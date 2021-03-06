<?php

class UserController extends BaseController {
    

    
    public function insertUser()
    {
	$image = Input::file('image'); // get the file from your input
	$avatarFile = 'default.png';
	
	if($image){
	    $destinationPath = 'public/img/avatars';
	    $filename = Input::get('username');
	    $extension =$image->getClientOriginalExtension(); //if you need extension of the file
	    $uploadSuccess = Input::file('image')->move($destinationPath, $filename.".".$extension);
	    
	    
	    if( $uploadSuccess ) {;
	       $avatarFile = $filename.".".$extension;
	    }    
	}
	
	
	$user = new User();
	
	$user->username = Input::get('username');
	$user->password = Hash::make(Input::get('password'));
	$user->active = 1;
	$user->email = Input::get('email');
	$user->tagline = Input::get('tagline');
	$user->avatarFile = $avatarFile;

	$user->save();

	
	return $this->loginUser();
    }
    
 public function loginUser()
    {
	if (Input::get("LoginFacebook", false))
	{
		return $this->loginFacebook();
	}

	$userdata = array(
	    'username'      => Input::get('username'),
	    'password'      => Input::get('password'),
	    'active'        => 1
	);
	
	return $this->authenticateUser($userdata);
    }

    public function loginFacebookEmail()
    {
	$userfacebook = $_SESSION['user'];
	$userfacebook['email'] = Input::get('email');

	$userdata = $this->insertUserFacebook($userfacebook);
	return $this->authenticateUser($userdata);
	
    }
    
    public function authenticateUser(array $userdata)
    {
	if ( Auth::attempt($userdata) )
	    {
	        // we are now logged in, go to home
		
		return Redirect::to('');
	    }
	    else
	    {
	    // auth failure! lets go back to the login
	        return Redirect::to('login')
			->with('login_errors', true);
	    // pass any error notification you want
	    // i like to do it this way :)
	    }
    }
    
    public function showHome(){
	$recentEpisodes = Episode::orderBy('id', 'DESC')->get()->take(8);
	return View::make('home' ,array("recentEpisodes" => $recentEpisodes));
    }
    
    public function insertUserFacebook(array $userfacebook)
    {
	$user = new User();
	
	$user->username = $userfacebook['username'];
	$user->password = Hash::make($userfacebook['id']);
	$user->active = 1;
	$user->email = $userfacebook['email'];
	$user->tagline = 'I love communitypodcast';
	
	$user->save();
	
	return array('username' => $userfacebook['username'], 'password' => $userfacebook['id'], 'active' => 1);
    }
    
    public function loginFacebook()
    {
	$auth = Facebook::auth();

	if(isset($_GET['error']))
	{
	    return Redirect::to('login');
	}
	
	if(!isset($_GET['code']) && !isset($_SESSION['token']))
	{
	    //$params = array('scope' => 'email', 'redirect_url' => 'http://localhost:81/compod/compod/server.php/loginFacebook');
	    //$login = "https://www.facebook.com/dialog/oauth?client_id={$appId}&redirect_uri={$redirecturi}";
	    
	    $login = $auth->getLoginUrl(array('scope' => 'email'));
	    return Redirect::to($login);
	}
	elseif(isset($_GET['code']))
	{

	    $code = $_GET['code'];
	   
	    //$access = "https://graph.facebook.com/oauth/access_token?client_id={$appId}&redirect_uri={$redirecturi}&client_secret={$secret}&code={$code}";
	    //$access = $curl->simple_get($access);
	    $access = $auth->getAccess($code);
	    	    
	    $_SESSION['access_token'] = $access['access_token'];
	    
	    $graph = Facebook::graph($_SESSION['access_token']);
	    $userfacebook = $graph->getUser();
	    $user = User::where('username', '=', $userfacebook['username'])->first();
	    $userdata = array('username' =>  $userfacebook['username'], 'password' => $userfacebook['id'], 'active' => 1);
	    
	    if($user == null)
	    {
		if(array_key_exists('email', $userfacebook))
		{
		    $userdata = $this->insertUserFacebook($userfacebook);
		}
		else
		{
		    $_SESSION["user"] = $userfacebook;
		    Return Redirect::to('loginEmail');
		}
	    }

	
	    return $this->authenticateUser($userdata);
	    
	    
	}    
    }
    
    public function showMyUser()
    {
	$user_id = Auth::user()->id;
	$skills = $this->getAllSkills();
	$podcasts = DB::select("select p.id, p.name, count(e.id) episode_count, up.creator podcast_isCreator from podcasts p JOIN user_podcast up ON up.podcast = p.id LEFT JOIN episodes e ON e.podcast = p.id and e.active = 1 WHERE p.active = 1 AND up.active = 1 AND up.user = ".$user_id." GROUP BY p.name");
	$episodes = DB::select('SELECT 
				A.episode_date,
				A.episode_title,
				A.podcast_name,
				A.podcast_id,
				A.episode_id,
				IF(c.id is NULL, 0, 1) episode_isCreator
				FROM
				    (
				    SELECT  date(e.publishdate) episode_date, 
					    e.title episode_title, 
					    e.id episode_id,
					    p.name podcast_name,
					    p.id podcast_id
				    FROM episodes e 
				    JOIN podcasts p ON p.id = e.podcast 
				    JOIN user_podcast up on p.id = up.podcast 
				    WHERE up.user = '.$user_id.'
				    ORDER BY publishdate DESC 
				    LIMIT 25
				    ) A
				LEFT JOIN creator c on c.user = '.$user_id.' and c.episode = A.episode_id');
	return View::make('user', array('skills' => $skills, 'podcasts' => $podcasts, 'episodes' => $episodes));
    }
    
    public function getAllSkills()
    {
	return DB::select('select s.*, if(us.id is null, 0,1) is_mastered from skills s LEFT JOIN user_skill us ON us.skill = s.id AND us.active = 1 AND us.user = '.Auth::user()->id);
    }
    
    public function saveSkills()
    {
	$skills = $this->getAllSkills();
	$user_id = Auth::user()->id;
	$debug = "";
	foreach($skills as $skill){
	    $mastered = false;
	    if(Input::get($skill->skill) == $skill->id){
		$mastered = true;
	    }
	    
	    if($mastered != $skill->is_mastered){ //only try update if value has changed
		$result = DB::table('user_skill')
			->where('user', $user_id)
			->where('skill', $skill->id)
			->update(array('active' => $mastered));
			
		if(!$result && $mastered){ //if update fails, that means there isn't a row yet so we insert one, but only if the skill is mastered
		    $result = DB::table('user_skill')->insert(array(
			'user'  => $user_id,
			'skill'  => $skill->id,
			'active'    => 1
		    ));
		}
	    }
	}
	
	return $this->showMyUser();
    }
    public function curPageURL()
    {
	    $pageURL = 'http';
	    
	    if ($_SERVER["HTTPS"] == "on")
	    {
	    	$pageURL .= "s";
	    }
	    $pageURL .= "://";
		
	    if ($_SERVER["SERVER_PORT"] != "80")
	    {
	    	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	    } else {
	    	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	    }
	    return $pageURL;	
    }

}

?>
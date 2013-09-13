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
	
	DB::table('users')->insert(array(
	    'username'  => Input::get('username'),
	    'password'  => Hash::make(Input::get('password')),
	    'active'    => 1,
	    'email'	=> Input::get('email'),
	    'tagline'	=> Input::get('tagline'),
	    'avatarFile' => $avatarFile
	));
	
	return $this->loginUser();
    }
    
    public function loginUser()
    {
	$userdata = array(
	    'username'      => Input::get('username'),
	    'password'      => Input::get('password'),
	    'active'        => 1
	);
	
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
    
    public function showMyUser()
    {
	$user_id = Auth::user()->id;
	$skills = DB::select('select s.* from skills s JOIN user_skill us ON us.skill = s.id WHERE us.active = 1 AND us.user = '.$user_id);
	$podcasts = DB::select("select p.name, count(e.id) episode_count, up.creator podcast_isCreator from podcasts p JOIN user_podcast up ON up.podcast = p.id JOIN episodes e ON e.podcast = p.id WHERE e.active = 1 AND p.active = 1 AND up.active = 1 AND up.user = ".$user_id." GROUP BY p.name");
	$episodes = DB::select('SELECT 
				A.episode_date,
				A.episode_title,
				A.podcast_name,
				IF(c.id is NULL, 0, 1) episode_isCreator
				FROM
				    (
				    SELECT 	date(e.publishdate) episode_date, 
					    e.title episode_title, 
					    e.id episode_id,
					    p.name podcast_name
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
}

?>
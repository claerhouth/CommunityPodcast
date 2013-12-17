<?php

class PodcastController extends BaseController {
    
    public function showAllPodcast()
    {
	$podcasts = DB::select('select
			        p.id,
				p.name,
				p.description,
				p.iconFile,
				IF(up.id IS NULL, 0, 1) isSubscribed,
				up.creator
				from podcasts p
				left join user_podcast up on up.podcast = p.id and up.user = '.Auth::user()->id.'  and up.active = 1');
	return View::make('podcastOverview',array("podcasts" => $podcasts, "type" => "all", "search" => ""));
    }
    public function showAbcPodcast()
    {
	$podcasts = DB::select('select
			        p.id,
				p.name,
				p.description,
				p.iconFile,
				IF(up.id IS NULL, 0, 1) isSubscribed,
				up.creator
				from podcasts p
				left join user_podcast up on up.podcast = p.id and up.user = '.Auth::user()->id.'  and up.active = 1 ORDER BY p.name ASC');
	return View::make('podcastOverview',array("podcasts" => $podcasts, "type" => "alfabetical list of", "search" => ""));
    }
    public function showZyxPodcast()
    {
	$podcasts = DB::select('select
			        p.id,
				p.name,
				p.description,
				p.iconFile,
				IF(up.id IS NULL, 0, 1) isSubscribed,
				up.creator
				from podcasts p
				left join user_podcast up on up.podcast = p.id and up.user = '.Auth::user()->id.'  and up.active = 1 ORDER BY p.name DESC');
	return View::make('podcastOverview',array("podcasts" => $podcasts, "type" => "alfabetical list of", "search" => ""));
    }
    
    public function showMyPodcast()
    {
	$podcasts = DB::select('select p.* from podcasts p JOIN user_podcast up ON up.podcast = p.id  WHERE up.creator = 1 AND up.user = '.Auth::user()->id);
	return View::make('podcastOverview' ,array("podcasts" => $podcasts, "type" => Auth::user()->username."'s", "search" => ""));
    }
    
    public function insertPodcast(){
	$image = Input::file('image'); // get the file from your input
	$iconFile = 'default.png';
	
	if($image){
	    $destinationPath = 'public/img/podcastlogos';
	    
	    $rand = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
	    $shrtName = substr(trim(Input::get('name')),0,4);
	    $filename = Auth::user()->id."_".$shrtName."_".$rand;
	    
	    $extension =$image->getClientOriginalExtension(); //if you need extension of the file
	    $uploadSuccess = Input::file('image')->move($destinationPath, $filename.".".$extension);

	    if( $uploadSuccess ) {;
	       $iconFile = $filename.".".$extension;
	    }    
	}
	
	$podcastId = DB::table('podcasts')->insertGetId(array(
	    'name'  => Input::get('name'),
	    'description'  => Input::get('description'),
	    'inviteOnly'    => 1,
	    'iconFile' => $iconFile
	));
	
	DB::table('user_podcast')->insert(array(
	    'user'  => Auth::user()->id,
	    'podcast' => $podcastId,
	    'creator' => 1
	));
	
	return $this->showMyPodcast();
    }
    
    public function subscribe($id)
    {
	return $this->changeSubscribe($id, 1);
    }
    
    public function unsubscribe($id)
    {
	return $this->changeSubscribe($id, 0);
    }
    
    private function changeSubscribe($id, $value){
	$result = DB::table('user_podcast')
			->where('podcast', $id)
			->where('user', Auth::user()->id)
			->update(array('active' => $value));
	
	if(!$result && $value){
	    $result = DB::table('user_podcast')->insert(array(
		'user'  => Auth::user()->id,
		'podcast'  => $id,
		'creator'    => 0
	    ));
	}
	
	if($result || !$value){
	    return Redirect::to('podcastoverview');
	}
	return $result;
    }
    
    public function showPodcastDetail($id){
	$podcastDetail = DB::select("select p.*, u.username podcast_creator from podcasts p join user_podcast up on up.podcast = p.id join users u on u.id = up.user  where p.id =".$id);
	$episodes = DB::select("select * from episodes where podcast=".$id.' ORDER by publishdate DESC');
	$podcastSkills = $this->getUserSkills($id);
	
	return View::make('podcast',array('podcast' => $podcastDetail[0], 'episodes' => $episodes, 'skills' => $podcastSkills));
    }
    
    public function searchPodcast(){
	$search = Input::get('search');
	
	$podcasts = DB::select("select
			        p.id,
				p.name,
				p.description,
				IF(up.id IS NULL, 0, 1) isSubscribed,
				up.creator,
				p.iconFile
				from podcasts p
				left join user_podcast up on up.podcast = p.id and up.user = ".Auth::user()->id."  and up.active = 1
				WHERE (p.name like '%".$search."%' OR p.description like '%".$search."%')");
	
	return View::make('podcastOverview',array("podcasts" => $podcasts, "own" => 0, "type" => "search", "search" => $search));
    }
    
    public function getUserSkills($podcast_id){
	return 	DB::select("select s.*,
		    us.id user_skill_id,
		    usp.*,
		    if(usp.id IS NULL, 0, 1) use_skill
		    from user_skill us
		    JOIN skills s on s.id = us.skill
		    LEFT JOIN user_skill_podcast usp ON usp.podcast = ".$podcast_id." and usp.user_skill = us.id and usp.active = 1 
		    WHERE us.user =".Auth::user()->id." 
		    AND us.active = true");
    }
    
    public function saveSkills(){
	$podcast_id = Input::get("podcastId");
	$skills = $this->getUserSkills($podcast_id);
	
	foreach($skills as $skill){
	    $used = false;
	    
	    if(Input::get($skill->skill) == $skill->user_skill_id){
		$used = true;
	    }
	    
	    if($used != $skill->use_skill){ //only try update if value has changed

		$result = DB::table('user_skill_podcast')
			->where('user_skill', $skill->user_skill_id)
			->where('podcast', $podcast_id)
			->update(array('active' => $used));
			
		if(!$result && $used){ //if update fails, that means there isn't a row yet so we insert one, but only if the skill is mastered
		    $result = DB::table('user_skill_podcast')->insert(array(
			'user_skill'  => $skill->user_skill_id,
			'podcast'  => $podcast_id,
			'active'    => 1
		    ));
		}
	    }
	}
	
	return Redirect::to('podcast/'.$podcast_id);
    }
}

?>
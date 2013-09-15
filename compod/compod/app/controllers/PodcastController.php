<?php

class PodcastController extends BaseController {
    
    public function showAllPodcast()
    {
	$podcasts = DB::select("select
			        p.id,
				p.name,
				p.description,
				IF(up.id IS NULL, 0, 1) isSubscribed,
				up.creator
				from podcasts p
				left join user_podcast up on up.podcast = p.id and up.user = ".Auth::user()->id."  and up.active = 1");
	return View::make('podcastOverview',array("podcasts" => $podcasts, "own" => 0));
    }
    
    public function insertPodcast(){
	$podcastId = DB::table('podcasts')->insertGetId(array(
	    'name'  => Input::get('name'),
	    'description'  => Input::get('description'),
	    'inviteOnly'    => 1
	));
	
	DB::table('user_podcast')->insert(array(
	    'user'  => Auth::user()->id,
	    'podcast' => $podcastId,
	    'creator' => 1
	));
	
	return $this->showMyPodcast();
    }
    
    public function showMyPodcast()
    {
	$podcasts = DB::select('select p.* from podcasts p JOIN user_podcast up ON up.podcast = p.id  WHERE up.creator = 1 AND up.user = '.Auth::user()->id);
	return View::make('podcastOverview' ,array("podcasts" => $podcasts, "own" => 1));
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
}

?>
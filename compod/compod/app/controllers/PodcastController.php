<?php

class PodcastController extends BaseController {
    
    public function showAllPodcast()
    {
	$podcasts = DB::select('select * from podcasts');
	return View::make('podcastOverview',array("podcasts" => $podcasts, "own" => 0));
    }
    
    public function showMyPodcast()
    {
	$podcasts = DB::select('select p.* from podcasts p JOIN user_podcast up ON up.podcast = p.id  WHERE up.creator = 1 AND up.user = '.Auth::user()->id);
	return View::make('podcastOverview' ,array("podcasts" => $podcasts, "own" => 1));
    }
}

?>
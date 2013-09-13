<?php

class EpisodeController extends BaseController {
    public function showAllEpisodes()
    {
	$episodes = DB::select('select date(e.publishdate) episode_date, e.title episode_title, e.description episode_desc, p.name podcast_name from episodes e JOIN podcasts p ON p.id = e.podcast ORDER BY publishdate DESC');	
	return View::make('episodeOverview' ,array("episodes" => $episodes, "own" => 0));
    }
    
    public function showMyEpisodes()
    {
	$episodes = DB::select('select date(e.publishdate) episode_date, e.title episode_title, e.description episode_desc, p.name podcast_name from episodes e JOIN podcasts p ON p.id = e.podcast JOIN creator c ON c.episode = e.id WHERE c.user = '.Auth::user()->id.' ORDER BY publishdate DESC');	
	return View::make('episodeOverview', array("episodes" => $episodes, "own" => 1));
    }
}

?>
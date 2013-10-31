<?php

class EpisodeController extends BaseController {
    public function showAllEpisodes()
    {
	$episodes = DB::select('select date(e.publishdate) episode_date, e.id episode_id, e.title episode_title, e.description episode_desc, e.iconFile episode_icon ,p.name podcast_name, p.id podcast_id from episodes e JOIN podcasts p ON p.id = e.podcast ORDER BY publishdate DESC');	
	return View::make('episodeOverview' ,array("episodes" => $episodes, "type" => "all"));
    }
    
    public function showRecentEpisodes()
    {
	$episodes = DB::select('select date(e.publishdate) episode_date, e.id episode_id, e.title episode_title, e.description episode_desc, e.iconFile episode_icon ,p.name podcast_name, p.id podcast_id from episodes e JOIN podcasts p ON p.id = e.podcast ORDER BY publishdate DESC LIMIT 25');
	return View::make('episodeOverview' ,array("episodes" => $episodes, "type" => "recent"));
    }
    public function showOldEpisodes()
    {
	$episodes = DB::select('select date(e.publishdate) episode_date, e.id episode_id, e.title episode_title, e.description episode_desc, e.iconFile episode_icon ,p.name podcast_name, p.id podcast_id from episodes e JOIN podcasts p ON p.id = e.podcast ORDER BY publishdate ASC LIMIT 25');
	return View::make('episodeOverview' ,array("episodes" => $episodes, "type" => "old"));
    }
    public function showAbcEpisodes()
    {
	$episodes = DB::select('select date(e.publishdate) episode_date, e.id episode_id, e.title episode_title, e.description episode_desc, e.iconFile episode_icon ,p.name podcast_name, p.id podcast_id from episodes e JOIN podcasts p ON p.id = e.podcast ORDER BY episode_title ASC LIMIT 25');
	return View::make('episodeOverview' ,array("episodes" => $episodes, "type" => "alfabetical list of"));
    }
    public function showZyxEpisodes()
    {
	$episodes = DB::select('select date(e.publishdate) episode_date, e.id episode_id, e.title episode_title, e.description episode_desc, e.iconFile episode_icon ,p.name podcast_name, p.id podcast_id from episodes e JOIN podcasts p ON p.id = e.podcast ORDER BY episode_title DESC LIMIT 25');
	return View::make('episodeOverview' ,array("episodes" => $episodes, "type" => "reverse alfabetical list of"));
    }
    
    public function showMyEpisodes()
    {
	$episodes = DB::select('select date(e.publishdate) episode_date, e.id episode_id, e.title episode_title, e.description episode_desc, e.iconFile episode_icon , p.name podcast_name, p.id podcast_id from episodes e JOIN podcasts p ON p.id = e.podcast JOIN creator c ON c.episode = e.id WHERE c.user = '.Auth::user()->id.' ORDER BY publishdate DESC');	
	return View::make('episodeOverview', array("episodes" => $episodes, "type" => Auth::user()->username."'s"));
    }
    
    public function showEpisodeDetail($id)
    {
	$episode = DB::select('select * from episodes where id = '.$id);
	$users = DB::select('select u.username
			    from users u
			    join creator c on u.id = c.user
			    where c.episode ='.$id);
	return View::make('episode', array("episode" => $episode[0], "creators" => $users));
    }
    public function getRecentEpisodes($count)
    {
	
	return "dikke tetten";
    }
    
    public function addEpisode($podcast_id)
    {
	$podcast = DB::select('select * from podcasts where id = '.$podcast_id);
	return View::make('addEpisode', array("podcast" => $podcast[0]));
    }
    
    public function insertEpisode(){
	$file = Input::file('file'); // get the file from your input
	$filename = "";
	$podcast_id = Input::get('podcastId');
	
	$rand = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
	$shrtName = substr(trim(Input::get('title')),0,4);
	    
	if($file){
	    $destinationPath = 'public/mp3';
	    
	    $filename = $podcast_id."_".$shrtName."_".$rand.".mp3";
	    $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
	    
	    if( is_null($uploadSuccess)) {
		return "Upload failed, please try again.";
	    }
	    
	}else{
	    return "The file you used is not OK";
	}
	
	$image = Input::file('image'); // get the file from your input
	$iconFile = 'default.png';
	
	if($image){
	    $destinationPath = 'public/img/episodelogos';
	    
	    $imagename = $podcast_id."_".$shrtName."_".$rand;
	    $extension =$image->getClientOriginalExtension(); //if you need extension of the file
	    $uploadSuccess = Input::file('image')->move($destinationPath, $imagename.".".$extension);

	    if( $uploadSuccess ) {;
	       $iconFile = $imagename.".".$extension;
	    }    
	}
	
	$newId = DB::table('episodes')->insertGetId(array(
	    'title'  => Input::get('title'),
	    'description'  => Input::get('description'),
	    'file' => $filename,
	    'publishdate' => date("Y-m-d H:i:s"),
	    'podcast' => $podcast_id,
	    'iconFile' => $iconFile
	));
	
	DB::table('creator')->insert(array(
	    'episode' => $newId,
	    'user' => Auth::user()->id
	));
	
	return Redirect::to('podcast/'.$podcast_id);
    }
}

?>
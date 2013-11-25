<?php

class Podcast extends Eloquent
{
    protected $table = 'podcasts';
    protected $primaryKey = 'podcast_id';
    
    public static function createPodcast($name, $description, $inviteOnly,$iconFile ){
	$podcast = new Podcast;

	$podcast->name = $name;
	$podcast->description = $description;
	$podcast->inviteOnly = $inviteOnly;
	$podcast->iconFile = $iconFile;
	
	$podcast->save();
	
	return $podcast;
    }
    
    public function episodes()
    {
            return $this->hasMany('Episode', 'podcast_id');
    }
    
    public function users()
    {
	return $this->belongsToMany('User', 'user_podcast', 'podcast', 'user');
    }
    
    public function isSubscribed()
    {
        
        $podcast = $this->users()->where('user_podcast.user', '=', Auth::user()->id)->where('user_podcast.active', '=', '1')->first();
        
        
        if($podcast != null)
        {
            return true;
        }
        
        return false;
    }

}
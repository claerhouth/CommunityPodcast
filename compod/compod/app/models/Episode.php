<?php

class Episode extends Eloquent
{
    protected $table = 'episodes';
    
    
    
    public function podcast()
    {
        return $this->belongsTo('Podcast', 'podcast_id');
    }
}
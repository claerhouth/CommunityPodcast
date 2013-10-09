<?php

class Skill extends Eloquent
{
    protected $table = 'skills';
    
    function users()
    {
        return $this->belongsToMany('User', 'user_skill', 'skill', 'user')->withPivot('active');
    }
    
}
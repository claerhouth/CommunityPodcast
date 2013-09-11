<?php

class SkillController extends BaseController {
    
    
    public function insertDefaultSkills()
    {
        DB::table('skills')->insert(array(
	    'skill'  => 'host',
	    'description'  => 'This person makes sure the podcast is created on time and may upload the episode.'
	));
        
        DB::table('skills')->insert(array(
	    'skill'  => 'editor',
	    'description'  => 'This person knows how to edit audio and mixes the audio of different participators into one coherent podcast.'
	));
        
        DB::table('skills')->insert(array(
	    'skill'  => 'guest',
	    'description'  => 'This person has knowledge or is passionate about the topic at hand and joins in on the conversation.'
	));
        
        return "Default skills created";
    }
}

?>
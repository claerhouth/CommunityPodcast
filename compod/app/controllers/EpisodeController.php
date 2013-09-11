<?php

class EpisodeController extends BaseController {
    
    
    public function createTestEpisodes()
    {
        DB::table('episodes')->insert(array(
	    'title'  => 'Gaming 101',
	    'description'  => 'How do we define gaming? Why do we game and what do we play?',
            'podcast' => 52,
            'file' => "gaming101.mp3"
	));
        
        DB::table('episodes')->insert(array(
	    'title'  => 'Bolognaise',
	    'description'  => "Let's start of with a classic, that isn't actually a classic.",
            'podcast' => 72,
            'file' => "bolognaise.mp3"
	));
        
        DB::table('episodes')->insert(array(
	    'title'  => 'What is community podcast',
	    'description'  => "We explain what community podcast is and why we created it.",
            'podcast' => 62,
            'file' => "cp001.mp3"
	));
        
        DB::table('episodes')->insert(array(
	    'title'  => 'The problem with platformers',
	    'description'  => "There's something wrong with todays platformers and we are determined to discover what that is.",
            'podcast' => 52,
            'file' => "platformersAreNotOk.mp3"
	));
        
        DB::table('episodes')->insert(array(
	    'title'  => 'Miauw',
	    'description'  => "Maauw miaaauw maauw maauw miaaw",
            'podcast' => 92,
            'file' => "miauw.mp3"
	));
        
        DB::table('episodes')->insert(array(
	    'title'  => 'Ragnar',
	    'description'  => "Let's discuss this legend",
            'podcast' => 82,
            'file' => "ragnar.mp3"
	));
        
        DB::table('episodes')->insert(array(
	    'title'  => 'Boom Headshot',
	    'description'  => "Our love for bullets through the head.",
            'podcast' => 102,
            'file' => "BH01.mp3"
	));
        
        DB::table('episodes')->insert(array(
	    'title'  => 'Funghi',
	    'description'  => "We like shrooms.",
            'podcast' => 72,
            'file' => "funghi.mp3"
	));
        
        DB::table('episodes')->insert(array(
	    'title'  => 'What are your skills?',
	    'description'  => "We give an in depth look at the skill system.",
            'podcast' => 62,
            'file' => "cp002.mp3"
	));
        
        DB::table('episodes')->insert(array(
	    'title'  => 'Games for girls',
	    'description'  => "Should there be a difference between games for guys and games for girls?",
            'podcast' => 52,
            'file' => "gfg.mp3"
	));
        
        return "Test episodes created";
    }
    
    public function simulateEpisodeCreators()
    {
	DB::table('creator')->insert(array(
	    'user'  => 42,
	    'episode'  => 2
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 52,
	    'episode'  => 2
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 62,
	    'episode'  => 12
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 52,
	    'episode'  => 22
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 42,
	    'episode'  => 32
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 52,
	    'episode'  => 32
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 52,
	    'episode'  => 42
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 62,
	    'episode'  => 52
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 42,
	    'episode'  => 62
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 62,
	    'episode'  => 62
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 62,
	    'episode'  => 72
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 52,
	    'episode'  => 82
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 42,
	    'episode'  => 92
	));
	
	DB::table('creator')->insert(array(
	    'user'  => 52,
	    'episode'  => 92
	));
        
        return "Episode creators simulated";
    }
}

?>
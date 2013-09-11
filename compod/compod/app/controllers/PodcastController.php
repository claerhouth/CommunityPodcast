<?php

class PodcastController extends BaseController {
    
    
    public function createTestPodcasts()
    {
        DB::table('podcasts')->insert(array(
	    'name'  => 'Gaming',
	    'description'  => 'We talk about anything gaming. From console wars to FPS leveling systems, everything goes.'
	));
        
        DB::table('podcasts')->insert(array(
	    'name'  => 'Community Podcast',
	    'description'  => "The house podcast. We put a spotlight on our community and reveal what's to come"
	));
        
        DB::table('podcasts')->insert(array(
	    'name'  => 'Pizza',
	    'description'  => 'Slice up some tomatoes and hold on to your garlic. Pizza is coming!'
	));
        
        DB::table('podcasts')->insert(array(
	    'name'  => 'Vikings',
	    'description'  => 'This podcast is limited to guys with beards.',
            'inviteOnly' => 1
	));
        
        DB::table('podcasts')->insert(array(
	    'name'  => 'Kittens',
	    'description'  => 'Talking about the backbone of the internet.'
	));
        
        DB::table('podcasts')->insert(array(
	    'name'  => 'FPS',
	    'description'  => "If you like cameras stuck in your head while you're shooting stuff, than this podcast is for you."
	));
        
        return "Test podcasts created";
    }
}

?>
<?php

class DefaultDataController extends BaseController {
    
    public function insertTestUser()
    {
        DB::table('users')->insert(array(
	    'username'  => 'jarres',
	    'password'  => Hash::make('test'),
	    'active'    => 1,
	    'email'	=> 'hcl604@gmail.com'
	));

        return "User created";
    }
    
    public function makeTestPodcastCreators()
    {
	DB::table('user_podcast')->insert(array(
	    'user'  => '42',
	    'podcast'  => 52,
	    'creator'    => 1
	));
	
	DB::table('user_podcast')->insert(array(
	    'user'  => '52',
	    'podcast'  => 62,
	    'creator'    => 1
	));
	
	DB::table('user_podcast')->insert(array(
	    'user'  => '62',
	    'podcast'  => 72,
	    'creator'    => 1
	));
	
	DB::table('user_podcast')->insert(array(
	    'user'  => '62',
	    'podcast'  => 82,
	    'creator'    => 1
	));
	
	DB::table('user_podcast')->insert(array(
	    'user'  => '52',
	    'podcast'  => 92,
	    'creator'    => 1
	));
	
	DB::table('user_podcast')->insert(array(
	    'user'  => '42',
	    'podcast'  => 102,
	    'creator'    => 1
	));

        return "Creators simulated";
    }
    
    public function makeTestSkillOwners()
    {
	DB::table('user_skill')->insert(array(
	    'user'  => 42,
	    'skill'  => 2
	));
	
	DB::table('user_skill')->insert(array(
	    'user'  => 42,
	    'skill'  => 22
	));
	
	DB::table('user_skill')->insert(array(
	    'user'  => 42,
	    'skill'  => 32
	));
	
	DB::table('user_skill')->insert(array(
	    'user'  => 52,
	    'skill'  => 2
	));
	
	DB::table('user_skill')->insert(array(
	    'user'  => 52,
	    'skill'  => 12
	));
	
	DB::table('user_skill')->insert(array(
	    'user'  => 52,
	    'skill'  => 22
	));
	
	DB::table('user_skill')->insert(array(
	    'user'  => 62,
	    'skill'  => 2
	));
	
	DB::table('user_skill')->insert(array(
	    'user'  => 62,
	    'skill'  => 22
	));

        return "Skill owners simulated";
    }
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
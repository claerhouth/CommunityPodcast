<?php

class UserController extends BaseController {
    
    
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
}

?>
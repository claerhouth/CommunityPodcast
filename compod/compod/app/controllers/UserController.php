<?php

class UserController extends BaseController {
    
    
    public function insertUser()
    {
	$image = Input::file('image'); // get the file from your input
	$destinationPath = 'public/img/avatars';
	$filename = Input::get('username');
	$extension =$image->getClientOriginalExtension(); //if you need extension of the file
	$uploadSuccess = Input::file('image')->move($destinationPath, $filename.".".$extension);
	
	$avatarFile = 'default.png';
	if( $uploadSuccess ) {;
	   $avatarFile = $filename.".".$extension;
	}
	
	DB::table('users')->insert(array(
	    'username'  => Input::get('username'),
	    'password'  => Hash::make(Input::get('password')),
	    'active'    => 1,
	    'email'	=> Input::get('email'),
	    'tagline'	=> Input::get('tagline'),
	    'avatarFile' => $avatarFile
	));
	
	$userdata = array(
	    'username'      => Input::get('username'),
	    'password'      => Input::get('password'),
	    'active'        => 1
	);
	
	if ( Auth::attempt($userdata) )
	{
	    // we are now logged in, go to home
	    return Redirect::to('');
	}
	else
	{
	    // auth failure! lets go back to the login
	    return Redirect::to('login')
		->with('login_errors', true);
	    // pass any error notification you want
	    // i like to do it this way :)
	}
    }
    
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
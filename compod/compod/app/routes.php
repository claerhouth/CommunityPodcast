<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('insertuser', 'UserController@insertTestUser');
Route::get('createdefaultskills', 'SkillController@insertDefaultSkills');
Route::get('createTestPodcasts', 'PodcastController@createTestPodcasts');
Route::get('createTestEpisodes', 'EpisodeController@createTestEpisodes');
Route::get('simulatePodcastCreators', 'UserController@makeTestPodcastCreators');
Route::get('simulateSkillOwners', 'UserController@makeTestSkillOwners');
Route::get('simulateEpisodeCreators', 'EpisodeController@simulateEpisodeCreators');

Route::get('login', array('as' => 'login', function() {
    return View::make('login');
}));

Route::post('login', function() {
    // get POST data
    $userdata = array(
        'username'      => Input::get('username'),
        'password'      => Input::get('password'),
	'active'        => 1
    );

    if ( Auth::attempt($userdata) )
    {
        // we are now logged in, go to home
        //return Redirect::to('home');
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
});

Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('login');
});

Route::get('podcastoverview', array('before' => 'auth', 'do' => function(){
    $podcasts = DB::select('select p.* from podcasts p JOIN user_podcast up ON up.podcast = p.id  WHERE up.creator = 1 AND up.user = '.Auth::user()->id);
    return View::make('podcastOverview')->with("podcasts", $podcasts);
}));

Route::get('episodeoverview', array('before' => 'auth', 'do' => function(){
    $episodes = DB::select('select date(e.publishdate) episode_date, e.title episode_title, e.description episode_desc, p.name podcast_name from episodes e JOIN podcasts p ON p.id = e.podcast JOIN creator c ON c.episode = e.id WHERE c.user = '.Auth::user()->id.' ORDER BY publishdate DESC');	
    return View::make('episodeOverview')->with("episodes", $episodes);
}));

Route::get('', array('before' => 'auth', 'do' => function() {
    return View::make('home');
}));

Route::get('user', array('before' => 'auth', 'do' => function() {
    $skills = DB::select('select s.* from skills s JOIN user_skill us ON us.skill = s.id WHERE us.active = 1 AND us.user = '.Auth::user()->id);
    $podcasts = DB::select("select p.name, count(e.id) episode_count from podcasts p JOIN user_podcast up ON up.podcast = p.id JOIN episodes e ON e.podcast = p.id WHERE e.active = 1 AND p.active = 1 AND up.active = 1 AND up.user = ".Auth::user()->id." GROUP BY p.name");
    //$podcasts = DB::select('select p.* from podcasts p JOIN user_podcast up ON up.podcast = p.id  WHERE up.user = '.Auth::user()->id);
    $episodes = DB::select('select date(e.publishdate) episode_date, e.title episode_title, p.name podcast_name from episodes e JOIN podcasts p ON p.id = e.podcast JOIN user_podcast up on p.id = up.podcast WHERE up.user = '.Auth::user()->id.' ORDER BY publishdate DESC LIMIT 25');
    return View::make('user', array('skills' => $skills, 'podcasts' => $podcasts, 'episodes' => $episodes));
}));
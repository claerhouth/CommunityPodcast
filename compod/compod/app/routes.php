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

//__BASIC_NAVIGATION

Route::get('login', array('as' => 'login', function() {
    return View::make('login');}));

Route::get('signup', function(){
    return View::make('signup');
});

Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('login');
});

Route::get('player', function() {
    return View::make('playertest');
});

Route::get('addPodcast', array('before' => 'auth', 'do' => function() {
    return View::make('addPodcast');	
}));


//___ACTIONS

//USERS
Route::get('',  array('before' => 'auth','uses' => 'UserController@showHome'));
Route::post('login', 'UserController@loginUser');
Route::post('loginFacebook', 'UserController@loginFacebook');
Route::post('loginFacebookEmail', 'UserController@loginFacebookEmail');
Route::get('loginFacebook', 'UserController@loginFacebook');
Route::get('loginEmail', function(){ return View::make('loginEmail'); });
Route::post('signup', 'UserController@insertUser');
Route::post('user', 'UserController@saveSkills');
Route::get('user', array('before' => 'auth', 'uses' => 'UserController@showMyUser'));

//PODCASTS
Route::get('podcastoverview', array('before' => 'auth', 'uses' =>'PodcastController@showAllPodcast'));
Route::get('podcastoverviewforuser', array('before' => 'auth', 'uses' =>'PodcastController@showMyPodcast'));
Route::get('subscribe/{id?}', array('before' => 'auth', 'uses' =>'PodcastController@subscribe'));
Route::get('unsubscribe/{id?}', array('before' => 'auth', 'uses' =>'PodcastController@unsubscribe'));
Route::post('addPodcast', 'PodcastController@insertPodcast');
Route::get('podcast/{id?}', array('before' => 'auth', 'uses' =>'PodcastController@showPodcastDetail'));
Route::post('searchpodcast', array('before' => 'auth', 'uses' =>'PodcastController@searchPodcast'));
Route::post('podcast/{id?}', array('before' => 'auth', 'uses' =>'PodcastController@saveSkills'));

//EPISODES
Route::get('recentoverview', array('before' => 'auth', 'uses' =>'EpisodeController@showRecentEpisodes'));
Route::get('episodeoverview', array('before' => 'auth', 'uses' =>'EpisodeController@showAllEpisodes'));
Route::get('episodeoverviewforuser', array('before' => 'auth', 'uses' =>'EpisodeController@showMyEpisodes'));
Route::get('episode/{id?}', array('before' => 'auth', 'uses' =>'EpisodeController@showEpisodeDetail'));
Route::get('addEpisode/{podcast_id?}', array('before' => 'auth', 'uses' =>'EpisodeController@addEpisode'));
Route::post('addEpisode', 'EpisodeController@insertEpisode');

//DEFAULT DATA
Route::get('insertuser', 'DefaultDataController@insertTestUser');
Route::get('createdefaultskills', 'DefaultDataController@insertDefaultSkills');
Route::get('createTestPodcasts', 'DefaultDataController@createTestPodcasts');
Route::get('createTestEpisodes', 'DefaultDataController@createTestEpisodes');
Route::get('simulatePodcastCreators', 'DefaultDataController@makeTestPodcastCreators');
Route::get('simulateSkillOwners', 'DefaultDataController@makeTestSkillOwners');
Route::get('simulateEpisodeCreators', 'DefaultDataController@simulateEpisodeCreators');


<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'AuthController@getLogin')->name('auth.login');
Route::post('/login', 'AuthController@postLogin')->name('auth.login');
Route::get('/logout', 'AuthController@getLogout')->name('auth.logout');

Route::group(['middleware' => ['auth']], function() {
	Route::get('/', 'HomeController@index')->name('homepage');
	Route::get('/child-info/{child}', 'HomeController@childInfo')->name('child-info');
	Route::get('/facility-info/{facility}', 'HomeController@facilityInfo')->name('facility-info');
	Route::get('/child-search', 'HomeController@childSearch')->name('child-search');
	Route::get('/facility-search', 'HomeController@facilitySearch')->name('facility-search');
    
    Route::get('register', 'RegisterController@index')->name('register');

	Route::resource('children', 'ChildrenController');
	Route::resource('community-followup', 'CommunityFollowupController');
	Route::post('community-followup/{child}/save', 'CommunityFollowupController@save')->name('community-followup.save');
    
    
	Route::resource('facility', 'FacilityController');
	Route::resource('facility-followup', 'FacilityFollowupController');
	Route::post('facility-followup/{facility}/save', 'FacilityFollowupController@save')->name('facility-followup.save');
    
    

	Route::resource('user', 'UserController');
});
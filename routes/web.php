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
Route::get('/view', 'ViewController@index')->name('facility-home');

Route::group(['middleware' => ['auth']], function() {
	Route::get('/test', 'HomeController@test')->name('test');
	Route::get('/', 'HomeController@index')->name('homepage');
    
    Route::get('/program-manager', 'HomeController@programManagerDashboard')->name('program-manager');
    Route::get('/program-manager_ym/{year}/{month}', 'HomeController@programManagerDashboard_ym')->name('program-manager_ym');
    Route::get('/program-user_ym/{year}/{month}', 'HomeController@programUserDashboard_ym')->name('program-user_ym');

	Route::get('/child-info/{child}', 'HomeController@childInfo')->name('child-info');
	Route::get('/facility-info/{facility}', 'HomeController@facilityInfo')->name('facility-info');
	Route::get('/child-search', 'HomeController@childSearch')->name('child-search');
	Route::get('/facility-search', 'HomeController@facilitySearch')->name('facility-search');
    
    Route::get('register', 'RegisterController@index')->name('register');
    Route::get('otp_report_admin', 'ReportController@otp_report_admin')->name('otp_report_admin');
    Route::get('reports', 'ReportController@index')->name('reports');

	Route::resource('children', 'ChildrenController');
	Route::resource('community-followup', 'CommunityFollowupController');
	Route::post('community-followup/{child}/save', 'CommunityFollowupController@save')->name('community-followup.save');
    
	Route::resource('facility', 'FacilityController');
	Route::resource('facility-followup', 'FacilityFollowupController');
	Route::post('facility-followup/{facility}/save', 'FacilityFollowupController@save')->name('facility-followup.save');
	Route::resource('user', 'UserController');
    
    
	Route::resource('iycf-followup', 'IycfFollowupController');
	Route::post('iycf-followup/{iycf}/save', 'IycfFollowupController@save')->name('iycf-followup.save');

    Route::resource('monthly-dashboard', 'MonthlyDashboardController');

});



// SYNC ------------------------------------------------------------
Route::get('/sync/children', [
	'uses' => 'SyncDataClientController@syncChildrenClient',
	'as' => 'sync.children.client'
]);

Route::get('/sync/facility-followup', [
	'uses' => 'SyncDataClientController@syncFacilityFollowupClient',
	'as' => 'sync.facility-followup.client'
]);

Route::get('fix-sync', function() {
	// $childrens = App\Models\Child::all();
	// foreach($childrens as $child) {
	// 	$child->sync_id = '101' . $child->id;
	// 	$child->save();
	// }

	// $facility_followups = App\Models\FacilityFollowup::all();
	// foreach($facility_followups as $facility_followup) {
	// 	$facility_followup->sync_id = '101'. $facility_followup->id;
	// 	$facility_followup->save();
	// }

	// $facility_followups = App\Models\FacilityFollowup::all();
	// foreach($facility_followups as $facility_followup) {
	// 	if(!$facility_followup->nutritionstatus) {
	// 		$facility_followup->nutritionstatus = 'SAM';
	// 		$facility_followup->save();
	// 	}
	// }
	// dd('done');
});
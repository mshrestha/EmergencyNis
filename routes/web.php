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
Route::get('/', 'OtpImportController@open_dashboard')->name('open_dashboard');
Route::get('open_dashboard_ym', 'OtpImportController@open_dashboard_ym')->name('open_dashboard_ym');

Route::group(['middleware' => ['auth']], function() {
	Route::get('/test', 'HomeController@test')->name('test');
	Route::get('/homepage', 'HomeController@index')->name('homepage');
    
    Route::get('/program-manager', 'HomeController@programManagerDashboard')->name('program-manager');
    Route::get('/admin_ym/{year}/{month}', 'HomeController@adminDashboard_ym')->name('admin_ym');
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
    
    Route::get('/pregnant-women/{women}/info', 'PregnantWomenController@info')->name('pregnant-women.info');
    Route::resource('pregnant-women', 'PregnantWomenController');
    Route::resource('pregnant-women-followup', 'PregnantWomenFollowupController');
    
	Route::resource('iycf-followup', 'IycfFollowupController');
	Route::post('iycf-followup/{iycf}/save', 'IycfFollowupController@save')->name('iycf-followup.save');

    Route::resource('monthly-dashboard', 'MonthlyDashboardController');

    Route::get('importExportOtp', 'OtpImportController@importExportOtp')->name('importExportOtp');
    Route::post('importOtp', 'OtpImportController@importOtp');
    Route::get('importExportBsfp', 'BsfpImportController@importExportBsfp')->name('importExportBsfp');
    Route::post('importBsfp', 'BsfpImportController@importBsfp');
    Route::get('importExportTsfp', 'TsfpImportController@importExportTsfp')->name('importExportTsfp');
    Route::post('importTsfp', 'TsfpImportController@importTsfp');
    Route::get('importExportSc', 'ScImportController@importExportSc')->name('importExportSc');
    Route::post('importSc', 'ScImportController@importSc');

    Route::resource('supply', 'SupplyController');

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

Route::get('/sync/iycf-followup', [
	'uses' => 'SyncDataClientController@syncIycfFollowupClient',
	'as' => 'sync.iycf-followup.client'
]);

Route::get('/sync/pregnant-women', [
	'uses' => 'SyncDataClientController@syncPregnantWomenClient',
	'as' => 'sync.pregnant-women.client'
]);

Route::get('/sync/pregnant-women-followup', [
	'uses' => 'SyncDataClientController@syncPregnantWomenFollowupClient',
	'as' => 'sync.pregnant-women-followup.client'
]);




Route::get('fix-sync', function() {
<<<<<<< HEAD
	\DB::beginTransaction();
	\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	try {
		// For old data
		$childrens = App\Models\Child::whereRaw('id = sync_id')
			->where('sync_status', 'synced')
			->where('id', '<=', '2691')->get();
		foreach($childrens as $child) {
			$child->sync_id = '101' . $child->id;
			$child->save();
		}

		$facility_followups = App\Models\FacilityFollowup::whereRaw('id = sync_id')
			->where('sync_status', 'synced')
			->where('id', '<=', '5960')->get();
		foreach($facility_followups as $facility_followup) {
			$child_append = ($facility_followup->children_id < 2691) ? '101' : env('SERVER_CODE');

			$facility_followup->sync_id = '101'. $facility_followup->id;
			$facility_followup->children_id = $child_append. $facility_followup->children_id;
			$facility_followup->save();
		}

		//For new data
		$childrens = App\Models\Child::whereRaw('id = sync_id')
			->where('sync_status', '!=', 'synced')
			->where('id', '>', '2691')->get();
		foreach($childrens as $child) {
			$child->sync_id = env('SERVER_CODE') . $child->id;
			$child->save();
		}
		$facility_followups = App\Models\FacilityFollowup::whereRaw('id = sync_id')
			->where('sync_status', '!=', 'synced')
			->where('id', '>', '5960')->get();

		foreach($facility_followups as $facility_followup) {
			$child_append = ($facility_followup->children_id < 2691) ? '101': env('SERVER_CODE'); 

			$facility_followup->sync_id = env('SERVER_CODE'). $facility_followup->id;
			$facility_followup->children_id = $child_append. $facility_followup->children_id;
			$facility_followup->save();
		}

		\DB::commit();
	} catch (Exception $e) {
		\DB::rollback();
	}
	\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	
=======
	// $childrens = App\Models\Child::orderBy('id', 'desc')->limit(50)->get();
	// foreach($childrens as $child) {
	// 	$child->sync_status = 'updated';
	// 	$child->save();
	// }

	// $facility_followups = App\Models\FacilityFollowup::orderBy('id', 'desc')->limit(50)->get();
	// foreach($facility_followups as $facility_followup) {
	// 	$facility_followup->sync_status = 'updated';
	// 	$facility_followup->save();
	// }

	// $iycf_followups = App\Models\IycfFollowup::orderBy('id', 'desc')->limit(50)->get();
	// foreach($iycf_followups as $iycf_followup) {
	// 	$iycf_followup->sync_status = 'updated';
	// 	$iycf_followup->save();
	// }

	// $pregnant_womens = App\Models\PregnantWomen::orderBy('id', 'desc')->limit(50)->get();
	// foreach($pregnant_womens as $pregnant_women) {
	// 	$pregnant_women->sync_status = 'updated';
	// 	$pregnant_women->save();
	// }

	// $pregnant_women_followups = App\Models\PregnantWomenFollowup::orderBy('id', 'desc')->limit(50)->get();
	// foreach($pregnant_women_followups as $pregnant_women_followup) {
	// 	$pregnant_women_followup->sync_status = 'updated';
	// 	$pregnant_women_followup->save();
	// }

>>>>>>> 3e7b6f3b914222f88186f88a8b173d2d38fb5967
	dd('done');
});
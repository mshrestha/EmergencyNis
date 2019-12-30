<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

Route::post('/sync/save-children', [
	'uses' => 'SyncDataServerController@syncChildrenServer',
	'as' => 'sync.children.server'
]);

Route::post('/sync/save-facility-followup', [
	'uses' => 'SyncDataServerController@syncFacilityFollowupServer',
	'as' => 'sync.facility-followup.server'
]);

Route::post('/sync/save-iycf-followup', [
	'uses' => 'SyncDataServerController@syncIycfFollowupServer',
	'as' => 'sync.iycf-followup.server'
]);

Route::post('/sync/save-pregnant-women', [
	'uses' => 'SyncDataServerController@syncPregnantWomenServer',
	'as' => 'sync.pregnant-women.server'
]);

Route::post('/sync/save-pregnant-women-followup', [
	'uses' => 'SyncDataServerController@syncPregnantWomenFollowupServer',
	'as' => 'sync.pregnant-women-followup.server'
]);
Route::get('otpApi/{report_year}/{report_month}', [
	'uses' => 'ApiController@otpApi',
	'as' => 'otpApi'
]);

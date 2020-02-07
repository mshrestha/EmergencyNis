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

Route::post('/sync/save-volunteers', [
	'uses' => 'SyncDataServerController@syncVolunteersServer',
	'as' => 'sync.volunteers.server'
]);

Route::post('/sync/save-community-sessions', [
	'uses' => 'SyncDataServerController@syncCommunitySessionsServer',
	'as' => 'sync.community-sessions.server'
]);

Route::post('/sync/save-outreach-supervisors', [
	'uses' => 'SyncDataServerController@syncOutreachSupervisorsServer',
	'as' => 'sync.outreach-supervisors.server'
]);

Route::post('/sync/save-outreach-monthly-reports', [
	'uses' => 'SyncDataServerController@syncOutreachMonthlyReportsServer',
	'as' => 'sync.outreach-monthly-reports.server'
]);



// Dump sql
Route::get('/sync/generate/mysqldump', [
	'uses' => 'SyncDataServerController@generateMysqldump',
	'as' => 'sync.generate.mysqldump'
]);

//API for mobile Application
Route::get('otpApi/{report_year}/{report_month}', [
	'uses' => 'ApiController@otpApi',
	'as' => 'otpApi'
]);
Route::get('tsfpApi/{report_year}/{report_month}', [
	'uses' => 'ApiController@tsfpApi',
	'as' => 'tsfpApi'
]);
Route::get('bsfpApi/{report_year}/{report_month}', [
	'uses' => 'ApiController@bsfpApi',
	'as' => 'bsfpApi'
]);

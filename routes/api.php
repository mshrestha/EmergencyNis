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
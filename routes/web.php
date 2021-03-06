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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/test', 'HomeController@test')->name('test');
    Route::get('/homepage', 'HomeController@index')->name('homepage');
    Route::get('fourW', 'OtpImportController@fourW')->name('fourW');
    Route::get('fourW_ym', 'OtpImportController@fourW_ym')->name('fourW_ym');

    Route::get('/ou', function () {
        return view('facility.ou');
    });

    Route::post('select-pp', ['as' => 'select-pp', 'uses' => 'FacilityController@selectPp']);
    Route::post('select-ip', ['as' => 'select-ip', 'uses' => 'FacilityController@selectIp']);
    Route::post('select-camp', ['as' => 'select-camp', 'uses' => 'FacilityController@selectCamp']);

    Route::get('preview', 'MonthlyMailController@preview');
    Route::get('generate-pdf', 'MonthlyMailController@generatePDF');
    Route::get('/sendmail', 'MonthlyMailController@sendmail')->name('sendmail');
    Route::get('/monthly_mail_home', 'MonthlyMailController@monthly_mail_home')->name('monthly_mail_home');
    Route::get('/monthly_mail', 'MonthlyMailController@monthly_mail')->name('monthly_mail');


    Route::get('/program-manager', 'HomeController@programManagerDashboard')->name('program-manager');
    Route::get('/admin_ym/{year}/{month}', 'HomeController@adminDashboard_ym')->name('admin_ym');
    Route::get('/program-manager_ym/{year}/{month}', 'HomeController@programManagerDashboard_ym')->name('program-manager_ym');
    Route::get('/program-user_ym/{year}/{month}', 'HomeController@programUserDashboard_ym')->name('program-user_ym');

    Route::get('/wfh_calculation', 'HomeController@wfhCalculation')->name('wfh_calculation');
    Route::get('/nutritionStatusCalculation', 'HomeController@nutritionStatusCalculation')->name('nutritionStatusCalculation');
    Route::get('/child-info/{child}', 'HomeController@childInfo')->name('child-info');
    Route::get('/facility-info/{facility}', 'HomeController@facilityInfo')->name('facility-info');
    Route::get('/child-search', 'HomeController@childSearch')->name('child-search');
    Route::get('/facility-search', 'HomeController@facilitySearch')->name('facility-search');

    Route::get('defaulter_child', 'RegisterController@defaulter_child')->name('defaulter_child');
    Route::get('sam_child', 'RegisterController@sam_child')->name('sam_child');
    Route::get('mam_child', 'RegisterController@mam_child')->name('mam_child');
    Route::get('normal_child', 'RegisterController@normal_child')->name('normal_child');
    Route::get('register_selected_facility/{facility}', 'RegisterController@register_selected_facility')->name('register_selected_facility');
    Route::get('register', 'RegisterController@index')->name('register');
    Route::get('register-iycf', 'RegisterController@iycf')->name('register-iycf');

    Route::get('summary_report', 'ReportController@summary_report')->name('summary_report');
    Route::get('summary_report_ym', 'ReportController@summary_report_ym')->name('summary_report_ym');
    Route::get('sc_report_admin', 'ReportController@sc_report_admin')->name('sc_report_admin');
    Route::get('otp_report_admin', 'ReportController@otp_report_admin')->name('otp_report_admin');
    Route::get('bsfp_report_admin', 'ReportController@bsfp_report_admin')->name('bsfp_report_admin');
    Route::get('tsfp_report_admin', 'ReportController@tsfp_report_admin')->name('tsfp_report_admin');
    Route::get('bsfp_report', 'ReportController@bsfp_report')->name('bsfp_report');
    Route::get('tsfp_report', 'ReportController@tsfp_report')->name('tsfp_report');
    Route::get('otp_report', 'ReportController@otp_report')->name('otp_report');
    Route::get('sc_report', 'ReportController@sc_report')->name('sc_report');
    Route::get('reports', 'ReportController@index')->name('reports');

    Route::resource('children', 'ChildrenController');
    Route::resource('community-followup', 'CommunityFollowupController');
    Route::post('community-followup/{child}/save', 'CommunityFollowupController@save')->name('community-followup.save');


    Route::resource('service', 'ServiceController');
    Route::resource('sector', 'SectorController');
    Route::resource('programPartner', 'PpController');
    Route::resource('implementingPartner', 'IpController');
    Route::resource('camp', 'CampController');
    Route::resource('facility', 'FacilityController');
    Route::resource('facility-followup', 'FacilityFollowupController');
    Route::post('facility-followup/{facility}/save', 'FacilityFollowupController@save')->name('facility-followup.save');

    Route::patch('user/Auth::user()', ['as' => 'user.password_update', 'uses' => 'UserController@password_update']);
    Route::get('/myprofile', 'UserController@myprofile');
    Route::resource('user', 'UserController');
    Route::resource('contact_list', 'ContactListController');

    Route::get('/pregnant-women/{women}/info', 'PregnantWomenController@info')->name('pregnant-women.info');
    Route::resource('/pregnant-women', 'PregnantWomenController');
    Route::get('/nutritionStatusWomen', 'PregnantWomenFollowupController@nutritionStatusWomen')->name('nutritionStatusWomen');
    Route::resource('pregnant-women-followup', 'PregnantWomenFollowupController');


    Route::resource('iycf-followup', 'IycfFollowupController');
    Route::post('iycf-followup/{iycf}/save', 'IycfFollowupController@save')->name('iycf-followup.save');

    Route::get('iycf_session_home', 'IycfGroupSessionController@iycf_session_home')->name('iycf_session_home');
    Route::resource('iycfGroupSession', 'IycfGroupSessionController');

    Route::resource('monthly-dashboard', 'MonthlyDashboardController');

    //Community Volunteer
    Route::resource('community', 'CommunityController');
    Route::resource('community-session', 'CommunitySessionController');
    Route::resource('community-session-women', 'CommunitySessionWomenController');

    //Community Supervisor
    Route::resource('outreach-supervisor', 'OutreachSupervisorController');
    Route::resource('outreach-monthly-report', 'OutreachMonthlyReportController');


    Route::get('importHome', 'OtpImportController@importHome')->name('importHome');
    Route::get('importExportOtp', 'OtpImportController@importExportOtp')->name('importExportOtp');
    Route::post('importOtp', 'OtpImportController@importOtp');
    Route::get('importExportBsfp', 'BsfpImportController@importExportBsfp')->name('importExportBsfp');
    Route::post('importBsfp', 'BsfpImportController@importBsfp');
    Route::delete('importExportOtp/{period}', ['as' => 'importExportOtp.destroy', 'uses' => 'OtpImportController@destroy']);
    Route::delete('importExportBsfp/{period}', ['as' => 'importExportBsfp.destroy', 'uses' => 'BsfpImportController@destroy']);
    Route::delete('importExportTsfp/{period}', ['as' => 'importExportTsfp.destroy', 'uses' => 'TsfpImportController@destroy']);
    Route::delete('importExportSc/{period}', ['as' => 'importExportSc.destroy', 'uses' => 'ScImportController@destroy']);

    Route::get('importExportTsfp', 'TsfpImportController@importExportTsfp')->name('importExportTsfp');
    Route::post('importTsfp', 'TsfpImportController@importTsfp');
    Route::get('importExportSc', 'ScImportController@importExportSc')->name('importExportSc');
    Route::post('importSc', 'ScImportController@importSc');

    Route::resource('supply', 'SupplyController');
    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

    Route::resource('indicator', 'IndicatorController');
    Route::resource('targetReached', 'TargetReachedController');

});

Route::get('/sync/get-live-data', [
    'uses' => 'SyncDataClientController@getLiveData',
    'as' => 'sync.get-live-data'
]);
Route::get('/sync/retrieve-live-data', [
    'uses' => 'SyncDataClientController@retrieveLiveData',
    'as' => 'sync.retrieve-live-data'
]);


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

// new
Route::get('/sync/volunteers', [
    'uses' => 'SyncDataClientController@syncVolunteers',
    'as' => 'sync.volunteers.client'
]);

Route::get('/sync/community-sessions', [
    'uses' => 'SyncDataClientController@syncCommunitySessions',
    'as' => 'sync.community-sessions.client'
]);

Route::get('/sync/community-sessions-womens', [
    'uses' => 'SyncDataClientController@syncCommunitySessionsWomens',
    'as' => 'sync.community-sessions-womens.client'
]);

Route::get('/sync/outreach-supervisors', [
    'uses' => 'SyncDataClientController@syncOutreachSupervisors',
    'as' => 'sync.outreach-supervisors.client'
]);

Route::get('/sync/outreach-monthly-reports', [
    'uses' => 'SyncDataClientController@syncOutreachMonthlyReports',
    'as' => 'sync.outreach-monthly-reports.client'
]);

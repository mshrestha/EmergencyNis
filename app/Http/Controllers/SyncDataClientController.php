<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\FacilityFollowup;
use App\Models\IycfFollowup;
use App\Models\PregnantWomen;

use DB;
use Schema;
use Illuminate\Http\Request;

class SyncDataClientController extends Controller
{
	// private $sync_url = 'http://localhost:8000';
	private $sync_url = 'https://ens.kazi270.com';

	public function syncChildrenClient() {
		return $this->sendDataToServer('App\Models\Child', '/api/sync/save-children');
	}

	public function syncFacilityFollowupClient() {
		return $this->sendDataToServer('App\Models\FacilityFollowup', '/api/sync/save-facility-followup');
	}

	public function syncIycfFollowupClient() {
		return $this->sendDataToServer('App\Models\IycfFollowup', '/api/sync/save-iycf-followup');
	}

	public function syncPregnantWomenClient() {
		return $this->sendDataToServer('App\Models\PregnantWomen', '/api/sync/save-pregnant-women');
	}

	public function syncPregnantWomenFollowupClient() {
		return $this->sendDataToServer('App\Models\PregnantWomenFollowup', '/api/sync/save-pregnant-women-followup');
	}
	public function syncVolunteers() {
		return $this->sendDataToServer('App\Models\Volunteer', '/api/sync/save-volunteers');
	}
	public function syncCommunitySessions() {
		return $this->sendDataToServer('App\Models\CommunitySession', '/api/sync/save-community-sessions');
	}
	public function syncCommunitySessionsWomens() {
		return $this->sendDataToServer('App\Models\CommunitySessionWomen', '/api/sync/save-community-sessions-womens');
	}
	public function syncOutreachSupervisors() {
		return $this->sendDataToServer('App\Models\OutreachSupervisor', '/api/sync/save-outreach-supervisors');
	}
	public function syncOutreachMonthlyReports() {
		return $this->sendDataToServer('App\Models\OutreachMonthlyReport', '/api/sync/save-outreach-monthly-reports');
	}





	public function sendDataToServer($model, $api_url) {
		$total_data_sync_count = $model::whereIn('sync_status', ['created', 'updated'])->count();
		$sync_data = $model::whereIn('sync_status', ['created', 'updated'])->limit(10)->get()->toArray();
		$has_more = ($total_data_sync_count > count($sync_data)) ? true : false;
		$sync_left = $total_data_sync_count - count($sync_data);

		//post data
		$post = [
			'total_data_sync_count' => $total_data_sync_count,
			'sync_data' => serialize($sync_data),
			'has_more' => $has_more
		];

		//Send to server
		$synced_ids = $this->curlInit($post, $this->sync_url. $api_url);

		//Change sync status
		if(is_array($synced_ids)) {	
			foreach($synced_ids as $synced_id) {
				$update_status = $model::where('sync_id', $synced_id)->first();
				$update_status->update(['sync_status' => 'synced']);
			}
		}

		return ['has_more' => $has_more, 'sync_left' => $sync_left];
	}

	public function curlInit($post, $url) {
		//This needs to be the full path to the file you want to send.
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		// execute!
		$response = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);

		$response = json_decode($response);
		return $response;
	}


	public function getLiveData() {
		if(!env('LIVE_SERVER')) {
			return view('sync.get-live-data');
		}
	}

	public function retrieveLiveData() {
		if(!env('LIVE_SERVER')) {
			try {
				// $this->sync_url = 'http://localhost:8000';
				$url = $this->sync_url . '/api/sync/generate/mysqldump'; 
				$source_url = file_get_contents($url);
				$file_path = public_path('uploads/mysqlbackup/ens.sql');
				$save_to_local = copy($source_url, $file_path);

				if($save_to_local) {
				//Drop all tables
					$this->drop_tables();

				//Import new database
					$db_database = env('DB_DATABASE');
					$db_username = env('DB_USERNAME');
					$db_password = env('DB_PASSWORD');
					exec("mysql -u {$db_username} -p{$db_password} {$db_database} < {$file_path}");
				}
			} catch (Exception $e) {

			}

			return 'Synced live database';
		}
	}

	public function drop_tables() {
		$tables = DB::select('SHOW TABLES');
		try {
			DB::statement('SET FOREIGN_KEY_CHECKS = 0');
			foreach($tables as $table){
				$db_name = 'Tables_in_'. env('DB_DATABASE');
				Schema::drop($table->$db_name);
			}
			DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		} catch (Exception $e) {
			DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		}
	}
}

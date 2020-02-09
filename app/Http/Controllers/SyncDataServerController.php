<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SyncDataServerController extends Controller
{
	public function syncChildrenServer(Request $request) {
		return $this->updateDatabase('children', $request);
	}

	public function syncFacilityFollowupServer(Request $request) {
		return $this->updateDatabase('facility_followups', $request);
	}

	public function syncIycfFollowupServer(Request $request) {
		return $this->updateDatabase('iycf_followups', $request);
	}

	public function syncPregnantWomenServer(Request $request) {
		return $this->updateDatabase('pregnant_womens', $request);
	}

	public function syncPregnantWomenFollowupServer(Request $request) {
		return $this->updateDatabase('pregnant_women_followups', $request);
	}

	public function syncVolunteersServer(Request $request) {
		return $this->updateDatabase('volunteers', $request);
	}
	public function syncCommunitySessionsServer(Request $request) {
		return $this->updateDatabase('community_sessions', $request);
	}
	public function syncCommunitySessionsWomensServer(Request $request) {
		return $this->updateDatabase('community_session_womens', $request);
	}
	public function syncOutreachSupervisorsServer(Request $request) {
		return $this->updateDatabase('outreach_supervisors', $request);
	}
	public function syncOutreachMonthlyReportsServer(Request $request) {
		return $this->updateDatabase('outreach_monthly_reports', $request);
	}


	public function updateDatabase($table, Request $request) {
		DB::beginTransaction();
		try {
			$datas = unserialize($request->sync_data);

			$synced_ids = [];
			foreach($datas as $data) {
				$data['sync_status'] = 'synced';
				unset($data['id']);

				DB::table($table)->updateOrInsert(['sync_id' => $data['sync_id']], $data);
				array_push($synced_ids, $data['sync_id']);
			}

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
		}

		return $synced_ids;
	}


	public function generateMysqldump() {
		try {
			$db_database = env('DB_DATABASE');
			$db_username = env('DB_USERNAME');
			$db_password = env('DB_PASSWORD');

			$file = 'uploads/mysqldump/ens_dump_'.time().'.sql';
			$file_path = public_path($file);

			exec("mysqldump -u {$db_username} -p{$db_password} {$db_database} > {$file_path}");
		} catch (Exception $e) {
			
		}

		return asset($file);
	}
}

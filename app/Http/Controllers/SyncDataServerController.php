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
}

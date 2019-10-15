<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SyncDataServerController extends Controller
{
	public function syncChildrenServer(Request $request) {
		DB::beginTransaction();
		try {
			$datas = unserialize($request->children_sync);
			$children_synced_ids = [];

			foreach($datas as $data) {
				$data['sync_status'] = 'synced';
				unset($data['id']);

				DB::table('children')->updateOrInsert(['sync_id' => $data['sync_id']], $data);
				array_push($children_synced_ids, $data['sync_id']);
			}

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
		}

		return $children_synced_ids;
	}

	public function syncFacilityFollowupServer(Request $request) {
		DB::beginTransaction();
		try {
			$datas = unserialize($request->facility_followup_sync);
			$facility_followup_synced_ids = [];

			foreach($datas as $data) {
				$data['sync_status'] = 'synced';
				unset($data['id']);

				DB::table('facility_followups')->updateOrInsert(['sync_id' => $data['sync_id']], $data);
				array_push($facility_followup_synced_ids, $data['sync_id']);
			}

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
		}

		return $facility_followup_synced_ids;
	}
}

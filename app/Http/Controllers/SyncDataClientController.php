<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\FacilityFollowup;

use Illuminate\Http\Request;

class SyncDataClientController extends Controller
{
	private $sync_url = 'http://localhost:9000';

    public function syncChildrenClient() {
    	$total_children_sync_count = Child::whereIn('sync_status', ['created', 'updated'])->count();
		$children_sync = Child::whereIn('sync_status', ['created', 'updated'])->limit(10)->get()->toArray();
		$has_more = ($total_children_sync_count > count($children_sync)) ? true : false;
		$sync_left = $total_children_sync_count - count($children_sync);

		$post = [
			'total_children_sync_count' => $total_children_sync_count,
			'children_sync' => serialize($children_sync),
			'has_more' => $has_more
		];

		$synced_children_ids = $this->curlInit($post, $this->sync_url.'/api/sync/save-children');

		if(is_array($synced_children_ids)) {
			foreach($synced_children_ids as $synced_children_id) {
				$children = Child::where('sync_id', $synced_children_id)->first();
				$children->update(['sync_status' => 'synced']);
			}
		}

		return response()->json(['has_more' => $has_more, 'sync_left' => $sync_left]);
    }

    public function syncFacilityFollowupClient() {
    	$total_facility_followup_sync_count = FacilityFollowup::whereIn('sync_status', ['created', 'updated'])->count();
		$facility_followup_sync = FacilityFollowup::whereIn('sync_status', ['created', 'updated'])->limit(10)->get()->toArray();
		$has_more = ($total_facility_followup_sync_count > count($facility_followup_sync)) ? true : false;
		$sync_left = $total_facility_followup_sync_count - count($facility_followup_sync);

		$post = [
			'total_facility_followup_sync_count' => $total_facility_followup_sync_count,
			'facility_followup_sync' => serialize($facility_followup_sync),
			'has_more' => $has_more
		];

		$synced_facility_followup_ids = $this->curlInit($post, $this->sync_url.'/api/sync/save-facility-followup');
		if(is_array($synced_facility_followup_ids)) {	
			foreach($synced_facility_followup_ids as $synced_facility_followup_id) {
				$facility_followup = FacilityFollowup::where('sync_id', $synced_facility_followup_id)->first();
				$facility_followup->update(['sync_status' => 'synced']);
			}
		}

		return response()->json(['has_more' => $has_more, 'sync_left' => $sync_left]);
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
}

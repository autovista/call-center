<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class transfer_report_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	function checkUserCountRights() {
		/*---check count as per group & user--*/
		if ($_SESSION['role'] != 1) {
			$process_id = $_SESSION['process_id'];
			$user_id = $_SESSION['user_id'];
			$this -> db -> select('g.campaign_name');
			$this -> db -> from('tbl_campaign g');
			$this -> db -> join('tbl_user_group u', 'u.group_id=g.group_id');
			$this -> db -> where('u.user_id', $user_id);
			$query1 = $this -> db -> get() -> result();
			$c = count($query1);
			if (count($query1) > 0) {
				$t = ' ( ';
				for ($i = 0; $i < $c; $i++) {
					if ($i == 0) {

						$t = $t . "enquiry_for = '" . $query1[$i] -> campaign_name . "'";

					} else {
						$t = $t . " or enquiry_for ='" . $query1[$i] -> campaign_name . "'";
					}
				}
				$st = $t . ')';

			}
			return $st;
		}

	}

	function checkUserRights() {
		if ($_SESSION['role'] != 1) {
			//$process_id = $_SESSION['process_id'];
			$user_id = $_SESSION['user_id'];
			$this -> db -> select('g.group_id');
			$this -> db -> from('tbl_group g');
			$this -> db -> join('tbl_user_group u', 'u.group_id=g.group_id');
			$this -> db -> where('u.user_id', $user_id);
			$query1 = $this -> db -> get() -> result();
			$c = count($query1);
			if (count($query1) > 0) {
				$t = ' ( ';
				for ($i = 0; $i < $c; $i++) {
					if ($i == 0) {

						$t = $t . "group_id = '" . $query1[$i] -> group_id . "'";

					} else {
						$t = $t . " or group_id ='" . $query1[$i] -> group_id . "'";
					}
				}
				$st = $t . ')';

			}
			return $st;
		}
	}

	public function telecaller_transfer_from() {
		$st = $this -> checkUserRights();
		$this -> db -> select('fname,lname,id');
		$this -> db -> from('lmsuser l');
		$this -> db -> join('tbl_user_group u', 'u.user_id=l.id');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where($st);
		}
		$this -> db -> where('role !=', 1);
		$this -> db -> where('status', 1);
		$this -> db -> group_by('u.user_id');
		$this -> db -> order_by('fname', 'asc');
		$query = $this -> db -> get();
		return $query -> result();
	}

	public function telecaller_transfer_to() {
		$t = "(role='3' || role ='4')";
		$this -> db -> select('fname,lname,id');
		$this -> db -> from('lmsuser ');
		$this -> db -> where($t);
		$this -> db -> where('status', 1);
		$this -> db -> order_by('fname', 'asc');
		$query = $this -> db -> get();
		return $query -> result();
	}

	//Select Status
	function select_status() {
		$process_id = $_SESSION['process_id'];
		$this -> db -> select('s.status_name,s.status_id ');
		$this -> db -> from('tbl_status s');
		$this -> db -> join('tbl_process p', 's.process_id=p.process_id', 'left');
		$this -> db -> where('p.process_id', $process_id);
		$query = $this -> db -> get();
		//	echo $this->db->last_query();
		return $query -> result();

	}

	public function select_transfer_lead() {
		$status = $this -> input -> post('status');
		$transfer_to = $this -> input -> post('transfer_to');
		$transfer_from = $this -> input -> post('transfer_from');
		$date_to = $this -> input -> post('todate');
		if (!$date_to) {
			$date_to = date('Y-m-d');
		}
		$date_from = $this -> input -> post('fromdate');
		if (!$date_from) {
			$date_from = date('Y-m-d');
		}
		$assign_by = $_SESSION['user_id'];
		$this -> db -> select('u.fname as transfer_to_fname,u.lname as transfer_to_lname,
		u1.fname as transfer_from_fname,u1.lname as transfer_from_lname,
		l.*,
		
		
		m.model_name as new_model,
		m1.model_name as old_model,
		v.variant_name,
		m2.make_name,
		s.status_name,
		r.assign_by_id,r.location as loc,r.created_date as transfer_date,r.assign_to_telecaller as assign_from');
		$this -> db -> from('lead_master l');
		$this -> db -> join('request_to_lead_transfer r', 'r.request_id=l.transfer_id');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller');
		$this -> db -> join('lmsuser u1', 'u1.id=l.assignby');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		//$this -> db -> join('lead_followup f', 'f.id=l.followup_id', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		//$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		if ($_SESSION['role'] == 3) {
			$this -> db -> where('l.assignby', $assign_by);
		}
		if ($status != 0) {
			$this -> db -> where('l.status', $status);
		}
		if ($transfer_to != '') {
			$this -> db -> where('l.assign_to_telecaller', $transfer_to);
		}
		if ($transfer_from != '') {
			$this -> db -> where('l.assignby', $transfer_from);
		}
		if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {

			$this -> db -> where('r.created_date', $date_from);

		} else {
			$this -> db -> where('r.created_date >=', $date_from);
			$this -> db -> where('r.created_date <=', $date_to);

		}

		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		if ($status == 0 && $transfer_from == '' && $transfer_to == '' && $date_to == '' && $date_from == '') {
			$this -> db -> limit(100);
		}
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}
public function select_transfer_lead_lc() {
		$status = $this -> input -> post('status');
		$transfer_to = $this -> input -> post('transfer_to');
		$transfer_from = $this -> input -> post('transfer_from');
		$date_to = $this -> input -> post('todate');
		if (!$date_to) {
			$date_to = date('Y-m-d');
		}
		$date_from = $this -> input -> post('fromdate');
		if (!$date_from) {
			$date_from = date('Y-m-d');
		}
		$assign_by = $_SESSION['user_id'];
		$this -> db -> select('u.fname as transfer_to_fname,u.lname as transfer_to_lname,
		u1.fname as transfer_from_fname,u1.lname as transfer_from_lname,
		l.*,
		
	
		m.model_name as new_model,
		m1.model_name as old_model,
		v.variant_name,
		m2.make_name,
		s.status_name,
		r.assign_by_id,r.location as loc,r.created_date as transfer_date,r.assign_to_telecaller as assign_from');
		$this -> db -> from('lead_master_lc l');
		$this -> db -> join('request_to_lead_transfer_lc r', 'r.request_id=l.transfer_id');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller');
		$this -> db -> join('lmsuser u1', 'u1.id=l.assignby');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		//$this -> db -> join('lead_followup_lc f', 'f.id=l.followup_id', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		//$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		if ($_SESSION['role'] == 3) {
			$this -> db -> where('l.assignby', $assign_by);
		}
		if ($status != 0) {
			$this -> db -> where('l.status', $status);
		}
		if ($transfer_to != '') {
			$this -> db -> where('l.assign_to_telecaller', $transfer_to);
		}
		if ($transfer_from != '') {
			$this -> db -> where('l.assignby', $transfer_from);
		}
		if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {

			$this -> db -> where('r.created_date', $date_from);

		} else {
			$this -> db -> where('r.created_date >=', $date_from);
			$this -> db -> where('r.created_date <=', $date_to);

		}
			
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		if ($status == 0 && $transfer_from == '' && $transfer_to == '' && $date_to == '' && $date_from == '') {
			$this -> db -> limit(100);
		}
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

public function select_transfer_lead1() {
		$status = $this -> input -> post('status');
		$transfer_to = $this -> input -> post('transfer_to');
		$transfer_from = $this -> input -> post('transfer_from');
		$date_to = $this -> input -> post('todate');
		if (!$date_to) {
			$date_to = date('Y-m-d');
		}
		$date_from = $this -> input -> post('fromdate');
		if (!$date_from) {
			$date_from = date('Y-m-d');
		}
		$assign_by = $_SESSION['user_id'];
		$this -> db -> select('
		d.disposition_name,
		f.nextfollowupdate,f.comment,f.date
		');
		$this -> db -> from('lead_master l');
		$this -> db -> join('request_to_lead_transfer r', 'r.lead_id=l.transfer_id');
		//$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller');
		//$this -> db -> join('lmsuser u1', 'u1.id=l.assignby');
		//$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('lead_followup f', 'f.assign_to=r.assign_by_id');
		//$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=f.disposition', 'left');
		//$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		//$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		//$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		

	
		$this -> db -> order_by('f.id', 'desc');
		
			$this -> db -> limit(1);
	
		$query = $this -> db -> get();
		//echo  $this->db->last_query();
		return $query -> result();

	}

}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class cSE_added_leads_model extends CI_model {
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
	function checkUserRights()
	{
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
	public function select_lead() {
		$st = $this -> checkUserCountRights();
		$filter_status = $this -> input -> post('filter_status');
		$filter_disposition = $this -> input -> post('filter_disposition');
		$filter_fromdate = $this -> input -> post('filter_fromdate');
		$filter_todate = $this -> input -> post('filter_todate');
		$filter_campaign_name = $this -> input -> post('filter_campaign_name');
		$filter_assign = $this -> input -> post('filter_assign');

		$this -> db -> select('l.manual_lead,
			u.fname,u.lname,			
			f1.date,f1.nextfollowupdate,f1.comment as remark,
			d.disposition_name,
			s.status_name,
			l.enq_id,name,l.assign_to_telecaller,l.email,contact_no,l.comment,enquiry_for,l.status,l.assignby,l.created_date,l.created_time,l.buyer_type,l.buy_status,l.model_id,l.variant_id,l.old_make,l.old_model,l.ownership,l.manf_year,l.color,l.km');

		$this -> db -> from('lead_master l');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		$this -> db -> join('lead_followup f1', 'f1.id=l.followup_id', 'left');
		if ($filter_assign != '') {
			$this -> db -> where('l.assign_to_telecaller', $filter_assign);

		}
		if ($filter_status != 0) {
			$this -> db -> where('l.status', $filter_status);
		}

		if ($filter_status == 0) {

			$this -> db -> where('l.status!=', '');
		}
		if ($filter_fromdate != '' && $filter_todate != '') {
			$this -> db -> where('l.created_date>=', $filter_fromdate);
			$this -> db -> where('l.created_date<=', $filter_todate);

		}
		if ($_SESSION['role'] != 1) {
			$this -> db -> where($st);
		}
		$this -> db -> where('l.manual_lead !=', '');
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		if ($filter_assign == '' && $filter_status == 0 && $filter_fromdate == '') {
			$this -> db -> limit(100);
		}
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
		/*
		 $this->db->select("l.manual_lead,l.enquiry_for,l.enq_id,name,l.contact_no,l.email,l.created_date,l.created_time,l.status,l.assign_to_telecaller,l.comment,u.fname,u.lname,f.comment as fcomment");
		 $this->db->from("lead_master l");
		 $this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller');
		 $this -> db -> join('lead_followup f', 'f.leadid=l.enq_id', 'left');
		 $this -> db -> where('l.manual_lead !=', '');
		 $this -> db -> group_by('leadid');
		 $this -> db -> order_by('enq_id', 'desc');
		 $query = $this -> db -> get();
		 return $query -> result();*/

	}

	public function select_disposition() {
		$status = $this -> input -> post('status');
		$this -> db -> select('disposition_name,disposition_id');
		$this -> db -> from('tbl_disposition_status ');
		if ($status != 0) {
			$this -> db -> where('status_id', $status);
		}
		$this -> db -> order_by('disposition_name', 'asc');
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
	}

	public function select_telecaller() {
		$st = $this -> checkUserRights();
		$this -> db -> select('fname,lname,id');
		$this -> db -> from('lmsuser l');
		$this -> db -> join('tbl_user_group u', 'u.user_id=l.id');
		$this -> db -> where('role', 3);
		$this -> db -> where('status', 1);
		if ($_SESSION['role'] != 1) {
			$this -> db -> where($st);
		}
		$this -> db -> group_by('id');
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

	public function select_tl_lead() {

		//echo "hi";
		$status = $this -> input -> post('status');
		//$dispostion=$this->input->post('dispostion');
		$assign_to = $this -> input -> post('assign_to');
		$fromdate = $this -> input -> post('fromdate');
		$todate = $this -> input -> post('todate');

		$str_fromdate = $fromdate;
		$str_todate = $todate;

		$this -> db -> select("l.status,u.lname,u.fname,l.assign_to_telecaller,l.name,l.manual_lead,l.enq_id,l.enquiry_for,l.contact_no,l.email,l.created_date,l.created_time,l.comment");
		$this -> db -> from("lead_master l");
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller');
		$this -> db -> where('l.manual_lead !=', '');

		if ($status != '') {
			$this -> db -> where('l.status', $status);

		}
		if ($assign_to != 0) {
			$this -> db -> where('l.assign_to_telecaller', $assign_to);

		}

		if ($fromdate != '') {
			//echo "hi";
			$this -> db -> where('l.created_date >=', $fromdate);
		}
		if ($todate != '') {
			$this -> db -> where('l.created_date <=', $todate);
		}

		//$this -> db -> order_by('enq_id', 'desc');
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

}
?>
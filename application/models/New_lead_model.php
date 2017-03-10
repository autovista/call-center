<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class new_lead_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	public function select_lead() {
		$yesterday = date("Y-m-d", strtotime('-1 days'));
		$assign_to = $_SESSION['user_id'];
		$this -> db -> select("u.fname,u.lname,
		 lm.buyer_type,lm.model_id,lm.variant_id,lm.buy_status,lf.date,d.disposition_name,
		lm.enq_id,lm.name,lm.status,lm.contact_no,lm.email,lm.enquiry_for,lm.created_date,lm.eagerness,lm.created_time,lm.old_make,lm.old_model,lm.ownership,lm.manf_year,lm.color,lm.km,
		lf.nextfollowupdate,lf.comment ,
		r.remark,
		s.status_name");
		$this -> db -> from("lead_master lm");
		$this -> db -> join("lead_followup lf", "lm.followup_id=lf.id",'left');
		//$this -> db -> join("lead_followup lf1", "lm.enq_id=lf1.leadid");		
		$this -> db -> join("tbl_status s", "s.status_id=lm.status", 'left');
		$this -> db -> join("tbl_manager_remark r", "r.remark_id=lm.remark_id", 'left');
		$this -> db -> join("lmsuser u", "u.id=lm.assign_to_telecaller", 'left');
		$this -> db -> join("tbl_disposition_status d", "d.disposition_id=lm.disposition", 'left');
		$this -> db -> where('lm.assign_to_telecaller', $assign_to);
		$this -> db -> where('s.status_name', 'Not Yet');
		$this -> db -> where('lm.assign_date >=', $yesterday);
		$this -> db -> order_by('lm.enq_id', 'desc');
		$this->db->limit('100');
		$query = $this -> db -> get();
		
		return $query -> result();

	}
	public function select_lead1() {
		$yesterday = date("Y-m-d", strtotime('-1 days'));
		$assign_to = $_SESSION['user_id'];
		$wh="lm.assign_to_telecaller = '$assign_to' AND  lf.assign_to != '$assign_to' "; 
		$this -> db -> select("u.fname,u.lname,
		 lm.buyer_type,lm.model_id,lm.variant_id,lm.buy_status,lf.date,d.disposition_name,
		lm.enq_id,lm.name,lm.status,lm.contact_no,lm.email,lm.enquiry_for,lm.created_date,lm.eagerness,lm.created_time,lm.old_make,lm.old_model,lm.ownership,lm.manf_year,lm.color,lm.km,
		lf.nextfollowupdate,lf.comment ,
		r.remark,
		s.status_name");
		$this -> db -> from("lead_master lm");
		$this -> db -> join("lead_followup lf", "lm.followup_id=lf.id");
		$this -> db -> join("request_to_lead_transfer rt", "rt.request_id=lm.transfer_id");
		//$this -> db -> join("lead_followup lf1", "lm.enq_id=lf1.leadid");		
		$this -> db -> join("tbl_status s", "s.status_id=lm.status", 'left');
		$this -> db -> join("tbl_manager_remark r", "r.remark_id=lm.remark_id", 'left');
		$this -> db -> join("lmsuser u", "u.id=lm.assign_to_telecaller", 'left');
		$this -> db -> join("tbl_disposition_status d", "d.disposition_id=lm.disposition", 'left');
		$this -> db -> where($wh);
		
		//$this -> db -> where('s.status_name', 'Not Yet');
		$this -> db -> where('rt.created_date >=', $yesterday);
		$this -> db -> order_by('lm.enq_id', 'desc');
		$this->db->limit('100');
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

}
?>
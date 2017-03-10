<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class pending_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	public function select_lead() {
		//Pending Attened Leads
		$assign_to = $_SESSION['user_id'];
		$today = date('Y-m-d');
		$status = "(lm.status = 2 or lm.status = 3)";
		$this -> db -> select("u.fname,u.lname,
		 lm.buyer_type,lm.model_id,lm.variant_id,lm.buy_status,lf.date,d.disposition_name,
		lm.eagerness,lm.enq_id,lm.name,lm.status,lm.contact_no,lm.email,lm.enquiry_for,lm.created_date,lm.created_time,lm.old_make,lm.old_model,lm.ownership,lm.manf_year,lm.color,lm.km,
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
		/*if($_SESSION['role']==3 || $_SESSION['role']==4)
		{*/
		$this -> db -> where("lm.assign_to_telecaller=", $assign_to);
		//}
		$this -> db -> where("lf.nextfollowupdate!=", '0000-00-00');
		$this -> db -> where("lf.nextfollowupdate <", $today);
		$this -> db -> group_by('lf.leadid');
		$this->db->order_by('lm.enq_id','desc');
		$this -> db -> limit('100');
		$query = $this -> db -> get();
		return $query -> result();

		

	}

	public function select_lead1() {
		//Pending Not Attened Leads
		$assign_to = $_SESSION['user_id'];
		$yesterday = date("Y-m-d", strtotime('-1 days'));
		$this -> db -> select("u.fname,u.lname,
		
		 lm.buyer_type,lm.model_id,lm.variant_id,lm.buy_status,lf.date,d.disposition_name,
		lm.eagerness,lm.enq_id,lm.name,lm.status,lm.contact_no,lm.email,lm.enquiry_for,lm.created_date,lm.created_time,lm.old_make,lm.old_model,lm.ownership,lm.manf_year,lm.color,lm.km,
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
		/*if($_SESSION['role']==3 || $_SESSION['role']==4)
		{*/
		$this -> db -> where("lm.assign_to_telecaller=", $assign_to);
		//}
		$this -> db -> where('lm.assign_date < ', $yesterday);
		$this -> db -> where('lm.assign_date!= ','0000-00-00');
		$this -> db -> where('s.status_name', 'Not Yet');
		$this->db->order_by('lm.enq_id','desc');
		$this -> db -> limit('100');
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

}
?>

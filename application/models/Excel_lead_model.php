<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class excel_lead_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	public function select_telecaller() {
		$this -> db -> select('id,fname,lname');
		$this -> db -> from('lmsuser');
		$this -> db -> where('role', 3);
		$this -> db -> where('status', 1);
			$this -> db -> order_by('fname', 'asc');
		$query = $this -> db -> get();
		return $query -> result();
	}

	public function select_lead() {
		$status = $this -> input -> post('status');
		$fromdate = $this -> input -> post('fromdate');
		$todate = $this -> input -> post('todate');

		$str_fromdate = strtotime($fromdate);
		$str_todate = strtotime($todate);
		$assign_to = $_SESSION['user_id'];

		$query = $this -> db -> query("SET NAMES utf8");
		//the main trick
		/*$query2=mysql_query("select enq_id,name,email,contact_no,enquiry_for,status,assignto,assignby,created_date,created_time from lead_master where lead_source = 'Excel' and assign_to_telecaller='$assign_to' order by enq_id DESC") or die(mysql_error()); */
		$this -> db -> select("count(f.leadid) as fcount,u.fname,u.lname,enq_id,name,l.email,contact_no,l.comment,enquiry_for,l.status,l.assign_to_telecaller,assignby,l.created_date,l.created_time ");
		$this -> db -> from('lead_master l');
		$this -> db -> join('lmsuser u', 'u.id=l.assignby');
		$this -> db -> join('lead_followup f', 'f.leadid=l.enq_id', 'left');
		$this -> db -> where('lead_source', 'Excel');
		$this -> db -> where('assign_to_telecaller', $assign_to);
		if ($status != 0) {
			$this -> db -> where('l.status', $status);
		}

		if ($status == 0) {
			$st = "(l.status=1 or l.status=2 or l.status=3 or l.status=4 or l.status=5)";
			$this -> db -> where($st);
		}
		if ($fromdate != '' || $todate != '') {
			$this -> db -> where('l.str_to_time_created_date>=', $str_fromdate);
			$this -> db -> where('l.str_to_time_created_date<=', $str_todate);
		}

		if ($status == 0 && $fromdate == '' && $todate == '') {
			$this -> db -> limit(100);
		}
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

	public function select_tl_lead() {
		$assign_to = $this -> input -> post('assign_to');
		$status = $this -> input -> post('status');
		$fromdate = $this -> input -> post('fromdate');
		$todate = $this -> input -> post('todate');
		$str_fromdate = strtotime($fromdate);
		$str_todate = strtotime($todate);
		$query = $this -> db -> query("SET NAMES utf8");
		//the main trick
		/*$query2=mysql_query("select enq_id,name,email,contact_no,enquiry_for,status,assignto,assignby,created_date,created_time from lead_master where lead_source = 'Excel' and assign_to_telecaller='$assign_to' order by enq_id DESC") or die(mysql_error()); */
		$this -> db -> select("count(f.leadid) as fcount,u.fname,u.lname,enq_id,name,l.email,contact_no,l.comment,enquiry_for,l.status,l.assign_to_telecaller,assignby,l.created_date,l.created_time ");
		$this -> db -> from('lead_master l');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller');
		$this -> db -> join('lead_followup f', 'f.leadid=l.enq_id', 'left');
		$this -> db -> where('lead_source', 'Excel');
		if ($status != 0) {
			$this -> db -> where('l.status', $status);
		}

		if ($status == 0) {
			$st = "(l.status=1 or l.status=2 or l.status=3 or l.status=4 or l.status=5)";
			$this -> db -> where($st);
		}
		if ($fromdate != '' || $todate != '') {
			$this -> db -> where('l.str_to_time_created_date>=', $str_fromdate);
			$this -> db -> where('l.str_to_time_created_date<=', $str_todate);
		}
		if ($assign_to != '' || $assign_to != 0) {
			$this -> db -> where('l.assign_to_telecaller', $assign_to);
		}

		if ($status == 0 && $fromdate == '' && $todate == '' && $assign_to == 0) {
			$this -> db -> limit(100);
		}
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		$query = $this -> db -> get();
		//echo $this -> db -> last_query();
		return $query -> result();

	}

}
?>
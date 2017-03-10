<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class add_new_customer_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_customer($fname, $email, $address, $pnum, $comment, $assign, $dept,$lead_source) {
		
			$count = count($dept);
		for ($i = 0; $i < $count; $i++) {
			$department = $dept[$i];
if ($i == 0) {
	$this->db->select("*");
	$this->db->from('lead_master');
	$this->db->where('contact_no',$pnum);
	$this->db->where('enquiry_for',$department);
	$query=$this->db->get()->result();
}}
		
		
//print_r($query);

	if (count($query) > 0) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Customer Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
			} else {

	$today = date("Y-m-d");
		//$str_today = strtotime($today);

		if (function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$time = date("H:i:s A");

		$count = count($dept);
		for ($i = 0; $i < $count; $i++) {
			$department = $dept[$i];

			$assign_date = date('Y-m-d');

			if ($assign == '') {
				$assignby = '';

			} else {
				$assignby = $_SESSION['user_id'];

			}
			
		

			$username = $_SESSION['username'];

			$query = $this -> db -> query("insert into lead_master(`manual_lead`,`name`,`email`,`address`,`contact_no`,`enquiry_for`,`assignby`,`comment`,`created_date`,`created_time`,`assign_to_telecaller`,`assign_date`,`lead_source`)values('$username','$fname','$email','$address','$pnum','$department','$assignby','$comment','$today','$time','$assign','$assign_date','$lead_source')");

$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Customer Added Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		}}

	}

	public function select_user($location) {

		$this -> db -> select('*');
		$this -> db -> from('lmsuser');
		$this -> db -> where('role', '3');
		$this -> db -> where('location', $location);
		$this -> db -> where('status', '1');
		$this -> db -> order_by('fname', 'asc');
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_dept() {
		$this -> db -> select('*');
		$this -> db -> from('department');
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_location() {
		$this -> db -> select('*');
		$this -> db -> from('tbl_location');
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_location1($location) {
		$this -> db -> select('*');
		$this -> db -> from('tbl_location');
		$this -> db -> where('location_id', $location);
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_customer() {

		$this -> db -> select('l.enq_id,l.name,l.manual_lead,l.email,l.address,l.contact_no,l.enquiry_for,l.address,l.created_date,f1.date,f1.nextfollowupdate,f1.comment as remark,l.location,l.assign_to_telecaller,l.comment,d.disposition_name,s.status_name,u.fname,u.lname');
		$this -> db -> from('lead_master l');

		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller');
		$this -> db -> join('tbl_status s', 's.status_id=l.status');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition','left');
		$this -> db -> join('lead_followup f1', 'f1.id=l.followup_id', 'left');

		if ($_SESSION['role'] == '3') {
			$this -> db -> where('manual_lead', $_SESSION['username']);
		}
		$this -> db -> where('manual_lead!=', '');
		$this -> db -> order_by('enq_id','desc');
		$this->db->limit(100);
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function edit_customer($id) {

		$this -> db -> select('l.enq_id,l.name,l.manual_lead,l.email,l.address,l.contact_no,l.enquiry_for,u.id,l.address,t.location,t.location_id,l.assign_to_telecaller,l.comment,u.fname,u.lname');
		$this -> db -> from('lead_master l');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller');
		$this -> db -> join('tbl_location t', 'u.location=t.location_id');

		$this -> db -> where('enq_id', $id);

		$query = $this -> db -> get();
		return $query -> result();

		//echo $this->db->last_query();

	}

	public function update_grp($enq_id, $fname, $email, $pnum, $address, $assign, $location, $comment, $dept) {

		$count = count($dept);
		for ($i = 0; $i < $count; $i++) {
			$department = $dept[$i];
			if ($i == 0) {
				$this -> db -> query('update lead_master set name="' . $fname . '",email="' . $email . '",address="' . $address . '",contact_no="' . $pnum . '",enquiry_for="' . $department . '",assign_to_telecaller="' . $assign . '",comment="' . $comment . '" where enq_id="' . $enq_id . '"');

			} else {
				$today = date("Y-m-d");
				//$str_today = strtotime($today);

				if (function_exists('date_default_timezone_set')) {
					date_default_timezone_set("Asia/Kolkata");
				}
				$time = date("H:i:s A");
				$assign_date = date('Y-m-d');

				if ($assign == '') {
					$assignby = '';

				} else {
					$assignby = $_SESSION['user_id'];

				}

				$username = $_SESSION['username'];

				$query = $this -> db -> query("insert into lead_master(`manual_lead`,`name`,`email`,`address`,`contact_no`,`enquiry_for`,`assignby`,`comment`,`created_date`,`created_time`,`assign_to_telecaller`,assign_date)values
				('$username','$fname','$email','$address','$pnum','$department','$assignby','$comment','$today','$time','$assign','$assign_date')");

			}

		}

	}

	//	$query = $this->db->get();

	//	echo $this->db->last_query();



function del_customer($enq_id) {
	$this -> db -> query("delete from lead_master where enq_id='$enq_id'");

}

}

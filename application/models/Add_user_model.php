<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class add_user_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_user($fname, $lname, $email, $pnum, $location, $role, $date, $password, $process_id, $group_id,$role_name) {
		
		$this->db->select('email');
		$this->db->from('lmsuser');
		$this -> db -> where('email', $email);
		$q=$this->db->get()->result();
			$count = count($q);
			//echo $count;
	
if($count > 0)
{
	$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> User Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
}
else {
	
	$query = $this -> db -> query("insert into lmsuser(`fname`,`lname`,`email`,`mobileno`,`location`,`role`,`date`,`status`,`is_active`,`password`,`process_id`,role_name)values('$fname','$lname','$email','$pnum','$location','$role','$date',1,'Offline','$password','$process_id','$role_name')");
		$user_id = $this -> db -> insert_id();
		$group_id_count = count($group_id);
		for ($i = 0; $i < $group_id_count; $i++) {
			$query = $this -> db -> query("INSERT INTO `tbl_user_group`(`user_id`, `group_id`) VALUES ($user_id,$group_id[$i])");
		}
		if ($query) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-success">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>LMS User Added Successfully...! Please Assign Rights.</strong></div>');

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> LMS User Not Added Successfully...!</strong></div>');

		}
	
}
	
		

		//if ($query) {
			//$this -> session -> set_flashdata('message', '<div class="alert alert-success">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>LMS User Added Successfully...! Please Assign Rights.</strong></div>');

		//} else {
			//$this -> session -> set_flashdata('message', '<div class="alert alert-danger">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> LMS User Not Added Successfully...!</strong></div>');

		//}
	}

	public function select_process() {
		$this -> db -> select('process_id,process_name');
		$this -> db -> from('tbl_process');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where('process_id', $_SESSION['process_id']);
		}
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_group($process_id) {
		$this -> db -> select('group_id,group_name');
		$this -> db -> from('tbl_group');
		$this -> db -> where('process_id', $process_id);
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_location() {
		$this -> db -> select('location_id,location');
		$this -> db -> from('tbl_location');
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_table() {
		$this -> db -> select('u.fname,u.lname,u.mobileno,u.email,u.id,u.role,l.location,p.process_name,u.role_name');
		$this -> db -> from('lmsuser u');
		$this -> db -> join('tbl_location l', 'l.location_id=u.location');
		$this -> db -> join('tbl_process p', 'p.process_id=u.process_id');
		$this -> db -> where('u.id !=', '0');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where('u.role !=', 1);
			$this -> db -> where('p.process_id ', $_SESSION['process_id']);
		}

		$this -> db -> where('status', '1');
		$query1 = $this -> db -> get();
		return $query1 -> result();

	}

	public function edit_user($id) {
		$this -> db -> select('u.fname,u.lname,u.mobileno,u.email,u.id,u.role,u.role_name,l.location_id,l.location,p.process_name,p.process_id,g.group_name,g.group_id');
		$this -> db -> from('lmsuser u');
		$this -> db -> join('tbl_location l', 'l.location_id=u.location', 'left');
		$this -> db -> join('tbl_process p', 'p.process_id=u.process_id', 'left');
		$this -> db -> join('tbl_user_group ug', 'ug.user_id=u.id', 'left');
		$this -> db -> join('tbl_group g', 'g.group_id=ug.group_id', 'left');
		$this -> db -> where('id', $id);
		$query1 = $this -> db -> get();
		// $this->db->last_query();
		return $query1 -> result();

	}

	function update_user($fname, $lname, $email, $pnum, $process_id, $location, $role, $id,$group_id,$role_name) {

		$query=$this -> db -> query('update lmsuser set fname="' . $fname . '",lname="' . $lname . '",email="' . $email . '",mobileno="' . $pnum . '",process_id="' . $process_id . '",location="' . $location . '",role="' . $role . '",role_name="' . $role_name . '"  where id="' . $id . '"');
		
		$group_id_count = count($group_id);
		
		
		$this -> db -> query("delete from tbl_user_group WHERE user_id='$id'");
		$this->db->last_query();
		
		for ($i = 0; $i < $group_id_count; $i++) {
			$query = $this -> db -> query("insert into tbl_user_group (user_id,group_id)values($id,$group_id[$i] )");
			
		}
				
		
		if ($query) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-success">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>LMS User Updated Successfully...! </strong></div>');

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>LMS User Not Updated Successfully...!</strong></div>');

		}
	}

	public function delete_user() {
		$id = $this -> input -> get('id');
		$query = $this -> db -> query("delete from tbl_user_group WHERE user_id='$id'");
		$query = $this -> db -> query("delete from lmsuser WHERE id='$id'");
		$query = $this -> db -> query("delete from tbl_rights WHERE user_id='$id'");
		if ($query) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-success">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>LMS User Deleted Successfully...! </strong></div>');

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>LMS User Not Deleted Successfully...!</strong></div>');

		}
	}

}

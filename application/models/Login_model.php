<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class login_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	public function form_submit($username, $password) {
		$this -> db -> select('role,id,fname,lname,location');
		$this -> db -> from('lmsuser');
		$this -> db -> where('email', $username);
		$this -> db -> where('password', $password);

		$this -> db -> limit(1);
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function form_submit1($username, $password) {

		$this -> db -> select('role,id,fname,lname,location,process_id');
		$this -> db -> from('lmsuser');
		$this -> db -> where('email', $username);
		$this -> db -> where('password', $password);

		$this -> db -> limit(1);
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

	public function update_status($id, $process_id) {

		$data = array('is_active' => 'Online');
		$this -> db -> where('id', $id);
		$this -> db -> update('lmsuser', $data);
		$this -> db -> select('process_name');
		$this -> db -> from('tbl_process');
		$this -> db -> where('process_id', $process_id);
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_user_group($id) {
		$this -> db -> select('g.group_name,g.group_id');
		$this -> db -> from('tbl_group g');
		$this -> db -> join('tbl_user_group u', 'u.group_id=g.group_id', 'left');
		$this -> db -> where('u.user_id', $id);
		$query = $this -> db -> get();
		return $query -> result();
	}

	public function change_status() {
		$id=$_SESSION['user_id'];
		$data = array('is_active' => 'Offline');
		$this -> db -> where('id', $id);
		$this -> db -> update('lmsuser', $data);

	}

	public function get_right($id) {
		$this -> db -> select('*');
		$this -> db -> from('tbl_rights');
		$this -> db -> where('user_id', $id);
		$query = $this -> db -> get();
		return $query -> result();
	}

}
?>

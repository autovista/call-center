<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class add_location_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function insert_location($location_name) {

		$q = $this -> db -> query('select * from tbl_location where location="' . $location_name . '"') -> result();
		//print_r($q);

		if (count($q) > 0) {

			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Location Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		} else {

			$query = $this -> db -> query("insert into tbl_location (`location`)values('$location_name')");

			$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Location Added Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		}
	}

	public function select_location() {
		$this -> db -> select('location_id,location');
		$this -> db -> from('tbl_location');
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function edit_location($id) {
		$this -> db -> select('location_id,location');
		$this -> db -> from('tbl_location');
		$this -> db -> where('location_id', $id);
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function edit_new_location($id, $location_name) {

		$q = $this -> db -> query('select * from tbl_location where location="' . $location_name . '"') -> result();

		//	print_r($q);

		if (count($q) > 0) {

			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Location Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		} else {

			$this -> db -> query('update tbl_location set location_id="' . $id . '", location="' . $location_name . '"  where location_id="' . $id . '"');
			if ($this -> db -> affected_rows() > 0) {

				$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Location Updated Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
			} else {
				$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Location Not Updated Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

			}

		}
	}

	public function delete_location($id) {

		$this -> db -> query("delete from tbl_location where location_id='$id'");
		if ($this -> db -> affected_rows() > 0) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Location Deleted Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Location Not Deleted Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		}

	}

	public function select_table() {
		$this -> db -> select('u.fname,u.lname,u.mobileno,u.email,u.id,u.role,l.location,p.process_name');
		$this -> db -> from('lmsuser u');
		$this -> db -> join('tbl_location l', 'l.location_id=u.location');
		$this -> db -> join('tbl_process p', 'p.process_id=u.process_id');
		$this -> db -> where('u.id !=', '0');

		$this -> db -> where('status', '1');
		$query1 = $this -> db -> get();
		return $query1 -> result();

	}

}

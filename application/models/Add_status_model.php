<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class add_status_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_status($status, $process_id) {

		$q = $this -> db -> query('select * from tbl_status where process_id="' . $process_id . '" and status_name="' . $status . '"') -> result();
		if (count($q) > 0) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Status Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
		} else {
			$query = $this -> db -> query("insert into tbl_status (`status_name`,`process_id`)values('$status','$process_id')");
			$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Status Added Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
		}
	}

	public function select_grp() {

		$this -> db -> select('g.group_name,g.group_id,p.process_id,p.process_name');
		$this -> db -> from('tbl_group g');
		$this -> db -> join('tbl_process p', 'p.process_id=g.process_id');
		$query1 = $this -> db -> get();
		return $query1 -> result();

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

	public function select_status() {

		$this -> db -> select('s.status_name,s.status_id,p.process_name,p.process_id');
		$this -> db -> from('tbl_status s');
		$this -> db -> join('tbl_process p', 'p.process_id=s.process_id');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where('p.process_id', $_SESSION['process_id']);
		}
		$query1 = $this -> db -> get();
		return $query1 -> result();

	}

	public function select_status_id($status_id) {

		$this -> db -> select('s.status_name,s.status_id,p.process_name,p.process_id');
		$this -> db -> from('tbl_status s');
		$this -> db -> join('tbl_process p', 'p.process_id=s.process_id');
		$this -> db -> where('status_id', $status_id);
		$query1 = $this -> db -> get();
		return $query1 -> result();

	}

	public function update_status($status_id, $status_name, $process_id) {

		$q = $this -> db -> query('select * from tbl_status where process_id="' . $process_id . '" and status_name="' . $status_name . '"') -> result();
		print_r($q);
		if (count($q) > 0) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Status Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
		} else {
			$this -> db -> query('update tbl_status set status_name="' . $status_name . '", process_id="' . $process_id . '"  where status_id="' . $status_id . '"');
			if ($this -> db -> affected_rows() > 0) {
				$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Status Updated Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

			} else {
				$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Status Not Updated Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

			}
		}
	}

	public function delete_status($status_id) {

		$this -> db -> query("delete from tbl_status where status_id='$status_id'");
		if ($this -> db -> affected_rows() > 0) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Status Deleted Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Status Not Deleted Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		}

	}

}

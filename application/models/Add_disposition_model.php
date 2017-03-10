<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class add_disposition_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_department($disposition_name, $lead, $process_id) {

		$this -> db -> select('d.disposition_name,d.status_id,p.process_id');
		$this -> db -> from('tbl_disposition_status d');
		$this -> db -> join('tbl_status s', 's.status_id=d.status_id');
		$this -> db -> join('tbl_process p', 'p.process_id=s.process_id');
		$this -> db -> where('d.disposition_name', $disposition_name);
		$this -> db -> where('d.status_id', $lead);
		$this -> db -> where('p.process_id', $process_id);
		$query1 = $this -> db -> get() -> result();

		//echo $this->db->last_query();

		$count = count($query1);

		if ($count > 0) {

			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Disposition Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
		} else {

			$query = $this -> db -> query("insert into tbl_disposition_status(`disposition_name`,`status_id`)values('$disposition_name','$lead')");
			$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Disposition Added Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		}

	}

	public function select_table() {

		$this -> db -> select('d.disposition_name,d.disposition_id,s.status_name,p.process_name');
		$this -> db -> from('tbl_disposition_status d');
		$this -> db -> join('tbl_status s', 's.status_id=d.status_id', 'left');
		$this -> db -> join('tbl_process p', 'p.process_id=s.process_id', 'left');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where('p.process_id', $_SESSION['process_id']);
		}
		$query1 = $this -> db -> get();
		return $query1 -> result();

	}

	public function select_grp() {

		$this -> db -> select('g.group_name,g.group_id,g.process_id,p.process_name');
		$this -> db -> from('tbl_group g');
		$this -> db -> join('tbl_process p', 'p.process_id=g.process_id');
		$query1 = $this -> db -> get();
		return $query1 -> result();

	}

	public function select_status($process_id) {

		$this -> db -> select('status_name,status_id');
		$this -> db -> from('tbl_status');
		$this -> db -> where('process_id', $process_id);
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_status1() {

		$this -> db -> select('*');
		$this -> db -> from('tbl_status');

		$query3 = $this -> db -> get();
		return $query3 -> result();

	}

	public function select_status2($process_id) {

		//echo $process_id;
		$this -> db -> select('*');
		$this -> db -> from('tbl_status');
		$this -> db -> where('process_id', $process_id);
		$query3 = $this -> db -> get();
		return $query3 -> result();

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

	public function edit_dispos($id) {
		$this -> db -> select('d.disposition_name,d.disposition_id,s.status_name,s.status_id,p.process_id,p.process_name');
		$this -> db -> from('tbl_disposition_status d');
		$this -> db -> join('tbl_status s', 's.status_id=d.status_id');
		$this -> db -> join('tbl_process p', 'p.process_id=s.process_id');
		$this -> db -> where('d.disposition_id', $id);
		$query = $this -> db -> get();
		return $query -> result();

	}

	function update_dispos($dispostion_name, $id, $process_id, $lead) {

		$this -> db -> select('d.disposition_name,d.status_id,p.process_id');
		$this -> db -> from('tbl_disposition_status d');
		$this -> db -> join('tbl_status s', 's.status_id=d.status_id');
		$this -> db -> join('tbl_process p', 'p.process_id=s.process_id');
		$this -> db -> where('d.disposition_name', $dispostion_name);
		$this -> db -> where('d.status_id', $lead);
		$this -> db -> where('p.process_id', $process_id);
		$query1 = $this -> db -> get() -> result();

		if (count($query1) > 0) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Disposition Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
		} else {

			$this -> db -> query('update tbl_disposition_status set disposition_name="' . $dispostion_name . '",status_id="' . $lead . '" where disposition_id="' . $id . '"');

			if ($this -> db -> affected_rows() > 0) {

				$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Disposition Updated Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
			} else {
				$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Disposition Not Updated Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

			}

		}

	}

	function del_dispos($id) {
		
		$this -> db -> query("delete from tbl_disposition_status where disposition_id='$id'");
		
		
		if ($this -> db -> affected_rows() > 0) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Disposition Deleted Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Disposition Not Deleted Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		}
		

	}

}

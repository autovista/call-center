<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class add_group_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_group($group_name, $process_id) {

		$this -> db -> select("*");
		$this -> db -> from("tbl_group");
		$this -> db -> where("group_name", $group_name);
		$this -> db -> where("process_id", $process_id);
		$query1 = $this -> db -> get() -> result();

		//print_r($query1);

		if (count($query1) > 0) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Group Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		} else {

			$query = $this -> db -> query("insert into tbl_group (`group_name`,`process_id`)values('$group_name','$process_id')");
			$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Group Added Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		}

	}

	public function select_grp() {

		$this -> db -> select('g.group_name,g.group_id,g.process_id,p.process_name');
		$this -> db -> from('tbl_group g');
		$this -> db -> join('tbl_process p', 'p.process_id=g.process_id');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where('p.process_id', $_SESSION['process_id']);
		}
		$query1 = $this -> db -> get();
		return $query1 -> result();

	}

	public function select_process() {
		$this -> db -> select('*');
		$this -> db -> from('tbl_process');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where('process_id', $_SESSION['process_id']);
		}
		$query2 = $this -> db -> get();
		return $query2 -> result();

	}

	public function edit_grp($id) {

		$this -> db -> select('g.group_name,g.group_id,g.process_id,p.process_name');
		$this -> db -> from('tbl_group g');
		$this -> db -> join('tbl_process p', 'p.process_id=g.process_id');
		$this -> db -> where('group_id', $id);
		$query1 = $this -> db -> get();
		return $query1 -> result();

		//	echo $this->db->last_query();

		return $query -> result();

	}

	public function update_grp($group_id, $grp_name, $process_id) {
		
			$this->db->select("*");
			$this->db->from("tbl_group");
			$this->db->where("group_name","$grp_name");
			$query=$this->db->get()->result();
		
		//print_r($query);
		
		if(count($query) > 0)
		{
			
					$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Group Already Exists ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');	
			
		}
		
		else
		 {
	
		$this -> db -> query('update tbl_group set group_name="' . $grp_name . '", process_id="' . $process_id . '"  where group_id="' . $group_id . '"');
	
		if ($this -> db -> affected_rows() > 0) {

				$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Group Updated Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');
			} else {
				$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Group Not Updated Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

			}
			
		}
	

		//	$query = $this->db->get();

		//	echo $this->db->last_query();

	}

	public function del_grp($id) {

		$this -> db -> query("delete from tbl_group where group_id='$id'");
		
		if ($this -> db -> affected_rows() > 0) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-success"><strong> Group Deleted Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong> Group Not Deleted Successfully ...!</strong>	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>	</div>');

		}
		

	}

}

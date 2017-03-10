<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class add_reason_followup_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_reason($reason_name)
	{
		
		$query=$this->db->query("insert into followup_reason(`reason_name`)values('$reason_name')");
	
	}
	
	
	public function select_table()
	{
		$this->db->select('*');
		$this->db->from('followup_reason');
		$query1 = $this->db->get();
		return $query1->result();
	
		
	}
	
		public function edit_reason($id)
	{
		$this->db->select('*');
		$this->db->from('followup_reason');
		$this->db->where('reason_id', $id);
		$query = $this->db->get();
		return $query->result();
	
	}
	
	function update_reason($reason_name,$id)
	{
		$this->db->query('update followup_reason set reason_name="'.$reason_name.'"  where reason_id="'.$id.'"');
		
	}
	
		function del_reason($id)
	{
		$this->db->query("delete from followup_reason where reason_id='$id'");
		
	}
	
	
	
	
}
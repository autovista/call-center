<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class manager_remark_model extends CI_model {
	function __construct()
	{
		parent::__construct();
	}
	
	public function select_lead($id)
	{	

		$this->db->select('name,contact_no,enquiry_for');
		$this->db->from('lead_master');
		$this->db->where('enq_id',$id);
		               
$query=$this->db->get();
return $query->result();                    
                    

			

	}
	public function select_remark($id)
	{
		
		$this->db->select('*');
		$this->db->from('lead_remarks');
		$this->db->where('lead_id',$id);
		$this->db->order_by('lead_remarks_id','desc');
		$query=$this->db->get();
		return $query->result();
	}		
	public function insert_remark()
	{
$today = date("Y-m-d");

$str_today=strtotime($today);

if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}
$time =  date("H:i:s A");
$date=$today.$time;


 //echo $assign=$_POST['assign'];
$assign=$_SESSION['user_id'];
$comment=$this->input->post('comment');
$status=$this->input->post('status');
$enq_id=$this->input->post('booking_id');

 $role=$this->input->post('role');
$enquiry_for=$this->input->post('enquiry_for');



$insert=$this->db->query("INSERT INTO `lead_remarks`( `lead_id`,`lead_remarks`, `lead_status`,`creation_by`,`creation_date`,`role`) VALUES ('$enq_id','$comment','$status','$assign','$today','$role')") or die(mysql_error());

	}		
	}
?>
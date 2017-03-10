<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class facebook_lead_model extends CI_model {
	function __construct()
	{
		parent::__construct();
	}
	public function select_lead($enq)
	{
			 
	  $status=$this->input->post('status');
		 $fromdate=$this->input->post('fromdate');
		 $todate=$this->input->post('todate');
	$enq=str_replace('%20', ' ', $enq);
		$str_fromdate=strtotime($fromdate);
		$str_todate=strtotime($todate);
	$assign_to=$_SESSION['user_id'];
			//$query2=mysql_query("select  from lead_master where lead_source='Facebook' order by enq_id DESC limit 500") or die(mysql_error()); 
					$this->db->select('u.fname,u.lname,count(f.id) as fcount,l.enq_id,l.name,l.email,l.comment,l.contact_no,l.enquiry_for,l.status,l.assign_to_telecaller,l.followupby,l.created_date,l.created_time');
					$this->db->from('lead_master l');
					$this->db->join('lead_followup f','f.leadid=l.enq_id');
					$this->db->join('lmsuser u','u.id=l.assignby');
					$this->db->where('l.lead_source','Facebook');
					$this->db->where('l.assign_to_telecaller',$assign_to);
				if($enq!='All')
			{
				$this->db->where('l.enquiry_for',$enq);
				
			}
				if($status!=0)
	{
		$this->db->where('l.status',$status);
	}
	
	if($status==0)
	{
		$st="(l.status=1 or l.status=2 or l.status=3 or l.status=4 or l.status=5)";
		$this->db->where($st);
	}
	if($fromdate!='' || $todate!='')
	{
		$this->db->where('l.str_to_time_created_date>=',$str_fromdate);
		$this->db->where('l.str_to_time_created_date<=',$str_todate);
	}
	
	
	
	$this->db->group_by('l.enq_id');
	$this->db->order_by('l.enq_id','desc');
	if($status==0 && $fromdate==''&& $todate=='')
	{
		$this->db->limit(100);
	}
					$this->db->group_by('l.enq_id');
					$this->db->order_by('l.enq_id','desc');
				
					$query=$this->db->get();
				//	echo $this->db->last_query();
					return $query->result();
		

	}
	public function select_tl_lead($enq)
	{
		$enq=str_replace("%20", " ", $enq);
		 $assign_to=$this->input->post('assign_to');
	  $status=$this->input->post('status');
		 $fromdate=$this->input->post('fromdate');
		 $todate=$this->input->post('todate');
		 $str_fromdate=strtotime($fromdate);
		$str_todate=strtotime($todate);
			//$query2=mysql_query("select  from lead_master where lead_source='Facebook' order by enq_id DESC limit 500") or die(mysql_error()); 
					$this->db->select('u.fname,u.lname,count(f.id) as fcount,l.enq_id,l.name,l.email,l.comment,l.contact_no,l.enquiry_for,l.status,l.assign_to_telecaller,l.followupby,l.created_date,l.created_time');
					$this->db->from('lead_master l');
					$this->db->join('lead_followup f','f.leadid=l.enq_id');
					$this->db->join('lmsuser u','u.id=l.assign_to_telecaller');
					$this->db->where('l.lead_source','Facebook');
			if($enq!='All')
			{
				$this->db->where('l.enquiry_for',$enq);
				
			}
			if($status!=0)
	{
		$this->db->where('l.status',$status);
	}
	
	if($status==0)
	{
		$st="(l.status=1 or l.status=2 or l.status=3 or l.status=4 or l.status=5)";
		$this->db->where($st);
	}
	if($fromdate!='' || $todate!='')
	{
		$this->db->where('l.str_to_time_created_date>=',$str_fromdate);
		$this->db->where('l.str_to_time_created_date<=',$str_todate);
	}
	if($assign_to !='' || $assign_to !=0)
	{
		$this->db->where('l.assign_to_telecaller',$assign_to);
	}
	
	if($status==0 && $fromdate=='' && $todate==''&& $assign_to==0)
	{
		$this->db->limit(100);
	}

					$this->db->group_by('l.enq_id');
					
					$this->db->order_by('l.enq_id','desc');
				
					$query=$this->db->get();
					//echo $this->db->last_query();
					return $query->result();
	}
	public function select_telecaller()
	{
			$this->db->select('fname,lname,id');
			$this->db->from('lmsuser');
			$this->db->where('role',3);
			$this->db->where('status',1);
			$this->db->order_by('fname','asc');
			$query=$this->db->get();
			return $query->result();			
	}
	}
?>
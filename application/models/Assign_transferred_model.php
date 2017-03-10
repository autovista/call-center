<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Assign_transferred_model extends CI_model {
	function __construct() {
		parent::__construct();
	}
	function location() {
		$this -> db -> select('*');
		$this -> db -> from('tbl_location');
		$query = $this -> db -> get();
		return $query -> result();

	}
	function checkUserCountRights()
	{
		/*---check count as per group & user--*/
		if ($_SESSION['role'] != 1) {
			$process_id = $_SESSION['process_id'];
			$user_id = $_SESSION['user_id'];

			$this -> db -> select('g.campaign_name');
			$this -> db -> from('tbl_campaign g');
			$this -> db -> join('tbl_user_group u', 'u.group_id=g.group_id');
			//$this -> db -> join('tbl_campaign c', 'c.group_id=u.group_id');
			$this -> db -> where('u.user_id', $user_id);
			//$this -> db -> where('g.process_id', $process_id);
			$query1 = $this -> db -> get() -> result();

			$c = count($query1);
			if (count($query1) > 0) {
				$t = ' ( ';
				for ($i = 0; $i < $c; $i++) {
					if ($i == 0) {
						/*if ($query1[$i] -> campaign_name == 'New Car') {
							$t = $t . "enquiry_for != 'Used Car'";
						} else {*/
							$t = $t . "enquiry_for = '" . $query1[$i] -> campaign_name . "'";
						//}
					} else {
						$t = $t . " or enquiry_for ='" . $query1[$i] -> campaign_name . "'";
					}
				}
				$st = $t . ')';

			}
		return $st; 
		}
		
		
	}
function all_count() {
		$this -> db -> select('count(enq_id)as acount');
		$this -> db -> from('lead_master');
		$this -> db -> where('assign_to_telecaller', $_SESSION['user_id']);		
		$query = $this -> db -> get();
		return $query -> result();
	}
function campaign_name() {		
		$this -> db -> select('enquiry_for,count(enquiry_for) as ecount');
		$this -> db -> from('lead_master');
		$this -> db -> where('assign_to_telecaller', $_SESSION['user_id']);
		$this -> db -> where('lead_source', 'Facebook');
		
		$this -> db -> group_by('enquiry_for');
		$query = $this -> db -> get();
		return $query -> result();
	}
function assign_data(){


		$assign_by = $_SESSION['user_id'];
		$assign_date = date('Y-m-d');
		 $cse_name = $this -> input -> post('cse_name');
		 $cse_count=count($cse_name);
			print_r($cse_name);
			echo"<br>";
			 $web_lead_name=$this -> input -> post('leads1');
			echo"<br>";
			 $web_lead_count=$this -> input -> post('lead_count1');
			echo"<br>";
			 $facebook_lead_name=$this -> input -> post('leads2');
			echo"<br>";
		 $facebook_lead_count=$this -> input -> post('lead_count2');
		echo"<br>";
		if($web_lead_count!='')
		{
		$lead_count=$web_lead_count;
		}else{
		$lead_count=$facebook_lead_count;
		}
		
		if($web_lead_name=='Web')
			{
				
				$web_lead_name='';
			}
		
		 $assign_count = $lead_count % $cse_count;
				if ($assign_count == 0)//check remainder
			{
				echo $assign_count1 = $lead_count / $cse_count;
				$assign_count_reminder=$assign_count1;
			}else{
					$lead_count = $lead_count - $assign_count;
					$assign_count1 = $lead_count / $cse_count;
				echo $assign_count_reminder = $assign_count1 + $assign_count;
			}

				for ($i = 0; $i < $cse_count; $i++) {
			if($i==0){
		if($web_lead_count!='')
		{
			
			
			$query=$this->db->query("select enq_id from lead_master where lead_source='$web_lead_name' and assign_to_telecaller='$assign_by'  limit $assign_count_reminder ")->result();
			echo $this->db->last_query();
			
			
	}else{
			echo"Facebook";
			$query=$this->db->query("select enq_id from lead_master where enquiry_for='$facebook_lead_name' and lead_source='Facebook' and assign_to_telecaller='$assign_by'  limit $assign_count_reminder ")->result();
			echo $this->db->last_query();
			
		}
			}else{
				if($web_lead_count!='')
		{
			
			
			$query=$this->db->query("select enq_id from lead_master where lead_source='$web_lead_name' and assign_to_telecaller='$assign_by' limit $assign_count1 ")->result();
			echo $this->db->last_query();
			
			
	}else{
			echo"Facebook";
			$query=$this->db->query("select enq_id from lead_master where enquiry_for='$facebook_lead_name' and lead_source='Facebook' and assign_to_telecaller='$assign_by' limit  $assign_count1")->result();
			echo $this->db->last_query();
			
		}
			}
			
				foreach ($query as $row) {
				echo $enq_id = $row->enq_id."<br>";
				$insertQuery = $this -> db -> query('INSERT INTO request_to_lead_transfer( `lead_id` , `assign_to_telecaller` , `assign_by_id` , `created_date` , `created_time` ,status)  VALUES("' . $enq_id . '","' .$cse_name[$i].'","' . $assign_by . '","' . $today1 . '","' . $time . '","Transfered")');
				$transfer_id=$this->db->insert_id();
				$this->db->query ("update lead_master set transfer_id='$transfer_id',assignby='$assign_by',assign_date='$assign_date',assign_to_telecaller='$cse_name[$i]' where enq_id='$enq_id'");
				echo $this->db->last_query();
						
			}
		}
			
	
						
			}
}
?>

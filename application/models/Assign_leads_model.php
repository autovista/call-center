<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class assign_leads_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	public function select_lead($enq_id) {
		$this -> db -> select('v.variant_id,v.variant_name,m.model_id,m.model_name,
		l.assign_date,l.enq_id,name,l.email,l.address,contact_no,l.comment,enquiry_for,l.status,l.created_date,
		l.created_time,l.location,
		f.activity,f.created_date as c_date,f.contactibility,f.followup_reason,f.comment as f_comment,f.nextfollowupdae,f.nextfollowuptime 
		 ');
		$this -> db -> from('lead_master l');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('lead_followup f', 'f.leadid=l.enq_id', 'left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');

		$this -> db -> where('l.enq_id', $enq_id);

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
	function website_count($st) {	
		$this -> db -> select('count(enq_id)as wcount');
		$this -> db -> from('lead_master');
		$this -> db -> where('assign_to_telecaller', '0');
		$this -> db -> where('lead_source', ' ');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where($st);
		}
		$query = $this -> db -> get();
		return $query -> result();
	}

	function all_count($st) {
		$this -> db -> select('count(enq_id)as acount');
		$this -> db -> from('lead_master');
		$this -> db -> where('assign_to_telecaller', '0');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where($st);
		}
		$query = $this -> db -> get();
		return $query -> result();
	}

	function dse_name() {
		$this -> db -> select('id,fname,lname');
		$this -> db -> from('lmsuser');
		$this -> db -> where('role', '3');
		$this -> db -> where('status', '1');
		$this -> db -> where('location', '1');
		$this -> db -> order_by('fname', 'asc');
		$query = $this -> db -> get();
		return $query -> result();

	}

	function location() {
		$this -> db -> select('*');
		$this -> db -> from('tbl_location');
		$query = $this -> db -> get();
		return $query -> result();

	}

	function select_cse() {
		if ($_SESSION['role'] != 1) {
			$process_id = $_SESSION['process_id'];
			$user_id = $_SESSION['user_id'];

			$this -> db -> select('g.group_id');
			$this -> db -> from('tbl_group g');
			$this -> db -> join('tbl_user_group u', 'u.group_id=g.group_id');
			$this -> db -> where('u.user_id', $user_id);
		
			$query1 = $this -> db -> get() -> result();
			$c = count($query1);
			if (count($query1) > 0) {
				$t = ' ( ';
				for ($i = 0; $i < $c; $i++) {
					if ($i == 0) {
						
							$t = $t . "group_id = '" . $query1[$i] -> group_id . "'";
						
					} else {
						$t = $t . " or group_id ='" . $query1[$i] -> group_id . "'";
					}
				}
				$st = $t . ')';

			}
		 $st; 
		}
		$location = $this -> input -> post('location');
		$this -> db -> select('id,fname,lname');
		$this -> db -> from('lmsuser l');
		$this -> db -> join('tbl_user_group u', 'u.user_id=l.id');
		$this -> db -> join('tbl_rights r', 'r.user_id=l.id');
		
			$this -> db -> where('r.form_name', 'Calling Notification');
			$this -> db -> where('r.view', '1');
								
				
	
				$this -> db -> where('status', '1');
		
		
		if ($_SESSION['role'] != 1) {
			$this -> db -> where($st);
		}
		$this -> db -> where('location', $location);
		$this->db->group_by("l.id");		
		$this->db->order_by("fname", "asc");		
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
	}

	function fb_count() {
		$this -> db -> select('count(enq_id)as fbcount');
		$this -> db -> from('lead_master');
		$this -> db -> where('assign_to_telecaller', '0');
		$this -> db -> where('lead_source', 'Facebook');
		$query = $this -> db -> get();
		return $query -> result();
	}

	function excel_count() {
		$this -> db -> select('count(enq_id)as ecount');
		$this -> db -> from('lead_master');
		$this -> db -> where('assign_to_telecaller', '0');
		$this -> db -> where('lead_source', 'Excel');
		$query = $this -> db -> get();
		return $query -> result();
	}

	function campaign_name($st) {		
		$this -> db -> select('enquiry_for,count(enquiry_for) as ecount');
		$this -> db -> from('lead_master');
		$this -> db -> where('assign_to_telecaller', '0');
		$this -> db -> where('lead_source', 'Facebook');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where($st);
		}
		$this -> db -> group_by('enquiry_for');
		$query = $this -> db -> get();
		return $query -> result();
	}

	function excel_name() {
		$this -> db -> select('enquiry_for,count(enquiry_for) as ecount');
		$this -> db -> from('lead_master');
		$this -> db -> where('assign_to_telecaller', '0');
		$this -> db -> where('lead_source', 'Excel');
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
			
			
			$query=$this->db->query("select enq_id from lead_master where lead_source='$web_lead_name' and assign_to_telecaller=''and assign_date='0000-00-00' limit $assign_count_reminder ")->result();
			echo $this->db->last_query();
			
			
	}else{
			echo"Facebook";
			$query=$this->db->query("select enq_id from lead_master where enquiry_for='$facebook_lead_name' and lead_source='Facebook' and assign_to_telecaller=''and assign_date='0000-00-00' limit $assign_count_reminder ")->result();
			echo $this->db->last_query();
			
		}
			}else{
				if($web_lead_count!='')
		{
			
			
			$query=$this->db->query("select enq_id from lead_master where lead_source='$web_lead_name' and assign_to_telecaller=''and assign_date='0000-00-00' limit $assign_count1 ")->result();
			echo $this->db->last_query();
			
			
	}else{
			echo"Facebook";
			$query=$this->db->query("select enq_id from lead_master where enquiry_for='$facebook_lead_name' and lead_source='Facebook' and assign_to_telecaller=''and assign_date='0000-00-00' limit  $assign_count1")->result();
			echo $this->db->last_query();
			
		}
			}
			
				foreach ($query as $row) {
				echo $enq_id = $row->enq_id."<br>";
				$this->db->query ("update lead_master set assignby='$assign_by',assign_date='$assign_date',assign_to_telecaller='$cse_name[$i]' where enq_id='$enq_id'");
				echo $this->db->last_query();
						
			}
		}
			
	
						
			}
			
			
		
				


	function assigned1($st) {	

		$assign_by = $_SESSION['user_id'];
		$assign_date = date('Y-m-d');
		 $cse_name = $this -> input -> post('cse_name');
			print_r($cse_name);
			echo $this -> input -> post('leads1');
			echo $this -> input -> post('lead_count1');
			echo $this -> input -> post('leads2');
			
		//Get Campaign name
		if ($this -> input -> post('leads1') == '') {
			
			$campWithCount = $this -> input -> post('leads2');
			$explodeCampWithCount=explode('##',$campWithCount);
			echo $campaign_name=$explodeCampWithCount[0];
			 $lead_count = $this -> input -> post('lead_count2');

		} else {			
			  $campaign_name = $this -> input -> post('leads1');
			 $lead_count = $this -> input -> post('lead_count1');
		}

		if ($lead_count == '') {
			if ($campaign_name != 'Web') {
			
				 $lead_count=$explodeCampWithCount[1];
				//echo $lead_count = $this -> input -> post('campaign_count');
			} else {
				
				 $lead_count = $this -> input -> post('web_count');

			}

		}

		//Count Wise Update
		$cse_count = count($cse_name);
		if ($cse_count == 1) {
			$this -> db -> select('enq_id');
			$this -> db -> from('lead_master');
			$this -> db -> where('assign_to_telecaller', 0);
			if ($campaign_name == 'Web') {

				if ($_SESSION['role'] != 1) {
					$this -> db -> where($st);
				}
				$this -> db -> where('lead_source', '');
			} else {
				$this -> db -> where('enquiry_for', $campaign_name);
				$this -> db -> where('lead_source', 'Facebook');
			}
			$this -> db -> limit($lead_count);
			$this -> db -> order_by('enq_id', 'asc');

			$query1 = $this -> db -> get();
			
			foreach ($query1->result() as $row) {
				// Select Customer

				//
				echo $enq_id = $row -> enq_id;				
			//	$query = $this -> db -> query("update lead_master set assignby='$assign_by',assign_date='$assign_date',assign_to_telecaller='$cse_name[0]' where enq_id='$enq_id'");
			
			}
			//echo $campaign_name . '-' . $cse_name[0] . '-' . $lead_count;
			
		} else {
			$assign_count = $lead_count % $cse_count;
			//check count of assign to and assign lead

			if ($assign_count == 0)//check remainder
			{
				$assign_count1 = $lead_count / $cse_count;

				for ($i = 0; $i < $cse_count; $i++) {
					

					$this -> db -> select('enq_id');
					$this -> db -> from('lead_master');
					$this -> db -> where('assign_to_telecaller', 0);
					if ($campaign_name == 'Web') {
						if ($_SESSION['role'] != 1) {
							$this -> db -> where($st);
						}
						$this -> db -> where('lead_source', '');
					} else {
						$this -> db -> where('enquiry_for', $campaign_name);
						$this -> db -> where('lead_source', 'Facebook');
					}
					$this -> db -> limit($assign_count1);
					$this -> db -> order_by('enq_id', 'asc');

					$query = $this -> db -> get();
					
					foreach ($query->result() as $row) {
						// Select Customer

						//
						$enq_id = $row -> enq_id;
					
					//	$query = $this -> db -> query("update lead_master set assignby='$assign_by',assign_date='$assign_date',assign_to_telecaller='$cse_name[$i]' where enq_id='$enq_id'");
						
						
					}
				}

			} else {
				$lead_count = $lead_count - $assign_count;
				$assign_count1 = $lead_count / $cse_count;
				$assign_count2 = $assign_count1 + $assign_count;
				echo $cse_name[0] . '-' . $assign_count2;
				$this -> db -> select('enq_id');
				$this -> db -> from('lead_master');
				$this -> db -> where('assign_to_telecaller', 0);
				if ($campaign_name == 'Web') {
					if ($_SESSION['role'] != 1) {
						$this -> db -> where($st);
					}
					$this -> db -> where('lead_source', '');
				} else {
					$this -> db -> where('enquiry_for', $campaign_name);
					$this -> db -> where('lead_source', 'Facebook');
				}
				$this -> db -> limit($assign_count2);
				$this -> db -> order_by('enq_id', 'asc');

				$query1 = $this -> db -> get();
				
				foreach ($query1->result() as $row) {
					// Select Customer

					//
					echo $enq_id = $row -> enq_id;
					
					//$query = $this -> db -> query("update lead_master set assignby='$assign_by',assign_date='$assign_date',assign_to_telecaller='$cse_name[0]' where enq_id='$enq_id'");
					
				}
				
				for ($i = 1; $i < $cse_count; $i++) {
					$this -> db -> select('enq_id');
					$this -> db -> from('lead_master');
					$this -> db -> where('assign_to_telecaller', 0);
					if ($campaign_name == 'Web') {
						if ($_SESSION['role'] != 1) {
							$this -> db -> where($st);
						}
						$this -> db -> where('lead_source', '');
					} else {
						$this -> db -> where('enquiry_for', $campaign_name);
						$this -> db -> where('lead_source', 'Facebook');
					}
					$this -> db -> limit($assign_count1);
					$this -> db -> order_by('enq_id', 'asc');

					$query1 = $this -> db -> get();
					
					foreach ($query1->result() as $row) {
						// Select Customer

						//
						$enq_id = $row -> enq_id;
						
						//$query = $this -> db -> query("update lead_master set assignby='$assign_by',assign_date='$assign_date',assign_to_telecaller='$cse_name[$i]' where enq_id='$enq_id'");
					
					}
					//echo $cse_name[$i] . '-' . $assign_count1;
				

				}

			}

		}

		//print_r($l);
		//print_r($lc);
	}

	function assigned() {
		echo $assign = $_POST['assign'];
		$lnum = $_POST['lnum'];
		$user_id = $_SESSION['user_id'];
		$assignlead = $_POST['assignlead'];
		$assign_excel_lead = $_POST['assign_excel_lead'];

		echo $campaign_name = $_POST['campaign_name'];
		echo $excel_name = $_POST['excel_name'];
		$alllead = $_POST['alllead'];
		$all_excel_lead = $_POST['all_excel_lead'];

		$assign_date = date('Y-m-d');
		if ($assignlead == 'on') {
			if ($alllead == 'on') {
				$query1 = $this -> db -> query("select enq_id from lead_master where assign_to_telecaller ='0'  and enquiry_for ='$campaign_name' order by enq_id") -> result();
			} else {
				$query1 = $this -> db -> query("select enq_id from lead_master where assign_to_telecaller ='0'  and enquiry_for='$campaign_name' order by enq_id limit $lnum") -> result();

			}

		} else if ($assign_excel_lead == 'on') {
			if ($all_excel_lead == 'on') {
				$query1 = $this -> db -> query("select enq_id from lead_master where assign_to_telecaller ='0' and lead_source='Excel'  and enquiry_for ='$excel_name' order by enq_id") -> result();
			} else {
				$query1 = $this -> db -> query("select enq_id from lead_master where assign_to_telecaller ='0' and lead_source='Excel'  and enquiry_for='$excel_name' order by enq_id limit $lnum") -> result();

			}

		} else {

			$query1 = $this -> db -> query("select enq_id from lead_master where lead_source='' and assign_to_telecaller ='0'   order by enq_id limit $lnum ") -> result();

		}

		foreach ($query1 as $row) {
			echo $enq_id = $row -> enq_id;
			$this -> db -> query("update lead_master set assignby='$user_id',assign_date='$assign_date',assign_to_telecaller='$assign' where enq_id='$enq_id'");
		}
	}

}
?>
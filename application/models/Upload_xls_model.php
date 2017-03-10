<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class upload_xls_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function upload1($name, $email_id, $contact, $campaign_name) {

		$created_date = date("Y-m-d");
		$str_today = strtotime($created_date);
		$time = date("H:i:s A");
		$lead_source = $this->input->post('lead_source');
		
		if($lead_source=='Web')
		{
			$lead_source='';
		}
		if ($contact != '') {

			$this -> db -> select('contact_no');
			$this -> db -> from('lead_master');
			$this -> db -> where('contact_no', $contact);
			$this -> db -> where('enquiry_for', $campaign_name);
			$query2 = $this -> db -> get() -> result();
			$count = count($query2);

			if ($count > 0) {

				echo "no already exist";
			} else {
				$query = $this -> db -> query("insert into lead_master(`name`,`contact_no`,`email`,`created_date`,`enquiry_for`,`created_time`,`lead_source`)values('$name','$contact','$email_id','$created_date','$campaign_name','$time','$lead_source')");
				echo "Inserted";			
			}

		}

	}

	//public function upload2($name,$email_id,$contact,$location,$lead_date,$assign_to_telecaller,$status,$disposition,$new_model,$new_variant,$buyer_type,$old_make,$old_model,$mfg_yr,$kms,$color,$ownership,$egerness,$created_date_followup,$nfd,$remark,$group_id,$campaign_name)
	public function upload2($name,$email_id,$contact,$location,$lead_date,$assign_to_telecaller,$status,$disposition,$old_make,$old_model,$buyer_type,$egerness,$created_date_followup,$nfd,$budget_to,$budget_from,$visit_booked,$visit_location,$visit_booked_in,$visit_booked_date,$customer_sales_status,$car_delivered,$remark,$group_id,$campaign_name)
	{
		//$remark=mysql_real_escape_string($remark);
		$assign_by=$_SESSION['user_id'];
		$created_date = date("Y-m-d");
		
		if($this->input->post('lead_source')=='Web')
		{
			$lead_source='';
		}
		else {
			$lead_source = $this->input->post('lead_source');
		}
		$str_today = strtotime($created_date);
		$time = date("H:i:s A");
		if($old_make!='')
		{
		$this -> db -> select('make_id') -> from('makes') -> where('make_name', $old_make);
		$query = $this -> db -> get() -> result();
		foreach ($query as $row) {

			$old_make_id = $row -> make_id;

			//echo $model_id;
		}
		}else{
			$old_make_id="";
		}
		if($old_model!='' && $old_make!='')
		{
		$this -> db -> select('model_id') -> from('make_models') -> where('model_name', $old_model)-> where('make_id', $old_make_id);
		$query = $this -> db -> get() -> result();
		foreach ($query as $row) {

			$old_model_id = $row -> model_id;

			//echo $model_id;
		}
		}else{
			$old_model_id = '';
		}
		if($new_model!='')
		{
		$this -> db -> select('model_id') -> from('make_models') -> where('model_name', $new_model);
		$query = $this -> db -> get() -> result();
		foreach ($query as $row) {

			$new_model_id = $row -> model_id;

			//echo $model_id;
		}
		}else
			{
				$$new_model_id='';
			}
			if($new_variant!=''&& $new_model!='')
			{
		$this -> db -> select('variant_id');
		$this -> db -> from('model_variant');
		$this -> db -> where('variant_name', $new_variant);
		$this -> db -> where('model_id', $new_model_id);

		$query = $this -> db -> get() -> result();

		foreach ($query as $row) {

			$new_variant_id = $row -> variant_id;

		}
			}else{
				$new_variant_id='';
			}

		$this -> db -> select('g.process_id,g.group_id,s.status_name,s.status_id');
		$this -> db -> from('tbl_group g');
		$this -> db -> join('tbl_status s', 's.process_id=g.process_id');
		$this -> db -> where('g.group_id', $group_id);
		$this -> db -> where('s.status_name', $status);

		$query = $this -> db -> get() -> result();

		foreach ($query as $row) {

			$status_id = $row -> status_id;

		}

		$this -> db -> select('disposition_id');
		$this -> db -> from('tbl_disposition_status');
		$this -> db -> where('disposition_name', $disposition);
		$this -> db -> where('status_id', $status_id);

		$query = $this -> db -> get() -> result();

		foreach ($query as $row) {

			$disposition_id = $row -> disposition_id;

		}
		//$NFD1 = date('Y-m-d', strtotime(str_replace('/', '-', $NFD)));
		//$NFD2 = date('Y-m-d', strtotime('-1 day', strtotime($NFD1)));
		$query = $this -> db -> query("insert into lead_master( `lead_source`,`name`, `email`, `contact_no`, `enquiry_for`, `status`, `disposition`, `eagerness`, `model_id`, `variant_id`,`buyer_type`, `location`,`assignby`, `assign_to_telecaller`, `created_date`, `assign_date`, `old_make`, `old_model`, `color`, `manf_year`, `ownership`, `km`,`buy_make`,`buy_model`,`budget_from`,`budget_to`)
													values('$lead_source','$name','$email_id','$contact','$campaign_name', '$status_id','$disposition_id','$egerness','','','$buyer_type','$location','$assign_by','$assign_to_telecaller','$lead_date','$lead_date','','','$color','$mfg_yr','$ownership','$kms','$old_make_id','$old_model_id','$budget_from','$budget_to')");
		echo $this->db->last_query();
												$insert_id = $this -> db -> insert_id();
		
		$query1 = $this -> db -> query("insert into lead_followup(`comment`,`nextfollowupdate`,`leadid`,`date`,`eagerness`,`assign_to`,`disposition`,`visit_status`,`visit_location`,`visit_booked`,`visit_booked_date`,`sale_status`,`car_delivered`)values('$remark','$nfd','$insert_id','$created_date_followup','$egerness','$assign_to_telecaller','$disposition_id','$visit_booked','$visit_location','$visit_booked','$visit_booked_date','$customer_sales_status','$car_delivered')");
		echo $this->db->last_query();
		$insert_id1 = $this -> db -> insert_id();
		$this -> db -> query('update lead_master set followup_id="' . $insert_id1 . '"  where enq_id="' . $insert_id . '"');
	}

	public function select_grp() {

		$this -> db -> select('*');
		$this -> db -> from('tbl_group');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where('process_id', $_SESSION['process_id']);
		}
		$query1 = $this -> db -> get();
		return $query1 -> result();

	}

	public function select_campaign() {

		$this -> db -> select('*');
		$this -> db -> from('tbl_campaign');
		$query2 = $this -> db -> get();
		return $query2 -> result();
	}

	public function refresh_campaign($group_id) {

		$this -> db -> select('*');
		$this -> db -> from('tbl_campaign');
		$this -> db -> where('group_id', $group_id);
		$query3 = $this -> db -> get();
		//echo $this->db->last_query();
		return $query3 -> result();

	}

}

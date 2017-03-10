<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class add_followup_model extends CI_model {
	function __construct() {
		parent::__construct();
	}
	//Select All Lead Data
	public function select_lead($enq_id) {
		$this -> db -> select('
		u.fname,u.lname,
		v.variant_id,v.variant_name,m.model_id as new_model_id,m.model_name as new_model_name,
		l.assign_date,l.enq_id,name,l.email,l.address,contact_no,l.comment,enquiry_for,l.created_date,l.buyer_type,l.color,l.km,l.manf_year,l.accidental_claim,l.ownership,l.buy_status,
		l.created_time,l.location,l.eagerness,l.buy_make,l.buy_model,l.reg_no,l.budget_from,l.budget_to,
		f.id as followup_id,f.activity,f.date as c_date,f.contactibility,f.comment as f_comment,f.nextfollowupdate,f.nextfollowuptime,f.visit_location,f.visit_booked,f.visit_status,f.visit_booked_date,f.sale_status,f.car_delivered,
		 s.status_name,s.status_id,
		 d.disposition_id,d.disposition_name,
		 m1.model_id,m1.model_name,bm1.model_name as buy_model_name,
		 m2.make_id,m2.make_name,bm2.make_name as buy_make_name');
		$this -> db -> from('lead_master l');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		
		$this -> db -> join('make_models bm1', 'bm1.model_id=l.buy_model', 'left');
		$this -> db -> join('makes bm2', 'bm2.make_id=l.buy_make', 'left');
		//$this -> db -> join('lead_followup f', 'f.leadid=l.enq_id', 'left');
		$this -> db -> join('lead_followup f', 'f.id=l.followup_id', 'left');
		$this -> db -> join('lmsuser u', 'u.id=f.assign_to','left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		$this -> db -> where('l.enq_id', $enq_id);

		$query = $this -> db -> get();
		return $query -> result();

	}
//Select All Lead Data
	public function select_followup_lead($enq_id) {
		$this -> db -> select('f.id as followup_id,f.activity,f.date as c_date,f.comment as f_comment,f.nextfollowupdate,f.nextfollowuptime, 
		 s.status_name,s.status_id,
		 d.disposition_id,d.disposition_name,
		 u.fname,u.lname
		 ');
		$this -> db -> from('lead_followup f');
		$this -> db -> join('lmsuser u', 'u.id=f.assign_to','left');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=f.disposition', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=d.status_id', 'left');
		$this -> db -> where('f.leadid', $enq_id);

		$query = $this -> db -> get();
		return $query -> result();

	}
	//Select Location
	public function select_location() {
		$this -> db -> select('location_id,location');
		$this -> db -> from('tbl_location');
		$query = $this -> db -> get();

		return $query -> result();
	}
	//Select Status
	public function select_status() {
		$process_id = $_SESSION['process_id'];
		$this -> db -> select('status_id,status_name');
		$this -> db -> from('tbl_status');
		$this -> db -> where('process_id', $process_id);
		$this -> db -> where('status_name!=','Not Yet');
		
		$query = $this -> db -> get();
		return $query -> result();
	}
	//Select Group
	function select_group() {
		$this -> db -> select('group_id,group_name');
		$this -> db -> from('tbl_group');
		$query = $this -> db -> get();
		return $query -> result();

	}
	//Select Disposition using status id
	public function select_disposition_id($status) {
		$this -> db -> select('disposition_id,disposition_name');
		$this -> db -> from('tbl_disposition_status');
		$this -> db -> where('status_id', $status);
		$query = $this -> db -> get();
		return $query -> result();
	}
	//Select lms user
	function lmsuser($location) {
		$role = "(role!=1 and role!=2)";
		$this -> db -> select('id,fname,lname');
		$this -> db -> from('lmsuser u');
		$this -> db -> join('tbl_location l', 'l.location_id=u.location', 'left');
		$this -> db -> where('status !=', 0);
		$this -> db -> where($role);
		$this -> db -> where('l.location', $location);
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
	}
	//Select Model
	function make_models() {
		$this -> db -> select('*');
		$this -> db -> from('make_models');
		$this -> db -> where('make_id', '1');
		$query = $this -> db -> get();
		return $query -> result();
	}
	
	function select_city() {
		
		$this->db->distinct();
		$this->db->select('city');
		$this->db->from('tbl_mumbai_price');
		$query = $this->db->get();
		return $query->result();
	
		
	}
	
	function select_city1() {
		
		$this->db->distinct();
		$this->db->select('city');
		$this->db->from('tbl_pune_price');
		$query = $this->db->get();
		return $query->result();
	
		
	}
	

	
		function select_model_name1($city) {
		
		$this->db->distinct();
		$this->db->select('model_name');
		$this->db->from('tbl_pune_price');
		$this -> db -> where('city', $city);
		$query = $this->db->get();
	   	return $query->result();
		
	}
		
		function select_model_name2($city) {
		
		$this->db->distinct();
		$this->db->select('model_name');
		$this->db->from('tbl_nexa_price');
		$this -> db -> where('city', $city);
		$query = $this->db->get();
	   	return $query->result();
		
	}
			function select_model_name3($city) {
		
		$this->db->distinct();
		$this->db->select('model_name');
		$this->db->from('tbl_mumbai_price');
		$this -> db -> where('city', $city);
		$query = $this->db->get();
	   	return $query->result();
		
	}
		function select_model_name4($city) {
		
		$this->db->distinct();
		$this->db->select('model_name');
		$this->db->from('tbl_nexa_price');
		$this -> db -> where('city', $city);
		$query = $this->db->get();
	   	return $query->result();
		
	}
	function select_description($model_name,$city) {
		
		
		//echo $model_name;
		//echo $city;
	//	$this->db->select('id,description,type');
		if($model_name=='S-CROSS'|| $model_name=='BALENO'||$model_name=='IGNIS')
			  {	
			  //	echo "nexa";
			  	$this->db->from('tbl_nexa_price');
				
			  }
else if(($city=='Pune-PCMC'|| $city=='Pune-PMC') && ($model_name!='S-CROSS'|| $model_name!='BALENO'||$model_name!='IGNIS'))
			  {
			  	//echo "pune";
			  	
			  	$this->db->from('tbl_pune_price');
				
			  }
			  
			 
				
 			
			  
			  /*elseif($quotation_location=='MUMBAI' && $quotation_model_name=='S-CROSS')
			  {
			 
			 
			  	$this->db->from('tbl_nexa_price');
				
			  }*/
			else
				 {
				  	//echo "mumbai";
					$this->db->from('tbl_mumbai_price');
				
				}

	
		
		$this -> db -> where('city', $city);
		$this -> db -> where('model_name', $model_name);
		
		$query = $this->db->get();
	//	echo $this->db->last_query();
	   return $query->result();
		
	}
	//Select data for qutation send
	function select_quotation($quotation_location, $quotation_model_name, $quotation_description)
	{
		$this->db->select('max(created_date) as created_date');
		if($quotation_model_name=='S-CROSS'|| $quotation_model_name=='BALENO'||$quotation_model_name=='IGNIS')
			  {	
			  //	echo "nexa";
			  	$this->db->from('tbl_nexa_price');
				
			  }
else if(($quotation_location=='Pune-PCMC'|| $quotation_location=='Pune-PMC') && ($quotation_model_name!='S-CROSS'|| $quotation_model_name!='BALENO'||$quotation_model_name!='IGNIS'))
			  {
			  	//echo "pune";
			  	
			  	$this->db->from('tbl_pune_price');
				
			  }
			  
			 else { $this->db->from('tbl_mumbai_price');}
			 $this->db->where ('city',$quotation_location);
			 $this->db->where('model_name',$quotation_model_name);
		
			$query=$this->db->get()->result();		
		
			echo $this->db->last_query();
		$this -> db -> select('*');
		
		
			 if($quotation_model_name=='S-CROSS'|| $quotation_model_name=='BALENO'||$quotation_model_name=='IGNIS')
			  {	
			  //	echo "nexa";
			  	$this->db->from('tbl_nexa_price');
				
			  }
else if(($quotation_location=='Pune-PCMC'|| $quotation_location=='Pune-PMC') && ($quotation_model_name!='S-CROSS'|| $quotation_model_name!='BALENO'||$quotation_model_name!='IGNIS'))
			  {
			  	//echo "pune";
			  	
			  	$this->db->from('tbl_pune_price');
				
			  }
			else
				 {
				  	//echo "mumbai";
					$this->db->from('tbl_mumbai_price');
				
				}

		$this -> db -> where('city', $quotation_location);
		$this -> db -> where('model_name', $quotation_model_name);
		if($quotation_description!='')
		{
		$this -> db -> where('description', $quotation_description);
		}
		$this->db->where('created_date',$query[0]->created_date);
		/*$this->db->where('Year(created_date)',$year);
        $this->db->where('Month(created_date)',$month);*/
		
		$query = $this -> db -> get();
		echo $this->db->last_query();
		return $query -> result();
	}
		function select_offer($quotation_location,$quotation_model_name)
	{
		$this->db->select('max(month) as created_date');
		$this->db->from("tbl_consumer_offer");
		  if($quotation_location=='Pune-PCMC'|| $quotation_location=='Pune-PMC')
			  {
			  	//echo "pune";
			  	
			  	$this->db->where('location','Pune');
				
			  }else{
			  	 	$this->db->where('location','Mumbai');
			  }
			  $this->db->where('model',$quotation_model_name);
		
			$query=$this->db->get()->result();		
		$this->db->select("*");
		$this->db->from("tbl_consumer_offer");
		  if($quotation_location=='Pune-PCMC'|| $quotation_location=='Pune-PMC')
			  {
			  	//echo "pune";
			  	
			  	$this->db->where('location','Pune');
				
			  }else{
			  	 	$this->db->where('location','Mumbai');
			  }
			  $this->db->where('model',$quotation_model_name);
			 $this->db->where('month',$query[0]->created_date);
		$query = $this -> db -> get();
		echo $this->db->last_query();
		return $query -> result();
	}
	//select variant from model id
	function select_variant_main() {
		$this -> db -> select('*');
		$this -> db -> from('model_variant');
		
		$query = $this -> db -> get();
		return $query -> result();

	}
	function select_model_main() {
		$this -> db -> select('*');
		$this -> db -> from('make_models');
	
		$query = $this -> db -> get();
		return $query -> result();
	}
	//Select model using make id
	function select_model($make) {
		$this -> db -> select('*');
		$this -> db -> from('make_models');
		$this -> db -> where('make_id', $make);
		$query = $this -> db -> get();
		return $query -> result();
	}
	//select make 
	function makes() {
		$this -> db -> select('*');
		$this -> db -> from('makes');
		$this -> db -> where('is_active', '1');
		$query = $this -> db -> get();
		return $query -> result();
	}
	//select variant from model id
	function select_variant($model) {
		$this -> db -> select('*');
		$this -> db -> from('model_variant');
		$this -> db -> where('model_id', $model);
		$query = $this -> db -> get();
		return $query -> result();

	}
	//Insert Followup
	function insert_followup() {

		$today = date("d-m-Y");
		$today1 = date("Y-m-d");

		$str_today = strtotime($today);

		$time = date("H:i:s A");
		$date = $this -> input -> post('date');
		 $enq_id = $this -> input -> post('booking_id');
		$old_data=$this->db->query("select email,address,model_id,variant_id,buy_status,buyer_type from lead_master where enq_id='".$enq_id."'")->result();
		//print_r($old_data);
		//Basic Followup
		$assign_to_telecaller = $_SESSION['user_id'];
		if($this -> input -> post('activity')=='')
		{
			$activity='Outbound Call';
		}
		else {
			$activity = $this -> input -> post('activity');
		}
		
		$status = $this -> input -> post('status1');
		$eagerness = $this -> input -> post('eagerness');
		$contactibility=$this->input->post('contactibility');
		$disposition = $this -> input -> post('disposition1');
		
		 $email = $this -> input -> post('email');
		if(!$email)
		{
			if($old_data[0]->email!=null)
			{
			 $email = $old_data[0]->email;
			}
			}
		 $showroom_location = $this -> input -> post('showroom_location');
		 $followupdate = $this -> input -> post('followupdate');
		 $address1 = $this -> input -> post('address');
		if(!$address1)
		{
			
			 $address1 = $old_data[0]->address;
		
		}
		$address = addslashes($address1);

		//New Car Details
		$new_model = $this -> input -> post('new_model');
		if(!$new_model)
		{
			 $new_model = $old_data[0]->model_id;
		}
		 $new_variant = $this -> input -> post('new_variant');
		if(!$new_variant)
		{
			 $new_variant = $old_data[0]->variant_id;
		}
		$book_status = $this -> input -> post('book_status');
		if(!$book_status)
		{
			 $book_status = $old_data[0]->buy_status;
		}
		$buyer_type = $this -> input -> post('buyer_type');
		if(!$buyer_type)
		{
			 $buyer_type = $old_data[0]->buyer_type;
		}
		
		$comment1 = $this -> input -> post('comment');
		 $comment = addslashes($comment1);

		//Exchange Car Details

		 $old_make = $this -> input -> post('old_make');
		 $old_model = $this -> input -> post('old_model');
		 $color = $this -> input -> post('color');
		 $ownership = $this -> input -> post('ownership');
		 $mfg = $this -> input -> post('mfg');
		 $km = $this -> input -> post('km');
		 $claim = $this -> input -> post('claim');

		//Buy used car Details
		  $buy_make = $this -> input -> post('buy_make');
		  $buy_model = $this -> input -> post('buy_model');
		  $visit_status=$this->input->post('visit_status');
		  $budget_from=$this->input->post('budget_from');
		  $budget_to=$this->input->post('budget_to');
		  $visit_location = $this -> input -> post('visit_location');
		  $visit_booked = $this -> input -> post('visit_booked');
		  $visit_date = $this -> input -> post('visit_date');
		  $sales_status = $this -> input -> post('sales_status');
		  $car_delivered = $this -> input -> post('car_delivered');
		 
		 
		//Transfer Lead
		 $assign_by = $_SESSION['user_id'];
		 $assign = $this -> input -> post('transfer_assign');
		 $tlocation = $this -> input -> post('tlocation');
		 $transfer_reason = $this -> input -> post('transfer_reason');
		 $group_id = $this -> input -> post('group_id');
		 $group_count = count($group_id);
		//print_r($group_id);
		$query=$this->db->query("select status_name from tbl_status where status_id='$status'")->result();
		if($query[0]->status_name== 'Live'){
			$datetime = new DateTime('tomorrow');
			echo $followupdate=$datetime->format('Y-m-d ');
			
		}
		
		//Insert in lead_followup
		$insert = $this -> db -> query("INSERT INTO `lead_followup`
		(`leadid`, `activity`, `comment`, `nextfollowupdate`,  `assign_to`, `disposition`,`eagerness`,`contactibility`, `transfer_reason`, `date`,`visit_status` ,`visit_location`,`visit_booked`,`visit_booked_date`,`sale_status`,`car_delivered`,`created_time`) 
		VALUES ('$enq_id','$activity','$comment','$followupdate','$assign_to_telecaller','$disposition','$eagerness','$contactibility','$transfer_reason','$today1','$visit_status','$visit_location','$visit_booked','$visit_date','$sales_status','$car_delivered','$time')") or die(mysql_error());
 		$followup_id = $this->db->insert_id();
		//Update Follow up in lead__master
		$update = $this -> db -> query("update lead_master set followup_id='$followup_id',status='$status',disposition='$disposition',eagerness='$eagerness',email='$email',location='$showroom_location',address='$address',
		model_id='$new_model',variant_id='$new_variant',buy_status='$book_status',buyer_type='$buyer_type',comment='$comment',
		old_make='$old_make',old_model='$old_model',color='$color',ownership='$ownership',manf_year='$mfg',km='$km',accidental_claim='$claim',buy_make='$buy_make',buy_model='$buy_model',budget_from='$budget_from',budget_to='$budget_to' where enq_id='$enq_id'");

		//Transfer Lead
		if ($assign != '') {
			if ($group_count == '1') {

				
				$insertQuery = $this -> db -> query('INSERT INTO request_to_lead_transfer( `lead_id` , `assign_to_telecaller` , `assign_by_id` ,`transfer_reason`, `location` , `created_date` , `created_time` ,status)  VALUES("' . $enq_id . '","' . $assign . '","' . $assign_by . '","' . $transfer_reason . '","' . $tlocation . '","' . $today1 . '","' . $time . '","Transfered")');
				$transfer_id=$this->db->insert_id();
				$update1 = $this -> db -> query("update lead_master set transfer_id='$transfer_id',`location`='$showroom_location',assign_to_telecaller='$assign',assignby='$assign_by',assign_date='$today1' where enq_id='$enq_id'");
			} else {

				
				$insertQuery = $this -> db -> query('INSERT INTO request_to_lead_transfer( `lead_id` , `assign_to_telecaller` , `assign_by_id` , `transfer_reason`,`location` , `created_date` , `created_time` ,status)  VALUES("' . $enq_id . '","' . $assign . '","' . $assign_by . '","' . $transfer_reason . '","' . $tlocation . '","' . $today1 . '","' . $time . '","Transfered")');
				$transfer_id=$this->db->insert_id();
				$update1 = $this -> db -> query("update lead_master set transfer_id='$transfer_id', assign_to_telecaller='$assign',assignby='$assign_by' ,assign_date='$today1' where enq_id='$enq_id'");
				for ($i = 1; $i < $group_count; $i++) {
					$q = $this -> db -> query("select * from lead_master where enq_id='$enq_id'") -> result();

					 $name = $q[0] -> name;
					$email = $q[0] -> email;
					$contact = $q[0] -> contact_no;

					$insertQuery = $this -> db -> query('INSERT INTO lead_master( `name` , `email` , `contact_no` ,`address`, `enquiry_for`, `created_date` , `created_time` ,`location`,assign_to_telecaller,assignby,assign_date) 
					 VALUES("' . $name . '","' . $email . '","' . $contact . '","' . $address . '","' . $group_id[$i] . '","' . $today1 . '","' . $time . '","' . $showroom_location . '","' . $assign . '","' . $assign_by. '","' . $today1 . '")') or die(mysql_error());
						
					$id1 = $this -> db -> insert_id();
					$insertQuery1 = $this -> db -> query('INSERT INTO request_to_lead_transfer( `lead_id` , `assign_to_telecaller` , `assign_by_id` ,`transfer_reason`, `location` , `created_date` , `created_time`  ,status)  VALUES("' . $id1 . '","' . $assign . '","' . $assign_by . '","' . $transfer_reason . '","' . $tlocation . '","' . $today1 . '","' . $time . '","Transfered")') or die(mysql_error());
					$transfer_id1=$this->db->insert_id();
					$update2 = $this -> db -> query("update lead_master set transfer_id='$transfer_id1' where enq_id='$id1'");
				}
			}
		}
		
	
	}
	//Insert Manager Remark
	function insert_remark() {

		
		$today = date("Y-m-d");
		
		
		//add remark 
		$user_id = $_SESSION['user_id'];
		$remark = $this -> input -> post('comment');
		$enq_id = $this -> input -> post('booking_id');
			
		$query=$this -> db -> query("INSERT INTO `tbl_manager_remark`(`remark`, `user_id`, `lead_id`, `created_date`) VALUES ('$remark','$user_id','$enq_id','$today')");
		$remark_id = $this->db->insert_id();
		$update1 = $this -> db -> query("update lead_master set remark_id='$remark_id' where enq_id='$enq_id'");
		
	}	
public function insert_additional_info()
{
	$today=date('Y-m-d');
	$make=$this->input->post('make');
	$model=$this->input->post('model');
	$color=$this->input->post('color');
	$ownership=$this->input->post('ownership');
	$mfg=$this->input->post('mfg');
	$km=$this->input->post('km');
	$claim=$this->input->post('claim');
	$buyer_type=$this->input->post('buyer_type');
	$enq_id=$this->input->post('enq_id');
	$query=$this->db->query("select info_id from tbl_additional_car_info where lead_id='$enq_id' and car_make='$make' and car_model='$model'")->result();
	
	if(count($query)==0)
	{
	$query=$this->db->query("INSERT INTO tbl_additional_car_info(lead_id, buyer_type,car_make, car_model, color, ownership, mfg_year,km,claim,created_date) VALUES ('$enq_id','$buyer_type','$make','$model','$color','$ownership','$mfg','$km','$claim','$today')");
	}
}
public function select_additional_info($enq_id)
{
	$this->db->select("m1.model_name,m.make_name");
	$this->db->from("tbl_additional_car_info a");
	$this->db->join("makes m",'a.car_make=m.make_id');
	$this->db->join("make_models m1",'a.car_model=m1.model_id');
	
	
	$this->db->where('lead_id',$enq_id);
	$query = $this -> db -> get();
		return $query -> result();
}
}
?>
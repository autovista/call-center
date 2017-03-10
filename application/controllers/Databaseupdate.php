<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Databaseupdate extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}

	function index() {
		echo "query  comment";
		/*
		 $q=$this->db->query('select enq_id from lead_master order by enq_id desc limit 10000')->result();
		 foreach($q as $row)
		 {
		 echo "<br>";
		 echo "enq_id=";
		 echo $enq_id=$row->enq_id;
		 $q1=$this->db->query("select id from lead_followup where leadid='$enq_id' order by id desc limit 1")->result();
		 {
		 if(count($q1)>0)
		 {
		 echo "followup=";
		 echo $id=$q1[0]->id;
		 $this->db->query("update lead_master set followup_id='$id' where enq_id='$enq_id'");
		 }
		 }
		 }*/

	}

	function addRecords() {

		/*	$query2 = $this->db->query("INSERT INTO lead_master(lead_source,manual_lead,name,address,email,contact_no,enquiry_for,enquiry_source,page_path,status,model_id,reg_no,fuel_type,loan_amnt,make_id,manf_year,variant_id,buy_status,engine_no,chasis_no,reg_date,km,old_make,old_model,color,accidental_claim,insurance_no,insurance_date,new_car_customer_name,new_car_customer_mobile_no,comment,pick_up_date,assignby,assign_to_telecaller,created_date,created_time)
		 SELECT                      lead_source,manual_lead,name,address,email,contact_no,enquiry_for,enquiry_source,page_path,status,model_id,reg_no,fuel_type,loan_amnt,make_id,manf_year,variant_id,buy_status,engine_no,chasis_no,reg_date,km,old_make,old_model,color,accidental_claim,insurance_no,insurance_date,new_car_customer_name,new_car_customer_mobile_no,comment,pick_up_date,assignby,assign_to_telecaller,created_date,created_time
		 FROM lead_masterdemo  order by enq_id desc limit 10");*/

		/*$query = mysql_query("select contact_no from lead_master where enq_id='$id' ") or die(mysql_error());

		 $fetch = mysql_fetch_array($query);

		 $contact_no = $fetch['contact_no'];

		 echo $location = $_GET['loc'];

		 $query1 = mysql_query("select count(contact_no) as count from lead_master where contact_no='$contact_no' ") or die(mysql_error());

		 $fetch1 = mysql_fetch_array($query1);
		 $fetch1['count'];
		 $count = $fetch1['count'];

		 if ($count > 1) {

		 $fetch = mysql_fetch_array($query2);

		 $query2 = mysql_query("INSERT INTO lead_master1(enq_id,facebook,lead_source,manual_lead,fb_id,form_id,name,address,email,contact_no,lead_id,enquiry_for,enquiry_source,page_path,assigned_to,assigned_on,updated_on,status,followup_reason,model_id,reg_no,fuel_type,loan_amnt,booking_amount,make_id,manf_year,refname,variant_id,add_date,evaluation_sheet_sr_no,stock_location,buy_status,engine_no,chasis_no,reg_date,current_milage,ownership,km,quoted_price,difference_price,insurance_company,insurance_type,car_loan,exchange,old_make,old_model,color,accidental_claim,insurance_no,insurance_date,new_car_customer_name,new_car_customer_mobile_no,source_of_sale,stock_status,sales_dsename,other_variant,service_date,comment,message,test_drive_date,assignto,location,package_type,package_price,pick_up_date,followupby,assignby,assign_to_telecaller,created_date,str_to_time_created_date,created_time)
		 SELECT enq_id,facebook,lead_source,manual_lead,fb_id,form_id,name,address,email,contact_no,lead_id,enquiry_for,enquiry_source,page_path,assigned_to,assigned_on,updated_on,status,followup_reason,model_id,reg_no,fuel_type,loan_amnt,booking_amount,make_id,manf_year,refname,variant_id,add_date,evaluation_sheet_sr_no,stock_location,buy_status,engine_no,chasis_no,reg_date,current_milage,ownership,km,quoted_price,difference_price,insurance_company,insurance_type,car_loan,exchange,old_make,old_model,color,accidental_claim,insurance_no,insurance_date,new_car_customer_name,new_car_customer_mobile_no,source_of_sale,stock_status,sales_dsename,other_variant,service_date,comment,message,test_drive_date,assignto,location,package_type,package_price,pick_up_date,followupby,assignby,assign_to_telecaller,created_date,str_to_time_created_date,created_time
		 FROM lead_master WHERE enq_id = '$id'");

		 $del = mysql_query("delete from lead_master where enq_id='$id'") or die(mysql_error());

		 } else {
		 echo "<script>alert('No Duplicate records found');</script>";

		 }*/
	}

	function updateConvertLostRecords() {
		
		$q = $this -> db -> query('select enq_id,status_name from lead_master l join tbl_status s on s.status_id=l.status where (s.status_name="Lost" or s.status_name="Convert")and s.process_id=3 order by enq_id desc') -> result();
		foreach ($q as $row) {
			echo $enq_id = $row -> enq_id;
			echo "<br>";
			$this -> db -> query("INSERT INTO lead_master_lc(enq_id,followup_id,remark_id,transfer_id,lead_source,manual_lead,name,address,email,contact_no,enquiry_for,enquiry_source,page_path,status,disposition,model_id,variant_id,buy_status,buyer_type,location,comment,assignby,assign_to_telecaller,created_date,created_time,assign_date,old_make,old_model,color,manf_year,ownership,km,accidental_claim,package_type,pick_up_date,package_price,reg_no,fuel_type,loan_amnt,make_id,refname,add_date,evaluation_sheet_sr_no,stock_location,	engine_no,	chasis_no,reg_date,current_milage,quoted_price,difference_price,insurance_company,insurance_type,car_loan,insurance_no,insurance_date,new_car_customer_name,new_car_customer_mobile_no,service_date)
						SELECT enq_id,followup_id,remark_id,transfer_id,lead_source,manual_lead,name,address,email,contact_no,enquiry_for,enquiry_source,page_path,status,disposition,model_id,variant_id,buy_status,buyer_type,location,comment,assignby,assign_to_telecaller,created_date,created_time,assign_date,old_make,old_model,color,manf_year,ownership,km,accidental_claim,package_type,pick_up_date,package_price,reg_no,fuel_type,loan_amnt,make_id,refname,add_date,evaluation_sheet_sr_no,stock_location,	engine_no,	chasis_no,reg_date,current_milage,quoted_price,difference_price,insurance_company,insurance_type,car_loan,insurance_no,insurance_date,new_car_customer_name,new_car_customer_mobile_no,service_date
				FROM lead_master WHERE enq_id = '$enq_id'");
			$this->db->query("delete from lead_master where enq_id='$enq_id'");	
			$q1 = $this -> db -> query('select id from lead_followup where leadid="' . $enq_id . '"') -> result();
			foreach ($q1 as $row1) {
				echo "-";
				echo $id = $row1 -> id;
				echo "<br>";
				$this -> db -> query("INSERT INTO lead_followup_lc(id,leadid,activity,comment,nextfollowupdate,nextfollowuptime,contactibility,	assign_to,disposition,	transfer_reason,date,created_time)
						SELECT id,leadid,activity,comment,nextfollowupdate,nextfollowuptime,contactibility,	assign_to,disposition,	transfer_reason,date,created_time
				FROM lead_followup WHERE id = '$id'");
				$this->db->query("delete from lead_followup where id='$id'");	
			}

		}

	}

}
?>
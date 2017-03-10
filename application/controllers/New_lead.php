<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class new_lead extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
		$this->load->model('new_lead_model');
		$this->load->model('website_lead_model');
		
	}
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	public function index()
	{
		
		$this->session();
	
		 $data['enq']='New';
		 	//For Insert Followup Details
		$data['select_campaign']=$this->website_lead_model->select_campaign();
		$data['select_model']=$this->website_lead_model->select_model();
		$data['select_all_model']=$this->website_lead_model->select_all_model();
		$data['select_make']=$this->website_lead_model->select_make();
		$data['select_variant']=$this->website_lead_model->select_variant_new();
		$data['get_location1']=$this->website_lead_model->select_location();
		$data['select_group']=$this->website_lead_model->select_group();
		$data['select_assign_to']=$this->website_lead_model->select_telecaller();	
		$data['select_status']=$this->website_lead_model->select_status();
		//get New leads details				
		$data['select_lead']=$this->new_lead_model->select_lead();
	//	print_r($data['select_lead']);
		$this->load->view('include/admin_header.php');
		$this->load->view('telecaller_lms_view.php',$data);
		$this->load->view('include/footer.php');
	} 
} 
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transfer_report extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
		$this->load->model('transfer_report_model');
		
	}
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	public function index()
	{
		$this->session();
		$data['select_transfer_lead']=$this->transfer_report_model->select_transfer_lead();
		$data['telecaller_transfer_from']=$this->transfer_report_model->telecaller_transfer_from();
		$data['telecaller_transfer_to']=$this->transfer_report_model->telecaller_transfer_to();
		$data['select_status']=$this->transfer_report_model->select_status();		
		//$data['select_transfer_lead1']=$this->transfer_report_model->select_transfer_lead1();
			$data['select_transfer_lead_lc']=$this->transfer_report_model->select_transfer_lead_lc();
		$this->load->view('include/admin_header.php');			
		$this->load->view('transfer_lead_top_tab_view.php',$data);
		$this->load->view('transfer_report_view.php',$data);
		//$this->load->view('include/footer.php');
	}
	public function tl_filter()
	{
		$this->session();
		$data['select_transfer_lead']=$this->transfer_report_model->select_transfer_lead();
			$data['select_transfer_lead_lc']=$this->transfer_report_model->select_transfer_lead_lc();
			$this->load->view('transfer_report__filter_view.php',$data);
	
		


			}
			}
		?>
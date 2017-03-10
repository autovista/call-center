<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
		$this->load->model('change_password_model');
		
	}
		
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	
	public function index() 
	{

		$data['var']=site_url('change_password/change_pwd');
		$this->load->view('include/admin_header.php');
		$this -> load -> view('change_password_view.php',$data);
		$this->load->view('include/footer.php');
	
	}
	
	public function change_pwd()
	
	{
		$this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    Please Enter Correct Old Password.
  </div>');

		
		$old_pwd=$this->input->post('old_pwd');
		$new_pwd=$this->input->post('new_pwd');
		$c_pwd=$this->input->post('c_pwd');
		$query=$this->change_password_model->change_pwd($old_pwd,$new_pwd,$c_pwd);
		redirect("change_password");
	
		
		
	}
	
	
	
	
	
	

}
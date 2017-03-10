<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_reason_followup extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
		$this->load->model('add_reason_followup_model');
		
	}
		
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	
	public function index() 
	{

		$query1=$this->add_reason_followup_model->select_table();
	$data['select_table']=$query1;
	
	
		//$query=$this->add_user_model->select_dept();
		//$data['select_dept']=$query;
		
		$data['var']=site_url('add_reason_followup/add_reason');
		$this->load->view('include/admin_header.php');
		$this -> load -> view('add_reason_followup_view.php',$data);
		$this->load->view('include/footer.php');
	
	}
	
	public function add_reason()
	{
	
		$reason_name=$this->input->post('reason_name');
		
	$query=$this->add_reason_followup_model->add_reason($reason_name);
		redirect('add_reason_followup');

		
	}
	
	public function edit_reason()
	{
	
		$reason_id=$this->input->get('id');
		$query=$this->add_reason_followup_model->edit_reason($reason_id);
		$data['select_table']=$query;
		
		
	
	
	
		$data['var1']=site_url('add_reason_followup/update_reason');
		$this->load->view('include/admin_header.php');
		$this -> load -> view('edit_reason_view',$data);
		$this -> load -> view('include/footer');
	
	

		
	}
	
	public function update_reason()
	{
	
	echo $id= $this->input->post('id');
	echo $reason_name=$this->input->post('reason_name');
	$this->add_reason_followup_model->update_reason($reason_name,$id);
	
	redirect('add_reason_followup');
		
		
	}
	
	function del_reason()
	{
	
	$id= $this->input->get('id');
	
	
	$q=$this->add_reason_followup_model->del_reason($id);
	
	redirect('add_reason_followup');
	}
	
	
	
}
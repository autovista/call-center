<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_dept extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
		$this->load->model('add_dept_model');
		
	}
		
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	
	public function index() 
	{
		$this->session();
		$query1=$this->add_dept_model->select_table();
		$data['select_table']=$query1;
	
	
		//$query=$this->add_user_model->select_dept();
		//$data['select_dept']=$query;
		
		$data['var']=site_url('add_dept/add_department');
		$this->load->view('include/admin_header.php');
		$this -> load -> view('add_dept_view.php',$data);
		$this->load->view('include/footer.php');
	
	}
	
	public function add_department()
	{
		
		$dept_name=$this->input->post('dept_name');
		$query=$this->add_dept_model->add_department($dept_name);
		redirect('add_dept');

		
	}
	
	public function edit_dept()
	{
		
		$this->session();
		$id=$this->input->get('id');
		
		$query=$this->add_dept_model->edit_dept($id);
		$data['select_dept']=$query;
		$data['var1']=site_url('add_dept/update_dept');
		$this->load->view('include/admin_header.php');
		$this -> load -> view('edit_dept_view',$data);
		$this -> load -> view('include/footer');
		
	

		
	}
	
	function update_dept()
	{
	
	$id= $this->input->post('id');
	$dept_name=$this->input->post('dept_name');
	
	$q=$this->add_dept_model->update_dept($dept_name,$id);
	
	redirect('add_dept');
	}
		
	
	function del_dept()
	{
	
	$id= $this->input->get('id');
	
	
	$q=$this->add_dept_model->del_dept($id);
	
	redirect('add_dept');
	}
	public function model_test()
	{
		
		
		
		$this -> load -> view('model_test.php');
		
	

		
	}
	
	
}
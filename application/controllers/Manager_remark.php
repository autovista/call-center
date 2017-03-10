<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class manager_remark extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
		$this->load->model('manager_remark_model');
		
	}
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
		
	public function leads($id,$location)
	{
		
		
	$data['select_lead']=$this->manager_remark_model->select_lead($id);
		$data['select_remark']=$this->manager_remark_model->select_remark($id);
		$data['location']=$location;
		$data['id']=$id;
		$data['var']=site_url().'manager_remark/insert_remark';
			$this->load->view('include/admin_header.php');
		$this->load->view('add_remark_view.php',$data);
		$this->load->view('include/footer.php');

	
	}
	public function insert_remark()
	{
		$this->manager_remark_model->insert_remark();
		if($this->input->post('location')=='Website')
		{
			redirect('website_leads/team_leader_leads/All');
		}
	}
	
	
}
?>
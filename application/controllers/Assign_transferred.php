<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Assign_transferred extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('assign_transferred_model');
		date_default_timezone_set("Asia/Kolkata");

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}

	public function index() {
		$this -> session();
		$groupWiseCond=$this -> assign_transferred_model -> checkUserCountRights();	
		$data['location'] = $this -> assign_transferred_model -> location();
		$data['all_count'] = $this -> assign_transferred_model -> all_count();
		$data['campaign_name'] = $this -> assign_transferred_model -> campaign_name();
		//$data['var'] = site_url('assign_leads/assigned');
		$data['var1'] = site_url('assign_transferred/assigned1');
		//$data['var1'] =site_url('assign_leads/test');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('assign_transferred_leads_view.php', $data);
		$this -> load -> view('include/footer.php');
	}
		function assigned1() {
		
		$this -> session();
		$groupWiseCond=$this -> assign_transferred_model -> checkUserCountRights();
		//$query=$this -> assign_leads_model -> assigned1($groupWiseCond);
		$query=$this -> assign_transferred_model -> assign_data();
		
		if(!$query)
		{
			 $this -> session -> set_flashdata('msg', '<div class="alert alert-success text-center">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Lead assigned successfully ...!</strong>');

		}else{
			$this -> session -> set_flashdata('msg', '<div class="alert alert-danger text-center">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Lead can not assign successfully ...!</strong>');
			
		}
		redirect('assign_transferred');
	}
}
?>
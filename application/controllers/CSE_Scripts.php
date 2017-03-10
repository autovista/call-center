<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CSE_Scripts extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		//$this -> load -> model('assign_leads_model');
		date_default_timezone_set("Asia/Kolkata");

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}

	public function index() {
			
		$this -> session();
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('CSE_Scripts_view.php');
		$this -> load -> view('include/footer.php');
	}
	
	

	

}
?>
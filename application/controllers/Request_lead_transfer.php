<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_lead_transfer extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('request_lead_transfer_model');

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	
	

	public function index() {
		$this -> session();
		$data['select_lead'] = $this -> request_lead_transfer_model -> select_transfer_lead();
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('request_to_lead_transfer_view.php', $data);
		$this -> load -> view('include/footer.php');
	}

}
?>
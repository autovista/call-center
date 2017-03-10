<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class remove_duplicate extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('remove_duplicate_model');

	}
	
	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	
	public function leads($id, $location) {

		$this -> remove_duplicate_model -> select_lead($id);
		if ($location == 'Website') {
			redirect('website_leads/telecaller_leads/All');
		} 
		elseif($location=='facebook')
		{
			redirect('facebook_leads/telecaller_lead/All');
		}
		elseif($location=='excel')
		{
			redirect('excel_leads/telecaller_leads');
		}
		else if ($location == 'pending_attended') {
			redirect('pending/telecaller_leads');
		} 
		else if ($location == 'pending')
		{
		redirect('pending/telecaller_leads_not_attended');
		}
		
		else {
			redirect($location);
		}
	}
}
?>
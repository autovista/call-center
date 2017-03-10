<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_status extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('add_status_model');

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}

	public function index() {

		$this -> session();
		$query1 = $this -> add_status_model -> select_status();
		$data['select_status'] = $query1;
		/*$query2 = $this -> add_status_model -> select_grp();
		$data['select_grp'] = $query2;*/
		$data['select_process'] = $this -> add_status_model -> select_process();
		$data['var'] = site_url('add_status/add');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('add_status_view.php', $data);
		$this -> load -> view('include/footer.php');

	}

	public function add() {
		$status = $this -> input -> post('status');
		$process_id = $this -> input -> post('process_id');
		$query = $this -> add_status_model -> add_status($status, $process_id);
		redirect('add_status');

	}

	public function edit_status($status_id) {

		$query1 = $this -> add_status_model -> select_status_id($status_id);
		$data['select_status_id'] = $query1;
		$data['select_process'] = $this -> add_status_model -> select_process();
		$data['var'] = site_url('add_status/update_status');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('edit_status_view', $data);
		$this -> load -> view('include/footer');

	}

	public function update_status() {

		$status_id = $this -> input -> post('id');
		$status_name = $this -> input -> post('status');
		$process_id = $this -> input -> post('process_id');
		$q = $this -> add_status_model -> update_status($status_id, $status_name, $process_id);
		redirect('add_status');

	}

	public function delete_status($status_id) {

		$q = $this -> add_status_model -> delete_status($status_id);
		redirect('add_status');

	}

}

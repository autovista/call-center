<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_right extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('add_rights_model');

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}

	public function index() {
		$this -> session();
		$data['select_user'] = $this -> add_rights_model -> select_user();
		$data['select_rights_user'] = $this -> add_rights_model -> select_rights_user();
	//	print_r($data['select_rights_user']);
		$data['select_data'] = $this -> add_rights_model -> select_data();
		$data['var'] = site_url('add_right/insert_rights');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('add_rights_view.php', $data);
		$this -> load -> view('include/footer.php');

	}

	public function insert_rights() {
		$this -> add_rights_model -> insert_right();
		redirect('add_right');
	}

	public function edit_right($id) {
		$this -> session();
		$data['select_right_data'] = $this -> add_rights_model -> select_right_data($id);
		//print_r($data['select_right_data']);
		$data['var'] = site_url('add_right/delete_rights');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('edit_rights.php', $data);
		$this -> load -> view('include/footer.php');
	}

	public function delete_rights() {
		$this -> add_rights_model -> delete_rights();
		redirect('add_right');
	}

	public function delete_all_rights($id) {
		$this -> add_rights_model -> delete_all_rights($id);
		redirect('add_right');
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper('form');
		$this -> load -> helper('url');
		$this -> load -> model('login_model');
		date_default_timezone_set('Asia/Kolkata');
		$CI = &get_instance();
		$this -> db2 = $CI -> load -> database('db2', TRUE);
	}

	public function index() {
		$data['var'] = site_url('login/login_form1');
		$this -> load -> view('login_view.php', $data);
	}

	public function test12() {
		$data['var'] = site_url('login/login_form1');
		$this -> load -> view('login_view.php', $data);
	}

	public function login_form() {
		$username = $this -> input -> post('username');
		$password = $this -> input -> post('password');

		$query = $this -> login_model -> form_submit($username, $password);
		if (count($query) == 1) {
			$id = $query[0] -> id;
			$location = $query[0] -> location;
			$role = $query[0] -> role;
			$department = $query[0] -> department;
			$fname = $query[0] -> fname;
			$lname = $query[0] -> lname;
			$username = $fname . ' ' . $lname;
			$this -> session -> set_userdata('user_id', $id);
			$this -> session -> set_userdata('role', $role);
			$this -> session -> set_userdata('department', $department);
			$this -> session -> set_userdata('username', $username);
			$this -> session -> set_userdata('location', $location);
			if ($role == '1' || $role == '2') {
				redirect('dashboard/admin');
			} else {
				redirect('dashboard/telecaller');
			}

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong>Error...!</strong> pls Check UserId Or password..</div>');
			redirect('login');
		}

	}

	public function login_form1() {
		$username = $this -> input -> post('username');
		$password = $this -> input -> post('password');

		$query = $this -> login_model -> form_submit1($username, $password);

		if (count($query) == 1) {
			$id = $query[0] -> id;
			$process_id = $query[0] -> process_id;
			$fname = $query[0] -> fname;
			$lname = $query[0] -> lname;
			$username = $fname . ' ' . $lname;
			$this -> session -> set_userdata('user_id', $id);
			$this -> session -> set_userdata('process_id', $process_id);
			$this -> session -> set_userdata('username', $username);
			$this -> session -> set_userdata('location', $query[0] -> location);
			$this -> session -> set_userdata('role', $query[0] -> role);

			$query1 = $this -> login_model -> update_status($id, $process_id);
			$this -> session -> set_userdata('process_name', $query1[0] -> process_name);

			$query2 = $this -> login_model -> select_user_group($id);
			$this -> session -> set_userdata('group_id', $query2[0] -> group_id);

			//Set Rights in session
			$get_rights = $this -> login_model -> get_right($id);
			if (count($get_rights) > 0) {
				foreach ($get_rights as $row) {
					$form_name1[] = $row -> form_name;
					$controller_name1[] = $row -> controller_name;
					$view1[] = $row -> view;
					$insert1[] = $row -> insert;
					$modify1[] = $row -> modify;
					$delete1[] = $row -> delete;

				}
				//print_r($form_name1);
				$_SESSION['form_name'] = $form_name1;
				$_SESSION['controller_name'] = $controller_name1;
				$_SESSION['view'] = $view1;
				$_SESSION['insert'] = $insert1;
				$_SESSION['modify'] = $modify1;
				$_SESSION['delete'] = $delete1;

				if ($_SESSION['role'] == '1') {
					redirect('dashboard/admin');
				} else if ($_SESSION['role'] == '2') {
					redirect('dashboard/admin');
				} else  {
					redirect('dashboard/telecaller');
				} 
			} else {
				$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong>Error...!</strong> Please Contact to Admin.</div>');
				redirect('login');
			}
		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger"><strong>Error...!</strong> please Check UserId Or password..</div>');
			redirect('login');
		}

	}

	function logout() {
		//$this->login_model->change_status();
		$this -> session -> unset_userdata($var);
		$this -> session -> sess_destroy();
		redirect('login');

	}

	function logout1() {

		$this -> login_model -> change_status();
		//	$this -> session -> unset_userdata($var);
		$this -> session -> sess_destroy();
		redirect('login');

	}

}

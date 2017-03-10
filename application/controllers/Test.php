<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class test extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('pending_model');

	}


	public function index() {
		$data['select_lead']=$this->pending_model->select_lead1();
		
		$this->load->view('include/telecaller_header.php');
				$this->load->view('telecaller_top_tab_view.php');
		//	$this -> load -> view('include/test_theam.php');
			$this -> load -> view('test_theam.php',$data);
	}
	/*public function test_data()
	{
		$Mixed = array("1","2","3");
		 $Text = json_encode($Mixed); 
		 $RequestText = urlencode($Text); 

		$test = array(1,2,3,4); 
	echo "<a href=".site_url()."test/testvar/?cluster=".$RequestText.">Test</a>"; 
  error_reporting(E_ALL); 

	}
	public function testvar()
	{
		$Text = urldecode($_GET['cluster']); 
		$Mixed = json_decode($Text); 
		print_r( $Mixed); 
		
	}
	*/
	}
?>
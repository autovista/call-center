<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_group extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('table','form_validation','session'));
		$this->load->helper(array('form','url'));
				
		$this->load->model('add_group_model');
		
		
	}
	
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
		}
 public function index()
{
	
	$this->session();
	$query1=$this->add_group_model->select_grp();
	$data['select_grp']=$query1;

	$query2=$this->add_group_model->select_process();
	$data['select_process']=$query2;



	$data['var']=site_url('add_group/add_group');
	$this->load->view('include/admin_header.php');
	$this->load->view('add_group_view.php',$data);
	$this->load->view('include/footer.php');
	
	
} 	

public function add_group()

{
	 $group_name=$this->input->post('grp_name');
	 $process_id=$this->input->post('process_name');
	
	
	
	//echo ($group_name);

	$query=$this->add_group_model->add_group($group_name,$process_id);
	redirect('add_group');
	
	
	
	
}


public function edit_grp()

{
	$this->session();
	$id=$this->input->get('id');
	
	//echo $group_id;
//	$group_name=$this->input->post('grp_name');
	
	$query=$this->add_group_model->edit_grp($id);
	$data['select_grp']=$query;
		
		
		$query2=$this->add_group_model->select_process();
		$data['select_process']=$query2;
		
		
		$data['var1']=site_url('add_group/update_grp');
		$this->load->view('include/admin_header.php');
		$this -> load -> view('edit_grp_view',$data);
		$this -> load -> view('include/footer');
		
	
	
}

public function update_grp()

{
	
	$group_id=$this->input->post('id');
	$grp_name=$this->input->post('grp_name');
 	 $process_id=$this->input->post('process_id');
	
	
	$q=$this->add_group_model->update_grp($group_id,$grp_name,$process_id);
	

	
	redirect('add_group');
	
	
}



public function del_grp()

{
	
	
	$id=$this->input->get('id');
	//echo $id;
	
	$q=$this->add_group_model->del_grp($id);
	
		
	redirect('add_group');
	
}


}
?>
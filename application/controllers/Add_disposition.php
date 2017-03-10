<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_disposition extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('add_disposition_model');

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}

	public function index() {
		
		$this->session();
		$query1 = $this -> add_disposition_model -> select_table();
		$data['select_table'] = $query1;
		//$query2=$this->add_disposition_model->select_grp();
		//$data['select_grp']=$query2;
		/*$query3=$this->add_disposition_model->select_status1();
		 $data['select_status1']=$query3;*/
		$data['select_process'] = $this -> add_disposition_model -> select_process();
		$data['var'] = site_url('add_disposition/add_disp');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('add_disposition_view.php', $data);
		$this -> load -> view('include/footer.php');

	}

	public function add_disp() {

		$process_id = $this -> input -> post('process_id');
		// view.php form element
		$disposition_name = $this -> input -> post('disposition_name');
		//view.php form element
		$lead = $this -> input -> post('lead');
		//view.php form element
		$query = $this -> add_disposition_model -> add_department($disposition_name, $lead, $process_id);
		//pass these value to
		redirect('add_disposition');

	}

	public function edit_dispos() {

		$this->session();
		$id = $this -> input -> get('id');
		$query = $this -> add_disposition_model -> edit_dispos($id);
		$data['select_dipos'] = $query;
		$process_id = $query[0] -> process_id;
		$data['select_process'] = $this -> add_disposition_model -> select_process();
		$query3 = $this -> add_disposition_model -> select_status2($process_id);
		$data['select_status1'] = $query3;
		$data['var1'] = site_url('add_disposition/update_dispos');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('edit_disposition_view', $data);
		$this -> load -> view('include/footer');

	}

	function update_dispos() {

		$id = $this -> input -> post('id');
		$dispostion_name = $this -> input -> post('disposition_name');
		$process_id = $this -> input -> post('process_id');
		$lead = $this -> input -> post('lead');
		$q = $this -> add_disposition_model -> update_dispos($dispostion_name, $id, $process_id, $lead);
		redirect('add_disposition');
	}
	public function select_status()	{
			
		$process_id=$this->input->post('process_id');			
		$query=$this->add_disposition_model->select_status($process_id);
		$data['select_status']=$query;	
		//print_r($query);		
		?>         	                  
			<select class="filter_s form-control" id="status" name="lead" required>
				<option value="">Please Select</option>
				<?php foreach($query as $fetch) {			?>	
				<option value="<?php echo $fetch->status_id;?>"><?php echo $fetch->status_name;?></option>
	            <?php } ?>
	         </select>
		<?php		
		
	}
	function del_dispos() {
		
		$id = $this -> input -> get('id');
		$q = $this -> add_disposition_model -> del_dispos($id);
		redirect('add_disposition');
	}

}

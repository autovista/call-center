<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_lms_user extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('add_user_model');

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}

	public function index() {
		$this -> session();
		$query1 = $this -> add_user_model -> select_table();
		$data['select_table'] = $query1;
		$data['select_process'] = $this -> add_user_model -> select_process();
		$data['select_location'] = $this -> add_user_model -> select_location();		
		$data['var'] = site_url('add_lms_user/add_user');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('add_lms_user_view.php', $data);
		$this -> load -> view('include/footer.php');

	}

	public function add_user() {

		$fname = $this -> input -> post('fname');
		$lname = $this -> input -> post('lname');
		$email = $this -> input -> post('email');
		$pnum = $this -> input -> post('pnum');

		$location = $this -> input -> post('location');
		$role1 = $this -> input -> post('role');
		$role2=explode('#',$role1);
		echo $role=$role2[0];
		echo $role_name=$role2[1];
		$process_id = $this -> input -> post('process_id');
		$group_id = $this -> input -> post('group_id');
		$date = date('Y/m/d');
		//$password = rand(0, 10000);
		$password ='autovista';
		$query = $this -> add_user_model -> add_user($fname, $lname, $email, $pnum, $location, $role, $date, $password, $process_id, $group_id,$role_name);
		$data['email'] = $email;
		$data['password'] = $password;
		$config = Array('mailtype' => 'html');
		$this -> load -> library('email', $config);
		$this -> email -> from('info@autovista.in', 'Admin');
		$this -> email -> to($email);
		$this -> email -> subject('LMS User Details');
		$body = $this -> load -> view('send_mail_view.php', $data, TRUE);
		$this -> email -> message($body);
		$this -> email -> send();
		redirect('add_lms_user');

	}

	public function get_group_name(){
					
		$process_id=$this->input->post('process_id');		
		$select_group =$this->add_user_model->select_group($process_id);
		if(count($select_group)>0)
		{			
					
		?>	
			<label class="control-label col-md-2 col-sm-2 col-xs-12" >Group Name: </label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<?php foreach ($select_group as $row) {?>
				<label class="checkbox-inline">
					<input type="checkbox"  name="group_id[]" value="<?php echo $row -> group_id; ?>" >
					&nbsp;&nbsp;<?php echo $row -> group_name; ?>
				</label>
				<?php } ?>
			</div>
	
		<?php 
		}
		else {
			?>
			<label class="control-label col-md-2 col-sm-2 col-xs-12" > </label>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type='hidden' required>
				<label class="control-label" >No Groups Found !! Please Add Group First.</label>
				
			</div>
			<?php
		}
	}
		
	public function edit_user() {
		$this -> session();
		$data['select_process'] = $this -> add_user_model -> select_process();

		$data['select_location'] = $this -> add_user_model -> select_location();

		$data['var1'] = site_url('add_lms_user/update_user');
		$id = $this -> input -> get('id');

		$query = $this -> add_user_model -> edit_user($id);
		//print_r($query);
		$data['edit_user'] = $query;
		$data['var1'] = site_url('add_lms_user/update_user');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('edit_user_view', $data);
		$this -> load -> view('include/footer');

	}

	function update_user() {

		$id = $this -> input -> post('id');
		
		$group_id = $this -> input -> post('group_id');
		//print_r($group_id);
		
		$fname = $this -> input -> post('fname');
		$lname = $this -> input -> post('lname');
		$email = $this -> input -> post('email');
		$pnum = $this -> input -> post('pnum');

		$location = $this -> input -> post('location');
		$role1 = $this -> input -> post('role');
		$role2=explode('#',$role1);
		echo $role=$role2[0];
		echo $role_name=$role2[1];
		$process_id = $this -> input -> post('process_id');

		$q = $this -> add_user_model -> update_user($fname, $lname, $email, $pnum, $process_id, $location, $role, $id,$group_id,$role_name);
	
	redirect('add_lms_user');
	}

	function delete_user() {
		$q = $this -> add_user_model -> delete_user();
		redirect('add_lms_user');
	}

}
?>
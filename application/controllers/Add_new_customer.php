<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class add_new_customer extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('add_new_customer_model');

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}

	public function index() {
		$this->session();
		$query = $this -> add_new_customer_model -> select_customer();
		$data['select_customer'] = $query;
		$data['select_location'] = $this -> add_new_customer_model -> select_location();
	/*	$query = $this -> add_new_customer_model -> select_user();
		$data['select_user'] = $query;*/

		$data['var'] = site_url('add_new_customer/add_customer');
		/*if ($_SESSION['role'] == 1) {
			$this -> load -> view('include/admin_header.php');
		} else if ($_SESSION['role'] == 2) {
			$this -> load -> view('include/team_leader_header.php');
		} else {
			$this -> load -> view('include/telecaller_header.php');
		}*/
		$this -> load -> view('include/admin_header.php');	
		$this -> load -> view('add_new_customer_view.php', $data);
		$this -> load -> view('include/footer.php');

	}

	public function add_customer() {

		$fname = $this -> input -> post('fname');
		$lname = $this -> input -> post('lname');

		$email = $this -> input -> post('email');
		$address = $this -> input -> post('address');
		$assign = $this -> input -> post('assign');

		$pnum = $this -> input -> post('pnum');
		//$location = $this -> input -> post('location');
		$comment = $this -> input -> post('comment');

		$dept = $this -> input -> post('dept');
		//print_r($dept);
		
		$lead_source = $this -> input -> post('lead_source');
		
		print_r($lead_source);
		
		if($lead_source=='Web')

{
	$lead_source='';
	
}
		$query = $this -> add_new_customer_model -> add_customer($fname, $email, $address, $pnum, $comment, $assign, $dept,$lead_source);
	
	redirect('add_new_customer');
	
	
	}

	public function edit_customer() {

		$id = $this -> input -> get('id');

		//echo $id;

		$query = $this -> add_new_customer_model -> edit_customer($id);
		$data['edit_customer'] = $query;
		$data['select_location'] = $this -> add_new_customer_model -> select_location();
		
		//print_r($query);

		//$query2=$this->add_group_model->select_process();
		//$data['select_process']=$query2;

		$data['var1'] = site_url('add_new_customer/update_grp');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('edit_new_customer_view', $data);
		$this -> load -> view('include/footer');

	}

	public function update_grp() {


		$this -> session();

		$enq_id = $this -> input -> post('enq_id');
		$fname = $this -> input -> post('fname');
		$email = $this -> input -> post('email');
		$pnum = $this -> input -> post('pnum');
		$address = $this -> input -> post('address');
		$location = $this -> input -> post('location');
		 $assign = $this -> input -> post('assign');
		$comment = $this -> input -> post('comment');
		$dept = $this -> input -> post('dept');
		//	print_r($dept);

		$q = $this -> add_new_customer_model -> update_grp($enq_id, $fname, $email, $pnum, $address, $assign, $location, $comment, $dept);

		redirect('add_new_customer');

	}
		function select_cse()
	{
		$location = $this -> input -> post('location');
		
		$select_user=$this->add_new_customer_model->select_user($location);
	
		$select_location = $this -> add_new_customer_model -> select_location1($location);
		?>
		<input type='hidden' name='location' value='<?php echo $select_location[0] -> location; ?>'>
			<div class="form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12" >Assign To: </label>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<select name="assign" id="assign" class="form-control" required >
										
											
							                      <option   value=""> Please Select </option>
							                      <?php
													foreach($select_user as $fetch)
													{
														?>
											<option value="<?php echo $fetch -> id; ?>"><?php echo $fetch -> fname; ?><?php " "?> <?php echo $fetch -> lname; ?></option>
                   	<?php } ?>
                   	</select>
									</div>
								</div>
	
	<?php
	}

	function select_loc()
	{

	$location = $this -> input -> post('location');

	$select_user=$this->add_new_customer_model->select_user($location);
		?>
		
		
									
										<select name="assign" id="assign" class="form-control" required>
										
											
							                      <option   value=""> Please Select </option>
							                      <?php
													foreach($select_user as $fetch)
													{
														?>
											<option value="<?php echo $fetch -> id; ?>"><?php echo $fetch -> fname; ?><?php " "?> <?php echo $fetch -> lname; ?></option>
                   	<?php } ?>
                 </select>
									
								
	
	<?php
	}

	public function del_customer() {

	$this -> session();
	$enq_id = $this -> input -> get('id');

	//echo $enq_id;

	$q = $this -> add_new_customer_model -> del_customer($enq_id);

	redirect('add_new_customer');

	}

	}
?>

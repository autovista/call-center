<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class website_leads extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
		$this->load->model('website_lead_model');
		
	}
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
		
	public function telecaller_leads($enq)
	{
		$this->session();
		 $data['enq']=$enq;
		 
		$data['select_lead']=$this->website_lead_model->select_lead($enq);
		$data['select_status']=$this->website_lead_model->select_status();
		//print_r($data['select_status']);
		$data['select_status1']=$this->website_lead_model->select_status1();
		$data['select_campaign']=$this->website_lead_model->select_campaign();
		$data['select_model']=$this->website_lead_model->select_model();
		$data['select_all_model']=$this->website_lead_model->select_all_model();
		$data['select_make']=$this->website_lead_model->select_make();
		$data['select_variant']=$this->website_lead_model->select_variant_new();
		$data['get_location1']=$this->website_lead_model->select_location();
		$data['select_group']=$this->website_lead_model->select_group();
		$data['select_assign_to']=$this->website_lead_model->select_telecaller();				
		$this->load->view('include/admin_header.php');
		$this->load->view('telecaller_top_tab_view1.php',$data);
		$this->load->view('telecaller_lms_view.php',$data);
		$this->load->view('include/footer.php');
	}
	public function team_leader_leads($enq)
	{
		$this->session();
		$data['enq']=$enq;
		$data['select_lead']=$this->website_lead_model->select_lead_team_leader($enq);
		$data['select_telecaller']=$this->website_lead_model->select_telecaller();
		$this->load->view('include/admin_header.php');
		$this->load->view('tl_top_tab_view.php',$data);
		$this->load->view('telecaller_lms_view.php',$data);
		$this->load->view('include/footer.php');
	}
	
	public function select_disposition()
	{
		$this->session();
		$status=$this->input->post('status');
		$query=$this->website_lead_model->select_disposition($status);
	?>           
	<div class="form-group">
		<select class="filter_s col-md-12 col-xs-12 form-control" id="disposition1" name="disposition1">
			<option value="">Disposition</option>
			<?php foreach ($query as $fetch) {?>
			<option value="<?php echo $fetch -> disposition_id; ?>"><?php echo $fetch -> disposition_name; ?></option>
            <?php } ?> 	
        </select>
   </div>
 <?php }
		public function select_disposition_filter()
	{
		$this->session();
		$status=$this->input->post('filter_status');
		$query=$this->website_lead_model->select_disposition($status);
	?>           
	<div class="form-group">
		<select class="filter_s col-md-12 col-xs-12 form-control" id="filter_disposition" name="filter_disposition">
			<option value="">Disposition</option>
			<?php foreach ($query as $fetch) {?>
			<option value="<?php echo $fetch -> disposition_id; ?>"><?php echo $fetch -> disposition_name; ?></option>
            <?php } ?> 	
        </select>
   </div>
 <?php }
	public function select_variant()
	{
	$new_model=$this->input->post('new_model');
	$select_variant=$this->website_lead_model->select_variant($new_model);
?>
	<div class="form-group">
		<select class="filter_s col-md-12 col-xs-12 form-control" id="new_variant" name="new_variant" required >
			<option value="">New Car variant</option>
			<?php foreach ($select_variant as $row) {?>
			<option value="<?php echo $row -> variant_id; ?>"><?php echo $row -> variant_name; ?></option>
			<?php } ?>							
		</select>
	</div>
	<?php }
		public function select_model()
		{
		$old_make=$this->input->post('old_make');
		$select_model=$this->website_lead_model->select_model_id($old_make);
	?>
		<select class="filter_s col-md-12 col-xs-12 form-control" id="old_model" name="old_model">
			<option value="">Old Car Model</option>
			<?php foreach ($select_model as $row) {?>
			<option value="<?php echo $row -> model_id; ?>"><?php echo $row -> model_name; ?></option>
			<?php } ?>		
		</select>
<?php }
			public function select_assign_to()
			{
			$location=$this->input->post('tlocation1');
			$select_assign=$this->website_lead_model->lmsuser($location);
		?>
		<select class="filter_s col-md-12 col-xs-12 form-control" id="transfer_assign" name="transfer_assign" required >
			<option value="">Assign Name</option>
			<?php foreach($select_assign as $row){?>
			<option value="<?php echo $row -> id; ?>"><?php echo $row -> fname . ' ' . $row -> lname; ?> </option> 
			<?php } ?>
       </select>
<?php }
		public function lms_details($id,$enq)
		{
		$this->session();
		$enq_id=$id;
		$data['enq']=$enq;
		$data['details']=$this->website_lead_model->lms_details($enq_id);
		$data['followup_detail']=$this->website_lead_model->followup_detail($enq_id);
		$data['remark_detail']=$this->website_lead_model->select_manager_remark($enq_id);
		$data['select_additional_info']=$this->website_lead_model->select_additional_info($enq_id);
		
		$this->load->view('include/admin_header.php');
		$this->load->view('lms_detail_view.php',$data);
		$this->load->view('include/footer.php');
		}
		public function telecaller_filter()
		{
		$this->session();
		 $enq=$this->input->post('enq');
		 if($enq=='')
		 {
		 	 $enq='All';
		 }
		 $data['enq']=$enq;
		$data['select_lead']=$this->website_lead_model->select_lead($enq);
		//For Insert Followup Details
		$data['select_campaign']=$this->website_lead_model->select_campaign();
		$data['select_model']=$this->website_lead_model->select_model();
		$data['select_all_model']=$this->website_lead_model->select_all_model();
		$data['select_make']=$this->website_lead_model->select_make();
		$data['select_variant']=$this->website_lead_model->select_variant_new();
		$data['get_location1']=$this->website_lead_model->select_location();
		$data['select_group']=$this->website_lead_model->select_group();
		$data['select_assign_to']=$this->website_lead_model->select_telecaller();
		$data['select_status']=$this->website_lead_model->select_status();				
		
		$this->load->view('telecaller_followup_view.php',$data);
	
		 	}
		 	/*public function team_leader_filter()
			{
			$this->session();
			$enq=$this->input->post('enq');
			$select_lead=$this->website_lead_model->select_lead_team_leader($enq);
		?>
		

	<div class="main_container">

		<div id="abc">
			<?php
			$today = date('d-m-Y');
			?>
			
<?php 	$enq=str_replace('%20', ' ', $enq); 
if($enq =='All')
{
	?>
	<h1 style="text-align:center;">Website Leads</h1>
<?php }
		else
		{
	?>
			<h1 style="text-align:center;"><?php echo $enq; ?> Leads</h1>
<?php } ?>
			<div class="table-responsive"  style="overflow-x:auto;">
				<script>
					jQuery(document).ready(function($) {
						var $table1 = jQuery('#table-1');
						// Initialize DataTable
						$table1.DataTable({
							"aLengthMenu" : [[10, 25, 50, -1], [10, 25, 50, "All"]],
							"bStateSave" : true
						});
						// Initalize Select Dropdown after DataTables is created
						$table1.closest('.dataTables_wrapper').find('select').select2({
							minimumResultsForSearch : -1
						});
					});
</script> 
				<table class="table table-bordered datatable table-responsive"" id="table-1">
				<thead>
				<tr>
				<th>Sr No.</th>
				<th>Interested In</th>
				<th>Name</th>
				<th>Contact</th>
				<th>Email</th>
				<th>Lead Date</th>
				<th>Status</th>
				<th>Assign To</th>
				<th>Comment</th>
				<th>Remark</th>
				<th>Action</th>
				<!--<th>Transfer</th>-->

				</tr>
				</thead>
				<tbody>
				<?php
				$i=0;

				foreach($select_lead as $fetch)
				{

				$enq_id=$fetch->enq_id;
				$status = $fetch->status;
				$i++;
				?>
				<tr>
				<td><?php echo $i; ?></td>

				<td><?php echo $fetch -> enquiry_for; ?></td>

				<?php
				$query = $this -> db -> query("select comment from lead_followup where leadid='$enq_id' order by id desc limit 1") -> result();
				?>

				<td><b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?> " title="Customer Follow Up Details"><?php echo $fetch -> name;
	echo "(" . $fetch -> fcount . ")";
 ?> </a></b></td>
				<td><?php echo $fetch -> contact_no; ?></td>
				<td><?php echo $fetch -> email; ?></td>

				<td><?php echo $fetch -> created_date; ?></td>

				<td>
				<?php

				if ($status == 1) {
					echo "Not Yet";
				}

				if ($status == 2) {
					echo "Live";
				}
				if ($status == 3) {
					echo "Postpone";
				}
				if ($status == 4) {
					echo "Lost";
				}
				if ($status == 5) {
					echo "Convert";
				}
				?>

				</td>
				<td>
				<?php
				echo $fetch -> fname . " " . $fetch -> lname;
				?>
				</td>
				<td><?php echo $fetch -> comment; ?></td>
				<td>
				<?php
				if ($fetch -> fcount != 0) {
					echo $query[0] -> comment;
				}
				?>
				</td>

			<td><a href="">Assign </a></td>
				</tr>
				<?php } ?>
				</tbody>

				</table>
				<br />
			</div>
		</div>

		<!-- /page content -->
	</div>


		
<?php 	}*/
public function t($enq)
	{
		$this->session();
		 $data['enq']=$enq;
		 
		$data['select_lead']=$this->website_lead_model->select_lead($enq);
		$data['select_status']=$this->website_lead_model->select_status();
		//print_r($data['select_status']);
		$data['select_campaign']=$this->website_lead_model->select_campaign();
		$data['select_model']=$this->website_lead_model->select_model();
		$data['select_all_model']=$this->website_lead_model->select_all_model();
		$data['select_make']=$this->website_lead_model->select_make();
		$data['select_variant']=$this->website_lead_model->select_variant_new();
		$data['get_location1']=$this->website_lead_model->select_location();
		$data['select_group']=$this->website_lead_model->select_group();
		$data['select_assign_to']=$this->website_lead_model->select_telecaller();				
		$this->load->view('include/admin_header.php');
		$this->load->view('telecaller_top_tab_view1.php',$data);
		$this->load->view('t.php',$data);
		$this->load->view('include/footer.php');
	}

			}
		?>
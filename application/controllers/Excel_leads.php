<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class excel_leads extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
		$this->load->model('excel_lead_model');
		
	}
		
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
		
	public function telecaller_leads()
	{
		$data['select_leads']=$this->excel_lead_model->select_lead();
			
		$this->load->view('include/admin_header.php');
		$this->load->view('telecaller_excel_top_tab_view.php');
		$this->load->view('excel_lead_telecaller_view.php',$data);
		$this->load->view('include/footer.php');
	}
	public function team_leader_leads()
	{
		$data['select_leads']=$this->excel_lead_model->select_tl_lead();
			$data['select_telecaller']=$this->excel_lead_model->select_telecaller();
		
		$this->load->view('include/admin_header.php');
		$this->load->view('tl_excel_top_tab_view.php',$data);
	
		$this->load->view('excel_lead_telecaller_view.php',$data);
		$this->load->view('include/footer.php');
	}
	public function telecaller_filter()
	{
			$select_leads=$this->excel_lead_model->select_lead();
		
		?>
		<div class="row top_tiles">

			<div id="abc">
				<?php
				$today = date('d-m-Y');
				?>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						var $table4 = jQuery("#table-4");
						$table4.DataTable({
							dom : 'Bfrtip',
							buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
						});
					});
				</script>

				<h1 style="text-align:center;">Excel Leads</h1>
				<div  class="table-responsive"  style="overflow-x:auto;">
		<table class="table table-bordered datatable table-responsive"" id="table-4">
					<thead>
					<tr>
					<th>Sr No.</th>
					<th>Interested In</th>
					<th>Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Lead Date</th>
					<th>Status</th>
					<th>Assign By</th>
					<th>Comment</th>
					<th>Remark</th>
					<th>Action</th>
					<!--<th>Transfer</th>-->

					</tr>
					</thead>
					<tbody>
					<?php
					$i=0;

					foreach ($select_leads as $fetch) {

					$enq_id=$fetch->enq_id;
					$i++;
					?>
					<tr>
					<td><?php echo $i; ?></td>

					<td><?php echo $fetch -> enquiry_for; ?></td>

					<td><b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?> " title="Customer Follow Up Details"><?php echo $fetch -> name . '(' . $fetch -> fcount . ')'; ?></a></b></td>
					<td><?php echo $fetch -> contact_no; ?></td>
					<td><?php echo $fetch -> email; ?></td>

					<td><?php echo $fetch -> created_date; ?></td>

					<td>
					<?php $status = $fetch -> status;

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
					<?php /*$assign = $fetch -> assignby;
						 $query3 = mysql_query("select fname,lname from lmsuser where id='$assign'") or die(mysql_error());
						 $fetch3 = mysql_fetch_array($query3);*/

						echo $fetch -> fname . " " . $fetch -> lname;
					?>
					</td>
					<td><?php echo $fetch -> comment; ?></td>
					<td>
					<?php

					$query3 = $this -> db -> query("select comment from lead_followup where leadid='$enq_id'  order by id desc limit 1") -> result();
					if ($fetch -> fcount != 0) {
						echo $query3[0] -> comment;

					}
				?>
					</td>

					<td><a href="add_followup.php?id=<?php echo $enq_id; ?>&loc=elead_telecaller">Add Follow Up </a>| <a href="remove_duplicate.php?id=<?php echo $enq_id; ?>&loc=elead_telecaller">Remove</a></td>
					<!--<td><a href="request_lead_transfer.php?id=<?php echo $enq_id; ?>">Request To Transfer</a></td>-->

					</tr>
					<?php } ?>
					</tbody>

					</table>
				</div>
				</div>
			</div>
					<?php
					}
					public function tl_filter()
					{
					$select_leads=$this->excel_lead_model->select_tl_lead();
		?>
		<div class="row top_tiles">

			<div id="abc">
				<?php
				$today = date('d-m-Y');
				?>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						var $table4 = jQuery("#table-4");
						$table4.DataTable({
							dom : 'Bfrtip',
							buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
						});
					});
				</script>

				<h1 style="text-align:center;">Excel Leads</h1>
				<div  class="table-responsive"  style="overflow-x:auto;">
		<table class="table table-bordered datatable table-responsive"" id="table-4">
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

					foreach ($select_leads as $fetch) {

					$enq_id=$fetch->enq_id;
					$i++;
					?>
					<tr>
					<td><?php echo $i; ?></td>

					<td><?php echo $fetch -> enquiry_for; ?></td>

					<td><b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?> " title="Customer Follow Up Details"><?php echo $fetch -> name . '(' . $fetch -> fcount . ')'; ?></a></b></td>
					<td><?php echo $fetch -> contact_no; ?></td>
					<td><?php echo $fetch -> email; ?></td>

					<td><?php echo $fetch -> created_date; ?></td>

					<td>
					<?php $status = $fetch -> status;

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
					<?php /*$assign = $fetch -> assignby;
						 $query3 = mysql_query("select fname,lname from lmsuser where id='$assign'") or die(mysql_error());
						 $fetch3 = mysql_fetch_array($query3);*/

						echo $fetch -> fname . " " . $fetch -> lname;
					?>
					</td>
					<td><?php echo $fetch -> comment; ?></td>
					<td>
					<?php

					$query3 = $this -> db -> query("select comment from lead_followup where leadid='$enq_id'  order by id desc limit 1") -> result();
					if ($fetch -> fcount != 0) {
						echo $query3[0] -> comment;

					}
				?>
					</td>

					<td><a href="add_followup.php?id=<?php echo $enq_id; ?>&loc=elead_telecaller">Add Follow Up </a>| <a href="remove_duplicate.php?id=<?php echo $enq_id; ?>&loc=elead_telecaller">Remove</a></td>
					<!--<td><a href="request_lead_transfer.php?id=<?php echo $enq_id; ?>">Request To Transfer</a></td>-->

					</tr>
					<?php } ?>
					</tbody>

					</table>
				</div>
				</div>
			</div>
					<?php
					}
					}
				?>
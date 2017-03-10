<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class telecaller_lead extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('telecaller_lead_model');

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	public function index() {
		$this -> session();
		$data['select_lead'] = $this -> telecaller_lead_model -> select_lead();
		$data['select_telecaller']=$this->telecaller_lead_model->select_telecaller();
			$data['select_campaign']=$this->telecaller_lead_model->select_campaign();
	$this -> load -> view('include/admin_header.php');
$this->load->view('tl_telecaller_top_tab_view.php',$data);
		$this -> load -> view('telecaller_lead_view.php', $data);
		$this -> load -> view('include/footer.php');
	}
	
	public function tl_filter()
	{
		
	    echo $campaign_name=$this->input->post('campaign_name');
	    echo $lead=$this->input->post('status');
		echo $dispostion=$this->input->post('dispostion');
		echo $a=$this->input->post('assign_to');
		echo $f=$this->input->post('fromdate');
		echo $t=$this->input->post('todate');
		$query=$this->telecaller_lead_model->select_tl_lead($campaign_name,$lead,$dispostion,$a,$f,$t);
	//	print_r($query);
	?>
	
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

                       <h1 style="text-align:center;">
                       	
                       	Telecaller Added Leads</h1>
                       <div class="table-responsive"  style="overflow-x:auto;"> 
				<table class="table table-bordered datatable table-responsive"" id="table-4"> 
						<thead>
						<tr>
							<th>Sr No.</th>
							<th>Interested In</th>
                            <th>Name</th>							
							<th>Contact</th>			
							<th>Email</th>
							<th>Lead (Date/Time)</th>
                            <th>Status</th>
                            <th>Added By</th>
							<th>Assign To</th>
							<th>Comment </th>
							<th>Remark</th>
							<th>Action</th>
					</thead>
					<tbody>
						<?php
						$i=0;
						
					foreach ($query as $fetch) {
						
							
						$enq_id=$fetch->enq_id;
							$i++;
						?>
						<tr>
							<td><?php echo $i; ?></td>
						
							   <td><?php echo $fetch -> enquiry_for; ?></td>
                             <td><b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?>"><?php echo $fetch -> name; ?></a></b></td>
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
									<?php
									echo $fetch -> manual_lead;
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

									$query = $this -> db -> query('select comment from lead_followup where leadid=' . $enq_id);

									foreach ($query->result() as $fetch1) {

										echo $fetch1 -> comment;
									}
									?>
								</td>
					
								
						<?php 
								if($status=1 && ($_SESSION['department']=='Website Call' || $_SESSION['department']=='Website Chat'))
								{
									?>	
								<td><a href="edit_leads/<?php echo $fetch -> enq_id; ?>">Edit</a></td>
						<?php
						}
						else{
 ?>
		<td>Edit</td>					
			<?php } ?>
						</tr>
						<?php } ?>
					</tbody>
					
					
				</table>
                   <br />
 </div> 
          </div> 
	
	



<?php 	}
	public function select_disposition()
	{
	$query=$this->telecaller_lead_model->select_disposition();
	?>            <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="dispostion" name="dispostion">
                                              	<option value="">Disposition</option>
											<?php foreach ($query as $fetch) {
												?>
											
													 <option value="<?php echo $fetch -> disposition_name; ?>"><?php echo $fetch -> disposition_name; ?></option>
                                            <?php } ?> 	
                                               
                                                </select>
											  
                                            </div>
                           
                                    <?php
									}

									}
		?>
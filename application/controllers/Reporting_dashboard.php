<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ob_start();
class Reporting_dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url','download'));
		$this -> load -> model('reporting_dashboard_model');
		date_default_timezone_set("Asia/Kolkata");
			$this->load->dbutil();
			

	}
	
	

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	
	public function admin() {
		
		$this -> session();
		
		$data['select_record1']=$this->reporting_dashboard_model->filter_record();
	//	print_r($data['select_record1']);
	
	
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('reporting_dashboard_view.php',$data);
		$this -> load -> view('include/footer.php');
		
	}
	
	public function filter_record() {
			
		//echo "hi";
		
		$select_record1=$this->reporting_dashboard_model->select_record1();
	
		
		?>
				



 <div class="control-group" id="campaign_loader" style="margin:0% 30% 1% 50%"></div>
			<table class="table table-bordered datatable" id="table-3"> 
					<thead>
						<tr>
				
						 <th>Date</th>
						 <th>Campaign Name</th>
						 <th>Source</th>
						 <th>Leads Generated</th>
						 <th>Contacted </th>
						 <th>Pending </th>
						 <th>Live </th>
						 <th>Lost </th>
						
						</tr>	
					</thead>
					<tbody>
				  
				  
				     <?php 
				     
					$i=0;
					foreach($select_record1 as $row)
					{
						
						
						  foreach($row as $fetch)
						  {
						     $enq_id=$fetch->enq_id;
							
					?>
					<tr>
							
								<td><?php echo $fetch ->created_date; ?></td>
								<td><?php echo $fetch ->enquiry_for; ?></td>
								<td>
									<?php echo $fetch ->lead_source; ?>
									
									
								</td>
								<td><?php echo $fetch ->enqcount; ?></td>
								<td>
									<?php 
									
									
									$q=$this->db->query('select count(enq_id)as contactcount from lead_master l
									join tbl_status s
									ON s.status_id=l.status
									where enquiry_for="'.$fetch->enquiry_for.'" and
									created_date="'.$fetch->created_date.'"
									
									and status_name !="Not Yet"
									')->result();
								
									echo $q[0]->contactcount;
									?>
									</td>
						
 					 			<td>
 					 				<?php 
								
									$q=$this->db->query('select count(enq_id)as pendingcount from lead_master l
									join tbl_status s
									ON s.status_id=l.status
									where enquiry_for="'.$fetch->enquiry_for.'" and
									created_date="'.$fetch->created_date.'"
									and status_name="Not Yet"
									')->result();
								
									echo $q[0]->pendingcount;
									?>
									
 					 				
 					 			</td>
								<td>
									
								<?php 
								
									$q=$this->db->query('select count(enq_id)as livecount from lead_master l
									join tbl_status s
									ON s.status_id=l.status
									where enquiry_for="'.$fetch->enquiry_for.'" and
									created_date="'.$fetch->created_date.'"
									and status_name= "Live"
									')->result();
								
									echo $q[0]->livecount;
									?>
 					 				
									
									</td>
								<td>
									
										<?php 
									
									$q=$this->db->query('select count(enq_id)as lostcount,enq_id from lead_master l
									join tbl_status s
									ON s.status_id=l.status
									where enquiry_for="'.$fetch->enquiry_for.'" and
									created_date="'.$fetch->created_date.'"
									and status_name="Lost"
									')->result();
							
									echo $q[0]->lostcount;
									?>
									
 					 				
									
							</td>
							
                            
                           </tr>
						<?php
						}
					}  ?>
					</tbody>
				</table>
			
		<?php
	}
	
	
}
?>

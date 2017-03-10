<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class report extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('report_model');
		$this -> load -> dbutil();

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	public function index()
	{
		$data['select_cse']=$this -> report_model -> select_cse();
		$data['select_fresh_lead']=$this -> report_model -> select_fresh_lead();
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('cse_wise_report_view.php', $data);
		$this -> load -> view('include/footer.php');
	}
	public function result()
	{
		$cse_name=$this->input->post('cse_name');
		$select_fresh_lead=$this -> report_model -> select_fresh_lead();
		?>
		 <div class="control-group" id="campaign_loader" style="margin:0% 30% 1% 50%"></div>
               <table id="campaign_count" class="table table-striped table-bordered table-responsive">
                         <tbody>
                         	<tr>
                         		<th></th>
                         		<th colspan=3>All</th>
                         		<th colspan=3>Pending</th>
                         		<th colspan=3>Todays</th>
                         		</tr>
					<tr>
                            
                            <td>Date</td>
                            
                            <td>Fresh Leads </td>
                            <td>Pending  Data </td>
						    <td>Follow-ups </td>
						    
						  
						    <td>Pending Fresh Calls </td>
							<td>Pending Data Calls</td>
							<td>Pending Follow-ups </td>
							
							<td>Attended Fresh Leads </td>
                            <td>Attended Pending  Data </td>
						    <td> Attended Follow-ups </td>
							<td>Live </td>
							<td>Lost </td>
							<td>Home VIsit Booked </td>
							<td>Showroom Visit Booked</td>
                        </tr>
                        <?php foreach($select_fresh_lead as $row){ 
                        	?>
                             <tr>
                             	
                       <td><?php
                       //Created date
                        echo $row->created_date;?></td>
                            
                            <td><?php 
                            // All new Leads according date and cse name
                             echo $fresh_data= $row->fresh_lead_count;?> </td>
                            
                            <td><?php // All Pending Leads according date and cse name?> </td>
                             
                              <td><?php //All Today Followup Leads according date and cse name
                              $today_followup =$this->db->query("SELECT l.enq_id FROM lead_master l JOIN lead_followup f ON f.leadid=l.enq_id WHERE f.nextfollowupdate = '$row->created_date' and l.assign_to_telecaller='$cse_name' group by enq_id")->result();
						    		//echo $this->db->last_query();
						    			echo $all_followup=count($today_followup); ?></td>
						   
                               <td>
                              	<?php
                              	// Pending from new leads according date and cse name
                              	$q=$this->db->query('select count(enq_id)as pending_fresh from lead_master l 
                              	join tbl_status s 
                              	on s.status_id=l.status
                              	where s.status_name="Not Yet" and created_date="'.$row->created_date.'" and l.assign_to_telecaller="'.$cse_name.'"')->result();
								//echo $this->db->last_query();
                              echo $q[0]->pending_fresh;
								?>
								
                              </td>
                              <td><?php //Pending from pending leads according date and cse name ?></td>
                               <td><?php
						 	//pending from today followup leads according date and cse name
						  $today_followup1 =$this->db->query("SELECT l.enq_id FROM lead_master l 
						 JOIN lead_followup f ON f.id=l.followup_id 
						 WHERE f.nextfollowupdate = '$row->created_date' 
						 and l.assign_to_telecaller='$cse_name' 
						 group by enq_id")->result();
						    		//echo $this->db->last_query();
						    		 echo $pending_followup=count($today_followup1); ?></td>
							
                                 <td>
                              	<?php
                              	//Attended from new leads according date and cse name
                              	$q=$this->db->query('select count(enq_id)as pending_fresh from lead_master l 
                              	join tbl_status s 
                              	on s.status_id=l.status
                              	where s.status_name!="Not Yet" and created_date="'.$row->created_date.'" and l.assign_to_telecaller="'.$cse_name.'"')->result();
								//echo $this->db->last_query();
                              echo $q[0]->pending_fresh;
								?> 
                       </td>
                       <td><?php //Attended from pending leads according date and cse name ?></td>
						<td><?php //Attened fron today followup according date and cse name 
							echo $attended_followup=$all_followup-$pending_followup?></td>
							
						<!--    <td><?php echo $total=$fresh_data+$pending_live_data + $today_followup_data;?></td>					    
						    
						    
						     <td><?php $fresh_pending =$this->db->query("SELECT count(l.enq_id) as pending_fresh_count FROM lead_master l JOIN tbl_status s ON s.status_id=l.status WHERE s.status_name ='Not Yet' AND l.created_date='$row->created_date'  ")->result();
						    			if(count($fresh_pending)>0){ echo $pending_fresh_data=$fresh_pending[0]->pending_fresh_count; }?></td>
						    
							<td><?php $pending_call_lead =$this->db->query("SELECT count(l.enq_id) as pending_lead_call_count FROM lead_master l JOIN lead_followup f ON f.leadid=l.enq_id WHERE f.nextfollowupdate != '0000-00-00' AND f.nextfollowupdate < '$row->created_date' AND f.date='$row->created_date'")->result();
						    			if(count($pending_call_lead)>0){ echo $pending_live_call_data=$pending_call_lead[0]->pending_lead_call_count; }?></td>
						    
							 <td><?php $today_followup_call=$this->db->query("SELECT count(l.enq_id) as followup_lead_call_count FROM lead_master l JOIN lead_followup f ON f.leadid=l.enq_id WHERE f.nextfollowupdate = '$row->created_date' AND f.date = '$row->created_date'")->result();
						    			if(count($today_followup_call)>0){ echo $today_followup_call_data=$today_followup_call[0]->followup_lead_call_count; }?></td>
						    <td><?php $live_data =$this->db->query("SELECT count(l.enq_id) as live_data_count FROM lead_master l JOIN tbl_status s ON s.status_id=l.status JOIN lead_followup f ON f.leadid=l.enq_id  JOIN tbl_disposition_status d ON d.disposition_id=f.disposition  WHERE s.status_name ='Live' AND f.date='$row->created_date'")->result();
						    			if(count($live_data)>0){ echo $live_data1=$live_data[0]->live_data_count; }?></td>
						    
							<td><?php $lost_data =$this->db->query("SELECT count(l.enq_id) as lost_data_count FROM lead_master l JOIN tbl_status s ON s.status_id=l.status WHERE s.status_name ='Lost' AND l.created_date='$row->created_date'")->result();
						    			if(count($lost_data)>0){ echo $live_data1=$lost_data[0]->lost_data_count; }?></td>
						    
							 <td><?php $home_visit =$this->db->query("SELECT count(l.enq_id) as home_visit_count FROM lead_master l JOIN tbl_status s ON s.status_id=l.status JOIN lead_followup f ON f.leadid=l.enq_id  JOIN tbl_disposition_status d ON d.disposition_id=f.disposition  WHERE d.disposition_name ='Home Visit Scheduled' AND f.date='$row->created_date'")->result();
						    			if(count($home_visit)>0){ echo $home_visit=$home_visit[0]->home_visit_count; }?></td>
						    
							 <td><?php $showroom_visit =$this->db->query("SELECT count(l.enq_id) as showroom_visit_count FROM lead_master l JOIN tbl_status s ON s.status_id=l.status JOIN lead_followup f ON f.leadid=l.enq_id  JOIN tbl_disposition_status d ON d.disposition_id=f.disposition  WHERE d.disposition_name ='Showroom Visit' AND f.date='$row->created_date'")->result();
						    			if(count($showroom_visit)>0){ echo $showroom_visit=$showroom_visit[0]->showroom_visit_count; }?></td>
						   -->
							</tr>
                      <?php  }?>
                         </tbody>
                    </table>
</div>
<?php
	}
}
?>
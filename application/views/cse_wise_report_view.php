<script type="text/javascript" src="<?php echo base_url();?>assets/js/tableExport.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.base64.js"></script>
<script>
	function select_table_data()
	{
		var fromdate=document.getElementById("fromdate").value;
		var todate=document.getElementById("todate").value;
		var cse_name=document.getElementById("cse_name").value;
//Create Loader
	src1 ="<?php echo base_url('assets/images/loader200.gif');?>";
	var elem = document.createElement("img");
	elem.setAttribute("src", src1);
	elem.setAttribute("height", "95");
	elem.setAttribute("width", "85");
	elem.setAttribute("alt", "loader");
	
	document.getElementById("campaign_loader").appendChild(elem);	  
	$.ajax({
		url : '<?php echo site_url('report/result'); ?>',
		type : 'POST',
		data : {'fromdate' : fromdate,'todate':todate,'cse_name':cse_name},
		success : function(result) {
		$("#cse_wise_count").html(result);
	}
});
	}
</script>
<div class="col-md-12">
    <div  class="col-md-4">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name"> From Date: </label>
									<div class="col-md-8 col-sm-8 col-xs-12">
							    
                                             	
                                              <input type="text" id="fromdate" value="<?php echo date('Y-m-d'); ?>" class="datett filter_s col-md-12 col-xs-12 form-control"  placeholder="Lead Date From" name="date_of_booking" readonly style="background:#F5F5F5; cursor:default;">
										
									</div>
								</div>

							</div>
							
							 <div  class="col-md-4">
								<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">To Date: </label>
										<div class="col-md-8 col-sm-8 col-xs-12">
                                              <input type="text" id="todate" value="<?php echo date('Y-m-d'); ?>" class="datett filter_s col-md-12 col-xs-12 form-control"  placeholder="Lead Date From" name="date_of_booking" readonly style="background:#F5F5F5; cursor:default;">
										
								</div>

							</div>
							</div>
							 <div  class="col-md-3">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name"> CSE : </label>
									<div class="col-md-8 col-sm-8 col-xs-12">
							    
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="cse_name" name="cse_name" onchange="select_table_data();" >
												 <option value=""> Please Select </option>
															<?php
								foreach ($select_cse as $row) {
									?>
									<option value="<?php echo $row -> id; ?>"><?php echo $row -> fname . " " . $row -> lname; ?></option>
									<?php
									}
	 ?>	
										</select>
										
										
										
									</div>
									
									
									
								</div>

							</div>
							
							<div class="pull-right" style="padding-top:20px;">
	
                                       
<a href="#" class="pull-right" onClick ="$('#campaign_table').tableExport({type:'excel',escape:'false'});"><i class="btn btn-defult entypo-download"></i></a>
           </div>
           
		</div>					<br><br><br>
     <div class="table-responsive" id="cse_wise_count">
    <div class="control-group" id="campaign_loader" style="margin:0% 30% 1% 50%"></div>
               <table id="campaign_count" class="table table-striped table-bordered table-responsive">
                         <tbody>
					<tr>
                            
                            <td>Date</td>
                            <td>Fresh Leads </td>
                            <td>Pending  Data </td>
						    <td>Follow-ups </td>
						    <td>Total Calls</td>
						    <td>Pending Fresh Calls </td>
							<td>Pending Data Calls</td>
							<td>Pending Follow-ups </td>
							<td> Fresh Calls </td>
							<td>Pending Calls</td>
							<td> Follow-ups </td>
							<!--<td>Live </td>
							<td>Lost </td>
							<td>Home VIsit Booked </td>
							<td>Showroom Visit Booked</td>-->
                        </tr>
                        <?php foreach($select_fresh_lead as $row){ 
                        	//foreach($select_followup_lead as $row1){
                        		//foreach($select_pending_lead as$row2){?>
                             <tr>
                       
                            <td><?php echo $row->created_date;?></td>
                            <td><?php  echo $fresh_data= $row->fresh_lead_count;?> </td>
                            <td><?php $pending_lead =$this->db->query("SELECT count(l.enq_id) as pending_lead_count FROM lead_master l JOIN lead_followup f ON f.leadid=l.enq_id WHERE f.nextfollowupdate != '0000-00-00' AND f.nextfollowupdate < '$row->created_date'")->result();
						    			if(count($pending_lead)>0){ echo $pending_live_data=$pending_lead[0]->pending_lead_count; }?></td>
						    <td><?php $today_followup =$this->db->query("SELECT count(l.enq_id) as followup_lead_count FROM lead_master l JOIN lead_followup f ON f.leadid=l.enq_id WHERE f.nextfollowupdate = '$row->created_date' ")->result();
						    		echo $this->db->last_query();
						    			if(count($today_followup)>0){ echo $today_followup_data=$today_followup[0]->followup_lead_count; }?></td>
						    <td><?php echo $total=$fresh_data+$pending_live_data + $today_followup_data;?></td>
						    
						    
						    
						     <td><?php $fresh_pending =$this->db->query("SELECT count(l.enq_id) as pending_fresh_count FROM lead_master l JOIN tbl_status s ON s.status_id=l.status WHERE s.status_name ='Not Yet' AND l.created_date='$row->created_date'  ")->result();
						    			if(count($fresh_pending)>0){ echo $pending_fresh_data=$fresh_pending[0]->pending_fresh_count; }?></td>
						    
							<td><?php $pending_call_lead =$this->db->query("SELECT count(l.enq_id) as pending_lead_call_count FROM lead_master l JOIN lead_followup f ON f.leadid=l.followup_id WHERE f.nextfollowupdate != '0000-00-00' AND f.nextfollowupdate < '$row->created_date' AND f.date='$row->created_date'")->result();
						    			if(count($pending_call_lead)>0){ echo $pending_live_call_data=$pending_call_lead[0]->pending_lead_call_count; }?></td>
						    
							 <td><?php $today_followup_call=$this->db->query("SELECT count(l.enq_id) as followup_lead_call_count FROM lead_master l JOIN lead_followup f ON f.leadid=l.followup_id WHERE f.nextfollowupdate = '$row->created_date' AND f.date = '$row->created_date'")->result();
						    			if(count($today_followup_call)>0){ echo $today_followup_call_data=$today_followup_call[0]->followup_lead_call_count; }?></td>
						
						
						  <td><?php echo $fresh_data_call_done=$fresh_data-$pending_fresh_data; ?> </td>
						  <td><?php echo $pending_data_call_done=$pending_live_data-$pending_live_call_data; ?></td>
						   <td><?php echo $followup_data_call_done=$today_followup_data-$today_followup_call_data;?></td>
						   
						   
						   
						   <!-- <td><?php $live_data =$this->db->query("SELECT count(l.enq_id) as live_data_count FROM lead_master l JOIN tbl_status s ON s.status_id=l.status JOIN lead_followup f ON f.leadid=l.followup_id  JOIN tbl_disposition_status d ON d.disposition_id=f.disposition  WHERE s.status_name ='Live' AND f.date='$row->created_date'")->result();
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

 <script type="text/javascript">
						$(document).ready(function() {
							$('.datett').daterangepicker({
								singleDatePicker : true,
								format : 'YYYY-MM-DD',
								calender_style : "picker_1"
							}, function(start, end, label) {
								console.log(start.toISOString(), end.toISOString(), label);
							});
});
</script>

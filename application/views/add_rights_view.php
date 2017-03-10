
<div class="row" >
<div><?php echo $this -> session -> flashdata('message'); ?></div>
<?php $insert=$_SESSION['insert'];
if($insert[8]==1)
{?>
<h1 style="text-align:center; ">Add Rights</h1>
	<div class="col-md-12" >
			<div class="panel panel-primary">
				<div class="panel-body">
					<form action="<?php echo $var; ?>" method="post">
						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="col-md-12">
								<div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">User Name: </label>
										<div class="col-md-5 col-sm-5 col-xs-12">
											<select class="filter_s col-md-12 col-xs-12 form-control" id="process_name" name="user_name" required>
											<option value=""> Please Select </option>
											<?php 
											//echo $c=count($select_rights_user);
											
											foreach ($select_user as $fetch) {
											
														?>	
											<option value="<?php echo $fetch -> id; ?>"><?php echo $fetch -> fname . ' ' . $fetch -> lname; ?></option>
                                            <?php
													
												 } ?>
                                            </select>
                                         </div>
                                    </div>
                                </div>
							</div><br><br><br>
							<div class="table-responsive">
							<table class="table table-bordered datatable"> 
							<thead>
							<tr>
							<th>Sr No.</th>
							<th>Module</th>
							<th>View  <input type="checkbox" name="view" class="pull-right" value="1" id="select_all" onclick="select_checkbox()"></th>
							<th>Insert<input type="checkbox" name="view" class="pull-right" value="1" id="select_all1" onclick="select_checkbox1()"></th>
							<th>Modify <input type="checkbox" name="view" class="pull-right" value="1" id="select_all2" onclick="select_checkbox2()"></th>
							<th>Delete<input type="checkbox" name="view" class="pull-right" value="1" id="select_all3" onclick="select_checkbox3()"></th>
							</tr>	
						</thead>
						<tbody>
						<tr>
							<td>1</td>
							<td>Add Location
							<input type="hidden" name="form_location"   value="Add Location">
							<input type="hidden" name="controller_location"   value="add_location">
							</td>
							
							<td><input type="checkbox" class="checkbox pull-right" name="add_location_view" value="1">
								<input type="hidden" name="add_location_view1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="add_location_insert" value="1">
								<input type="hidden" name="add_location_insert1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="add_location_modify" value="1">
								<input type="hidden" name="add_location_modify1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="add_location_delete" value="1">
								<input type="hidden" name="add_location_delete1"   value="0">
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Add User
								<input type="hidden" name="form_user"   value="Add User">
							<input type="hidden" name="controller_user"   value="add_lms_user">
							</td>
							<td><input type="checkbox" class="checkbox pull-right" name="add_new_user_view" value="1">
								<input type="hidden" class="checkbox" name="add_new_user_view1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="add_new_user_insert" value="1">
								<input type="hidden" class="checkbox1" name="add_new_user_insert1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="add_new_user_modify" value="1">
								<input type="hidden" class="checkbox2" name="add_new_user_modify1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="add_new_user_delete" value="1">
								<input type="hidden" class="checkbox3" name="add_new_user_delete1" value="0">
							</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Add Group 
								<input type="hidden" name="form_group"   value="Add Group ">
							<input type="hidden" name="controller_group"   value="add_group">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="add_group_view" value="1">
								<input type="hidden" class="checkbox" name="add_group_view1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="add_group_insert" value="1">
								<input type="hidden" class="checkbox" name="add_group_insert1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="add_group_modify" value="1">
								<input type="hidden" class="checkbox2" name="add_group_modify1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="add_group_delete" value="1">
								<input type="hidden" class="checkbox3" name="add_group_delete1" value="0">
							</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Add Campaign
								<input type="hidden" name="form_campaign"   value="Add Campaign">
							<input type="hidden" name="controller_campaign"   value="add_campaign">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="add_campaign_view" value="1">
								<input type="hidden" class="checkbox" name="add_campaign_view1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="add_campaign_insert" value="1">
								<input type="hidden" class="checkbox" name="add_campaign_insert1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="add_campaign_modify" value="1">
								<input type="hidden" class="checkbox2" name="add_campaign_modify1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="add_campaign_delete" value="1">
								<input type="hidden" class="checkbox3" name="add_campaign_delete1" value="0">
							</td>
						</tr>
						<tr>
							<td>5</td>
							<td>Add Status
								<input type="hidden" name="form_status"   value="Add Status">
							<input type="hidden" name="controller_status"   value="add_status">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="add_status_view" value="1">
								<input type="hidden" class="checkbox" name="add_status_view1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="add_status_insert" value="1">
								<input type="hidden" class="checkbox" name="add_status_insert1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="add_status_modify" value="1">
								<input type="hidden" class="checkbox2" name="add_campaign_modify1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="add_status_delete" value="1">
								<input type="hidden" class="checkbox3" name="add_status_delete1" value="0">
							</td>
						</tr>
						<tr>
							<td>6</td>
							<td>Add Disposition
								<input type="hidden" name="form_disposition"   value="Add Disposition">
							<input type="hidden" name="controller_disposition"   value="add_disposition">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="add_disposition_view" value="1">
								<input type="hidden" class="checkbox" name="add_disposition_view1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="add_disposition_insert" value="1">
								<input type="hidden" class="checkbox" name="add_disposition_insert1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="add_disposition_modify" value="1">
								<input type="hidden" class="checkbox2" name="add_disposition_modify1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="add_disposition_delete" value="1">
								<input type="hidden" class="checkbox3" name="add_disposition_delete1" value="0">
							</td>
						</tr>
						<tr>
							<td>7</td>
							<td>Add Rights
								<input type="hidden" name="form_right"   value="Add Rights">
							<input type="hidden" name="controller_right"   value="add_right">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="add_right_view" value="1">
								<input type="hidden" class="checkbox" name="add_right_view1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="add_right_insert" value="1">
								<input type="hidden" class="checkbox" name="add_right_insert1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="add_right_modify" value="1">
								<input type="hidden" class="checkbox2" name="add_right_modify1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="add_right_delete" value="1">
								<input type="hidden" class="checkbox3" name="add_right_delete1" value="0">
							</td>
						</tr>
						<tr>
							<td>8</td>
							<td>Add New Lead
							<input type="hidden" name="form_new_lead"   value="Add New Lead">
							<input type="hidden" name="controller_new_lead"   value="add_new_customer">
							</td>
							
							<td><input type="checkbox" class="checkbox pull-right" name="new_lead_view" value="1">
								<input type="hidden" name="new_lead_view1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="new_lead_insert" value="1">
								<input type="hidden" name="new_lead_insert1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="new_lead_modify" value="1">
								<input type="hidden" name="new_lead_modify1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="new_lead_delete" value="1">
								<input type="hidden" name="new_lead_delete1"   value="0">
							</td>
						</tr>
						
						
						<tr>
							<td>9</td>
							<td>Assign Lead
								<input type="hidden" name="form_assign_lead"   value="Assign Lead ">
							<input type="hidden" name="controller_assign_lead"   value="assign_leads">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="assign_leads_view" value="1">
								<input type="hidden" class="checkbox" name="assign_leads_view1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="assign_leads_insert" value="1">
								<input type="hidden" class="checkbox" name="assign_leads_insert1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="assign_leads_modify" value="1">
								<input type="hidden" class="checkbox2" name="assign_leads_modify1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="assign_leads_delete" value="1">
								<input type="hidden" class="checkbox3" name="assign_leads_delete1" value="0">
							</td>
						</tr>
						<tr>
							<td>10</td>
							<td>Add Follow Up
							<input type="hidden" name="form_follow_up"   value="Add Follow Up">
							<input type="hidden" name="controller_follow_up"   value="add_followup">
							</td>
							
							<td><input type="checkbox" class="checkbox pull-right" name="add_followup_view" value="1">
								<input type="hidden" name="add_followup_view1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="add_followup_insert" value="1">
								<input type="hidden" name="add_followup_insert1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="add_followup_modify" value="1">
								<input type="hidden" name="add_followup_modify1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="add_followup_delete" value="1">
								<input type="hidden" name="add_followup_delete1"   value="0">
							</td>
						</tr>
						
						<tr>
							<td>11</td>
							<td>Add Manager Remark
							<input type="hidden" name="form_manager_remark"   value="Add Manager Remark">
							<input type="hidden" name="controller_manager_remark"   value="add_manager_remark">
							</td>
							
							<td><input type="checkbox" class="checkbox pull-right" name="manager_remark_view" value="1">
								<input type="hidden" name="manager_remark_view1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="manager_remark_insert" value="1">
								<input type="hidden" name="manager_remark_insert1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox2 pull-right" name="manager_remark_modify" value="1">
								<input type="hidden" name="manager_remark_modify1"   value="0">
							</td>
							<td><input type="checkbox" class="checkbox3 pull-right" name="manager_remark_delete" value="1">
								<input type="hidden" name="manager_remark_delete1"   value="0">
							</td>
						</tr>
						<tr>
							<td>12</td>
							<td>Transfer Lead
							<input type="hidden" name="form_transfer_lead"   value="Transfer Lead">
							<input type="hidden" name="controller_transfer_lead"   value="request_lead_transfer">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="request_lead_transfer_view" value="1">
								<input type="hidden" class="checkbox" name="request_lead_transfer_view1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="request_lead_transfer_insert" value="1">
								<input type="hidden" class="checkbox" name="request_lead_transfer_insert1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox2 pull-right" name="request_lead_transfer_modify" value="1">-->
								<input type="hidden" class="checkbox2" name="request_lead_transfer_modify1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox3 pull-right" name="request_lead_transfer_delete" value="1">-->
								<input type="hidden" class="checkbox3" name="request_lead_transfer_delete1" value="0">
							</td>
						</tr>
						<tr>
							<td>13</td>
							<td>Upload Lead
							<input type="hidden" name="form_upload_lead"   value="Upload Lead">
							<input type="hidden" name="controller_upload_lead"   value="upload_xls">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="upload_xls_view" value="1">
								<input type="hidden" class="checkbox" name="upload_xls_view1" value="0">
							</td>
							<td><input type="checkbox" class="checkbox1 pull-right" name="upload_xls_insert" value="1">
								<input type="hidden" class="checkbox" name="upload_xls_insert1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox2 pull-right" name="upload_xls_modify" value="1">-->
								<input type="hidden" class="checkbox2" name="upload_xls_modify1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox3 pull-right" name="upload_xls_delete" value="1">-->
								<input type="hidden" class="checkbox3" name="upload_xls_delete1" value="0">
							</td>
						</tr>
						
							
						
						<tr>
							<td>14</td>
							<td>Tracker
							<input type="hidden" name="form_tracker"   value="Tracker">
							<input type="hidden" name="controller_tracker"  value="tracker/team_leader_leads">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="all_tracker_view" value="1">
								<input type="hidden" class="checkbox" name="all_tracker_view1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox1 pull-right" name="all_tracker_insert" value="1">-->
								<input type="hidden" class="checkbox" name="all_tracker_insert1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox2 pull-right" name="all_tracker_modify" value="1">-->
								<input type="hidden" class="checkbox2" name="all_tracker_modify1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox3 pull-right" name="all_tracker_delete" value="1">-->
								<input type="hidden" class="checkbox3" name="all_tracker_delete1" value="0">
							</td>
						</tr>
						
						<tr>
							<td>15</td>
							<td>Transferred leads
							<input type="hidden" name="form_transferred"   value="Transferred Leads">
							<input type="hidden" name="controller_transferred"   value="request_lead_transfer">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="transferred_leads_view" value="1">
								<input type="hidden" class="checkbox" name="transferred_leads_view1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox1 pull-right" name="transferred_leads_insert" value="1">-->
								<input type="hidden" class="checkbox" name="transferred_leads_insert1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox2 pull-right" name="transferred_leads_modify" value="1">-->
								<input type="hidden" class="checkbox2" name="transferred_leads_modify1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox3 pull-right" name="transferred_leads_delete" value="1">-->
								<input type="hidden" class="checkbox3" name="transferred_leads_delete1" value="0">
							</td>
						</tr>
						<tr>
							<td>16</td>
							<td>Calling Notification 
							<input type="hidden" name="calling_notification"   value="Calling Notification">
							<input type="hidden" name="controller_calling_notification"   value="">
							</td>
							<td><input type="checkbox" class="checkbox pull-right " name="calling_notification_view" value="1">
								<input type="hidden" class="checkbox" name="calling_notification_view1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox1 pull-right" name="transferred_leads_insert" value="1">-->
								<input type="hidden" class="checkbox" name="calling_notification_insert1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox2 pull-right" name="transferred_leads_modify" value="1">-->
								<input type="hidden" class="checkbox2" name="calling_notification_modify1" value="0">
							</td>
							<td><!--<input type="checkbox" class="checkbox3 pull-right" name="transferred_leads_delete" value="1">-->
								<input type="hidden" class="checkbox3" name="calling_notification_delete1" value="0">
							</td>
						</tr>
						</tbody>
						</table>
						</div>
                     	<div class="form-group">
							<div class="col-md-2 col-md-offset-4">
								<button type="submit" class="btn btn-success col-md-12 col-xs-12 col-sm-12">Submit</button>
							</div>
							<div class="col-md-2">
								<input type='reset' class="btn btn-primary col-md-12 col-xs-12 col-sm-12" value='Reset'>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php } ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var $table4 = jQuery("#table-4");
		$table4.DataTable({
			dom : 'Bfrtip',
			buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
		});
	}); 
</script> 
<div class="col-md-12" >
	<?php 
	 $modify=$_SESSION['modify'];
	 $delete=$_SESSION['delete'];  
	  $form_name=$_SESSION['form_name'];  
	 ?>
<table class="table table-bordered datatable" id="table-4"> 
<thead> 
<tr> 
<th>Sr No.</th>
							<th> Name</th>
							<th>Email Id</th>				
                            <th>Contact</th>		
							<th>Location</th>
							<th>Role</th>	
							<th>Process</th>
								<?php if($modify[8]==1 || $delete[8]==1)  {?>		
							<th>Action</th>
							<?php } ?>
							
 </tr>
</thead> 


<tbody>


					 <?php 
					 $i=0;
						foreach($select_data as $fetch)
						{
							$i++;
						?>

						<tr>
						
						<td>	<?php echo $i;
									?> 		
							</td>
						
						
						
							<td>
							<?php echo $fetch->fname.' '.$fetch->lname;?>
							</td>
								
							<td>
							<?php echo $fetch->email;?>
							</td>	
						
							<td>
						<?php echo $fetch->mobileno;?>
							</td>
								
								
							<td><?php echo $fetch->location;?></td>
							<td>
								
								<?php echo $fetch->role_name;?>
									<?php
							/*if ($fetch->role == 1) {
											echo 'Admin';
										} elseif ($fetch->role == 2) {
											echo 'Team Leader';

										} else {
											echo 'CSE';
										}
							*/
							
							?>
							
								
								
							</td>
							<td>
								
								<?php echo $fetch->process_name;?>
								
							</td>
					
                            <?php if($modify[8]==1 || $delete[8]==1)  {?>	   
							<td>
								 <?php if($modify[8]==1 ){?>
								<a href="<?php echo site_url();?>add_right/edit_right/<?php echo $fetch->id; ?>">Edit </a> &nbsp;&nbsp;
		<?php }  if($delete[8]==1){?> 
							 <a onclick="return getConfirmation();" href="<?php echo site_url();?>add_right/delete_all_rights/<?php echo $fetch->id; ?>">Delete </a>
		<?php } ?>
		
							</td>
							<?php } ?>
						</tr>
<?php } ?>				
					</tbody>
 
 </table> 
 
   </div>
   <script src="<?php echo base_url();?>assets/js/campaign.js"></script>
   	</div>
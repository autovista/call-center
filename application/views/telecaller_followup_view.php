	<?php
$today = date('d-m-Y');
?>
<?php 	$enq=str_replace('%20', ' ', $enq);
		if($enq =='All')
		{
?>
	
	<h1 style="text-align:center;">Website Leads</h1>
<?php }else{?>
	<h1 style="text-align:center;"><?php echo $enq; ?> Leads</h1>
<?php } ?>
<hr>
<div class="control-group" id="blah" style="margin:0% 30% 1% 50%"></div>
	<!-- Manager Remark and Followup Div -->
		<div id="remark_followup" style=" display: none; padding-bottom:20px;">
			<div class="col-md-12 " style="padding-bottom:20px;">
				<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-lg-2 col-md-2 col-sm-2 col-xs-6" style="padding-top:20px;">
						<a type="submit" id="sub" onclick="get_followup_div()" class=""><i style="line-height: 2em;" class="entypo-plus-squared btn btn-info btn-icon ">  Add Followup </i></a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6" style="padding-top:20px;">
                        <a type="submit" id="sub" onclick="get_remark_div()" class=""><i style="line-height: 2em;" class="entypo-plus-squared btn btn-info ">  Add Manager Remark </i></a>
                </div>
			</div><br>
		</div>
		<!-- Add Manager Remark Div --> 		
		<div id="add_remark" style=" display: none;">
			<div class="col-md-12" >
				<div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding:20px;">
					<div class="form-group">
							<input  class=" filter_s col-md-12 col-xs-12 form-control" id="manager_comment" name="manager_comment"  placeholder="Manager Remark" value="" type="text"  >
					</div>
				</div>
				 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6" style="padding-top:20px;">
                 	<a id="sub"  onclick="insert_remark()"> <i class="btn btn-info entypo-check"></i></a>
                </div>
			</div>
		</div>
		<!-- Add Basic Followup -->
		<div id="add_followup" style=" display: none;">
			<div class="col-md-12" >
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-bottom:20px;width: 13%;">
					<div class="form-group ">
						<select class="filter_s col-md-6 col-xs-6 form-control" id="status1" name="status1" required  onchange="select_disposition1();">
							<option value="">Status</option>									
								<?php foreach($select_status as $row)
									{?>
										<option value="<?php echo $row -> status_id; ?>"><?php echo $row -> status_name; ?></option>
								<?php } ?>
							</select>
					
						
						</div>
					</div>
					<div id="disposition_div1" class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-bottom:20px;width: 14%;">
						<div class="form-group">
							<select class="filter_s col-md-12 col-xs-12 form-control" id="disposition1" name="disposition1">
									<option value="">Disposition</option>
							</select>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-bottom:20px;">
						<div class="form-group">
							<input  class=" filter_s col-md-12 col-xs-12 form-control" id="comment" name="comment"  placeholder="Remark" value="" type="text"  >
						</div>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12" style="padding-bottom:20px;width: 13%;">
						<div class="form-group">
							<input  class="datett  filter_s col-md-6 col-xs-6 form-control" id="followupdate"  name="followupdate"  placeholder="N.F.D" value="" type="text" readonly style="background:#F5F5F5; cursor:default;">
							
						</div>
				</div>
					<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12" style="padding-bottom:20px;width: 13%;">
						<div class="form-group">
								<select class="filter_s col-md-6 col-xs-6 form-control" id="eagerness" name="eagerness" >
							<option value="">Eagerness</option>									
							<option value="HOT">HOT</option>		
							<option value="WARM">WARM</option>		
							<option value="COLD">COLD</option>		
							</select>						
						</div>
					</div>
					<div id="disposition_div1" class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-bottom:20px;width: 13%;">
						<div class="form-group">
							<select class="filter_s col-md-12 col-xs-12 form-control" id="buyer_type" name="buyer_type" onclick=" select_buyer_type()">
									<option value="">Buyer Type</option>
									<option value="First">First</option>
									<option value="Exchange">Exchange</option>
									<!--<option value="Buy Used Car">Buy Used Car</option>
									<option value="Sold Used Car">Sold Used Car</option>-->
									<option value="Additional">Additional</option>
							</select>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6" style="padding-bottom:20px;">
						
                          <a id="sub"  onclick="return insert_followup()" title="test tooltip"> <i class="btn btn-info entypo-check"></i></a>
                          <a id="sub"  onclick="get_detail_followup()"> <i class="btn btn-info entypo-doc-text-inv"></i></a>
                        <?php                 
                        
                                $insert= $_SESSION['insert'];
                        if($insert[12]==1)
						{ ?>
                          <a id="sub"  onclick="get_transfer()"> <i class="btn btn-info entypo-switch"></i></a>
                          <?php }
                          ?>
                          
                    </div>
			</div>
		</div>
			<!-- New Car Details Div -->
			<div id="first_div" style=" display: none;">
				<div class=" col-md-12" >
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
						<div class="form-group">
							<select class="filter_s col-md-12 col-xs-12 form-control" id="new_model" name="new_model"   onchange="select_variant();">
									<option value="">New Car Model</option>
									<?php foreach($select_model as $row)
									{
										?>
											<option value="<?php echo $row -> model_id; ?>"><?php echo $row -> model_name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div id="varinat_div" class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div class="form-group">
								<select class="filter_s col-md-12 col-xs-12 form-control" id="new_variant" name="new_variant" >
									<option value="">New Car variant</option>
									<?php foreach($select_variant as $row)
									{?>
									<option value="<?php echo $row -> variant_id; ?>"><?php echo $row -> variant_name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div class="form-group">
								<select class="filter_s col-md-12 col-xs-12 form-control" id="book_status" name="book_status" >
									<option value="">Booking Status</option>
									<option value="No">No</option>
									<option value="Yes">Yes</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Exchange Car Div -->
				<div id="exchange_div" style=" display: none;">
					<div class=" col-md-12" >
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div class="form-group">
								<select class="filter_s col-md-12 col-xs-12 form-control" id="old_make" name="old_make"   onchange="select_model();">
									<option value="">Old Car Make</option>
									<?php foreach ($select_make as $row) {?>
									<option value="<?php echo $row -> make_id; ?>"><?php echo $row -> make_name; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						<div  class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div  id="model_div" class="form-group">
								<select class="filter_s col-md-12 col-xs-12 form-control" id="old_model" name="old_model">
									<option value="">Old Car Model</option>
									<?php foreach($select_model as $row)
									{?>
										<option value="<?php echo $row -> model_id; ?>"><?php echo $row -> model_name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div  class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div class="form-group">
								<select class="filter_s col-md-12 col-xs-12 form-control" id="mfg" name="mfg">
									<option value="">MFG Year</option>
										 <?php
											$year=date('Y');
											for ($i=$year;$i>1980;$i--){
										?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?> </option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div  class=" col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div class="form-group">
								<select class="filter_s col-md-12 col-xs-12 form-control" id="ownership" name="ownership">
										<option value="">Ownership</option>
									    <option value="First">First</option>
                       					<option value="Second">Second</option>
                       					<option value="Third">Third</option>
                        				<option value="More Than Three">More Than Three</option>
                       			</select>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div class="form-group">
								<input  class=" filter_s col-md-12 col-xs-12 form-control" id="color" name="color"  placeholder="Colour" value="" type="text"  >
							</div>
						</div>
						<div  class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div class="form-group">
								<input  class=" filter_s col-md-12 col-xs-12 form-control" id="km" name="km"  placeholder="KMS" value="" type="text"  >
							</div>
						</div>
						<input type="hidden" id="selected_id" name="selected_id"   >
					</div>
				</div>
				<!-- Transfer Lead Div -->
				<div id="transfer_div" style=" display: none;">
					<div class=" col-md-12" >
						<div  class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div class="form-group">
								<select class="filter_s col-md-12 col-xs-12 form-control" id="tlocation" name="tlocation" onchange="select_assign_to()">
									<option value="">Transfer Location</option>
									<?php foreach($get_location1 as $fetch1){?>
									<option value="<?php echo $fetch1 -> location; ?>"><?php echo $fetch1 -> location; ?></option>
                     				 <?php } ?>
                       			</select>
                       		</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
								<div id="assign_div" class="form-group">
									<select class="filter_s col-md-12 col-xs-12 form-control" id="transfer_assign" name="transfer_assign" required >
										<option value="">Assign Name</option>
									</select>
								</div>
						</div>
						<div  class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
							<div class="form-group">
								<select class="filter_s col-md-12 col-xs-12 form-control" id="transfer_reason" name="transfer_reason">
										<option value="">Transfer Reason</option>
									    <option value="Test Drive Alloted">Test Drive Alloted</option>
                       					<option value="Home visit Alloted">Home visit Alloted</option>
                       					<option value="Showroom Visit">Showroom Visit</option>
                        				<option value="Final Deal">Final Deal</option>
                        				<option value="Finance Issue">Finance Issue</option>
                         				<option value="POC">POC</option>
                             			<option value="Final Quotation Required">Final Quotation Required</option>   
                              			<option value="Evaluation Alloted">Evaluation Alloted</option>   
								</select>
							</div>
						</div>
						<div  class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:20px;">
							<div class="form-group">
							<?php $count=count($select_group);
								  $i=0;
								  foreach($select_group as $row2){
								  $i++;?>
								<label class="checkbox-inline"><input type="checkbox" id="group_id<?php echo $i ;?>" name="group_id[]" value="<?php echo $row2 -> group_name; ?>"><?php echo $row2 -> group_name; ?></label>
								<?php  }?>
								<input type="hidden" id="group_count" name="group_count" value="<?php echo $count;?>" >
							</div>
						</div>
					</div>
				</div>
<script>  
jQuery(document).ready(function(){
 $('#results').DataTable();});
</script>		

			<!--- Fetch Table Data -->
			<div class="col-md-12">
			<?php echo $this -> session -> flashdata('message_ajax'); ?>
			</div>
		   	<div class="row">
				<div class="col-md-12" >
					<div class="table-responsive"  style="overflow-x:auto;">
						<table class="result table table-bordered datatable table-responsive" id="results">
						<thead>
							<tr>
								<!-- Show Select box if add followup or remark right 1 -->
								<?php $insert=$_SESSION['insert'];
								if($insert[9]==1 || $insert[10]==1 )
								{?>
								<th> </th>
								<?php } ?>
								<th>Sr</th>
								<th>Interested In</th>
								<?php if($enq=='Transferred')
								{?>
									<th>Transfer From</th>
									<?php } ?>
								<th>Name</th>
								<th>Contact</th>
								<th>Lead Date</th>
								<th>Status</th>
								<th>Disposition</th>
								<th>Call Date</th>
								<th>N.F.D</th>
								<?php
								$view=$_SESSION['view'];
								if($view[10]==1)
								{?>
								<th>Assign To</th>
								<?php } ?>
								<th>Remark</th>
								<?php
								if($view[10]==1)
								{?>
								<th>Manager Remark</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach($select_lead as $fetch){
							$enq_id=$fetch->enq_id;
							$status = $fetch->status;
							$i++;
						
							
							?>
							<tr id='t<?php echo $i; ?>'>
								<input type="hidden" value="<?php echo count($select_lead); ?>" id="lead_count">
								<!-- Add Followup Select Box -->
								<?php
								if($insert[9]==1 || $insert[10]==1 ){?>
								<td>
									<?php 	$data_array=array($fetch->buyer_type,$fetch->model_id,$fetch->variant_id,$fetch->buy_status,$fetch->old_make,$fetch->old_model,$fetch->ownership,$fetch->manf_year,$fetch->color,$fetch->km,$fetch->eagerness);
									 $data_array2 = implode(",", $data_array);?>
									<input type="checkbox" id="<?php echo $i; ?>" name="assignlead"  onclick="get_followup('<?php echo $enq_id; ?>','<?php echo $i; ?>','t<?php echo $i; ?>','<?php   echo $data_array2; ?>');">
								</td>
								<?php } ?>
								
								<td><?php echo $i; ?></td>
								<td><?php echo $fetch -> enquiry_for; ?></td>
								<?php if($enq=='Transferred')
								{?>
									<td><?php echo $fetch -> transfer_by_fname.' '.$fetch->transfer_by_lname; ?></td>
									<?php } ?>
								<td><b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?>/<?php echo $enq;?> " title="Customer Follow Up Details"><?php echo $fetch -> name;
								if($fetch->eagerness=='HOT')
								{?>
									<span class="label label-danger"><?php echo $fetch->eagerness;?></span>
									<?php }else if($fetch->eagerness=='WARM'){?><span class="label label-warning"><?php echo $fetch->eagerness;?></span><?php }
								else{?><span class="label label-success"><?php echo $fetch->eagerness;?></span> <?php }if($enq !="New Lead" && $enq!="Pending Not Attended")
								{//echo "(" . $fetch -> fcount . ")";
								}?></a></b>
								</td>
								<td><?php echo $fetch -> contact_no; ?></td>
								<td><?php echo $fetch -> created_date; ?></td>
								<td><?php echo $fetch -> status_name; ?></td>
								<td><?php echo $fetch -> disposition_name; ?></td>
								<td><?php echo $fetch -> date; ?></td>
								<td><?php echo $fetch -> nextfollowupdate; ?></td>
								<?php
								if($view[10]==1)
								{?>
								<td><?php echo $fetch->fname.' '.$fetch->lname;?></td>
								<?php } ?>
							<td><?php $comment = $fetch -> comment;

												$string = strip_tags($comment);

												if (strlen($string) > 20) {

													// truncate string
													$stringCut = substr($string, 0, 20);

													// make sure it ends in a word so assassinate doesn't become ass...
													$string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
												}
												echo $string;
											 ?></td>
								<?php
								if($view[10]==1)
								{?>
								<td><?php $manager_comment= $fetch->remark;
									$string1 = strip_tags($manager_comment);

												if (strlen($string1) > 20) {

													// truncate string
													$stringCut = substr($string1, 0, 20);

													// make sure it ends in a word so assassinate doesn't become ass...
													$string1 = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
												}
												echo $string1;?></td>
												<?php } ?>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
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
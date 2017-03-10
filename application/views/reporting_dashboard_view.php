<script type="text/javascript" src="<?php echo base_url();?>assets/js/tableExport.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.base64.js"></script>

<script>
	function test()
{
	//alert("hi");
	var f=document.getElementById("fromdate").value;
	
	alert(f);
	
    var t=document.getElementById("todate").value;
    
    alert(t);
    
	if (f > t) {
        alert("please select another date");
        return false;
    }
    
    //Create Loader
	src1 ="<?php echo base_url('assets/images/loader200.gif');?>";
	var elem = document.createElement("img");
	elem.setAttribute("src", src1);
	elem.setAttribute("height", "95");
	elem.setAttribute("width", "85");
	elem.setAttribute("alt", "loader");
	
	document.getElementById("campaign_loader").appendChild(elem);	  
	
	
	$.ajax({
			url:"<?php echo site_url('reporting_dashboard/filter_record'); ?>",
		type:'POST',
		data:{fromdate:f,todate:t},
	success:function(response){$("#display_report").html(response);}
		});
	
	
		}
</script>                       
<!-- Filter-->
<div class="row">
	
	 <div class="x_panel">
	
	 		
	 		
	 		  <div  class="col-md-4">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name"> From Date: </label>
									<div class="col-md-8 col-sm-8 col-xs-12">
							    
                                             	
                                              <input type="text" id="fromdate" value="<?php echo date('Y-m-d'); ?>" class="datett filter_s col-md-12 col-xs-12 form-control"  placeholder="From Date" name="date_of_booking" readonly style="background:#F5F5F5; cursor:default;">
										
									</div>
								</div>

							</div>
	 		
	 		
	 			
							 <div  class="col-md-4">
								<div class="form-group">
								<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">To Date: </label>
										<div class="col-md-8 col-sm-8 col-xs-12">
                                              <input type="text" id="todate" value="<?php echo date('Y-m-d'); ?>" class="datett filter_s col-md-12 col-xs-12 form-control" onblur="return test();" placeholder="Lead Date From" name="date_of_booking"  style="background:#F5F5F5; ">
										
								</div>

							</div>
							</div>
	 		
                   				<div class="pull-right" style="padding-top:20px;">
	
                                       
<a href="#" class="pull-right" onClick ="$('#tbl_report').tableExport({type:'excel',escape:'false'});"><i class="btn btn-defult entypo-download"></i></a>
           </div>
							
                                <!-- <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding:20px;">
                                     <div class="form-group">
                       
                             
                                    <a  onclick="test()" > <i class="btn btn-info entypo-search"></i></button>
                               
                     
                        	<a onclick="clear_data()"> <i class="btn btn-primary entypo-cancel"></i></a>
                            
                      </div>       
                     </div> -->
              
                                </div>
                              
                                </div>
   
<!--Filter Ends-->          

		
<div class="table-responsive"  id="display_report" style="overflow-x:auto;"> 

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
				     
				//	$i=0;
					foreach($select_record1 as $fetch)
					{
						
						     $enq_id=$fetch->enq_id;
							//$i++;
					?>
					<tr>
								
								<td><?php echo $fetch -> created_date; ?></td>
								<td><?php echo $fetch -> enquiry_for; ?></td>
								<td>
									<?php echo $fetch -> lead_source; ?>
									
									
								</td>
								<td><?php echo $fetch -> enqcount; ?></td>
								<td>
									<?php

									$q = $this -> db -> query('select count(enq_id)as contactcount from lead_master l
									join tbl_status s
									ON s.status_id=l.status
									where enquiry_for="' . $fetch -> enquiry_for . '" and
									created_date="' . $fetch -> created_date . '"
									
									and status_name !="Not Yet"
									') -> result();

									echo $q[0] -> contactcount;
									?>
									</td>
						
 					 			<td>
 					 				<?php

									$q = $this -> db -> query('select count(enq_id)as pendingcount from lead_master l
									join tbl_status s
									ON s.status_id=l.status
									where enquiry_for="' . $fetch -> enquiry_for . '" and
									created_date="' . $fetch -> created_date . '"
									and status_name="Not Yet"
									') -> result();

									echo $q[0] -> pendingcount;
									?>
									
 					 				
 					 			</td>
								<td>
									
								<?php

										$q = $this -> db -> query('select count(enq_id)as livecount from lead_master l
									join tbl_status s
									ON s.status_id=l.status
									where enquiry_for="' . $fetch -> enquiry_for . '" and
									created_date="' . $fetch -> created_date . '"
									and status_name= "Live"
									') -> result();

										echo $q[0] -> livecount;
									?>
 					 				
									
									</td>
								<td>
									
										<?php

										$q = $this -> db -> query('select count(enq_id)as lostcount,enq_id from lead_master l
									join tbl_status s
									ON s.status_id=l.status
									where enquiry_for="' . $fetch -> enquiry_for . '" and
									created_date="' . $fetch -> created_date . '"
									and status_name="Lost"
									') -> result();

										echo $q[0] -> lostcount;
									?>
									
 					 				
									
							</td>
							
                            
                           </tr>
						<?php

						}
  ?>
					</tbody>
				</table>
			</div>
			  <!-- date script -->
    <script>
		function clear_data() {
			document.getElementById("myForm").reset();
		}
    </script>
                    
                     <script type="text/javascript">
						$(document).ready(function() {
							$('.datett').daterangepicker({
								singleDatePicker : true,
								format : 'YYYY-MM-DD',
								calender_style : "picker_1"
							}, function(start, end, label) {
								console.log(start.toISOString(), end.toISOString(), label);
							});

							$('#fromdate').daterangepicker({
								singleDatePicker : true,
								format : 'YYYY-MM-DD',
								calender_style : "picker_1"
							}, function(start, end, label) {
								console.log(start.toISOString(), end.toISOString(), label);
							});

							$('#todate').daterangepicker({
								singleDatePicker : true,
								format : 'YYYY-MM-DD',
								calender_style : "picker_1"
							}, function(start, end, label) {
								console.log(start.toISOString(), end.toISOString(), label);
							});

							$(window).load(function() {
								var status = $('#status1').val();
								//alert(status);
								if (status == 'Free Stock') {
									$('#booking').hide();
									$('#tl').hide();
									$('#dse').hide();
									$('#fromdate').hide();
									$('#todate').hide();

								} else {
									$('#booking').show();
									$('#tl').show();
									$('#dse').show();
									$('#fromdate').show();
									$('#todate').show();
								}
							})
							//Code for Hide & Show for select control

							$('#status1').change(function() {

								var selectedValue = this.value;

								if (selectedValue == 'Free Stock') {
									$('#booking').hide();
									$('#tl').hide();
									$('#dse').hide();
									$('#fromdate').hide();
									$('#todate').hide();

								} else {
									$('#booking').show();
									$('#tl').show();
									$('#dse').show();
									$('#fromdate').show();
									$('#todate').show();
								}

							})
						});

						function clear_text() {

							window.location.assign("lms.php");
						}
                    </script>
					
                    
                    <!-- date script -->
         
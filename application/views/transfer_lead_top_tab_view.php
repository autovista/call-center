<script>
function test()
{
	var s=document.getElementById("status").value;
	var a=document.getElementById("transfer_to").value;
	if(document.getElementById("transfer_from")!=null)
	{
		var b=document.getElementById("transfer_from").value;
	}
	var f=document.getElementById("fromdate").value;
	if(document.getElementById("todate")!=null)
	{
		var t=document.getElementById("todate").value;
	}
	//Create loader
	src1 ="<?php echo base_url('assets/images/loader200.gif');?>";
	var elem = document.createElement("img");
	elem.setAttribute("src", src1);
	elem.setAttribute("height", "95");
	elem.setAttribute("width", "85");
	elem.setAttribute("alt", "loader");
	document.getElementById("blah").appendChild(elem);	
	$.ajax({
			url:"<?php echo site_url('transfer_report/tl_filter'); ?>",
			type:'POST',
			data:{status:s,fromdate:f,todate:t,transfer_to:a,transfer_from:b},
			success:function(response){$("#leaddiv").html(response);}
			});

	}
</script>                       
<!-- Filter-->
<div class="row">
	<form action="#" id='myForm' method="post">
	 <div class="x_panel">
	 		
      	<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding:20px;">
	           <div class="form-group">
                    <select class="filter_s col-md-12 col-xs-12 form-control" id="status" name="lead" required>
						<option value="0">All</option>
                                <?php foreach($select_status as $row){?>
									<option value="<?php echo $row -> status_id; ?>"><?php echo $row -> status_name; ?></option>
								<?php } ?>
                    </select>
				 </div>
               </div>
                <?php if($_SESSION['role']!=3) {?>            
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding:20px;">
                        <div class="form-group">
                              <select class="filter_s col-md-12 col-xs-12 form-control" name="user" id="transfer_from" >
									<option value="">Transfer From</option>
										<?php	foreach ($telecaller_transfer_from as $fetch) {?>
												 	<option value="<?php echo $fetch -> id; ?>"><?php echo $fetch -> fname . " " . $fetch -> lname; ?></option> 
										<?php } ?>
                                </select>
							</div>
                        </div>
                        <?php } ?>  
                             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding:20px;">
                        			<div class="form-group">
                                         <select class="filter_s col-md-12 col-xs-12 form-control" name="user" id="transfer_to" >
											<option value="">Transfer To</option>
										<?php	foreach ($telecaller_transfer_to as $fetch) {?>
												 	<option value="<?php echo $fetch -> id; ?>"><?php echo $fetch -> fname . " " . $fetch -> lname; ?></option> 
										<?php } ?>
                                           </select>
									</div>
                                </div>
                          <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                           
											
                                              <input type="text" id="fromdate" value="<?php echo date('Y-m-d');?>" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="From Date" name="date_of_booking" readonly style="background:#F5F5F5; cursor:default;">
										
                                        </div>
                            </div>
                             <?php if($_SESSION['role']==3)
							 {?>       
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                           
											
                                              <input type="text" id="todate" value="<?php echo date('Y-m-d');?>" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="To Date" name="to_booking" readonly style="background:#F5F5F5; cursor:default;">
											
                                        </div>
                           </div>
                           <?php } ?>
                                   <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding:20px;">
                                     <div class="form-group">
                       
                             
                                    <a  onclick="test()" > <i class="btn btn-info entypo-search"></i></button>
                               
                     
                        	<a onclick="clear_data()"> <i class="btn btn-primary entypo-cancel"></i></a>
                            
                      </div>       
                     </div> 
                     
                                </div>
                                </form>
                                </div>
    <!-- date script -->
    <script>
    	function clear_data()
    	{
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

<!--Filter Ends-->                    
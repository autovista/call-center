            

<!--<ol class="breadcrumb bc-3" > <li> <a href=""><i class="fa fa-home"></i>Home</a> </li><li class="active"> <strong>Report</strong> </li> </ol>-->
	

         <script>
 
										function test()
			{
				 		
	
				 var s=document.getElementById("status").value;
				
				//alert(s);
				if(document.getElementById("assign_to")!=null)
				{
				  var a=document.getElementById("assign_to").value;
				}
				//alert(a);
				    var c=document.getElementById("campaign_name").value;
				//alert(c);
			   var d=document.getElementById("dispostion").value;
			  // alert(d);
			  
				var f=document.getElementById("fromdate").value;
					var t=document.getElementById("todate").value;
			//alert(t);
			
		
				
			//var l=document.getElementById("lead_date").value;
				 //alert(lead_date);
			
			
			
				
				//Create Loader
	src1 ="<?php echo base_url('assets/images/loader200.gif'); ?>";
					var elem = document.createElement("img");
					elem.setAttribute("src", src1);
					elem.setAttribute("height", "95");
					elem.setAttribute("width", "85");
					elem.setAttribute("alt", "loader");

					document.getElementById("blah").appendChild(elem);

					$.ajax(
					{
					url:"<?php echo site_url('tracker/tracker_dse_filter'); ?>",
							type:'POST',
							data:{status:s,fromdate:f,assign_to:a,dispostion:d,campaign_name:c,todate:t},
							success:function(response)
							{$("#leaddiv").html(response);}
							});

							}
</script>   
<script>function download_data()
	{
	
				 var status=document.getElementById("status").value;
				
				//alert(s);
				if(document.getElementById("assign_to")!=null)
				{
				  var assign_to=document.getElementById("assign_to").value;
				}
				//alert(a);
				    var campaign_name=document.getElementById("campaign_name").value;
				//alert(c);
			   var disposition=document.getElementById("dispostion").value;
			  // alert(d);
				var fromdate=document.getElementById("fromdate").value;
				window.open("<?php echo site_url();?>tracker/download_data/?status=" +status +"&fromdate="+ fromdate +"&assign_to="+ assign_to +"&disposition="+ disposition +"&camapaign"+ campaign_name,'_self');
					

		
	}</script>      
      <script>
		
					function select_disposition() {
			var status = document.getElementById("status").value;
			//alert(status);

			$.ajax({
			url : '<?php echo site_url('tracker/select_disposition'); ?>',
				type : 'POST',
				data : {'status' : status,

				},
				success : function(result) {
				$("#disposition_div").html(result);
				}
				});
				}
</script>          
<!-- Filter-->
<div class="row">
                        
                            <div class="x_panel">
                         
                            <div class=" col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="campaign_name"  name="campaign_name"   >
											<?php if($enq!='')
											{?>
												 <option value="<?php echo $enq; ?>"><?php echo $enq; ?></option>
											<?php }else{ ?>
													 <option value="">Campaign Name</option>
													 <?php } ?>
													  <option value="All">All</option>
													   <option value="Website">Web</option>
													    <option value="Manual%23Nexa Pune Web">Nexa Pune Web</option>
													    <option value="Manual%23Carwale">Carwale</option>
													   <option value="All">Cardekho</option>
													     <option value="Manual%23IBC">IBC</option>	  
													    <option value="Manual%23Zendesk">Zendesk</option>
													   <option value="Manual%23GSC">GSC</option>
													   <option value="Manual%23FB Comment">FB Comment</option>
													 <?php foreach ($select_campaign as $fetch) {
														 ?>
													 
                                             	<option value="Facebook%23<?php echo $fetch -> enquiry_for; ?>"><?php echo $fetch -> enquiry_for; ?></option>
                                              
                                               <?php } ?>
                                                </select>
											  
                                            </div>
                            </div>
                              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="status" name="lead" required  onchange="select_disposition();">
											<option value="">Select Status</option>
											<option value="All">All</option>
											
											<?php foreach($select_status as $row)
									{?>
										<option value="<?php echo $row -> status_id; ?>"><?php echo $row -> status_name; ?></option>
								<?php } ?>
                                               
                                                </select>
											  
                                            </div>
                            </div>
                                  <div id="disposition_div" class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="dispostion" name="dispostion">
											
													 <option value="">Disposition</option>
                                             	
                                               
                                                </select>
											  
                                            </div>
                            </div>
                                        
                                    
                                    
                                    
                              <?php //if($_SESSION['role']==2 || $_SESSION['role']==1)
							 // {?>       
                           <!--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-top:20px;width:15%">
                        
                                       <div class="form-group">
                                           <div id="txtHint1">
											
                                              <select class="filter_s col-md-12 col-xs-12 form-control" name="user" id="assign_to" >
											
											
												<option value="">Assigned To</option>
										<?php		
													foreach ($select_telecaller as $fetch) {
														
												
 ?>
												 		<option value="<?php echo $fetch -> id; ?>"><?php echo $fetch -> fname . " " . $fetch -> lname; ?></option> 
													 <?php
													}
												  ?>
                                                </select>
												</div>
                                        </div>
                           </div>-->
                           
                            <?php //} ?>
							
                                    
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px; >
                        
                                       <div class="form-group">
                                           
											
                                              <input type="text" id="fromdate" value="<?php //echo date('Y-m-d'); ?>" class="datett filter_s col-md-12 col-xs-12 form-control"  placeholder="Lead Date From" name="date_of_booking" readonly style="background:#F5F5F5; cursor:default;">
										
                                        </div>
                         
                               
                                    
                                    
                                      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;" >
                        
                                       <div class="form-group">
                                           
											
                                              <input type="text" id="todate" value="" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="Lead Date To"   name="date_of_booking" readonly style="background:#F5F5F5; cursor:default;">
										
                                        </div>
                            </div>
                                    
                                    
                                    
                                    
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                           
											
                                            
                                    <a onclick="test()" > <i class="btn btn-info entypo-search"></i></a>
                               
                        	<a href="" onclick="clear()"  > <i class="btn btn-primary entypo-cancel"></i></a>
                            
                              
                                        </div>
                            </div>
                                     
                     
                                </div>
                                </div>
                              <!--  <a class="pull-right" onclick="download_data()" > <i class="btn btn-info entypo-search">Download</i></a>-->
    <!-- date script -->
                         <script>
							function clear() {
								document.getElementById("status").innerHTML = 'All';

								document.getElementById("fromdate").innerHTML = '';
								document.getElementById("assign_to").innerHTML = '';

								document.getElementById("todate").innerHTML = '';
								test();

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

							//Code for Hide & Show for select control

						});

						function clear_text() {

							window.location.assign("lms.php");
						}
						
						function Lead_Date_disabled()
						{
							
						document.getElementById("lead_date").disabled = true;	
							
						}
						
							function from_Date_disabled()
						{
							
						document.getElementById("fromdate").disabled = true;	
							
						}
						
						
						
						
                    </script>
					
<script>
$(document).ready(function(){
    $("#fromdate1").click(function(){
        $("#leaddate1").toggle();
    });
});
</script>
 
 					
<script>
$(document).ready(function(){
    $("#leaddate1").click(function(){
        $("#fromdate1").toggle();
    });
});
</script>
 
                    <!-- date script -->

<!--Filter Ends-->                    
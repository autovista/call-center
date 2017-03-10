    <script>
 		function test()
		{
				var s=document.getElementById("filter_status").value;
				var d=document.getElementById("filter_disposition").value;
				var f=document.getElementById("filter_fromdate").value;
			
				var e=document.getElementById("filter_campaign_name").value;
			 	var c=document.getElementById("filter_campaign_name").value;
			 	if( document.getElementById("filter_assign")!=null)
		{
			 	var a=document.getElementById("filter_assign").value;
			 }
			 else{
			 	var a=<?php echo $_SESSION['user_id'];?>;
			 }
				if(f=='')
				{
					alert('Please Select Date');
					
				}
				else
				{
				
				src1 ="<?php echo base_url('assets/images/loader200.gif');?>";
	var elem = document.createElement("img");
	elem.setAttribute("src", src1);
	elem.setAttribute("height", "95");
	elem.setAttribute("width", "85");
	elem.setAttribute("alt", "loader");
	//elem.style("margin-left", "30%");
	document.getElementById("blah").appendChild(elem);	
				$.ajax(
				{
					url:"<?php echo site_url('website_leads/telecaller_filter'); ?>",
					type:'POST',
					data:{
						filter_assign:a,
						filter_disposition:d,
						filter_status:s,
						filter_fromdate:f,
						enq:e,
						filter_campaign_name:c},
					success:function(response)
					{$("#replacediv").html(response);}
					});
				}
		}
		function clear_fields()
		{
			document.getElementById("telecaller_form").reset();
			
		}
</script>  
<script>
	function select_filter_disposition() {
		if( document.getElementById("filter_status")!=null)
		{
			var filter_status = document.getElementById("filter_status").value;
		}
		$.ajax({
			url : '<?php echo site_url('website_leads/select_disposition_filter'); ?>',
			type : 'POST',
			data : {'filter_status' : filter_status,

			},
			success : function(result) {
			$("#filter_disposition_div").html(result);
			}
			});
			}
</script> 

<div class="row">
                        
                            <div class="x_panel">
                            	<form id="telecaller_form" method="post" action="#">
                      <div class=" col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="filter_campaign_name"  name="filter_campaign_name"   >
											
													 <option value="">Campaign Name</option>
													 
													  <option value="All">All</option>
													   <option value="Website">Website</option>
													    <option value="Carwale">Carwale</option>
													 <?php foreach ($select_campaign as $fetch) {
														 ?>
													 
                                             	<option value="<?php echo $fetch->enquiry_for;?>"><?php echo $fetch->enquiry_for;?></option>
                                              
                                               <?php } ?>
                                                </select>
											  
                                            </div>
                            </div>
                              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="filter_status" name="filter_status" required  onchange="select_filter_disposition();">
												 <option value="">Status</option>
												<?php foreach($select_status1 as $row)
									{?>
										<option value="<?php echo $row -> status_id; ?>"><?php echo $row -> status_name; ?></option>
								<?php } ?>
                                               
                                                </select>
											  
                                            </div>
                            </div>
                         
                                  <div id="filter_disposition_div" class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="filter_disposition" name="filter_disposition">
											
													 <option value="">Disposition</option>
                                             	
                                               
                                                </select>
											  
                                            </div>
                            </div>
                                        
                                    
                              <?php if($_SESSION['role']==2 || $_SESSION['role']==1)
							  {?>
                            <div id="filter_disposition_div" class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="filter_assign" name="filter_assign">
											
													 <option value="">Assign To</option>
                                             	<?php foreach ($select_assign_to as $row) {
													 ?>
													 	 <option value="<?php echo $row->id;?>"><?php echo $row->fname. ' '.$row->lname;?></option>
												<?php } ?>
                                               
                                                </select>
											  
                                            </div>
                            </div>
                            <?php } ?>            
                            
							
                                
                        	  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                    
                                              <input  class="datett filter_s col-md-12 col-xs-12 form-control" name="filter_fromdate" id="filter_fromdate"  placeholder="Date" value="<?php echo date('Y-m-d');?>" type="text" readonly style="background:#F5F5F5; cursor:default;" >
										
                                          
                                        </div>
                            </div>
                             
                                   
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6" style="padding:20px;">
                              
                        	
                                    <a id="sub"  onclick="test()"> <i class="btn btn-info    entypo-search"></i></a>&nbsp;&nbsp;&nbsp;
                            		<a onclick="clear_fields()" > <i class="btn btn-primary entypo-cancel"></i></a>
                                </div>
                            
                     
                      </div>       
                     
                           </div>
                             <!--</div>-->
</form>
<!--Filter Ends-->                    
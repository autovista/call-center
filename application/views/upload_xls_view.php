<script>

function select_campaign()
	{
	var group_id=document.getElementById("group_name").value;
	
	$.ajax({
			url : '<?php echo site_url('upload_xls/select_campaign'); ?>',
			type : 'POST',
			data : {'group_id' : group_id,

			},
			success : function(result) {
			$("#disposition_div").html(result);
			}
			});	
		}
		function select_group(val)
	{
		
		if(val=='Facebook')
		{
			document.getElementById("group_div").style.display="block";
			document.getElementById('group_name').disabled = false;
			document.getElementById("campaign_div").style.display="block";
			document.getElementById('campaign_name').disabled = false;
		}else if(val=='')
		{
			document.getElementById("group_div").style.display="none";
			document.getElementById('group_name').disabled = true;
			document.getElementById("campaign_div").style.display="none";
			document.getElementById('campaign_name').disabled = true;
			}else{
			document.getElementById("group_div").style.display="block";
			document.getElementById('group_name').disabled = false;
			document.getElementById("campaign_div").style.display="none";
			document.getElementById('campaign_name').disabled = true;
		}
		
		if(val=='Carwale')
		{
			document.getElementById("group_div").style.display="block";
			document.getElementById('group_name').disabled = false;
			//document.getElementById("campaign_div").style.display="block";
			//document.getElementById('campaign_name').disabled = false;
		}
}
		
</script>
<div class="row" style="margin-left:0px;margin-right: 0px;">
		<div class="col-md-12" >
				<div class="col-md-12">
				<?php echo $this->session->flashdata('msg');?>
			</div>
				<h1 style="text-align:center;">Upload Excel Leads</h1>
			    
                    
                     <div class="row">
                    <div id="abc">

                 
 <div class="panel panel-primary">
    
     <div class="panel-body">
     
              <form name='import' action="<?php echo $var; ?>" method="post"  enctype="multipart/form-data">
              
						
                     	
						
                     <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                     	
                     	
									<div class="form-group">
                                            
									<label class="control-label col-md-4 col-sm-4 col-xs-12" >Lead Source: </label>
										<div class="col-md-5 col-sm-5 col-xs-12" >
											<select name="lead_source" id="lead_source" class="form-control" onchange="select_group(this.value);" required>
												<option value="">Please Select </option>
												<option value="Web">Web </option>
												<option value="Facebook">Facebook</option>
												<option value="Email">Email </option>
												<option value="Zendesk">Zendesk </option>
												<option value="IBC">IBC</option>
												<option value="GSC">GSC</option>
												<option value="Carwale">Carwale</option>
												<option value="Others">Others</option>
											</select>
											</div>
										</div>

									<div id="group_div" class="form-group" style="display: none">
                                            
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Group Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
								
									       
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="group_name" name="group_name"   onchange="select_campaign();" required disabled>
												 <option value=""> Please Select </option>
											
												<?php
										
										foreach($select_grp as $fetch)
										{
																				
										?>
													
													 <option value="<?php echo $fetch -> group_id; ?>"><?php echo $fetch -> group_name; ?></option>
                                             		<?php
										}
								?>
								<option value="Carwale Pune">Carwale Pune</option>
								<option value="Carwale Mumbai">Carwale Mumbai</option>
								<option value="Carwale Nexa">Carwale Nexa</option>
                                               
                                                </select>
								
									</div>
									
									
								</div>

                     	
                     	
                     		
									<div id="campaign_div" class="form-group" style="display: none">
                                            
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Campaign Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12" id="disposition_div">
										
										
									       
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="campaign_name" name="campaign_name" required disabled>
                                              	 <option value=""> Please Select </option>
											
                                              	<?php
                                              	
                                              	foreach($select_campaign as $fetch)
												{
													
												
                                              	?>
												
											
													 <option value="<?php echo $fetch -> campaign_name; ?>"><?php echo $fetch->campaign_name;?></option>
                                             
                                             <?php
                                              }?>
                                                </select>
										
									
									</div>
									
									
								</div>

                  
                     
                      
                <!--         
                     <input type='file' name='file' /><br />
<input type='submit' name='submit' value='Submit' />-->
  <div class="form-group">
							<label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
								<div class="col-md-5 col-sm-5 col-xs-12">
										<label class="control-label "><font color="red">Please upload only .xls file</font></label>
								</div>
							</div>
    <div class="form-group">
							<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Upload File:</label>
								<div class="col-md-5 col-sm-5 col-xs-12">
									<input type="file"  class="btn btn-info"  name="file" id="file" required  >
								</div>
							</div>
<div class="form-group">
						<div class="col-md-2 col-md-offset-4">

							<button type="submit" class="btn btn-success col-md-12 col-xs-12 col-sm-12">
								Submit
							</button>
						</div>

						<div class="col-md-2">
							<input type='reset' class="btn btn-primary col-md-12 col-xs-12 col-sm-12" value='Reset'>
						</div>
					</div>
</div>
</form>

                    </div>
                    
                    </div>
                    </div>
             

                        </div>
                      
                    </div> 
	
	
               
            </div>
      



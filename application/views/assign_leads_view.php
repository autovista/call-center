<body>
<script>
				function select_cse()
		{
			var location= document.getElementById("user_location").value;
		
			$.ajax({
				url:'<?php echo site_url('assign_leads/select_cse')?>',
				type:'POST',
				data:{location:location},
				success:function(response)
				{$("#leaddiv").html(response);}
				});

				}
		
	</script>
		<div class="row" >
			<div class="col-md-12">
				<?php echo $this->session->flashdata('msg');?>
			</div>
		<h1 style="text-align:center; ">Assign lead to CSE</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">

				<div class="panel-body">
					
					<form name="myform" action="<?php echo $var1; ?>" method="post" >

						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
								<div class="col-md-6">
							 <div class="form-group">
                                                               	
									<label class="control-label col-md-3 col-sm-3 col-xs-4" for="first-name">
										 Location </label>
									<div class="col-md-9 col-sm-9 col-xs-8">
										<select name="location" id="user_location" class="form-control" required onchange="select_cse()">
								
										
                     
                      <option value="">Please Select</option>
                     <?php				
													foreach($location as $row)
													{
														?>
											 <option value="<?php echo $row->location_id;?>"><?php echo $row->location;?></option>
											 
											 <?php } ?>
                   
                    </select>
										</select>
									
									</div>
								</div>
								<div id="leaddiv" class="form-group">
                                                        	
									<!--<label class="control-label col-md-3 col-sm-3 col-xs-4" for="first-name">
										 CSE Name </label>
									<div class="col-md-9 col-sm-9 col-xs-8">
										<?php	//	$leader_query = mysql_query("select * from lmsuser where role='3' and status='1' order by fname asc") or die(mysql_error());
													
													foreach($dse_name as $row)
													{
														?>
											<input type="checkbox" id="cse_name" name="cse_name[]" value="<?php echo $row -> id; ?>" >      <?php echo $row -> fname . " " . $row -> lname; ?><br>
									<?php } ?>
									</div>-->
								</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
                                                               	
									<label class="control-label col-md-7 col-sm-7 col-xs-12" for="first-name">
										 Total (<?php  echo $all_count[0] -> acount; ?>)</label>
								
								</div>
								<?php $web_query = $this->db->query("select lead_source,enquiry_for,count(lead_source) as wcount from lead_master where lead_source!='Facebook' and assign_to_telecaller=0 group by lead_source ") ->result();
											$i=0;
											foreach ($web_query as $row) {
												 
												$i++;
										
												?>
							 <div class="form-group">
                                                               	
									<label class="control-label col-md-7 col-sm-7 col-xs-12" for="first-name">
										<input type='radio'id="web-<?php echo $i ;?>" name='leads1' value="<?php if($row->lead_source==''){echo 'Web'; }else{ echo $row->lead_source ;}?>" onclick="get_web('web_count-<?php echo $i;?>','web-<?php echo $i ;?>');"> <?php if($row->lead_source==''){echo 'Web'; }else{ echo $row->lead_source ;}?> (<?php echo $row->wcount; ?>)</label>
									<div class="col-md-3 col-sm-3 col-xs-12">
										
										<input type='text' id='web_count-<?php echo $i;?>' name='lead_count1' class="form-control" onblur="check_count('w_count-<?php echo $i;?>','web_count-<?php echo $i;?>')" disabled>
										
									<input type='hidden' id="w_count-<?php echo $i;?>" name='web_count' class="form-control" value="<?php  echo $row -> wcount; ?>">
									</div>
								</div>
								<?php } ?>
										
								<input type='hidden' id='all_count' name='all_count' class="form-control" value="<?php echo count($web_query);?>" >
                                                               	
									<input type='hidden' id='campaign_name_count' value=<?php echo count($campaign_name); ?> class="form-control">
										<?php		//$leader_query = mysql_query("select form_id,enquiry_for,count(enquiry_for) as ecount from lead_master where lead_source='Excel' and assign_to_telecaller ='0' group by enquiry_for ") or die(mysql_error());
													$i=0;
															foreach($campaign_name as $row)
													{
														
														$i++;
														?>
														 <div class="form-group">
														<label class="control-label col-md-7 col-sm-7 col-xs-12" for="first-name">
														<input type='radio' id="<?php echo 'c' . $i; ?>" value="<?php echo $row -> enquiry_for ?>" name='leads2' onclick="get_campaign('<?php echo 'l' . $i; ?>','<?php echo 'c' . $i; ?>')"> <?php echo $row -> enquiry_for; ?> (<?php echo $row -> ecount; ?>)</label>
														<div class="col-md-3 col-sm-3 col-xs-12">
										
										<input type='text' id="<?php echo 'l' . $i; ?>" disabled name='lead_count2' class="form-control"  onblur="check_count('<?php echo 'cc' . $i; ?>','<?php echo 'l' . $i; ?>')" >
										<input type='hidden' id="<?php echo 'cc' . $i; ?>" name='campaign_count' class="form-control" value="<?php echo $row -> ecount; ?>">
									</div>
												 		</div>
													 <?php
													}
												  ?>
										
									
								
								</div>
						
						
						<div class="form-group">
							<div class="col-md-2 col-md-offset-5">

								<button type="submit" id="submit_data" class="btn btn-success col-md-12 col-xs-12 col-sm-12" onClick="return validate_button()">
									Submit
								</button>
							</div>

							<div class="col-md-2">
								<input type='reset' class="btn btn-primary col-md-12 col-xs-12 col-sm-12" value='Reset'>

							</div>
						</div>
				</div>
			</div>
			</form>
		</div>

		
	</div>
</div>
	<script src="<?php echo base_url();?>assets/js/campaign.js"></script>

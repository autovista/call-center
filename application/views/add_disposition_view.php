 <script>
		function select_status() {
	var process_id = document.getElementById("process_id").value;
		$.ajax({
			url : '<?php echo site_url('add_disposition/select_status'); ?>',
			type : 'POST',
			data : {'process_id' : process_id,

			},
			success : function(result) {
			$("#disposition_div").html(result);
			}
			});
			}
</script> 
<div class="row" >
		<?php echo $this -> session -> flashdata('message'); ?>
		<?php $insert=$_SESSION['insert'];
if($insert[7]==1)
{?>
		<h1 style="text-align:center; ">Add Disposition</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">

					<form action="<?php echo $var; ?>" method="post">
				<div class="panel-body">

						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							
							
							<div class="col-md-12">
								
									<div class="form-group">
                                            
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Process Name: </label>
									<div  class="col-md-5 col-sm-5 col-xs-12">
										
										
									       
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="process_id" name="process_id" onchange="select_status();" required>
												 <option value=""> Please Select </option>
										
										 <?php foreach ($select_process as $row) {
                          
                      ?>
                      <option value="<?php echo $row -> process_id; ?>"><?php echo $row -> process_name; ?></option>
					  <?php } ?>
							 </select>
							</div>
							</div>
						 <div class="form-group">
                                     
                                      	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Lead Status: </label>
                                               <div class="col-md-5 col-sm-5 col-xs-12" id="disposition_div" >
                                              <select class="filter_s form-control" id="status" name="lead" required>
										
											
													 <option value="">Please Select</option>
                                        </select>
										  </div>
                                            </div>
							
							
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Disposition Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										<input type="text" required onkeypress="return alpha(event)" autocomplete="off" class="form-control" id="name" name="disposition_name">
									</div>
								</div>

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
			</div>
			</form>
		</div>
    <?php } ?>
                    </div> 
	

<div class="col-md-12">
	<?php
	$modify = $_SESSION['modify'];
	$delete = $_SESSION['delete'];
	$form_name = $_SESSION['form_name'];
	 ?>
				<table class="table table-bordered datatable" id="results"> 
					<thead>
						<tr>
							<th>Sr No.</th>
							
							<th>Process Name</th>
							<th>Lead Status</th>
							<th>Disposition Name</th>
							<?php if($modify[7]==1 || $delete[7]==1)  {?>
							<th>Action</th>
						<?php } ?>
							
						</tr>	
					</thead>
					<tbody>
				
					 <?php 
					 $i=0;
						foreach($select_table as $fetch) 
						{
							$i++;
						?>
						
						
						<tr>
								
						<td>	
						
						<?php echo $i; ?> 		
						
						</td>
						
							<td>
							<?php echo $fetch -> process_name; ?>
						</td>
						
						<td>
							<?php echo $fetch -> status_name; ?>
						</td>
						
						
							<td>
							<?php echo $fetch -> disposition_name; ?>
							</td>
								
								<?php if($modify[7]==1 || $delete[7]==1)  {?>
							
							<td>
							<?php if($modify[7]==1) {?>			
						<a href="<?php echo site_url(); ?>add_disposition/edit_dispos?id=<?php echo $fetch -> disposition_id; ?>">Edit</a> &nbsp;&nbsp;
						<?php  }if($delete[7]==1) { ?>	
					 <a href="<?php echo site_url(); ?>add_disposition/del_dispos?id=<?php echo $fetch -> disposition_id; ?>" onclick="return getConfirmation();"> Delete </a>
						
						</a>
						<?php } ?>	
							</td>
								      
                              <?php } ?>                    
						 </tr>
						 
						 	 <?php } ?>
						 
					
					</tbody>
				</table>
			</div>

	
  <script src="<?php echo base_url(); ?>assets/js/campaign.js"></script>    
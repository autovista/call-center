<div class="row" >
		<?php echo $this -> session -> flashdata('message'); ?>
		<?php $insert=$_SESSION['insert'];
if($insert[3]==1)
{?>
		<h1 style="text-align:center; ">Add Group</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">

				<div class="panel-body">
				
					<form action="<?php echo $var; ?>" method="post">

						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							
								<div class="col-md-12">
							
							<div class="form-group">
                                            
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Process Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										
										
									       
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="process_name" name="process_name" required>
												 <option value=""> Please Select </option>
											<?php foreach ($select_process as $fetch) {
											?>	
											
													 <option value="<?php echo $fetch -> process_id; ?>"><?php echo $fetch -> process_name; ?></option>
                                             <?php } ?>
                                             	
                                               
                                                </select>
										
									
									</div>
									
									
								</div>

							
							
						<div class="form-group">
                                            
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Group Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										<input type="text" required onkeypress="return alpha(event)" autocomplete="off" class="form-control" id="name" 
										name="grp_name" >
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
			
			</form>
		</div>

		      </div>    
		       <?php } ?>  
		      </div>  
<div class="row">
<div class="col-md-12" >
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
								<th>Group Name</th>
							
							<?php if($modify[3]==1 || $delete[3]==1)  {?>
							<th>Action</th>
							<?php } ?>
						
							
						</tr>	
					</thead>
					<tbody>
				
			<?php
			
			$i=0;
			
			foreach($select_grp as $fetch)
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
							
							<?php echo $fetch -> group_name; ?>
							
							</td>
								
						
						<?php if($modify[3]==1 || $delete[3]==1)  {?>
							
							<td>
							<?php if($modify[3]==1) {?>
				<a href="<?php site_url(); ?>add_group/edit_grp?id=<?php echo $fetch -> group_id; ?>">Edit </a> &nbsp;&nbsp;
					<?php } if($modify[3]==1) { ?>
					 <a href="<?php site_url(); ?>add_group/del_grp?id=<?php echo $fetch -> group_id; ?>" onclick="return getConfirmation();"> Delete </a>
						
					</a>
						<?php } ?>	
							</td>
							<?php } ?>	
						
						</tr>
						 <?php } ?>
					</tbody>
					
				</table>
				
	
				
				
                   
                      </div>
                   
	
	</div>
	<script  src="<?php echo site_url(); ?>assets/js/campaign.js"></script>
    
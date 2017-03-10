<div class="row" >
	<?php echo $this -> session -> flashdata('message'); ?>
	<?php $insert=$_SESSION['insert'];
if($insert[6]==1)
{?>
		<h1 style="text-align:center; ">Add Status</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">
				<div class="panel-body">
					<form action="<?php echo $var; ?>" method="post">
						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							<div class="col-md-12">
								<div class="form-group">
                                     <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Process Name :</label>
                                      <div class="col-md-5 col-sm-5 col-xs-12">
                                          <select name="process_id" id="process_id" required class="form-control" onchange="get_group();">
								               <option value="">Please Select </option>
								               <?php foreach ($select_process as $row) { ?>
								                <option value="<?php echo $row -> process_id; ?>"><?php echo $row -> process_name; ?></option>
												<?php } ?>                   
                   							</select>
                                       </div>
                                    </div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Status: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										<input type="text" required onkeypress="return alpha(event)" autocomplete="off" class="form-control" id="name" name="status">
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
					<th>Status</th>
				<?php if($modify[6]==1 || $delete[6]==1)  {?>
							<th>Action</th>
							<?php } ?>
				</tr>	
			</thead>
			<tbody>
				<?php 
					 $i=0;
						foreach($select_status as $fetch) 		{
							$i++;
						?>
					<tr>
						<td><?php echo $i; ?> </td>
						<td><?php echo $fetch -> process_name; ?>	</td>
						<td><?php echo $fetch -> status_name; ?></td>
						<?php if($modify[6]==1 || $delete[6]==1)  {?>
							
							<td>
							<?php if($modify[6]==1) {?>					
							<a href="<?php echo site_url(); ?>add_status/edit_status/<?php echo $fetch -> status_id; ?>">Edit </a> &nbsp;&nbsp;
							<?php } if($delete[6]==1) { ?>		
								<a href="<?php echo site_url(); ?>add_status/delete_status/<?php echo $fetch -> status_id; ?>" onclick="return getConfirmation();"> Delete </a>
							</a>
							<?php } ?>									
						</td>
						<?php } ?>
					</tr>
					 <?php } ?>
			</tbody>
		</table>
	</div>
 <script src="<?php echo base_url();?>assets/js/campaign.js"></script>
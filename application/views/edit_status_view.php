	  <script>
function goBack() {
    window.history.back();
}
</script>

<h1 style="text-align:center; ">Edit Status</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">
				<div class="panel-body">				
					<form action="<?php echo $var;?>" method="post">
						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">										
							<div class="col-md-12">
								<?php foreach ($select_status_id as $fetch1) {					?>	
								<div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Process Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										<select class="filter_s col-md-12 col-xs-12 form-control" id="process_id" name="process_id" required>
											 <option value="<?php echo $fetch1->process_id;?>"> <?php echo $fetch1->process_name;?> </option>
											<?php foreach ($select_process as $fetch) {					?>	
											<option value="<?php echo $fetch->process_id;?>"><?php echo $fetch->process_name;?></option>
                                             <?php } ?>
                                             
                                             
                                             
                                         </select>
									</div>
								</div>
								
								<div class="form-group">
									<input type='hidden' name='id' value='<?php echo $fetch1->status_id;?>'>	
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Status: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										<input type="text" required onkeypress="return alpha(event)" autocomplete="off" class="form-control" value="<?php echo $fetch1->status_name;?>" id="name" name="status">
									</div>
								</div>       
                                   <?php } ?>           	
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-2 col-md-offset-4">
								<button type="submit" class="btn btn-success col-md-12 col-xs-12 col-sm-12">Update</button>
							</div>
							<div class="col-md-2">
									<input type='text' class="btn btn-primary col-md-12 col-xs-12 col-sm-12" value='Cancel' onclick="goBack()">
							</div>
						</div>
				</div>
			</div>
		</form>
	</div>           
</div> 
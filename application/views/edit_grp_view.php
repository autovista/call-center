
	  
<!DOCTYPE html>
<html lang="en">

	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>LMS::</title>
	
	
<script type="text/javascript">
         <!--
            function getConfirmation(){
               var retVal = confirm("Do you want to continue ?");
               if( retVal == true ){
                
			return true;
               }
               else{
				   
                return false;
               }
            }
         //-->
      </script>
</head>

	

	<!--<ol class="breadcrumb bc-3" >
		<li>
			<a href="dashboard.php"><i class="fa fa-home"></i>Home</a>
		</li>
		<li class="active">
			<strong>Edit Group </strong>
		</li>
	</ol>-->
	<div class="row" >
			<?php echo $this->session->flashdata('message'); ?>
		<h1 style="text-align:center; ">Edit Group</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">

				<div class="panel-body">
				
					<form action="<?php echo $var1;?>" method="post">

						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							
							
							
							
							<div class="col-md-12">
								
								
								
								
									<div class="form-group">
                                            
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Process Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										
										<?php foreach ($select_grp  as $fetch) {
											?>	
											
									       
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="process_name" name="process_id">
												 <option value="<?php echo $fetch->process_id;?>"> <?php echo $fetch->process_name;?> </option>
												  
                                             	  <?php } ?>
                                             
											
											
											
													<?php foreach ($select_process as $fetch) {
											?>	
											
													 <option value="<?php echo $fetch->process_id;?>"><?php echo $fetch->process_name;?></option>
                                             <?php } ?>
                                             	
                                                	
                                                </select>
										
									
									</div>
									
									
								</div>


								<div class="form-group">
									
									<?php
									
									foreach($select_grp as $fetch)
									{
										
										
										
									
									
									?>
										<input type='hidden' name='id' value='<?php echo $fetch ->group_id;?>'>	
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Group Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										<input type="text"  onkeypress="return alpha(event)" autocomplete="off" class="form-control" id="name" name="grp_name" 
										value="<?php echo $fetch->group_name;?>">
									</div>
								</div>

							</div>
							

						</div>
						<?php
						}
									?>
							<div class="form-group">
							<div class="col-md-2 col-md-offset-4">

								<button type="submit" class="btn btn-success col-md-12 col-xs-12 col-sm-12">Update</button>
							</div>

							<div class="col-md-2">
									<input type='text' class="btn btn-primary col-md-12 col-xs-12 col-sm-12" value='Cancel' onclick="window.location='<?php echo site_url();?>add_group'"/>

							</div>
						</div>
				</div>
			</div>
			</form>
		</div>

		            

                    </div> 
	
	
    
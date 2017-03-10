 
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
	  
	  <script>
function goBack() {
    window.history.back();
}
</script>

</head>

	

	<!--<ol class="breadcrumb bc-3" >
		<li>
			<a href="dashboard.php"><i class="fa fa-home"></i>Home</a>
		</li>
		<li class="active">
			<strong>Edit Department</strong>
		</li>
	</ol>-->
	<div class="row" >
		
		<?php echo $this->session->flashdata('message'); ?>
		
		<h1 style="text-align:center; ">Edit Campaign</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">

				<div class="panel-body">
				
					<form action="<?php echo $var;?>" method="post">

						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							
							
							<div class="col-md-12">
								
											 <?php 
								 
						foreach($select_campaign_id as $fetch1) 
						{
							
									
					?>
									<div class="form-group">
                                            
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Group Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										
										
									       
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="process_name" name="group_id">
												 <option value="<?php echo $fetch1->group_id;?>"> <?php echo $fetch1->group_name;?> </option>
												 
											<?php foreach ($select_grp as $fetch) {
											?>	
											
													 <option value="<?php echo $fetch->group_id;?>"><?php echo $fetch->group_name;?></option>
                                             <?php } ?>
                                             	
                                               
                                                </select>
										
									
									</div>
									
									
								</div>

								
								
								<div class="form-group">
								
					
					
						<input type='hidden' name='id' value='<?php echo $fetch1 ->campaign_id;?>'>	
						
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Campaign Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
					
									<input type="text"  onkeypress="return alpha(event)" autocomplete="off" class="form-control" id="name" value="<?php echo $fetch1->campaign_name;?>"name="campaign_name">
									
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
									<input type='text' class="btn btn-primary col-md-12 col-xs-12 col-sm-12" value='Cancel' onclick="goBack()">

							</div>
						</div>
				</div>
			</div>
			</form>
			
		</div>

		            

                      
                    </div> 
	
	
    
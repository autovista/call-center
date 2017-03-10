
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
         
            function getConfirmation(){
               var retVal = confirm("Do you want to continue ?");
               if( retVal == true ){
                	return true;
               }
               else{
				   
                return false;
               }
            }
         
      </script>
</head>

	

	<!--<ol class="breadcrumb bc-3" >
		<li>
			<a href="dashboard.php"><i class="fa fa-home"></i>Home</a>
		</li>
		<li class="active">
			<strong>Edit Campaign</strong>
		</li>
	</ol>-->
	<div class="row" >
		<h1 style="text-align:center; ">Edit Campaign</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">

					<form action="<?php echo $var1;?>" method="post">
				<div class="panel-body">

						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							
							
							<div class="col-md-12">
							
							 <div class="form-group">
                                     <?php
                                     
                                     foreach ($select_camp as $fetch)
									  {
                                     
									 ?>
									 		<input type='hidden' name='id' value='<?php echo $fetch->campaign_id;?>'>	
                                      	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Select Group Name : </label>
                                               <div class="col-md-5 col-sm-5 col-xs-12">
                                               	
                                               	
                                             <select class="filter_s col-md-12 col-xs-12 form-control" id="grp_name" name="grp_name" required>
												 <option value="<?php echo $fetch->group_name;?>"><?php echo $fetch->group_name;?> </option>
												 <?php } ?>
												 
											<?php
											
											 foreach ($select_table as $fetch2) {
											 											
											?>	
													 <option value="<?php echo $fetch2->group_id;?>"><?php echo $fetch2->group_name;?></option>
                                            <?php } ?>
                                             	
                                               
                                                </select>
                                                
																			
												
											  </div>
                                            </div>
                                            
                                  <div class="form-group">
                                  	
                                  	  <?php
                                     
                                     foreach ($select_camp as $fetch)
									  {
                                     
									 ?>
                                     
                                      	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Select Campaign Name : </label>
                                               <div class="col-md-5 col-sm-5 col-xs-12">
                                               	
                                               	
                                           <select class="filter_s col-md-12 col-xs-12 form-control" id="c_name" name="c_name" required>
												 <option value="<?php echo $fetch->campaign_name;?>"><?php echo $fetch->campaign_name;?> </option>
												 
												 <?php } ?>
											<?php
											
											 foreach ($select_campaign as $fetch1) {
											
											?>	
											
													 <option value="<?php echo $fetch1->enquiry_for;?>"><?php echo $fetch1->enquiry_for;?></option>
                                             <?php } ?>
                                             	
                                               
                                             </select>
                                                
												
										
												
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

		            

                    </div> 
	
	
      
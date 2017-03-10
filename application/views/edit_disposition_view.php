
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
	  	  <script>
function goBack() {
    window.history.back();
}
</script>

      
      <script>
		
			function select_status() {
				
				//alert("hi");
				
			var process_id = document.getElementById("process_id").value;
			//alert(process_id);

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


</head>

	

	<!--<ol class="breadcrumb bc-3" >
		<li>
			<a href="dashboard.php"><i class="fa fa-home"></i>Home</a>
		</li>
		<li class="active">
			<strong>Edit Disposition</strong>
		</li>
	</ol>-->
	<div class="row" >
		<h1 style="text-align:center; ">Edit Disposition</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">

				<div class="panel-body">
					<form action="<?php echo $var1;?>" method="post">

						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							
							
							<div class="col-md-12">
								
										<div class="form-group">
                                            						 <?php 
								 
						foreach($select_dipos as $fetch) 
						{
							
									
					?>
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Process Name : </label>
									<div  class="col-md-5 col-sm-5 col-xs-12">
										
										
									       
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="process_id" name="process_id" onchange="select_status();" required>
												 <option value="<?php echo $fetch->process_id;?>"> <?php echo $fetch->process_name;?> </option>
										
										 <?php foreach ($select_process as $row) {
                          
                      ?>
                      <option value="<?php echo $row->process_id;?>"><?php echo $row->process_name;?></option>
					  <?php } ?>
										
										<!--	<?php foreach ($select_grp as $fetch) {
											?>	
											
													 <option value="<?php echo $fetch->group_id;?>"><?php echo $fetch->group_name;?></option>
                                             <?php } ?>-->
                                             	
                                               
                                                </select>
										
									
									</div>
									
									
								</div>

							
							 <div class="form-group">
                                     
                                      	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Lead Status: </label>
                                               <div class="col-md-5 col-sm-5 col-xs-12" id="disposition_div" >
                                               	
                                              <select class="filter_s form-control" id="status" name="lead" required>
										 
										 
									 
										 <option value="<?php echo $fetch->status_id;?>"> <?php echo $fetch->status_name;?> </option>
										
													
                                             <?php
                                             
                                             
                                           foreach($select_status1 as $fetch1)
										   {
										   	
											?>
										 <option value="<?php echo $fetch1->status_id;?>"><?php echo $fetch1->status_name;?></option>
					  <?php } ?>
											
											
										  
                                             	
                                                
                                                </select>
												
										
												
											  </div>
                                            </div>
								
								
								
								<div class="form-group">
								
				
					<input type='hidden' name='id' value='<?php echo $fetch ->disposition_id;?>'>	
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Disposition Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										<input type="text" required onkeypress="return alpha(event)" autocomplete="off" class="form-control" value="<?php echo $fetch->disposition_name;?>" id="name" name="disposition_name">
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
	
	
      
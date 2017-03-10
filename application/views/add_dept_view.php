

	  
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
			<strong>Add Department</strong>
		</li>
	</ol>-->
	<div class="container" >
		<h1 style="text-align:center; ">Add Department</h1>
		<div class="col-md-12" >
			<div class="panel panel-primary">

				<div class="panel-body">
				
					<form action="<?php echo $var;?>" method="post">

						<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
							
							
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Department Name: </label>
									<div class="col-md-5 col-sm-5 col-xs-12">
										<input type="text" required onkeypress="return alpha(event)" autocomplete="off" class="form-control" id="name" name="dept_name">
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

		            
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var $table4 = jQuery("#table-4");
		$table4.DataTable({
			dom : 'Bfrtip',
			buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
		});
	});
</script> 
<div class="table-responsive">
				<table class="table table-bordered datatable" id="table-4"> 
					<thead>
						<tr>
							<th>Sr No.</th>
							<th>Department Name</th>
							<th>Action</th>
						
							
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
						
						<td>	<?php echo $i;
									?> 		
							</td>
						
						
						
							<td>
							<?php echo $fetch ->dept_name;
							?>
							</td>
								
						
							<td>
							
						<a href="<?php echo site_url();?>add_dept/edit_dept?id=<?php echo $fetch ->dept_id;?>">Edit 
						| <a href="<?php echo site_url();?>add_dept/del_dept?id=<?php echo $fetch->dept_id;?>" onclick="return getConfirmation();"> Delete </a>
						
						</a>
							
							</td>
								
						
						</tr>
						 <?php }?>
					</tbody>
					
				</table>
				
	
				
				
                        </div>
                      
                    </div> 
	
	
    
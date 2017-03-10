<script>
function get_group()
{
	var process_id=document.getElementById("process_id").value;
	
	$.ajax({url: "<?php echo site_url();?>add_lms_user/get_group_name",
	type:"POST",
	data:{process_id:process_id}, 
	success: function(result){
        $("#group_div").html(result)
   } });

}

</script>
<script type="text/javascript">
$(document).ready(function () {
    $('#checkBtn').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("You must check at least one checkbox.");
        return false;
      }

    });
});

</script>
<div class="row" >
	<div class="col-md-12">
<?php echo $this -> session -> flashdata('message'); ?>
</div>
<?php $insert=$_SESSION['insert'];
if($insert[2]==1)
{?>
		   <h1 style="text-align:center; ">Add New LMS User</h1>
<div class="col-md-12" >
 <div class="panel panel-primary">
   
     <div class="panel-body">
                <form name="submit" action="<?php echo $var;?>" method="post" onsubmit="return validate_form()">
                
						
                     <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                         <div class="col-md-6">
                              <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name: 
                                            </label>
                                                   <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <input type="text" required onkeypress="return alpha(event)" placeholder="Enter First Name" autocomplete="off" class="form-control" id="fname" name="fname" >
                                            </div>
                                                               </div>
                                                                 <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name: 
                                            </label>
                                                   <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <input type="text" required  onkeypress="return alpha(event)" placeholder="Enter Last Name" autocomplete="off" class="form-control" id="lname" name="lname">
                                            </div>
                                                               </div>
                           <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                     <input  type="text" autocomplete="off" required class="form-control" id="email" placeholder="Enter Email ID" name="email" >
                                                  
                                            </div>
                                      </div>

                                     <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Moblie Number:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <input type="text" onkeypress="return isNumberKey(event)" onkeyup="return limitlength(this, 10)" placeholder="Enter Moblie Number" autocomplete="off" class="form-control" id="pnum" name="pnum" required>
                                            </div>
                                      </div>
                                      
                                      
                                      
                                      
                             
                            
                            
                        
                         </div>
                         <div class="col-md-6">
                          
                                       
                                      
                           
															   
															   <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Location:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <select name="location" id="location" required class="form-control" >
                      <option value="">Please Select  </option>
                      <?php foreach ($select_location as $row) {
                          ?>
                      
                      <option value="<?php echo $row->location_id;?>"><?php echo $row->location;?></option>
                      <?php }?>
                   
                    </select>
                                            </div>
                                      </div>
                             
															   <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Role:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <select name="role" required id="role" class="form-control" >
                      <option value="">Please Select </option>
                     <!-- <option value="1">Admin</option>-->
                      <option value="2#Manager">Manager</option>
					  <option value="2#Team Leader">Team Leader</option>
					  	  <option value="3#CSE">CSE</option>
              		  <option value="4#DSE">DSE</option>
                   
                    </select>
                                            </div>
                                      </div>
                           <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Process:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <select name="process_id" id="process_id" required class="form-control" onchange="get_group();">
                      <option value="">Please Select </option>
                      <?php foreach ($select_process as $row) {
                          
                      ?>
                      <option value="<?php echo $row->process_id;?>"><?php echo $row->process_name;?></option>
					  <?php } ?>
                   
                    </select>
                                            </div>
                                      </div>
                               </div></div>
                              <div class="col-md-12 form-group" id="group_div"></div>
                               

                         
                  
                    <div class="form-group">
                     <div class="col-md-2 col-md-offset-4">
                    	
						
                    <button type="submit" id="checkBtn" class="btn btn-success col-md-12 col-xs-12 col-sm-12">Submit</button>
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
<?php } ?>

<script>  
jQuery(document).ready(function(){
 $('#results').DataTable();});
</script>		


<div class="table-responsive"  style="overflow-x:auto;">
	<?php 
	 $modify=$_SESSION['modify'];
	 $delete=$_SESSION['delete'];  
	  $form_name=$_SESSION['form_name'];  
	 ?>
<table class="result table table-bordered datatable table-responsive" id="results">
<thead> 
<tr> 
<th>Sr No.</th>
							<th> Name</th>
							<th>Email Id</th>				
                            <th>Contact</th>		
							
						
							<th>Location</th>
							<th>Role</th>
								<th>Process</th>
								<?php if($modify[2]==1 || $delete[2]==1)  {?>
							<th>Action</th>
							<?php }?>
							
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
							<?php echo $fetch ->fname.' '.$fetch->lname ;
							?>
							</td>
								
							<td>
							<?php echo $fetch ->email;
							?>
							</td>	
						
							<td>
							<?php echo $fetch ->mobileno;
							?>
							</td>
								
												
							<td>
							<?php echo $fetch ->location;
							?>
							</td>	
									
							<td>
							
							
							<?php echo $fetch ->role_name;
							/*
							if ($fetch->role == 1) {
											echo 'Admin';
										} elseif ($fetch->role == 2) {
											echo 'Team Leader';

										} elseif($fetch->role==3) {
											echo 'CSE';
										} elseif($fetch->role==4) {
											echo 'DSE';
										}
							
							*/
							?>
							
							
							</td>
									
										
						
									
					
							<td>
							<?php echo $fetch ->process_name;
							?>
							</td>		
										
					
                               
						    <?php if($modify[2]==1 || $delete[2]==1)  {?>
							<td>
								<?php if($modify[2]==1) {?>
								<a href="<?php echo site_url();?>add_lms_user/edit_user?id=<?php echo $fetch ->id;?>">Edit </a> &nbsp;&nbsp;
								<?php }   if($delete[2]==1) {?>
								<a onclick="return getConfirmation();" href="<?php echo site_url();?>add_lms_user/delete_user?id=<?php echo $fetch ->id;?>">Delete </a>
		<?php } ?>
							</td>
							<?php } ?>
						</tr>
						 <?php }?>
					</tbody>
 
 </table> 
</div>

<script src="<?php echo base_url();?>assets/js/campaign.js"></script>



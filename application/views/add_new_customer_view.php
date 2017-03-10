<script>	
function select_cse()
{
	var location= document.getElementById("location1").value;
	$.ajax({
				url:'<?php echo site_url('add_new_customer/select_cse')?>
				',
				type:'POST',
				data:{location:location},
				success:function(response)
				{$("#csediv").html(response);}
				});

				}				
</script>

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
		  
	<div class="col-md-12" >
		
		<h1 style="text-align:center;">Add New Customer Lead Details</h1>
		<div class="panel panel-primary">

			<div class="panel-body">
				<form name="submit" action="<?php echo $var;?>" method="post" onsubmit="return validate_form()" >

					<div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
						
						<div class="col-md-12">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >Name: </label>
								<div class="col-md-9 col-sm-9 col-xs-12">
										
									<input type="text" required onkeypress="return alpha(event)"   placeholder="Enter Name" class="form-control" id="fname" name="fname">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >Email: </label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									
									<input type="text" class="form-control" id="email1" name="email" placeholder="Enter Email ID" >
									

								</div>
							</div>
						

					
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >Moblie Number: </label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<input type="text" onkeypress="return isNumberKey(event)" placeholder="Enter Moblie Number" onkeyup="return limitlength(this, 10)" class="form-control" id="pnum" name="pnum" required>
								</div>
							</div>
							
								<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >Address:</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
										<textarea name='address' class="form-control"></textarea>
									
								</div>
							</div>
							
								
							

						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >Lead Source: </label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select name="lead_source" id="lead_source" class="form-control" required>
										<option value="">Please Select </option>
										<option value="Web">Web </option>
										<option value="Zendesk">Zendesk </option>
										<option value="IBC">IBC</option>
										<option value="GSC">GSC</option>
										<option value="Email">Email</option>
										<option value="Reference">Reference</option>
										<option value="Walk In">Walk In</option>
										<option value="FB Comment">FB Comment</option>
										
									
									</select>
								</div>
							</div>
							
								<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >Location: </label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<select name="location1" id="location1" class="form-control" required onchange='select_cse()'>
										<option value="">Please Select </option>
										<?php 
										foreach($select_location as $row)
										{
											?>
											<option value="<?php echo $row->location_id;?>"><?php echo $row->location;?></option>
											<?php
										}
										?>
									
									</select>
								</div>
							</div>
							
							
							
							<div id='csediv'>
	<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" >Assign To: </label>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<select name="assign" id="assign" class="form-control" required >
										
											
							                      <option   value=""> Please Select </option>
					<!--<?php
					foreach($select_user as $fetch)
					{
					
					?>
                     
					 	<option value="<?php echo $fetch->id; ?>"><?php echo $fetch->fname;?><?php " "?> <?php echo $fetch->lname; ?></option>
                   
					  
					  
					  <?php } ?>-->
                
												
										</select>
									</div>
								</div>
								</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >Comment: </label>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<textarea name='comment'  class="form-control" ></textarea>
								</div>
							</div>

						</div>
						
						</div>


				<div class="row">

					<div class="form-group">
						
								<label class="control-label col-md-2 col-sm-2 col-xs-12" >Group Name: </label>
						
								<div class="col-md-10 col-sm-10 col-xs-12" >
								
						
								

									<label class="checkbox-inline"><input type="checkbox" name="dept[]" value="New Car">New Car </label>
									<label class="checkbox-inline"><input type="checkbox" name="dept[]" value="Used Car" >Used Car </label>
									<label class="checkbox-inline"><input type="checkbox" name="dept[]" value="Insurance">Insurance </label>
									<label class="checkbox-inline"><input type="checkbox" name="dept[]" value="Finance">Finance </label>
									<label class="checkbox-inline"><input type="checkbox" name="dept[]" value="Service">Service </label>
								</div>
							</div>
					
				</div>
			
			
			
					
	</div>
					<div class="form-group">
						<div class="col-md-2 col-md-offset-4">

							<button type="submit" id="checkBtn" class="btn btn-success col-md-12 col-xs-12 col-sm-12">
								Submit
							</button>
						</div>

						<div class="col-md-2">
							<input type='reset' class="btn btn-primary col-md-12 col-xs-12 col-sm-12" value='Reset'>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
	

	
<?php
	
	if ($_SESSION['role'] == 1)
	 {
		
			
		
	} 
	
	else if ($_SESSION['role'] == 2)
	 {
		
			
	} 
		
	else
	 {
			
		?>	
<div class="table-responsive"  style="overflow-x:auto;">
						<table class="result table table-bordered datatable table-responsive" id="results">
					<thead>
						<tr>
							<th>Sr No.</th>
							
							<th>Interested In</th>
							
							<th>Name</th>
							
							<th>Contact</th>
							
							<th>Lead Date</th>
							
							<th>Status</th>
							
							<th>Disposition</th>
							
							<th>Call Date</th>
							
							<th>N.F.D</th>
							
							<th>Assign To</th>
							
							<th>Customer Comment</th>

							<th>Remark </th>							
							
							<th>Address</th>
							<!--<th>Location</th>-->
						
							<th>Action</th>
						
							
						</tr>	
					</thead>
					<tbody>
				
		 <?php 
					 $i=0;
			foreach($select_customer as $fetch )
			{
				
				$i++;
		
			
			
			?>
			
						<tr>
								
						<td>	
					<?php echo $i;
									?> 		
						</td>
						
						<td><?php echo $fetch->enquiry_for;?></td>
						
						<td>
							<?php echo $fetch ->name;
							?>
						</td>
						
						
						
								
									<td>
							
							<?php echo $fetch->contact_no;?>
							</td>
							
									
							<td>
							
							<?php echo $fetch->created_date;?>
							</td>
							
								
							<td>
							
							<?php echo $fetch->status_name;?>
							</td>
								 
								 
							<td>
							
							<?php echo $fetch->disposition_name;?>
							</td> 
                                 	  
							
							  
								     
						
                                 	
                             <td>
							
							<?php echo $fetch->date;?>
							</td> 
                                 	
                                 	
                             <td>
							
							<?php echo $fetch->nextfollowupdate;?>
							</td> 
                                 	
                                 	
							<td>
							
							<?php echo $fetch->fname;?><?php echo " ", $fetch->lname;?>
							</td>
							
							
						<td>
								   	
								   	
								   	<?php
									// echo $fetch->comment;

									
									$comment=$fetch->comment;

									$string = strip_tags($comment);

									if (strlen($string) > 25) {

									// truncate string
									$stringCut = substr($string, 0, 25);

									// make sure it ends in a word so assassinate doesn't become ass...

									$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
									}
									echo $string;
								?> 
									
									
								   	
								   	
								   </td>
							<td><?php 
								$comment1=$fetch->remark;

									$string = strip_tags($comment1);

									if (strlen($string) > 25) {

									// truncate string
									$stringCut = substr($string, 0, 25);

									// make sure it ends in a word so assassinate doesn't become ass...

									$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
									}
									echo $string;
								?></td>
					   
							
							<td>
							
						<?php echo $fetch->address;?>
							</td>  
							
							           
							           	<td>
								<a href="<?php site_url();?>add_new_customer/edit_customer?id=<?php echo $fetch->enq_id;?>">Edit 
						| <a href="<?php site_url();?>add_new_customer/del_customer?id=<?php echo $fetch->enq_id;?>" onclick="return getConfirmation();"> Delete </a>
						
							
							</td>      
							         
							                 
						 </tr>
						
						 	 <?php }?>
					</tbody>
					
					
				</table>
				
	
				
				
                        </div>
                        <?php
		}
	
	
	?>	
	
                      
	
	<script src="<?php echo base_url();?>assets/js/campaign.js"></script>



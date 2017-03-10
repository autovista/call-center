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

<script type="text/javascript" class="init">
	$(document).ready(function() {
		$('#example').dataTable({
			"bSort" : false,
			dom : 'Bfrtip',
			buttons : ['csvHtml5']
		});
	}); 
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#myModal').modal({
			backdrop : 'static',
			keyboard : false
		});
	}); 
</script>


<script>
	function validate_form() {

		var phone1 = document.forms["submit"]["pnum"].value;
		var x = document.forms['submit']['email'].value;

		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {

			alert("Not a valid e-mail address!");
			return false;
			email.focus();
		}
		var no = /^\d{10}$/;

		if (no.test(phone1)) {
			//	return true;
		} else {
			alert("Phone Number must be 10 Digit!");

			return false;
			phone.focus();
		}

	}

	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		// Added to allow decimal, period, or delete
		if (charCode == 110 || charCode == 190 || charCode == 46)
			return true;

		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;

		return true;
	}

	function limitlength(obj, length) {
		var maxlength = length
		if (obj.value.length > maxlength)
			obj.value = obj.value.substring(0, maxlength)
	}

	function alpha(e) {
		var k;
		document.all ? k = e.keyCode : k = e.which;
		return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
	}


	$(document).ready(function() {
		$("#fname").keypress(function(event) {
			var inputValue = event.which;
			// allow letters and whitespaces only.
			if ((inputValue > 47 && inputValue < 58) && (inputValue != 32)) {
				event.preventDefault();
			}
		});
	});

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

<script>
function goBack() {
    window.history.back();
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
<!--<ol class="breadcrumb bc-3" >
	<li>
		<a href="dashboard.php"><i class="fa fa-home"></i>Home</a>
	</li>
	<li class="active">
		<strong>Add New LMS User</strong>
	</li>
</ol>-->
<div class="row" >
		   <h1 style="text-align:center; ">Edit LMS User</h1>
<div class="col-md-12" >
 <div class="panel panel-primary">
   
     <div class="panel-body">
     	
                <form name='submit'action="<?php echo $var1;?>" method="post" onsubmit="return validate_form()">
                
						
                     <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
					 
					 			 
					 
                         <div class="col-md-6">
                              <div class="form-group">
							  
					
						 <input type='hidden' name='id' value='<?php echo $edit_user[0] ->id;?>'>		  
							  
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name: 
                                            </label>
                                                   <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <input type="text" required onkeypress="return alpha(event)" autocomplete="off" class="form-control" value="<?php echo $edit_user[0] ->fname;?>" id="fname" name="fname" >
                                            </div>
                                                               </div>
                                                                 <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name: 
                                            </label>
                                                   <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <input type="text" required  onkeypress="return alpha(event)" autocomplete="off" class="form-control"  value="<?php echo $edit_user[0] ->lname;?>"id="lname" name="lname">
                                            </div>
                                                               </div>
                           <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                     <input  type="text" autocomplete="off" class="form-control" value="<?php echo $edit_user[0] ->email;?>" id="email" name="email" >
                                                  
                                            </div>
                                      </div>

                                     <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >Moblie Number:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <input type="text" onkeypress="return isNumberKey(event)" onkeyup="return limitlength(this, 10)" autocomplete="off" class="form-control" value="<?php echo $edit_user[0] ->mobileno;?>" id="pnum" name="pnum" required>
                                            </div>
                                      </div>
                                      
                                      
                                      
                                      
                             
                            
                            
                        
                         </div>
                         <div class="col-md-6">
                          
                                  
                            
                                      
                          
															   
															   <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Location:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <select name="location" id="location" class="form-control" >
                      <option value="<?php echo $edit_user[0]->location_id; ?>"> <?php echo $edit_user[0]->location; ?>  </option>
                 <?php  foreach($select_location as $fetch1)
					{
					
					?>
					 <option value="<?php echo $fetch1->location_id; ?>"> <?php echo $fetch1->location; ?>  </option>
					 <?php } ?>
                    </select>
                                            </div>
                                      </div>
                             
															   <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Role:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                  <select name="role" id="role" class="form-control" >
                      <?php /*
				if($edit_user[0]->role == '2')
				{
					
					?>
					<option value="<?php echo $edit_user[0]->role;?>">Team Leader</option>
										 
									<?php	}
									
									 else if($edit_user[0]->role =='3')
										 {
											 ?>
											 <option value="<?php echo $edit_user[0]->role;?>">CSE</option>
										<?php	}
										
										 else if($edit_user[0]->role =='4')
										 {
											 ?>
											 <option value="<?php echo $edit_user[0]->role;?>">DSE</option>
										<?php	}
										*/
										?>
								
									
									

                    <option value="<?php echo $edit_user[0]->role.'#'.$edit_user[0]->role_name;?>"><?php echo $edit_user[0]->role_name?></option>
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
                                                                            <select name="process_id" id="process_id" class="form-control" onchange="get_group();">
                      <option   value="<?php echo $edit_user[0]->process_id; ?>"> <?php echo $edit_user[0]->process_name; ?></option>
					<?php
						
					foreach($select_process as $fetch2)
					{
					
					?>
                     
					 	<option value="<?php echo $fetch2->process_id; ?>"><?php echo $fetch2->process_name; ?></option>
                   
					  
					  
					  <?php } ?>
                    </select>
                                            </div>
                             </div>
                                      </div>
 <div class="col-md-12 form-group" id="group_div">
 	<label class="control-label col-md-2 col-sm-2 col-xs-12" >Group Name: </label>
 	
                                                 <div class="col-md-9 col-sm-9 col-xs-12">    
                                                <?php foreach ($edit_user as $fetch) {
		 
	 ?>
                                                  	<input type="checkbox"  checked="checked" name="group_id[]" value="<?php echo $fetch->group_id;?>" >&nbsp;&nbsp;<?php echo $fetch->group_name;?>  </label>
                                                 
<?php } ?></div></div>

                              
               
                         
                     
                    </div>
                    <div class="form-group">
                     <div class="col-md-2 col-md-offset-5">
                    	
						<button type="submit" id="checkBtn" class="btn btn-success col-md-12 col-xs-12 col-sm-12">Update</button>
          
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


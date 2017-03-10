
<!--<ol class="breadcrumb bc-3" > <li> <a href="index.php"><i class="fa fa-home"></i>Home</a> </li><li class="active"> <strong>Add Remark</strong> </li> </ol>-->
	
	

  <div class="container body" style="width: 100%;">


       
	<div class="container" style="background-color:#fff;margin-top:55px;padding-left:5px;">
		<div class="col-md-12" >
			    <h1 style="text-align:center;">Add Remark</h1>
			<div class="panel panel-primary">
 
     <div class="panel-body">
			      
                   <form action="<?php echo $var;?>" method="post">
                	<input type="hidden" name="booking_id" value="<?php echo $id; ?>">
							<input type="hidden" name="enquiry_for" value="<?php echo $select_lead[0]->enquiry_for; ?>">
							<input type="hidden" name="location" value="<?php echo $location; ?>">
                     <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                         <div class="col-md-12">
                              
                     

                                  
                                      
                                      
                                       <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status: 
                                            </label>
                                                   <div class="col-md-9 col-sm-9 col-xs-12">
                                                       <select name="status" class="form-control" required>
                                                       	<option value="">Select Status</option>
                                		<option value="1">Not Yet</option>
                                		<option value="2">Live</option>
                                		<option value="3">Postpone</option>
                                		<option value="4">Lost</option>
                                		<option value="5">Convert</option>
                                </select>
                                            </div>
                                                               </div>
       					  
                           <div class="form-group">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Remark:
                                            </label>
                                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea placeholder="Remark" name='comment' required class="form-control" /></textarea>
                                            </div>
                                                               </div>



                              
                        </div>
                         
                     
                    </div>
                    <div class="form-group">
                     <div class="col-md-2 col-md-offset-5">
                    	
						
                    <button type="submit" class="btn btn-success col-md-12 col-xs-12 col-sm-12">Submit</button>
                         </div>
                       
                        <div class="col-md-2">
                        	<input type='reset' class="btn btn-primary col-md-12 col-xs-12 col-sm-12" value='Reset'>
                           
                        </div>
                    </div>
                    
                </form>
             </div>
            </div>
        					
	
            </div>
            <div class="col-md-12">
       	<script type="text/javascript">
	jQuery(document).ready(function($) {
		var $table4 = jQuery("#table-4");
		$table4.DataTable({
			dom : 'Bfrtip',
			buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
		});
	});
</script> 
				<table class="table table-bordered datatable" id="table-4"> 
					<thead>
						<tr>
							<th>Sr No.</th>
							<th>Date</th>
							 <th>Remark</th>	
							  <th>Status</th>				
                          
                            
						</tr>	
					</thead>
					<tbody>
						<?php
						
					$i=0;
						foreach($select_remark as $fetch)
						{
							$date=$fetch->creation_date;
							$remarks=$fetch->lead_remarks;
							$status=$fetch->lead_status;
							$i++;
						?>
						<tr>
							<td><?php echo $i; ?></td>
								
								<td><?php
								echo $date;
								 ?>
								 </td>
								 <td>
								 <?php
							echo $remarks;
						?></td>
							 <td>
								 <?php
								 if($status =='1')
								 {
								 	echo 'Not Yet';
								 }
								 if($status=='2')
								 {
								 	echo 'Live';
								 }
								 if($status=='3')
								 {
								 	echo 'Postponed';
								 }
								 if($status=='4')
								 {
								 	echo 'Lost';
								 }
								  if($status=='4')
								 {
								 	echo 'Converted';
								 }
								 
						?></td>
                              
								
                               
						</tr>
						<?php } ?>
					</tbody>
					
					
				</table>
</div>
		</div>
		</div>

		
   
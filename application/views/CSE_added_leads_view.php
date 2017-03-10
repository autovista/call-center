
<script>
			function test()
	{
		
	var l=document.getElementById("status").value;
	//alert(l);


  // var d=document.getElementById("dispostion").value;
	
   //alert(d);

	var a=document.getElementById("assign_to").value;

    //alert(a);	


	var f=document.getElementById("fromdate").value;
    //alert(f);
    var t=document.getElementById("todate").value;
 
   
//	var e=document.getElementById("enq").value;
//Create Loader
	src1 ="<?php echo base_url('assets/images/loader200.gif');?>";
	var elem = document.createElement("img");
	elem.setAttribute("src", src1);
	elem.setAttribute("height", "95");
	elem.setAttribute("width", "85");
	elem.setAttribute("alt", "loader");
	
	document.getElementById("blah").appendChild(elem);	  
	$.ajax(
{
	url:"<?php echo site_url('cSE_added_leads/tl_filter'); ?>
	",
	type:'POST',

	data:{filter_status:l,filter_assign:a,filter_fromdate:f,filter_todate:t},

	success:function(response)
	{$("#leaddiv").html(response);}
	});

	}
</script>
<!--
<script>
		
			function select_disposition() {
				
				//alert("hi");
				
			var status = document.getElementById("status").value;
			//alert(status);

			$.ajax({
			url : '<?php echo site_url('CSE_added_leads/select_disposition'); ?>',
			type : 'POST',
			data : {'status' : status,

			},
			success : function(result) {
			$("#disposition_div").html(result);
			}
			});
			}
</script> -->

<!-- Filter-->
 <div class="container" style="width: 100%;">
<div class="row">

	<div class="x_panel">
<form id="form_cse_filter" action="#" method="post">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding:20px;">

		<div class="form-group">
		<div id="txtHint1">

		<select class="filter_s col-md-12 col-xs-12 form-control" name="user" id="assign_to" >

		<option value="">CSE Name </option>
		<?php
		foreach ($select_telecaller as $fetch) {

		?>
		<option value="<?php echo $fetch -> id; ?>
		"><?php echo $fetch -> fname . " " . $fetch -> lname; ?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
</div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="status" name="status" required>
											<option value="">Select Status</option>
													 <?php foreach($select_status as $row)
									{?>
										<option value="<?php echo $row -> status_id; ?>"><?php echo $row -> status_name; ?></option>
								<?php } ?>
                                               
                                                </select>
											  
                                            </div>
                           </div>
                            

    <!--<div id="disposition_div" class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="dispostion" name="dispostion">
											
													 <option value="">Dispostion</option>
                                             	
                                               
                                                </select>
											  
                                            </div>
                      </div>-->
                                        
                                    






<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">

	<div class="form-group">

		<input type="text" id="fromdate" value="<?php echo date('Y-m-d');?>" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="From Date" name="date_of_booking" readonly style="background:#F5F5F5; cursor:default; ">

	</div>
</div>





<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">

	<div class="form-group">

		<input type="text" id="todate" value="<?php echo date('Y-m-d') ?>" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="To Date" name="to_booking" readonly style="background:#F5F5F5; cursor:default;">

	</div>
</div>


		    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6" style="padding:20px;">

			      <a id="sub"  onclick="test()"> <i class="btn btn-info  entypo-search"></i></a>
		</div>

		 <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6" style="padding:20px;">
		<a onclick="clear_data()"> <i class="btn btn-primary entypo-cancel"></i></a>

		</div>
	</form>


</div>
</div>

</div>
<!-- date script -->

          <script>
			function clear_data() {
				
				document.getElementById("form_cse_filter").reset(); 
				/*document.getElementById("status").innerHTML = 'All';

				document.getElementById("fromdate").innerHTML = '';
				document.getElementById("assign_to").innerHTML = '';

				document.getElementById("todate").innerHTML = '';
				test();*/

			}
    </script>
                    

<script type="text/javascript">
	$(document).ready(function() {
		$('.datett').daterangepicker({
			singleDatePicker : true,
			format : 'YYYY-MM-DD',
			calender_style : "picker_1"
		}, function(start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});

		$('#fromdate').daterangepicker({
			singleDatePicker : true,
			format : 'YYYY-MM-DD',
			calender_style : "picker_1"
		}, function(start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});

		$('#todate').daterangepicker({
			singleDatePicker : true,
			format : 'YYYY-MM-DD',
			calender_style : "picker_1"
		}, function(start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});

		
		
		
	});

	function clear_text() {

		window.location.assign("lms.php");
	}
</script>

<!-- date script -->

<!--Filter Ends-->

	
	
	
	
	
	
    <div class="container body" style="width: 100%;">


        <div  id="leaddiv" class="main_container">

<div class="control-group" id="blah" style="margin:0% 30% 1% 50%">
				
				</div>





                    <div id="abc">
<?php
$today = date('d-m-Y');
?>
  <script>    jQuery(document).ready(function(){
    $('#results').DataTable();
});</script>

                       <h1 style="text-align:center;">
                       	
                       	CSE Added Leads</h1>
                       <div class="table-responsive"  style="overflow-x:auto;"> 
				<table class="table table-bordered datatable table-responsive"" id="results"> 
						<thead>
						<tr>
							<th>Sr No.</th>
							<th>Interested In</th>
                            <th>Name</th>							
							<th>Contact</th>			
							<!--<th>Email</th>-->
							<th>Lead Date</th>
                            <th>Status</th>
                           	 <th>Disposition</th>
                           	 	 <th>Call Date</th>
                           	 	 	 <th>N.F.D</th>
                           	<th>Added By</th>
							<th>Assign To</th>
							<th>Customer Comment </th>
							<th>Remark</th>
							<!--<th>Action</th>-->
					</thead>
					<tbody>
				
				<?php
				$i=0;
						
				foreach($select_lead as $fetch)
				
				{
						
					
							$enq_id=$fetch->enq_id;
							$i++;
						
					
			
				?>
				
						<tr>
								<td><?php echo $i; ?></td>
					
									<td><?php echo $fetch -> enquiry_for; ?></td>
								
                                  <td><b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?>/<?php echo $enq;?> "><?php echo $fetch -> name; ?></a></b></td>
                                  	
								<td><?php echo $fetch -> contact_no; ?></td>
								<td><?php echo $fetch -> created_date; ?></td>
								<td><?php echo $fetch -> status_name; ?></td>
								<td><?php echo $fetch -> disposition_name; ?></td>
								<td><?php echo $fetch -> date; ?></td>
								<td><?php echo $fetch -> nextfollowupdate; ?></td>
                                 <td>
									<?php
									echo $fetch -> manual_lead;
									?>
								</td>
							
									   
								   <td><?php
										echo $fetch -> fname . " " . $fetch -> lname;
									?></td>
								   
								
								   
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
					
									
					
					
		
						</tr>
						<?php } ?>	
					</tbody>
					
					
				</table>
                   <br />
 </div> 
          </div> 
         
             </div>
             </div>       


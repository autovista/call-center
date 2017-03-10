
<script>

	function test()
	{
	//alert("hi");			
	var m=document.getElementById("model").value;
   	//alert(m);
  	 var l=document.getElementById("assigned_location").value;
   	//alert(l);
	var cd=document.getElementById("created_date").value;
	//alert(cd);
 	
	$.ajax(
{
	url:"<?php echo site_url('new_car_stock/new_stock_filter'); ?>",
	type:'POST',
		

	data:{model:m,assigned_location:l,created_date:cd},
	
	success:function(response)
		{$("#table_stock").html(response);}
	});


}
</script>

<!-- Filter-->
 <div class="container" style="width: 100%;">
<div class="row">

	<div class="x_panel">
<form id="form_cse_filter" action="#" method="post">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding:20px;">

		<div class="form-group">
		<div id="txtHint1">

		<select class="filter_s col-md-12 col-xs-12 form-control" name="model" id="model" >

		<option value="">Model</option>
		<?php
		foreach ($select_model as $fetch) {

		?>
		<option value="<?php echo $fetch -> model_id; ?>
		"><?php echo $fetch -> model_name ?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
</div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="assigned_location" name="assigned_location" required>
											<option value="">Location</option>
													 <?php foreach($assigned_location as $row)
									{?>
										<option value="<?php echo $row -> assigned_location; ?>"><?php echo $row -> assigned_location; ?></option>
								<?php } ?>
                                               
                                                </select>
											  
                                            </div>
                           </div>
                            

    


<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">

	<div class="form-group">

			<input type="text" id="created_date" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="Created Date" name="date_of_booking" readonly style="background:#F5F5F5; cursor:default;">

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

	<div class="row" >
	
		<h1 style="text-align:center; ">New Car Stock Vehicle Detail</h1>
		 </div> 
	

<div class="col-md-12" id="table_stock">
	
				<table class="table table-bordered datatable" id="results"> 
					<thead>
						<tr>
							<th>Sr No.</th>
							<th>Model</th>
							<th>Sub Model</th>
							<th>Color</th>
							<th>Fuel Type</th>
							<th>Vehicle Status</th>
							<th>Location</th>
							<th>Ageing</th>
							<th>Last Updated</th>
						</tr>	
					</thead>
					<tbody>
				
					 <?php 
					 $i=0;
						foreach($select_stock as $fetch) 
						{
							$i++;
						?>
						
						
						<tr>
						<td>	
						<?php echo $i; ?> 		
						
						</td>
							<td><?php echo $fetch -> model_name; ?></td>
						
							<td><?php echo $fetch -> submodel; ?></td>
						
						<td><?php echo $fetch -> color; ?></td>
						
						
							<td><?php echo $fetch -> fuel_type; ?></td>
								
								<td><?php echo $fetch -> vehicle_status; ?></td>  
							<td><?php echo $fetch -> assigned_location; ?></td> 
							<td><?php echo $fetch -> ageing; ?></td>   
							<td><?php echo $fetch -> created_date; ?></td>                   
						 </tr>
						 
						 	 <?php } ?>
						 
					
					</tbody>
				</table>
			</div>

	
  <script src="<?php echo base_url(); ?>assets/js/campaign.js"></script>   

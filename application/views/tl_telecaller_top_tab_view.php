<!--<ol class="breadcrumb bc-3" >
	<li>
		<a href="dashboard.php"><i class="fa fa-home"></i>Home</a>
	</li>
	<li class="active">
		<strong>Lead Management System</strong>
	</li>
</ol>-->

<script>
		function test()
	{
	//	alert("hi");


//	var c=document.getElementById("campaign_name").value;

	//alert(c);	

	var l=document.getElementById("status").value;
	//alert(l);


   var d=document.getElementById("dispostion").value;
	
   //alert(d);

	var a=document.getElementById("assign_to").value;

    //alert(a);	


	var f=document.getElementById("fromdate").value;
   // alert(f);
   var t=document.getElementById("todate").value;
    //alert(t);
   
//	var e=document.getElementById("enq").value;

	$.ajax(
{
	url:"<?php echo site_url('telecaller_lead/tl_filter'); ?>",
	type:'POST',
		
	//data:{campaign_name:c,assign_to:a,fromdate:f,todate:t,status:l,dispostion:d},
	
	data:{status:l,dispostion:d,assign_to:a,fromdate:f,todate:t},
	
	success:function(response)
		{$("#leaddiv").html(response);}
	});

		}
</script>

<script>
		
			function select_disposition() {
				
				//alert("hi");
				
			var status = document.getElementById("status").value;
			//alert(status);

			$.ajax({
			url : '<?php echo site_url('telecaller_lead/select_disposition'); ?>',
			type : 'POST',
			data : {'status' : status,

			},
			success : function(result) {
			$("#disposition_div").html(result);
			}
			});
			}
</script> 

<!-- Filter-->
<div class="row">

	<div class="x_panel">
<!--	<input type="hidden" id="enq" value="<?php echo $enq; ?>" class=""" placeholder="To Date" name="enq" >-->
		<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="padding:20px;">

		<div class="form-group">

		<select class="filter_s col-md-12 col-xs-12 form-control" id="status" name="lead" required>
		<?php
		$status=$_REQUEST['lead'];
		if($status !='')
		{
		if($status == '0')
		{?>
		<option value="0">All</option>
		<option value="1">Not Yet</option>
		<option value="2">Live</option>
		<option value="3">Postponed</option>
		<option value="4">Lost</option>
		<option value="5">Convert</option>
		<?php }
			if($status =='1')
			{
		?>

		<option value="1">Not Yet</option>
		<option value="0">All</option>
		<option value="2">Live</option>
		<option value="3">Postpone</option>
		<option value="4">Lost</option>
		<option value="5">Convert</option>
		<?php }

			if($status =='2')
			{
		?>

		<option value="2">Live</option>
		<option value="0">All</option>
		<option value="1">Not Yet</option>
		<option value="3">Postpone</option>
		<option value="4">Lost</option>
		<option value="5">Convert</option>
		<?php }

			if($status =='3')
			{
		?>

		<option value="3">Postpone</option>
		<option value="0">All</option>
		<option value="1">Not Yet</option>
		<option value="2">Live</option>
		<option value="4">Lost</option>
		<option value="5">Convert</option>
		<?php }
			if($status =='4')
			{
		?>

		<option value="4">Lost</option>
		<option value="0">All</option>
		<option value="1">Not Yet</option>
		<option value="2">Live</option>
		<option value="3">Postpone</option>
		<option value="5">Convert</option>

		<?php }

	if($status =='5')
	{
		?>

		<option value="5">Convert</option>
		<option value="0">All</option>
		<option value="1">Not Yet</option>
		<option value="2">Live</option>
		<option value="3">Postpone</option>
		<option value="4">Lost</option>

		<?php } ?>

		<?php } else{ ?>
		<option value="">Lead Status</option>
		<option value="0">All</option>
		<option value="1">Not Yet</option>
		<option value="2">Live</option>
		<option value="3">Postponed</option>
		<option value="4">Lost</option>
		<option value="5">Convert</option>
		<?php } ?>

		</select>

		</div>
		</div>-->

<!--<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;padding-left:17px;">

		<div class="form-group">
		<div id="txtHint1">

		      <select class="filter_s col-md-12 col-xs-12 form-control" id="campaign_name"  name="campaign_name" >
											<?php if($enq!='')
											{?>
												 <option value="<?php echo $enq;?>"><?php echo $enq;?></option>
											<?php }else{ ?>
													 <option value="0">Campaign Name</option>
													 <?php } ?>
													  <option value="All">All</option>
													   <option value="Web">Web</option>
													 <?php foreach ($select_campaign as $fetch) {
														 ?>
													 
                                             	<option value="<?php echo $fetch->enquiry_for;?>"><?php echo $fetch->enquiry_for;?></option>
                                              
                                               <?php } ?>
                                                </select>
											  
	</div>
</div>
</div>-->


    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="status" name="lead" required  onchange="select_disposition();">
											
													 <option value="0">All</option>
                                             	<option value="1">Not Yet</option>
                                                  <option value="2">Live</option>
                                                  <option value="3">Postponed</option>
                                                  <option value="4">Lost</option>
                                                  <option value="5">Convert</option>
                                               
                                                </select>
											  
                                            </div>
                            </div>
                            

     <div id="disposition_div" class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="dispostion" name="dispostion">
											
													 <option value="">Dispostion</option>
                                             	
                                               
                                                </select>
											  
                                            </div>
                            </div>
                                        
                                    



		<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding:20px;">

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

		<input type="text" id="fromdate" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="From Date" name="date_of_booking" readonly style="background:#F5F5F5; cursor:default;">

	</div>
</div>





<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">

	<div class="form-group">

		<input type="text" id="todate" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="To Date" name="to_booking" readonly style="background:#F5F5F5; cursor:default;">

	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		<div class="col-lg-2 col-md-2 col-md-offset-4 col-lg-offset-4 col-sm-6 col-xs-12" style="padding:20px;">

			<button type="submit" id="sub" onclick="test()" class="btn btn-info btn-icon btn-lg ">
				Search <i class="fa fa-search"></i>
			</button>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding:20px;">
			<a href="flead.php" class="btn btn-primary btn-icon btn-lg "  >Reset <i class="fa fa-times"></i></a>

		</div>
	</div>
</div>

</div>
</div>
<!-- date script -->

<script type="text/javascript">
	$(document).ready(function() {
		$('.datett').daterangepicker({
			singleDatePicker : true,
			format : 'DD-MM-YYYY',
			calender_style : "picker_1"
		}, function(start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});

		$('#fromdate').daterangepicker({
			singleDatePicker : true,
			format : 'DD-MM-YYYY',
			calender_style : "picker_1"
		}, function(start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});

		$('#todate').daterangepicker({
			singleDatePicker : true,
			format : 'DD-MM-YYYY',
			calender_style : "picker_1"
		}, function(start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});

		$(window).load(function() {
			var status = $('#status1').val();
			//alert(status);
			if (status == 'Free Stock') {
				$('#booking').hide();
				$('#tl').hide();
				$('#dse').hide();
				$('#fromdate').hide();
				$('#todate').hide();

			} else {
				$('#booking').show();
				$('#tl').show();
				$('#dse').show();
				$('#fromdate').show();
				$('#todate').show();
			}
		})
		//Code for Hide & Show for select control

		$('#status1').change(function() {

			var selectedValue = this.value;

			if (selectedValue == 'Free Stock') {
				$('#booking').hide();
				$('#tl').hide();
				$('#dse').hide();
				$('#fromdate').hide();
				$('#todate').hide();

			} else {
				$('#booking').show();
				$('#tl').show();
				$('#dse').show();
				$('#fromdate').show();
				$('#todate').show();
			}

		})
	});

	function clear_text() {

		window.location.assign("lms.php");
	}
</script>

<!-- date script -->

<!--Filter Ends-->

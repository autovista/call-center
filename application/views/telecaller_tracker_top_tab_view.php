            

<!--<ol class="breadcrumb bc-3" > <li> <a href=""><i class="fa fa-home"></i>Home</a> </li><li class="active"> <strong>Report</strong> </li> </ol>-->
	

<script>
		function test()
	{

	var s=document.getElementById("status").value;

	var f=document.getElementById("fromdate").value;

	var t=document.getElementById("todate").value;
	
	var c=document.getElementById("campaign_name").value;
				
	 var d=document.getElementById("dispostion").value;

	$.ajax(
	{
	url:"<?php echo site_url('tracker/tl_filter'); ?>
		",
		type:'POST',
		data:{status:s,fromdate:f,todate:t,dispostion:d,campaign_name:c},
		success:function(response)
		{$("#leaddiv").html(response);}
		});

		}
</script>
<script>
		
			function select_disposition() {
			var status = document.getElementById("status").value;
			//alert(status);

			$.ajax({
			url : '<?php echo site_url('tracker/select_disposition'); ?>',
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
		    <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="campaign_name"  name="campaign_name"   >
											<?php if($enq!='')
											{?>
												 <option value="<?php echo $enq;?>"><?php echo $enq;?></option>
											<?php }else{ ?>
													 <option value="">Campaign Name</option>
													 <?php } ?>
													  <option value="All">All</option>
													   <option value="Website">Web</option>
													 <?php foreach ($select_campaign as $fetch) {
														 ?>
													 
                                             	<option value="<?php echo $fetch->enquiry_for;?>"><?php echo $fetch->enquiry_for;?></option>
                                              
                                               <?php } ?>
                                                </select>
											  
                                            </div>
                            </div>
                              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding:20px;">
                        
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
											
													 <option value="">Disposition</option>
                                             	
                                               
                                                </select>
											  
                                            </div>
                            </div>
                                        
                                    
		

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">

			<div class="form-group">

				<input  class="date-picker filter_s col-md-12 col-xs-12 form-control" name="date_of_booking" id="fromdate"  placeholder="Date From" type="text" value="<?php echo date('d-m-Y'); ?>" readonly style="background:#F5F5F5; cursor:default;">

			</div>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:20px;">

			<div class="form-group">

				<input type="text" id="todate" class="datett filter_s col-md-12 col-xs-12 form-control" placeholder="To Date" name="to_booking" readonly value="<?php echo date('d-m-Y'); ?>" style="background:#F5F5F5; cursor:default;">

			</div>
		</div>
		<div class="col-md-12">

			<div class="form-group">
				<div class="col-lg-2 col-md-2 col-md-offset-4 col-lg-offset-4 col-sm-6 col-xs-12" style="padding:20px;">

					<button type="submit" id="sub" class="btn btn-info btn-icon btn-lg " onclick="test()">
						Search <i class="fa fa-search"></i>
					</button>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding:20px;">
						<a href="" onclick="clear()" class="btn btn-primary btn-icon btn-lg " >Reset <i class="fa fa-times"></i></a>
                            
                          
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
	<!-- date script -->
  <script>
    	function clear()
    	{
    		alert('hii');
    		document.getElementById("status").innerHTML ='All';
				
				document.getElementById("fromdate").innerHTML='' ;
			
			
				document.getElementById("todate").innerHTML='' ;
				 test();
			
    		
    	}
    </script>
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
});
			
	</script>

	<!--Filter Ends-->


	<script type="text/javascript" src="<?php echo base_url();?>assets/js/tableExport.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.base64.js"></script>
<script>
	function select_telecaller(telecaller) {

		$.ajax({
			type : "POST",
			url : "select_table_telecaller.php",
			data : {
				telecaller : telecaller
			},
			success : function(result) {

				$("#telecaller").html(result);

			}
		});

	}
</script>
 	<style>
		table {
			border-collapse: collapse;
			border-spacing: 0;
			width: 100%;
			border: 1px solid #ddd;
			font-size: 12px;
		}

</style> 
	<style type="text/css" class="init">
	</style>


      
    
    
      <script>
 
				function change_campaign()
			{
				//alert("hi");
				 		
				 var cname=document.getElementById("campaign_name").value;
				
				//alert(cname);
				//Create Loader
	src1 ="<?php echo base_url('assets/images/loader200.gif');?>";
	var elem = document.createElement("img");
	elem.setAttribute("src", src1);
	elem.setAttribute("height", "95");
	elem.setAttribute("width", "85");
	elem.setAttribute("alt", "loader");
	
	document.getElementById("campaign_loader").appendChild(elem);	  
				$.ajax(
				   {
					
					url:"<?php echo site_url('dashboard/select_table'); ?>",
					type:'POST',
					data:{campaign_name:cname},
					success:function(response)
					{$("#replacediv").html(response);}
					});
				
					}
</script>   
    

</head>


<body>
<script>
function test(a){
//	alert(a);
	var st=document.getElementById(a).value;
	// alert(st);
	
	$.ajax({
		url : '<?php echo site_url('dashboard/details'); ?>',
		type : 'POST',
		data : {'st' : st,},
		success : function(result) {
		$("#tracker_list").html(result);
		}
	});
	
}
</script>



<script>
	function goBack() {
		window.history.back();
	}
</script>

 <!--<ol class="breadcrumb bc-3" > <li> <a href="dashboard.php"><i class="fa fa-home"></i>Home</a> </li><li class="active"> <strong>Lead Management System</strong> </li> </ol>-->
	
    <div class="container body" style="width: 100%;">


        <div class="main_container">



            <!-- page content -->
            <div class="right_col" role="main">

                <br />
                <div class="">

                  <div class="row top_tiles">  
               
                
                    <div class="col-md-12">
                  
                <div class="pull-left">
                <h3>All Leads</h3></div>

 <div class="pull-right">
<a href="#" class="pull-right" onClick ="$('#xls_data').tableExport({type:'excel',escape:'false'});"><i class="btn btn-defult entypo-download"></i></a>
      </div></div>
           <!-- All Lead Table-->
             	<div class="table-responsive">
               		<table id="xls_data" class="table table-striped table-bordered table-responsive">
                         <tbody>
						<tr>
                            <td></td>
                            <td>New</td>
                            <td>Live</td>                           
						    <td>Postponed</td>
							<td>Lost</td>
							<td>Converted</td>
							<td>Pending(Live)</td>
							<td>Pending(New)</td>
							<td>Total Leads</td>
                        </tr>
                         <tr>                            
                           <td>MTD</td>
                           
                           <td><?php 
								$t = ' ( ';
								$i=0;
								foreach($all_new_lead as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								 $all_new_lead1=count($all_new_lead);
								 if($all_new_lead1!=0)
								 {?>
								 	<input type="hidden" id="all_new_lead1" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_new_lead1');">
								<?php }
							echo $all_new_lead1;?>
							</a></td>
							<td>
								<?php 
								$t = ' ( ';
								$i=0;
								foreach($all_m_live as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								$all_m_live1 =count($all_m_live);
								 if($all_m_live1!=0)
								 {?>
								 	<input type="hidden" id="all_m_live" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_m_live');">
								<?php }echo $all_m_live1;?>
							</a></td>
							 <td><?php 
								$t = ' ( ';
								$i=0;
								foreach($all_m_postponed as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								$all_m_Postponed1 = count($all_m_postponed);
								if($all_m_Postponed1!=0){
								?>
							<input type="hidden" id="all_m_postponed" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_m_postponed');">

								<?php }echo $all_m_Postponed1;   ?></a></td>
							<td><?php 
								$t = ' ( ';
								$i=0;
								foreach($all_m_lost as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								
								foreach($all_m_lost_lc as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								 $all_m_Lost1=0; 
							$all_m_Lost1 = $all_m_Lost1 + count($all_m_lost);
							 $all_m_Lost1 = $all_m_Lost1 + count($all_m_lost_lc);
							if($all_m_Lost1!=0)
							{?>
							<input type="hidden" id="all_m_lost" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_m_lost');">
								<?php }
								echo $all_m_Lost1;
							?></a></td>
							<td><?php 
								$t = ' ( ';
								$i=0;
								foreach($all_m_convert as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								
								foreach($all_m_convert_lc as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								?>
								<?php
								 $all_m_Converted1 = 0;
							$all_m_Converted1 = $all_m_Converted1 + count($all_m_convert);
							 $all_m_Converted1 = $all_m_Converted1 + count($all_m_convert_lc);
								 if($all_m_Converted1!=0)
								 {?>
								<input type="hidden" id="all_m_convert" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_m_convert');">
									<?php } echo $all_m_Converted1;
							?></a></td>
							<td>
								<?php 
								$t = ' ( ';
								$i=0;
								foreach($all_pending as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								?>
						<input type="hidden" id="all_m_pending" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_m_pending');">
								<?php 
								echo $all_pending_lead1=count($all_pending);
						 ?></td>
						 <td>
						 	<?php 
								$t = ' ( ';
								$i=0;
								foreach($all_not_attended_pending as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';
								 $all_pending_lead=count($all_not_attended_pending);	 
								if($all_pending_lead!=0)
							{?>
						<input type="hidden" id="all_m_pending_not_attened" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_m_pending_not_attened');">
								<?php }
							
							echo $all_pending_lead;
						  ?></a></td>
							<td><?php 
								$t = ' ( ';
								
								$b=0;
								foreach($all_m_live as $row){
								if ($b == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$b++;
								}
								
								foreach($all_new_lead as $row){
								if ($b == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$b++;
								}
								
								
							
								
								foreach($all_m_postponed as $row){
								if ($b == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$b++;
								}
								
								foreach($all_m_convert as $row){
								if ($b == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$b++;
								}
								
								foreach($all_m_lost as $row){
								if ($b == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$b++;
								}
								
								foreach($all_m_lost_lc as $row){
								if ($b == 0) {
								
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$b++;
								}
								foreach($all_m_convert_lc as $row){
								if ($b == 0) {
								
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$b++;
								}
								foreach($all_not_attended_pending as $row){
								if ($b == 0) {
								
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$b++;
								}
								
								
								
								$st = $t . ')';	 ?>
								<input type="hidden" id="total_m" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('total_m');">
								<?php 
							echo $total = $all_new_lead1+$all_m_live1 + $all_m_Postponed1 + $all_m_Lost1 + $all_m_Converted1 + $all_pending_lead; ?></a></td>
					</tr>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                              <tr>                            
                           <td>YTD</td>
                           <td><?php
								$t = ' ( ';
								$i=0;
								foreach($all_new_lead as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								 $all_new_lead_y=count($all_new_lead);
								if($all_new_lead_y!=0)
							{?>
								<input type="hidden" id="all_new_lead_y" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_new_lead_y');">
								<?php }  echo $all_new_lead_y=count($all_new_lead);?>
							</a></td>
							<td>
								<?php 
								$t = ' ( ';
								$i=0;
								foreach($all_y_live as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								$all_y_live1 =count($all_y_live);
								 if($all_y_live1!=0)
								 {?>
						<input type="hidden" id="all_y_live1" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_y_live1');">
								<?php }echo $all_y_live1;?>
							</a></td>
							 <td><?php 
								$t = ' ( ';
								$i=0;
								foreach($all_y_postponed as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								$all_y_Postponed1 = count($all_y_postponed);
								if($all_y_Postponed1!=0){
								?>
							<input type="hidden" id="all_y_Postponed" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_y_Postponed');">
								<?php }echo $all_y_Postponed1;   ?></a></td>
							<td><?php 
								$t = ' ( ';
								$i=0;
								foreach($all_y_lost as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								
								foreach($all_y_lost_lc as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								 $all_y_Lost1=0; 
							$all_y_Lost1 = $all_y_Lost1 + count($all_y_lost);
							 $all_y_Lost1 = $all_y_Lost1 + count($all_y_lost_lc);
							if($all_y_Lost1!=0)
							{?>
						<input type="hidden" id="all_y_Lost" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_y_Lost');">
								<?php }
								echo $all_y_Lost1;
							?></a></td>
							<td><?php 
								$t = ' ( ';
								$i=0;
								foreach($all_y_convert as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								
								foreach($all_y_convert_lc as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								?>
								<?php
								 $all_y_Converted1 = 0;
							$all_y_Converted1 = $all_y_Converted1 + count($all_y_convert);
							 $all_y_Converted1 = $all_y_Converted1 + count($all_y_convert_lc);
								 if($all_y_Converted1!=0)
								 {?>
								<input type="hidden" id="all_y_convert" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_y_convert');">
									<?php } echo $all_y_Converted1;
							?></a></td>
								<td>
								<?php 
							$t = ' ( ';
								$i=0;
								foreach($all_pending_y as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								 $all_pending_lead_y1=count($all_pending_y);
								if($all_pending_lead_y1!=0)
								 {?>
							<input type="hidden" id="all_pending_lead_y" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_pending_lead_y');">
								<?php  }
								echo $all_pending_lead_y1;
						 ?></a></td>
						
						 
						 <td>
						 	<?php 
								$t = ' ( ';
								$i=0;
								foreach($all_not_attended_pending_y as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								 $all_pending_lead_y=count($all_not_attended_pending_y);
								if($all_pending_lead_y!=0)
								 { ?>
							<input type="hidden" id="all_pending_lead_y" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('all_pending_lead_y');">
								<?php }
							
							echo $all_pending_lead_y;
						  ?></a></td>
						 
						 
							<td>
								<?php 
								$t = ' ( ';
								$i=0;
								foreach($all_new_lead as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								foreach($all_y_live as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								foreach($all_y_postponed as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								foreach($all_y_convert as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								foreach($all_y_lost as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								foreach($all_y_lost_lc as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								foreach($all_y_convert_lc as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								foreach($all_not_attended_pending_y as $row){
								if ($i == 0) {
								$t = $t . "enq_id = '" . $row -> enq_id . "'";
								} else {
								$t = $t . " or enq_id ='" . $row -> enq_id . "'";
								}
								$i++;
								}
								$st = $t . ')';	 
								?>
								<input type="hidden" id="total_y" value="<?php echo $st; ?>">
							<a href="#" onclick= "test('total_y');">
								<?php echo $total = $all_new_lead_y+$all_y_live1 + $all_y_Postponed1 + $all_y_Lost1 + $all_y_Converted1+ $all_pending_lead_y; ?></td>
                           </tr>
                             
                        
                      
                         </tbody>
                    </table>
</div>






<div class="col-md-12">
	
<div class="col-md-3">
	<h3>Campaign Name </h3>
</div>	

	<div class="col-md-5">
		      <div class=" col-md-6 col-sm-6 col-xs-12" style="padding:20px;">
                        
                                       <div class="form-group">
                                       
                                               
                                              <select class="filter_s col-md-12 col-xs-12 form-control" id="campaign_name"   onchange="change_campaign();" name="campaign_name"   >
									
													 <option value="0">Campaign Name</option>
													 
													 
													   <option value="Web">Web</option>
													   
													 <?php
													  foreach ($select_campaign as $fetch)
													   {
														 ?>
													 
                                             	<option value="<?php echo $fetch->campaign_name;?>"><?php echo $fetch->campaign_name;?></option>
                                              
                                               <?php } ?>
                                                </select>
											  
                                            </div>
                            </div>

</div>	
	<div class="pull-right" style="padding-top:20px;">
	
                                       
<a href="#" class="pull-right" onClick ="$('#campaign_count').tableExport({type:'excel',escape:'false'});"><i class="btn btn-defult entypo-download"></i></a>
           </div>
</div>




<div id="replacediv">
	<div class="control-group" id="campaign_loader" style="margin:0% 30% 1% 50%"></div>
   <div class="table-responsive" >
               <table id="campaign_count" class="table table-striped table-bordered table-responsive">
                         <tbody>
					<tr>
                            <td></td>
                            <td>New</td>
                            <td>Live</td>
                            <td>Postponed</td>
						    <td>Lost</td>
						    <td>Converted</td>
						    <td>Pending(Live)</td>
							<td>Pending(New)</td>
							<td>Total Leads</td>
                        </tr>
                             <tr>
                          	<td>MTD</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							</tr>
                             <tr>
                        	<td>YTD</td>
                            <td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							</tr>
                      
                         </tbody>
                    </table>
</div>

</div>

</div>

                                   
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/datatables/datatables.css" id="style-resource-1">

 <div class="row top_tiles">
 	<div id="leaddiv" class="container " style="width: 100%;">
 		<div class="control-group" id="blah" style="margin:0% 30% 1% 50%"></div>
		<div class="table-responsive"  style="overflow-x:auto;"> 
			<?php if($_SESSION['role']=='1' || $_SESSION['role']=='2'){?>
				<script type="text/javascript">
		jQuery(document).ready(function($) {
		var $table3 = jQuery("#table-3");
		$table3.DataTable({
			dom : 'Bfrtip',
			buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
		});
	}); 

</script>
			<table class="table table-bordered datatable" id="table-3"> 
				<?php }else{ ?>
					<script type="text/javascript">


jQuery( document ).ready( function( $ ) {
var $table4 = jQuery("#table-4");
var table4 = $table4.DataTable( {
"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
} );
// Initalize Select Dropdown after DataTables is created
$table4.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
minimumResultsForSearch: -1
});
// Setup - add a text input to each footer cell
$( '#table-4 tfoot th' ).each( function () {
var title = $('#table-4 thead th').eq( $(this).index() ).text();
$(this).html( '<input type="text" class="form-control" placeholder="Search ' + title + '" />' );
} );
// Apply the search
table4.columns().every( function () {
var that = this;
$( 'input', this.footer() ).on( 'keyup change', function () {
if ( that.search() !== this.value ) {
that
.search( this.value )
.draw();
}
} );
} );
} );
</script>

        <table class="result table table-bordered datatable table-responsive" id="table-4">
				
				<?php }?>
					<thead>
						<tr>
						 <th>Sr No.</th>
						 <th>Lead Source</th>
						 <th>Transfer From</th>
						 <th>Transfer To</th>
						 <th>Customer Name</th>
						 <th>Moblie Number</th>
						 <th>Email ID</th>
						 <th>Transfer Date</th>
						 <th>NFD</th>
						 <th>Lead Date</th>
						 <th>Lead Status</th>
						 <th>CSE Disposition</th>
						 <th>DSE Disposition</th>
						 <th>Model/Variant</th>
						 <th>Transfer Location</th>
						 <th>Buyer Type</th>
						 <th>Exchange Make/Model</th>
						 <th>Manufacturing Year</th>
						 <th>Color</th>
						 <th>KMS</th>
						 <th>Ownership</th>
						 <th>Accidental claim </th>
						 <th>Lead Location</th>
						 <th>Booked</th>
						 <th>CSE Remark</th>
						 <th>DSE Remark</th>
						</tr>	
					</thead>
					<tbody>
				   <?php
					$i=0;
					$enq='transfer_report';
					foreach($select_transfer_lead as $fetch)
					{
						     $enq_id=$fetch->enq_id;
							$i++;
					?>
					<tr>
							<td><?php echo $i; ?></td>
 					 		<td><?php
								if ($fetch -> lead_source == '') {
									echo "Web";
								} elseif ($fetch -> lead_source == 'Facebook') {
									echo $fetch -> enquiry_for;
								} else {
									echo $fetch -> lead_source;
								}
							?></td>
							<td><?php echo $fetch -> transfer_from_fname . ' ' . $fetch -> transfer_from_lname; ?></td>
							<td> <?php echo $fetch -> transfer_to_fname . ' ' . $fetch -> transfer_to_lname; ?></td>
							<td>
								
								<b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?>/<?php echo $enq; ?> " title="Customer Follow Up Details"><?php echo $fetch -> name; ?></a></b>
								<!--<?php echo $fetch -> name; ?>--></td>
                            <td><?php echo $fetch -> contact_no; ?></td>
                            <td><?php echo $fetch -> email; ?></td>
                            <td><?php echo $fetch -> transfer_date; ?></td>
                             <?php $query = $this -> db -> query("SELECT f.nextfollowupdate,d.disposition_name,f.comment FROM  lead_followup f LEFT JOIN tbl_disposition_status d ON d.disposition_id=f.disposition  where f.leadid='$enq_id'  and assign_to='$fetch->assign_by_id' ORDER BY `f`.`id` DESC  limit 1") -> result(); ?>
                            <?php $query1=$this->db->query("SELECT f.nextfollowupdate,d.disposition_name,f.comment FROM  lead_followup f LEFT JOIN tbl_disposition_status d ON d.disposition_id=f.disposition  where f.leadid='$enq_id'  and assign_to='$fetch->assign_from' ORDER BY `f`.`id` DESC  limit 1")->result();
                   
                        ?>
                            <td><?php  if(count($query1)!=0)
                            { echo"1";echo $query1[0] -> nextfollowupdate;}
                            else{
                            	echo"2";
                            	echo $query[0] -> nextfollowupdate;} ?></td>
                            <td><?php echo $fetch -> created_date; ?></td>
                            <td><?php echo $fetch -> status_name; ?></td>
                             <?php
                            if(count($query)>0)
							{
								?>
								 <td><?php echo $query[0]->disposition_name ?></td>
								 
								  <?php
								}else
								{
							?>
								<td></td>
						<?php 	} 
                            
                           
                           if(count($query1)>0)
							{
								?>
								 <td><?php echo $query1[0]->disposition_name ?></td>
								 
								  <?php
								}else
								{
							?>
								<td></td>
						<?php 	} ?>
                            
                            <td><?php echo $fetch -> new_model . ' ' . $fetch -> variant_name; ?></td>
                            <td><?php echo $fetch -> loc; ?></td>
                            <td><?php echo $fetch -> buyer_type; ?></td>
                            <td><?php echo $fetch -> make_name . ' ' . $fetch -> old_model; ?></td>
                            <td><?php echo $fetch -> manf_year; ?></td>
                            <td><?php echo $fetch -> color; ?></td>
                            <td><?php echo $fetch -> km; ?></td>
                            <td><?php echo $fetch -> ownership; ?></td>
                            <td><?php echo $fetch -> accidental_claim; ?></td>
                            <td><?php echo $fetch -> location; ?></td>
                            <td><?php echo $fetch -> buy_status; ?></td>
                            <?php
                            if(count($query)>0)
							{
								?>
								 <td><?php echo $query[0]->comment ?></td>
								 
								  <?php
								}else
								{
							?>
								<td></td>
						<?php 	}
									if(count($query1)>0)
									{
								?>
								 <td><?php echo $query1[0]->comment ?></td>
								 
								  <?php
								}else
								{
							?>
								<td></td>
						<?php 	} ?>
                           </tr>
						<?php } ?>
						  <?php
					$i=count($select_transfer_lead);
					
					foreach($select_transfer_lead_lc as $fetch)
					{
						     $enq_id=$fetch->enq_id;
							$i++;
					?>
					<tr>
							<td><?php echo $i; ?></td>
 					 		<td><?php
								if ($fetch -> lead_source == '') {
									echo "Web";
								} elseif ($fetch -> lead_source == 'Facebook') {
									echo $fetch -> enquiry_for;
								} else {
									echo $fetch -> lead_source;
								}
							?></td>
							<td><?php echo $fetch -> transfer_from_fname . ' ' . $fetch -> transfer_from_lname; ?></td>
							<td> <?php echo $fetch -> transfer_to_fname . ' ' . $fetch -> transfer_to_lname; ?></td>
							<td>
								
								<b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?>/<?php echo $enq; ?> " title="Customer Follow Up Details"><?php echo $fetch -> name; ?></a></b>
								<!--<?php echo $fetch -> name; ?>--></td>
                            <td><?php echo $fetch -> contact_no; ?></td>
                            <td><?php echo $fetch -> email; ?></td>
                            <td><?php echo $fetch -> transfer_date; ?></td>
                         <?php $query = $this -> db -> query("SELECT f.nextfollowupdate,d.disposition_name,f.comment FROM  lead_followup_lc f LEFT JOIN tbl_disposition_status d ON d.disposition_id=f.disposition  where f.leadid='$enq_id'  and assign_to='$fetch->assign_by_id' ORDER BY `f`.`id` DESC  limit 1") -> result(); ?>
                            <?php $query1=$this->db->query("SELECT f.nextfollowupdate,d.disposition_name,f.comment FROM  lead_followup_lc f LEFT JOIN tbl_disposition_status d ON d.disposition_id=f.disposition  where f.leadid='$enq_id'  and assign_to='$fetch->assign_from' ORDER BY `f`.`id` DESC  limit 1")->result();
                   
                        ?>
                            <td><?php  if(count($query1)!=0)
                            {echo $query1[0] -> nextfollowupdate;}
                            else{
                            	echo $query[0] -> nextfollowupdate;} ?></td>
                            <td><?php echo $fetch -> created_date; ?></td>
                            <td><?php echo $fetch -> status_name; ?></td>
                           
                           <?php
                            if(count($query)>0)
							{
								?>
								 <td><?php echo $query[0]->disposition_name ?></td>
								 
								  <?php
								}else
								{
							?>
								<td></td>
						<?php 	} ?>
                            
                           
                          <?php 
                   
                            if(count($query1)>0)
							{
								?>
								 <td><?php echo $query1[0]->disposition_name ?></td>
								 
								  <?php
								}else
								{
							?>
								<td></td>
						<?php 	} ?>
                            
                            <td><?php echo $fetch -> new_model . ' ' . $fetch -> variant_name; ?></td>
                            <td><?php echo $fetch -> loc; ?></td>
                            <td><?php echo $fetch -> buyer_type; ?></td>
                            <td><?php echo $fetch -> make_name . ' ' . $fetch -> old_model; ?></td>
                            <td><?php echo $fetch -> manf_year; ?></td>
                            <td><?php echo $fetch -> color; ?></td>
                            <td><?php echo $fetch -> km; ?></td>
                            <td><?php echo $fetch -> ownership; ?></td>
                            <td><?php echo $fetch -> accidental_claim; ?></td>
                            <td><?php echo $fetch -> location; ?></td>
                            <td><?php echo $fetch -> buy_status; ?></td>
                            <?php
                            if(count($query)>0)
							{
								?>
								 <td><?php echo $query[0]->comment ?></td>
								 
								  <?php
								}else
								{
							?>
								<td></td>
						<?php 	}
									if(count($query1)>0)
									{
								?>
								 <td><?php echo $query1[0]->comment ?></td>
								 
								  <?php
								}else
								{
							?>
								<td></td>
						<?php 	} ?>
                           </tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
		</div>
</div>
		
<script src="<?php echo base_url(); ?>assets/js/datatables/datatables.js" id="script-resource-8"></script>
<!-- Footer -->
<footer class="main" style="margin-top: 20px;border-top: none;">
	&copy; 2016 <strong>All Right Reserved | Autovista</strong>
	<div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">
		<div class="chat-inner">
			<h2 class="chat-header"><a href="#" class="chat-close"><i class="entypo-cancel"></i></a><i class="entypo-users"></i>
		</div>
	</div>
</footer>

</div>
</div>

<script src="<?php echo base_url(); ?>assets/js/gsap/TweenMax.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/resizeable.js"></script>
<script src="<?php echo base_url(); ?>assets/js/neon-api.js"></script>

<script src="<?php echo base_url(); ?>assets/js/neon-custom.js"></script>


<!--<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js" id="script-resource-9"></script>-->

<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.min2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datepicker/daterangepicker.js"></script>

</body> </html>			
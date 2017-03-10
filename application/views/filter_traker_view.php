<script type="text/javascript">
	jQuery(document).ready(function($) {
		var $table4 = jQuery("#table-4");
		$table4.DataTable({
			dom : 'Bfrtip',
			buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
		});
	}); 
</script> 
<div class="control-group" id="blah" style="margin:0% 30% 1% 50%">
				
				</div>
<div class="table-responsive"  style="overflow-x:auto;">
		<table class="table table-bordered datatable table-responsive"" id="table-4"> 
				<thead>
						<tr>
							<th>Sr No.</th>
							<th>Lead Source</th>
							<?php if($_SESSION['role']!=3)
							{?>
							<th>Assign To</th>
							<?php } ?>
							<th>Customer Name</th>
							<th>Moblie Number</th>
							<th>Email ID</th>
							<th>Lead Date</th>
							<th>Call Date</th>
							<th>NFD</th>
							<th>Lead Status</th>
							<th>Disposition</th>
							<th>Model/Variant</th>
							<th>Location</th>
							<th>Buyer Type</th>
							<th>Exchange Make/Model</th>
							<th>Manufacturing Year</th>
							<th>Color</th>
							<th>KMS</th>
							<th>Ownership</th>
							<th>Accidental claim </th>
							<th>Lead Location</th>
							<th>Booked</th>
							<th>Remark</th>		
						</tr>	
					</thead>
					<tbody>
					<?php
					$i=0;
					foreach($select_lead as $fetch)
					{
						 $enq_id=$fetch->enq_id;
							$i++; ?>
							<tr>
					<td><?php echo $i; ?></td>
				<td><?php if($fetch->lead_source == '')
						{
						 echo "Web"; 
						}
elseif($fetch->lead_source == 'Facebook')
{
	 echo $fetch->enquiry_for;
}elseif($fetch->lead_source == 'Carwale')
{
	 echo $fetch->enquiry_for;
}
						else
						{
							 echo $fetch->lead_source;
						}?></td>
					<?php if($_SESSION['role']!=3)
							{?>
							<td><?php echo $fetch->fname . ' ' . $fetch->lname; ?></td>
							<?php } ?>
						<td><b><?php echo $fetch->name;?></b></td>
                    <td><?php echo $fetch->contact_no;?></td>
                    <td><?php echo $fetch->email;?></td>
                    <td><?php echo $fetch->created_date;?></td>
                    <td><?php echo $fetch->date;?></td>
					<td><?php echo $fetch->nextfollowupdate;?></td>
					<td><?php echo $fetch->status_name;?></td>
					<td><?php echo $fetch->disposition_name;?></td>
                    <td><?php echo $fetch->new_model_name.' '.$fetch->variant_name; ?></td>
                    <td><?php echo $fetch->location;?></td>
                    <td><?php echo $fetch->buyer_type;?></td>
                    <td><?php echo $fetch->make_name.' '.$fetch->old_model_name;?></td>
                    <td><?php echo $fetch->manf_year;?></td>
                    <td><?php echo $fetch->color;?></td>
                    <td><?php echo $fetch->km;?></td>
					<td><?php echo $fetch->ownership;?></td>
					<td><?php echo $fetch->accidental_claim;?></td>
					<td><?php echo $fetch->location;?></td>
					<td><?php echo $fetch->buy_status;?></td>
                    <td><?php echo $fetch->comment; ?></td>  
					</tr>
					<?php }
						$i=count($select_lead);
						foreach($lc_data as $fetch)
						{
						     $enq_id=$fetch->enq_id;
							$i++;
					?>
					<tr>
										<td><?php echo $i; ?></td>
				<td><?php if($fetch->lead_source == '')
						{
						 echo "Web"; 
						}
elseif($fetch->lead_source == 'Facebook')
{
	 echo $fetch->enquiry_for;
}elseif($fetch->lead_source == 'Carwale')
{
	 echo $fetch->enquiry_for;
}
						else
						{
							 echo $fetch->lead_source;
						}?></td>
					<?php if($_SESSION['role']!=3)
							{?>
							<td><?php echo $fetch->fname . ' ' . $fetch->lname; ?></td>
							<?php } ?>
						<td><b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?> " title="Customer Follow Up Details"><?php echo $fetch->name;?></a></b></td>
                    <td><?php echo $fetch->contact_no;?></td>
                    <td><?php echo $fetch->email;?></td>
                    <td><?php echo $fetch->created_date;?></td>
                    <td><?php echo $fetch->date;?></td>
					<td><?php echo $fetch->nextfollowupdate;?></td>
					
					
					<td><?php echo $fetch->status_name;?> </b><a href="<?php echo site_url();?>tracker/reopen?enq_id=<?php echo $enq_id; ?> "><b> Reopen</b> </a></td>
					
												
					
					<td><?php echo $fetch->disposition_name;?></td>
                    <td><?php echo $fetch->new_model_name.' '.$fetch->variant_name; ?></td>
                    <td><?php echo $fetch->location;?></td>
                    <td><?php echo $fetch->buyer_type;?></td>
                    <td><?php echo $fetch->make_name.' '.$fetch->old_model_name;?></td>
                    <td><?php echo $fetch->manf_year;?></td>
                    <td><?php echo $fetch->color;?></td>
                    <td><?php echo $fetch->km;?></td>
					<td><?php echo $fetch->ownership;?></td>
					<td><?php echo $fetch->accidental_claim;?></td>
					<td><?php echo $fetch->location;?></td>
					<td><?php echo $fetch->buy_status;?></td>
                    <td><?php echo $fetch->comment; ?></td>
					</tr>
					<?php } ?>
					
				</tbody>
			</table>
		</div>
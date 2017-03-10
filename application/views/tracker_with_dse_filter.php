<script type="text/javascript">
	jQuery(document).ready(function($) {
		var $table4 = jQuery("#table-3");
		$table4.DataTable({
			dom : 'Bfrtip',
			buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
		});
	}); 
</script> 
<div class="control-group" id="blah" style="margin:0% 30% 1% 50%">
				
				</div>
		<div class="table-responsive"  style="overflow-x:auto;">
			
		<table class="table table-bordered datatable table-responsive" id="table-3"> 
		
				<thead>
						<tr>
							<tr>
							<th>Sr No.</th>
							<th>Lead Source</th>
							<th>Customer Name</th>
							<th>Mobile Number</th>
							<th>Email ID</th>
							<th>Lead Date</th>
							<th>Showroom Location</th>
							
							<th>CSE Name</th>
							
							<th>CSE Call Date</th>
							<th>CSE Disposition</th>
							<th>CSE Remark</th>	
							<th>CSE NFD</th>
							
							<th>DSE Name</th>
							<th>DSE Call Date</th>
							<th>DSE Disposition</th>
							<th>DSE Remark</th>	
							<th>DSE NFD</th>
								
							<th>Lead Status</th>
							<th>Buyer Type</th>
							<th>Model/Variant</th>
							<th>Exchange Make/Model</th>
							<th>Manufacturing Year</th>
							<th>Color</th>
							<th>KMS</th>
							<th>Ownership</th>
							<th>Accidental claim </th>
							<th>Booked</th>
							
						</tr>	
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
						<td><b><a href="<?php echo site_url();?>website_leads/lms_details/<?php echo $enq_id;?>/tracker_lead " title="Customer Follow Up Details"><?php echo $fetch->name;?></a></b></td>
                    <td><?php echo $fetch->contact_no;?></td>
                    <td><?php echo $fetch->email;?></td>
                     <td><?php echo $fetch->created_date;?></td>
                     <td><?php echo $fetch->location;?></td>
							
							 <!--- CSE Information -->
                     
                     	  <?php $query_cse1=$this->db->query("SELECT l.lname as cse_lname,l.fname as cse_fname from request_to_lead_transfer r join lmsuser l on  r.assign_by_id=l.id  where  lead_id='$enq_id'")->result();?> 
                 	<?php if($fetch->transfer_id==0)
					{?>
					<td><?php echo $fetch->fname . ' ' . $fetch->lname; ?></td>
					<?php }else{?>
						<td><?php echo $query_cse1[0]->cse_fname . ' ' . $query_cse1[0]->cse_lname; ?></td>
					<?php } ?>
					 <?php $query_cse=$this->db->query("SELECT d.disposition_name,f.comment,f.date,f.nextfollowupdate FROM  lead_followup f LEFT JOIN tbl_disposition_status d ON d.disposition_id =f.disposition  where f.leadid='$enq_id'  and assign_to='$fetch->assign_by_id' ORDER BY f.id DESC  limit 1")->result();?>
                    <?php if($fetch->transfer_id==0)
					{?>
						<td><?php echo $fetch->date; ?></td>
						<td><?php echo $fetch->disposition_name ; ?></td>
						<td><?php echo $fetch->comment; ?></td>
						<td><?php echo $fetch->nextfollowupdate; ?></td>
						<?php } else{?>
                     <td><?php  if(count($query_cse)>0){echo $query_cse[0]->date; } ?></td>
                   <td><?php if(count($query_cse)>0){ echo $query_cse[0]->disposition_name; }?></td>
                     <td><?php if(count($query_cse)>0){ echo $query_cse[0]->comment; }?></td>  
                  	  <td><?php if(count($query_cse)>0){ echo $query_cse[0]->nextfollowupdate; }?></td>
						<?php } ?>	
						
                     	  <?php $query_dse1=$this->db->query("SELECT l.lname as dse_lname,l.fname as dse_fname from request_to_lead_transfer r join lmsuser l on  r.assign_to_telecaller=l.id  where  lead_id='$enq_id' order by request_id desc")->result();?> 
                 	<?php if($fetch->transfer_id!=0)
					{?>
					
						<td><?php echo $query_dse1[0]->dse_fname . ' ' . $query_dse1[0]->dse_lname; ?></td>
					<?php }else{?>
						<td></td>
						<?php } ?>
					 <?php $query_dse=$this->db->query("SELECT d.disposition_name,f.comment,f.date,f.nextfollowupdate FROM  lead_followup f  JOIN tbl_disposition_status d ON d.disposition_id =f.disposition  where f.leadid='$enq_id'  and assign_to='$fetch->assign_to_telecaller' ORDER BY f.id DESC  limit 1")->result();?>
                    <?php if($fetch->transfer_id!=0)
					{?>
                     <td><?php if(count($query_dse)>0){echo $query_dse[0]->date; } ?></td>
                      <td><?php if(count($query_dse)>0){ echo $query_dse[0]->disposition_name; }?></td>
                     
                    
                  	<td><?php if(count($query_dse)>0){ echo $query_dse[0]->comment; }?></td>  
                  	<td><?php if(count($query_dse)>0){ echo $query_dse[0]->nextfollowupdate; }?></td>
						<?php }else{ ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							
							<?php } ?>									
							 <!-- Car Information -->
                  	<td><?php echo $fetch->status_name;?></td>
                  	<td><?php echo $fetch->buyer_type;?></td>
                    <td><?php echo $fetch->new_model_name.' '.$fetch->variant_name; ?></td>
          			 <td><?php echo $fetch->make_name.' '.$fetch->old_model_name;?></td>
                    <td><?php echo $fetch->manf_year;?></td>
                    <td><?php echo $fetch->color;?></td>
                    <td><?php echo $fetch->km;?></td>
					<td><?php echo $fetch->ownership;?></td>
					<td><?php echo $fetch->accidental_claim;?></td>
				
					<td><?php echo $fetch->buy_status;?></td>
							
						</tr>	
					<?php } 
					$i=count($select_lead);
					
					foreach($lc_data as $fetch)
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
					<td><b><?php echo $fetch->name;?></b></td>
                    <td><?php echo $fetch->contact_no;?></td>
                    <td><?php echo $fetch->email;?></td>
                     <td><?php echo $fetch->created_date;?></td>
                     <td><?php echo $fetch->location;?></td>
							
							 <!--- CSE Information -->
                    
                     	  <?php $query_cse1=$this->db->query("SELECT l.lname as cse_lname,l.fname as cse_fname from request_to_lead_transfer r join lmsuser l on  r.assign_by_id=l.id  where  lead_id='$enq_id'")->result();?> 
                 	<?php if($fetch->transfer_id==0)
					{?>
					<td><?php echo $fetch->fname . ' ' . $fetch->lname; ?></td>
					<?php }else{?>
						<td><?php echo $query_cse1[0]->cse_fname . ' ' . $query_cse1[0]->cse_lname; ?></td>
					<?php } ?>
					 <?php $query_cse=$this->db->query("SELECT d.disposition_name,f.comment,f.date,f.nextfollowupdate FROM  lead_followup_lc f LEFT JOIN tbl_disposition_status d ON d.disposition_id =f.disposition  where f.leadid='$enq_id'  and assign_to='$fetch->assign_by_id' ORDER BY f.id DESC  limit 1")->result();?>
                    
                     <?php if($fetch->transfer_id==0)
					{?>
						<td><?php echo $fetch->date; ?></td>
						<td><?php echo $fetch->disposition_name ; ?></td>
						<td><?php echo $fetch->comment; ?></td>
						<td><?php echo $fetch->nextfollowupdate; ?></td>
						<?php } else{?>
                     <td><?php  if(count($query_cse)>0){echo $query_cse[0]->date; } ?></td>
                   <td><?php if(count($query_cse)>0){ echo $query_cse[0]->disposition_name; }?></td>
                     <td><?php if(count($query_cse)>0){ echo $query_cse[0]->comment; }?></td>  
                  	  <td><?php if(count($query_cse)>0){ echo $query_cse[0]->nextfollowupdate; }?></td>
						<?php } ?>	
						
                     	  <?php $query_dse1=$this->db->query("SELECT l.lname as dse_lname,l.fname as dse_fname from request_to_lead_transfer r join lmsuser l on  r.assign_to_telecaller=l.id  where  lead_id='$enq_id'")->result();?> 
                 	<?php if($fetch->transfer_id!=0)
					{?>
					
						<td><?php echo $query_dse1[0]->dse_fname . ' ' . $query_dse1[0]->dse_lname; ?></td>
					<?php }else{?>
						<td></td>
						<?php } ?>
					 <?php $query_dse=$this->db->query("SELECT d.disposition_name,f.comment,f.date,f.nextfollowupdate FROM  lead_followup_lc f LEFT JOIN tbl_disposition_status d ON d.disposition_id =f.disposition  where f.leadid='$enq_id'  and assign_to='$fetch->assign_to_telecaller' ORDER BY f.id DESC  limit 1")->result();?>
                    
                 <?php if($fetch->transfer_id!=0)
					{?>
                     <td><?php if(count($query_dse)>0){echo $query_dse[0]->date; } ?></td>
                      <td><?php if(count($query_dse)>0){ echo $query_dse[0]->disposition_name; }?></td>
                     
                    
                  	<td><?php if(count($query_dse)>0){ echo $query_dse[0]->comment; }?></td>  
                  	<td><?php if(count($query_dse)>0){ echo $query_dse[0]->nextfollowupdate; }?></td>
						<?php }else{ ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							
							<?php } ?>		
								
							 <!-- Car Information -->
                  		
					<td><?php echo $fetch->status_name;?> </b><?php if($_SESSION['role']==1 || $_SESSION['role']==2){?><a href="<?php echo site_url();?>tracker/reopen?enq_id=<?php echo $enq_id; ?> "><b> Reopen</b> </a><?php }?></td>
                  	<td><?php echo $fetch->buyer_type;?></td>
                    <td><?php echo $fetch->new_model_name.' '.$fetch->variant_name; ?></td>
          			 <td><?php echo $fetch->make_name.' '.$fetch->old_model_name;?></td>
                    <td><?php echo $fetch->manf_year;?></td>
                    <td><?php echo $fetch->color;?></td>
                    <td><?php echo $fetch->km;?></td>
					<td><?php echo $fetch->ownership;?></td>
					<td><?php echo $fetch->accidental_claim;?></td>
				
					<td><?php echo $fetch->buy_status;?></td>
							
						</tr>	
						<?php } ?>
					</tbody>
					</table>

		</div>
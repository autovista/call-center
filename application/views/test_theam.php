<!--<ol class="breadcrumb bc-3" >
	<li>
		<a href=""><i class="fa fa-home"></i>Home</a>
	</li>
	<li class="active">
		<strong>Lead Management System</strong>
	</li>
</ol>-->

<div class="container body" style="width: 100%;">

	<div class="main_container">

			<?php
			$today = date('d-m-Y');
			?>
		<script>	jQuery(document).ready(function(){
    $('#results').DataTable();
});</script>
			<h1 style="text-align:center;">Pending Leads - Attended</h1>
			<div class="table-responsive "  style="overflow-x:auto;">
			
				<form action="" method="get" enctype="application/x-www-form-urlencoded">
		<div class="panel panel-primary" style="border-color: #eaeaea">
				<table class="result table table-bordered datatable table-responsive"" id="results">
				<thead>
				<tr>
				<th>Sr No.</th>
				<th>Interested In</th>
				<th>Name</th>
				<th>Contact</th>
				<th>Email</th>
				<th>Lead Date</th>
			
				<th>Status</th>
				<th>Assign By</th>
				<th>Comment</th>
				
				<th>Action</th>
				<!--<th>Transfer</th>-->

				</tr>
				</thead>
				<tbody>
				<?php
				$i=0;

				foreach($select_lead as $fetch)
				{

				$enq_id=$fetch->enq_id;
				$status = $fetch->status;
				$i++;
				?>
				<tr>
				<td><?php echo $i; ?></td>

				<td><?php echo $fetch -> enquiry_for; ?></td>

				<?php
				$query = $this -> db -> query("select count(leadid)as fcount from lead_followup where leadid='$enq_id' ") -> result();
			
				?>

				<td><b><a href="<?php echo site_url();?>website_leads/lms_details/<?php echo $enq_id;?> " title="Customer Follow Up Details"><?php echo $fetch -> name;
	echo "(" . $query[0]-> fcount . ")";
 ?> </a></b></td>
				<td><?php echo $fetch -> contact_no; ?></td>
				<td><?php echo $fetch -> email; ?></td>

				<td><?php echo $fetch -> created_date; ?></td>
		

				<td>
				<?php

				if ($status == 1) {
					echo "Not Yet";
				}

				if ($status == 2) {
					echo "Live";
				}
				if ($status == 3) {
					echo "Postpone";
				}
				if ($status == 4) {
					echo "Lost";
				}
				if ($status == 5) {
					echo "Convert";
				}
				?>

				</td>
				<td>
				<?php
				echo $fetch -> fname . " " . $fetch -> lname;
				?>
				</td>
				<td><?php echo $fetch -> comment; ?></td>
				
				

				<td><a href="<?php echo site_url();?>add_followup/detail/<?php echo $fetch->enq_id?>/pending_attended">Add Follow Up </a>
					 | <a href="<?php echo site_url();?>remove_duplicate/leads/<?php echo $enq_id;?>/pending_attended"  onclick="return confirm('Do you want to delete this record?')">Remove</a></td>

				
				
				</tr>
				<?php } ?>
				</tbody>

				</table>
				
				<br />
			</div>
		</div>

		<!-- /page content -->
		
       
    </form>
	</div>

</div>
       
       
    
    
    </body>
</html>

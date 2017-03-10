
 <script type="text/javascript">
$(function () {
    //Loop through all Labels with class 'editable'.
    $(".editable").each(function () {
        //Reference the Label.
        var label = $(this);
 
        //Add a TextBox next to the Label.
        label.after("<input type = 'text' style = 'display:none' />");
 
        //Reference the TextBox.
        var textbox = $(this).next();
 
        //Set the name attribute of the TextBox.
        textbox[0].name = this.id.replace("lbl", "txt");
 
        //Assign the value of Label to TextBox.
        textbox.val(label.html());
 
        //When Label is clicked, hide Label and show TextBox.
        label.click(function () {
            $(this).hide();
            $(this).next().show();
        });
 
        //When focus is lost from TextBox, hide TextBox and show Label.
        textbox.focusout(function () {
            $(this).hide();
            $(this).prev().html($(this).val());
            $(this).prev().show();
        });
    });
});
</script>
<div class="container body" style="width: 100%;">

	<div id="leaddiv" class="main_container">

		<div class="row top_tiles">

			<div id="abc">
				<?php
				$today = date('d-m-Y');
				?>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						var $table4 = jQuery("#table-4");
						$table4.DataTable({
							dom : 'Bfrtip',
							buttons : ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
						});
					});
				</script>

				<h1 style="text-align:center;">Excel Leads</h1>
				<div  class="table-responsive"  style="overflow-x:auto;">
					<table class="table table-bordered datatable table-responsive"" id="table-4">
					<thead>
					<tr>
					<th>Sr No.</th>
					<th>Interested In</th>
					<th>Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Lead Date</th>
					<th>Status</th>
					<?php if($_SESSION['role']==3)
					{?>
					<th>Assign By</th>
					<?php }else{ ?>
						<th>Assign To</th>
						<?php } ?>
					<th>Comment</th>
					<th>Remark</th>
					<th>Action</th>
					<!--<th>Transfer</th>-->

					</tr>
					</thead>
					<tbody>
					<?php
					$i=0;

					foreach ($select_leads as $fetch) {

					$enq_id=$fetch->enq_id;
					$i++;
					?>
					<tr>
					<td><?php echo $i; ?></td>

					<td><?php echo $fetch -> enquiry_for; ?></td>

					<td><b><a href="<?php echo site_url(); ?>website_leads/lms_details/<?php echo $enq_id; ?> " title="Customer Follow Up Details"><?php echo $fetch -> name . '(' . $fetch -> fcount . ')'; ?></a></b></td>
					<td  id="lblName" class="editable"><?php echo $fetch -> contact_no; ?></td>
					<td><?php echo $fetch -> email; ?></td>

					<td><?php echo $fetch -> created_date; ?></td>

					<td>
					<?php $status = $fetch -> status;

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
					<?php /*$assign = $fetch -> assignby;
						 $query3 = mysql_query("select fname,lname from lmsuser where id='$assign'") or die(mysql_error());
						 $fetch3 = mysql_fetch_array($query3);*/

						echo $fetch -> fname . " " . $fetch -> lname;
					?>
					</td>
					<td><?php echo $fetch -> comment; ?></td>
					<td>
					<?php

					$query3 = $this -> db -> query("select comment from lead_followup where leadid='$enq_id'  order by id desc limit 1") -> result();
					if ($fetch -> fcount != 0) {
						echo $query3[0] -> comment;

					}
				?>
					</td>

					<?php if($_SESSION['role']==3)
{?>
				<td><a href="<?php echo site_url();?>add_followup/detail/<?php echo $enq_id;?>/excel">Add Follow Up </a> | 
					<a href="<?php echo site_url();?>remove_duplicate/leads/<?php echo $enq_id;?>/excel"  onclick="return confirm('Do you want to delete this record?')">Remove</a><!--<td><a href="request_lead_transfer.php?id=<?php echo $enq_id; ?>">Request To Transfer</a></td>--></td>

<?php }else{
	if($fetch->assign_to_telecaller==0){ ?>
	<td><a href="<?php echo site_url();?>manager_remark/leads/<?php echo $enq_id;?>/excel">Manager Remark </a></td>
	<?php }else
{
	?>
	<td></td>
<?php }} ?>
					</tr>
					<?php } ?>
					</tbody>

					</table>
					<br />
				</div>
			</div>

		</div>
	</div>
</div>


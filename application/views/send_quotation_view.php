<!DOCTYPE html>
<html><body>
	<div style="text-align: center">
	<h1>Excell Autovista Pvt. Ltd.</h1>												
<h3>257, S. V. Road, Bandra (W), MUMBAI- 400 050, 												
 Tel : +91-8888807738, Email : info@autovista.in.												
</h3>
</div>

			 <?php 
			if($select_data[0]->model_name=='S-CROSS'|| $select_data[0]->model_name=='BALENO'||$select_data[0]->model_name=='IGNIS')
			  {
			  	?>
			
	 <table border="1">
			 <tr>
				<th>City</th>
				<th>Model Name</th>
				<th>Description</th>
				<th>Entry Tax </th>
				<th>Ex-Showroom </th>
				<th>TCS@1%On Taxable amount </th>
				<th>Individual (RTO Tax +Road Safety Cess+Regsitrtaion Fee Payable to RTO) </th>
				<th>Compnay  (RTO Tax +Road Safety Cess+ Regsitrtaion Fee Payable to RTO) </th>
				<th>Zero Dep Insurance </th>
				<th>Return to Invoice </th>
				<th>Engine Protect	 </th>
				<th>RTI & EP</th>
				<th>TOTAL RTI & EP </th>
				<th>My Nexa Card </th>
				<th>Gold EW	Platinum EW </th>
				<th>Individual ONRAOD with Nexa Gold EW </th>
				<th>Company ONROAD with Nexa Gold EW </th>
			</tr>
        
   	<?php foreach ($select_data as $fetch) {?>
					<tr style="text-align:center">
				
					<td >  <?php echo $fetch->city ;?></td>
					<td> <?php echo $fetch->model_name;?></td>
					<td> <?php echo $fetch->description;?></td>
					<td ><?php echo $fetch->entry_tax;?></td>
					<td> <?php echo $fetch->ex_showroom;?></td>
					<td> <?php echo $fetch->tcs; ?></td>
					<td> <?php echo $fetch->individual ;?></td>
					<td> <?php echo $fetch->company;?></td>
					<td> <?php echo $fetch->zero_dep_insurance;?></td>
					<td><?php echo $fetch->return_to_invoice;?></td>
					<td> <?php echo $fetch->engine_protect;?></td>
					<td> <?php echo $fetch->rti_and_ep;?></td>
					<td> <?php echo $fetch->total_rti_and_ep;?></td>
					<td> <?php echo $fetch->my_nexa_card;?></td>
					<td><?php echo $fetch->gold_ew;?></td>
               	<td><?php echo $fetch->platinum_ew;?></td>
               	<td> <?php echo $fetch->individual_onroad_with_nexa_gold_ew;?></td>
              
               </tr>
                 	<?php } ?>
                
                
               </table>
               <?php }
else if(($select_data[0]->city=='Pune-PCMC'|| $select_data[0]->city=='Pune-PMC') && ($select_data[0]->model_name!='S-CROSS'|| $select_data[0]->model_name!='BALENO'||$select_data[0]->model_name!='IGNIS'))

			  {
			  	?>
			  	
			  <table border="1">
			  	<tr>
			  		<th colspan="12"><?php echo $select_data[0]->city.' Price';?></th>
			  		<th colspan="14"><?php echo $select_data[0]->city.' OUTSIDE LBT LIMIT PRICE';?></th>
			  	</tr>
			  	
			 <tr>
				
				<th>Model Name</th>
				<th>Description</th>
				<th>EX-SHOWROOM PRICE</th>
				<th>INS.</th>
				<th>RTO TAX</th>
				<th>	Registration Fees* </th>
				<th>Registration Plate </th>
				<th>3rd & 4th Yr. EXT. WARR	</th>
				<th>Auto Card </th>
				<th>TOTAL</th>
				<th>Comprehensive</th>
				<th>Zero Dep</th>
				<th>Zero dep + Eng Protect</th>
				<th>Zero dep + Eng Protect + RTI</th>
				
				
				<th>EX-SHOWROOM PRICE</th>
				<th>INS.</th>
				<th>RTO TAX</th>
					<th>Registration Fees* </th>
				<th>Registration Plate </th>
				<th>3rd & 4th Yr. EXT. WARR</th>
				<th>	Auto Card </th>
				<th>TOTAL</th>
				<th>Comprehensive</th>
				<th>Zero Dep</th>
				<th>Zero dep + Eng Protect</th>
				<th>Zero dep + Eng Protect + RTI</th>
				
			</tr>
			
        <?php foreach ($select_data as $fetch) {?>
					<tr style="text-align:center">
					<td> <?php echo $fetch->model_name;?></td>
					<td> <?php echo $fetch->description;?></td>
					<td ><?php echo $fetch->ex_showroom_price;?></td>
					<td> <?php echo $fetch->ins;?></td>
					<td> <?php echo $fetch->rto_tax; ?></td>
					<td> <?php echo $fetch->registration_fee ;?></td>
					<td> <?php echo $fetch->registration_plate;?></td>
					<td> <?php echo $fetch->external_warrenty;?></td>
					<td><?php echo $fetch->auto_card;?></td>
					<td> <?php echo $fetch->total_price;?></td>
					<td> <?php echo $fetch->Comprehensive;?></td>
					<td> <?php echo $fetch->zero_dep;?></td>
					<td> <?php echo $fetch->zero_dep_plus_eng_protect;?></td>
					<td><?php echo $fetch->zero_dep_eng_protect_rti;?></td>
					
					<td ><?php echo $fetch->ex_showroom_price_o;?></td>
					<td> <?php echo $fetch->ins_o;?></td>
					<td> <?php echo $fetch->rto_tax_o; ?></td>
					<td> <?php echo $fetch->registration_fee_o ;?></td>
					<td> <?php echo $fetch->registration_plate_o;?></td>
					<td> <?php echo $fetch->external_warrenty_o;?></td>
					<td><?php echo $fetch->auto_card_o;?></td>
					<td> <?php echo $fetch->total_price_o;?></td>
					<td> <?php echo $fetch->Comprehensive_o;?></td>
					<td> <?php echo $fetch->zero_dep_o;?></td>
					<td> <?php echo $fetch->zero_dep_plus_eng_protect_o;?></td>
					<td><?php echo $fetch->zero_dep_eng_protect_rti_o;?></td>
             
             
              
               </tr>
                 	<?php } ?>
                
                
             </table><?php }
			else
				 {
				  
				

               ?>
                <table border="1">
			 <tr>
			 
				<th>City</th>
				<th>Model Name</th>
				<th>Description</th>
				<th>Type</th>
				<th>Ex-Showroom </th>
				<th>AUTO CARD & NUM. PLATE EXP. </th>
				<th>Zero Dep Insurance (With EP & RTI) </th>
				<th>Individual Registration</th>
				<th>Company Registration</th>
				<th>TCS @1%</th>
				<th>Individual ONRAOD</th>
				<th>Company ONROAD</th>
				<th>3rd year Warranty </th>
				<th>3rd & 4th year Warranty</th>
				<th>Engine Protect</th>
				<th>Return Invoice</th>
			</tr>
        
   	<?php foreach ($select_data as $fetch) {?>
					<tr style="text-align:center">
			
					<td >  <?php echo $fetch->city ;?></td>
					<td> <?php echo $fetch->model_name;?></td>
					<td> <?php echo $fetch->description;?></td>
					<td ><?php echo $fetch->type;?></td>
					<td> <?php echo $fetch->ex_showroom;?></td>
					<td> <?php echo $fetch->auto_card_num_plate_exp; ?></td>
					<td> <?php echo $fetch->zero_dep_insurance ;?></td>
					<td> <?php echo $fetch->individual_registration;?></td>
					<td> <?php echo $fetch->company_registration;?></td>
						<td><?php echo $fetch->tcs_at_one_percentage;?></td>
					<td> <?php echo $fetch->individual_onroad;?></td>
					<td> <?php echo $fetch->company_onroad;?></td>
					<td> <?php echo $fetch->third_year_warranty;?></td>
					
					<td> <?php echo $fetch->third_fourth_year_warranty;?></td>
					<td><?php echo $fetch->engine_protect;?></td>
               	<td><?php echo $fetch->return_invoice;?></td>
               	
              
               </tr>
                 	<?php } ?>
                
                
               </table>
                <?php }?>
                <br>
                <?php if(count($select_offer)>0 )
				{?>
                	<h3>Consumer Offers</h3>
                 <table border="1">
			 <tr>
			 
				
				<th>City</th>
				<th>Model Name</th>
				<th>Description</th>
				<th>Amount</th>
				<th>MI Disocount</th>
				<th>Exchange </th>
				<th>Total Benifit</th>
				
			</tr>
        
   	<?php
   	foreach ($select_offer as $fetch) {?>
					<tr style="text-align:center">
			
					<td> <?php echo $fetch->location;?></td>
					<td> <?php echo $fetch->model;?></td>
					<td> <?php echo $fetch->description;?></td>
					<td ><?php echo $fetch->amount;?></td>
					<td> <?php echo $fetch->mi_discount;?></td>
					<td> <?php echo $fetch->exchange; ?></td>
					<td> <?php echo $fetch->total_benefit ;?></td>
					
               	
              
               </tr>
                 	<?php } ?>
                
                
               </table>
               <?php } ?>
             
              <div>
              	<h4>TERMS & CONDITIONS:</h4>
              	<ul><li>Delivery against full payment in advance</li>
              		<li>Equipment specification & price inclusive of Excise duty & Tax quote above are subject to change without prior notice. </li>
              		<li>Terms & conditions of sale and documents required as per order booking form.</li>
					<li>Prices are subject  to change without prior notice. Prices prevailing at the time of delivery will be applicable irrespective when the initial booking amount was paid.</li>              
 					<li>Cheque, Pay Order or RTGS/NEFT in Favour of <b>'Excell Autovista Pvt. Ltd'</b></li>             	
              	</ul>
              </div>  
				
                <h3>Thanks and regards,</h3>
        
              <h4>Team Autovista </h4>
             
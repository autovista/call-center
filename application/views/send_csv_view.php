<?php

if(isset($select_data))
{
	
	if($select_data[0]->model_name=='S-CROSS'|| $select_data[0]->model_name=='BALENO'|| $select_data[0]->model_name=='IGNIS')
			  {
			  	
			  	 $csv = "City,Model Name,Description,type,Entry Tax ,Ex-Showroom,TCS@1%On Taxable amount,Individual (RTO Tax +Road Safety Cess+Regsitrtaion Fee Payable to RTO),Compnay  (RTO Tax +Road Safety Cess+ Regsitrtaion Fee Payable to RTO),Zero Dep Insurance,Return to Invoice,Engine Protect,RTI & EP,TOTAL RTI & EP,My Nexa Card,Gold EW	Platinum EW ,Individual ONRAOD with Nexa Gold EW ,Company ONROAD with Nexa Gold EW  \n";//Column headers
foreach ($select_data as $record){

    $csv.= $record->city.','.$record->model_name.','.$record->description.','.$record->type.','.$record->entry_tax.','.$record->ex_showroom.','.$record->tcs.','.$record->individual.','.$record->company.','.$record->zero_dep_insurance.','.$record->return_to_invoice.','.$record->engine_protect.','.$record->rti_and_ep.','.$record->total_rti_and_ep.','.$record->my_nexa_card.','.$record->gold_ew.','.$record->platinum_ew.','.$record->individual_onroad_with_nexa_gold_ew.','.$record->company_onroad_with_nexa_gold_ew."\n"; //Append data to csv
    }
}
else if(($select_data[0]->city=='Pune-PCMC'|| $select_data[0]->city=='Pune-PMC') && ($select_data[0]->model_name!='S-CROSS'|| $select_data[0]->model_name!='BALENO'||$select_data[0]->model_name!='IGNIS'))
{
		
			$csv = ", ,,, ,,,Pune-PCMC Price, , , ,,,, , ,,, , ,,Pune-PCMC OUTSIDE LBT LIMIT PRICE,,,,,,\n";//Column headers	
		$csv = $csv."City,Model Name,Description,Type,EX-SHOWROOM PRICE,INS,RTO TAX,Registration Fees*,Registration Plate,3rd & 4th Yr. EXT. WARR,Auto Card,TOTAL,Comprehensive,Zero Dep,Zero dep + Eng Protect,Zero dep + Eng Protect + RTI,,EX-SHOWROOM PRICE,INS,RTO TAX,Registration Fees*,Registration Plate,3rd & 4th Yr. EXT. WARR,Auto Card,TOTAL,Comprehensive,Zero Dep,Zero dep + Eng Protect,Zero dep + Eng Protect + RTI\n";//Column headers

		foreach ($select_data as $record){
	
   $csv.= $record->city.','.$record->model_name.','.$record->description.','.$record->type.','.$record->ex_showroom_price.','.$record->ins.','.$record->rto_tax.','.$record->registration_fee.','.$record->registration_plate.','.$record->external_warrenty.','.$record->auto_card.','.$record->total_price.','.$record->Comprehensive.','.$record->zero_dep.','.$record->zero_dep_plus_eng_protect.','.$record->zero_dep_eng_protect_rti.',,'.$record->ex_showroom_price_o.','.$record->ins_o.','.$record->rto_tax_o.','.$record->registration_fee_o.','.$record->registration_plate_o.','.$record->external_warrenty_o.','.$record->auto_card_o. ','.$record->total_price_o.','.$record->Comprehensive_o.','.$record->zero_dep_o.','.$record->zero_dep_plus_eng_protect_o.','.$record->zero_dep_eng_protect_rti_o."\n"; //Append data to csv

    }

			  }

    

			  
	else{
	
$csv = "City,Model Name,Description,Type,Ex-Showroom,AUTO CARD & NUM. PLATE EXP.,Zero Dep Insurance (With EP & RTI),Individual Registration,Company Registration,TCS @1%,Individual ONRAOD,Company ONROAD,3rd year Warranty,3rd & 4th year Warranty,Engine Protect,Return Invoice \n";//Column headers
foreach ($select_data as $record){
    $csv.= $record->city.','.$record->model_name.','.$record->description.','.$record->type.','.$record->ex_showroom.','.$record->auto_card_num_plate_exp.','.$record->zero_dep_insurance.','.$record->individual_registration.','.$record->company_registration.','.$record->tcs_at_one_percentage.','.$record->individual_onroad.','.$record->company_onroad.','.$record->third_year_warranty.','.$record->third_fourth_year_warranty.','.$record->engine_protect.','.$record->return_invoice."\n"; //Append data to csv
    }
	}
	
	if(count($select_offer)>0 )
				{
					$csv.=" \n";
					$csv.= ", ,Consumer Offers,\n";//Column headers	
					 $csv.="City,Model Name,Description,Amount,MI Disocount,Exchange,Total Benifit \n";//Column headers
		foreach ($select_offer as $record) {

    $csv.= $record->location.','.$record->model.','.$record->description.','.$record->amount.','.$record->mi_discount.','.$record->exchange.','.$record->total_benefit."\n"; //Append data to csv
  
                
    }}
	
	 
	
	
$csv_handler = fopen ('car_quotation.csv','w');
fwrite ($csv_handler,$csv);
fclose ($csv_handler);	
}
 /*if(count($select_offer)>0 )
				{
					  	 $csv = "City,Model Name,Description,Amount,MI Disocount,Exchange,Total Benifit \n";//Column headers
	foreach ($select_offer as $record) {

    $csv.= $record->location.','.$record->model.','.$record->description.','.$record->amount.','.$record->mi_discount.','.$record->exchange.','.$record->total_benefit."\n"; //Append data to csv
  
                
    }}
$csv_handler = fopen ('car_consumer_offser.csv','w');
fwrite ($csv_handler,$csv);
fclose ($csv_handler);	*/
				 ?>

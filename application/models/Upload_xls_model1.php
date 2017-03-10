<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class upload_xls_model1 extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	

	public function upload($outlet_name,$supplier_category,$supplier,$model,$sub_model_code,$submodel,$color_code,$color,$fuel_type,$chassis_number,$engine_number,$key_no,$dealer_vin_no,$vehicle_status,$acc_issued_amount,$quality_status,$octroi,$manuf_fin_number,$manuf_fin_date,$gp_number,$veh_order_cat,$INF_financier,$receipt_number,$receipt_date,$order_number,$customer_name,$alloted_date,$rto_invoiceNo,$rto_invoice_date,$purchase_price,$stock_location,$assigned_location,$bin_no,$dse_executive,$team_leader,$purchase_remarks,$damage_remarks,$year_of_mfr_invoice,$rebilled,$gate_pass_no,$gate_pass_date,$ageing)
	 {
		
	
			$created_date = date("Y-m-d");
		
			$this -> db -> select('model_id');
			$this -> db -> from('make_models');

			if($model == 'WAGON-R')
			{
				
				$this -> db -> where('model_name', 'Wagon R');
				
			}
		else {
			
		$this -> db -> where('model_name', $model);
			}
		
			$query = $this -> db -> get() -> result();
			
		//	print_r($query);
			
			foreach ($query as $row) {

			$model_id = $row -> model_id;

			echo $model_id;
		
			if($vehicle_status == 'FREE' || $vehicle_status == 'BLOCKED' )
			{
				
			$query=$this->db->query("insert into tbl_stock_in_hand_new (`outlet_name`,`supplier_category`,`supplier`,`model`,`sub_model_code`,`submodel`,`color_code`,`color`,`fuel_type`,`chassis_number`,`engine_number`,`key_no`,`dealer_vin_no`,`vehicle_status`,`acc_issued_amount`,`quality_status`,`octroi`,`manuf_fin_number`,`manuf_fin_date`,`gp_number`,`veh_order_cat`,`INF_financier`,`receipt_number`,`receipt_date`,`order_number`,`customer_name`,`alloted_date`,`rto_invoiceNo`,`rto_invoice_date`,`purchase_price`,`stock_location`,`assigned_location`,`bin_no`,`dse_executive`,`team_leader`,`purchase_remarks`,`damage_remarks`,`year_of_mfr_invoice`,`rebilled`,`gate_pass_no`,`gate_pass_date`,`ageing`,`created_date`)
			
			values('".$outlet_name."','".$supplier_category."','".$supplier."','".$model_id."','".$sub_model_code."','".$submodel."','".$color_code."','".$color."','".$fuel_type."','".$chassis_number."','".$engine_number."','".$key_no."','".$dealer_vin_no."','".$vehicle_status."','".$acc_issued_amount."','".$quality_status."','".$octroi."','".$manuf_fin_number."','".$manuf_fin_date."','".$gp_number."','".$veh_order_cat."','".$INF_financier."','".$receipt_number."','".$receipt_date."','".$order_number."','".$customer_name."','".$alloted_date."','".$rto_invoiceNo."','".$rto_invoice_date."','".$purchase_price."','".$stock_location."','".$assigned_location."','".$bin_no."','".$dse_executive."','".$team_leader."','".$purchase_remarks."','".$damage_remarks."','".$year_of_mfr_invoice."','".$rebilled."','".$gate_pass_no."','".$gate_pass_date."','".$ageing."','".$created_date."')");
		
			}
			
		
			
		}
		
		
	}

		public function upload2($outlet_name,$make,$model,$submodel,$color,$source,$emission,$fuel_type,$rto_no,$reg_date,$chassis_number,$engine_number,$mfg_year,$mfg_month,$owner,$mileage,$odo_meter,$financier,$insurance_type,$insurance_expiry_date,$category,$ntv_reason,$rc_status,$vehicle_status,$quality_status,$receipt_number,$receipt_date,$evaluator_code,$evaluator_name,$evaluator_tl,$purchase_price,$est_refurbishment_cost,$battery_replacement,$body_repair,$labour,$mga_accessories,$outside_labour,$spare_parts,$tyre_replacement,$workshop_repair,$total_refurbishment_amount,$other,$total_other_expense,$expt_selling_price,$approved_disc,$exch_order_no,$exchange_dealer_share,$exchange_mgf_share,$exchange_bonus,$order_number,$customer_name,$allotted_date,$aloted_aging,$dse,$tl,$total_landing_cost,$ageing,$stock_location,$stock_ageing,$ready_for_sale,$ready_for_sale_date,$ready_for_sale_ageing)
	 {
		
				$created_date = date("Y-m-d");		
				//echo "hi";
		
	
			$this -> db -> select('make_id');
			$this -> db -> from('makes');
			$this->db->where('make_name',$make);
			$query=$this->db->get()->result();
			print_r($query);
			
			
			$make_id_count=count($query);
			
			if($make_id_count < 1)
			{
				
				$query1=$this->db->query("insert into makes (`make_name`) values('".$make."')");
				$insert_id = $this->db->insert_id();
				$make_id=$insert_id;
				
			}
			
			else {
			
			$make_id=$query[0]->make_id;
				
			
				}

	if($vehicle_status == 'FREE' || $vehicle_status == 'BLOCKED' )
			{

				$query=$this->db->query
				
				("insert into tbl_stock_in_hand_poc (`outlet_name`,`make`,`model`,`submodel`,`color`,`source`,`emission`,`fuel_type`,`rto_no`,`reg_date`,`chassis_number`,
				
				`engine_number`,`mfg_year`,`mfg_month`,`owner`,`mileage`,`odo_meter`,`financier`,`insurance_type`,`insurance_expiry_date`,`category`,`ntv_reason`,`rc_status`,`vehicle_status`,`quality_status`,`receipt_number`,`receipt_date`,`evaluator_code`,`evaluator_name`,
				
				`evaluator_tl`,`purchase_price`,`est_refurbishment_cost`,`battery_replacement`,`body_repair`,`labour`,`mga_accessories`,`outside_labour`,`spare_parts`,`tyre_replacement`,
				
				`workshop_repair`,`total_refurbishment_amount`,`other`,`total_other_expense`,`expt_selling_price`,`approved_disc`,`exch_order_no`,`exchange_dealer_share`,`exchange_mgf_share`,`exchange_bonus`,`order_number`,
				
				`customer_name`,`allotted_date`,`aloted_aging`,`dse`,`tl`,`total_landing_cost`,`ageing`,`stock_location`,`stock_ageing`,`ready_for_sale`,
				
				`ready_for_sale_date`,`ready_for_sale_ageing`,`created_date`)
				
				values('".$outlet_name."','".$make_id."','".$model."','".$submodel."','".$color."','".$source."','".$emission."','".$fuel_type."','".$rto_no."','".$reg_date."','".$chassis_number."',
				
				'".$engine_number."','".$mfg_year."','".$mfg_month."','".$owner."','".$mileage."','".$odo_meter."','".$financier."','".$insurance_type."','".$insurance_expiry_date."','".$category."','".$ntv_reason."','".$rc_status."','".$vehicle_status."','".$quality_status."','".$receipt_number."','".$receipt_date."','".$evaluator_code."','".$evaluator_name."',
				
				'".$evaluator_tl."','".$purchase_price."','".$est_refurbishment_cost."','".$battery_replacement."','".$body_repair."','".$labour."','".$mga_accessories."','".$outside_labour."','".$spare_parts."','".$tyre_replacement."',
				
				'".$workshop_repair."','".$total_refurbishment_amount."','".$other."','".$total_other_expense."','".$expt_selling_price."','".$approved_disc."','".$exch_order_no."','".$exchange_dealer_share."','".$exchange_mgf_share."','".$exchange_bonus."','".$order_number."',
				
				'".$customer_name."','".$allotted_date."','".$aloted_aging."','".$dse."','".$tl."','".$total_landing_cost."','".$ageing."','".$stock_location."','".$stock_ageing."',
				
				'".$ready_for_sale."','".$ready_for_sale_date."','".$ready_for_sale_ageing."','".$created_date."'
			
				)");
				
				
					
					}
			
	 
	 
	 }
	



}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class old_car_stock_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	function select_old_stock()
	{
		
		$this->db->select_max('created_date');
		$this->db->from('tbl_stock_in_hand_poc');
		$max_date1 = $this -> db -> get()->result();
		
		foreach($max_date1 as $row)
		{
			$max_date = $row->created_date;
			
		}	
		$this -> db -> select('mk.make_name,st.submodel,st.color,st.fuel_type,st.owner,st.mfg_year,st.odo_meter,st.mileage,st.insurance_type,st.insurance_expiry_date,st.category,st.vehicle_status,st.stock_location,st.expt_selling_price,st.stock_ageing,st.total_landing_cost,st.created_date');
		$this -> db -> from('tbl_stock_in_hand_poc st');		
		$this -> db -> join('makes mk', 'mk.make_id=st.make');
		$this -> db -> where('created_date', $max_date);
		$query = $this -> db -> get();
		return $query -> result();
	}
	
	
		function stock_location() {
		$this->db->distinct();		
		$this -> db -> select('stock_location');
		$this -> db -> from('tbl_stock_in_hand_poc');
		$query = $this -> db -> get();
		return $query -> result();
	}

	
	function select_make() {
		$this->db->distinct();	
		$this -> db -> select('make_name,make_id');
		$this -> db -> from('makes');
		$this -> db -> where('make_name !=','');
		$query = $this -> db -> get();
		return $query -> result();
	}
	
		function select_model() {
		$this->db->distinct();	
		$this -> db -> select('model_name,model_id');
		$this -> db -> from('make_models');
		$this -> db -> where('make_id =','1');
		$query = $this -> db -> get();
		return $query -> result();
	}


		function assigned_location() {
		$this->db->distinct();		
		$this -> db -> select('assigned_location');
		$this -> db -> from('tbl_stock_in_hand_new');
		$query = $this -> db -> get();
		return $query -> result();
	}


	function old_stock_filter($make,$stock_location,$budget_from,$budget_to,$created_date) {
		
		$this -> db -> select('mk.make_name,st.make,st.total_landing_cost,st.submodel,st.color,st.fuel_type,st.owner,st.mfg_year,st.odo_meter,st.mileage,st.insurance_type,st.insurance_expiry_date,st.category,st.vehicle_status,st.stock_location,st.expt_selling_price,st.stock_ageing,st.created_date,st.total_landing_cost');
		$this -> db -> from('tbl_stock_in_hand_poc st');		
		$this -> db -> join('makes mk', 'mk.make_id=st.make');
		
		if($make !='')
		{
		$this -> db -> where('make', $make);	
		}
		
		if($stock_location !='')
		{
		$this -> db -> where('stock_location', $stock_location);	
		}
		
	
		
		if($budget_from !='')
		{
			
			//echo "hi";
			$this -> db -> where('expt_selling_price >=', $budget_from);
		}
		if($budget_to !='')
		{
			$this -> db -> where('expt_selling_price <=', $budget_to);
		}
		
			if($created_date !='')
		{
			$this -> db -> where('created_date', $created_date);
		}
		
	
		
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
		
		
		
	}





}
?>
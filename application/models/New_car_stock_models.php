<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class new_car_stock_models extends CI_model {
	function __construct() {
		parent::__construct();
	}

	function select_stock()
	{
		

		$this->db->select_max('created_date');
		$this->db->from('tbl_stock_in_hand_new');
		$max_date1=$this->db->get()->result();
		
		foreach($max_date1 as $row)
		{
			$max_date=$row->created_date;
			
		}

		$this -> db -> select('st.submodel,st.color,st.fuel_type,st.vehicle_status,st.assigned_location,st.ageing,st.created_date,st.created_date,m.model_name');
		$this -> db -> from('tbl_stock_in_hand_new st');		
		$this -> db -> join('make_models m', 'm.model_id=st.model');
		$this->db->where('created_date',$max_date);
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



	function new_stock_filter($model,$assigned_location,$created_date) {
		
		$this -> db -> select('st.submodel,st.color,st.fuel_type,st.vehicle_status,st.assigned_location,st.ageing,m.model_name,st.created_date');
		$this -> db -> from('tbl_stock_in_hand_new st');
		$this -> db -> join('make_models m', 'm.model_id=st.model');
		
		if($model != '')
		{
		$this -> db -> where('model', $model);	
		}
		
		if($assigned_location != '')
		{
				$this -> db -> where('assigned_location', $assigned_location);
			
		}
		
		if($created_date != '')
		{
			$this -> db -> where('created_date', $created_date);	
			
		}
	
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
	}


}
?>
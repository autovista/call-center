<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Old_car_stock extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('old_car_stock_model');

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	public function index() {
		$this -> session();
	
		$data['select_old_stock']=$this->old_car_stock_model->select_old_stock();	
		$data['select_make']=$this->old_car_stock_model->select_make();
		$data['stock_location']=$this->old_car_stock_model->stock_location();
		
		$this -> load -> view('include/admin_header.php');		
		$this -> load -> view('old_car_stock_view.php',$data);
		$this -> load -> view('include/footer.php');
	}
	
		public function old_stock_filter()
	{
		//echo "hi";
		
		$make=$this->input->post('make');
		$stock_location=$this->input->post('stock_location');
		$budget_from=$this->input->post('budget_from');
		$budget_to=$this->input->post('budget_to');
		$created_date=$this->input->post('created_date');
		
		
		$select_stock_filetr=$this->old_car_stock_model->old_stock_filter($make,$stock_location,$budget_from,$budget_to,$created_date);	
		
		//print_r($select_stock_filetr);
		?>
		
				<table class="table table-bordered datatable" id="results"> 
					<thead>
						<tr>
							<th>Sr No.</th>
							<th>Make</th>
						
							<th>Sub Model</th>
							<th>Color</th>
							<th>Fuel Type</th>
							<th>Owner</th>							
							<th>Mfg year</th>
							<th>Mileage</th>
							<th>Odo Meter</th>
							<th>Insurance</th>
							<th>Insurance Expiry</th>
							<th>Category</th>
							<th>Vehicle Status</th>
							<th>Stock Location</th>
							<th>Expt Selling Price</th>
							<th>Total landing Cost</th>
							<th>Ageing</th>
								<th>Last Updated</th>
						</tr>	
					</thead>
					<tbody>
				
					 <?php 
					 $i=0;
						foreach($select_stock_filetr as $fetch) 
						{
							$i++;
						?>
						
						
						<tr>
						<td>	
						<?php echo $i; ?> 		
						
						</td>
						<td><?php echo $fetch -> make_name; ?></td>
						
						<td><?php echo $fetch -> submodel; ?></td>
						<td><?php echo $fetch -> color; ?></td>
						<td><?php echo $fetch -> fuel_type; ?></td>	
						<td><?php echo $fetch -> owner; ?></td>	
						<td><?php echo $fetch -> mfg_year; ?></td>	
						<td><?php echo $fetch -> mileage; ?></td>	
						<td><?php echo $fetch -> odo_meter; ?></td>		
						<td><?php echo $fetch -> insurance_type; ?></td>		
						<td><?php echo $fetch -> insurance_expiry_date; ?></td>	
						<td><?php echo $fetch -> category; ?></td>						
						<td><?php echo $fetch -> vehicle_status; ?></td>  
						<td><?php echo $fetch -> stock_location; ?></td> 
						<td><?php echo $fetch -> expt_selling_price; ?></td> 
						<td><?php echo $fetch -> total_landing_cost; ?></td>
						<td><?php echo $fetch -> stock_ageing; ?></td>     
						<td><?php echo $fetch ->created_date; ?></td>                 
						 </tr>
						 
						 	 <?php } ?>
						 
					
					</tbody>
				</table>
				
			 <script>    jQuery(document).ready(function(){
    $('#results').DataTable();
});</script>

	
  
<?php
	
	}

	}
?>

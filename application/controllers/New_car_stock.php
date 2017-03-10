<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_car_stock extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model('new_car_stock_models');

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	public function index() {
		$this -> session();
	
		$data['select_stock']=$this->new_car_stock_models->select_stock();	
		$data['select_model']=$this->new_car_stock_models->select_model();
		$data['assigned_location']=$this->new_car_stock_models->assigned_location();
		
		$this -> load -> view('include/admin_header.php');		
		$this -> load -> view('New_car_stock_views.php',$data);
		$this -> load -> view('include/footer.php');
	}
	
		public function new_stock_filter()
	{
		//echo "hi";
		
		$model=$this->input->post('model');
		$assigned_location=$this->input->post('assigned_location');
		$created_date=$this->input->post('created_date');
		
		$select_stock_filetr=$this->new_car_stock_models->new_stock_filter($model,$assigned_location,$created_date);	
		
		//print_r($select_stock_filetr);

	?>
	 <script>    jQuery(document).ready(function(){
    $('#results').DataTable();
});</script>

	<table class="table table-bordered datatable" id="results"> 
					<thead>
						<tr>
							<th>Sr No.</th>
							<th>Model</th>
							<th>Sub Model</th>
							<th>Color</th>
							<th>Fuel Type</th>
							<th>Vehicle Status</th>
							<th>Stock Location</th>
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
							<td><?php echo $fetch -> model_name; ?></td>
						
							<td><?php echo $fetch -> submodel; ?></td>
						
							<td><?php echo $fetch -> color; ?></td>
						
						
							<td><?php echo $fetch -> fuel_type; ?></td>
								
							<td><?php echo $fetch -> vehicle_status; ?></td>  
							<td><?php echo $fetch -> assigned_location; ?></td> 
							<td><?php echo $fetch -> ageing; ?></td>                  
						 <td><?php echo $fetch ->created_date; ?></td>      
						 </tr>
						 
						 
						 	 <?php } ?>
						 
					
					</tbody>
				</table>
<?php
	}

	}
?>

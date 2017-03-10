<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_followup extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation', 'session'));
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> model(array('add_followup_model', 'website_lead_model', 'pending_model','today_followup_model','new_lead_model','transfer_lead_model'));
		
		date_default_timezone_set("Asia/Kolkata");

	}

	public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}

	public function detail($id, $path) {
		$this -> session();
		$enq_id = $id;
		$data['path'] = $path;
		$query = $this -> add_followup_model -> select_lead($enq_id);
		$data['lead_detail'] = $query;
		$data['disposition'] = $this -> add_followup_model -> select_disposition_id($query[0]->status_id);
		$data['select_group'] = $this -> add_followup_model -> select_group();
		$data['status'] = $this -> add_followup_model -> select_status();
		$query1 = $this -> add_followup_model -> select_location();
		$data['get_location1'] = $query1;

		$data['make_models'] = $this -> add_followup_model -> make_models();
		$data['select_followup_lead'] = $this -> add_followup_model -> select_followup_lead($enq_id);
		
		//$query2 = $this -> add_followup_model -> select_city();
		//print_r($query2);
		
		$data['select_city'] = $this -> add_followup_model -> select_city();
		$data['select_city1'] = $this -> add_followup_model -> select_city1();
	
		$data['model_variant'] = $this -> add_followup_model ->select_variant_main();
		$data['make_model'] = $this -> add_followup_model ->select_model_main();
		
		$data['makes'] = $this -> add_followup_model -> makes();
		$data['var'] = site_url('add_followup/insert_followup');
		$this -> load -> view('include/admin_header.php');
		$this -> load -> view('add_followup_view.php', $data);
		$this -> load -> view('include/footer.php');
	}
	public function select_disposition()
	{
		$status=$this->input->post('status');
		$select_disposition=$this->add_followup_model->select_disposition_id($status);
		?>
		  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Disposition:  </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                   <select name="disposition1" id="disposition1" class="form-control" onchange='check_status1(this.value);' required>
                         <option value="">Please Select</option>
                           <?php foreach($select_disposition as $row)
									{
										if($row->disposition_name=='Interested' || 	$row->disposition_name=='TD Scheduled')
										{
											
										}
										else {
											
										?>
						 <option value="<?php echo $row -> disposition_id; ?>"><?php echo $row -> disposition_name; ?></option>
										<?php } } ?>
                                        
                     </select>
               </div>
       
 <?php
	}function select_buy_model()
	{
	$make=$_POST['make'];
	$query=$this->add_followup_model->select_model($make);
		 ?>
		 <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name"> Car Model:</label>
         <div class="col-md-8 col-sm-8 col-xs-12">
             <select name="buy_model" id="buy_model" class="form-control" required >
                    <option value="">Please Select  </option>
					<?php	foreach($query as $row){?>							
					<option value="<?php echo $row -> model_id; ?>"><?php echo $row -> model_name; ?></option>
                    <?php } ?>
             </select>
        </div>
 <?php
}
	function select_model()
	{
	$make=$_POST['make'];
	$query=$this->add_followup_model->select_model($make);
		 ?>
		 <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name"> Car Model:</label>
         <div class="col-md-8 col-sm-8 col-xs-12">
             <select name="old_model" id="model" class="form-control" required >
                    <option value="">Please Select  </option>
					<?php	foreach($query as $row){?>							
					<option value="<?php echo $row -> model_id; ?>"><?php echo $row -> model_name; ?></option>
                    <?php } ?>
             </select>
        </div>
 <?php
}
function select_variant()
{
	$model=$_POST['model'];
	$query=$this->add_followup_model->select_variant($model);
?>
<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">New Car Variant:</label>
<div class="col-md-8 col-sm-8 col-xs-12">
	<select name="new_variant" id="new_variant" class="form-control"  >
		<option value="">Please Select  </option>
		<?php	foreach($query as $row){?>
		<option value="<?php echo $row -> variant_id; ?>"><?php echo $row -> variant_name; ?></option>
        <?php } ?>
   </select>
</div>
<?php }

	public function select_assign_to(){
		$location=$this->input->post('tlocation1');
		$select_assign=$this->add_followup_model->lmsuser($location);?>
		<div  class="form-group">
			 <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Assign To:</label>
                   <div class="col-md-8 col-sm-8 col-xs-12">
                        <select name="transfer_assign" id="tassignto1" class="form-control" required >
                              <option value="">Please Select </option> 
                              <?php foreach($select_assign as $row){?>
									<option value="<?php echo $row -> id; ?>"><?php echo $row -> fname . ' ' . $row -> lname; ?> </option> 
							<?php } ?>
                        </select>
					</div>
				</div>
<?php
}
	public function select_model_name(){
		
		$city=$this->input->post('city');
		
		//echo $city;
	
	
	
	if ($city=='Pune-PCMC'|| $city=='Pune-PMC'){
			$select_model_name=$this->add_followup_model->select_model_name1($city);
		$select_model_name1=$this->add_followup_model->select_model_name4($city);
		//print_r($select_model_name);
		}
	elseif($city=='PANVEL' || $city=='NON LBT')
		{
		$select_model_name=$this->add_followup_model->select_model_name2($city);
		//print_r($select_model_name);
			
		}
	else {
			$select_model_name=$this->add_followup_model->select_model_name3($city);
			$select_model_name1=$this->add_followup_model->select_model_name4($city);
			//print_r($select_model_name3);
	}
	
	

	
	
	?>
	     <select name="model_name" id="model_name" class="form-control" onchange="select_description();" required>
                                                  	
												 
												  
												 
					<option value="">Please Select  </option>
													
                     			 <?php foreach ($select_model_name as $row) {
                          
                      ?>
                      <option value="<?php echo $row->model_name;?>"><?php echo $row->model_name;?></option>
                      
                      
					  <?php } 
					  
					  if( $city!='PANVEL' || $city!='NON LBT')
					  
					  {
					  
					  foreach ($select_model_name1 as $row) {
                          
                      ?>
                      <option value="<?php echo $row->model_name;?>"><?php echo $row->model_name;?></option>
                      
                      
					  <?php } 
					  }
					  ?>
                     
          
                     			
                
                     
                     
                     
                           </select>
		
		
	
		
		
<?php
}
	
	
		public function select_description(){
		
		$model_name=$this->input->post('model_name');
		$city=$this->input->post('city');
		
		//echo $model_name;
		//echo $city;
	
	$select_description=$this->add_followup_model->select_description($model_name,$city);
	
//	print_r($select_description);
	?>
	 <select name="description" id="description" class="form-control" >
          <option value="">Please Select</option> 
			<?php foreach ($select_description as $row) {?>
                  <option value="<?php echo $row->description;?>"><?php echo $row->description.'  '. $row->type;?></option>
					  <?php } ?>
             </select>
		
<?php
}
	
	
function insert_followup() {
	$query=$this -> add_followup_model -> insert_followup();
	
	if (!$query) {
			 $this -> session -> set_flashdata('message', '<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Remark Added Successfully...!</strong>');
			} else {
			 $this -> session -> set_flashdata('message', '<div class="alert alert-danger text-center">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Remark Not added ...!</strong>');
			}
			//Send quotation 
	  $email = $this -> input -> post('email');
	 $quotation_location = $this -> input -> post('qlocation');
	 $quotation_model_name = $this -> input -> post('model_name');
	 $quotation_description = $this -> input -> post('description');
	  $phone = $this -> input -> post('phone');
	 if($quotation_location!='' && $quotation_model_name!='')
	 {
	$this->send_mail($email,$quotation_location, $quotation_model_name, $quotation_description,$phone);
	 }
	$a = $_POST['loc'];
	 $page_location=str_replace('%20',' ',$a);
	
	
	if ($page_location == 'Pending Live') {
		//redirect pending attended details
	redirect('pending/telecaller_leads');
	} elseif ($page_location == 'Pending New') {
		//redirect pending not attended details
	redirect('pending/telecaller_leads_not_attended');
	} elseif ($page_location == 'Today Followup') {
		//redirect today followup details
	redirect('today_followup');
	} else if($page_location == 'New'){
		//redirect new assign lead details
	redirect(new_lead);
	}else if($page_location == 'Transferred '){
		//redirect transfer details	
		redirect(transfer_lead);
	}
	else if($page_location == 'transfer_report'){
		//redirect transfer details	
		redirect(transfer_report);
	}
	else if($page_location=='tracker_lead')
	{
		redirect('tracker/leads');
		
	}
	else{
		//redirect data leads details
	redirect('website_leads/telecaller_leads/'.$page_location);
	}
	
	}
function insertFollowupThroughAjax() {
		$query=$this -> add_followup_model -> insert_followup();
		if (!$query) {
			 $this -> session -> set_flashdata('message_ajax', '<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Remark Added Successfully...!</strong>');
			} else {
			 $this -> session -> set_flashdata('message_ajax', '<div class="alert alert-danger text-center">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Remark Not added ...!</strong>');
			}
			$e=$_POST['loc'];
			$enq=str_replace('%20',' ',$e);
			$data['enq']=$enq;
		if($this->input->post('loc')=='Pending Live')
		{
			//get pending attened leads details
		$data['select_lead'] = $this -> pending_model -> select_lead();
		}
		else if($this->input->post('loc')=='Pending New')
		{
			//get pending Not attened leads details
		$data['select_lead'] = $this -> pending_model -> select_lead1();
		}
		else if($this->input->post('loc')=='Today Followup')
		{
			//get pending Not attened leads details
		$data['select_lead'] = $this -> today_followup_model -> select_lead();
		}
		else if($this->input->post('loc')=='New')
		{
		//get New leads details				
		$data['select_lead']=$this->new_lead_model->select_lead();
		}
		else if($this->input->post('loc')=='Transferred')
		{
		///get transfer leads details
		$data['select_lead'] = $this -> transfer_lead_model -> select_lead();
		}
		else
		{
		//get All data leads details
		$data['select_lead']=$this->website_lead_model->select_lead($enq);
		}

		$data['select_status']=$this->website_lead_model->select_status();
		//print_r($data['select_status']);
		$data['select_campaign']=$this->website_lead_model->select_campaign();
		$data['select_model']=$this->website_lead_model->select_model();
		$data['select_make']=$this->website_lead_model->select_make();
		$data['select_variant']=$this->website_lead_model->select_variant_new();
		$data['get_location1']=$this->website_lead_model->select_location();
		$data['select_group']=$this->website_lead_model->select_group();		
		
		$this -> load -> view('telecaller_followup_view.php', $data);
		
	}
	function insertremark() {
		$query=$this -> add_followup_model -> insert_remark();
		if (!$query) {
			 $this -> session -> set_flashdata('message_ajax', '<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Remark Added Successfully...!</strong>');
			} else {
			 $this -> session -> set_flashdata('message_ajax', '<div class="alert alert-danger text-center">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Remark Not added ...!</strong>');
			}
		$e=$_POST['loc'];
			$enq=str_replace('%20',' ',$e);
			$data['enq']=$enq;
		if($this->input->post('loc')=='Pending Live')
		{
			//get pending attened leads details
		$data['select_lead'] = $this -> pending_model -> select_lead();
		}
		else if($this->input->post('loc')=='Pending New')
		{
			//get pending Not attened leads details
		$data['select_lead'] = $this -> pending_model -> select_lead1();
		}
		else if($this->input->post('loc')=='Today Followup')
		{
			//get pending Not attened leads details
		$data['select_lead'] = $this -> today_followup_model -> select_lead();
		}
		else if($this->input->post('loc')=='New')
		{
		//get New leads details				
		$data['select_lead']=$this->new_lead_model->select_lead();
		}
		else if($this->input->post('loc')=='Transferred')
		{
		///get transfer leads details
		$data['select_lead'] = $this -> transfer_lead_model -> select_lead();
		}
		else
		{
		//get All data leads details
		$data['select_lead']=$this->website_lead_model->select_lead($enq);
		}


		$this -> load -> view('telecaller_followup_view.php', $data);
		
	}
 public function send_mail($email_id,$quotation_location, $quotation_model_name, $quotation_description,$phone)
  {
  	$this->load->helper('path');
 	$select_data=$this -> add_followup_model -> select_quotation($quotation_location, $quotation_model_name, $quotation_description);
 	$data['select_data']=$select_data;
 	$data['select_offer']=$this->add_followup_model->select_offer($quotation_location,$quotation_model_name);
	
 	$this->load->view('send_csv_view.php',$data);
 $config = Array(       
         
            'mailtype'  => 'html'
          
        );
        $this->load->library('email', $config);



$this->email->from('info@autovista.in', 'Autovista.in');
$this->email->to($email_id);
$this->email->bcc('jamil@autovista.in,snehal@autovista.in');

$this->email->subject('Maruti '.$quotation_model_name.' Quotation From Autovista');
$body = $this->load->view('send_quotation_view.php',$data,TRUE);
$this->email->message($body);  
$this->email->attach('https://autovista.in/call-center/car_quotation.csv');
$this->email->send();
$csv_handler = fopen ('car_quotation.csv','w');

file_put_contents("car_quotation.csv", "");
   fclose ($csv_handler);

	// Authorisation details.
	/*$username = "satyam@autovista.in";
	$hash = "58b0ce15875a87f64b38c56b54dd9277a6c4d7e4";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "AVTECH"; // This is who the message appears to be from.
	$numbers = $phone; // A single number or a comma-seperated list of numbers
	$message = "Thank You For Showing Interest in Autovista .";
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);*/

			
  }
public function insert_buy_car_data()
{
	$this->add_followup_model->insert_additional_info();
	$enq_id=$this->input->post('enq_id');
	$select_data = $this -> add_followup_model -> select_additional_info($enq_id);
	?>
	 <div class="panel panel-primary">
 							<div class="panel-body">
 								<?php
	foreach($select_data as $fetch){?>
		
<div class='col-md-6'>
	<div class="form-group">
	 	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Make Name:</label>
	 	<div class="col-md-8 col-sm-8 col-xs-12">
	 		<?php echo $fetch->make_name;?>
	 	</div>
</div>
</div>
<div class='col-md-6'>
	<div class="form-group">
	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Model Name:</label>
		<div class="col-md-8 col-sm-8 col-xs-12">
	 		<?php echo $fetch->model_name;?>
	 	</div>
	 </div>
</div>
<?php 
}	?>
</div>
</div>
<?php
}
public function insert_additional_info()
{
	$enq_id=$this->input->post('enq_id');
	$query = $this -> add_followup_model -> select_lead($enq_id);
		$lead_detail = $query;
		$makes= $this -> add_followup_model -> makes();
	$this->add_followup_model->insert_additional_info();
	$select_data = $this -> add_followup_model -> select_additional_info($enq_id);
	?>
	<h3 class="text-center">Old Car Details</h3>
     			 <div class="panel-body">
                  <div class="col-md-12">
	                	<div class="col-md-6">   
                        	<div class="form-group">
                             <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name"> Car Make: </label>
                             	<div class="col-md-8 col-sm-8 col-xs-12">
                                	<select name="old_make" id="make" class="form-control" required  onchange="select_model();">
                                    
										<option value="">Please Select  </option>
										<?php  foreach($makes as $row){ ?>
										<option value="<?php echo $row -> make_id; ?>"><?php echo $row -> make_name; ?></option>
                     					<?php } ?>
                  						</select>
                                 </div>
                             </div>
                            
                            <div class="form-group">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name"> Colour:</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                   <input type="text"  placeholder="Enter Colour" id="color" name='color' onkeypress="return alpha(event)" autocomplete="off"  class=" form-control" required />
                                </div>
                            </div>
                              <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Ownership: </label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                           <select name="ownership" id="ownership" class="form-control"  >
                            
							<option value="">Please Select  </option>
						
                     		<option value="First">First</option>
                       		<option value="Second">Second</option>
                       		<option value="Third">Third</option>
                        	<option value="More Than Three">More Than Three</option>
                       	</select>
                     	</div>
                     </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Any Assidental Claim: </label>
                         <div class="col-md-8 col-sm-8 col-xs-12">
                            <select name="claim" id="claim" class="form-control"  >
                         
							 <option value="">Please Select  </option>
								
							 <option value="Yes">Yes</option>
                     		<option value="No">No</option>
                     	 	</select>
                          </div>
                        </div>
					</div>
                    <div class="col-md-6">
                     <div class="form-group"  id="model_div">
                               <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name"> Car Model:</label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <select name="old_model" id="model" class="form-control" required >
                                    
									<option value="">Please Select  </option>
								
								<?php  foreach($make_model as $row){ ?>
										<option value="<?php echo $row -> model_id; ?>"><?php echo $row -> model_name; ?></option>
                     					<?php } ?>
                      			 </select>
                               </div>
                          	</div>
                     <div class="form-group">
                      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Manufacturing Year: </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                           <select name="mfg" id="mfg" class="form-control"  >
                            
							<option value="">Please Select  </option>
								<?php 
									$year=date('Y');
									for ($i=$year;$i>1980;$i--){ ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?> </option>
								<?php } ?>
							</select>
                           </div>
                        </div>
                        <div class="form-group">
                         <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">KMS: </label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                              <input type="text"  placeholder="Enter Km" id="km" name='km' onkeypress="return isNumberKey(event)" onkeyup="return limitlength(this, 10)" autocomplete="off" class="form-control"   />
                           </div>
                        </div>
                       
                        <div class="form-group" id='additional_btn'>
                        	<div class="col-md-4 pull-right">
                          <a onclick="insert_additional_info()" class=" col-md-12 col-xs-12 col-sm-12"><u>Add Next Car</u></a>
                         </div>
                         
                        </div>
                      </div>
                   </div>
                   	 	<div class="col-md-12">
                <div class="panel panel-primary">
                	<div class="panel-body">
 							
 								<?php
	foreach($select_data as $fetch){?>
		
<div class='col-md-6'>
	<div class="form-group">
	 	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Make Name:</label>
	 	<div class="col-md-8 col-sm-8 col-xs-12">
	 		<?php echo $fetch->make_name;?>
	 	</div>
</div>
</div>
<div class='col-md-6'>
	<div class="form-group">
	<label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Model Name:</label>
		<div class="col-md-8 col-sm-8 col-xs-12">
	 		<?php echo $fetch->model_name;?>
	 	</div>
	 </div>
</div>

<?php 
}	?>
 </div>
</div>

                </div>
                </div>
                <?php
}
}
?>
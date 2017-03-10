<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_xls extends CI_Controller {

		function __construct() {
		parent::__construct();
		$this -> load -> library(array('table', 'form_validation','session'));
		$this -> load -> helper(array('form', 'url'));
	   $this->load->model('upload_xls_model');
	   	date_default_timezone_set('Asia/Kolkata');
		
	}
		public function session() {
		if ($this -> session -> userdata('username') == "") {
			redirect('login/logout');
		}
	}
	
	public function index() 
	{
			
		$query1=$this->upload_xls_model->select_grp();
		$data['select_grp']=$query1;	
			
	//	print_r($query1);
	
		/*$query2=$this->upload_xls_model->select_campaign();
		$data['select_campaign']=$query2;*/
		//print_r($query2);
				
		$data['var']=site_url('upload_xls/upload');
		$this->load->view('include/admin_header.php');
		$this -> load -> view('upload_xls_view.php',$data);
		$this->load->view('include/footer.php');
	
	}
	
	
	public function upload()
	{
		$group_id=$this->input->post('group_name');
if($this->input->post('campaign_name')=='')
{
	if($this->input->post('lead_source')!='Carwale')
	{
	$query=$this->db->query("select group_name from tbl_group where group_id=".$group_id)->result();
	foreach ($query as $row) {
		$campaign_name=$row->group_name;
	}
	}
	else{
		$campaign_name=$this->input->post('group_name');
	}
}
else {
	$campaign_name=$this->input->post('campaign_name');
}



$date=date('Y-m-d:H:i:A');


   if($_FILES["file"]["error"] > 0) 
			{
				echo "Error: " . $_FILES["file"]["error"] . "<br>";
			} 
			else 
			{
				echo "Upload: " . $_FILES["file"]["name"] . "<br>";
				"Type: " . $_FILES["file"]["type"] . "<br>";
				"Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				"Stored in: " . $_FILES["file"]["tmp_name"];"<br>";
			}
			
			
			move_uploaded_file($_FILES["file"]["tmp_name"],'upload/'.$date.'_'.$_FILES["file"]["name"]);
	
			$file='upload/'.$date.'_'.$_FILES["file"]["name"];
			echo $file;
			require_once 'Excel/reader.php';
			
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('CP1251');
			$data->read($file);
			
			for ($x = 2; $x <= count($data->sheets[0]["cells"]); $x++) 
			{
				/*$first = $data->sheets[0]["cells"][$x][1];
				$last =$data->sheets[0]["cells"][$x][2];
				$this->addvlist_model->insert($villgeid,$first,$last);*/
				echo     "<br>";
		echo 	$name=$data->sheets[0]["cells"][$x][1];
		echo     "<br>";
		echo 	$email_id=$data->sheets[0]["cells"][$x][2];
		echo     "<br>";
		echo 	$contact=$data->sheets[0]["cells"][$x][3];
		echo     "<br>";
			$new=$data->sheets[0]["cells"][$x][4];
		
	
	if ($new=='New')
	{
		
			$query=$this->upload_xls_model->upload1($name,$email_id,$contact,$campaign_name);
	
	}
			
	else
		{
				
			
			/*echo $location=$data->sheets[0]["cells"][$x][4];
			echo     "<br>";
			 $lead_date1=$data->sheets[0]["cells"][$x][5];
			 //convert value in date format
			 $phpexcepDate = $lead_date1-25569; //to offset to Unix epoch
     		$date=strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
	 		echo $lead_date = date('Y-m-d', $date);
			echo     "<br>";
			echo $assign_to_telecaller=$data->sheets[0]["cells"][$x][6];
			echo     "<br>";
			echo $status=$data->sheets[0]["cells"][$x][7];
			echo     "<br>";
			echo $disposition=$data->sheets[0]["cells"][$x][8];
			echo     "<br>";
			echo $new_model=$data->sheets[0]["cells"][$x][9];
			echo     "<br>";
			echo $new_variant=$data->sheets[0]["cells"][$x][10];
			echo     "<br>";
			echo $buyer_type=$data->sheets[0]["cells"][$x][11];
			echo     "<br>";
			echo $old_make=$data->sheets[0]["cells"][$x][12];
			echo     "<br>";
			echo $old_model=$data->sheets[0]["cells"][$x][13];
			echo     "<br>";
			echo $mfg_yr=$data->sheets[0]["cells"][$x][14];
			echo     "<br>";
			echo $kms=$data->sheets[0]["cells"][$x][15];
			echo     "<br>";
			echo $color=$data->sheets[0]["cells"][$x][16];
			echo     "<br>";
			echo $ownership=$data->sheets[0]["cells"][$x][17];
			echo     "<br>";
			echo $egerness=$data->sheets[0]["cells"][$x][18];
			echo     "<br>";
			 $created_date_followup1=$data->sheets[0]["cells"][$x][19];
			$phpexcepDate = $created_date_followup1-25569; //to offset to Unix epoch
     		$date=strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
	 		echo $created_date_followup = date('Y-m-d', $date);
			echo     "<br>";
			 $nfd1=$data->sheets[0]["cells"][$x][20];
			$phpexcepDate = $nfd1-25569; //to offset to Unix epoch
     		$date=strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
	 		echo $nfd = date('Y-m-d', $date);
			echo     "<br>";
			echo $remark=$data->sheets[0]["cells"][$x][21];
			
		$query=$this->upload_xls_model->upload2($name,$email_id,$contact,$location,$lead_date,$assign_to_telecaller,$status,$disposition,$new_model,$new_variant,$buyer_type,$old_make,$old_model,$mfg_yr,$kms,$color,$ownership,$egerness,$created_date_followup,$nfd,$remark,$group_id,$campaign_name);
		*/
	echo $location=$data->sheets[0]["cells"][$x][4];
			echo     "<br>";
			 $lead_date1=$data->sheets[0]["cells"][$x][5];
			 //convert value in date format
			 $phpexcepDate = $lead_date1-25569; //to offset to Unix epoch
     		$date=strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
	 		echo $lead_date = date('Y-m-d', $date);
			echo     "<br>";
			echo $assign_to_telecaller=$data->sheets[0]["cells"][$x][6];
			echo     "<br>";
			echo $status=$data->sheets[0]["cells"][$x][7];
			echo     "<br>";
			echo $disposition=$data->sheets[0]["cells"][$x][8];
			echo     "<br>";
			echo $new_model=$data->sheets[0]["cells"][$x][9];
			echo     "<br>";
			echo $new_variant=$data->sheets[0]["cells"][$x][10];
			echo     "<br>";
			echo $buyer_type=$data->sheets[0]["cells"][$x][11];
			echo $egerness=$data->sheets[0]["cells"][$x][12];
			echo     "<br>";
			 $created_date_followup1=$data->sheets[0]["cells"][$x][13];
			$phpexcepDate = $created_date_followup1-25569; //to offset to Unix epoch
     		$date=strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
	 		echo $created_date_followup = date('Y-m-d', $date);
			echo     "<br>";
			 $nfd1=$data->sheets[0]["cells"][$x][14];
			$phpexcepDate = $nfd1-25569; //to offset to Unix epoch
     		$date=strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
	 		echo $nfd = date('Y-m-d', $date);
			echo     "<br>";
			echo $budget_to = $data->sheets[0]["cells"][$x][15];
			echo $budget_from = $data->sheets[0]["cells"][$x][16];
			echo $visit_booked = $data->sheets[0]["cells"][$x][17];
			echo $visit_location = $data->sheets[0]["cells"][$x][18];
			echo $visit_booked_in=$data->sheets[0]["cells"][$x][19];
			 $visit_booked_date= $data->sheets[0]["cells"][$x][20];
				 //convert value in date format
			 $phpexcepDate = $visit_booked_date-25569; //to offset to Unix epoch
     		$date=strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
	 		echo $visit_booked_date = date('Y-m-d', $date);
			echo $customer_sales_status= $data->sheets[0]["cells"][$x][21];
			echo $car_delivered= $data->sheets[0]["cells"][$x][22];
			echo $remark=$data->sheets[0]["cells"][$x][23];
			
		$query=$this->upload_xls_model->upload2($name,$email_id,$contact,$location,$lead_date,$assign_to_telecaller,$status,$disposition,$new_model,$new_variant,$buyer_type,$egerness,$created_date_followup,$nfd,$budget_to,$budget_from,$visit_booked,$visit_location,$visit_booked_in,$visit_booked_date,$customer_sales_status,$car_delivered,$remark,$group_id,$campaign_name);
		
		
		
}
		
	if(!$query)
		{
			 $this -> session -> set_flashdata('msg', '<div class="alert alert-success text-center">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> File Upload successfully ...!</strong>');

		}else{
			$this -> session -> set_flashdata('msg', '<div class="alert alert-danger text-center">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> File Can not Upload successfully ...!</strong>');
			
		}
			
			
			}
			
			
	//	redirect('upload_xls');
		
		
		
	}
	
	public function select_campaign()
	
	{
			$group_id=$this->input->post('group_id');
			//echo $group_id;
			
				$query3=$this->upload_xls_model->refresh_campaign($group_id);
					
			?>
			
					
				<select class="filter_s col-md-12 col-xs-12 form-control" id="campaign_name" name="campaign_name" >
                                              	 <option value=""> Please Select </option>
											
                                              	<?php
                                              	
                                              	foreach($query3 as $fetch)
												{
													
												
                                              	?>
												
											
													 <option value="<?php echo $fetch -> campaign_name; ?>"><?php echo $fetch -> campaign_name; ?></option>
                                             
                                             <?php
											}
										?>
                                      </select>
			
	<?php
				}

				}
			?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="" />
		<meta name="author" content="" />	
		<title>LMS | Dashboard </title>
	
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" id="style-resource-4">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-core.css" id="style-resource-5">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-theme.css" id="style-resource-6">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-forms.css" id="style-resource-7">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/datatable.css">
	
		</head>
	<body class="page-body">
			
			<script  src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
		<script  src="<?php echo base_url(); ?>assets/js/bootstrap.js" id="script-resource-3"></script>
		<div class="page-container">
		
			<div class="sidebar-menu">
				<div class="sidebar-menu-inner">
					<header class="logo-env">
						<!-- logo -->
						<div class="logo">
							<a href="http://autovista.in/"> <h1 style="color:white;margin-top:0px"><i class="" style="font-size: 26px;"></i>autovista.in</h1> </a>
						</div>
						<!-- logo collapse icon -->
						<div class="sidebar-collapse hidden-xs">
							<a href="#" class="sidebar-collapse-icon">
								<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --> <i class="entypo-menu"></i> </a>
						</div>
						<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
						<div class="sidebar-mobile-menu visible-xs">
							<a href="#" class="with-animation"><!-- add class "with-animation" to support animation --> <i class="entypo-menu"></i> </a>
						</div>
					</header>
				
					<ul id="main-menu" class="main-menu">
						<li class="active">
							<a href="<?php echo site_url(); ?>dashboard/telecaller"><i class="entypo-gauge"></i><span class="title">Dashboard</span></a>
						</li>
						<li>
							<a href=""><i class="entypo-plus-squared"></i><span class="title">Script</span></a>
						</li>
						<li>
							<a href="<?php echo site_url(); ?>add_new_customer"><i class="entypo-plus-squared"></i><span class="title">Add New Lead</span></a>
						</li>
						
						<li class="has-sub">
							<a href="#"><i class="entypo-users"></i><span class="title"> Leads</span></a>
							<ul>
									<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/All"><span class="title">All</span></a></li>
						<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/All"><span class="title">Web</span></a></li>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/All"><span class="title">Carwale</span></a></li>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/All"><span class="title">Cardekho</span></a></li>
								
						
						<?php
						$group_id=$_SESSION['group_id'];
					$CI = &get_instance();

$this->db2 = $CI->load->database('db2', TRUE);
$q=$this->db->query("select campaign_name from tbl_campaign  where group_id='$group_id'")->result();
							foreach($q as $row)
							{
								
								?>
								<li>
							<a href="<?php echo site_url(); ?>website_leads/team_leader_lead/<?php echo $row -> campaign_name; ?>"><span class="title"><?php echo $row -> campaign_name; ?></span></a>
						
						
						</li>
								<?php
								}
						
						/*if($_SESSION['department']=='New Car')
						{
							?>
							<li >
								<a href="<?php echo site_url();?>website_leads/telecaller_leads/New Car" ><span class="title">New Car</span></a>
							</li>
							<li >
							<a href="<?php echo site_url();?>website_leads/telecaller_leads/Campaign" ><span class="title">Campaign</span></a>
							</li>
	
							<li >
								<a href="<?php echo site_url();?>website_leads/telecaller_leads/Discount" ><span class="title">Discount</span></a>
							</li>
							<li >
							<a href="<?php echo site_url();?>website_leads/telecaller_leads/Online Book" ><span class="title">Online Book</span></a>
						</li>
							<?php
						}
						elseif($_SESSION['department']=='Used Car')
							{
								?>
								<li >
							<a href="<?php echo site_url();?>website_leads/telecaller_leads/Used Car" ><span class="title">Used Car</span></a>
						</li>
								<?php
							}
							elseif($_SESSION['department']=='Insurance')
							{
								?>
								<li >
							<a href="<?php echo site_url();?>website_leads/telecaller_leads/Insurance"><span class="title">Insurance</span></a>
						</li>
								<?php
							}
							elseif($_SESSION['department']=='Finance')
							{
								?>
								<li >
							<a href="<?php echo site_url();?>website_leads/telecaller_leads/Finance" ><span class="title">Loan</span></a>
						</li>
								<?php
							}
							elseif($_SESSION['department']=='Driving School')
							{
								?>
								<li >
							<a href="<?php echo site_url();?>website_leads/telecaller_leads/Driving School" ><span class="title">Driving School</span></a>
						</li>
								<?php
							}*/
						?>
							</ul>
							
								</li>
								<!--<li>
							<a href="<?php echo site_url();?>excel_leads/telecaller_leads"><i class="entypo-users"></i><span class="title">Excel Leads</span></a>
						</li>
										<li class="has-sub">
							<a href="#"><i class="entypo-facebook-squared"></i><span class="title">Facebook Campaign Leads</span></a>
							<ul>
								<li>
							<a href="<?php echo site_url();?>facebook_leads/telecaller_lead/All"><span class="title">All</span></a>
						</li>
							
				<?php
							$q=$this->db->query('select distinct(enquiry_for) from lead_master where lead_source="Facebook"')->result();
							foreach($q as $row)
							{
								?>
								<li>
							<a href="<?php echo site_url();?>facebook_leads/telecaller_lead/<?php echo $row->enquiry_for;?>"><span class="title"><?php echo $row->enquiry_for;?></span></a>
						</li>
								<?php
							}
							?>
</ul>
</li>-->
<li>
							<a href="<?php echo site_url();?>telecaller_lead"><i class="entypo-list-add"></i><span class="title">You Added Leads</span></a>
						</li>
							<li>
							<a href="<?php echo site_url();?>request_lead_transfer"><i class="entypo-switch"></i><span class="title">Transferred Leads </span></a>
						</li>
					
						

						<li>
							<a href="<?php echo site_url();?>tracker/telecaller_leads"><i class="entypo-doc-text-inv"></i><span class="title">Tracker</span></a>
						</li>
						
						</ul>
				</div>
			</div>
			<div class="main-content">
				<div class="row">
					<!-- Profile Info and Notifications -->
					<div class="col-md-6 col-sm-8 clearfix">
						<ul class="user-info pull-left pull-none-xsm">
							<ul class="user-info pull-left pull-right-xs pull-none-xsm">
								<li><h1 style="text-align:center;font-weight:bold;font-size:30px;color:#ee4749">Lead Management System</h1></li>
							
							</ul>
							
					</div>
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">
						<ul class="list-inline links-list pull-right">
						
									<li class="dropdown language-selector">
								<!--</a>-->
							
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true"> 
									
									
							
							<strong >Notifications<i class="entypo-down-dir"></i></strong>  </a>
								<ul class="dropdown-menu pull-right">
										<li>
											<a href="<?php echo site_url();?>new_lead">New Leads<span class="badge"></span></a>
                                   
							
							
							</li>
							<li>	
			<a href="<?php echo site_url('pending/telecaller_leads')?>" >Pending Leads-Attended</a>
							
							</li>
							<li>	
			<a href="<?php echo site_url('pending/telecaller_leads_not_attended')?>" >Pending Leads-Not Attended </a>
							
							</li>

									<li>
									     
						
											<a href="<?php echo site_url('today_followup')?>">Today's Follow Up <span class="badge"></span></a>
                                   
							
							
							</li>
								</ul>
							</li>
						
						
						<li>
						<span >Department : <strong ><?php echo $_SESSION['process_name']?> </strong> &nbsp; &nbsp; </span>
						</li>
							<span >  Welcome </span>
						
							<li class="dropdown language-selector">
								<!--</a>-->
							
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true"> 
									
									
							
							<strong  style='font-size:15px;color:#21a9e1'><?php echo $_SESSION['username']; ?><i class="entypo-down-dir"></i></strong>  </a>
								<ul class="dropdown-menu pull-right">
									<li>
								<a href="<?php echo site_url('login/logout')?>">  <i class="entypo-logout right"></i>Log Out </a>
							</li>
									<li>
								<a href="<?php echo site_url();?>change_password">  <i class="entypo-key"></i> Change Password</a>
							</li>
									
							
									
								</ul>
							</li>
							<li class="sep"></li>
							<li>
								
							</li>
							
						</ul>
					</div>
				</div>
			

<!-- Footer -->
<footer class="main" style="margin-top:0px">
	&copy; 2016 <strong>All Right Reserved | Autovista</strong>
	<div id="chat" class="fixed" data-current-user="Art Ramadani" data-order-by-status="1" data-max-chat-history="25">
		<div class="chat-inner">
			<h2 class="chat-header"><a href="#" class="chat-close"><i class="entypo-cancel"></i></a><i class="entypo-users"></i>
</footer>





<script src="<?php echo base_url();?>assets/js/gsap/TweenMax.min.js"></script>

<script src="<?php echo base_url();?>assets/js/resizeable.js"></script>
<script src="<?php echo base_url();?>assets/js/neon-api.js"></script>

<script src="<?php echo base_url();?>assets/js/neon-custom.js"></script>
  <script src="<?php echo base_url();?>assets/js/datatable.js"></script>
  
  

<script src="<?php echo base_url();?>assets/js/select2/select2.min.js" id="script-resource-9"></script>

<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.min2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datepicker/daterangepicker.js"></script>












    <!-- Bootstrap Core JavaScript -->


      
</body> </html>
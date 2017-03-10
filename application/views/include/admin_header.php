<!DOCTYPE html>
<html lang="en">
		
	<head >
		<div id="tracker_list" class="page-container">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="" />
		<meta name="author" content="" />	
		
		<title>LMS </title>
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
				
				<?php

					$form_name = $_SESSION['form_name'];
					$controller_name = $_SESSION['controller_name'];
					$view = $_SESSION['view']; ?>
					<ul id="main-menu" class="main-menu">
						<li class="active">
							<?php
							if ($_SESSION['role'] == '1' || $_SESSION['role'] == '2') {
								?>
				<a href="<?php echo site_url(); ?>dashboard/admin"><i class="entypo-gauge"></i><span class="title">Dashboard</span></a>
						<?php
						} else {
				?>
				<a href="<?php echo site_url(); ?>dashboard/telecaller"><i class="entypo-gauge"></i><span class="title">Dashboard</span></a>
						
						<?php
						}
					?>		</li>
					
					<?php if($view[4]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>assign_leads"><i class="entypo-share"></i><span class="title">Assign Leads</span></a>
						</li>
						<?php } ?>
						<?php if($view[1]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>add_new_customer"><i class="entypo-plus-squared"></i><span class="title">Add New Lead</span></a>
						</li>
						<?php } ?>
						<?php if($_SESSION['role'] !=1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>CSE_Scripts"><i class="entypo-doc-text-inv"></i><span class="title">Script</span></a>
						</li>
						<?php } ?>
						<li class="has-sub">
							<a href="#"><i class="entypo-users"></i><span class="title">Leads</span></a>
							<ul>
						<?php
						if($_SESSION['role']==1)
						{
							?>
							
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/All"><span class="title">All</span></a></li>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/Website"><span class="title">Web</span></a></li>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/Carwale"><span class="title">Carwale</span></a></li>
								<li><a href="#"><span class="title">Cardekho</span></a></li>
								
							<?php
							$query1=$this->db->query('select g.group_id,g.group_name
								from  tbl_group  g
								join tbl_campaign c on c.group_id=g.group_id group by c.group_id')->result();
						
							foreach($query1 as $row1)
							{
							?>
								<li class="has-sub">
								<a href="#"><span class="title"></span><?php echo $row1->group_name;?></a>
									<ul>
									<?php	
								$query=$this->db->query("select *
								from  tbl_campaign 
							 where group_id='$row1->group_id'
							")->result();
							foreach($query as $row)
							{?>
								
									
								
										
								<li>
									<a href="<?php echo site_url(); ?>website_leads/telecaller_leads/<?php echo $row->campaign_name; ?>"><span class="title"><?php echo $row->campaign_name; ?></span></a>
								</li>
								<?php } ?>
								</ul>
								</li>
								<?php
							}
						
								}
								else { 

								/*if($_SESSION['role']==2)
								{*/
								?>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/All"><span class="title">All</span></a></li>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/Website"><span class="title">Web</span></a></li>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/Carwale"><span class="title">Carwale</span></a></li>
								<li><a href="#"><span class="title">Cardekho</span></a></li>
								
								<?php /*
								}
								else {
								?>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/All"><span class="title">All</span></a></li>
						<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/Website"><span class="title">Web</span></a></li>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/All"><span class="title">Carwale</span></a></li>
								<li><a href="<?php echo site_url(); ?>website_leads/telecaller_leads/All"><span class="title">Cardekho</span></a></li>
								<?php
								}
							*/
								$query1=$this->db->query('select g.group_id,t.group_name
								from tbl_user_group g
							
							 join tbl_group t on t.group_id=g.group_id
							 
							 
							 where g.user_id="'.$_SESSION['user_id'].'"
							 ')->result();
						
							foreach($query1 as $row1)
							{
							?>
								<li class="has-sub">
								<a href="#"><span class="title"></span><?php echo $row1->group_name;?></a>
									<ul>
									<?php	
								$query=$this->db->query("select *
								from  tbl_campaign 
							 where group_id='$row1->group_id'
							")->result();
							foreach($query as $row)
							{?>
								
									
								
										
								<li>
									<a href="<?php echo site_url(); ?>website_leads/telecaller_leads/<?php echo $row->campaign_name; ?>"><span class="title"><?php echo $row->campaign_name; ?></span></a>
								</li>
								<?php } ?>
								</ul>
								</li>
								<?php
							}
							?>
							
								
							<?php

							}
					  ?>
					</ul>
							
								</li>
						<?php if($view[0]==1)
						{?>
							
						<li>
							<a href="<?php echo site_url(); ?>add_location"><i class="entypo-plus-squared"></i><span class="title">Add Location</span></a>
						</li>
						<?php } ?>
						
						<?php if($view[2]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>add_lms_user"><i class="entypo-user-add"></i><span class="title">Add User</span></a>
						</li>
						<?php } ?>
						<?php if($view[3]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>add_group"><i class="entypo-plus-squared"></i><span class="title">Add Group</span></a>
						</li>
						<?php } ?>
						
						<?php if($view[5]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>add_campaign"><i class="entypo-plus-squared"></i><span class="title">Add Campaign</span></a>
						</li>
						<?php } ?>
						<?php if($view[6]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>add_status"><i class="entypo-plus-squared"></i><span class="title">Add Status</span></a>
						</li>
						<?php } ?>
						<?php if($view[7]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>add_disposition"><i class="entypo-plus-squared"></i><span class="title">Add Disposition</span></a>
						</li>
						<?php } ?>
						
						<?php if($view[8]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>add_right"><i class="entypo-plus-squared"></i><span class="title">Add Rights</span></a>
						</li>
						<?php } ?>
						<?php if($view[11]==1)
						{?>
								<li class="has-sub">
							<a href="#"><i class="entypo-upload"></i><span class="title">Upload</span></a>
							<ul>
								
										
						<li>
							<a href="<?php echo site_url(); ?>upload_xls"><span class="title">Lead</span></a>
						</li>
						
								<li>
							<a href="<?php echo site_url(); ?>upload_xls1"><span class="title">Stock </span></a>
						</li>
							</ul>
							
					</li>
					
					
						
							
					
						<?php } ?>
						<li class="has-sub">
							<a href="#"><i class="entypo-search"> </i><span class="title">Stock</span></a>
							<ul>
								
										
						<li>
							<a href="<?php echo site_url(); ?>New_car_stock"><span class="title">New Car </span></a>
						</li>
						
								<li>
							<a href="<?php echo site_url(); ?>Old_car_stock"><span class="title">POC</span></a>
						</li>
							</ul>
							
					</li>
						<!--<?php if($view[8]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>request_lead_transfer"><i class="entypo-share"></i><span class="title">Transfer lead</span></a>
						</li>
						<?php } ?>-->
						<!--<?php if($view[9]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>dashboard/telecaller"><i class="entypo-share"></i><span class="title">CSE dashboard</span></a>
						</li>
						<?php } ?>-->
						<!--<?php if($view[10]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>dashboard/admin"><i class="entypo-share"></i><span class="title">Team Leader dashboard</span></a>
						</li>
						<?php } ?>-->
						
						<!--<?php if($view[12]==1)
						{?>
						<li>
							<a href="<?php echo site_url(); ?>tracker/telecaller_leads"><i class="entypo-share"></i><span class="title">CSE Tracker</span></a>
						</li>
						<?php } ?>-->
						<?php if($view[1]==1)
						{?>
							<?php
							if ($_SESSION['role'] == '1' || $_SESSION['role'] == '2') {
							?><li>
				<a href="<?php echo site_url(); ?>CSE_added_leads" ><i class="entypo-doc-text-inv"></i><span class="title">CSE Added Leads</span></a>
									</li>
						<?php
						} 
					 } ?>
						
						
						<?php if($view[14]==1)
						{?>
							<?php
							if ($_SESSION['role'] == '1' || $_SESSION['role'] == '2') {
							?><li>
				<a href="<?php echo site_url(); ?>transfer_report" ><i class="entypo-doc-text-inv"></i><span class="title">Transfer Lead Tracker</span></a>
									</li>
						<?php
						} else {
				?><li>
				<a href="<?php echo site_url(); ?>transfer_report"><i class="entypo-switch"></i><span class="title">Transferred Lead to DSE </span></a>
								</li>	
						<?php
						}
					?>	
						
						<?php } ?>
						<?php if($view[13]==1)
						{?>
								
				<li><a href="<?php echo site_url(); ?>tracker/team_leader_leads"><i class="entypo-doc-text-inv"></i><span class="title">Tracker</span></a></li>
			<li>	<a href="<?php echo site_url(); ?>tracker/leads"><i class="entypo-doc-text-inv"></i><span class="title">Tracker with Lead Date</span></a></li>
						
						
						
						<?php } ?>
						
						
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
						<?php if(isset($form_name[15]) && isset($view[15]))
						{
							if($form_name[15]=='Calling Notification' && $view[15]==1)
								{
								?>
							<li class="dropdown language-selector">
								
							
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true"> 
									
									
							
							<strong >Notifications<i class="entypo-down-dir"></i></strong>  </a>
								<ul class="dropdown-menu pull-right">
									<li>
									  <a href="<?php echo site_url(); ?>new_lead">New Leads<span class="badge"></span></a>
									</li>
									<li>
										<a href="<?php echo site_url('today_followup')?>">Today's Follow Up <span class="badge"></span></a>
                           			</li>
									<li>
										<a href="<?php echo site_url(); ?>transfer_lead">Transferred Lead to You<span class="badge"></span></a>
                                   	</li>
									<li>	
										<a href="<?php echo site_url('pending/telecaller_leads')?>" >Pending (Live) Leads</a>
									</li>
									<li>	
										<a href="<?php echo site_url('pending/telecaller_leads_not_attended')?>" >Pending (New) Leads</a>
									</li>
								</ul>
							</li>
						<?php } }?>
						<li>
						<span >Department : <strong ><?php echo $_SESSION['process_name']; ?></strong> &nbsp; &nbsp; </span>
						</li>
							<span >  Welcome </span>
						
							<li class="dropdown language-selector">
								<!--</a>-->
							
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true"> 
									
									
							
							<strong  style='font-size:15px;color:#21a9e1'><?php echo $_SESSION['username']; ?><i class="entypo-down-dir"></i></strong>  </a>
								<ul class="dropdown-menu pull-right">
									<li>
								<a href="<?php echo site_url(); ?>change_password">  <i class="entypo-key"></i> Change Password</a>
							</li>
									<li>
								<a href="<?php echo site_url('login/logout1')?>">  <i class="entypo-logout right"></i>Log Out </a>
							</li>
									
									
							
									
								</ul>
							</li>
							<li class="sep"></li>
							<li>
								
							</li>
							
						</ul>
					</div>
				</div>
				
				<hr />


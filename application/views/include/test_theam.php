<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/test.css" id="style-resource-1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" id="style-resource-4">
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap1.min.css">
	    	    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datatable.css">

  		<script  src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
		<script  src="<?php echo base_url(); ?>assets/js/bootstrap.js" id="script-resource-3"></script>
		
<div class="wrapper">
    <div class="row-offcanvas row-offcanvas-left">
        <!-- sidebar -->
        <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
        	
            <ul class="nav" id="menu">
            
            
             <!--   <li><a href="#" data-toggle="offcanvas"><h4><span class="collapse in hidden-xs">autovista.in</span><i class="glyphicon glyphicon-list-alt"></i></h4></a></li>
               -->
               <li><a href="#"><h4><span class="collapse in hidden-xs">autovista.in</span><i class="glyphicon glyphicon-list-alt"></i></h4></a></li>
                <li><a href="#"><i class="fa fa-list-alt"></i> <span class="collapse in hidden-xs">Link 1</span></a></li>
                <li><a href="#"><i class="fa fa-list"></i> <span class="collapse in hidden-xs">Stories</span></a></li>
                <li><a href="#"><i class="fa fa-paperclip"></i> <span class="collapse in hidden-xs">Saved</span></a></li>
                <li><a href="#"><i class="fa fa-refresh"></i> <span class="collapse in hidden-xs">Refresh</span></a></li>
                <li>
                    <a href="#" data-target="#item1" data-toggle="collapse"><i class="fa fa-list"></i> <span class="collapse in hidden-xs">Menu <span class="caret"></span></span></a>
                    <ul class="nav nav-stacked collapse left-submenu" id="item1">
                        <li><a href="google.com">View One</a></li>
                        <li><a href="gmail.com">View Two</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-target="#item2" data-toggle="collapse"><i class="fa fa-list"></i> <span class="collapse in hidden-xs">Menu <span class="caret"></span></span></a>
                    <ul class="nav nav-stacked collapse" id="item2">
                        <li><a href="<?php echo site_url();?>test">View One</a></li>
                        <li><a href="#">View Two</a></li>
                        <li><a href="#">View Three</a></li>
                    </ul>
                </li>
                <li><a href="#"> <span class="collapse in hidden-xs">Link</span><i class="glyphicon glyphicon-list-alt"></i></a></li>
            </ul>
        </div>
        <!-- /sidebar -->

        <!-- main right col -->
      
       
      
         <div class="column test-margin col-sm-10 col-xs-11 margin-top"  > 	
        
        	 <div class="row">
        <p class="pull-left " style="font-weight:bold;font-size:30px;color:#ee4749">Lead Management System</p>
        <div class="col-md-6 col-sm-4 pull-right hidden-xs margin-top">
						<ul class="list-inline links-list pull-right">
						
									<li class="dropdown language-selector">
								<!--</a>-->
							
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true"> 
									
									
							
							<strong >Notifications<span class="caret"></span></strong>  </a>
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
									
									
							
							<strong  style='font-size:15px;color:#21a9e1'><?php echo $_SESSION['username']; ?><span class="caret"></span></strong>  </a>
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
        
        <!-- /main -->
        
   
<script>
	/* off-canvas sidebar toggle */
$('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
    $('.collapse').toggleClass('in').toggleClass('hidden-xs').toggleClass('visible-xs');
});
</script>
 <script src="<?php echo base_url();?>assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->


        <script src="<?php base_url();?>assets/js/datatable.js"></script>

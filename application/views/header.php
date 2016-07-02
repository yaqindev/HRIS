<?php 
    if (!isset($_SESSION['id_user']))
    {
        $this->session->sess_destroy();
        redirect('login');
    }
?>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/icon.png" />
	<link href="<?php echo base_url()."assets/";?>css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url()."assets/";?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/";?>css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/";?>js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/";?>lineicons/style.css">    
	<script src="<?php echo base_url()."assets/";?>js/modal.js"></script>
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()."assets/";?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()."assets/";?>css/style-responsive.css" rel="stylesheet">
    <script src="<?php echo base_url()."assets/";?>js/chart-master/Chart.js"></script>
	
   <header class="header black-bg">
            <!--logo start-->
            <ul class="nav pull-left top-menu" style="color:white">
                    <div class="logo">
                    <li><img src="<?php echo base_url();?>/assets/img/logo_eta.jpg" width="208px" height="70px" style="margin:0px -10px -10px -19px"></li>
            </ul>
			<div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation" style="margin:0px -10px -10px 29px"></div>
            </div>
            <!--logo end-->
            	<ul class="nav pull-right top-menu">
					<div class="logout" style="margin:10px 20px 0px -10px; color:white">
					<?php 
                    $user = $this->session->userdata('nama_user');
					if(isset($user)) 
                    {
                        echo $user;
                    }
                    else 
                    {
						echo "nama user";
						// redirect('login');
					}?>
					<li><a class="btn btn-warning btn-md" href="<?php echo base_url()?>login/logout" style="color:black">Logout</a></li> </ul>
            </div>
        </header>
</head>

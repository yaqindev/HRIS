<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()."assets/";?>/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url()."assets/";?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()."assets/";?>/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()."assets/";?>/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" method="POST" action="<?= base_url() ?>login/auth_login">
                <h2 class="form-login-heading">Sign In Now</h2>
                <?php $notif = $this->session->flashdata('notif'); ?>
                <?php if ($notif): ?>
                <br>
                <div class="row">
                  <div class="alert alert-danger">Username dan Password salah !</div>
                </div>
                <?php endif ?>
                <div class="login-wrap">
                    <input type="email" class="form-control" autocomplete="off" name="username" required placeholder="E-mail" required autofocus>
                    <br>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                   <hr>
                    <button  class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</a>
                </div>
              </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url()."assets/";?>/js/jquery.js"></script>
    <script src="<?php echo base_url()."assets/";?>/js/bootstrap.min.js"></script>

  </body>
</html>

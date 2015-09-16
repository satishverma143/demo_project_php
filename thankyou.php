<!DOCTYPE html>
<?php
require_once './dbconfig/config.php';

$errorMessage = '&nbsp;';
$url="http://localhost:8080/demo_project/register.php";
if (!isset($_SERVER['HTTP_REFERER'])){//$_SERVER['HTTP_REFERER'] != $url)
    header('Location: login.php');
    exit();
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thank You | <?php echo $site_title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="assets/theme/images/icon.png">
    <!-- nanoScroller -->
    <link rel="stylesheet" type="text/css" href="assets/nanoScroller/nanoscroller.css" />
    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css" />
    <!-- Material Design Icons -->
    <link rel="stylesheet" type="text/css" href="assets/material-design-icons/css/material-design-icons.min.css" />
    <!-- IonIcons -->
    <link rel="stylesheet" type="text/css" href="assets/ionicons/css/ionicons.min.css" />
    <!-- WeatherIcons -->
    <link rel="stylesheet" type="text/css" href="assets/weatherIcons/css/weather-icons.min.css" />
    <!-- Animate.css -->
  	<link rel="stylesheet" type="text/css" href="assets/animate/animate.css" /
    <!-- Main -->
    <link rel="stylesheet" type="text/css" href="assets/theme/css/theme.min.css"  />
    <link rel="stylesheet" type="text/css" href="css/custom.min.css">
    <!--[if lt IE 9]>
      <script src="assets/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body class="bg-light-gray">
 <section class="container contain">
	<div class="row">
    <!-- <div class="alert alert-dismissible lighten-4 text-darken-2">
        <strong>Warning!</strong> Better check yourself, you're not looking too good.
        <button class="close">&times;</button>
    </div>  -->
		<!-- <div class="alert green lighten-4 green-text text-darken-2 alert-border-bottom wow bounceInLeft">
      		<strong>Warning!</strong> Better check yourself, you're not looking too good.
    	</div> -->
		<div id="page-message">
	      <h2>Thank you!</h2>
	      <h3>Account Registration successful</h3>
	      <p>Please wait till administrator validate your account, then you can login to you account.</p>
		  <p>If you are already register, or active user then please <a href="login.php">Login</a> </p>
	    </div>      	
    </div>	
    <div class="row">
      <div class="align-center wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
          <img src="assets/theme/images/logo.png" alt="Con Admin" class="photo wow pulse animated" data-wow-iteration="infinite" style="visibility: visible; animation-iteration-count: infinite; animation-name: pulse;">
        </div>
    </div>
 </section>


    <!-- DEMO [REMOVE IT ON PRODUCTION] -->
    <script type="text/javascript" src="assets/theme/js/_demo.js"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
    <!-- jQuery RAF (improved animation performance) -->
    <script type="text/javascript" src="assets/jqueryRAF/jquery.requestAnimationFrame.min.js"></script>
    <!-- nanoScroller -->
    <script type="text/javascript" src="assets/nanoScroller/jquery.nanoscroller.min.js"></script>
    <!-- Materialize -->
    <script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
    <!-- Parsley (validation) -->
    <script type="text/javascript" src="assets/parsley/parsley.min.js"></script>
    <!-- Sortable -->
    <script type="text/javascript" src="assets/sortable/Sortable.min.js"></script>
    <!-- WOW.js -->
  	<script type="text/javascript" src="assets/wow/wow.min.js"></script>
    <!-- Main -->
    <script type="text/javascript" src="assets/theme/js/theme.min.js"></script>
</body>
</html>

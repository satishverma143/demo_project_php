<!DOCTYPE html>
<?php
require_once './dbconfig/config.php';
require_once './library/functions.php';

$errorMessage = '&nbsp;';

if (isset($_POST['accno']) && isset($_POST['pass'])) {
    $result = doLogin();
    
    if ($result != '') {
        $errorMessage = $result;
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | <?php echo $site_title; ?></title>
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
    <!-- Main -->
    <link rel="stylesheet" type="text/css" href="assets/theme/css/theme.min.css"  />
    <!--[if lt IE 9]>
      <script src="assets/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>
    <section id="sign-in">
        <!-- Background Bubbles -->
        <!--<canvas id="bubble-canvas"></canvas>-->
        <!-- /Background Bubbles -->
        <!-- Sign In Form -->
        <form action="dashboard.html">
            <div class="row links">
                <div class="col s6 logo">
                    <img src="assets/theme/images/logo-white.png" alt="">
                </div>
                <div class="col s6 right-align">
                    <strong>Sign In</strong> / <a href="register.php">Sign Up</a>
                </div>
            </div>
            <div class="card-panel clearfix">
                <!-- Social Sign Up -->
                <div class="row socials">
                    <div class="col s4">
                        <a class="btn blue darken-2 z-depth-0 z-depth-1-hover" href="#"><i class="fa fa-2x fa-facebook"></i></a>
                    </div>
                    <div class="col s4">
                        <a class="btn blue lighten-2 z-depth-0 z-depth-1-hover" href="#"><i class="fa fa-2x fa-twitter"></i></a>
                    </div>
                    <div class="col s4">
                        <a class="btn red z-depth-0 z-depth-1-hover" href="#"><i class="fa fa-2x fa-google-plus"></i></a>
                    </div>
                </div>
                <!-- /Social Sign Up -->

                <div class="row">
                    <div class="col"></div>
                </div>

                <!-- Username -->
                <div class="input-field">
                    <i class="fa fa-user prefix"></i>
                    <input id="username-input" type="text" class="validate">
                    <label for="username-input">Username</label>
                </div>
                <!-- /Username -->
                <!-- Password -->
                <div class="input-field">
                    <i class="fa fa-unlock-alt prefix"></i>
                    <input id="password-input" type="password" class="validate">
                    <label for="password-input">Password</label>
                </div>
                <!-- /Password -->

                <div class="switch">
                    <label>
                        <input type="checkbox" checked />
                        <span class="lever"></span>
                        Remember
                    </label>
                </div>

                <button class="waves-effect waves-light btn-large z-depth-0 z-depth-1-hover">Sign In</button>
            </div>

            <div class="links right-align">
                <a href="page-forgot-password.html">Forgot Password?</a>
            </div>

        </form>
        <!-- /Sign In Form -->
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
    <!-- Sortable -->
    <script type="text/javascript" src="assets/sortable/Sortable.min.js"></script>
    <!-- Main -->
    <script type="text/javascript" src="assets/theme/js/theme.min.js"></script>
</body>
</html>

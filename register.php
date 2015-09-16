<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register | <?php echo ProjectTitle; ?></title>
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
    <section id="sign-up">        
        <!-- Background Bubbles -->
        <!--<canvas id="bubble-canvas"></canvas>-->
        <!-- /Background Bubbles -->
        <!-- Sign Up Form -->
        <div id="message"></div>
        <form id="form_register" name="form_register" action="" method="post" enctype="multipart/form-data" data-parsley-validate>
            <div class="row links">
                <div class="col s6 logo">
                    <img src="assets/theme/images/logo-white.png" alt="">
                </div>
                <div class="col s6 right-align">
                    <a href="login.php">Sign In</a> / <strong>Sign Up</strong>
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
                    <!-- First Name -->
                    <div class="col m6 s12">
                        <div class="input-field">
                            <i class="fa fa-user prefix"></i>
                            <input id="input_fname" name="input_fname" type="text" class="validate" required="" aria-required="true">
                            <label for="input_fname">First Name</label>
                        </div>
                    </div>
                    <!-- /First Name -->
                    <!-- Last Name -->
                    <div class="col m6 s12">
                        <div class="input-field">
                            <i class="fa fa-user prefix"></i>
                            <input id="input_lname" name="input_lname" type="text" class="validate" required="" aria-required="true">
                            <label for="input_lname">Last Name</label>
                        </div>
                    </div>
                    <!-- /Last Name -->
                </div>

                <!-- Email -->
                <div class="input-field">
                    <i class="fa fa-envelope prefix"></i>
                    <input id="input_email" name="input_email" type="email" class="validate" required="" aria-required="true">
                    <label for="input_email">Email</label>
                </div>
                <!-- /Email -->
                <!-- Username -->
                <div class="input-field">
                    <i class="fa fa-user prefix"></i>
                    <input id="input_username" name="input_username" type="text" class="validate" required="" aria-required="true">
                    <label for="input_username">Username</label>
                </div>
                <!-- /Username -->
                <!-- Password -->
                <div class="input-field">
                    <i class="fa fa-unlock-alt prefix"></i>
                    <input id="input_password" name="input_password" type="password" class="validate" required="" aria-required="true">
                    <label for="input_password">Password</label>
                </div>
                <!-- /Password -->

                <p>
                    <input type="checkbox" id="checkbox_terms" class="validate" required="" aria-required="true"/>
                    <label for="checkbox_terms">I agree to the <a href="#">terms of use</a>.</label>
                </p>

                <button id="btnSend" name="send" class="waves-effect waves-light btn-large z-depth-0 z-depth-1-hover">Sign Up <i class="mdi-action-lock-open right"></i></button>
            </div>

        </form>
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
    <!-- Main -->
    <script type="text/javascript" src="assets/theme/js/theme.min.js"></script>

    <script type="text/javascript">
        $('#btnSend').click(function(){
            var url = "./account/register.php"; // the script where you handle the form input.
            $.ajax({
                type:"POST",
                url:url,
                data:$("#form_register").serialize(),
                success:function(data){
                    if(data!="")
                        window.location="thankyou.php";
                    else
                        $('#message').append("<div class='alert alert-dismissible lighten-4 text-darken-2'><strong>Error!</strong> User is already exist, please try another email.<button class='close'>&times;</button></div>");
                },
                error:function(){
                    $('#message').append("<div class='alert alert-dismissible lighten-4 text-darken-2'><strong>Warning!</strong> Better check yourself, you're not looking too good.<button class='close'>&times;</button></div>");
                }
            });
        return false; // avoid to execute the actual submit of the form.
        });
        
    </script>
</body>
</html>

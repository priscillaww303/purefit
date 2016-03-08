<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql";
$tbl_name="cs_profiles"; 

// Create connection
$conn = mysql_connect($servername, $username, $password);
mysql_select_db ($dbname);

session_start();

$users = ['user_name'];
if (!isset($_SESSION['user_name'])) {
    header("location: /purefit/login.html");
    die();
};

$identity = $_POST['identity'];
$state = $_POST['state'];
$interest = $_POST['interest'];
$age = $_POST['age'];
$availability = $_POST['availability'];

$result= mysql_query("SELECT * FROM cs_profiles WHERE identity ='{$_POST['identity']}' AND state = '{$_POST['state']}' AND interest = '{$_POST['interest']}' AND age = '{$_POST['age']}' AND availability = '{$_POST['availability']}'");

?>


    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Connect Training Instructors" />
        <script type="application/x-javascript">
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>

        <link href="css/bootstrap-3.1.1.min.css" rel='stylesheet' type='text/css' />
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <!-- Theme files -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href='http://fonts.useso.com/css?family=Oswald:300,400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.useso.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>


        <script>
            $(document).ready(function () {
                $(".dropdown").hover(
                    function () {
                        $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                        $(this).toggleClass('open');
                    },
                    function () {
                        $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                        $(this).toggleClass('open');
                    }
                );
            });
        </script>
    </head>



    <body>
        <!-- start Navigation -->
        <div class="navbar navbar-inverse-blue navbar">
            <!--<div class="navbar navbar-inverse-blue navbar-fixed-top">-->
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
                    <p5><b>URE FIERCE </b></p5>
                    <div class="pull-right">
                        <nav class="navbar nav_bottom" role="navigation">

                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header nav_2">
                                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">Menu
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#"></a>
                            </div>


                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                                <ul class="nav navbar-nav nav_1">
                                    <li><a href="index.html">Home</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Browse<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="search-id.php">Browse All Profiles</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Message Center<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="./privatemsg/index.php">Message Center</a></li>

                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Member<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="login.html">Log In</a></li>
                                            <li><a href="register.html">Register</a></li>
                                            <li><a href="index.html">Log Out</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </nav>
                    </div>
                    <!-- end pull-right -->
                    <div class="clearfix"> </div>
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-inner -->
        </div>
        <!-- end navbar-inverse-blue -->
        <!-- end Navigation -->




        <div class="grid_3">
            <div class="container">
                <div class="breadcrumb1">
                    <ul>
                        <a href="index.html"><i class="fa fa-home home_1"></i></a>
                        <span class="divider">&nbsp;|&nbsp;</span>
                        <!-- <?php var_dump ($_SESSION);?>-->
                        <h2> Welcome, <?php echo $_SESSION['user_name']; ?> </h2>

                        <br>
                        <li class="current-page">Search By Profile ID</li>
                    </ul>
                </div>
                <div class="col-md-9 profile_left">
                    <form action="search_id.php" method="get">
                        <div class="form_but1">
                            <label class="col-sm-5 control-lable1" for="sex">Profile ID : </label>
                            <div class="col-sm-7 form_radios">
                                <div class="input-group1">
                                    <input type="text" name="id" value="" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '';}">
                                    <input type="submit" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- search result -->

        <div class="paid_people">
            <h1>Premium Users</h1>
            <div class="row_1">
                <div class="col-sm-6 paid_people-left">
                    <ul class="profile_item">
                        <a href="#">

                            <?php
                                while($row = mysql_fetch_assoc($result)){
                                    echo '<li class="profile_item-img">';
                                    echo '<img src="uploads/'. $row['id']. '.jpg" class="img-responsive" alt="">';
                                    echo '</li>';
                                    echo '<li class="profile_item-desc">';
                                    echo '<h4>';
                                    echo $row["name"];
                                    echo '</h4>';
                                    echo '<p>';
                                    echo $row ["identity"];
                                    echo $row ["state"];
                                    echo $row ["interest"];
                                    echo $row ["age"];
                                    echo $row ["availability"];
                                    echo '</p>';
                                    echo '<h5>';
                                    echo 'View Full Profile';
                                    echo '</h5>';
                                    echo '</li>';
                                }
                                ?>

                                <div class="clearfix"> </div>
                        </a>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/a7.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>2458741</h4>
                                <p>30 Yrs, Dancing</p>
                                <h5>View Full Profile</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="row_1">
                <div class="col-sm-6 paid_people-left">
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/a6.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>2458741</h4>
                                <p>26 Yrs, Fitness</p>
                                <h5>View Full Profile</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/a5.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>2458741</h4>
                                <p>35 Yrs, Basketball</p>
                                <h5>View Full Profile</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="row_2">
                <div class="col-sm-6 paid_people-left">
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/a7.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>2458741</h4>
                                <p>29 Yrs, Tennis</p>
                                <h5>View Full Profile</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="profile_item">
                        <a href="#">
                            <li class="profile_item-img">
                                <img src="images/a6.jpg" class="img-responsive" alt="" />
                            </li>
                            <li class="profile_item-desc">
                                <h4>2458741</h4>
                                <p>28 Yrs, kickboxing</p>
                                <h5>View Full Profile</h5>
                            </li>
                            <div class="clearfix"> </div>
                        </a>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>


        <div class="col-sm-6 col_2 center">
            <div class="view_profile view_profile2">
                <h3>View Similar Profiles</h3>
                <ul class="profile_item">
                    <a href="#">
                        <li class="profile_item-img">
                            <img src="images/p5.jpg" class="img-responsive" alt="" />
                        </li>
                        <li class="profile_item-desc">
                            <h4>2458741</h4>
                            <p>25 Yrs, Yoga</p>
                            <h5>View Full Profile</h5>
                        </li>
                        <div class="clearfix"> </div>
                    </a>
                </ul>
                <ul class="profile_item">
                    <a href="#">
                        <li class="profile_item-img">
                            <img src="images/p6.jpg" class="img-responsive" alt="" />
                        </li>
                        <li class="profile_item-desc">
                            <h4>2458741</h4>
                            <p>33 Yrs, Body Building</p>
                            <h5>View Full Profile</h5>
                        </li>
                        <div class="clearfix"> </div>
                    </a>
                </ul>
            </div>
        </div>

        <div class="clearfix"> </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3150859.767904157!2d-96.62081048651531!3d39.536794757966845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1408111832978"> </iframe>
        </div>
        <div class="footer">
            <div class="container">
                <div class="col-sm-6 col_2">
                    <h4>About Us</h4>
                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris."</p>
                </div>
                <div class="col-md-2 col_2">
                    <h4>Help & Support</h4>
                    <ul class="footer_links">
                        <li><a href="contact.html">Contact us</a></li>
                        <li><a href="#">Feedback</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col_2">
                    <h4>Quick Links</h4>
                    <ul class="footer_links">
                        <li><a href="privacy.html">Privacy Policy</a></li>
                        <li><a href="services.html">Services</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col_2">
                    <h4>Social</h4>
                    <ul class="footer_social">
                        <li><a href="#"><i class="fa fa-facebook fa1"> </i></a></li>
                        <li><a href="#"><i class="fa fa-twitter fa1"> </i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus fa1"> </i></a></li>
                        <li><a href="#"><i class="fa fa-youtube fa1"> </i></a></li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
                <div class="copy">
                    <p>Copyright &copy; 2016.Pure Fierce All rights reserved.</p>
                </div>
            </div>
        </div>


        <!-- FlexSlider -->
        <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
        <script defer src="js/jquery.flexslider.js"></script>
        <script type="text/javascript">
            $(function () {
                SyntaxHighlighter.all();
            });
            $(window).load(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function (slider) {
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>
        <!-- FlexSlider -->
    </body>

    </html>
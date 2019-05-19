<?php
session_start();
if(isset($_SESSION['user'])&&$_SESSION['user']!=null) {
    $firstname = $_SESSION['user']['Firstname'];
}
?>
<!doctype html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <title>TeamDurham : Facilities</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <link href="../style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/collection.js"></script>
    <script type="text/javascript" src="lib/jquery-2.1.4.min.js"></script>
    <script src="../js/html5.js"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="bookmark"  type="image/x-icon"  href="../images/favicon.ico"/>
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    <script>
        $(function(){
            $("#sub_btn").click(function(){
                var email = $("#email").val();
                var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //match Email
                if(email=='' || !preg.test(email)){
                    $("#chkmsg").html("Please enter correct email address！");
                }else{
                    $("#sub_btn").attr("disabled","disabled").val('submiting..').css("cursor","default");
                    $.post("recovery/sendmail.php",{mail:email},function(msg){
                        if(msg=="noreg"){
                            alert("This email does not register！");
                            $("#sub_btn").removeAttr("disabled").val('submit').css("cursor","pointer");
                        }else{
                            alert(msg);
                            $("#sub_btn").removeAttr("disabled").val('submit').css("cursor","pointer");
                        }
                    });
                }
            });
        })

    </script>
    <script src="../js/belatedPNG.js"></script>
    <script>
        DD_belatedPNG.fix('*');
    </script>
    <![endif]-->
    <style>
        .box3 p{
            text-align: justify;
        }
        .box3 h2{
           font-size: 1.2em;
        }

        .box3 a{
            text-decoration: none;
            color: #A8284E !important;
        }

        .box3 a:hover{
            text-decoration: underline;
            color: #d39bc3 !important ;
        }

        @media screen and (max-device-width: 375px) {
            body {
                background: url(../images/topbg.png) repeat-x;
                background-size: auto 16%;
                font-family: 'DroidSansRegular', Verdana, Geneva, sans-serif;
                color: #5a5143;
            }
        }
    </style>
</head>

<body>
<div id="wrap">

    <div class="container" style="">
        <nav class="navbar navbar-expand-md navbar-light bg-faded">
            <a class="navbar-brand" href="#">
                <h1 id="textlogo">
                    Durham University<span>Sport</span>
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar"
                    aria-expanded="false">
                &#9776;
            </button>
            <div class="collapse navbar-collapse" id="exCollapsingNavbar">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="../index.php">Home</a></li>
                    <li class="nav-item active"><a href="Contact.php">Contact</a></li>
                    <?php
                    if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
                        echo '<li class="nav-item"><a href="mybooking.php">My Bookings</a></li><li class="nav-item"><a href="PersonalDetail.php">Personal Detail</a></li><li class="nav-item"><a href="php/logout.php">Logout</a></li>';
                    } else {
                        echo '<li class="nav-item"><a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login/Register</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>

    <!-- pop-up-box -->
    <div id="small-dialog" class="mfp-hide w3ls_small_dialog wthree_pop">
        <h3>Login</h3>
        <div class="agileits_modal_body">
            <form action="php/login_check.php" method="post">
                <div class="agileits_w3layouts_user">
                    <img src="../images/ev.png" width="22" height="22">
                    <input type="text" name="Email" placeholder="Email Address" required="">
                </div>
                <div class="agileits_w3layouts_user">
                    <img src="../images/pw.png" width="22" height="22">
                    <input type="password" name="Password" placeholder="Password" required="">
                </div>
                <div class="agile_remember">
                    <div class="agile_remember_right">
                        <a href="#small-dialog2" class="play-icon popup-with-zoom-anim">Forgot Password?</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <input type="submit" value="Sign In">
            </form>
            <h5>Don't have an account? <a href="#small-dialog1" class="play-icon popup-with-zoom-anim">Sign Up</a></h5>
        </div>
    </div>

    <div id="small-dialog2" class="mfp-hide w3ls_small_dialog wthree_pop">
        <h3>Reset Password</h3>
        <div class="agileits_modal_body">
            <form action="#" method="post">
                <div class="agileits_w3layouts_user">
                    <img src="../images/ev.png" width="22" height="22">
                    <input type="text" name="Email" id="email" placeholder="Email Address" required=""><span id="chkmsg"></span>
                </div>

                <input type="button" id ="sub_btn" value="Reset">
            </form>
            <h5>Back to <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign In</a></h5>
        </div>
    </div>

    <div id="small-dialog1" class="mfp-hide w3ls_small_dialog wthree_pop">
        <h3>Sign Up</h3>
        <div class="agileits_modal_body">
            <form action="php/register_check.php" method="post">
                <div class="agileits_w3layouts_user">
                    <img src="../images/user.png" width="22" height="22">
                    <input type="text" name="firstname" placeholder="First Name" required="">
                </div>
                <div class="agileits_w3layouts_user">
                    <img src="../images/user.png" width="22" height="22">
                    <input type="text" name="lastname" placeholder="Last Name" required="">
                </div>
                <div style="margin-top: 10px"></div>
                <div class="agileits_w3layouts_user">
                    <img src="../images/ev.png" width="22" height="22">
                    <input type="text" name="email" placeholder="Email Address" required="">
                </div>
                <div style="margin-top: 10px"></div>
                <div class="agileits_w3layouts_user">
                    <img src="../images/phone.png" width="22" height="22">
                    <input type="text" name="phone" placeholder="Phone Number" required="">
                </div>

                <div class="agileits_w3layouts_user agileits_w3layouts_user_agileits">
                    <img src="../images/pw.png" width="22" height="22">
                    <input type="password" name="password" placeholder="Password" required="">
                </div>
                <div class="agileits_w3layouts_user">
                    <img src="../images/confirm.png" width="22" height="22">
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required="">
                </div>

                <input type="submit" value="Register">
            </form>
            <h5>Already a member <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign In</a></h5>
        </div>
    </div>
    <!-- //pop-up-box -->
    <script src="lib/jquery.magnific-popup.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });

        });
    </script>

    <div class="container" style="">
        <div id="homeheader">

        </div>
    </div>

    <div class="container" style="">
        <div class="mainheading">
            <h2 class="introhead">Contact Us</h2>
        </div>
        <div>
            <div class="box3">
                <img src="../images/Contact-Us.jpg">
                <h2>For prices, bookings, membership enquiries or general enquiries please contact:</h2>

                <p>Tel: 0191 334 2178</p>

                <h2>For multi-bookings or events please contact:</h2>

                <p>     Tel: 0191 334 7216</p>
                <br /><br />
                <p>   Durham University Sport</p>
                <p>  The Graham Sports Centre,</p>
                <p>  Durham University</p>
                <p> Stockton Road</p>
                <p>  DH1 3SE</p>

                <h2>Parking</h2>
                <p>Parking is available onsite at the main car park.</p>
                <br />
                <a> teamdurham.bookings@durham.ac.uk </a>
            </div>
        </div>

</div>
<footer>

    <div id="bottom">
        <a href="../index.php">Home</a> | <a href="Contact.php">Contact</a> | <?php
        if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
            echo '<a href="mybooking.php">My Bookings</a> | <a href="PersonalDetail.php">Personal Detail</a> | Welcome '.$firstname. ' <a href="php/logout.php">Logout</a>';
        }else{
            echo '<a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login/Sign up</a>';
        }
        ?>
        <div class="clear"></div>
    </div>
    <div id="credits">
        2019 &copy; All Rights Reserved. <a>Group6</a> Durham University
        <p>original data from: <a href=https://www.teamdurham.com>https://www.teamdurham.com</a></p>
    </div>
</footer>

</body>
</html>

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1" >
    <link href="../style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/collection.js"></script>
    <script type="text/javascript" src="lib/jquery-2.1.4.min.js"></script>
    <script src="../js/html5.js"></script>
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

</head>

<body>
<div id="wrap">

    <nav id="mainnav">

        <h1 id="textlogo">
            Durham University<span>Sport</span>
        </h1>
        <ul>
            <div class="w3_agile_login">
                <li><a href="../index.php">Home</a></li>
                <li class="active"><a href="Contact.php">Contact</a></li>
                <?php
                if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
                    echo '<li><a href="mybooking.php">My Bookings</a></li><li><a href="PersonalDetail.php">Personal Detail</a></li><li><a href="php/logout.php">Logout</a></li>';
                }else{
                    echo '<li><a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login/Register</a></li>';
                }
                ?>
            </div>

        </ul>
    </nav>


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
                    <img src="../images/phone.png" width="22" height="22">
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

                <div class="agileits_w3layouts_user">
                    <img src="../images/phone.png" width="22" height="22">
                    <input type="text" name="email" placeholder="Email Address" required="">
                </div>

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

    <section id="content">
        <header id="homeheader">
            <h2>

                <div class="banner-form">
                        <span></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </h2>
        </header>
        <section id="page">
            <section id="fourcols">
                <header class="mainheading">
                    <h2 class="introhead">Contact Us</h2>
                </header>
                <div class="clear"></div>
                <div>
                    <p>For prices, bookings, membership enquiries or general enquiries, please contact us:</p>

                    <p>Tel: 0191 334 2178</p>

                    <p>  For multi-bookings or events please contact:</p>

                    <p>     Tel: 0191 334 7216</p>

                    <p>   Email: teamdurham.bookings@durham.ac.uk</p>

                    <p>   Durham University Sport</p>
                    <p>  The Graham Sports Centre,</p>
                    <p>  Durham University</p>
                    <p> Stockton Road</p>
                    <p>  DH1 3SE</p>

                    <h2>Parking</h2>
                    <p>Parking is available onsite at the main car park.</p>
                </div>
                <div class="clear"></div>
            </section>
        </section>
    </section>
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
    </div>
</footer>

</body>
</html>

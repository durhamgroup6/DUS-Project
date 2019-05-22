<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $firstname = $_SESSION['user']['Firstname'];
    $userid = $_SESSION['user']['UserID'];
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

    <link rel="bookmark" type="image/x-icon" href="../images/favicon.ico"/>
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    <script>
        $(function () {
            $("#sub_btn").click(function () {
                var email = $("#email").val();
                var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //match Email
                if (email == '' || !preg.test(email)) {
                    $("#chkmsg").html("Please enter correct email address！");
                } else {
                    $("#sub_btn").attr("disabled", "disabled").val('submiting..').css("cursor", "default");
                    $.post("recovery/sendmail.php", {mail: email}, function (msg) {
                        if (msg == "noreg") {
                            alert("This email does not register！");
                            $("#sub_btn").removeAttr("disabled").val('submit').css("cursor", "pointer");
                        } else {
                            alert(msg);
                            window.location.href = "index.html";
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
    @media screen and (max-device-width: 375px) {
        body {
            background: url(../images/topbg.png) repeat-x;
            background-size: auto 10%;
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
            <a class="navbar-brand" href="https://www.teamdurham.com/">
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
                    <?php
                    if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
                        if ($_SESSION["user"]['Role'] != "admin") {
                            echo '<style>#exCollapsingNavbar{
                                        margin-left: 0%;
                                                }</style>';
                            echo '<li class="nav-item"><a href="Contact.php">Contact</a></li><li class="nav-item active"><a href="mybooking.php">My Bookings</a></li><li class="nav-item"><a href="PersonalDetail.php">Personal Detail</a></li><li class="nav-item"><a href="php/logout.php">Logout</a></li>';
                        }else{
                            echo '<style>#exCollapsingNavbar{
                                        margin-left: -2%;
                                                }</style>';
                            echo '<li class="nav-item active"><a href="mybooking.php">My Bookings</a></li><li class="nav-item"><a href="PersonalDetail.php">Personal Detail</a></li>  <li class="nav-item"><a href="../Admin/index.php">Admin Area</a></li><li class="nav-item"><a href="php/logout.php">Logout</a></li>';
                        }
                    }else {
                        header('Location: ../index.php');
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container" style="">
        <div id="homeheader">

        </div>
    </div>

    <div class="container" style="">
        <div class="mainheading">
            <h2 class="introhead">Booking List</h2>
        </div>
        <div>
            <?php
            require_once 'database/database.php';
            showmybookings($userid);
            ?>
        </div>

    </div>
</div>

<footer>

    <div id="bottom">
        <a href="../index.php">Home</a> | <?php
        if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
            if ( $_SESSION["user"]['Role'] != "admin") {
                echo '<a href="Contact.php">Contact</a> | <a href="mybooking.php">My Bookings</a> | <a href="PersonalDetail.php">Personal Detail</a> | Welcome ' . $firstname . ' <a href="php/logout.php">Logout</a>';
            }else{
                echo '<a href="mybooking.php">My Bookings</a> | <a href="PersonalDetail.php">Personal Detail</a> | <a href="../Admin/index.php">Admin Area</a> | Welcome ' . $firstname . ' <a href="php/logout.php">Logout</a>';
            }
        }else {
            echo '<a href="Contact.php">Contact</a> | <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login/Sign up</a>';
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

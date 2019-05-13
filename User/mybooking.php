<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $firstname = $_SESSION['user']['Firstname'];
    $userid=$_SESSION['user']['UserID'];
}
?>
<!doctype html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <title>TeamDurham : Facilities</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="../style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/collection.js"></script>
    <script type="text/javascript" src="lib/jquery-2.1.4.min.js"></script>
    <script src="../js/html5.js"></script>
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
                <li><a href="Contact.php">Contact</a></li>
                <?php
                if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
                    echo '<li class="active"><a href="mybooking.php">My Bookings</a></li><li><a href="PersonalDetail.php">Personal Detail</a></li><li><a href="php/logout.php">Logout</a></li>';
                } else {
                    header('Location: index.php');
                }
                ?>
            </div>

        </ul>
    </nav>

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
            <h2 class="introhead">Booking List</h2>
        </header>
        <div class="clear"></div>
        <div>
            <?php
            require_once 'database/database.php';
            showmybookings($userid);
            ?>
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
            echo ' <a href="">My Bookings</a> | <a href="PersonalDetail.php">Personal Detail</a> | Welcome ' . $firstname . ' <a href="php/logout.php">Logout</a>';
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

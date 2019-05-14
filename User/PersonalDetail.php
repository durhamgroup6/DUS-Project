<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $firstname = $_SESSION['user']['Firstname'];
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
                    echo '<li><a href="mybooking.php">My Bookings</a></li><li class="active"><a href="PersonalDetail.php">Personal Detail</a></li><li><a href="php/logout.php">Logout</a></li>';
                } else {
                    header('Location: ../index.php');
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
            <h2 class="introhead">Personal Detail</h2>
        </header>
        <div class="clear"></div>
        <div>
            <form action="php/persondetail_update.php" method="post">

                <div class="agileits_w3layouts_user">
                    Email:
                    <input type="text" name="email" value=<?php echo $_SESSION['user']['Email']?> readonly>
                </div>

                <div class="agileits_w3layouts_user">
                    Firstname:
                    <input type="text" name="firstname" value=<?php echo $_SESSION['user']['Firstname']?> required="">
                </div>
                <div class="agileits_w3layouts_user">
                    Lastname:
                    <input type="text" name="lastname" value=<?php echo $_SESSION['user']['Lastname']?> required="">
                </div>

                <div class="agileits_w3layouts_user">
                    Phone:
                    <input type="text" name="phone" value=<?php echo $_SESSION['user']['Phone']?> required="">
                </div>

                <div class="agileits_w3layouts_user agileits_w3layouts_user_agileits">
                    Password:
                    <input type="password" name="password" value=<?php echo $_SESSION['user']['Password']?>>
                </div>

                <input type="submit" name="submit" value="update">
            </form>
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
            echo ' <a href="mybooking.php">My Bookings</a> | <a href="PersonalDetail.php">Personal Detail</a> | Welcome ' . $firstname . ' <a href="php/logout.php">Logout</a>';
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

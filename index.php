<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $firstname = $_SESSION['user']['Firstname'];
}
?>
<!doctype html>

<html class="no-js" lang="en">
<head>
    <title>TeamDurham : Facilities</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/collection.js"></script>
    <script type="text/javascript" src="User/lib/jquery-2.1.4.min.js"></script>
    <script src="js/html5.js"></script>
    <link href='User/calendarcss/fullcalendar.min.css' rel='stylesheet'/>
    <link href='User/calendarcss/fullcalendar.print.min.css' rel='stylesheet' media='print'/>
    <script src='User/lib/moment.min.js'></script>
    <script src='User/lib/jquery.min.js'></script>
    <script src='User/lib/fullcalendar.min.js'></script>
    <script type="text/javascript" src="User/lib/jquery.fancybox.pack.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="User/calendarcss/jquery.fancybox.css?v=2.1.5" media="screen"/>
    <script>

        $(document).ready(function () {
            var date = new Date();
            var month = date.getMonth() + 1;
            var defaultDate = date.getFullYear() + '-' + month + '-' + date.getDate();
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listYear'
                },
                defaultDate: defaultDate,
                selectable: true,
                selectHelper: true,
                allDay: false,
                editable: true,
                navLinks: true, // can click day/week names to navigate views
                eventLimit: true, // allow "more" link when too many events
                businessHours: true,
                slotDuration: '01:00:00',
                eventStartEditable:false,
                events: {
                    url: 'User/php/get-events.php',
                    error: function () {
                        $('#script-warning').show();
                    }
                },
                loading: function (bool) {
                    $('#loading').toggle(bool);
                },
                eventClick: function (calEvent, jsEvent, view) {
                    $.fancybox({
                        'type': 'ajax',
                        'href': 'User/php/showevent.php?id=' + calEvent.id +'&color='+calEvent.color
                    });
                },
                selectConstraint: {
                    start: $.fullCalendar.moment().subtract(1, 'days'),
                    end: $.fullCalendar.moment().startOf('month').add(1, 'year')
                },
                select: function (date, jsEvent, view) {
                    $.fancybox({
                        'type': 'ajax',
                        'href': 'User/php/booking.php?date=' + date.format()
                    });

                }
            });

        });

        $(function () {
            $("#sub_btn").click(function () {
                var email = $("#email").val();
                var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //match Email
                if (email == '' || !preg.test(email)) {
                    $("#chkmsg").html("Please enter correct email address！");
                } else {
                    $("#sub_btn").attr("disabled", "disabled").val('submiting..').css("cursor", "default");
                    $.post("User/recovery/sendmail.php", {mail: email}, function (msg) {
                        if (msg == "noreg") {
                            alert("This email does not register！");
                            $("#sub_btn").removeAttr("disabled").val('submit').css("cursor", "pointer");
                        } else {
                            alert(msg);
                            $("#sub_btn").removeAttr("disabled").val('submit').css("cursor", "pointer");
                        }
                    });
                }
            });
        });

    </script>
    <style>

        #calendarbackground {
            margin: 0;
            padding: 0;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
            font-size: 14px;
        }

        #script-warning {
            display: none;
            background: #eee;
            border-bottom: 1px solid #ddd;
            padding: 0 10px;
            line-height: 40px;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            color: red;
        }

        #loading {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        #calendar {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 10px;
        }

    </style>
    <script src="js/belatedPNG.js"></script>
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
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="User/Contact.php">Contact</a></li>
                <?php
                if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
                    echo '<li><a href="User/mybooking.php">My Bookings</a></li><li><a href="User/PersonalDetail.php">Personal Detail</a></li><li><a href="User/php/logout.php">Logout</a></li>';
                } else {
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
            <form action="User/php/login_check.php" method="post">
                <div class="agileits_w3layouts_user">
                    <img src="images/ev.png" width="22" height="22">
                    <input type="text" name="Email" placeholder="Email Address" required="">
                </div>
                <div class="agileits_w3layouts_user">
                    <img src="images/pw.png" width="22" height="22">
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
                    <img src="images/phone.png" width="22" height="22">
                    <input type="text" name="Email" id="email" placeholder="Email Address" required=""><span
                            id="chkmsg"></span>
                </div>

                <input type="button" id="sub_btn" value="Reset">
            </form>
            <h5>Back to <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign In</a></h5>
        </div>
    </div>

    <div id="small-dialog1" class="mfp-hide w3ls_small_dialog wthree_pop">
        <h3>Sign Up</h3>
        <div class="agileits_modal_body">
            <form action="User/php/register_check.php" method="post">
                <div class="agileits_w3layouts_user">
                    <img src="images/user.png" width="22" height="22">
                    <input type="text" name="firstname" placeholder="First Name" required="">
                </div>
                <div class="agileits_w3layouts_user">
                    <img src="images/user.png" width="22" height="22">
                    <input type="text" name="lastname" placeholder="Last Name" required="">
                </div>

                <div class="agileits_w3layouts_user">
                    <img src="images/phone.png" width="22" height="22">
                    <input type="text" name="email" placeholder="Email Address" required="">
                </div>

                <div class="agileits_w3layouts_user">
                    <img src="images/phone.png" width="22" height="22">
                    <input type="text" name="phone" placeholder="Phone Number" required="">
                </div>

                <div class="agileits_w3layouts_user agileits_w3layouts_user_agileits">
                    <img src="images/pw.png" width="22" height="22">
                    <input type="password" name="password" placeholder="Password" required="">
                </div>
                <div class="agileits_w3layouts_user">
                    <img src="images/confirm.png" width="22" height="22">
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required="">
                </div>

                <input type="submit" value="Register">
            </form>
            <h5>Already a member <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign In</a></h5>
        </div>
    </div>
    <!-- //pop-up-box -->
    <script src="User/lib/jquery.magnific-popup.js" type="text/javascript"></script>
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

    <div id="content">
        <header id="homeheader">
            <h2>

                <div class="banner-form">
                    <form class="search_form" action="" method="post">
                        <input class="wow fadeInRight" data-wow-delay="0.5s" type="text" placeholder="Search"
                               name="facility"/>
                        <input class="wow fadeInLeft" data-wow-delay="0.5s" type="submit" name="submit" value="Search"/>
                    </form>
                    <div class="search">
                        <span></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </h2>
        </header>
        <div id="page">
            <header class="mainheading">
                <h2 class="introhead">Main Facilities in Maiden Castle</h2>
            </header>
            <div>
                <div class="container">
                    <?php
                    require_once 'User/database/database.php';
                    //$record = $pdo->query("SELECT game.gameName,record.time,record.result FROM competition JOIN record ON record.competitionid = competition.competitionid JOIN game ON competition.gameid = game.gameid WHERE userid = '".$_SESSION['user']['userid'AND game.rank<=7]."';");
                    $facility = filter_input(INPUT_POST, 'facility', FILTER_SANITIZE_STRING);
                    if (isset($_POST['submit']) && $_POST['submit'] == "Search" && $facility != null) {
                        $search = $pdo->query("SELECT * FROM facility WHERE FacilityName LIKE '%" . $facility . "%';");
                        while ($row = $search->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="cell">';
                            echo '<div class="image"><img src="images/' . $row['FacilityName'] . '.jpg"></a></div>';
                            echo '<div align="center"><table style="width: 220px;text-align: center"><tr>
                    <th style="font-size: 1.8em">' . $row['FacilityName'] . '</th>
                    </tr>
                    <tr>
                    <td style="font-size: 1.2em"><textarea name="reworkmes" cols="40" rows="4" style="overflow:scroll; overflow-x: hidden;" readonly>' . $row['Description'] . '</textarea></td>
                    </tr></table></div>';
                            echo '</div>';
                        }
                    } else {
                        showfacilities();
                    } ?>
                </div>
                <div class="clear"></div>
            </div>
            <div id="fourcols">
                <header class="mainheading">
                    <h2 class="introhead">Events</h2>
                </header>
                <div class="clear"></div>
                <div class="col">
                    <h3>flexible canlendar</h3>
                    <p>If you are interested in joining the classes/sessions <a>Contact Trainer for Sign Up</a></p>
                </div>
                <div id="calendarbackground">
                    <div id='calendar'></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

<footer>

    <div id="bottom">
        <a href="index.php">Home</a> | <a href="User/Contact.php">Contact</a> | <?php
        if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
            echo '<a href="User/mybooking.php">My Bookings</a> | <a href="User/PersonalDetail.php">Personal Detail</a> | Welcome ' . $firstname . ' <a href="User/php/logout.php">Logout</a>';
        } else {
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

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
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/collection.js"></script>
    <script type="text/javascript" src="User/lib/jquery-2.1.4.min.js"></script>
    <script src="js/html5.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment-with-locales.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.js"></script>

    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='User/calendarcss/fullcalendar.min.css' rel='stylesheet'/>
    <link href='User/calendarcss/fullcalendar.print.min.css' rel='stylesheet' media='print'/>
    <!--    <script src='User/lib/moment.min.js'></script>-->
    <!--    <script src='User/lib/jquery.min.js'></script>-->
    <!--    <script src='User/lib/fullcalendar.min.js'></script>-->
    <script type="text/javascript" src="User/lib/jquery.fancybox.pack.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="User/calendarcss/jquery.fancybox.css?v=2.1.5" media="screen"/>
    <link rel="bookmark" type="image/x-icon" href="images/favicon.ico"/>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <script>

        $(document).ready(function () {

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listYear'
                },
                defaultView: 'month',
                selectable: true,
                selectHelper: true,
                navLinks: true, // can click day/week names to navigate views
                eventLimit: true, // allow "more" link when too many events
                businessHours: true,
                slotDuration: '01:00:00',
                minTime: '07:00:00',
                maxTime: '22:00:00',
                eventStartEditable: false,
                events: {url: 'User/php/get-events.php'},
                eventRender: function (event, element, view) {
                    var theDate = event.start
                    var endDate = new Date(event.dowend);
                    var startDate = new Date(event.dowstart);
                    if (theDate >= endDate) {
                        return false;
                    }
                    if (theDate <= startDate) {
                        return false;
                    }

                },
                loading: function (bool) {
                    $('#loading').toggle(bool);
                },
                eventClick: function (calEvent, jsEvent, view) {
                    $.fancybox({
                        'type': 'ajax',
                        'href': 'User/php/showevent.php?id=' + calEvent.id + '&color=' + calEvent.color
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

        @media screen and (max-device-width: 375px) {
            body {
            background: url(images/topbg.png) repeat-x;
            background-size: auto 13%;
            font-family: 'DroidSansRegular', Verdana, Geneva, sans-serif;
            color: #5a5143;
        }
        }

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
                    <li class="nav-item active"><a href="index.php">Home</a></li>
                    <li class="nav-item"><a href="User/Contact.php">Contact</a></li>
                    <?php
                    if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
                        echo '<li class="nav-item"><a href="User/mybooking.php">My Bookings</a></li><li class="nav-item"><a href="User/PersonalDetail.php">Personal Detail</a></li><li class="nav-item"><a href="User/php/logout.php">Logout</a></li>';
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

    <div class="container" style="">
        <div id="homeheader">
            <h2>
                <div class="banner-form">
                    <form class="search_form" action="" method="post">
                        <input class="wow fadeInRight" data-wow-delay="0.5s" type="text" placeholder="Search"
                               name="facility"/>
                        <input class="wow fadeInLeft" data-wow-delay="0.5s" type="submit" name="submit" value="Search"
                               style="width: 75px"/>
                    </form>
                    <div class="search">
                        <span></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </h2>
        </div>
    </div>

    <div class="container" style="">
        <div class="mainheading">
            <h2 class="introhead">Main Facilities in Maiden Castle</h2>
        </div>
        <div>
            <?php
            require_once 'User/database/database.php';
            //$record = $pdo->query("SELECT game.gameName,record.time,record.result FROM competition JOIN record ON record.competitionid = competition.competitionid JOIN game ON competition.gameid = game.gameid WHERE userid = '".$_SESSION['user']['userid'AND game.rank<=7]."';");
            $facility = filter_input(INPUT_POST, 'facility', FILTER_SANITIZE_STRING);
            if (isset($_POST['submit']) && $_POST['submit'] == "Search" && $facility != null) {
                $search = $pdo->query("SELECT * FROM facility WHERE FacilityName LIKE '%" . $facility . "%';");
                while ($row = $search->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="cell">';
                    echo '<div class="image"><img src="images/' . $row['FacilityName'] . '.jpg"></a></div>';
                    echo '<div align="center"><table class="font_table"><tr>
                    <th>' . $row['FacilityName'] . '</th>
                    </tr>
                    <tr>
                    <td><textarea class="textarea_facility" name="reworkmes" style="overflow:scroll; overflow-x: hidden;" readonly>' . $row['Description'] . '</textarea></td>
                    </tr></table></div>';
                    echo '</div>';
                }
            }
            else {
                showfacilities();
            } ?>
        </div>

        <div class="container" style="">
            <div id="fourcols">
                <div class="mainheading">
                    <h2 class="introhead">Event</h2>
                </div>
                <div class="clear"></div>
                <h3>flexible canlendar</h3>
                <p>If you are interested in joining the classes/sessions, Please contact trainers for sign up</p>
                <h4>Green: Classes/Sessions</h4>
                <h5>Red: Block Booking</h5>
                <h6>Other Color: Facility Booking</h6>
                <div id="calendarbackground">
                    <div id='calendar'></div>
                </div>
                <div class="clear"></div>
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

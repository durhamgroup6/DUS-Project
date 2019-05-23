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
                    var theDate = event.start;
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
                        'href': 'User/php/showevent.php?id=' + calEvent.id + '&type=' + calEvent.type
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

        #popBox {
            display: none;
            background-color: #FFFFFF;
            z-index: 11;
            max-width: 700px;
            top:0;
            right:0;
            left:0;
            bottom:0;
            margin:auto;
            padding: 2em;
            position: relative;
            text-align: center;
        }

        #popBox .close{
            text-align: right;
            margin-right: 5px;
            background-color: #F8F8F8;
        }

        #popBox .close a {
            text-decoration: none;
            color: #2D2C3B;
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
                    <li class="nav-item active"><a href="index.php">Home</a></li>
                    <?php
                    if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
                        if ($_SESSION["user"]['Role'] != "admin") {
                            echo '<style>#exCollapsingNavbar{
                                        margin-left: 0%;
                                                }</style>';
                            echo '<li class="nav-item"><a href="User/Contact.php">Contact</a></li><li class="nav-item"><a href="User/mybooking.php">My Bookings</a></li><li class="nav-item"><a href="User/PersonalDetail.php">Personal Detail</a></li><li class="nav-item"><a href="User/php/logout.php">Logout</a></li>';
                        } else {
                            echo '<style>#exCollapsingNavbar{
                                        margin-left: -2%;
                                                }</style>';
                            echo '<li class="nav-item"><a href="User/mybooking.php">My Bookings</a></li><li class="nav-item"><a href="User/PersonalDetail.php">Personal Detail</a></li>  <li class="nav-item"><a href="Admin/index.php">Admin Area</a></li><li class="nav-item"><a href="User/php/logout.php">Logout</a></li>';
                        }
                    } else {
                        echo ' <li class="nav-item"><a href="User/Contact.php">Contact</a></li><li class="nav-item"><a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login/Register</a></li>';
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
                    <img src="images/ev.png" width="22" height="22">
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
                <div style="margin-top: 10px"></div>
                <div class="agileits_w3layouts_user">
                    <img src="images/ev.png" width="22" height="22">
                    <input type="text" name="email" placeholder="Email Address" required="">
                </div>
                <div style="margin-top: 10px"></div>
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
            <input type="button" name="popBox" value="User Guidance" onclick="popBox()" style="width: 35%;
        border: 0.8px solid #8636d2;
        font-size: 1em;
        color: #fff;
        outline: none;
        font-weight: 600;
        background: #8636d2;
        border-radius: 3px;
        border-left: 5px solid #8636d2;
        border-right: 5px solid #8636d2;
        transition: 0.5s all;
        -webkit-transition: 0.5s all;
        -moz-transition: 0.5s all;
        -o-transition: 0.5s all;
        position: relative;
        -ms-transition: 0.5s all;">
            <div id="popLayer"></div>
            <div id="popBox">
                <div class="close">
                    <a href="javascript:void(0)" onclick="closeBox()">Close</a>
                </div>
                <div class="content">
                    <h1>Guideline</h1>
                    <p>After reading this guidance, you can easily know how to use the online booking system. It might take about 3-5 mins to read it.</p>
                    <p> 1.	Create New Accounts/Login</p>
                    Go to the homepage. After clicking ‘Login/Register’ in the Navigation Bar or ‘Login/Sign up’ in the bottom of the website, you’ll see the register/Login pop-up box. Fill in your information and confirm to register a new account. Remember all the information are needed. If you already have an account, provide the email address and password to login.

                    <p> 2.	Recover Account Password</p>
                    Go to the homepage. After clicking ‘Login/Register’ in the Navigation Bar or ‘Login/Sign up’ in the bottom of the website, you’ll see the register/Login pop-up box. Press the ‘Forget the password’ to reset your password. You’ll receive an email and a link which is valid for only 24-hour will sent to you to set up a new password.
                    <p> 3.	Modify User Account Information</p>
                    You can modify your account details after login. Click ‘Personal Details’ in the Navigation Bar to enter a new page, which can adjust your account details. A notification email will also be sent to you if you change the information.
                    <p> 4.	Search Website</p>
                    There is a search box in the homepage which can help you quickly find the information you want.
                    <p> 5.	View Facility Information</p>
                    There is a list of facilities provided in the homepage. You can see the facilities’ pictures and information.
                    <p> 6.	View Flexible Calendar</p>
                    There is a flexible calendar provided in the homepage. You can see the existing bookings and activities details via daily, weekly and monthly views. For the calendar color, Green means flexible classes or sessions, Red means the period are blocked for Booking and Other Color all existing Facility Bookings.
                    <p> 7.	Check Account Booking</p>
                    You can check your booking record after login. Click ‘My Bookings’ in the Navigation Bar to enter a new page to see your booking details.
                    <p> 8.	Book Facilities</p>
                    You can use the homepage calendar to make a facility booking. Click the available time on the calendar only once, you’ll see a booking pop-up box. Fill all the booking details (No blanks accepted) and submit request. If you book successfully, a confirmation email with booking cost will send to you.
                    <p> 9.Ask for help</p>
                    If you have any problem, you can contact us by clicking ’Contact’ in the Navigation Bar to see all our contact information.
                </div>
            </div>
            <script>
                /*点击弹出按钮*/
                function popBox() {
                    var popBox = document.getElementById("popBox");
                    var popLayer = document.getElementById("popLayer");
                    popBox.style.display = "block";
                    popLayer.style.display = "block";
                };

                /*点击关闭按钮*/
                function closeBox() {
                    var popBox = document.getElementById("popBox");
                    var popLayer = document.getElementById("popLayer");
                    popBox.style.display = "none";
                    popLayer.style.display = "none";
                }
            </script>
            <h2>
                <div class="banner-form">
                    <form class="search_form" action="" method="post">
                        <input class="wow fadeInRight" data-wow-delay="0.5s" type="text"
                               placeholder="Facility or Classes"
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
        <?php
        require_once 'User/database/database.php';
        //$record = $pdo->query("SELECT game.gameName,record.time,record.result FROM competition JOIN record ON record.competitionid = competition.competitionid JOIN game ON competition.gameid = game.gameid WHERE userid = '".$_SESSION['user']['userid'AND game.rank<=7]."';");
        $facility = filter_input(INPUT_POST, 'facility', FILTER_SANITIZE_STRING);
        if (isset($_POST['submit']) && $_POST['submit'] == "Search" && $facility != null) {
            $search = $pdo->query("SELECT * FROM facility WHERE FacilityName LIKE '%" . $facility . "%';");
            echo '<div class="mainheading">
            <h2 class="introhead">Search Result</h2>
        </div>
        <div>';
            while ($row = $search->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="search"><table>';
                $image = $row['PicURL'];
                echo '<tr>
<th>Facility Name</th>
<th>Image</th>
<th>Description</th>
</tr>
<tr>
 <td>' . $row['FacilityName'] . '</td>
 <style>.image{
margin-left: 25%;
 width: 50%;
 height: 50%;
 }
  @media screen and (max-device-width: 375px) {
  .image{
margin-left: 2%;
 width: 100%;
 height: 100%;
 }
  }
 </style>
    <td><div class="image"><img src="Admin/facilityImages/' . $image . '"></div></td>
    <td><textarea style="width: 100%;height: 100%" rows="5" readonly>' . $row['Description'] . '</textarea></td>    
    </tr></table></div>';
            }

            $search = $pdo->query("SELECT * FROM event as e left join user as u on e.TrainerID = u.UserID WHERE EventName LIKE '%" . $facility . "%';");
            while ($row = $search->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="search"><table>
<tr>
<th>Event Name</th>
<th>Trainer Name</th>
<th>Contact</th>
<th>Description</th>
</tr>
<tr>
    <td>' . $row['EventName'] . '</td>
    <td>' . $row['Firstname'] . ' ' . $row['Lastname'] . '</td>
    <td>' . $row['Email'] . '<br> ' . $row['Phone'] . '</td>
     <td><textarea style="width: 100%;height: 100%" rows="5" readonly>' . $row['Description'] . '</textarea></td>    
    </tr></table></div>';
            }
        } else {
            echo '<div class="mainheading">
            <h2 class="introhead">Main Facilities in Maiden Castle</h2>
        </div>
        <div>';
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
        <a href="index.php">Home</a> | <?php
        if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
            if ( $_SESSION["user"]['Role'] != "admin") {
                echo '<a href="User/Contact.php">Contact</a> | <a href="User/mybooking.php">My Bookings</a> | <a href="User/PersonalDetail.php">Personal Detail</a> | Welcome ' . $firstname . ' <a href="User/php/logout.php">Logout</a>';
            }else{
                echo '<a href="User/mybooking.php">My Bookings</a> | <a href="User/PersonalDetail.php">Personal Detail</a> | <a href="Admin/index.php">Admin Area</a> | Welcome ' . $firstname . ' <a href="User/php/logout.php">Logout</a>';
            }
        }else {
            echo '<a href="User/Contact.php">Contact</a> | <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login/Sign up</a>';
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

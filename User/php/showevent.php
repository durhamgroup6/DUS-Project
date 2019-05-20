<?php
session_start();
include_once('../database/database.php');
$id = $_GET['id'];

if (isset($_GET['type']) && $_GET['type'] == "event") {
    $id = $_GET['id'];
    $sql_event = "SELECT e.EventID,e.EventName,e.Description,e.StartDate,e.EndDate,f.FacilityName,u.Email,u.Phone,u.Firstname,u.Lastname from event as e LEFT JOIN user as u on e.TrainerID = u.UserID left JOIN facility as f ON e.FacilityID = f.FacilityID WHERE e.EventID = '$id'";
    $result = $pdo->query($sql_event);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id = $row['EventID'];
        $title = $row['EventName'];
        $description = $row['Description'];
        $startdate = $row['StartDate'];
        $enddate = $row['EndDate'];
        $facility = $row['FacilityName'];
        $firstname = $row['Firstname'];
        $lastname = $row['Lastname'];
        $email = $row['Email'];
        $phone = $row['Phone'];

    }
    echo '<script src="http://malsup.github.io/jquery.form.js" type="text/javascript"></script>
<div class="fancy">
    <h2>Event Detail</h2>
    <form id="add_form" action="" method="post">
        <input type="hidden" name="id" id="eventid" value=' . $id . '>
        <p>Event Name：<text class="input" name="event" id="event" style="width:180px">' . $title . '</text></p>
        <p>Description：<textarea class="input" name="description" style="width:280px;height: 180px"
                              id="description" readonly>'.$description.' </textarea>
        </p>
        <p>Facility：<text class="input" name="facility" style="width:180px;"
                           id="facility">' . $facility . '</text>
        </p>
        <p>Start Time：<text class="input datepicker" name="startdate"
                             id="startdate">' . $startdate . '</text>
        </p>
        <p>End Time：<text class="input datepicker" name="enddate" id="enddate">' . $enddate . '</text>
        </p>
        <p>Trainer Name：<text class="input" name="trainername" style="width:180px;"
                               id="trainername" readonly>' . $firstname.' '.$lastname . '</text>
        </p>
        <p>Contact：<textarea class="input" name="contact" style="width:200px"
                id="contact" readonly>Email:' . $email . ' Phone:' . $phone . '</textarea>
        </p>
    </form>
</div>';
}elseif (isset($_GET['type']) && $_GET['type'] == "block"){
    $id = $_GET['id'];
    $sql_blockbooking = "select * from blockbookings as b left join facility as f on b.facilityID = f.FacilityID where b.BlockID = '$id'";
    $result = $pdo->query($sql_blockbooking);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id = $row['BlockID'];
        $title = $row['FacilityName'];
        $startdate = $row['StartTime'];
        $enddate = $row['EndTime'];

    }
    echo '<script src="http://malsup.github.io/jquery.form.js" type="text/javascript"></script>
<div class="fancy">
    <h2>Block Facility Detail</h2>
    <form id="add_form" action="" method="post">
        <input type="hidden" name="id" id="eventid" value=' . $id . '>
        <p>Facility Name：<text class="input" name="event" id="event" style="width:180px">' . $title . '</text></p>
        <p>Start Time：<text class="input datepicker" name="startdate"
                             id="startdate">' . $startdate . '</text>
        </p>
        <p>End Time：<text class="input datepicker" name="enddate" id="enddate">' . $enddate . '</text>
        </p>
    </form>
</div>';
}else {
    if(isset($_SESSION['user'])&&$_SESSION['user']!=null) {
        $usersessionid = $_SESSION['user']['UserID'];
    $id = $_GET['id'];
    $sql = "SELECT COUNT(*) as facilityuser,f.FacilityName,b.Price,bd.StartTime,bd.EndTime,f.Capacity,b.UserID,bd.BookingID FROM bookingdates as bd left join booking as b on bd.BookingID=b.BookingID LEFT JOIN facility as f ON b.FacilityID = f.FacilityID WHERE bd.StartTime = (SELECT StartTime FROM bookingdates WHERE BookDateID = '$id')  and b.FacilityID = (SELECT FacilityID FROM bookingdates as bd LEFT join booking as b on b.BookingID=bd.BookingID WHERE bd.BookDateID = '$id')";
    $result = $pdo->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id = $row['BookingID'];
        $facility = $row['FacilityName'];
        $userid = $row['UserID'];
        $user = $row['facilityuser'];
        $Capacity = $row['Capacity'];
        $starttime = $row['StartTime'];
        $endtime = $row['EndTime'];
        $price = $row['Price'];
    }
    if ($usersessionid != $userid) {
        echo '<script src="http://malsup.github.io/jquery.form.js" type="text/javascript"></script>
<div class="fancy">
    <h2>Book Detail----Facility</h2>
    <form id="add_form" action="" method="post">
        <input type="hidden" name="id" id="eventid" value=' . $id . '>
        <p>Facility：<text class="input" name="facility" style="width:180px;"
                           id="facility">' . $facility . '</text>
        </p>
        <p>Number of bookings：<text class="input" name="studentNumber" id="studentNumber">' . $user . '</text>
        </p>
        <p>Capacity：<text class="input" name="CapacityNow" id="CapacityNow">' . $Capacity . '</text>
        </p>
        <p>Start Time：<text class="input datepicker" name="startdate" id="startdate">' . $starttime . '</text>
        </p>
        <p>End Time：<text class="input datepicker" name="enddate" id="enddate">' . $endtime . '</text>
        </p>
    </form>
</div>';
    }else{
        echo '<script src="http://malsup.github.io/jquery.form.js" type="text/javascript"></script>
<div class="fancy">
    <h2>Book Detail--Yours</h2>
    <form id="add_form" action="" method="post">
        <p>Booking ID:<text name="id" id="eventid" style="width:250px ">' . $id . '</text></p>
        <p>Facility：<text class="input" name="facility" style="width:180px;"
                           id="facility">' . $facility . '</text>
        </p>
        <p>Price：<text class="input" name="price" id="price">' . $price . '</text>
        </p>
        <p>Start Time：<text class="input datepicker" name="startdate" id="startdate">' . $starttime . '</text>
        </p>
        <p>End Time：<text class="input datepicker" name="enddate" id="enddate">' . $endtime . '</text>
        </p>
    </form>
</div>';
        }
    }else{
        echo "Please login firstly";
        }
}

?>
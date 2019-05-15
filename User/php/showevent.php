<?php
session_start();
include_once('../database/database.php');
$id = $_GET['id'];
$sql = "SELECT * FROM event as e LEFT JOIN user as u on e.TrainerID = u.UserID left JOIN facility as f ON e.FacilityID = f.FacilityID WHERE e.EventID = '$id'";


if (isset($_GET['color']) && $_GET['color'] == "green") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM event as e LEFT JOIN user as u on e.TrainerID = u.UserID left JOIN facility as f ON e.FacilityID = f.FacilityID WHERE e.EventID = '$id'";
    $result = $pdo->query($sql);
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
        <p>Contact：<textarea class="input" name="contact" style="width:180px"
                id="contact" readonly>Email:' . $email . ' Phone:' . $phone . '</textarea>
        </p>
    </form>
</div>';
}elseif (isset($_GET['color']) && $_GET['color'] == "red"){
    $id = $_GET['id'];
    $sql = "SELECT * FROM event WHERE EventID = '$id'";
    $result = $pdo->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $id = $row['EventID'];
        $title = $row['EventName'];
        $description = $row['Description'];
        $startdate = $row['StartDate'];
        $enddate = $row['EndDate'];

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
        <p>Start Time：<text class="input datepicker" name="startdate"
                             id="startdate">' . $startdate . '</text>
        </p>
        <p>End Time：<text class="input datepicker" name="enddate" id="enddate">' . $enddate . '</text>
        </p>
    </form>
</div>';
}else{
    $id = $_GET['id'];
    $sql = "SELECT COUNT(*) as facilityuser,f.FacilityName,b.StartTime,b.EndTime,f.Capacity FROM booking as b LEFT JOIN facility as f ON b.FacilityID = f.FacilityID WHERE b.StartTime = (SELECT StartTime FROM booking WHERE BookingID = '$id')  and b.FacilityID = (SELECT FacilityID FROM booking WHERE BookingID = '$id')";
    $result = $pdo->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        //$id = $row['BookingID'];
        $facility = $row['FacilityName'];
        $user = $row['facilityuser'];
        $Capacity = $row['Capacity'];
        $starttime = $row['StartTime'];
        $endtime = $row['EndTime'];
    }
    echo '<script src="http://malsup.github.io/jquery.form.js" type="text/javascript"></script>
<div class="fancy">
    <h2>Book Detail</h2>
    <form id="add_form" action="" method="post">
     <!-- <input type="hidden" name="id" id="eventid" value=' . $id . '> --!>
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
}

?>
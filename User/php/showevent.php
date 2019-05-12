<?php
session_start();
include_once('../database.php');
$id = intval($_GET['id']);
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
?>
<script src="http://malsup.github.io/jquery.form.js" type="text/javascript"></script>
<div class="fancy">
    <h3>Event Detail</h3>
    <form id="add_form" action="do.php?action=edit" method="post">
        <input type="hidden" name="id" id="eventid" value="<?php echo $id; ?>">
        <p>Event Name：<input type="text" class="input" name="event" id="event" style="width:180px"
                             value="<?php echo $title; ?>" readonly></p>
        <p>Description：<input type="text" class="input" name="description" style="width:280px;height: 180px"
                              id="description" value="<?php echo $description; ?>" readonly>
        </p>
        <p>Facility：<input type="text" class="input" name="facility" style="width:180px;"
                           id="facility" value="<?php echo $facility; ?>" readonly>
        </p>
        <p>Start Time：<input type="text" class="input datepicker" name="startdate"
                             id="startdate" value="<?php echo $startdate; ?>" readonly>
        </p>
        <p>End Time：<input type="text" class="input datepicker" name="enddate" id="enddate"
                           value="<?php echo $enddate; ?>" readonly>
        </p>
        <p>Trainer Name：<input type="text" class="input" name="trainername" style="width:180px;"
                               id="trainername" value="<?php echo $firstname." ".$lastname; ?>" readonly>
        </p>
        <p>Contact：<textarea class="input" name="contact" style="width:180px"
                id="contact" readonly><?php echo "Email:".$email." Phone:".$phone; ?></textarea>
        </p>
    </form>
</div>
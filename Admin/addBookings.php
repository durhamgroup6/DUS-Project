<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";
$sql = "select FacilityID, FacilityName from facility where FacilityID IN(3,4,5,6)";
$facility = $pdo->query($sql);
$sqluser = "select UserID, Firstname, Lastname from user where Role!='admin'";
$user = $pdo->query($sqluser);
if(isset($_POST['submit'])){
    $facility=filter_input(INPUT_POST, 'facility', FILTER_SANITIZE_NUMBER_INT);
    $event=filter_input(INPUT_POST, 'event', FILTER_SANITIZE_NUMBER_INT);
    $userid=filter_input(INPUT_POST, 'user', FILTER_SANITIZE_NUMBER_INT);
    $start=filter_input(INPUT_POST, 'start', FILTER_SANITIZE_NUMBER_INT);
    $end=filter_input(INPUT_POST, 'end', FILTER_SANITIZE_NUMBER_INT);
    $price=filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
    $date=filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);;
    if(trim($facility)==""){
        ?>
        <script>
            window.alert("Please select Facility!");
            history.go(-1);
        </script>
        <?php
    }
    elseif (trim($userid)==""){
        ?>
        <script>
            window.alert("Please select User!");
            history.go(-1);
        </script>
        <?php
    }
    elseif (trim($price)==""){
        ?>
        <script>
            window.alert("Please Enter Price!");
            history.go(-1);
        </script>
        <?php
    }
    elseif (trim($date)==""){
        ?>
        <script>
            window.alert("Please select dates!");
            history.go(-1);
        </script>
        <?php
    }elseif (trim($start)==""){
        ?>
        <script>
            window.alert("Please select start time!");
            history.go(-1);
        </script>
        <?php
    }elseif (trim($end)==""){
        ?>
        <script>
            window.alert("Please select end time!");
            history.go(-1);
        </script>
        <?php
    }elseif ($end < $start){
        ?>
        <script>
            window.alert("Please select end time greater than start time!");
            history.go(-1);
        </script>
        <?php
    }
    else {
        if ($facility == 3) {
            $color = "yellow";
        } else if ($facility == 4) {
            $color = "blue";
        } else if ($facility == 5) {
            $color = "pink";
        } else if ($facility == 6) {
            $color = "orange";
        }
        $cf = "SELECT COUNT(BookDateID) AS count, facility.`Capacity` FROM booking LEFT JOIN facility ON facility.FacilityID = booking.FacilityID LEFT JOIN bookingdates ON bookingdates.BookingID= booking.BookingID WHERE booking.FacilityID = " . $facility . " AND booking.`is_cancel`=0";
        $Fcount = $pdo->query($cf);
        $FasCount = $Fcount->fetch(PDO::FETCH_ASSOC);
        $countck = ($end-$start)+$FasCount['count'];
        if ($FasCount['count']==0 || $countck <= $FasCount['Capacity']) {
            $startDate = $date . ' ' . $start;
            $endDate = $date . ' ' . $end;
            $stmt = "INSERT into booking (UserID, Price,StartTime,EndTime, FacilityID, color) VALUE (" . $userid . "," . $price . ", '" . $startDate . "','" . $endDate . "'," . $facility . ",'" . $color . "')";
            $pdo->exec($stmt);
            if ($pdo->lastInsertId() != null) {
                $bulkArr = '';
                $comm = '';
                $stmtboo = "Select BookingID from booking ORDER BY BookingID DESC LIMIT 1";
                $booking = $pdo->query($stmtboo);
                $bookingID = $booking->fetch(PDO::FETCH_ASSOC);
                if (count($bookingID) > 0) {
                    for ($time = $start; $time < $end; $time++) //loop over values
                    {
                        $time2 = $time+1;
                        $bulkArr .= '' . $comm . '(' . $bookingID['BookingID'] . ',"' . $date . ' ' . $time . '", "' . $date . ' ' . $time2 . '")';
                        $comm = ',';
                    }
                    $stmt = "INSERT into bookingdates (BookingID, StartTime, EndTime) VALUE " . $bulkArr . " ";
                    $pdo->exec($stmt);
                    if ($pdo->lastInsertId() != null) {
                        echo '<script>alert("Booking saved successfully!");</script>';
                        ?>
                        <script>
                            window.location.href = 'viewBookings.php';
                        </script>
                        <?php
                    }
                } else {
                    echo '<script>alert("Error saving Booking!");</script>';
                }
            } else {
                echo '<script>alert("Error saving Booking!");</script>';
            }
        }else{
            echo '<script>alert("Facility capacity is full yo can not add  more bookings!");
history.go(-1);</script>';
        }
    }
}
?>
<div class="main-content">
    <!-- header area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="nav-btn pull-left">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a> Bookings</a></li>
                        <li><span>Add Bookings</span></li>
                    </ul>
                </div>
            </div>
            <?php require_once('includes/adminInfo.php'); ?>
        </div>
    </div>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-body">
                        <h4 class="header-title">Add Booking</h4>
                        <form class="needs-validation" novalidate="" method="post" action="addBookings.php">
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom01">Facility</label>
                                    <select name="facility" onchange="FacilityDates(this.value)" class="form-control" id="validationCustom02" required>
                                        <option disabled selected value=""> Facility</option>
                                        <?php
                                        while ($row = $facility->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <option value="<?php echo $row['FacilityID'];?>"> <?php echo $row['FacilityName'];?></option>
                                        <?php }?>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">User</label>
                                    <select name="user" class="form-control" id="validationCustom02" required>
                                    <option disabled selected value=""> user</option>
                                    <?php
                                    while ($row = $user->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <option value="<?php echo $row['UserID'];?>"> <?php echo $row['Firstname'].' '.$row['Lastname'];?></option>
                                    <?php }?>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Price</label>
                                    <input class="form-control" name="price" type="number" placeholder="Price" id="validationCustom02" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Select Booking Date</label>
                                    <input type="text" class="form-control date" name="date" id="validationCustom02" placeholder="Select Booking Date" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Start Time</label>
                                    <div class='input-group' id='datetimepicker3'>
                                        <input type='text' class="form-control" name="start" id="validationCustom02" placeholder="Start time" required/>
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">End Time</label>
                                    <div class='input-group' id='datetimepicker4'>
                                        <input type='text' class="form-control" name="end" id="validationCustom02" placeholder="End time" required/>
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" name="submit" type="submit">Add Bookings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function FacilityDates(id){
        $.post("getBlockDates.php",{id: id},function(result){
            $('.date').datepicker('destroy');
                $('.date').datepicker({
                    startDate: new Date(),
                    multidate: false,
                    format: "yyyy-mm-dd",
                    daysOfWeekHighlighted: "5,6",
                    datesDisabled: result,
                    language: 'en'
                });
        });
    }

</script>
<?php require_once('includes/footer.php'); ?>

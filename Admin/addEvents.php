<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";
$sql = "select FacilityID, FacilityName from facility";
$facility = $pdo->query($sql);
$sqluser = "select UserID, Firstname, Lastname from user where Role='trainer'";
$trianer = $pdo->query($sqluser);
if(isset($_POST['submit'])){
    $name=filter_input(INPUT_POST, 'ename', FILTER_SANITIZE_STRING);
    $facility=filter_input(INPUT_POST, 'facility', FILTER_SANITIZE_NUMBER_INT);
    $trainer=filter_input(INPUT_POST, 'trainer', FILTER_SANITIZE_NUMBER_INT);
    $capacity=filter_input(INPUT_POST, 'capacity', FILTER_SANITIZE_NUMBER_INT);
    $dates=filter_input(INPUT_POST, 'dates', FILTER_SANITIZE_STRING);
    $start=filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
    $end=filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
    $description=filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $weekDay=filter_input(INPUT_POST, 'weekDay', FILTER_SANITIZE_NUMBER_INT);
    $color='#3c763d';
    if(empty($trainer)){
        $trainer = 'NULL';
    }
    if($weekDay == 0){
        $weekDay = 'NULL';
    }
    if(trim($name)==""){
        ?>
        <script>
            window.alert("Please Enter Event Name!");
            history.go(-1);
        </script>
        <?php
    }elseif (trim($facility)==""){
        ?>
        <script>
            window.alert("Please select Facility Price!");
            history.go(-1);
        </script>
        <?php
    }
    elseif (trim($capacity)==""){
        ?>
        <script>
            window.alert("Please Enter Capacity!");
            history.go(-1);
        </script>
        <?php
    }
    elseif (trim($start)==""){
        ?>
        <script>
            window.alert("Please Select start date!");
            history.go(-1);
        </script>
        <?php
    }
    elseif (trim($end)==""){
        ?>
        <script>
            window.alert("Please Select end date!");
            history.go(-1);
        </script>
        <?php
    }
    elseif (trim($description)==""){
        ?>
        <script>
            window.alert("Please Enter Facility Description!");
            history.go(-1);
        </script>
        <?php
    }else{
        $string = preg_replace('/\.$/', '', $dates);
        $array = explode(',', $string);
        $length = count($array);
        $startDate = $array[0] . ' ' . $start;
        $endDate = $array[$length - 1] . ' ' . $end;
        $stmt = "INSERT into event (EventName, TrainerID, StartDate, EndDate, Capacity, Description, FacilityID, color, WeekDate) VALUE ('".$name."', ".$trainer.",'".$startDate."','".$endDate."', ".$capacity.", '".$description."',".$facility.",'".$color."',".$weekDay.")";
        $pdo->exec($stmt);
        if($pdo->lastInsertId()!=null){
            $bulkArr = '';
            $comm = '';
            $stmtboo = "Select EventID from event ORDER BY EventID DESC LIMIT 1";
            $event = $pdo->query($stmtboo);
            $eventID = $event->fetch(PDO::FETCH_ASSOC);
            if (count($eventID) > 0) {
                foreach ($array as $value) //loop over values
                {
                    $bulkArr .= '' . $comm . '(' . $eventID['EventID'] . ',"' . $value . ' ' . $start . '", "' . $value . ' ' . $end . '")';
                    $comm = ',';
                }
                $stmt = "INSERT into eventdates (EventID, StartTime, EndTime) VALUE " . $bulkArr . " ";
                $pdo->exec($stmt);
                if ($pdo->lastInsertId() != null) {
                    echo '<script>alert("Event added successfully!");</script>';
                    ?>
                    <script>
                        window.location.href = 'viewEvents.php';
                    </script>
                    <?php
                }
            }else {
                echo '<script>alert("Error adding Event!");</script>';
            }
        } else {
            echo '<script>alert("Error adding Event!");</script>';
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
                        <li><a> Events</a></li>
                        <li><span>Add Events</span></li>
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
                        <h4 class="header-title">Add Event</h4>
                        <form class="needs-validation" novalidate="" method="post" action="addEvents.php">
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Facility</label>
                                    <select name="facility" class="form-control" id="validationCustom02" required>
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
                                    <label for="validationCustom02">Event Name</label>
                                    <input type="text" name="ename" class="form-control" id="validationCustom02" placeholder="Event name" required="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Trainer</label>
                                    <select name="trainer" class="form-control" id="validationCustom02">
                                        <option disabled selected value=""> Trainer</option>
                                        <?php
                                        while ($row = $trianer->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <option value="<?php echo $row['UserID'];?>"> <?php echo $row['Firstname'].' '.$row['Lastname'];?></option>
                                        <?php }?>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Capacity</label>
                                    <input type="number" name="capacity" class="form-control" id="validationCustom02" placeholder="Capacity" required="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Day of the week</label>
                                    <select name="weekDay" class="form-control" id="validationCustom02" required>
                                        <option disabled selected value=""> Select day</option>
                                        <option value="1"> Every Monday</option>
                                        <option value="2"> Every Tuesday</option>
                                        <option value="3"> Every Wednesday</option>
                                        <option value="4"> Every Thursday</option>
                                        <option value="5"> Every Friday</option>
                                        <option value="6"> Every Saturday</option>
                                        <option value="7"> Every Sunday</option>
                                        <option value="0"> Every Day</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-9 mb-3">
                                    <label for="validationCustom02">Select Booking Dates</label>
                                    <input type="text" class="form-control date" name="dates" id="validationCustom02" placeholder="Pick the multiple dates" required>
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
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Description</label>
                                    <textarea class="form-control" name="description" required=""></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary" name="submit" type="submit">Add Event</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>

<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";$sql = "select FacilityID, FacilityName from facility";
$facility = $pdo->query($sql);
$sqluser = "select UserID, Firstname, Lastname from user where Role='trainer'";
$trianer = $pdo->query($sqluser);
if(isset($_POST['submit'])){
    $name=filter_input(INPUT_POST, 'ename', FILTER_SANITIZE_STRING);
    $facility=filter_input(INPUT_POST, 'facility', FILTER_SANITIZE_NUMBER_INT);
    $trainer=filter_input(INPUT_POST, 'trainer', FILTER_SANITIZE_NUMBER_INT);
    $capacity=filter_input(INPUT_POST, 'capacity', FILTER_SANITIZE_NUMBER_INT);
    $start=filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_STRING);
    $end=filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_STRING);
    $description=filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $weekDay=filter_input(INPUT_POST, 'weekDay', FILTER_SANITIZE_NUMBER_INT);
    $color=$_POST['color'];
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
        $stmt = "INSERT into event (EventName, TrainerID, StartDate, EndDate, Capacity, Description, FacilityID, color, WeekDate) VALUE ('".$name."', ".$trainer.",'".$start."','".$end."', ".$capacity.", '".$description."',".$facility.",'".$color."',".$weekDay.")";
        $pdo->exec($stmt);
        if($pdo->lastInsertId()!=null){
            echo '<script>alert("Event added successfully!");</script>';
            ?>
            <script>
                window.location.href = 'viewEvents.php';
            </script>
            <?php
        }else{
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
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Start Date</label>
                                    <input class="form-control" name="startdate" type="datetime-local" placeholder="select start date" id="validationCustom02" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">End Date</label>
                                    <input class="form-control" name="enddate" type="datetime-local" placeholder="select start date" id="validationCustom02" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Select Color</label>
                                    <input class="form-control" style="height:46px;" name="color" type="color" value="" id="validationCustom02" required>
                                    <div class="valid-feedback">
                                        Looks good!
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

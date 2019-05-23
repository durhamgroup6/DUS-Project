<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";
if(isset($_POST['submit'])){
    $bulkArr= '';
    $color='#FF0000';
    $facilityId = $_GET['id'];
    $start=filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
    $end=filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
    if(trim($_POST['dates'])==""){
        ?>
        <script>
            window.alert("Please select Block Dates!");
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
    }else {
        $string = preg_replace('/\.$/', '', $_POST['dates']); //Remove dot at end if exists
        $array = explode(',', $string);
        $comm = '';
        foreach ($array as $value) //loop over values
        {
            $bulkArr .= '' . $comm . '(' . $facilityId . ',"'.$color.'","' . $value.' '.$start.'","' . $value.' '.$end . '" )';
            $comm = ',';
        }
        $stmt = "INSERT into blockbookings (FacilityID, color, StartTime, EndTime) VALUE " . $bulkArr . " ";
        $pdo->exec($stmt);
        if ($pdo->lastInsertId() != null) {
            echo '<script>alert("Block dates added successfully!");</script>';
            ?>
            <script>
                window.location.href = 'viewEvents.php';
            </script>
            <?php
        } else {
            echo '<script>alert("Error adding Block dates!");</script>';
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
                        <li><span>Block Bookings</span></li>
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
                        <h4 class="header-title">Block Booking</h4>
                        <form class="needs-validation" novalidate="" method="post" action="blockBooking.php?id=<?php echo $_GET['id'];?>">
                            <div class="form-row">
                                <div class="col-md-10 mb-3">
                                    <label for="validationCustom02">Select Block Dates</label>
                                    <input type="text" class="form-control date" name="dates" readonly id="validationCustom02" placeholder="Pick the multiple dates" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">Start Time</label>
                                    <div class='input-group' id='datetimepicker3'>
                                        <input type='text' class="form-control" name="start" id="validationCustom02" placeholder="Pick the multiple dates" required/>
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">End Time</label>
                                    <div class='input-group' id='datetimepicker4'>
                                        <input type='text' class="form-control" name="end" id="validationCustom02" placeholder="Pick the multiple dates" required/>
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" name="submit" type="submit">Block</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>

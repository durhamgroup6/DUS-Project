<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";
$sql = "SELECT event.EventName, event.EventID, event.StartDate, event.EndDate, event.Capacity, event.Description, user.Firstname, user.Lastname, facility.FacilityName, event.WeekDate FROM event LEFT JOIN facility ON event.FacilityID=facility.FacilityID LEFT JOIN user ON user.UserID = event.TrainerID";
$event = $pdo->query($sql);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    echo $id;
    $sql = "delete from facility where FacilityID = ".$id." ";
    $del = $pdo->exec($sql);
    if($del == 1){
        echo '<script>alert("Facility deleted successfully!");</script>';
        ?>
        <script>
            history.go(-1);
        </script>
        <?php
    }else{
        echo '<script>alert("Error deleting facility!");</script>';
        ?>
        <script>
            history.go(-1);
        </script>
        <?php
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
                        <li><span>View Events</span></li>
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
                        <h4 class="header-title">View Events</h4>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>Name</th>
                                    <th>Facility</th>
                                    <th>Description</th>
                                    <th>Trainer</th>
                                    <th>Capacity</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Week Day</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = $event->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['EventName']; ?></td>
                                        <td><?php echo $row['FacilityName']; ?></td>
                                        <td><?php echo $row['Description']; ?></td>
                                        <td><?php echo $row['Firstname'].' '.$row['Lastname'] ; ?></td>
                                        <td><?php echo $row['Capacity']; ?></td>
                                        <td><?php echo $row['StartDate'];?></td>
                                        <td><?php echo $row['EndDate'];?></td>
                                        <td><?php if($row['WeekDate'] == 1){echo 'Every Monday';}
                                            if($row['WeekDate'] == 2){echo 'Every Tuesday';}
                                            if($row['WeekDate'] == 3){echo 'Every Wednesday';}
                                            if($row['WeekDate'] == 4){echo 'Every Thursday';}
                                            if($row['WeekDate'] == 5){echo 'Every Friday';}
                                            if($row['WeekDate'] == 6){echo 'Every Saturday';}
                                            if($row['WeekDate'] == 7){echo 'Every Sunday';}
                                            if($row['WeekDate'] == 0){echo 'Every Day';}
                                        ;?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function deletefac(id){
        var result = confirm('Are you sure you want to delete this facility');
        if(result === true){
            window.location.href = 'viewFacilties.php?id='+id
        }
    }
    function editfac(id) {
        window.location.href = 'editFacilities.php?id='+id
    }
</script>
<?php require_once('includes/footer.php'); ?>

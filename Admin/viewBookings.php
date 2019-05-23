<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";
$sql = "SELECT user.Firstname, user.Lastname, facility.FacilityName, booking.Price,booking.is_cancel,booking.StartTime,booking.EndTime,booking.BookingID, booking.FacilityID,booking.UserID FROM booking LEFT JOIN facility ON booking.FacilityID=facility.FacilityID LEFT JOIN user ON user.UserID = booking.UserID";
$booking = $pdo->query($sql);
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $upcan = "update booking set is_cancel = 1 where BookingID = ".$id." ";
    $can = $pdo->exec($upcan);
    if($can == 1){
        include_once "includes/sendEmail.php";
        $sqlus = "SELECT user.Firstname, user.Lastname, user.Email, facility.FacilityName, booking.Price,booking.StartTime,booking.EndTime FROM booking LEFT JOIN facility ON booking.FacilityID=facility.FacilityID LEFT JOIN user ON user.UserID = booking.UserID where booking.BookingID = ".$id." ";
        $user = $pdo->query($sqlus);
        $UserData = $user->fetch(PDO::FETCH_ASSOC);
        $email = $UserData['Email'];
        $subject = 'Booking Cancellation';
        $body = '<p>Dear, </p> <p>'.$UserData['Firstname'].' </p> <p>This is to inform you that your booking for '.$UserData['FacilityName'].' facility from '.$UserData['StartTime'].' to '.$UserData['EndTime'].' is cancelled on your request <p>Thanks</p><p>Team Durhum</p>';
        sendmail($email, $subject, $body);
        echo '<script>alert("Booking Cancelled successfully!");</script>';
        ?>
        <script>
            history.go(-1);
        </script>
        <?php
    }else{
        echo '<script>alert("Error Cancelling Booking!");</script>';
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
                        <li><a> Bookings</a></li>
                        <li><span>View Bookings</span></li>
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
                        <h4 class="header-title">View Bookings</h4>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>Facility</th>
                                    <th>User</th>
                                    <th>Price</th>
                                    <th>StartDate</th>
                                    <th>EndDate</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = $booking->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['FacilityName']; ?></td>
                                        <td><?php echo $row['Firstname'].' '.$row['Lastname'] ; ?></td>
                                        <td><?php echo $row['Price']; ?></td>
                                        <td><?php echo $row['StartTime']; ?></td>
                                        <td><?php echo $row['EndTime']; ?></td>
                                        <td><?php if($row['is_cancel'] == 1){echo 'Cancelled';}else{echo'Active';}?></td>
                                        <td><?php if($row['is_cancel'] == 1){echo '-------';}else{ ?>
                                            <button onclick="cancelbook(<?php echo $row['BookingID']; ?>)" class="btn btn-flat btn-danger btn-xs mb-3">Cancel</button>
                                        <?php }?></td>

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
    function cancelbook(id){
        var result = confirm('Are you sure you want to cancel this booking');
        if(result === true){
            window.location.href = 'viewBookings.php?id='+id
        }
    }
</script>
<?php require_once('includes/footer.php'); ?>

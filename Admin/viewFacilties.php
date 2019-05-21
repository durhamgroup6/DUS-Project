<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";
$sql = "select * from facility ";
$facility = $pdo->query($sql);
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
                        <li><a> Facilities</a></li>
                        <li><span>View Facilities</span></li>
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
                        <h4 class="header-title">View Facilities</h4>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Capacity</th>
                                    <th>Availability</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = $facility->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['FacilityName']; ?></td>
                                        <td><?php echo $row['Description']; ?></td>
                                        <td><?php echo $row['Price']; ?></td>
                                        <td><?php echo $row['Capacity']; ?></td>
                                        <td><?php if($row['Availability'] == 1){
                                            echo "Available";
                                            }else{
                                                echo "Unavailable";
                                            } ?></td>
                                        <td><img src="facilityImages/<?php echo $row['PicURL']; ?>" style="width: 100px;"/></td>
                                        <td><button type="button" onclick="editfac(<?php echo $row['FacilityID']; ?>)" class="btn btn-flat btn-info btn-xs mb-3"><i class="fa fa-edit"></i></button>
                                            <button onclick="deletefac(<?php echo $row['FacilityID']; ?>)" class="btn btn-flat btn-danger btn-xs mb-3"><i class="fa fa-trash"></i></button>
                                            <button type="button" onclick="blockbook(<?php echo $row['FacilityID']; ?>)" class="btn btn-flat btn-info btn-xs mb-3">Block</button></td>
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
    function blockbook(id) {
        window.location.href = 'blockBooking.php?id='+id
    }
</script>
<?php require_once('includes/footer.php'); ?>

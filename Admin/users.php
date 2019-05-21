<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $role = $_GET['role'];
    $sql = "update user set Role='".$role."' where UserID = ".$id." ";
    $del = $pdo->exec($sql);
    if($del == 1){
        echo '<script>alert("User role updated successfully!");</script>';
        ?>
        <script>
            history.go(-1);
        </script>
        <?php
    }else{
        echo '<script>alert("Error updating user role!");</script>';
        ?>
        <script>
            history.go(-1);
        </script>
        <?php
    }
}
$sql = "select * from user ";
$users = $pdo->query($sql);
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
                        <li><a> Users</a></li>
                        <li><span>View Users</span></li>
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
                        <h4 class="header-title">View Users</h4>
                        <div class="data-tables datatable-primary">
                            <table id="dataTable2" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Firstname']; ?></td>
                                        <td><?php echo $row['Lastname']; ?></td>
                                        <td><?php echo $row['Email']; ?></td>
                                        <td><?php echo $row['Phone']; ?></td>
                                        <td><?php echo $row['Role']; ?></td>
                                        <td><button class="btn btn-flat btn-info btn-xs mb-3 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Change Role</button>
                                            <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <?php if($row['Role'] !== 'admin'){?><a class="dropdown-item" onclick="changeRole(<?php echo $row['UserID']; ?>, 'admin')">Admin</a><?php } ?>
                                                <?php if($row['Role'] !== 'user'){?><a class="dropdown-item" onclick="changeRole(<?php echo $row['UserID']; ?>, 'user')">User</a><?php } ?>
                                                <?php if($row['Role'] !== 'trainer'){?><a class="dropdown-item" onclick="changeRole(<?php echo $row['UserID']; ?>, 'trainer')">Trainer</a><?php } ?>
                                            </div>
                        </div></td>
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
    function changeRole(id, role){
        var result = confirm('Are you sure you want to change user role');
        if(result === true){
            window.location.href = 'users.php?id='+id+'&role='+role
        }
    }
</script>
<?php require_once('includes/footer.php'); ?>

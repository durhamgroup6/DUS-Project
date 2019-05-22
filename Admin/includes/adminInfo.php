<div class="col-sm-6 clearfix">
    <div class="user-profile pull-right">
        <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']['Firstname']. ' ' . $_SESSION['user']['Lastname']; ?> <i class="fa fa-angle-down"></i></h4>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="../index.php">Log Out</a>
            <a class="dropdown-item" href="../User/PersonalDetail.php">Profile Update</a>
            <a class="dropdown-item" href="../index.php">User area</a>
        </div>
    </div>
</div>

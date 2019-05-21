<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";
if(isset($_POST['submit'])){
    $name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $price=filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
    $capacity=filter_input(INPUT_POST, 'capacity', FILTER_SANITIZE_NUMBER_INT);
    $availability=filter_input(INPUT_POST, 'availability', FILTER_SANITIZE_NUMBER_INT);
    $description=filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    if(trim($name)==""){
        ?>
        <script>
            window.alert("Please Enter Facility Name!");
            history.go(-1);
        </script>
        <?php
    }elseif (trim($price)==""){
        ?>
        <script>
            window.alert("Please Enter Facility Price!");
            history.go(-1);
        </script>
        <?php
    }
    elseif (trim($capacity)==""){
        ?>
        <script>
            window.alert("Please Enter Facility Capacity!");
            history.go(-1);
        </script>
        <?php
    }
    elseif (trim($availability)==""){
        ?>
        <script>
            window.alert("Please Select Facility Availability!");
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
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
        move_uploaded_file($file_tmp,"facilityImages/".$file_name);
        $stmt = "INSERT into facility (FacilityName, Description, Price, Capacity, Availability, PicURL) VALUE ('".$name."', '".$description."','".$price."', '".$capacity."', '".$availability."', '".$file_name."')";
        $pdo->exec($stmt);
        if($pdo->lastInsertId()!=null){
            echo '<script>alert("Facility added successfully!");</script>';
            ?>
            <script>
                window.location.href = 'viewFacilties.php';
            </script>
            <?php
        }else{
            echo '<script>alert("Error adding facility!");</script>';
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
                        <li><a> Facilities</a></li>
                        <li><span>Add Facilities</span></li>
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
                        <h4 class="header-title">Add Facility</h4>
                        <form class="needs-validation" novalidate="" enctype="multipart/form-data" method="post" action="addFacilities.php">
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom01">Facility name</label>
                                    <input type="text" name="name" class="form-control" id="validationCustom01" placeholder="Name" required="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Price</label>
                                    <input type="number" name="price" class="form-control" id="validationCustom02" placeholder="Price" value="Otto" required="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Capacity</label>
                                    <input type="number" name="capacity" class="form-control" id="validationCustom02" placeholder="Capacity" value="Otto" required="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom02">Availability</label>
                                    <select name="availability" class="form-control" id="validationCustom02" required>
                                        <option disabled selected value=""> Availability</option>
                                        <option value="1"> Available</option>
                                        <option value="0"> Unavailable</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom03">Image</label>
                                    <input type="file" name="image" class="form-control" id="validationCustom02" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">Description</label>
                                    <textarea class="form-control" name="description" required=""></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary" name="submit" type="submit">Add Facility</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('includes/footer.php'); ?>

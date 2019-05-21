<?php
require_once('includes/header.php');
require_once('includes/navigation.php');
include_once "../User/database/database.php";
$sql = "select FacilityID, FacilityName from facility where FacilityID IN(3,4,5,6)";
$facility = $pdo->query($sql);
?>
<script>
    function getDates(request) {
        document.addEventListener('DOMContentLoaded', function () {
            $.post("getBookings.php", request, function (result) {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    defaultDate: new Date(),
                    editable: false,
                    navLinks: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: JSON.parse(result)
                });

                calendar.render();
            });
        });
    }
</script>
<style>

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #script-warning {
        display: none;
        background: #eee;
        border-bottom: 1px solid #ddd;
        padding: 0 10px;
        line-height: 40px;
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        color: red;
    }

    #loading {
        display: none;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    #calendar {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 10px;
    }

</style>
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
            <div class="col-12" style="padding-left: 0;padding-right: 0;">
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="col-md-3 mb-3"></div>
                        <div class="col-md-6 mb-3" style="text-align: center;">
                            <label for="validationCustom01" style="font-weight: bold;padding-top: 20px;">Select Facility to view bookings and block dates</label>
                            <select name="facility" onchange="FacilityId(this.value)" class="form-control" id="validationCustom02" required>
                                <option value="all" selected> All Facilities</option>
                                <?php
                                while ($row = $facility->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <option value="<?php echo $row['FacilityID'];?>" <?php if(isset($_GET['id'])  && $row['FacilityID'] == $_GET['id']){ echo 'selected';}?>> <?php echo $row['FacilityName'];?></option>
                                <?php }?>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" style="background: white;">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
<script>
    var request = {};
    if(window.location.href.indexOf('id')>0){
        var url = window.location.href;
        var id = url.substring(url.indexOf('=')+ 1);
        request= {id: id}
    }
    getDates(request);
    function FacilityId(id){
        if(id == 'all'){
            window.location.href = "index.php";
        }else{
            window.location.href = "index.php?id="+id;
        }
    }
</script>
<?php require_once('includes/footer.php'); ?>


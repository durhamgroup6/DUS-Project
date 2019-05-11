<?php
$id = intval($_GET['id']);
$db_host = 'mysql:host=localhost';
$db_name = 'dbname=CalendarTest';
$db_user = 'root';
$db_pass = '';
$pdo = new PDO($db_host . ';' . $db_name, $db_user, $db_pass, array(PDO::ATTR_PERSISTENT => true));
$sql = "select * from event where  EventID = '$id'";
$result = $pdo->query($sql);
$row =  $result->fetch(PDO::FETCH_ASSOC);
if($row){
    $id = $row['EventID'];
    $title = $row['EventName'];
    $description = $row['Description'];
    $startdate = $row['StartTime'];
    $start_d = date("Y-m-d",strtotime($startdate));
    $start_t = date("H:i:s",strtotime($startdate));
    $enddate = $row['EndTime'];
    $end_d = date("Y-m-d",strtotime($enddate));
    $end_t = date("H:i:s",strtotime($enddate));
}
?>
<script src="http://malsup.github.io/jquery.form.js" type="text/javascript"></script>
<div class="fancy">
    <h3>Event Detail</h3>
    <form id="edit_form" action="php/do.php" method="post">
        <input type="hidden" name="id" id="eventid" value="<?php echo $id;?>">
        <p>Event Name：<input type="text" class="input" name="event" id="event" style="width:180px"
                             value="<?php echo $title;?>"></p>
        <p>Description：<input type="text" class="input" name="description" style="width:280px;height: 180px"
                              id="description" value="<?php echo $description;?>">
        </p>
        <p>Start Date：<input type="datetime-local" step="01" class="input datepicker" name="startdate"
                             id="startdate" value="<?php echo "{$start_d}T{$start_t}";?>">
        </p>
        <p>End Date：<input type="datetime-local" step="01" class="input datepicker" name="enddate" id="enddate" value="<?php echo "{$end_d}T{$end_t}";?>">
        </p>
        <div class="sub_btn"><input type="submit" name="submit" class="btn btn_ok" value="Update"><input type="submit" name="submit" class="btn btn_del" id="del_event"
                                                      value="Delete">
            </div>
    </form>
</div>
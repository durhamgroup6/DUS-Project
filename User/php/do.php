<?php
include_once('../database/database.php');//连接数据库

    $eventid = $_POST['id'];
    $eventname = stripslashes(trim($_POST['event']));//事件内容
    $description = $_POST['description'];
    $startdate = $_POST['startdate'];//开始日期
    $enddate = $_POST['enddate'];//结束日期

//    $s_time = $_POST['s_hour'].':'.$_POST['s_minute'].':00';//开始时间
//    $e_time = $_POST['e_hour'].':'.$_POST['e_minute'].':00';//结束时间


//    $colors = array("#360","#f30","#06c");
//    $key = array_rand($colors);
//    $color = $colors[$key];

if(isset($_POST['submit'])&&$_POST['submit']=='Update') {
    $sql = "UPDATE Event SET EventName='$eventname',TrainerID='2',Capacity='3',Description='$description',StartTime='$startdate',EndTime='$enddate',allday='0',FacilityID='2'  where  EventID = '$eventid'";
    if ($pdo->query($sql)) {
        echo "<script>alert('update success！'); history.go(-1);</script>";
    } else {
        echo "<script>alert('update fail！'); history.go(-1);</script>";
    }
}elseif(isset($_POST['submit'])&&$_POST['submit']=='Delete'){
        $sql="delete from Event where EventID='$eventid'";
        if($pdo->query($sql)){
            echo "<script>alert('delete success！'); history.go(-1);</script>";
        }else{
            echo "<script>alert('delete fail！'); history.go(-1);</script>";
        }
}
?>
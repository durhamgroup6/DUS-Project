<?php
include_once('../database.php');//connect database

$sql = "select * from event";
$result = $pdo->query($sql);
while($row = $result->fetch(PDO::FETCH_ASSOC)){
//    $allday = $row['allday'];
//    $is_allday = $allday==1?true:false;
    $data[] = array(
        'id' => $row['EventID'],//event id
        'title' => $row['EventName'],//event name
//        'allday' => $is_allday, //is all day event
        'start' => $row['StartDate'],//event start date time
        'end' => $row['EndDate'],//event start date time
    );
}
echo json_encode($data);
?>
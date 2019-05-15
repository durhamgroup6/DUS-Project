<?php
include_once('../database/database.php');//connect database

$sql_event = "select * from event";
$sql_book = "select * from booking as b left join facility as f on f.FacilityID = b.FacilityID";
$result_event = $pdo->query($sql_event);
$result_book = $pdo->query($sql_book);
while ($row = $result_event->fetch(PDO::FETCH_ASSOC)) {
//    $allday = $row['allday'];
//    $is_allday = $allday==1?true:false;
    $start_d = date("Y-m-d", strtotime($row['StartDate']));
    $start_t = date("H:i:s", strtotime($row['StartDate']));
    $end_d = date("Y-m-d", strtotime($row['EndDate']));
    $end_t = date("H:i:s", strtotime($row['EndDate']));
    if($row['WeekDate']!=null) {
        $data[] = array(
            'id' => $row['EventID'],//event id
            'title' => $row['EventName'],//event name
            'start' =>$start_t,//event start date time
            'end' => $start_t,//event start date time
            'color' => $row['color'],
            'dow' => [$row['WeekDate']],
            'dowstart' => $start_d,
            'dowend' => $end_d
        );
    }else{
        $data[] = array(
            'id' => $row['EventID'],//event id
            'title' => $row['EventName'],//event name
            'start' => $row['StartDate'],//event start date time
            'end' => $row['EndDate'],//event start date time
            'color' => $row['color']
        );
    }
}
while ($row = $result_book->fetch(PDO::FETCH_ASSOC)) {
    $data[] = array(
        'id' => $row['BookingID'],//event id
        'title' => $row['FacilityName'],//event name
        'start' => $row['StartTime'],//event start date time
        'end' => $row['EndTime'],//event start date time
        'color' => $row['color']
    );
}
echo json_encode($data);
?>
<?php
include_once('../database/database.php');//connect database

$sql_event = "select * from event";
$sql_book = "select * from booking as b left join facility as f on f.FacilityID = b.FacilityID";
$result_event = $pdo->query($sql_event);
$result_book = $pdo->query($sql_book);
while ($row = $result_event->fetch(PDO::FETCH_ASSOC)) {
//    $allday = $row['allday'];
//    $is_allday = $allday==1?true:false;
    $data[] = array(
        'id' => $row['EventID'],//event id
        'title' => $row['EventName'],//event name
//        'allday' => $is_allday, //is all day event
        'start' => $row['StartDate'],//event start date time
        'end' => $row['EndDate'],//event start date time
        'color' => $row['color']
    );
}
while ($row = $result_book->fetch(PDO::FETCH_ASSOC)) {
//    for ($i = 0; $i < count($row)-1; $i++) {
//            if ($row[$i]['FacilityName'] == $row[$j]['FacilityName'] && $row[$i]['StartTime'] != $row[$j]['StartTime']) {
//                $data[] = array(
//                    'id' => $row[$i]['BookingID'],//event id
//                    'title' => $row[$i]['FacilityName'],//event name
//                    'start' => $row[$i]['StartTime'],//event start date time
//                    'end' => $row[$i]['EndTime'],//event start date time
//                    'color' => $row[$i]['color']
//                );
//        }
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
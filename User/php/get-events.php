<?php
include_once('../database/database.php');//connect database

$sql_event = "select * from event";
$sql_eventdates = "select * from event as e left join eventdates as ed on e.EventID=ed.EventID";
$sql_blockbooking = "select * from blockbookings as b left join facility as f on b.facilityID = f.FacilityID";
$sql_book = "SELECT bd.StartTime,bd.EndTime,bd.BookDateID,b.Price,f.FacilityName,b.is_cancel,u.Firstname,u.Lastname,b.color FROM bookingdates as bd left join booking as b on bd.BookingID=b.BookingID LEFT join facility as f on f.FacilityID=b.FacilityID left JOIN user as u on u.UserID=b.UserID where b.is_cancel='0'";
$result_event = $pdo->query($sql_event);
$result_eventdates = $pdo->query($sql_eventdates);
$result_block = $pdo->query($sql_blockbooking);
$result_book = $pdo->query($sql_book);
//while ($row = $result_event->fetch(PDO::FETCH_ASSOC)) {
////    $allday = $row['allday'];
////    $is_allday = $allday==1?true:false;
//    $start_d = date("Y-m-d", strtotime($row['StartDate']));
//    $start_t = date("H:i:s", strtotime($row['StartDate']));
//    $end_d = date("Y-m-d", strtotime($row['EndDate']));
//    $end_t = date("H:i:s", strtotime($row['EndDate']));
//    if($row['WeekDate']!=null) {
//        $data[] = array(
//            'id' => $row['EventID'],//event id
//            'title' => $row['EventName'],//event name
//            'start' =>$start_t,//event start date time
//            'end' => $start_t,//event start date time
//            'color' => $row['color'],
//            'dow' => [$row['WeekDate']],
//            'dowstart' => $start_d,
//            'dowend' => $end_d,
//            'type'=>"event"
//        );
//    }else{
//        $data[] = array(
//            'id' => $row['EventID'],//event id
//            'title' => $row['EventName'],//event name
//            'start' => $row['StartDate'],//event start date time
//            'end' => $row['EndDate'],//event start date time
//            'color' => $row['color'],
//            'type'=>"event"
//        );
//    }
//}
while ($row = $result_book->fetch(PDO::FETCH_ASSOC)) {
    $data[] = array(
        'id' => $row['BookDateID'],//event id
        'title' => $row['FacilityName'],//event name
        'start' => $row['StartTime'],//event start date time
        'end' => $row['EndTime'],//event start date time
        'color' => $row['color'],
        'type'=>"book"
    );
}

while ($row = $result_block->fetch(PDO::FETCH_ASSOC)) {
    $data[] = array(
        'id' => $row['BlockID'],//block id
        'title' => $row['FacilityName'],//facility name
        'start' => $row['StartTime'],//event start date time
        'end' => $row['EndTime'],//event start date time
        'color' => $row['color'],
        'type'=>"block"
    );

}
while ($row = $result_eventdates->fetch(PDO::FETCH_ASSOC)) {
    $data[] = array(
        'id' => $row['EventDateID'],//block id
        'title' => $row['EventName'],//facility name
        'start' => $row['StartTime'],//event start date time
        'end' => $row['EndTime'],//event start date time
        'color' => $row['color'],
        'type'=>"event"
    );

}
echo json_encode($data);
?>
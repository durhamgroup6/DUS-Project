<?php
include_once "../User/database/database.php";
?>

<?php
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $sql = "SELECT booking.BookingID AS id, FacilityName AS title, bookingdates.StartTime AS start, bookingdates.EndTime AS end, booking.color FROM facility LEFT JOIN booking ON facility.`FacilityID` = booking.`FacilityID` LEFT JOIN bookingdates ON bookingdates.`BookingID` = booking.`BookingID` WHERE bookingdates.`BookDateID` IS NOT NULL AND booking.`is_cancel`=0 AND facility.`FacilityID` = ".$id." UNION SELECT facility.FacilityID AS id, FacilityName AS title, StartTime AS start, EndTime AS end, blockbookings.`color` FROM facility LEFT JOIN blockbookings ON blockbookings.`FacilityID` = facility.`FacilityID` WHERE BlockID IS NOT NULL AND facility.`FacilityID` = ".$id." UNION SELECT event.EventID AS id, EventName AS title, event.StartDate AS start, event.EndDate AS end, event.`color` FROM facility LEFT JOIN event ON event.`FacilityID` = facility.`FacilityID` WHERE event.EventID IS NOT NULL AND facility.`FacilityID` = ".$id."";
}else{
    $sql = "SELECT booking.BookingID AS id, FacilityName AS title, bookingdates.StartTime AS start, bookingdates.EndTime AS end, booking.color FROM facility LEFT JOIN booking ON facility.`FacilityID` = booking.`FacilityID` LEFT JOIN bookingdates ON bookingdates.`BookingID` = booking.`BookingID` WHERE bookingdates.`BookDateID` IS NOT NULL AND booking.`is_cancel`=0 UNION SELECT facility.FacilityID AS id, FacilityName AS title, StartTime AS start, EndTime AS end, blockbookings.`color` FROM facility LEFT JOIN blockbookings ON blockbookings.`FacilityID` = facility.`FacilityID` WHERE BlockID IS NOT NULL UNION SELECT event.EventID AS id, EventName AS title, eventdates.StartTime AS start, eventdates.EndTime AS end, event.`color` FROM facility LEFT JOIN event ON event.`FacilityID` = facility.`FacilityID` LEFT JOIN eventdates ON event.EventID = eventdates.EventID WHERE event.EventID IS NOT NULL";
}
$BlockDates = $pdo->query($sql);
$datesArr = [];
while ($row = $BlockDates->fetch(PDO::FETCH_ASSOC)) {
    $row['textColor'] = 'black';
    array_push($datesArr, $row);
}
print_r(json_encode($datesArr));
?>
<?php
include_once "../User/database/database.php";
?>

<?php
$id = $_REQUEST['id'];
$sql = "select DATE_FORMAT(StartTime,'%Y-%m-%d') as blockDate from blockbookings where FacilityID=".$id." ";
$BlockDates = $pdo->query($sql);
$datesArr = [];
while ($row = $BlockDates->fetch(PDO::FETCH_ASSOC)) {
    array_push($datesArr, $row['blockDate']);
}
print_r(json_encode($datesArr));
?>

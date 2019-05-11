<?php
/**
 * Created by PhpStorm.
 * User: 陈子峰
 * Date: 2019/5/9
 * Time: 11:18
 */
require_once 'database.php';
//$record = $pdo->query("SELECT game.gameName,record.time,record.result FROM competition JOIN record ON record.competitionid = competition.competitionid JOIN game ON competition.gameid = game.gameid WHERE userid = '".$_SESSION['user']['userid'AND game.rank<=7]."';");
$facility=filter_input(INPUT_POST, 'facility', FILTER_SANITIZE_STRING);
$search = $pdo->query("SELECT * FROM facility WHERE FacilityName LIKE '%".$facility."%';");
if(empty($search)){
    ?>
    <script>
        window.alert("No such facility is found!");
        location.href="index.html";
    </script>
    <?php
    die();
}
?>

<html>
<head>
    <title>Facility searched</title>
</head>
<body>
<div class="wrapper">
    <div class="search_facility">
        <table border="1">
            <tr>
                <th>Facility</th>
                <th>Description</th>
                <th>Image</th>
                <th>Maximum Capacity</th>
                <th>Availability</th>
            </tr>
            <?php
            while($row=$search->fetch(PDO::FETCH_ASSOC)){
                //$id = $row['FacilityID'];
                $facilityName = $row['FacilityName'];
                $description = $row['Description'];
                $picURL = $row['PicURL'];
                $capacity = $row['Capacity'];
                $availability = $row['Availability'];

                echo "<tr>
                        <td>$facilityName</td>
                        <td>$description</td>
                        <td>$picURL</td>
                        <td>$capacity</td>
                        <td>$availability</td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
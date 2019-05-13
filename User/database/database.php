<?php
$db_host = 'mysql:host=localhost';
$db_name = 'dbname=teamdurham';
$db_user = 'root';
$db_pass = '';
$pdo = new PDO($db_host . ';' . $db_name, $db_user, $db_pass, array(PDO::ATTR_PERSISTENT => true));

function make_database_connection()
{
    $db_host = 'mysql:host=localhost';
    $db_name = 'dbname=teamdurham';
    $db_user = 'root';
    $db_pass = '';
    $pdo = new PDO($db_host . ';' . $db_name, $db_user, $db_pass, array(PDO::ATTR_PERSISTENT => true));
    return $pdo;
}

function showfacilities()
{
    $pdo = make_database_connection();
    $sql = "select * from facility ";
    $facility = $pdo->query($sql);
    while ($row = $facility->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="cell">';
        echo '<div class="image"><img src="images/' . $row['FacilityName'] . '.jpg"></a></div>';
        echo '<div align="center"><table style="width: 220px;text-align: center"><tr>
                    <th style="font-size: 1.8em">' . $row['FacilityName'] . '</th>
                    </tr>
                    <tr>
                    <td style="font-size: 1.2em"><textarea name="reworkmes" cols="40" rows="4" style="overflow:scroll; overflow-x: hidden;" readonly>' . $row['Description'] . '</textarea></td>
                    </tr></table></div>';
        echo '</div>';
    }
}

function showmybookings($userid){
    $pdo = make_database_connection();
    $sql = "select * from booking as b left join facility as f on b.FacilityID = f.FacilityID where UserID ='$userid'";
    $bookings = $pdo->query($sql);
    echo '<div align="center">
                    <table style="width: 500px;text-align: center">
                    <tr>
                    <th style="font-size: 1.8em">Facility</th>
                    <th style="font-size: 1.8em">Start Time</th>
                    <th style="font-size: 1.8em">End Time</th>
                    </tr>';
    while ($row = $bookings->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
                    <td style="font-size: 1.2em">'.$row['FacilityName'].'</td>
                    <td style="font-size: 1.2em">'.$row['StartTime'].'</td>
                    <td style="font-size: 1.2em">'.$row['EndTime'].'</td>
                    </tr>';
    }
    echo '</table></div>';
}

?>
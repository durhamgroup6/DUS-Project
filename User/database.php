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
        echo '<div class="image"><img src="../images/' . $row['FacilityName'] . '.jpg"></a></div>';
        echo '<div align="center"><table style="width: 220px;text-align: center"><tr>
                    <th style="font-size: 1.8em">' . $row['FacilityName'] . '</th>
                    </tr>
                    <tr>
                    <td style="font-size: 1.2em">' . $row['Description'] . '</td>
                    </tr></table></div>';
        echo '</div>';
    }
}

?>
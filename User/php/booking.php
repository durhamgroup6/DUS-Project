<?php
include_once '../database/database.php';
$pdo = make_database_connection();
session_start();
if (isset($_GET['date']) && $_GET['date'] != null) {
    $date = $_GET['date'];
    $newdate = date("Y-m-d H:i:s", strtotime($date));
    $start_d = date("Y-m-d", strtotime($date));
    $start_t = date("H:i:s", strtotime($date));
    $sql = "SELECT StartDate,EndDate FROM event WHERE color = 'red'";
    $result = $pdo->query($sql);
    while ($row=$result->fetch(PDO::FETCH_NUM)){
        if($newdate>=$row[0]&&$newdate<$row[1]){
            echo "This time is unavailable for booking";
            die();
        }
    }
}
if (isset($_POST['submit']) && $_POST['submit'] == "Book!") {
    $userId = $_SESSION['user']['UserID'];
    $facilityName = filter_input(INPUT_POST, 'facility', FILTER_SANITIZE_STRING);
    $startTime = filter_input(INPUT_POST, 'startTime', FILTER_SANITIZE_STRING);
    $startTime = date('Y-m-d H:i:s', strtotime($startTime));//formatting it a bit
    $howLong = filter_input(INPUT_POST, 'howLong', FILTER_SANITIZE_STRING);
    $isMember = filter_input(INPUT_POST, 'isMember', FILTER_SANITIZE_STRING);

    if ($facilityName == "Squash Courts") {
        $color = "yellow";
    } else if ($facilityName == "Aerobics room") {
        $color = "blue";
    } else if ($facilityName == "Tennis") {
        $color = "pink";
    } else if ($facilityName == "Athletics Track") {
        $color = "orange";
    }
    $check_startTime = date('H:i:s', strtotime($startTime));
    if ($check_startTime < '07:00:00') {// check if the start time picked is earlier than standard open time
        ?>
        <script>
            window.alert("Sorry, you cannot pick a time earlier than standard open time(7.00 am).");
            history.go(-1);
        </script>
        <?php
        die();
    }
    $check_endTime = date('H:i:s', strtotime("+" . $howLong . " hour", strtotime($startTime)));
//echo $check_endTime;
    if ($check_endTime > '22:00:01' or $check_endTime < '07:00:00') {// check if the end time picked is latter than standard close time
        ?>
        <script>
            window.alert("Sorry, you cannot pick a time later than standard close time(10.00 pm).");
            history.go(-1);
        </script>
        <?php
        die();
    }
    $stmt = $pdo->query("SELECT * FROM facility WHERE FacilityName='" . $facilityName . "'");
    $facility = $stmt->fetch(PDO::FETCH_ASSOC);
    $facilityId = $facility['FacilityID'];// getting facilityID by facilityName
    $price = $facility['Price'];// getting the price per hour
    $totalPrice = $price * $howLong;
    $capacity = $facility['Capacity'];
    if ($isMember == 1) {
        $price = 0.9 * $price;
    }

    $stmt = $pdo->query("SELECT * FROM event WHERE FacilityID='" . $facilityId . "' AND StartDate <= '" . $startTime . "' AND EndDate >= '" . $startTime . "';");// find the events that are using the same facility at the same time
    $event_withinTime = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($event_withinTime)) {
        ?>
        <script>
            window.alert("Sorry, this facility is occupied by event(s) during your booking period, please check the available time from the calendar and book again!");
            history.go(-1);
        </script>
        <?php
        die();
    } else {
        for ($x = 1; $x <= $howLong; $x++) {
            $nextHour = date('Y-m-d H:i:s', strtotime("+1 hour", strtotime($startTime)));// one hour later of the start time
            $stmt = $pdo->query("SELECT COUNT(BookingID) AS currentBookings FROM booking WHERE StartTime='" . $startTime . "' AND EndTime='" . $nextHour . "';");
            $count = $stmt->fetch(PDO::FETCH_ASSOC);
            $currentBookings = $count['currentBookings'];
            if ($currentBookings >= $capacity) {
                ?>
                <script>
                    window.alert("Sorry, this facility is full booked from <?php echo $startTime; ?> to <?php echo $nextHour; ?>");
                    history.go(-1);
                </script>
                <?php
                die();
            } else {
                $insert_into_booking = "INSERT INTO booking (UserID, StartTime, EndTime, Price, FacilityID,color) VALUES ('" . $userId . "', '" . $startTime . "', '" . $nextHour . "', '" . $price . "', '" . $facilityId . "','$color');";
                $pdo->exec($insert_into_booking);
                $startTime = $nextHour;
                if ($id = $pdo->lastInsertId() != null) {
                    $firstname = $_SESSION['user']['Firstname'];
                    $email = $_SESSION['user']['Email'];
                    $result = sendmail($firstname, $email, $price, $facilityName, $startTime, $nextHour);
                    if ($result == 1) {//send email successfully
                        echo '<script>
            window.alert("book the facility successfully! The booking confirmation will send you by email,please check");
            window.location.href = "../../index.php";</script>';
                    } else {
                       echo '<script>window.alert("book the facility unsuccessfully!");
                        window.location.href = "../../index.php";</script>';
                    }
                }
            }
        }
    }
}

function sendmail($firstname, $email, $price, $facility, $start, $end)
{
    require '../recovery/PHPMailer.php';

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 0;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.qq.com';  // Specify main and backup SMTP servers. 这里改成smtp.gmail.com
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '649965979@qq.com';                 // SMTP username 这里改成自己的gmail邮箱，最好新注册一个，因为后期设置会导致安全性降低
    $mail->Password = 'xnwisvsbeuxnbbdg';                           // SMTP password 这里改成对应邮箱密码
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

    $mail->setFrom('649965979@qq.com');
    $mail->addAddress($email);     // Add a recipient 这里改成用于接收邮件的测试邮箱 // Name is optional
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Durham Sport Online Booking - Booking Confirmation";
    $mail->Body = "Dear " . $firstname . "：Your Booking Information : " . $facility . " Start Time:" . $start . " End Time:" . $end . " Total Price:" . $price;
    $rs = $mail->send();
    return $rs;


}

if(isset($_SESSION['user'])&&$_SESSION['user']!=null){
   echo '<!DOCTYPE html >
<html lang = "en" >
<head >
    <script type = "text/javascript" >
        function check()
        {
            var
            startTime = document . getElementById("startTime") . value;
            if (startTime == "") {
                alert("pick a time!");
                return false
            } else {
                return true;
            }
        }
    </script >
    <meta charset = "UTF-8" >
    <title > Book</title >
</head >
<body >
<form class="book_form" action = "User/php/booking.php" method = "post" onsubmit = "return check()" >
        Facility: <select name = "facility" >
        <option value = "Squash Courts" > Squash Courts </option >
        <option value = "Aerobics room" > Aerobics room </option >
        <option value = "Tennis" > Tennis</option >
        <option value = "Athletics Track" > Athletics Track </option >
    </select ><br >
    Start Time: <input type = "datetime-local" id = "startTime" name = "startTime"
                       value = '.$start_d . 'T' . $start_t.' /><br >
    How Long: <select name = "howLong" >
        <option value = "1" > 1</option >
        <option value = "2" > 2</option >
        <option value = "3" > 3</option >
        <option value = "4" > 4</option >
        <option value = "5" > 5</option >
        <option value = "6" > 6</option >
        <option value = "7" > 7</option >
        <option value = "8" > 8</option >
        <option value = "9" > 9</option >
        <option value = "10" > 10</option >
        <option value = "11" > 11</option >
        <option value = "12" > 12</option >
        <option value = "13" > 13</option >
        <option value = "14" > 14</option >
        <option value = "15" > 15</option >
    </select ><br >
    Are You a Member ? <input type = "radio" name = "isMember" value = "1" checked > Yes
    <input type = "radio" name = "isMember" value = "0" > NO<br >
    <input type = "submit" name = "submit" value = "Book!" >
</form >
</body >
</html >';
    }else{
    echo "If you want to make a booking, please login firstly";
}
?>
<?php
session_start();
$email = trim($_SESSION['user']['Email']);
if (isset($_POST['submit']) && $_POST['submit'] == "update") {
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    include '../database/database.php';
    $stmt = $pdo->query("SELECT * FROM user WHERE email='$email'");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user['Password'] != $password) {
        $salt = "knock_knock_whos_there?";
        $password_hash = $password . $email . $salt;
        $password_hash = password_hash($password_hash, PASSWORD_DEFAULT);
        $sql_update = "Update user set Firstname='$firstname',Lastname='$lastname',Phone='$phone',Password = '$password_hash' where Email = '$email'";
        $getpasstime = time();
        $uid = trim($_SESSION['user']['UserID']);
        $token = md5($uid.$email.$password_hash);
        $time = date('Y-m-d H:i');
        $localhost = $_SERVER['HTTP_HOST'];
        $url = "http://".$localhost."/DUS-Project/User/recovery/reset.php?token=" . $token . "&email=" . $email;
        $result = sendmail_change($firstname, $time, $email, $url);
        if ($result == 1) {//send email successfully
            $sql = "UPDATE user SET resetpasswordtime='$getpasstime' WHERE UserID='$uid'";
            $pdo->query($sql);
        }
    } else {
        $sql_update = "Update user set Firstname='$firstname',Lastname='$lastname',Phone='$phone' where Email = '$email'";
    }
    $pdo->query($sql_update);
    $stmt = $pdo->query("SELECT * FROM user WHERE email='" . $email . "';");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION["user"] = $user;
    echo '<script>alert("update success!");history.go(-1)</script>';
}

function sendmail_change($firstname, $time, $email, $url)
{
    require '../recovery/PHPMailer.php';
//Create a new PHPMailer instance
    $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
    $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
    $mail->SMTPDebug = 0;
//Set the hostname of the mail server
    $mail->Host = 'tls://smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
    $mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "durhamteamgroup6@gmail.com";
//Password to use for SMTP authentication
    $mail->Password = "qygejmxrcfmswhxq";
//Set who the message is to be sent from
    $mail->setFrom('durhamteamgroup6@gmail.com');
//Set an alternative reply-to address
    $mail->addAddress($email);     // Add a recipient // Name is optional
    $mail->isHTML(true);
    $mail->Subject = "Durham Sport Online Booking - Change Password";
    $mail->Body = "Dear " . $firstname . "：you are in " . $time . " change your password. If you don't do it yourself,please click the link to reset password（valid for 24 hours)." . $url . " If you cannot click this link, please copy it enter your website address. ";
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $rs = $mail->send();
    return $rs;
}
?>
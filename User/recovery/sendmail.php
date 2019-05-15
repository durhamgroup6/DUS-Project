<?php
include_once("../database/database.php");

$email = stripslashes(trim($_POST['mail']));

$sql = "select * from user where Email='$email'";
$query = $pdo->query($sql);
$row = $query->fetch(PDO::FETCH_ASSOC);
if ($row == null) {//this email does not register！
    echo 'noreg';
    exit;
} else {
    $getpasstime = time();
    $uid = $row['UserID'];
    $firstname = $row['Firstname'];
    $token = md5($uid . $row['Email'] . $row['Password']);
    $localhost = $_SERVER['HTTP_HOST'];
    $url = "http://".$localhost."/DUS-Project/User/recovery/reset.php?token=" . $token . "&email=" . $email;
    $time = date('Y-m-d H:i');
    $result = sendmail($firstname,$time, $email, $url);
    if ($result == 1) {//send email successfully
        $msg = 'The System has sent a email for you,check your email and reset your password please！';
        //update reset password time
        $sql = "UPDATE user SET resetpasswordtime='$getpasstime' WHERE UserID='$uid'";
        $pdo->query($sql);
    } else {
        $msg = $result;
    }
    echo $msg;
}

function sendmail($firstname,$time, $email, $url){
    require 'PHPMailer.php';
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
    $mail->Subject = "Durham Sport Online Booking - Reset Password";
    $mail->Body    = "Dear " . $firstname . "：you are in " . $time . " submit a request of reseting password. Please click the link to reset password（valid for 24 hours)." . $url . " If you cannot click this link, please copy it enter your website address. If you do not submit this request,ignore this email please.";
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $rs = $mail->send();
    return $rs;

}

?>
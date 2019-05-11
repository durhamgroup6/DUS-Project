<?php
include_once("../database.php");

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
    $url = "http://localhost:63342/DUS-Project3.0/User/recovery/reset.php?_ijt=ur5g5i1aa1rbh4nam0pdj1um0e?reset=yes&token=" . $token . "&email=" . $email;
    $time = date('Y-m-d H:i');
    $result = sendmail($firstname,$time, $email, $url);
    if ($result == 1) {//邮件发送成功
        $msg = 'The System has sent a email for you,check your email and reset your password please！';
        //update reset password time
        $sql = "UPDATE user SET resetpasswordtime='$getpasstime' WHERE UserID='$uid'";
        $result = $pdo->query($sql);
    } else {
        $msg = $result;
    }
    echo $msg;
}

//function sendmail($time, $email, $url)
//{
//    include_once("../php/smtp.class.php");
//    $smtpserver = "ssl://smtp.gmail.com"; //SMTP server
//    $smtpserverport = 465; //SMTP server port
//    $smtpusermail = "durhamteamgroup6@gmail.com"; //SMTP server's email
//    $smtpuser = "durhamteamgroup6@gmail.com"; //SMTP server's account
//    $smtppass = "durham123456"; //SMTP server's password
//    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //true means using auth.
//    $emailtype = "html"; //email type，text；web：HTML
//    $smtpemailto = $email;
//    $smtpemailfrom = $smtpusermail;
//    $emailsubject = "Durham Sport Online Booking - Reset Password";
//    $emailbody = "Dear " . $email . "：you are in " . $time . " submit a request of reseting password. Please click the link to reset password（valid for 24 hours)." . $url . " If you cannot click this link, please copy it enter your website address. If you do not submit this request,ignore this email please.";
//    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
//    return $rs;
//}

function sendmail($firstname,$time, $email, $url){
    require '../php/PHPMailer.php';

    $mail = new PHPMailer;

   //$mail->SMTPDebug = 0;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.qq.com';  // Specify main and backup SMTP servers. 这里改成smtp.gmail.com
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '649965979@qq.com';                 // SMTP username 这里改成自己的gmail邮箱，最好新注册一个，因为后期设置会导致安全性降低
    $mail->Password = 'xnwisvsbeuxnbbdg';                           // SMTP password 这里改成对应邮箱密码
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port =25 ;                                    // TCP port to connect to

    $mail->setFrom('649965979@qq.com');
    $mail->addAddress($email);     // Add a recipient 这里改成用于接收邮件的测试邮箱 // Name is optional
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Durham Sport Online Booking - Reset Password";
    $mail->Body    = "Dear " . $firstname . "：you are in " . $time . " submit a request of reseting password. Please click the link to reset password（valid for 24 hours)." . $url . " If you cannot click this link, please copy it enter your website address. If you do not submit this request,ignore this email please.";
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $rs = $mail->send();
    return $rs;
//    if(!$mail->send()) {
//        echo  'Message could not be sent.';
//        echo 'Mailer Error: ' . $mail->ErrorInfo;
//    } else {
//        echo 'Message has been sent';
//    }

}

?>
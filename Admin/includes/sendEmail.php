<?php
function sendmail($email,$subject, $body){
    require '../User/recovery/PHPMailer.php';
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
    $mail->Subject = $subject;
    $mail->Body    = $body;
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
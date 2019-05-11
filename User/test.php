<?php

require 'php/PHPMailer.php';
require 'php/smtp.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "tls://smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = "durhamteamgroup6@gmail.com";
$mail->Password = "eozeijeccdzgpfzs";
$mail->SetFrom("durhamteamgroup6@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("649965979@qq.com");

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent";
}
?>
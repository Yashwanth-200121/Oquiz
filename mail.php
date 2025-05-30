<!DOCTYPE html>
<html>
    <body>
        <form action="index.php" method="get">
            Mail:<input type="text" name="mail">
            <input type="submit">
</form>
    




<?php
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use  PHPMailer\PHPMailer\PHPMailer;
use  PHPMailer\PHPMailer\SMTP;
use  PHPMailer\PHPMailer\Exception;

$e=$_POST['email'];
$mail = new PHPMailer();
$mail->isSMTP();
$mail-> Host="smtp.gmail.com";
$mail->SMTPAuth="true";
$mail->SMTPSecure="tls";
$mail->Port="587";
$mail->Username="teamoquiz@gmail.com";
$mail->Password="Oquiz@123";
$mail->Subject="Congratualations for Sign in";
$mail->setFrom("teamoquiz@gmail.com");
$mail->isHTML(true);
$mail->addAttachment('img/Login.png');
$mail->Body="<h1> Testing </h1></br><p> Hello All Welcome. Congratualations for entering to OQUIZ.


Regards:TeamOquiz
</p> ";
$mail->addAddress($e);

if ($mail->Send()){
    echo "Sucess....";

}else{
    echo "Bela";
}
$mail->smtpClose();

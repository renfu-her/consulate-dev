<?php

	//mail("$tempMailTarget","$title","$bady","$exdata"); 

$mail->Host     = "localhost"; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "tihudashi@tihudashi.com.tw";  // SMTP username
$mail->Password = "ami123456"; // SMTP password
$mail->CharSet  = "utf-8";
$mail->From     = "tihudashi@tihudashi.com.tw";
$mail->FromName = $from;
$mailuser="consulatechang@yahoo.com.tw";
$mailuser2="amiwu2012@gmail.com";
$mail->AddAddress($mailuser,"管理者");
$mail->AddAddress($mailuser2,"管理者");
//$mailuser3="f8621001@gmail.com";
//$mail->AddAddress($mailuser3,"管理者");
$mail->WordWrap = 50;                              // set word wrap

$mail->IsHTML(true);                              // send as HTML
$mail->Subject  =  $title;
$mail->Body     =  $bady;
if(!$mail->Send())
{
   echo "Message was not sent <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
} 	
?>

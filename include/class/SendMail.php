<?php

class SendMail{
   var $body;
   var $to;
   var $cc;
   var $Bcc;
   var $subject;
   var $charset = 'UTF-8';
   var $html = true;
   var $message;
   var $from;

  function MiniSend($to = '',$subject='',$message ='',$from=''){
    $to = $this->to;
	$subject = $this->subject;
	$message = $this->message;
	$from = $this->from;
	
    $charset = "utf-8";
	$br = strtoupper(substr(PHP_OS,0,3)) == 'WIN' ? "\r\n" : "\n";
	$title =  $subject;
    $subject = "=?utf-8?B?".base64_encode($subject)."?=";
	$message = $message;
	$to = $to;
	
    $headers = '';
    $headers .= 'Content-type: text/html; charset=utf-8' . "$br";
	$headers .= 'MIME-Version: 1.0' . "$br";
	$headers .= "From : $from $br";
	
	$message = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title> $title </title>
</head>
<body>
<div>  $message </div>
</body>
</html>";
   return mail($to, $subject, $message, $headers);
}
   
   function SetMessage($body){
       $this->message = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title> title </title>
</head>
<body>
$body
</body>
</html>";
   } 
   
   function Send(){
       $br = strtoupper(substr(PHP_OS,0,3)) == 'WIN' ? "\r\n" : "\n";
	   
	   $subject = "=?utf-8?B?".base64_encode($this->subject)."?=";
	   $headers = '';
	   if($this->html === true){
	   	   $headers .= 'Content-type: text/html; charset=utf-8' . "$br";
	       $headers .= 'MIME-Version: 1.0' . "$br";
	       $headers .= "From : ".$this->from." $br";
	   }
	  return mail($this->to, $subject, $this->message, $headers);
   }
   
}



?>
<?php 
require_once('../confirm_login.php'); 
$ID = intval($_GET['ID']);
$db->Delete("#@#news" , "ID=$ID");
$db->disConnect();
GoTo2('referer');
?>
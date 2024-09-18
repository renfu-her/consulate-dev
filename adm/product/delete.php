<?php 
require_once('../confirm_login.php');

$ID = intval($_GET['ID']);

$db->Execute("DELETE FROM #@#product WHERE pro_id = $ID");
$db->Execute("DELETE FROM #@#product_images WHERE PID = $ID");
$db->disConnect();
GoTo2('referer');
?>
<?php 
require_once('../confirm_login.php');
//$admin->Competence('product_delete');
$ID = intval($_GET['ID']);
$t = htmlspecialchars($_GET['t']);
$db->Execute("DELETE FROM #@#$t WHERE ID=$ID");
$db->disConnect();
GoTo2('referer');
?>
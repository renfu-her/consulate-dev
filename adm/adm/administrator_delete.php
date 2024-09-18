<?php 
require_once('../confirm_login.php');
//$admin->Competence("admin_delete");
$admin->Delete(intval($_GET['AdminID']));
$db->disConnect();
GoTo2("referer");
?>
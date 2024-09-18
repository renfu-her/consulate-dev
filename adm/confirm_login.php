<?php
include_once("config.php");
include_once(CLASS_DIR."admin.php");
$admin = new admin();
if( ! $admin->IsLogin() ){
 GoTo2(ADMIN_PATH."login.php");
}
?>
<?php
require_once(dirname(__FILE__)."/config.php");
require_once(CLASS_DIR."DB.php");
$db = new DB(true);
$db->SetCharset(CHARSET);
$db->SetFetchMode(MYSQL_ASSOC);
require_once(INC_DIR."functions.php");
?>
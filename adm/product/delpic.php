<?php 
require_once('../confirm_login.php'); 
$ID = intval($_GET['ID']);
$db->Delete("#@#product_images" , "ID=$ID");

$save_dir = ROOT_DIR."UserFiles/ProductImages/";
$file1 = ROOT_DIR."UserFiles/ProductImages/".$_GET['ImageTemp'];
$file2 = ROOT_DIR."UserFiles/ProductImages/s".$_GET['ImageTemp'];
if(file_exists($file1) && is_file($file1)) unlink($file1);
if(file_exists($file2) && is_file($file2)) unlink($file2);
GoTo2('referer');
?>
<?php
include_once(realpath(dirname(__FILE__)."/include/")."/inc.php");

SessionStart();
define("ADMIN_DIR" , dirname(__FILE__)."/");

define("ADMIN_PATH" ,ROOT_PATH.basename(dirname(__FILE__))."/");

$col_lang = "en";

if(isset($_GET['lang'])){
   $col_lang = $_GET['lang'];
   $_SESSION['sess_user']['lang'] = $col_lang;
}elseif(isset($_SESSION['sess_user']['lang'])){
   $col_lang = $_SESSION['sess_user']['lang'];
}else{
   $_SESSION['sess_admin']['lang'] = $col_lang;
}

$admin_lang = array();

function GetLangName($lang){
   global $language_array;
   if(count($language_array) < 2) return '';
   return " (".$GLOBALS['admin_lang'][$lang].")";   
}
$link="http://www.checkbox.asia/";
?>
<?php
//error_reporting(E_ALL ^ E_NOTICE); 
error_reporting(0); 
define("CHARSET","UTF-8");
// set charset = utf-8
header("Content-Type:text/html;Charset=".CHARSET);
//  ### document root
define("ROOT_PATH",'/');
define("ECATALOG_ROOT",'/');
define("PLAS_ROOT",'/');


define("ROOT_DIR",realpath(dirname(__FILE__)."/../")."/");
define("INC_DIR",ROOT_DIR."include/");
define("CLASS_DIR",ROOT_DIR."include/class/");


?>

<?php
$category_class = array('Default', 'Product' , 'Article' , 'Download' );

$language_array = array("en");

define("MAX_FILE_SIZE",return_bytes(ini_get("upload_max_filesize")));

$upload_image_type = array('.zip' , '.doc','.txt' , '.rar' , '.pdf' , '.xls' , '.pub' , '.ppt' , '.mdb' ,'.gif','.jpg','.png','.swf');


$product_image_setting = array();
$product_image_setting['list'] = array(160, 130);
$product_image_setting['detail'] = array(300 , 230);

//$product_image_setting['home'] = array(113 , 138);

define("REDUCE_IMAGE_BG" , true);     //普拉瑞斯創意整合?
define("REDUCE_IMAGE_BG_COLOR" , "#FFFFFF");  //??????
  

//??
define("PRODUCT_OPEN" , true); //????
define("PRODUCT_CATEGORY_LAYER",3); //??????
define("PRODUCT_CATEGORY_IMAGE_OPEN" , true);//普拉瑞斯創意整合??
define("PRODUCT_CATEGORY_IMAGE_WIDTH" , 198); //???????
define("PRODUCT_CATEGORY_IMAGE_HEIGHT", 123) ; //???????
define("PRODUCT_CATEGORY_RECOMMEND" , false); //??????

define("PRODUCT_DESCRIPTION" ,true) ; //??????
define("PRODUCT_DETAILS" , false); //????
//??

define("ARTICLE_CATEGORY_LAYER",1); //??????
define("ARTICLE_CATEGORY_IMAGE_OPEN" , false);//普拉瑞斯創意整合
define("ARTICLE_CATEGORY_IMAGE_WIDTH" , 100);
define("ARTICLE_CATEGORY_IMAGE_HEIGHT" , 100);

//??
define("CATEGORY_IMAGE_DIR" , ROOT_DIR."UserFiles/CategoryImages/");  //???????

//??
define("PRODUCT_IMAGE_DIR" , ROOT_DIR."UserFiles/ProductImages/");   //???????

//??
define("ORDER_OPEN" , true); //??????
//E-mail
define("EMAIL_OPEN" , true); //??E-mail

//??
define("DOWNLOAD_OPEN" , true) ; //????

define("DOWNLOAD_DIR" ,ROOT_DIR."UserFiles/Files/");//?????

define("CONTACT_US_OPEN" , true);//??????
?>
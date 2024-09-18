<?php
ob_start();
include_once(dirname(__FILE__)."/class/session.php");
header('content-Type:image/png');
mt_srand(make_seed());
$randval  = mt_rand();
$seccode = substr($randval,-4);
$length    =  strlen($seccode);
$_SESSION['seccode']  =  $seccode;

$img       = imagecreate(60,20);
$bgcolor = imagecolorallocate($img,255,255,255);

for  ($i = 0; $i < $length;  $i++)  {
    $color = imagecolorallocate($img,abs(mt_rand()%256),abs(mt_rand()%256),abs(mt_rand()%256)); //随机取色
     imagechar($img,5,abs(mt_rand()%4)+$i*15,abs(mt_rand()%5),$seccode[$i],$color);//随机每个字符的x,y值   
} 

imagepng($img);
imageDestroy($img);
ob_end_flush();

/*
设置随机数种子，从php手册中抄来的。
*/
function make_seed()
{
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}
?>
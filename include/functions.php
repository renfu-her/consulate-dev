<?php
//+------------------------------------------+
// @filename functions.php
// @author ZhaiPeng <sohophp@hotmail.com>    +
// @copyright zhaipeng.cn                    +
// @time 2007-06
// @explain 
//+------------------------------------------+



function Alert($msg){
    $msg = str_replace(array("'","\n","\r"),array("\\'","\\n","\\r"),$msg);
	echo Javascript("window.alert('$msg')");
}
function Javascript($code){
    $js = "<script language=\"Javascript\" type=\"text/javascript\">\n";
	$js .= $code;
	$js .="\n</script>\n";
	echo  $js;
}

function NoCache(){
    if(!headers_sent()){
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
   }
}


//php version < 5.1  htmlspecialchars_decode
if ( !function_exists('htmlspecialchars_decode') )
{
   function htmlspecialchars_decode($text)
   {
       return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
   }
}

function GetQueryString($exclusion = ''){
    $ret = '';
	foreach($_GET as $k=>$v){
		if(is_array($exclusion)){
		   if(!in_array($k , $exclusion)) $ret .="&$k=".urlencode($v); 
		}else{
		   if($k != $exclusion) $ret .="&$k=".urlencode($v);    
		}
	}
	return $ret;
}

function BiteStr($str , $len , $postfix = '...'){
   return bite_str($str , $len , 0 , 3, $postfix);
}
// String intercept By Bleakwind
// utf-8:$byte=3 | gb2312:$byte=2 | big5:$byte=2
function bite_str($string='', $len=0, $start=0, $byte=3 , $postfix = "...")
{
   $str    = "";
   $count  = 0;
   $str_len = strlen($string);
   
   //后加的字数不够时直接反回原string
   //if($str_len <= $len) return $string;

   for ($i=0; $i<$str_len; $i++) {
       if (($count+1-$start)>$len) {
           $str  .= $postfix;
           break;
       } elseif ((ord(substr($string,$i,1)) <= 128) && ($count < $start)) {
           $count++;
       } elseif ((ord(substr($string,$i,1)) > 128) && ($count < $start)) {
           $count = $count+2;
           $i    = $i+$byte-1;
       } elseif ((ord(substr($string,$i,1)) <= 128) && ($count >= $start)) {
           $str  .= substr($string,$i,1);
           $count++;
       } elseif ((ord(substr($string,$i,1)) > 128) && ($count >= $start)) {
           $str  .= substr($string,$i,$byte);
           $count = $count+2;
           $i    = $i+$byte-1;
       }
   }
   return $str;
}

function SessionStart(){
   if(isset($_SESSION)) return true;
   include_once(dirname(__FILE__)."/class/session.php");
}

function ShowHtml($text){
   echo "<div style=\"position:absolute;text-align:center;color:red;font-size:12px;border:1pt solid #333333;width:200px;height:50px;line-height:50px;top:150px;left:300px;\">\n";
   echo $text;
   echo "\n</div>";
}

function GoTo2($filename , $msg = '' , $window = 'self' , $seconds = 1 ){
   if($msg != ''){
      ShowHtml($msg);
	  if($seconds == 1){
	     $seconds = strlen($msg) * 100; 
	  }
   }

   switch($filename){
      case '-1':
	  case 'back':
	  case 'history':
	      $js = "window.history.back()";
		  break;
	  case 1:
	      $js = "$window.location.href = $window.location.href";
		  break;
	  case 'referer':
	      $js = "$window.location.href = document.referrer";
		  break;
	  default: $js = "$window.location.href = '$filename'";	  	  	  
   }

   Javascript("
      function re_location(){
	     $js;
	  }
	  setTimeout(\"re_location()\" , $seconds);
   ");
   exit;
}

function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val{strlen($val)-1});
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}
function GetProductImage($filename , $prefix = ""){
    if($filename == '') return ROOT_PATH."UserFiles/empty.gif";
    return ROOT_PATH."UserFiles/ProductImages/$prefix"."$filename";
}

function GetCategoryImage($Image){
   if($Image == '') return ROOT_PATH."UserFiles/empty.gif";
   return ROOT_PATH."UserFiles/CategoryImages/".$Image;
}

function GetDownloadFile($filename){
   $file = ROOT_DIR."UserFiles/Files/$filename";
   if(file_exists($file) && is_file($file)) return ROOT_PATH."UserFiles/Files/$filename";
   else return false;
}
function GetImagePath($filename , $prefix = ""){
    if($filename == '') return ROOT_PATH."UserFiles/empty.gif";
    return ROOT_PATH."UserFiles/Images/$prefix"."$filename";
}

function GetWebsite($website){
  if($website == '' || $website == '#') return '#';
  if(!eregi('^http://' , $website)) return 'http://'.$website;
  return $website;
}

function GetLogo($logo){
  if(empty($logo)) return ROOT_PATH.'UserFiles/empty.gif';
  return ROOT_PATH.'UserFiles/Logos/'.$logo;
}

function GetAdImage($image){
  if(empty($image)) return ROOT_PATH.'UserFiles/empty.gif';
  return ROOT_PATH.'UserFiles/ad/'.$image;
}
function DeleteImage($FileName , $CatalogID){
   $prefix = array('','bottom_','left_');
   
   $dir = ROOT_DIR."UserFiles/Images/$CatalogID/";
   foreach($prefix as $pre){
     $file = $dir.$pre.$FileName;
	 if(is_file($file)) unlink($file);
   }
}
function DeleteProductImage($FileName , $CatalogID){
   $prefix = array('','bottom_','left_','detail','list');
   
   $dir = ROOT_DIR."UserFiles/$CatalogID/";
   foreach($prefix as $pre){
     $file = $dir.$pre.$FileName;
	 if(is_file($file)) unlink($file);
   }
}

function Now(){
   return date("Y-m-d H:i:s");
}
function TypeImage($filename , $width = 36 , $height = 36 , $att='' , $jpg = true){
    $postfix = strtolower(substr(strrchr($filename,'.'),1));
	switch($postfix){
	   case 'as':    $img = 'as';       break;
	   case 'avi':   $img = 'avi';      break;
	   case 'bmp':   $img = 'bmp';      break;
	   case 'chm':   $img = 'chm';      break;
	   case 'com':   $img = 'com';      break;
	   case 'css':   $img = 'css';      break;
	   case 'forder':
	   case 'dir':   $img = 'dir';      break;
	   case 'doc':   $img = 'doc';      break;
	   case 'exe':   $img = 'exe';      break;
	   case 'gif':   $img = 'gif';      break;
	   case 'htm':
	   case 'html':  $img = 'html';     break;
	   case 'ini':   $img = 'ini';      break;
	   case 'jpg':   $img = 'jpg';      break;
	   case 'js':    $img = 'js';       break;
	   case 'log':   $img = 'log';      break;
	   case 'mdb':   $img = 'mdb';      break;
	   case 'mov':   $img = 'mov';      break;
	   case 'pdf':   $img = 'pdf';      break;
	   case 'png':   $img = 'png';      break;
	   case 'ppt':   $img = 'ppt';      break;
	   case 'psd':   $img = 'psd';      break;
	   case 'pub':   $img = 'pub';      break;
	   case 'rar':   $img = 'rar';      break;
	   case 'rm' :   $img = 'rm';       break;
	   case 'swf':   $img = 'swf';      break;
	   case 'ttf':   $img = 'ttf';      break;
	   case 'txt':   $img = 'txt';      break;
	   case 'wav':   $img = 'wav';      break;
	   case 'wma':   $img = 'wma';      break;
	   case 'wmv':   $img = 'wmv';      break;
	   case 'xls':   $img = 'xls';      break;
	   case 'zip':   $img = 'zip';      break;
	   default:      $img = 'zip';    	    
	}
	if($jpg === true){
	  $img = 'jpg/'.$img.'.jpg';
	}else{
	  $img = $img.'.png';
	}
	return '<img src="'.ROOT_PATH.'include/files/'.$img.'" width="'.$width.'" height="'.$height.'" alt="'.$postfix.'" border="0" '.$att.' />';
}
function Editor($fieldname , $value = '' , $width = '98%' , $height = 300 , $toolBar = 'Sohophp' ){
    include_once(dirname(__FILE__)."/editor/Editor.php");
	$editor = new Editor($fieldname , $width , $height , $value , $toolBar);
	$editor->Create();
}

function Download($file, $filename){ 
	 $filename = urlencode($filename);
	 $len = filesize($file);
	 $ctype="application/force-download"; 
	 header("Pragma: public");
     header("Expires: 0");
     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
     header("Cache-Control: public"); 
     header("Content-Description: File Transfer");
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    //Force the download
    $header="Content-Disposition: attachment; filename=".$filename.";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    readfile($file);
    exit;
}

function imagenewsize($save_dir , $file ,$percent = 0.8 , $percent2 = 0.95){
   
  $filename = $save_dir.$file;
  $newfilename = $save_dir.'size_'.$file; 
  
  // Content type
  header('Content-type: image/jpeg');
  
// Get new sizes
  list($width, $height) = getimagesize($filename);
  $newwidth = $width * $percent;
  $newheight = $height * $percent;
  
  $width2 = $width * $percent2;
  $height2 = $height * $percent2;
  // Load
  $thumb = imagecreatetruecolor($newwidth, $newheight);
  $source = imagecreatefromjpeg($filename);

  // Resize
  imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imagedestroy($source);
  
  $im2 = imagecreatetruecolor($width2 , $height2);
  imagecopyresized($im2 , $thumb ,0,0,0,0,$width2, $height2 , $newwidth , $newheight);
  imagedestroy($thumb);
  // Output
  imagejpeg($im2,$newfilename);
  imagedestroy($im2);
  
}

function GetCurImage($content){
  set_time_limit(0);
  if(get_magic_quotes_gpc()) $content = stripslashes($content);
  
  $img_array = array();
  preg_match_all("/(src|SRC)=[\"|'| ]{0,}(http:\/\/([^\.]+)\.(gif|jpg|jpeg|bmp|png))/isU",$content,$img_array);
  $img_array = array_unique($img_array[2]);
 
  $saveDir = ROOT_DIR."UserFiles/Image/";
  
  foreach($img_array as $key=>$value){
     if(!eregi("^http://",$value)) continue;
     
	 $size = getimagesize($value);
	 
	 $type = $size['mime'];
	 if($type == 'image/gif'){
	    $postfix = ".gif";
	 }elseif($type == 'image/png'){
	    $postfix = ".png";
	 }elseif($type == 'image/jpeg'){
	    $postfix = ".jpg";
	 }else{
	    continue;
	 }
	 
	 $filename = time().rand(substr(time(),-3),time());
	 $filename .= $postfix; 
	 $saveFile = $saveDir.$filename;

	 $imgContent = file_get_contents($value);
	 
	 if(!empty($imgContent)){
	     
	 	 $fp = fopen($saveFile , "wb");
		 
		 $write = fwrite($fp , $imgContent);
		 
		 fclose($fp);
		  
		 if($write){
	        $content = str_replace($value, ROOT_PATH."UserFiles/Image/$filename",$content);
	     }		 
	 }
  }
  return $content;
}
//utf8截取字串
function cut_str($sourcestr,$cutlength) 
{ 
   $returnstr=''; 
   $i=0; 
   $n=0; 
   $str_length=strlen($sourcestr);//字符串的字节数 
   while (($n<$cutlength) and ($i<=$str_length)) 
    { 
      $temp_str=substr($sourcestr,$i,1); 
      $ascnum=Ord($temp_str);//得到字符串中第$i位字符的ascii码 
      if ($ascnum>=224)    //如果ASCII位高与224，
      { 
         $returnstr=$returnstr.substr($sourcestr,$i,3); //根据UTF-8编码规范，将3个连续的字符计为单个字符         
         $i=$i+3;            //实际Byte计为3
         $n++;            //字串长度计1
      }
       elseif ($ascnum>=192) //如果ASCII位高与192，
      { 
         $returnstr=$returnstr.substr($sourcestr,$i,2); //根据UTF-8编码规范，将2个连续的字符计为单个字符 
         $i=$i+2;            //实际Byte计为2
         $n++;            //字串长度计1
      }
       elseif ($ascnum>=65 && $ascnum<=90) //如果是大写字母，
      { 
         $returnstr=$returnstr.substr($sourcestr,$i,1); 
         $i=$i+1;            //实际的Byte数仍计1个
         $n++;            //但考虑整体美观，大写字母计成一个高位字符
      }
       else                //其他情况下，包括小写字母和半角标点符号，
      { 
         $returnstr=$returnstr.substr($sourcestr,$i,1); 
         $i=$i+1;            //实际的Byte数计1个
         $n=$n+0.5;        //小写字母和半角标点等与半个高位字符宽...
      } 
    } 
          if ($str_length>$cutlength){
          $returnstr = $returnstr ;//超过长度时在尾处加上省略号
      }
     return $returnstr; 

} 
$weblink="http://www.tihudashi.com.tw/";
?>
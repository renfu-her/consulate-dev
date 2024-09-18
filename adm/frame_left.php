<?php 
require_once('confirm_login.php');

$lis = array();
$i = 0;	
	if($_SESSION['sess_admin']['GroupID']==0){
	   $lis[$i][] = array("#" , $admin_lang['administrators']);
	   $lis[$i][] = array("adm/administrator_index.php" , $admin_lang['administrators']);
	   if($admin->IsCompetence("admin_insert")){
		 $lis[$i][] = array("adm/administrator_add.php" , $admin_lang['add_a_new_user']);
	   }
	   $i ++;  
	}
	
	
	$lis[$i][] = array("#" , "活動訊息管理");
	$lis[$i][] = array("news/index.php" , "活動訊息列表");
	$lis[$i][] = array("news/add.php" , "新增活動訊息");
	$i ++ ;
	
	$lis[$i][] = array("#" , $admin_lang['product_management']);	
	$lis[$i][] = array("food/class_index.php?t=food" , "菜單分類");	
	$lis[$i][] = array("product/index.php" , "菜單列表");
	$lis[$i][] = array("product/add.php" , "新增菜單");		
	$i ++ ;
	
	$lis[$i][] = array("#" , "飲品/蛋糕/輕食分類");
	$lis[$i][] = array("class/class_index.php?t=class" , "飲品/蛋糕/輕食列表");	
	$lis[$i][] = array("product2/index.php" , "飲品/蛋糕/輕食內容");
	$lis[$i][] = array("product2/add.php" , "新增飲品/蛋糕/輕食");		
	$i ++ ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>frame_left</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../include/javascript/init.js"></script>
<script language="javascript" type="text/javascript">

window.onload = function(){
   
  var lis = document.getElementById('nav').childNodes;
  for(var i=0;i<lis.length;i++){
    if(lis[i].nodeType != 1) continue ;
	if(lis[i].getElementsByTagName('UL').length >0){
	     
		 /*
		 lis[i].childNodes[0].onclick = function (){return false;} 
	  	*/
		 
		 lis[i].getElementsByTagName('a')[0].onclick = function(){
	         var uls = document.getElementById('nav').getElementsByTagName('UL');
			 
			 var nextSib = this.parentNode.getElementsByTagName('UL')[0];
			 for(var n = 0 ; n < uls.length ; n ++){
			    uls[n].style.display = 'none';
			 }
			 nextSib.style.display = '';
			 
		  } 
		  
		 lis[i].getElementsByTagName('UL')[0].style.display = 'none';
		 
	  }
  }

}
</script>
</head>

<body>
<div id="navlayer">
<ul id="nav">
 <?php
 foreach($lis as $arr){
    echo " <li>\n";
	$target =  isset($arr[0][2]) ? $arr[0][2] : '_self';
	
	echo "  <a href=\"".$arr[0][0]."\" target=\"$target\">".$arr[0][1]."</a>\n";
	$c = count($arr);
	if($c > 1){
	   echo "  <ul>\n";
	   for($i = 1; $i < $c ; $i ++){
	      $target = isset($arr[$i][2]) ? $arr[$i][2]  : 'mainFrame' ;
	      echo "      <li><a href=\"".$arr[$i][0]."\" target=\"$target\">".$arr[$i][1]."</a></li>\n";
	   }
	   echo "  </ul>\n";
	}  
	
	echo " </li>\n";
	
 }
 ?> 
 </li>
</ul>
<div style="width:95%;border-right: 1pt solid #CCCCCC;height:320px;">
<div style="display: block;
	line-height: 26px;
	list-style-type: none;
	background-image: url(images/imqq4_top01_03.gif);
	background-repeat: repeat-x;
	background-position: left center;
	text-indent: 20px;
	font-weight: bold;
	border-top-width: 1pt;
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-top-color: #CCCCCC;
	border-bottom-color: #F6F6F6;
	text-decoration: none;"></div>
</div>
</div>
</body>
</html>

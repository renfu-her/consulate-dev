<?php
include("include/config.php");
include("include/DB.php");
require_once("include/functions.php");
SessionStart();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>淡水 領事館餐廳</title>
<meta name="keywords" content="輕食,淡水美食,淡水河岸咖啡館,咖啡午茶,咖啡簡餐" />
<meta name="description" content="我們是一家咖啡館以領事館為名，經營咖啡簡餐、地中海美食套餐，領事館餐廳座落在紅毛城對面,以西班牙式風格的「領事館」在淡水極負盛名" />
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/top.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="wrapper">

    <div class="myfb"><!-- start myfb -->
        <a target="_blank" href="https://www.facebook.com/consulate.coffee"><img src="images/fb.png"></a>
    </div><!-- end myfb -->
    
    <div id="header_p"><!-- start header_p -->
        <div id="nav_ps"><!-- start header_p -->
        <ul id="nav_p">
             <?php include("inc_menu.php");?>
        </ul>
        </div>
        <div id="top_p">
            <div id="logo_p"><a href="index.php"><img src="images/logo.png" ></a></div>
         </div>
    </div><!-- end header_p -->
     
  
     
   
   <!-- start banner -->
   <div id="banner"><img src="images/banner01.gif"></div>
   <!-- end banner -->
 
   <div id="content"><!-- end content -->
        
        <div class="newsAA">
            <h2>活動訊息</h2>
            <ul>
               <?php
            $diarysql="SELECT * FROM #@#news where list='Y' ORDER BY now_time desc,ID desc limit 3";
			$diary1 = $db->Execute($diarysql);		  
			$i=0;
			while($row_news = $diary1->FetchRow()){
			?>
                <li> 
                    <a href="news_center.php?ID=<?=$row_news['ID']?>">
                    <?php if($row_news['Image']!=""){?>
                    <img src="UserFiles/newsImages/s<?=$row_news['Image']?>">
                    <?php }?>
                        <p class="date"><?=$row_news['now_time']?></p> 
                        <h3><?=cut_str($row_news['subject'],12)?></h3>
                        <p class="cont"><?=$row_news['s_subject']?></p>
                    </a>
                </li>
                <?php }?>
            </ul>
            <div class="clear">&nbsp;</div><!-- div 因 float:left 產生的問題所以要加 class="clear"，但這個空的div無意義所以還會有其他寫法 --> 
        </div>
        
        <div class="clear"></div><!-- 有時因 float:left 產生的問題所以要加 class="clear",但因為前面我已有寫過兩組所以這個刪除也不會造成錯位 --> 
                
        <div class="newsB">
            <h2>店長推薦</h2>
            <ul>
             <?php
            $diarysql="SELECT * FROM #@#product where list='Y' and command='Y' ORDER BY SortOrder asc,pro_id asc";
			$diaryp = $db->Execute($diarysql);		  
			$i=0;
			while($row_p = $diaryp->FetchRow()){
			?>
                <li> 
                    <a href="menu_list_01.php?CID=<?=$row_p['CID']?>"><?php if($row_p['Image']!=""){?>
                    <img src="UserFiles/ProductImages/<?=$row_p['Image']?>">
                    <?php }?>
                        <h3><?=$row_p['pro_name']?></h3>
                        <p class="cont"><?=cut_str(strip_tags($row_p['info2']),27)?></p><!-- 這個字數過少會造成前端不平衡所以可以在這個命名加統一"高度" -->
                    </a>
                </li>
                 <?php }?>
                </ul>
            <div class="clear">&nbsp;</div><!-- div 因 float:left 產生的問題所以要加 class="clear"，但這個空的div無意義所以還會有其他寫法 --> 
        </div>

   </div><!-- end content -->
   
   <div class="clear">&nbsp;</div><!-- 有時因 float:left 產生的問題所以要加 class="clear",但因為前面我已有寫過兩組所以這個刪除也不會造成錯位 --> 
                   
   <div id="footer"><!-- start footer -->
       <p>CopyRight© 2015 CONSUATE. All Rights Reserved.<br>
          地址：新北市251淡水區中正路257號／訂位專線：02-26228529／營業時間：10：30~22：00</p> 
   </div><!-- end footer -->
     
</div>
  
</body>

</html>

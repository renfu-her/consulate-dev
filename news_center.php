<?php
include("include/config.php");
include("include/DB.php");
require_once("include/functions.php");
SessionStart();
$ID=intval($_GET['ID']);
$diarysql="SELECT * FROM #@#news where ID='$ID'";
$diary1 = $db->Execute($diarysql);		  
$row_news = $diary1->FetchRow();
$ss=str_replace("\n","",$row_news['s_subject']);
$ss=str_replace("\r","",$ss);
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

<meta property="og:title" content="<?=$row_news['subject']?>"/> <!-- 分享的TITLE  -->
<meta property="og:description" content="<?=$ss?>"/> <!-- 分享的內容描述 -->
<meta property="og:url" content="http://www.consulate.idv.tw/news_center.php?ID=<?=$ID?>"/> <!-- 分享網頁的連結 -->
<meta property="og:site_name" content="淡水 領事館餐廳"/>
<meta property="og:type" content="website" />

<meta name="title" content="淡水 領事館餐廳" />
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
     
   <div class="clear">&nbsp;</div>
     
   
     <div id="content"><!-- end content -->
        
        <div class="newsC">
            <h2>活動訊息</h2>
            <ul>
                <li> 
                   <?php if($row_news['Image']!=""){?>
                    <img src="UserFiles/newsImages/<?=$row_news['Image']?>">
                    <?php }?>
                        <p class="date1"><?=$row_news['now_time']?></p> 
                        <h3><?=$row_news['subject']?></h3>
                        <div style="margin-left:20px">
                      <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fconsulate.idv.tw%2Fnews_center.php%3FID%3D<?=$ID?>&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=203445733098460" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true" width="600"></iframe>
                       <?php
					  		   
					   echo $row_news['content'];?></div>
              </li>
            </ul>
            <div class="clear">&nbsp;</div><!-- div 因 float:left 產生的問題所以要加 class="clear"，但這個空的div無意義所以還會有其他寫法 --> 
        </div>
        
        <div class="clear"></div><!-- 有時因 float:left 產生的問題所以要加 class="clear",但因為前面我已有寫過兩組所以這個刪除也不會造成錯位 --> 
                
       
            
             
            <div class="clear">&nbsp;</div><!-- div 因 float:left 產生的問題所以要加 class="clear"，但這個空的div無意義所以還會有其他寫法 --> 
        </div>

   </div><!-- end content -->
   
   <div class="clear">&nbsp;</div><!-- 有時因 float:left 產生的問題所以要加 class="clear",但因為前面我已有寫過兩組所以這個刪除也不會造成錯位 --> 
                   
   <div id="footer"><!-- start footer -->
       <p>CopyRight© 2015 CONSUATE. All Rights Reserved.<br>
          地址：新北市251淡水區中正路257號／訂位專線：02-26228529／營業時間：11：30~21：00</p> 
   </div><!-- end footer -->
     
</div>
  
</body>

</html>

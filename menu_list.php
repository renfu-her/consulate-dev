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
            <li style="padding-left: 250px;"><a href="about.html">關於我們</a> </li>
            <li ><a href="news_list.php">活動訊息</a> </li>
            <li><a href="menu_list.php">菜單介紹</a> </li>    
            <li><a href="surroundings.html">環境介紹</a></li>
            <li><a href="location.html">交通路線圖</a></li>
            <li><a href="connection.php">與我聯絡</a></li>
        </ul>
        </div>
        <div id="top_p">
            <div id="logo_p"><a href="index.php"><img src="images/logo.png" ></a></div>
         </div>
    </div><!-- end header_p -->
     
   <div class="clear">&nbsp;</div>
     
   
     <div id="content"><!-- end content -->
            <div class="page">
            <h2>菜單介紹</h2>
            <ul class="navM">
            <?php
            $rs_f = $db->Execute("SELECT * FROM #@#food order by ID asc");	
			while($row_f = $rs_f->FetchRow()){			
			?>
                    <li><a href="/menu_list_01.php?CID=<?=$row_f['ID']?>"><?=$row_f['className']?></a></li>
                    <?php }?>
                   
              </ul>
              <div class="clear">&nbsp;</div>

            <div class="newsE">
           <ul>
                <li> 
                 <img src="images/menu_p1.jpg">
               <p class="cont">為使入館貴賓享受不凡之格調及品質
                                請你我共同完成以下之愛的箴言</br>
                                1. 入館之貴賓，其最低消費為:每人須點一杯飲料。</br>
                                2. 為維護館內品質之保證,禁止貴賓攜帶外食。</br>
                                3. 禁止貴賓攜帶酒入館，若有自行帶酒飲用者，
                                4. 每瓶酌收新台幣300元。</br>
                                5. 入館之貴賓，禁止玩牌，賭博情事，以防止紛爭。</br>
                                6. 消費須另加10%服務費。<br>
               </p><!-- 這個字數過少會造成前端不平衡所以可以在這個命名加統一"高度" -->
                  
                  <img src="images/menu_p2.jpg">
             </li>
             
           </ul>
            
            <div class="clear">&nbsp;</div>
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

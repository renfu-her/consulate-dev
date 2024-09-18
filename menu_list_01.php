<?php
include("include/config.php");
include("include/DB.php");
require_once("include/functions.php");
SessionStart();
$CID=intval($_GET['CID']);
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
     
   <div class="clear">&nbsp;</div>
     
   
     <div id="content"><!-- end content -->
          
            
            
       
                     
            <div class="page">
            <h2>菜單介紹</h2>
            <ul class="navM">
                   <?php
            $rs_f = $db->Execute("SELECT * FROM #@#food order by ID asc");	
			while($row_f = $rs_f->FetchRow()){			
			if($CID==$row_f['ID']){$foodstr=$row_f['foodtime'];}
			$css="";
			if($row_f['ID']==$CID){$css="activition";}
			?>
              <li class="<?=$css?>"><a href="<?=$row_f['link']?>?CID=<?=$row_f['ID']?>"><?=$row_f['className']?></a></li>
                    <?php }?>
              </ul>
              <div class="clear"><Ul><li>&nbsp;</li>
              <li><?=nl2br($foodstr)?></li>
              <li>&nbsp;</li>
              </ul></div>

           
            <!-- 第一排 -->
            <ul class="newsA">
            <?php
            $diarysql="SELECT * FROM #@#product where list='Y' and CID='$CID' ORDER BY SortOrder asc,pro_id asc";
			$diary1 = $db->Execute($diarysql);		  
			$i=0;
			while($row_news = $diary1->FetchRow()){
			?>
                           <li> 
                    <?php if($row_news['Image']!=""){?>
                    <img src="UserFiles/ProductImages/<?=$row_news['Image']?>">
                    <?php }?>
                       <h3><?=$row_news['pro_name']?></h3>
                        <?=nl2br($row_news['info2'])?> <br>
             <p><br>
            <span class="cont_1">$<?=$row_news['price']?></span>
           
                        <!-- 這個字數過少會造成前端不平衡所以可以在這個命名加統一"高度" -->
                 
             </li>
             <?php }?>
               
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

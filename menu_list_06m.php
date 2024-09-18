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
			?>
                    <li><a href="<?=$row_f['link']?>?CID=<?=$row_f['ID']?>"><?=$row_f['className']?></a></li>
                    <?php }?>
              </ul>
              <div class="clear"><Ul><li>&nbsp;</li>
              <li><?=nl2br($foodstr)?></li>
              <li>&nbsp;</li>
              </ul></div>

           <?php
            $diarysql="SELECT * FROM #@#product where list='Y' and CID='$CID' ORDER BY SortOrder asc";
			$diary1 = $db->Execute($diarysql);		  
			$i=0;
			while($row_news = $diary1->FetchRow()){
			?>
            <div class="newsG">
                <div class="newsGimg">
				<?php if($row_news['Image']!=""){?>
                    <img src="UserFiles/ProductImages/<?=$row_news['Image']?>">
                    <?php }?></div>
                <div class="newsGcon">
                    <h3><?=$row_news['pro_name']?><span>$<?=$row_news['price']?></span></h3> 
                    <ul>
                       <?=$row_news['info2']?> 
                    </ul>
             </div>
           </div>
           <?php }?>
           

           <!--<li>
                  <img src="images/news2.jpg" alt=""><h3>單品 Coffee</h3>
                      領事館咖啡( 綜合咖啡豆) Consulate Coffee $120<br>
                      巴西咖啡 Brazi l$140<br>
                      摩卡咖啡 Mocha$140<br>
                      曼巴咖啡 Mandheling Brazil $150<br>
                      曼特寧咖啡 Mandheling $150<br>
                      藍山咖啡 Blue-mountain$160</li> 
                    
                </li>
               
                  
               <li><img src="images/news2.jpg"><h3>領事館熱茶 Hot Tea</h3>
                       新鮮水果茶 Fresh Fruit Tea (冰、熱Iced or Hot)<br>
                       桔茶 Little Tangerine Tea (冰、熱Iced or Hot)<br>
                       伯爵茶 Earl Grey Tea<br>
                       蘋果茶 Apple Tea<br>
                       錫蘭茶 Ceylon Tea(加鮮奶$20)                   
                </li>
                
                 <li><img src="images/news2.jpg"><h3>有機養生熱茶 ( 不含咖啡因) Hot Healthy Drinks Tea</h3>
                                  
                       有機元氣茶 Herbal Blend Man's Activity (奧地利)(孕婦不宜飲用) $220<br>
                       有機舒眠花茶 Herbal Blend Perfect World (德國) $220<br>
                       有機幸運花茶 Organic Fortune Herbal Tea (德國) $200<br>
                       有機晶瑩玫瑰花茶Fruit Pomegranate Organic (德國) $220<br>       
                </li>
          
           <li><img src="images/news2.jpg"><h3>冰咖啡 Iced coffee</h3>
                       冰美式咖啡( 黑咖啡) Iced American Coffee$120<br>
                       特調冰咖啡 Iced Coffee$140<br>
                       冰淇淋咖啡 Iced Coffee with Ice Cream$160<br>
                       冰拿鐵 Iced Caffè Latte$160<br>
                       冰榛果拿鐵 Iced Hazelnut Caffè Latte$170<br>
                       冰卡布奇諾 Iced Cappuccino$160<br>
                       冰焦糖瑪奇朵 Iced Caramel Macchiatto$170<br>
                       冰巧克力摩卡咖啡 Iced Caffè Mocha$170
                       
                       
                                         
                </li> -->
                   
              
            </div>
            
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

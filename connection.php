<?php

include("include/config.php");

include("include/DB.php");

require_once("include/functions.php");

SessionStart();

header("Cache-control: private"); 

if(isset($_POST['Submit'])){

	if(!isset($_SESSION['seccode']) || $_POST['code'] != $_SESSION['seccode']){

      echo "<script>alert('驗證碼錯誤!');history.go(-1);</script>";	 

	  exit();

    }

	if($_POST['sex']==""){

		echo "<script>alert('性別未選擇');history.go(-1);</script>";

		exit();

	}

	//mail start

	$body = "<html><META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=utf-8'><head><title>淡水 領事館餐廳與我聯絡需求</title></head>";
	$body .= "時間:".date("Y-m-d H:i:s")."<p>";
	$body .= "姓名:".$_POST['username']."<p>";
	$body .= "性別:".$_POST['sex']."<p>";
	$body .= "電話:".$_POST['tel_1']."-".$_POST['tel_2']."<p>";
	$body .= "手機:".$_POST['cellphone_1']."-".$_POST['cellphone_2']."-".$_POST['cellphone_3']."<p>";
	$body .= "電子郵件:".$_POST['email']."<p>";
	$body .= "需求說明:<BR>".nl2br($_POST['content'])."<p>";
    $body .="<FONT COLOR=#333333 size=2 face=Arial>======本信件由系統自動發送，請勿直接回覆本信件，謝謝!======</Font><br>";
    $body .="</body></html>";


    $org_subject="淡水領事館官網來信";
//
//    $from = "=?UTF-8?B?" . base64_encode($org_subject) . "?=";

    $title="與我聯絡需求";

//    $title="=?UTF-8?B?" . base64_encode($title) . "?=";

//    $url = 'http://admin-consulate.test/send-mail';
    $url = "https://admin.consulate.idv.tw/send-mail";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
        array("post"=>$_POST, "body" => $body, "title" => $title, "subject" => $org_subject)));
    $output = curl_exec($ch);
    curl_close($ch);

//
//
//			require("class.phpmailer.php");
//
//			$mail = new PHPMailer();
//
//			$mail->IsSMTP();
//
//
//
//	 		include("sendmail.php");

	echo "<script>alert('謝謝你的填寫，我們將會盡速處理信件!');location.href='connection.php';</script>";

//exit;
}

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

<script src="validator.js"></script> 

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

        

        <div class="newsD">

            <h2>與我聯絡</h2>

           <form method="post" name="form1" action="" onSubmit="return Validator.Validate(this,2)" enctype="multipart/form-data" >

            <fieldset>

                 <ol>

                 <li>若需訂位者，請用訂位專線：02-26228529預約 (非線上預約)</li>

                   <li>

                     <label for="name">姓名 :</label>

                     <input id="name" name="username" type="text" class="fildform" datatype="Require" msg="姓名未輸入" />

                   </li>

                  

                   <li>

                     <label for="Sex">性別 :</label>

                     <input id="Sex" name="sex" type="radio" value="男生"  class="fildform"/>男生

                      <input id="Sex" name="sex" type="radio" value="女生"  class="fildform"/>女生

                   </li>

                   <li>

                     <label for="phone">電話 :</label>

                     <input type="text" name="tel_1"  class="input" id="phone"  require="false" dataType="Integer" msg="電話第一欄請輸入數字" maxlength="3" style="width:30px" value="<?=$t[0]?>"/> - <input type="text" name="tel_2"  class="input"  style="width:80px" id="phone"  require="false" dataType="Integer" msg="電話第二欄話請輸入數字" maxlength="10" value="<?=$t[1]?>"/>(格式02-1234567)

                   </li>

                   <li>

                     <label for="phone2">手機 :</label>

                     <input type="text" name="cellphone_1"  class="input" style="width:40px" id="phone2"  require="true" dataType="Integer" msg="手機第一欄請輸入數字" maxlength="4" value="<?=$c[0]?>"/>-<input type="text" name="cellphone_2"  class="input"  style="width:40px" id="phone2" require="true" dataType="Integer" msg="手機第二欄請輸入數字" maxlength="3" value="<?=$c[1]?>"/>-<input type="text" name="cellphone_3"  class="input"  style="width:40px" id="phone2" require="true" dataType="Integer" msg="手機第三欄請輸入數字" maxlength="3" value="<?=$c[2]?>"/>(格式0123-456-789)

                   </li>

                   <li>

                     <label for="email">Email :</label>

                     <input id="email" name="email" type="text" class="fildform" dataType="Email" msg="Email格式不正確"/>

                   </li>

                   <li>

                     <label for="section">內容 :</label>

                      <textarea name="content" type="text" cols="40" rows="8" id="section" class="fildform" datatype="Require" msg="內容未輸入"/></textarea>

                   </li>

                   <li>

                     <label for="section">驗証碼 :</label>

                      <input type="text" name="code"  class="input" size="6" id="chick" dataType="Require" msg="驗証碼未輸入" maxlength="4"/>

                <img src="../include/code_image.php" onclick="var now = new Date();this.src='../include/code_image.php?'+ now;" style="vertical-align:middle;background:#ccc;border:solid 1px #eee;width:60px;height:20px"/>

                   </li>

                  <li><label>&nbsp;</label><input type="submit" name="Submit" value=" 送出表單 "></li>

                  </ol>

           </fieldset>

        </form>        

             

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


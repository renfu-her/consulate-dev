<?php 
require_once('config.php');

SessionStart();
NoCache();
ini_set("display_errors","On"); //显示所有错误信息
if(!empty($_POST['Username'])){
	
   if(!isset($_SESSION['seccode']) || $_POST['code'] != $_SESSION['seccode']){
      
	  GoTo2('login.php?err=0');
   }
   
   
   include_once(CLASS_DIR."admin.php");

   $admin = new admin();

   if($admin->Login()){
      GoTo2('index.php','','top');
   }else{
	  GoTo2('login.php?err=1','','top');
   }
   
}
$error = array($admin_lang['code_error'] , $admin_lang['username_or_password_is_invalid']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>淡水 領事館餐廳管理後台</title>

<style type="text/css">
<!--
body {
	background-color: #f6f6f6;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.div1 {  display: block;
  width: 65px;  /* 邊框寬度 */
  padding: 6px;  /* 字與框的距離 */
  text-align: center;
  
  background: #645f66;
  font-size:12px;
  color:#ffffff;
  -moz-border-radius: 10px / 10px;
  -webkit-border-radius: 10px / 10px;
  border-radius: 0px / 0px; /* 圓角角度 */
}
.style1 {	font-size: x-large;
	font-weight: bold;
	color:#f5333b;
}
.style2 {	font-family:"微軟正黑體", PMingLiU , Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight: bold;
	color: #515050;
	line-height: 22px; /* 字型行距 */
	letter-spacing: 1px; /* 字型間距 */
	text-align: right; 
}
-->
</style>
<style type="text/css">
<!--
html{
	overflow-x:hidden; SCROLLBAR-ARROW-COLOR: #aaa; overflow-y:auto;
	SCROLLBAR-FACE-COLOR: #fff; SCROLLBAR-3DLIGHT-COLOR: #fff; SCROLLBAR-DARKSHADOW-COLOR: #fff;	
	SCROLLBAR-HIGHLIGHT-COLOR: #aaa; SCROLLBAR-SHADOW-COLOR: #aaa; SCROLLBAR-TRACK-COLOR: #aaa;
}
#Layer1 {
	position:absolute;
	left:227px;
	top:150px;
	width:328px;
	height:137px;
	z-index:1;
}

body,td,th {
	font-size: 12px;
}
#login_form #Username {
	width: 140px;
	border: 1pt solid #666666;
}
#login_form #Password {
	width: 140px;
	border: 1pt solid #666666;
}
#login_form #code {
	width: 50px;
	border: 1pt solid #666666;
}
-->
</style>
</head>

<body onLoad="login_form.Username.focus();">
<form id="login_form" name="login_form" method="post" action="login.php">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="80">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="500" border="0" align="center" cellpadding="0" cellspacing="40" bgcolor="#E3E3E3">
     
      <tr>
        <td><table width="500" border="0" cellpadding="0" cellspacing="10" bordercolor="#666666" bgcolor="#FFFFFF">
            <tr>
              <td height="20" colspan="2" align="center"><?php if(isset($_GET['err'])) echo $error[$_GET['err']];?>&nbsp;</td>
            </tr>
            <tr>
              <td width="200" align="right"><a href="http://www.tihudashi.com.tw/" target="_blank"><img src="images/logo.png" alt="" border="0" /></a></td>
              <td width="276"><span class="style1">網站後台管理系統</span></td>
            </tr>
            <tr>
              <td class="style2">帳號：</td>
              <td><span class="text_05">
                <input type="text" name="Username"  class="input" size="15" id="Username"/>
              </span></td>
            </tr>
            <tr>
              <td class="style2">密碼：</span></td>
              <td><span class="text_05">
                <input type="password" name="Password"  class="input" size="15" id="Password"/>
              </span></td>
            </tr>
            <tr>
              <td class="style2">驗證碼：</td>
              <td><span class="text_05">
                <input type="text" name="code"  class="input" size="6" id="code" maxlength="4"/>
              </span><img src="../include/code_image.php" onclick="var now = new Date();this.src='../include/code_image.php?'+ now;" style="vertical-align:middle;background:#ccc;border:solid 1px #eee;" /></td>
            </tr>
            <tr>
              <td class="style2">&nbsp;</td>
              <td><INPUT type="image" src="images/log.gif" alt="" width="65" height="27" border="0" /></td>
            </tr>
            <tr>
              <td height="20" colspan="2" >&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      
    </table></td>
  </tr>
</table>
</form>
</body>
</html>

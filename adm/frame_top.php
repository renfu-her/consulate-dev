<?php require_once('confirm_login.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>frame_top</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="frame_top_layer">
  <div id="logo"><font style="color:#FF0000;font-size:18px;">淡水 領事館餐廳</font> 後台管理</div>
  <div id="frame_top_right"><a href="../" target="_blank"><img src="images/home.gif" alt="main page" width="21" height="21" border="0" align="middle" /> <?php echo $admin_lang['home_page'];?>&nbsp; </a> <a href="logout.php" target="_top"><img src="images/logout.gif" alt="Log out" width="20" height="21" border="0" align="middle" /> <?php echo $admin_lang['logout'];?></a>&nbsp; <a href="adm/admin_edit.php" target="mainFrame"><img src="images/vcard.png" width="16" height="16" border="0" />&nbsp; <?php echo $_SESSION['sess_admin']['Username']; ?></a>&nbsp;&nbsp;
   
   <?php
   if(count($language_array) > 1){
   ?>
   <label>
	<script language="javascript" type="text/javascript">
	function ChangeLanguage(lang){
	    var frame_top = self;
		var frame_left = top.frames[1];
		var frame_main = top.frames[2];
	    frame_left.location.href = 'frame_left.php?lang='+lang;
		frame_main.location.reload();
		frame_top.location.reload();
	}
	</script>
    <select name="lang" id="lang" onchange="ChangeLanguage(this.options[this.options.selectedIndex].value)">
	<?php
	foreach($language_array as $language){
	  $selected = ''; 
	  if($col_lang == $language) $selected = 'selected="selected"';
	  echo "<option value=\"$language\" $selected>".$admin_lang[$language]."</option>\n";
	}
	?>
    </select>
    </label>
   <?php } ?>
  </div>
</div>
</body>
</html>

<?php require_once('confirm_login.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>frame main</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="title_menu"><?php echo $db->GetOne("SELECT $col_Title FROM #@#system");?></div>

<div id="menu_bar"><img src="images/status_online.png" width="16" height="16" />&nbsp;<?php echo $_SESSION['sess_admin']['Username'];?></div>
<div id="main"></div>

</body>

</html>

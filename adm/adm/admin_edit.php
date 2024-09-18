<?php 
require_once('../confirm_login.php');

if(!empty($_POST['Submit'])){
  $admin->Update($_SESSION['sess_admin']['AdminID']);
  GoTo2("../logout.php",'','top');
}

$row = $admin->Select("AdminID=".$_SESSION['sess_admin']['AdminID'] , true);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin password edit</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="title_menu"><?php echo $admin_lang['change_password'];?></div>
<div id="menu_bar"><a href="Javascript:window.history.back();">Back</a></div>
<div id="main">
  <form id="form1" name="form1" method="post" action="">
    <table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td class="form_list_1"><?php echo $admin_lang['username'];?></td>
        <td class="form_list_2"><label>
          <input name="Username" type="text" id="Username" value="<?php echo $row['Username'];?>" />
        </label></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
        <td class="form_list_1"><?php echo $admin_lang['password'];?></td>
        <td class="form_list_2"><label>
          <input name="Password" type="text" id="Password" value="<?php echo $row['Password'];?>" />
        </label></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
        <td class="form_list_1"><?php echo $admin_lang['email'];?></td>
        <td class="form_list_2"><label>
          <input name="Email" type="text" id="Email" value="<?php echo $row['Email'];?>" />
        </label></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
        <td width="19%" class="form_list_1">&nbsp;</td>
        <td width="27%" class="form_list_2"><label>
          <input name="Submit" type="submit" id="Submit" value="<?php echo $admin_lang['submit'];?>" />
          <input name="Reset" type="reset" id="Reset" value="<?php echo $admin_lang['reset'];?>" />
        </label></td>
        <td width="54%" class="form_list_3">&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<?php $db->disConnect();?>
</body>
</html>

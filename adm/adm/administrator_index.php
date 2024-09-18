<?php 
require_once('../confirm_login.php');
//$admin->Competence("admin_select");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>administrator index</title>
<link href="../style.css" rel="stylesheet" type="text/css" /><script language="JavaScript" type="text/javascript" src="../../include/javascript/init.js"></script>
<script language="JavaScript" type="text/javascript" src="../../include/javascript/layer.js"></script>
<script language="javascript" type="text/javascript">

function cancel_delete(){
   HiddenObject('note_message_layer');
}
function confirm_delete(href){
   $('a_continue').href = href;
   BlockObject('note_message_layer');
   return false;
}
function continue_delete(){
  return true;
}
window.onload = function (){
  mouse_layer('note_message_layer');
}
</script>
</head>

<body>
<div id="note_message_layer">
  <div id="message_layer_bar">
    <div id="result_box" dir="ltr"><?php echo $admin_lang['confirmed_information'];?></div>
  </div>
  <div id="message_layer_main">
    <p><?php echo $admin_lang['confirm_delete_admin'];?></p>
    </div>
  <div id="message_button">[ <a href="#" onclick="return continue_delete()" id="a_continue"><?php echo $admin_lang['continue'];?></a> ]  [ <a href="javascript:cancel_delete();"><?php echo $admin_lang['cancel'];?></a> ]</div>
</div>


<div id="title_menu"><?php echo $admin_lang['administrators'];?> </div>
<div id="menu_bar"><?php
//if($admin->IsCompetence("admin_insert")){
?>
<input name="Submit" type="submit" id="Submit" value="新增資料" onclick="location='administrator_add.php'" />
<?php
//}
?>
</div>
<div id="main">
  <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#E8E9F9" class="main_table">
    <tr class="list_menu">
      <td width="22%"><?php echo $admin_lang['username'];?></td>
      <td width="25%"><a href="#"><?php echo $admin_lang['email'];?></a></td>
      <td width="13%">&nbsp;</td>
      <td width="29%">&nbsp;</td>
      <td width="11%" colspan="2" align="center"><?php echo $admin_lang['action'];?></td>
    </tr>
	<?php
	$rs = $db->Select("#@#administrators" , "AdminID > 1 ORDER BY AdminID DESC");
	$i = 0;
	while($row = $rs->FetchRow()){
	    $i++;
		$className = $i % 2 == 0 ? list_tr2 : list_tr1;   
	?>
    <tr class="<?php echo $className ;?>" onmousemove="this.className = 'list_tr3'" onmouseout="this.className = '<?php echo $className ; ?>'">
      <td class="line"><?php echo $row['Username'];?></td>
      <td class="line"><?php echo $row['Email'];?></td>
      <td class="line">&nbsp;</td>
      <td class="line">&nbsp;</td>
      <td class="line"><?php
	  //if($admin->IsCompetence("admin_update")){
	  ?>
	  <a href="administrator_edit.php?AdminID=<?php echo $row['AdminID'];?>"><img src="../images/icon_edit.gif" alt="編輯" width="18" height="17" border="0" /></a><?php //} ?>	  </td>
      <td class="line"><?php
	  //if($admin->IsCompetence("admin_delete")){
	  ?>
	    <a href="administrator_delete.php?AdminID=<?php echo $row['AdminID'];?>"><img src="../images/icon_delete.gif" alt="刪除" width="18" height="17" border="0" onclick="return confirm('確認刪除嗎？')" /></a>
	  <?php
	  //}
	  ?></td>
    </tr>
    <?php
	}
	?>
  </table>
</div>
<div id="pager"></div>
<?php $db->disConnect();?>
</body>
</html>

<?php 
require_once('../confirm_login.php');
require_once(ADMIN_DIR."include/Pager.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<script language="JavaScript" type="text/javascript" src="../../include/javascript/init.js"></script>
<script language="JavaScript" type="text/javascript" src="../../include/javascript/layer.js"></script>
<script language="JavaScript" type="text/javascript">
window.onload =  function (){mouse_layer('note_message_layer');}
</script>
<body>
<?php require_once('../include/ConfirmDelete.php'); 
$t = htmlspecialchars($_GET['t']);
if($t=="class"){$brandstr="第一分類";}
if($t=="class1"){$brandstr="第二分類";}
if($t=="class2"){$brandstr="第三分類";}
?>
<div id="title_menu">飲品/蛋糕/輕食分類</div>
<div id="menu_bar">

</div>
<div id="main"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr class="list_menu">
      <td width="60%">名稱</td>
      <td width="10%">狀態</td>
      <td width="10%">排列順序</td>
      <td align="center">操作</td>
    </tr>
	<?php
	$t = htmlspecialchars($_GET['t']);
	$Pager = new Pager(200);
	$Pager->Init("SELECT * FROM #@#$t order by #@#$t.SortOrder asc");
	while($row = $Pager->FetchRow()){	  
	?>
    <tr <?php echo $Pager->ListClass();?>>
      <td class="line"><?php echo $row['className'];?></td>
      <td class="line"><?php echo ($row['list']=='Y'?"<font color=red>上架</font>":"下架");?></td>
      <td class="line"><?php echo $row['SortOrder'];?></td>
     <td width="9%" align="center" class="line">
	   <? //if($admin->IsCompetence("product_update")){?>
	   <a href="class_edit.php?ID=<?php echo $row['ID'];?>&t=<?php echo $t;?>"><img src="../images/application_edit.png" alt="<?php echo $admin_lang['edit'];?>" width="16" height="16" border="0" /></a>
	    <? //}?>	   </td>
      
	  
    </tr>
  <?php } ?>
  </table>
</div>
<?php $db->disConnect();?>
</body>
</html>

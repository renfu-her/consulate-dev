<?php 
require_once('../confirm_login.php'); 
//require_once(CLASS_DIR.'category.php');
 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link href="../style.css" rel="stylesheet" type="text/css" />

  <script src="../jsPrototype/lib/prototype.js" type="text/javascript"></script>
  <script src="../jsPrototype/src/scriptaculous.js" type="text/javascript"></script>
  <script src="../jsPrototype/src/unittest.js" type="text/javascript"></script>
  <style type="text/css" media="screen">
    .inplaceeditor-saving { background: #c6ffaa; }
  </style>
</head>

<body>
<div id="title_menu"><?php echo $admin_lang['adminnews'];?> &gt; <?php echo $admin_lang['adminnews'];?>列表</div>
<div id="menu_bar">
  <form action="" method="get" enctype="application/x-www-form-urlencoded" name="form1" id="form1" style="width:70%;float:left;text-align:left;">
    <label>
     <select name="CID" id="CID">
	     
		  <option value="now_time" <?php if($_GET['CID']=="now_time"){ echo "selected";}?>>日期</option>
		  <option value="subject" <?php if($_GET['CID']=="subject"){ echo "selected";}?>>新聞主題</option>
		  
          </select>
		  
		  </label>
		  <label>
    <input name="keywords" type="text" id="keywords" <?php if(isset($_GET['keywords']) && $_GET['keywords'] != '') echo " value=\"".$_GET['keywords']."\"";?> />
    </label>
      <label>
      <input name="Submit" type="submit" id="Submit" value="查詢" />
      </label>
  </form>
  <label style="width:30%;">
 
  
  
  </label>
</div>
 <div id="main">
   <table width="100%" border="0" cellspacing="1" cellpadding="1">
     <tr class="list_menu">
       <td width="17%">日期</td>
       <td width="50%">標題</td>
       <td width="20%">狀態</td>
       <td colspan="2" align="center">操作</td>
     </tr>
	 <?php
	 
	 include_once(ADMIN_DIR."include/Pager.php");
	 $Pager = new Pager(15);
	 $where = "WHERE 1";	 
	 if(isset($_GET['keywords'])){
	   $keywords = htmlspecialchars($_GET['keywords']);
	   $where .=" AND ".$_GET['CID']." LIKE '%$keywords%'";
	   
	 }
	 
	 function keyfont($str){
	    
	    if(!isset($_GET['keywords']) || $_GET['keywords'] == '') return $str;
	    $keywords = $_GET['keywords'];
		
		if(false !== strpos($str , $keywords )){
		  $str = str_replace($keywords , "<font color=red>$keywords</font>" , $str);
		}
		return $str;
		
	 }

	 $Pager->Init("SELECT * FROM soho_news $where ORDER BY now_time desc,ID desc");
	 while($row = $Pager->FetchRow()){

         var_dump($row);
	 ?>
     <tr <?php echo $Pager->ListClass();?>>
       <td class="line"><?php echo keyfont($row['now_time']);?>&nbsp;</td>
       <td class="line"><?php echo keyfont($row['subject']);?></td>
       <td class="line"><?php echo ($row['list']=='Y'?"<font color=blue>上架</font>":"下架");?></td>
       
       <td width="4%" align="center" class="line">
         
       <a href="edit.php?ID=<?php echo $row['ID'];?>"><img src="../images/icon_edit.gif" alt="編輯" width="18" height="17" border="0" /></a>       </td>
       <td width="4%" align="center" class="line">
	   
	   <a href="delete.php?ID=<?php echo $row['ID'];?>"><img src="../images/icon_delete.gif" alt="刪除" width="18" height="17" border="0" onclick="return confirm('確認刪除嗎？')" /></a>       </td>
     </tr>
	 <?php } ?>
   </table>
   <div id="Pager"><?php echo $Pager->AdminPager();?>
   </div>

 </div>

<?php $db->disConnect();?>
</body>
</html>

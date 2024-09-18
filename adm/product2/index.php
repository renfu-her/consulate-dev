<?php 
require_once('../confirm_login.php'); 
$catid=htmlspecialchars($_GET['catid']);
$keywords = htmlspecialchars($_GET['keywords']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="../style.css" rel="stylesheet" type="text/css" />

  <script src="../jsPrototype/lib/prototype.js" type="text/javascript"></script>
  <script src="../jsPrototype/src/scriptaculous.js" type="text/javascript"></script>
  <script src="../jsPrototype/src/unittest.js" type="text/javascript"></script>
  <style type="text/css" media="screen">
    .inplaceeditor-saving { background: #c6ffaa; }
  </style>
</head>

<body>
<div id="title_menu">飲品/蛋糕/輕食內容</div>
<div id="menu_bar">
  <form action="" method="get" enctype="application/x-www-form-urlencoded" name="form1" id="form1" style="width:70%;float:left;text-align:left;">
    <label>
      <select name="CID" id="CID">	     
	    <option value="pro_name" <?php if($_GET['CID']=="pro_name"){ echo "selected";}?>>菜單名稱</option>		 	  
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
       <td width="20%">菜單分類</td>
       <td width="49%">菜單名稱</td>
       <td width="7%">售價</td>
       <td width="7%">排序</td>
       <td width="10%" align="center">是否上架</td>
       <td colspan="2" align="center">操作</td>
     </tr>
	 <?php
	 
	 include_once(ADMIN_DIR."include/Pager.php");
	 $Pager = new Pager(30);
	 $where = "WHERE 1";	 
	 if($keywords!=""){ 	   	 
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
	
	$rs_CID = $db->Execute("SELECT * FROM #@#class order by ID asc");	
	while($row_CID = $rs_CID->FetchRow()){			
			$CID_array[$row_CID['ID']]=$row_CID['className'];
	}
	
	
	if($catid!=""){
		$where .=" AND CID='$catid'";
	}
	 $psql="SELECT * from #@#product $where and CID=6 order by pro_id desc";
	 $Pager->Init($psql);
	 while($row = $Pager->FetchRow()){
		
	 ?>
     <tr <?php echo $Pager->ListClass();?>>
       <td class="line"><?php echo $CID_array[$row['CID1']];?></td>
       <td class="line"><?php echo keyfont($row['pro_name']);?></td>
       <td align="center"class="line"><?php echo keyfont($row['price']);?>&nbsp;</td>
       <td align="center"class="line">&nbsp;<?php echo keyfont($row['SortOrder']);?></td>
       <td align="center" class="line"><?php echo ($row['list']=='Y'?"<font color='#0000FF'>是</font>":"否");?></td>
       <td width="3%" align="center" class="line"><a href="edit.php?ID=<?php echo $row['pro_id'];?>&catid=<?=$catid?>&Page=<?=$Page?>"><img src="../images/icon_edit.gif" alt="編輯" width="18" height="17" border="0" /></a>
	    	   </td>
       <td width="4%" align="center" class="line">
	  
	   <a href="delete.php?ID=<?php echo $row['pro_id'];?>"><img src="../images/icon_delete.gif" alt="刪除" width="18" height="17" border="0" onclick="return confirm('確認刪除嗎？')" /></a>
	      </td>
     </tr>
	 <?php } ?>
   </table>
   <div id="Pager"><?php echo $Pager->AdminPager();?></div>

 </div>

<?php $db->disConnect();?>
</body>
</html>

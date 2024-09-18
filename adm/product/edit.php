<?php 
require_once('../confirm_login.php');
$save_dir = ROOT_DIR."UserFiles/ProductImages/";
include_once(CLASS_DIR."Upload.php");
include_once(CLASS_DIR."ReduceImage.php");
header("Cache-control: private"); 
$ID = intval($_GET['ID']);
$catid=htmlspecialchars($_GET['catid']);
if(isset($_POST['Submit'])){
  if($_POST['price']==0){
		echo "<script>alert('價格不可為0!');history.go(-1);</script>";
		exit();  
  }
  $post = array();
  $post['info1'] = GetCurImage($_POST['info1']);
  $x=str_replace("'", "&#39;", $_POST['info2']);
  $post['info2'] = GetCurImage($x);
  
  include("../ImageResize.php");  
  for($i=0;$i<2;$i++){	
		if(!empty($_FILES['file']['name'][$i]))
		{
        srand((double)microtime()*1000000);
	    $rd=rand(10000000,99999999);
		$rd="$rd"."$i";
		$userfile_tmp 	= $_FILES["file"]["tmp_name"][$i]; 	//上傳圖檔(暫存位置)
		$userfile_name 	= $_FILES["file"]["name"][$i];		//上傳後的圖檔名稱
		$size_1 		= $_FILES["file"]["size"][$i];
		$splitS			= explode(".",$userfile_name);
		$suffix			= $splitS[(count($splitS)-1)];
		$imgsize   =   GetImageSize($userfile_tmp);
		//$imgsize[1];//高  $imgsize[0];//寬			
		//上傳格式檢查
		if(strtolower($suffix) != "jpg" && strtolower($suffix) != "gif" && strtolower($suffix) != "png" && strtolower($suffix) != "")
		{echo"<script>alert('上傳圖片限 jpg 或 gif 或 png 格式!!');history.go(-1);</script>";exit();}
			$pic_name	=$rd.".".$suffix;
			$img_resize1="../../UserFiles/ProductImages/".$pic_name;
			$img_resize2="../../UserFiles/ProductImages/s".$pic_name;
		    copy($_FILES['file']['tmp_name'][$i],$img_resize1);				
			if($i==0){		
					$post['Image']=$pic_name;
					if($imgsize[0]>400){
						$srcW = 400;
						$WW=$srcW/$imgsize[0];//縮的比例					
						$srcH = $WW*$imgsize[1];	
						ImageResize($img_resize1, $img_resize1,$srcW,$srcH);
					}
						//小圖
						$srcW = 220;
						$WW=$srcW/$imgsize[0];//縮的比例					
						$srcH = $WW*$imgsize[1];	
						ImageResize($img_resize1, $img_resize2,$srcW,$srcH);
			}
				if($i==1){		
					$post['Image1']=$pic_name;
					if($imgsize[0]>220){
						$srcW = 220;
						$WW=$srcW/$imgsize[0];//縮的比例					
						$srcH = $WW*$imgsize[1];	
						ImageResize($img_resize1, $img_resize1,$srcW,$srcH);
					}
				}
				
				/**
					$WW=400/$imgsize[0];//縮的比例
					$srcW = $WW*$imgsize[0];
					$srcH = 400;
					$t = new Photo();
					$t->setWidth($srcW);
					$t->setHeight($srcH);			
					$t->setNewPicPath("../../UserFiles/newsImages/");				
					$rs= $t->creatIMG($img_resize1,1);
				**/
				
				$file = ROOT_DIR."UserFiles/ProductImages/".$_POST['tmpImage'.$i];					 
				if(file_exists($file) && is_file($file)) unlink($file);
				$file2 = ROOT_DIR."UserFiles/ProductImages/s".$_POST['tmpImage'.$i];					 
				if(file_exists($file2) && is_file($file2)) unlink($file2);
			
			
		}
		
   }//for
  $post['color'] = implode(",",(array)$_POST['color']);
  $db->Update("#@#product" ,"pro_id=$ID" ,  $post);
  
  GoTo2("edit.php?ID=".$_POST['ID'].'&catid='.$_POST['catid2'].'&Page='.$_POST['Page']);
  
}

$row = $db->GetRow("SELECT * FROM #@#product WHERE pro_id=$ID");
function IsCompetenceX($Competence,$dbCompetence){ 
      return in_array($Competence ,split(",",$dbCompetence));
	  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../style.css" rel="stylesheet" type="text/css" />

<script src="../../validator.js"></script>
<script src="../ckeditor/ckeditor.js" type="text/javascript"><!--mce:2--></script>
</head>

<body>
<div id="title_menu"><a href="index.php"><?php echo $admin_lang['product_management'];?></a> &gt; 修改菜單 </div>
<div id="menu_bar">
  <label>
  <input name="back" type="button" id="back" value="<?php echo $admin_lang['back'];?>" onclick="javascript:location.href='index.php';" />
  </label>

</div>
<div id="main">
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return Validator.Validate(this,2)">
	<input type="hidden" name="tmpImage0" value="<?=$row['Image']?>" />
<input type="hidden" name="tmpImage1" value="<?=$row['Image1']?>" />
<input type="hidden" name="tmpImage2" value="<?=$row['Image2']?>" />
<input type="hidden" name="Page" value="<?=$Page?>" />
<input type="hidden" name="ID" value="<?=$ID?>" />
<input type="hidden" name="catid2" value="<?=$catid?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="16" class="form_list_1">*菜單分類</td>
          <td class="form_list_2">
          <select name="CID" dataType="Require" msg="菜單分類未輸入">		  
		  
	<?php	
	$rs_class = $db->Execute("SELECT * FROM #@#food where ID<>6 order by SortOrder asc");	
	while($row_class = $rs_class->FetchRow()){	
	?>
	<option value="<?php echo $row_class['ID'];?>" <? if($row['CID']==$row_class['ID']){echo "selected";}?>><?php echo $row_class['className'];?></option>
	 <?php }?> 
	 </select>
        </td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
        <?php if($row['CID']==1){?>
      <?php }?>
        <tr>
          <td width="9%" height="16" class="form_list_1">*菜單名稱</td>
          <td width="63%" class="form_list_2"><label>
            <input name="pro_name" type="text" id="ProName" size="50" dataType="Require" msg="菜單名稱未輸入" value="<?=$row['pro_name']?>"/>
          </label></td>
          <td width="28%" class="form_list_3">&nbsp;</td>
        </tr>
       
		 
        <tr>
          <td class="form_list_1">是否上架</td>
          <td class="form_list_2"><input type="radio" name="list" value="Y" <?php if($row['list']=="Y"){echo "checked";}?>/>是 <input type="radio" name="list" value="N" <?php if($row['list']=="N"){echo "checked";}?> />否</td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
        <!--
         <tr>
           <td class="form_list_1">排序</td>
           <td class="form_list_2"><input type="text" name="SortOrder" size="5" value="<?=$row['SortOrder']?>"/></td>
           <td class="form_list_3">&nbsp;</td>
         </tr>
          !-->
        <tr>
          <td class="form_list_1">*價錢</td>
          <td class="form_list_2"><input name="price" type="text" id="price" size="10" value="<?php echo ($row['price']==0?"":$row['price']);?>" require="true" dataType="Integer" msg="價錢請輸入整數"/></td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
       
        
      <tr>
          <td class="form_list_1">排序</td>
          <td class="form_list_2"><INPUT type="text" name="SortOrder" value="<?php echo $row['SortOrder'];?>" size="5" />(由小到大)</td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
		 <tr>
          <td class="form_list_1">店長推薦</td>
          <td class="form_list_2"><input type="radio" name="command" value="Y" <?php if($row['command']=="Y"){echo "checked";}?>/>是 <input type="radio" name="command" value="N" <?php if($row['command']=="N"){echo "checked";}?> />否</td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
        <tr>
          <td class="form_list_1">圖片</td>
          <td class="form_list_2"><label>
		  
            <input name="file[]" type="file" id="file[]" />
(尺寸建議寬290) </label><br />
<?php if($row['Image']!=""){?>
         <img src="../../UserFiles/ProductImages/<?=$row['Image']?>">
         <?php }?></td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
		 <tr>
		  <td class="form_list_1">菜單說明</td>
		  <td colspan="2" class="form_list_2">
	<?php if($row['CID']==7){?>
	<textarea id="editor12" class="ckeditor" cols="80" rows="7" name="info2"><?php echo $row['info2'];?></textarea>	
    <?php }else{?>
    <textarea cols="80" rows="7" name="info2"><?php echo $row['info2'];?></textarea>	
    <?php }?>	 </td>
	    </tr>	
        <tr>
          <td class="form_list_1">&nbsp;</td>
          <td class="form_list_2"><label>
            <input type="submit" name="Submit" value="<?php echo $admin_lang['submit'];?>" />
          </label></td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
      </table>
  </form>
</div>
<?php $db->disConnect();?>
</body>
</html>

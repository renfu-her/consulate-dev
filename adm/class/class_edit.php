<?php 
require_once('../confirm_login.php');
//$admin->Competence('product_update');
$ID = intval($_GET['ID']);
$t = htmlspecialchars($_GET['t']);
if(isset($_POST['Submit'])){
  $post=array();
  $post['content'] = GetCurImage($_POST['content']);
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
		{echo"<script>alert('上傳圖片限 jpg 或 gif 或 png  格式!!');history.go(-1);</script>";exit();}
			$pic_name	=$rd.".".$suffix;
			$img_resize1="../../UserFiles/ProductImages/".$pic_name;
			
		    copy($_FILES['file']['tmp_name'][$i],$img_resize1);	
			
						
				$post['Image']=$pic_name;
			
				if($imgsize[0]>290){
					$WW=290/$imgsize[0];//縮的比例
					$srcW = 290;
					$srcH = $WW*$imgsize[1];	
					ImageResize($img_resize1, $img_resize1,$srcW,$srcH);
				}
			
				
				$file = ROOT_DIR."UserFiles/ProductImages/".$_POST['tmpImage0'];					 
				if(file_exists($file) && is_file($file)) unlink($file);
			
			
		}
		
   }//for
  $db->Update("#@#$t" , "ID=$ID",  $post);
  GoTo2('class_index.php?t='.$t);
}
$row  = $db->GetRow("SELECT * FROM #@#$t WHERE ID=$ID");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<script src="../../validator.js"></script>
<body>
<div id="title_menu">修改資料</div>
<div id="menu_bar"><input name="back" type="button" id="back" value="<?php echo $admin_lang['back'];?>" onclick="Javascript:window.history.back();void(0);" /></div>
<div id="main">
  <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" onSubmit="return Validator.Validate(this,2)">
  <input type="hidden" name="tmpImage0" value="<?=$row['Image']?>" />
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8%" class="form_list_1">標題</td>
        <td width="58%" class="form_list_2"><label>
          <input name="className" type="text" id="className" value="<?php echo $row['className'];?>" size="50" />
        </label></td>
        <td width="34%" class="form_list_3">&nbsp;</td>
      </tr>
       <tr>
        <td class="form_list_1">排列順序</td>
        <td class="form_list_2"><input name="SortOrder" type="text" id="SortOrder" value="<?php echo $row['SortOrder'];?>" size="5"/></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
          <td class="form_list_1">是否上架</td>
          <td class="form_list_2"><input type="radio" name="list" value="Y" <?php if($row['list']=="Y"){echo "checked";}?>/>是 <input type="radio" name="list" value="N" <?php if($row['list']=="N"){echo "checked";}?> />否</td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
      <tr>
        <td class="form_list_1">圖片</td>
        <td class="form_list_2"><input type="file" name="file[]" size="10" />
          (寬290，高不限)<br />
<?php if($row['Image']!=""){?>
         <img src="../../UserFiles/ProductImages/<?=$row['Image']?>">
         <?php }?></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
        <td class="form_list_1">&nbsp;</td>
        <td class="form_list_2"><label>
          <input type="submit" name="Submit" value="送 出" />
        </label></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<?php $db->disConnect();?>
</body>
</html>

<?php 
require_once('../confirm_login.php');
header("Cache-control: private"); 

//$admin->Competence("product_insert");

if(isset($_POST['Submit'])){
  if($_POST['price']==0){
		echo "<script>alert('價格不可為0!');history.go(-1);</script>";
		exit();  
  }
  $post=array();
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
			
		    copy($_FILES['file']['tmp_name'][$i],$img_resize1);				
			$post['Image']=$pic_name;
				if($imgsize[0]>290){
						$srcW = 290;
						$WW=$srcW/$imgsize[0];//縮的比例					
						$srcH = $WW*$imgsize[1];	
						ImageResize($img_resize1, $img_resize1,$srcW,$srcH);
				}
		}
   }//for 
  $newID=$db->Insert("#@#product" , $post);
  $ID=$db->Insert_ID($newID);
  GoTo2("index.php");
  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script src="../../validator.js"></script>
</head>
<body>
<script src="../ckeditor/ckeditor.js" type="text/javascript"><!--mce:2--></script>
<div id="title_menu"><a href="index.php"><?php echo $admin_lang['product_management'];?></a> &gt; 新增菜單</div>
<div id="menu_bar">
  <label>
  <input name="back" type="button" id="back" value="<?php echo $admin_lang['back'];?>" onclick="window.history.back();" />
  </label>

</div>
<div id="main">
    <form action="" method="post" enctype="multipart/form-data" name="FEeditForm" id="form1" onSubmit="return Validator.Validate(this,2)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="16" class="form_list_1">*菜單分類</td>
          <td class="form_list_2"><select name="CID" dataType="Require" msg="產品分類未輸入">		  
		  
	<?php	
	$rs_class = $db->Execute("SELECT * FROM #@#food where ID<>6 order by SortOrder asc");	
	while($row_class = $rs_class->FetchRow()){	
	?>
	<option value="<?php echo $row_class['ID'];?>"><?php echo $row_class['className'];?></option>
	 <?php }?> 
	 </select></td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
        <tr>
          <td width="9%" height="16" class="form_list_1">*菜單名稱</td>
          <td width="63%" class="form_list_2"><label>
            <input name="pro_name" type="text" id="ProName" size="50" dataType="Require" msg="菜單名稱未輸入"/>
          </label></td>
          <td width="28%" class="form_list_3">&nbsp;</td>
        </tr>
        
        <tr>
          <td class="form_list_1">是否上架</td>
          <td class="form_list_2"><input type="radio" name="list" value="Y" checked="checked"/>是 <input type="radio" name="list" value="N"/>否</td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
        <!--
         <tr>
           <td class="form_list_1">排序</td>
           <td class="form_list_2"><input type="text" name="SortOrder" size="5" value="0"/></td>
           <td class="form_list_3">&nbsp;</td>
         </tr>
         !-->
        <tr>
          <td class="form_list_1">*價錢</td>
          <td class="form_list_2"><input name="price" type="text" id="price" size="10" value=""/></td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
        <tr>
          <td class="form_list_1">排序</td>
          <td class="form_list_2"><INPUT type="text" name="SortOrder" value="0" size="5" />(由小到大)</td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
        <tr>
          <td class="form_list_1">店長推薦</td>
          <td class="form_list_2"><input type="radio" name="command" value="Y"/>是 <input type="radio" name="command" value="N" checked="checked"/>否</td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
        <tr>
          <td class="form_list_1">圖片</td>
          <td class="form_list_2"><label>
		  
            <input name="file[]" type="file" id="file[]" />
(尺寸建議寬290) </label></td>
          <td class="form_list_3">&nbsp;</td>
        </tr>
		 <tr>
		  <td class="form_list_1">菜單說明</td>
		  <td colspan="2" class="form_list_2">
       <?php if($row['CID']==7){?>
	<textarea id="editor12" class="ckeditor" cols="80" rows="7" name="info2"><?php echo $row['info2'];?></textarea>	
    <?php }else{?>
    <textarea cols="80" rows="7" name="info2"><?php echo $row['info2'];?></textarea>	
    <?php }?>
    </td>
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

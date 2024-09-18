<?php 
require_once('../confirm_login.php'); 

$ID = intval($_GET['ID']);
if(isset($_POST['Submit'])){
  $post = array();
  $ID=$_POST['ID'];
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
		{echo"<script>alert('上傳圖片限 jpg 或 gif 或 png 格式!!');history.go(-1);</script>";exit();}
			$pic_name	=$rd.".".$suffix;
			$img_resize1="../../UserFiles/newsImages/".$pic_name;
			$img_resize2="../../UserFiles/newsImages/s".$pic_name;
		    copy($_FILES['file']['tmp_name'][$i],$img_resize1);	
			
						
				$post['Image']=$pic_name;
				if($imgsize[0]>288){
						$srcW = 288;
						$WW=$srcW/$imgsize[0];//縮的比例					
						$srcH = $WW*$imgsize[1];	
						ImageResize($img_resize1, $img_resize2,$srcW,$srcH);
				}else{
						ImageResize($img_resize1, $img_resize2, $imgsize[0],$imgsize[1]);
				}
				
				$file = ROOT_DIR."UserFiles/newsImages/".$_POST['tmpImage0'];					 
				if(file_exists($file) && is_file($file)) unlink($file);
				$file = ROOT_DIR."UserFiles/newsImages/s".$_POST['tmpImage0'];					 
				if(file_exists($file) && is_file($file)) unlink($file);
			
		}
		
   }//for
  
  $db->Update("#@#news" ,"ID=$ID",$post);
  GoTo2('index.php');
}
$row = $db->GetRow("SELECT * FROM #@#news WHERE ID=$ID");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<script src="../ckeditor/ckeditor.js" type="text/javascript"><!--mce:2--></script> 
<script src="../../validator.js"></script>
<body>
<div id="title_menu"><a href="index.php"><?php echo $admin_lang['adminnews'];?></a> &gt;  修改<?php echo $admin_lang['adminnews'];?></div>
<div id="menu_bar">
  <label>
  <input name="Submit" type="button" id="Submit" onclick="window.history.back();" value="&lt; 返 回 " />
  </label>
</div>
 <div id="main">
   <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return Validator.Validate(this,2)">
   <input type="hidden" name="tmpImage0" value="<?=$row['Image']?>" />
   <input type="hidden" name="ID" value="<?=$ID?>" />
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
         <td class="form_list_1">日 期</td>
         <td class="form_list_2"><input name="now_time" type="text" id="now_time" size="20" value="<?php echo $row['now_time'];?>"/>          </td>
         <td class="form_list_3">&nbsp;</td>
       </tr>
       <tr>
         <td class="form_list_1">*標題</td>
         <td class="form_list_2"><input name="subject" type="text" id="subject" size="50" value="<?php echo $row['subject'];?>" dataType="Require" msg="標題未輸入"/></td>
         <td class="form_list_3">&nbsp;</td>
       </tr>
        <tr>
         <td class="form_list_1">圖片</td>
         <td class="form_list_2"><input type="file" name="file[]" size="10" />           
         (圖片建議尺寸為：850x399pix)<br />
         <?php if($row['Image']!=""){?>
         <img src="../../UserFiles/newsImages/<?=$row['Image']?>">
         <?php }?></td>
         <td class="form_list_3">&nbsp;</td>
       </tr>
     <tr>
          <td class="form_list_1">上架</td>
          <td class="form_list_2"><input type="radio" name="list" value="Y" <?php if($row['list']=="Y"){echo "checked";}?>/>上架 <input type="radio" name="list" value="N" <?php if($row['list']=="N"){echo "checked";}?>/>下架 </td>
          <td class="form_list_3">&nbsp;</td>
       </tr>
<tr>
         <td class="form_list_1">簡短內容</td>
         <td class="form_list_2">
         <textarea cols="70" rows="5" name="s_subject" dataType="Limit" max="34" msg="簡短內容限 34 個字內"><?php echo $row['s_subject'];?></textarea>	
         (文字限：34 字內)	 	</td>
         <td class="form_list_3">&nbsp;</td>
       </tr>
       <tr>
         <td class="form_list_1">內容</td>
         <td class="form_list_2">		
<textarea id="editor12" class="ckeditor" cols="80" rows="7" name="content"><?php echo $row['content'];?></textarea> </td>
         <td class="form_list_3">&nbsp;</td>
       </tr>
         <td class="form_list_1">&nbsp;</td>
         <td class="form_list_2"><label>
           <input name="Submit" type="submit" id="Submit" value=" 送 出 " />
         </label></td>
		 <td></td>
       </tr>
     </table>
   </form>
 </div>
 <?php $db->disConnect();?>
</body>
</html>

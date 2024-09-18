<?php 
require_once('../confirm_login.php');
//$admin->Competence("admin_update");

$AdminID = intval($_GET['AdminID']);

if(!empty($_POST['Submit'])){
     
	 
    if($_POST['Username'] == '') GoTo2("back",$admin_lang['username_empty']);
    if($admin->UserIsExists($_POST['Username'] , $AdminID)){
	   GoTo2("back",$admin_lang['username_exists']);
	} 
	
    $admin->Update($AdminID);
	GoTo2("administrator_index.php");
}

$row = $admin->Select("AdminID=$AdminID" , true);
$dbCompetence1=$row['Competence1'];
function IsCompetenceX($Competence,$dbCompetence){      
      return in_array($Competence ,explode(",",$dbCompetence));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>administrator add</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="../../include/javascript/init.js"></script>
<script language="javascript" type="text/javascript">

function input_style(){

   var inputs = document.getElementsByTagName('input');
   for(var i = 0; i<inputs.length; i ++){
      if(inputs[i].type == 'text' || inputs[i].type == 'password'){
         inputs[i].onfocus = function(){
	     this.style.backgroundColor = '#FFFFCC';
	  }
	 inputs[i].onblur = function(){
	   this.style.backgroundColor = '#FFFFFF';
	 }
    }
  }
}


</script>

<script language="JavaScript" type="text/javascript">
function select_all(checked , parent_tag){
   if(!parent_tag){
      var parent_tag = document ;
   }
   
   var inputs = parent_tag.getElementsByTagName('input');
   for( var i = 0; i < inputs.length ; i++ ){
      if(inputs[i].type == 'checkbox'){
	     inputs[i].checked = checked;
	  }
   }
}

function get_tr_object(obj){
   
    if(obj.tagName && obj.tagName == 'TR') return obj;
	else return get_tr_object(obj.parentNode);
}

function select_one_all(obj){
  var checked = obj.checked;
  var tr = get_tr_object(obj);
  
  var e = tr.getElementsByTagName('input');
  
  for(var i = 0; i < e.length;i++){
     if(e[i].type == 'checkbox'){
	     
		e[i].checked = checked;
		  
	 }
  }
}

function setup_checked (){
   var checked_arr = '<?php echo $row['Competence1'];?>'.split(",");
   var e = $('form1').elements;
   for(var i=0; i < e.length; i++){
      if(e[i].type == 'checkbox'){
	     if(in_array(e[i].value , checked_arr)){
		   e[i].checked = true;
		 }
	  }
   }
      
}
function in_array(str , arr){
    for(var i=0;i<arr.length;i++){
	   if(arr[i] == str) return true;
	}
	return false;
}

//window.onload = function (){
//   setup_checked();
//}      
</script>
</head>

<body>
<div id="title_menu"><a href="administrator_index.php"><?php echo $admin_lang['administrators'];?></a> &gt; <?php echo $row['Username'] ;?></div>
<div id="menu_bar"><input name="back" type="button" id="back" value="<?php echo $admin_lang['back'];?>" onclick="javascript:location.href='administrator_index.php';" /></div>
<div id="main">
  <form id="form1" name="form1" method="post" action="">
    <table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr class="list_menu">
        <td><?php echo $admin_lang['login_information'];?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
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
        <td class="form_list_1"><label for="checkbox_row_9"><?php echo $admin_lang['remarks'];?></label></td>
        <td class="form_list_2"><label>
          <textarea name="Remarks" cols="40" id="Remarks"><?php echo $row['Remarks'];?></textarea>
        </label></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
       <tr>
        <td class="form_list_1">身分</td>
        <td class="form_list_2"><select name="GroupID">
        <option value="0" <?php if($row['GroupID']==0){echo "selected";}?>>總管理員</option>
        <option value="1" <?php if($row['GroupID']==1){echo "selected";}?>>一般管理員</option>
        </select></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
        <td width="13%" class="form_list_1">&nbsp;</td>
        <td width="52%" class="form_list_2"><label>
          <input name="Submit" type="submit" id="Submit" value="<?php echo $admin_lang['submit'];?>" />
        </label></td>
        <td width="35%" class="form_list_3">&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<script language="javascript" type="text/javascript"> input_style(); </script>
<?php $db->disConnect();?>
</body>
</html>

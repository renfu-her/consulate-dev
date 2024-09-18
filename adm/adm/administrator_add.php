<?php 
require_once('../confirm_login.php');
//$admin->Competence('admin_insert');
if(!empty($_POST['Submit'])){
     
    if($_POST['Username'] == '') GoTo2("back",$admin_lang['username_empty']);
    if($admin->UserIsExists($_POST['Username'])){
	   GoTo2("back",$admin_lang['username_exists']);
	}
	
	$admin->Insert();
	GoTo2("administrator_index.php");
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
      
</script>
</head>

<body>
<div id="title_menu"><a href="administrator_index.php"><?php echo $admin_lang['administrators'];?></a> &gt; <?php echo $admin_lang['add_a_new_user'];?></div>
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
          <input name="Username" type="text" id="Username" />
        </label></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
        <td class="form_list_1"><?php echo $admin_lang['password'];?></td>
        <td class="form_list_2"><label>
          <input name="Password" type="password" id="Password" />
        </label></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
        <td class="form_list_1"><?php echo $admin_lang['email'];?></td>
        <td class="form_list_2"><label>
          <input name="Email" type="text" id="Email" />
        </label></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
        <td class="form_list_1"><label for="checkbox_row_9"><?php echo $admin_lang['remarks'];?></label></td>
        <td class="form_list_2"><label>
          <textarea name="Remarks" cols="40" id="Remarks"></textarea>
        </label></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>
      <tr>
        <td class="form_list_1">身分</td>
        <td class="form_list_2"><select name="GroupID">
        <option value="0">總管理員</option>
        <option value="1">一般管理員</option>
        </select></td>
        <td class="form_list_3">&nbsp;</td>
      </tr>

      
      <tr>
        <td width="12%" class="form_list_1">&nbsp;</td>
        <td width="53%" class="form_list_2"><label>
          <input name="Submit" type="submit" id="Submit" value="<?php echo $admin_lang['submit'];?>" />
          <input name="Reset" type="reset" id="Reset" value="<?php echo $admin_lang['reset'];?>" />
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

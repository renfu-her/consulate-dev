<script language="javascript" type="text/javascript">

function cancel_delete(){
   HiddenObject('note_message_layer');
}

function confirm_delete(href , message){
  
  var styletop = 100;
  try{
     styletop +=document.documentElement.scrollTop
  }catch(e){
     try{
	  styletop +=window.pageYoffset;
	 }catch(err){
	   styletop +=100;
	 }
  }
  $('note_message_layer').style.top = styletop + 'px';
  
   $('a_continue').href = href;
   $('message_layer_message').innerHTML  = message;
   BlockObject('note_message_layer');
   mouse_layer('note_message_layer');
   return false;
}
function continue_delete(){
  return true;
}
</script>
<div id="note_message_layer">
  <div id="message_layer_bar">
    <div id="result_box" dir="ltr"><?php echo $admin_lang['confirmed_information'];?></div>
  </div>
  <div id="message_layer_main">
    <p id="message_layer_message">Loadding...</p>
    </div>
  <div id="message_button">[ <a href="#" onclick="return continue_delete()" id="a_continue"><?php echo $admin_lang['continue'];?></a> ]  [ <a href="javascript:cancel_delete();"><?php echo $admin_lang['cancel'];?></a> ]</div>
</div>
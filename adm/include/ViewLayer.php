<script language="javascript" type="text/javascript">
function ShowViewLayer(title , main , footer , width){
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
  $('ViewLayer').style.top = styletop + 'px';
  
   $('ViewTitle').innerHTML = title;
   $('ViewMain').innerHTML = main;
   $('ViewFooter').innerHTML = footer;
   $('ViewLayer').style.width = width;
   BlockObject('ViewLayer');
   var selects = document.getElementsByTagName('select');
   for(var i=0;i< selects.length;i++){
      selects[i].style.display = 'none';
   }
   var this_selects = $('ViewLayer').getElementsByTagName('select');
   for(var i=0;i<this_selects.length;i++){
      this_selects[i].style.display = '';
   }
   if(document.all) mouse_layer('ViewLayer');
}

function HiddenViewLayer(){
   HiddenObject('ViewLayer');
   var selects = document.getElementsByTagName('select');
   for(var i=0;i<selects.length;i++){
     selects[i].style.display = '';
   }
}

</script>
<div id="ViewLayer">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="4%" bgcolor="#3366CC"><img src="<?php echo ADMIN_PATH;?>images/view.jpg" width="16" height="16" /></td>
      <td width="92%" bgcolor="#3366CC" style="color:#FFFFFF;font-weight:bold;" id="ViewTitle">Title</td>
      <td width="4%" align="right" bgcolor="#3366CC"><a href="Javascript:HiddenViewLayer();"><img src="<?php echo ADMIN_PATH;?>images/04.gif" alt="Close" width="15" height="13" border="0" /></a></td>
    </tr>
  </table>
  <div id="ViewMain" style="z-index:20">Loading...</div>
  <div id="ViewFooter"></div>
</div>
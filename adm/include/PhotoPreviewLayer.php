<script language="javascript" type="text/javascript">
function photo_preview(src , width , height){
   var width  = width;
   var height = height;
   $('photo_preview').style.width = width+'px';
   $('photo_preview').style.height = height+'px';
   BlockObject('photo_preview');
   
   try{
      $('photo_preview').filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = src;
   }catch(e){
      try{
	    var img_preview = document.createElement('img');
	    img_preview.setAttribute('width' , width);
	    img_preview.setAttribute('height' , height);
	    img_preview.setAttribute('src' ,src) ;
	    $('photo_preview').appendChild(img_preview);
      }catch(e){
	    return false;
	  }
   }
}
</script>
<div id="photo_preview" style="top:100px;right:10px;display:none;position:absolute;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);
" onclick="this.style.display='none';"></div>
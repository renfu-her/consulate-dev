<?php
class ReduceImage{
  var $R;
  var $G;
  var $B;
  var $x;
  var $y;
  var $dstW;
  var $dstH;
  var $src_im;
  var $src;
  var $src_type;
  var $src_mime;
  var $srcW;
  var $srcH;
  var $error_msg;
  function __construct(){
      $this->x = 100;
	  $this->y = 100;
	  $this->R = 255;
	  $this->G = 255;
	  $this->B = 255;
  }
  
  function SetImage($src){
       $this->src = $src;
	   $size = getimagesize($src);
	  
	   //$this->srcW = $size[0];
	   //$this->srcH = $size[1];
	   $this->src_type = $size[2];
	   $this->src_mime = $size['mime'];
	   switch($this -> src_type){
         case 1: $this->src_im = imagecreatefromgif($src); break;
         case 2: $this->src_im = imagecreatefromjpeg($src); break;
         case 3: $this->src_im = imagecreatefrompng($src); break;
         case 6:
         case 15: $this->src_im = imagecreatefromwbmp($src); break;
         default : $this -> errorMsg = 'Image type error!'; return false;
	   }
	   $this->srcW = imagesx($this->src_im);
	   $this->srcH = imagesy($this->src_im);
	   return true;		   
  }
  
  function SetXY($x , $y , $bg = true){
        $this->x=$x; 
        $this->y=$y; 
    if($this->srcH > $this->y){ 
       $this->dstH = $this->y; 
       $this->dstW=intval($this->y * $this->srcW/$this->srcH); 
    } else{ 
        $this->dstH = $this->srcH; 
        $this->dstW = $this->srcW; 
    }    
  if($this->dstW > $this->x){ 
       $this->dstH = intval($this->x*$this->dstH/$this->dstW); 
       $this->dstW=$this->x; 
   } 

   $this->dstX=intval(($this->x-$this->dstW)/2); 
   $this->dstY=intval(($this->y-$this->dstH)/2); 
  }
  
  function SetColor($color){
     $arr  = $this->GetRGB($color);
	 $this->R = $arr[0];
	 $this->G = $arr[1];
	 $this->B = $arr[2];
  }
  
  function SetRGB($R , $G , $B){
       $this->R = $R;
	   $this->G = $G;
	   $this->B = $B;
  }
    
  function GetRGB($color_hex) {
        return array_map('hexdec', explode('|', wordwrap(substr($color_hex, 1), 2, '|', 1)));
  }
  
  function GetImage($filename = '' , $reduce = true){
     
	 if($reduce === false){
	   $w = $this->dstW;
	   $h = $this->dstH;
	   $dstX = 0;
	   $dstY = 0;
	 }else{
	   $w = $this->x;
	   $h = $this->y;
	   $dstX = $this->dstX;
	   $dstY = $this->dstY;
	 }
	 
	 if($this->type == 1){   // gif
	    $im = imagecreate($w,$h);
	 }else{
	     $im = imagecreatetruecolor($w,$h);
	 }
	 
	 //背景色
	 $bg = imagecolorallocate($im,$this->R,$this->G,$this->B); 
     imagefill($im,0,0,$bg);
	 
	 imagecopyresampled($im , $this->src_im , $dstX , $dstY , 0 , 0 ,$this->dstW , $this->dstH , $this->srcW , $this->srcH);
	
	 	
	 if($filename != ''){
	      switch ($this -> src_type){
             case 1:imagegif($im, $filename); break;
             case 2:imagejpeg($im, $filename,100); break;
             case 3:imagepng($im, $filename); break;
             case 6:
             case 15:imagewbmp($im, $filename); break;
			 default: $this->error_msg = 'put error'; return false;
         }
		 chmod($filename , $chmod = 0777);
		 
		 return true;
	 }else{
	    header("Content-Type:".$this->src_mime);
		switch ($this -> src_type){
             case 1:imagegif($im); break;
             case 2:imagejpeg($im); break;
             case 3:imagepng($im); break;
             case 6:
             case 15:imagewbmp($im); break;
			 default: $this->error_msg = 'put error2'; return false;
        } 
	 }
	 imagedestroy($im);
	 
  }
  
  function close(){
     imagedestroy($this->src_im);
  }
}
?>
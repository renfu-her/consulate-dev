<?php
class XML{
   
   var $xml = '';
   var $response;
   
   function __construct(){
      //清除输出
	  if(ob_get_length()) ob_clean();
      //发送标题阴止浏览器缓存
      header("Expires: Mon , 26 Jul 1997 05:00:00 GMT");
      header('Last-Modified:'.gmdate('D,d M Y H:i:s') .'GMT');
      header('Cache-Control: no-cache , must-revalidate');
      header('Content-Type:text/xml');
   }
   
     
   
   function Add($tag , $text='' , $attribute = ''){
      $this->xml .= '<'.$tag;
	  if(!empty($attribute)){
	      if(is_array($attribute)){
		     foreach($attribute as $name=>$value){
			     $this->xml .= ' '.$name.'="'.$value.'"';
			 }
		  }
	  }
	  $this->xml .='>';
	  if(is_array($text)){
	    foreach($text as  $sub_tag=>$sub_text){
		   $this->Add($sub_tag , $sub_text);
		}
		
	  }else{
	  	  $this->xml .= $text;
	  }
	  $this->xml .= '</'.$tag.'>';
	  
   }
   
   
   function Display($response = 'response'){
      $this->response = $response;
	  
	  $putout ='<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
	  $putout .='<'.$this->response.'>';
	  $putout .= $this->xml;
	  $putout .='</'.$this->response.'>'; 	  
	  echo $putout;
	  exit();
   }
    
}

?>
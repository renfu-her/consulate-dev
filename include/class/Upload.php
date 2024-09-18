<?php
error_reporting(7);
set_time_limit(0);
ini_set('display_errors' , 'On');
ini_set('memory_limit', '64M');


class Upload {
   var $field;
   var $save_dir;
   var $error_msg;
   var $files ; 
   var $types;
   var $fields;  //上传的文件个数
   var $filenames ;
      
   function __construct($field = 'file'){
        $this->field = $field ; 
		$this->files = $_FILES[$field]; 
		$this->fields = count($this->files['error']);  //计算上传的文件个数
   }
   
   function SetType($types){
       $this->types =  $types;
   }
   
   
   
   
   function Move($save_dir , $oldname = false  , $reduce_config = false){
       
       if(!$this->Mkdirs($save_dir)){
	       $this->error_msg = "mkdir : $save_dir";
		   return false;
	   }
	   
	   $this->save_dir = $save_dir;
	   
	   $uploaded = 0;
	   $this->filenames = array();
	   
	   if($reduce_config){
	      include_once(dirname(__FILE__)."/ReduceImage.php");
	      $reduce =  new ReduceImage();	
	   }
	   
	   foreach((array)$this->files['error'] as $i=>$error){
	       if($error == UPLOAD_ERR_OK){
		       $postfix = strrchr(strtolower($this->files['name'][$i]),".");
			   
			   
			   $name_arr = split("[\\/]",$this->files['name'][$i]);
			   
			   $c = count($name_arr)-1;
			   $name = $name_arr[$c];
			   
			   if((strcasecmp('.php',$postfix) == 0 ) || !in_array($postfix , $this->types)){
				     continue;
			   }
			   
			   if($oldname === true){
			      $filename = $this->SetOldName($name);  
			   }else{
			      $filename = time().$i.$postfix; 
			   }
			   
			   if(move_uploaded_file($this->files['tmp_name'][$i] , $this->save_dir.$filename)){
			      
				  chmod($this->save_dir.$filename , $chmod = 0777);
				  
				  $this->filenames[$i] = array("FileName"=>$filename ,
				                             "Size"=>$this->files['size'][$i],
											 "Type"=>$this->files['type'][$i],
											 "Name"=>$name);
				  $uploaded ++; 
				  
				  
				 //自動生成縮略圖 
				  if(!empty($reduce_config)){
					    
						 $reduce->SetImage($this->save_dir.$filename);
						 
						 foreach($reduce_config as $arr){
						    $reduce->SetXY($arr[1] , $arr[2]);
		                    $reduce->SetColor($arr[3]);
		                    $reduce->GetImage($this->save_dir.$arr[0].$filename , $arr[4]);									
						 }
						 
						 $reduce->close();		 						 
 			      }
				   
			   }else{
			      $this->filenames[$i] = array(); //多个文件上传时不成功的
			   }
		   }else{
		      $this->filenames[$i] = array(); 
		   }	   
		   
	   }
	   
	   return $uploaded;
	   
   }
   
   
   
   
   function SetOldName($filename){
      $filename = urlencode($filename);
      $file = $this->save_dir.$filename;
	  if(file_exists($file)){
	     $filename ="_".$filename;
	     $filename = $this->SetOldName($filename);
	  }
	  return $filename;
   }
   
   function Mkdirs($dir , $mode = 0777){
      
	  $save_dir = str_replace("\\","/",$dir);
	  
	  if(is_dir($save_dir)) return $save_dir;
	  	  
      $dirs = explode("/",$save_dir);
	  $path = '';
	  foreach($dirs as $folder){
	     $path .= $folder."/";
		 
		 if(!is_dir($path)){
		    if(!mkdir($path , $mode)){
			   return false;
			}
		 }
	  }
	  return true;
    }	
}
?>
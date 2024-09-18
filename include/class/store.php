<?php
class store{
   var $db;
   var $row;
   
   function __construct(){
       $this->db = &$GLOBALS['db'];
	   SessionStart();
   }
   
   function Insert(){
      $db = $this->db;
	  $post = array();
	  if(isset($_POST['Competence1'])){
	  	  $post['Competence1'] = implode(",",(array)$_POST['Competence1']);
	  }else{
	  	  $post['Competence1'] ="";	
	  }
	  return $db->Insert("#@#store" , $post); 
   }
   
   function Update($AdminID){
      $db = $this->db;
	  $post = array();
	  if(isset($_POST['Competence1'])){
	  	  $post['Competence1'] = implode(",",(array)$_POST['Competence1']);		  
	  }else{
	  	  $post['Competence1'] ="";	
	  }
	  
	  return $db->Update("#@#store" , "storeID=$storeID" , $post); 
   }
   
   function Delete ($AdminID){
       $db = $this->db;
	   return $db->Delete ("#@#member" , "ID = $AdminID");
   }
   
   function Select($where , $GetRow = false){
      if($GetRow === true && is_array($this->row) && !empty($this->row)) return $this->row;
	  $db = $this->db;
	  return $db->Select("#@#store", $where , $GetRow);
   }
   
   function Login(){
       $post = $this->db->GetPost();
	   $Username = $post['Username'];
	   $Password = $post['Password'];
	   
	   $rs = $this->Select("storeID='$Username' AND pwd='$Password' AND status=1 and storeClass='0'");
	   if($rs->RecordCount() > 0){
	      SessionStart();
		  $this->row = $rs->FetchRow();
		  $_SESSION['sess_admin']['AdminID'] = $this->row['ID'];
		  $_SESSION['sess_admin']['Username'] = $this->row['storeName'];
		  $_SESSION['sess_admin']['flag'] = "store";
		  return true;
	   }
	   return false;
   }
   
   function LogOut(){
      $_SESSION['sess_admin'] = array();
	  unset($_SESSION['sess_admin']);
   }
   
   function IsLogin(){
      $ret =  isset($_SESSION['sess_admin']) && $_SESSION['sess_admin']['AdminID'] >0;  
	  
	  return $ret;
   }
   
   function Confirm(){
      
   }
   function UserIsExists($Username , $AdminID = 0){
      
	  $db = $this->db;
	
      $Username = $db->QMagic($Username);
	  $where = "`storeID`='$Username'";
	  if($AdminID > 0 ){
	     $where .=" AND ID <> $AdminID";
	  }
	  
	  $ret = $this->Select($where , true);
	  
	  return $ret;
   }
 
   function Competence($Competence , $msg = ''){
       $arr = explode(",",$_SESSION['sess_admin']['Competence1']);
	   if(!in_array($Competence , $arr))  GoTo('back' , $msg);
   }
   
         
   function IsCompetence($Competence){
      return in_array($Competence ,explode(",",$_SESSION['sess_admin']['Competence1']));
   }
}
?>
<?php
class user{
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
	  return $db->Insert("#@#member" , $post); 
   }
   
   function Update($AdminID){
      $db = $this->db;
	  $post = array();
	  if(isset($_POST['Competence1'])){
	  	  $post['Competence1'] = implode(",",(array)$_POST['Competence1']);		  
	  }else{
	  	  $post['Competence1'] ="";	
	  }
	  
	  return $db->Update("#@#administrators" , "AdminID=$AdminID" , $post); 
   }
   
   function Delete ($AdminID){
       $db = $this->db;
	   return $db->Delete ("#@#member" , "ID = $AdminID");
   }
   
   function Select($where , $GetRow = false){
      if($GetRow === true && is_array($this->row) && !empty($this->row)) return $this->row;
	  $db = $this->db;
	  return $db->Select("#@#member", $where , $GetRow);
   }
   
   function Login(){
       $post = $this->db->GetPost();
	   $MemberID = $post['loginMemberID'];
	   $pwd = $post['loginPwd'];	   
	   $rs = $this->Select("`MemberID`='$MemberID' AND `pwd`='$pwd'");
	   if($rs->RecordCount() > 0){
	      SessionStart();
		  $this->row = $rs->FetchRow();
		  $_SESSION['sess_user']['MemberID'] = $this->row['MemberID'];
		  $_SESSION['sess_user']['MemberName'] = $this->row['MemberName'];	
		  $_SESSION['sess_user']['flag'] = $this->row['flag'];		  
		  return true;
	   }
	   return false;
   }
   
   function LogOut(){
      $_SESSION['sess_user'] = array();
	  unset($_SESSION['sess_user']);
   }
   
   function IsLogin(){
      $ret =  isset($_SESSION['sess_user']) && $_SESSION['sess_user']['MemberID'] >0;
	  
	  return $ret;
   }
   
   function Confirm(){
      
   }
   function UserIsExists($Username , $AdminID = 0){
      
	  $db = $this->db;
	
      $Username = $db->QMagic($Username);
	  $where = "`MemberID`='$Username'";
	  if($AdminID > 0 ){
	     $where .=" AND ID <> $AdminID";
	  }
	  
	  $ret = $this->Select($where , true);
	  
	  return $ret;
   }
   
   function Competence($Competence , $msg = ''){
       $arr = explode(",",$_SESSION['sess_user']['Competence1']);
	   if(!in_array($Competence , $arr))  GoTo2('back' , $msg);
   }
   
         
   function IsCompetence($Competence){
      return in_array($Competence ,explode(",",$_SESSION['sess_user']['Competence1']));
   }
}
?>
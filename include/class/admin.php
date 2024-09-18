<?php
include_once(dirname(__FILE__) . '../MYSQL.php');
include_once(dirname(__FILE__) .'/../../adm/adodb/adodb.inc.php');


class admin{
   var $db;
   var $row;
   var $ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
   
   function __construct(){

       $db = adoNewConnection('mysqli'); # eg. 'mysqli' or 'oci8'
       $db->debug = true;
       $db->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
       $this->db = $db;
//       $rs = $db->execute('select * from soho_administrators');
//       print "<pre>";
//       print_r($rs->getRows());
//       print "</pre>";
//       exit;
	   SessionStart();
   }
   
   function Insert(){
      $db = $this->db;
	  $post = array();
	  if(isset($_POST['Competence'])){
	  	  $post['Competence'] = implode(",",(array)$_POST['Competence']);
	  }else{
	  	  $post['Competence'] ="";	
	  }
	  return $db->autoExecute("soho_administrators" , $post, 'INSERT');
   }
   
   function Update($AdminID){
      $db = $this->db;
	  $post = array();
	  if(isset($_POST['Competence'])){
	  	  $post['Competence'] = implode(",",(array)$_POST['Competence']);		  
	  }else{
	  	  $post['Competence'] ="";	
	  }
	  
	  return $db->autoExecute("soho_administrators", $post, 'UPDATE' , "AdminID=$AdminID" );
   }
   
   function Delete ($AdminID){
       $db = $this->db;
	   return $db->execute ("delete from soho_administrators where AdminID = $AdminID");
   }
   
   function Select($where , $GetRow = false){
	  
      if($GetRow === true && is_array($this->row) && !empty($this->row)) return $this->row;
	  $db = $this->db;
	  return $db->getAll("select * from soho_administrators where $where");
   }
   
   function Login(){
//       $post = $this->db->GetPost();
	   $Username = $_POST['Username'];
	   $Password = $_POST['Password'];
	   $rs = $this->Select(" `Username`='$Username' AND `Password`='$Password'");

	   if(count($rs) > 0){
	      SessionStart();
          $_SESSION['sess_admin']['AdminID'] = $rs[0]['AdminID'];
		  $_SESSION['sess_admin']['Username'] = $rs[0]['Username'];
		  $_SESSION['sess_admin']['Competence'] = $rs[0]['Competence'];
		  $_SESSION['sess_admin']['flag'] = "admin";
		  $_SESSION['sess_admin']['GroupID'] = $rs[0]['GroupID'];
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
	  $where = "`Username`='$Username'";
	  if($AdminID > 0 ){
	     $where .=" AND AdminID <> $AdminID";
	  }
	  
	  $ret = $this->Select($where , true);
	  
	  return $ret;
   }
   
   function Competence($Competence , $msg = ''){
       $arr = explode(",",$_SESSION['sess_admin']['Competence']);
	   if(!in_array($Competence , $arr))  GoTo2('back' , $msg);
   }
   
         
   function IsCompetence($Competence){
      return in_array($Competence ,explode(",",$_SESSION['sess_admin']['Competence']));
   }
}
?>
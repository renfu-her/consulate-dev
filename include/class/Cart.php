<?php
SessionStart();

define("CART_SAVE_DB" , true);
class  Cart{
   var $cart;
   var $db;
   var $SaveDB = true ; 
   var $SessionID;
   
   function __construct(){
      if(!isset($_SESSION['ShopCart'])) $_SESSION['ShopCart'] = array();
      $this->cart =& $_SESSION['ShopCart'];   
	  $this->SessionID = session_id();
	  $this->CART_SAVE_DB = CART_SAVE_DB;
	  
	  if(CART_SAVE_DB){
	  	  $this->db =& $GLOBALS['db']; 
	      $this->DeleteOld();	 
	 }	 
   }
   
   function DeleteOld(){
     $db = $this->db;
	 $rs = $db->Execute("SELECT cart.CartID ,cart.SessionID ,  sess.session_id  FROM #@#cart as cart LEFT JOIN #@#sessions as sess ON cart.SessionID = sess.session_id  WHERE sess.session_id IS NULL GROUP BY cart.SessionID");
     while($row = $rs->FetchRow()){
		  $db->Execute("DELETE FROM #@#cart WHERE SessionID='".$row['SessionID']."'");
     }	  
	 $rs->Close();
   }
   
   function Add($ProID , $number = 0){
      if(isset($this->cart[$ProID])){
	    $this->cart[$ProID] += $number;
	  }else{
	    $this->cart[$ProID] = $number;
	  }
	  
	  if($this->SaveDB === true){
	     $db = $this->db;
		
		 $rs = $db->Execute("SELECT * FROM #@#cart WHERE SessionID='{$this->SessionID}' AND ProID=$ProID");
		 if($rs->RecordCount() > 0){
		    $row = $rs->FetchRow();
			
		    $sql = $db->GetUpdateSQL($rs,array("Quantity"=>$number+$row['Quantity']));
		 }else{
		    $sql = $db->GetInsertSQL($rs ,array("Quantity"=>$number , "ProID"=>$ProID , "SessionID"=>$this->SessionID));
		 }
		 $db->Execute($sql);
	  }
	  
   }
  
  function Remove($ProID){
      $this->cart[$ProID] = null;
	  unset($this->cart[$ProID]);
	  if($this->SaveDB === true){
	      $db = $this->db;
		  $db->Delete("#@#cart" , "SessionID='{$this->SessionID}' AND ProID=$ProID");
	  }
  }
  
  function Update($ProID , $number = 0){
      if($number < 0 ) $number = 0;
	  $this->cart[$ProID] = $number;
	  if($this->SaveDB === true){
	     $db = $this->db;
		 $db->Update("#@#cart" , "SessionID='{$this->SessionID}' AND ProID=$ProID" , array('Quantity'=>$number));
	  }
  }
  
  function Exists($ProID){
      $ret = isset($this->cart[$ProID]) &&  ($this->cart[$ProID] > 0);
	  
	  return $ret;
  }
  
  function GetAll(){
    return $this->cart;
  }
  
  function EmptyCart(){
     $db = $this->db;
     $this->cart = array();
	 if($this->SaveDB === true){
	    $db->Delete("#@#cart" , "SessionID='{$this->SessionID}'");
	 }
  }
  
  function GetProducts(){
     global $db , $col_ProName;
	 $ret = array();
	 foreach($this->cart as $ProID=>$number){
	    $row = $db->GetRow("SELECT ProID , $col_ProName as ProName,`No` ,$number as `number` , OrderDoc , OrderDocTitle FROM #@#products WHERE ProID=".intval($ProID));
		if($row){
		  $ret[] = $row;
		}
	 }
	 
	 return $ret;
  }
  
  function GetRS(){
     $db = $this->db;
	 return $db->Execute("SELECT * FROM #@#cart as cart LEFT JOIN #@#products as pro ON cart.ProID=pro.ProID WHERE cart.SessionID='{$this->SessionID}' ORDER BY CartID ASC");
	 
  }
  
  function Insert($ProIDs , $numbers , $Comments = false){
       $db = $this->db;
	  
	   $this->EmptyCart();
	   
	   
	   for($i = 0; $i < count($ProIDs); $i ++){
	       $ProID = intval($ProIDs[$i]);
		   $Quantity = (int)$numbers[$i];
		   $Comment = $db->Qmagic($Comments[$i]);
		   
		   $this->cart[$ProID] = $Quantity;
		   $db->Execute("INSERT INTO #@#cart(SessionID , ProID , Quantity,`Comment`) VALUES('{$this->SessionID}' , $ProID , $Quantity ,'$Comment')");
	   }
	   
  }
  
}
?>
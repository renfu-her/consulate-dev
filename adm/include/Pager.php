<?php
include_once(dirname(__FILE__) . '/../../include/MYSQL.php');
include_once(dirname(__FILE__) .'/../../adm/adodb/adodb.inc.php');

class Pager{
  var $max;
  var $numRows;
  var $pageNumberName;
  var $queryString = '';
  var $startRow = 0;
  var $pageNumber;
  var $endRow; //当前页结束记录
  var $totalPage ; //总页数
  var $sql ;
  var $result ;
  var $pageName;
  var $firstPage;
  var $previousPage;
  var $nextPage;
  var $lastPage;
  var $className; //管理列表tr樣式
  var $mathPage ;
  function __construct($max = 10  , $numRows = 0 , $pageNumberName = 'Page'){
      $this->max = $max;
	  $this->numRows = $numRows; 
	  $this->pageNumberName = $pageNumberName; 
     
	  $this->pageName = $_SERVER['PHP_SELF'];
  }
  function Init($sql = ''){
      $this->StartRow();
	  if($sql != ''){
	     $this->NumRows($sql);
	  }
	    
	  $this->endRow = min($this->startRow+$this->max , $this->numRows); //当前页结束记录数
	  
	  $this->totalPage = ceil($this->numRows / $this->max);  
	  $this->GetQueryString(); 
  }
  
  function StartRow(){
     
     if($this->pageNumber > 0) return $this->startRow; //执行过此函数直接返回开始记录
	 
     if(!isset($_GET[$this->pageNumberName])){
	    
		$this->pageNumber = 1;
		$this->startRow = 0;
		
	 }else{
	    $this->pageNumber = $_GET[$this->pageNumberName] > 0 ? intval($_GET[$this->pageNumberName]) : 1;
		$this->startRow =  ($this->pageNumber - 1) * $this->max;  
	 } 
	 
	 return $this->startRow;
  }
  
  function NumRows($sql){
      $db = adoNewConnection('mysqli'); # eg. 'mysqli' or 'oci8'
      $db->debug = true;
      $db->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
      global $db;
	  if(isset($_GET['numRows'])){ 
	     $this->numRows = intval($_GET['numRows']);
	  }else{	 
	     $rs = $db->execute($sql);
	     $this->numRows = $rs->recordCount();
	     $rs->Close();
	  }

	  $this->result = $db->selectLimit($sql , $this->max ,$this->startRow );
	  return $this->numRows;
  }
  function &Result(){
    return $this->result;
  }
  
  function FetchRow(){
     $rs = &$this->Result();
	 $this->className = ($rs->currentRow % 2 == 0) ? "list_tr1" : "list_tr2";
     var_dump($rs->fetchRow());
	 return $rs->FetchRow();
  }
  function ListClass(){
    return " class=\"".$this->className."\" onmousemove=\"this.className = 'list_tr3'\" onmouseout=\"this.className='".$this->className."'\"";
  }
  function SetLinks($first = 'First' , $previous = 'Previous' , $next = 'Next' , $last = 'Last' , $classNameA="PagerA" , $classNameB='PagerB'){
      	  
	  if($this->pageNumber > 1){ 
	      $this->firstPage = "<a href=\"".$this->GetHref(1)."\" class=\"$classNameA\">$first</a>";
		  $this->previousPage = "<a href=\"".$this->GetHref($this->pageNumber-1)."\" class=\"$classNameA\">$previous</a>";		   
	 }else{
	      $this->firstPage = "<a href=\"#\" onclick=\"return false;\" class=\"$classNameB\">$first</a>";
		  $this->previousPage = "<a href=\"#\" onclick=\"return false;\" class=\"$classNameB\">$previous</a>";		   
	 }
	 
	 if($this->totalPage > $this->pageNumber){
	     $this->nextPage = "<a href=\"".$this->GetHref($this->pageNumber+1)."\" class=\"$classNameA\">$next</a>";
		 $this->lastPage = "<a href=\"".$this->GetHref($this->totalPage)."\" class=\"$className\">$last</a>";
	 }else{
	     $this->nextPage = "<a href=\"#\" onclick=\"return false;\" class=\"$classNameB\">$next</a>";
		 $this->lastPage = "<a href=\"#\" onclick=\"return false;\" class=\"$classNameB\">$last</a>";
	 }
	 for($i=1;$i<=$this->totalPage;$i++){
	 	if($this->pageNumber==$i){
			$this->mathPage=$this->mathPage."[$i]&nbsp;&nbsp;";
		}else{
	 		$this->mathPage=$this->mathPage."<a href=\"".$this->GetHref($i)."\" class=\"$classNameA\">$i</a>&nbsp;&nbsp;";
		}
		
	 }
	 return array($this->firstPage , $this->previousPage, $this->mathPage , $this->nextPage , $this->lastPage); 	  
  }
  
  
  function PageImage(){
     $first = "<img src=\"".ADMIN_PATH."images/firstPage.jpg\" border=\"0\"/>";
	 $previous = "<img src=\"".ADMIN_PATH."images/previousPage.jpg\" border=\"0\" />";
	 $next = "<img src=\"".ADMIN_PATH."images/nextPage.jpg\" border=\"0\"/>";
	 $last = "<img src=\"".ADMIN_PATH."images/lastPage.jpg\" border=\"0\"/>";
	 return  implode(" ",$this->SetLinks($first , $previous , $next , $last));
  }
  
  function AdminPager(){
       global $col_lang;
	   if($col_lang == 'tw'){
	       $page = '當前頁';
		   $total = '總共';
		   $records = '記錄';
		   $to = "到";
		   $of = "共";
	   }elseif($col_lang == 'cn'){
		   $page = '当前页';
	       $total = '总共';
		   $records = '记录';
		   $to = '到';
		   $of = '共';
	   }else{
	       $page = 'Page';
		   $total = 'Total';
		   $records = 'Records';
		   $to = 'To';
		   $of = 'Of';
	   }
	   
	   return $page.": ".$this->pageNumber."/".$this->totalPage." &nbsp; $records ".min($this->startRow+1 , $this->numRows)."-".$this->endRow."/".$this->numRows ." &nbsp;&nbsp; ".$this->PageImage();
  }
  
  function GetHref($pageNumber){
     return $this->pageName."?".$this->pageNumberName."=".$pageNumber.$this->queryString;
  }
  
  function GetQueryString(){
      
      $this->queryString = '';
	  
	  foreach($_GET as $key=>$value){
	    if($key != $this->pageNumberName && ($key != 'numRows')){
		   $this->queryString .= "&$key=".urlencode($value);
		}
	  }
	  $this->queryString .="&numRows=".$this->numRows;
  }
  
}
?>
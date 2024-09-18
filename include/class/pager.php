<?php

class page_class{
	
	var $numRows ; 
	/**
	 * 总记录数参数名称
	 *
	 * @var string
	 */
    var $numRowsName = 'rows';
	/**
	 * 每页记录数
	 *
	 * @var integer
	 */
	var $maxRow = 10 ;
	/**
	 * 当前页码
	 *
	 * @var integer
	 */
	var $pageNum =1;
	/**
	 * 相前操作页名称
	 * 
	 * @var string
	 */ 
	var $selfPage ;
	/**
	 * 当前页其它参数
	 *
	 * @var string
	 */
	var $queryString='';
	/**
	 * 传递页码参数名称
	 *
	 * @var string
	 */
	var $pageNumName = 'page';
	/**
	 * 总页数
	 *
	 * @var integer
	 */
	var $totalPageNum; 
	/**
	 * 信息提示,主要用在总记录为0时使用
	 * (好像用不上了先放这儿留以后扩展时处理错误信息使用)
	 * @var boolean
	 */
	var $isError= false;
	/**
	 * 起始记录
	 *
	 * @var integer
	 */
	var $startRow=0;
	/**
	 * 第一页链接名称
	 *
	 * @var string
	 */
	var $first = 'First';
	/**
	 *上一页链接名称
	 * 
	 * @var String
	 */
	var $previous='Previous';
	/**
	 * 下一页链接名称
	 * 
	 * @var string
	 */
	
	var $next = 'Next';
	/**
	 * 最后一页链接名称
	 *
	 * @var string
	 */
	var $last = 'Last';
	/**
	 * 第一页链接
	 *
	 * @var string
	 */
	var $firstLink= 'First';
	/**
	 * 上一页链接
	 *
	 * @var string
	 */
	var $previousLink = 'Previous';
	/**
	 * 下一页链接
	 *
	 * @var string
	 */
	var $nextLink = 'Next';
	/**
	 * 最后一页链接
	 *
	 * @var string
	 */
	var $lastLink = 'Last';
	/**
	 * 默认常用翻页(分页)链接样式
	 *
	 * @var string
	 */
	var $styleDefault ='';
	/**
	 * 数字翻页(分页)链接样式
	 *
	 * @var string
	 */
	var $styleNumber = '';
	/**
	 * 选择框翻页(分页)链接样式
	 *
	 * @var string
	 */
	var $styleSelect = '';
	/**
	 * 简单页码统计
	 *
	 * @var string
	 */
	var $pageCounter;
	/**
	 * 简单记录统计
	 *
	 * @var string
	 */
	var $rowsCounter;
	/**
	 * 构造函数
	 *
	 * @param integer $numRows 总记录数
	 * @param integer $maxRow 每页记录数
	 * @param string $pageNumName 分页参数名称
	 * @param string $numRowsName 总记录参数名称
	 * @return page_class
	 */
	
	function __construct($numRows=0,$maxRow=10,$pageNumName='p',$numRowsName='r'){
		/**
		 * 接收总记录数
		 */
		$this->numRows = $numRows;
		/**
		 * 接收每页最多记录数
		 */
		$this->maxRow = $maxRow;
		/**
		 * 接收页码参数名称
		 */
		$this->pageNumName = $pageNumName;
		
		/**
		 * 其它要传递的地址栏GET方法参数
		 */
		$this->GetQueryString();
		/**
		 * 计算出总页数
		 */
		$this->totalPageNum = @ceil($this->numRows/$this->maxRow);
	    /**
	     * 生成起始记录 $this->startRow 留给数据库操作用
	     */
		$this->getStartRow();
		/**
		 * 当前页结束记录
		 */
		$this->selfMaxRow = min($this->startRow+$this->maxRow,$this->numRows);
	}
	function __set($name,$value){
		$this->$name = $value;
	}
	
	/**
	 * 取得起始记录
	 *
	 * @return $this->startRow 起始记录
	 */
	
	function GetStartRow(){
		/**
		 * 第一页时默认返回0
		 */
		if(!isset($_GET[$this->pageNumName])){
			return 0;
		}
	    /**
	     * 当前页码,如果有传来页码参数相当页码为$_GET[$this->pageNumName] 没有为 1
	     */
		
		if(!empty($_GET[$this->pageNumName])){
			 $this->pageNum = intval($_GET[$this->pageNumName]);
		}else{
			 $this->pageNum = 1;
		}
		/**
		 * 记算起始记录 (页码-1)*每页最多记录数
		 */
		$this->startRow = ($this->pageNum-1) * $this->maxRow;
		/**
		 * 返回起始记录
		 */
		return $this->startRow;
	}

    /**
     * 设定翻页(分页)链接名称
     *
     * @param String $first
     * @param String $previous
     * @param String $next
     * @param String $last
     */
	function setLinkName($first='First',$previous='Previous',$next='Next',$last='Last'){
		/**
		 * 接收链接名称
		 */
		$this->first = $this->firstLink =  $first;
		$this->previous = $this->previousLink = $previous;
		$this->next = $this->nextLink = $next;
		$this->last = $this->lastLink = $last;
	}
	function createLink(){	
		/**
		 * 如果不是第一页显示 '第一页' 和 '上一页'链接
		 */
		if($this->pageNum>1){
			$this->firstLink = $this->getLink($this->first,1);
			$this->previousLink = $this->getLink($this->previous,$this->pageNum-1);
		}
		/**
		 * 如果当前页小于总页数显示 '下一页' 和 '最后一页' 链接
		 */
       if($this->pageNum < $this->totalPageNum){
				$this->nextLink = $this->getLink($this->next,$this->pageNum+1);
                $this->lastLink = $this->getLink($this->last,$this->totalPageNum);
			}
	}
	/**
	 * 返回默认常用样式翻页(分页)链接
	 *
	 * @param string  $delimiter 间隔符 默认加入两个空格
	 * @return 默认常用样式翻页(分页)链接
	 */
	function styleDefault($delimiter='&nbsp;&nbsp;'){
		/**
		 * 生成链接
		 */
		$this->createLink();
		/**
		 * 生成样式
		 */
		$this->styleDefault = '';
		$this->styleDefault .= $this->firstLink;
		$this->styleDefault .= $delimiter;
		$this->styleDefault .= $this->previousLink;
		$this->styleDefault .= $delimiter;
		$this->styleDefault .= $this->nextLink;
		$this->styleDefault .= $delimiter;
		$this->styleDefault .= $this->lastLink;
		/**
		 * 返回样式
		 */
		return $this->styleDefault;
	}
	/**
	 * 数字翻页(分页)链接
	 * 其中当前页使用<b>当前页</b> 也可以换成其它样式
	 * @param integer $left 当前页左边显示个数
	 * @param integer $right 当前页右边显示个数
	 * @param string $delimiter 数字之间的间隔 默使用一个空格
	 * @return 数字样式翻页(分页)链接
	 */
	function styleNumber($left=5,$right=5,$delimiter = '&nbsp;' , $className='' , $currentClassName = ''){
		$this->styleNumber = '';
		$start = max($this->pageNum-$left,1);
		$max = min($this->pageNum+$right,$this->totalPageNum);
        for($i=$start;$i<=$max;$i++){
        	if($i == $this->pageNum){
        		$this->styleNumber .= '<a href="javascript:void 0" class="'.$currentClassName.'">'.$i.'</a>';
				//$this->styleNumber .= $this->getLink($i,$i);
        	}else{
        	    $this->styleNumber .=$this->getLink($i,$i , $className);
        	}
			//不是最后就加个间隔
			if($i != $max){  
        	  $this->styleNumber .= $delimiter;
			}
        }
       return $this->styleNumber;
	}
	/**
	 * 选择框样式翻页(分页)链接
	 *
	 * @param integer $total 最多显示多少条链接.如果页数过多时可能要使用,默认为0表示全部
	 * @return unknown
	 */
	function styleSelect($total = 0){
		$this->styleSelect ='';
		if($total == 0){
			$max = $this->totalPageNum;
		}else{
			$max = min($this->totalPageNum,$total);
		}
		$this->styleSelect .='<select name="pageSelect" id="pageSelect"';
		$this->styleSelect .=' onChange="window.location.href=\'';
		$this->styleSelect .=$this->selfPage.'?'.$this->pageNumName.'=\'';
		$this->styleSelect .='+this.options[this.options.selectedIndex].value+';
		$this->styleSelect .='\''.$this->queryString.'\';">';
		for($i=1;$i<=$max;$i++){
       		$this->styleSelect .= '<option value="'.$i.'"';
       		if($i == $this->pageNum){
       			$this->styleSelect .=' selected="selected"';
       		}
       		$this->styleSelect .='>';
       		$this->styleSelect .='Page:'.$i.'';
       		$this->styleSelect .='</option>';
		}
		$this->styleSelect .= '</select>';
		return $this->styleSelect;
	}
	function pageCounter($page = 'Page',$total = 'Total'){
		$this->pageCounter='';
		//$this->pageCounter .="$page : ".$this->pageNum." $total : ".$this->totalPageNum."";
		$this->pageCounter .="当前第 ".$this->pageNum." 页  共 ".$this->totalPageNum." 页";
        return $this->pageCounter;
	}

	function rowsCounter($records = 'Records',$to = 'to',$of = 'of'){
		$this->rowsCounter ='';
		$this->rowsCounter .=" $records ".$this->startRow." $to ".$this->selfMaxRow." $of ".$this->numRows;
        
	    return $this->rowsCounter;
	}

    /**
     * 返回一个链接
     *
     * @param string $linkName
     * @param integer $pageNum
     * @param string $styleClass
     * @return 一个翻页(分页)链接HTML代码
     */
	function getLink($linkName='',$pageNum=1,$className=''){
		/**
		 * 定义相前页名称
		 */
		$this->selfPage = $_SERVER['PHP_SELF'];
		/**
		 * 生成链接
		 */
		$link = '<a href="'.$this->selfPage.'?'.$this->pageNumName.'='.$pageNum.$this->queryString.'"';
		/**
		 * 如果链接使用HTML样式则添加样式名称
		 */
		if($className !=''){
		  $link .=' class="'.$className.'"';
		}
		$link .='>'.$linkName.'</a>';
		/**
		 * 返回链接HTML代码
		 */
		return $link;
	}
	/**
	 * 其它传递参数设置
	 *
	 * @return 其它传递参数
	 */
	function getQueryString(){
		
		$this->queryString='';
		
		if(!empty($_SERVER['QUERY_STRING'])){
		   		
		    foreach ($_GET as $key=>$value){
			   if($key != $this->pageNumName){
			    	$this->queryString .= '&amp;'.$key.'='.urlencode($value);
			    }
		     }
		 }
		return $this->queryString;				
	}
}

//准备换个类名
class Page extends page_class{
   function page($numRows=0,$maxRow=10,$pageNumName='p'){
       $this->page_class($numRows,$maxRow,$pageNumName);
   }
}

//常用的使用方法
class Pager{
   var $pager;
   var $sql;
   var $max;
   var $rs;
   var $numRows;
   function Pager($sql,$max = 20 ,$page = "page"){
        global $db;
		$this->sql = $sql;
		$this->max = $max;
		$rs = $db->Execute($sql);

		$this->numRows = $rs->RecordCount();
		$pager = new page_class($this->numRows,$max,$page);
		$pager->SetLinkName('第一頁','上一頁','下一頁','最後一頁');
		$this->pager = $pager;
   }

   function GetRS(){
       if(is_object($this->rs)){
	     return $this->rs;
	   }
	   $this->rs =& $GLOBALS['db']->SelectLimit($this->sql,$this->max,$this->pager->startRow);
       return $this->rs;
   }

   function GetPager(){
       return $this->pager;
   }
   
}

?>
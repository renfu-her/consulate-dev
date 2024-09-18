<?php
class Category{
   var $db;
   var $ClassID;
   var $language;
   var $col_lang;
   var $UpArr;
   var $row;
   var $Tree;
   var $Layer;
   var $rows ; //包括當前CID及以上的記錄數組如 : array(array('CName'=>'name' , 'CID'=>'2') , array('CName'=>'name2' ,'CID'=>5))
   function __construct($ClassID = 0 , $language = 'tw'){
      $this->db = &$GLOBALS['db'];
      if($ClassID > 0 ) $this->SetClass($ClassID);
	  $this->SetLanguage($language);
   }
   
   function SetClass($ClassID = 0){
     $this->ClassID = (int)$ClassID;  
   }
   
   function SetLanguage($language){
      $this->language = $language;
	  $this->col_lang = $language;
   }
   
   
   function Insert($post){
       $db = $this->db;
	   $post = array_merge($post , $this->ActionTree($_POST['PID']));
	   $db->Insert("#@#category",$post);	
	   $this->SetSubCount($_POST['PID']); // 把上一级的所属下级类别个数统计会记入上级级记录中
	   $ret = $db->Insert_ID();
	   return $ret;
   }
   
      
   //返回所有下级类别记录数组
   function GetSubRows($PID){
       $db = $this->db;
	   $col_CName = $this->col_lang."_CName";
	   $rs = $db->Execute("SELECT * , $col_CName as CName FROM #@#category WHERE ClassID=".$this->ClassID." AND PID=$PID ORDER BY SortOrder DESC , CID DESC");
	   $total = $rs->RecordCount();
	   $rows = array();
	   while($row = $rs->FetchRow()){
	       $rows[] = $row;
	   }
	   return $rows;
   }
   
   
   //返回$PID 的所有下级类别个数 
   function GetSubRecordCount($PID){
     $db = $this->db;
	 $num_rows =  $db->GetOne("SELECT COUNT(CID) FROM #@#categry WHERE ClassID=".$this->ClassID." AND PID=$PID");
     return $num_rows;
   }
   
   function Update($CID , $post){
      $db = $this->db;
	  $post = array_merge($post,$this->ActionTree($_POST['PID']));
	  $db->Update("#@#category","CID=$CID" , $post);
	  $this->SetSubCount($_POST['PID']); // 把上一级的所属下级类别个数统计会记入上级级记录中
	  return $db->Affected_Rows();
   }
    
   function Delete($CID){
       
	   
	    
	   $db = $this->db;
	   
	   
	   $row = $db->GetRow("SELECT PID,SubCount,Tree FROM #@#category WHERE CID=$CID");
	    
	   $Tree_arr = explode("," , $row['Tree']);
	   
	   $Tree_arr[] = $CID;
	   
	   $Tree = implode(",",$Tree_arr);
	   
	   //删除其下和自己所有类别图片
	   $categorys = $db->Execute("SELECT CID , Image FROM #@#category WHERE  ClassID=".$this->ClassID." AND (Tree LIKE 'Tree%' OR CID = $CID)");
	   
	   while($r = $categorys->FetchRow()){
	       if($this->ClassID == 1){   // Delete Products And Image
	             $this->DeleteProduct($r['CID']);	   
	       }
		   //删除这个类别的图片
		   if($r['Image'] != ''){
		      $image = CATEGORY_IMAGE_DIR.$r['Image'];
			  if(file_exists($image) && is_file($image)) unlink($image);
		   }
	   }
	   	   
	   
	   //刪除所有下級類別和當前類別
	   
	   
	   	   	   
	   $db->Execute("DELETE FROM #@#category WHERE ClassID=".$this->ClassID." AND (Tree LIKE '$Tree%' OR CID = $CID)"); 
	   $deleted = $db->Affected_Rows();
	   
	   //重新處理刪除的類別的上一級類別的 SubCount記錄
	   if($row['PID'] > 0){
	      $this->SetSubCount($row['PID']);
	   }
	   return  $deleted;
	   	   
   }
   
   function DeleteProduct($CID){
       
       $db = $this->db;
	   global $product_image_setting;
	   $image_arr = array_keys($product_image_setting);
	   $image_length = count($image_arr);
	   
	   //删除当前类别下的产品和产品图片
	   
	   $rs = $db->Execute("SELECT `Image` FROM  #@#products WHERE CID =$CID AND `Image` IS NOT NULL");
	   while($row = $rs->FetchRow()){
	        $filename = PRODUCT_IMAGE_DIR.$row['Image'];
			if(file_exists($filename) && is_file($filename)){
			    unlink($filename);
			}
			for($i = 0 ;$i < $image_length ; $i++){
			   $filename = PRODUCT_IMAGE_DIR.$image_arr[$i].$row['Image'];
			   if(file_exists($filename) && is_file($filename)){
			     unlink($filename);
			   }
			}
			            
	   }
	   $rs->Close();
	   $db->Execute("DELETE FROM #@#products WHERE CID = $CID");
	   return $db->Affected_Rows(); 
   }
   
  
   // $PID : 以上一级记录为基础.反回新的数组   
   function ActionTree($PID){
       
       if($PID < 1) return array('Tree'=>$PID , "TopID"=>$PID , "Layer"=>1 ,'ClassID'=>$this->ClassID);
	  
	  
	   $ParentRow = $this->GetRow($PID);
	   
	   $ret = array();
	   $ParentTree = explode("," , $ParentRow['Tree']);
	   $ParentTree[] = $PID;
	   
	   $ret['Tree'] =  implode(",",$ParentTree);
	   $ret['TopID'] = $ParentRow['TopID'];
	   $ret['Layer'] = $ParentRow['Layer']+1;
	   $ret['ClassID'] = $ParentRow['ClassID'];
	   
	   return $ret;
   }
   
   function SetSubCount($CID){
      $db = $this->db;
	  if($CID < 1) return false;
	  $SubCount = $db->GetOne("SELECT COUNT(CID) FROM #@#category WHERE ClassID=".$this->ClassID." AND PID=$CID");
	  $db->Execute("UPDATE #@#category SET SubCount = $SubCount WHERE CID = $CID");
	  return $SubCount;
   }
   
   function GetRow($CID){
       $db = $this->db;
	   $col_CName =  $this->col_lang."_CName";
	   $row = $db->GetRow("SELECT  *, $col_CName as CName FROM #@#category WHERE CID=$CID");
	   return $row;
   }
   
   //返回为Select使用用的Options
   function GetOptions($PID = 0 , $selected = 0 , $default = '' , $className1='',$className2=''){
        $db = $this->db;
					
		$col_CName = $this->col_lang."_CName";
		$options = '';
		if($default != ''){
		   $select = $selected == 0 ? 'selected="selected"' : ''; 
		   $options .="<option value=\"0\" $select>$default</option>\n";   
		}
		
		$rs = $db->Execute("SELECT CID , $col_CName as CName , Layer ,SubCount FROM #@#category WHERE ClassID=".$this->ClassID." AND PID = $PID ORDER BY SortOrder DESC , CID DESC");
		
		while($row = $rs->FetchRow()){
		    $select = $selected == $row['CID'] ? 'selected="selected"' : '';
			$space = str_repeat("&nbsp;",($row['Layer']-1)*4);
			$className = $className2;
			
			if($row['SubCount'] == 0 ){
			  $className = $className1;
			}
			$options .= "<option value=\"".$row['CID']."\" class=\"$className\" $select>".$space."".$row['CName']."</option>\n";
		    
			
			if($row['SubCount'] > 0){
			    $options .= $this->GetOptions($row['CID'] , $selected , '' , $className1 , $className2);   
			}
		}	
		
		
        return $options;
   }
   
    function GetCheckbox($PID = 0,  $checked = ''){
        $db = $this->db;		
		$rs = $db->Execute("SELECT contact,email,IsAsk,ID FROM #@#email where ID=$PID ORDER BY email ASC");
		$i=0;
		while($row = $rs->FetchRow()){
		    $checked ='';
		    if($row['IsAsk'] == 'Yes'){
		   		$checked = "checked=\"checked\"";
			} 
		   	
				$options .= "<input type=\"checkbox\" name=\"IsAsk[$i]\" value=\"Yes\" $checked><input name=\"contact[$i]\" type=\"text\" value=\"".$row['contact']."\" /><input name=\"email[$i]\" type=\"text\" value=\"".$row['email']."\" /><BR>";
			$i=$i+1;
		    
		}	
		
		
        return $options;
   }
   
   //返回导航链接 $delemiter : 间隔符  $href :为链接形式如 products.php?CID=
   function GetNavigation($CID , $href = '#' , $delimiter = ' &gt; '){
       $rows = $this->GetUpArr($CID);
	   $nav = '';
	   foreach($rows as $row){
	      $nav .= '<a href="'.$href.$row['CID'].'">'.$row['CName'].'</a>';
		  if($row['CID'] != $CID) $nav .= $delimiter;
	   }
	   return $nav;
   }
   
   //返回向上记录数组
   function GetUpArr($CID){
       $db = $this->db;
	  
	   $col_CName = $this->col_lang."_CName";
	   
	   $this->rows = array();
	   if($CID < 1 ) return $this->rows;
	   $this->row = $this->GetRow($CID);
	   
	   $Tree = $this->row['Tree'];
	   if($Tree == '') return array(); //有的类别已经删除后再次访问会出错在下边的 IN()
	   $this->Layer = $this->row['Layer'];
	   $arr = explode("," , $this->row['Tree']);
	   $this->TopID = intval($arr[1]);
	    
	   $this->rows = $db->GetArray("SELECT CID,PID,TopID,Tree,Layer,SortOrder,$col_CName as CName FROM #@#category WHERE ClassID=".$this->ClassID." AND (CID IN ($Tree) OR CID = $CID) ORDER BY Layer ASC");
	   
	   return $this->rows;    
   }
   
        
}
?>
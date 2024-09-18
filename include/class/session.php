<?php 
define('SESSION_TO_MYSQL' , false);
define("SESSION_SAVE_PATH",realpath(dirname(__FILE__)."/../../UserFiles/sessions/"));

if(SESSION_TO_MYSQL === true){
  include_once(realpath(dirname(__FILE__)."/../")."/MYSQL.php");
}
/*
CREATE TABLE `ws_sessions` ( 
  `session_id` varchar(255) binary NOT NULL default '', 
  `session_expires` int(10) unsigned NOT NULL default '0', 
  `session_data` text, 
  PRIMARY KEY  (`session_id`) 
) TYPE=InnoDB; 
*/
class session { 
    // session-lifetime 
    var $lifeTime; 
    // mysql-handle 
    var $dbHandle; 
    function open($savePath, $sessName) { 
       // get session-lifetime 
       $this->lifeTime = get_cfg_var("session.gc_maxlifetime"); 
       // open database-connection 
       $dbHandle = @mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD); 
       $dbSel = @mysqli_select_db(DB_DATABASE,$dbHandle); 
       // return success 
       if(!$dbHandle || !$dbSel) 
           return false; 
       $this->dbHandle = $dbHandle; 
       return true; 
    } 
	
    function close() { 
        $this->gc(ini_get('session.gc_maxlifetime')); 
        // close database-connection 
        return @mysqli_close($this->dbHandle); 
    }
	
	 
    function read($sessID) { 
        // fetch session-data 
        $res = $this->sql_query("SELECT session_data AS d FROM #@#sessions 
                            WHERE session_id = '$sessID' 
                            AND session_expires > ".time()); 
        // return data or an empty string at failure 
        if($row = mysqli_fetch_assoc($res)) 
            return $row['d']; 
        return ""; 
    } 
    function write($sessID,$sessData) { 
        // new session-expire-time 
        $newExp = time() + $this->lifeTime; 
        // is a session with this id in the database? 
        $res = $this->sql_query("SELECT * FROM #@#sessions 
                            WHERE session_id = '$sessID'"); 
        // if yes, 
        if(mysqli_num_rows($res)) { 
            // ...update session-data 
            $this->sql_query("UPDATE #@#sessions 
                         SET session_expires = '$newExp', 
                         session_data = '$sessData' 
                         WHERE session_id = '$sessID'"); 
            // if something happened, return true 
            if(mysqli_affected_rows($this->dbHandle)) 
                return true; 
        } 
        // if no session-data was found, 
        else { 
            // create a new row 
            $this->sql_query("INSERT INTO #@#sessions ( 
                         session_id, 
                         session_expires, 
                         session_data) 
                         VALUES( 
                         '$sessID', 
                         '$newExp', 
                         '$sessData')"); 
            // if row was created, return true 
            if(mysqli_affected_rows($this->dbHandle)) 
                return true; 
        } 
        // an unknown error occured 
        return false; 
    } 
    function destroy($sessID) { 
        // delete session-data 
        $this->sql_query("DELETE FROM #@#sessions WHERE session_id = '$sessID'"); 
        // if session was deleted, return true, 
        if(mysqli_affected_rows($this->dbHandle)) 
            return true; 
        // ...else return false 
        return false; 
    } 
    function gc($sessMaxLifeTime) { 
        // delete old sessions 
        $this->sql_query("DELETE FROM #@#sessions WHERE session_expires < ".time()); 
        // return affected rows 
        return mysqli_affected_rows($this->dbHandle); 
    } 
	function sql_query($sql){
	   $sql = str_replace("#@#",DB_PREFIX , $sql);
	   $rs = mysqli_query($sql , $this->dbHandle);
	   return $rs;
	}
} 



if(!isset($_SESSION)){
   if(SESSION_TO_MYSQL === true){
     $session = new session(); 
     session_set_save_handler(array(&$session,"open"), 
                         array(&$session,"close"), 
                         array(&$session,"read"), 
                         array(&$session,"write"), 
                         array(&$session,"destroy"), 
                         array(&$session,"gc")); 
  }else{
    if(!is_dir(SESSION_SAVE_PATH)) mkdir(SESSION_SAVE_PATH , 0777);
    session_save_path(SESSION_SAVE_PATH);
  }
  
  session_start(); 
  
}
?>
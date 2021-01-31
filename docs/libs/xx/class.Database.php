<?PHP

	define("__ERROR_OPEN_DATABASE", "Not open database");
	define("__ERROR_CLOSE_DATABASE", "Not close database");
	define("__ERROR_SET_DATABASE", "Database not found");
	define("__ERROR_OPEN_QUERY", "Not open query. Statement error: ");
	define("__ERROR_CLOSE_QUERY", "Not close query");
	define("__ERROR_EXECUTE_COMMAND", "Not execute command. Statement error: ");
	define("__ERROR_FETCH_OBJECT", "Not fetch object");
	define("__ERROR_FETCH_ARRAY", "Not fetch array");
	define("__ERROR_ROWS_COUNT", "Not rows count");

	class xxDatabase {
		var $__cID=0;
		var $__host;
		var $__user;
		var $__pswd;
		var $__base;
		var $__error_reporting = E_USER_ERROR;

		function xxDatabase($host, $user, $pswd, $base){
			//-- 10.17.2001: Create database connect object
			$this->__host=$host;
			$this->__user=$user;
			$this->__pswd=$pswd;
			$this->__base=$base;
		}

		function open(){
			//-- 10.17.2001: Open connection to database
			if($this->isOpen()) return $this->getConnectId();
			$this->__cID = mysql_pconnect($this->__host, $this->__user, $this->__pswd);
			if (!$this->__cID)
				$this->__cID = mysql_connect($this->__host, $this->__user, $this->__pswd);
			if ($this->getConnectId() && !$this->setDatabase($this->__base))
				$this->setError(__ERROR_OPEN_DATABASE);
			return $this->getConnectId();
		}

		function close(){
			//-- 10.17.2001: Close connection to database
			if(!$this->isOpen()) return true;
			$result=mysql_close($this->getConnectId());
			if(!$result) $this->setError(__ERROR_CLOSE_DATABASE);
			$this->__cID=0;
			return $result;
		}

		function setDatabase($base){
			//-- 10.17.2001: change database
			$this->__base=$base;
			if(!($this->isOpen() && $base))
				return false;
			$result = mysql_select_db($base, $this->getConnectId());
			if(!$result)
				$this->setError(__ERROR_SET_DATABASE);
			return $result;
		}

		function getDatabase(){
			//-- 10.17.2001: Get database name
			return $this->__base;
		}

		function isOpen(){
			//-- 10.17.2001: Return TRUE if to database connect active
			return ($this->__cID) ? true : false;
		}

		function getConnectId(){
			//-- 10.17.2001: Get connect ID
			return $this->__cID;
		}

		function setError($message=null){
			//-- 10.17.2001: Generate error message
			$errorMessage=$message.mysql_error().mysql_errno();
			//echo $errorMessage;
			user_error($errorMessage, $this->__error_reporting);

		}
	}

	class xxDataset {
		var $__cID;
		var $__qID=0;
		var $__statement;
		var $__prefix;
		var $__prfx_id;  //replace to __prefix in MySQL query

		var $__error_reporting = E_USER_ERROR;
		var $__stripslashes_data = __CFG_DB_STRIPSLASHES;

		var $_timer;

		function xxDataset(&$connectId, $prefix = "", $prfx_id = ""){
			//-- 10.17.2001: Create dataset object
			$this->__cID = &$connectId;
			$this->__error_reporting = $connectId->__error_reporting;
			$this->__prefix=trim($prefix);
			$this->__prfx_id=trim($prfx_id);
			$this->execute('set names utf8');
		}

		function setError($message=null){
			//-- 10.17.2001: Generate error message
			$errorMessage=$message.mysql_error().mysql_errno();
			//echo $errorMessage;
			user_error($errorMessage, $this->__error_reporting);
		}

		function initTimer() {
			$this->_timer = getmicrotime();
		}

		function set_error_reporting($new_reporting){
			// 26.02.2003
			$this->__error_reporting = $new_reporting;
		}

		function get_error_reporting()
		{
			return $this->__error_reporting;
		}

		function getTablePrefix()
		{
		  return $this->__prefix;
		}

		function setTablePrefix($prefix)
		{
		  $this->__prefix = $prefix;
		}

		function replaceIDToPrefix($statement)
		{
//		  return str_replace($this->__prfx_id, $this->__prefix, $statement);
            return $statement;
		}

		function quoteValue($Value, $Quote="'")
		{
		  return $Quote.mysql_real_escape_string($Value).$Quote;
		}

		function make_statement_correct($statement)
		{
		  $statement = trim($statement);
		  $statement = preg_replace("/[ ]{2,}/"," ",$statement);
		  if($this->__prfx_id)
		  {
		  	$statement = $this->replaceIDToPrefix($statement);
		  }
		  return $statement;
		}

		function open($statement = ""){
			GLOBAL $Timer;
			//-- 10.17.2001: Open select query

			$statement = $this->make_statement_correct($statement);

//			$Timer->start($statement . "\n");

			if($this->isOpen()) $this->close();
			if ($statement) $this->__statement = $statement;
			//echo "$statement<br>";
			$this->__qID=mysql_query($this->__statement);
			if(!$this->__qID) {
				$err_txt = "Error: " . mysql_errno().": ".mysql_error();
				$this->setError(__ERROR_OPEN_QUERY . "\n\t" . $statement . "\n\t" . $err_txt);
			}

//			$Timer->stop($statement . "\n");

			return $this->__qID;
		}

		function isOpen(){
			//-- 10.17.2001: Is query running?
			return ($this->__qID) ? true : false;
		}

		function close(){
			//-- 10.17.2001: Close query result
			if(!$this->isOpen()) return true;
			$result=mysql_free_result($this->__qID);
			/*if(!$result)
				user_error(__ERROR_CLOSE_QUERY, $this->__error_reporting); */
			$this->__qID = 0;
			return $result;
		}

		function execute($statement){
			GLOBAL $Timer;
			//-- 10.17.2001: Execute insert/update/delete statement
			$statement = $this->make_statement_correct($statement);

//			$Timer->start($statement);
			//$this->__cID->open();

			$result=mysql_query($statement);
			if(!$result) {
				$err_txt = "Error: " . mysql_errno().": ".mysql_error();
				$this->setError(__ERROR_EXECUTE_COMMAND . "\n\t" . $statement . "\n\t" . $err_txt);
			}
			$newID = mysql_insert_id();
//			$Timer->stop($statement);
			if(!empty($newID))
				return $newID;
			return $this->getAffectedRows();
		}

		function &fetchObject(){
			//-- 10.17.2001: Fetch next object row
			if(!$this->isOpen()) return false;
			$res = mysql_fetch_object($this->__qID);
			if(is_object($res))
			{
			  foreach($res as $name => $val)
			  {
			    if($name == 'body' || $name == 'description' || $name == "field")
			    {
			      $res[$name] = $this->retranslate($val);
			    }
			    elseif($this->__stripslashes_data)
			    {
			      $res[$name] = stripslashes($res[$name]);
				}
			  }
			}

			return $res;
		}

		function retranslate($str)
		{
            $search = array('&amp;', '&quot;', '&#039;', '&lt;', '&gt;');
            $replace = array('&', '"', "'", '<', '>');
            return str_replace($search, $replace, $str);
        }


		function &fetchArray(){
			//-- 10.17.2001: Fetch next array row
			if(!$this->isOpen()) return false;
			$res = mysql_fetch_assoc($this->__qID);
			if(is_array($res))
			{
			  foreach($res as $name => $val)
			  {
			    if($name == 'body' || $name == 'description' || $name == "field")
			    {
			      $res[$name] = $this->retranslate($val);
			    }
			    elseif($this->__stripslashes_data)
			    {
			      $res[$name] = stripslashes($res[$name]);
				}
			  }
			}
			return $res;
		}

		function &fetchColsAll(){
			//-- 07.20.2002: Fetch all array row in accociative array
			if(!$this->isOpen()) return false;
			$ret = array();
			for ($i = 0; $i < $this->numFields(); $i++) {
				$fieldName = $this->fetchFieldName($i);
				$ret[$fieldName] = array();
			}
			while ($r = $this->fetchObject()) {
				for ($i = 0; $i < $this->numFields(); $i++) {
					$fieldName = $this->fetchFieldName($i);
					$ret[$fieldName][] = $r->$fieldName;
				}
			}
			return $ret;
		}

		function &fetchRowsAll($as = "array"){
			//-- 07.20.2002: Fetch all array row in accociative array
			if(!$this->isOpen()) return false;
			$ret = array();
			switch ($as) {
				case "array":
					while ($r = $this->fetchArray()) { $ret[] = $r;	}
					break;
				case "object":
					while ($r = $this->fetchObject()) { $ret[] = $r; }
					break;
			}
			return $ret;
		}

		function &fetch($as = "array") {
			return $this->fetchRowsAll($as);
		}

		function &fetchPair($fld1, $fld2 = NULL){
			return $this->fetchPairs($fld1, $fld2);
		}

		function &fetchPairs($fld1, $fld2 = NULL){
			//-- 07.20.2002: Fetch all array row in accociative array
			if(!$this->isOpen()) return false;
			$ass_arr = array();
			while ($r = $this->fetchObject()) {
				if(isset($fld2))
					$ass_arr[$r->$fld1] = $r->$fld2;
				else
					$ass_arr[] = $r->$fld1;
			}
			return $ass_arr;
		}

		function &fetchColl($fld) {
			return $this->fetchPairs($fld);
		}

		function &getCountries($params=array()){
			global $Timer, $_SQL_TABLE;
			$Timer->start("getCountries");
			$this->open("SELECT * FROM ".$_SQL_TABLE['country']." WHERE active = 'y' ".((!isEmptyArr($params)) ? "AND ".join(' AND ', $params) : '')." ORDER BY ord, name");
			$res = &$this->fetchRowsAll();
			$Timer->stop("getCountries");
			return $res;
		}

		function &getStates($params=array()){
			global $Timer, $_SQL_TABLE;
			$Timer->start("getStates");
			$this->open("SELECT * FROM ".$_SQL_TABLE['state']." WHERE active = 'y' ".((!isEmptyArr($params)) ? "AND ".join(' AND ', $params) : '')." ORDER BY name");
			$ret = &$this->fetchRowsAll();
			$Timer->stop("getStates");
			return $ret;
		}

		function tableExist($tblName, $dbName='')
		{
			$tblName = $this->replaceIDToPrefix($tblName);
			$error_reporting = $this->get_error_reporting();
			$this->set_error_reporting('');
			$tables = $this->getTables($tblName, $dbName);
			$this->set_error_reporting($error_reporting);
			foreach($tables as $n => $tab)
			{
			  if($tab == $tblName)
			  {
				return true;
			  }
			}
			return false;
		}

		function DBExist($dbName)
		{
			$Error_reporting = $this->get_error_reporting();
    		$this->set_error_reporting('');
			$query = "SHOW TABLES".((!isBlank($dbName)) ? " FROM ".$dbName : "");
	  	  	$this->open($query);
	  	  	$result = $this->fetchRowsAll();
			$this->set_error_reporting($Error_reporting);
			if(is_array($result))
			{
			  return true;
			}
			return false;
		}

		function isFieldInTable($tblName, $fieldName)
		{
			$Fields = $this->getFieldsOfTable($tblName, $fieldName);
			if(is_array($Fields[$fieldName]))
			{
			  return true;
			}
			else
			{
			  return false;
			}
  	  	}

  	  	function getTables($tblName='', $dbName='')
		{

			$query = "SHOW TABLES".((!isBlank($dbName)) ? " FROM ".$dbName : "").((!isBlank($tblName)) ? " LIKE '".$tblName."'" : "");
	  	  	$this->open($query);
	  	  	$result = $this->fetchRowsAll();
	  	  	foreach($result as $n => $arr)
	  	  	{
	  		  $tables[] = reset($arr);
	  	  	}
	  	    return $tables;
  	  	}

  	  	function getFieldsOfTable($tblName, $fieldName='')
		{
			$query = "DESCRIBE ".$tblName.((!isBlank($fieldName)) ? " '".$fieldName."'" : "");
	  	  	$this->open($query);
	  	  	$result = $this->fetchRowsAll();
	  	  	$Fields = array();
	  	  	foreach($result as $n => $val)
  	  		{
  	    	  $Fields[$val['Field']] = $val;
  	  		}
	  	    return $Fields;
  	  	}

		function save($table, $data, $where = "") {

			$set_a = array();
			foreach($data as $k=>$w) {
				$set_a[] = "$k = '$w'";
			}

			$set = implode(" , " , $set_a);

			if ($where) {
				// update
				$this->execute("UPDATE $table SET $set WHERE $where");
				$inst_id = 0;
			} else {
				// insert
				$inst_id = $this->execute("INSERT INTO $table SET $set");
			}
			return $inst_id;
		}

		function loadResult()
		{
  		    $ret = null;
            $row = $this->fetchRow();
            if($row)
            {
              $ret = $row[0];
            }
            return $ret;
        }

		function fetchRow() {
			//-- 11.20.2001: Fetch next row
			if(!$this->isOpen()) return false;
			$res = mysql_fetch_array($this->__qID);
			if(is_array($res))
			{
			  foreach($res as $name => $val)
			  {
			    if($name == 'body' || $name == 'description' || $name == "field")
			    {
			      $res[$name] = $this->retranslate($val);
			    }
			    elseif($this->__stripslashes_data)
			    {
			      $res[$name] = stripslashes($res[$name]);
				}
			  }
			}
			return $res;
		}

		function fetchFieldName($index) {
			//-- 11.28.2001: Fetch fields list
			if(!$this->isOpen()) return false;
			return mysql_field_name($this->__qID, $index);
		}

		function numRows(){
			//-- 10.17.2001: Get rows count
			if(!$this->isOpen()) return false;
			return mysql_num_rows($this->__qID);
		}

		function numFields() {
			//-- 11.28.2001: Get fields count
			if(!$this->isOpen()) return false;
			return mysql_num_fields($this->__qID);
		}

		function getAffectedRows() {
			//--12.05.2001: Get affected rows
			$result = mysql_affected_rows();
			return $result;
		}

		function getDBTime()
		{
			$this->open("SELECT NOW()");
			return $this->loadResult();
		}

		function lockAllTables() {
			$this->open("SHOW TABLES");
			$tables = $this->fetchColl($this->fetchFieldName(0));
			$locks = array();
			foreach ($tables as $table)
				$locks[] = " $table WRITE";
			if ($locks)
				$this->execute("LOCK TABLES " . join(",", $locks) ) ;
		}

		function unlockTables() {
			$this->execute("UNLOCK TABLES");
		}
	}

?>
<?php
class dbConnect  {

	var $connId;
	var $host;
	var $db;
	var $user;
	var $pass;
	
	//function dbConnect($host="localhost", $db="db_bopaboo_db", $user="bopdev", $pass="BobDev1q2w") {	
	function dbConnect($host=MAINDBSERVER, $db=MAINDB, $user=MAINDBUSER, $pass=MAINDBPASS) {	
		
		$this->host	= $host;
		$this->db   	= $db;
		$this->user	= $user;
		$this->pass	= $pass;
		
		$this->connId =	@mysql_connect($this->host,$this->user,$this->pass);

		if (!$this->connId) {
			trigger_error("Error connecting to <b>Server</b> $this->host<br>", E_USER_ERROR);
			die();
		}

		if (!mysql_select_db($this->db, $this->connId)) {
			trigger_error("Unable to connect to database $this->db on <b>Server</b> $this->host<br>", E_USER_ERROR);
			die();
		}	
	}
	
}

// Query Class
class dbQuery	{

	var $connId;
	var $result;
	var $insertId;

	function dbQuery($sql,$connId) {	
	
		global $debugString;
		global $className;
		$this->connId = $connId;				
		
		$this->result = mysql_query($sql, $this->connId);
		
	/*	
	if($_SESSION["DEBUG"] == 1 ){
	
$debugString .='
		<br><table width="99%" align="center" height="40" border="0" bordercolor="#999999" cellpadding="5" cellspacing="0"  id="noPrint" style="border-style:dashed; border-width:1px; border-collapse:collapse">
		  <tr>
			<td class="content"><b>Page Name -: '.$_SERVER["REQUEST_URI"].'</b></td>
		 </tr>
		  <tr>
			<td class="content">Class Name -:&nbsp;&nbsp;'.$className.'</td>
		  </tr>
		  <tr>
			<td class="content">'.$sql.'</td>
		  </tr>
		</table>			
			';
		}*/
		
		if (!$this->result) {echo $sql;
			trigger_error("Error Executing Query: " . mysql_error(), E_USER_ERROR);
			
			die();
		}		

		$this->insertId	= mysql_insert_id($this->connId);
	}

	function affectedRows() {
		return mysql_affected_rows($this->connId);
	}
	
	function numRows() {
		return mysql_num_rows($this->result);
	}

	function getRow() {
		return mysql_fetch_row($this->result);
	}
	
	function getArray() {
		return mysql_fetch_array($this->result);
	}
	function getFields() {
		$feildsArray = array();
		while ($i < mysql_num_fields($this->result)) {
			$meta = mysql_fetch_field($this->result, $i);
			if (!$meta) {
				echo "No fields<br />\n";
			}
			array_push($feildsArray,$meta->name);
			$i++;
		}
		return $feildsArray;

	}
	
	function lastInsertId() {
		return $this->insertId;
	}
}
?>
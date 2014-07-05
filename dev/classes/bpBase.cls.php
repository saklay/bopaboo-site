<?php
class clsbpBase {

	var $connect;	
	var $includePath;
	var $implementClassName;	

	var $returnUrl;

	var $pageIndex;
	var $pageSize;
	var $jumpTo;
	var $sortColumn;
	var $sortDirection; 
	var $feedSortcolumn;
	var $feedSortDirection;
	var $sortImage;
	var $parentId;

	var $action;
	
	var $submitted;
	
	var $userIP;

	var $today;
	
	var $debug;
	var $searchSize;
	

	function clsbpBase($connect, $includePath, $implementClassName) {
		
		$this->connect				= $connect;
		$this->includePath			= $includePath;
		$this->implementClassName	= $implementClassName;		

		$this->returnUrl			= "";
				
		$this->sortColumn			= "";	
		$this->sortDirection		= "ASC";
		$this->sortImage			= " <img src='".$this->includePath."images/sortasc.gif'>";
		$this->debug				= "";
		//echo 'includepath:1:'.$this->includePath.'<br/>';
		$this->fromSecureToRegular();	
		//echo 'includepath:2:'.$this->includePath.'<br/>';

// Its again called from lcbase b'se we are using it in alomost all classes.10-11-2006-Dileep.
// commented functions taken out from the constructor of lcBase.cls.php, since its executed in every object creation.

		//$this->userIP				= $this->getIp();	

	}
	
	function fromSecureToRegular(){
		
		if(strripos($this->includePath,'http')===false){
			$pos_sec=strripos($_SERVER['SERVER_PROTOCOL'], 'HTTPS');
			//echo 'pos:'.$pos.'HTTP :'.HTTP.'<br/>';
			if( $pos_sec > 0){
				$this->includePath = HTTP.$this->includePath;
			}else{
				$this->includePath = HTTP.$this->includePath;
			}
		}
	}
	
	/*
	function fromSecureToRegular(){
		global $log_g;
		$log_g->log("in fromSecureToRegular  ::".$this->includePath);
		if(strripos($this->includePath,'bopaboo')===false){
			$pos_sec=strripos($_SERVER['SERVER_PROTOCOL'], 'bopaboos');
			//echo 'pos:'.$pos.'HTTP :'.HTTP.'<br/>';
			if( $pos_sec > 0){
				$this->includePath = HTTP.$this->includePath;
			}
		}
	}
	*/
	function setPostVars() {

		if (isset($_POST[$this->implementClassName."_returnUrl"]))		$this->returnUrl		 = stripslashes($_POST[$this->implementClassName."_returnUrl"]);
		if (isset($_POST[$this->implementClassName."_pageIndex"]))		$this->pageIndex		 = $_POST[$this->implementClassName."_pageIndex"];
		if (isset($_POST[$this->implementClassName."_pageSize"]))		$this->pageSize			 = $_POST[$this->implementClassName."__pageSize"];
		if (isset($_POST[$this->implementClassName."_searchSize"]))		$this->searchSize		 = $_POST[$this->implementClassName."_searchSize"];
		if (isset($_POST[$this->implementClassName."_sortColumn"]))		$this->sortColumn		 = $_POST[$this->implementClassName."_sortColumn"];
		if (isset($_POST[$this->implementClassName."_sortDirection"]))	$this->sortDirection	 = $_POST[$this->implementClassName."_sortDirection"];
		if (isset($_POST[$this->implementClassName."_feedSortDirection"])) $this->feedSortDirection =	$_POST[$this->implementClassName."_feedSortDirection"];
		if (isset($_POST[$this->implementClassName."_feedSortcolumn"])) $this->feedSortcolumn	 =	$_POST[$this->implementClassName."_feedSortcolumn"];
		if (isset($_POST[$this->implementClassName."_action"]))			$this->action			 = $_POST[$this->implementClassName."_action"];
		if (isset($_POST[$this->implementClassName."_submitted"]))		$this->submitted		 = $_POST[$this->implementClassName."_submitted"];
		if (isset($_POST[$this->implementClassName."_jumpTo"]))		    $this->jumpTo		     = $_POST[$this->implementClassName."_jumpTo"];
		if ($this->sortDirection == "DESC") 							  
			$this->sortImage	= " <img src='".$this->includePath."images/sortdesc.gif'>";
		
	}

	function setGetVars() {		
		
		if (isset($_GET["returnUrl"]))		$this->returnUrl		= stripslashes($_GET["returnUrl"]);
		if (isset($_GET["submitted"]))		$this->submitted		= $_GET["submitted"];
		if (isset($_GET["pageIndex"]))		$this->pageIndex		= $_GET["pageIndex"];
		if (isset($_GET["jumpTo"]))		    $this->jumpTo		    = $_GET["jumpTo"];
		if (isset($_GET["pageSize"]))		$this->pageSize			= $_GET["pageSize"];
		if (isset($_GET["searchSize"]))		$this->searchSize		= $_GET["searchSize"];
		if (isset($_GET["parentId"]))		$this->parentId			= $_GET["parentId"];
		if (isset($_GET["sortColumn"]))		$this->sortColumn		= $_GET["sortColumn"];
		if (isset($_GET["sortDirection"]))	$this->sortDirection	= $_GET["sortDirection"];
		if (isset($_GET["action"]))			$this->action			= $_GET["action"];
		if(isset($_GET["feedSortDirection"])) 	  $this->feedSortDirection			=	$_GET["feedSortDirection"];
		if(isset($_GET["feedSortcolumn"])) 	 $this->feedSortcolumn			=	$_GET["feedSortcolumn"];
		if ($this->sortDirection == "DESC") 							  
			$this->sortImage	= " <img src='".$this->includePath."images/sortdesc.gif'>";
		else
			$this->sortImage	= " <img src='".$this->includePath."images/sortasc.gif'>";
/*			
		if (isset($_GET["debug"]))			$this->debug			= $_GET["debug"];		
		
		//203.200.143.20 - kochi ip
		//if($this->getIp() == "192.168.0.129"){
				if($this->debug == 1){		
					$_SESSION["DEBUG"] = 1;
				}
				elseif($this->debug <>"" && $this->debug == 0){
					$_SESSION["DEBUG"] = 0;	
				}
				if($_SESSION["DEBUG"] == 1){
					global $className;
					$className         = $this->implementClassName;
				}
		  // }*/		
	}
	
	 function sortImage($fieldName, $sortColumn) {
		
		 if (trim($fieldName)  == trim($sortColumn))

			return $this->sortImage;			
		 else 
			return "";
	 }	
	
	function getIp() {

		$ipAddress = getenv("REMOTE_ADDR"); 

		if($ipAddress == "") 
			$ipAddress = $_SERVER['REMOTE_ADDR'];

		return $ipAddress;
	}
	
/*	function getProductInfo() {

		$query	= "	SELECT	projectName, projectVersion 
					FROM	lcsettings";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		if($dbQry->numRows() >0) {
			$row = $dbQry->getArray();
			$this->projectName		= $row["projectName"];
			$this->projectVersion	= $row["projectVersion"];
			return 1;
		}
		else {
			return 0;
		}
	} */
}	
?>

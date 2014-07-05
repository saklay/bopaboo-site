<?php
class clsbpPaginate {

	var $dbQry;	
	var $query;
	
	var $jumpTo;
	var $pageSize;
	var $numOfRecs;
	var $pageIndex;
	var $numOfPages;
	var $recsFrom;
	var $recsTo;
	var $recordNumberOffset;	// this will be recordnumber offset for the starting number in a page,
								// respective of pagesize and pageindex
		
	var $rangeVal;
	var $rangeCurrent;
	var $rangeTotal;
	var $rangePrevPg;
	var $rangeNextPg;
	var $rangeCurrentStart;
	var $rangeCurrentEnd;	
	var $includePath;
	var $orderCol;
	var $orderAscDesc;
	var $orderGif;
	
	
	//$runOptimised - give value of 0 if no distinct query
	function clsbpPaginate($connId, $query, $pageSize=0, $rangeVal=15, $pageIndex, $includePath, $runOptimised=0) {
		
		$this->includePath	= $includePath;
		
		$this->query 				= $query;
		$this->pageSize				= $pageSize;
		
		$this->rangeVal				= $rangeVal;
		$this->numOfRecs			= 0;
		$this->pageIndex			= $pageIndex;
		$this->numOfPages			= 0;
		$this->recsFrom				= 0;
		$this->recsTo				= $this->pageSize;	
		$this->recordNumberOffset	= 1;
		
				
		//Getting the total num of recs
		if ($runOptimised == 0) {
			//commented the below line sine the distinct and contacted fields order by was creation issues, which we didnt like
			//$countQry			= "Select count(*) " . stristr($query, "from");			
			$countQry			= "Select count(*) " . str_replace(stristr($query, "ORDER BY"),"",stristr($query, "from"));	
			$this->dbQry		= new dbQuery($countQry, $connId);
			$row				= $this->dbQry->getArray();
			$this->numOfRecs	= $row[0]; 
		}
		else {
			//No Optimisation will be done here.
			//	This change was made because there was problem in executing a query which has both count(*) and UNION
			$this->dbQry		= new dbQuery($query, $connId);
			$this->numOfRecs	= $this->dbQry->numRows();
		}
				
		$this->setPageVars();
		
		$limitQry	= $query . " LIMIT " . $this->recsFrom . ", " . $this->pageSize;
		$this->dbQry->dbQuery($limitQry, $connId);
	}
	
	function setPageVars() {

		if ($this->pageSize == 0) {
			$this->recsFrom		= 0;
			$this->recsTo		= $this->numOfRecs;
			$this->pageIndex	= 1;
			$this->numOfPages	= 1;
			$this->pageSize		= $this->numOfRecs;
		} 
		else {
		
			$this->numOfPages	= ceil($this->numOfRecs / $this->pageSize);
			if ($this->pageIndex <= 0) $this->pageIndex = 1;	
			if ($this->pageIndex > $this->numOfPages) $this->pageIndex = $this->numOfPages;
			$this->recsFrom		= ($this->pageIndex - 1) * $this->pageSize;
			if($this->recsFrom < 0) $this->recsFrom = 0;
			$this->recsTo		= $this->recsFrom + $this->pageSize;
			if ($this->recsTo > $this->numOfRecs) $this->recsTo = $this->numOfRecs;
		}
	}

	function getCurrPagesRangeVar() {

		$this->rangeCurrent	= ceil($this->pageIndex / $this->rangeVal);
		$this->rangeTotal	= ceil($this->numOfPages / $this->rangeVal);
		$this->rangePrevPg	= 1;
		$this->rangeNextPg	= 1;
		
		if ($this->rangeCurrent > 1) $this->rangePrevPg = ($this->rangeCurrent - 2) * $this->rangeVal + 1;
		if ($this->rangeTotal > $this->rangeCurrent) $this->rangeNextPg = ($this->rangeCurrent) * $this->rangeVal + 1;

		$this->rangeCurrentStart	= ($this->rangeCurrent - 1) * $this->rangeVal + 1;
		$this->rangeCurrentEnd		= $this->rangeCurrentStart + $this->rangeVal - 1;
				
		if ($this->rangeCurrentEnd > $this->numOfPages) {
			$this->rangeCurrentStart	= $this->numOfPages - $this->rangeVal + 1;
			if ($this->rangeCurrentStart < 1) $this->rangeCurrentStart = 1;
			$this->rangeCurrentEnd		= $this->numOfPages;
		}
		
		$this->recordNumberOffset	= ($this->pageSize * ($this->pageIndex - 1)) + 1;
	}

	function getArray() {

		return $this->dbQry->getArray();
	}
		
	function writeHTMLPageRanges($className, $pageName, $extraParameters="") {

		$this->getCurrPagesRangeVar();
		if ($this->rangeCurrent <= 0) return;
		

		//$this->rangeCurrent=$this->rangeCurrent+2;
		//$this->rangeTotal=$this->rangeTotal+2;
		if ($this->pageIndex == 1) 
			echo 'Previous&nbsp;&nbsp;';
		else { 
		
			//$turl 	= "javascript:navigatePage(1, \"$className\", \"$pageName\", \"$extraParameters\");";
			//echo "<b><span class='content'><font size=1><A href='$turl'>1</b></span></A></font>&nbsp;";
		    $pre = $this->pageIndex-1;
			$turl	= "javascript:navigatePage($pre, \"$className\", \"$pageName\", \"$extraParameters\");";
			echo "<A href='$turl'>Previous</A>&nbsp;&nbsp;";
		}
		if($this->numOfRecs<=$this->pageSize)
		$div = "|";
		
		for ($i=$this->rangeCurrentStart; $i<=$this->rangeCurrentEnd; $i++) {
			if ($this->pageIndex == $i)
				echo "<span >".$div."&nbsp;<B>".$i."</B>&nbsp;|</span>";
			else {
				$turl	= "javascript:navigatePage($i, \"$className\", \"$pageName\", \"$extraParameters\");";
				echo "<span ><A href='$turl'>$i</A>|</span>";
			}
		}
		
		echo "</font></SPAN>";
		//print $this->numOfPages	."--".$this->pageIndex;
		if ($this->pageIndex == $this->numOfPages)
			echo "&nbsp;&nbsp;Next";
		else {
				$next = $this->pageIndex+1;
			$turl	= "javascript:navigatePage($next, \"$className\", \"$pageName\", \"$extraParameters\");";
			echo "&nbsp;&nbsp;<A href='$turl'>Next</A>";

			//$turl	= "javascript:navigatePage($this->numOfPages, \"$className\", \"$pageName\", \"$extraParameters\");";
			//echo "&nbsp;<b><span class='normal'><A href='$turl'>$this->numOfPages</b></span></A>";
		}
	
		
	}
	
	function getHTMLPageRangesForAjax($ajaxUrl,$className, $pageName, $extraParameters="",$tagName) {
		$this->getCurrPagesRangeVar();
		if ($this->rangeCurrent <= 0) return;
		

		//$this->rangeCurrent=$this->rangeCurrent+2;
		//$this->rangeTotal=$this->rangeTotal+2;
	
		if ($this->pageIndex == 1) 
			$returnUrl =  'Previous&nbsp;&nbsp;';
		else { 
		
			//$turl 	= "javascript:navigatePage(1, \"$className\", \"$pageName\", \"$extraParameters\");";
			//echo "<b><span class='content'><font size=1><A href='$turl'>1</b></span></A></font>&nbsp;";
		    $pre = $this->pageIndex-1;
			$turl	= "javascript:navigateAjaxPage(\"$ajaxUrl\",$pre, \"$className\", \"$pageName\", \"$extraParameters\", \"$tagName\");";
			$returnUrl .= "<A href='$turl'>Previous</A>&nbsp;&nbsp;";
		}
		if($this->numOfRecs<=$this->pageSize)
		$div = "|";
		
		for ($i=$this->rangeCurrentStart; $i<=$this->rangeCurrentEnd; $i++) {
			if ($this->pageIndex == $i)
				$returnUrl.= "<span >".$div."&nbsp;<B>".$i."</B>&nbsp;|</span>";
			else {
				$turl	= "javascript:navigateAjaxPage(\"$ajaxUrl\",$i, \"$className\", \"$pageName\", \"$extraParameters\", \"$tagName\");";
				$returnUrl .= "<span ><A href='$turl'>$i</A>|</span>";
			}
		}
		
		$returnUrl .= "</font></SPAN>";
		//print $this->numOfPages	."--".$this->pageIndex;
		if ($this->pageIndex == $this->numOfPages)
			$returnUrl .= "&nbsp;&nbsp;Next";
		else {
				$next = $this->pageIndex+1;
			$turl	= "javascript:navigateAjaxPage(\"$ajaxUrl\",$next, \"$className\", \"$pageName\", \"$extraParameters\", \"$tagName\");";
			 $returnUrl .= "&nbsp;&nbsp;<A href='$turl'>Next</A>";

			//$turl	= "javascript:navigatePage($this->numOfPages, \"$className\", \"$pageName\", \"$extraParameters\");";
			//echo "&nbsp;<b><span class='normal'><A href='$turl'>$this->numOfPages</b></span></A>";
		}
	
		return $returnUrl;
	}
	
	function writePageStatus($totalRecsInCurrentPage) {
    	
		if ($totalRecsInCurrentPage <= 0) return;

		$pageStatus = ($this->pageSize * ($this->pageIndex - 1)) + 1;
		$pageStatus .= " - ";
		$pageStatus .= ($this->pageSize * ($this->pageIndex - 1)) + $totalRecsInCurrentPage;
		$pageStatus .= " of ";
		$pageStatus .= $this->numOfRecs;
		$pageStatus .= " Records";	 
		return $pageStatus;
	}
}
?>

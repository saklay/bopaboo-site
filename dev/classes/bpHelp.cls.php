<?php
/*******************************************************************
/ Title: Help system class, this handles mainly two tables (tbl_faqhelp, lkup_faqcategory)
/ Purpose: This file is used for handelling the internal messaging system.
/ 
/ Inputs:   
			
/ Outputs:  
/           

/ Authors: BL Team for Bopaboo
/*******************************************************************/
class clsbpHelp extends clsbpBase {
	
	var $nFaqId;
	var $nCatId;
	var $strQuestion;
	var $strAnswer;
	var $strDateUpdated;
	var $strActive;
	var $searchKeyword;
	var $action;
	
	
	function clsbpHelp($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpHelp");			
		
 		$this->nFaqId = 0;
 		$this->nCatId = 0;
 		$this->strQuestion = "";
 		$this->strAnswer = "";
 		$this->strDateUpdated = date('Y-m-d');
 		$this->strActive = '1';
 		$this->searchKeyword='';
 		$this->action = "";
	}
	
	function setPostVars() {	
		parent::setPostVars();	
		if (isset($_POST['clsbpHelp_FaqId']))  $this->nFaqId					= $_POST['clsbpHelp_FaqId'];
		if (isset($_POST['clsbpHelp_CatId']))  $this->nCatId					= $_POST['clsbpHelp_CatId'];
		if (isset($_POST['clsbpHelp_Question']))  $this->strQuestion			= $_POST['clsbpHelp_Question'];
		if (isset($_POST['clsbpHelp_Answer']))  $this->strAnswer				= $_POST['clsbpHelp_Answer'];
		if (isset($_POST['clsbpHelp_Date']))  $this->strDateUpdated			= $_POST['clsbpHelp_Date'];
		if (isset($_POST['clsbpHelp_Active']))  $this->strActive				= $_POST['clsbpHelp_Active'];
		if (isset($_POST['clsbpHelp_SearchKeyword']))$this->searchKeyword	= $_POST['clsbpHelp_SearchKeyword'];
	}

	function setGetVars() {

		parent::setGetVars();	
		if (isset($_GET['clsbpHelp_FaqId']))  $this->nFaqId				= $_GET['clsbpHelp_FaqId'];
		if (isset($_GET['clsbpHelp_CatId']))  $this->nCatId				= $_GET['clsbpHelp_CatId'];
		if (isset($_GET['clsbpHelp_Question']))  $this->strQuestion			= $_GET['clsbpHelp_Question'];
		if (isset($_GET['clsbpHelp_Answer']))  $this->strAnswer			= $_GET['clsbpHelp_Answer'];
		if (isset($_GET['clsbpHelp_Date']))  $this->strDateUpdated		= $_GET['clsbpHelp_Date'];
		if (isset($_GET['clsbpHelp_Active']))  $this->strActive				= $_GET['clsbpHelp_Active'];
		if (isset($_GET['clsbpHelp_SearchKeyword']))$this->searchKeyword	= $_GET['clsbpHelp_SearchKeyword'];
	}
	
	function getAllHelpCategory() {
		$query = "	SELECT
						* 
					FROM
						lkup_faqcategory
					ORDER BY 
						sortOrder
				";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		return $this->retrieveCatRowArray($dbQry);
	}
	
	function retrieveCatRowArray($dbQry) {
	
		$arrHelp	= array();
		while($row  = $dbQry->getArray()) {
			$arrHelp[$row["bi_CatID"]]	= array(
												"bi_CatID"	    => $row["bi_CatID"],	
												"vc_CatName"	    => $row["vc_CatName"]			
											    );
		}			
		return $arrHelp;
	}
	
	function getCatActiveQuestions($catId) {
	
		$query = "	SELECT 
						* 
					FROM 
						tbl_faqhelp
					WHERE
						bi_CatID = $catId
							AND
						enum_Active = '1';
				";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		return $this->retrieveHelpRowArray($dbQry);
		
	}
	
	function retrieveHelpRowArray($dbQry) {
	
		$arrHelp	= array();
		while($row  = $dbQry->getArray()) {
			$arrHelp[$row["bi_FaqID"]]	= array(
												"bi_FaqID"	    	=> $row["bi_FaqID"],	
												"bi_CatID"	    	=> $row["bi_CatID"],			
												"t_Question"	    	=> $row["t_Question"],
												"lt_Answer"	    	=> $row["lt_Answer"],
												"dt_UpdateDate"	=> $row["dt_UpdateDate"],
												"enum_Active"	=> $row["enum_Active"]
											    );
		}			
		return $arrHelp;
	}
	
	function getAnswerRow($faqId) {
		$query = "	SELECT 
						*  
					FROM 
						tbl_faqhelp
					WHERE
						bi_FaqID = $faqId
				";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		return $this->retrieveAnswerRow($dbQry);
	}
	
	function retrieveAnswerRow($dbQry) {
		if(!$dbQry->numRows()) return 0;
		
		$row				= $dbQry->getArray();
		
		$this->nFaqId = $row['bi_FaqID'];
 		$this->nCatId = $row['bi_CatID'];
 		$this->strQuestion = $row['t_Question'];
 		$this->strAnswer = $row['lt_Answer'];
 		$this->strDateUpdated = $row['dt_UpdateDate'];
 		$this->strActive = $row['enum_Active'];
	
		return 1;
	}
	function getSearchResult($keyword) {
		if($keyword=="Search the FAQ"){
			$keyword = "";	
		}
		
		$keywords = explode(" ",$keyword);

		$query = "	SELECT 
						* 
					FROM 
						tbl_faqhelp
					WHERE
						t_Question LIKE '%$keyword%'
							OR
						lt_Answer LIKE '%$keyword%'";
		$i=0;
		while($i<count($keywords)) {
			$query.= " OR t_Question LIKE '%".$keywords[$i]."%' OR lt_Answer LIKE '%".$keywords[$i]."%'";
			$i++;
		}
		$query .= " AND enum_Active = '1' ";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		return $this->retrieveHelpRowArray($dbQry);
	}
	
}

?>
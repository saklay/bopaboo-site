<?php

/*******************************************************************
/ Title: Genre Class.
/ Purpose: This file is used for handelling Genre functions .
/ 
/ Inputs:   
			
/ Outputs:  
/           

/ Authors: s Sivaprasad C
/*******************************************************************/
class clsbpGenre extends clsbpBase  { 

	var $bi_GenreId;		
	var $vc_GenreName;		
	var $ti_GenreActive;		
	var $GenreIds;

	function clsbpGenre($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpGenre");			
		
		$this->bi_GenreId		= "";		
		$this->vc_GenreName		= "";		
		$this->ti_GenreActive	= "";	
		$this->GenreIds	        = "";	
		$this->includePath		= $includePath;
		$this->sortColumn		= "vc_GenreName";
		$this->sortDirection    = "ASC";
		$this->pageSize			= constant('BPDEFAULTPAGESIZE');
		$this->rangeVal			= constant("BPRANGEVAL");
	}

	function setPostVars() {	

		parent::setPostVars();	
		if (isset($_POST['clsbpGenre_bi_GenreId']))	        $this->bi_GenreId	   = trim($_POST['clsbpGenre_GenreId']);
		if (isset($_POST['clsbpGenre_vc_GenreName']))	$this->vc_GenreName	   = trim($_POST['clsbpGenre_vc_GenreName']);
		if (isset($_POST['clsbpGenre_GenreActive']))	    $this->ti_GenreActive  = trim($_POST['clsbpGenre_GenreActive']);
		if (isset($_POST['clsbpGenre_GenreIds']))           $this->GenreIds		   = trim($_POST['clsbpGenre_GenreIds']);			
	}

	function setGetVars() {

		parent::setGetVars();	

		if (isset($_GET['clsbpGenre_bi_GenreId']))		$this->bi_GenreId	  = trim($_GET['clsbpGenre_bi_GenreId']);
		if (isset($_GET['clsbpGenre_vc_GenreName']))		$this->vc_GenreName	  = trim($_GET['clsbpGenre_vc_GenreName']);
		if (isset($_GET['GenreActive']))	$this->ti_GenreActive = trim($_GET['GenreActive']);
		if (isset($_GET['GenreIds']))		$this->GenreIds	      = trim($_GET['GenreIds']);			
	}
	
	// add/edit genre information
	function saveGenre($bi_GenreId) { 

		if (!$this->validateGenre()) return 0;	

		if (trim($GenreId) ==  "") {

			$query	= " INSERT INTO   
							lkup_genre 
							(
								vc_GenreName,
								ti_GenreActive
							) 
						VALUES 
							(
								\"$this->vc_GenreName\",
								\"$this->ti_GenreActive\"
								
							)";


			
			$dbQry	        = new dbQuery($query, $this->connect->connId);
			$this->GenreId	= $dbQry->lastInsertId();
			
			$_SESSION["FMMESSAGE"]	= "Genre added successfully";	

		} 
		else {

			$query	= "	UPDATE 
							lkup_genre 
						SET 
							vc_GenreName   = \"$this->vc_GenreName\",
							ti_GenreActive = \"$this->ti_GenreActive\"
						WHERE 
							bi_GenreId   = $GenreId";
							

			$dbQry	        = new dbQuery($query, $this->connect->connId);
			$this->GenreId	= $GenreId;
			
			$_SESSION["FMMESSAGE"]	= "Genre updated successfully";	
		}
		return $this->GenreId;
	}
	
	// function to validate genre while insert an new and update an exsisting genre.
	function validateGenre() { 
		
			$_SESSION["FMMESSAGE"]    = "";	
			
		if (trim($this->GenreName) == "") {
			$_SESSION["FMMESSAGE"] .= "Genre Name cannot be null <BR>";
		}

		$query	= " SELECT 
						* 
					FROM 
						lkup_genre 
					WHERE 
						vc_GenreName = '$this->vc_GenreName' ";
		if (trim($this->GenreId) != "") {
			$query	.= " AND bi_GenreId != $this->bi_GenreId";
		}

		$dbQry	= new dbQuery($query, $this->connect->connId);		
		if ($dbQry->numRows() > 0) {				
			$_SESSION["FMMESSAGE"] .= "The Genre already exist";
		} 

	if (strlen($_SESSION["FMMESSAGE"]) > 0) {
			return 0;
		} else {
			return 1;
		}						
	}
	
	// retrive a single row 
	function retrieveGenre($bi_GenreId) {

	if (trim($bi_GenreId) == "") return 0;	

	$query	= " SELECT 
						* 
					FROM 
						lkup_genre 
					WHERE 
						bi_GenreId = $bi_GenreId"; 
						
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveGenreRow($dbQry);
		return $dbQry->numRows();
	
	} 
	function retrieveGenreName() {

		

	 $query	= " SELECT 
						* 
					FROM 
						lkup_genre 
					"; 
						
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveGenreNameRow($dbQry);
		return $dbQry->numRows();
	
	} 
	
       function retrieveGenreNameRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

	        $row				= $dbQry->getArray(); 
		$this->GenreId		= $row["bi_GenreId"];
		$this->GenreName	= $row["vc_GenreName"];
		$this->GenreActive	= $row["ti_GenreActive"];
			
		return 1;
	}
	function retrieveGenreNameArray() { 	
		
		 $query	= " SELECT	
						lkup_genre.bi_GenreId,
						lkup_genre.vc_GenreName,
						lkup_genre.ti_GenreActive
								
					FROM	
						lkup_genre WHERE 1=1 ";	

	
					
		if (trim($this->categoryName) != "") 
			$query	.= " AND vc_GenreName LIKE '%".$this->vc_GenreName."%'";
				
		if (trim($this->GenreIds) != "") 
			$query	.= " AND bi_GenreId IN($this->GenreIds)";
			
	$query	.= " ORDER BY lkup_genre.$this->sortColumn $this->sortDirection";
	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
	      return  $this->retrieveGenreNameRowArray($dbQry);
	}

	function retrieveGenreNameRowArray($dbQry) {
	
		$arrGenre	= array();
		while($row		= $dbQry->getArray()) {
			$arrGenre[$row["bi_GenreId"]]	= array(
														"bi_GenreId"			=> $row["bi_GenreId"],
														"vc_GenreName"			=> $row["vc_GenreName"],
														"ti_GenreActive"		=> $row["ti_GenreActive"]
												);
		}			
	return $arrGenre;
	}
	function retrieveGenreRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

	        $row				= $dbQry->getArray(); 
		$this->bi_GenreId		= $row["bi_GenreId"];
		$this->vc_GenreName	= $row["vc_GenreName"];
		$this->GenreActive	= $row["ti_GenreActive"];
			
		return 1;
	}
        
	function retrieveGenreArray() { 	
		
		 $query	= " SELECT	
						lkup_genre.bi_GenreId,
						lkup_genre.vc_GenreName,
						lkup_genre.ti_GenreActive
								
					FROM	
						lkup_genre WHERE 1=1 ";	

		if(trim($this->GenreId) != "") 
			$query	.=	" AND bi_GenreId	=	".$this->bi_GenreId;
					
		if (trim($this->vc_GenreName) != "") 
			$query	.= " AND vc_GenreName LIKE '%".$this->vc_GenreName."%'";
				
		if (trim($this->GenreIds) != "") 
			$query	.= " AND bi_GenreId IN($this->GenreIds)";
			
	       $query	.= " ORDER BY $this->sortColumn $this->sortDirection";
	
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
	      return $this->retrieveGenreRowArray($this->clsbpPaginate);
	}

	function retrieveGenreRowArray($dbQry) {
	
		$arrGenre	= array();
		while($row		= $dbQry->getArray()) {
			$arrGenre[$row["bi_GenreId"]]	= array(
														"bi_GenreId"			=> $row["bi_GenreId"],
														"vc_GenreName"			=> $row["vc_GenreName"],
														"ti_GenreActive"		=> $row["ti_GenreActive"]
												);
		}			
	return $arrGenre;
	}

	function retrieveGenreDependencyArray() { 	
		
		$query	= " SELECT	
						fmgenre.bi_GenreId,
						fmgenre.vc_GenreName,
						fmgenre.GenreActive
							
					FROM	
						lkup_genre 
					INNER JOIN tbl_member_files ON fmgenre.bi_GenreId = tbl_member_files.bi_GenreId    	
						WHERE 1=1 ";
							
		if(trim($this->GenreId) != "") 
			$query	.=	" AND fmgenre.bi_GenreId	=	".$this->bi_GenreId;
					
		if (trim($this->GenreName) != "") 
			$query	.= " AND fmgenre.vc_GenreName LIKE '%".$this->vc_GenreName."%'";
			
		if (trim($this->GenreIds) != "") 
			$query	.= " AND fmgenre.bi_GenreId IN($this->GenreIds)";
			
	        $query	.= " ORDER BY $this->sortColumn $this->sortDirection";
		
		$dbQry	= new dbQuery($query, $this->connect->connId);	

		return	$this->retrieveGenreDependencyRowArray($dbQry);

	}

	function retrieveGenreDependencyRowArray($dbQry) {
	
		$arrGenre	= array();
		while($row		= $dbQry->getArray()) {
			$arrGenre[$row["bi_GenreId"]]	= array(
														"GenreId"			=> $row["bi_GenreId"],
														"GenreName"			=> $row["vc_GenreName"],
														"ti_GenreActive"		=> $row["ti_GenreActive"]
												);
		}			
		return $arrGenre;
	}

	function deleteGenre($GenreIds) {

		if (trim($GenreIds) == "") return 0;
		
// ----- Starting of dependency check -----

		$arrDependencyArray = array();
		$arrDependencyArray = $this->retrieveGenreDependencyArray();

// Getting Names of Genre  & having Dependency.
		$dependendArray = array();  				 // Stores the genreIds having Dependency.
		$dependedGenre  = "";      		   			// Stores the GenreNames having Dependency.
		
		foreach($arrDependencyArray as $rowDependency){
			if($dependedGenre <> "") $dependedGenre .= ",<br>";	
			$dependedGenre    .= $rowDependency["vc_GenreName"];
			$dependendArray[] =  $rowDependency["bi_GenreId"]; 									
		}			
		
		if(trim($dependedGenre) <> "") 
			$_SESSION["FMMESSAGE"]	.= '<br><font color ="red">'.$dependedGenre.'<br> Cannot be deleted.<br>These Genre may have associated with a song</font>';
		
		if(!is_array($GenreIds)) 
			$arrGenreIds = explode(",",$GenreIds);						  // Making genreIds to function Array
			
		$arrGenreIdsForDelete = array_diff($arrGenreIds, $dependendArray);  // Get the genreIds don't have dependency as Array
		
		$GenreIdsForDelete = implode(",",$arrGenreIdsForDelete);	 		  // Make the deletable array again string.
		
		if (trim($GenreIdsForDelete) == "") return 0;

		$genreIds = $GenreIdsForDelete;									// Assign deletable string to $genreIds	
			
//----End of Dependency check ----- 				
		
		$query	= " DELETE FROM 
						fmgenre 
					WHERE 
						bi_GenreId IN ($genreIds)";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$_SESSION["FMMESSAGE"]	.= "Gener(s) deleted successfully";

		return 1;			
	}
			
	function postCategory() {	

		$this->setPostVars();
		$this->setGetVars();	
		
		
		if ($this->action == "SAVE") {		
			if ($this->saveGenre($this->bi_GenreId)) {
				header("location:".stripslashes($this->includePath."admin/".$this->returnUrl));			
				exit();					
			}
		}
		else if ($this->action == "DELETE") {				
			$this->deleteGenre($this->GenreIds);
			header("location:".stripslashes($this->includePath."admin/".$this->returnUrl));				
			exit();
		}
		
		return $this->retrieveGenre($this->bi_GenreId);
	}
}
?>

<?php 
class clsbpBopaBox extends clsbpBase  { 

	var $bi_file_id;		
	var $bi_FileTypeId;		
	var $bi_GenreId;		
	var $i_tg_id;		
	var $bi_MemberId;		
	var $vc_FileName;		
	var $vc_FilePath;		
	var $dt_FileUploaded;		
	var $dbl_price;		
	var $i_in_sell;		

	var $bi_file_ids;

	function clsbpBopaBox($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpBopaBox");			
		
		$this->bi_file_id	= "";		
		$this->bi_FileTypeId	= "";		
		$this->bi_GenreId	= "";		
		$this->i_tg_id	= "";		
		$this->bi_MemberId	= "";		
		$this->vc_FileName	= "";		
		$this->vc_FilePath	= "";		
		$this->dt_FileUploaded	= "";		
		$this->dbl_price	= "";		
		$this->i_in_sell	= "";		

		$this->bi_file_ids				= "";
		$this->fileIds4sale = "";
		$this->includePath			= $includePath;
		$this->sortColumn			= "vc_artists_nm_mod";
		$this->pageSize				= 10;
		$this->rangeVal				= constant("BPRANGEVAL");
		$this->returnURL ="";
	}

	function setPostVars() {	

		parent::setPostVars();	
		if (isset($_POST['clsbpBopaBox_bi_file_id']))			$this->bi_file_id				= trim($_POST['clsbpBopaBox_bi_file_id']);
		if (isset($_POST['clsbpBopaBox_bi_FileTypeId']))			$this->bi_FileTypeId				= trim($_POST['clsbpBopaBox_bi_FileTypeId']);
		if (isset($_POST['clsbpBopaBox_bi_GenreId']))			$this->bi_GenreId				= trim($_POST['clsbpBopaBox_bi_GenreId']);
		if (isset($_POST['clsbpBopaBox_i_tg_id']))			$this->i_tg_id				= trim($_POST['clsbpBopaBox_i_tg_id']);
		if (isset($_POST['clsbpBopaBox_bi_MemberId']))			$this->bi_MemberId				= trim($_POST['clsbpBopaBox_bi_MemberId']);
		if (isset($_POST['clsbpBopaBox_vc_FileName']))			$this->vc_FileName				= trim($_POST['clsbpBopaBox_vc_FileName']);
		if (isset($_POST['clsbpBopaBox_vc_FilePath']))			$this->vc_FilePath				= trim($_POST['clsbpBopaBox_vc_FilePath']);
		if (isset($_POST['clsbpBopaBox_dt_FileUploaded']))			$this->dt_FileUploaded				= trim($_POST['clsbpBopaBox_dt_FileUploaded']);
		if (isset($_POST['clsbpBopaBox_dbl_price']))			$this->dbl_price				= trim($_POST['clsbpBopaBox_dbl_price']);
		if (isset($_POST['clsbpBopaBox_i_in_sell']))			$this->i_in_sell				= trim($_POST['clsbpBopaBox_i_in_sell']);
		if (isset($_POST['clsbpFileDetails_jumpTo']))           $this->jumpTo	        = trim($_POST['clsbpFileDetails_jumpTo']);
		if (isset($_SESSION["USERID"]))		                    $this->bi_MemberId	    = trim($_SESSION["USERID"]	);
		if (isset($_POST['clsbpBopaBox_bi_file_ids']))				$this->bi_file_ids					= trim($_POST['clsbpBopaBox_bi_file_ids']);			
	}

	function setGetVars() {

		parent::setGetVars();	

			if (isset($_GET['bi_file_id']))			$this->bi_file_id							= trim($_GET['bi_file_id']);
			if (isset($_GET['bi_FileTypeId']))		$this->bi_FileTypeId						= trim($_GET['bi_FileTypeId']);
			if (isset($_GET['bi_GenreId']))			$this->bi_GenreId							= trim($_GET['bi_GenreId']);
			if (isset($_GET['i_tg_id']))			$this->i_tg_id								= trim($_GET['i_tg_id']);
			if (isset($_GET['bi_MemberId']))		$this->bi_MemberId							= trim($_GET['bi_MemberId']);
			if (isset($_GET['vc_FileName']))		$this->vc_FileName							= trim($_GET['vc_FileName']);
			if (isset($_GET['vc_FilePath']))		$this->vc_FilePath							= trim($_GET['vc_FilePath']);
			if (isset($_GET['dt_FileUploaded']))	$this->dt_FileUploaded						= trim($_GET['dt_FileUploaded']);
			if (isset($_GET['dbl_price']))			$this->dbl_price							= trim($_GET['dbl_price']);
			if (isset($_GET['i_in_sell']))			$this->i_in_sell							= trim($_GET['i_in_sell']);
			
			
			if (isset($_GET['bi_file_ids']))		$this->bi_file_ids							= trim($_GET['bi_file_ids']);			
	}
	
	function saveBopaBox($bi_file_id) { 

		if (!$this->validateBopaBox()) return 0;	

		if (trim($bi_file_id) ==  "") {

			$query	= " INSERT INTO   
							tbl_bopabox 
							(
							bi_FileTypeId,
							bi_GenreId,
							i_tg_id,
							bi_MemberId,
							vc_FileName,
							vc_FilePath,
							dt_FileUploaded,
							dbl_price,
							i_in_sell

							) 
						VALUES 
							(
							\"$this->bi_FileTypeId\",
							\"$this->bi_GenreId\",
							\"$this->i_tg_id\",
							\"$this->bi_MemberId\",
							\"$this->vc_FileName\",
							\"$this->vc_FilePath\",
							\"$this->dt_FileUploaded\",
							\"$this->dbl_price\",
							\"$this->i_in_sell\"

							)";

			$dbQry	= new dbQuery($query, $this->connect->connId);
			$this->bi_file_id		= $dbQry->lastInsertId();
			$_SESSION["MESSAGE"]	= "BopaBox added successfully";	

		} 
		else {

			$query	= "	UPDATE 
							tbl_bopabox 
						SET 
							bi_FileTypeId = \"$this->bi_FileTypeId\",
							bi_GenreId = \"$this->bi_GenreId\",
							i_tg_id = \"$this->i_tg_id\",
							bi_MemberId = \"$this->bi_MemberId\",
							vc_FileName = \"$this->vc_FileName\",
							vc_FilePath = \"$this->vc_FilePath\",
							dt_FileUploaded = \"$this->dt_FileUploaded\",
							dbl_price = \"$this->dbl_price\",
							i_in_sell = \"$this->i_in_sell\"

						WHERE 
							bi_file_id   = $bi_file_id";

			$dbQry	= new dbQuery($query, $this->connect->connId);
			$this->bi_file_id		= $bi_file_id;
			$_SESSION["MESSAGE"]	= "BopaBox updated successfully";	
		}
		return $this->bi_file_id;
	}

	function validateBopaBox() {	
			$_SESSION["BPMESSAGE"] 	= "";	
		if (trim($this->bi_FileTypeId) == "") {
			$_SESSION["BPMESSAGE"] .= "Bi_ File Type Name cannot be null <BR>";
		}
		if (trim($this->bi_GenreId) == "") {
			$_SESSION["BPMESSAGE"] .= "Bi_ Genre Name cannot be null <BR>";
		}
		if (trim($this->i_tg_id) == "") {
			$_SESSION["BPMESSAGE"] .= "I_tg_id cannot be null <BR>";
		}
		if (trim($this->bi_MemberId) == "") {
			$_SESSION["BPMESSAGE"] .= "Bi_ Member Name cannot be null <BR>";
		}
		if (trim($this->vc_FileName) == "") {
			$_SESSION["BPMESSAGE"] .= "Vc_ File Name cannot be null <BR>";
		}
		if (trim($this->vc_FilePath) == "") {
			$_SESSION["BPMESSAGE"] .= "Vc_ File Path cannot be null <BR>";
		}
		if (trim($this->dt_FileUploaded) == "") {
			$_SESSION["BPMESSAGE"] .= "Dt_ File Uploaded cannot be null <BR>";
		}
		if (trim($this->dbl_price) == "") {
			$_SESSION["BPMESSAGE"] .= "Dbl_price cannot be null <BR>";
		}
		if (trim($this->i_in_sell) == "") {
			$_SESSION["BPMESSAGE"] .= "I_in_sell cannot be null <BR>";
		}

	if (strlen($_SESSION["BPMESSAGE"]) > 0) {
			return 0;
		} else {
			return 1;
		}						
	}

	function retrieveBopaBox($bi_file_id) {

		if (trim($bi_file_id) == "") return 0;

		$query	= " SELECT 
						* 
					FROM 
						tbl_bopabox 
					WHERE 
						bi_file_id = $bi_file_id";	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveBopaBoxRow($dbQry);
		return $dbQry->numRows();
	}

	function retrieveBopaBoxRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row						= $dbQry->getArray();
		$this->bi_file_id			= $row["bi_file_id"];
		$this->bi_FileTypeId			= $row["bi_FileTypeId"];
		$this->bi_GenreId			= $row["bi_GenreId"];
		$this->i_tg_id			= $row["i_tg_id"];
		$this->bi_MemberId			= $row["bi_MemberId"];
		$this->vc_FileName			= $row["vc_FileName"];
		$this->vc_FilePath			= $row["vc_FilePath"];
		$this->dt_FileUploaded			= $row["dt_FileUploaded"];
		$this->dbl_price			= $row["dbl_price"];
		$this->i_in_sell			= $row["i_in_sell"];

			

		return 1;

	}

	function retrieveBopaBoxArray() { 	
		
		$query	= "SELECT * FROM tbl_bopabox bpbox, tbl_papa papa, tbl_id3_tags id3
					WHERE bpbox.bi_file_id = papa.bi_file_id
					AND bpbox.i_tg_id = id3.i_tg_id AND bi_MemberId=$this->bi_MemberId";	
						
	
		if(trim($this->bi_file_id) != "") 
			$query	.=	" AND bi_file_id	=	".$this->bi_file_id;		
		if(trim($this->bi_FileTypeId) != "") 
			$query	.=	" AND bi_FileTypeId	=	".$this->bi_FileTypeId;		
		if(trim($this->bi_GenreId) != "") 
			$query	.=	" AND bi_GenreId	=	".$this->bi_GenreId;		
		if(trim($this->i_tg_id) != "") 
			$query	.=	" AND i_tg_id	=	".$this->i_tg_id;		
		if(trim($this->bi_MemberId) != "") 
			$query	.=	" AND bi_MemberId	=	".$this->bi_MemberId;		
		if(trim($this->dbl_price) != "") 
			$query	.=	" AND dbl_price	=	".$this->dbl_price;		
		if(trim($this->i_in_sell) != "") 
			$query	.=	" AND i_in_sell	=	".$this->i_in_sell;		

		if (trim($this->vc_FileName) != "") 
			$query	.= " AND vc_FileName LIKE '%".$this->vc_FileName."%'";
		if (trim($this->vc_FilePath) != "") 
			$query	.= " AND vc_FilePath LIKE '%".$this->vc_FilePath."%'";
		if (trim($this->dt_FileUploaded) != "") 
			$query	.= " AND dt_FileUploaded LIKE '%".$this->dt_FileUploaded."%'";

			if (trim($this->bi_file_ids) != "") 
			$query	.= " AND bi_file_id IN($this->bi_file_ids)";
			
		$query	.= " ORDER BY $this->sortColumn $this->sortDirection";
		
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveBopaBoxRowArray($this->clsbpPaginate);
	}

	function retrieveBopaBoxRowArray($dbQry) {
	
		$arrBopaBox	= array();
		while($row		= $dbQry->getArray()) {
			$arrBopaBox[$row["bi_file_id"]]	= array(
												"bi_file_id"	    => $row["bi_file_id"],	
												"bi_MemberId"	    => $row["bi_MemberId"],
												"bi_FileTypeId"	    => $row["bi_FileTypeId"],
												"bi_GenreId"	    => $row["bi_GenreId"],
											    "vc_FileName"	    => $row["vc_FileName"],
												"vc_FilePath"		=> $row["vc_FilePath"],
												"dt_FileUploaded"	=> $row["dt_FileUploaded"],
												"vc_FileSize"		=> $row["vc_FileSize"],
												"vc_artists_nm_mod"	=> $row["vc_artists_nm_mod"],
												"vc_album_nm_mod"	=> $row["vc_album_nm_mod"],
												"vc_title_nm_mod"	=> $row["vc_title_nm_mod"],
												"lt_comment"	    => $row["lt_comment"],
												"vc_year"		    => $row["vc_year"],
												"f_track_length"    => $row["f_track_length"],
												"dbl_price"		    => $row["dbl_price"],
												"i_in_sell"		    => $row["i_in_sell"]

															);
		}			
		return $arrBopaBox;
	}





	function deleteBopaBox($bi_file_ids) {

		if (trim($bi_file_ids) == "") return 0;
		
		$query	= " DELETE FROM 
						tbl_bopabox 
					WHERE 
						bi_file_id IN ($bi_file_ids)";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$_SESSION["MESSAGE"]	.= "BopaBox(s) deleted successfully";

		return 1;			
	}
//////////////////////// Function to create XML for PAPA Validations ////////////////////////

			
	function postBopaBox() {	

		$this->setPostVars();
		$this->setGetVars();	

		if ($this->action == "SAVE") {		
			if ($this->saveBopaBox($this->bi_file_id)) {
				header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();					
			}
		}
		else if ($this->action == "DELETE") {				
			$this->deleteBopaBox($this->bi_file_ids);
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();		
		}
		
		return $this->retrieveBopaBox($this->bi_file_id);
	}
}
?>

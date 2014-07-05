<?php 
class bpclsPapa extends clsbpBase  { 

	var $bi_file_id;		
	var $f_amplitude1;		
	var $f_amplitude2;		
	var $f_amplitude3;		
	var $f_avg_amplitude;		
	var $f_amplitudeMean;		
	var $f_amplitudeMedian;		
	var $f_amplitudeLoc;		

	var $bi_file_ids;

	function bpclsPapa($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "bpclsPapa");			
		
		$this->bi_file_id	= "";		
		$this->f_amplitude1	= "";		
		$this->f_amplitude2	= "";		
		$this->f_amplitude3	= "";		
		$this->f_avg_amplitude	= "";		
		$this->f_amplitudeMean	= "";		
		$this->f_amplitudeMedian	= "";		
		$this->f_amplitudeLoc	= "";		

		$this->bi_file_ids				= "";
		$this->includePath			= $includePath;
		$this->sortColumn		= "vc_GenreName";
		$this->sortDirection    = "ASC";
		$this->pageSize				= constant('BPDEFAULTPAGESIZE');
		$this->rangeVal				= constant("BPRANGEVAL");
	}

	function setPostVars() {	

		parent::setPostVars();	
		if (isset($_POST['bpclsPapa_bi_file_id']))			$this->bi_file_id				= trim($_POST['bpclsPapa_bi_file_id']);
		if (isset($_POST['bpclsPapa_f_amplitude1']))			$this->f_amplitude1				= trim($_POST['bpclsPapa_f_amplitude1']);
		if (isset($_POST['bpclsPapa_f_amplitude2']))			$this->f_amplitude2				= trim($_POST['bpclsPapa_f_amplitude2']);
		if (isset($_POST['bpclsPapa_f_amplitude3']))			$this->f_amplitude3				= trim($_POST['bpclsPapa_f_amplitude3']);
		if (isset($_POST['bpclsPapa_f_avg_amplitude']))			$this->f_avg_amplitude				= trim($_POST['bpclsPapa_f_avg_amplitude']);
		if (isset($_POST['bpclsPapa_f_amplitudeMean']))			$this->f_amplitudeMean				= trim($_POST['bpclsPapa_f_amplitudeMean']);
		if (isset($_POST['bpclsPapa_f_amplitudeMedian']))			$this->f_amplitudeMedian				= trim($_POST['bpclsPapa_f_amplitudeMedian']);
		if (isset($_POST['bpclsPapa_f_amplitudeLoc']))			$this->f_amplitudeLoc				= trim($_POST['bpclsPapa_f_amplitudeLoc']);

		
		if (isset($_POST['bpclsPapa_bi_file_ids']))				$this->bi_file_ids					= trim($_POST['bpclsPapa_bi_file_ids']);	
		if (isset($_SESSION['USERID']))	 $this->bi_MemberId		= $_SESSION['USERID'];		
	}

	function setGetVars() {

		parent::setGetVars();	

		if (isset($_GET['bi_file_id']))			$this->bi_file_id								= trim($_GET['bi_file_id']);
		if (isset($_GET['f_amplitude1']))			$this->f_amplitude1								= trim($_GET['f_amplitude1']);
		if (isset($_GET['f_amplitude2']))			$this->f_amplitude2								= trim($_GET['f_amplitude2']);
		if (isset($_GET['f_amplitude3']))			$this->f_amplitude3								= trim($_GET['f_amplitude3']);
		if (isset($_GET['f_avg_amplitude']))			$this->f_avg_amplitude								= trim($_GET['f_avg_amplitude']);
		if (isset($_GET['f_amplitudeMean']))			$this->f_amplitudeMean								= trim($_GET['f_amplitudeMean']);
		if (isset($_GET['f_amplitudeMedian']))			$this->f_amplitudeMedian								= trim($_GET['f_amplitudeMedian']);
		if (isset($_GET['f_amplitudeLoc']))			$this->f_amplitudeLoc								= trim($_GET['f_amplitudeLoc']);

		 
		 	if (isset($_GET['bi_file_ids']))				$this->bi_file_ids								= trim($_GET['bi_file_ids']);			
	}
	
	function savePapa($bi_file_id) { 

		if (!$this->validatePapa()) return 0;	

		if (trim($bi_file_id) ==  "") {

			$query	= " INSERT INTO   
							tbl_papa 
							(
							f_amplitude1,
							f_amplitude2,
							f_amplitude3,
							f_avg_amplitude,
							f_amplitudeMean,
							f_amplitudeMedian,
							f_amplitudeLoc

							) 
						VALUES 
							(
							\"$this->f_amplitude1\",
							\"$this->f_amplitude2\",
							\"$this->f_amplitude3\",
							\"$this->f_avg_amplitude\",
							\"$this->f_amplitudeMean\",
							\"$this->f_amplitudeMedian\",
							\"$this->f_amplitudeLoc\"

							)";

			$dbQry	= new dbQuery($query, $this->connect->connId);
			$this->bi_file_id		= $dbQry->lastInsertId();
			$_SESSION["MESSAGE"]	= "Papa added successfully";	

		} 
		else {

			$query	= "	UPDATE 
							tbl_papa 
						SET 
							f_amplitude1 = \"$this->f_amplitude1\",
							f_amplitude2 = \"$this->f_amplitude2\",
							f_amplitude3 = \"$this->f_amplitude3\",
							f_avg_amplitude = \"$this->f_avg_amplitude\",
							f_amplitudeMean = \"$this->f_amplitudeMean\",
							f_amplitudeMedian = \"$this->f_amplitudeMedian\",
							f_amplitudeLoc = \"$this->f_amplitudeLoc\"

						WHERE 
							bi_file_id   = $bi_file_id";

			$dbQry	= new dbQuery($query, $this->connect->connId);
			$this->bi_file_id		= $bi_file_id;
			$_SESSION["MESSAGE"]	= "Papa updated successfully";	
		}
		return $this->bi_file_id;
	}

/*	function validatePapa() {	
			$_SESSION["LSMESSAGE"] 	= "";	
	 <!-- BEGIN DYNAMIC BLOCK: validatefeilds -->
		if (trim($this->f_amplitudeLoc) == "") {
			$_SESSION["LSMESSAGE"] .= "TPL_FIELD_NAME cannot be null <BR>";
		}
		<!-- END DYNAMIC BLOCK: validatefeilds -->
	if (strlen($_SESSION["LSMESSAGE"]) > 0) {
			return 0;
		} else {
			return 1;
		}						
	}*/

	function retrievePapa($bi_file_id) {

		if (trim($bi_file_id) == "") return 0;

		$query	= " SELECT 
						* 
					FROM 
						tbl_papa 
					WHERE 
						bi_file_id = $bi_file_id";	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrievePapaRow($dbQry);
		return $dbQry->numRows();
	}

	function retrievePapaRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row						= $dbQry->getArray();
		$this->bi_file_id			= $row["bi_file_id"];
		$this->f_amplitude1			= $row["f_amplitude1"];
		$this->f_amplitude2			= $row["f_amplitude2"];
		$this->f_amplitude3			= $row["f_amplitude3"];
		$this->f_avg_amplitude			= $row["f_avg_amplitude"];
		$this->f_amplitudeMean			= $row["f_amplitudeMean"];
		$this->f_amplitudeMedian			= $row["f_amplitudeMedian"];
		$this->f_amplitudeLoc			= $row["f_amplitudeLoc"];

			

		return 1;

	}

	function retrievePapaArray() { 	
		
		$query	= " SELECT	
						*  
					FROM	
						tbl_papa WHERE 1=1 ";	
						
	
		if(trim($this->bi_file_id) != "") 
			$query	.=	" AND bi_file_id	=	".$this->bi_file_id;		
		if(trim($this->f_amplitude1) != "") 
			$query	.=	" AND f_amplitude1	=	".$this->f_amplitude1;		
		if(trim($this->f_amplitude2) != "") 
			$query	.=	" AND f_amplitude2	=	".$this->f_amplitude2;		
		if(trim($this->f_amplitude3) != "") 
			$query	.=	" AND f_amplitude3	=	".$this->f_amplitude3;		
		if(trim($this->f_avg_amplitude) != "") 
			$query	.=	" AND f_avg_amplitude	=	".$this->f_avg_amplitude;		
		if(trim($this->f_amplitudeMean) != "") 
			$query	.=	" AND f_amplitudeMean	=	".$this->f_amplitudeMean;		
		if(trim($this->f_amplitudeMedian) != "") 
			$query	.=	" AND f_amplitudeMedian	=	".$this->f_amplitudeMedian;		
		if(trim($this->f_amplitudeLoc) != "") 
			$query	.=	" AND f_amplitudeLoc	=	".$this->f_amplitudeLoc;		

	/*	<!-- BEGIN DYNAMIC BLOCK: retrievearraystringfeilds -->
		if (trim($this->TPL_RETSTRINGFEILDS) != "") 
			$query	.= " AND TPL_RETSTRINGFEILDS LIKE '%".$this->TPL_RETSTRINGFEILDS."%'";
		<!-- END DYNAMIC BLOCK: retrievearraystringfeilds -->	*/
			if (trim($this->bi_file_ids) != "") 
			$query	.= " AND bi_file_id IN($this->bi_file_ids)";
		$query	.= " ORDER BY $this->sortColumn $this->sortDirection";
		
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrievePapaRowArray($this->clsbpPaginate);
	}

	function retrievePapaRowArray($dbQry) {
	
		$arrPapa	= array();
		while($row		= $dbQry->getArray()) {
			$arrPapa[$row["bi_file_id"]]	= array(
															"bi_file_id"			=> $row["bi_file_id"],
															"f_amplitude1"			=> $row["f_amplitude1"],
															"f_amplitude2"			=> $row["f_amplitude2"],
															"f_amplitude3"			=> $row["f_amplitude3"],
															"f_avg_amplitude"			=> $row["f_avg_amplitude"],
															"f_amplitudeMean"			=> $row["f_amplitudeMean"],
															"f_amplitudeMedian"			=> $row["f_amplitudeMedian"],
															"f_amplitudeLoc"			=> $row["f_amplitudeLoc"]

															);
		}			
		return $arrPapa;
	}


	function deletePapa($bi_file_ids) {

		if (trim($bi_file_ids) == "") return 0;
		
		$query	= " DELETE FROM 
						tbl_papa 
					WHERE 
						bi_file_id IN ($bi_file_ids)";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$_SESSION["MESSAGE"]	.= "Papa(s) deleted successfully";

		return 1;			
	}
	
	////////////// functions for papa validations ////////////////////////
		function retrieveGenreArray() { 	
		
		 $query	= " SELECT	
						lkup_genre.bi_GenreId,
						lkup_genre.vc_GenreName,
						lkup_genre.ti_GenreActive
								
					FROM	
						lkup_genre WHERE 1=1 AND lkup_genre.ti_GenreActive=1 ";	


			
	     $query	.= " ORDER BY $this->sortColumn $this->sortDirection";

		 $dbQry	= new dbQuery($query, $this->connect->connId);	
	     return  $this->retrieveGenreRowArray($dbQry);
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
	

	
	function retrievePapaValidateArray() {

    $query	= " SELECT * FROM  tbl_bopabox bpbox, tbl_papa papa, tbl_id3_tags id3 "
            ." WHERE  bpbox.bi_file_id=papa.bi_file_id  "
			." AND bpbox.i_tg_id=id3.i_tg_id  "
			." AND bpbox.bi_MemberId=$this->bi_MemberId";


		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrievePapaValidateRowArray($dbQry);
}


		function retrievePapaValidateRowArray($dbQry) {
	    if(!$dbQry->numRows()) return 0;
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_file_id"]]	= array(
													
												
												
												"bi_FileTypeId"	    => $row["bi_FileTypeId"],
												"bi_GenreId"	    => $row["bi_GenreId"],
											    "vc_tags"		    => $row["vc_tags"],
												"bi_MemberId"		=> $row["bi_MemberId"],
												"vc_FileName"	    => $row["vc_FileName"],
												"vc_FilePath"		=> $row["vc_FilePath"],
												"dt_FileUploaded"	=> $row["dt_FileUploaded"],
												"vc_FileSize"	    => $row["vc_FileSize"],
												"dbl_price"	        => $row["dbl_price"],
												"i_in_sell"	        => $row["i_in_sell"],
												"vc_title_nm_mod"	=> $row["vc_title_nm_mod"],
												"vc_artists_nm_mod"	=> $row["vc_artists_nm_mod"],
												"vc_album_nm_mod"	=> $row["vc_album_nm_mod"],
												"vc_genre_mod"	    => $row["vc_genre_mod"],
												"vc_year"           => $row["vc_year"],
												"f_bitrate"		    => $row["f_bitrate"],
												"f_frequency"		=> $row["f_frequency"],
												"f_track_length"    => $row["f_track_length"],
												"lt_comment"		=> $row["lt_comment"],
												"i_num_frames"	    => $row["i_num_frames"],	
												"f_amplitude1"	    => $row["f_amplitude1"],
												"f_amplitude2"	    => $row["f_amplitude2"],
												"f_amplitude3"	    => $row["f_amplitude3"],
												"f_avg_amplitude"	=> $row["f_avg_amplitude"],
												"f_amplitudeMean"	=> $row["f_amplitudeMean"],
												"f_amplitudeMedian"	=> $row["f_amplitudeMedian"],
												"f_amplitudeLoc"	=> $row["f_amplitudeLoc"]
												);
		}			
		return $arrFile;
	}

	
function getFileInfo() {	

	
	
		
		$resultset=$this->retrievePapaValidateArray();
		$arrGenre = $this->retrieveGenreArray();

//print_r($arrGenre);

		if($resultset ==0){
		
		
		 $xml=''; 		
		 $xml ="<"."?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
		 $xml .="<userFiles>";
		foreach($arrGenre as $arrGenreVal){	
			$xml .="<lkup_genre>";
			$xml .="\t\t\t".'<bi_GenreId>'.$arrGenreVal['bi_GenreId'].'</bi_GenreId>'."\r\n";
			$xml .="\t\t\t".'<vc_GenreName>'.$arrGenreVal['vc_GenreName'].'</vc_GenreName>'."\r\n";
			$xml .="\t\t\t".'<ti_GenreActive>'.$arrGenreVal['ti_GenreActive'].'</ti_GenreActive>'."\r\n";
			$xml .="</lkup_genre>";
			}	
		   $xml .="</userFiles>";	
		echo ($xml);
		}
		else{
		
		 $xml=''; 		
		 $xml ="<"."?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
		 $xml .="<userFiles>";
		 
			foreach($resultset as $resultset){		  	
	
					$xml .="<fileDetails>";
					$xml .="\t\t\t".'<fileName>'.$resultset['vc_FileName'].'</fileName>'."\r\n";
					$xml .="\t\t\t".'<fileType>mp3</fileType>'."\r\n";
					$xml .="\t\t\t".'<filePath>./temp/</filePath>'."\r\n";
					$xml .="\t\t\t".'<uploadedDatetime>'.$resultset['dt_FileUploaded'].'</uploadedDatetime>'."\r\n";
					$xml .="\t\t\t".'<songName>'.$resultset['vc_title_nm_mod'].'</songName>'."\r\n";
					$xml .="\t\t\t".'<artistName>'.$resultset['vc_artists_nm_mod'].'</artistName>'."\r\n";
					$xml .="\t\t\t".'<genre>'.$resultset['vc_genre_mod'].'</genre>'."\r\n";
					$xml .="\t\t\t".'<comments>'.$resultset['lt_comment'].'</comments>'."\r\n";
					$xml .="\t\t\t".'<year>'.$resultset['vc_year'].'</year>'."\r\n";
					$xml .="\t\t\t".'<trackLength>'.$resultset['f_track_length'].'</trackLength>'."\r\n";
					$xml .="\t\t\t".'<tags>'.$resultset['vc_tags'].'</tags>'."\r\n";
					$xml .="\t\t\t".'<fileSize>'.$resultset['vc_FileSize'].'</fileSize>'."\r\n";
					$xml .="\t\t\t".'<albumName>'.$resultset['vc_album_nm_mod'].'</albumName>'."\r\n";
					$xml .="\t\t\t".'<amplitude1>'.$resultset['f_amplitude1'].'</amplitude1>'."\r\n";
					$xml .="\t\t\t".'<amplitude2>'.$resultset['f_amplitude2'].'</amplitude2>'."\r\n";
					$xml .="\t\t\t".'<amplitude3>'.$resultset['f_amplitude3'].'</amplitude3>'."\r\n";
					$xml .="\t\t\t".'<amplocation>'.$resultset['f_amplitudeLoc'].'</amplocation>'."\r\n";
					$xml .="\t\t\t".'<mean>'.$resultset['f_amplitudeMean'].'</mean>'."\r\n";
					$xml .="\t\t\t".'<median>'.$resultset['f_amplitudeMedian'].'</median>'."\r\n";
					$xml .="\t\t\t".'<sale>'.$resultset['f_track_length'].'</sale>'."\r\n";
					$xml .="\t\t\t".'<salePrice>'.$resultset['dbl_price'].'</salePrice>'."\r\n";
					$xml .="</fileDetails>";
			
			 } 
			foreach($arrGenre as $arrGenreVal){	
			$xml .="<lkup_genre>";
			$xml .="\t\t\t".'<bi_GenreId>'.$arrGenreVal['bi_GenreId'].'</bi_GenreId>'."\r\n";
			$xml .="\t\t\t".'<vc_GenreName>'.$arrGenreVal['vc_GenreName'].'</vc_GenreName>'."\r\n";
			$xml .="\t\t\t".'<ti_GenreActive>'.$arrGenreVal['ti_GenreActive'].'</ti_GenreActive>'."\r\n";
			$xml .="</lkup_genre>";
			}	
		   $xml .="</userFiles>";		
		 
		   echo ($xml);
	/*	   $fileName ="fff.xml";
		    $Handle = fopen($fileName, 'w');
	
	 if(fwrite($Handle, $xml ) == FALSE) {
	
		return false;
	 }
	
	 fclose($Handle);	
		}*/
			 
					
	}
}	
	////////////////////////////////////////////////////////
	
			
	function postPapa() {	

		$this->setPostVars();
		$this->setGetVars();	

		if ($this->action == "SAVE") {		
			if ($this->savePapa($this->bi_file_id)) {
				header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();					
			}
		}
		else if ($this->action == "DELETE") {				
			$this->deletePapa($this->bi_file_ids);
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();		
		}
		
		return $this->retrievePapa($this->bi_file_id);
	}
}
?>
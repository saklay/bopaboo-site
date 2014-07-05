<?php 
/*******************************************************************
/ Title: Upload Class.
/ Purpose: This file is used for File upload functions.
/ Mainly used for file upload process.
/ 
/ Inputs:   An XML ($_POST['xmlData']), $memberId from Cookie
			
/ Outputs:  
/           

/ Authors: Sivaprasad C
/*******************************************************************/
class clsbpFileUpload extends clsbpBase  { 

	var $xmlData;	
	var $bi_file_id;
	var $bi_FileTypeId;
	var $bi_GenreId;
	var $bi_MemberId;
	var $vc_FileTypeName;
	var $vc_FilePath;
	var $vc_FileSize;
	var $dbl_price;
	var $c_in_sell;
	var $f_amplitude1;
	var $f_amplitude2;
	var $f_amplitude3;
	var $f_avg_amplitude;
	var $f_amplitudeMean;
	var $f_amplitudeMedian;
	var $f_amplitudeLoc;
	var $i_tg_id;
	var $vc_artists_nm;
	var $vc_album_nm;
	var $vc_genre;
	var $vc_year;
	var $f_bitrate;
	var $i_frequency;
	var $f_track_length;
	var $lt_comment;
	var $i_num_frames;
	var $vc_artists_nm_mod;
	var $vc_album_nm_mod;
	var $vc_genre_mod;
	var $t_FileUploaded;
	var $vc_tags;
	

	function clsbpFileUpload($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpFileUpload");			
		
		$this->xmlData			= "";
		$this->memberId			= "";	
		$this->fileName	        = "";
		$this->includePath		= $includePath;
		$this->pageSize			= constant('BPDEFAULTPAGESIZE');
		$this->rangeVal			= constant("BPRANGEVAL");
	}

	function setPostVars() {	

		parent::setPostVars();	
		if (isset($_POST['xmlData']))	 $this->xmlData		= trim($_POST['xmlData']);
		
				
	}

	// function to create an XML for user
	function createXML(){
	
	
	 $this->memberId	= trim($_COOKIE['COOKIE_USERID']);	
	 $this->fileName = "songList".$this->memberId.".xml"; 

	 $Handle = fopen($this->fileName, 'w');
	
	 if(fwrite($Handle, $this->xmlData ) == FALSE) {
	
		return false;
	 }
	
	 fclose($Handle);	
	 return $this->saveMp3Tags();
	
	}
	
		// function to create an XML for user
	function generateXML(){
	
	
	 $this->memberId	= trim($_COOKIE['COOKIE_USERID']);	
	 $this->fileName = "songList".$this->memberId.".xml"; 

	 $Handle = fopen($this->fileName, 'w');
	
	 if(fwrite($Handle, $this->xmlData ) == FALSE) {
	
		return false;
	 }
	
	 fclose($Handle);	
	 return $this->saveMp3Tags();
	
	}
	
function retrieveFileDeatils() {
		if (!isset($_SESSION['MEMBERID'])) return 0;
		$this->bi_MemberId	=	$_SESSION['MEMBERID'];
		$bi_MemberId		=	$_SESSION['MEMBERID'];
		$this->memberId	= trim($_COOKIE['COOKIE_USERID']);
		$query	= "SELECT * FROM tbl_bopabox t, tbl_ID3_TAGS tb, tbl_PAPA tbl  WHERE t.i_tg_id=tb.i_tg_id  AND t.bi_file_id=tbl.bi_file_id AND t.bi_MemberId=$bi_MemberId";	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveFileDetailsArray($dbQry);
}

function retrieveFileDetailsArray($dbQry) {

		if(!$dbQry->numRows()) return 0;
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_MemberId"]]	= array(													
												"bi_file_id"	    	=> $row["bi_file_id"],	
												"bi_FileTypeId"	   		 => $row["bi_FileTypeId"],
												"bi_GenreId"	    	=> $row["bi_GenreId"],
												"i_tg_id"	    		=> $row["i_tg_id"],											        
												"vc_FileName"			=> $row["vc_FileName"],
												"vc_FilePath"			=> $row["vc_FilePath"],
												"dt_FileUploaded"		=> $row["dt_FileUploaded"],
												"dbl_price"				=> $row["dbl_price"],
												"i_in_sell"	    		=> $row["i_in_sell"],
												"vc_artists_nm"	  	 	=> $row["vc_artists_nm"],
												"vc_album_nm"	  	  	=> $row["vc_album_nm"],
												"vc_genre"	    		=> $row["vc_genre"],
												"vc_year"		  	  	=> $row["vc_year"],
												"f_bitrate"    			=> $row["f_bitrate"],
												"f_track_length"		=> $row["f_track_length"],
												"lt_comment"			=> $row["lt_comment"],
												"i_num_frames"	   		 => $row["i_num_frames"],	
												"vc_artists_nm_mod"	    => $row["vc_artists_nm_mod"],
												"vc_album_nm_mod"	    => $row["vc_album_nm_mod"],
												"vc_genre_mod"	  		=> $row["vc_genre_mod"],											        
												"f_amplitude1"			=> $row["f_amplitude1"],
												"f_amplitude1"			=> $row["f_amplitude1"],
												"f_amplitude2"			=> $row["f_amplitude2"],
												"f_amplitude3"			=> $row["f_amplitude3"],
												"f_avg_amplitude"	    => $row["f_avg_amplitude"],
												"f_amplitudeMean"	    => $row["f_amplitudeMean"],
												"f_amplitudeMedian"	    => $row["f_amplitudeMedian"],
												"f_amplitudeLoc"	    => $row["f_amplitudeLoc"],
												"vc_tags"		   		=> $row["vc_tags"],
												"vc_FileTypeName"    	=> getFileTypeName($row["bi_FileTypeId"])								
												);
		}			
		return $arrFile;
}
	
	
	
	// insert file information
function saveMp3Tags() { 
		
//$fileName = "songlist81.xml";
		if (!$myXML=simplexml_load_file($this->fileName)){ // parse the xml file
	
		return false;
		
	    }
	
	    foreach($myXML as $song){

				$query	= " INSERT INTO   
								tbl_member_files 
								(
									bi_MemberId,
									bi_FileTypeId,
									vc_FileName,
									vc_FilePath,
									dt_FileUploaded,
									vc_FileSize,
									vc_ArtistName,
									vc_AlbumName,
									vc_SongName,
									lt_Comment,
									c_Year,
									vc_TrackLength,
									vc_Tags
								) 
							VALUES 
								(
									\"$this->memberId\",
									1,
									\"$song->fileName\",
									\"$song->filePath\",
									now(),
									\"$song->fileSize\",
									\"$song->artistName\",
									\"$song->albumName\",
									\"$song->songName\",
									\"$song->comments\",
									\"$song->year\",
									\"$song->trackLength\",
									\"$song->tags\"									
									
								)";
	
	
			
				$dbQry	        = new dbQuery($query, $this->connect->connId);
			
				$this->fileId	= $dbQry->lastInsertId();	
			}
			
			$_SESSION["FMMESSAGE"]	= "Songs added successfully";	
	
		
		return true;
	}	



	
	function postFileUpload() {	

		$this->setPostVars();
		
		if (!$this->createXML()) {
			
			return false;				
		}
	
				
	}
	
function getFileInfo() {	

		
		 $xml='';
 		
		 $file= fopen("songlist.xml", "w");
		 $xml ="<"."?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
		 $xml .="<userFiles>";
		  $xml .="<fileDetails>";
		
		$resultset=retrieveFileDeatils();
		foreach($resultset as $row){		  	

				$xml .="\t\t\t".'<memberId>'.$this->bi_MemberId.'</memberId>'."\r\n";
		 	    $xml .="\t\t\t".'<fileName>'.$this->vc_FileName.'</fileName>'."\r\n";
				$xml .="\t\t\t".'<fileType>'.$this->vc_FileTypeName.'</fileType>'."\r\n";
				$xml .="\t\t\t".'<filePath>'.$this->vc_FilePath.'</filePath>'."\r\n";
				$xml .="\t\t\t".'<uploadedDatetime>'.$this->dt_FileUploaded.'</uploadedDatetime>'."\r\n";
				$xml .="\t\t\t".'<songName>'$this->vc_FileName.'</songName>'."\r\n";
				$xml .="\t\t\t".'<artistName>'.$this->vc_artists_nm.'</artistName>'."\r\n";
				$xml .="\t\t\t".'<genre>'.$this->vc_genre.'</genre>'."\r\n";
				$xml .="\t\t\t".'<comments>'.$this->lt_comment.'</comments>'."\r\n";
				$xml .="\t\t\t".'<year>'.$this->vc_year.'</year>'."\r\n";
				$xml .="\t\t\t".'<trackLength>'.$this->f_track_length.'</trackLength>'."\r\n";
				$xml .="\t\t\t".'<tags>'.$this->vc_tags.'</tags>'."\r\n";
				$xml .="\t\t\t".'<fileSize>'.$this->vc_FileSize.'</fileSize>'."\r\n";
				$xml .="\t\t\t".'<albumName>'.$this->vc_album_nm.'</albumName>'."\r\n";
				$xml .="\t\t\t".'<amplitude1>'.$this->f_amplitude1.'</amplitude1>'."\r\n";
				$xml .="\t\t\t".'<amplitude2>'.$this->f_amplitude2.'</amplitude2>'."\r\n";
				$xml .="\t\t\t".'<amplitude3>'.$this->f_amplitude3.'</amplitude3>'."\r\n";
				$xml .="\t\t\t".'<location>'.$this->f_amplitudeLoc.'</location>'."\r\n";
				$xml .="\t\t\t".'<mean>'.$this->f_amplitudeMean.'</mean>'."\r\n";
				$xml .="\t\t\t".'<median>'.$this->f_amplitudeMedian.'</median>'."\r\n";
				$xml .="\t\t\t".'<sale>'.$this->f_track_length.'</sale>'."\r\n";
				$xml .="\t\t\t".'<salePrice>'.$this->dbl_price.'</salePrice>'."\r\n";
		
		 } 
		 $xml .="</fileDetails>";
		 $xml .="</userFiles>";		
		 fwrite($file, $xml);
		 fclose($file);			 
			$file = "songlist.xml";
			if(is_file($file))
			{
				$descriptor = fopen ($file, "r");
				$contents = fread ($descriptor, filesize ($file));
				fclose ($descriptor);
				echo $contents;
			}
			else
			{
				echo "null";
			}
					
	}
function getFileTypeName($id) {

		if ($id="") return 0;
		$query	= "SELECT * FROM lkup_file_type  where bi_FileTypeId=$id";	
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$this->retrieveFileTypeRow($dbQry);
		return $dbQry->numRows();
	}

function retrieveFileTypeRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row						= $dbQry->getArray();
		$this->vc_FileTypeName		= $row["vc_FileTypeName"];
		$this->ti_FileActive		= $row["ti_FileActive"];
						
		return 1;

	}
	
	
}
?>
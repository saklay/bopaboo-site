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
	

	function clsbpFileUpload($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpFileUpload");			
		
		$this->xmlData			= "";
		$this->memberId			= "";	
		$this->fileName	        = "";
		$this->includePath		= $includePath;

	}

	function setPostVars() {	

		parent::setPostVars();	
		
		if (isset($_POST['xmlData']))	 $this->xmlData		= stripslashes($_POST['xmlData']);
		if (isset($_SESSION['USERID']))	 $this->memberId		= $_SESSION['USERID'];	
				
	}

	// function to create an XML for user
	function createXML(){
	

         $this->memberId	     = trim($_COOKIE['COOKIE_USERID']);	
	 $this->fileName         = "songList".$this->memberId.".xml"; 

	 $Handle = fopen($this->fileName, 'w');
	
	 if(fwrite($Handle, $this->xmlData ) == FALSE) {
	
		return false;
	 }
	
	 fclose($Handle);	
	 return $this->saveMp3Tags();

	return;
	}
	function moveToS3Bucket($fileName){
	
			//include the S3 class
			if (!class_exists('S3'))require_once('S3.php');
			
			//AWS access info
			if (!defined('awsAccessKey')) define('awsAccessKey', '1ABSSS1VJH0D5XRFWT82');
			if (!defined('awsSecretKey')) define('awsSecretKey', 'x+S10RVL5A82g/vDSvw+tlgTHPlRFdqFNlIONdox');
			
			//instantiate the class
			$s3 = new S3(awsAccessKey, awsSecretKey);
	
			//retreive post variables
			$fileName     = "bopaBox/1111111111/music2/".$fileName;
		
			$fileTempName = "temp/".$fileName;
			$somecontent .="\n".$fileName;
			$somecontent .="\n".$fileTempName;
			//create a new bucket
			$s3->putBucket("bopabox", S3::ACL_PUBLIC_READ);
			
			//move the file
			if ($s3->putObjectFile($fileTempName, "bopabox", $fileName, S3::ACL_PUBLIC_READ)) {
				//echo "<strong>We successfully uploaded your file.</strong>";
				$somecontent .="\nWe successfully uploaded your file";
				return true;
			}else{
				//echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
				$somecontent .="\nSomething went wrong while uploading your file... sorry";
				return false;
			}
			
		 	$filename = 'test.txt';
			
			
			
			$handle = fopen($filename, 'a');
			fwrite($handle, $somecontent);
			fclose($handle);
	
	}

	
	// insert file information
	function saveMp3Tags() { 
	


		if (!$myXML=simplexml_load_file($this->fileName)){ // parse the xml file
	
		return false;
		
	    }
	
	    foreach($myXML as $song){

			// Move file to S3 Bucket
			$this->moveToS3Bucket($song->fileName);
			
			if($song->artistName==""){
			$song->artistName ="Artist Name";
			}
			if($song->albumName=="" || $song->albumName=="Album"){
			$song->albumName =" ";
			}
			
			if($song->songName==""){
			$song->songName ="Song Name";
			}
			if($song->sale=="For Sale"){
			$song->sale =1;
			$song->salePrice = trim(str_replace("$","",$song->salePrice));
			}
			else{
			$song->sale =0;
			$song->salePrice =".45";
			}
			
			//$genre=1;
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
								vc_FileSize,
								dbl_price,
								i_in_sell
								) 
							VALUES 
								(
									
									1,
									\"$song->genre\",
									0,
									\"$this->memberId\",
									\"$song->fileName\",
									\"$song->filePath\",
									now(),
									\"$song->fileSize\",
									\"$song->salePrice\",
									\"$song->sale\"
																		
									
								)";
	
	
			
				$dbQry	        = new dbQuery($query, $this->connect->connId);
			
				$this->fileId	= $dbQry->lastInsertId();	
				
				// query to insert  PAPA values to - tbl_papa
					
						$avgAmplitude = ($song->amplitude1+$song->amplitude2+$song->amplitude3)/3;
						$query	= " INSERT INTO   
								tbl_papa 
								(
									bi_file_id,
									f_amplitude1,
									f_amplitude2,
									f_amplitude3,
									f_avg_amplitude,
									f_amplitudeMean,
									f_amplitudeMedian,
									f_amplitudeLoc,
									f_set1amplitude1,
									f_set1amplitude2,
									f_set1amplitude3,
									f_set2amplitude1,
									f_set2amplitude2,
									f_set2amplitude3,
									f_set3amplitude1,
									f_set3amplitude2,
									f_set3amplitude3,
									f_set4amplitude1,
									f_set4amplitude2,
									f_set4amplitude3,
									f_set5amplitude1,
									f_set5amplitude2,
									f_set5amplitude3
								) 
							VALUES 
								(
									\"$this->fileId\",
									\"$song->amplitude1\",
									\"$song->amplitude2\",
									\"$song->amplitude3\",
									\"$avgAmplitude\",
									\"$song->mean\",
									\"$song->median\",									
									\"$song->amplocation\",
									\"$song->set1amplitude1\",
									\"$song->set1amplitude2\",
									\"$song->set1amplitude3\",
									\"$song->set2amplitude1\",
									\"$song->set2amplitude2\",
									\"$song->set2amplitude3\",
									\"$song->set3amplitude1\",
									\"$song->set3amplitude2\",
									\"$song->set3amplitude3\",
									\"$song->set4amplitude1\",
									\"$song->set4amplitude2\",
									\"$song->set4amplitude3\",
									\"$song->set5amplitude1\",
									\"$song->set5amplitude2\",
									\"$song->set5amplitude3\"
										
									
								)";
	
	
			
				$dbQry	        = new dbQuery($query, $this->connect->connId);
				
				$this->f_bitrate = $song->bitrate;
				if($this->f_bitrate==''){
				$this->f_bitrate=0;
				}
				$this->f_frequency=0;
				$this->i_num_frames=0;
				$query	= " INSERT INTO   
							tbl_id3_tags 
							(
							vc_title_nm,
							vc_artists_nm,
							vc_album_nm,
							vc_genre,
							vc_year,
							f_bitrate,
							f_frequency,
							f_track_length,
							lt_comment,
							i_num_frames,
							vc_title_nm_mod,
							vc_artists_nm_mod,
							vc_album_nm_mod,
							vc_genre_mod,
							vc_tags

							)
						VALUES 
							(
							\"$song->actualSongName\",
							\"$song->actualArtistName\",
							\"$song->actualAlbumName\",
							\"$this->actualgenre\",
							\"$song->year\",
							\"$this->f_bitrate\",
							\"$this->f_frequency\",
							\"$song->trackLength\",
							\"$song->comments\",
							\"$this->i_num_frames\",
							\"$song->songName\",
							\"$song->artistName\",
							\"$song->albumName\",
							\"$song->genre\",
							\"$song->tags\"
							)";

			$dbQry	= new dbQuery($query, $this->connect->connId);
			$this->i_tg_id		= $dbQry->lastInsertId();
			
				$query	= "	UPDATE 
							tbl_bopabox 
						SET 							
							i_tg_id = \"$this->i_tg_id\"
						
						WHERE 
							bi_file_id   = $this->fileId";

			$dbQry	= new dbQuery($query, $this->connect->connId);
				
				
			}
			
			$_SESSION["FMMESSAGE"]	= "Songs added successfully";	
			unlink($this->fileName); // delete the XML file from server
		 
		return true;
	}
		
	



	
	function postFileUpload() {	

		$this->setPostVars();
		
		if (!$this->createXML()) {
			
			return false;				
		}
		else{
		header("location:bpBopaBox.php");
		exit();	
		}
	
				
	}
}
?>
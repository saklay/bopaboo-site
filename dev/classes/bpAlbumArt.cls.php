<?php
class clsAlbumArt {
	
var $sArtPath;
var $nBopaBoxID;

//$sSize expects "L" for large or "S" for small.  Defaults to large
function getAlbumArt($bopaBoxID, $sSize="L") {
	
	$this->nBopaBoxID	= $bopaBoxID;
	
	//Form the DB Query to grab the album art on this page
	if ($sSize == "L") {
		$sSQL = sprintf("SELECT coverLarge FROM tbl_album_data,tbl_bopabox_album_data  WHERE tbl_bopabox_album_data.albumDataID = tbl_album_data.albumDataID AND tbl_bopabox_album_data.bopaboxId=".$bopaBoxID);
	}
	else {
		$sSQL = sprintf("SELECT coverSmall FROM tbl_album_data,tbl_bopabox_album_data  WHERE tbl_bopabox_album_data.albumDataID = tbl_album_data.albumDataID AND tbl_bopabox_album_data.bopaboxId=".$bopaBoxID);
	}
	
	//Connect to the AlbumArt DB and run the Query
	$link = mysql_connect(ALBUMDBSERVER, ALBUMDBUSER, ALBUMDBPASS);
	
	mysql_select_db(ALBUMDB, $link);
		
	//run the SQL
	$result = mysql_query($sSQL);
		
	$row = mysql_fetch_row($result);
	
	$sArtPath = $row[0];
	
	if ($sArtPath =='') {
		$sArtPath=DEFAULTALBUMART;
	}
	else {
		$sArtPath= ALBUMART. $sArtPath;
	}
	
	mysql_free_result($result);
	$this->sArtPath	= $sArtPath;
	
	return $sArtPath;
}

//Copies a file from the web to our local server
function copyWebFile($sFileURL) {
	//create a uniquehash of this file for our server's file name.
	$newFileName = substr(md5($sFileURL),0,15);
	
	//sFile is the file we are grabbing from the Web.
	$sFile = rawurldecode($sFileURL);
	$sUploadfile = explode('/', $sFile);
	$sFilename = array_pop($sUploadfile);
	$sExtTemp = explode('.', $sFile);
	$sExt = array_pop($sExtTemp);
	
	//$ds = ALBUMART . '/' . $sFilename;
	$ds = ALBUMART . $newFileName . '_L.' . $sExt;
	
	//echo 'new file name/location= ' . $ds;
	
	if(!file_exists($ds)) {
		//we don't have this file locally... so grab it and move it...
		//Start Remote File Snatch with CURL
		ob_start();
		$chF = curl_init($sFile);
		curl_setopt($chF, CURLOPT_HEADER, 1);
		curl_setopt($chF, CURLOPT_NOBODY, 1);
		
		$ok = curl_exec($chF);
		curl_close($chF);
		$head = ob_get_contents();
		ob_end_clean();
		
		//copy that sucker to our local server
		if (!copy($sFile, $ds)){
			$sError = "<br>Dang... We failed to copy to $sFilename!";
			//echo $sError;
		}	
		else {
			
			list($img_width, $img_height, $img_type_no, $img_src_attr) = getimagesize($ds);
			
			$nTame = ALBUMART . $newFileName . '_S.' . $sExt;
					
			$this->createSmallerIMG($nTame, $ds, $img_width, $img_height);
			
		}
	}
	
	return array($newFileName . '_L.' . $sExt, $newFileName . '_S.' . $sExt);
		
}

//creates a smaller image of the original fixed to 100 pixels on the largest dimension
function createSmallerIMG($newthumbname, $newfilename, $width,$height) {
		
		$fix = 100;
		if ($width > $height) {
			$limit = ($fix / $width);
		} 
		else {
			$limit = ($fix / $height);
		}
		
		$t_width = round($width * $limit);
		$t_height = round($height * $limit); 
		$largeimage = imagecreatefromjpeg($newfilename);
		$thumb = imagecreatetruecolor($t_width, $t_height);	
		imagecopyresampled($thumb, $largeimage, 0, 0, 0, 0, $t_width, $t_height, $width, $height);
		imagejpeg($thumb, $newthumbname);
		imagedestroy($largeimage);
		imagedestroy($thumb);
		return($newthumbname);
}

//Function to see if a certain bopaBox has associated album art
function bopaBoxMissingArt($nBopaBoxId) {
	$bInsert = false;  //pessimistic initialization
	
	//First let's find if this is going to be an insert or update query
	$sSQL = sprintf("SELECT bopaboxId FROM tbl_bopabox_album_data WHERE bopaboxId = ". $nBopaBoxId);
	
	//create the DB connection
	$link = mysql_connect(ALBUMDBSERVER, ALBUMDBUSER, ALBUMDBPASS);
	mysql_select_db(ALBUMDB, $link);
		
	//run the SQL
	$result = mysql_query($sSQL);
	$row = mysql_fetch_row($result);
	
	//If we do not have this album in our DB...
	if ($row[0] =='') {
		// tehn return true
		$bInsert = true;
	}
	
	return $bInsert;
}

//Function to insert a record linking bopaBox to Album Data/Art
function updateBopaBoxAlbumArt($nBopaBoxId, $nAlbumArtId, $bInsert) {
	if ($bInsert) {
		$sSQL = "INSERT INTO tbl_bopabox_album_data (bopaboxId, albumDataID)  VALUES(".$nBopaBoxId .",".$nAlbumArtId .")";
	}
	else {
		$sSQL = "UPDATE tbl_bopabox_album_data SET albumDataID=".$nAlbumArtId ." WHERE bopaboxId=". $nBopaBoxId;	
	}
	
	//create the DB connection
	$link = mysql_connect(ALBUMDBSERVER, ALBUMDBUSER, ALBUMDBPASS);
	mysql_select_db(ALBUMDB, $link);
		
	//run the SQL
	$result = mysql_query($sSQL);

}

//Check to see if the copyright owner is in the DB... 
//If not then add it and return the labelId
function updateCopyOwner($sCopyOwner) {
	//first we need to check to see if the label exists in the copyright owners table
	$sSQL = "SELECT copyOwnerID FROM lkup_copy_owner WHERE copyOwnerName = '" .$sCopyOwner. "'";
	
	//create the DB connection
	$link = mysql_connect(ALBUMDBSERVER, ALBUMDBUSER, ALBUMDBPASS);
	mysql_select_db(ALBUMDB, $link);
	
	//run the SQL
	$result = mysql_query($sSQL);
	$row = mysql_fetch_row($result);
	
	if ($row[0] !='') {
		//we have the label... great let's use it...
		$iLabelID = $row[0];
	}
	else {
		//no label in the DB... we need to insert this
		$sSQL = "INSERT INTO lkup_copy_owner(copyOwnerName) VALUES('".$sCopyOwner."')";
		
		//run the SQL
		$result = mysql_query($sSQL);
		//If we do not have this album in our DB...
		if (!$result) {
		//    echo '<br />We\'ve encountered an error in processing your request.<br>'.$sSQL.'<br>' . mysql_error();
		}

		$iLabelID = mysql_insert_id($link);
	}

	return $iLabelID;
}

//Update our DB with the album information
function updateAlbumDB($sArtist, $sAlbum, $sRelease, $sLabel, $sLargeArt, $sSmallArt) {

	//create the DB connection
	$link = mysql_connect(ALBUMDBSERVER, ALBUMDBUSER, ALBUMDBPASS);
	mysql_select_db(ALBUMDB, $link);
	
	$sSQL = sprintf("INSERT INTO tbl_album_data(artistName, albumName, releaseDate, copyOwnerID, coverLarge, coverSmall) VALUES('".$sArtist."','".$sAlbum."','".$sRelease."',".$sLabel.",'".$sLargeArt."','".$sSmallArt."')");
		
	//run the SQL
	$result = mysql_query($sSQL);
	
	return mysql_insert_id($link);
		
}

}
?>
<?php
/*
  File: fileGrab.php
  Version: 1.0
  Created: 06/02/2008 by Tolga Baki
  Revised:
*/


//Enter your IDs
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpSessionCheck.php");


define("Access_Key_ID", "1ABSSS1VJH0D5XRFWT82");

$bSubmit = false;
$sError = '';
$sSearch = $_REQUEST['artist'];
$sSearch2 = $_REQUEST['album'];
$sFilename = '';
$sImage = '';
$request = '';
$nWidth = '0';  	//Image Width
$nHeight = '0';  	//Image Height
$sLabel = '';  		//Label
$sReleaseDate = '';  	//Release Date
$sRealArtist = '';  	//Artist for real
$sRealAlbum = '';  	//Album Name for real
$bError = false;

//give the relative URL of the location you want to move the files too
//This is relative to the location of this script
//leave off the trailing slash
$dest = './';
//$dest = '/var/www/html/workarea';

//first we will grab the XML from Amazon, parse it and find the URL for the album art
$sImage = ItemSearch($sSearch, $sSearch2);

//You need to check to make sure you actually got a URL and not an empty XML.

if ($sImage == '') {
	$sImage = DEFAULTALBUMART;
	$bError = true;
}

//OK we've submitted dah pagina so mark it as such

$bSubmit = true;

//now grab that image and move it to our server
//her it will be agood idea to rename the image to match the DB PK for the row

//echo $sImage;

//moveFile($sImage);

//now you need to enter this URL intot he DB

function moveFile($sFileURL){
	global $sFilename;
	global $dest;
	global $sLabel;
	global $sReleaseDate;
	global $sRealArtist;
	global $sRealAlbum;
	
	//sFile is the file we are grabbing from Amazon.
	//This field will come from the XML document
	$sFile = rawurldecode($sFileURL);
	$sUploadfile = explode('/', $sFile);
	$sFilename = array_pop($sUploadfile);
	
	$ds = array($dest, '/', $sFilename);
	$ds = implode('', $ds);
	
	// Start Remote File Snatch with CURL
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
		$sError = "failed to copy to $sFilename!";
	}
	if(file_exists($ds)) {
		
		echo "<br />$sFilename file exists... here $ds<br />";
		list($img_width, $img_height, $img_type_no, $img_src_attr) = getimagesize($ds);
		
		if($img_type_no ==1){
			$ext = ".gif";
		}
		
		else if($img_type_no==2) {
			$ext = ".jpg";
		}
		
		else if($img_type_no==3){
			$ext = ".png";
		}
		$path_parts = pathinfo($ds);
		$path = $path_parts['dirname'];
		
// 		echo "<br />$ext";
		$tname = substr(md5($ds),0,10).'S';
		$ttname  = substr(md5($ds),0,10).'L';
		$nName = $path."/".$tname.$ext;
		$nTame = $path."/".$ttname.$ext;
// 		echo $tname."<br />";
		rename($ds, $nName);
		
		
		createThumb($nTame, $nName, $img_width, $img_height);
	}
	else{
		echo "file not exists...";
	}
}

function createThumb($newthumbname, $newfilename, $width,$height) {
		
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

function ItemSearch($Artist, $Album){
	 if ($Album=='') exit;
	
	 global $request;
	 global $nHeight;
	 global $nWidth;
	 global $sLabel;
	 global $sReleaseDate;
	 global $sRealArtist;
	 global $sRealAlbum;
	 
	 
	//Set the values for some of the parameters.
	$Operation = "ItemSearch";
	$ResponseGroup = "Images,ItemAttributes";
	$SearchIndex = "Music";
	
	$Keywords = rawurlencode($Artist) . '+' . rawurlencode($Album) ;
	
	//Add the tag +CD at the end
	$Keywords .= '+CD';
	
	//Define the request
	$request=
	     "http://ecs.amazonaws.com/onca/xml"
	   . "?Service=AWSECommerceService"
	   . "&AWSAccessKeyId=" . Access_Key_ID
	   . "&Operation=" . $Operation
	   . "&SearchIndex=" . $SearchIndex
	   . "&Keywords=" . $Keywords
	   . "&ResponseGroup=" . $ResponseGroup;
	

	//Catch the response in the $response object
	$response = file_get_contents($request);
	$parsed_xml = simplexml_load_string($response);
	
	if ($parsed_xml->Items->TotalResults == '0') {
		return '';
	}
	
	// USE THIS FOR PHP5
	$key = $parsed_xml->Items->Item->MediumImage->URL;
	$nHeight = $parsed_xml->Items->Item->MediumImage->Height;
	$nWidth = $parsed_xml->Items->Item->MediumImage->Width;
	//$key = $parsed_xml->Items->Item->SmallImage->URL;
	
	//Grab the rest of the data from the Atrributes node from Amazon
	$sLabel = $parsed_xml->Items->Item->ItemAttributes->Label;
	$sReleaseDate = $parsed_xml->Items->Item->ItemAttributes->ReleaseDate;
	$sRealArtist = $parsed_xml->Items->Item->ItemAttributes->Artist;
	$sRealAlbum = $parsed_xml->Items->Item->ItemAttributes->Title;
	
	
	return $key;
}

	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>bopaboo - File Grabber Test Bed</title>
</head>

<body>

<div style="font-family: Arial, Sans-Serif; font-size: 10pt;">

<?php echo $request; ?><br><br>
<b>We are going to Grab the file</b> "<i><?php echo $sFilename ?></i>" <b>from</b>: <?php echo $sImage ?><br>
<b>And move it to</b>: <?php echo $dest ?><br><br>
<b>Here is the image</b>:<br>
<?php echo '<img src="' . $sImage. '" alt="' . $sSearch . '" border=1><br>'; ?><?php echo $nWidth; ?> x <?php echo $nHeight; ?><br><br>
<b>Update with the following</b><br>
<table cellpadding=0 cellspacing=0 border=0 width=400 style="border: solid 1px #41310e; background-color: #f3eabd;">
<tr><td width=150><b>Label</b>:</td><td><?php echo $sLabel; ?></td></tr>
<tr><td><b>Release Date</b>:</td><td><?php echo $sReleaseDate; ?></td></tr>
<tr><td><b>Artist</b>:</td><td><?php echo $sRealArtist; ?></td></tr>
<tr><td><b>Album</b>:</td><td><?php echo $sRealAlbum; ?></td></tr>
</table><br><br>
<?php echo $sError; ?><br><br>
</div>

</body>
</html>

<?php

ob_end_flush(); 
?>

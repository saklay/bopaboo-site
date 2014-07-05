<?php
/*
  File: bpAlbumArt.tmpl.php
  Version: 1.0
  Created: 06/02/2008 by Tolga Baki
  Revised: 07/30/2008
*/


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
$AlbumDataID;
$dataSRC;
$bError = false;


//First... Check to see if we have this album artwork already in our DB
list($AlbumDataID,$sImage,$sRealArtist,$sRealAlbum,$sReleaseDate,$sLabel) = ScanAlbumDB($sSearch, $sSearch2);

if ($AlbumDataID != '0') {
	$dataSRC= 'db';
	$sImage = ALBUMART.$sImage;
	$sLabel = getLabelName($sLabel);
	}
else {
	$dataSRC= 'web';	
	//first we will grab the XML from Amazon, parse it and find the URL for the album art
	list($AlbumDataID,$sImage,$sRealArtist,$sRealAlbum,$sReleaseDate,$sLabel) = ItemSearch($sSearch, $sSearch2);
}

//You need to check to make sure you actually got a URL and not an empty XML.
if ($sImage == '') {
	$sImage = DEFAULTALBUMART;
	$bError = true;
}

//Did we actually get album information?
if ($sRealAlbum == '') {
	$bError = true;
}

//OK we've submitted dah pagina so mark it as such
$bSubmit = true;


?>

<div id="updateArtForm">
  <form id="frmUpdateArt" name="frmUpdateArt" method="post" action="">
	<input type="hidden" id="postaction" name="clsbpFileDetails_action" value="">
	<input type="hidden" id="clsbpFileDetails_bi_file_id" name="clsbpFileDetails_bi_file_id" value="<?php echo $clsbpFileDetails->bi_file_id; ?>">
	<input type="hidden"  name="bopaboxID" value="<?php echo $clsbpFileDetails->bi_file_id; ?>">
	<input type="hidden"  name="albumDataID" value="<?php echo $AlbumDataID; ?>">
	<input type="hidden"  name="imagePath" value="<?php echo $sImage; ?>">
	<input type="hidden"  name="artistName" value="<?php echo $sRealArtist; ?>">
	<input type="hidden"  name="albumName" value="<?php echo $sRealAlbum; ?>">
	<input type="hidden"  name="releaseDate" value="<?php echo $sReleaseDate; ?>">
	<input type="hidden"  name="labelName" value="<?php echo $sLabel; ?>">
	<input type="hidden"  name="dataSRC" value="<?php echo $dataSRC; ?>">
	<input type="hidden"  name="submitted" value="1">	
	<input type="hidden" name="clsbpFileDetails_returnURL" value="<?php echo $clsbpFileDetails->returnURL; ?>" />
	<input type="hidden" name="flagNew" value="1" />
    <div class="postForSaleBox">
        <div class="hdr"></div>
        <div class="contents">
          <div class="top">
            	<h1>Update Album Information</h1>
                <span><a href="javascript: void(0);"><img src="images/btn-close1.jpg" alt="close" width="19" height="19" border="0" class="closenow" onclick="tb_remove();" /></a></span>
	  </div>
            <div class="contentholder">
                <div class="small-hdg">
		<?php if ($bError) {
			echo 'Unable to locate album information for "' . $sSearch2 . '".';
		}
		else { echo 'Would you like to update your file with the following?';} ?>
                </div><br><br>
                <div class="lside">
                	<?php echo '<img src="' . $sImage. '" alt="' . $sSearch2 . '" border=0>'; ?>
                </div>
                <div class="rside">
		    <table width=100% border=0 cellpadding=10 cellspacing=0>
                        <tr><td width=110 align="left"><b>Album</b>:</td><td align="left"><?php echo $sRealAlbum; ?></td></tr>
		    	<tr><td align="left"><b>Artist</b>:</td><td align="left"><?php echo $sRealArtist; ?></td></tr>
                    	<tr><td align="left"><b>Release Date</b>:</td><td align="left"><?php  if (!$bError) echo date("m/d/Y", strtotime($sReleaseDate)); ?></td></tr>
                    	<tr><td align="left"><b>Label</b>:</td><td align="left"><?php echo $sLabel; ?></td></tr>
		    </table>
                </div>
          </div><!-- Contents Holder -->
            <div class="postforsalebtn">
            	<input type="image" src="images/btn-ok.jpg" border="0" /> <img src="images/btn-cancel.png" alt="cancel" border="0" onclick="tb_remove();" /></div>
            
         </div>
         <div class="ftr"></div>
  </div><!-- Post for sale box -->

  </form>
</div>


<?php

function ItemSearch($Artist, $Album){ 
	global $nHeight;
	global $nWidth;
	
	if ($Album=='') exit;
	
	
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
	
	//Grab the rest of the data from the Atrributes node from Amazon
	$sLabel = $parsed_xml->Items->Item->ItemAttributes->Label;
	$sReleaseDate = $parsed_xml->Items->Item->ItemAttributes->ReleaseDate;
	$sRealArtist = $parsed_xml->Items->Item->ItemAttributes->Artist;
	$sRealAlbum = $parsed_xml->Items->Item->ItemAttributes->Title;
	
	return array(0, $key, $sRealArtist, $sRealAlbum, $sReleaseDate, $sLabel);
}

function ScanAlbumDB($Artist, $Album) { 
	$iAlbumID = '0';
	$imageURL = '';
	$sRealArtist = '';
	$sRealAlbum = '';
	$sReleaseDate = '';
	$sLabel = '';
		
	if ($Album=='') exit;
	
	//Form the DB Query
	$sSQL = sprintf("SELECT albumDataID, artistName, albumName, releaseDate, copyOwnerID, coverLarge FROM tbl_album_data WHERE artistName='".$Artist."' AND albumName='".$Album."'");
	
	//Connect to the AlbumArt DB and run the Query
	$link = mysql_connect(ALBUMDBSERVER, ALBUMDBUSER, ALBUMDBPASS);
	
	mysql_select_db(ALBUMDB, $link);
		
	//run the SQL
	$result = mysql_query($sSQL);
	
		
	$row = mysql_fetch_row($result);
	
	$iAlbumID = $row[0];
	$sRealArtist = $row[1];
	$sRealAlbum = $row[2];
	$sReleaseDate = $row[3];
	$sLabel = $row[4];
	$imageURL = $row[5];
	
	if ($iAlbumID =='' || $iAlbumID == NULL) $iAlbumID='0';
	
	mysql_free_result($result);
		
	return array($iAlbumID, $imageURL, $sRealArtist, $sRealAlbum, $sReleaseDate, $sLabel);
}

function getLabelName($nLabelID) {
	$sSQL = sprintf("SELECT copyOwnerName FROM lkup_copy_owner WHERE copyOwnerID=".$nLabelID);
	
	//Connect to the AlbumArt DB and run the Query
	$link = mysql_connect(ALBUMDBSERVER, ALBUMDBUSER, ALBUMDBPASS);
	
	mysql_select_db(ALBUMDB, $link);
		
	//run the SQL
	$result = mysql_query($sSQL);
	
	//If we do not have this album in our DB...
	if (!$result) {
	    //$sError  = '<br />We\'ve encountered an error in processing your request.<br>' . mysql_error();
	    //$iAlbumID = '0';
	}
	
	$row = mysql_fetch_row($result);
	
	$sLabel = $row[0];
		
	mysql_free_result($result);

	return $sLabel;
}
?>

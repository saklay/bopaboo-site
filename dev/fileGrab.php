<?php
/*
  File: fileGrab.php
  Version: 1.0
  Created: 06/02/2008 by Tolga Baki
  Revised:
*/

ob_start();

//Enter your IDs
define("Access_Key_ID", "1ABSSS1VJH0D5XRFWT82");

$bSubmit = false;
$sError = '';
$sSearch = 'The Killers Hot Fuss';  //sample default
$sFilename = '';
$sImage = '';
//give the relative URL of the location you want to move the files too
//This is relative to the location of this script
$dest = '/dev/albumArt';

if (isset($_POST['txtSearch']) && ($_POST['txtSearch'] != '')) {
	//OK we've submitted dah pagina.
	$bSubmit = true;
	$sSearch = $_POST['txtSearch'];
	
	//first grab the XML from Amazon, parse it and find the URL for the album art
	$sImage = ItemSearch($sSearch);
	
	//now grab that image and move it to our server
	moveFile($sImage);
}

function moveFile($sFileURL){
	global $sFilename;
	
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
	if (!copy($sFile, $ds))  $sError = "failed to copy to $sFilename!";

}

function ItemSearch($Keywords){
	 if ($Keywords=='') exit;
	//Set the values for some of the parameters.
	$Operation = "ItemSearch";
	$ResponseGroup = "Images";
	$SearchIndex = "Music";
	
	$Keywords = urlencode($Keywords . '+CD');
	
	//Define the request
	$request=
	     "http://ecs.amazonaws.com/onca/xml"
	   . "?Service=AWSECommerceService"
	   . "&AWSAccessKeyId=" . Access_Key_ID
	   . "&Operation=" . $Operation
	   . "&SearchIndex=" . $SearchIndex
	   . "&Keywords=" . $Keywords
	   . "&ResponseGroup=" . $ResponseGroup;
	
	   $original_magic_quotes_runtime_value = get_magic_quotes_runtime();
	   set_magic_quotes_runtime(0);

	//Catch the response in the $response object
	$response = file_get_contents($request);
	$parsed_xml = simplexml_load_string($response);
	
	// USE THIS FOR PHP5
	$key = $parsed_xml->Items->Item->MediumImage->URL;
	//$key = $parsed_xml->Items->Item->SmallImage->URL;
	
	
	// THIS WORKS on PHP4
	/* ----------------------------------------
	$parsed_xml = domxml_open_mem($response, DOMXML_LOAD_DONT_KEEP_BLANKS);
	
	$root = $parsed_xml->document_element();
	
	$result_nodes = $root->get_elements_by_tagname('MediumImage');
	
	foreach ($result_nodes as $node) {
		//this works   ccccc
		$newResults = $node->get_elements_by_tagname('URL');
		foreach ($newResults as $myURL) {
			$key = $myURL->get_content();
		}
		//echo '<br>' . $node->node_name(). '::' . $key;
		break;
	}
	
	$parsed_xml->free();
	*/
	set_magic_quotes_runtime($original_magic_quotes_runtime_value);
	
	return $key;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>bopaboo - File Grabber Test Bed</title>
</head>

<body>
<form name="frmGrab" method="post" action="fileGrab.php">
	Enter Search String: <input type="text" name="txtSearch" size=50 value="<?php echo $sSearch ?>"><br>
	<input type="submit" name="smtGo" value="Grab It!"><br>
	
	<?php if($bSubmit) {?>

	We are going to Grab the file "<i><?php echo $sFilename ?></i>" from: <?php echo $sImage ?><br>
	And move it to: <?php echo $dest ?><br>
	Here is the file:<br>
	<?php echo '<img src="' . ItemSearch($sSearch) . '" alt="' . $sSearch . '"><br>'; ?><br>
	Here are the errors (if any): <?php echo $sError; ?><br><br>
	--- End of Code ---
	
	<?php } ?>
	
</form>
<?php
 ob_end_flush();
?>
</body>
</html>

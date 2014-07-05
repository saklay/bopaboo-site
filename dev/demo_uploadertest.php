<?php
	//include the S3 class
	if (!class_exists('S3'))require_once('./includes/S3.php');
	
	//AWS access info
	if (!defined('awsAccessKey')) define('awsAccessKey', '1ABSSS1VJH0D5XRFWT82');
	if (!defined('awsSecretKey')) define('awsSecretKey', 'x+S10RVL5A82g/vDSvw+tlgTHPlRFdqFNlIONdox');
	
	//instantiate the class
	$s3 = new S3(awsAccessKey, awsSecretKey);

	$filename = $_POST['filename'];
	require_once('getid3/getid3.php');
	$getID3 = new getID3;
	$filename = "FALCON.mp3";
	$path = "http://bopabox.s3.amazonaws.com/";
	$contents = $s3->getBucket("bopabox");
	
	foreach ($contents as $file){
	
		print $path.$file['name'];
		print "<br>";
		$fileinfo = $getID3->analyze($path.$file['name']);
		print_r($fileinfo);
		getid3_lib::CopyTagsToComments($fileinfo);
	
		$data["currenttitle"] = $fileinfo['tags']['id3v2']['title'][0];
		$data["currentartist"] = $fileinfo['comments_html']['artist'][0];
		$data["currentalbum"] = $fileinfo['comments_html']['album'][0];
		$data["currentyear"] = $fileinfo['comments_html']['year'][0];
		$data["currentcomment"] = $fileinfo['comments_html']['comment'][0];
		$data["currentgenre"] = $fileinfo['comments_html']['genre'][0];
		$data["currentduration"] = $fileinfo['playtime_string'];
		$data["currentbitrate"] = $fileinfo['audio']['bitrate'];
		$data["currentformat"] = $fileinfo['fileformat'];
	
		$output = '';
			while(list($key, $value) = each($data))
			{
					if($output == '')
						$output = $key."=".urlencode($value);
					else
						$output = $output."&".$key."=".urlencode($value);
			}
			print($output);
				print "<br>";
	}

?>

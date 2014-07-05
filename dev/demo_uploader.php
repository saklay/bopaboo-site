<?php

	$filename = $_POST['filename'];
	require_once('./getid3/getid3.php');
	$getID3 = new getID3;
	$fileinfo = $getID3->analyze('temp/'.$filename);
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

?>

<?php
	function moveToS3Bucket($file){
	
			//include the S3 class
			if (!class_exists('S3'))require_once('./includes/S3.php');
			
			//AWS access info
			if (!defined('awsAccessKey')) define('awsAccessKey', '1ABSSS1VJH0D5XRFWT82');
			if (!defined('awsSecretKey')) define('awsSecretKey', 'x+S10RVL5A82g/vDSvw+tlgTHPlRFdqFNlIONdox');
			
			//instantiate the class
			$s3 = new S3(awsAccessKey, awsSecretKey);
	
			//retreive post variables
			$fileName      = $file;
	
		print	$fileTempName = "./temp/".$file;
				chmod($fileTempName, 0777);
			//create a new bucket
			$s3->putBucket("bopabox", S3::ACL_PUBLIC_READ);
			
			//move the file
			if ($s3->putObjectFile($fileTempName, "bopabox", $fileName, S3::ACL_PUBLIC_READ)) {
				echo "<strong>We successfully uploaded your file.</strong>";
			
				return true;
			}else{
				echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
		
				return false;
			}
			
		
	
	}

moveToS3Bucket('frogblujnspoisn333339999999.mp3');
?>
<?php
//	include_once('./includes/S3.php');

	//include the S3 class
			if (!class_exists('S3'))require_once('./includes/S3.php');
			
			//AWS access info
			if (!defined('awsAccessKey')) define('awsAccessKey', '1ABSSS1VJH0D5XRFWT82');
			if (!defined('awsSecretKey')) define('awsSecretKey', 'x+S10RVL5A82g/vDSvw+tlgTHPlRFdqFNlIONdox');
			
			//instantiate the class
			$s3 = new S3(awsAccessKey, awsSecretKey);
	
	if ($_FILES['Filedata']['name']) 
	{
		//move_uploaded_file($_FILES['Filedata']['tmp_name'], 'temp/' . $_POST['Filename']);
		//chmod('temp/' . $_POST['Filename'], 0755);
		
		/*$s3 = new S3('1ABSSS1VJH0D5XRFWT82', 'fX8jp8S7p+Er3t+bkHQZX1mrZjfGwdppQE+fVXdO');
		
		$source_location = "/var/www/htdocs/bopaboo/temp/".$_POST['Filename'];
		$target_location = "bopmedia";
			
		define('BUCKET',$target_location);
		define('DIR',$source_location);	

		if ($s3->putObjectFile(DIR, BUCKET, basename(DIR), S3::ACL_PRIVATE)) 
		{
			return true;
				
		} else 
		{
			return false;
		}*/
		
		
		//retreive post variables
		$fileName     = $_FILES['Filedata']['name'];
		$fileTempName = $_FILES['Filedata']['tmp_name'];
		
		//create a new bucket
		$s3->putBucket("bopabox", S3::ACL_PUBLIC_READ);
		
		//move the file
		if ($s3->putObjectFile($fileTempName, "bopabox", $fileName, S3::ACL_PUBLIC_READ)) {
			echo "<strong>We successfully uploaded your file.</strong>";
		}else{
			echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
		}
		
		 
	}
?> 

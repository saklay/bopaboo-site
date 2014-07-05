<?php
include('S3.php');

//make sure we are getting right number of
//arguments from command line
if (count($_SERVER['argv']) < 3){
	die("You must provide a target directory and bucket name!\nusage: backups.php <target_dir> <bucket_name>\n");
}

//take second argument and use it as our targetdir variable
$targetdir = $_SERVER['argv'][1];

//take third argument and use it as our bucketname variable
$bucket = $_SERVER['argv'][2];

//assign to constants
define('BUCKET',$bucket);
define('DIR',$targetdir);

if(!is_file(DIR)) {
	die("Please Select a file to upload\n");
}


//switch directories to target directory
if (is_dir(DIR))
	chdir(DIR);


//instantiate S3 class
$s3 = new S3('1ABSSS1VJH0D5XRFWT82', '4maAFp7JtNRQ+0qn+IU9APjOnbYfzct+VhT9IemG');

//try to create bucket
$okay = $s3->putBucket(BUCKET, S3::ACL_PRIVATE);


if ($okay){
  echo "Created bucket ".BUCKET."\n";
}else{
  die("Can't create bucket ". BUCKET."\n");
}




//iterate through files in the directory

if($okay) 
{
	
	if ($s3->putObjectFile(DIR, BUCKET, basename(DIR), S3::ACL_PRIVATE)) 
	{
		 echo "File copied: ".basename(DIR)."\n";
			
	} else 
	{
		 echo "*** Failed to copy: ". basename(DIR). "\n";
	}
} else 
{
	echo "Error Occured!!!";
}



?>


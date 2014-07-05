<?php
session_start();


if (file_exists("index.html")) {	// This is set for redirecting to the login page if the index.html file is there in the root.
									// index.html is the maintanence notification file
	header("location: index.html");
	exit;
}

//error_reporting(0);

include_once($includePath."bpConstants.php");
include_once($includePath."bpFunctions.php");
include_once($includePath."classes/bpConnect.cls.php");
include_once($includePath."classes/bpBase.cls.php");

$debugString = "";
$className	 = "";

// To create js functions into a single function for ajax loading in onload event.
$functionList = "";	
$connect		= new dbConnect();
if(isset($_SESSION['ARLOGINTIME'])) {
	checkTime();
}

// (Start) Getting the current date and time values
$clsbpBase	= new clsbpBase($connect, $includePath, 'clsbpBase');
error_reporting(0);
// Its again called from lcbase b'se we are using it in alomost all classes.
//functions taken out from the constructor of bpBase.cls.php, since its executed in every object creation.
//$clsbpBase->userIP	= $clsbpBase->getIp();	
$date		= split(' ', $clsbpBase->today);
//$today		= split(':', $date[1]);
$arrDay		= split('-', $date[0]); 
			   
//$hr			= $today[0] ;
//$min		= $today[1] ;
//$sec		= $today[2] ;

//$day		= $arrDay[2];
//$month		= $arrDay[1];
$year		= $arrDay[0];

//$indianTime = date("H:i", mktime($hr, $min, $sec, $month, $day, $year));	
// (End) Getting the current date and time values

$arrPageRange		= 	array(	
								5	=>	5,
								10  => 10,
								25	=> 25,
					  			50	=> 50,
								100	=> 100,
								200	=> 200,
								500	=> 500								
							 );

for($i =date("Y")-14; $i>= 1940; $i--) {
	$yearArray[$i] = str_pad($i, 2 , "0", STR_PAD_LEFT);
}
for($i =2008; $i<= 2024; $i++) {
	$yearNewArray[$i] = str_pad($i, 2 , "0", STR_PAD_LEFT);
}

$MonthArray = array( "01" => "January",
						"02" => "February",
						"03" => "March",
						"04" => "April",
						"05" => "May",
						"06" => "June",
						"07" => "July",
						"08" => "August",
						"09" => "September",
						"10" => "October",
						"11" => "November",
						"12" => "December"
				  );	
$MonthNewArray = array( "1" => "01",
						"2" => "02",
						"3" => "03",
						"4" => "04",
						"5" => "05",
						"6" => "06",
						"7" => "07",
						"8" => "08",
						"9" => "09",
						"10" => "10",
						"11" => "11",
						"12" => "12"
				  );	

for($i=1; $i<=31; $i++) {
	$dayArray[$i] = str_pad($i, 2 , "0", STR_PAD_LEFT);
}

for($i=0; $i<=23; $i++) {
	$hourArray[] = str_pad($i, 2 , "0", STR_PAD_LEFT);
}

for($i=0; $i<=59; $i++) {
	$minuteArray[] = str_pad($i, 2 , "0", STR_PAD_LEFT);
}

for($i=1; $i<=5; $i++) {
	$arrSequence[] = str_pad($i, 2 , "0", STR_PAD_LEFT);
}

//S/W request form S/W type						  
$arrPageType			= 	array(	
									"A"=>"Advertisement",
									"R"=>"Articles",
									"F"=>"Franchise",
									"N"=>"News",
									"P"=>"Press Release",								
									"S"=>"Success Stories"
							  );
							  
//S/W request form S/W type						  
$arrBannerType			= 	array(	
									"H"=>"Header Banner",
									"M"=>"Middle Banner"
							  );
//S/W request form S/W type						  
$arrParentPageType		= 	array(	
									"M"=>"Main Page",
									"S"=>"Sub Page"
							  );							  							 

function checkTime() {
	$t = time();
	$diff  = $t - $_SESSION['ARLOGINTIME'];
	
	if($diff < 1200) {
		$_SESSION['ARLOGINTIME'] = time();
	}
	else {
	
	/*clear cart*/
		$cartSize = count($_SESSION['bopaBasket']['song']);
	
		if($cartSize > 0 ){
		
					if(isset($_SESSION['bopaBasket']['song'])){
						for($i=1;$i<=$cartSize;$i++){	
							$FileID = $_SESSION['bopaBasket']['song'][$i-1];
							$query	= "	DELETE FROM tbl_cart WHERE bi_MemberId=".$_SESSION['USERID']." AND bi_FileID=$FileID";
							mysql_query($query)or die();
							$queryNew	= "UPDATE tbl_bopabox SET ti_lock=0 WHERE bi_file_id=$FileID";
							mysql_query($queryNew)or die(mysql_error());
						}
						
					}
	
			}
			session_unset();
			session_destroy();
			//header("location:index.php");
		
	}

}
function returnUserId(){

 $userId = $_SESSION['USERID'];
 
 return $userId;
}
?>
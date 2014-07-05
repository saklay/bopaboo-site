<?php
function getTitle() {
	
	global $pageTitle;
	
	if(trim($pageTitle == ""))
		$pageTitle	= getProductName()." - Bopaboo";

	return $pageTitle;
}

function getMetaDescription() {

	global $metaDescription;

	if(trim($metaDescription == ""))
		$metaDescription = getProductName()." - Bopaboo";

	return $metaDescription;
}

function getMetaKeywords() {

	global $metaKeywords;

	if(trim($metaKeywords == ""))
		$metaKeywords = getProductName()." - Bopaboo";

	return $metaKeywords;
}

function getProductName() {
	
	global $clslcSetting;

	if (is_object($clslcSetting))
		return $clslcSetting->productName;
	else
		return "<undefined>";
}

function setMessage($message, $messageType="ERROR", $forceOverwrite=0) {
	
	if (trim($message) == "") return;

	if (trim($message) != "" && !$forceOverwrite) return;

	$_SESSION["BPMESSAGETYPE"]	= $messageType;
	$_SESSION["BPMESSAGE"]		= $message;
}

function displayMessage() {

	if (!isset($_SESSION["BPMESSAGE"]) || $_SESSION["BPMESSAGE"] == "") return;

	$msg	= "";

	$msg	= "<p><font color='#F36734'>".$_SESSION["BPMESSAGE"]."</font></p>";
	//$msg	.= "<table cellpadding='0' cellspacing='0' width='100%' border='0'>";
	//$msg	.= "<tr><td width='100%' height='20'  style='font-size:11px;padding-left:20px'>";
	//$msg	.= "<font color='#F36734'>".$_SESSION["BPMESSAGE"]."</font>";
	//$msg	.= "</td></tr></table>";

	$_SESSION["BPMESSAGE"] = "";

	return $msg;
}
function displayWelcome() {

	if (!isset($_SESSION["BPMESSAGE"]) || $_SESSION["BPMESSAGE"] == "") return;

	$msg	= "";

	$msg	= "<p><font color='#F87217'>".$_SESSION["BPMESSAGE"]."</font></p>";
	//$msg	.= "<table cellpadding='0' cellspacing='0' width='100%' border='0'>";
	//$msg	.= "<tr><td width='100%' height='20'  style='font-size:11px;padding-left:10px'>";
	//$msg	.= "<font color='#F36734'>".$_SESSION["BPMESSAGE"]."</font>";
	//$msg	.= "</td></tr></table>";

	$_SESSION["BPMESSAGE"] = "";

	return $msg;
}
function displayError() {

	if (!isset($_SESSION["BPMESSAGE"]) || $_SESSION["BPMESSAGE"] == "") return;

	$msg	= "";

	$msg	= "<p><font color='#000000'>".$_SESSION["BPMESSAGE"]."</font></p>";
	//$msg	.= "<table cellpadding='0' cellspacing='0' width='100%' border='0'>";
	//$msg	.= "<tr><td width='100%' height='20'  style='font-size:11px;padding-left:20px'>";
	//$msg	.= "<font color='#F36734'>".$_SESSION["BPMESSAGE"]."</font>";
	//$msg	.= "</td></tr></table>";

	$_SESSION["BPMESSAGE"] = "";

	return $msg;
}
function dateadd($per,$n,$d) {
	//echo $per."<br>".$n."<br>".$d;
   switch($per) {
      case "yyyy": $n*=12;
      case "m":
         $d=mktime(date("H",$d),date("i",$d)
            ,date("s",$d),date("n",$d)+$n
            ,date("j",$d),date("Y",$d));
         $n=0; break;
      case "ww": $n*=7;
      case "d": $n*=24;
      case "h": $n*=60;
      case "n": $n*=60;
   }
   return $d+$n;
}

function HTMLOption1DArray($arr, $selectedValue)  {
	$str = "";
	if (is_array($arr)) {
		for ($i=0; $i<count($arr); $i++) {
			$str .= "<option value='". $arr[$i] ."'";
			if (!empty($selectedValue)) {
				if ($arr[$i] == $selectedValue) {
					$str .= " SELECTED ";
				}
			}	
			$str .= ">". $arr[$i] ."</option>";
		}
	}
	return $str;
}

function HTMLOptionValueArray($arr, $selectedValue)  {
	$str = "";
		if (is_array($arr)) {
		for ($i=0; $i<count($arr); $i++) {
			$str .= "<option value='". $arr[0][$i] ."'";
			if (!empty($selectedValue)) {
				if ($arr[0][$i] == $selectedValue) {
					$str .= " SELECTED ";
				}
			}	
			$str .= ">". $arr[0][$i] ."</option>";
		}
	}
	return $str;
}

# selectedValue	- can hold array or delimited string
# $seperator	- used to explode the selected value (only if its not an array)
# $colIndTitle2	- used to pass 2nd key value
function HTMLOption2DArray($arr, $colIndVal, $colIndTitle, $selectedValue, $seperator=", ", $colIndTitle2="") {	

	$str = "";	
	if (!is_array($selectedValue)) 
		$selectedValue = explode($seperator, $selectedValue);
		
	if (is_array($arr)) {		
		foreach ($arr as $row) {      
		         
			$str .= "<option value='". $row[$colIndVal] ."'";
		
			if (!empty($selectedValue)) 
			
				if (in_array($row[$colIndVal], $selectedValue)) 
					$str .= " SELECTED ";

			$str .= ">". $row[$colIndTitle];
			
			if (!empty($colIndTitle2) && $row[$colIndTitle2] != "")	
				$str .= " (".$row[$colIndTitle2].")";

			$str .= "</option>";
		}
	}
	return $str;
}

//HTMLOptionKeyValArray : Return the '<option value="key">value</option>' string using the input array 
//The input Array should be 'Key-Value pair' type.
function HTMLOptionKeyValArray($arr, $selectedValue)  {	
	$str = "";	
	
	if (!is_array($selectedValue)) $selectedValue = explode(", ", $selectedValue);

	if (is_array($arr)) {		
		while(list($key, $value) = each($arr) )
		{
			$str .= "<option value='". $key ."'";
			if (!empty($selectedValue)) {
				if (in_array($key, $selectedValue)) {
					$str .= " SELECTED ";
				}
			}	
			$str .= ">". $value ."</option>";
		}
	}
	return $str;
}

function getCurrentPageURL() {
	
	$pageName	= explode("/", $_SERVER['PHP_SELF']);
	return $pageName[count($pageName)-1]."?".$_SERVER["QUERY_STRING"];
}
function getCurrentPage() {
	
	$pageName	= explode("/", $_SERVER['PHP_SELF']);

	
	if($_SERVER["QUERY_STRING"] != "")
	{
	
	return $pageName[count($pageName)-1]."?".$_SERVER["QUERY_STRING"];
	}
	
	else
	{
		return $pageName[count($pageName)-1];
	}
}
# function convert2MySqlDate()
# convert date into a mysql date format
# eg: 12-Dec-2004 ==> 2004-12-12
function convert2MySqlDate($date) {

	$arrShortMonth = array( "Jan" => "01",
							"Feb" => "02",
							"Mar" => "03",
							"Apr" => "04",
							"May" => "05",
							"Jun" => "06",
							"Jul" => "07",
							"Aug" => "08",											
							"Sep" => "09",
							"Oct" => "10",
							"Nov" => "11",
							"Dec" => "12"
							);
	list($dd,$mm,$yyyy) = split('[/-]',$date);
	$mysqlDate = $yyyy."-".$arrShortMonth[$mm]."-".$dd;
	
	return $mysqlDate;
}

#Convert the mysql date foemat YYYY-MM-DDD to DD-MMM-YYYY
function convertMysqlDate2MyDate($datestr) {

	$arrtmp = split('[/-]', $datestr);
	$retval = "";
	if(count($arrtmp) == 3){ #Check whether the string can be split into 3 parts
		list($year,$month,$day) = $arrtmp;
		$year = intval($year);
		$month = intval($month);
		$day = intval($day);
		$arrMonth = array("", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov","Dec");
		if(checkdate($month, $day, $year)) {
			$day = str_pad($day, 2, '0',STR_PAD_LEFT);
			$month = $arrMonth[$month];
			$retval = "$day-$month-$year";
		}
		return 	$retval;
	}
}

# function validateIPAddress() 
# 1. validating  the IP Address.
function validateIPAddress($ipAddress) {

	if (trim($ipAddress) == "") return;
	$ipCheck = 0;
	$arripAddress	=  explode(".",$ipAddress);
	for($i=0;$i<count($arripAddress);$i++) {
		if (!is_numeric($arripAddress[$i])) {
			$ipCheck = 1;
			break;
		}if (is_numeric($arripAddress[$i]) > 254) {
				$ipCheck = 1;
				break;
		}
	}	
	if ($ipCheck == 0) {
		if (!ereg("^[^0][0-9]{0,2}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$",$ipAddress)) {
			return 0;
		}else {
			return 1;
		}		
	}else {
		return 0;
	}
	
}

# function validateIPAddress() 
# 1. validating  the IP Address.
function validateEmailAddress($emailId) {
	
	if (trim($emailId) == "") return ;

	if (ereg('^[a-zA-Z0-9._-]+@([a-zA-Z0-9._-]+\.[a-zA-Z.]{2,5})$', $emailId)) {	
		return 1;
	} else {
		return 0;
	}
	
}

#function:dateTimeDiff - return the differnce betwwen two dates
function dateTimeDiff($datefrom, $dateto,$interval='', $using_timestamps = false) {
  /*
    $interval can be:
    yyyy - Number of full years
    q - Number of full quarters
    m - Number of full months
    y - Difference between day numbers
      (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d - Number of full days
    w - Number of full weekdays
    ww - Number of full weeks
    h - Number of full hours
    n - Number of full minutes
    s - Number of full seconds (default)
  */
  
  if (!$using_timestamps) {
    $datefrom = strtotime($datefrom." GMT", 0);
    $dateto = strtotime($dateto." GMT", 0);
  }
 // print $dateto; print "<br>";
 //print $datefrom;
	$difference = $dateto - $datefrom; // Difference in seconds
  
  switch($interval) {
   
    case 'yyyy': // Number of full years

      $years_difference = floor($difference / 31536000);
      if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
        $years_difference--;
      }
      if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
        $years_difference++;
      }
      $datediff = $years_difference;
      break;

    case "q": // Number of full quarters

      $quarters_difference = floor($difference / 8035200);
      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
        $months_difference++;
      }
      $quarters_difference--;
      $datediff = $quarters_difference;
      break;

    case "m": // Number of full months

      $months_difference = floor($difference / 2678400);
      while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
        $months_difference++;
      }
      $months_difference--;
      $datediff = $months_difference;
      break;

    case 'y': // Difference between day numbers

      $datediff = date("z", $dateto) - date("z", $datefrom);
      break;

    case "d": // Number of full days

      $datediff = floor($difference / 86400);
      break;

    case "w": // Number of full weekdays

      $days_difference = floor($difference / 86400);
      $weeks_difference = floor($days_difference / 7); // Complete weeks
      $first_day = date("w", $datefrom);
      $days_remainder = floor($days_difference % 7);
      $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
      if ($odd_days > 7) { // Sunday
        $days_remainder--;
      }
      if ($odd_days > 6) { // Saturday
        $days_remainder--;
      }
      $datediff = ($weeks_difference * 5) + $days_remainder;
      break;

    case "ww": // Number of full weeks

      $datediff = floor($difference / 604800);
      break;

    case "h": // Number of full hours

      $datediff = floor($difference / 3600);
      break;

    case "n": // Number of full minutes

      $datediff = floor($difference / 60);
      break;

    default: // Number of full seconds (default)

      $datediff = $difference;
      break;
  }    
//print $datediff;
  return $datediff;

}

function numOfWeekdaysInAPeriod($startDate,$endDate,$weekDays='0' ) 
{ 
	$totalDays = dateTimeDiff($startDate, $endDate,'d') + 1;
	$numDays = 0;
	for($i=0; $i<$totalDays; $i++) {
		$timestamp = dateadd("d", $i,strtotime($startDate));
		if(date("w", $timestamp) == $weekDays ){
			$numDays++;
		}
	}
	return $numDays;
}

#function:hourToHM - convert hour to hour:minute
function hourToHM($hour) {
	$sign = "";
	if($hour < 0) {
		$sign = "-";
	}
#	$hour = intval(abs($hour));
#	$fract = $hour % 60;
#	$hh = str_pad($hour, 2, '0',STR_PAD_LEFT);
#	$mm = str_pad(floor($fract), 2, '0',STR_PAD_LEFT);
	$hour = abs($hour);

	$hh = str_pad(intval($hour), 2, '0',STR_PAD_LEFT);;
	$fraction = $hour - intval($hour);
	$mm = str_pad(floor($fraction * 60), 2, '0',STR_PAD_LEFT);

	Return "$sign$hh:$mm";	
}

#function:minuteToHM - convert minute to hour:minute
function minuteToHM($minute) {
	$sign = "";
	if($minute < 0) {
		$sign = "-";
	}
	$minute = intval(abs($minute));
	$hour = intval($minute/60);
	$fract = $minute % 60;
	$hh = str_pad($hour, 2, '0',STR_PAD_LEFT);
	$mm = str_pad(floor($fract),2, '0',STR_PAD_LEFT);
	return "$sign$hh:$mm";	
}
function mysqlDateTomyDate($datestr){
	$arrtmp = split('[/-]', $datestr);
	$retval = "";
	if(count($arrtmp) == 3){ #Check whether the string can be split into 3 parts
		list($year,$month,$day) = $arrtmp;
		$year = intval($year);
		$month = intval($month);
		$day = intval($day);
		$arrMonth = array("", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov","Dec");
		if(checkdate($month, $day, $year)) {
			$day = str_pad($day, 2, '0',STR_PAD_LEFT);
			$month = $arrMonth[$month];
			$retval = "$day-$month-$year";
		}
		return 	$retval;
	}
}

#function is_leap_year return the year leap year or not
function is_leap_year($year)
{
	if ($year%4 == 0)
	{
		if ($year%100 == 0 && $year%400 <>0)
			return false;
		else
			return true;
	}
	else
		return false;
}

#function total_days return the number days for a given month and year
function total_days($month,$year)
{
	$days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	if ($month==2 && is_leap_year($year))
	{
		return 29;
	}
		else return $days[$month-1];
}
#function numOfWeekdaysInAMonth return number of a week day given for a month, year, and the week day
function numOfWeekdaysInAMonth($month,$year,$weekDays='0' ) 
{ 
	
	$totalDays = date("t", mktime(0, 0, 0, $month, 1, $year));
	$numDays = 0;
	
	for($i=1; $i<=$totalDays; $i++) {
		if(date("w", mktime(0, 0, 0, $month, $i, $year)) == $weekDays )
			$numDays++;
	}

	return $numDays; 
}


function imageSize($img){ 
	global $width, $height;
	if($img != '') {
		$size = @GetImageSize ($img);
		$widthandheight = explode(" ",$size[3]);
		$width = substr($widthandheight[0],7,(strlen($widthandheight[0])-8));
		$width += 5;
		$height = substr($widthandheight[1],8,(strlen($widthandheight[1])-9));
		$height += 7;
	}
	return;
}

// Function to get the usertype name
function getUserModeName($userMode) {

	switch($userMode) {
		case "A":
			return "Administrator";
		case "M":	
			return "Management";
		
		case "N":	
			return "Normal";
		
		case "S":
			return "Semi Management";
		
		default:
			return "Unknown";
	}
}

//Function to format Dtabase feild
function innerCapsToReadableText($text) {
	  $text = ereg_replace("([A-Z]) ", "\\1",ucwords(strtolower(ereg_replace("[A-Z]"," \\0",$text))));
	  return ereg_replace("([A-Za-z])([0-9])", "\\1 \\2", $text);
}

//getUsername
function getUserName($userId="",$firstName="",$lastName="",$userName=""){
	
	global $connect,$includePath;
	if(trim($userId) == "" || $userId == 0) {
		if(trim($firstName)!="") return $firstName ." ". $lastName . " ("  . $userName . ")";
		else   return "";
	}else{
		$clslcSearchUser		 	 = new clslcSearchUser($connect,$includePath);
		$clslcSearchUser->userId 	 = $userId;
		$clslcSearchUser->isAdmin	 = 1;
		$arrSearchUser 				 = $clslcSearchUser->retrieveSearchUserArray();
		return $arrSearchUser[$userId]["firstName"] ." ". $arrSearchUser[$userId]["lastName"] . " ("  . $arrSearchUser[$userId]["userName"] . ")"; 
	}	
}

//get Division
function getDivisionName($divisionId){
	if(trim($divisionId) == "" || $divisionId == 0) {
		return false;
	}
	global $connect,$includePath;
	$clslcSearchDivision		 	 = new clslcSearchDivision($connect,$includePath);
	$clslcSearchDivision->divisionId = $divisionId;
	$arrSearchDivision 				 = $clslcSearchDivision->retrieveSearchDivisionArray();

	return $arrSearchDivision[0]["divisionName"];
}	
function getBranchName($branchName,$branchLocation) {
	if($branchName == "" || $branchLocation == "") {
		return false;
	}
	return $branchName."/".$branchLocation;
}
#function to encrypt password
function passEncrypt($str,$lngth=20)
{
	$str=substr($str,0,$lngth);		
	$str = str_pad($str,$lngth," ");
	
	$retstr="";
	for($i=0;$i<$lngth;$i++)
	{
		$sch=substr($str,$i,1);			
		$iasc=ord($sch) + 2*$i + 30;			
		if($iasc>255) $iasc=$iasc-255;
		$sch=chr($iasc);			
		$retstr=$retstr.$sch;
		
	}
	return addslashes($retstr);
}

#function to decrypt password		
function passDecrypt($str)
{
	$retstr="";
	$lngth=strlen($str);
	for($i=0;$i<$lngth;$i++)
	{
		$sch=substr($str,$i,1);
		$iasc=ord($sch) - 2*$i - 30;
		if($iasc<=0) $iasc=255+$iasc;
		$sch=chr($iasc);
		$retstr=$retstr.$sch;
	}
	return trim($retstr);
}


 function downloadFile($file,$dispname){

 	  $len 	 		  = filesize($file);

   	  $filename  	  = basename($file);

	  $file_extension = strtolower(substr(strrchr($filename,"."),1));
	  if($dispname<>"")	
	  	$dispname		  = $dispname.".".$file_extension;
	  else
	  	$dispname		  =	$filename ;	
	

	  switch($file_extension) {

		 case "pdf" : $ctype="application/pdf"; break;

		 case "exe" : $ctype="application/octet-stream"; break;

		 case "zip" : $ctype="application/zip"; break;

		 case "doc" : $ctype="application/msword"; break;

		 case "xls" : $ctype="application/vnd.ms-excel"; break;

		 case "ppt" : $ctype="application/vnd.ms-powerpoint"; break;

		 case "gif" : $ctype="image/gif"; break;

		 case "png" : $ctype="image/png"; break;

		 case "jpeg":

		 case "jpg" : $ctype="image/jpg"; break;

		 case "mp3" : $ctype="audio/mpeg"; break;

		 case "wav" : $ctype="audio/x-wav"; break;

		 case "mpeg":

		 case "mpg" :

		 case "mpe" : $ctype="video/mpeg"; break;

		// case "mov" : $ctype="video/quicktime"; break;

		 case "avi" : $ctype="video/x-msvideo"; break;

		 default	: $ctype="application/force-download"; 

		}

 		 @ob_end_clean(); 

		 header("Cache-Control: no-store, no-cache, must-revalidate");

		 header("Cache-Control: post-check=0, pre-check=0", false);

		 header("Pragma: no-cache");

		 header("Expires: " . gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y"))) . " GMT");

		 header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	
		 header('Content-type: $ctype');

		header('Content-Disposition: attachment; filename="'.$dispname . '"');
		readfile($file);
	}
	
function day_diff($str_start, $str_end)

{

	$str_start  = strtotime($str_start); // The start date becomes a timestamp
	
	$str_end 	= strtotime($str_end); // The end date becomes a timestamp
	
	$nseconds   = $str_end - $str_start; // Number of seconds between the two dates
	$ndays 		= (int)($nseconds / 86400); // One day has 86400 seconds
	$nseconds 	= $nseconds % 86400; // The remainder from the op
	$nhours 	= (int)($nseconds / 3600); // One hour has 3600 seconds
	//$nseconds   = $nseconds % 3600;
	//$nminutes   = round($nseconds / 60); // One minute has 60 seconds, duh!
	//$nseconds   = $nseconds % 60;
	return  "$ndays Days $nhours Hours";

}

function replaceInvalidCharacters($string){
	return ereg_replace("[^[:space:]a-zA-Z0-9*_.-]", "", $string);
}	 

# function to determine which is the browser.
# it will return browser name, browser version, browser platform
# Use $Browser_Name, $Browser_Version, $Browser_Platform respectively
function whichBrowser()
{
	global $Browser_Name,$Browser_Version,$Browser_Platform;
	
	$userAgent =  $_SERVER['HTTP_USER_AGENT'];
	$Browser_Name = strtok($userAgent, "/");
	$Browser_Version = strtok(" ");
	if(ereg("MSIE", $userAgent))
	{
		$Browser_Name = "MSIE";
		$Browser_Version = strtok("MSIE");
		$Browser_Version = strtok(" ");
		$Browser_Version = strtok(";");
	}
	if(ereg("Opera", $userAgent))	
	{
		$Browser_Name = "Opera";
		$Browser_Version = strtok("Opera");
		$Browser_Version = strtok("/");
		$Browser_Version = strtok(";");
	}
	$Browser_Platform = "unknown";
	if(ereg("Windows",$userAgent)	|| ereg("WinNT",$userAgent)|| ereg("Win95",$userAgent)) 
	{
		$Browser_Platform = "Windows";
	}
	if(ereg("Mac", $userAgent)) 
	{
		$Browser_Platform = "Macintosh";
	}
	if(ereg("X11", $userAgent)) 
	{ 
		$Browser_Platform = "Unix"; 
	} 
	return $Browser_Name;
}

// function to check session

function fnCheckSession(){

	if($_SESSION['USERID'] == ""){
		/*if(isset($_COOKIE["COOKIE_SESSION_ID"]))
		{
			session_id($_COOKIE["COOKIE_SESSION_ID"]); 
		
			setcookie("COOKIE_SESSION_ID");
			setcookie("COOKIE_SESSION_ID",    session_id(),    time()+1*1200,"/");
			//$_SESSION['USERID'] = $_COOKIE["COOKIE_USERID"];
			//$_SESSION['ARLOGINTIME'] = date("H:i:s");
			return true;
		}
		else*/
		
 
      
			return false;
	}
	else{
	
		return true;
	}


}

/*function isSessionTimedOut()
{
$end=time(); 

$start=$_SESSION['ARLOGINTIME']; 
       
        $ItemStartDate=$start."<br>";
        $ItemEndDate = $end."<br>";
        //    $Today = time();
        $TimeLeft = $ItemEndDate - $ItemStartDate;
        //$TimeLeft = $ItemEndDate - $ItemStartDate;
	
        if($TimeLeft > 0)
        {
        $ADayInSecs = 24 * 60 * 60;
        $Days = $TimeLeft / $ADayInSecs;
        $Days = intval($Days);
       
        $TimeLeft = $TimeLeft - ($Days * $ADayInSecs);
        $Hours = $TimeLeft / (60 * 60);
        $Hours = intval($Hours);
        $TimeLeft = $TimeLeft - ($Hours * 60 * 60);
       
        $Minutes = $TimeLeft / 60;
        $Minutes = intval($Minutes);
        $TimeLeft = $TimeLeft - ($Minutes * 60);
       
        $Seconds = $TimeLeft;
        $Seconds = intval($Seconds);
       
        $TimeLeft = $TimeLeft - ($Seconds / 60 * 60 );
        $MilliSeconds = $TimeLeft;
       
       $Seconds." Seconds " ;
		$time_out=5;
		
		if($Minutes<$time_out){
    	$_SESSION['ARLOGINTIME']=$end;
}else{
    include("bplogout.php");
}	
}
}*/
function calcDateDiff($date1,$date2) {


   list ($hour,$minute,$second,) = split ('[:]', $date1);
   list ($hour1,$minute1,$second1,) = split ('[:]', $date2);
   

          if($hour<$hour1)
          {
             $h=24-$hour1;
             $h1=$hour%24;
             $h2=$h+$h1;

          }
          else
          {
             $h2=$hour-$hour1; 
          }
          if($minute<$minute1)
          {
             $m=60-$minute1;
             $m1=$minute%60;
             $m2=$m+$m1;
          }
          else
          {
             $m2=$minute-$minute1;
          }
          if($second<$second1)
          {
             $s=60-$second1;
             $s1=$second%60;
             $s2=$s+$s1;
          }
          else
          {
             $s2=$second-$second1;
          }

$mm=$h2*60+$m2+$s2/60;

return $mm;
}

function convertMonthToString($monthId) {

	$month="";
	
	switch($monthId) {
		case "01":
					$month = "January";
					break;
		case "02":
					$month = "February";
					break;
		case "03":
					$month = "March";
					break;
		case "04":
					$month = "April";
					break;
		case "04":
					$month = "May";
					break;
		case "06":
					$month = "June";
					break;
		case "07":
					$month = "July";
					break;
		case "08":
					$month = "August";
					break;
		case "09":
					$month = "September";
					break;
		case "1":
					$month = "October";
					break;
		case "11":
					$month = "November";
					break;
		case "12":
					$month = "December";
					break;
	}
	
	return $month;
}

/** 
	Function which removes duplicate entries from a multi-dimentional array
	@name: multi_unique
	@param: $array => input array from which the duplicates are to be eliminated
	@return: $new1 => array with no duplicate entries
	@author: BlueLabs Technology Solutions
*/

function multi_unique($array) {
    foreach ($array as $k=>$na)
        $new[$k] = serialize($na);
    $uniq = array_unique($new);
    foreach($uniq as $k=>$ser)
        $new1[$k] = unserialize($ser);
    return $new1;
}

function displayObject($obj) {
	$arrObject = get_object_vars($obj);
	echo "<pre>";
	print_r($arrObject);
	echo "</pre>";
}

function displayArray($array) {
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function convertDateToString($date) {
	$year =  substr($date,0,4);
	$month = substr($date,5,2);
	$day=substr($date,8,2);
	
	switch($month) {
		case "01":
				$strMonth = "Jan";
				break;
		case "02":
				$strMonth = "Feb";
				break;
		case "03":
				$strMonth = "Mar";
				break;
		case "04":
				$strMonth = "Apr";
				break;
		case "05":
				$strMonth = "May";
				break;
		case "06":
				$strMonth = "Jun";
				break;
		case "07":
				$strMonth = "Jul";
				break;
		case "08":
				$strMonth = "Aug";
				break;
		case "9":
				$strMonth = "Sep";
				break;
		case "10":
				$strMonth = "Oct";
				break;
		case "11":
				$strMonth = "Nov";
				break;
		case "12":
				$strMonth = "Dec";
				break;
	}
	
	$strDate = $strMonth." ".$day.", ".$year;
	return $strDate;
}

?>
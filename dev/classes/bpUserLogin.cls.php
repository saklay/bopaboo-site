<?php 
/*******************************************************************
/ Title: User Details Class.
/ Purpose: This file is used for handelling Genre functions .
/ 
/ Inputs:   
			
/ Outputs:  
/           

/ Authors: Amruthraj
/*******************************************************************/
class clsbpUserLogin extends clsbpBase  { 
	var $bi_MemberId;
    var $i_CountriesId;	
	var $vc_FirstName;		
	var $vc_LastName;		
	var $d_DateOfBirth;
	var $optDay;
	var $optMonth;
	var $optYear;
	var $b_Gender;	
	var $dt_SignUp;		
	var $dt_LastSignIn;
	var $dt_Validated;
	var $vc_EmailId;
	var $vc_Password;
	var $confPassword;
	var $vc_DisplayName;
	var $memberStatus;
	var $accessLevel;
	var $recaptcha_challenge_field;
	var $recaptcha_response_field;
	var $privateKey;
	var $vc_OldPassword;
	var $flagNotification;
	var $flagNotifyFeatures;
	var $flagNotifyPromos;
	var $downloadLocation;
	var $uploadLocation;
	var $defaultPrice;
	var $withdrawAmount;
	var $available_withdraw;
function clsbpBase($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpUserLogin");			
		
		$this->bi_MemberId		= "";		
		$this->i_CountriesId	= "";		
		$this->vc_FirstName		= "";		
		$this->vc_LastName		= "";	
		$this->d_DateOfBirth	= "";
		$this->optDay			= "";
		$this->optMonth			= "";
		$this->optYear			= "";	
		$this->b_Gender			= 2;		
		$this->dtsignup			= "";		
		$this->dt_SignUp		= "";		
		$this->dt_Validated		= "";
		$this->vc_EmailId		= "";
		$this->vc_Password	    = "";
		$this->confPassword 	= "";		
		$this->vc_DisplayName	= "";
		$this->memberStatus		= "";	
		$this->accessLevel		= "";
		$this->checkTerms		= ""; 				
		$this->includePath		= $includePath;
		$this->sortColumn		= "bi_MemberId";
		$this->pageSize			= constant('FMDEFAULTPAGESIZE');
		$this->rangeVal			= constant("FMRANGEVAL");		
		$this->pageId 			= "";
		$this->createdDate		= "";
		$this->privateKey		= "";
		$this->recaptcha_challenge_field			="";	
		$this->recaptcha_response_field				="";
		$this->vc_OldPassword ="";
		$this->flagNotification=1;
		$this->flagNotifyFeatures =1;
		$this->flagNotifyPromos =1;
		$this->downloadLocation = "";
		$this->uploadLocation ="";
		$this->defaultPrice = 0.45;
		$this->withdrawAmount = 0.00;
		$this->classname_email		= "";

		
		
	}

function setPostVars() {

		parent::setPostVars();	
		
		if (isset($_POST['clsbpUserLogin_bi_MemberId']))	    $this->bi_MemberId		 = trim($_POST['clsbpUserLogin_bi_MemberId']);
		if (isset($_POST['clsbpUserLogin_optCountry']))	    $this->i_CountriesId		 = trim($_POST['clsbpUserLogin_optCountry']);
		if (isset($_POST['clsbpUserLogin_txtFname']))   	$this->vc_FirstName		 	 = trim($_POST['clsbpUserLogin_txtFname']);
		if (isset($_POST['clsbpUserLogin_txtLname']))		$this->vc_LastName			 = trim($_POST['clsbpUserLogin_txtLname']);
		if (isset($_POST['clsbpUserLogin_optDay']))			$this->optDay				 = trim($_POST['clsbpUserLogin_optDay']);
		if (isset($_POST['clsbpUserLogin_optMonth']))		$this->optMonth				 = trim($_POST['clsbpUserLogin_optMonth']);
		if (isset($_POST['clsbpUserLogin_optYear']))		$this->optYear				 = trim($_POST['clsbpUserLogin_optYear']);	
		if (isset($_POST['clsbpUserLogin_optGender']) && $_POST['clsbpUserLogin_optGender']!="")
		$this->b_Gender	 = trim($_POST['clsbpUserLogin_optGender']);
		else 
		$this->b_Gender	 = 2;
				
		if (isset($_POST['clsbpUserLogin_txtEmail']))		 $this->vc_EmailId     	 = trim($_POST['clsbpUserLogin_txtEmail']);
		if (isset($_POST['clsbpUserLogin_txtOldPassword']))	 $this->vc_OldPassword		 = base64_encode(base64_encode(trim($_POST['clsbpUserLogin_txtOldPassword'])));
		if (isset($_POST['clsbpUserLogin_txtPassword']))	 $this->vc_Password		 = base64_encode(base64_encode(trim($_POST['clsbpUserLogin_txtPassword'])));
		if (isset($_POST['clsbpUserLogin_txtConfirmation'])) $this->confPassword	 = base64_encode(base64_encode(trim($_POST['clsbpUserLogin_txtConfirmation'])));
		if (isset($_POST['clsbpUserLogin_txtDisname']))	     $this->vc_DisplayName	 = trim($_POST['clsbpUserLogin_txtDisname']);
		if (isset($_POST['clsbpUserLogin_checkbox']))	     $this->checkTerms		 = trim($_POST['clsbpUserLogin_checkbox']);	
			$this->memberStatus					=0;
			$this->accessLevel					=0;	
		if (isset($_POST['recaptcha_challenge_field']))		 $this->recaptcha_challenge_field	= trim($_POST['recaptcha_challenge_field']);
		if (isset($_POST['recaptcha_response_field']))		 $this->recaptcha_response_field	= trim($_POST['recaptcha_response_field']);
		if (isset($_POST['privateKey']))			         $this->privateKey					= trim($_POST['privateKey']);
		
		if(isset($_POST['clsbpUserLogin_chkNotify']))	$this->flagNotification = trim($_POST['clsbpUserLogin_chkNotify']);
		if(isset($_POST['clsbpUserLogin_chkNotifyFeatures']))	$this->flagNotifyFeatures = trim($_POST['clsbpUserLogin_chkNotifyFeatures']);
		if(isset($_POST['clsbpUserLogin_chkNotifyPromos']))	$this->flagNotifyPromos = trim($_POST['clsbpUserLogin_chkNotifyPromos']);
		
		if($this->flagNotification == "") {
			$this->flagNotification =0;
		}
		
		if($this->flagNotifyFeatures == "") {
			$this->flagNotifyFeatures =0;
		}
		
		if($this->flagNotifyPromos == "") {
			$this->flagNotifyPromos =0;
		}
		
		if(isset($_POST['clsbpUserLogin_downloadPreference']))	$this->downloadLocation = trim($_POST['clsbpUserLogin_downloadPreference']);
		if(isset($_POST['clsbpUserLogin_uploadPreference']))	$this->uploadLocation = trim($_POST['clsbpUserLogin_uploadPreference']);
		if(isset($_POST['clsbpUserLogin_txtDefaultPrice']))	$this->defaultPrice = trim($_POST['clsbpUserLogin_txtDefaultPrice']);
		if(isset($_POST['classname_amount']))	$this->withdrawAmount = trim($_POST['classname_amount']);
		if(isset($_POST['classname_email']))	$this->classname_email = trim($_POST['classname_email']);

}

	function setGetVars() {

		parent::setGetVars();
			
		if (isset($_GET['bi_MemberId']))
				$this->bi_MemberId				= trim($_GET['bi_MemberId']);  
		if (isset($_GET['i_CountriesId']))
				$this->i_CountriesId			= trim($_GET['i_CountriesId']);
		if (isset($_GET['vc_FirstName']))
				$this->vc_FirstName				= trim($_GET['vc_FirstName']);
		if (isset($_GET['vc_LastName']))
				$this->vc_LastName				= trim($_GET['vc_LastName']);
		if (isset($_GET['d_DateOfBirth']))
				$this->d_DateOfBirth			= trim($_GET['d_DateOfBirth']);
		if (isset($_GET['b_Gender']))
				$this->b_Gender					= trim($_GET['b_Gender']);		
		if (isset($_GET['dt_SignUp']))
				$this->dt_SignUp				= trim($_GET['dt_SignUp']);
		if (isset($_GET['emailId']))
				$this->vc_EmailId				= trim($_GET['emailId']);
		if (isset($_GET['Password']))
		    	$this->vc_Password				= trim($_GET['password']);
		if (isset($_GET['displayName']))
				$this->vc_DisplayName			= trim($_GET['displayName']);
		if (isset($_GET['memberStatus']))
				$this->memberStatus				= trim($_GET['memberStatus']);
		if (isset($_GET['accessLevel']))
				$this->accessLevel				= trim($_GET['accessLevel']);
		if (isset($_GET['checkTerms']))
				$this->checkTerms				= trim($_GET['checkTerms']);
		if (isset($_GET['returnUrl']))
				$this->returnUrl				= trim($_GET['returnUrl']);
		if (isset($_GET['songList']))
				$this->songList				   =  base64_decode($_GET['songList']);
			
}
	
	function saveUserDetails($id) { 

		if (!$this->validatetbl_mem_details()) return 0;	
		
		if (trim($id) ==  "") {
				$query	= " INSERT INTO   
									tbl_mem_login 
									(
										vc_DisplayName,
										vc_EmailId,
										vc_Password,
										ti_MemberStatus,
										i_AccessLevel
									) 
								VALUES 
									(
										\"$this->vc_DisplayName\",
										\"$this->vc_EmailId\",
										\"$this->vc_Password\",
										1,
										\"$this->accessLevel\"
									)";
		
				     	$dbQry					= 	new dbQuery($query, $this->connect->connId);	
						
						$txtDob					=	trim($this->optDay)."-".trim($this->optMonth)."-".trim($this->optYear);
						$this->d_DateOfBirth	= 	date("Y-m-d",strtotime($txtDob));					
						$this->bi_MemberId		= 	$dbQry->lastInsertId();
						
						$query	= " INSERT INTO   
									 tbl_mem_details 
									(
										bi_MemberId,
										vc_FirstName,
										vc_LastName,
										i_CountriesId,
										d_DateOfBirth,
										b_Gender,
										dt_SignUp,
										dt_LastSignIn,
										dt_Validated
									) 
								VALUES 
									(
										$this->bi_MemberId,
										\"$this->vc_FirstName\",
										\"$this->vc_LastName\",
										$this->i_CountriesId,
										\"$this->d_DateOfBirth\",
										$this->b_Gender,
										NOW(),
										NOW(),
										NOW()
									)";//Query changed by nilesh for local setup
		
				     $dbQry	= new dbQuery($query, $this->connect->connId);
									
					/* following section will send registration email*/				
					$clsbpEmailTemplate = new clsbpEmailTemplate($this->connect,$this->includePath);				
			
					$emailTo								= $this->vc_EmailId; // to email
					$clsbpEmailTemplate->sendSubject        = 'bopaboo Registration Confirmation'; // subject
					$encodeid								=base64_encode(base64_encode($this->bi_MemberId)); // encoded user id
					$this->songList = base64_encode($this->songList); // this is the list of items user has added to cart if any
					
					/* Email templete variables*/
					$clsbpEmailTemplate->additionalField1 	= $this->vc_FirstName;
					$clsbpEmailTemplate->additionalField2	= "<a style='text-decoration:none; color:#6EA4D1; font-weight:bold;' href='".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION&songList=$this->songList"."'>".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION&songList=$this->songList"."</a>";
					$clsbpEmailTemplate->additionalField3 	= HTTP;
					$clsbpEmailTemplate->additionalField4	= "<a href='".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION&songList=$this->songList"."'><img border='0' src='".HTTP."emailtemplates/images/btnActivate.jpg'></a>";
					

					$sendStatus								= $clsbpEmailTemplate->send('ACTIVATE',$emailTo,1); // send email to user email id
		} 
		else {
		
			$query	= "	UPDATE 
							tbl_mem_details 
						SET 
						        vc_FirstName	=    \"$this->vc_FirstName\",
								vc_LastName 	=\"$this->vc_LastName\",
							   	i_CountriesId 	=\"$this->i_CountriesId\",
								d_DateOfBirth 	=\"$this->d_DateOfBirth\",
								b_Gender 		=\"$this->b_Gender\",
								dt_SignUp		=\"$this->dt_SignUp\",								
								dt_Validated 	= Now() 
						WHERE 
								bi_MemberId   = $bi_MemberId";
			$dbQry	= new dbQuery($query, $this->connect->connId);
			$this->bi_MemberId		= $bi_MemberId;
			//$_SESSION["BPMESSAGE"]	= "ContactForUserDetails updated successfully";	
		}
		return $this->bi_MemberId;
	}


function updateUserDetails($id) { 

		//if (!$this->validatetbl_mem_details()) return 0;	
		
		

		if (trim($id) !=  "") {
		
				$query	= " UPDATE 
									tbl_mem_login 
							SET
									vc_EmailId = \"$this->vc_EmailId\"
							WHERE
									bi_MemberId = $id";
				
				$dbQry					= 	new dbQuery($query, $this->connect->connId);		
				$txtDob					=	trim($this->optDay)."-".trim($this->optMonth)."-".trim($this->optYear);
				$this->d_DateOfBirth	= 	date("Y-m-d",strtotime($txtDob));
				
				$query	= "	UPDATE   
								    		tbl_mem_details 
								    	SET
										
										vc_FirstName =\"$this->vc_FirstName\",
										vc_LastName = \"$this->vc_LastName\",
										i_CountriesId = \"$this->i_CountriesId\",
										d_DateOfBirth = \"$this->d_DateOfBirth\",
										b_Gender = \"$this->b_Gender\"
									WHERE
										bi_MemberId = $id";
				$dbQry	= new dbQuery($query, $this->connect->connId);
				return 1;
// 				$clsbpEmailTemplate = new clsbpEmailTemplate($this->connect,$this->includePath);				
// 			
// 				$emailTo								= $this->vc_EmailId;
// 
// 				$clsbpEmailTemplate->sendSubject        = 'bopaboo Registration Confirmation';
// 		
// 				$clsbpEmailTemplate->additionalField1 	= $this->vc_FirstName;
// 					
// 				$encodeid								=base64_encode(base64_encode($this->bi_MemberId));
// 				$this->songList = base64_encode($this->songList);
// 				$clsbpEmailTemplate->additionalField2	= "<a href='".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION&songList=$this->songList"."'>".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION"."</a>";
// 
// 				$sendStatus								= $clsbpEmailTemplate->send('ACTIVATE',$emailTo,1);
		} 
	}

function validatetbl_mem_details() {


		$_SESSION["BPMESSAGE"] 	= "";	
		if (trim($this->vc_FirstName) == "") {
			$_SESSION["BPMESSAGE"] .= "* First Name cannot be null <BR>";
		}
		if (trim($this->vc_LastName) == "") {
			$_SESSION["BPMESSAGE"] .= "* Last Name cannot be null <BR>";
		}
			if (trim($this->vc_EmailId) == "") {
			$_SESSION["BPMESSAGE"] .= "* Email address cannot be null <BR>";
		}
		if (trim($this->vc_DisplayName) == "") {
			$_SESSION["BPMESSAGE"] .= "* Display name cannot be null <BR>";
		}
		if ($this->optDay == 0 || $this->optMonth == 0 || $this->optYear == 0 ) {
			$_SESSION["BPMESSAGE"] .= "* Invalid Date of Birth <BR>";
		}
		
		if ($this->checkDisplayNameExist()) {
			$_SESSION["BPMESSAGE"] .= "* The Display Name you have chosen already exists. Please choose another name. <BR>";
		}
		
		if(!validateEmailAddress($this->vc_EmailId))
		{
		$_SESSION["BPMESSAGE"] .= "* Email address is not valid <BR>";
		}
		
		if ($this->checkEmailExist()) {
			$_SESSION["BPMESSAGE"] .= "* Email address is already exists <BR>";
		}
		
		$resp = recaptcha_check_answer ($this->privateKey,$_SERVER["REMOTE_ADDR"],$this->recaptcha_challenge_field,$this->recaptcha_response_field);
  		if (!$resp->is_valid) { $_SESSION["BPMESSAGE"] .= "* Incorrect Security Code. Please Re-enter the security code <BR>"; }
		
		## validating the passwords	
		if(preg_replace("/^\s*$/","",$this->vc_Password)=="" && preg_replace("/^\s*$/","",$this->confPassword)=="")
		{
		$_SESSION["BPMESSAGE"] .="* Password and confirm password are required.";
		}
			elseif(preg_replace("/^\s*$/","",$this->vc_Password)=="")
			{			
				$_SESSION["BPMESSAGE"] .="* Password is required.";
			}
				elseif(preg_replace("/^\s*$/","",$this->confPassword)=="")
				{
					$_SESSION["BPMESSAGE"] .="* Confirm password is required.";
				}
					elseif($this->vc_Password!=$this->confPassword)
					{
						$_SESSION["BPMESSAGE"] .="* Passwords are not matching.";
					}
	
	if (strlen($_SESSION["BPMESSAGE"]) > 0) {
			return 0;
		} else {
			return 1;
		}						
}

function updateUserPassword($bi_MemberId) {
	
	
	if (trim($bi_MemberId) == "") return 0;
	
	//echo (validatePasswordChange());
	if($this->validatePasswordChange()) {
	
		$query = "UPDATE 
					tbl_mem_login 
				 SET
					vc_Password = \"$this->vc_Password\"
				WHERE
					bi_MemberId = $bi_MemberId";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		return 1;
	}
	else {
// 		$_SESSION["BPMESSAGE"]	.=  "* Enter your old password correctly!!!!";
// 		print_r($_SESSION["BPMESSAGE"]);
// 		die("here");
		return 0;
	}
}

function validatePasswordChange() {
	$query = "SELECT * FROM tbl_mem_login WHERE bi_MemberId=\"$this->bi_MemberId\" AND vc_Password = \"$this->vc_OldPassword\"";
	$dbQry	= new dbQuery($query, $this->connect->connId);
	$dbQry->numRows();
	return $dbQry->numRows();
}

function retrieveUserDeatils($bi_MemberId) {

		if (trim($bi_MemberId) == "") return 0;

		$query	= " SELECT 
						* 
					FROM 
						tbl_mem_details 
					WHERE 
						bi_MemberId = $bi_MemberId";	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveMemberDeatilsRow($dbQry);
		return $dbQry->numRows();
	}

function retrieveMemberDeatilsRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row						= $dbQry->getArray();
	
		$this->bi_MemberId			= $row["bi_MemberId"];
		$this->i_CountriesId		= $row["i_CountriesId"];
		$this->vc_FirstName			= $row["vc_FirstName"];
		$this->vc_LastName			= $row["vc_LastName"];
	
		$this->d_DateOfBirth		= $row["d_DateOfBirth"];	
		$this->b_Gender				= $row["b_Gender"];		
		$this->dt_SignUp			= $row["dt_SignUp"];	
		$this->dt_LastSignIn		= $row["dt_LastSignIn"];		
		$this->dt_Validated			= $row["dt_Validated"];	
		return 1;

	}
	
function retrieveUserAllDeatils($bi_MemberId) {

		if (trim($bi_MemberId) == "") return 0;

		$query	= " SELECT *
						FROM 
							tbl_mem_login
						INNER JOIN 
							tbl_mem_details 
						ON 
							tbl_mem_login.`bi_MemberId` = tbl_mem_details.`bi_MemberId`
						WHERE 
							tbl_mem_login.`bi_MemberId` =$bi_MemberId";	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveMemberAllDeatilsRow($dbQry);
		return $dbQry->numRows();
	}
	
function retrieveMemberAllDeatilsRow($dbQry) {

		if(!$dbQry->numRows()) {
			 $this->defaultPrice = 0.45;
			 return 0;
		}

		$row						= $dbQry->getArray();
		$this->vc_EmailId 				= $row["vc_EmailId"];
		$this->vc_DisplayName			= $row["vc_DisplayName"];
		$this->bi_MemberId			= $row["bi_MemberId"];
		$this->i_CountriesId			= $row["i_CountriesId"];
		$this->vc_FirstName			= $row["vc_FirstName"];
		$this->vc_LastName			= $row["vc_LastName"];
		$this->d_DateOfBirth			= $row["d_DateOfBirth"];	
		$this->b_Gender				= $row["b_Gender"];		
		$this->dt_SignUp				= $row["dt_SignUp"];	
		$this->dt_LastSignIn			= $row["dt_LastSignIn"];		
		$this->dt_Validated			= $row["dt_Validated"];	
		$this->vc_Password			= $row["vc_Password"];
		$this->flagNotification			=$row["ti_PostedNotification"];
		$this->flagNotifyFeatures		=$row["ti_FeatureNotification"];
		$this->flagNotifyPromos		=$row["ti_PromosNotification"];
		$this->downloadLocation 		= $row["vc_DowonloadLocation"];
		$this->uploadLocation 			=$row["vc_UploadLocation"];
		$this->defaultPrice 			= $row["f_DefaultSellPrice"];
				
		return 1;
	}

function retrieveLogin($bi_MemberId) {

		if (trim($bi_MemberId) == "") return 0;

		$query	= " SELECT 
						* 
					FROM 
						tbl_mem_login 
					WHERE 
						bi_MemberId = $bi_MemberId";	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveLoginRow($dbQry);
		return $dbQry->numRows();
}



function checkEmailExist() {
	 $query	= " SELECT 
						* 
					FROM 
						tbl_mem_login 
					WHERE 
						vc_EmailId = '$this->vc_EmailId'";
							
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $dbQry->numRows();
}
function checkEmailExistPass() {
	 $query	= " SELECT 
						* 
					FROM 
						tbl_mem_login 
					WHERE 
						vc_EmailId = '$this->vc_EmailId'";
							
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveLoginRow($dbQry);
		return $dbQry->numRows();
}
function checkDisplayNameExist() {
	$query	= " SELECT 
						* 
					FROM 
						tbl_mem_login 
					WHERE 
						 vc_DisplayName = '$this->vc_DisplayName'";	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $dbQry->numRows();
}
function retrieveLoginRow($dbQry) {
if(!$dbQry->numRows()) return 0;
		$row					= $dbQry->getArray();
		
		$this->bi_MemberId			= $row["bi_MemberId"];
		$this->vc_EmailId			= $row["vc_EmailId"];
		$this->vc_Password			= $row["vc_Password"];
		$this->vc_FirstName			= $row["vc_FirstName"];
		$this->vc_DisplayName			= $row["vc_DisplayName"];
		$this->memberStatus			= $row["ti_MemberStatus"];
		$this->accessLevel			= $row["i_AccessLevel"];			
		return 1;
}

function retrieveUserDeatilsArray() { 	
		
		$query	= " SELECT	
						*  
					FROM	
						tbl_mem_details WHERE 1=1 ";						
		if(trim($this->bi_MemberId) != "") 
			$query	.=	" AND bi_MemberId	=	".$this->bi_MemberId;		
		if(trim($this->i_CountriesId) != "") 
			$query	.=	" AND i_CountriesId	=	".$this->i_CountriesId;		
		if (trim($this->vc_FirstName) != "") 
			$query	.= " AND vc_FirstName LIKE '%".$this->vc_FirstName."%'";
		if (trim($this->vc_LastName) != "") 
			$query	.= " AND vc_LastName LIKE '%".$this->vc_LastName."%'";
		if (trim($this->d_DateOfBirth) != "") 
			$query	.= " AND d_DateOfBirth LIKE '%".$this->d_DateOfBirth."%'";
		if (trim($this->b_Gender) != "") 
			$query	.= " AND b_Gender=			".$this->b_Gender."%'";	
		if (trim($this->dt_SignUp) != "") 
			$query	.= " AND dt_SignUp LIKE  '%".$this->dt_SignUp."%'";
		if (trim($this->dt_LastSignIn) != "") 
			$query	.= " AND dt_LastSignIn LIKE '%".$this->dt_LastSignIn."%'";
		if (trim($this->dt_Validated) != "") 
			$query	.= " AND dt_Validated LIKE '%".$this->dt_Validated."%'";	
		
			$query	.= " ORDER BY $this->sortColumn $this->sortDirection";
		
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveContactForUserDeatilsRowArray($this->clsfmPaginate);
}

function retrieveUserDetailsRowArray($dbQry) {	
		$arrContactForUserDeatils	= array();
		while($row= $dbQry->getArray()) {
			$arrdetails[$row["bi_MemberId"]]	= array(
					"bi_MemberId"		=> $row["bi_MemberId"],
					"i_CountriesId"  	=> $row["i_CountriesId"],
					"vc_FirstName"		=> $row["vc_FirstName"],
					"vc_LastName"		=> $row["vc_LastName"], 
					"b_Gender" 			=> $row["b_Gender"] ,
					"d_DateOfBirth"		=> $row["d_DateOfBirth"],
					"dt_SignUp"			=> $row["dt_SignUp"] ,
					"dt_LastSignIn" 	=> $row["dt_LastSignIn"],
					"dt_Validated" 		=> $row["dt_Validated"]);
		}			
		return $arrdetails;
	}
	
function getCountry() { 	
		
		$query	= "SELECT * FROM lkup_countries order by i_CountriesId ASC";		
		
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveCountryRowArray($dbQry);
	
}	
function retrieveCountryRowArray($dbQry) {	
		$arrCoutryDeatils	= array();
		while($row= $dbQry->getArray()) {
		$arrCoutryDeatils[$row["i_CountriesId"]]	= array(
					"i_CountriesId"		=> $row["i_CountriesId"],
					"vc_CountriesName"  	=> $row["vc_CountriesName"]);
			
			
		}	
			
		return $arrCoutryDeatils;
	}

function sendEmail()

		{
		
				
			$clsbpEmailTemplate					= new clsbpEmailTemplate($this->connect,$this->includePath);
			
 			$emailTo	=  $this->vc_EmailId; 
			$clsbpEmailTemplate->additionalField2	= $this->vc_DisplayName;
			$clsbpEmailTemplate->sendSubject        = 'Welcome to bopaboo';
			$clsbpEmailTemplate->additionalField1	= $this->vc_EmailId;
			$encodeid								= base64_encode(base64_encode($this->bi_MemberId));
			 $clsbpEmailTemplate->additionalField3	= "<a href='".HTTP."bpSetPassword.php?bi_MemberId=$encodeid"."'>".HTTP."bpSetPassword.php?bi_MemberId=$encodeid"."</a>";

					$query	= "	UPDATE 
							tbl_mem_login 
						SET 
									ti_MemberStatus 	  =\"0\"						
						WHERE 
								bi_MemberId   = $this->bi_MemberId";

			$dbQry	= new dbQuery($query, $this->connect->connId);
			

			$sendStatus	= $clsbpEmailTemplate->send('FORGOTPASSWORD',$emailTo,1);

		

		}
		
function sendMailAgain() {
 					
					//$query = "SELECT * FROM tbl_mem_login WHERE vc_EmailId = '".$this->vc_EmailId."'";
					$query ="SELECT *
						FROM 
							tbl_mem_login
						INNER JOIN 
							tbl_mem_details 
						ON 
							tbl_mem_login.`bi_MemberId` = tbl_mem_details.`bi_MemberId`
						WHERE 
							tbl_mem_login.vc_EmailId = '$this->vc_EmailId'";
							
					$dbQry	= new dbQuery($query, $this->connect->connId);
					$this->retrieveLoginRow($dbQry);
					
					
					$emailTo				= $this->vc_EmailId;

 					$clsbpEmailTemplate			= new clsbpEmailTemplate($this->connect,$this->includePath);

 					$clsbpEmailTemplate->sendSubject        = 'bopaboo Registration Confirmation';
 		
 					 					
 					$encodeid				=base64_encode(base64_encode($this->bi_MemberId));

 					$this->songList 			= base64_encode($this->songList);

 					/* Email templete variables*/
					$clsbpEmailTemplate->additionalField1 	= $this->vc_FirstName;
					$clsbpEmailTemplate->additionalField2	= "<a style='text-decoration:none; color:#6EA4D1; font-weight:bold;' href='".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION&songList=$this->songList"."'>".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION&songList=$this->songList"."</a>";
					$clsbpEmailTemplate->additionalField3 	= HTTP;
					$clsbpEmailTemplate->additionalField4	= "<a href='".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION&songList=$this->songList"."'><img border='0'; src='".HTTP."emailtemplates/images/btnActivate.jpg'></a>";
 
 					$sendStatus				= $clsbpEmailTemplate->send('ACTIVATE',$emailTo,1);
}
		

function updateLoginDeatils($id)
		{
			
			$encodeid								=base64_decode(base64_decode($id));
			$this->songList = base64_encode($this->songList);
			$query	= "	UPDATE 
							tbl_mem_login 
						SET 
									ti_MemberStatus 	  =\"1\"						
						WHERE 
								bi_MemberId   = $encodeid";

			$dbQry	= new dbQuery($query, $this->connect->connId);

			
				$query	= " INSERT INTO   
									 tbl_bopabank 
									(
										bi_MemberId,
										f_DepositAmount
										
									) 
								VALUES 
									(
										\"$encodeid\",'10'				
										
									)";
									$dbQry	= new dbQuery($query, $this->connect->connId);

}
		
function updatePassword($bi_MemberId)

		{
		$resp = recaptcha_check_answer ($this->privateKey,$_SERVER["REMOTE_ADDR"],$this->recaptcha_challenge_field,$this->recaptcha_response_field);
  		if (!$resp->is_valid) { $_SESSION["BPMESSAGE"]= "* Incorrect Security Code. Please Re-enter the security code"; return 0; }
		
	 	 $encodeid      =   base64_decode(base64_decode($this ->bi_MemberId)); 
		 $query	= "	UPDATE 

							tbl_mem_login 

						SET 

								vc_Password  =\"$this->vc_Password\",
								ti_MemberStatus =\"1\"
						
						WHERE 

								bi_MemberId   = $encodeid";
			
	            $dbQry	  = new dbQuery($query, $this->connect->connId);  
	            
	  

			//$_SESSION["BPMESSAGE"]	= "ContactForUserDetails updated successfully";	
		        $this ->retrieveLogin($encodeid);
			$clsbpEmailTemplate	=   new clsbpEmailTemplate($this->connect,$this->includePath);	
  			  $emailTo	        =  $this->vc_EmailId;  
		        $clsbpEmailTemplate->additionalField1	= $this->vc_DisplayName; 
			$clsbpEmailTemplate->sendSubject        = 'Welcome to bopaboo'; 
			$sendStatus	= $clsbpEmailTemplate->send('PASSWORDCHANGED',$emailTo,1);
return 1;

		}
		
		function SendPasswordMail()
	{
	
	            
	  

			
	$clsbpEmailTemplate	=   new clsbpEmailTemplate($this->connect,$this->includePath);	
  			  $emailTo	        =  $this->vc_EmailId;  
		        $clsbpEmailTemplate->additionalField1	= $this->vc_DisplayName; 
			$clsbpEmailTemplate->sendSubject        = 'Welcome to bopaboo'; 
			$sendStatus	= $clsbpEmailTemplate->send('PASSWORDCHANGED',$emailTo,1);
return 1;
	
	}
		
	function deleteContactForUserDeatils($ids) {

		if (trim($ids) == "") return 0;
		
		$query	= " DELETE FROM 
						tbl_mem_details 
					WHERE 
						bi_MemberId IN ($ids)";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$_SESSION["BPMESSAGE"]	.= "  tbl_mem_details deleted successfully ";

		return 1;			
	}
	
	
	#function loginAfterRegistration is to perform login after registeration
	#Added by Nilesh for directly sign in the user after registration is successfully completed
	function loginAfterRegistration() 
	{
		if($this->login() > 0){			
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();
			}
	}	
	
	function login() {

		$this->deleteCookie(); // first delete any cookies present
		return $this->isClient();//check whether client
	}	
	
	#function deleteCookie is to set the cookie
    function deleteCookie() { 	
		if (isset($_COOKIE["COOKIE_USERNAME"])) {
			$_COOKIE["COOKIE_USERNAME"] = "" ;
		}
		if (isset($_COOKIE["COOKIE_USERID"])) {
			$_COOKIE["COOKIE_USERID"] = "" ;
		}
		
		setcookie("COOKIE_USERNAME","", time() - 1*24*3600);
		setcookie("COOKIE_USERID","", time() - 1*24*3600);			
 	}
	function isClient(){

		$password = $this->vc_Password;	
		$query = "SELECT * FROM tbl_mem_login 
		          WHERE vc_EmailId = '$this->vc_EmailId'
				  AND vc_Password='$password'
				  AND ti_MemberStatus='1'";
	
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$this->retrieveLoginRow($dbQry);
		$this->setCookie($this->bi_MemberId,$this->vc_DisplayName);
		$this->sessionStart($this->bi_MemberId);
		
		$cartSize = count($_SESSION['bopaBasket']['song']);
		$clsbpBopaCart	= new clsbpBopaCart($this->connect, $this->includePath,"clsbpBopaCart");
		if($cartSize==0){ // if cart session is empty select from database
		
		$clsbpBopaCart->retrieveCartItemsofUser($this->bi_MemberId);
		}
		/*----------------------------------------------------------------------------	
		 Created cart object*/
		 	if($cartSize > 0){
			
			$clsbpBopaCart->postCart();
			$clsbpBopaCart->fn_InsertItemtoCartTableAfterLogin();
			}
		/*---------------------------------------------------------------------------*/
			
		
		return $dbQry->numRows();
		
		
	}
	function setCookie($userId,$userName){
	
	    setcookie("COOKIE_USERNAME",  $userName,  time()+1*24*3600,"/");
		setcookie("COOKIE_USERID",    $userId,    time()+1*24*3600,"/");
	//	setcookie("COOKIE_SESSION_ID",    session_id(),    time()+1*300,"/");
	
	}
	function sessionStart($userId) {

		//session_start();	
		//$_SESSION['bopaBasket']= "";
		if(!session_is_registered('USERID')){	session_register('USERID');}
		//if(!session_is_registered('ARLOGINTIME')){	session_register('ARLOGINTIME');}
		$_SESSION['USERID']			= $userId;
		
		
		$_SESSION['ARLOGINTIME']			= time();
		
	}
	#function logout is to perform logout
	function logout() {		
		
		session_destroy();
		//session_start();
		$this->deleteCookie();
		//$_SESSION['BPMESSAGE'].= "You have successfully logged out";
		return 1;
	}

	function updateNotifications($userId) {
		if($this->hasValues($userId)) {
			$query = "
						UPDATE 
							tbl_member_preferences_notifications 
						SET 
							ti_PostedNotification = $this->flagNotification,
							ti_FeatureNotification = $this->flagNotifyFeatures,
							ti_PromosNotification =  $this->flagNotifyPromos
						WHERE
							bi_MemberId = $userId
					";
		}
		else {
			$query = "
						INSERT INTO 
							tbl_member_preferences_notifications(
								bi_MemberId,
								ti_PostedNotification,
								ti_FeatureNotification,
								ti_PromosNotification)
						VALUES($userId,
							$this->flagNotification,
							$this->flagNotifyFeatures,
							$this->flagNotifyPromos)
					";
		}
		$dbQry	= new dbQuery($query, $this->connect->connId);
		
		return 1;
	}
	
	function updatePreferences($userId) {
		if($this->hasValues($userId)) {
			$query = "
						UPDATE 
							tbl_member_preferences_notifications 
						SET 
							vc_DowonloadLocation = \"$this->downloadLocation\",
							vc_UploadLocation = \"$this->uploadLocation\",
							f_DefaultSellPrice =  $this->defaultPrice
						WHERE
							bi_MemberId = $userId
					";
		}
		else {
			$query = "
						INSERT INTO 
							tbl_member_preferences_notifications(
								bi_MemberId,
								vc_DowonloadLocation,
								vc_UploadLocation,
								f_DefaultSellPrice
								)
						VALUES($userId,
							\"$this->downloadLocation\",
							\"$this->uploadLocation\",
							\"$this->defaultPrice\"
							)
					";
		}
		$dbQry	= new dbQuery($query, $this->connect->connId);
		
		return 1;
	}
	
	function hasValues($userId) {
		$query = "SELECT * FROM 
							tbl_member_preferences_notifications 
						WHERE 
							bi_MemberId=$userId";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		if(!$dbQry->numRows()) 
			return 0;
		else 
			return 1;
		
	}
	
	function withdrawFunds() { 
		$userid = $_SESSION['USERID'];
		$vc_description= 'bopaboo withdrawl on ' . date("F j, Y - h:i a");
		$query = "INSERT INTO tbl_withdrawal ( bi_MemberId, vc_EmailId, f_WithdrawalAmount, vc_currencyCode, vc_description, d_withdrawalDate, d_processDate )
		 VALUES
		 ( " . $userid . ", \"$this->classname_email\", \"$this->withdrawAmount\", 'USD', '" . $vc_description . "', now(), null )";

		$dbQry	= new dbQuery($query, $this->connect->connId);
		if(!$dbQry->numRows()) 
			return 0; 
		else 
			return 1;
	}	
	
	function retrieveUserNotificationDeatils($userId) {
		$query = "SELECT *
					FROM `tbl_member_preferences_notifications` WHERE bi_MemberId = $userId";
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveMemberAllDeatilsRow($dbQry);
		return $dbQry->numRows();
		
	}
	
			
	function postContactForUserDeatils() {	
		
		
		// initilize Post and Get methods
	    $this->setPostVars();
		$this->setGetVars();	
		
		

		if ($this->action == "SAVE") {	 // registration
		
			if ($this->saveUserDetails($this->bi_MemberId)) {
			
				//$this->loginAfterRegistration($this->vc_EmailId,$this->vc_Password); //Added By Nilesh
				$this->loginAfterRegistration(); //Added By Nilesh
				//NIL header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();					
			}
		}
		
		if ($this->action == "UPDATE") {	 // change account
			
			if ($this->updateUserDetails($this->bi_MemberId)) {
				$_SESSION["BPMESSAGE"]	= "* Settings saved!";
				header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();					
			}
		}
		
		else if ($this->action == "DELETE") { // delete account (admin side)
					
			$this->deleteContactForUserDeatils($this->ids);
			header("location:".$this->includePath."admin/".stripslashes($this->returnUrl));
			exit();		
		}
		
		else if ($this->action == "ACTIVATION") { // account activation
						
				$this->updateLoginDeatils($this->bi_MemberId);
		
				if($this->songList!=''){
				
				$clsbpBopaCart	= new clsbpBopaCart($this->connect, $this->includePath,"clsbpBopaCart");
				$clsbpBopaCart->bi_MemberId = base64_decode(base64_decode($this->bi_MemberId));
				$clsbpBopaCart->fn_CreateCartSession($this->songList);
				
				}
				
				$_SESSION["BPMESSAGE"]	= "Your Account has beeen  activated";	
				header("location:index.php?songList=$this->songList");
				exit();		
		}
		else if($this->action == "RESEND")
		{
			
		
 			$this->sendMailAgain();
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();	
		}
		else if ($this->action == "LOGIN") { // user login
					
							
			if($this->login() > 0){			
			
			
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();
			
			}
			else{
			
			$_SESSION["BPMESSAGE"]	.= "invalid email address or password";
			
			}	
		}
		
		else if ($this->action == "LOGOUT") { //logout user
					
			if($this->login() > 0){
			
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();
			
			}
			else{
			
			$_SESSION["BPMESSAGE"]	.= "invalid username or password";
			
			}	
		}
		else if ($this->action == "FORGOTPASSWORD") {	// forgot password
               	
				$this->checkEmailExist();
			
			if($this->checkEmailExistPass() > 0){
			
           		 $this->sendEmail();				
				 
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();	
			
			}
				
			else{
			
			$_SESSION["BPMESSAGE"]	.= "That email address was not found in our database.  Please try again.";
			
			}
			
				
		}
		else if ($this->action == "NEWPASSWORD") {		// set new password
			
			if($this->updatePassword($this->bi_MemberId)>0){
			
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();		
			
			}
		}
		else if ($this->action == "PASSWORDSEND") {		// set new password
			
			if($this->SendPasswordMail()>0){
			
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();		
			
			}
		}
		else if ($this->action == "UPDATEPWD") {		// set new password
			if($this->vc_Password != $this->confPassword) {
			echo 	$_SESSION["BPMESSAGE"]	= "* Password do not match."; exit();
				
				//echo "coming here";
			}
			else {
				
				if($this->updateUserPassword($this->bi_MemberId)) {
					//echo "coming here";
					$_SESSION["BPMESSAGE"]	= "* Password changed";
				}
				else {
					//die("coming here12");
					 $_SESSION["BPMESSAGE"]	= "* Please enter your old password correctly"; 
					
				}
			}
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();
		}
		else if ($this->action == "UPDATENOTIFICATION") {		// Change notification settings
			$this->bi_MemberId =$_SESSION['USERID'];
			if($this->updateNotifications($this->bi_MemberId)) {
				$_SESSION["BPMESSAGE"]	.= "* Settings saved!";
				header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();
			}
		}
		else if ($this->action == "UPDATEPREFERENCES") {		// Change preference settings
			$this->bi_MemberId =$_SESSION['USERID'];
			if($this->updatePreferences($this->bi_MemberId)) {
				$_SESSION["BPMESSAGE"]	.= "* Settings saved!";
				header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();
			}
		}
		else if ($this->action == "GETNOTIFICATION") {		// Change notification settings
			$this->bi_MemberId =$_SESSION['USERID'];
			
			$count = $this->retrieveUserNotificationDeatils($this->bi_MemberId);
			if(!$count || ($this->flagNotification==2 && $this->flagNotifyFeatures ==2 && $this->flagNotifyPromos ==2)) {//Check for any update
				$this->flagNotification=1;
				$this->flagNotifyFeatures =1;
				$this->flagNotifyPromos =1;
				
			}
		}
		else if ($this->action == "GETPREFERENCES") {		// Change preference settings
			$this->bi_MemberId =$_SESSION['USERID'];
			$count = $this->retrieveUserNotificationDeatils($this->bi_MemberId);
			if(!$count || ($this->defaultPrice==-1.00)){ //Check for any update
				$this->defaultPrice = 0.45;
			}
		}
		else {
			$this->retrieveUserAllDeatils($_SESSION['USERID']	);
		}
		
	} // end of function postContactForUserDeatils()
	
} // end of class
?>
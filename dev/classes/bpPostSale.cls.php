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
class clsPostSale extends clsbpBase  { 
	var $fileId;
    var $artistName;	
	var $songName;		
	var $tagname;		
	var $price;
	
function clsbpBase($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsPostSale");		
		$this->$fileId="";
    	$this->$artistName="";	
		$this->$songName="";		
		$this->$tagname="";		
		$this->$price="";
		}

function setPostVars() {	

		parent::setPostVars();	
	
		if (isset($_POST['clsbpUserLogin_optCountry']))
			 $this->i_CountriesId			 = trim($_POST['clsbpUserLogin_optCountry']);
		if (isset($_POST['clsbpUserLogin_txtFname']))
			$this->vc_FirstName		 		= trim($_POST['clsbpUserLogin_txtFname']);
		if (isset($_POST['clsbpUserLogin_txtLname']))	
			$this->vc_LastName			 	= trim($_POST['clsbpUserLogin_txtLname']);
		if (isset($_POST['clsbpUserLogin_optDay']))
	
}

	function setGetVars() {

		parent::setGetVars();
			
		if (isset($_GET['bi_MemberId']))
				$this->bi_MemberId				= trim($_GET['bi_MemberId']);  
		if (isset($_GET['i_CountriesId']))
				$this->i_CountriesId				= trim($_GET['i_CountriesId']);
		if (isset($_GET['vc_FirstName']))
				$this->vc_FirstName					= trim($_GET['vc_FirstName']);
		if (isset($_GET['vc_LastName']))
				$this->vc_LastName					= trim($_GET['vc_LastName']);
		if (isset($_GET['d_DateOfBirth']))
				$this->d_DateOfBirth				= trim($_GET['d_DateOfBirth']);
		if (isset($_GET['b_Gender']))
				$this->b_Gender						= trim($_GET['b_Gender']);		
		if (isset($_GET['dt_SignUp']))
				$this->dt_SignUp					= trim($_GET['dt_SignUp']);
		if (isset($_GET['emailId']))
				$this->vc_EmailId					=trim($_GET['emailId']);
		if (isset($_GET['Password']))
		    	$this->vc_Password					=trim($_GET['password']);
		if (isset($_GET['displayName']))
				$this->vc_DisplayName				=trim($_GET['displayName']);
		if (isset($_GET['memberStatus']))
				$this->memberStatus					=trim($_GET['memberStatus']);
		if (isset($_GET['accessLevel']))
				$this->accessLevel					=trim($_GET['accessLevel']);
		if (isset($_GET['checkTerms']))
				$this->checkTerms					=trim($_GET['checkTerms']);
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
										\"$this->memberStatus\",
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
										\"$this->bi_MemberId\",
										\"$this->vc_FirstName\",
										\"$this->vc_LastName\",
										\"$this->i_CountriesId\",
										\"$this->d_DateOfBirth\",
										\"$this->b_Gender\",
										NOW(),
										NULL,
										NULL
									)";
		
				     $dbQry	= new dbQuery($query, $this->connect->connId);
									
					$clsbpEmailTemplate = new clsbpEmailTemplate($this->connect,$this->includePath);				
			
					$emailTo								= $this->vc_EmailId;

					$clsbpEmailTemplate->sendSubject        = 'Welcome to Bopaboo';
		
					$clsbpEmailTemplate->additionalField1 	= $this->vc_FirstName;
					
					$encodeid								=base64_encode(base64_encode($this->bi_MemberId));
					$clsbpEmailTemplate->additionalField2	= "<a href='".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION"."'>".HTTP."activateAccount.php?bi_MemberId=$encodeid&action=ACTIVATION"."</a>";

					$sendStatus								= $clsbpEmailTemplate->send('ACTIVATE',$emailTo,1);
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
			$_SESSION["BPMESSAGE"]	= "ContactForUserDetails updated successfully";	
		}
		return $this->bi_MemberId;
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
			$_SESSION["BPMESSAGE"] .= "* Display name is already exists <BR>";
		}
		
		if(!validateEmailAddress($this->vc_EmailId))
		{
		$_SESSION["BPMESSAGE"] .= "* Email address is not valid <BR>";
		}
		
		if ($this->checkEmailExist()) {
			$_SESSION["BPMESSAGE"] .= "* Email address is already exists <BR>";
		}
		$resp = recaptcha_check_answer ($this->privateKey,$_SERVER["REMOTE_ADDR"],$this->recaptcha_challenge_field,$this->recaptcha_response_field);
  		if (!$resp->is_valid) { $_SESSION["BPMESSAGE"] .= "* Incorrect Recaptcha <BR>"; }
		
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

function retrieveUserDeatils($bi_MemberId) {

		if (trim($id) == "") return 0;

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
		$this->vc_DisplayName		= $row["vc_DisplayName"];
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
		
				
			$clsbpEmailTemplates					= new clsbpEmailTemplate($this->connect,$this->includePath);
			$clsbpEmailTemplate->sendSubject        = 'Welcome to Bopaboo';
 			$emailTo	=  $this->vc_EmailId; 
			$clsbpEmailTemplates->additionalField2	= $this->vc_DisplayName;
			$clsbpEmailTemplate->sendSubject        = 'Welcome to Bopaboo';
			$clsbpEmailTemplates->additionalField1	= $this->vc_EmailId;
			$encodeid								= base64_encode(base64_encode($this->bi_MemberId));
			 $clsbpEmailTemplates->additionalField3	= "<a href='".HTTP."bpSetPassword.php?bi_MemberId=$encodeid"."'>".HTTP."bpSetPassword.php?bi_MemberId=$encodeid"."</a>";


			

			$sendStatus	= $clsbpEmailTemplates->send('FORGOTPASSWORD',$emailTo,1);

		

		}
		

function updateLoginDeatils($id)
		{
			
			$encodeid								=base64_decode(base64_decode($id));
			$query	= "	UPDATE 
							tbl_mem_login 
						SET 
									ti_MemberStatus 	  =\"1\"						
						WHERE 
								bi_MemberId   = $encodeid";

			$dbQry	= new dbQuery($query, $this->connect->connId);

			$_SESSION["BPMESSAGE"]	= "Your Account has beeen  activated";	
			header("location:index.php");
			exit();

}
		
function updatePassword($bi_MemberId)

		{
	 	 $encodeid      =   base64_decode(base64_decode($this ->bi_MemberId)); 
		 $query	= "	UPDATE 

							tbl_mem_login 

						SET 

								vc_Password  =\"$this->vc_Password\"

						
						WHERE 

								bi_MemberId   = $encodeid";
			
	            $dbQry	  = new dbQuery($query, $this->connect->connId);  
	            
	  

			$_SESSION["BPMESSAGE"]	= "ContactForUserDetails updated successfully";	
		        $this ->retrieveLogin($encodeid);
			$clsbpEmailTemplates	=   new clsbpEmailTemplate($this->connect,$this->includePath);	
  			$emailTo	        =  $this->vc_EmailId;  
		        $clsbpEmailTemplates->additionalField1	= $this->vc_DisplayName; 
			$clsbpEmailTemplate->sendSubject        = 'Welcome to Bopaboo'; 
			$sendStatus	= $clsbpEmailTemplates->send('PASSWORDCHANGED',$emailTo,1);


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
	
	#function login is to perform login
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
		
		setcookie("COOKIE_USERNAME","", time() - 3600);
		setcookie("COOKIE_USERID","", time() - 3600);			
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
		
		return $dbQry->numRows();
		
		
	}
	function setCookie($userId,$userName){
	
	    setcookie("COOKIE_USERNAME",  $userName,  time()+365*24*3600,"/");
		setcookie("COOKIE_USERID",    $userId,    time()+365*24*3600,"/");
		
	}
	function sessionStart($userId) {

		//session_start();	
		$_SESSION["USERID"]			= $userId;
	}
	#function logout is to perform logout
	function logout() {		
		
		//session_destroy();
		//session_start();
		$this->deleteCookie();
		//$_SESSION['BPMESSAGE'].= "You have successfully logged out";
		return 1;
	}
			
	function postContactForUserDeatils() {	
		$this->setPostVars();
		$this->setGetVars();	

		if ($this->action == "SAVE") {	
			if ($this->saveUserDetails($this->bi_MemberId)) {
			
				header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();					
			}
		}
		else if ($this->action == "DELETE") {				
			$this->deleteContactForUserDeatils($this->ids);
			header("location:".$this->includePath."admin/".stripslashes($this->returnUrl));
			exit();		
		}
		else if ($this->action == "ACTIVATION") {				
			$this->updateLoginDeatils($this->bi_MemberId);
			header("location:index.php");
			exit();		
		}
		else if ($this->action == "LOGIN") {
					
			if($this->login() > 0){
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();
			}
			else
			{
			$_SESSION["BPMESSAGE"]	.= "Invalid username or password.";
			}	
		}
			else if ($this->action == "LOGOUT") {
					
			if($this->login() > 0){
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();
			}
			else
			{
			$_SESSION["BPMESSAGE"]	.= "Invalid username or password.";
			}	
		}
		else if ($this->action == "FORGOTPASSWORD") {	
               		$this->checkEmailExist();
			
			if($this->checkEmailExistPass() > 0){
           		 $this->sendEmail();
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();	
			}	
			else
			{
			header("location:bpForgotPassword.php");
			return 0;
			exit();
			}
			
				
		}
		else if ($this->action == "NEWPASSWORD") {				
			$this->updatePassword($this->bi_MemberId);
			
			header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();		
		}
	}
}
?>
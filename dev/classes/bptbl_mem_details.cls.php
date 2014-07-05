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
class clsbptbl_mem_details extends clsbpBase  { 
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

function clsbpBase($connect, $includePath) {			
		
		$this->clsfmBase($connect, $includePath, "clsbptbl_mem_details");			
		
		$this->bi_MemberId		= "";		
		$this->i_CountriesId	= "";		
		$this->vc_FirstName		= "";		
		$this->vc_LastName		= "";	
		$this->d_DateOfBirth	= "";
		$this->optDay			= "";
		$this->optMonth			= "";
		$this->optYear			= "";	
		$this->b_Gender			= "";		
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
	}

function setPostVars() {	

		parent::setPostVars();	
		
		if (isset($_POST['clsbptbl_mem_details_optCountry']))
			$this->i_CountriesId			 = trim($_POST['clsbptbl_mem_details_optCountry']);
		if (isset($_POST['clsbp tbl_mem_details_txtFname']))
			$this->vc_FirstName		 		= trim($_POST['clsbp tbl_mem_details_txtFname']);
		if (isset($_POST['clsbptbl_mem_details_txtLname']))	
			$this->vc_LastName			 	= trim($_POST['clsbp tbl_mem_details_txtLname']);
		if (isset($_POST['clsbptbl_mem_details_optDay']))
				$this->optDay				 = trim($_POST['clsbptbl_mem_details_optDay']);
		if (isset($_POST['clsbptbl_mem_details_optMonth']))
				$this->optMonth				 = trim($_POST['clsbptbl_mem_details_optMonth']);
		if (isset($_POST['clsbptbl_mem_details_optYear']))
				$this->optYear				 = trim($_POST['clsbptbl_mem_details_optYear']);	
		if (isset($_POST['clsbptbl_mem_details_optGender']))
			$this->b_Gender			 		=trim($_POST['clsbptbl_mem_details_optGender']);
		if (isset($_POST['clsbptbl_mem_details_txtEmail']))
				$this->vc_EmailId      		 =trim($_POST['clsbptbl_mem_details_txtEmail']);
		if (isset($_POST['clsbptbl_mem_details_txtPassword']))
			$this->vc_Password				=trim($_POST['clsbptbl_mem_details_txtPassword']);
		if (isset($_POST['clsbptbl_mem_details_txtDisname']))
			$this->vc_DisplayName			=trim($_POST['clsbptbl_mem_details_txtDisname']);
		if (isset($_POST['clsbptbl_mem_details_checkbox']))
			$this->checkTerms				=trim($_POST['clsbptbl_mem_details_checkbox']);	
			$this->memberStatus					=0;
			$this->accessLevel					=0;	
}

	function setGetVars() {

		parent::setGetVars();
			
		if (isset($_GET['bi_MemberId']))
				$this->bi_MemberId					= trim($_GET['id']);
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

		if (!$this-> validatetbl_mem_details) return 0;	

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
										\"$this->accessLevel\",
									)";
		
					$dbQry	= new dbQuery($query, $this->connect->connId);			
					
					$this->bi_MemberId		= $dbQry->lastInsertId();
					$this->d_DateOfBirth=trim($this->optDay)."-".trim($this->optDay)."-".trim($this->optDay);
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
										dt_LastSignIn								
										
									) 
								VALUES 
									(
										\"$this->bi_MemberId\",
										\"$this->vc_FirstName\",
										\"$this->vc_LastName\",
										\"$this->i_CountriesId\",
										\"$this->d_DateOfBirth\",
										\"$this->b_Gender\",
										\"$this->dt_SignUp\",
										NOW()
									)";
		
					$dbQry	= new dbQuery($query, $this->connect->connId);
					$this->bi_MemberId		= $dbQry->lastInsertId();
					$_SESSION["FMMESSAGE"]	= "Thank You";
		} 
		else {

			$query	= "	UPDATE 
							tbl_mem_details 
						SET 
						        vc_FirstName    \"$this->vc_FirstName\",
								vc_LastName  =\"$this->vc_LastName\",
							   	i_CountriesId =\"$this->i_CountriesId\",
								d_DateOfBirth =\"$this->d_DateOfBirth\",
								b_Gender =\"$this->b_Gender\",
								dt_SignUp =\"$this->dt_SignUp\",								
								dt_Validated = Now ; 
						WHERE 
								bi_MemberId   = $bi_MemberId";
			$dbQry	= new dbQuery($query, $this->connect->connId);
			$this->bi_MemberId		= $bi_MemberId;
			$_SESSION["FMMESSAGE"]	= "ContactForUserDetails updated successfully";	
		}
		return $this->bi_MemberId;
	}

function validatetbl_mem_details() {	
			$_SESSION["FMMESSAGE"] 	= "";	
		if (trim($this->firstName) == "") {
			$_SESSION["FMMESSAGE"] .= "First Name cannot be null <BR>";
		}
		if (trim($this->lastName) == "") {
			$_SESSION["FMMESSAGE"] .= "Last Name cannot be null <BR>";
		}
			if (trim($this->vc_EmailId) == "") {
			$_SESSION["BPMESSAGE"] .= "Email address cannot be null <BR>";
		}
		if (trim($this->vc_DisplayName) == "") {
			$_SESSION["BPMESSAGE"] .= "Display name cannot be null <BR>";
		}
		if(!$this->validateEmailAddress($this->vc_EmailId))
		{
		$_SESSION["BPMESSAGE"] .= "Email address is not valid <BR>";
		}
		## validating the passwords	
		if(preg_replace("/^\s*$/","",$this->vc_Password)=="" && preg_replace("/^\s*$/","",$this->confPassword)=="")
		{			
		$_SESSION["BPMESSAGE"] .="Password and confirm password are required.";
		}
			elseif(preg_replace("/^\s*$/","",$this->vc_Password)=="")
			{			
				$_SESSION["BPMESSAGE"] .="Password is required.";
			}
				elseif(preg_replace("/^\s*$/","",$this->confPassword)=="")
				{
					$_SESSION["BPMESSAGE"] .="Confirm password is required.";
				}
					elseif($this->vc_Password!=$this->confPassword)
					{
						$_SESSION["BPMESSAGE"] .="Passwords are not matching.";
					}
	
	if (strlen($_SESSION["FMMESSAGE"]) > 0) {
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
			$query	.=	" AND bi_MemberId	=	".$this->id;		
		if(trim($this->i_CountriesId) != "") 
			$query	.=	" AND i_CountriesId	=	".$this->countryid;		
		if (trim($this->vc_FirstName) != "") 
			$query	.= " AND vc_FirstName LIKE '%".$this->firstName."%'";
		if (trim($this->vc_LastName) != "") 
			$query	.= " AND vc_LastName LIKE '%".$this->lastName."%'";
		if (trim($this->d_DateOfBirth) != "") 
			$query	.= " AND d_DateOfBirth LIKE '%".$this->dob."%'";
		if (trim($this->b_Gender) != "") 
			$query	.= " AND b_Gender LIKE '%".$this->gender."%'";	
		if (trim($this->dt_SignUp) != "") 
			$query	.= " AND dt_SignUp LIKE '%".$this->dtsignup."%'";
		if (trim($this->dt_LastSignIn) != "") 
			$query	.= " AND dt_LastSignIn LIKE '%".$this->dtlastsignin."%'";
		if (trim($this->dt_Validated) != "") 
			$query	.= " AND dt_Validated LIKE '%".$this->validateDate."%'";	
		if (trim($this->ids) != "") 
			$query	.= " AND bi_MemberId IN($this->ids)";
		$query	.= " ORDER BY $this->sortColumn $this->sortDirection";
		
		$this->clsfmPaginate = new clsfmPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
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
					"b_Gender" 		=> $row["b_Gender"] ,
					"d_DateOfBirth"		=> $row["d_DateOfBirth"],
					"dt_SignUp"			=> $row["dt_SignUp"] ,
					"dt_LastSignIn" 	=> $row["dt_LastSignIn"],
					"dt_Validated" 		=> $row["dt_Validated"]);
		}			
		return $arrdetails;
	}


	function deleteContactForUserDeatils($ids) {

		if (trim($ids) == "") return 0;
		
		$query	= " DELETE FROM 
						tbl_mem_details 
					WHERE 
						bi_MemberId IN ($ids)";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$_SESSION["FMMESSAGE"]	.= "  tbl_mem_details deleted successfully ";

		return 1;			
	}
			
	function postContactForUserDeatils() {	

		$this->setPostVars();
		$this->setGetVars();	

		if ($this->action == "SAVE") {		
			if ($this->saveUserDetails($this->id)) {
				header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();					
			}
		}
		else if ($this->action == "DELETE") {				
			$this->deleteContactForUserDeatils($this->ids);
			header("location:".$this->includePath."admin/".stripslashes($this->returnUrl));
			exit();		
		}
	}
}
?>
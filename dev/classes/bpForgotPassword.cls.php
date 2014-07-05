<?php 
class clsbpForgotPassword extends clsbpUserLogin  { 

	
	var $vc_EmailId;		
	
	function clsbpForgotPassword($connect, $includePath) {			
		
		$this->clsfmBase($connect, $includePath, "clsbpForgotPassword");			
		
		
	}
function setPostVars() {	

		parent::setPostVars();	
		
		if (isset($_POST['clsbpForgotPassword_vc_EmailId']))				$this->vc_EmailId			= trim($_POST['clsbpForgotPassword_vc_EmailId']);
			
	}

	function setGetVars() {

		parent::setGetVars();	

		if (isset($_GET['clsbpForgotPassword_vc_EmailId']))			$this->vc_EmailId								= trim($_GET['clsbpForgotPassword_vc_EmailId']);
				
	}
function validatePassword() {	
			$_SESSION["FMMESSAGE"] 	= "";	
		
		if (trim($this->vc_EmailId) == "") {
			$_SESSION["FMMESSAGE"] .= "Email Name cannot be null <BR>";
		}
		
	if (strlen($_SESSION["FMMESSAGE"]) > 0) {
			return 0;
		} else {
			return 1;
		}						
	}
function retrievePassword($vc_EmailId) {

		if (trim($vc_EmailId) == "") return 0;

		$query	= " SELECT 
						* 
					FROM 
						tbl_mem_login 
					WHERE 
						vc_EmailId = $vc_EmailId";	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveContactRow($dbQry);
		return $dbQry->numRows();
	$clsbpEmailTemplate = new clsbpEmailTemplate($this->connect,$this->includePath);				
			$vc_MemberId            =  'base64_encode($this->bi_Memberid)';
			$emailTo		 = '$this->vc_EmailId';

			$clsfmEmailTemplate->sendSubject        = 'Password Reset Mail';

			$clsbpEmailTemplate->additionalField1 	= $this->vc_EmailId;
			$clsbpEmailTemplate->additionalField2 	= $vc_MemberId;
			$clsbpEmailTemplate->additionalField3	= " Name 			:". $this->vc_DisplayName.
													 
													;

			$sendStatus								= $clsbpEmailTemplate->send('FORGOTPASSWORD',$emailTo,1);

	}

	function postForgotPassword() {	

		$this->setPostVars();
		$this->setGetVars();	

		if ($this->action == "FORGOTPASSWORD") {		
			if ($this->retrievePassword($this->vc_EmailId)) {
				header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();					
			}
		}
		
	}
}
?>
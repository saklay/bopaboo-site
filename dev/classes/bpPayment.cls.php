<?php 
/*******************************************************************
/ Title: BopaCart Class.
/ Purpose: This file is used for shopping cart process .
/ 
/ Inputs:   
			
/ Outputs:  
/           

/ Authors:  Sivaprasad C
/*******************************************************************/
class clsbpPayment extends clsbpBase  { 

	var $bi_bopabank_id;		
	var $bi_MemberId;		
	var $f_DepositAmount;		
	var $f_SalesAmount;
	var $d_LastUpdatedDate;
	var $cardId;
	function clsbpPayment($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpPayment");			
		
		$this->bi_bopabank_id		= "";
		$this->bi_MemberId	        = "";		
		$this->f_DepositAmount	    = "";
		$this->f_SalesAmount	    = "";	
		$this->d_LastUpdatedDate    = "";		
		$this->includePath		    = $includePath;
		
	
		
	}
    
	function setPostVars() {	

		parent::setPostVars();	
		if (isset($_POST['clsbpPayment_bi_bopabank_id']))         $this->bi_bopabank_id    = trim($_POST['clsbpPayment_bi_bopabank_id']);
		if (isset($_POST['clsbpPayment_f_DepositAmount']))        $this->f_DepositAmount   = trim($_POST['clsbpPayment_f_DepositAmount']);
		if (isset($_POST['clsbpPayment_f_SalesAmount']))  		  $this->f_SalesAmount     = trim($_POST['clsbpPayment_f_SalesAmount']);
		if (isset($_POST['clsbpPayment_d_LastUpdatedDate']))  	  $this->d_LastUpdatedDate = trim($_POST['clsbpPayment_d_LastUpdatedDate']);
		if ($_SESSION['USERID']!='')          	                  $this->bi_MemberId       = $_SESSION['USERID'];
		if (isset($_POST['clsbpPayment_TotalPurchaseAmount']))    $this->purchaseAmount     = trim($_POST['clsbpPayment_TotalPurchaseAmount']);
		
		if (isset($_POST['clsbpCreditCard_txtCreditCardVer1']))    $this->CreditCardVer1     = trim($_POST['clsbpCreditCard_txtCreditCardVer1']);
		if (isset($_POST['clsbpPayment_cardId']))    $this->cardId     = trim($_POST['clsbpPayment_cardId']);

	}

	function setGetVars() {

		parent::setGetVars();	

		if (isset($_GET['clsbpPayment_bi_bopabank_id']))	$this->bi_bopabank_id    = trim($_GET['bi_bopabank_id']);
		if (isset($_GET['f_DepositAmount']))				$this->bi_bopabank_ids   = trim($_GET['f_DepositAmount']);
		if (isset($_GET['f_SalesAmount']))					$this->bi_bopabank_ids   = trim($_GET['f_SalesAmount']);
		if (isset($_GET['d_LastUpdatedDate']))				$this->d_LastUpdatedDate = trim($_GET['d_LastUpdatedDate']);
		if (isset($_GET['returnUrl']))	        			$this->returnUrl         = urldecode($_GET['returnUrl']);				
		if (isset($_GET['cardId']))	        			    $this->cardId         = urldecode($_GET['cardId']);	
		if (isset($_GET['editcc']))	        			    $this->editcc         = urldecode($_GET['editcc']);	
	}
	
	///////////////// Functions to handel cart sessions ////////////////////////
	

	
	//////////////// Functions for fetching bank informations ////////////////
	
	function retrieveBankAmount() { // return bank info array

		

		$query	= " SELECT * FROM tbl_bopabank WHERE bi_MemberId=".$this->bi_MemberId;
			                 	
						
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveBankDetailsOfUserRow($dbQry);
	
	}
	
	/////// Function will return total bank balance of logined user
	
	function retrieveBankAmountofUser() {

		

		$query	= " SELECT * FROM tbl_bopabank WHERE bi_MemberId=".$this->bi_MemberId;
			                 	
						
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$bankArray =  $this->retrieveBankDetailsOfUserRow($dbQry);
	
		$bankBalance = $bankArray['f_DepositAmount'] + $bankArray['f_SalesAmount'];
		
		return $bankBalance;
	}
	

	function retrieveBankDetailsOfUserRow($dbQry){
	
	
	$row = $dbQry->getArray();
	
	return $row;

	  
	}	  
	//////////////// Functions for fetching bank informations  ends here////////////////
	
	/// Function to valuidate CCV//////
	
	function fn_ValidateCCV($ccv){
	
	$_SESSION["BPMESSAGE"] 	= "";	
	//print $ccv;
	//print "<br>";
	//print $this->CreditCardVer1;
		if($ccv <> $this->CreditCardVer1){
		$_SESSION["BPMESSAGE"] 	= "Your CCV number is wrong. Please check.";	
		}
		else{
		return 1;
		}
	
	}
	
	

	///////////// MAIN FUNCTION //////////////
			
	function postPayment() {	

		$this->setPostVars();
		$this->setGetVars();	
		
		
		if ($this->action == "CREDITCARD") {	// old card
			
			$clsbpCreditCard	= new clsbpCreditCard($this->connect, $includePath,"clsbpCreditCard");
			$clsbpCreditCard->retrieveCreditCardDetails($this->cardId);
	
			// function to validate CCV number of existing CC
			/*if($this->fn_ValidateCCV($clsbpCreditCard->i_CCV) <> 1){
			header("location: bpPayment.php");
			exit();			
			}*/
			
				
			
		}
		else if ($this->action == "BANK"){ // bank only
		
		$this->retrieveBankAmount(); 
		}
		
				
		
	}
}
?>
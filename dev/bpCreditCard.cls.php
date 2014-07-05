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
class clsbpCreditCard extends clsbpBase  { 
	var $bi_card_id;
	var $bi_MemberId;
	var $bi_card_num;
    var $bi_ord_id;	
	var $vc_card_type;
	var $optMonth;
	var $optYear;		
	var $dt_expiry;		
	var $i_CCV;
	var $vc_name_on_card;
	var $vc_first_nm;
	var $vc_last_nm;
	var $vc_addr;
	var $optbilling;
	var $vc_addrone;
	var $vc_addrtwo;	
	var $vc_city;		
	var $vc_state;
	var $vc_zipcode ;
	var $vc_country;
	var $temp ;
	var $i_isPrimary;
	
function clsbpCreditCard($connect, $includePath) {			
		$this->clsbpBase($connect, $includePath, "clsbpCreditCard");			
		$this->bi_card_id		= "";
		$this->bi_MemberId		= "";
		$this->bi_card_num		= "";		
		$this->bi_ord_id	= "";	
		$this->optDay			= "";
		$this->optMonth			= "";	
		$this->dt_expiry		= "";		
		$this->vc_card_type		= "";	
		$this->i_CCV	= "";
		$this->vc_name_on_card			= "";
		$this->vc_first_nm		= "";
		$this->vc_last_nm			= "";	
		$this->vc_addr			= "";
		$this->optbilling			= "";
		$this->vc_addrone			= "";
		$this->vc_addrtwo			= "";		
		$this->vc_city			= "";		
		$this->vc_state		= "";	
		$this->vc_zipcode  = "";	
		$this->vc_country		= "";
		$this->pageSize			= 10;
		$this->rangeVal			= constant("BPRANGEVAL")	;		
		$this->includePath		= $includePath;
		$this->i_isPrimary    = 0;
		$this->sortColumn		= "bi_card_id";
		$this->Primary		= "bi_card_id";
		$this->sortDirection    = "ASC";
		$this->temp 			= "";	
		$this->pageId 			= "";
		//$this->keyval 			= "asfasfgaep";
	}

function setPostVars() {	

		
		parent::setPostVars();	
	if (isset($_POST['clsbpCreditCard_bi_card_id']))	    $this->bi_card_id		 = trim($_POST['clsbpCreditCard_bi_card_id']);
	if (isset($_SESSION["USERID"]))		                    $this->bi_MemberId	    = trim($_SESSION["USERID"]	);
		if (isset($_POST['clsbpCreditCard_txtFname']))	    $this->vc_first_nm		 = trim($_POST['clsbpCreditCard_txtFname']);
		if (isset($_POST['clsbpCreditCard_txtLname']))   	$this->vc_last_nm		 	 = trim($_POST['clsbpCreditCard_txtLname']);
		
		if (isset($_POST['clsbpCreditCard_optCardType']))	$this->vc_card_type				 = trim($_POST['clsbpCreditCard_optCardType']);
		if (isset($_POST['clsbpCreditCard_txtCardNum']))		$this->bi_card_num			 = trim($_POST['clsbpCreditCard_txtCardNum']);
		if (isset($_POST['clsbpCreditCard_optMonth']))		$this->optMonth				 = trim($_POST['clsbpCreditCard_optMonth']);
		if (isset($_POST['clsbpCreditCard_optYear']))		$this->optYear				 = trim($_POST['clsbpCreditCard_optYear']);	
		
				
		if (isset($_POST['clsbpCreditCard_txtCreditCardVer'])) $this->i_CCV    	          = trim($_POST['clsbpCreditCard_txtCreditCardVer']);
		if (isset($_POST['clsbpCreditCard_txtCreditCardVer1'])) $this->i_CCV1   	          = trim($_POST['clsbpCreditCard_txtCreditCardVer1']);
		
		if (isset($_POST['clsbpCreditCard_txtAddres']))        $this->vc_addr    	      = trim($_POST['clsbpCreditCard_txtAddres']);
		if (isset($_POST['clsbpCreditCard_optnewbilling']))        $this->optbilling   	      = trim($_POST['clsbpCreditCard_optnewbilling']);
		if (isset($_POST['clsbpCreditCard_txtAddresone']))        $this->vc_addrone    	      = trim($_POST['clsbpCreditCard_txtAddresone']);
		if (isset($_POST['clsbpCreditCard_txtAddrestwo']))        $this->vc_addrtwo    	      = trim($_POST['clsbpCreditCard_txtAddrestwo']);
		if (isset($_POST['clsbpCreditCard_txtCity']))          $this->vc_city   	      = trim($_POST['clsbpCreditCard_txtCity']);
		if (isset($_POST['clsbpCreditCard_optState']))         $this->vc_state  	      = trim($_POST['clsbpCreditCard_optState']);
		if (isset($_POST['clsbpCreditCard_txtZipCode']))        $this->vc_zipcode 	      = trim($_POST['clsbpCreditCard_txtZipCode']);
		if (isset($_POST['clsbpCreditCard_txtCountry']))        $this->vc_country  	      = trim($_POST['clsbpCreditCard_txtCountry']);
if (isset($_POST['clsbpCreditCard_returnURL']))           $this->returnUrl  	        = trim($_POST['clsbpCreditCard_returnURL']);
if (isset($_POST['clsbpCreditCard_chkSavecard']))           $this->CreditCard_chkSavecard 	        = trim($_POST['clsbpCreditCard_chkSavecard']);


}

	function setGetVars() {

		parent::setGetVars();
		if (isset($_GET['clsbpCreditCard_bi_card_id']))
				$this->bi_card_id				= trim($_GET['clsbpCreditCard_bi_card_id']); 
		if (isset($_GET['bi_MemberId']))
				$this->bi_MemberId				= trim($_GET['bi_MemberId']);  	
		if (isset($_GET['clsbpCreditCard_bi_card_id']))
				$this->bi_card_id				= trim($_GET['clsbpCreditCard_bi_card_id']);  
		if (isset($_GET['clsbpCreditCard_txtFname']))
				$this->vc_first_nm				= trim($_GET['clsbpCreditCard_txtFname']);
		if (isset($_GET['clsbpCreditCard_txtLname']))
				$this->vc_last_nm			= trim($_GET['clsbpCreditCard_txtLname']);
		if (isset($_GET['clsbpCreditCard_optCardType']))
				$this->vc_card_type				= trim($_GET['clsbpCreditCard_optCardType']);
		if (isset($_GET['clsbpCreditCard_txtCardNum']))
				$this->bi_card_num				= trim($_GET['clsbpCreditCard_txtCardNum']);
		if (isset($_GET['clsbpCreditCard_optMonth']))
				$this->optMonth						= trim($_GET['clsbpCreditCard_optMonth']);		
		if (isset($_GET['clsbpCreditCard_optYear']))
				$this->optYear				= trim($_GET['clsbpCreditCard_optYear']);
		if (isset($_GET['clsbpCreditCard_txtCreditCardVer']))
				 $this->i_CCV				= trim($_GET['clsbpCreditCard_txtCreditCardVer']);
				 
		if (isset($_GET['clsbpCreditCard_txtCreditCardVer1']))
				 $this->i_CCV1				= trim($_GET['clsbpCreditCard_txtCreditCardVer1']);
				 		 
		if (isset($_GET['clsbpCreditCard_txtAddres']))
		    	 $this->vc_addr 			= trim($_GET['clsbpCreditCard_txtAddres']);
		if (isset($_GET['clsbpCreditCard_txtAddrestwo']))
		    	 $this->vc_addrtwo 			= trim($_GET['clsbpCreditCard_txtAddrestwo']);
		if (isset($_GET['clsbpCreditCard_txtCity']))
				 $this->vc_city 			= trim($_GET['clsbpCreditCard_txtCity']);
		if (isset($_GET['clsbpCreditCard_optState']))
				$this->vc_state  			= trim($_GET['clsbpCreditCard_optState']);
		if (isset($_GET['clsbpCreditCard_txtZipCode']))
				 $this->vc_zipcode			= trim($_GET['clsbpCreditCard_txtZipCode']);
		if (isset($_GET['clsbpCreditCard_txtCountry']))
				$this->vc_country  				= trim($_GET['clsbpCreditCard_txtCountry']);
		if (isset($_GET['clsbpCreditCard_optnewbilling']))
				$this->vc_country  				= trim($_GET['clsbpCreditCard_optnewbilling']);



}
	
function saveCreditCardDetails($id) { 

		
	$sess = 	$this->validate($this->bi_card_num, $this->optMonth, $this->optYear);
	//NIL $sess = 1; //NIL
	if (trim($id) ==  "") {
		
				
		if($sess != 1)	{
			$_SESSION['BPMESSAGE'] = "Invalid Cedit Card";
			return 0;
		}
		$txtExpiry				=	trim($this->optYear)."-".trim($this->optMonth)."-00";
		$this->d_DateofExpiry	= 		$txtExpiry;	
		//NIL echo $this->d_DateofExpiry;
		$this->memberid = $_SESSION['USERID'];
		$query = "select * from tbl_creditcard where bi_MemberId =$this->memberid";
		$dbQry					= 	new dbQuery($query, $this->connect->connId);
		$numrows =  $dbQry->numRows();

		$encryptval=encrypt($this->bi_card_num);
		
		if($numrows ==0) {
			$this->i_isPrimary=1;
		}
	
		if( $this->optbilling=="Enterold") {
			$query	= " INSERT INTO   
										tbl_creditcard
										(
											bi_MemberId,
											vc_first_nm,
											vc_last_nm,
											vc_card_type,
											bi_card_num,
											dt_expiry,
											i_CCV,
											i_isPrimary,
											vc_addr) 
									VALUES 
										(
											\"$this->memberid\",
											\"$this->vc_first_nm\",
											\"$this->vc_last_nm\",
											\"Visa\",
											\"$encryptval\",
											\"$this->d_DateofExpiry\",
											\"$this->i_CCV\" ,
											\"$this->i_isPrimary\",
											\"$this->vc_addr\"
											
										)";
			
				$dbQry					= 	new dbQuery($query, $this->connect->connId);	
				$this->bi_card_id		= 	$dbQry->lastInsertId();
		}
		
		if( $this->optbilling=="EnterNew") {
			$txtExpiry				=	trim($this->optYear)."-".trim($this->optMonth)."-00";
			$this->d_DateofExpiry	= 		$txtExpiry		;	
			
			$txtAddr = trim($this->vc_addrone).", ";
			
			if($this->vc_addrtwo!="") {
				$txtAddr  .= trim($this->vc_addrtwo).", ";
			}
			
			$txtAddr .=  trim($this->vc_city) .", ".trim($this->vc_state)  .", ".trim( $this->vc_zipcode).", "."United States"; 	    
			
	
			$this->txtAddress = $txtAddr ;
			$this->memberid  = $_SESSION['USERID'];
			$query =  " INSERT INTO   
									tbl_creditcard
									(
										bi_MemberId,
										vc_first_nm,
										vc_last_nm,
										vc_card_type,
										bi_card_num,
										dt_expiry,
										i_isPrimary,
										i_CCV,
									
									
									vc_addr)
									values
									(
									\"$this->memberid\",
									\"$this->vc_first_nm\",
										\"$this->vc_last_nm\",
										\"Visa\",
										\"$encryptval\",
										
										\"$this->d_DateofExpiry\",
										\"$this->i_isPrimary\",
										\"$this->i_CCV\",
									\"$this->txtAddress\" 
									)";
						
				$dbQry					= 	new dbQuery($query, $this->connect->connId);
				$this->bi_card_id		= 	$dbQry->lastInsertId();	
		
		}
	}								
				
	else {

		$txtAddr = trim($this->vc_addrone).", ";
		
		if($this->vc_addrtwo!="") {
			$txtAddr  .= trim($this->vc_addrtwo).", ";
		}
		
		$txtAddr .=  trim($this->vc_city) .", ".trim($this->vc_state)  .", ".trim( $this->vc_zipcode).", "."United States"; 	    
		
		$this->txtAddress = $txtAddr ;
			$txtExpiry				=	trim($this->optYear)."-".trim($this->optMonth)."-00";
			$this->d_DateofExpiry	= 		$txtExpiry		;	
		
		
		$query	= "	UPDATE 
					tbl_creditcard
					SET";
					
		if($this->d_DateofExpiry != "0-0-00") {
			$query .=" dt_expiry	=    \"$this->d_DateofExpiry\",";
		}
							
		$query .=" i_CCV	=\"$this->i_CCV\",
		vc_card_type  =\"Visa\"	";
			
		if($this->optbilling == "EnterOld") {
		
			$adderess =  $this->vc_addr;
		}
		
		else if($this->optbilling == "EnterNew") {
		
			$adderess = $this->txtAddress;
		}
		
		$query	.=" , vc_addr	=\"$adderess\"";
		$query	.=" WHERE 
				bi_card_id   = $id"; 		
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$this->bi_card_id		= $id;
			
	}
	return $this->bi_card_id;
}

function validatetbl_CreditCard_details() {


		$_SESSION["BPMESSAGE"] 	= "";	
		if (trim($this->vc_first_nm) == "") {
			$_SESSION["BPMESSAGE"] .= "* First Name cannot be null <BR>";
		}
		if (trim($this->vc_last_nm) == "") {
			$_SESSION["BPMESSAGE"] .= "* Last Name cannot be null <BR>";
		}
			
	
		if ( $this->optMonth == 0 || $this->optYear == 0 ) {
			$_SESSION["BPMESSAGE"] .= "* Invalid Date of Birth <BR>";
		}
		
		
	if (strlen($_SESSION["BPMESSAGE"]) > 0) {
			return 0;
		} else {
			return 1;
		}						
}

 function validate($number, $expiration_m, $expiration_ys) {

	 
	  $this->bi_card_num = ereg_replace('[^0-9]', '', $number);

       if (ereg('^4[0-9]{12}([0-9]{3})?$', $this->bi_card_num)) {

        $this->vc_card_type = 'Visa';

      } elseif (ereg('^5[1-5][0-9]{14}$', $this->bi_card_num)) {

        $this->vc_card_type = 'Master Card';

      }  else {

        return -1;

      }

 

      if (is_numeric($expiration_m) && ($expiration_m > 0) && ($expiration_m < 13)) {

        $this->optMonth = $expiration_m;

      } else {

        return -2;

      }

 
//echo $this->vc_card_type;

      $current_year = date('Y');

$expiration_y = substr($current_year, 0, 2) . $expiration_ys;
//print $expiration_y;
//print "<br>";
//print $current_year;
/*	echo $expiration_y. "<br>" .($current_year+10) ."<BR>";
	echo (($expiration_y <= ($current_year + 10)));*/
	//die((is_numeric($expiration_y) && ($expiration_y >= $current_year) && ($expiration_y <= ($current_year + 10))));
      if (!(is_numeric($expiration_y) && ($expiration_y >= $current_year) && ($expiration_ys <= ($current_year + 10)))) {
        return -3;

      }

 

      if ($expiration_y == $current_year) {

        if ($expiration_m < date('n')) {

          return -4;

        }

      }

 

      return $this->is_valid();

    }

 

    function is_valid() {

      $cardNumber = strrev($this->bi_card_num);

      $numSum = 0;

 $num = strlen($cardNumber );

      for ($i=0; $i < $num ; $i++)
	  {

       $currentNum = substr($cardNumber, $i, 1);

 

// Double every second digit

        if ($i % 2 == 1) {

          $currentNum *= 2;

        }

 

// Add digits of 2-digit numbers together

        if ($currentNum > 9) {

          $firstNum = $currentNum % 10;

          $secondNum = ($currentNum - $firstNum) / 10;

          $currentNum = $firstNum + $secondNum;

        }

 

        $numSum += $currentNum;

      }

 

// If the total has no remainder it's OK

      return ($numSum % 10 == 0);

    }


function retrieveCreditCardDetails($id) {

		if (trim($id) == "") return 0;

	$query	= " SELECT 
						* 
					FROM 
						tbl_creditcard
					WHERE 
						bi_card_id = $id";	
	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveCreditCardDetailsRow($dbQry);
		return $dbQry->numRows();
	}

function retrieveCreditCardDetailsRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row						= $dbQry->getArray();
		$this->bi_card_id			= $row["bi_card_id"];
		$this->bi_card_num		    = decrypt($row["bi_card_num"]);
		$this->vc_card_type			= $row["vc_card_type"];
		$this->d_DateofExpiry		= $row["dt_expiry"];
		$this->i_CCV		        = $row["i_CCV"];	
		$this->vc_first_nm				= $row["vc_first_nm"];		
		$this->vc_last_nm			= $row["vc_last_nm"];	
		$this->vc_addr		= $row["vc_addr"];		
		$this->vc_city			= $row["vc_city"];	
		$this->vc_state			= $row["vc_state"];	
		$this->vc_zipcode			= $row["vc_zipcode"];	
	    $this->vc_country			= $row["vc_country"];
		return 1;

	}

function getAddress() { 	
	$this->memberid = $_SESSION['USERID'];
		$query	= "SELECT vc_addr FROM tbl_creditcard where bi_MemberId= $this->memberid";		
		
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveAddressRowArray($dbQry);
	
}
function getNoofCards()

{
$this->memberid = $_SESSION['USERID'];
$query	= "SELECT * FROM tbl_creditcard where bi_MemberId= $this->memberid";		
$dbQry	= new dbQuery($query, $this->connect->connId);	
//die($dbQry->numRows());
return $this->retrieveCardRowArray($dbQry);
}
function retrieveAddressRowArray($dbQry) {	
		$arrAddressDeatils	= array();
		while($row= $dbQry->getArray()) {
		$arrAddressDeatils[$row["vc_addr"]]	= array(
					
					"vc_addr"  	=> $row["vc_addr"]);
			
			
		}	
			
		return $arrAddressDeatils;
	}
/* Get user's credit card info 
   Called on the payment page bpPayment.php
   	
---------------------------------------------*/

function getUserCards() { 	
	
		$query	= "SELECT bi_card_id,bi_card_num,dt_expiry,i_isPrimary,vc_card_type FROM tbl_creditcard where bi_MemberId= $this->memberid ORDER BY bi_ord_id DESC";		
		
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveCardRowArray($dbQry);
	
}
function retrieveCardRowArray($dbQry) {	
		$arrCardDeatils	= array();
		while($row= $dbQry->getArray()) {
		
		$dateArr = explode(" ",$row["dt_expiry"]);
		
		$year = substr($row['dt_expiry'],0,4);
		$month = substr($row['dt_expiry'],5,2);

		$expdate = $month."/".$year;

		 $expireDate = " Exp.".$expdate;
	
		$dateArr = $dateArr[0];
		$cCard = $row["vc_card_type"]."**************".substr(decrypt($row["bi_card_num"]), -4).$expireDate."&nbsp;&nbsp;&nbsp;";
		
		$arrCardDeatils[$row["bi_card_id"]]	= array(
					"bi_card_id"    => $row["bi_card_id"],
					"bi_card_num"  	=> $cCard,
					
					"i_isPrimary"  	=> $row["i_isPrimary"]
					);
			
			
		}	
			
		 return $arrCardDeatils;
	}

/*-------------------------------------------*/
	
	
	
	function getAddresssingle() { 	
		
		$query	= "SELECT vc_addr FROM tbl_creditcard where bi_card_id = $this->bi_card_id";		
		
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveAddressSingleRowArray($dbQry);
	
}
function retrieveAddressSingleRowArray($dbQry) {	
		$arrAddressDeatilss	= array();
		while($row= $dbQry->getArray()) {
		$arrAddressDeatilss[$row["vc_addr"]]	= array(
					
					"vc_addr"  	=> $row["vc_addr"]);
			
			
		}	
			
		return $arrAddressDeatilss;
	}
	function getCardTypes() { 	
		
		$query	= "SELECT vc_card_type FROM tbl_creditcard where bi_card_id = $this->bi_card_id";		
		
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveCardTypesRowArray($dbQry);
	
}
function retrieveCardTypesRowArray($dbQry) {	
		$arrCardDeatilss	= array();
		while($row= $dbQry->getArray()) {
		$arrCardDeatilss[$row["vc_card_type"]]	= array(
					
					"vc_card_type"  	=> $row["vc_card_type"]);
			
			
		}	
			
		return $arrCardDeatilss;
	}
function retrieveCreditCardDetailsArray() { 	
		
	$query	= " SELECT	
						*  
					FROM	
						tbl_creditcard WHERE  bi_MemberId=$this->bi_MemberId ";		
							
		if(trim($this->bi_card_id) != "") 
			$query	.=	" AND bi_card_id	=	".$this->bi_card_id;		
		if(trim($this->bi_card_num) != "") 
			$query	.=	" AND bi_card_num	=	".$this->bi_card_num;		
		if (trim($this->vc_card_type) != "") 
			$query	.= " AND vc_card_type LIKE '%".$this->vc_card_type."%'"; 
			
			 $query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 			
	
		
		
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveCreditCardDeatilsRowArray($this->clsbpPaginate);
}
function retrieveCreditCardDeatilsRowArray($dbQry) {	
		$arrdetails	= array();
		while($row= $dbQry->getArray()) {
			$arrdetails[$row["bi_card_id"]]	= array(
					"bi_card_id"		=> $row["bi_card_id"],
					"bi_card_num"  	=> decrypt($row["bi_card_num"]),
					"vc_card_type"		=> $row["vc_card_type"],
					"dt_expiry"		=> $row["dt_expiry"], 
					"vc_first_nm" 			=> $row["vc_first_nm"] ,
					"vc_last_nm"		=> $row["vc_last_nm"],
					"vc_addr"			=> $row["vc_addr"] ,
					"vc_city" 	        =>  $row["vc_city"],
					"i_isPrimary" 	    =>  $row["i_isPrimary"],
					"vc_state" 		=> $row["vc_state"],
				    "vc_zipcode" 		=> $row["vc_zipcode"],
					"vc_country" 		=> $row["vc_country"]);
					
					
					
		}			
		return $arrdetails;
	}
	function fn_DeleteCreditCard($id){
	
		$query	= " DELETE FROM tbl_creditcard " 
			 	 ."	WHERE bi_card_id=$id ";
		$dbQry	= new dbQuery($query, $this->connect->connId);
	
	}

	function postCreditCardDetails() {	
	    $this->setPostVars();
		$this->setGetVars();	
		
	
		


		if ($this->action == "SAVE") {
	
			
			if ($this->saveCreditCardDetails($this->bi_card_id)) {
			//if($this->returnUrl='bpOrderDetails.php'){
			
		//	$this->returnUrl =$this->returnUrl."&cardId=".$this->bi_card_id;
		
			//exit();
			//}
			if($this->returnUrl=='bpBopaBank.php'){
			$this->returnUrl= $this->returnUrl;
			}
			else{
			
			 $this->returnUrl= $this->returnUrl."&cardId=".$this->bi_card_id;
			 
			 }
			
			
			
				 header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();					
			}
		
		
		}
		if ($this->action == "SAVEYES") {
	
			
			if ($this->saveCreditCardDetails($this->bi_card_id)) {
			
			
				 header("location:".$this->includePath.stripslashes($this->returnUrl));
				exit();					
			}
		
		
		}
		else if ($this->action == "UPDATE") {				
			
			if($this->saveCreditCardDetails($this->bi_card_id) > 0)
			{
		
				header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();		
		}
		}
		else if ($this->action == "REMOVE") {				
			$this->fn_DeleteCreditCard($this->bi_card_id);
			header("location:".stripslashes($this->includePath.$this->returnUrl));				
			exit();
		}
		return $this->retrieveCreditCardDetails($this->bi_card_id);
	}
	
	
		/////////////////////////Encryption & decryption
	
		function encrypt($plain_text) 
		{
				$plain_text = trim($plain_text);
				
				//$key=$this->keyval;
				
				$iv = substr(md5($key), 0,mcrypt_get_iv_size (MCRYPT_CAST_256,MCRYPT_MODE_CFB));
		
				$c_t = mcrypt_cfb (MCRYPT_CAST_256, EDKEY, $plain_text, MCRYPT_ENCRYPT, $iv);
		
				return trim(chop(base64_encode($c_t)));
		}

		function decrypt($c_t) 
		{
				$c_t =  trim(chop(base64_decode($c_t)));
				
				//$key=$this->keyval;
				
				$iv = substr(md5($key), 0,mcrypt_get_iv_size (MCRYPT_CAST_256,MCRYPT_MODE_CFB));
		
				$p_t = mcrypt_cfb (MCRYPT_CAST_256, EDKEY, $c_t, MCRYPT_DECRYPT, $iv);
		
				return trim(chop($p_t));
		}

}
?>
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
class clsbpBopaCart extends clsbpBase  { 

	var $bi_FileId;		
	var $bi_MemberId;		
	var $FileIds;		
	

	function clsbpBopaCart($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpBopaCart");			
		
		$this->bi_FileId		= "";
		$this->bi_MemberId	        = "";		
		$this->FileIds	        = "";	
		$this->includePath		= $includePath;
		
		if(!session_start()){ session_start();}
		if(!session_is_registered('bopaBasket')){	session_register('bopaBasket');}
		
	}
    
	function setPostVars() {	

		parent::setPostVars();	
		if (isset($_POST['clsbpBopaCart_bi_FileId']))  $this->bi_FileId	 = trim($_POST['clsbpBopaCart_bi_FileId']);
		if (isset($_POST['clsbpBopaCart_bi_FileId']))  $this->bi_FileIds = trim($_POST['clsbpBopaCart_bi_FileId']);
		if ($_SESSION['USERID']!='')          	       $this->bi_MemberId= $_SESSION['USERID'];
		
	}

	function setGetVars() {

		parent::setGetVars();	

		if (isset($_GET['fileId']))		$this->bi_FileId  = trim($_GET['fileId']);
		if (isset($_GET['fileIds']))	$this->bi_FileIds = trim($_GET['fileIds']);
		if (isset($_GET['returnUrl']))	$this->returnUrl = urldecode($_GET['returnUrl']);				
		
	}
	
	///////////////// Functions to handel cart sessions ////////////////////////
	
	// function for resetting the array
	function fn_resetCartArray($cartArray)
	{
		$tempArray=array();
		if(sizeof($cartArray)>0)
		{
			foreach($cartArray as $key=>$value)
			{
				$tempArray[] = $value;
			}	
			return $tempArray;	
		}else
		{
			return $tempArray;
		}
	}	
	// add items to cart session
	function fn_addToCart() {
	
	    //create a session array... if one not exist already.....
		if(!is_array($_SESSION['bopaBasket']['song']))
		{
			$_SESSION['bopaBasket']['song']=array();	
		}
		
		$productArray = array();
		
		if($this->bi_FileIds){
		
		$productArray = explode(",",$this->bi_FileIds);
		}
		else{
		
		$productArray[0] = $this->bi_FileId;
		
		}
	
		
		foreach($productArray as $key=>$value){
		
		
			if(!in_array($value,$_SESSION['bopaBasket']['song']) ) // if a new item
		    {
			// add item to array
			$_SESSION['bopaBasket']['song'][] = $value;
			
			// function to lock file
		    $this->fn_LockUnlockFile(1,$value);
			
				// if user is logged in then  items selected will be added to the cart table
				if($this->bi_MemberId > 0 && $_SESSION['USERID'] > 0){
				
					$this->fn_InsertItemtoCartTable($value);
			
			   }		
		   }
		 
		}
		
	  return true;
			
	
	}
	

	
    // remove item from cart session
	function fn_removeItem() {
	
	    $productKey = $this->bi_FileId;

			if(in_array($productKey,$_SESSION['bopaBasket']['song']))
			{
				// fetch the key of corressponding element
				$keyArray = array_keys($_SESSION['bopaBasket']['song'],$productKey);
				$key = $keyArray[0];
				if(array_key_exists($key,$_SESSION['bopaBasket']['song']))
				{
					//unset the key
					unset($_SESSION['bopaBasket']['song'][$key]);
					$_SESSION['bopaBasket']['song'] = $this->fn_resetCartArray($_SESSION['bopaBasket']['song']);
					
					// function to unlockfile
					$this->fn_LockUnlockFile(0,$productKey);
					
					// if user is logged in then  items selected will be deleted from the cart table
					if($this->bi_MemberId > 0 && $_SESSION['USERID'] > 0){
						$this->fn_DeleteItemfromCartTable($productKey);
					}
					return true;		
				}
				
			}else
			{
				return false;
			}		
	   }
	///////////////// Functions to handel cart sessions ////////////////////////  
	   
	
	/////////////////////// CART Table functions //////////////////////////////////
	
	// function to add item to cart table [ CALL FROM FUNCTION - fn_addToCart() ] 
	// if already logined
	function fn_InsertItemtoCartTable($songId){
       $date =date("Y-m-d");
	
	 $query	= " INSERT INTO tbl_cart (bi_MemberId, bi_FileId, dt_CreatedDate) VALUES  ($this->bi_MemberId,$songId,'$date')";

	$dbQry	= 	new dbQuery($query, $this->connect->connId);
	
	}
	// if login at time of chekout
	function fn_InsertItemtoCartTableAfterLogin(){
	
	$cartItemArray = $_SESSION['bopaBasket']['song'];
	 $cartSize = count($_SESSION['bopaBasket']['song']);
	
	 for($i=1;$i<=$cartSize;$i++){
	 
	  $songId = $_SESSION['bopaBasket']['song'][$i-1];
	  $this->fn_InsertItemtoCartTable($songId);
	 }
	
	}
	
	// function to remove item from cart table [CALL FROM FUNCTION - fn_removeItem()]
	function fn_DeleteItemfromCartTable($songId){
	
		$query	= " DELETE FROM tbl_cart " 
			 	 ."	WHERE bi_MemberId=\"$this->bi_MemberId\" AND bi_FileId=$songId";
		$dbQry	= new dbQuery($query, $this->connect->connId);
	
	}
	
	/////////////////////// CART Table functions Ends here//////////////////////////////
	
	
	// function to create cart session after completing registration
	// this function is called from bpUserLogin.php (action = ACTIVATION)
	
	function fn_CreateCartSession($SongList){
	
		$sArray = array();
		$SongList = base64_decode($SongList);
		$sArray = explode(",",$SongList);
		
		
		foreach($sArray as $key=>$value){
				
				//if(!in_array($value,$_SESSION['bopaBasket']['song']) ) // if a new item
			//	{
					// add item to array
				//	$_SESSION['bopaBasket']['song'][] = $value;
		
				
						// if user is logged in then  items selected will be added to the cart table
						if($this->bi_MemberId > 0){
						
							$this->fn_InsertItemtoCartTable($value);
					
					    }
				//}  
		}
	
	
	
	
	}
	
	
	
	
	//////////////// Functions for LOCK and UN LOCK files /////////////////////////////
	
    // if $lock is 1 files will lock
	// if $lock is 0 files will unlock 
	function fn_LockUnlockFile($lock,$fId){
	
		// query to update file table
		
		
		 $query = "UPDATE 
								tbl_member_files 
							SET 
								ti_lock   = \"$lock\"
								
							WHERE 
								bi_FileID   = '$fId'";
	
		$dbQry	        = new dbQuery($query, $this->connect->connId);
	
	return ;
	}
	////////////////  LOCK and UN LOCK Ends Here /////////////////////////////
	
	//////////////// Functions for fetching song informations ////////////////
	// function to retrive owner details of a song 
	// called from ViewCarttmpl.php
	function retrieveOwner($ownerId) {

		

		 $query	= " SELECT vc_FirstName,vc_LastName FROM tbl_mem_details 
								 WHERE bi_MemberId=$ownerId";
				                 	
						
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveFileDetailsOfUserRow($dbQry);
	
	}
	
	// function to retrive details of a song 
	// called from ViewCarttmpl.php
	
	function retrieveFileDetailsOfUser($FileID) {

		

		 $query	= " SELECT * FROM tbl_mem_details t, 
		                         tbl_member_files tb
								 WHERE t.bi_MemberId=tb.bi_MemberId 
				                 AND bi_FileID = $FileID";	
						
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveFileDetailsOfUserRow($dbQry);
	
	}
	function retrieveFileDetailsOfUserRow($dbQry){
	
	
	$row = $dbQry->getArray();
	
	return $row;

	  
	}	  
	//////////////// Functions for fetching song informations  ends here////////////////
	
//////// ///////////////	
function retrieveCartItemsofUser($memberId) {

		

		 $query	= " SELECT * FROM tbl_cart " 
			 	 ."	WHERE bi_MemberId=\"$memberId\"";	
						
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$row= $this->retrieveCartItemsOfUserRow($dbQry);
	
		
	// assign cart items to session from cart table
	foreach($row as $value){
	
	
	
		if(!in_array($value,$_SESSION['bopaBasket']['song']) ) // if a new item
			{
				// add item to array
				$_SESSION['bopaBasket']['song'][] = $value[bi_FileId];
		  }
	
	}

	
	}
		function retrieveCartItemsOfUserRow($dbQry){
	
	
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_FileId"]]	= array(
													
												"bi_FileId"	        => $row["bi_FileId"],	
												"bi_MemberId"	    => $row["bi_MemberId"],
												);
		}			
		 return $arrFile;
		
	}	
	
///////////// //////////	
	///////////// MAIN FUNCTION //////////////
			
	function postCart() {	

		$this->setPostVars();
		$this->setGetVars();	
		
		
		if ($this->action == "ADDTOCART") {		
				if ($this->fn_addToCart()) {
			
				header("location:".stripslashes($this->includePath.$this->returnUrl));			
				exit();					
			}
		}
		else if ($this->action == "REMOVE") {				
			$this->fn_removeItem();
			header("location:".stripslashes($this->includePath.$this->returnUrl));				
			exit();
		}
		
		
	}
}
?>
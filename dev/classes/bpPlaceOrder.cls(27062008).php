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
class clsbpPlaceOrder extends clsbpBase  { 

	var $bi_bopabank_id;		
	var $bi_MemberId;		
	var $f_DepositAmount;		
	var $f_SalesAmount;
	var $d_LastUpdatedDate;
	var $vc_EmailID;
	var $orderNumber;
	var $bi_ord_id;
	var $paymentMethod;
	var $vc_bank_amount;
	var $vc_cc_amount;
	var $cardId; 
	var $serviceFloor;
	var $serviceCharge;
	var $transactionFee;
	
	function clsbpPlaceOrder($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpPlaceOrder");			
		
		$this->bi_bopabank_id		= "";
		$this->bi_MemberId	        = "";		
		$this->f_DepositAmount	    = "";
		$this->f_SalesAmount	    = "";	
		$this->d_LastUpdatedDate    = "";		
		$this->includePath		    = $includePath;
		$this->vc_EmailId	  ='';
		$this->bi_ord_id	  ='';
		$this->paymentMethod  ='';
		$this->vc_bank_amount ='';
		$this->vc_cc_amount   ='';
		$this->cardId         ='';
		$this->serviceFloor   ='';
		$this->serviceCharge  ='';
		$this->transactionFee ='';
	}
    
	function setPostVars() {	

		parent::setPostVars();	
		if (isset($_POST['clsbpPlaceOrder_bi_bopabank_id']))          $this->bi_bopabank_id    = trim($_POST['clsbpPlaceOrder_bi_bopabank_id']);
		if (isset($_POST['clsbpPlaceOrder_f_DepositAmount']))         $this->f_DepositAmount   = trim($_POST['clsbpPlaceOrder_f_DepositAmount']);
		if (isset($_POST['clsbpPlaceOrder_f_SalesAmount']))  		  $this->f_SalesAmount     = trim($_POST['clsbpPlaceOrder_f_SalesAmount']);
		if (isset($_POST['clsbpPlaceOrder_d_LastUpdatedDate']))  	  $this->d_LastUpdatedDate = trim($_POST['clsbpPlaceOrder_d_LastUpdatedDate']);
		if ($_SESSION['USERID']!='')          	                 	  $this->bi_MemberId       = $_SESSION['USERID'];
		
	}

	function setGetVars() {

		parent::setGetVars();	

		if (isset($_GET['clsbpPlaceOrder_bi_bopabank_id']))		$this->bi_bopabank_id    = trim($_GET['bi_bopabank_id']);
		if (isset($_GET['f_DepositAmount']))				    $this->bi_bopabank_ids   = trim($_GET['f_DepositAmount']);
		if (isset($_GET['f_SalesAmount']))				        $this->bi_bopabank_ids   = trim($_GET['f_SalesAmount']);
		if (isset($_GET['d_LastUpdatedDate']))				    $this->d_LastUpdatedDate = trim($_GET['d_LastUpdatedDate']);
		if (isset($_GET['returnUrl']))	        			    $this->returnUrl         = urldecode($_GET['returnUrl']);				
		if (isset($_GET['cardId']))	        			   		$this->cardId            = urldecode($_GET['cardId']);
	}
	
	///////////////// Functions to handel cart sessions ////////////////////////
	

	
	//////////////// Functions for fetching bank informations ////////////////
		function retrieveFileDetailsOfUser($FileID) {

		

		 /*$query	= " SELECT * FROM tbl_mem_details t, 
		                         tbl_bopabox tb
								 WHERE t.bi_MemberId=tb.bi_MemberId 
				                 AND tb.bi_file_id = $FileID";*/
								 
		$query = "SELECT t.bi_MemberId, t.vc_FirstName, t.vc_LastName,
		         tb.bi_file_id, tb.bi_FileTypeId,tb.i_tg_id, tb.bi_MemberId, tb.dbl_price,
				 id3.vc_title_nm_mod, id3.vc_artists_nm_mod, id3.vc_album_nm_mod
		         FROM tbl_mem_details t, tbl_bopabox tb, tbl_id3_tags id3
		         WHERE t.bi_MemberId = tb.bi_MemberId
		         AND tb.i_tg_id = id3.i_tg_id
		         AND tb.bi_file_id =$FileID";
								 	
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveFileDetailsOfUserRow($dbQry);
	
	}
	function retrieveMemDetails($user_id) {
	
	 $query	= " SELECT vc_DisplayName FROM tbl_mem_login 
				 WHERE 
			    bi_MemberId=$user_id";	
	$dbQry	= new dbQuery($query, $this->connect->connId);
		$row = $dbQry->getArray();
	
	return $row['vc_DisplayName'];
	}
	function retrieveFirstName($id){
		

		 $query	= " SELECT vc_FirstName FROM tbl_mem_details 
				 WHERE 
			    bi_MemberId=$id";	
						
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$row = $dbQry->getArray();
	
	return $row['vc_FirstName'];	
		
	
	}

	function retrieveFileDetailsOfUserRow($dbQry){
	
	
	$row = $dbQry->getArray();
	
	return $row;

	  
	}
	
	function fn_TransferAmount() { // transfer amount from bank only
	
		
		  $cartSize = count($_SESSION['bopaBasket']['song']);
	
				if($cartSize > 0 )
				{			
				
				   if(isset($_SESSION['bopaBasket']['song'])){
								   
								    // Group cart items based on file owner 
									for($i=1;$i<=$cartSize;$i++){
								   	
										$FileID = $_SESSION['bopaBasket']['song'][$i-1];
										$row1 = $this->retrieveFileDetailsOfUser($FileID);
										$cartarr[$i] = array('owner' =>$row1['bi_MemberId'] , 'product' =>$FileID, 'dbl_price' =>$row1['dbl_price']);
								
									}
										
									foreach ($cartarr as $key => $row) {
									$owner[$key]  = $row['owner'];
									$song[$key] = $row['dbl_price'];
									}
	
				
									array_multisort($owner, SORT_DESC, $song, SORT_DESC, $cartarr);
									// grouping ends here ($cartarr - grouped array)
	
									$own ="";
									$pr = array();
									$subTotalPrice=0;
								
									foreach($cartarr as $k =>$r){
									
												if($own<>$r['owner']){
												
													 $count =0;
													 $own = $r['owner'];
													 $price = 0;
													 
												}
												
												if($own==$r['owner']){
												
												
													$fileDetails = $this->retrieveFileDetailsOfUser($r['product']);
													$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);	
													//$price = $price +$fileDetails['dbl_price'];
													$price = $fileDetails['dbl_price'];
													
													  $songTitle  = $fileDetails['vc_title_nm_mod'];
													  $artistName = $fileDetails['vc_artists_nm_mod'];
													  $albumName  = $fileDetails['vc_album_nm_mod'];
													  
													//  print $price.$own."<br>" ;
													$this->fn_TransferBankAmounttoOwner($own,$price);
													$this->fn_transferBopaBox($r['product']); // changing file permission
													$this->fn_maintainHistory($r['product'], $r['owner'], $this->bi_MemberId,$fileDetails['dbl_price'],$songTitle,$artistName,$albumName); // add the value to the histroy table				 
												}
												$count++;
									}
	
		
	
							
				  
				   }
				 //  print $subTotalPrice;
				 $this->fn_DeductAmountfromUserBank($subTotalPrice);
				 $this->vc_bank_amount = $subTotalPrice;
				 $this->vc_cc_amount   = '';
				 $this->fn_OrderPayment();	
		
			  }
		
	}
	
	function fn_TransferAmountfromCreditcard(){ // transfer amount from credit card only
	
	
	
	  $cartSize = count($_SESSION['bopaBasket']['song']);

			if($cartSize > 0 ){			
			
			   if(isset($_SESSION['bopaBasket']['song'])){
					
							   for($i=1;$i<=$cartSize;$i++){
							   	
								$FileID = $_SESSION['bopaBasket']['song'][$i-1];
								$row1 = $this->retrieveFileDetailsOfUser($FileID);
								$cartarr[$i] = array('owner' =>$row1['bi_MemberId'] , 'product' =>$FileID, 'dbl_price' =>$row1['dbl_price']);
							
								
								}
									
								foreach ($cartarr as $key => $row) {
								$owner[$key]  = $row['owner'];
								$song[$key] = $row['dbl_price'];
								}

			
								array_multisort($owner, SORT_DESC, $song, SORT_DESC, $cartarr);


								$own ="";
								$pr = array();
								$subTotalPrice=0;
							
								foreach($cartarr as $k =>$r){
								
										if($own<>$r['owner']){
										
											 $count =0;
											 $own = $r['owner'];
											 $price = 0;
											 
										}
										
										if($own==$r['owner']){
										
										
										$fileDetails = $this->retrieveFileDetailsOfUser($r['product']);
										$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);	
										//$price = $price +$fileDetails['dbl_price']; OLD CODE
										$price = $fileDetails['dbl_price'];
										$songTitle  = $fileDetails['vc_title_nm_mod'];
										$artistName = $fileDetails['vc_artists_nm_mod'];
										$albumName  = $fileDetails['vc_album_nm_mod'];
										  
										//print  $price.$own.$r['product']."<br>" ;
										//exit();
										$this->fn_TransferBankAmounttoOwner($own,$price);
										$this->fn_transferBopaBox($r['product']); // changing file permission
										$this->fn_maintainHistory($r['product'], $r['owner'], $this->bi_MemberId,$fileDetails['dbl_price'],$songTitle,$artistName,$albumName); // add the value to the histroy table		 
										}
										$count++;
								}

	         	  }
				  
				 $this->vc_bank_amount ='';
				 
					 if($subTotalPrice < constant("serviceFloor")){
					 $subTotalPrice       = $subTotalPrice + constant("serviceCharge"); 
					 $this->serviceFloor  = constant("serviceFloor");
					 $this->serviceCharge = constant("serviceCharge");
					 }
					 // call a function to transfer amount from CC - future reference--
				 $this->vc_cc_amount = $subTotalPrice;
				 $this->fn_OrderPayment();	
	       }
}	

/* Transfer Amount from credit card and bank (if user does not have enough bank balance)*/
function fn_TransferAmountfromCreditcardAndBank(){

	
	  $cartSize = count($_SESSION['bopaBasket']['song']);

			if($cartSize > 0 )
			{			
			
			   if(isset($_SESSION['bopaBasket']['song'])){
					
							   for($i=1;$i<=$cartSize;$i++)
								{	
								$FileID = $_SESSION['bopaBasket']['song'][$i-1];
								$row1 = $this->retrieveFileDetailsOfUser($FileID);
								
								$cartarr[$i] = array('owner' =>$row1['bi_MemberId'] , 'product' =>$FileID, 'dbl_price' =>$row1['dbl_price']);
							
								
									}
									
							foreach ($cartarr as $key => $row) {
							$owner[$key]  = $row['owner'];
							$song[$key] = $row['dbl_price'];
						    }

			
							array_multisort($owner, SORT_DESC, $song, SORT_DESC, $cartarr);


							$own ="";
							$pr = array();
							$subTotalPrice=0;
							
								foreach($cartarr as $k =>$r){
								
								if($own<>$r['owner']){
								
								     $count =0;
									 $own = $r['owner'];
									 $price = 0;
									 
								}
									
									if($own==$r['owner']){
									
									
									$fileDetails = $this->retrieveFileDetailsOfUser($r['product']);
									$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);	
									//$price = $price +$fileDetails['dbl_price'];
									
									$price = $fileDetails['dbl_price'];
									$songTitle  = $fileDetails['vc_title_nm_mod'];
									$artistName = $fileDetails['vc_artists_nm_mod'];
									$albumName  = $fileDetails['vc_album_nm_mod']; 
									//  print $price.$own."<br>" ;
									$this->fn_TransferBankAmounttoOwner($own,$price);
									$this->fn_transferBopaBox($r['product']); // changing file permission
									$this->fn_maintainHistory($r['product'], $r['owner'], $this->bi_MemberId,$fileDetails['dbl_price'],$songTitle,$artistName,$albumName); // add the value to the histroy table				 
									}
											  $count++;
								}

	

						
			  
	           }
			 //  print $subTotalPrice;
			 $clsbpPayment	= new clsbpPayment($this->connect, $includePath,"clsbpPayment");
			 $clsbpPayment->bi_MemberId = $this->bi_MemberId ;
			 $userbankAmount =  $clsbpPayment->retrieveBankAmountofUser(); // user bank amount
			
			     $this->fn_DeductAmountfromUserBank($userbankAmount); // deduct the remaining balance from the user bank account (if user choose the bank and CC )
			 
				 $this->vc_bank_amount = $userbankAmount; // take remaining bank balance of the user
				 $ccAmt                = $subTotalPrice - $userbankAmount; // remaining amount that has to be capture from CC Account
				 
				  /* Service charge calculation */
				 
				  if($subTotalPrice < constant("serviceFloor")){ // if subtotal price is less than service floor add searvice charge to CC amount
				  
					 $ccAmt               = $ccAmt + constant("serviceCharge"); 
					 $this->serviceFloor  = constant("serviceFloor");
					 $this->serviceCharge = constant("serviceCharge");
					 
				  }
					 
				 /*Service charge calc end here*/
				 
				// Call a function to retrive amount from users CC account -- future ref ($ccAmt)
				 
				 $this->vc_cc_amount   = $ccAmt;
				 $this->vc_bank_amount = $userbankAmount;
				 $this->fn_OrderPayment();
	
		  }


}


//--------------------------------------------------------------------------	
	
 function fn_TransferBankAmounttoOwner($owner,$amount){
 
 	//$reduceTransactionFee = 1.00-constant("transactionFee");
 	//$amount               = $amount * $reduceTransactionFee;
	$bopabooAmount = $amount * constant("transactionFee"); // commission for bopaboo (file amount * transactionn fee)

    $amount = $amount-$bopabooAmount; // owner amount (file amount- bopaboo commission)
	
	$arrBank = $this->retrieveBankAmountOwner($owner);
	 $arrBank['f_SalesAmount'];
	 	 $salesAmount = $arrBank['f_SalesAmount'] + $amount;

	  $query	= "	UPDATE tbl_bopabank SET  f_SalesAmount=$salesAmount,d_LastUpdatedDate=Now() WHERE bi_MemberId   = $owner";
							
	$dbQry	= new dbQuery($query, $this->connect->connId);
 
 }
 
/* function fn_DeductAmountfromUserBank($subTotalPrice){
 
    $clsbpPayment	= new clsbpPayment($this->connect, $this->includePath,"clsbpPayment");
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();
	
 	 $amount = $arrBank['f_DepositAmount'] -  $subTotalPrice;
	
	 $query	= "	UPDATE tbl_bopabank SET  f_DepositAmount=$amount ,d_LastUpdatedDate=Now() WHERE bi_MemberId=$this->bi_MemberId";
								
	$dbQry	= new dbQuery($query, $this->connect->connId);
 } */
 
  function fn_DeductAmountfromUserBank($subTotalPrice){
 
    $clsbpPayment	= new clsbpPayment($this->connect, $this->includePath,"clsbpPayment");
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();
	
 	 
	 
	   if($subTotalPrice > $arrBank['f_DepositAmount']){ // if purchase amount greater than deposit amount we have to reduce the amount from the sales amount coloum
		   
		  
		   $amountdiff =  $subTotalPrice - $arrBank['f_DepositAmount'];
		 
		 
		   $deductSalesAmt   = $amountdiff; // amount to be reduced
		   $deductSalesdeducted = $arrBank['f_SalesAmount'] - $deductSalesAmt; // reduce amount from database value
		   
		   $deductDepositAmt = $subTotalPrice - $amountdiff; // amount to be reduced
		   $deductDepositdeducted = $arrBank['f_DepositAmount'] - $deductDepositAmt;  // reduce amount from database value
		   
		   $query	= "	UPDATE tbl_bopabank SET  f_DepositAmount=$deductDepositdeducted ,f_SalesAmount=$deductSalesdeducted, d_LastUpdatedDate=Now() WHERE bi_MemberId=$this->bi_MemberId";
	   }
	   else{ // if there is enough money in deposit amt then purchase amount is reduced from the deposit amount
	   
	   	  $amount = $arrBank['f_DepositAmount'] -  $subTotalPrice;
		  $query	= "	UPDATE tbl_bopabank SET  f_DepositAmount=$amount ,d_LastUpdatedDate=Now() WHERE bi_MemberId=$this->bi_MemberId";
		 
	   }
	   						
     $dbQry	= new dbQuery($query, $this->connect->connId);
 }

function fn_transferBopaBox($songId){
 	$query = "SELECT f_DefaultSellPrice FROM tbl_member_preferences_notifications WHERE bi_MemberId=$this->bi_MemberId";
	
	$dbQry	= new dbQuery($query, $this->connect->connId);
	
	$row = $dbQry->getArray();
	
	$price = $row['f_DefaultSellPrice'];
 if($price !="")
 {
 
    $query	= "	UPDATE tbl_bopabox SET  bi_MemberId=$this->bi_MemberId, dbl_price =".$price.",i_in_sell ='0',ti_lock='0' WHERE bi_file_id=$songId";
}
else
{
    $query	= " UPDATE tbl_bopabox SET  bi_MemberId=$this->bi_MemberId, dbl_price =".BPDEFAULTSONGPRICE.",i_in_sell ='0',ti_lock='0' WHERE bi_file_id=$songId";
}
								
	$dbQry	= new dbQuery($query, $this->connect->connId);
	
	 $query	= "	DELETE FROM tbl_cart WHERE bi_MemberId=$this->bi_MemberId AND bi_FileID=$songId";
								
	$dbQry	= new dbQuery($query, $this->connect->connId);

	
 }
 
 
 /**
 *	This function updates the tbl_File_History when a buying process occures.
 *	@Name: fn_mantainHistory
 *	@date: 21-04-2008
 *	@author: BL Bopaboo
 *	@version: v1.0
 *	@param: fileId = > Id of the file current file
 *	@param: sellerId = > Id of the seller for file current file
 *	@param: buyerId = > Id of the buyer for file current file
 *	@return: nil
 */
 function fn_maintainHistory($fileId, $sellerId, $buyerId,$filePrice,$songTitle,$artistName,$albumName) {
 	
 	$query	= "
 				INSERT INTO 
 					tbl_file_history (
					    bi_ord_id,
 						bi_SellerId,
 						bi_BuyerId,
 						bi_FileId,
						vc_filePrice,
 						vc_title,
						vc_artists,
						vc_album,
						dt_insertedDate
 					)
 				VALUES
 					(
 						$this->bi_ord_id,
						$sellerId,
 						$buyerId,
 						$fileId,
						$filePrice,
						\"$songTitle\",
						\"$artistName\",
						\"$albumName\",
 						now()
 					)
 			    	";
					
 	$dbQry	= new dbQuery($query, $this->connect->connId);
 }
 /*--------------------------------------------------------*/
  /**
 *	This function updates the tbl_mem_order when a buying process occures.
 *	@Name: fn_OrderMaster
 *	@date: 08-06-2008
 *	@author: BL Bopaboo
 *	@version: v1.0
  *	@return: bi_ord_id (last inserted primary key)
 */
 function fn_OrderMaster() {
 	
 	$query	= "INSERT INTO 
 					tbl_mem_order (
 						vc_ord_number,
 						ord_date,
						vc_payment_method
 						
 					)
 				VALUES
 					(
 						\"$this->orderNumber\",
 						NOW(),
						\"$this->paymentMethod\"
						
 					)
 			    	";
					
 	$dbQry	= new dbQuery($query, $this->connect->connId);
	$this->bi_ord_id	= $dbQry->lastInsertId();
	
	return $this->bi_ord_id;
 }
 /*----------------------------------------------------------------*/
   /**
 *	This function updates the tbl_ord_payment when a buying process occures.
 *	@Name: fn_OrderPayment
 *	@date: 08-06-2008
 *	@author: BL Bopaboo
 *	@version: v1.0
  *	@return: nill
 */
 function fn_OrderPayment() {
 	
 	$query	= "INSERT INTO 
 					tbl_ord_payment (
 						bi_ord_id,
 						vc_bank_amount,
						vc_cc_amount,
						bi_creditcard_id
 						
 					)
 				VALUES
 					(
 						\"$this->bi_ord_id\",
 						\"$this->vc_bank_amount\",
						\"$this->vc_cc_amount\",
						\"$this->cardId\"
 					)
 			    	";
 	$dbQry	= new dbQuery($query, $this->connect->connId);
	
 }
 /*----------------------------------------------------------------*/
   /**
 *	This function updates the tbl_mem_order after payment process occures. Updates the current bank amount of user
 *	@Name: fn_UpdateOrderMaster
 *	@date: 08-06-2008
 *	@author: BL Bopaboo
 *	@version: v1.0
  *	@return: nil
 */
 function fn_UpdateOrderMaster() {
 	
	
	$bankArr 		= $this->retrieveBankAmountOwner($this->bi_MemberId);
	$currentBalance = $bankArr['f_SalesAmount']+$bankArr['f_DepositAmount'];
	$this->transactionFee = constant("transactionFee");
 	 $query	= "UPDATE 
							tbl_mem_order 
						SET 
							vc_bopabank_balance = \"$currentBalance\",
							f_serviceFloor =\"$this->serviceFloor\",
						    f_serviceCharge =\"$this->serviceCharge\",
							f_transactionFee =\"$this->transactionFee\"
							
						WHERE
							bi_ord_id =  \"$this->bi_ord_id \"
 			    	";
					
 	$dbQry	= new dbQuery($query, $this->connect->connId);
	
	
	
 }
 /*----------------------------------------------------------------*/
/*
Owner bank details
*/
	function retrieveBankAmountOwner($own) {

		

		$query	= " SELECT * FROM tbl_bopabank WHERE bi_MemberId=".$own;
			                 	
						
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveBankDetailsOfOwnerRow($dbQry);
	
	}
	

	function retrieveEmailId($id) {

		

		$query	= " SELECT * FROM tbl_mem_login WHERE bi_MemberId =".$id;
								
		$dbQry	= new dbQuery($query, $this->connect->connId);	

		$row = $dbQry->getArray();
	
		return $row['vc_EmailId'];
		}	

	function retrieveBankDetailsOfOwnerRow($dbQry){
	
	
	$row = $dbQry->getArray();
	
	return $row;

	  
	}


	function  fn_clearCart(){
	
	session_unregister('bopaBasket');
	
	}
	
	function fn_SendMailtoSeller($orderId){
	
		$query = "SELECT bi_HistoryId,bi_SellerId  FROM tbl_file_history
		         WHERE bi_ord_id=$orderId  group by bi_SellerId order by `bi_SellerId` ";

	    $dbQry	= new dbQuery($query, $this->connect->connId);	
		
		
		$sellerArray = $this->retrieveSellers($dbQry);
	
		foreach($sellerArray as $seller){
	
				$sellerId = $seller[bi_SellerId];
		
				$querySeller = "SELECT history.bi_FileId,history.vc_title,history.vc_artists,
				history.vc_album,history.vc_filePrice,history.bi_BuyerId,history.bi_SellerId,
				memorder.vc_ord_number,memorder.bi_ord_id,memorder.f_transactionFee
			    FROM tbl_file_history history, tbl_mem_order  memorder
		        WHERE history.bi_ord_id=$orderId  AND history.bi_SellerId=$sellerId
				AND  memorder.bi_ord_id=$orderId ORDER BY history.bi_SellerId";
	
				 $dbQry	= new dbQuery($querySeller, $this->connect->connId);	
				 $sellerFileArray = $this->retrieveSellersFiles($dbQry);
			 	//print_r($sellerFileArray );
				
				 $sellart="";
				 $total =0;
				
					 foreach ($sellerFileArray as $sell){
					 
					 $buyerName =$this->retrieveMemDetails($sell["bi_BuyerId"]);
					 $sellart .= ". Buyer:&nbsp;&nbsp;".$buyerName."<br>. Item:&nbsp;&nbsp;<b>".$sell["vc_title"]."</b> by ".$sell["vc_artists"]." from the album - ".$sell["vc_album"]."<br>. Price:&nbsp;&nbsp;$".$sell["vc_filePrice"]."";
					 
					 $total = $total + $sell["vc_filePrice"];
					 }
					 
				 $sellerName =$this->retrieveMemDetails($sell["bi_SellerId"]);
				 $messageBody = "Dear ".$sellerName.",<br>Thank you for using bopaboo to sell your unwanted digital music. We are pleased to inform you that you have sold some of your unwanted tunes and the items listed below have been transferred from your bopaBox to their new owners. You now must delete your original copies of these items from your computer, mp3 player, or any other device where you may have stored a copy.  Failing to do so violates bopaboo's Terms of Use and may subject you to civil and criminal liability for copyright infringement. You may view the details of this transaction anytime in the future by referencing order number <a href='bpAccountActivity.php'>".$sell["vc_ord_number"]."</a> in your bopaBank.<br><div style='padding-left:40px;'><b><u>Order Summary</u></b><br>";
			
				$sellart = $sellart."<br>Total Sale:&nbsp;&nbsp;$".$total."<br>";
				$Charge = number_format($total * $sell["f_transactionFee"],2);
				$sellart = $sellart."Our Fee:&nbsp;&nbsp;$".$Charge."<br>"; 
				$YourShare = $total-$Charge;
				$sellart = $sellart."Your Share:&nbsp;&nbsp;$".$YourShare."<br>"; 
			
				$sellart = "".$sellart."Your share has been deposited in your bopaBank.  You are now free to spend this money purchasing new music on bopaboo.  With thousands of new items uploaded daily, you're sure to find the right track to fit your mood!<br><br>Thank you again for choosing bopaboo!</div>";
			
			
			  	$messageBody .=$sellart;
				$strSubject   = "Order Summary";
				$dtSentDate     = date('Y-m-d H:i:s');
				$nMessageFromId = $sell["bi_BuyerId"];
				$nMessageToId   = $sell["bi_SellerId"];
				$messageBody = addslashes($messageBody);
		 $query = "INSERT INTO
						tbl_messages
					 VALUES
					 	('',$nMessageFromId,
					 	$nMessageToId,
					 	'$strSubject',
					 	'$messageBody',
					 	'$dtSentDate',
					 	0,
					 	0,
					 	0
					 	)
					";
					
			$dbQry	= new dbQuery($query, $this->connect->connId);
			
		}
	
	}
	
	function retrieveSellersFiles($dbQry)
	{
	
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_FileId"]]	= array(
													
												"vc_ord_number"	   	=> $row["vc_ord_number"],
												"vc_title"	   		=> $row["vc_title"],
												"vc_artists"	   	=> $row["vc_artists"],
												"vc_album"	   	=> $row["vc_album"],
												"vc_filePrice"	   	=> $row["vc_filePrice"],
												"bi_BuyerId"	   	=> $row["bi_BuyerId"],
												"bi_SellerId"	   	=> $row["bi_SellerId"],
												"f_transactionFee"	   	=> $row["f_transactionFee"]
											);
											
											
											
		}			
		return $arrFile; 
	}
	
	function retrieveSellers($dbQry)
	{
	
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_SellerId"]]	= array(
													
												"bi_SellerId"	   		=> $row["bi_SellerId"]
											);
											
											
											
		}			
		return $arrFile; 
	}	
	//////////////// Functions for fetching bank informations  ends here////////////////
	

	///////////// MAIN FUNCTION //////////////
			
	function postPlaceOrder() {	

		$this->setPostVars();
		$this->setGetVars();	
		$this->assignCart();
		$this->orderNumber=date("mdy").rand(10000000,999999999);
		
		if ($this->action == "CREDITCARD") {	
			
		$this->fn_TransferAmountfromCreditcard();		
		$this->sendMailToBuyer();
		$this->fn_clearCart();
							
			
		}
		else if ($this->action == "YES"){ // bank only
		
		$this->paymentMethod = "BANK";		
		$this->fn_OrderMaster();
		$this->sendMailToBuyer();
		$this->fn_TransferAmount();
		$this->fn_UpdateOrderMaster();
		$this->fn_SendMailtoSeller($this->bi_ord_id);  // send internal message to seller
		$this->fn_clearCart();
	
		}
		else if ($this->action == "NEWCARD"){ // credit card only (new card)
		$this->paymentMethod = "CC";
		$this->fn_OrderMaster();
		$this->sendMailToBuyer();
		$this->fn_TransferAmountfromCreditcard(); 
		$this->fn_UpdateOrderMaster();
		$this->fn_SendMailtoSeller($this->bi_ord_id);  // send internal message to seller
		$this->fn_clearCart();
		}
		else if ($this->action == "OLDCARD"){ // credit card only (exsiting card)
		$this->paymentMethod = "CC";
		$this->fn_OrderMaster();
		$this->sendMailToBuyer();
		$this->fn_TransferAmountfromCreditcard(); 
		$this->fn_UpdateOrderMaster();
		$this->fn_SendMailtoSeller($this->bi_ord_id);  // send internal message to seller
		$this->fn_clearCart();
		}
		else if ($this->action == "OLDCARDYES"){ // old card and bank 
		$this->paymentMethod = "CCBANK";
		$this->fn_OrderMaster();
		$this->sendMailToBuyer();
		$this->fn_TransferAmountfromCreditcardAndBank(); 
		$this->fn_UpdateOrderMaster();
		$this->fn_SendMailtoSeller($this->bi_ord_id);  // send internal message to seller
		$this->fn_clearCart();
		}
		else if ($this->action == "NEWCARDYES"){ // new card and bank
		$this->paymentMethod = "CCBANK";
		$this->fn_OrderMaster();
		$this->sendMailToBuyer();
		$this->fn_TransferAmountfromCreditcardAndBank(); 
		$this->fn_UpdateOrderMaster();
		$this->fn_SendMailtoSeller($this->bi_ord_id);  // send internal message to seller
		$this->fn_clearCart();
		
		}
				
			
	}

	function sendMailToBuyer(){		
			
			$clsbpBopaCart	= new clsbpBopaCart($this->connect, $this->includePath,"clsbpBopaCart");
			$own ="";
			$pr = array();
			$subTotalPrice=0;	
		   foreach($this->cartArray as $k =>$r){
				$_SESSION[$r['product']]=$r;
				$count =0;
				$own = $r['owner'];
		
				$ownerInfo = $clsbpBopaCart->retrieveOwner($own);
				$fileDetails = $clsbpBopaCart->retrieveFileDetailsOfUser($r['product']);
				$slist.='<div class="ordersummarybox" style="float:left; width:531px; margin:0 auto; padding:15px 28px 10px 35px; border-bottom:1px solid #ccc;">
							<ul style="list-style:none; font:11px/18px Verdana, Arial, Helvetica, sans-serif; color:#666; float:left; width:100%; margin:0 auto; padding:0;">
							<li>Seller:'.$ownerInfo['vc_DisplayName'].'</li>
							<li>Item: '. stripslashes($fileDetails['vc_title_nm_mod']).','.stripslashes($fileDetails['vc_artists_nm_mod']).','.stripslashes($fileDetails['vc_album_nm_mod']).'</li>
							<li>Price: $'.number_format($fileDetails['dbl_price'],2).'</li>
							</ul>
							</div>';
	
				$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);
	
			$count++;
	
			}
	
			$slist.='<div class="total" style="float:left; width:531px; margin:0 auto; padding:15px 28px 10px 35px; font:bold 11px/18px Verdana, Arial, Helvetica, sans-serif;">Total Order:$'.number_format($subTotalPrice,2).'</div>';
	
	
	
			$clsbpEmailTemplate 			= new clsbpEmailTemplate($this->connect,$this->includePath);
				
			$emailTo				= $this->retrieveEmailId($_SESSION['USERID']);
		
			$clsbpEmailTemplate->sendSubject        = 'bopaboo Order Confirmation';
		
			$clsbpEmailTemplate->additionalField1 	= $this->retrieveFirstName($_SESSION['USERID']);
			$clsbpEmailTemplate->additionalField2 	= $slist;
			$clsbpEmailTemplate->additionalField3 	= HTTP;
			$clsbpEmailTemplate->additionalField4 	= $this->orderNumber;
			
			$sendStatus				= $clsbpEmailTemplate->send('ORDERCONFIRMATION',$emailTo,1);	
		
	}
	function assignCart(){
	
				$cartSize = count($_SESSION['bopaBasket']['song']);
	
				if($cartSize > 0 )
				{			
				
				   if(isset($_SESSION['bopaBasket']['song'])){
				
							for($i=1;$i<=$cartSize;$i++){	
								$FileID = $_SESSION['bopaBasket']['song'][$i-1];
								$row1 = $this->retrieveFileDetailsOfUser($FileID);
								
					$cartarr[$i] = array('owner' =>$row1['bi_MemberId'] , 'product' =>$FileID, 'dbl_price' =>$row1['dbl_price']);	
							}
									
							foreach ($cartarr as $key => $row) {
								$owner[$key]  = $row['owner'];
								$song[$key] = $row['dbl_price'];
						
							}
	
							array_multisort($owner, SORT_DESC, $song, SORT_DESC, $cartarr);
				}
	
	
			$this->cartArray=$cartarr;
			}
	}



}
?>
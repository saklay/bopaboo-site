<?php
ob_start();
header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php");

include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpBopaCart.cls.php");
//error_reporting(E_ALL);
include_once($includePath."classes/bpBopaBank.cls.php");
include_once($includePath."classes/bpPayment.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpCreditCard.cls.php");
include_once($includePath."classes/bpPayment.cls.php");


$clsbpPayment	= new clsbpPayment($connect, $includePath,"clsbpPayment");
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();
	$clsbpBopaBank	= new clsbpBopaBank($connect, $includePath,"clsbpBopaBank");
		

		
		
	$clsbpBopaBank->setPostVars();
	$clsbpBopaBank->setGetVars();
	$tgName = $_GET['tabName']; 
	 
	/*----------------- For transaction Tab ------------------------*/
	  $optionVal =$_GET['optionVal']; 
	  $optionVal0 =$_GET['optionVal0']; 
	  
		 if($optionVal==1) { // All Transaction Types
		 $arrfileDetails = $clsbpBopaBank->retrieveAllOrderArray(); 
		 }
		 if($optionVal==2) { // All Paid Transactions
		 $arrfileDetails = $clsbpBopaBank->retrievePaidArray(); 
		 }
		 if($optionVal==3) { //All Received Transactions
		 $arrfileDetails = $clsbpBopaBank->retrieveReceivedArray(); 
		 }
		 if($optionVal==4) { //All Withdrawal Transactions
		 $arrfileDetails = $clsbpBopaBank->retrieveWithdrawalArray(); 
		 // print_r($arrfileDetails );
		
		 }
		 
		// print_r(get_object_vars($clsbpBopaBank));
	/*----------------- end oftransaction Tab ------------------------*/	
	/*print "<pre>";
	print_r( $arrfileDetails);*/
	
	 
?>	
       
   
          <?php if($optionVal!=4)
		  {
		 if($_REQUEST['sortColumn'] == "vc_EmailId" || $_REQUEST['sortColumn'] =="f_WithdrawalAmount" ||  $_REQUEST['sortColumn'] =="f_BopabankBalance" || $_REQUEST['sortColumn'] =="d_withdrawalDate")
		  
		  {
		  $_REQUEST['sortColumn'] = "ord_date";
		  
		  }
		  
		  
		  ?>
      
               	<table width="912" border="0" cellpadding="0" cellspacing="0" id="datacell">
                          <tr>
                        
                            <th width="175"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','ord_date','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php  if($_REQUEST['sortColumn'] =='ord_date' || $_REQUEST['sortColumn']==''){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";} }?>>Date</a></th>
                            <th width="102"><a href="#"   <?php if($_REQUEST['sortColumn'] =='type'){ if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>>Type</a></th>
                            <th width="189"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','vc_ord_number','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php  if($_REQUEST['sortColumn'] =='vc_ord_number'){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>>Order Number</a></th>
                            <th width="129"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','count','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php if($_REQUEST['sortColumn'] =='count'){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>># of Items</a></th>
                            <th width="118"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','sum','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php if($_REQUEST['sortColumn'] =='sum'){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>>Amount</a></th>
                      <th width="195"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','vc_bopabank_balance','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php if($_REQUEST['sortColumn'] =='vc_bopabank_balance'){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>>bopaBank Balance</a></th>
                          </tr>
                           <?php 
				 // error_reporting(E_ALL);
	$type="";
	 $extraParameters	= "pageSize=".$clsbpBopaBank->pageSize."&submitted=".$clsbpBopaBank->submitted."&optionVal=".$optionVal."&sortDirection=".$clsbpBopaBank->sortDirection."&sortColumn=".$clsbpBopaBank->sortColumn;
		 $recordNumber	= $clsbpBopaBank->clsbpPaginate->recordNumberOffset; 

				foreach($arrfileDetails as $row) { 
				
				if($row[bi_SellerId]==$clsbpBopaBank->bi_MemberId){
				$type= "Received";
				
				}
				if($row[bi_BuyerId]==$clsbpBopaBank->bi_MemberId){
				$type= "Paid";
				
				}
				
				
				if($type=='Received')
				$displayId = $row[bi_BuyerId];
				else
				$displayId = $row[bi_SellerId];
		
				
				
				
							 //  $orderDetailsArray = $clsbpBopaBank->fn_OrderDetails($row[bi_ord_id]);
							 
				
				?> 
                          <tr id="tr_<?php echo $recordNumber; ?>" height="" class="trHover">
                            <td align="right"  class="spacingRight"><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php
							echo date ("F j, Y",strtotime($row['ord_date']));
							?></a></td>
                            <td align="center"><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php echo $type; ?></a></td>
                            <td align="center" ><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php echo $row['vc_ord_number'];?></a></td>
                            <td align="center" ><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php echo $row['count']; ?></a></td>
                             <td align="center"><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" >                             <?php 
							  if($type=='Received'){ 
							  $Charge = number_format($row['sum'] * constant("transactionFee"),2);
							  $yShare = $row['sum'] - $Charge;
							  echo "$".number_format($yShare,2);
							  }
							  if($type=='Paid'){ 
                              echo "$".number_format($row['sum'],2); 
							  }
                             ?></a>
                             </td>
                      <td align="right" class="amtspace"><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php if($type=='Received'){ print "$".number_format($clsbpPayment->retrieveBankAmountofUser(),2) ; }  if($type=='Paid'){ echo "$".number_format($row['vc_bopabank_balance'],2); } ?></a></td>
                          </tr>
                          <tr id="showHideDetails<?php echo $recordNumber; ?>" style="display:none;">
                            <td align="right" colspan="6"><table width="860" border="0" cellspacing="0" cellpadding="0" class="accountDetails" align="right">
                              <thead>
                                <tr>
                                  <th width="20" class="close"><a href="#" ><img onclick="javascript: fn_HideOrderDetails(<?php echo $recordNumber; ?>);" src="images/btn-close3.jpg" alt="close" width="20" height="23" border="0" /></a></th>
                                  <th width="310">Display Name</th>
                                  <th width="334">Song Title</th>
                                  <th width="196">Price</th>
                                </tr>
                              </thead>
                            
                              <tbody>
                                <tr>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                </tr>
                               <?php 
							  
							   /*Order details section starts here*/
							 $orderDetailsArray = $clsbpBopaBank->fn_OrderDetails($row[bi_ord_id]);
							  $array = array(); 
							  $clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
							   $clsbpCreditCard	= new clsbpCreditCard($connect, $includePath,"clsbpCreditCard");
						 $SubTotal =0;
								 $Total=0;
							
							 
				foreach($orderDetailsArray as $orderRow) { 
							 $status = 0;
							 	 
								 if($type=='Paid'){ // grouping seller
								 
									 if(in_array($orderRow['bi_SellerId'],$array)){
									 $status =1;
									 
									 }
									 array_push($array,$orderRow['bi_SellerId']);
								 }
							 
								 if($type=='Received'){ // grouping buyer
								
									 if(in_array($orderRow['bi_BuyerId'],$array)){
									 $status =1;
									 }
									 if($orderRow['bi_SellerId']==$_SESSION["USERID"]){
									 array_push($array,$orderRow['bi_BuyerId']);
									 }
								 }
							 
								
								/* Bank paind and received section*/
								 if($orderRow['vc_payment_method']=='BANK' ){ // bank
								
										/*paid*/
										 if($type=='Paid'){ 
										$pMethod ="bopaBank";
										$Charge = 'NA';
										$SubTotal =$orderRow['vc_bank_amount'];
										$Total =$orderRow['vc_bank_amount'];
								        }
											   // received 
											   if($type=='Received'){ 
											
														if($orderRow['bi_SellerId']==$_SESSION["USERID"]){
												$SubTotal = $SubTotal +$orderRow['vc_filePrice'];
												}
													
													if($orderRow['f_transactionFee'] == 0){
													$Charge = 'NA'; 
													}
													
													if($orderRow['f_transactionFee'] > 0){												
													
													$Charge = number_format($SubTotal * $orderRow['f_transactionFee'],2); // commission for bopaboo (file amount * transactionn fee)
															
													
													
													}
												
											
												$Total = $SubTotal-$Charge; // owner amount (file amount- bopaboo commission)
											   }
								 
								 }
								 
								 
								 
								  if($orderRow['vc_payment_method']=='CC' ){ //cc
								 
								    $clsbpCreditCard->retrieveCreditCardDetails($orderRow['bi_creditcard_id']);
									$pMethod ="xxx-xxx-xxx-".substr($clsbpCreditCard->bi_card_num,-4);
									 
								     
									if($type=='Paid'){ // paid
									$SubTotal =$orderRow['vc_cc_amount'];
										if($orderRow['f_serviceCharge'] > 0){
										
										$Charge   = $orderRow['f_serviceCharge'];
										$Charge   =  number_format($Charge,2);
										$SubTotal = $SubTotal-$orderRow['f_serviceCharge'];
										
										$Total    = $SubTotal + $orderRow['f_serviceCharge']; 
										}
										else{									
										
										$Charge = 'NA';
										$Total    = $SubTotal ;
										}
									
									 
									}
									else{ // received
									  //  $Charge   = "$".$orderRow['f_transactionFee'];
										if($orderRow['bi_SellerId']==$_SESSION["USERID"]){
										 $SubTotal = $SubTotal +$orderRow['vc_filePrice'];
										}
										//$SubTotal = $SubTotal-$orderRow['f_serviceCharge'];
										$Charge = number_format($SubTotal* $orderRow['f_transactionFee'],2); 
									   $Total    = $SubTotal-$Charge;
									}
								
								 }
								 
								 /* Bank and CC*/
								 if($orderRow['vc_payment_method']=='CCBANK' ){ //cc
								 //	print_r($orderRow);
									// paid
									if($type=='Paid'){
									 $clsbpCreditCard->retrieveCreditCardDetails($orderRow['bi_creditcard_id']);
									$pMethod ="xxx-xxx-xxx-".substr($clsbpCreditCard->bi_card_num,-4)."/Bopabank"; 
									$SubTotal =$orderRow['vc_cc_amount']+$orderRow['vc_bank_amount'];
									
										if($orderRow['f_serviceCharge'] > 0){
										
										$Charge   = $orderRow['f_serviceCharge'];
										$Charge   =  number_format($Charge,2);
										$SubTotal = $SubTotal-$orderRow['f_serviceCharge'];
										
										$Total    = $SubTotal + $orderRow['f_serviceCharge']; 
										}
										else{									
										
										$Charge = 'NA';
										$Total    = $SubTotal ;
										}
									}
									
									// received 
									if($type=='Received'){ 
									
										if($orderRow['bi_SellerId']==$_SESSION["USERID"]){
										 $SubTotal = $SubTotal +$orderRow['vc_filePrice'];
										}
										//$SubTotal = $SubTotal-$orderRow['f_serviceCharge'];
										$Charge = number_format($SubTotal* $orderRow['f_transactionFee'],2); 
									   $Total    = $SubTotal-$Charge;
									}
								
								 }
						
							   ?>
                               <?php if($type=='Paid'){?>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td valign="top" class="spacing"> <?php if($status==0){
							
								   $clsbpUserLogin->retrieveLogin($orderRow['bi_SellerId']);
								   
								   echo $clsbpUserLogin->vc_DisplayName;
								  
								  } ?>
                                  </td>
                                  <td valign="top" class="spacing"> <?php echo $orderRow['vc_title'];?> - <?php echo $orderRow['vc_artists'];?>
                                  </td>
                                  <td valign="top" class="amount"><?php echo "$".number_format($orderRow['vc_filePrice'],2); ?></td>
                                </tr>
                               <?php
                               } 
							   ?> 
                                  <?php if(($type=='Received') && ($orderRow['bi_SellerId']==$_SESSION["USERID"])){
								
								  ?>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td valign="top" class="spacing"> <?php  if($status==0){
							
								   $clsbpUserLogin->retrieveLogin($orderRow['bi_BuyerId']);
								   
								   echo $clsbpUserLogin->vc_DisplayName;
								  }
								  ?>
                                  </td>
                                  <td valign="top" class="spacing"> <?php echo $orderRow['vc_title'];?> - <?php echo $orderRow['vc_artists'];?>
                                  </td>
                                  <td valign="top" class="amount"><?php echo "$".number_format($orderRow['vc_filePrice'],2); ?></td>
                                </tr>
                               <?php
                               } 
							   ?> 
                               
                                <?php
                               } 
							   ?> 
                                <tr>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                </tr>
                                
                                 <?php if($type=='Paid'){?>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td valign="top" class="paymentMethod spacing"> <?php echo "Payment Method:".$pMethod; ?> </td>
                                  <td valign="top" class="subTotal spacing">Sub-total:<br />
                                    <?php echo "Service Fee:";?></td>
                                  <td valign="top" class="subTotal amount"><?php echo "$".number_format($SubTotal,2); ?><br />
                                    <?php if($Charge=='NA'){echo $Charge;} else { echo "$".$Charge; } ?></td>
                                </tr>
                                  <tfoot>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td class="total"><?php echo "Total:";?>  </td>
                                  <td class="amount total"><?php echo "$".number_format($Total,2);  ?></td>
                                </tr>
                              </tfoot>
                                <tr>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                </tr>
                                <?php } ?>
                                      <?php  if(($type=='Received')){?>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td valign="top" class="paymentMethod spacing"> <?php  "Payment Method:".$pMethod; ?> </td>
                                  <td valign="top" class="subTotal spacing">Sub-total:<br />
                                    <?php echo "bopaboo Fee:";?></td>
                                  <td valign="top" class="subTotal amount"><?php echo "$".number_format($SubTotal,2); ?><br />
                                    <?php if($Charge=='NA'){echo $Charge;} else { echo "$".$Charge; } ?></td>
                                </tr>
                                  <tfoot>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td class="total"><?php echo "Your Share:";?>  </td>
                                  <td class="amount total"><?php echo "$".number_format($Total,2);  ?></td>
                                </tr>
                              </tfoot>
                                <tr>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                  <td class="horSpace"></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table></td>
                          </tr>
                             <?php 
				$recordNumber++;
				 } ?>
                   
                   
                    </table>                   
              
                  <?php } else {  
				  if($_REQUEST['sortColumn']=='ord_date' || $_REQUEST['sortColumn']==' '){ 
				  $_REQUEST['sortColumn']='d_withdrawalDate';
				  }
				  ?>
                   
                  <table width="912" border="0" cellpadding="0" cellspacing="0" id="datacell">
                          <tr>
                            <th width="175"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','d_withdrawalDate','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php  if($_REQUEST['sortColumn'] =='d_withdrawalDate' || $_REQUEST['sortColumn']==''){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";} }?>>Date</a></th>
                            <th width="102"><a href="#"   <?php if($_REQUEST['sortColumn'] =='type'){ if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>>Type</a></th>
                            <th width="189"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','vc_EmailId','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php  if($_REQUEST['sortColumn'] =='vc_EmailId'){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>>Email Id</a></th>
                            <th width="129"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','count','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php if($_REQUEST['sortColumn'] =='count'){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>># of Items</a></th>
                            <th width="118"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','f_WithdrawalAmount','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php if($_REQUEST['sortColumn'] =='f_WithdrawalAmount'){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>>Withdrawal Amount</a></th>
                      <th width="195"><a href="#" onclick="javascript:sortAjaxColumn('bpAjaxAccountActivity.php','f_BopabankBalance','clsbpBopaBank','frmbopabank','<?php $extraParameters ?>','accountActivity');" <?php if($_REQUEST['sortColumn'] =='f_BopabankBalance'){  if($_REQUEST['sortDirection']=="ASC"){echo "class='ascending'";} else if($_REQUEST['sortDirection']=="DESC") { echo "class='descending'";}}?>>bopaBank Balance</a></th>
                          </tr>
                  
               <?php  	$type="";
	 $extraParameters	= "pageSize=".$clsbpBopaBank->pageSize."&submitted=".$clsbpBopaBank->submitted."&optionVal=".$optionVal."&sortDirection=".$clsbpBopaBank->sortDirection."&sortColumn=".$clsbpBopaBank->sortColumn;
		 $recordNumber	= $clsbpBopaBank->clsbpPaginate->recordNumberOffset;  foreach($arrfileDetails as $row) { ?>
                       <tr  height="" class="trHover">
                            <td align="right"  class="spacingRight"><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php
							echo date ("F j, Y",strtotime($row['d_withdrawalDate']));
							?></a></td>
                            <td align="center"><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php echo "Withdrawal"; ?></a></td>
                            <td align="center" ><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php echo $row['vc_EmailId'];?></a></td>
                            <td align="center" ><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php echo 1; ?></a></td>
                             <td align="center"><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" >                           <?php echo "$".number_format($row['f_WithdrawalAmount']); ?></a>
                             </td>
                      <td align="right" class="amtspace"><a href="#rNum_<?php echo $recordNumber; ?>" onclick="javascript: fn_ShoworderDetails(<?php echo $recordNumber; ?>);" ><?php echo "$".number_format($row['f_BopabankBalance'],2);?></a></td>
                          </tr>
                  
                  <?php 	$recordNumber++; } }?>
                  
                  </table>
               <div id="pages" align="center"> <?php
				  $optionVal0 =$_GET['optionVal0'];
	if($optionVal0==""){
	$optionVal0 = 30;
	}
			$extraParameters	= "pageSize=".$clsbpBopaBank->pageSize."&submitted=".$clsbpBopaBank->submitted."&optionVal=".$optionVal."&optionVal0=".$optionVal0."&sortDirection=".$clsbpBopaBank->sortDirection."&sortColumn=".$clsbpBopaBank->sortColumn;
				// $clsbpBopaBank->clsbpPaginate->writeHTMLPageRanges("clsbpBopaBank", "frmbopabank", $extraParameters);
				echo $clsbpBopaBank->clsbpPaginate->getHTMLPageRangesForAjax("bpAjaxAccountActivity.php","clsbpBopaBank", "frmbopabank", $extraParameters,'accountActivity')
			
			?></div>
            
<?php

ob_get_contents();

?>            

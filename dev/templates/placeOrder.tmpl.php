  <SCRIPT  type="text/javascript" language="javascript">

<!-- Begin
function fn_cart(fileId)
{
var frm = document.frmcart;
var url = frm.url.value;
//alert(url);
frm.action="<?= HTTP ?>bpBopaCart.php?fileId="+fileId+"&action=REMOVE&returnUrl=bpOrderDetails.php?"+url+"";

frm.submit();

}
function checkEmpty(cartSize){
if(cartSize==0){
alert("                                   Your Shopping Cart is empty.\n Please continue shopping and when an item interests you, click the Add to Cart button.");
return false;
}
else {
return true;
}
}

function submitBack() {
	var frm = document.frmcart;
	frm.action="<?= HTTP ?>bpBuy.php";
	frm.submit();
}

// End -->
</SCRIPT>

  
  <!-- header ends-->
  <div id="container">
  
      <div id="shoppingLs">
      	
      	<ul class="cartLinks">
      		
        	<li><a href="<?php echo HTTP?>bpViewCart.php">view cart</a></li>
            <li><a href="<?php echo HTTP?>bpPayment.php">payment</a></li>
            <li class="viewCart active"><a href="#">place order</a></li>
            <li><a href="#">download</a></li>
        </ul>
        
        <div class="cartLinkBorder"></div>
        <div class="clsTop"></div>
      
      	<div class="rounded" id="shoppingCart">
        <div class="t">
          <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
          <div class="holder">
          	
            <div class="cls"></div>          
          	<div class="shoppingHead">
            	<h1><span class="greyText">order details</span></h1>
            </div>
            
            <div class="content">
            	<p>
            	<br>Please check all the information below to make sure it's correct.
            	<br>If you need to remove an item from your order, click the remove link next to the price.
            	<br>Once you click Place Order, your purchase will immediately be transferred to your bopaBox.
          	</div>
          	
                <div class="cls"></div>           
                
                <form name="frmcart"  method="post" action="">
                
                <table width="690" class="tableGeneral" id="messagesBoxTable">
<thead>
                  <tr valign="middle" class="tableHead">
                    <th width="35%" align="center"><a href="#">seller</a></th>
                    <th width="35%" align="center"><a href="#">item</a></th>
                    <th width="15%" align="center"><a href="#">price</a></th>
                    <th width="15%" align="center"><a href="#">delete</a></th>
                </tr>
            </thead>
<?php 
//error_reporting(E_ALL);

  $cartSize = count($_SESSION['bopaBasket']['song']);

			if($cartSize > 0 )
			{			
			
			   if(isset($_SESSION['bopaBasket']['song'])){ 
					
							   for($i=1;$i<=$cartSize;$i++)
								{	
								$FileID = $_SESSION['bopaBasket']['song'][$i-1];
								$row1 = $clsbpBopaCart->retrieveFileDetailsOfUser($FileID);
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
			$_SESSION[$r['product']]=$r;
		$count =0;
			 $own = $r['owner'];
?>
            
             <tbody>
                <tr valign="middle" class="new">
                  <td valign="bottom" class="indent"><?php $ownerInfo = $clsbpBopaCart->retrieveOwner($own); echo $ownerInfo['vc_DisplayName']; ?></td>
<?php
	$fileDetails = $clsbpBopaCart->retrieveFileDetailsOfUser($r['product']);
	//displayArray($fileDetails);
	$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);	
?>  
                  
                  <td valign="bottom" class="indent">
                  		<p class="spacing"><?php print stripslashes($fileDetails['vc_title_nm_mod']);?></p>
        				<p class="spacing"><?php print stripslashes($fileDetails['vc_artists_nm_mod']);?></p>
      					<p class="spacing"><?php print stripslashes($fileDetails['vc_album_nm_mod']);?></p>
                  </td>
                  <td align="center" valign="bottom"><?php print "$".number_format($fileDetails['dbl_price'],2); ?></td>
                  <td align="center" valign="bottom"><a href="javascript:void(0);" onclick="return fn_cart(<?php echo $r['product']; ?>);"><img src="<?php echo IMAGEPATH;?>iconDelete.png" border=0></a></td>
               </tr>
<?php
	  $count++;
	}
   $minAmt =constant("serviceFloor"); 
   if( (( $subTotalPrice)< $minAmt) && ($clsbpPayment->action=='OLDCARD' || $clsbpPayment->action=='NEWCARD' || $clsbpPayment->action=='NEWCARDYES' || $clsbpPayment->action=='OLDCARDYES'))  {
?>
               <tr> 
                    <td align="left" class="alternatebg001placeorder4subtotal"><h3>Sub-Total</h3></td>
                    <td align="left" class="alternatebg001placeorder4"><p class="spacing">&nbsp;</p></td>
                    <td align="center" class="alternatebg001placeorder4-price"><?php  echo "&nbsp$".number_format($subTotalPrice ,2) ;?></td>
                    <td align="center" class="alternatebg001placeorder4">&nbsp;</td>
                  </tr>
                    <tr>
                    <td height="30" align="left" class="alternatebg001placeorder4"><h3>Service Fee -<a href='javascript:void(0);' onClick='javascript:window.open("<?= HTTP ?>bpService.php","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,screenX=150,screenY=150,top=150,left=150,height=450,width=570");'>What is this?</a></h3></td>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4-price">&nbsp;$<?php echo constant("serviceCharge");?></td>
                    <td align="center" class="alternatebg001placeorder4">&nbsp;</td>
                  </tr>
                  <?php $subTotalPrice= $subTotalPrice+constant("serviceCharge"); }?>
                    <!--<tr>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4-price">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4">&nbsp;</td>
                  </tr>-->
                  <div class="cls"></div>
                  <div class="cls"></div>
          		  <table width="690" class="tablePlaceOrder">
          			<tr>
                    <td width="35%" valign="bottom" class="indent"><h3>Total</h3></td>
                    <td width="35%"></td>
                    <td width="15%" align="center" valign="bottom"><h3><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$".number_format($subTotalPrice ,2) ;?></h3></td>
                    <td width="15%"></td>
            		</tr>
          		   </table>
          
          <div class="cls"></div>
					<input type="hidden" name="clsbpPayment_TotalPurchaseAmount" value="<?php echo $subTotalPrice; ?>" />
                  <tr>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4-price">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4">&nbsp;</td>
                  </tr><input type="hidden" name="url" value="<?php echo $_SERVER['QUERY_STRING'];?>" />
                 
                  	 <?php }}
		 
		 else{			       
	  
	  ?> <tr>
                    <td colspan="4" align="left" class="alternatebg001placeorder1"></td>
                    </tr>
                  <tr>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4-price">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="4"  class="alternatebg001placeorder4total" align="center"><br />
                               Your Shopping Cart is empty.<br /> Please continue shopping and when an item interests you, click the Add to Cart button.<br /></td>
                    </tr>
                  <tr>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4-price">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4">&nbsp;</td>
                  </tr>
                
      
<?php } ?> <?php 
	//  if (isset($_POST['clsbpBopaCart_txtCreditCardVer1'])) $clsbpBopaCart->i_CCV1  	          = trim($_POST['clsbpBopaCart_txtCreditCardVer1']);
	  
	   if (isset($_POST['clsbpCreditCard_txtCreditCardVer1'])){
	 
	    $clsbpCreditCard->i_CCV1   	          = trim($_POST['clsbpCreditCard_txtCreditCardVer1']);
		$clsbpBopaCart->i_CCV1                = trim($_POST['clsbpCreditCard_txtCreditCardVer1']);
		$_SESSION['CCV']=trim($_POST['clsbpCreditCard_txtCreditCardVer1']);
		}
?>		
            
             </tbody>
          </table>
               <input type="hidden" name="clsbpBopaCart_txtCreditCardVer1" id="clsbpBopaCart_txtCreditCardVer1" value="<?php echo $_SESSION['CCV']; ?>" />
              
               <input type="hidden" name="clsbpPayment_cardId" value="<?php echo $clsbpPayment->cardId; ?>" />
		</form>
          	
          <div id="placeOrder">
          	<div>
          		<span>click place order to complete purchase</span>
          		<!--<span style="margin-left:20px;"><a href="#"><img src="../images/btnPlaceOrder.jpg" border=0"></a></span>-->
          		<span class="btPlaceOrder"><a onclick="return checkEmpty(<?php echo $cartSize; ?>);" href="<?= HTTP ?>bpThankYou.php?action=<?php echo $clsbpPayment->action; ?>&cardId=<?php echo $clsbpPayment->cardId; ?>" style="margin-left:20px;display:block;float:right;"></a></span>
          	</div>
          	<div>by placing your order, you agree to the bopaboo <b><a href="termsOfServices.html">terms of use</a> and <a href="privacyPolicy.html">privacy policy</a>.</b></div>
          </div>
          	
	      <div class="cls"></div>
       
        <div class="rounded" id="disclaimer">
            <div class="t">
              <div class="tr"></div>
            </div>
            <div class="c"> <div class="cl">
              <!--add content-->
              <div class="disclaimerContent">
								<p><b>Security & Privacy</b></p>
								<br>Every transaction on bopaboo is secure.
								<br>Any personal information you give us will be handled according to our <a href="privacyPolicy.html"><b>privacy policy</b></a>.
              <!--finish content-->
              </div> </div>
            <div class="b"><span class="br"></span></div>
          </div>
          </div>
          	
          </div>
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div>
      
      </div>     
      
      <div id="shoppingRs">
      	
			<div class="roundedTab" id="orderSummary">
        <div class="t">
          <div class="tab"><h3>order summary</h3></div>
          <div class="tr"></div>
        </div>
            <div class="c"> <div class="cl">
              <!--add content-->
              		<div class="content">
      	<?php
        
		 $cartSize = count($_SESSION['bopaBasket']['song']);
		 $subTotalPrice=0;
				if($cartSize > 0 )
				{			
				
				   if(isset($_SESSION['bopaBasket']['song'])){
						
								   for($i=1;$i<=$cartSize;$i++){
								   	$FileID = $_SESSION['bopaBasket']['song'][$i-1];
									$fileDetails = $clsbpBopaCart->retrieveFileDetailsOfUser($FileID);
									$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);	
									}
					}
				}					
		?>
              			<span class="total"><h3>Total:</h3></span><span class="totalPrice"><h3><?php  $minAmt =constant("serviceFloor"); 
			if($subTotalPrice > 0 ){
					if( ($subTotalPrice < $minAmt) && ($clsbpPayment->action=='OLDCARD' || $clsbpPayment->action=='NEWCARD' )) 
					 {
						echo "$".number_format($subTotalPrice+constant("serviceCharge"),2);
					 } 
					 else if( (( $subTotalPrice-$clsbpPayment->retrieveBankAmountofUser())< $minAmt) && ($clsbpPayment->action=='NEWCARDYES' || $clsbpPayment->action=='OLDCARDYES')){
					 
					 }
					 else {
					 
					  echo "$".number_format($subTotalPrice,2) ; 
					 
					 }
			}
			else{
			echo "$".number_format($subTotalPrice,2) ; 
			}		 
			 ?> </h3></span>
                  </div>
              <!--finish content-->
              </div> </div>
            <div class="b"><span class="br"></span></div>
      </div>
      
      <div class="cls"></div>
      
      <div class="roundedTab" id="paymentType">
        <div class="t">
          <div class="tab"><h3>payment information</h3></div>
          <div class="tr"></div>
        </div>
            <div class="c"> <div class="cl">
              <!--add content-->
              		<div class="content">
              			<p><b>pay by bopabank:</b> <?php  if(($clsbpPayment->action=="NEWCARDYES")  || ($clsbpPayment->action=="OLDCARDYES") || ($clsbpPayment->action=="YES") ){ ?>Yes<?php } else {?>No<?php }?><br />
                		<br>your remaining bopabank
              			<br>balance is <b><?php  echo "$";
               
			    if($clsbpPayment->action=="YES"){
                print number_format($arrBank['f_DepositAmount'] + $arrBank['f_SalesAmount'] - $subTotalPrice,2) ;
                }
                
				if((($clsbpPayment->action=="OLDCARDYES") || ($clsbpPayment->action=="NEWCARDYES")) && ($subTotalPrice >0)){
				$remainnigBankBalance =0;
               // print number_format( ($subTotalPrice) - ($arrBank['f_DepositAmount'] + $arrBank['f_SalesAmount']) ,2) ; 
			    print number_format($remainnigBankBalance);
				
                }
				/*else{
				print number_format($arrBank['f_DepositAmount'] + $arrBank['f_SalesAmount'] ,2) ;
				}*/
				
				if((($clsbpPayment->action=="OLDCARD") || ($clsbpPayment->action=="NEWCARD")) && (($subTotalPrice >0) ||($subTotalPrice==0) )){
				$remainnigBankBalance =0;
                print number_format( ($arrBank['f_DepositAmount'] + $arrBank['f_SalesAmount']) ,2) ; 
			   
                }
                ?></b>
              			<p><b><a href="<?= HTTPS ?>bpPayment.php?cardId=<?php echo $clsbpPayment->cardId; ?>&editcc=<?php echo $clsbpPayment->action; ?>">edit payment information</a></b>
                  </div>
              <!--finish content-->
              </div> </div>
            <div class="b"><span class="br"></span></div>
      </div>
      
      <div class="cls"></div>
      
          <div class="rounded" id="placeOrderButtons">
            <div class="t">
              <div class="tr"></div>
            </div>
            <div class="c"> <div class="cl">
              <!--add content-->
              <div class="content">              
              	<div class="btNextStep"><a onclick="return checkEmpty(<?php echo $cartSize; ?>);" href="<?= HTTP ?>bpThankYou.php?action=<?php echo $clsbpPayment->action; ?>&cardId=<?php echo $clsbpPayment->cardId; ?>" class="buttonPosition"></a></div>
              	<div class="btReviseCart"><a href="<?= HTTPS ?>bpPayment.php?cardId=<?php echo $clsbpPayment->cardId; ?>&editcc=<?php echo $clsbpPayment->action; ?>" class="buttonPosition"></a></div>
              	<div class="btContinueShopping"><a href="javascript: void(0)" onclick="javascript: submitBack();" class="buttonPosition"></a></div>
              </div>
              <!--finish content-->
              </div> </div>
            <div class="b"><span class="br"></span></div>
          </div>
      	
        <div class="cls"></div>
          
			<div class="roundedTab" id="aboutYourCart">
            <div class="t">
          <div class="tab"><h3>about your cart</h3></div>
          <div class="tr"></div>
        </div>
            <div class="c"> <div class="cl">
              <!--add content-->
              		<div class="pad">
              		
                    
              
              		<p>On bopaboo you buy items directly from the seller. The process is simple and easy – and, you can buy items from multiple sellers and checkout just ONCE! We handle the entire payment processing and then immediately transfer and digitally deliver your purchases - so you can start enjoying them.</p>
                    
                    <h5>four easy checkout steps</h5>
                    
                    <ul style="width:200px;">
                        <li>view cart</li>
                        <li>select payment method</li>
                        <li>confirm purchase</li>
                        <li>instant delivery directly to your bopaBox</li>
                    </ul>
                    
                    </div>
              	
              <!--finish content-->
              </div> </div>
            <div class="b"><span class="br"></span></div>
      </div>
      
      <div class="cls"></div>
        
        <div class="rounded" id="shoppingGoDaddy">
            <div class="t">
              <div class="tr"></div>
            </div>
            <div class="c"> <div class="cl">
              <!--add content-->
              <div class="holder">
					<img src="../images/godaddy.png" alt="go daddy" />             
              <!--finish content-->
              </div> </div>
            <div class="b"><span class="br"></span></div>
          </div>
          </div>
          
          <div class="cls"></div>
      	
      </div>
            
      </div>
  <!-- container ends -->
</div>
<!-- wrapper ends -->

<SCRIPT  type="text/javascript" language="javascript">

<!-- Begin
function fn_cart(fileId)
{
var frm = document.frmcart;
frm.action="bpBopaCart.php?fileId="+fileId+"&action=REMOVE&returnUrl=<?php echo "bpOrderDetails.php";  ?>";
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
// End -->
</SCRIPT>
<div id="container">
<div id="ViewCartpageheadPlaceorder">
  <h1>Shopping Cart</h1>
  <h2><a href="bpViewCart.php">View Cart</a> </h2>
  <img src="images/icon-arrow-viewcart.png" alt="Next" width="57" height="12" class="arrow" />
  <h2><a href="bpPayment.php">Payment</a></h2>
  <img src="images/icon-arrow-viewcart.png" alt="Next" width="57" height="12" class="arrow" />
  <h2><a href="bpOrderDetails.php"><img src="images/btn-viewcart.png" alt="View Cart" width="39" height="44" border="0" class="viewcart" />Place Order</a></h2>
</div>
<div id="viewcart">
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><h2>Review the information below, then click &quot;Place Order&quot;</h2></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="696" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table border="0" cellpadding="0" cellspacing="0" id="viewcart_tbl-placeorder">
      <tr>
        <td class="hdr"><h1>Order Details</h1></td>
      </tr>
      <tr>
        <td class="cartlistings"><p>Please check all the information below to make sure it is correct.<br />
         If you need to remove an item from your order, click the remove link next to the price.<br />
              Once you click Place Order, your purchases will immediately be transfered to your bopaBox.</p></td>
      </tr>
      <tr>
        <td class="cartlistings"><table width="650" border="0" align="center" cellpadding="0" cellspacing="0" id="srchresults1">
            <tr>
              <td colspan="3" valign="top" class="tbl004placeorder"><form name="frmcart"  method="post" action=""><table border="0" cellpadding="00" cellspacing="0" id="searchlistings2">
                  <tr>
                    <th width="197"><h3>Seller</h3></th>
                    <th width="239"><h3>Item</h3></th>
                    <th width="136"><h3>Price</h3></th>
                    <th width="76"><h3>&nbsp;</h3></th>
                  </tr>
                                <?php 
error_reporting(0);

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

$count =0;
	 $own = $r['owner'];
	?>
                  <tr>
                    <td align="left" class="alternatebg001placeorder-name"><?php $ownerInfo = $clsbpBopaCart->retrieveOwner($own);  echo $ownerInfo['vc_DisplayName'];?></td>            <?php
	

	
	
	
	
	$fileDetails = $clsbpBopaCart->retrieveFileDetailsOfUser($r['product']);
	$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);	
	?>  
                    <td align="left" class="alternatebg001placeorder-item"><p class="spacing"><?php print stripslashes($fileDetails['vc_title_nm_mod']);?></p>
                        <p class="spacing"><?php print stripslashes($fileDetails['vc_artists_nm_mod']);?></p>
                      <p class="spacing"><?php print stripslashes($fileDetails['vc_album_nm_mod']);?></p></td>
                    <td class="alternatebg001placeorder-price"><?php print "$".number_format($fileDetails['dbl_price'],2); ?></td>
                    <td align="center" class="alternatebg001placeorder-delete"><a  href='javascript:void(0);'   onclick="return fn_cart(<?php echo $r['product']; ?>);"><img src="images/icon-delete.png" width="21" height="21" border="0" /></a></td>
                  </tr>
                  
                  <tr>
                    <td height="1" colspan="4" align="left" class="alternatebg001placeorder1"></td>
                    </tr>
                                <?php
			  $count++;
}

	

						
			?>
             
                  
                  <tr>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4-price">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" class="alternatebg001placeorder4total"><h3>Total</h3></td>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4-price"><h3><?php  echo "&nbsp&nbsp;$".number_format($subTotalPrice ,2) ;?></h3></td>
                    <td align="center" class="alternatebg001placeorder4">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="left" class="alternatebg001placeorder4">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4-price">&nbsp;</td>
                    <td align="center" class="alternatebg001placeorder4">&nbsp;</td>
                  </tr>
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
      
      <?php } ?>
              </table>
              </form></td>
            </tr>
          </table>          </td>
      </tr>
      <tr>
        <td class="footer">&nbsp;</td>
      </tr>
    </table>
      <a href="#"></a>
      <table width="90%" border="0" cellpadding="0" cellspacing="0" id="viewcart_tbl1placeorder">
        
        <tr>
          <td width="461"><div align="right">Click Place Order to Complete Purchase</div></td>
          <td width="169" align="right"><a onclick="return checkEmpty(<?php echo $cartSize; ?>);" href="bpThankYou.php"><img src="images/place-ordr-btn.jpg" width="165" height="26" border="0" /></a></td>
        </tr>
        <tr>
          <td colspan="2"><div align="right">By placing your order, you agree to the bopaboo <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</div></td>
          </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
      </td>
      
      
    <td width="252" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0" class="viewcartrightsidebox-placeorder">
      <tr>
        <td class="tbl001b"><h1>Order Summary</h1></td>
      </tr>
      <tr>
        <td class="tbl002b"><table width="84%" border="0" align="center" cellpadding="0" cellspacing="0" class="ordersummary">
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
          <tr>
            <td width="70%"><h3>Total:</h3></td>
            <td><h3 align="left"><?php  echo "$".number_format($subTotalPrice,2) ;?></h3></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="tbl003a">&nbsp;</td>
      </tr>
    </table>
    <table border="0" cellspacing="0" cellpadding="0" class="viewcartrightsidebox-placeorder">
      <tr>
        <td class="tbl001b"><h1>Payment Information</h1></td>
      </tr>
        
        
        <tr>
          <td valign="top" class="tbl002a"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="paymentinfo">
            <tr>
              <td><strong>Pay by bopaBank:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes<br />
                Your Remaining bopaBank<br />
balance is <strong><?php  echo "$";

print number_format($arrBank['f_DepositAmount'] + $arrBank['f_SalesAmount'] - $subTotalPrice,2) ;?></strong></td>
            </tr>
            
            <tr>
              <td><a href="bpPayment.php">Edit Payment Information</a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td class="tbl003a">&nbsp;</td>
        </tr>
      </table>
      <table border="0" cellspacing="0" cellpadding="0" class="viewcartrightsidebox-placeorder">
        <tr>
          <td class="tbl001a">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="tbl002b"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center"><a onclick="return checkEmpty(<?php echo $cartSize; ?>);" href="bpThankYou.php"><img src="images/place-ordr-btn.jpg" width="165" height="26" border="0" /></a></td>
              </tr>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center"><a href="bpViewCart.php"><img src="images/go-back-btn.jpg" width="165" height="26" border="0" /></a></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center"><a href="bpSearch.php"><img src="images/continueshopping-small-btn.jpg" width="165" height="26" border="0" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td class="tbl003a">&nbsp;</td>
        </tr>
        <tr>
          <td height="14"></td>
        </tr>
      </table>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
    <div id="footertopwrapper">
      <div class="leftaside">
        <table border="0" cellpadding="0" cellspacing="0" id="viewcart_tbl-placeorder3">
              <tr>
                <td class="hdr"><h1>Disclaimer</h1></td>
              </tr>
              <tr>
                <td class="cartlistings"><h2>Security &amp; Privacy</h2>
                    <p>Every transaction on bopaboo is secure. Any personal information you give us will be handed according to our <a href="#">Privacy Policy</a>.</p>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <!--adjusting the spacing-->
                      <tr>
                        <td height="14"></td>
                      </tr>
                  </table></td>
              </tr>
              <tr>
                <td class="footer"></td>
              </tr>
            </table>
          </div>
          <div class="rightaside">
            <table border="0" cellspacing="0" cellpadding="0" class="viewcartrightsidebox-placeorder">
              <tr>
                <td class="tbl001a">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" class="tbl002b"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center"><img src="images/truste-logo.gif" width="110" height="30" /></td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><img src="images/godaddy-logo.gif" width="70" height="35" /></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td class="tbl003a">&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
</div>
</div>
<script  type="text/javascript" language="javascript">

<!-- Begin
function fn_cart(fileId)
{
var frm = document.frmcart;
frm.action="bpBopaCart.php?fileId="+fileId+"&action=REMOVE&returnUrl=<?php echo "bpViewCart.php";  ?>";
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
function submitBack() {
	var frm = document.frmcart;
	frm.action="bpBuy.php";
	frm.submit();
}
</script>
<div id="container">
       
        

  <div id="ViewCartpagehead1">
        	<h1>Shopping Cart</h1>
        	<img src="images/btn-viewcart.png" alt="View Cart" width="39" height="44" border="0" class="viewcart1" /> 
        	<h2><a href="#">View Cart</a> </h2>      
       	<img src="images/icon-arrow-viewcart.png" alt="Next" width="57" height="12" class="arrow" /><h2><a href="#">Payment</a></h2>
       	<img src="images/icon-arrow-viewcart.png" alt="Next" width="57" height="12" class="arrow" />
       	<h2><a href="#">Place Order</a></h2>
      </div>
      	<div id="viewcart1"><form name="frmcart"  method="post" action="">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table border="0" cellpadding="0" cellspacing="0" id="viewcart_tbl1">
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
if($own<>$r['owner']){
$count =0;
	 $own = $r['owner'];
	?>
              <tr>
                <td class="hdr">Order from <span class="buyer">
                  <?php $ownerInfo = $clsbpBopaCart->retrieveOwner($own); echo $ownerInfo['vc_DisplayName'];?>
                  </span></td>
              </tr>
              <?php
	
	}
	
	if($own==$r['owner']){
	
	
	$fileDetails = $clsbpBopaCart->retrieveFileDetailsOfUser($r['product']);
	$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);	
	
	?>
      <tr>
        <td class="cartlistings1"><table border="0" align="center" cellpadding="0" cellspacing="0" class="productlist1">
            <tr>
              <td><table border="0" cellpadding="0" cellspacing="0" class="product1">
                  <tr>
                    <td width="70" align="center"><img src="images/prodimg001.png" alt="albumimage" width="52" height="52" /></td>
                    <td><span class="albumname"><?php print stripslashes($fileDetails['vc_title_nm_mod']);?></span><br />
                        <span class="artist"><em>by</em> <?php print stripslashes($fileDetails['vc_artists_nm_mod']);?></span><br />
                      <a href='javascript:void(0);'  class="buynow" onclick="return fn_cart(<?php echo $r['product']; ?>);"><img src="images/icon-image.jpg" alt="remove" width="17" height="17" border="0" align="top" />Remove</a></td>
                    <td width="70" valign="top" class="price"><?php print "$".number_format($fileDetails['dbl_price'],2); ?></td>
                  </tr>
                  <?php if($own==$r['owner'] && $count > 0){?>
                          
                         <hr style="height:0;border:0;border-top:1px dashed #a4a4a4; "/>
                          <?php } ?>
              </table></td>
            </tr>
        </table></td>
      </tr>
      <?php }
			  $count++;
}

	

						
			?>
              <?php    
	           }
			   ?>
      
      
      <tr>
        <td class="footer"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="subtotal">
            <tr>
              <td width="544" align="right" class="subtotal">Sub-Total</td>
              <td width="100" class="price"><?php  echo "&nbsp;&nbsp;$".number_format($subTotalPrice ,2) ;?></td>
            </tr>
        </table></td>
      </tr>
      <?php }
		 
		 else{			       
	  
	  ?>
              <tr>
                <td class="hdr">&nbsp;</td>
              </tr>
              <tr>
                <td class="cartlistings1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="productlist1">
                    <tr>
                      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="product1">
                          <tr>
                            <td align="center" class="tbl002b"><br />
                               Your Shopping Cart is empty.<br /> Please continue shopping and when an item interests you, click the Add to Cart button.<br />
                            </td>
                          </tr>
                      </table></td>
                    </tr>
                  </table></td>
              </tr>
               <tr>
                <td class="footer"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="subtotal">
                    <tr>
                           <td width="544" align="right" class="subtotal"></td>
                      <td width="100" class="price"></td>
                 
                      
                    </tr>
                  </table></td>
              </tr>
              <?php } ?>
    </table>
      </td>
    <td valign="top" width="28%"><table border="0" cellpadding="0" cellspacing="0" class="sidebox002">
      <tr>
        <td class="hdr">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top" class="content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="40" align="center"><a onclick="return checkEmpty(<?php echo $cartSize; ?>);" <?php if($_SESSION['USERID']=='' && $cartSize >0) { ?>href="bpSignIn.php?height=316&width=549&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo getCurrentPage();   ?>" class="thickbox"<?php } else { ?> href="bpPayment.php"  <?php }?>><img src="images/btn-checkout.jpg" alt="checkout" border="0" /></a></td>
            </tr>
            
            <tr>
              <td height="40" align="center"><a href="javascript: void(0);" onclick="javascript: submitBack();"><img src="images/btn-contd-shopping.jpg" alt="continue shopping" border="0" /></a></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td class="footer">&nbsp;</td>
      </tr>
    </table>
      <table border="0" cellpadding="0" cellspacing="0" class="sidebox002">
        <tr>
          <td class="hdr">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="40" align="center"><img src="images/logo-trusteecert.jpg" alt="Trustee" width="110" height="30" /></td>
              </tr>
              <tr>
                <td height="40" align="center"><br />
                    <img src="images/godaddy-logo.gif" alt="Go Daddy" width="70" height="35" /></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td class="footer">&nbsp;</td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" class="sidebox001">
        <tr>
          <td height="39" class="hdr"><span class="tbl001b">About your cart</span></td>
        </tr>
        <tr>
          <td align="center" class="content"><p>On bopaboo you buy items directly from the seller. The  process is simple and easy &ndash; and, you can buy items from multiple sellers and  checkout just ONCE!  We handle the entire  payment processing and then immediately transfer and digitally deliver your  purchases - so you can start enjoying them.  <br />
                  <br />
            </p>
              <strong>Four easy checkout steps</strong>
              <ol>
                <li>View Cart </li>
                <li>Select Payment Method</li>
                <li>Confirm Purchase</li>
                <li>Instant delivery directly to your bopaBox</li>
              </ol></td></tr>
        <tr>
          <td class="footer">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
   </form>
    </div>
</div> 

<div id="cls"></div>

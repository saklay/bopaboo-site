<SCRIPT  type="text/javascript" language="javascript">

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
var w = window.width/2;
var h = window.height/2;
var el = document.getElementById('view');
el.href = "bpSignIn.php?height="+h+"&width="+w+"&modal=true";

return true;
}
}

// End -->
</SCRIPT>
<script type="text/javascript">
function fnGetResolution()
{
alert("here");
var w = screen.width;
var h = screen.height;
var el = document.getElementById('view');
el.href = "bpSignIn.php?height="+h+"&width="+w+"&modal=true";
}
</script>
<div id="container">
  <div id="ViewCartpagehead">
    <h1>Shopping Cart</h1>
    <img src="images/btn-viewcart.png" alt="View Cart" width="39" height="44" border="0" class="viewcart" />
    <h2><a href="#">View Cart</a> </h2>
    <img src="images/icon-arrow-viewcart.png" alt="Next" width="57" height="12" class="arrow" />
    <h2><a href="#">Payment</a></h2>
    <img src="images/icon-arrow-viewcart.png" alt="Next" width="57" height="12" class="arrow" />
    <h2><a href="#">Place Orders</a></h2>
  </div>
  <div id="viewcart">
    <form name="frmcart"  method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top"><table border="0" cellpadding="0" cellspacing="0" id="viewcart_tbl">
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
                  <?php $ownerInfo = $clsbpBopaCart->retrieveOwner($own); echo $ownerInfo['vc_FirstName']." ".$ownerInfo['vc_LastName'];?>
                  </span></td>
              </tr>
              <?php
	
	}
	
	if($own==$r['owner']){
	
	
	$fileDetails = $clsbpBopaCart->retrieveFileDetailsOfUser($r['product']);
	$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);	
	?>
              <tr>
                <td class="cartlistings"><table width="554" border="0" align="center" cellpadding="0" cellspacing="0" class="productlist">
                    <tr>
                      <td><table width="530" border="0" cellpadding="0" cellspacing="0" class="product">
                          <tr>
                            <td width="70" align="center"><img src="images/prodimg001.png" alt="albumimage" width="52" height="52" /></td>
                            <td><span class="albumname"><?php print stripslashes($fileDetails['vc_title_nm_mod']);?></span><br />
                              <span class="artist"><em>by</em><?php print stripslashes($fileDetails['vc_artists_nm_mod']);?></span><br />
                              <a  href='javascript:void(0);'  class="buynow" onclick="return fn_cart(<?php echo $r['product']; ?>);"><img src="images/icon-image.jpg" alt="remove" width="17" height="17" border="0" align="top" />Remove</a></td>
                            <td width="70" class="price"><?php print "$".number_format($fileDetails['dbl_price'],2); ?></td>
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
                           <td width="487" align="right" class="subtotal">Sub total</td>
                      <td width="97" class="price"><?php  echo "&nbsp&nbsp;$&nbsp;".number_format($subTotalPrice ,2) ;?></td>
                 
                      
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
                <td class="cartlistings"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="productlist">
                    <tr>
                      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="product">
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
                           <td width="487" align="right" class="subtotal"></td>
                      <td width="97" class="price"></td>
                 
                      
                    </tr>
                  </table></td>
              </tr>
              <?php } ?>
            
            </table>
            <a href="#"></a>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" id="viewcart_tbl1">
              <tr>
                <td>&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
              <tr>
                <td><a href="bpSearch.php"><img src="images/btn-contd-shopping.jpg" alt="continue shopping" width="236" height="28" border="0" /></a></td>
                <td align="right"><a name="view" id="view" onclick="return checkEmpty(<?php echo $cartSize; ?>);" <?php if($_SESSION['USERID']=='' && $cartSize >0) { ?>href="javascript: void(0);"  class="thickbox" <?php } else { ?>href="bpPayment.php"  <?php }?>><img src="images/btn-checkout.jpg" alt="checkout" width="236" height="28" border="0"/></a></td>
              </tr>
            </table></td>
          <td valign="top"><table border="0" cellspacing="0" cellpadding="0" class="viewcartrightsidebox">
              <tr>
                <td class="tbl001a">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" class="tbl002a"><a onclick="return checkEmpty(<?php echo $cartSize; ?>);" <?php if($_SESSION['USERID']=='' && $cartSize >0) { ?>href="bpSignIn.php?height=316&width=549&modal=true" class="thickbox"<?php } else { ?> href="bpPayment.php"  <?php }?>><img src="images/btn-checkout.jpg" alt="checkout" width="236" height="28" border="0" /></a></td>
              </tr>
              <tr>
                <td align="center" class="tbl002a">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" class="tbl002a"><a href="bpSearch.php"><img src="images/btn-contd-shopping.jpg" alt="continue shopping" width="236" height="28" border="0" /></a></td>
              </tr>
              <tr>
                <td class="tbl003a">&nbsp;</td>
              </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" class="viewcartrightsidebox">
              <tr>
                <td class="tbl001a">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" class="tbl002a"><img src="images/godaddy-logo.gif" alt="Go Daddy" width="70" height="35" />&nbsp;&nbsp;&nbsp;<img src="images/truste-logo.gif" alt="Trustee" width="110" height="30" /></td>
              </tr>
              <tr>
                <td class="tbl003a">&nbsp;</td>
              </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" class="viewcartrightsidebox">
              <tr>
                <td class="tbl001b">About your cart</td>
              </tr>
              <tr>
                <td align="center" class="tbl002b"><p>On bopaboo you buy items directly from the seller. The  process is simple and easy - and, you can buy items from multiple sellers and  checkout just ONCE! We handle the entire  payment processing and then immediately transfer and digitally deliver your  purchases - so you can start enjoying them.<br />
                    <br />
                  </p>
                  <strong>Four easy checkout steps</strong>
                  <ol>
                    <li>View Cart </li>
                    <li>Select Payment Method</li>
                    <li>Confirm Purchase</li>
                    <li>Instant delivery directly to your bopaBox</li>
                  </ol></td>
              </tr>
              <tr>
                <td class="tbl003a">&nbsp;</td>
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

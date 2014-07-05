<script  type="text/javascript" language="javascript">
<!-- Begin
function fn_cart(fileId)
{
	var frm = document.frmcart;
	frm.action="<?= HTTP ?>bpBopaCart.php?fileId="+fileId+"&action=REMOVE&returnUrl=<?php echo "bpViewCart.php";  ?>";
	frm.submit();
}

function checkEmpty(cartSize){
	if(cartSize==0){
		alert("Your Shopping Cart is empty.\n Please continue shopping and when an item interests you, click the Add to Cart button.");
		return false;
	} else {
		return true;
	}
}
// End -->

function submitBack() {
	var frm = document.frmcart;
	frm.action="<?= HTTP ?>bpBuy.php";
	frm.submit();
}
</script>

  <!-- header ends-->
  <div id="container">
  	  
  <!--- form Start--->
  <form name="frmcart"  method="post" action="">

      <div id="shoppingLs">
      
      	<ul class="cartLinks">
        	<li class="viewCart active"><a href="#">view cart</a></li>
            <li><a href="<?php echo HTTP?>bpPayment.php">payment</a></li>
            
            <!--<li><a <?php if($_SESSION['USERID']=='' && $cartSize >0) { ?>href="bpPayment.php"<?php } else { ?> href="<?php echo HTTPS; ?>bpSignIn.php?returnUrl=<?php $currentpageurl=urlencode(getCurrentPage()); echo getCurrentPage();?>&height=316px&width=100px&modal=true&KeepThis=true&TB_iframe=true" class="thickbox"  <?php }?>>payment</a></li>-->
            
            <li><a href="<?php echo HTTP?>bpOrderDetails.php">place order</a></li>
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
            
            
<?php 

	error_reporting(0);
	$prodCount = 0;
  	$cartSize = count($_SESSION['bopaBasket']['song']);

	if($cartSize > 0 ) {			
			
		if(isset($_SESSION['bopaBasket']['song'])){
					
			for($i=1;$i<=$cartSize;$i++) {	
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
				$prodCount++;
	 			$own = $r['owner'];
?>

            <div class="cls"></div>          
          	<div class="shoppingHead">
            	<h1><span class="greyText">order from</span>&nbsp;<?php $ownerInfo = $clsbpBopaCart->retrieveOwner($own); echo $ownerInfo['vc_DisplayName'];?></h1>
                <h5>$0.90</h5>
            </div>
            		
<?php
			}
	
			if($own==$r['owner']){
				$fileDetails = $clsbpBopaCart->retrieveFileDetailsOfUser($r['product']);
				$subTotalPrice  = $subTotalPrice +   number_format($fileDetails['dbl_price'],2);

				$tempCount = $prodCount % 2;
				if ($tempCount == 0) {
					$prodCount = 0;
?>
            <div class="cartItem">
            	<img src=".<?php echo IMAGEPATH; ?>cartItem.png" alt="cart item" />
                <table>
                	<tr><td><?php print stripslashes($fileDetails['vc_title_nm_mod']);?></td></tr>
                    <tr><td><strong>by <?php print stripslashes($fileDetails['vc_artists_nm_mod']);?></strong></td></tr>
                    <tr><td>price: <?php print "$".number_format($fileDetails['dbl_price'],2); ?></td></tr>	
                    <tr><td><a href="javascript:void(0);" onclick="return fn_cart(<?php echo $r['product']; ?>);">
                    	<img src="<?php echo IMAGEPATH; ?>btnDelete.gif" alt="delete" />
                    </a></td></tr>
                </table> 
            </div>
            
                         <hr style="height:0;border:0;border-top:1px dashed #a4a4a4; "/>
<?php
				} else {
?>
            
            
            <div class="cartItem">
            	<img src="<?php echo IMAGEPATH;?>cartItem.png" alt="cart item" />
                <ul>
                	<li><?php print stripslashes($fileDetails['vc_title_nm_mod']);?></li>
                    <li><strong>by <?php print stripslashes($fileDetails['vc_artists_nm_mod']);?></strong></li>
                    <li>price: <?php print "$".number_format($fileDetails['dbl_price'],2); ?></li>	
                    <li><a href="javascript:void(0);" onclick="return fn_cart(<?php echo $r['product']; ?>);">
                    	<img src="<?php echo IMAGEPATH;?>btnDelete.gif" alt="delete" />
                    </a></li>
                </ul> 
            </div>
            
<?php
				}
				if($own==$r['owner'] && $count > 0){
?>


<?php 
				} 
?>
<?php 
			}		
			$count++;
		}
	}
?>
    
            <div class="cls"></div>
            
            <div class="cartTotal">
                <dl>
                    <dt>sub-total</dt>
                        <dd><?php  echo number_format($subTotalPrice ,2) ;?></dd>
                </dl>
            </div>
   
<?php 

	} else {
	  
?>
            <div class="content">
            	<h3 style="text-align:center">Your Shopping Cart is empty.<br /> Please continue shopping and when an item interests you, click the Add to Cart button.<br /></h3>
            </div>

<?php 
	}
?>

       
          	
          </div>
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div>
      
      </div>     
      
      <div id="shoppingRs">
      
          <div class="rounded" id="shoppingButtonCol">
            <div class="t">
              <div class="tr"></div>
            </div>
            <div class="c"> <div class="cl">
              <!--add content-->
              <div class="holder">
              <!--
              <a href="#"><img src="../images/buttonContinueShopping.png" alt="continue shopping"  class="button"/></a>
              <a href="#"><img src="../images/buttonCheckout.png" alt="checkout" class="button"/></a>
              -->
              	<div>
              		<div class="btContinueShopping"><a href="javascript: void(0);" onclick="javascript: submitBack();"  style="display:block;margin-top:5px;"></a></div>
              		<div class="btCheckOut"><a <?php if($_SESSION['USERID']=='' && $cartSize >0) { ?>href="bpPayment.php"<?php } else { ?> href="<?php echo HTTPS; ?>bpSignIn.php?returnUrl=<?php $currentpageurl=urlencode(getCurrentPage()); echo getCurrentPage();?>&height=316px&width=100px&modal=true&KeepThis=true&TB_iframe=true" class="thickbox"  <?php }?> style="display:block;margin-top:5px;"></a></div>
              	</div>
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
					<img src="<?php echo IMAGEPATH; ?>godaddy.png" alt="go daddy" />             
              <!--finish content-->
              </div> </div>
            <div class="b"><span class="br"></span></div>
          </div>
          </div>
          
          <div class="cls"></div>
      	
      </div>

	  </form>
            <!-- form ends -->
      </div>
  <!-- container ends -->
</div>
<!-- wrapper ends -->

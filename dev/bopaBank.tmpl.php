<div id="container">
  
      <div id="laside720">
      	<div class="roundedTab" id="payment">
        <div class="t">
          <div class="tab"><h3 class="wide"><a href="<?= HTTP ?>bpAccountActivity.php">history</a></h3>
          </div>
          <div class="tabOff"><h3 class="wide"><a href="<?= HTTPS ?>bpWithdraw.php">withdraw</a></h3>
          </div><div class="tab"><h3 class="wide"><a href="#">payments</a></h3>
          </div><div class="loading"> <img src="../images/o2.gif" alt="loading" width="16" height="16" /> </div>     
          <div class="tr"></div>
        </div>

              		<!-- start of  iframe -->
                			<iframe 
							frameborder="no"
							src ="<?=PCIURL?>bpBopaBankPCI.php"
							width="100%" height = "260px">
						</iframe>
				  <!-- end of iframe -->
        <div class="b"><span class="br"></span></div>
      </div> <!-- bopaBigBox ends -->
      <div class="cls"></div>
      <!--<a href="#" class="btnAddNewCard"></a>-->
      <div>
          <a href="<?=HTTP?>bpCreditCardAdd.php"><input type="image" src="<?= HTTP ?>images/btnAddCard.png" align="right" onclick="return fnGo();" /></a>
      </div>
      <!-- end laside720 -->
    
  </div>
  <!-- container ends -->
</div>
<!-- wrapper ends -->
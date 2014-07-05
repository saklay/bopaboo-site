  <div id="container">
  
      <div class="roundedTab" id="withdrawFund">
        <div class="t">
          <div class="tabOff"><h3 class="wide"><a href="<?= HTTP ?>bpAccountActivity.php">history</a></h3>
          </div>
          <div class="tab"><h3 class="wide"><a href="#">withdraw</a></h3>
          </div><div class="tabOff"><h3 class="wide"><a href="<?= HTTPS ?>bpBopaBank.php">payments</a></h3></div>

          <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
			<div class="withdrawFund">
              <form name="frmWithdraw" method="POST" action="" >
              	<ul>
                	<li>
                    	<label class="left">&nbsp;</label>
                        <span class="right">
                        	<span class="balanceAvailable"> $<?php print number_format($arrBank['f_SalesAmount'] - $subTotalPrice,2) ; ?></span>
	                        <span> &nbsp;&nbsp;available for withdrawal via</span><span class="paypal"></span>
                        </span>
                    </li>
                    <li>
                    	<label class="left">your paypal email address:</label>
                        <span class="right">
                        	<input type="text" class="inputStyle" name="classname_email" value="<?php echo $clsbpUserLogin->vc_EmailId; ?>" id="email-address" /><br />
                            <span class="note">(If you don't have a PayPal address, just enter your email )</span>
                        </span>
                    </li>
                    <li>
                    	<label class="left">confirm email address</label><span class="right">
                    	<input type="text" class="inputStyle" name="classname_conf_email" id="conf-email"/></span>
                    </li>
                    <li>
                    	<label class="left">amount you wish to withdraw</label>
                        <span class="right"><input type="text" class="inputStyle1" name="classname_amount" id="amount" /></span>
                    </li>
                    <li>
                    	<label class="left">&nbsp;</label><span class="right btWithdraw"><a href="#" onclick="javascript: return fnValWithdraw();" style="display:block;"></a>
                    </li>
                    <li>&nbsp;</li>
                </ul>
                <input type="hidden" value='<?php print number_format($arrBank['f_SalesAmount'] - $subTotalPrice,2) ; ?>' name="available_withdraw" id="available_withdraw">
              </form>
            </div>
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- bopaBigBox ends -->
    
  </div>
  <!-- container ends -->
</div>
<!-- wrapper ends -->
    <div id="container">
      <div id="submenu">
            <a href="<?php echo HTTP ?>bpAccountActivity.php"  class="current">bopaBank</a>	|	<a href="<?php echo HTTP ?>bpFeedback.php">Feedback</a>	|	<a href="<?php echo HTTP ?>bpMyBopaMessageInbox.php">Messages</a>
      </div>
        <div id="pagehead-bopabank">
          <h1>Withdraw Funds</h1><form action="" method="post" name="bopabankdetails">
      <div id="bopabank-balance">
            	<h2>bopaBank Balance</h2>
            	<div id="bopabank-details">
                	 <?php echo date("F j, Y");
    			         			 ?><br />
        
					Total: $<?php print number_format($arrBank['f_DepositAmount'] + $arrBank['f_SalesAmount'] - $subTotalPrice,2) ; ?><br />
                    Available for withdraw: $<?php print number_format($arrBank['f_SalesAmount'] - $subTotalPrice,2) ; ?>
                </div>
            </div>
            </form>
      </div>
        <div id="bopabank">
          <table width="914" border="0" cellspacing="0" cellpadding="0" class="datalist">
                <tr>
                  <td><ul id="bopabank-menu">
                    <li class="accountactivity"><a href="<?php echo HTTP ?>bpAccountActivity.php">Account Activity</a></li>
                    <li class="withdrawfunds"><a href="<?php echo HTTPS ?>bpWithdraw.php" class="currentsel">Withdraw Funds</a></li>
                    <li class="managecredit"><a href="<?php echo HTTPS ?>bpBopaBank.php">Manage Credit Cards</a></li>
                  </ul></td>
                </tr>
                <tr>
                    <td class="hdr">&nbsp;</td>
            </tr>
                <tr>
                  <td valign="top" class="bdy"> <span class="price">$<?php print number_format($arrBank['f_SalesAmount'] - $subTotalPrice,2) ; ?></span><span class="avlbaltext"> available for <em>withdraw via</em></span><a href="#"><img src="images/tn-paypal.png" alt="paypal" width="80" height="27" border="0" align="absmiddle" /></a><br />
                  <form name="frmWithdraw" method="POST" action="" onsubmit="javascript: return fnValWithdraw();">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="amt-withdraw">
                      <tr>
                        <td width="23%" align="right" class="tdheight">&nbsp;</td>
                        <td width="77%" class="tdheight">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="right" class="avlbaltext1"> Your PayPal Email Address</td>
                        <td><input type="text" name="classname_email" value="<?php echo $clsbpUserLogin->vc_EmailId; ?>" id="email-address"  class="inputtext" />
                        &nbsp;&nbsp;<span class="lighttext">(If you don't have a PayPal address, just enter your email )</span> </td>
                      </tr>
                      <tr>
                        <td align="right" class="avlbaltext1">Confirm PayPal Email Address</td>
                        <td><input type="text" name="classname_conf_email" id="conf-email" class="inputtext" /></td>
                      </tr>
                      <tr>
                        <td align="right" class="avlbaltext1">Amount you Wish to Withdraw</td>
                        <td><input type="text" name="classname_amount" id="amount" class="inputtext" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><input type="image" src="images/btn-withdrawfund.png" /></td>
                      </tr>
                    </table>
                    		<input type="hidden" value='<?php print number_format($arrBank['f_SalesAmount'] - $subTotalPrice,2) ; ?>' name="available_withdraw" id="available_withdraw">
                    </form>
                   </td>
            </tr>
                <tr>
                  <td class="ftr">&nbsp;</td>
                </tr>
          </table>
            <div style="clear:both;"></div>

        
        <div>
        </div>
        </div>
    </div>
    
    <div id="ad">
          <!-- Begin: AdBrite -->
          <script type="text/javascript">
				var AdBrite_Title_Color = '0000FF';
				var AdBrite_Text_Color = '000000';
				var AdBrite_Background_Color = 'FFFFFF';
				var AdBrite_Border_Color = 'CCCCCC';
				var AdBrite_URL_Color = '008000';
            </script>
          <span style="white-space:nowrap;">
          <script src="http://ads.adbrite.com/mb/text_group.php?sid=597989&amp;zs=3732385f3930" type="text/javascript"></script>
          <!--  -->
          <a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=597989&amp;afsid=1"> <img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#CCCCCC;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" /> </a> </span>
          <!-- End: AdBrite -->
        </div>
    
</div> 
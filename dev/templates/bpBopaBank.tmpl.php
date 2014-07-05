<script type="text/javascript" language="javascript">
function fnGo()
{
window.location="<?=HTTPS?>bpCreditCardAdd.php";
return false;
}
function fn_showTab(tabName,gourl){


xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){

  alert ("Browser does not support HTTP Request")
  return
} 

function stateChangedTab() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 
 document.getElementById('bopabank').innerHTML=xmlHttp.responseText ;
 	
 } 
}
	
	var url=gourl+"&tabName="+tabName;


	xmlHttp.onreadystatechange=stateChangedTab;
	
	//document.write(url);
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)

}
function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}
</script>

<div id="container">

      <div id="submenu">
            <a href="<?= HTTP ?>bpAccountActivity.php" class="current">bopaBank</a>	|	<a href="<?= HTTP ?>bpFeedback.php?feedbacklist=provided">Feedback</a>	|	<a href="<?= HTTP ?>bpMyBopaMessageInbox.php">Messages</a>      
      </div>
<div id="pagehead-bopabank">
          <h1>Manage Credit Cards</h1>
          <form action="" method="post" name="bopabankdetails">
          <div id="bopabank-balance">
                    <h2>bopaBank Balance</h2>
                    <div id="bopabank-details">
                         <?php echo date("F j, Y");  ?><br />
                        Total: $<?php print number_format($clsbpPayment->retrieveBankAmountofUser(),2) ; ?><br />
                        Available for withdraw: $<?php print number_format($clsbpPayment->retrieveBankAmountofUser(),2) ; ?>
                    </div>
            </div>
            </form>
      </div>
        <div id="bopabank">
        <!-- <form action="" method="post" name="formname"> -->
        <input type="hidden"  name="clsbpCreditCard_pageSize" value="<?php echo $clsbpCreditCard->pageSize; ?>">
          <input type="hidden"  name="clsbpCreditCard_pageIndex" value="<?php echo $clsbpCreditCard->pageIndex; ?>">
          <input type="hidden"  name="clsbpCreditCard_sortColumn" value="<?php echo $clsbpCreditCard->sortColumn; ?>"> 
          <input type="hidden"  name="clsbpCreditCard_sortDirection" value="<?php echo $clsbpCreditCard->sortDirection; ?>"> 
          <input type="hidden"  name="clsbpCreditCard_action" value=""> 
     
          <input type="hidden" name="clsbpCreditCard_returnUrl" value=""> 
          <input type="hidden"  name="clsbpCreditCard_submitted" value="1">
          
          <table width="914" border="0" cellspacing="0" cellpadding="0" class="datalist">
                <tr>
                  <td><ul id="bopabank-menu">
                    <li class="accountactivity"><a href="<?= HTTP ?>bpAccountActivity.php">Account Activity</a></li>
                    <li class="withdrawfunds"><a href="<?= HTTPS ?>bpWithdraw.php">Withdraw Funds</a></li>
                    <li class="managecredit"><a href="<?= PCIURL ?>bpBopaBank.php" class="currentsel">Manage Credit Cards</a></li>
                  </ul></td>
                </tr>
                <tr>
                    <td class="hdr">&nbsp;</td>
            </tr>
                <tr>
                  <td valign="top" class="bdy">
                
                <!-- start of  iframe -->
                			<iframe 
							frameborder="no"
							src ="<?=PCIURL?>bpBopaBankPCI.php"
							width="100%" height = "260px">
						</iframe>
				  <!-- end of iframe -->
                </td>
            </tr>
                <tr>
                  <td class="ftr">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><a href="<?=HTTPS?>bpCreditCardAdd.php"><input type="image" src="<?= HTTP ?>images/btn-addnewcard.png" align="right" onclick="return fnGo();" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
          </table>
         <!--   </form> -->

        
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
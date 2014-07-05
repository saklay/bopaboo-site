<script  type="text/javascript" language="javascript">
function fn_showTab(tabName,gourl){

document.getElementById('loader_aac').style.visibility ='visible';

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){

  alert ("Browser does not support HTTP Request")
  return
} 

function stateChangedTab() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 

 document.getElementById('bopa').innerHTML=xmlHttp.responseText;
 document.getElementById('loader_aac').style.visibility ='hidden';	
 } 
}
	
	var url=gourl+"&tabName="+tabName;

//alert( gourl);
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

function fn_ShoworderDetails(record){
//alert("tr_"+record);
tr = "tr_"+record;
sd = "showHideDetails"+record;

document.getElementById(sd).style.display ='';
}
function fn_HideOrderDetails(record){
tr = "tr_"+record;
sd = "showHideDetails"+record;
document.getElementById(tr).style.height ='0px'; 
document.getElementById(sd).style.display ='none';
}
</script>

    <div id="container">

      <div id="submenu">
            <a href="bpAccountActivity.php" class="current">bopaBank</a>	|	<a href="bpFeedback.php?feedbacklist=provided">Feedback</a>	|	<a href="bpMyBopaMessageInbox.php">Messages</a>
      </div>
        <div id="pagehead-bopabank">
          <h1>bopaBank</h1><form action="" method="post" name="bopabankdetails">
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
        <table width="914" border="0" cellspacing="0" cellpadding="0" class="datalist">
                <tr>
                  <td><ul id="bopabank-menu">
   					<li><div id="loader_aac" align="absmiddle" style="padding-top:8px;"> <img src="images/o2.gif" alt="loader" /></div></li>
                    <li class="accountactivity"><a href="bpAccountActivity.php" class="currentsel">Account Activity</a></li>
                    <li class="withdrawfunds"><a href="https://staging.bopaboo.com/dev/bpWithdraw.php">Withdraw Funds</a></li>
                    <li class="managecredit"><a href="https://staging.bopaboo.com/dev/bpBopaBank.php">Manage Credit Card</a></li>
                  </ul></td>
                </tr>            <?php

echo "<script type='text/javascript'>fn_showTab('accountActivity','bpAjaxAccountActivity.php?optionVal=1&sortDirection=DESC&sortColumn=ord_date');
</script>";



?>
                              <form action="" method="post" name="frmbopabank">
         <input type="hidden"  name="clsbpBopaBank_pageSize" value="<?php echo $clsbpBopaBank->pageSize; ?>">
          <input type="hidden"  name="clsbpBopaBank_pageIndex" value="<?php echo $clsbpBopaBank->pageIndex; ?>">
          <input type="hidden"  name="clsbpBopaBank_sortColumn" value="<?php echo $clsbpBopaBank->sortColumn; ?>"> 
          <input type="hidden"  name="clsbpBopaBank_sortDirection" value="<?php echo $clsbpBopaBank->sortDirection; ?>"> 
          
          <input type="hidden"  name="clsbpBopaBank_action" value=""> 
 
          <input type="hidden" name="clsbpBopaBank_returnUrl" value=""> 
          <input type="hidden"  name="clsbpBopaBank_submitted" value="1">
                <tr>
                    <td class="hdr"><div id="searchpage-hdr">Show
                      <select name="showjmenu" id="showjmenu" class="showjmenu" onchange="javascript:changeOption('bpAjaxAccountActivity.php','1','clsbpBopaBank','frmbopabank','<?php echo $extraParameters;?>','accountActivity');">
                        <option value="1" <?php if($optionVal==1) {?>selected="selected"<?php } ?>>All Transaction Types</option>
                        <option value="2" <?php if($optionVal==2) {?>selected="selected"<?php } ?>>All Paid Transactions</option>
                        <option value="3" <?php if($optionVal==3) {?>selected="selected"<?php } ?>>All Received Transactions</option>
                      </select>&nbsp;&nbsp;&nbsp; Within
                      <select name="withinjmenu" id="withinjmenu" class="withinjmenu" onchange="javascript:changeOption('bpAjaxAccountActivity.php','1','clsbpBopaBank','frmbopabank','<?php echo $extraParameters;?>','accountActivity');">
                        <option <?php if($optionVal0==30) {?>selected="selected"<?php } ?> value="30">The past 30 Days</option>
                        <option <?php if($optionVal0==7) {?>selected="selected"<?php } ?> value="7">The past 7 days</option>
                        <option <?php if($optionVal0==60) {?>selected="selected"<?php } ?> value="60">The past 60 days</option>
                        <option <?php if($optionVal0==90) {?>selected="selected"<?php } ?> value="90">The past 90 days</option>
                        <option <?php if($optionVal0=='year') {?>selected="selected"<?php } ?> value="year">This calendar year</option>
                      </select> 
                    </div></td>
                </tr>
                 <tr ><td valign="top" id="bopa" class="bdy">&nbsp;</td></tr>
                 <tr>
               <tr>
                  <td class="ftr"> </td>
                </tr>
                 </form>  
		</table>
         
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
          <a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=597989&amp;afsid=1"> <img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#CCCCCC;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" /> </a></span>
          <!-- End: AdBrite -->
        </div>
    
</div>  

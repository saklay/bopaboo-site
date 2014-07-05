
<script>
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey; 
function fnGo()
{
window.location="<?= PCIURL ?>bpBopaBank.php";
return false;
}
function isAlphaNumeric(str){
  var re = /[^a-zA-Z0-9\/\-\s]/g 
  if (re.test(str)) return false;

}
function isAddress(str)
{
  var re = /[^a-zA-Z0-9\/\-\s/.&#97;]/g 
 if (re.test(str)) return false;
}
function fnValidate()
{

var errorlist="";
var invalid=" ";
if(document.frmCreditCard.clsbpCreditCard_txtCreditCardVer.value =="" || isNaN(document.frmCreditCard.clsbpCreditCard_txtCreditCardVer.value)== true || document.frmCreditCard.clsbpCreditCard_txtCreditCardVer.value.length != 3 || document.frmCreditCard.clsbpCreditCard_txtCreditCardVer.value.indexOf(invalid) > -1)
{


errorlist +="\n Enter a Valid 3 Digit Card Verification Number";



}


var datenow = new Date();
		
      var thism = datenow.getMonth()+1;
	  var thisy = datenow.getFullYear();
      var currentMonthYear = thisy + "" + thism;
      var uExpMonth = document.frmCreditCard.clsbpCreditCard_optMonth.value;
	  var uExpYear =document.frmCreditCard.clsbpCreditCard_optYear.value;
	  var uExpMonthYear = uExpYear + "" + uExpMonth;
	  uExpMonthYear = parseInt(uExpMonthYear);
	  currentMonthYear = parseInt(currentMonthYear);
  
    
if ( uExpMonthYear < currentMonthYear ){
     errorlist +="\n Please Enter a valid Expiry Date";
    }

if(document.frmCreditCard.clsbpCreditCard_optnewbilling[0].checked==true && document.frmCreditCard.clsbpCreditCard_txtAddres.value=="")
{
errorlist +="\n Please Enter  a valid Billing Address";
}
if(document.frmCreditCard.clsbpCreditCard_optnewbilling[0].checked==false && document.frmCreditCard.clsbpCreditCard_optnewbilling[1].checked==false)
{
errorlist +="\n Please Select a valid Billing Address";
}


if(document.frmCreditCard.clsbpCreditCard_optnewbilling[1].checked)

{



var valid = "0123456789-";
var hyphencount = 0;
var field =document.frmCreditCard.clsbpCreditCard_txtZipCode.value ; 

if (field.length!=5 && field.length!=10 ||isNaN(field) == true ) {
errorlist +="\n Please enter your 5 digit or 5 digit+4 Valid zip code.";

}


if(document.frmCreditCard.clsbpCreditCard_txtAddresone.value == "")
{
 errorlist +="\n Please Enter Address Line  one";


}
if(isAddress(document.frmCreditCard.clsbpCreditCard_txtAddresone.value) == false)
{
 errorlist +="\n Please Enter Valid Address Line  one";


}
if(isAddress(document.frmCreditCard.clsbpCreditCard_txtAddrestwo.value) == false)
{
 errorlist +="\n Please Enter Valid Address Line  two";


}
if(document.frmCreditCard.clsbpCreditCard_txtCity.value == "")
{
 errorlist +="\n Please Enter City";


}
if(isAlphaNumeric(document.frmCreditCard.clsbpCreditCard_txtCity.value )==false)
{
 errorlist +="\n Please Enter Alphabets in City";
}




if(document.frmCreditCard.clsbpCreditCard_optState.value ==0)
{
 errorlist +="\n Please Enter State";
}

}




if(errorlist =="")
{

 document.frmCreditCard.clsbpCreditCard_action.value="UPDATE";

return true;
} 
else
{
alert(errorlist);
return false;
}



}
function fnExpand(thistag,tag,showr) {
   styleObj=document.getElementById(thistag).style;
   if (showr=='show')
   {
   	styleObj.display='';
	
   }
   else {
   	styleObj.display='none';
   
   }
}
</script>




<div id="container">

      <div id="submenu">
             <a href="<?= HTTP ?>bpAccountActivity.php">bopaBank</a>	|	<a href="<?= HTTP ?>bpFeedback.php?feedbacklist=provided">Feedback</a>	|	<a href="<?= HTTP ?>bpMyBopaMessageInbox.php">Messages</a>
      </div>
        <div id="pagehead-bopabank">
          <h1>Edit Credit Card Information</h1><form action="" method="post" name="bopabankdetails">
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
                    <li class="accountactivity"><a href="<?= HTTP ?>bpAccountActivity.php">Account Activity</a></li>
                    <li class="withdrawfunds"><a href="<?= HTTPS ?>bpWithdraw.php">Withdraw Funds</a></li>
                    <li class="managecredit"><a href="<?= PCIURL ?>bpBopaBank.php" class="currentsel">Manage Credit Cards</a></li>
                  </ul></td>
                </tr>
                <tr>
                    <td class="hdr">&nbsp;</td>
            </tr>
            	<tr><td>
                <!-- NIL 07/21/08 start of  iframe -->
                			<iframe 
							frameborder="no"
							src ="<?=PCIURL?>bpCreditEditPCI.php"
							width="100%" height = "260px">
						</iframe>
				  <!-- end of iframe -->
</td></tr>
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
          <a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=597989&amp;afsid=1"> <img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#CCCCCC;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" /> </a> </span>
          <!-- End: AdBrite -->
        </div>
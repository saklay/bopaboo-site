
	<script>
			// NIL 07/21/08 
var invalid=" ";
function isAlphaNumeric(str){
  var re = /[^a-zA-Z0-9\/\-\s]/g 
  if (re.test(str)) return false;

}
function isAddress(str)
{
   var re = /[^a-zA-Z0-9\/\-\s/.&#97;]/g 
 if (re.test(str)) return false;
}

function isCheckNumeric(str){
  var re = /[^a-zA-Z\s]/g
  if (re.test(str)) return false;

}

function fnValidate(){

	var errorlist="";

		<!--if(document.frmCreditCard.selcard.value=="newcard"){-->
	
	if(document.getElementById("card3").style.display==''){

		if(document.frmCreditCard.clsbpCreditCard_txtFname.value == "")
		{
			errorlist +="\n Please Enter a First  Name";
		
		}

		if(isCheckNumeric(document.frmCreditCard.clsbpCreditCard_txtFname.value)==false)
		{
		 errorlist +="\n Enter Letters in  First  Name";
		}
		if(document.frmCreditCard.clsbpCreditCard_txtLname.value == "")
		{
		 errorlist +="\n Please Enter a  Last Name";
		
		
		
		}
		if(isCheckNumeric(document.frmCreditCard.clsbpCreditCard_txtLname.value)==false)
		{
		 errorlist +="\n Enter Letters in  Last  Name";
		}
	
		if(document.frmCreditCard.clsbpCreditCard_txtCardNum.value =="" ||isNaN(document.frmCreditCard.clsbpCreditCard_txtCardNum.value)==true || parseInt(document.frmCreditCard.clsbpCreditCard_txtCardNum.value.length) != 16 || document.frmCreditCard.clsbpCreditCard_txtCardNum.value.indexOf(invalid) > -1)
		{
		
		errorlist +="\n Enter a Valid Credit Card Number";
		}
		
		
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
        errorlist +="\n Please Enter a valid expiration Date"; // message changed by nilesh expiry => expiration
        }
		

//if(document.frmCreditCard.cpe[1].checked)
if(document.getElementById("cpe").style.display=='')
{

var valid = "0123456789-";
var hyphencount = 0;
var field =document.frmCreditCard.clsbpCreditCard_txtZipCode.value ; 

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
if (field.length!=5 && field.length!=10 ||isNaN(field) == true ) {
errorlist +="\n Please enter your 5 digit or 5 digit+4 Valid zip code.";

}
		
		}
		

		
		if(errorlist ==""){
		
		//alert(document.frmCreditCard.clsbpCreditCard_chkSavecard.value);
			if(document.frmCreditCard.clsbpCreditCard_chkSavecard.value==1){
			
			
			  document.frmCreditCard.clsbpCreditCard_action.value="SAVE";
			 
			 document.frmCreditCard.submit();
			 return true;
			}		
		
		} 
		else{
		
		alert(errorlist);
		return false;
		
		}
		
	}

		
	else if((document.frmCreditCard.clsbpCreditCard_txtCreditCardVer1.value =="" || isNaN(document.frmCreditCard.clsbpCreditCard_txtCreditCardVer1.value)== true || document.frmCreditCard.clsbpCreditCard_txtCreditCardVer1.value.length != 3 || document.frmCreditCard.clsbpCreditCard_txtCreditCardVer1.value.indexOf(invalid) > -1) && ( document.getElementById("card7").style.display==''&& document.getElementById("card2").style.display==''&& document.getElementById("card5").style.display=='') ) {

			//	alert(document.frmCreditCard.selectbank.value);
		alert("Enter a Valid 3 Digit Card Verification Number");
	
		return false;
		
		}
	
	



	
	else{
	//alert("4444 777");
	var frm = document.frmCreditCard;
	act="";
	if(document.getElementById("card7").style.display==''){ // exsiting CC
	act ="OLDCARD";
	
	//alert(act);
	}
	if(frm.selectbank.value=='yes'){ // bank only
	act =act+"YES";
	}
	if(document.getElementById("card7").style.display==''){ // exsiting CC
	
	act= act+"&cardId="+document.frmCreditCard.clsbpCreditCard_selCard.value+"&";
	}
	//if(document.frmCreditCard.selectbank.value=='yes'){// creditcard and bank
	//act =act+"BANKYES";
	//}
	//alert(act);
	
	frm.action="<?= HTTPS ?>bpOrderDetails.php?action="+act+"";
	frm.submit();

	
	
	}
	
}




function show(){
	if(trim(document.frmCreditCard.selectbank.value)== "no"){
	
	<?php
	$Visiblecard1 ='none';
	$minAmt =constant("serviceFloor");
if( $clsbpBopaCart->fn_cartSubTotal() < $minAmt){

// show the  card1 area
$Visiblecard1 ='';

}
else{

$Visiblecard1 ='none';
}
	?>
		
		
		document.getElementById("card1").style.display = 'none';
		<?php  if($cardCount > 0){ ?>
		//alert('asdsd');
		
		document.getElementById("card1").style.display = '<?php echo $Visiblecard1 ;?>';
		document.getElementById("card3").style.display = 'none';
		document.getElementById("card4").style.display = 'none';
		document.getElementById("hr2").style.display = '';
		document.getElementById("hr1").style.display = 'none'; <!--11111-->
		document.frmCreditCard.clsbpCreditCard_selCard.value="oldcard";
		document.getElementById("card2").style.display = '';
		document.getElementById("card5").style.display = '';
		document.getElementById("card7").style.display = '';
		document.getElementById("msg").style.display = 'none';
		
		<?php } else {?>
		//alert('asdsd111');
		document.getElementById("card1").style.display = '<?php echo $Visiblecard1 ;?>';
		document.getElementById("card2").style.display = '';
		document.getElementById("card3").style.display = '';
		document.getElementById("card4").style.display = '';
		document.getElementById("hr2").style.display = '';
		document.getElementById("msg").style.display = 'none';
		document.frmCreditCard.clsbpCreditCard_returnURL.value="bpOrderDetails.php?action=NEWCARD";
		<?php }?>
		
			if(document.frmCreditCard.clsbpCreditCard_selCard.value=="newcard"){
		
		document.getElementById("card3").style.display = '';
		document.getElementById("card4").style.display = '';
		document.getElementById("card5").style.display = '';
		document.getElementById("card7").style.display = 'none';
		document.getElementById("hr1").style.display = '';

		}
		
	
		
		
	}
	else
	{
		<?php
	
			$minAmt =constant("serviceFloor");
		if( $clsbpBopaCart->fn_cartSubTotal() < $minAmt){
		
		// show the  card1 area
		$Visiblecard1 ='';
		
		}
		else{
		
		$Visiblecard1 ='none';
		}
			?>
	
	document.frmCreditCard.clsbpCreditCard_returnURL.value="bpOrderDetails.php?action=NEWCARDYES";
	
	<?php 
	if($clsbpBopaCart->fn_cartSubTotal() < $clsbpPayment->retrieveBankAmountofUser()){
	$visiblehr2 ='none';
	}
	
	
	?>
	
			if(trim(document.frmCreditCard.selectbank.value)== "yes"){
		
		document.getElementById("card1").style.display = '';
		document.getElementById("card7").style.display = '';
		//document.getElementById("card3").style.display = '';
		//document.getElementById("card4").style.display = '';
		document.getElementById("hr1").style.display = '';
		document.getElementById("hr2").style.display = 'none'; <!--last-->
		document.getElementById("msg").style.display = ''; <!--last-->
		}
		if(document.frmCreditCard.clsbpCreditCard_selCard.value=="newcard"){
		//alert('new');
	
		document.getElementById("card3").style.display = '';
		document.getElementById("card4").style.display = '';
		document.getElementById("card5").style.display = '';
		document.getElementById("card7").style.display = 'none';
		document.getElementById("hr1").style.display = '';
		document.frmCreditCard.clsbpCreditCard_returnURL.value="bpOrderDetails.php?action=OLDCARDYES";
		//alert(document.frmCreditCard.clsbpCreditCard_returnURL.value);
		}
		else{
		//alert('old');
		
		document.getElementById("card1").style.display = '';
		document.getElementById("card3").style.display = 'none';
		document.getElementById("card4").style.display = 'none';
			if(trim(document.frmCreditCard.selectbank.value)== "yes"){
			document.getElementById("card3").style.display = 'none';
		    document.getElementById("card4").style.display = 'none';
			}
		}
	
		
		if(parseInt(document.frmCreditCard.bankBalance.value) > parseInt(document.frmCreditCard.subTotalPrice.value) ){
		
		document.getElementById("card1").style.display = 'none';
		document.getElementById("card2").style.display = 'none';
		document.getElementById("card3").style.display = 'none';
		document.getElementById("card4").style.display = 'none';
		document.getElementById("card5").style.display = 'none';
		document.getElementById("card7").style.display = 'none';
		
		
		}
		
	}
}

function showcard(){

	if(trim(document.frmCreditCard.clsbpCreditCard_selCard.value)== "newcard"){
	//alert('adsd');
	<?php
	
			$minAmt =constant("serviceFloor");
		if( $clsbpBopaCart->fn_cartSubTotal() < $minAmt){
		?>
		<?php } ?>
		document.getElementById("card1").style.display = '';
		document.getElementById("card3").style.display = '';
		document.getElementById("card4").style.display = '';
		document.getElementById("card5").style.display = '';
		document.getElementById("card7").style.display = 'none';
		document.getElementById("hr1").style.display = '';
		if(trim(document.frmCreditCard.selectbank.value)== "no"){
		document.getElementById("card1").style.display = 'none';
		}
		<?php
	
			$minAmt =constant("serviceFloor");
		if( $clsbpBopaCart->fn_cartSubTotal() < $minAmt){
		?>
		document.getElementById("card1").style.display = '';
		<?php } ?>
		
		<?php
		if($addCount > 0) { 
		?> 
		document.getElementById("cpe").style.display = 'none';
		<?php  }
		
		?>
				<?php
				if($clsbpPayment->retrieveBankAmountofUser() == 0 ) {
				?>
				
				document.getElementById("card1").style.display = 'none';
				
				<?php } ?>
		
		
	}
	else
	{
	
		document.getElementById("card1").style.display = '';
		document.getElementById("card3").style.display = 'none';
		document.getElementById("card4").style.display = 'none';
		document.getElementById("card5").style.display = '';
		document.getElementById("card7").style.display = '';
		document.getElementById("hr1").style.display = 'none';
		if(trim(document.frmCreditCard.selectbank.value)== "no"){
		document.getElementById("card1").style.display = 'none';
		}
		<?php
	
			$minAmt =constant("serviceFloor");
		if( $clsbpBopaCart->fn_cartSubTotal() < $minAmt){
		?>
		document.getElementById("card1").style.display = '';
		<?php } ?>

		if(parseInt(document.frmCreditCard.bankBalance.value) < parseInt(document.frmCreditCard.subTotalPrice.value) ){
		document.frmCreditCard.clsbpCreditCard_returnURL.value="bpOrderDetails.php?action=OLDCARDYES";
		
		
		}
		
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

function submitBack() {
	var frm = document.frmCreditCard;
	frm.action="<?= HTTP ?>bpBuy.php";
	frm.submit();
}

</script>
	<div id="container">
<form  method="post" name="frmCreditCard" onsubmit="return fnValidate();" >
    <div id="viewcartpaymentdet">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tholder">
        <tr>
          <td width="73%" valign="top"><table border="0" cellpadding="0" cellspacing="0" class="tbl001c">
              <tr>
                <td class="hdr">Billing Information</td>
              </tr>
              <tr>
                <td valign="top" class="content"><table width="620" border="0" cellpadding="0" cellspacing="0" class="sections">
                  <tr>
                    <td colspan="4" class="section01"><span class="hdg">Pay by bopaBank</span><br />
                      Your current bopaBank balance is <strong>$<?php $bankBalance = $clsbpPayment->retrieveBankAmountofUser();   $balance = number_format($bankBalance,2) ; echo $balance;?></strong><br />
                      Would you like to use this balance for this purchase?<br />
                      <select name="selectbank" id="selectbank"  onChange="show();">
                      <?php if($clsbpPayment->retrieveBankAmountofUser() > 0 ) {?>  <option value="yes">Yes</option><?php }?>
                        <option value="no">No</option>
                      </select>      <br>      <div id="msg">  <?php if($clsbpPayment->retrieveBankAmountofUser() > $clsbpBopaCart->fn_cartSubTotal()){ echo "Click Next Step to Confirm your Purchase&nbsp;!"; } ?></div><hr id="hr2" style="height:0;border:0;border-top:1px solid #D3D5D6; " />                   </td>
        
                  </tr>
          <tr>
                    <td colspan="4" class="section01"></td></tr>
                  <tr  id="card1" > 
                    <td colspan="4" class="section02"><strong>$<?php if($Visiblecard1 =='') { echo '0'; } else { echo $balance;}?> applied to your purchase. You still owe $<?php  if($Visiblecard1 =='') {  echo number_format($clsbpBopaCart->fn_cartSubTotal(),2); } else { echo number_format($clsbpBopaCart->fn_cartSubTotal()-$balance,2);} ?><br />
                      Please enter your Credit Card information.</strong><br />
                      <br />
                     <?php if(($clsbpBopaCart->fn_cartSubTotal()-$balance) < $minAmt){?> <span class="warning">* All Credit Card transactions below <?php echo constant("serviceFloor");?> will incur a $<?php print constant("serviceCharge"); ?> transaction fee</span><?php } ?>
                     <hr style="height:0;border:0;border-top:1px solid #D3D5D6; "/>  </td>
                  </tr>
                  <tr id="card2">
                    <td colspan="4" class="section03"><span class="hdg">Credit Card Information</span><br />
                      bopaboo uses a secure connection to protect the privacy and security of your personal information.<br />
                                     </td>
                  </tr>
                   <tr >
                    <td colspan="4" class="section03">&nbsp;
                                     </td>
                  </tr>
                    <tr id="card5" class="" >
                      <td colspan="4" style="padding-left:17px; padding-bottom:5px;" >
                      <select onchange="showcard();" name="clsbpCreditCard_selCard" id="clsbpCreditCard_selCard" class="currentaddress">                       
					  <?php if($addCount>0) {  echo $CardList;  } ?>
                      <option value="newcard">Use New Card&nbsp;&nbsp;</option>
       				 </select><br /><br /><hr id="hr1" style="height:0;border:0;border-top:1px solid #D3D5D6; "/></td>
                    </tr>
                    <tr id="card7"   >
                
                    <td width="143" style="padding-left:17px;" ><strong>Credit Card ID :  </strong></td>
                    <td width="33" style="padding-left:9px;"><input name="clsbpCreditCard_txtCreditCardVer1"  type="text" id="clsbpCreditCard_txtCreditCardVer1" value="<?php  echo $clsbpCreditCard->i_CCV; ?>" size="4" maxlength="3"/></td>
                               
                    <td width="106"  style="padding-left:27px;">&nbsp;<img src="../images/img-cc-backside.jpg" alt="card verification number" width="59" height="33" border="0" /></td>
                    <td width="338" ><a href='javascript:void(0);' onClick='javascript:window.open("<?= HTTP ?>bpCardPopUp.php","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,screenX=150,screenY=150,top=150,left=150,height=450,width=570");' class="edit-remove">Where is my Credit Card ID?</a>&nbsp;</td>
                    </tr>
                  <tr id="card3">
                    <td colspan="4" class="section04">Debit Cards (also called check cards, ATM cards, or banking cards) are accepted if they have a Visa or MasterCard logo.<br />
                        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="5" class="addnewcard">
                          <tr>
                            <td width="23%" align="right" class="tdheight">&nbsp;</td>
                            <td width="77%" class="tdheight">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="right" valign="top" class="darktext"><strong>First Name:</strong></td>
                            <td><input type="text"  name="clsbpCreditCard_txtFname" value="<?php echo $clsbpCreditCard->vc_first_nm	; ?>"  id="textfield" class="inputtext2" /></td>
                          </tr>
                          <tr>
                            <td align="right" valign="top" class="darktext"><strong>Last Name:</strong></td>
                            <td><input name="clsbpCreditCard_txtLname" value="<?php  echo $clsbpCreditCard->vc_last_nm; ?>"  type="text"  class="inputtext2" id="textfield6" /></td>
                          </tr>
                          <tr>
                            <td align="right" valign="top" class="darktext"><strong>Card Number:</strong></td>
                            <td><input name="clsbpCreditCard_txtCardNum"  type="text" class="inputtext2" id="ccnumber" value="<?php  echo $clsbpCreditCard->bi_card_num; ?>" maxlength="16" />
                              &nbsp;&nbsp;&nbsp;<img src="../images/icon-visacard.png" alt="visa card" width="51" height="25" border="0" align="absmiddle" />&nbsp;&nbsp;<img src="../images/icon-mastercards.png" alt="mastercard" width="50" height="25" border="0" align="absmiddle" /></td>
                          </tr>
                          <tr>
                            <td align="right" valign="top" class="darktext"><strong>Expiration Date:</strong></td>
                            <td><select name="clsbpCreditCard_optMonth">
                             
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
            <option value="4">04</option>
            <option value="5">05</option>
            <option value="6">06</option>
            <option value="7">07</option>
            <option value="8">08</option>
            <option value="9">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
         
          </select>
                              &nbsp;&nbsp;&nbsp;
                             <select name="clsbpCreditCard_optYear" id="select2">
                             
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
          </select>                             </td>
                          </tr>
                          <tr>
                            <td align="right" class="darktext"><strong>Credit Card ID :  </strong></td>
                            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="cardback">
                                <tr>
                                  <td width="25"><input name="clsbpCreditCard_txtCreditCardVer"  type="text" id="textfield" value="<?php  echo $clsbpCreditCard->i_CCV; ?>" size="4" maxlength="3"/></td>
                                  <td width="69" ><img src="../images/img-cc-backside.jpg" alt="card verification number" width="59" height="33" border="0" /></td>
                                  <td width="366"><a href='javascript:void(0);' onClick='javascript:window.open("bpCardPopUp.php","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,screenX=150,screenY=150,top=150,left=150,height=450,width=570");'  class="edit-remove">Where is my Credit Card ID?</a></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="right" class="darktext">&nbsp;</td>
                            <td valign="top"><input type="checkbox" name="clsbpCreditCard_chkSavecard" id="clsbpCreditCard_chkSavecard" value="1" />
                              Save Credit Card in Profile</td>
                          </tr>
                      </table><hr style="height:0;border:0;border-top:1px solid #D3D5D6; "/>  </td>
                  </tr>
                  <tr id="card4">
                    <td colspan="4" class="section05"><span class="hdg">Billing Address</span><br />
                      Enter the address where you receive billing statements for this card. In order to verify your bank card number, the billing address must be the one displayed on your bank receipt.<br />
                      <br />
                      <span class="lalign"></span>
                   <?php
 if($addCount > 0) { 
?>    <input type="radio" name="clsbpCreditCard_optnewbilling" <?php if($addCount==0) { ?> disabled="disabled" <? } ?> checked="checked" id="clsbpCreditCard_optnewbilling" value="Enterold" onclick="fnExpand('cpe', this,'hide');"/>
     <span class="darktext">Use existing address as billing address:</span><br /><?php }?>
                    <?php
 if($addCount > 0) { 
?>   <select name="clsbpCreditCard_txtAddres" id="select3" class="currentaddress">
					  <?php echo $addresslist		; ?>
       				 </select> <?php }?>
                      <br />
                      <br />
                      <span class="lalign"></span><input <?php if($addCount==0) { ?> checked="checked" <? } ?> type="radio" name="clsbpCreditCard_optnewbilling" id="clsbpCreditCard_optnewbilling2"   onclick="fnExpand('cpe', this,'show');" value="EnterNew"/>
                        <span class="darktext">Enter a new billing address</span> <div style="display:none;" id="cpe" >
                      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="4" class="addnewcard1" >
                        <tr>
                          <td align="right" valign="top" class="valign"></td>
                          <td class="valign"></td>
                        </tr>
                        <tr>
                          <td width="23%" align="right" valign="top" class="darktext">Address Line 1:</td>
                          <td width="77%"><input type="text" name="clsbpCreditCard_txtAddresone" value="<?php  echo $clsbpCreditCard->vc_addrone; ?>" id="addressline1" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top"><span class="darktext">Address Line 2:</span><br />
                           <span class="optional">(optional)</span></td>
                          <td valign="top"><input type="text"  name="clsbpCreditCard_txtAddrestwo" value="<?php  echo $clsbpCreditCard->vc_addrtwo; ?>"  id="addressline2" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">City:</td>
                          <td valign="top"><input type="text"  name="clsbpCreditCard_txtCity" value="<?php  echo $clsbpCreditCard->vc_city ; ?>" id="city" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">State:</td>
                          <td valign="top"><select name="clsbpCreditCard_optState" id="state">
                          <option value="0">Select</option>
                         <option value="Alabama">Alabama</option>
      <option value="Alaska">Alaska</option>

      <option value="Arizona">Arizona</option>
      <option value="Arkansas">Arkansas</option>
      <option value="California">California</option>
      <option value="Colorado">Colorado</option>
      <option value="Connecticut">Connecticut</option>
      <option value="D.C.">D.C.</option>

      <option value="Delaware">Delaware</option>
      <option value="Florida">Florida</option>
      <option value="Georgia">Georgia</option>
      <option value="Hawaii">Hawaii</option>
      <option value="Idaho">Idaho</option>
      <option value="Illinois">Illinois</option>

      <option value="Indiana">Indiana</option>
      <option value="Iowa">Iowa</option>
      <option value="Kansas">Kansas</option>
      <option value="Kentucky">Kentucky</option>
      <option value="Louisiana">Louisiana</option>
      <option value="Maine">Maine</option>

      <option value="Maryland">Maryland</option>
      <option value="Massachusetts">Massachusetts</option>
      <option value="Michigan">Michigan</option>
      <option value="Minnesota">Minnesota</option>
      <option value="Mississippi">Mississippi</option>
      <option value="Missouri">Missouri</option>

      <option value="Montana">Montana</option>
      <option value="Nebraska">Nebraska</option>
      <option value="Nevada">Nevada</option>
      <option value="New Hampshire">New Hampshire</option>
      <option value="New Jersey">New Jersey</option>
      <option value="New Mexico">New Mexico</option>

      <option value="New York">New York</option>
      <option value="North Carolina">North Carolina</option>
      <option value="North Dakota">North Dakota</option>
      <option value="Ohio">Ohio</option>
      <option value="Oklahoma">Oklahoma</option>
      <option value="Oregon">Oregon</option>

      <option value="Pennsylvania">Pennsylvania</option>
      <option value="Rhode Island">Rhode Island</option>
      <option value="South Carolina">South Carolina</option>
      <option value="South Dakota">South Dakota</option>
      <option value="Tennessee">Tennessee</option>
      <option value="Texas">Texas</option>

      <option value="Utah">Utah</option>
      <option value="Vermont">Vermont</option>
      <option value="Virginia">Virginia</option>
      <option value="Washington">Washington</option>
      <option value="West Virginia">West Virginia</option>
      <option value="Wisconsin">Wisconsin</option>

      <option value="Wyoming">Wyoming</option>
                          </select></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">Zip Code:</td>
                          <td valign="top"><input type="text" name="clsbpCreditCard_txtZipCode" value="<?php  echo $clsbpCreditCard->vc_zipcode; ?>"  id="zipcode" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="darktext">Country:</td>
                          <td>United States</td>
                        </tr>
                      </table></div>
                      <br />
                      <br />
                      <span class="darktext"><span class="lalign"></span>&nbsp;&nbsp;&nbsp;&nbsp;For your protection, we verify credit card information.</span><br />
                      <br />                          The process normally takes about 30 seconds, but it may take longer during certain times of the day. </td>
                  </tr><!--</div>-->
                </table></td>
              </tr>
              <tr>
                <td class="footer">&nbsp;</td>
              </tr>
          </table></td>
          <td width="27%" valign="top"><table border="0" cellpadding="0" cellspacing="0" class="sidebox001">
            <tr>
              <td class="hdr">Order Summary</td>
            </tr>
            <tr>
              <td valign="top" class="content"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="ordersummary">
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
                  <td width="60%"><h3>Total:</h3></td>
                  <td width="40%"><h3><?php  echo "$".number_format($clsbpBopaCart->fn_cartSubTotal(),2) ;?></h3></td>
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
                    <td height="40" align="center"><input type="image"  name="form_submitted" src="../images/btn-nextstep.jpg" value="Next Step"  width="165" height="26px"/></td>
                  </tr> 
                  <tr>
                    <td height="40" align="center"><a href="<?= HTTP ?>bpViewCart.php"><img src="../images/btn-revisedstep.jpg" alt="Revised" width="165" height="26" border="0" /></a></td>
                  </tr>
                  <tr>
                    <td height="40" align="center"><a href="javascript: void(0)"><img src="../images/btn-continueshopping.jpg" alt="Continue Shopping" width="165" height="26" border="0" onclick="javascript: submitBack();"/></a></td>
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
                      <td height="40" align="center"><img src="../images/logo-trusteecert.jpg" alt="Trustee" width="110" height="30" /></td>
                    </tr>
                    <tr>
                      <td height="40" align="center"><br />
                        <img src="../images/godaddy-logo.gif" alt="Go Daddy" width="70" height="35" /></td>
                    </tr>
                    
                    
                </table></td>
              </tr>
              <tr>
                <td class="footer">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div> <input type="hidden"  id="clsbpCreditCard_action" name="clsbpCreditCard_action" value="">
            <input type="hidden"  id="clsbpCreditCard_returnURL" name="clsbpCreditCard_returnURL" value="">
            <?php if($bankBalance < $subTotalPrice){

$cardStatus =1;

}
else
{

$cardStatus =0;
} ?>
            <input type="hidden"  id="cardStatus" name="cardStatus" value="<?php echo $cardStatus; ?>">
            <input type="hidden"  id="bankBalance" name="bankBalance" value="<?php echo $bankBalance; ?>">
            <input type="hidden"  id="subTotalPrice" name="subTotalPrice" value="<?php echo $subTotalPrice; ?>">
    </form>
</div>


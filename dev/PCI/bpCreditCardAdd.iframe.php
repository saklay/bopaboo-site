<script>
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey; 
function fnGo()
{

window.location="<?=HTTPS?>bpBopaBank.php";
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

function isCheckNumeric(str){
  var re = /[^a-zA-Z\s]/g
  if (re.test(str)) return false;

}

function fnValidate()
{

var errorlist="";
if(document.frmCreditCard.clsbpCreditCard_txtFname.value == "")
{
    errorlist +="\n Please enter a First  Name";

}

if(isCheckNumeric(document.frmCreditCard.clsbpCreditCard_txtFname.value)==false)
{
 errorlist +="\n Enter Letters in  First  Name";
}
if(document.frmCreditCard.clsbpCreditCard_txtLname.value == "")
{
 errorlist +="\n Please enter a  Last Name";



}
if(isCheckNumeric(document.frmCreditCard.clsbpCreditCard_txtLname.value)==false)
{
 errorlist +="\n Enter Letters in  Last  Name";
}

var invalid=" ";
if(document.frmCreditCard.clsbpCreditCard_txtCardNum.value =="" ||isNaN(document.frmCreditCard.clsbpCreditCard_txtCardNum.value)==true || parseInt(document.frmCreditCard.clsbpCreditCard_txtCardNum.value.length) != 16 || document.frmCreditCard.clsbpCreditCard_txtCardNum.value.indexOf(invalid) > -1)
{

errorlist +="\n Enter A Valid Credit Card Number";
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

 document.frmCreditCard.clsbpCreditCard_action.value="SAVE";

return true;
} 
else
{
alert(errorlist);
return false;
}
}
function fnEnterNewBilling()
{
if(document.frmCreditCard.clsbpCreditCard_optnewbilling[1].checked==true)
{

var styleObj=document.getElementById('cpe').style;
styleObj.display='';
return true;
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


          <form  method="post" target ="_parent" name="frmCreditCard" onsubmit="return fnValidate();">
          <table class="datalist">
                <tr>
                  <td valign="top" class="bdy"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="addccard">
                    <tr>
                      <td><span class="textpadd">Debit Cards (also called check cards, ATM cards, or banking cards) are accepted if they have a Visa or MasterCard logo.</span></td>
                    </tr>
                    <tr>
                      <td><span class="textpadd"><strong>Number of cards active on your account: <?php echo $clsbpCreditCard->num;?></strong></span></td>
                    </tr>
                    <tr>
                      <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="addnewcard">
                        <tr>
                          <td width="23%" align="right" class="tdheight">&nbsp;</td>
                          <td width="77%" class="tdheight">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">First Name:</td>
                          <td><input type="text"  name="clsbpCreditCard_txtFname" value="<?php echo $clsbpCreditCard->vc_first_nm	; ?>"  id="textfield" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">Last Name:</td>
                          <td><input name="clsbpCreditCard_txtLname" value="<?php  echo $clsbpCreditCard->vc_last_nm; ?>"  type="text"  class="inputtext2" id="textfield6" /></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">Card Number:</td>
                          <td><input name="clsbpCreditCard_txtCardNum" value="<?php  echo $clsbpCreditCard->bi_card_num; ?>"  type="text" id="ccnumber" class="inputtext2" maxlength="16" />
                          &nbsp;&nbsp;&nbsp;<img src="<?= HTTP ?>images/icon-visacard.png" alt="visa card" width="51" height="25" border="0" align="absmiddle" />&nbsp;&nbsp;<img src="<?= HTTP ?>images/icon-mastercards.png" alt="mastercard" width="50" height="25" border="0" align="absmiddle" /></td>
                        </tr>
                        
                        <tr>
                          <td align="right" valign="top" class="darktext">Expiration Date:</td>
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
          </select>                         </td>
                        </tr>
                        <tr>
                          <td align="right" class="darktext">Card Verification Number: </td>
                          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="cardback">
                              <tr>
                                <td width="15">

                               <input name="clsbpCreditCard_txtCreditCardVer" value="<?php  echo $clsbpCreditCard->i_CCV; ?>"  type="text" id="textfield" size="4" maxlength="3"/>
                                
                                </td>
                                <td width="70"><img src="<?= HTTP ?>images/img-cc-backside.jpg" alt="card verification number" width="59" height="33" border="0" /></td>
                                <td>(on the back of your card, locate the final 3 digit number)<br />
                                  <a href='javascript:void(0);' onClick='javascript:window.open("<?= HTTP ?>bpCardPopUp.php","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,screenX=150,screenY=150,top=150,left=150,height=450,width=570");' class="edit-remove">Help finding your Card Verification Number</a></td>
                              </tr>
                              
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><h3>Billing Address</h3></td>
                    </tr>
                    <tr>
                      <td class="commontext">Enter the address where you receive billing statements for this card. In order to verify your bank card number, the billing address must be the one displayed on your bank receipt.</td>
                    </tr>
                    
                    <tr>
                      <td><span class="lalign"></span><input type="radio" name="clsbpCreditCard_optnewbilling" id="radio" value="Enterold" onclick="fnExpand('cpe', this,'hide');"/>
                        <span class="darktext">Use existing address as billing address:</span></td>
                    </tr>
                    <tr>
                      <td><span class="lalign"></span><select name="clsbpCreditCard_txtAddres" id="select3" class="currentaddress">
                      
       <?php echo $addresslist		; ?>
        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><span class="lalign"></span><input type="radio" name="clsbpCreditCard_optnewbilling" id="clsbpCreditCard_optnewbilling"   onclick="fnExpand('cpe', this,'show');" value="EnterNew" <?php if($clsbpCreditCard->num == 0) { echo "checked";} ?>/>
                        <span class="darktext">Enter a new billing address</span></td>
                    </tr>
                     
                    <tr>
                      <td>
                      
                      <div style="display:none;" id="cpe" >
                      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="addnewcard1">
                        <tr>
                          <td align="right" valign="top" class="valign"></td>
                          <td class="valign"></td>
                        </tr>
                        <tr>
                          <td width="23%" align="right" valign="top" class="darktext">Address Line 1:</td>
                          <td width="77%"><input type="text" name="clsbpCreditCard_txtAddresone" value="<?php  echo $clsbpCreditCard->vc_addrone; ?>" id="addressline1" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">Address Line 2:</td>
                          <td><input type="text"  name="clsbpCreditCard_txtAddrestwo" value="<?php  echo $clsbpCreditCard->vc_addrtwo; ?>"  id="addressline2" class="inputtext2" /></td>
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
                      </table></td>
                    </tr>
                    <tr>
                      <td class="darktext"><span class="lalign"></span>For your protection, we verify credit card information.</td>
                    </tr>
                    <tr>
                      <td class="commontext">The process normally takes about 30 seconds, but it may take longer during certain times of the day. Please click the Add Card button to update your information. When your card has been successfully added, you will see a confirmation page.</td>
                    </tr>
                  </table></td>
            </tr>
			<tr>
                <td align="right">
                  <input type="image" src="<?= HTTP ?>images/btn-cancel.png" onclick="return fnGo();" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="<?= HTTP ?>images/btn-addcard.png"/>
                  <input type="hidden"  id="clsbpCreditCard_action" name="clsbpCreditCard_action" value="">
            	  <input type="hidden"  id="clsbpCreditCard_returnUrl" name="clsbpCreditCard_returnUrl" value="bpBopaBank.php">
           		</td>
            </tr>
      </table>
   </form>


<script>
	// NIL 07/21/08 
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey; 
function fnGo()
{
//window.location="<?= HTTPS ?>bpBopaBank.php";
parent.document.location="<?= HTTPS ?>bpBopaBank.php";
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
	 <form  method="post" name="frmCreditCard" onsubmit="return fnValidate();">
          <table width="914" border="0" cellspacing="0" cellpadding="0" class="datalist">

                <tr>
                  <td valign="top" class="bdy"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="editccard">
                    <tr>
                      <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="editcardback">
                        <tr>
                          <td width="23%" align="right" class="tdheight">&nbsp;</td>
                          <td width="77%" class="tdheight">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="right" class="darktext"><strong>Selected Card:</strong></td>
                          <td>xxxx-xxxx-xxxx-<?php echo substr("$clsbpCreditCard->bi_card_num", -4);    ?></td>
                        </tr>
                        <tr>
                          <td align="right" class="darktext">Expiration Date:</td>
                          <td> <?php  echo substr($clsbpCreditCard->d_DateofExpiry,5,2)."/".substr($clsbpCreditCard->d_DateofExpiry,0,4); ?></td>
                        </tr>
                        <tr>
                          <td align="right" class="darktext">New Expiration Date:</td>
                          <td><select name="clsbpCreditCard_optMonth">
                            
         
            <?php echo $monthList; ?>
                            </select>
                            &nbsp;&nbsp;&nbsp;
                            <select name="clsbpCreditCard_optYear" id="select2">
                               
                             
                                <?php echo $yearList ?>
                                
          </select>                         </td>
                        </tr>
                        <tr>
                          <td align="right" class="darktext">Card Verification Number: </td>
                          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="cardback">
                              <tr>
                                <td width="15"><input name="clsbpCreditCard_txtCreditCardVer" value="" type="text" id="textfield" size="4" maxlength="3"/></td>
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
                      <td><span class="lalign"></span><input type="radio" name="clsbpCreditCard_optnewbilling" value="EnterOld" onclick="fnExpand('cpe', this,'hide');" id="radio"  />
                        <span class="darktext">Use existing address as billing address:</span></td>
                    </tr>
                    <tr>
                      <td><span class="lalign"></span><select name="clsbpCreditCard_txtAddres" id="select3" class="currentaddress">
                       
                       
       <?php echo $addresslist	; ?>
        </select>                    </td>
                    </tr>
                    <tr>
                      <td><span class="lalign"></span>
                     <input type="radio" name="clsbpCreditCard_optnewbilling" id="clsbpCreditCard_optnewbilling"   onclick="fnExpand('cpe', this,'show');" value="EnterNew"/>
                        <span class="darktext">Enter a new billing address</span></td>
                    </tr>
                    <tr>
                      <td>
                      <div style="display:none;" id="cpe">
                      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="editcardback1">
                        
                        <tr>
                          <td align="right" valign="top" class="valign"></td>
                          <td class="valign"></td>
                        </tr>
                        <tr>
                          <td width="23%" align="right" valign="top" class="darktext">Address Line 1:</td>
                          <td width="77%"><input type="text" name="clsbpCreditCard_txtAddresone" id="textfield2" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">Address Line 2:</td>
                          <td><input type="text" name="clsbpCreditCard_txtAddrestwo" id="textfield3" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">City:</td>
                          <td valign="top"><input type="text" name="clsbpCreditCard_txtCity" id="textfield4" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" class="darktext">State:</td>
                          <td valign="top"><select name="clsbpCreditCard_optState" id="select4">
                          <option value="0">Select State</option>
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
                          <td valign="top"><input type="text" name="clsbpCreditCard_txtZipCode" id="textfield6" class="inputtext2" /></td>
                        </tr>
                        <tr>
                          <td align="right" class="darktext">Country:</td>
                          <td>United States</td>
                        </tr>
                        
                      </table>
                      </div>
                      </td>
                    </tr>
                    
                    <tr>
                      <td class="darktext"><span class="lalign"></span>For your protection, we verify credit card information.</td>
                    </tr>
                    <tr>
                      <td class="commontext">Enter the address where you receive billing statements for this card. In order to verify your bank card number, the billing address must be the one displayed on your bank receipt.</td>
                    </tr>
                  </table></td>
            </tr>
                <tr>
                  <td class="ftr">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">
                  
            
                  <input type="image" src="<?= HTTP ?>images/btn-cancel.png" onclick="return fnGo();" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" src="<?= HTTP ?>images/btn-save.png" />
                  <input type="hidden"  id="clsbpCreditCard_bi_card_id" name="clsbpCreditCard_bi_card_id" value="<?php echo $clsbpCreditCard->bi_card_id;?>">
                     <input type="hidden"  id="clsbpCreditCard_action" name="clsbpCreditCard_action" value="">
            <input type="hidden"  id="clsbpCreditCard_returnUrl" name="clsbpCreditCard_returnUrl" value="bpBopaBank.php"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
          </table>
           </form>
</div>
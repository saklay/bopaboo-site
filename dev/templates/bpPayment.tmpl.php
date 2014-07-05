<script>
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
      
  <!--<div id="viewcartpayment">
        	<h1>Shopping Cart</h1>
        	<h2><a href="<?= HTTP ?>bpViewCart.php" class="spaceleft">View Cart</a> </h2>      
       	<img src="images/icon-arrow-viewcart.png" alt="Next" width="57" height="12" class="arrow" /><h2><a href="<?= HTTPS ?>bpPayment.php"><img src="images/btn-viewcart.png" alt="View Cart" width="39" height="44" border="0" class="viewcart1" />Payment</a></h2>
       	<img src="images/icon-arrow-viewcart.png" alt="Next" width="57" height="12" class="arrow" />
       	<h2><a href="<?= HTTPS ?>bpOrderDetails.php">Place Order</a></h2>
    </div>-->

                <!-- NIL 07/21/08 start of  iframe -->
                	 	<iframe 
							frameborder="no"
							src ="<?=PCIURL?>bpPaymentPCI.php"
							width="100%" height = "400px">
						</iframe> 
				  <!-- end of iframe -->	
  </div>
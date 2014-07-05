<?php

    $includePath		= "../";

    include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
    include_once($includePath."bpSessionCheck.php");
	include_once($includePath."classes/bpBopaCart.cls.php");
	include_once($includePath."classes/bpPayment.cls.php");
	include_once($includePath."classes/bpUserLogin.cls.php");
    include_once($includePath."classes/bpCreditCard.cls.php");
	 
	 
	$clsbpCreditCard	= new clsbpCreditCard($connect, $includePath,"clsbpCreditCard");
	$clsbpCreditCard->setPostVars();
	$clsbpCreditCard->setGetVars();
	
	/*----------------------------------------------------------------------------	
	 Created cart object*/
	$clsbpBopaCart	= new clsbpBopaCart($connect, $includePath,"clsbpBopaCart");
	$clsbpBopaCart->postCart();
	/*---------------------------------------------------------------------------*/
	
	/*----------------------------------------------------------------------------	
	 Created payment object*/
	$clsbpPayment	= new clsbpPayment($connect, $includePath,"clsbpPayment");
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();
	
	/*---------------------------------------------------------------------------*/
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bopaboo – Your Place to Buy and Sell Digital Music</title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="../images/logo.ico">
<link href="../styles/bopaboov2.css" rel="stylesheet" type="text/css" />

<link href="../styles/custom.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../scripts/bpCommon.js"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="../styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="../scripts/pngfix.js"></script>
<![endif]-->
<script language="javascript">
	function clstext(){
		document.form2.textfield.value="";
		}
</script>
<?php 

if($clsbpPayment->retrieveBankAmountofUser() < $clsbpBopaCart->fn_cartSubTotal()){
$visible ='';
$cardStatus =1;
$bankstatus = "bpOrderDetails.php?action=NEWCARDYES";
}
else
{
$visible ='none';
$cardStatus =0;
$bankstatus = "bpOrderDetails.php?action=NEWCARD";
}
?>




</head>

<body>
	<!-- NIL 07/21/08 new add start -->
<?php
 if($addCount==0) { 
?> 
<script language="javascript">
 document.getElementById("cpe").style.display = '';
 document.frmCreditCard.clsbpCreditCard_optnewbilling.checked=true;
  document.frmCreditCard.clsbpCreditCard_chkSavecard.checked=true;
 </script>
<?php  }


?>


<script language="javascript">

document.frmCreditCard.clsbpCreditCard_returnURL.value="<?php echo $bankstatus ;?>";
document.getElementById("card1").style.display = '<?php echo $visible ;?>';
document.getElementById("card2").style.display = '<?php echo $visible ;?>';
document.getElementById("card3").style.display = '<?php echo $visible ;?>';
document.getElementById("card4").style.display = '<?php echo $visible ;?>';
document.getElementById("card5").style.display = '<?php echo $visible ;?>';
document.getElementById("card7").style.display = 'none';
document.getElementById("hr2").style.display = '<?php echo $visible ;?>';

</script>
<?php  if(($cardCount > 0 )&& ($clsbpPayment->retrieveBankAmountofUser() < $clsbpBopaCart->fn_cartSubTotal())){ ?>
<script language="javascript">
document.getElementById("card3").style.display = 'none';
document.getElementById("card4").style.display = 'none';
document.getElementById("card5").style.display = '';
document.getElementById("card7").style.display = '';
document.getElementById("hr1").style.display = 'none';
document.frmCreditCard.clsbpCreditCard_selCard.value= "oldcard";
</script>
<?php } ?>

<?php

if($clsbpPayment->editcc=='OLDCARD'){
$minAmt =constant("serviceFloor");

	if($clsbpBopaCart->fn_cartSubTotal() < $minAmt)
	{
	$cardDis ='';
	}
	else{
	$cardDis ='none';
	}
?>
<script language="javascript">
document.frmCreditCard.selectbank.value= "no";
document.getElementById("hr2").style.display = '';
document.getElementById("hr1").style.display = 'none';
document.getElementById("msg").style.display = 'none';
document.getElementById("card1").style.display = '<?php echo $cardDis ;?>';
document.getElementById("card2").style.display = '';
document.getElementById("card5").style.display = '';
document.getElementById("card7").style.display = '';
document.frmCreditCard.clsbpCreditCard_selCard.value= "oldcard";

</script>
<?php }
?>
<?php

if($clsbpPayment->editcc=='OLDCARDYES'){
?>
<script language="javascript">
document.frmCreditCard.selectbank.value= "yes";
document.getElementById("hr2").style.display = '';
document.getElementById("msg").style.display = 'none';
document.getElementById("card1").style.display = '';
document.getElementById("card2").style.display = '';
document.getElementById("card5").style.display = '';
document.getElementById("card7").style.display = '';
document.frmCreditCard.clsbpCreditCard_selCard.value= "oldcard";

</script>
<?php }
?>

<?php
if($clsbpPayment->retrieveBankAmountofUser() == 0 ) {
?>
<script language="javascript">
document.getElementById("card1").style.display = 'none';
</script>
<?php } ?>

<?php

if($clsbpPayment->editcc=='NEWCARD'){

$minAmt =constant("serviceFloor");

	if($clsbpBopaCart->fn_cartSubTotal() < $minAmt)
	{
	$cardDis ='';
	}
	else{
	$cardDis ='none';
	}
?>
<script language="javascript">
document.frmCreditCard.selectbank.value= "no";
document.frmCreditCard.clsbpCreditCard_selCard.value= "newcard";
document.getElementById("msg").style.display = 'none';
document.getElementById("hr2").style.display = '';

document.getElementById("card1").style.display = '<?php echo $cardDis ;?>';
document.getElementById("card2").style.display = '';
document.getElementById("card3").style.display = '';
document.getElementById("card4").style.display = '';
document.getElementById("card5").style.display = '';
document.getElementById("hr1").style.display = '';
document.getElementById("card7").style.display = 'none';
</script>
<?php } ?>
<?php

if($clsbpPayment->editcc=='NEWCARDYES'){



?>
<script language="javascript">
document.frmCreditCard.selectbank.value= "yes";
document.frmCreditCard.clsbpCreditCard_selCard.value= "newcard";
document.getElementById("msg").style.display = 'none';
document.getElementById("hr2").style.display = '';
document.getElementById("hr1").style.display = '';
document.getElementById("card1").style.display = '';
document.getElementById("card2").style.display = '';
document.getElementById("card3").style.display = '';
document.getElementById("card4").style.display = '';
document.getElementById("card5").style.display = 'none';
document.getElementById("card7").style.display = 'none';
document.getElementById("cpe").style.display = 'none';
</script>
<?php } ?>

<!-- new add end -->
    		<?
    			include("./bpPaymentPCI.iframe.php");
    		?>
</body>
</html>

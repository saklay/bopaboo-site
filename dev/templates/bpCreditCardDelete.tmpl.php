<script type="text/javascript" language="javascritp">
function fn_credit(cardid)
{

var frm = document.form1;
frm.action="<?= HTTPS ?>bpCreditCardDelete.php?clsbpCreditCard_bi_card_id="+cardid+"&action=REMOVE&returnUrl=<?php echo "bpBopaBank.php";  ?>";

frm.submit();
return true;

}

</script>
<div id="deletePopUp">
  <form id="form1" name="form1" method="post" action="" >
  <div class="top">
  	<h1>Confirm you want to delete this credit card?</h1>
    <a href="#"><img src="images/btn-close1.jpg" alt="close" width="19" height="19" border="0" class="closenow" onclick="tb_remove();"/></a>
   </div>
	<div class="contents">Are you sure you want to permanently delete this credit card from your bopaBank?</div>
<div class="bottom"><a href="#"><img src="images/btn-ok.jpg"  onclick="return fn_credit(<?php echo $clsbpCreditCard->bi_card_id; ?>);" alt="Ok" width="106" height="29" border="0" /></a>
  <a href="#" class="rmar"><img src="images/btn-cancel2.jpg" alt="Cancel" width="106" height="29" border="0" onclick="tb_remove();"/></a></div>
<input type="hidden" name="clsbpCreditCard_action" value=""/>
<input type="hidden" name="clsbpCreditCard_bi_card_id" value="<?php echo $clsbpCreditCard->bi_card_id; ?>"/>
<input type="hidden" name="clsbpCreditCard_returnUrl" value="<?php echo "bpBopaBank.php";  ?>"  />
  </form>
</div>

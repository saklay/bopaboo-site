
<div id="deletePopUp">
<?php
  	//if($_REQUEST['clsbpFileDetails_delete_list'] != 0){
  	
 
  ?>
	<form id="frmDelFile" name="frmDelFile" method="post" action="">
		<div class="top">
			<h1>Confirm you want to delete the selected song?</h1>
			<a href="javascript: void(0)"><img src="images/btn-close1.jpg" alt="close" width="19" height="19" border="0" class="closenow" onclick="javascript :tb_remove();"/></a>
		</div>
		<div class="contents">Are you sure you want to permanently delete these selected songs from your bopabox?</div>
		<div class="bottom"><a href="bpBopaAction.php?clsbpFileDetails_action=DELETEFILES&clsbpFileDetails_delete_list=<?php echo $_REQUEST['clsbpFileDetails_delete_list']; ?>&clsbpFileDetails_returnURL=<?php echo $_REQUEST['parameters']; ?>"><img src="images/btn-ok.jpg" alt="Ok" width="106" height="29" border="0" /></a>
		<a href="javascript: void(0);" class="rmar"><img src="images/btn-cancel2.jpg" alt="Cancel" width="106" height="29" border="0" onclick="javascript :tb_remove();"/></a></div>
		<input type="hidden" value="<?php echo $_REQUEST['clsbpFileDetails_delete_list']; ?>" name="clsbpFileDetails_delete_list">
		<input type="hidden" value="<?php echo $_REQUEST['parameters']; ?>" name="clsbpFileDetails_returnURL">
		<input type="hidden" value="DELETEFILES" name="clsbpFileDetails_action">
	</form>
<?php
	//}
	//else {
?>
<!--<form id="frmDelFile" name="frmDelFile" method="post" action="">
		<div class="top">
			<h1>Error in operation!!!</h1>
			<a href="javascript: void(0)"><img src="images/btn-close1.jpg" alt="close" width="19" height="19" border="0" class="closenow" onclick="javascript :tb_remove();"/></a>
		</div>
		<div class="contents">Please select atlease one file to perform this operation!</div>
		<div class="bottom"><a href="javascript: void(0);"><img src="images/btn-ok.jpg" alt="Ok" width="106" height="29" border="0" onclick="javascript :tb_remove();"/></a>
		</div></form>-->
<?php
	//}
?>
</div>

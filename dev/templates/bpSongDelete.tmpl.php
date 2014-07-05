<script type="text/javascript" language="JavaScript">
	function fnDeleteSong(id) {
		
		var frmVar = document.frmDelFile;
		frmVar.clsbpFileDetails_bi_file_id.value = id;
		frmVar.clsbpFileDetails_action.value = "DELETEFILE";
		alert(frmVar.clsbpFileDetails_action.value);
		window.open.location('bpBopaAction.php?clsbpFileDetails_action=DELETEFILE&clsbpFileDetails_bi_file_id=');
		return true;
	}
</script>

<div id="popContainer">
	<form id="frmDelFile" name="frmDelFile" method="post" action="">
    <div class="rounded" id="songStatus">
        <div class="t">
          
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
				<div class="pad">                  

                    <h1>confirm you want to delete the selected song?</h1>
                    <a href="javascript: void(0)"><img src="<?php echo IMAGEPATH ?>closePopUpSmall.png" alt="close" width="19" height="19" border="0" class="closenow" onclick="javascript:tb_remove();" /></a>
                    
                    <div class="cls"></div>
                    
                       <p>Are you sure you want to permanently delete this song from your bopaBox?</span></p>
                <div class="bottom" style="margin-top:20px;">
                	<a href="bpBopaAction.php?clsbpFileDetails_action=DELETEFILE&clsbpFileDetails_bi_file_id=<?php echo $_REQUEST['clsbpFileDetails_bi_file_id']; ?>&clsbpFileDetails_returnURL=<?php echo $_REQUEST['parameters']; ?>"><img src="<?php echo IMAGEPATH ?>buttonOK.png" alt="Ok" border="0" /></a>
                	<a href="javascript: void(0);" class="rmar"><img src="<?php echo IMAGEPATH ?>buttonCancel.gif" alt="Cancel" border="0" onclick="javascript:tb_remove();"/></a>
                	<input type="hidden" value="<?php echo $_REQUEST['clsbpFileDetails_bi_file_id']; ?>" name="clsbpFileDetails_bi_file_id">
   								<input type="hidden"   name="clsbpFileDetails_returnURL" value="<?php echo $_REQUEST['parameters']; ?>">
   								<input type="hidden" value="DELETEFILE" name="clsbpFileDetails_action">
                </div>
                </div>
            <!--finish content-->
          </div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->    
    </form> 
</div>

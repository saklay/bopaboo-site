<form id="form2" name="frmMessage" method="post" action="" onsubmit="javascript: sendMessage();">
	<input type="hidden" name="clsbpMessages_action" value="" />
	<input type="hidden" name="clsbpMessages_returnUrl" value="" />
	
  <div id="container">
  	<div id="messagesLs">
  
      <div class="roundedTab" id="messagesBox">
        <div class="t">
        		<div class="tabOff"><h3 class="wide"><a href="bpMyBopaMessageInbox.php" >inbox</a></h3></div>
          	<div class="tabOff"><h3 class="wide"><a href="bpMyBopaMessageOutbox.php" >sent</a></h3></div>
          	<div class="tab"><h3 class="wide">compose</h3></div>
          <div class="tr"></div>          
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
			
            <div class="pad holder" style="width:720px;">
            	
            	<h5>compose</h5>
            	<div class="messageOptions" style="float:right;"><span id="sendContainer"><a href="javascript:void(0);" class="sent">send</a></span> <span><a href="javascript:void(0);" class="delete">cancel</a></span></div>
                
                <div class="cls"></div>
                	<div class="formRow">
                        <label>to:</label>
                        <select name="clsbpMessages_toId" id="select" onchange="javascript: changeIcon();" style="width:370px;">
       	              		<option value="0">- - - - - - - - - - - - Select Recepient - - - - - - - - - - - - </option>
       	              		<?php echo $ToListControl; ?>
   	                		</select>
                    </div>
                    <div class="cls"></div>
                    <div class="formRow">
                        <label>re:</label>
                        <input name="clsbpMessages_messageSubject" id="subject" type="text" class="inputBox" value="<?php if($clsbpMessages->reSubject!=''){ echo $clsbpMessages->reSubject; } ?>"  style="width:370px;" />
                    </div>
                    <div class="cls"></div>
                    <div class="formRow">
                        <label></label>
                        <textarea name="clsbpMessages_messageContent" id="textarea" cols="45" rows="5" class="inputComments" onkeypress="javascript: changeIcon();" style="width:390px;"></textarea>
                        <input type="hidden" name="clsbpMessages_fromId" value="<?php echo $_SESSION['USERID'];?>" />
                    </div>
                
                </div>
            <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- SellBoxPromote ends -->
      <!-- SellBox ends -->
    </div><!-- messagesLs ends -->
  </div>
  
</form>

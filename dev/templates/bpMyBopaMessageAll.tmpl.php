<div id="container">
  <div id="submenu">
            <a href="bpBopaBank.php">bopaBank</a>	|	<a href="bpFeedback.php?feedbacklist=provided">Feedback</a>	|	<a href="bpMyBopaMessageInbox.php" class="current">Messages</a>
      </div>
        <div id="pagehead-mybopa">
          <h1>Messages</h1>
        </div>
        <div id="myBopaContentWrapper">
       	  <div id="leftWrapper">
       	    <form id="form2" name="frmMessage" method="post" action="" onsubmit="javascript: sendMessage();">
       	    <input type="hidden" name="clsbpMessages_action" value="" />
       	    <input type="hidden" name="clsbpMessages_returnUrl" value="" />
                           	<ul id="bopabank-menu">
                    <li class="inbox"><a href="bpMyBopaMessageInbox.php">Inbox</a></li>
                    <li class="sent"><a href="bpMyBopaMessageOutbox.php">Sent</a></li>
                    <li class="compose"><a href="javascript:void(0);"  class="currentsel">Compose</a></li>
                  </ul>
       	      <div class="composeMessage"> <span class="hdr"></span> <span class="contents">
             <span class="hdg"> Compose</span>
             <ul class="composeTopMenu">
           
		<li><span id="sendContainer"><img src="images/icon-sentMailinactive.png" alt="Sent Mail" width="38" height="26" border="0" align="absmiddle" />&nbsp;<a href="#">Send</a></span></li>
                  
              </ul>
              <ul class="messageBody">
                  <li>
                    <label>To:</label>
                    <span class="toAddress">Message to All <input type="hidden" name="clsbpMessages_toId" value="0"/></span>
       	            </li>
       	          <li>
       	            <label>Subject:</label>
                    <span class="subject">
                    	<input name="clsbpMessages_messageSubject" id="subject" type="text" class="inputsubject" value="<?php if($clsbpMessages->reSubject!=''){ echo $clsbpMessages->reSubject; } ?>"/>
                    </span>       	            </li>
       	          <li>
                  	<label>Message:</label>
                    <span class="comments">
                   	<textarea name="clsbpMessages_messageContent" id="textarea" cols="45" rows="5" class="inputComments" onkeypress="javascript: changeIcon();"></textarea>
                   	<input type="hidden" name="clsbpMessages_fromId" value="<?php echo $_SESSION['USERID'];?>" />
                    </span>                  </li>
   	          </ul>
             <span class="spacing"></span>
       	       </span> <span class="ftr"></span>
              </div>
            </form>
   	      </div>
      </div>
    </div>
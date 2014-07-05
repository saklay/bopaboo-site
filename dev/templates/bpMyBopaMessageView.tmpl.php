  <div id="container">
  	<div id="messagesLs">
  
      <div class="roundedTab" id="messagesBox">
        <div class="t">
        		<div class="tabOff"><h3 class="wide"><a href="bpMyBopaMessageInbox.php" >inbox</a></h3></div>
          	<div class="tabOff"><h3 class="wide"><a href="bpMyBopaMessageOutbox.php" >sent</a></h3></div>
          	<div class="tabOff"><h3 class="wide"><a href="bpMyBopaMessageCompose.php" >compose</a></h3></div>
          <div class="tr"></div>          
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
          
          <form id="form2" name="msgForm" method="post" action="bpMyBopaMessageCompose.php">
       	    	<input type="hidden" name="clsbpMessages_delId" value="">
       	    	<input type="hidden" name="clsbpMessages_action" value="">
       	    	<input type="hidden" name="clsbpMessages_delFlag" value="<?php echo $clsbpMessages->delFlag; ?>">
       	    	<input type="hidden" name="clsbpMessages_newToId" value="">
       	    	<input type="hidden" name="clsbpMessages_replySubject" value="RE: <?php echo $clsbpMessages->strSubject;?>">
       	    	
            <div class="pad holder" style="width:720px;">
            	<h5><a href="<?php if($_POST['chkIfFromOutbox']!=1){ echo "bpMyBopaMessageInbox.php";} else{ echo "bpMyBopaMessageOutbox.php";} ?> " class="linkInbox"><?php if($_POST['chkIfFromOutbox']!=1){ echo "inbox"; } else {echo "sent"; }?></a> <img src="<?php echo IMAGEPATH ?>arrowMsg.jpg" alt="arrow" /> message</h5>
								<div class="messageOptions" style="float:right;">
<?php 
	if($_POST['chkIfFromOutbox'] !=1){
?>
                	<a href="javascript: viewMessage(<?php echo $clsbpMessages->nMessageFromId; ?>)" class="reply">reply</a>
<?php
	}
?>
									<a href="javascript:deleteFile(<?php echo $clsbpMessages->nMessageId ?>, <?php echo $clsbpMessages->delFlag ?>);" class="delete">cancel</a>
								</div>
                <div class="cls"></div>   
                
                <div id="mailHeader">
                	<dl>
                    	<dt>from:</dt>
                        <dd><?php echo $clsbpMessages->strDisplayName; ?></dd>
                        <dt>to:</dt>
                        <dd><?php echo $clsbpMessages->getUserName($clsbpMessages->nMessageToId); ?></dd>
                        <dt>date:</dt>
                        <dd><?php 
						$date = explode(" ",$clsbpMessages->dtSentDate);	
						$sendDate = date ("m/j/y",strtotime($date[0]));
						echo $sendDate; ?></dd>
                        <dt>subject:</dt>
                        <dd><?php echo $clsbpMessages->strSubject; ?></dd>
                    </dl>
               </div>
                    
                <div id="mailBody">
                    <p><?php echo nl2br($clsbpMessages->strMessage); ?></p>
                </div>
                
             </form>
            </div>
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- SellBoxPromote ends -->
      
      <div class="cls"></div>

  
      <!-- SellBox ends -->

  
      <!-- SellBox ends -->
      
      <div class="cls"></div>
            
      <!--<div id="pages" align="center"><a href="#" class="currentsel">Previous</a> <a href="#" class="currentselno">1</a>  <a href="#">2</a>  <a href="#">3</a>  <a href="#">4</a>  <a href="#">5</a>  <a href="#">6</a>  <a href="#">7</a> <a href="#">8</a>  <a href="#">9</a> <a href="#">10</a> ...<a href="#">199</a> <a href="#">Next</a></div>-->
      
    </div><!-- messagesLs ends -->
  </div>

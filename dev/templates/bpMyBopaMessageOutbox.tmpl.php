<form id="form2" name="frmOutbox" method="post" action="bpMyBopaMessageView.php">
	<input type="hidden" name="clsbpMessages_messageId" value="">
	<input type="hidden" name="clsbpMessages_delIds" value="">
	<input type="hidden" name="clsbpMessages_action" value="">
	<input type="hidden" name="chkIfFromOutbox" value="1">
	<input type="hidden" name="clsbpMessages_delFlag" value="1">
	<input type="hidden"  name="clsbpMessages_searchSize" value="<?php echo $clsbpMessages->searchSize; ?>">
	<input type="hidden"  name="clsbpMessages_pageIndex" value="<?php echo $clsbpMessages->pageIndex; ?>">

  <div id="container">
  	<div id="messagesLs">
  
      <div class="roundedTab" id="messagesBox">
        <div class="t">
        	<div class="tabOff"><h3 class="wide"><a href="bpMyBopaMessageInbox.php">inbox</a></h3></div>
          <div class="tab"><h3 class="wide">sent</h3></div>
          <div class="tabOff"><h3 class="wide"><a href="bpMyBopaMessageCompose.php" >compose</a></h3></div>
          <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
			
            <div class="pad holder">
            	<h5>sent</h5>
                <div class="cls"></div>           
                
              <table width="715" class="tableGeneral" id="messagesBoxTable">
								<thead>
                  <tr valign="middle" class="tableHead">
                    <th width="33" valign="bottom" class="cehckboxCell" id="first"><input name="selectAll" type="checkbox" value="" onclick="javascript: fnSetAllCheckBoxes('frmOutbox', 'toDelete[]', this.checked)"></th>
                    <th width="185" class="artist highlightCol"><a href="#">to</a></th>
                    <th width="340" class="song"><a href="#">subject</a></th>
                    <th width="150" class="actions fin"><a href="#">date</a></th>
                </tr>
            </thead>
             <tbody>
             	
<?php 
	if(count($arrMessages)) {
		foreach($arrMessages as $row) {
			$classUnRead = "";
			if($row['bi_ToId']!=0) {
				$classFrom = "class=\"from read\"";
				$classSubject = "class=\"subject read\"";
				$classDate = "class=\"date read\"";
				$classUnRead = "class=\"new\"";
?>
                <tr valign="middle" <?php echo $classUnRead; ?>>
               	  <td align="center" valign="middle"><input name="toDelete[]" type="checkbox" value="<?php echo $row['bi_MessageId']; ?>" /></td>
                  <td valign="bottom" class="indent"><a href="javascript: readMessage(<?php echo $row['bi_MessageId']?>);"><a href="#"><?php echo $clsbpMessages->getUserName($row['bi_ToId']);?></a></td>
                  <td valign="bottom" class="indent"><a href="javascript: readMessage(<?php echo $row['bi_MessageId']?>);"><?php echo $row['vc_Subject']; ?></a></td>
                  <td align="center" valign="bottom"><?php 	
                      					$date = explode(" ",$row['dt_SentDate']);	
							$sendDate = date ("m/j/y",strtotime($date[0]));
							echo $sendDate; 
						?></td>                    
               </tr>
               
	     <?php
		}
		}
		}
		else{
	     ?>
	     
	     <tr> 
                      <td colspan="4" align="center">
                      	<strong style="color: #FF6F3F">There are no messages in your sent box</strong>
		     </td>
                    </tr>
              <?php
              	}
              ?>
               
             </tbody>
          </table>
                  
            </div>
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- SellBoxPromote ends -->
      
      <div class="cls"></div>
      <!-- SellBox ends -->      
      <div class="cls"></div>
            
      <div id="pages" align="center"><?php echo $clsbpMessages->clsbpPaginate->writeHTMLPageRanges("clsbpMessages", "frmInbox", $extraParameters); ?></div>
      
    </div><!-- messagesLs ends -->
  </div>

</form>

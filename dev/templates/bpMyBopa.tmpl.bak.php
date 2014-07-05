<script language="javascript">
function fn_PostContact(){

	var frm = document.frmContact;
	frm.action="bpSendInviteMail.php";

	frm.submit();
}
function ShowStore(){

			if ($(document.getElementById("PromoteStoreContent")).is(":hidden")) {
					document.getElementById("PromoteStoreContent").style.display = '';
			} 
			else{
			document.getElementById("PromoteStoreContent").style.display = 'none';
			
			}

}
</script>

    <div id="container">

      <div id="submenu">
            <a href="bpAccountActivity.php">bopaBank</a>	|	<a href="bpFeedback.php?feedbacklist=provided">Feedback</a>	|	<a href="bpMyBopaMessageInbox.php">Messages</a>
      </div>
        <div id="pagehead-mybopa">
          <h1>myBopa</h1>
      <div id="upldmusic">
            	<a href='javascript:void(0);' onClick='javascript:window.open("uploadMyBopa.php","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,screenX=150,screenY=150,top=150,left=150,height=725,width=880");'><img src="images/icon-uploadmusic.png" alt="Upload Music" width="165" height="52" border="0" /></a> </div>
      </div>
        <div id="mybopa">
        	<div id="announcement">
            	<div class="hdr">Announcements</div>
                <div class="contents" id="announcediv">
                	<span class="hdg"><?echo $clsbpAnnouncements->strSubject; ?></span><span class="date"><?php echo convertDateToString($clsbpAnnouncements->dtInsertedDate); ?></span><p><?php echo substr(nl2br($clsbpAnnouncements->strAnnouncement),0,300);?>&nbsp;&nbsp;&nbsp;(<a href="javascript: void(0);" class="link" id="announce">more...</a>)                </p>
                </div>
                <div class="footer"></div>
            </div>
            <div id="laside">
            	<div id="box001">
                	<div class="hdr">My Store</div>
                    <div class="contents">
                    	<div class="holder">
                        	<span class="ltitle">Feedback:</span>
                       		 <span class="rdetails">
                        			<!--<img src="images/rate_4star.png" alt="4 star" width="96" height="20" />-->
                              <?php echo "<img src=\"images/rate_".$rating.\"star.png\" alt=\"Edit\" width=\"96\" height=\"20\" 
							  border=\"0\" align=\"absmiddle\" />";?>
                                     (<?php echo $clsbpRatings->totalReviews;?>)
                          </span>
                        </div>
                         <div class="holder">
                        	<span class="ltitle">View My Music Store:</span>
                       		 <span class="rdetails">
                        		<a href="<?php  echo constant("URL").str_replace(" ","-",$_COOKIE['COOKIE_USERNAME']); ?>"><?php echo constant("URL").$_COOKIE['COOKIE_USERNAME']; ?></a>
                          	</span>
                        </div>
                        <div class="holder">
                        	<span class="ltitle">Add To:</span>
                       		 <span class="rdetails">
                        		<img src="images/page_white_code.png" alt="facebook" />
					<img src="images/wfba.gif" alt="my space"  />
					<img src="images/myspace.gif" alt="Bebo"   />
					<img src="images/wbba.gif" alt="Bebo"   />
					<img src="images/blogger.gif" alt="Bebo"  />
					<img src="images/typepad.gif" alt="Bebo"   /> 
					<img src="images/wordpress.gif" alt="Bebo"   /> 
					<img src="images/livejournal.gif" alt="Bebo"  /> 
					<img src="images/tagged.gif" alt="Bebo"  /> 
					<img src="images/multiply.gif" alt="Bebo"  /> 
					<img src="images/freewebs.gif" alt="Bebo" /> 
					<img src="images/blogger-post.gif" alt="Bebo" /> 
					<img src="images/google.gif" alt="Bebo"  /> 
					<img src="images/netvibes.gif" alt="Bebo"  /> 
					<img src="images/pageflakes.gif" alt="Bebo"  /> 
					<img src="images/hi5.gif" alt="Bebo"  /> 
					<img src="images/orkut-os.gif" alt="Bebo" /> 
					<img src="images/hi5-os.gif" alt="Bebo"  /> 
					<img src="images/ning-os.gif" alt="Bebo"  /> 

<!-- 	<img src="images/icon-facebook.jpg" alt="facebook" width="100" height="37" /><img src="images/icon-myspace.jpg" alt="my space" width="147" height="34" class="lspace" /><img src="images/icon-bebo.jpg" alt="Bebo" width="99" height="37" class="lspace" />-->
                                
                                
                                </span>                        </div>
                     </div>
                    <div class="footer"></div>
                </div>
                
                <div id="box002">
                <form name="frmMyBopa" method="POST">
                	<input type="hidden" name="clsbpMessages_messageId" value=""><!--<input type="text" id="mtest_val" /><input type="text" id="mtest_val2" /><input type="text" id="mtest_val3" /><input type="text" id="mtest_val4" />-->
<!--<input type="text" id="mtest_val5" />-->
                	<div class="hdr">&nbsp;</div>
                  <div class="contents">
                   	<ul class="tabs">
                    		<li id="tab001"><div class="mtest"><a href="javascript: void(0);" id="slidein" ><?php if($countMessages>0){ ?><span class="smlhdr" id="countText"><?php echo $countMessages. " New "; ?></span><?php } ?>Messages</a></div>
				</li>
                        	<li id="tab002"><div class="selltest"><a href="javascript: void(0);" id="slidein2" >Saved Sellers</div></a>
				</li>
                    	</ul>
                         <div id="messages" class="mtest" >
                            &nbsp;
                         </div>
                           <div id="sellers"  class="selltest">
                         	&nbsp;
                         </div>
                         
                       	<ul class="tabs">
                        	<li id="tab003" ><div class="srchtest"><a href="javascript: void(0);" id="slidein3" >Popular Searches</a></div></li>
                        	<li id="tab004"><div class="srch1test"><a href="javascript: void(0);" id="slidein4" >Saved Searches</a></div></li>
                        </ul>
			<div id="search"  class="srchtest">
                        	 &nbsp;
                        </div>
                        <div id="search1" class="srch1test">
                            	&nbsp;
                         </div>
                       
                    
                  </div></form>
                    <div class="footer"></div>
                </div>
                
                
                
                
                <div id="box003">
                	<form id="frmTopList" name="frmTopList" method="post" action="bpAdvSearchResult.php">
				<input type="hidden" name="clsbpFileDetails_flagTopSearch" value="">
				<input type="hidden" name="clsbpFileDetails_vc_title_nm_mod" value="">
				<input type="hidden" name="clsbpFileDetails_vc_artists_nm_mod" value="">
                	<div class="hdr">bopaboo Top 50 Songs</div>
                    <div class="contents">
                    	<ul id="top50albumjpg">
                        	<li class="jpg001"><a href="#"><img src="images/top50-tn-jpg001.jpg" alt="Top 50 Songs" width="105" height="97" border="0" /></a></li>
                            <li class="jpg002"><a href="#"><img src="images/top50-tn-jpg002.jpg" alt="Top 50 Songs" width="105" height="97" border="0" /></a></li>
                          <li class="jpg003"><a href="#"><img src="images/top50-tn-jpg003.jpg" alt="Top 50 Songs" width="105" height="97" border="0" /></a></li>
                            <li class="jpg004"><a href="#"><img src="images/top50-tn-jpg004.jpg" alt="Top 50 Songs" width="105" height="97" border="0" /></a></li>
                        </ul>
                        <ol id="top50listings">
                        	<?php
            	    	$i=0;
            	    	foreach ($arrDet as $row) {
            	    ?>
                      <li><a href="javascript: void(0);" onclick="javascript: searchItem('<?php echo $row['vc_title_nm_mod']; ?>','<?php echo $row['vc_artists_nm_mod']; ?>')"><?php echo $row['vc_artists_nm_mod']; ?> - <?php echo $row['vc_title_nm_mod']; ?></a></li>
                      <?php
                      		$i++;
                      		if($i==25) { 
                      			break;
                      		}
                      	}
                      ?>
                        </ol>
                        <div id="gototop50">
                          <a href="bpMyBopaTop50.php">See All Top 50 Songs</a>                        </div>
                  </div>
                    <div class="footer"></div>
                    </form>
                </div>
                
                
                
            </div>
            <div id="raside">
           	  <div id="box001">
                	<div class="hdr">My Dashboard</div>
                    <div class="contents">
                      <div class="holder">
                      	<span class="ltitle">Songs on Sale:</span> <span class="rdetails"><?php echo $clsbpFileDetails->countUserSellFiles; ?></span>
                        <span class="ltitle">Songs in your bopaBox:</span> <span class="rdetails"><?php echo $clsbpFileDetails->countUserFiles; ?></span>
                        <span class="ltitle">bopaBank Balance:</span> <span class="rdetails">$<?php print number_format($clsbpPayment->retrieveBankAmountofUser(),2) ; ?></span>
                        <span class="ltitle">Songs Sold this Year:</span> <span class="rdetails"><?php echo $clsbpFileDetails->countTotalSellYear; ?></span>
                        <span class="ltitle">Sales this Year:</span> <span class="rdetails">$<?php echo stripslashes(number_format($clsbpFileDetails->priceTotalSellYear,2));?></span>
                       </div>
                    </div>
                    <div class="footer"></div>
              </div>
                 <div id="box002">
                	<div class="hdr">Invite Your Friends</div>
                    <div class="contents">
                    <div class="holder">
                   		<a href="javascript: void(0);" id="PromoteStore">
                    	<img src="images/icon-invitefriends.png" alt="promote your store" border="0" height="61" width="58" align="absmiddle" />Promote Your Store
                        </a>
                    </div>
                    <form name="frmContact" action="" method="post">
                     <div class="holder" id="PromoteStoreContent"  <?php if($_SESSION['friendList']!='' || $_GET['invite']==1){?>style="display:;" <?php }else { ?>style="display:none;" <?php } ?>>
                   		<span class="title">Email Addresses</span><span class="lighttext">(seperated by commas)</span>
                        <span class="link"><a href="bpSelectAccount.php?height=500&width=700px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo getCurrentPage();   ?>" class="thickbox"><br />
                        Click Here to Import Email Addresses</a></span>
                        <span class="lighttext">(you can import addresses from Gmail, Hotmail, Yahoo!, AOL, Outlook &amp; more)</span><span class="emailaddress">
                        <textarea name="clsbpMailImport_textarea" cols="" rows=""><?php echo strip_tags($_SESSION['friendList']);?></textarea>
                        </span><span class="btnsend">
                       <a href="javascript: void(0);" onclick="javascript: fn_PostContact();"><img border="0" src="images/btn-sendInvitation.png" alt="Send Invitation" /></a>
                       </span>
                    </div> </form>               
                   </div>
                    <div class="footer"></div>    
                </div>
              <div id="ad">
                	 <!-- Begin BidVertiser code -->
<SCRIPT LANGUAGE="JavaScript1.1" SRC="http://bdv.bidvertiser.com/BidVertiser.dbm?pid=122686&bid=312684" type="text/javascript"></SCRIPT>
<a href="http://www.bidvertiser.com">internet marketing</a>
<!-- End BidVertiser code -->
                </div>
                
            </div>
        <div>
        </div>
      </div>
    </div>
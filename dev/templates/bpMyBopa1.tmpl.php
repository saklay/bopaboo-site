
    <div id="container">

      <div id="submenu">
            <a href="bpBopaBank.php">bopaBank</a>	|	<a href="bpFeedback.php?feedbacklist=provided">Feedback</a>	|	<a href="bpMyBopaMessageInbox.php">Messages</a>
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
                	<span class="hdg"><?echo $clsbpAnnouncements->strSubject; ?></span><span class="date"><?php echo convertDateToString($clsbpAnnouncements->dtInsertedDate); ?></span><p><?php echo substr(nl2br($clsbpAnnouncements->strAnnouncement),0,300);?>(<a href="javascript: void(0);" class="link" id="announce">more...</a>)                </p>
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
                        		<a href="http://www.bopaboo.com/bradford">http://www.bopaboo.com/bradford</a>
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
                	<input type="hidden" name="clsbpMessages_messageId" value="">
                	<div class="hdr">&nbsp;</div>
                  <div class="contents">
                   	<ul class="tabs">
                    		<li id="tab001"><a href="javascript: void(0);" id="slidein">Messages</a></li>
                        	<li id="tab002"><a href="javascript: void(0);" id="slidein2">Saved Sellers</a></li>
                    	</ul>
                         <div id="messages">
                            &nbsp;
                         </div>
                           <div id="sellers">
                         	&nbsp;
                         </div>
                         
                       	<ul class="tabs">
                        	<li id="tab003"><a href="javascript: void(0);" id="slidein3">Popular Searches</a></li>
                        	<li id="tab004"><a href="javascript: void(0);" id="slidein4">Saved Searches</a></li>
                        </ul>
			<div id="search">
                        	 &nbsp;
                        </div>
                        <div id="search1">
                            	&nbsp;
                         </div>
                       
                    </form>
                  </div>
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
                   	<a href="#"><img src="images/icon-invitefriends.png" alt="promote your store" width="58" height="61" border="0" align="absmiddle" />Promote Your Store</a>                    </div>
                    <div class="footer"></div>    
                </div>
                <div id="ad">
                	 <!-- Begin BidVertiser code -->
<SCRIPT LANGUAGE="JavaScript1.1" SRC="http://bdv.bidvertiser.com/BidVertiser.dbm?pid=122686&bid=312684" type="text/javascript"></SCRIPT>
<noscript><a href="http://www.bidvertiser.com">internet marketing</a></noscript>
<!-- End BidVertiser code -->
                </div>
                
            </div>
        <div>
        </div>
      </div>
    </div>
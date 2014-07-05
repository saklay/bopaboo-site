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
    <div class="roundedTab" id="popularMusic">
      <div class="t">
        <div class="tab"><h3>today's most popular music</h3></div>
        <div class="tr"></div>
      </div>
    </div>
    <div class="roundedTab" id="popularMusic" style="background-color:#ffffff;">
      <div class="c"> <div class="cl">
        <!--add content-->
        		<table cellpadding=0 cellspacing=0 border=0 width=998 height=100>
		<tr><td align=center valign=top>
		<script language="javascript">
			if (AC_FL_RunContent == 0) {
				alert("This page requires Javascript.");
			} else {
				AC_FL_RunContent(
					'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
					'width', '860',
					'height', '100',
					'src', 'albumScroll',
					'quality', 'high',
					'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
					'align', 'middle',
					'play', 'true',
					'loop', 'true',
					'scale', 'showall',
					'wmode', 'window',
					'devicefont', 'false',
					'id', 'albumScroll',
					'bgcolor', '#ffffff',
					'name', 'albumScroll',
					'menu', 'true',
					'allowFullScreen', 'false',
					'allowScriptAccess','sameDomain',
					'movie', 'albumScroll',
					'salign', ''
					); //end AC code
			}
		</script>
		<noscript>
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="860" height="100" id="albumScroll" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="false" />
			<param name="movie" value="albumScroll.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="albumScroll.swf" quality="high" bgcolor="#ffffff" width="860" height="100" name="albumScroll" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>
		</noscript></td></tr>
		</table>
        <!--finish content-->
      </div>
      <div class="b"><span class="br"></span></div>
    </div>
    <!-- popularMusic ends -->
    <div class="cls"></div>
    
<div>
    <div id="laside">
      <div class="roundedTab" id="myDashboard">
        <div class="t">
          <div class="tab"><h3>my dashboard</h3></div>
          <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
          <div class="holder">
                <span class="ltitle">feedback:</span><span class="star"><img src="<?php echo IMAGEPATH ?>rate_<?php echo $rating; ?>star.png" alt="<?php echo $rating; ?> stars" title="<?php echo $rating; ?> stars" border=0 /></span><span class="rated">(<?php echo $clsbpRatings->totalReviews;?>)</span>
                <span class="ltitle">songs on sale:</span> <span class="rdetails"> <?php echo $clsbpFileDetails->countUserSellFiles; ?></span> 
                <span class="ltitle">songs in your bopaBox:</span> <span class="rdetails"> <?php echo $clsbpFileDetails->countUserFiles; ?></span> 
                <span class="ltitle">bopaBank balance:</span> <span class="rdetails"> $<?php print number_format($clsbpPayment->retrieveBankAmountofUser(),2) ; ?></span> 
                <span class="ltitle">songs sold this year:</span> <span class="rdetails"> <?php echo $clsbpFileDetails->countTotalSellYear; ?></span> 
                <span class="ltitle">sales this year:</span> <span class="rdetails"> $<?php echo stripslashes(number_format($clsbpFileDetails->priceTotalSellYear,2));?></span> 
            </div>
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- myDashboard ends -->
      
    </div>
    <!-- laside ends -->
    <div id="raside">
      <div class="rounded" id="quickLinks">
        <div class="t">
          <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
          <div class="holder">
              <div class="qlMessages"><a id="qlMessagesToggle" href="javascript:void(0);"><span class="newMessage"><?php if($countMessages>0){ echo $countMessages; } else { echo "0"; } ?> </span> messages</a></div>
              <div class="qlSellers"><a id="qlSellersToggle" href="#">saved sellers</a></div> 
              <div id="qlMessagesDiv">
                <table width="490" class="tableGeneral" id="bopaBoxTable">
                  <thead>
                    <tr valign="middle" class="tableHead">
                      <th width="99" class="from" id="first"><a href="#">from</a></th>
                            <th width="314" class="subject"><a href="#">subject</a></th>
                            <th width="61" class="date fin"><a href="#">date</a></th>
                        </tr>
                  </thead>
                  <tbody>
<?php 
	if(count($arrMessages)) {
		foreach($arrMessages as $row) {	
			if($row['ti_received'] == 1) {
				$classFrom = "class=\"from read\"";
				$classSubject = "class=\"subject read\"";
				$classDate = "class=\"date read\"";
				$classUnRead = "";
			} else {
				$classFrom = "class=\"from unread\"";
				$classSubject = "class=\"subject unread\"";
				$classDate = "class=\"date unread\"";
				$classUnRead = "class=\"unread\"";
			}
?>
                        <tr valign="middle" <?php echo $classUnRead; ?>>
                            <td valign="bottom" class="indent"><?php echo $row['display_name']; ?></td>
                            <td valign="bottom" class="indent"><?php echo $row['vc_Subject']; ?></td>
                            <td align="center" valign="bottom" ><?php 	
                      					$date = explode(" ",$row['dt_SentDate']);	
																$sendDate = date ("m/j/y",strtotime($date[0]));
																echo $sendDate; 
														?></td>                    
                        </tr>
<?php
		}
	} else {
?>
	     
												<tr> 
                      		<td colspan="3" align="center"><strong style="color: #FF6F3F">There are no messages in your inbox</strong></td>
                    		</tr>
<?php
	}
?>
                  </tbody>
                </table>
<?php
	if(count($arrMessages) < 1) {}
	else{ ?>
						<span class="viewMessages"><a href="bpMyBopaMessageInbox.php">>> view messages</a></span>
<?php } ?>
          	
          </div>
          <div id="qlSellersDiv">
                <dl class="left">
                    <dt>1. BJJohnson</dt>
                      <dd class="fivestar">star</dd>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                    <dt>2. BJJohnson</dt>
                      <dd class="fivestar">star</dd>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                    <dt>3. BJJohnson</dt>
                      <dd class="fivestar">star</dd>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                    <dt>4. BJJohnson</dt>
                      <dd class="fivestar">star</dd>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                </dl>
                <dl class="right">
                    <dt>5. BJJohnson</dt>
                      <dd class="fivestar">star</dd>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                    <dt>6. BJJohnson</dt>
                      <dd class="fivestar">star</dd>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                    <dt>7. BJJohnson</dt>
                      <dd class="fivestar">star</dd>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                    <dt>8. BJJohnson</dt>
                      <dd class="fivestar">star</dd>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                </dl>
          </div> 
          	<div class="cls"></div>
          
              <div class="qlPopular"><a id="qlPopularToggle" href="#">popular searches</a></div>
              <div class="qlSaved"><a id="qlSavedToggle" href="#">saved searches</a></div>
              
          <div id="qlPopularDiv">
          	<div id="tags" style="padding:10px;width:500px;">
                        <?php
                        	$parameters = urlencode(getCurrentPageURL());
				$query = "SELECT vc_searchKeyword AS tag, bi_searchKeywordCount AS quantity
						FROM 
							tbl_search_records 
						WHERE
							bi_searchResultCount > 0
						ORDER BY 
							vc_searchKeyword 	ASC";
			
				$result = mysql_query($query);
			
				while ($row = mysql_fetch_array($result)) {
					$row['tag'] = trim($row['tag']);
					$row['tag'] = strtolower($row['tag']);
					$tags[$row['tag']] = $row['quantity'];
				}
				
				
				arsort($tags);

				$tags = array_slice($tags,0,25);

				ksort($tags, SORT_STRING);
				
				$max_size = 44; // max font size in %
				$min_size = 12; // min font size in %
				
				$max_qty = max(array_values($tags));
				$min_qty = min(array_values($tags));
				
				$spread = $max_qty - $min_qty;
				if (0 == $spread) { // we don't want to divide by zero
					$spread = 1;
				}
				
				$step = ($max_size - $min_size)/($spread);
				$count = 0;
				foreach ($tags as $key => $value) {
				if($count>=25) {break;}
				$size = $min_size + (($value - $min_qty) * $step);
				 if ($size   == 12)
				{
					$class = 'f007';
				} 
				elseif ($size> 12 and $size <=15) {
					$class = 'f006';
				} 
				elseif ($size > 15 and $size <=18) {
					$class = 'f004';
				} 
				elseif ($size > 18 and $size <24) {
					$class = 'f002';
				} 
				else {
					$class = 'f001';
				}
					
				echo '<a class="'.$class.'" href="bpSearch.php?clsbpFileDetails_txtSearch='.$key.'" style="font-size: '.$size.'px"';
				// perhaps adjust this title attribute for the things that are tagged
				//echo ' title="'.$value.' searches with '.$key.'"';
				echo '>'.$key.'</a> &nbsp; ';
				$count++;
				}
                        ?>
          	</div>
          </div>
          <div id="qlSavedDiv">
                <dl class="left">
                    <dt>1. BJJohnson</dt>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                      <dd class="iconEdit"><a href="#">edit</a></dd>
                    <dt>2. BJJohnson</dt>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                      <dd class="iconEdit"><a href="#">edit</a></dd>
                    <dt>3. BJJohnson</dt>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                      <dd class="iconEdit"><a href="#">edit</a></dd>
                    <dt>4. BJJohnson</dt>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                      <dd class="iconEdit"><a href="#">edit</a></dd>
                </dl>
                <dl class="right">
                    <dt>5. BJJohnson</dt>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                      <dd class="iconEdit"><a href="#">edit</a></dd>
                    <dt>6. BJJohnson</dt>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                      <dd class="iconEdit"><a href="#">edit</a></dd>
                    <dt>7. BJJohnson</dt>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                      <dd class="iconEdit"><a href="#">edit</a></dd>
                    <dt>8. BJJohnson</dt>
                      <dd class="iconDelete"><a href="#">delete</a></dd>
                      <dd class="iconEdit"><a href="#">edit</a></dd>
                </dl>
          </div>              
                      
          </div>
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- quickLinks ends -->
    
    </div>
    <!-- raside ends -->
    
</div>

<div class="cls"></div>

<div>
    <div id="laside">
      
      <div class="roundedTab" id="recentSongs">
        <div class="t">
          <div class="tab"><h3 style="padding-left:4px;padding-right:2px;">most recent songs from saved sellers</h3></div>
          <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
          <ul>
            <li><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5> &nbsp;LKNRockstar</span></li>
            <li><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5> &nbsp;LKNRockstar</span></li>
            <li><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5> &nbsp;LKNRockstar</span></li>
            <li><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5>  
            LKNRockstar</span></li>
            <li><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5> &nbsp;LKNRockstar</span></li>
            <li><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5> &nbsp;LKNRockstar</span></li>
            <li><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5> &nbsp;LKNRockstar</span></li>
            <li><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5> &nbsp;LKNRockstar</span></li>
            <li><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5> &nbsp;LKNRockstar</span></li>
            <li class="fin"><span class="recentSong"><a href="#">So Small</a> by Carrie Underwood</span> <span class="recentSeller">
                <h5>seller : </h5> &nbsp;LKNRockstar</span></li>
          </ul>
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- recent ends -->   
      
    </div>
    <!-- laside ends -->
    <div id="raside">
    
    <div class="roundedTab" id="personalizedSuggestions">
        <div class="t">
          <div class="tab">
          <h3>personalized suggestions</h3>
          </div>
          <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
          	<div class="pad">
              <a href="#" class="f001">Music</a> <a href="#" class="f006">60s</a>    <a href="#" class="f005">70s</a>   <a href="#" class="f005">80s</a> <a href="#" class="f006">90s</a>  <a href="#" class="f004">british invasion</a>  <a href="#" class="f006">acoustic</a>   <a href="#" class="f006">albums</a>  <a href="#" class="f007">alt-country</a>  <a href="#" class="f004">alternative</a>	<a href="#" class="f005">anime</a>   <a href="#" class="f002">avant-grade</a>   <a href="#" class="f007">awsome</a>   <a href="#" class="f007">beautiful</a>   <a href="#" class="f005">black metal blues    british</a>   <a href="#" class="f003">britpop</a>   <a href="#" class="f006">brutal death</a> <a href="#" class="f001">metal</a>  <a href="#" class="f005">canadian</a> <a href="#" class="f004">Classical</a> <a href="#" class="f005">rock</a>  <a href="#" class="f006">classical</a>   <a href="#" class="f005">comedy</a>   <a href="#" class="f005">cool</a>   <a href="#" class="f002">country</a>  <a href="#" class="f003">dance    dark</a> <a href="#" class="f004">british invasion</a> <a href="#" class="f001">avant-grade</a> <a href="#" class="f001">avant-grade</a> <a href="#" class="f001">avant-grade</a></div>
              <div style="height:3px;"></div>
          </div>
          <!--finish content-->
          
        <div class="b"><span class="br"></span></div>
      </div>
      </div>
      <!-- personalizedSuggestions ends -->
    
    </div>
    <!-- raside ends -->
    
</div>
    
  </div>
  

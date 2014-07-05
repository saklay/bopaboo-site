<script  language="javascript" type="text/javascript">

var xmlHttp;
function fn_Add(str) { 
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null) {
		alert ("Your browser does not support AJAX!");
		return;
	} 
	var url="bpAddFavSeller.php";
	url=url+"?sellerId="+str;
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}		
function stateChanged() { 
	if (xmlHttp.readyState==4){ 
		//alert(document.getElementById("tablebody").innerHTML);
		/*document.getElementById("tablebody").innerHTML=*/
		if(xmlHttp.responseText==1){
		//	alert('<?php // echo $clsbpFileDetails->vc_DisplayName ?>'+" has been added to your favourite seller list.");
			 document.frmMemberStore.submit();
		}
		else if(xmlHttp.responseText==0){
			
			/*document.getElementById('sellerNew').innerHTML = '<img src="images/dis-add-a-cart-ico.png" alt="Add Seller to Favorites" width="27" height="26" border="0" align="absmiddle" /><a href="javascript:void(0);"   class="itemfooterlinks">One of My Saved Sellers</a>' ;
		*/
		//alert('<?php // echo $clsbpFileDetails->vc_DisplayName ?>'+" is already there in  your favourite seller list.")		
  
		}
		else {
			alert("You are not logged in!!!");
			
		
		}
	}
}
function GetXmlHttpObject() {
	var xmlHttp=null;
	try{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		// Internet Explorer
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
</script>
<div id="container">
<div id="pageheadStore">
        	<h1><?php echo $clsbpFileDetails->vc_DisplayName ?>'s Music Store</h1>
    </div>
      <form action="" method="post" name="frmMemberStore">
		
        <input type="hidden"  name="clsbpFileDetails_searchSize" value="<?php echo $clsbpFileDetails->searchSize; ?>">
		<input type="hidden"  name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
		<input type="hidden"  name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
		<input type="hidden"  name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
		<input type="hidden"  name="clsbpFileDetails_action" value=""> 
		<input type="hidden"  name="clsbpFileDetails_FileIds" value=""> 
		<input type="hidden" name="clsbpFileDetails_FileId" value=""> 
		<input type="hidden" name="clsbpFileDetails_bi_GenreId" value="<?php echo $clsbpFileDetails->bi_GenreId; ?>"> 
		<input type="hidden" name="clsbpFileDetails_vc_tags" value="<?php echo $clsbpFileDetails->vc_tags; ?>"> 
		<input type="hidden" name="clsbpFileDetails_txtSearch" value="<?php echo $clsbpFileDetails->txtSearch; ?>"> 
		<input type="hidden" name="clsbpFileDetails_seachCat" value="<?php echo $clsbpFileDetails->seachCat; ?>"> 
		<input type="hidden" name="clsbpFileDetails_SearchGenreId" value="<?php echo $clsbpFileDetails->SearchGenreId; ?>"> 
		<input type="hidden" name="clsbpFileDetails_SearchGenreName" value="<?php echo $clsbpFileDetails->SearchGenreName; ?>"> 
		<input type="hidden" name="clsbpFileDetails_Search_tags" value="<?php echo $clsbpFileDetails->Searchtags; ?>"> 
		<input type="hidden" name="clsbpFileDetails_returnUrl" value=""> 
		<input type="hidden"  name="clsbpBopaCart_action" value=""> 
		<input type="hidden"  name="clsbpBopaCart_FileIds" value=""> 
		<input type="hidden" name="clsbpBopaCart_FileId" id="clsbpBopaCart_FileId" value=""> 
		<input type="hidden" name="clsbpBopaCart_returnUrl" value=""> 
		<input type="hidden"  name="clsbpFileDetails_submitted" value="1">
        <input type="hidden"  name="mS" value="<?php echo $clsbpFileDetails->mS; ?>">
		<input type="hidden"  name="clsbpFileDetails_goBack" value="<?php echo $_SERVER['PHP_SELF'];?>"> 
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="46">&nbsp;</td>
        <td width="603" valign="top"><table border="0" cellpadding="0" cellspacing="0" id="memberstrore_tbl">
          <tr>
            <td class="hdr"><h1>Meet the Seller</h1></td>
          </tr>
          <tr>
            <td class="bodymemberstorebox"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td width="154" height="25" align="right" class="labelss"><strong>Feedback :</strong> </td>
                <td width="7%" align="left" valign="middle"><img src="images/rate_<?php echo $rating; ?>star.png" alt="Edit" width="96" height="20"  border="0" align="absmiddle"  /></td>
                <td  width="57%" align="left" valign="middle">&nbsp;(<?php echo $clsbpRatings->totalReviews;?>)</td>
              </tr>
              <tr>
                <td height="25" align="right" class="labelss"><strong>Member Since :</strong></td>
                <td colspan="2"><?php $date = explode(" ",$clsbpFileDetails->dt_SignUp); echo date ("F j, Y",strtotime($date[0]));?></td>
              </tr>
              <tr>
                <td height="25" align="right" class="labelss"><strong>Total Sales :</strong></td>
                <td colspan="2"><?php echo $clsbpFileDetails->getAllSoldItemsCount($clsbpFileDetails->bi_sellerId); ?> Songs</td>
              </tr>
              <tr>
                <td height="25" align="right" class="labelss"><strong>Grab a Direct Link :</strong></td>
                <td colspan="2"><input name="textfield" type="text" class="inputstyle01" id="textfield" value="<?php echo
				"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>"/></td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="35">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="50%" class="labels2">
                                   
                         <?php  if($_SESSION['USERID'] !="" )
						 
						  {
						 if($_COOKIE['COOKIE_USERNAME'] != $clsbpFileDetails->mS)
						 {		
					 	?>
										<div class="getaquestionimg"><a href="bpMyBopaMessageCompose.php?clsbpMessages_newToId=<?php echo $clsbpFileDetails->bi_sellerId; ?>"><img src="images/store-ico.png" width="27" height="26" border="0" align="absmiddle" /></a></div> 
										<?php echo "<div id=\"getaquestion\">Got a Question?";   ?>
                      						 <a href="bpMyBopaMessageCompose.php?clsbpMessages_newToId=<?php echo $clsbpFileDetails->bi_sellerId; ?>"  class="itemfooterlinks">Send a message</a>
     							<?php }} 
							
							else { 
								?>
                                	<div class="getaquestionimg"><a href="bpSignIn.php?height=316&width=100px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo getCurrentPage();   ?>" class="thickbox itemfooterlinks"><img src="images/store-ico.png" width="27" height="26" border="0" align="absmiddle" /></a></div> 
										<?php echo "<div id=\"getaquestion\">Got a Question?";   ?>
                					<a href="bpSignIn.php?height=316&width=100px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo getCurrentPage();   ?>" class="thickbox itemfooterlinks">Send a message</a>
                			<?php } ?> 
                    
                    </div></td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" id="sellerNew">
                     <?php  
					
					 if($_SESSION['USERID'] !="" && $_SESSION['USERID'] !=$clsbpFileDetails->bi_sellerId)
					 {
					 
					  if($numOfFavSellors == 0)
                        {?>
				<a href='javascript:void(0);' onclick="return fn_Add(<?php echo $clsbpFileDetails->bi_sellerId;?>);"><img src="images/icon-add.png" alt="Add Seller to Favorites" width="27" height="26" border="0" align="absmiddle"/></a>
				
			<a href='javascript:void(0);' onclick="return fn_Add(<?php echo $clsbpFileDetails->bi_sellerId;?>);"  class="itemfooterlinks">Add Seller to Favorites</a>
            <?php     }
			         else{?>
            <img src="images/dis-add-a-cart-ico.png" alt="Add Seller to Favorites" width="27" height="26" border="0" align="absmiddle"/><a href="javascript:void(0);"   class="itemfooterlinks">One of My Saved Sellers</a>
            
			   <?php }
               } ?>
       
			
           <?php
		   if($_SESSION['USERID']=="")
		   {?>
           
				  <a href="bpSignIn.php?height=316&width=100px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo getCurrentPage();   ?>" class="thickbox itemfooterlinks"><img src="images/icon-add.png" alt="Add Seller to Favorites" width="27" height="26" border="0" align="absmiddle"/></a>
			
		   <a href="bpSignIn.php?height=316&width=100px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo getCurrentPage();?>" class="thickbox itemfooterlinks">Add Seller to Favorites</a>
		  <?php } ?>
                        </td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="50%" class="labels2">&nbsp;</td>
                  <td width="50%">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
          
          <tr>
            <td class="footer">&nbsp;</td>
          </tr>
        </table></td>
        <td width="25">&nbsp;</td>
        <td width="370" align="left" valign="top">
        <div id="memberstore-ad"><!-- Begin BidVertiser code -->
<SCRIPT LANGUAGE="JavaScript1.1" SRC="http://bdv.bidvertiser.com/BidVertiser.dbm?pid=122686&bid=295224" type="text/javascript"></SCRIPT>
<noscript><a href="http://www.bidvertiser.com">internet marketing</a></noscript>
<!-- End BidVertiser code -->

</div>
        
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
    
    
    <table width="921" border="0" align="center" cellpadding="0" cellspacing="0" id="srchresults-memberstore">
      <tr>
        <td class="tbl001"></td>
        <td class="tbl002">
        <div id="searchpage-hdr">Select all
          <input name="Check_ctr" type="checkbox" id="selectall" value="yes" onclick="javascript: fnSetAllCheckBoxes('frmMemberStore', 'addtoCart[]', this.checked)"/>
          &nbsp;&nbsp;<a href='javascript:void(0);'  onclick="return fn_addcart();"><img src="images/btn-add_to_cart.png" alt="Add to Cart" width="81" height="18" border="0" align="absmiddle" /></a> &nbsp;&nbsp;Sorted by
          <select name="sortMenu" id="jumpMenu" onchange="javascript : submitForm()">
                        <option value="1" <?php if($clsbpFileDetails->sortColumn=="dt_FileUploaded" && $clsbpFileDetails->sortDirection=="DESC"){echo 'selected='.'"selected"'; } ?>>Most Recently Listed</option>
                        <option value="2" <?php if($clsbpFileDetails->sortColumn=="dt_FileUploaded" && $clsbpFileDetails->sortDirection=="ASC"){echo 'selected='.'"selected"';} ?>>Least Recently Listed </option>
                        <option value="3" <?php if($clsbpFileDetails->sortColumn=="dbl_price" && $clsbpFileDetails->sortDirection=="DESC"){echo 'selected='.'"selected"';} ?>>Price: High to Low</option>
                        <option value="4"  <?php if($clsbpFileDetails->sortColumn=="dbl_price" && $clsbpFileDetails->sortDirection=="ASC"){echo 'selected='.'"selected"';} ?>>Price: Low to High</option>
                        <option value="5">Seller Rating: High to Low</option>
                        <option value="6">Seller Rating: Low to High</option>
                      </select>
        </div></td>
        <td class="tbl003"></td>
                </tr>
                <tr>
                    <td colspan="3" class="tbl004"><table width="100%" border="0" cellpadding="00" cellspacing="0" id="searchlistings">
                      <tr>
                        <th width="28">&nbsp;</th>
                        <th width="177"><a href="javascript:sortColumn('vc_title_nm_mod', 'clsbpFileDetails', 'frmMemberStore', '<?php echo $extraParameters; ?>');" onClick="this.href" <?php if($clsbpFileDetails->sortColumn =='vc_title_nm_mod' ||$clsbpFileDetails->sortColumn ==''){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}}?> >Song Title</a></th>
                        <th width="182"><a href="javascript:sortColumn('vc_artists_nm_mod', 'clsbpFileDetails', 'frmMemberStore', '<?php echo $extraParameters; ?>');" onClick="this.href" <?php if($clsbpFileDetails->sortColumn =='vc_artists_nm_mod'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Artist</a></th>
                        <th width="64"><a href="#">Format</a></th>
                        <th width="69"><a href="javascript:sortColumn('f_bitrate', 'clsbpFileDetails', 'frmMemberStore', '<?php echo $extraParameters; ?>');" onClick="this.href" <?php if($clsbpFileDetails->sortColumn =='f_bitrate'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Bit Rate</a></th>
                        <th width="64"><a href="javascript:sortColumn('dbl_price', 'clsbpFileDetails', 'frmMemberStore', '<?php echo $extraParameters; ?>');" onClick="this.href" <?php if($clsbpFileDetails->sortColumn =='dbl_price'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Price</a></th>
                       <!-- <th width="151"><a href="#">Sellers Feedback</a></th>-->
                        <th width="76"><a href="#">Add to Cart</a></th>
                        <th width="101"><a href="#">Buy Now</a></th>
                      </tr>
			<?php 
				function fnCheckLength($value, $length)
{   
    if(is_array($value)) list($string, $matching) = $value;
    else { $string = $value; $matching = $value{0}; }

    $match_start = stristr($string, $matching);
    $match_compute = strlen($string) - strlen($match_start);

    if (strlen($string) > $length)
    {
        if ($match_compute < ($length - strlen($matching)))
        {
            $pre_string = substr($string, 0, $length);
            $pos_end = strrpos($pre_string, " ");
            if($pos_end === false) $string = $pre_string."...";
            else $string = substr($pre_string, 0, $pos_end)."...";
        }
        else if ($match_compute > (strlen($string) - ($length - strlen($matching))))
        {
            $pre_string = substr($string, (strlen($string) - ($length - strlen($matching))));
            $pos_start = strpos($pre_string, " ");
            $string = "...".substr($pre_string, $pos_start);
            if($pos_start === false) $string = "...".$pre_string;
            else $string = "...".substr($pre_string, $pos_start);
        }
        else
        {       
            $pre_string = substr($string, ($match_compute - round(($length / 3))), $length);
            $pos_start = strpos($pre_string, " "); $pos_end = strrpos($pre_string, " ");
            $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
            if($pos_start === false && $pos_end === false) $string = "...".$pre_string."...";
            else $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
        }

        $match_start = stristr($string, $matching);
        $match_compute = strlen($string) - strlen($match_start);
    }
   
    return $string;
}
			
				$recordNumber	= $clsbpFileDetails->clsbpPaginate->recordNumberOffset;
				foreach ($arrfileDetails as $row) 
				{
					if ( $recordNumber &1 )
					{
						$class = "alternatebg001";
					}
					else
					{
						$class = "alternatebg002";
					}
					$string = fnCheckLength($row['vc_title_nm_mod'],25);
			?> 
                      <tr>
                        <td align="center" class="<?php echo $class; ?>" >  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="20" height="20">
                            <param name="movie" value="preview.swf">
                             <param name="wmode" value="transparent">
                            <param name="quality" value="high">
                            <param name="FlashVars" value="filename=temp/<?php echo stripslashes($row['vc_FileName']); ?>" />
                            <param name="allowScriptAccess" value="sameDomain" />
                            <embed src="preview.swf" quality="high" wmode="transparent"  allowScriptAccess="sameDomain" FlashVars="filename=temp/<?php echo stripslashes($row['vc_FileName']); ?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="20" height="20"></embed>
                            
                            </object></td>
                        <td align="left" class="<?php echo $class; ?> spacing" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes($string); ?></td>
                        <td align="left" class="<?php echo $class; ?> spacing" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes($row['vc_artists_nm_mod']); ?></td>
                        <td align="center" class="<?php echo $class; ?>"><img src="images/icon-mp3.png" width="52" height="28" /></td>
                        <td align="center" class="<?php echo $class; ?>" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes(round($row['f_bitrate'])); ?>Kbps</td>
                        <td align="center" class="<?php echo $class; ?>" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);" ><?php echo "$".number_format($row['dbl_price'],2); ?></td>
                     
                        <td align="center" class="<?php echo $class; ?>"><input id="add<?php echo $recordNumber; ?>"  type="checkbox" name="addtoCart[]" value="<?php echo $row[bi_file_id];?>" <?php if(!in_array($row[bi_file_id],$_SESSION['bopaBasket']['song']) ){ } else { ?>  disabled="disabled" readonly="readonly"<?php } ?> /></td>
                        <td align="center" class="<?php echo $class; ?>"><?php if(!in_array($row[bi_file_id],$_SESSION['bopaBasket']['song']) ){?><a href='javascript:void(0);'  class="buynow" onclick="return fn_addCcart(<?php echo $recordNumber; ?>);" ></a><?php } else { echo "Already In Cart";}?></td>
                      </tr>
                       <?php
					$recordNumber++;
				} 
			?>    
                    </table></td>
                </tr>
      <tr>
        <td class="tbl005"></td>
        <td class="tbl006"></td>
        <td class="tbl007"></td>
      </tr>
    </table>
   <div id="errornew" align="center"><?php echo displayError(); ?></div>
            <div id="pages" align="center"><?php echo $clsbpFileDetails->clsbpPaginate->writeHTMLPageRanges("clsbpFileDetails", "frmMemberStore", $extraParameters);
			
			?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jump to
              <input name="clsbpFileDetails_jumpTo" id="pagenumber" type="text" value="" />
          <input type="image" src="images/btn-go.png" id="sendbtn1" alt="Go To Page" align="bottom" />
         </div>

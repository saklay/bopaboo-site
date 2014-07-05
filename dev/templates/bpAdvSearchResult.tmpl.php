<div id="container">
        
        <div id="ad">
          <!-- Begin: AdBrite -->
          <script type="text/javascript">
				var AdBrite_Title_Color = '0000FF';
				var AdBrite_Text_Color = '000000';
				var AdBrite_Background_Color = 'FFFFFF';
				var AdBrite_Border_Color = 'CCCCCC';
				var AdBrite_URL_Color = '008000';
            </script>
          <span style="white-space:nowrap;">
          <script src="http://ads.adbrite.com/mb/text_group.php?sid=597989&amp;zs=3732385f3930" type="text/javascript"></script>
          <!--  -->
          <a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=597989&amp;afsid=1"> <img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#CCCCCC;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" /> </a> </span>
          <!-- End: AdBrite -->
        </div>
        <div id="pagehead">
        	<h1>
            	<?php 
					if($clsbpFileDetails == '')
						echo "Search Results";
					else
						echo "Search for ".$clsbpFileDetails->txtSearch;
				?>
            		
                
            </h1>
        </div>
        <div id="searchpage">
       
<form action="" method="post" name="frmsrch">
		
         <input type="hidden"  name="clsbpFileDetails_searchSize" value="<?php echo $clsbpFileDetails->searchSize; ?>">
		<input type="hidden"  name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
		<input type="hidden"  name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
		<input type="hidden"  name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
		<input type="hidden"  name="clsbpFileDetails_action" value=""> 
		<input type="hidden"  name="clsbpFileDetails_FileIds" value=""> 
		<input type="hidden" name="clsbpFileDetails_FileId" value=""> 
		<input type="hidden" name="clsbpFileDetails_bi_GenreId" value="<?php echo $clsbpFileDetails->bi_GenreId; ?>"> 
		<input type="hidden" name="clsbpFileDetails_vc_Tags" value="<?php echo $clsbpFileDetails->vc_Tags; ?>"> 
		<input type="hidden" name="clsbpFileDetails_txtSearch" value="<?php echo $clsbpFileDetails->txtSearch; ?>"> 
		<input type="hidden" name="clsbpFileDetails_seachCat" value="<?php echo $clsbpFileDetails->seachCat; ?>"> 
		<input type="hidden" name="clsbpFileDetails_returnUrl" value=""> 
		<input type="hidden"  name="clsbpBopaCart_action" value=""> 
		<input type="hidden"  name="clsbpBopaCart_FileIds" value=""> 
		<input type="hidden" name="clsbpBopaCart_FileId" id="clsbpBopaCart_FileId" value=""> 
		<input type="hidden" name="clsbpBopaCart_returnUrl" value=""> 
		<input type="hidden"  name="clsbpFileDetails_submitted" value="1">
		
        	<input type="hidden"  name="clsbpFileDetails_lstSeachCat" value="<?php echo $clsbpFileDetails->searchCat; ?>">
        	<input type="hidden"  name="clsbpFileDetails_optSearchType" value="<?php echo $clsbpFileDetails->searchType; ?>">
        	<input type="hidden"  name="clsbpFileDetails_lstGenre" value="<?php echo $clsbpFileDetails->searchGenre; ?>">
        	<input type="hidden"  name="clsbpFileDetails_txtMin" value="<?php echo $clsbpFileDetails->searchMinAmount; ?>">
        	<input type="hidden"  name="clsbpFileDetails_txtMax" value="<?php echo $clsbpFileDetails->searchMaxAmount; ?>">
        	<input type="hidden"  name="clsbpFileDetails_optSeller" value="<?php echo $clsbpFileDetails->searchIfSeller; ?>">
        	<input type="hidden"  name="clsbpFileDetails_lstAct" value="<?php echo $clsbpFileDetails->searchAction; ?>">
        	<input type="hidden"  name="clsbpFileDetails_txtSeller" value="<?php echo $clsbpFileDetails->searchSeller; ?>">
            	<input type="hidden"  name="clsbpFileDetails_goBack" value="<?php echo $_SERVER['PHP_SELF'];?>">
            <div id="tableParent">
            <table width="921" border="0" cellpadding="0" cellspacing="0" id="srchresults">
                <tr>
                    <td class="tbl001"></td>
                    <td class="tbl002"><div style="float:left; width:180px;line-height:36px;font-size:10px"><?php echo $clsbpFileDetails->clsbpPaginate->writePageStatus(count($arrfileDetails));?></div><div id="searchpage-hdr"> Select all <input name="Check_ctr" type="checkbox" id="selectall" value="yes" onclick="javascript: fnSetAllCheckBoxes('frmsrch', 'addtoCart[]', this.checked)"/>
                      &nbsp;&nbsp;<a href='javascript:void(0);'  onclick="return fn_addcart();" ><img src="images/btn-add_to_cart.png" alt="Add to Cart" width="81" height="18" border="0" align="absmiddle" /></a> &nbsp;&nbsp;Sorted by 
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
                        <th width="177"><a href="javascript:sortColumn('vc_title_nm_mod', 'clsbpFileDetails', 'frmsrch', '<?php echo $extraParameters; ?>');" onClick="this.href" <?php if($clsbpFileDetails->sortColumn =='vc_title_nm_mod' ||$clsbpFileDetails->sortColumn ==''){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}}?> >Song Title</a></th>
                        <th width="182"><a href="javascript:sortColumn('vc_artists_nm_mod', 'clsbpFileDetails', 'frmsrch', '<?php echo $extraParameters; ?>');" onClick="this.href" <?php if($clsbpFileDetails->sortColumn =='vc_artists_nm_mod'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Artist</a></th>
                        <th width="64"><a href="#">Format</a></th>
                        <th width="69"><a href="javascript:sortColumn('f_bitrate', 'clsbpFileDetails', 'frmsrch', '<?php echo $extraParameters; ?>');" onClick="this.href" <?php if($clsbpFileDetails->sortColumn =='f_bitrate'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Bit Rate</a></th>
                        <th width="64"><a href="javascript:sortColumn('dbl_price', 'clsbpFileDetails', 'frmsrch', '<?php echo $extraParameters; ?>');" onClick="this.href" <?php if($clsbpFileDetails->sortColumn =='dbl_price'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Price</a></th>
                        <th width="151"><a href="javascript: void(0);" onClick="javascript:sortColumn('avgRating', 'clsbpFileDetails', 'frmsrch', '<?php echo $extraParameters; ?>');" <?php if($clsbpFileDetails->sortColumn =='avgRating'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Sellers Feedback</a></th>
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
					
					
					if((0.00 < $row["avgRating"]) &&  ($row["avgRating"] <= 1.00)) {
						$row["avgRating"] = 1; 
					}
					else if((1.00 < $row["avgRating"]) && ($row["avgRating"]<=1.25)) {
						$row["avgRating"] = floor($row["avgRating"]); 
					}
					else if((1.25 < $row["avgRating"]) && ($row["avgRating"]<=1.75)) {
						$row["avgRating"] = 15;
					}
					else if((1.75<$row["avgRating"]) && ( $row["avgRating"] <= 2.00)) {
						$row["avgRating"] = 2;
					}
					
					
					else if((2.00 < $row["avgRating"]) && ($row["avgRating"]<=2.25)) {
						$row["avgRating"] = floor($row["avgRating"]); 
					}
					else if((2.25 < $row["avgRating"]) && ($row["avgRating"]<=2.75)) {
						$row["avgRating"] = 25;
					}
					else if((2.75<$row["avgRating"]) && ( $row["avgRating"] <= 3.00)) {
						$row["avgRating"] = 3;
					}
					
					
					else if((3.00 < $row["avgRating"]) && ($row["avgRating"]<=3.25)) {
						$row["avgRating"] = floor($row["avgRating"]); 
					}
					else if((3.25 < $row["avgRating"]) && ($row["avgRating"]<=3.75)) {
						$row["avgRating"] = 35;
					}
					else if((3.75<$row["avgRating"]) && ( $row["avgRating"] <= 4.00)) {
						$row["avgRating"] = 4;
					}
					
					
					else if((4.00 < $row["avgRating"]) && ($row["avgRating"]<=4.25)) {
						$row["avgRating"] = floor($row["avgRating"]); 
					}
					else if((4.25 < $row["avgRating"]) && ($row["avgRating"]<=4.75)) {
						$row["avgRating"] = 45;
					}
					else if((4.75<$row["avgRating"]) && ( $row["avgRating"] <= 5.00)) {
						$row["avgRating"] = 5;
					}
			
					else {
						$row["avgRating"] = 0;
					}
					
			
			?> 
                      <tr>
                        <td align="center" class="<?php echo $class; ?>">  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="15" height="15">
                            <param name="movie" value="preview.swf">
                            <param name="wmode" value="transparent">
                            <param name="quality" value="high">
                            <param name="FlashVars" value="filename=temp/<?php echo stripslashes($row['vc_FileName']); ?>" />
                            <param name="allowScriptAccess" value="sameDomain" />
                            <embed src="preview.swf" quality="high" wmode="transparent" allowScriptAccess="sameDomain" FlashVars="filename=temp/<?php echo stripslashes($row['vc_FileName']); ?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="20" height="20"></embed>
                            
                            </object></td>
                        <td align="left" class="<?php echo $class; ?> spacing" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><a href="javascript: void(0);" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes($string); ?></a></td>
                        <td align="left" class="<?php echo $class; ?> spacing"  onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><a href="javascript: void(0);" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes($row['vc_artists_nm_mod']); ?></a></td>
                        <td align="center" class="<?php echo $class; ?>"><img src="images/icon-mp3.png" width="52" height="28" /></td>
                        <td align="center" class="<?php echo $class; ?>" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes(round($row['f_bitrate'])); ?>Kbps</td>
                        <td align="center" class="<?php echo $class; ?>" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo "$".number_format($row['dbl_price'],2); ?></td>
                         <td align="left" class="<?php echo $class; ?> spacing"><!--<img src="images/rate_1star.png" alt="1 star rating" width="96" height="20" border="0" align="absmiddle" /><span class="spacing">(169)</span>--><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                           
                            <td width="7%" align="left" valign="middle" style="border:none" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><img src="images/rate_<?php echo $row["avgRating"] ?>star.png" alt="Seller Rating" width="96" height="20" border="0" align="absmiddle" /></td>
                            <td width="64%" align="left" valign="middle" style="border:none" onclick="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);">(<?php $clsbpRatings->fn_showUserRatings($row['bi_MemberId']); echo $clsbpRatings->totalReviews;?>)</td>
                          </tr>
                        </table></td>
                        <td align="center" class="<?php echo $class; ?>"><input id="add<?php echo $recordNumber; ?>" type="checkbox" name="addtoCart[]"  value="<?php echo $row['bi_file_id'];?>" <?php if(!in_array($row['bi_file_id'],$_SESSION['bopaBasket']['song']) ){ } else { ?>  disabled="disabled" readonly="readonly"<?php } ?> /></td>
                        <td align="center" class="<?php echo $class; ?>"><?php if(!in_array($row['bi_file_id'],$_SESSION['bopaBasket']['song']) ){?><a href='javascript:void(0);'  class="buynow" onclick="return fn_addCcart(<?php echo $recordNumber; ?>);"></a><?php } else { echo "Already In Cart";}?></td>
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
            
       	   <div align="center"><?php echo displayMessage(); ?></div>
            <div id="pages" align="center"><?php echo $clsbpFileDetails->clsbpPaginate->writeHTMLPageRanges("clsbpFileDetails", "frmsrch", $extraParameters);
			
			?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jump to
              <input name="clsbpFileDetails_jumpTo" id="pagenumber" type="text" value="" />
          <input type="image" src="images/btn-go.png" id="sendbtn1" alt="Go To Page" align="bottom" />
          </div>
         </div>
       </form>
       </div>
      
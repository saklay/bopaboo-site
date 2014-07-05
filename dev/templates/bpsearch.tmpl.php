<SCRIPT  type="text/javascript" language="javascript">
<!--

<!-- Begin
function fnSetAllCheckBoxes(FormName, FieldName, CheckValue) {
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
}

// End -->

function fn_cart(fileId) {
	var frm = document.frmsrch;
	frm.clsbpBopaCart_action.value="ADDTOCART";
	frm.action="bpBopaCart.php?fileId="+fileId+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php?clsbpFileDetails_txtSearch=$clsbpFileDetails->txtSearch";  ?>";
	frm.submit();
}

function fn_addcart() {
	var frmcart = document.frmsrch;
	fileIds		= getCheckedItem(frmcart,"addtoCart[]");
	if(fileIds==undefined || fileIds=='') {
		alert('Please select a song from list');
		return false
	} else{
		frmcart.clsbpBopaCart_action.value="ADDTOCART";
		frmcart.action="bpBopaCart.php?fileIds="+fileIds+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php?clsbpFileDetails_txtSearch=$clsbpFileDetails->txtSearch"; ?>";
		frmcart.submit();
	}
}

function fn_viewDetails(fileId) {
	var frm = document.frmsrch;
	frm.action="bpViewFileDetails.php?clsbpFileDetails_bi_file_id="+fileId+"&returnUrl=<?php echo "bpSearch.php";  ?>&extraparameters=<?php echo $extraParameters?>";
	frm.submit();	
}

function fn_addCcart(val) {
	var chk = "add"+val;	
	var elid = document.getElementById(chk);
	elid.checked=true;
	fn_addcart();
}

//
// Ajax Call
//

function fn_showTab(url){
document.getElementById('loadImage').style.visibility ='visible'
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){

  alert ("Browser does not support HTTP Request")
  return
} 



function stateChangedTab() { 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") { 
		document.getElementById('searchpage').innerHTML=xmlHttp.responseText ;
 		document.getElementById('loadImage').style.visibility ='hidden'
	}
}
	       
                  selItem=document.getElementById("sortMenu").value;
// 		 gurl=url+"?sortMenu="+selItem;
		xmlHttp.onreadystatechange=stateChangedTab;	
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
}
	



function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

//end of Ajax



</script>

<div id="container">
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
					<input type="hidden" name="clsbpFileDetails_vc_tags" value="<?php echo $clsbpFileDetails->vc_tags; ?>"> 
					<input type="hidden" name="clsbpFileDetails_txtSearch" value="<?php echo $clsbpFileDetails->txtSearch; ?>"> 
					<input type="hidden" name="clsbpFileDetails_seachCat" value="<?php echo $clsbpFileDetails->seachCat; ?>"> 
					<input type="hidden" name="clsbpFileDetails_SearchGenreId" value="<?php echo $clsbpFileDetails->SearchGenreId; ?>"> 
					<input type="hidden" name="clsbpFileDetails_SearchGenreName" value="<?php echo $clsbpFileDetails->SearchGenreName; ?>"> 
					<input type="hidden" name="clsbpFileDetails_Search_tags" value="<?php echo $clsbpFileDetails->Searchtags; ?>"> 
					<input type="hidden" name="clsbpFileDetails_artist" value="<?php echo $clsbpFileDetails->artistname; ?>"> 
					<input type="hidden" name="clsbpFileDetails_album" value="<?php echo $clsbpFileDetails->albumname; ?>">
					<input type="hidden" name="clsbpFileDetails_vc_Tags" value="<?php echo $clsbpFileDetails->vc_Tags; ?>">
					<input type="hidden"  name="clsbpFileDetails_lstSeachCat" value="<?php echo $clsbpFileDetails->searchCat; ?>">
					<input type="hidden"  name="clsbpFileDetails_optSearchType" value="<?php echo $clsbpFileDetails->searchType; ?>">
					<input type="hidden"  name="clsbpFileDetails_lstGenre" value="<?php echo $clsbpFileDetails->searchGenre; ?>">
					<input type="hidden"  name="clsbpFileDetails_txtMin" value="<?php echo $clsbpFileDetails->searchMinAmount; ?>">
					<input type="hidden"  name="clsbpFileDetails_txtMax" value="<?php echo $clsbpFileDetails->searchMaxAmount; ?>">
					<input type="hidden"  name="clsbpFileDetails_optSeller" value="<?php echo $clsbpFileDetails->searchIfSeller; ?>">
					<input type="hidden"  name="clsbpFileDetails_lstAct" value="<?php echo $clsbpFileDetails->searchAction; ?>">
					<input type="hidden"  name="clsbpFileDetails_txtSeller" value="<?php echo $clsbpFileDetails->searchSeller; ?>">
					<input type="hidden" name="clsbpFileDetails_returnUrl" value=""> 
					<input type="hidden"  name="clsbpBopaCart_action" value=""> 
					<input type="hidden"  name="clsbpBopaCart_FileIds" value=""> 
					<input type="hidden" name="clsbpBopaCart_FileId" id="clsbpBopaCart_FileId" value=""> 
					<input type="hidden" name="clsbpBopaCart_returnUrl" value=""> 
					<input type="hidden"  name="clsbpFileDetails_submitted" value="1">
					<input type="hidden"  name="clsbpFileDetails_goBack" value="<?php echo $_SERVER['PHP_SELF'];?>">
					<input type="hidden" name="clsbpFileDetails_advSearchFlag" value="<?php echo $clsbpFileDetails->flagAdvSearch; ?>">
					<input type="hidden"  name="showjmenu" id="showjmenu" >
        
      <div class="roundedTab" id="searchResults" style="background-color:#ffffff;">
        <div class="t">
        		<div class="tabOff"><h3 class="wide"><a href="bpBuy.php" >top 25</a></h3></div>
        		<div class="tabOff"><h3 class="wide"> <a href="bpBuy.php?tab=toptags" >top tags</a></h3></div>
        		<div class="tabOff"><h3 class="wide"><a href="bpBuy.php?tab=genre" >genre </a></h3></div>
        		<div class="tabOff"><h3 class="wide"><a href="bpBuy.php?tab=popular" >popular</a>  </h3></div>
            <div class="tab"><h3 class="wide">search</h3></div>
            <div id="loadImage" class="loading" style="visibility:hidden;"> <img src="<?php echo IMAGEPATH ?>o2.gif" alt="loading" width="16" height="16" /> </div>
            <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->

			<div class="searchHdr">
            	<div class="hdrSearchResults"><h1><?php 
			
					if($clsbpFileDetails->Searchtags!='') {
						echo "search results for  ".stripslashes($clsbpFileDetails->Searchtags);
					}
					else if($clsbpFileDetails->artistname!='') {
						echo "search results for ".stripslashes($clsbpFileDetails->artistname);
					} 
					else if($clsbpFileDetails->albumname!='') {
						echo "search results for ".stripslashes($clsbpFileDetails->albumname);
					} 
					else if ($clsbpFileDetails->txtSearch!='') {
						echo "search results for ".$displaySearch = str_replace("Search ","",stripslashes($clsbpFileDetails->txtSearch));
					}
					else {
						echo "search results";
					}
						
			?>
			<?php echo stripslashes($clsbpFileDetails->SearchGenreName); ?></h1></div>
                <div class="searchResultsSortBy"> 
                    <span class="selectText">sort by</span>
                    <span class="selectSortBox">
                        <select name="sortMenu" id="sortMenu" onchange="javascript:changeSearchOption('bpAjaxSearch.php','1','clsbpFileDetails','frmsrch','<?php echo $extraParameters;?>');">
                        	<option value="1" <?php if($clsbpFileDetails->sortColumn=="dt_FileUploaded" && $clsbpFileDetails->sortDirection=="DESC"){echo 'selected='.'"selected"'; } ?>>most recently listed</option>
                        	<option value="2" <?php if($clsbpFileDetails->sortColumn=="dt_FileUploaded" && $clsbpFileDetails->sortDirection=="ASC"){echo 'selected='.'"selected"';} ?>>least recently listed </option>
                        	<option value="3" <?php if($clsbpFileDetails->sortColumn=="dbl_price" && $clsbpFileDetails->sortDirection=="DESC"){echo 'selected='.'"selected"';} ?>>price: high to low</option>
                        	<option value="4"  <?php if($clsbpFileDetails->sortColumn=="dbl_price" && $clsbpFileDetails->sortDirection=="ASC"){echo 'selected='.'"selected"';} ?>>price: low to high</option>
                        	<option value="5" <?php if($clsbpFileDetails->sortColumn=="avgRating" && $clsbpFileDetails->sortDirection=="DESC"){echo 'selected='.'"selected"';} ?>>seller rating: high to low</option>
                        	<option value="6" <?php if($clsbpFileDetails->sortColumn=="avgRating" && $clsbpFileDetails->sortDirection=="ASC"){echo 'selected='.'"selected"';} ?>>seller rating: low to high</option>
                        </select>
                    </span>      
              </div>
            </div>
            <div class="clsTable"></div>
          <div class="tableHolder">
          	<table width="980" class="tableGeneral" id="buyPageTable">
			<thead>
                  <tr valign="middle">
                    <th width="32"  id="first" class="cehckboxCell"><input name="Check_ctr" type="checkbox" id="selectall" value="yes" onclick="javascript: fnSetAllCheckBoxes('frmsrch', 'addtoCart[]', this.checked)"/></th>
                    <th width="246" <?php if($clsbpFileDetails->sortColumn =='vc_title_nm_mod' ||$clsbpFileDetails->sortColumn ==''){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='highlightCol'";}}?> ><a href="javascript:sortAjaxColumn('bpAjaxSearch.php', 'vc_title_nm_mod', 'clsbpFileDetails','frmsrch','<?php echo $extraParameters; ?>');">song title</a></th>
                    <th width="246" <?php if($clsbpFileDetails->sortColumn =='vc_artists_nm_mod'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='highlightCol'";}} ?> ><a href="javascript:sortAjaxColumn('bpAjaxSearch.php', 'vc_artists_nm_mod', 'clsbpFileDetails','frmsrch','<?php echo $extraParameters; ?>');">artist</a></th>
                    <th width="66" <?php if($clsbpFileDetails->sortColumn =='f_bitrate'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='highlightCol'";}} ?> ><a href="javascript:sortAjaxColumn('bpAjaxSearch.php', 'f_bitrate', 'clsbpFileDetails','frmsrch','<?php echo $extraParameters; ?>');">bitrate</a></th>
                    <th width="69" <?php if($clsbpFileDetails->sortColumn =='dbl_price'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='highlightCol'";}} ?> ><a href="javascript:sortAjaxColumn('bpAjaxSearch.php', 'dbl_price', 'clsbpFileDetails','frmsrch','<?php echo $extraParameters; ?>');">price</a></th>
                    <th width="145" <?php if($clsbpFileDetails->sortColumn =='avgRating'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='highlightCol'";}} ?> ><a href="javascript:sortAjaxColumn('bpAjaxSearch.php', 'avgRating', 'clsbpFileDetails','frmsrch','<?php echo $extraParameters; ?>');">sellers feedback</a></th>
                    <th width="85" nowrap><a href="#">add to cart</a></th>
                		<th width="85" class="fin"><a href="#">buy now</a></th>
                </tr>
            </thead>
             <tbody>
             	
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
								$string = fnCheckLength($row['vc_title_nm_mod'],31);
								
								
								if((0.00 < $row["avgRating"]) &&  ($row["avgRating"] <= 1.00)) {
									$row["avgRating"] = 1; 
								}
								else if((1.00 < $row["avgRating"]) && ($row["avgRating"] <=1.25)) {
									$row["avgRating"] = floor($row["avgRating"]); 
								}
								else if((1.25 < $row["avgRating"]) && ($row["avgRating"] <=1.75)) {
									$row["avgRating"] = 15;
								}
								else if((1.75<$row["avgRating"]) && ( $row["avgRating"] <= 2.00)) {
									$row["avgRating"] = 2;
								}
								
								
								else if((2.00 < $row["avgRating"]) && ($row["avgRating"] <=2.25)) {
									$row["avgRating"] = floor($row["avgRating"]); 
								}
								else if((2.25 < $row["avgRating"]) && ($row["avgRating"] <=2.75)) {
									$row["avgRating"] = 25;
								}
								else if((2.75<$row["avgRating"]) && ( $row["avgRating"] <= 3.00)) {
									$row["avgRating"] = 3;
								}
								
								
								else if((3.00 < $row["avgRating"]) && ($row["avgRating"] <=3.25)) {
									$row["avgRating"] = floor($row["avgRating"]); 
								}
								else if((3.25 < $row["avgRating"]) && ($row["avgRating"] <=3.75)) {
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
             	
                <tr valign="middle">
               	  <td align="center" valign="bottom">
               	  	<div style="float:left;margin-left:5px;margin-bottom:2px;">
               	  	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="20" height="20">
               	  		<param name="movie" value="preview.swf">
               	  		<param name="wmode" value="transparent">
               	  		<param name="quality" value="high">
               	  		<param name="FlashVars" value="filename=http://bopabox.s3.amazonaws.com/bopaBox/<?php echo $row['bi_MemberId']; ?>/music/<?php echo stripslashes($row['vc_FileName']); ?>" />
               	  		<param name="allowScriptAccess" value="sameDomain" />
               	  		<embed src="preview.swf" quality="high" wmode="transparent"  allowScriptAccess="sameDomain" FlashVars="filename=http://bopabox.s3.amazonaws.com/bopaBox/<?php echo $row['bi_MemberId']; ?>/music/<?php echo stripslashes($row['vc_FileName']); ?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="20" height="20"></embed>
               	  	</object>
               	  	</div>
									</td>
                  <td valign="bottom" class="indent" style="width:246px;"><a href="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes($string); ?></a></td>
                  <td valign="bottom" class="indent" style="width:246px;"><a href="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes($row['vc_artists_nm_mod']); ?></a></td>
                  <td valign="bottom" class="indent"><?php echo stripslashes(round($row['f_bitrate'])); ?>K</td>
                  <td valign="bottom" class="indentright"><?php echo "$".number_format($row['dbl_price'],2); ?></td>
                  <td valign="bottom" class="indent"><a href="javascript:void();"><img src="<?php echo IMAGEPATH; ?>rate_<?php echo $row["avgRating"] ?>star.png" alt="seller rating" border="0" /></a>&nbsp;<a href="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);">(<?php $clsbpRatings->fn_showUserRatings($row['bi_MemberId']); echo $clsbpRatings->totalReviews;?>)</a></td>
                  <td align="center" valign="bottom"><input id="add<?php echo $recordNumber; ?>"  type="checkbox" name="addtoCart[]" value="<?php echo $row[bi_file_id];?>" <?php if(!in_array($row[bi_file_id],$_SESSION['bopaBasket']['song']) ){ } else { ?>  disabled="disabled" readonly="readonly"<?php } ?> /></td>
                  <td align="center" valign="bottom"><?php if(!in_array($row[bi_file_id],$_SESSION['bopaBasket']['song']) ){?><span class="btBuyNow2"><a href="javascript:void(0);" style="display:block;" onclick="return fn_addCcart(<?php echo $recordNumber; ?>);" ></a></span><?php } else { echo "Already In Cart";}?></td>
               </tr>
					<?php
								$recordNumber++;
							} 
						?>
             </tbody>
          </table>
          </div>
        
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- bopaBigBox ends -->
      
      <div class="cls"></div>
      
      <div id="errornew" align="center"><?php echo displayError(); ?></div>
            
      <div id="pages" align="center"><?php echo $clsbpFileDetails->clsbpPaginate->getHTMLPageRangesForAjax("bpAjaxSearch.php","clsbpFileDetails", "frmsrch", $extraParameters,'');?></div>

</form>
</div>
</div>

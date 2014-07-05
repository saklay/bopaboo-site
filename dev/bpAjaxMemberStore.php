<?php
//ob_start();
//header("Cache-Control: no-store, no-cache");

set_time_limit (60);
$includePath		= "./";
$pageTitle			= "www.bopaboo.com";
$metaDescription	= "";
$metaKeywords		= "";

include_once($includePath."bpCommon.php");
// error_reporting(E_ALL);

include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpRatings.cls.php");
include_once($includePath."classes/bpMemberStore1.cls.php");
$extraParameters	.= "searchSize=$clsbpFileDetails->searchSize&submitted=$clsbpFileDetails->submitted&ms=$clsbpFileDetails->mS";

global $clsbpCreditCard;
global $arrMM_TO_MMM,$yearArray,$MonthArray;
	
	/*----------------------------------------------------------------------------	
	 For Sign In Popup*/
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");

	$clsbpUserLogin->setGetVars(); 
	 $clsbpUserLogin->postContactForUserDeatils(); 
	
	/*---------------------------------------------------------------------------*/

	
	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsbpCreditCard->pageSize);
	

	//$extraParameters	.= "pageSize=$clsbpCreditCard->pageSize&submitted=$clsbpCreditCard->submitted";
	
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
// displayObject($clsbpFileDetails);
	$query = "SELECT * FROM tbl_mem_login WHERE vc_DisplayName = '".$clsbpFileDetails->mS."'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	
		if(count($row)>1){

				/*--------------------------------------------------------------------------------*/
				
				$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
				$rating = $clsbpRatings->fn_showUserRatingsAsImage($row[0]);
				/*--------------------------------------------------------------------------------*/
				
				$arrfileDetails = $clsbpFileDetails->retrieveMemberStoreArray();
				$clsbpFileDetails->retrieveMember();
				
				$arraySize=sizeof($arrfileDetails);
				
			
				
				if($_SESSION["USERID"] !="")
                                   {
                                        $numOfFavSellors = $clsbpFileDetails->checkFavSellerForMemberStore($clsbpFileDetails->bi_sellerId);
                                   }

				$extraParameters	.= "searchSize=$clsbpFileDetails->searchSize&submitted=$clsbpFileDetails->submitted&mS=$clsbpFileDetails->mS";
                         }
                       
?>


        <div class="cls"></div>
  
  
      <div class="roundedTab" id="bopaBigBox">
        <div class="t">
          <div class="tab"><h3 class="wide">all</h3></div>
          <div class="tabOff"><h3 class="wide"><a href="#">new</a></h3></div>
          <div class="tabOff"><h3 class="wide"><a href="#">deals</a></h3></div>
          <div id="loadImage" class="loading" style="visibility:hidden;"> <img src="<?php echo IMAGEPATH ?>o2.gif" alt="loading" width="16" height="16" /> </div>
          <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->

<form action="" method="post" name="frmMemberStore">
		<input type="hidden" name="clsbpFileDetails_searchSize" value="<?php echo $clsbpFileDetails->searchSize; ?>">
		<input type="hidden" name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
		<input type="hidden" name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
		<input type="hidden" name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
		<input type="hidden" name="clsbpFileDetails_action" value=""> 
		<input type="hidden" name="clsbpFileDetails_FileIds" value=""> 
		<input type="hidden" name="clsbpFileDetails_FileId" value=""> 
		<input type="hidden" name="clsbpFileDetails_bi_GenreId" value="<?php echo $clsbpFileDetails->bi_GenreId; ?>"> 
		<input type="hidden" name="clsbpFileDetails_vc_tags" value="<?php echo $clsbpFileDetails->vc_tags; ?>"> 
		<input type="hidden" name="clsbpFileDetails_txtSearch" value="<?php echo $clsbpFileDetails->txtSearch; ?>"> 
		<input type="hidden" name="clsbpFileDetails_seachCat" value="<?php echo $clsbpFileDetails->seachCat; ?>"> 
		<input type="hidden" name="clsbpFileDetails_SearchGenreId" value="<?php echo $clsbpFileDetails->SearchGenreId; ?>"> 
		<input type="hidden" name="clsbpFileDetails_SearchGenreName" value="<?php echo $clsbpFileDetails->SearchGenreName; ?>"> 
		<input type="hidden" name="clsbpFileDetails_Search_tags" value="<?php echo $clsbpFileDetails->Searchtags; ?>"> 
		<input type="hidden" name="clsbpFileDetails_returnUrl" value=""> 
		<input type="hidden" name="clsbpBopaCart_action" value=""> 
		<input type="hidden" name="clsbpBopaCart_FileIds" value=""> 
		<input type="hidden" name="clsbpBopaCart_FileId" id="clsbpBopaCart_FileId" value=""> 
		<input type="hidden" name="clsbpBopaCart_returnUrl" value=""> 
		<input type="hidden" name="clsbpFileDetails_submitted" value="1">
    <input type="hidden" name="mS" value="<?php echo $clsbpFileDetails->mS; ?>">
		<input type="hidden" name="clsbpFileDetails_goBack" value="<?php echo $_SERVER['PHP_SELF'];?>">
		<input type="hidden" name="showjmenu" value="0" />
		
			<!-- <div class="songNo">1 - 20 of 41 records</div> -->
            <div style="float:right;">                
              <select name="sortMenu" id="jumpMenu" onchange="javascript : return submitForm();">
              					<option value="1" <?php if($clsbpFileDetails->sortColumn=="dt_FileUploaded" && $clsbpFileDetails->sortDirection=="DESC"){echo 'selected='.'"selected"'; } ?>>most recently listed</option>
                        <option value="2" <?php if($clsbpFileDetails->sortColumn=="dt_FileUploaded" && $clsbpFileDetails->sortDirection=="ASC"){echo 'selected='.'"selected"';} ?>>least recently listed </option>
                        <option value="3" <?php if($clsbpFileDetails->sortColumn=="dbl_price" && $clsbpFileDetails->sortDirection=="DESC"){echo 'selected='.'"selected"';} ?>>price: high to low</option>
                        <option value="4"  <?php if($clsbpFileDetails->sortColumn=="dbl_price" && $clsbpFileDetails->sortDirection=="ASC"){echo 'selected='.'"selected"';} ?>>price: low to high</option>
                        <option value="5">seller rating: high to low</option>
                        <option value="6">seller rating: low to high</option>
              </select>
          </div>
            <div class="clsTable"></div>
          <table width="980" class="tableGeneral" id="bopaBoxTable">
            <thead>
              <tr valign="middle" class="tableHead">
                <th width="33"  id="first"><input name="Check_ctr" type="checkbox" id="selectall" value="yes" onclick="javascript: fnSetAllCheckBoxes('frmMemberStore', 'addtoCart[]', this.checked)"/></th>
                <th width="233" <?php if($clsbpFileDetails->sortColumn =='vc_artists_nm_mod'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='highlightCol'";}} ?> ><a href="javascript:sortAjaxColumn('bpAjaxMemberStore.php','vc_artists_nm_mod','clsbpFileDetails','frmMemberStore', '<?php echo $extraParameters; ?>','');">artist</a></th>
                <th width="233" <?php if($clsbpFileDetails->sortColumn =='vc_title_nm_mod' ||$clsbpFileDetails->sortColumn ==''){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='highlightCol'";}}?> ><a href="javascript:sortAjaxColumn('bpAjaxMemberStore.php','vc_title_nm_mod','clsbpFileDetails','frmMemberStore', '<?php echo $extraParameters; ?>','');">song</a></th>
                <th width="85" ><a href="#">genre</a></th>
                <th width="85" <?php if($clsbpFileDetails->sortColumn =='f_bitrate'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='highlightCol'";}} ?> ><a href="javascript:sortAjaxColumn('bpAjaxMemberStore.php','f_bitrate','clsbpFileDetails','frmMemberStore', '<?php echo $extraParameters; ?>','');">bitrate</a></th>
                <th width="85" <?php if($clsbpFileDetails->sortColumn =='dbl_price'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='highlightCol'";}} ?> ><a href="javascript:sortAjaxColumn('bpAjaxMemberStore.php','dbl_price','clsbpFileDetails','frmMemberStore', '<?php echo $extraParameters; ?>','');">price</a></th>
                <th width="85" ><a href="#">add to cart</a></th>
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
					$string = fnCheckLength($row['vc_title_nm_mod'],25);
			?> 
            	
              <tr valign="middle">
                <td align="center" valign="bottom">
                	<div style="float:left;margin-left:5px;margin-bottom:2px;">
                	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="20" height="20">
                  	<param name="movie" value="preview.swf">
                  	<param name="wmode" value="transparent">
                  	<param name="quality" value="high">
                  	<param name="FlashVars" value="filename=temp/<?php echo stripslashes($row['vc_FileName']); ?>" />
                  	<param name="allowScriptAccess" value="sameDomain" />
                  	<embed src="preview.swf" quality="high" wmode="transparent"  allowScriptAccess="sameDomain" FlashVars="filename=temp/<?php echo stripslashes($row['vc_FileName']); ?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="20" height="20"></embed>
									</object>
									</div>
                </td>
                <td valign="bottom" class="indent"><a href="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes($row['vc_artists_nm_mod']); ?></a></td>
                <td valign="bottom" class="indent"><a href="javascript: fn_viewDetails(<?php echo $row['bi_file_id'];?>);"><?php echo stripslashes($string); ?></a></td>
                <td align="center" valign="bottom">classical</td>
                <td align="center" valign="bottom"><?php echo stripslashes(round($row['f_bitrate'])); ?>kbps</td>
                <td align="center" valign="bottom"><?php echo "$".number_format($row['dbl_price'],2); ?></td>
                <td align="center" valign="bottom"><input id="add<?php echo $recordNumber; ?>"  type="checkbox" name="addtoCart[]" value="<?php echo $row[bi_file_id];?>" <?php if(!in_array($row[bi_file_id],$_SESSION['bopaBasket']['song']) ){ } else { ?>  disabled="disabled" readonly="readonly"<?php } ?> /></td>
                <td align="center" valign="bottom">
                	
<?php 
	if(!in_array($row[bi_file_id],$_SESSION['bopaBasket']['song'])) {
		if($_SESSION['USERID'] !=$clsbpFileDetails->bi_sellerId) {
?>
									<div class="btBuy"><a href="javascript:void(0);" onclick="return fn_addCcart(<?php echo $recordNumber; ?>);" style="float:left;"></a></div>
<?php
		} else {  
?>   
									<div class="btBuy"><a href="javascript:void(0);" style="float:left;"></a></div>
<?php  
		}
	} else {
									echo "Already In Cart";
	} 
?>
                	
                </td>
              </tr>

                       <?php
					$recordNumber++;
				} 
						?>

            </tbody>
<tbody><tr></tr>
          </tbody>
          </table>
        </form>
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- bopaBigBox ends -->
      
    	</div> <!-- id memberStore -->
      <div class="cls"></div>
            
      <div id="pages" align="center"><?php echo $clsbpFileDetails->clsbpPaginate->getHTMLPageRangesForAjax("bpAjaxMemberStore.php","clsbpFileDetails","frmMemberStore", $extraParameters); ?></div>

<?php
ob_get_contents();
?>

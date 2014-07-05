<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpRatings.cls.php");

//error_reporting(E_ALL);

global $arrPageRange;
global $rates;
	
$pageRange				= HTMLOptionKeyValArray($arrPageRange,$clsbpFileDetails->pageSize);
$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
$clsbpFileDetails->setPostVars();
$clsbpFileDetails->setGetVars();
$clsbpFileDetails->submitted = 1;
$clsbpFileDetails->postFiles();
$clsbpRatings			= new clsbpRatings($connect, $includePath,"clsbpRatings");
$clsbpUserLogin		= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
$arrObj						= get_object_vars($clsbpFileDetails);
$tgName						= $_GET['tabName'];

if($_GET['tabName']=='received'){

	if(($clsbpFileDetails->feedSortcolumn=="vc_title") && ($clsbpFileDetails->feedSortDirection=="ASC") ) {
			$iclass = "class='highlightCol'";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_title") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$iclass = "";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_DisplayName") && ($clsbpFileDetails->feedSortDirection=="ASC")) {
			$sclass = "class='highlightCol'";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_DisplayName") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$sclass = "";
		}
		if(($clsbpFileDetails->feedSortcolumn=="dt_insertedDate") && ($clsbpFileDetails->feedSortDirection=="ASC")) {
			$dclass = "class='highlightCol'";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="dt_insertedDate") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$dclass = "";
		}
		if(($clsbpFileDetails->feedSortcolumn=="vc_artists_nm_mod") && ($clsbpFileDetails->feedSortDirection=="ASC")) {
			$dclass = "";
			$clsbpFileDetails->feedSortDirection="ASC";
			$clsbpFileDetails->feedSortcolumn		= "dt_insertedDate"; $clsbpFileDetails->feedSortDirection    = "DESC";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_artists_nm_mod") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$dclass = "";
			$clsbpFileDetails->feedSortDirection="ASC";
	}
	
//$clsbpFileDetails->clsbpPaginate->writeHTMLPageRanges("clsbpFileDetails", "frmreceived", $extraParameters);
?>

<div class="roundedTab" id="feedbackBox" style="background-color:#ffffff;">
        <div class="c"> <div class="cl">
          <!--add content-->
<form action="" method="post" name="frmreceived">
	<input type="hidden" name="clsbpFileDetails_pageSize" value="<?php echo $clsbpFileDetails->pageSize; ?>">
	<input type="hidden" name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
	<input type="hidden" name="clsbpFileDetails_submitted" value="1">
	<input type="hidden" name="clsbpFileDetails_feedSortcolumn" value="<?php echo $clsbpFileDetails->feedSortcolumn; ?>"> 
	<input type="hidden" name="clsbpFileDetails_feedSortDirection" value="<?php echo $clsbpFileDetails->feedSortDirection; ?>"> 
	<input type="hidden" name="showjmenu" value="0">
						<div style="height:21px;"></div>

            <div class="clsTable"></div>
          <table width="951" class="tableGeneral" id="feedbackTable">
			<thead>
                  <tr valign="middle">
                    <th width="278" id="first" <?php echo $iclass; ?>><a href="javascript:sortAjaxColumnNew('bpajaxFeed.php','vc_title','clsbpFileDetails','frmreceived','<?php echo $extraParameters;?>','received');">song</a></th>
                    <th width="278" <?php echo $sclass; ?>><a href="javascript:sortAjaxColumnNew('bpajaxFeed.php','vc_DisplayName','clsbpFileDetails','frmreceived','<?php echo $extraParameters;?>','received');">seller</a></th>
                    <th width="149" ><a href="#">rating</a></th>
                    <th width="104" <?php echo $dclass; ?>><a href="javascript:sortAjaxColumnNew('bpajaxFeed.php','dt_insertedDate','clsbpFileDetails','frmreceived','<?php echo $extraParameters;?>','received');">date</a></th>
                    <th width="108" class="actions fin">&nbsp;</th>
                </tr>
            </thead>
             <tbody>

<?php
	//displayObject($clsbpFileDetails);
	$arrfileDetails1 = $clsbpFileDetails->retrieveFeedbackReceivedArray();
	$extraParameters	= "pageSize=".$clsbpFileDetails->pageSize."&submitted=".$clsbpFileDetails->submitted."";
	$totalRecords = count($arrfileDetails1);
	$clsbpFileDetails->feedbacklist="received";
	
	$count = 0;
	foreach ($arrfileDetails1 as $row) { 
		$count++;
		$width = $clsbpFileDetails->retrieveRatingArray($row[bi_SellerId],$row[bi_fileId]);
		$username =  $row[vc_DisplayName];
?>

                <tr valign="middle">
               	  <td valign="bottom" class="indent"><?php echo $row[vc_title]; ?></td>
                  <td valign="bottom" class="indent"><a href="bpMemberStore.php?mS=<?php echo $username; ?>"><?php echo $row[vc_DisplayName]; ?></a></td>
                  <td align="center" valign="bottom">
                  	<ul  class="star-rating">
                  		<li  class="current-rating" style="width:<?php echo $width; ?>px;">Currently 3/5 Stars.</li>
                  		<li><a href="#" title="1 star out of 5" >1</a></li>
                  		<li><a href="#" title="2 stars out of 5" >2</a></li>
                  		<li><a href="#" title="3 stars out of 5" >3</a></li>
                  		<li><a href="#" title="4 stars out of 5" >4</a></li>
                  		<li><a href="#" title="5 stars out of 5" >5</a></li>
                  	</ul>
                  </td>
                  <td align="center" valign="bottom"><?php echo date("F j, Y",strtotime($row[dt_insertedDate])); ?></td>
                  <td align="center" valign="bottom"></td>
               </tr>

<?php
	} 
?>

             </tbody>
          </table>
        </form>
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- bopaBigBox ends -->
      
      <div class="cls"></div>
            
      <div id="pages" align="center"><?php echo $clsbpFileDetails->clsbpPaginate->getHTMLPageRangesForAjax("bpajaxFeed.php","clsbpFileDetails", "frmreceived", $extraParameters,$tgName); ?></div>


<?php
}

if($_GET['tabName']=='provided'){

	if($_GET['optionVal']==2){ // feedback already given

		if(($clsbpFileDetails->feedSortcolumn=="vc_title") && ($clsbpFileDetails->feedSortDirection=="ASC") ) {
			$iclass = "class='highlightCol'";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_title") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$iclass = "";
			
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_DisplayName") && ($clsbpFileDetails->feedSortDirection=="ASC")) {
			$sclass = "class='highlightCol'";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_DisplayName") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$sclass = "";
			
		}
		if(($clsbpFileDetails->feedSortcolumn=="dt_insertedDate") && ($clsbpFileDetails->feedSortDirection=="ASC")) {
			$dclass = "class='highlightCol'";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="dt_insertedDate") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$dclass = "";
			
		}
		if(($clsbpFileDetails->feedSortcolumn=="vc_artists_nm_mod") && ($clsbpFileDetails->feedSortDirection=="ASC")) {
			$dclass = "";
			$clsbpFileDetails->feedSortDirection="ASC";
			$clsbpFileDetails->feedSortcolumn		= "dt_insertedDate"; $clsbpFileDetails->feedSortDirection    = "DESC";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_artists_nm_mod") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$dclass = "";
			$clsbpFileDetails->feedSortDirection="ASC";
			
		}
?>

      <div class="roundedTab" id="feedbackBox" style="background-color:#ffffff;">
        <div class="c"> <div class="cl">
          <!--add content-->
<form action="" method="post" name="frmrating">
	<input type="hidden" name="clsbpFileDetails_pageSize" value="<?php echo $clsbpFileDetails->pageSize; ?>">
	<input type="hidden" name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
	<input type="hidden" name="clsbpFileDetails_submitted" value="1">
	<input type="hidden" name="clsbpFileDetails_feedSortcolumn" value="<?php echo $clsbpFileDetails->feedSortcolumn; ?>"> 
	<input type="hidden" name="clsbpFileDetails_feedSortDirection" value="<?php $clsbpFileDetails->feedSortDirection; ?>"> 
		
		
            <div class="feedbackShow"> 
								<span class="selectText">show</span>
                <span class="selectSortBox">
                	<select onchange="javascript:changeOption('bpajaxFeed.php','1','clsbpFileDetails','frmrating','<?php echo $extraParameters; ?>','provided');" name="showjmenu" id="showjmenu" class="selectSort">
						  			<option value="1" >feedback needed</option>
                    <option value="2" selected="selected">feedback completed</option>
                  </select>
                  <input type="hidden" id="withinjmenu" name="withinjmenu" value="0">
                </span>      
          </div>
            <div class="clsTable"></div>
          <table width="951" class="tableGeneral" id="feedbackTable">
			<thead>
                  <tr valign="middle">
                    <th width="278" id="first" <?php echo $iclass; ?>><a href="javascript:sortAjaxColumnNew('bpajaxFeed.php','vc_title','clsbpFileDetails','frmrating','<?php echo $extraParameters; ?>','provided');">song</a></th>
                    <th width="278" <?php echo $sclass; ?>><a href="javascript:sortAjaxColumnNew('bpajaxFeed.php','vc_DisplayName','clsbpFileDetails','frmrating','<?php echo $extraParameters; ?>','provided');">seller</a></th>
                    <th width="149" class="album"><a href="#">rating</a></th>
                    <th width="104" <?php echo $dclass; ?>><a href="javascript:sortAjaxColumnNew('bpajaxFeed.php','dt_insertedDate','clsbpFileDetails','frmrating','<?php echo $extraParameters; ?>','provided');">date</a></th>
                    <th width="108" class="actions fin">&nbsp;</th>
                </tr>
            </thead>
             <tbody>
             	
<?php
						 $arrfileDetails = $clsbpFileDetails->retrieveFeedbackCompleteddArray();
						//print_r("<pre>");
						//print_r($arrfileDetails);
					//error_reporting(E_ALL);
						 $extraParameters	= "pageSize=$clsbpFileDetails->pageSize&submitted=$clsbpFileDetails->submitted&optionVal=2";
						 $count = 0;
						 foreach ($arrfileDetails as $row) { 
						  $count++;
 							$username =  $row[vc_DisplayName];
						  $clsbpFileDetails->feedbacklist="provided";
						  $width = $clsbpFileDetails-> retrieveRatingArray($row[bi_SellerId],$row[bi_fileId]);
?>
             	
                <tr valign="middle">
               	  <td valign="bottom" class="indent"><?php echo $row[vc_title]; ?></td>
                  <td valign="bottom" class="indent"><a href="bpMemberStore.php?mS=<?php echo $username; ?>"><?php echo $row[vc_DisplayName]; ?></a></td>
                  <td align="center" valign="bottom" id="Response<?php echo $row[bi_FileId]; ?>">
                  	<ul class="star-rating">
                  		<li id="<?php echo $row[bi_FileId]; ?>" class="current-rating" style="width:<?php echo $width; ?>px;">Currently 3/5 Stars.</li>
                  		<li ><a href="#" onclick="fn_alert(1,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_SellerId]; ?>,<?php echo $count; ?>)" title="1 star out of 5" <?php if($width==0){ ?> class="one-stars"<?php } ?>>1</a></li>
                  		<li ><a href="#" onclick="fn_alert(2,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_SellerId]; ?>,<?php echo $count; ?>)" title="2 star out of 5" <?php if($width==0){ ?> class="two-stars"<?php } ?>>2</a></li>
                  		<li ><a href="#" onclick="fn_alert(3,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_SellerId]; ?>,<?php echo $count; ?>)" title="3 star out of 5" <?php if($width==0){ ?> class="three-stars"<?php }  ?>>3</a></li>
                  		<li ><a href="#" onclick="fn_alert(4,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_SellerId]; ?>,<?php echo $count; ?>)" title="4 star out of 5" <?php if($width==0){ ?> class="four-stars"<?php } ?>>4</a></li>
                  		<li ><a href="#" onclick="fn_alert(5,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_SellerId]; ?>,<?php echo $count; ?>)" title="5 star out of 5" <?php if($width==0){ ?> class="five-stars"<?php } ?>>5</a></li>
                  	</ul>
                  	<input type="hidden" name="starUser<?php echo $row[bi_FileId]; ?>" value="0" />
                  </td>
                  <td align="center" valign="bottom"><?php echo date("F j, Y",strtotime($row[dt_insertedDate])); ?></td>
                  <td align="center" valign="bottom">
<?php
	if($width == 0 ) {
?>
                  	<div class="btSend2"><a href="javascript:void(0);" onClick="return fn_addrate(<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_SellerId]; ?>,<?php echo $count; ?>);" style="float:left;"></a></div>
<?php
	}
?>
                  </td>
               </tr>
<?php
                      } 
?>
             </tbody>
          </table>
        </form>
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- bopaBigBox ends -->
      
      <div class="cls"></div>
            
      <div id="pages" align="center"><?php echo $clsbpFileDetails->clsbpPaginate->getHTMLPageRangesForAjax("bpajaxFeed.php","clsbpFileDetails", "frmrating", $extraParameters,$tgName); ?></div>

<?php			
	}
	if($_GET['optionVal']==1){ // feedback to be completed

		if(($clsbpFileDetails->feedSortcolumn=="vc_title") && ($clsbpFileDetails->feedSortDirection=="ASC") ) {
			$iclass = "class='highlightCol'";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_title") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$iclass = "";
			
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_DisplayName") && ($clsbpFileDetails->feedSortDirection=="ASC")) {
			$sclass = "class='highlightCol'";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_DisplayName") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$sclass = "";
			
		}
		if(($clsbpFileDetails->feedSortcolumn=="dt_insertedDate") && ($clsbpFileDetails->feedSortDirection=="ASC")) {
			$dclass = "class='highlightCol'";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="dt_insertedDate") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$dclass = "";
			
		}
	if(($clsbpFileDetails->feedSortcolumn=="vc_artists_nm_mod") && ($clsbpFileDetails->feedSortDirection=="ASC")) {
			$dclass = "";
			$clsbpFileDetails->feedSortDirection="ASC";
			$clsbpFileDetails->feedSortcolumn		= "dt_insertedDate"; $clsbpFileDetails->feedSortDirection    = "DESC";
		}
		else if(($clsbpFileDetails->feedSortcolumn=="vc_artists_nm_mod") && ($clsbpFileDetails->feedSortDirection=="DESC")) {
			$dclass = "";
			$clsbpFileDetails->feedSortDirection="ASC";
			
		}
?>


      <div class="roundedTab" id="feedbackBox" style="background-color:#ffffff;">
        <div class="c"> <div class="cl">
          <!--add content-->
<form action="" method="post" name="frmrating">
	<input type="hidden" name="clsbpFileDetails_pageSize" value="<?php echo $clsbpFileDetails->pageSize; ?>">
	<input type="hidden" name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
	<input type="hidden" name="clsbpFileDetails_submitted" value="1">
	<input type="hidden" name="clsbpFileDetails_feedSortcolumn" value="<?php echo $clsbpFileDetails->feedSortcolumn; ?>"> 
	<input type="hidden" name="clsbpFileDetails_feedSortDirection" value="<?php echo $clsbpFileDetails->feedSortDirection; ?>"> 
	<input type="hidden" id="withinjmenu"  name="withinjmenu" value="0">
				
            <div class="feedbackShow"> 
				<span class="selectText">show</span>
                <span class="selectSortBox">
                	<select onchange="javascript:changeOption('bpajaxFeed.php','1','clsbpFileDetails','frmrating','<?php echo $extraParameters; ?>','provided');" name="showjmenu" id="showjmenu" class="selectSort">
						   			<option value="1" selected="selected">feedback needed</option>
                    <option value="2" >feedback completed</option>
									</select>
                </span>      
          </div>
            <div class="clsTable"></div>
          <table width="951" class="tableGeneral" id="feedbackTable">
			<thead>
                  <tr valign="middle">
                    <th width="278" id="first" <?php echo $iclass; ?>><a href="javascript:sortAjaxColumnNew('bpajaxFeed.php','vc_title','clsbpFileDetails','frmrating','<?php echo $extraParameters; ?>','provided');">song</a></th>
                    <th width="278" <?php echo $sclass; ?>><a href="javascript:sortAjaxColumnNew('bpajaxFeed.php','vc_DisplayName','clsbpFileDetails','frmrating','<?php echo $extraParameters; ?>','provided');">seller</a></th>
                    <th width="149" class="album"><a href="#">rating</a></th>
                    <th width="104" <?php echo $dclass; ?>><a href="javascript:sortAjaxColumnNew('bpajaxFeed.php','dt_insertedDate','clsbpFileDetails','frmrating','<?php echo $extraParameters; ?>','provided');">date</a></th>
                    <th width="108" class="actions fin">&nbsp;</th>
                </tr>
            </thead>
             <tbody>
             	
<?php

		$arrfileDetails		= $clsbpFileDetails->retrieveFeedbackNeededArray();
		//print_r($arrfileDetails);
		//error_reporting(E_ALL);
		$extraParameters	= "pageSize=$clsbpFileDetails->pageSize&submitted=$clsbpFileDetails->submitted&optionVal=1";
		$count						= 0;
		foreach ($arrfileDetails as $row) {
			$username =  $row[vc_DisplayName];
			$count++;
			$clsbpFileDetails->feedbacklist="provided";
			
?>
             	
                <tr valign="middle" id="tr_<?php echo $count; ?>" style="display:;">
               	  <td valign="bottom" class="indent"><?php echo $row[vc_title]; ?></td>
                  <td valign="bottom" class="indent"><a href="bpMemberStore.php?mS=<?php echo $username; ?>"><?php echo $row[vc_DisplayName]; ?></a></td>
                  <td align="center" valign="bottom" id="Response<?php echo $row[bi_FileId]; ?>">
                  	<ul class="star-rating">
                  		<li id="<?php echo $row[bi_FileId]; ?>" class="current-rating" style="width:<?php echo $width; ?>px;">Currently 3/5 Stars.</li>
                  		<li ><a href="#" onclick="fn_alert(1,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_MemberId]; ?>,<?php echo $count; ?>)" title="1 star out of 5" <?php if($width==0){ ?> class="one-stars" <?php } ?>>1</a></li>
                  		<li ><a href="#" onclick="fn_alert(2,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_MemberId]; ?>,<?php echo $count; ?>)" title="2 star out of 5" <?php if($width==0){ ?> class="two-stars" <?php } ?>>2</a></li>
                  		<li ><a href="#" onclick="fn_alert(3,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_MemberId]; ?>,<?php echo $count; ?>)" title="3 star out of 5" <?php if($width==0){ ?> class="three-stars" <?php } ?>>3</a></li>
                  		<li ><a href="#" onclick="fn_alert(4,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_MemberId]; ?>,<?php echo $count; ?>)" title="4 star out of 5" <?php if($width==0){ ?> class="four-stars" <?php } ?>>4</a></li>
                  		<li ><a href="#" onclick="fn_alert(5,<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_MemberId]; ?>,<?php echo $count; ?>)" title="5 star out of 5" <?php if($width==0){ ?> class="five-stars" <?php } ?>>5</a></li>
                  	</ul>
                  	<input type="hidden" name="starUser<?php echo $row[bi_FileId]; ?>" value="0" />
                  </td>
                  <td align="center" valign="bottom"><?php echo date("F j, Y",strtotime($row[dt_insertedDate])); ?></td>
                  <td align="center" valign="bottom">
                  	
<?php
			if($width == 0 ) {
?>
                  	<div class="btSend2"><a href="javascript:void(0);" onClick="return fn_addrate(<?php echo $row[bi_FileId]; ?>,<?php echo $row[bi_SellerId]; ?>,<?php echo $count; ?>);" style="float:left;"></a></div>
<?php
			}
?>
                  </td>
               </tr>
<?php
		} 
?>

                  </td>
               </tr>
             </tbody>
          </table>
        </form>
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- bopaBigBox ends -->
      
      <div class="cls"></div>
            
      <div id="pages" align="center"><?php echo $clsbpFileDetails->clsbpPaginate->getHTMLPageRangesForAjax("bpajaxFeed.php","clsbpFileDetails", "frmrating", $extraParameters,$tgName); ?></div>


<?php
	}			
}

?>

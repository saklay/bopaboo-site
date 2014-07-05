<?php 
include_once("bpFunctions.php");
include_once($includePath."bpCommon.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpPaginate.cls.php");
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
//error_reporting(E_ALL);
$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	$clsbpFileDetails->submitted = 1;
	$clsbpFileDetails->postFiles();
	$extraParameters	.= "pageSize=$clsbpFileDetails->pageSize&submitted=$clsbpFileDetails->submitted";
	$tgName = $_GET['tabName'];
	$swrd=$_GET['searchWord'];
	
	$arrfileDetails = $clsbpFileDetails->retrieveBopaBoxArray();
	$totalItems = 0;
	
	foreach($arrfileDetails as $row) {
		if($row['i_in_sell']==0) {
			$totalItems++;
		}
	}
	
	$arraySize=sizeof($arrfileDetails);
	
	if($arraySize == 0 && $tgName =="All" ){
		if(isset($_GET['searchWord'])) {
		$_SESSION["BPMESSAGE"]	="We were unable to find anything for (<strong>".stripslashes($_REQUEST[searchWord]).")</strong><br> Please try another search.";
		}
		else{
		$_SESSION["BPMESSAGE"]	= "Your bopaBox is empty! You need to upload the songs you want to sell.";
}			
	}
	if($arraySize == 0 && $tgName =="MyUploads" ){
	if(isset($_GET['searchWord'])) {
		$_SESSION["BPMESSAGE"]	="We were unable to find anything for (<strong>".stripslashes($_REQUEST[searchWord]).")</strong><br> Please try another search.";
		}
		else
	
	$_SESSION["BPMESSAGE"]	= "You need to upload more music!";	
	}
		if($arraySize == 0 && $tgName =="Sale" ){
if(isset($_GET['searchWord'])) {
		$_SESSION["BPMESSAGE"]	="We were unable to find anything for (<strong>".stripslashes($_REQUEST[searchWord]).")</strong><br> Please try another search.";
		}
		else
	
	$_SESSION["BPMESSAGE"]	= "Nothing for sale? You really like all that music you own?";	
	}
		if($arraySize == 0 && $tgName =="Purchase" ){
if(isset($_GET['searchWord'])) {
		$_SESSION["BPMESSAGE"]	="We were unable to find anything for (<strong>".stripslashes($_REQUEST[searchWord]).")</strong><br> Please try another search.";
		}
		else
	
	$_SESSION["BPMESSAGE"]	= "You haven't purchased anything! Go browse bopaboo and buy new music.";	
	}
	
	 		
?>
<script type="text/javascript" src="scripts/jqueryboxbopabox.js"></script>
<script type="text/javascript" src="scripts/thickboxbopabox.js"></script>
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />

      <div class="roundedTab" id="bopaBigBox" style="background-color:#ffffff;">
        <div class="c"> <div class="cl">
          <!--add content-->
<form id="frmFileList" name="frmFileList" method="post" action="">
	<input type="hidden" name="clsbpFileDetails_pageSize" value="<?php echo $clsbpFileDetails->pageSize; ?>">
	<input type="hidden" name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
	<input type="hidden" name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
	<input type="hidden" name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
	<input type="hidden" name="clsbpFileDetails_filelist" value="<?php echo $clsbpFileDetails->filelist; ?>"> 
	<input type="hidden" name="clsbpFileDetails_action" value=""> 
	<input type="hidden" name="clsbpFileDetails_FileIds" value=""> 
	<input type="hidden" name="clsbpFileDetails_FileId" value=""> 
	<input type="hidden" name="clsbpFileDetails_returnUrl" value=""> 
	<input type="hidden" name="clsbpFileDetails_submitted" value="1">
	<input type="hidden" name= "clsbpFileDetails_check_list" value="">
	<input type="hidden" name= "clsbpFileDetails_delete_list" value="">
	<input type="hidden" name= "tabname" value="<?php echo $tgName; ?>">
	<input type="hidden" name="tabName" id="tabName" value="<?php echo $clsbpFileDetails->tabName; ?>">
	<input type="hidden" name="clsbpFileDetails_goBack" value="<?php echo getCurrentPageURL();?>">
	<input type="hidden" name="showjmenu" value="0" />
	<input type="hidden" id="test_val" value="0" />
	
	
            <div class="clsTable"></div>
            
          <table width="980" class="tableGeneral" id="bopaBoxTable">
					<thead>
                  <tr valign="middle" class="tableHead">
                    <th width="33" valign="bottom" class="cehckboxCell" id="first"><input name="Check_ctr" type="checkbox" id="selectall" value="yes" onclick="javascript: fnSetAllCheckBoxes('frmFileList','check_list[]',this.checked)"/></th>
                    <th width="261" <?php if($clsbpFileDetails->sortColumn =='vc_artists_nm_mod' ||$clsbpFileDetails->sortColumn ==''){ if($clsbpFileDetails->sortDirection=="ASC"){echo "class='highlightCol'";}}?> ><a href="javascript:sortAjaxColumn('bpajaxBopaBox.php','vc_artists_nm_mod','clsbpFileDetails','frmFileList','<?php echo $extraParameters; ?>','<?php echo $_REQUEST[tabName]; ?>');">artist</a></th>
                    <th width="261" <?php if($clsbpFileDetails->sortColumn =='vc_title_nm_mod' ){ if($clsbpFileDetails->sortDirection=="ASC"){echo "class='highlightCol'";}}?> ><a href="javascript:sortAjaxColumn('bpajaxBopaBox.php','vc_title_nm_mod','clsbpFileDetails','frmFileList','<?php echo $extraParameters; ?>','<?php echo $_REQUEST[tabName]; ?>');">song</a></th>
                    <th width="261" <?php if($clsbpFileDetails->sortColumn =='vc_album_nm_mod' ){ if($clsbpFileDetails->sortDirection=="ASC"){echo "class='highlightCol'";}}?> ><a href="javascript:sortAjaxColumn('bpajaxBopaBox.php','vc_album_nm_mod','clsbpFileDetails','frmFileList','<?php echo $extraParameters; ?>','<?php echo $_REQUEST[tabName]; ?>');">album</a></th>
                    <th width="81" <?php if($clsbpFileDetails->sortColumn =='i_in_sell'){ if($clsbpFileDetails->sortDirection=="ASC"){echo "class='highlightCol'";}} ?> ><a href="javascript:sortAjaxColumn('bpajaxBopaBox.php','i_in_sell','clsbpFileDetails','frmFileList','<?php echo $extraParameters; ?>','<?php echo $_REQUEST[tabName]; ?>');">on sale</a></th>
                    <th width="81" class="actions fin"><a href="#">actions</a></th>
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
			//smb://192.168.1.38/bopaboo/www/bpajaxBopaBox.php
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
				
				foreach ($arrfileDetails as $row) { 
				$songstring = fnCheckLength($row['vc_title_nm_mod'],20);
				$artiststring = fnCheckLength($row['vc_artists_nm_mod'],20);
				$albumstring = fnCheckLength($row['vc_album_nm_mod'],35);

				?>
             	
                <tr valign="middle">
               	  <td align="center" valign="middle">
               	  	<?php if($row[i_in_sell] == 0) { ?>
                    		<input type="checkbox" name="check_list[]" value="<?php  echo $row[bi_file_id] ; ?>" onClick="return fnChecking();"/>
                    	<?php
                    		}
                    		else {
                    	?>
                    		<input type="checkbox" disabled="true"/>
                    	<?php
                    		}
                    		
                    	?>
               	  </td>
                  <td valign="bottom" class="indent"><?php if($row[i_in_sell] == 0) { ?><a href="javascript:fn_viewDetails(<?php echo $row[bi_file_id];?>);"><?php echo stripslashes($artiststring);?></a><?php } else { echo stripslashes($artiststring); }?></td>
                  <td valign="bottom" class="indent"><?php if($row[i_in_sell] == 0) { ?><a href="javascript:fn_viewDetails(<?php echo $row[bi_file_id];?>);"><?php echo stripslashes($songstring);?></a><?php } else { echo stripslashes($songstring); }?></td>
                  <td valign="bottom" class="indent"><?php if($row[i_in_sell] == 0) { ?><a href="javascript:fn_viewDetails(<?php echo $row[bi_file_id];?>);"><?php echo stripslashes($albumstring);?></a><?php } else { echo stripslashes($albumstring); }?></td>
                  <td align="center" valign="bottom">
<?php if($row[i_in_sell] == 1) { 
					$parameters = urlencode(getCurrentPageURL());
					?>
		<a href="bpSongStatusForSale.php?clsbpFileDetails_bi_file_id=<?php echo $row[bi_file_id];?>&height=316&width=100px&modal=true&parameters=<?php echo "bpBopaBox.php?".urlencode($_SERVER["QUERY_STRING"]);?>" class="thickbox"><img onclick="return test();" src="<?php echo IMAGEPATH ?>iconTag.png" border="0"  /></a>
					<?php } else{ 
 $parameters = urlencode(getCurrentPageURL());?>
 <a href="bpSongNotForSale.php?clsbpFileDetails_bi_file_id=<?php echo $row[bi_file_id];?>&height=316&width=100px&modal=true&parameters=<?php echo "bpBopaBox.php?".urlencode($_SERVER["QUERY_STRING"]);?>" class="thickbox"><!--<img  onclick="test();" src="<?php echo IMAGEPATH ?>iconTagged.gif"  border="0" >--></a><?php }?></td>
<td align="center">
<?php if($row[i_in_sell] == 1) { echo 
"<img src=\"".IMAGEPATH."iconInactiveSell.png\" border='0'>" ; }else{ ?>
<a  title="Post for sale" href="bpPostSale.php?clsbpFileDetails_bi_file_id=<?php echo $row[bi_file_id];?>&height=600&width=900&modal=true&parameters=<?php echo "bpBopaBox.php?".urlencode($_SERVER["QUERY_STRING"]);?>"  class="thickbox"><img onclick="test();" alt="Post for sale" title="Post for sale" src="<?php echo IMAGEPATH ?>iconSell.png" border="0" /></a><?php } ?>
<?php if($row[i_in_sell] == 1) { echo 
"<img src='".IMAGEPATH."iconInactiveDownload.png' border='0'>" ; }else{ ?>
<a title="Download" href="bpDownload.php?clsbpFileDetails_bi_file_id=<?php echo $row[bi_file_id];?>"><img alt="Download" title="Download" src="<?php echo IMAGEPATH ?>iconDownload.png" border="0" /></a><?php } ?><?php if($row[i_in_sell] == 1) { echo 
"<img src=\"".IMAGEPATH."iconInactiveDelete.png\" border='0'>" ; }else{ ?><a href="bpSongDelete.php?clsbpFileDetails_bi_file_id=<?php echo $row[bi_file_id];?>&height=316&width=100px&modal=true&parameters=<?php echo "bpBopaBox.php?".urlencode($_SERVER["QUERY_STRING"]);?>" class="edit-remove thickbox"><img onclick="test();" title="Delete" src="<?php echo IMAGEPATH ?>iconDelete.png" alt="delete" border="0" /></a></td>
<?php } ?>
               </tr>
                <?php
				$recordNumber++;
				 } ?>
                 <tr><td colspan="5" align="center" ><?php echo displayMessage(); ?><td></tr>
             </tbody>
          </table>

        </form>
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> <!-- bopaBigBox ends -->
      
    	
      
      <div class="cls"></div>
            
      <div id="pages" align="center"><?php echo $clsbpFileDetails->clsbpPaginate->getHTMLPageRangesForAjax("bpajaxBopaBox.php","clsbpFileDetails", "frmFileList", $extraParameters,$tgName); ?></div>
      
      </div> <!-- end bopasearchbox -->

<?php
ob_get_contents();

?>

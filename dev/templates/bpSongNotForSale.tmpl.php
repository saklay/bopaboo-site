<script language="javascript">
function fnPriceUpdateNot()
{

var frm = document.frmSongNot;

frm.clsbpFileDetails_action.value = "UPDATESONGSTATUS";

optSaleStatus = frm.optSaleStatus.value;

frm.action="bpBopaAction.php?clsbpFileDetails_action=UPDATESONGSTATUS&clsbpFileDetails_bi_file_id=<?php echo $_REQUEST['clsbpFileDetails_bi_file_id']; ?>&optSaleStatus="+optSaleStatus;
frm.submit();

return true;
}

</script> 
<div id="songStatusForSale">

  <form id="form1" name="frmSongNot" method="post" action="" onsubmit="return fnPriceUpdateNot();">
  <input type="hidden" id="postaction" name="clsbpFileDetails_action" value="">
   <input type="hidden" id="clsbpFileDetails_bi_file_id" name="clsbpFileDetails_bi_file_id" value="<?php echo $clsbpFileDetails->bi_file_id; ?>">
   <input type="hidden"  name="clsbpFileDetails_pageSize" value="<?php echo $clsbpFileDetails->pageSize; ?>">
   <input type="hidden"  name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
   <input type="hidden"  name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
   <input type="hidden"  name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
   <input type="hidden"  name="clsbpFileDetails_submitted" value="1">	
   <input type="hidden" name="clsbpFileDetails_returnURL" value="<?php echo $clsbpFileDetails->returnURL; ?>" />
  <div class="top">
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
								$songstring = fnCheckLength($clsbpFileDetails->vc_title_nm_mod,20);
							

					 ?>
  	<h1><?php echo stripslashes($songstring); ?></h1>
    <span><a href="#"><img src="images/btn-close1.jpg" alt="close" width="19" height="19" border="0" class="closenow" onclick="tb_remove()"; /></a></span>
   </div>
	<div class="contents">
    	<label>
            <span class="texttitle">Current Status</span>
            <select name="optSaleStatus" id="select" class="currentstatus">
             <option value="0" selected="selected">Not For Sale</option> 
         	<option value="1">For Sale</option>
 </select></label>
           <label>&nbsp;</label>
   	   <span class="commontext">
This song is currently not listed For Sale. If you would like to post the song For Sale, please select the For Sale option from above.</span></div>
<div class="bottom"><a href="#"><img src="images/btn-cancel1.jpg" alt="Cancel" width="89" height="29" border="0" onclick="tb_remove()"; /></a>
 <input type="image" src="images/btn-update.jpg" alt="update" width="97" height="29" border="0" /></div>

  </form>
</div>


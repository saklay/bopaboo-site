<script language="javascript">
function fnPriceUpdate()
{

var frm = document.frmSong;

if((frm.clsbpFileDetails_dbl_price.value < 0.25|| isNaN(frm.clsbpFileDetails_dbl_price.value)==true) && frm.optSaleStatus.value==1)

{
alert("Enter a Valid Price Greater than or equal to $0.25.");
return false;
}
frm.clsbpFileDetails_action.value = "UPDATESONG";

frm.action="bpBopaAction.php";
frm.submit();


return true;
}
function currencyFormat(fld, milSep, decSep, e) {
				var sep = 0;
				var key = '';
				var i = j = 0;
				var len = len2 = 0;
				var strCheck = '0123456789$';
				var aux = aux2 = '';
				var whichCode = (window.Event) ? e.which : e.keyCode;
				
				if (whichCode == 13) return true;  // Enter
				if (e.keyCode == 46 || e.keyCode ==37 || e.keyCode == 39 || e.keyCode == 35 ||e.keyCode == 66) return true; 
				if ((whichCode == 8)){
					return true;  // Delete (Bug fixed)
				}
				
				key = String.fromCharCode(whichCode);  // Get key value from key code
				if(document.frmSong.flagNew.value==2)
				
				{
				document.frmSong.flagNew.value=1;
				document.frmSong.clsbpFileDetails_dbl_price.value="";
				
				}
				if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
				len = fld.value.length;
				for(i = 0; i < len; i++)
					if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
				aux = '';
				for(; i < len; i++)
					if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
						aux += key;
				len = aux.length;
				if (len == 0) fld.value = '';
				if (len == 1) fld.value = '0'+ decSep + '0' + aux;
				if (len == 2) fld.value = '0'+ decSep + aux;
				if (len > 2) {
					aux2 = '';
					for (j = 0, i = len - 3; i >= 0; i--) {
						if (j == 3) {
							aux2 += milSep;
							j = 0;
						}
						aux2 += aux.charAt(i);
						j++;
					}
					fld.value = '';
					len2 = aux2.length;
					for (i = len2 - 1; i >= 0; i--)
						fld.value += aux2.charAt(i);
					fld.value += decSep + aux.substr(len - 2, len);
				}
				var val = fld.value;
				if(val.charAt(0)=='$') {val = val.substr(1); var flag=1;}
				if(val>99.99) {
					val=99.99;
				}
				if(flag==1) {
					val='$'+val;
				}
				fld.value = val;
				
				return false;
	}
	function fnSelect()
				{
			
				
				document.frmSong.flagNew.value=2;
				
				}
function fnHidePrice(thistag,tag)
{
styleObj=document.getElementById(thistag).style;

   if (tag==1)
   {
   	styleObj.display='';
	
   }
   else {
   	styleObj.display='none';
   
   }
}
</script>

<form id="form1" name="frmSong" method="post" action="" onSubmit="return fnPriceUpdate();" >
   <input type="hidden" id="postaction" name="clsbpFileDetails_action" value="">
   <input type="hidden" id="clsbpFileDetails_bi_file_id" name="clsbpFileDetails_bi_file_id" value="<?php echo $clsbpFileDetails->bi_file_id; ?>">
   <input type="hidden" name="clsbpFileDetails_pageSize" value="<?php echo $clsbpFileDetails->pageSize; ?>">
   <input type="hidden" name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
   <input type="hidden" name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
   <input type="hidden" name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
   <input type="hidden" name="clsbpFileDetails_submitted" value="1">	
   <input type="hidden" name="clsbpFileDetails_returnURL" value="<?php echo $clsbpFileDetails->returnURL; ?>" />
   <input type="hidden" name="flagNew" value="1" />
    
<div id="popContainer">
    <div class="rounded" id="songStatus">
        <div class="t">
          
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
				<div class="pad">                  

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
                    <a href="#file_<?php echo $clsbpFileDetails->bi_file_id; ?>"><img src="<?php echo IMAGEPATH ?>closePopUpSmall.png" alt="close" width="19" height="19" border="0" class="closenow" onclick="tb_remove();" /></a>
                    
                    <div class="cls"></div>
                    
                    <div class="formRow">
                        <label>Current Status</label>                            
                            <select name="optSaleStatus" id="select" class="currentstatus" onchange="return fnHidePrice('rem',this.value);">
                  						<option value="1" selected="selected">For Sale</option>
                   						<option value="0">Not For Sale</option>
														</select>
                    </div>
                    
                    <div class="formRow" id="rem" style="display:''">
                        <label>Current List Price </label>
                             <input type="text"  name="clsbpFileDetails_dbl_price" value="<?php echo stripslashes(number_format($clsbpFileDetails->dbl_price,2));?>" onKeyPress="javascript: return(currencyFormat(this,'','.',event))" onselect="return fnSelect();" class="inputBox" />
                    </div>
                    
                       <p>
                This song is currently posted For Sale. Would you like to change the price or status of the Item ? </span></p>
                <div class="bottom">
                		<a href="#file_<?php echo $clsbpFileDetails->bi_file_id; ?>"><img src="<?php echo IMAGEPATH ?>buttonCancel.gif" border=0 onclick="tb_remove();" /></a>
                    <input type="image" src="<?php echo IMAGEPATH ?>buttonUpdate.png" alt="update" style="cursor:pointer" />
                </div>
                </div>
            <!--finish content-->
          </div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->     
</div>
</form>

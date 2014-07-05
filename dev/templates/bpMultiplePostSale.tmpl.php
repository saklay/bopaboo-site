
<div id="container">	
	  
      	<div id="pageheadSell">
        	<h1>Post Songs for Sale</h1>
    	</div>
        <form id="frmSale" name="frmSale" method="post" action="">
          <div id="pagecontents">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="690">&nbsp;</td>
                    <td width="270" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table border="0" cellpadding="0" cellspacing="0" id="postforsalemultiplesongs">
                          <tr>
                            <td class="hdr">&nbsp;</td>
                          </tr>
                          <tr>
                            <td valign="top" class="content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>
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
							foreach( $arrSelectedItems as $FileID) {
								if($FileID == '') {
									header("Location: bpBopaBox.php");
									exit();
								}
 								$result = $clsbpFileDetails->retrieveFile($FileID);
 								$objArray = get_object_vars($clsbpFileDetails);
								$songstring = fnCheckLength($clsbpFileDetails->vc_SongName,15);
								$artiststring = fnCheckLength($clsbpFileDetails->vc_artists_nm_mod,15);
								$albumstring = fnCheckLength($clsbpFileDetails->vc_album_nm_mod,15);

								
						?>
						<table width="93%" border="0" cellspacing="0" cellpadding="0" class="postforsaleform">
						<tr>
						<td width="40%"><span class="small-hdg"><?php echo $songstring;?></span></td>
						<td width="60%" align="right"><span class="small-hdg"><a href="javascript: void(0);" onclick="javascript: deleteItem(<?php echo $clsbpFileDetails->bi_file_id; ?>)"><img src="images/btn-close2.png" alt="close" width="11" height="11" border="0" align="absmiddle" class="closebtn2"  /></a></span></td>
						</tr>
						<tr>
						<td><label class="lside">Title:</label><?php echo $songstring; ?></td>
						<td><label class="rside">Enter Price:</label><input type="text" name="clsbpFileDetails_txtPrice[]" id="price" class="price1" value="<?php if($clsbpFileDetails->i_in_sell == 1){echo stripslashes(number_format($clsbpFileDetails->dbl_price,2)); }  else { echo stripslashes(number_format($clsbpUserLogin->defaultPrice,2)); }?>" onKeyPress="javascript: return(currencyFormat(this,'','.',event))" onselect="return fnSelect();" /></td>
						</tr>
						<tr>
						<td><label class="lside">Artist:</label><?php echo $artiststring; ?></td>
						<td rowspan="2" valign="top"><label  class="rside">Tags:</label>
							<textarea name="clsbpFileDetails_txaTags[]" rows="2" class="tags" id="tags"><?php echo $clsbpFileDetails->vc_tags; ?></textarea>
							<input type="hidden" name="clsbpFileDetails_txtFileId[]" value="<?php echo $clsbpFileDetails->bi_file_id; ?>" />
							<input type="hidden" name="clsbpFileDetails_txtTagId[]" value="<?php echo $clsbpFileDetails->i_tg_id; ?>" />
                             <input type="hidden" name="flagNew" value="1" />
						</td>
						</tr>
						<tr>
						<td><label class="lside">Album:</label><?php echo $albumstring; ?></td>
						</tr>
						
						</table>
						<?php
							}
						?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td class="ftr">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="40" class="btnright">
			<input type="hidden" id="postaction" name="clsbpFileDetails_posted" value="">
			<input type="hidden" id="postaction" name="clsbpFileDetails_deleteId" value="">
			<input type="hidden" id="postaction" name="clsbpFileDetails_saleIds" value="">                                                                                                
                         <input type="hidden" id="postaction" name="clsbpFileDetails_action" value="">
                         <input type="image" src="images/btn-goback1.png" width="105" height="29" class="btngoback" onclick="javascript: goBack()"/>
                        &nbsp;&nbsp;&nbsp;
                        <input type="image" src="images/btn-postforsale.png" width="156" height="29" class="btnpostforsale" onclick="return fnPriceValidate();"/>                      </td>
                      </tr>
                    </table></td>
                    <td align="center" valign="top"><!-- Begin: AdBrite -->
						<script type="text/javascript">
                        var AdBrite_Title_Color = '0000FF';
                        var AdBrite_Text_Color = '000000';
                        var AdBrite_Background_Color = 'FFFFFF';
                        var AdBrite_Border_Color = 'CCCCCC';
                        var AdBrite_URL_Color = '008000';
                            </script>
						<script src="http://ads.adbrite.com/mb/text_group.php?sid=606390&zs=3136305f363030" type="text/javascript"></script>
                        <div>
                        	<a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=606390&afsid=1" style="font-weight:bold;font-family:Arial;font-size:13px;">Your Ad Here</a>                        </div>
                    <!-- End: AdBrite --></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
          </div>
      </form>
        </div>
<script  language="javascript" type="text/javascript">

function fnGo()
{

window.location="bpBopaBox.php?"+"<?php echo $clsbpFileDetails->goBack;?>";
}

function fn_saveDetails(fileId){

	var frm = document.frmDetails;
	
		if(frm.clsbpFileDetails_vc_title_nm_mod.value == "")
		{
		alert("Please enter Song Name");
		frm.clsbpFileDetails_vc_title_nm_mod.focus();
		return false;
		}
		if(frm.clsbpFileDetails_vc_artists_nm_mod.value == "")
		{
		alert("Please enter Artist Name");
		frm.clsbpFileDetails_vc_artists_nm_mod.focus();
		return false;
		}
	/*	if(frm.clsbpFileDetails_vc_album_nm_mod.value == "")
		{
		alert("Please enter Album Name");
		frm.clsbpFileDetails_vc_album_nm_mod.focus();
		return false;
		}*/
		if(frm.clsbpFileDetails_bi_GenreId.value == 0)
		{
		alert("Please select Genre");
		frm.clsbpFileDetails_bi_GenreId.focus();
		return false;
		}
		if(frm.clsbpFileDetails_vc_tags.value == "")
		{
		alert("Please enter Tags");
		frm.clsbpFileDetails_vc_tags.focus();
		return false;
		}

frm.action="bpViewDetails.php?clsbpFileDetails_bi_file_id="+fileId+"&action=UPDATEINFO&returnUrl=<?php echo "bpBopaBox.php";?>&extraparameters=<?php echo $extraParameters;?>";

	frm.submit();

}
function fnPopUp(URL) {

day = new Date();
id = day.getTime();

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=1,menubar=1,resizable=0,width=500,height=430,left = 262,top = 169');");
}
</script>
<div id="container">	
	  
      	<div id="pageheadSelling">
        	<h1><?php echo stripslashes($clsbpFileDetails->vc_title_nm_mod); ?></h1>
    	</div>
        <div class="backtosearch"><a href="bpBopaBox.php"><img src="images/arrow-back-search.png" alt="arrow search" width="18" height="18" border="0" align="top" />Back to bopaBox</a></div>
        <form id="frmDetails"  name="frmDetails" method="post" action="">
          <input type="hidden"  name="clsbpFileDetails_pageSize" value="<?php echo $clsbpFileDetails->pageSize; ?>">
          <input type="hidden"  name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
          <input type="hidden"  name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
          <input type="hidden"  name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
 		<input type="hidden" name="clsbpFileDetails_returnURL" value="" />
         <input type="hidden"  name="clsbpFileDetails_goBack" value="<?php echo $clsbpFileDetails->goBack;?>">
         <input type="hidden" name= "clsbpFileDetails_filelist" value="<?php echo $clsbpFileDetails->filelist; ?>">
          <div id="pagecontents">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="view-page">
              <tr>
                <td width="312" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="albumdetails">
                    <tr>
                      <td><img src="images/albumcover.jpg" alt="Album Cover" width="250" height="250" /></td>
                  </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align=left><table border="0" cellspacing="0" cellpadding="0" width="100%">
		      	<tr><td width="100" align="left">Date Uploaded:</td><td><?php  $darray = explode(" ",$clsbpFileDetails->dt_FileUploaded);  
					  echo date("m/d/Y",strtotime($darray[0])); ?></td></tr>
                        <tr><td align="left">Format:</td><td>MP3</td></tr>
                        <tr><td align="left">Size:</td><td><?php echo number_format((($clsbpFileDetails->vc_FileSize)/(1024*1024)),2); ?> MB</td></tr>
                        <tr><td align="left">Bit Rate:</td><td><?php echo round($clsbpFileDetails->f_bitrate); ?>K</td></tr></table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="30"><a title="Post for sale"  href="bpPostSale.php?clsbpFileDetails_bi_file_id=<?php echo $clsbpFileDetails->bi_file_id;?>&clsbpFileDetails_returnURL=bpBopaBox.php?tabName=<?php echo $_REQUEST["tabName"];?>&height=600&width=900&modal=true"  class="thickbox"><img title="Post for sale" alt="Post for sale" src="images/icon-sell.png"  width="21" height="21" border="0" /></a><a title="Download" href="bpDownload.php?clsbpFileDetails_bi_file_id=<?php echo $clsbpFileDetails->bi_file_id;?>"><img src="images/icon-download.png" alt="Sell" width="21" height="21" border="0" /></a><a href="bpSongDelete.php?clsbpFileDetails_bi_file_id=<?php echo $clsbpFileDetails->bi_file_id;?>&parameters=bpBopaBox.php?tabName=<?php echo $_REQUEST["tabName"];?>&height=400&width=750&modal=true" class="edit-remove thickbox"><img src="images/icon-delete.png" alt="Sell" width="21" height="21" border="0" /></a></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><a href="#">Update Album Art</a></td>
                    </tr>
                </table></td>
                <td width="389" valign="top" class="viewpageform">
                <div align="left" style="padding-left:85px;"><?php echo displayMessage();?></div>
	                <label for="name">Name</label><input type="text" name="clsbpFileDetails_vc_title_nm_mod" id="name" class="inputstyle" value="<?php echo stripslashes($clsbpFileDetails->vc_title_nm_mod); ?>"/>
                    <label for="artist">Artist</label><input type="text" name="clsbpFileDetails_vc_artists_nm_mod" id="artist" class="inputstyle" value="<?php echo stripslashes($clsbpFileDetails->vc_artists_nm_mod); ?>"/>
                    <label for="album">Album</label><input type="text" name="clsbpFileDetails_vc_album_nm_mod" id="album" class="inputstyle" value="<?php echo stripslashes($clsbpFileDetails->vc_album_nm_mod); ?>"/>
                <label for="Genre">Genre</label>
                <select name="clsbpFileDetails_bi_GenreId" id="Genre" class="inputstyle">
                <option value='0'>Select</option>
                  <?php echo $GenreListControl; ?>
                </select>
                <label for="Tags">Tags</label><input type="text" name="clsbpFileDetails_vc_tags" id="tags" class="inputstyle" value="<?php echo stripslashes($clsbpFileDetails->vc_tags); ?>"/>
                <label for="desc">Description</label>
                
                <textarea name="clsbpFileDetails_lt_Comment" id="desc" cols="45" rows="5" class="textareastyle"><?php echo stripslashes($clsbpFileDetails->lt_Comment); ?></textarea><input type="hidden" name="clsbpFileDetails_i_tg_id" value="<?php echo  $clsbpFileDetails->i_tg_id;?>" />
                <br /> 
	<!-- <a href="bpBopaBox.php">	--><img src="images/btn-goback.png"  style="cursor:pointer"   name="goback"   id="savechanges"  value="goback"     alt="Cancel Changes" width="130" height="29" border="0" class="viewpagebtns" onclick="fnGo();"/><!--</a>-->
              <input  name="savechanges"   type="image" value="savechanges"  id="goback"   src="images/btn-savechanges.png"  onclick="return fn_saveDetails(<?php echo stripslashes($clsbpFileDetails->bi_file_id); ?>);"  alt="Save Changes"  width="130" height="29" border="0" class="viewpagebtns1" />
                </td>
                <td width="217" align="center" valign="top">
                    <!-- Begin: AdBrite -->
						<script type="text/javascript">
                        var AdBrite_Title_Color = '0000FF';
                        var AdBrite_Text_Color = '000000';
                        var AdBrite_Background_Color = 'FFFFFF';
                        var AdBrite_Border_Color = 'CCCCCC';
                        var AdBrite_URL_Color = '008000';
                            </script>
						<script src="http://ads.adbrite.com/mb/text_group.php?sid=606390&zs=3136305f363030" type="text/javascript"></script>
                        <div>
                        	<a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=606390&afsid=1" style="font-weight:bold;font-family:Arial;font-size:13px;">Your Ad Here</a>
                        </div>
                    <!-- End: AdBrite -->
                
                </td>
              </tr>
            </table>
          </div>
                </form>
        </div>
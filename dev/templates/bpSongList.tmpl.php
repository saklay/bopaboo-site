<SCRIPT  type="text/javascript" language="javascript">
<!--

<!-- Begin
function fnSetAllCheckBoxes(FormName, FieldName, CheckValue)
{
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

function fn_cart(fileId)
{
var frm = document.frm_songlist;
frm.clsbpBopaCart_FileId.value=fileId;
frm.clsbpBopaCart_action.value="ADDTOCART";
frm.action="bpBopaCart.php?fileId="+fileId+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php";  ?>";
frm.submit();

}
function fn_addcart()
{
var frmcart = document.frm_songlist;
fileIds		= getCheckedItem(frmcart,"addtoCart[]");
alert(fileIds);
frmcart.clsbpBopaCart_action.value="ADDTOCART";
frmcart.action="bpBopaCart.php?fileIds="+fileIds+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php"; ?>";
frmcart.submit();
}

</script>
<div id="container">	
      
        <ul id="breadcrumb-links">
          <li><a href="index.php">Home</a></li>
          <li><img src="images/arrow-breadcrumb.gif" alt="breadcrumb" />&nbsp;&nbsp;bopaBox</li>
        </ul>
        
        <div id="uploadmusic">
            <a href='javascript:void(0);' onClick='javascript:window.open("upload.php","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,screenX=150,screenY=150,top=150,left=150,height=650,width=880");'><img src="images/icon-uploadmusic.png" alt="Upload Music" width="165" height="52" border="0" /></a>
        </div>
        
        <div id="pagehead">
        	<h1>Song List</h1>
        </div>
                
		<div id="bopabox_topnav">

            <ul class="bopabox_menu">
              <li><a href="#"  class="currentsel">All</a></li>
              <li><a href="#" class="myuploads">My Uploads</a></li>
              <li><a href="#" class="items_on_sale">Items on Sale</a></li>
              <li><a href="#" class="my_purchase">My Purchase</a></li>
            </ul>
            <form id="" name="" method="post" action="">
              <input name="textfield" type="text" id="textfield" value="Search your bopaBox" onclick="clstext();" />
            </form>
        </div>
        <div id="tracklistings-header"></div>
        <div id="tracklistings-container">
    
       	  <form id="frm_songlist" name="frm_songlist" method="post" action="">
                 <input type="hidden"  name="clsbpFileDetails_searchSize" value="<?php echo $clsbpFileDetails->searchSize; ?>">
          <input type="hidden"  name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
          <input type="hidden"  name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
          <input type="hidden"  name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
          <input type="hidden"  name="clsbpBopaCart_action" value=""> 
          <input type="hidden"  name="clsbpBopaCart_FileIds" value=""> 
          <input type="hidden" name="clsbpBopaCart_FileId" id="clsbpBopaCart_FileId" value=""> 
          <input type="hidden" name="clsbpBopaCart_returnUrl" value=""> 
          <input type="hidden"  name="clsbpFileDetails_submitted" value="1">
          
            <div id="toplistbox"><span class="leftside"><input name="Check_ctr" type="checkbox" id="selectall" value="yes"
onclick="javascript: fnSetAllCheckBoxes('frm_songlist', 'addtoCart[]', this.checked)"/>&nbsp;&nbsp;<input type="submit" name="Addtocart" value="Add to cart" onclick="return fn_addcart();"  /><label for="selectall">Select All</label>
                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clsbpFileDetails->clsbpPaginate->writePageStatus(count($arrfileDetails));?></span> <span class="rightside"><a href="#"><img src="images/icon-sell.png" alt="buy" width="21" height="21" border="0" /></a>&nbsp;<a href="#"><img src="images/icon-delete.png" alt="delete" width="21" height="21" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> </div> <div id="cls"></div>
              <table width="900" align="center" cellpadding="0" cellspacing="0" id="Playlist">
                <thead>
                <tr id="PlaylisHeading">
                  <th width="35" class="selectBox"><img src="images/bg-selctbox.jpg" alt="selectbox" width="35" height="30" align="left" /></th>
                  <th width="247"><a href="#" class="currentsel">Artists</a></th>
                  <th width="208"><a href="#" class="artists">Albums</a></th>
                  <th width="152"><a href="#" class="songs " >Songs</a></th>
                  <th width="99"><a href="#" class="format">Format</a></th>
                  <th width="51"><a href="#" class="status">Status</a></th>
                  <th width="108"><a href="#" class="actions">Actions</a></th>
                </tr></thead>
                <tbody>
                <?php 
				
				$recordNumber	= $clsbpFileDetails->clsbpPaginate->recordNumberOffset;
				
				foreach ($arrfileDetails as $row) { ?> 
				
                  <tr>
                    <td align="center" class="songListings"> <input type="checkbox" name="addtoCart[]" value="<?php echo $row[bi_FileID];?>" <?php if(!in_array($row[bi_FileID],$_SESSION['bopaBasket']['song']) ){ } else { ?>  disabled="disabled" readonly="readonly"<?php } ?> /></td>
                    <td class="songListings"><?php  echo stripslashes($row[vc_ArtistName]);?></td>
                    <td class="songListings"><?php echo stripslashes($row[vc_AlbumName]);?></td>
                    <td align="center" class="songListings"><?php echo stripslashes($row[vc_SongName]);?></td>
                    <td align="center" class="songListings"><a href="#"><img src="images/icon-mp3.png" alt="mp3 file" width="52" height="28" border="0" /></a></td>
                    <td align="center" class="songListings"><a href="#"></a></td>
                    <td align="center" class="songListings"><?php if(!in_array($row[bi_FileID],$_SESSION['bopaBasket']['song']) ){?><a href='javascript:void(0);' onclick="return fn_cart(<?php echo $row[bi_FileID]; ?>);">Buy Now</a><?php } else { echo "Already In Cart";}?></td>
                  </tr>
                <?php
				$recordNumber++;
				 } ?>
                 <tr><td colspan="6" align="center" ><?php echo displayMessage(); ?><td></tr>
                </tbody>
            </table>
              
            <div id="pages" align="center"> <?php
			
				echo $clsbpFileDetails->clsbpPaginate->writeHTMLPageRanges("clsbpFileDetails", "frmFileList", $extraParameters);
			
			?></div>
              <div id="tracklistings-footer"></div>
      	  </form>
        </div>
      </div>
      
      
      <div id="cls"></div>
<div id="ad"> 
     
                
                	<img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#CCCCCC;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" />
                 
              </span>
        <!-- End: AdBrite -->

      </div>
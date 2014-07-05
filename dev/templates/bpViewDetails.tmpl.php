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


<?php

//did we post?
if ($_POST['submitted'] == '1') {
	$bInsert = false;		//assume an update query
	$iBopaBoxId = $clsbpFileDetails->bi_file_id;
	
	$bInsert = $clsAlbumArt->bopaBoxMissingArt($iBopaBoxId);
	
	//Now let's build the query
	if ($_POST['dataSRC'] == 'db') {

		$clsAlbumArt->updateBopaBoxAlbumArt($iBopaBoxId, $_POST['albumDataID'], $bInsert);
	
	}	
	else {
		//the album data/art are not in the database so we need to set it all up here...
		//with updates from the web...
		
		//First thing first... W need to make sure that we actually FOUND the album information on the web
		//If we did, we will proceed with updates on our database.  Otherwise we do nothing.
		if ($_POST['albumName'] != '' ) {
			//1. Check to see if the copyright owner (recording label) is already in our lkup database.  If not add it.
			$iLabelID = $clsAlbumArt->updateCopyOwner($_POST['labelName']);
			
			//2. Grab the album art from web and save both the original and the small size to our local media servers
			//Now we need to move the file from the Web to this webserver
			list($sNewFileNameL, $sNewFileNameS) = $clsAlbumArt->copyWebFile($_POST['imagePath']);
			
			//3. Now we need to update our DB with the location of the new file as well as the album data from the web
			$iAlbumDataID = $clsAlbumArt->updateAlbumDB($_POST['artistName'], $_POST['albumName'], $_POST['releaseDate'], $iLabelID, $sNewFileNameL, $sNewFileNameS);
			
			//4. Now we link the newly created album information to this bopaBox entry
			$clsAlbumArt->updateBopaBoxAlbumArt($iBopaBoxId, $iAlbumDataID, $bInsert);
			
			//5. Next, since we updated this data from the web, we need to update the bopaBox with the new information (artist, album name)
			$sSQL = "UPDATE tbl_id3_tags SET vc_artists_nm_mod = '".$_POST['artistName']."', vc_album_nm_mod='".$_POST['albumName']."' WHERE i_tg_id = (SELECT i_tg_id FROM tbl_bopabox WHERE bi_file_id=".$iBopaBoxId.")";
			
			$dbConnect = new dbConnect();
			$dbQry = mysql_query($sSQL);
			
			//6. And Finally, UPDATE THE CLASS
			$clsbpFileDetails->vc_artists_nm_mod = $_POST['artistName'];
			$clsbpFileDetails->vc_album_nm_mod = $_POST['albumName'];
		}
	}
}

?>

<form id="frmDetails"  name="frmDetails" method="post" action="">
	<input type="hidden"  name="clsbpFileDetails_pageSize" value="<?php echo $clsbpFileDetails->pageSize; ?>">
	<input type="hidden"  name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
	<input type="hidden"  name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
	<input type="hidden"  name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
	<input type="hidden" name="clsbpFileDetails_returnURL" value="" />
	<input type="hidden"  name="clsbpFileDetails_goBack" value="<?php echo $clsbpFileDetails->goBack;?>">
	<input type="hidden" name= "clsbpFileDetails_filelist" value="<?php echo $clsbpFileDetails->filelist; ?>">
          
  <div id="container">
  
      <div class="rounded" id="viewDetailsPage">
      <div class="t">
        <div class="tr"></div>
      </div>
      <div class="c"> <div class="cl">
        <!--add content-->
		<div id="viewDetailsLS">
            	<h1><?php echo stripslashes($clsbpFileDetails->vc_title_nm_mod); ?></h1>
                <div class="albumArt"><img src="<?php echo $clsAlbumArt->getAlbumArt($clsbpFileDetails->bi_file_id, "L"); ?>" alt="<?php echo stripslashes($clsbpFileDetails->vc_album_nm_mod); ?>" /></div>
                <div style="clear:both;"></div>
                <div>
                	<span class="actions"><a title="post for sale" href="bpPostSale.php?clsbpFileDetails_bi_file_id=<?php echo $clsbpFileDetails->bi_file_id;?>&clsbpFileDetails_returnURL=bpBopaBox.php?tabName=<?php echo $_REQUEST["tabName"];?>&height=600&width=900&modal=true" class="thickbox"><img src="<?php echo IMAGEPATH ?>iconSell.png" width="18" height="18"  /></a> <em><a title="download" href="bpDownload.php?clsbpFileDetails_bi_file_id=<?php echo $clsbpFileDetails->bi_file_id;?>"><img src="<?php echo IMAGEPATH ?>iconDownload.png"  /></a> <a title="delete" href="bpSongDelete.php?clsbpFileDetails_bi_file_id=<?php echo $clsbpFileDetails->bi_file_id;?>&parameters=bpBopaBox.php?tabName=<?php echo $_REQUEST["tabName"];?>&height=400&width=750&modal=true" class="edit-remove thickbox"><img src="<?php echo IMAGEPATH ?>iconDelete.png"  /></a></em></span>
                </div>
                <div style="clear:both;"></div>
                <div>
                	<p>date uploaded: <?php  $darray = explode(" ",$clsbpFileDetails->dt_FileUploaded);  echo date("m/d/Y",strtotime($darray[0])); ?></p>
                	<p>format: mp3</p>
                	<p>size: <?php echo number_format((($clsbpFileDetails->vc_FileSize)/(1024*1024)),2); ?>mb</p>
                	<p>bit rate: <?php echo round($clsbpFileDetails->f_bitrate); ?>K</p>            	
                	<p><a href="bpUpdateAlbumArt.php?id=<?php echo $clsbpFileDetails->bi_file_id;?>&clsbpFileDetails_returnURL=bpViewDetails.php?clsbpFileDetails_bi_file_id=<?php echo $clsbpFileDetails->bi_file_id;?>&clsbpFileDetails_returnURL=bpBopaBox.php?tabName=<?php echo $_REQUEST["tabName"];?>&artist=<?php echo rawurlencode(stripslashes($clsbpFileDetails->vc_artists_nm_mod)); ?>&album=<?php echo rawurlencode(stripslashes($clsbpFileDetails->vc_album_nm_mod)); ?>&height=600&width=900&modal=true" class="thickbox">upload album art</a></p>
              	</div>
        </div>
            <div id="viewDetailsRS">
            	<form class="viewDetails">
                	<div class="formRow">
                        <label>song</label>
                        <input type="text" name="clsbpFileDetails_vc_title_nm_mod" id="name" class="inputStyle" value="<?php echo stripslashes($clsbpFileDetails->vc_title_nm_mod); ?>"/></div>
                    <div class="formRow">
                        <label>artist</label>
                        <input type="text" name="clsbpFileDetails_vc_artists_nm_mod" id="artist" class="inputStyle" value="<?php echo stripslashes($clsbpFileDetails->vc_artists_nm_mod); ?>"/></div>
                    <div class="formRow">
                        <label>album</label>
                        <input type="text" name="clsbpFileDetails_vc_album_nm_mod" id="album" class="inputStyle" value="<?php echo stripslashes($clsbpFileDetails->vc_album_nm_mod); ?>"/></div>
                        <div class="formRow">
                        <label>genre</label>
                        <select name="clsbpFileDetails_bi_GenreId" id="Genre" class="inputstyle">
                					<option value='0'>Select</option>
                  				<?php echo $GenreListControl; ?>
                				</select></div>
                    <div class="formRow">
                        <label>tags</label>
                        <input type="text" name="clsbpFileDetails_vc_tags" id="tags" class="inputStyle" value="<?php echo stripslashes($clsbpFileDetails->vc_tags); ?>"/></div>
                    <div class="formRow">
                        <label>description</label>
                        <textarea name="clsbpFileDetails_lt_Comment" id="desc" cols="45" rows="5" class="textareastyle"><?php echo stripslashes($clsbpFileDetails->lt_Comment); ?></textarea><input type="hidden" name="clsbpFileDetails_i_tg_id" value="<?php echo  $clsbpFileDetails->i_tg_id;?>" /></div>
                    <div class="buttonRow"><input type="image" src="<?php echo IMAGEPATH ?>buttonCancel.gif" class="cancel"/><input type="image" src="<?php echo IMAGEPATH ?>buttonSaveChanges.gif" /></div>
                </form>
            </div>         
        </div>
        <!--finish content-->
      </div>
      <div class="b"><span class="br"></span></div>
    </div>
      
      <div class="cls"></div>
            
      </div>
</form>

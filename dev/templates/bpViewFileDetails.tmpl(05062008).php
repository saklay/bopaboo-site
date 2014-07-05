<?php
	
	if(strstr($clsbpFileDetails->goBack,"bpAdvSearchResult.php")) {
		$clsbpFileDetails->goBack = "bpAdvSearchResult.php";
	}
	else{
		$clsbpFileDetails->goBack = "bpSearch.php";
	}
	

	

	
?>

<script  language="javascript" type="text/javascript">

var xmlHttp;

function fnPopUp(URL) {

day = new Date();
id = day.getTime();

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=1,menubar=1,resizable=0,width=500,height=430,left = 262,top = 169');");
}

function fn_cart(fileId)
{

var frm = document.form2;

frm.action="bpBopaCart.php?fileId="+fileId+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php";  ?>";
frm.submit();

}
// function fn_Add(sellername,checkSellers)
// {
// 
// 	var frm = document.form2;
// 
// 	var addtofav= confirm("Do you really want to Add "+sellername+" to Favorites");
// 	if(checkSellers==1)
// 
// 	{
// 		addtofav = false;
// 		
// 		alert("Seller already added");
// 
// 
// 	}
// 	if(addtofav == true)
// 	{
// 		var frm = document.form2;
// 
// 		frm.clsbpFileDetails_action.value="ADDTOFAV";
// 
// 		frm.submit();
// 
// 	}
// 
// }

function submitBack() {
	var frm = document.form2;
	frm.clsbpBopaCart_action.value="ADDTOCART";
	frm.action="<?php echo $clsbpFileDetails->goBack;?>";
	frm.submit();
}
		
		
function fn_Add(str) { 
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null) {
		alert ("Your browser does not support AJAX!");
		return;
	} 
	var url="bpAddFavSeller.php";
	url=url+"?sellerId="+str;
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}		
function stateChanged() { 
	if (xmlHttp.readyState==4){ 
		//alert(document.getElementById("tablebody").innerHTML);
		/*document.getElementById("tablebody").innerHTML=*/
		if(xmlHttp.responseText==1){
			
			 document.form2.submit();
		}
		else if(xmlHttp.responseText==0){
			
			/*document.getElementById('sellerNew').innerHTML = '<img src="images/dis-add-a-cart-ico.png" alt="Add Seller to Favorites" width="27" height="26" border="0" align="absmiddle" /><a href="javascript:void(0);"   class="itemfooterlinks">One of My Saved Sellers</a>' ;
		*/
		alert('<?php echo $clsbpFileDetails->memberDisplayName ?>'+" is already there in  your favourite seller list.")		
  
		}
		else {
			alert("You are not logged in!!!");
			
		
		}
	}
}
function GetXmlHttpObject() {
	var xmlHttp=null;
	try{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		// Internet Explorer
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
</script>
<div id="container">	
	  
      	<div id="pageheadSelling">
        	<h1><?php echo stripslashes($clsbpFileDetails->vc_SongName); ?></h1>
    	</div>
        <div class="backtosearch"><a href="javascript: void(0);" onclick="javascript: submitBack();"><img src="images/arrow-back-search.png" alt="arrow search" width="18" height="18" border="0" align="top" />Back to Search Results</a></div>
        <form id="form2" name="form2" method="post" action="">
       
         <input type="hidden"  name="clsbpFileDetails_searchSize" value="<?php echo $clsbpFileDetails->searchSize; ?>">
	<input type="hidden"  name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
	<input type="hidden"  name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
	<input type="hidden"  name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
        <input type="hidden"  name="clsbpFileDetails_txtSearch" value="<?php echo $clsbpFileDetails->txtSearch; ?>">
        <input type="hidden"  name="clsbpFileDetails_lstSeachCat" value="<?php echo $clsbpFileDetails->searchCat; ?>">
        <input type="hidden"  name="clsbpFileDetails_optSearchType" value="<?php echo $clsbpFileDetails->searchType; ?>">
        <input type="hidden"  name="clsbpFileDetails_lstGenre" value="<?php echo $clsbpFileDetails->searchGenre; ?>">
        <input type="hidden"  name="clsbpFileDetails_txtMin" value="<?php echo $clsbpFileDetails->searchMinAmount; ?>">
        <input type="hidden"  name="clsbpFileDetails_txtMax" value="<?php echo $clsbpFileDetails->searchMaxAmount; ?>">
        <input type="hidden"  name="clsbpFileDetails_optSeller" value="<?php echo $clsbpFileDetails->searchIfSeller; ?>">
        <input type="hidden"  name="clsbpFileDetails_lstAct" value="<?php echo $clsbpFileDetails->searchAction; ?>">
        <input type="hidden"  name="clsbpFileDetails_txtSeller" value="<?php echo $clsbpFileDetails->searchSeller; ?>">
        <input type="hidden"  name="clsbpFileDetails_goBack" value="<?php echo $clsbpFileDetails->goBack;?>">
        <input type="hidden"  name="clsbpFileDetails_artist" value="<?php echo $clsbpFileDetails->vc_artists_nm_mod;?>">
        <input type="hidden"  name="clsbpFileDetails_album" value="<?php echo $clsbpFileDetails->vc_album_nm_mod;?>">
        
        <input type="hidden"  name="clsbpBopaCart_action" value=""> 
        <input type="hidden" name="clsbpFileDetails_vc_tags" value="<?php echo $clsbpFileDetails->vc_tags; ?>"> 
	<input type="hidden" name="clsbpFileDetails_txtSearch" value="<?php echo $clsbpFileDetails->txtSearch; ?>"> 
	<input type="hidden" name="clsbpFileDetails_seachCat" value="<?php echo $clsbpFileDetails->seachCat; ?>"> 
	<input type="hidden" name="clsbpFileDetails_bi_GenreId" value="<?php echo $clsbpFileDetails->bi_GenreId; ?>"> 
	<input type="hidden" name="clsbpFileDetails_SearchGenreId" value="<?php echo $clsbpFileDetails->SearchGenreId; ?>"> 
	<input type="hidden" name="clsbpFileDetails_SearchGenreName" value="<?php echo $clsbpFileDetails->SearchGenreName; ?>"> 
	<input type="hidden" name="clsbpFileDetails_Search_tags" value="<?php echo $clsbpFileDetails->Searchtags; ?>">
	<input type="hidden" name="clsbpFileDetails_bi_SellerId" value="<?php echo $clsbpFileDetails->sellerId; ?>">
    <input type="hidden" name="clsbpFileDetails_action" value="">
    <input type="hidden" name="clsbpFileDetails_bi_file_id" value="<?php echo $clsbpFileDetails->bi_file_id;  ?>">
        <div id="pagecontents">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="item-page">
				<tr>
					<td width="307" valign="top">
                    	<table width="250" border="0" cellpadding="0" cellspacing="0" class="albumcover">
                        	<tr>
                            	<td><img src="images/albumcover.jpg" alt="Album Cover" width="250" height="250" /></td>
                             </tr>
                         </table>
                    </td>
					<td width="302" valign="top">
						<table height="100%" width="100%" border="0" cellspacing="0" cellpadding="0" class="albumdetails">
							<tr>
								<td height="30%">
                                
                                	<h2><?php 
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
							$songname = fnCheckLength($clsbpFileDetails->vc_SongName,25); 		
									echo stripslashes($songname); ?></h2>
                                    by <a href="bpSearch.php?clsbpFileDetails_artist=<?php echo stripslashes($clsbpFileDetails->vc_artists_nm_mod); ?>" class="artistname"><?php echo stripslashes($clsbpFileDetails->vc_artists_nm_mod); ?></a>
                                    <br />album <a href="bpSearch.php?clsbpFileDetails_album=<?php echo stripslashes($clsbpFileDetails->vc_album_nm_mod); ?>" class="albumname"><?php echo stripslashes($clsbpFileDetails->vc_album_nm_mod); ?></a>
                                 </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="190px">
                                	<span class="title">File Size</span>: <?php echo number_format((($clsbpFileDetails->vc_FileSize)/(1024*1024)),2); ?> MB
                                    <br />
                                    <span class="title">Format: </span>MP3<br />
                                    <span class="title">Bit Rate: </span><?php echo round($clsbpFileDetails->f_bitrate) ?>K <br />
                                    <span class="title">Time: </span><?php echo stripslashes($clsbpFileDetails->f_track_length); ?><br />
                                    <span class="title">Price: </span>$<?php echo stripslashes($clsbpFileDetails->dbl_price); ?><br />
                                    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="30" height="30">
                                    <param name="movie" value="preview.swf">
                                    <param name="wmode" value="transparent">
                                    <param name="quality" value="high">
                                    <param name="FlashVars" value="filename=temp/<?php echo stripslashes($clsbpFileDetails->vc_FileName); ?>" />
                                    <param name="allowScriptAccess" value="sameDomain" />
                                    <embed src="preview.swf" quality="high" allowScriptAccess="sameDomain" FlashVars="filename=temp/<?php echo stripslashes($clsbpFileDetails->vc_FileName); ?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="30" height="30"></embed>
									</object>
                                    <br/>
									<?php if(!in_array($clsbpFileDetails->bi_file_id,$_SESSION['bopaBasket']['song']) ){?>
<a href="javascript: void(0);" onclick="return fn_cart(<?php echo $clsbpFileDetails->bi_file_id; ?>);"><img src="images/btn-addtocart.jpg" alt="add to cart" width="109" height="22" border="0"/></a>
								<?php }else {?>
                                
                                
                                <a href="javascript: void(0);" onclick="return fn_cart(<?php echo $clsbpFileDetails->bi_file_id; ?>);"><img src="images/btn-addtocart.jpg" alt="add to cart" width="109" height="22" border="0"/></a> <?php
}
?>							</td>
						</tr> 
                     </table>
                 </td>
<td width="355" align="left" valign="top">
<!-- Begin BidVertiser code -->
<SCRIPT LANGUAGE="JavaScript1.1" SRC="http://bdv.bidvertiser.com/BidVertiser.dbm?pid=122686&bid=295224" type="text/javascript"></SCRIPT>
<noscript><a href="http://www.bidvertiser.com">internet marketing</a></noscript>
<!-- End BidVertiser code -->

</td>
</tr>
</table>

</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="863" border="0" cellpadding="0" cellspacing="0" class="item-page-footer">
                  <tr>
                    <td width="863" class="hdr">Seller Information </td>
                  </tr>
                  <tr>
                    <td class="contentbody"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="288" height="45" align="center">Seller: <span class="seller"><?php echo $clsbpFileDetails->memberDisplayName ?></span></td>
                        <td width="287" align="center">
                        <!-- Rating section start here-->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr align="center">
                            <td width="29%" align="right" valign="middle">Rating:</td>
                            <td width="7%" align="left" valign="middle"><img src="images/rate_<?php echo $rating; ?>star.png" alt="Edit" width="96" height="20"  border="0" align="absmiddle" /></td>
                            <td width="64%" align="left" valign="middle"><!--<a href="#" class="itemfooterlinks-lt">-->(<?php echo $clsbpRatings->totalReviews;?>)<!--</a>--></td>
                          </tr>
                        </table>
                        <!-- Rating section ends here-->
                         </td>
                        <td width="288" align="center">Member Since: <?php  $date = explode(" ",$clsbpFileDetails->memberRegDate); echo date ("m/j/Y",strtotime($date[0]));?></td>
                      </tr>
                      <tr>
                        <td height="45" align="center"><a href="#"><img src="images/icon-suitcase.jpg" alt="View Member Store" width="29" height="35" border="0" align="absmiddle" /></a><a href="<?php  echo constant("URL").$clsbpFileDetails->memberDisplayName; ?>"  class="itemfooterlinks">View Member Store</a></td>
                        <td align="center">
                       <?php  if($_SESSION['USERID'] !="")
					 {
					 
                        ?>
                        <a href="bpMyBopaMessageCompose.php?clsbpMessages_newToId=<?php echo $clsbpFileDetails->bi_sellerId; ?>"><img src="images/icon-mail.jpg" alt="Contact" width="31" height="24" border="0" align="absmiddle" /></a><a href="bpMyBopaMessageCompose.php?clsbpMessages_newToId=<?php echo $clsbpFileDetails->bi_sellerId; ?>"  class="itemfooterlinks">Contact</a>
                        
                <?php } else { 
			?>
         <a href="bpSignIn.php?height=316&width=100px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPageURL(); echo $currentpageurl;   ?>">   <img src="images/icon-mail.jpg" alt="Contact" width="31" height="24" border="0" align="absmiddle" /></a>
                    
                <a href="bpSignIn.php?height=316&width=100px&modal=true&return=<?php $currentpageurl=getCurrentPage(); echo $currentpageurl;  ?>" class="thickbox itemfooterlinks"> Contact      </a>
                <?php } ?> 
                        </td>
                        <td align="center" id="sellerNew">
                     <?php  
					
					 if($_SESSION['USERID'] !="" && $_SESSION['USERID'] !=$clsbpFileDetails->bi_sellerId)
					 {
					 
					  if($numOfFavSellors == 0)
                        {?>
				<a href='javascript:void(0);' onclick="return fn_Add(<?php echo $clsbpFileDetails->bi_sellerId;?>);">
					<img src="images/icon-add.png" alt="Add Seller to Favorites" width="27" height="26" border="0" align="absmiddle" /></a>
			
			<a href='javascript:void(0);' onclick="return fn_Add(<?php echo $clsbpFileDetails->bi_sellerId;?>);"  class="itemfooterlinks">Add Seller to Favorites</a>
            <?php    }else{?>
            <img src="images/dis-add-a-cart-ico.png" alt="Add Seller to Favorites" width="27" height="26" border="0" align="absmiddle" /><a href="javascript:void(0);"   class="itemfooterlinks">One of My Saved Sellers</a>
            
           <?php }} ?>
       
			
           <?php
		   if($_SESSION['USERID']=="")
		   {?>
           
				  <a href="bpSignIn.php?height=316&width=100px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo $currentpageurl;    ?>" class="thickbox itemfooterlinks"><img src="images/icon-add.png" alt="Add Seller to Favorites" width="27" height="26" border="0" align="absmiddle"  />	</a>
			
		   <a href="bpSignIn.php?height=316&width=100px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo $currentpageurl;   ?>" class="thickbox itemfooterlinks">Add Seller to Favorites</a>
		  <?php } ?>
                        </td>
                      </tr>
                    </table></td>
                  </tr>
                  
                  <tr>
                    <td class="footer">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </div>
      </form>
        </div>
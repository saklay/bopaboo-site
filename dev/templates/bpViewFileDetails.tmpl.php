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
	Eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=1,menubar=1,resizable=0,width=500,height=430,left = 262,top = 169');");
}

function fn_cart(fileId) {

	var frm = document.form2;
	frm.action="bpBopaCart.php?fileId="+fileId+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php";  ?>";
	frm.submit();

}

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
		if(xmlHttp.responseText==1){			
			 document.form2.submit();
		} else if(xmlHttp.responseText==0) {
			alert('<?php echo $clsbpFileDetails->memberDisplayName ?>'+" is already there in  your favourite seller list.");
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
	
	<form id="form2" name="form2" method="post" action="">
		<input type="hidden"  name="clsbpFileDetails_searchSize" value="<?php echo $tempObject->searchSize; ?>">
		<input type="hidden"  name="clsbpFileDetails_pageIndex" value="<?php echo $tempObject->pageIndex; ?>">
		<input type="hidden"  name="clsbpFileDetails_sortColumn" value="<?php echo $tempObject->sortColumn; ?>"> 
		<input type="hidden"  name="clsbpFileDetails_sortDirection" value="<?php echo $tempObject->sortDirection; ?>"> 
		<input type="hidden"  name="clsbpFileDetails_txtSearch" value="<?php echo $tempObject->txtSearch; ?>">
		<input type="hidden"  name="clsbpFileDetails_lstSeachCat" value="<?php echo $tempObject->searchCat; ?>">
		<input type="hidden"  name="clsbpFileDetails_optSearchType" value="<?php echo $tempObject->searchType; ?>">
		<input type="hidden"  name="clsbpFileDetails_lstGenre" value="<?php echo $tempObject->searchGenre; ?>">
		<input type="hidden"  name="clsbpFileDetails_txtMin" value="<?php echo $tempObject->searchMinAmount; ?>">
		<input type="hidden"  name="clsbpFileDetails_txtMax" value="<?php echo $tempObject->searchMaxAmount; ?>">
		<input type="hidden"  name="clsbpFileDetails_optSeller" value="<?php echo $tempObject->searchIfSeller; ?>">
		<input type="hidden"  name="clsbpFileDetails_lstAct" value="<?php echo $tempObject->searchAction; ?>">
		<input type="hidden"  name="clsbpFileDetails_txtSeller" value="<?php echo $tempObject->searchSeller; ?>">
		<input type="hidden"  name="clsbpFileDetails_goBack" value="<?php echo $tempObject->goBack;?>">
		<input type="hidden"  name="clsbpFileDetails_artist" value="<?php echo $tempObject->vc_artists_nm_mod;?>">
		<input type="hidden"  name="clsbpFileDetails_album" value="<?php echo $tempObject->vc_album_nm_mod;?>">
    <input type="hidden"  name="clsbpBopaCart_action" value=""> 
		<input type="hidden" name="clsbpFileDetails_vc_tags" value="<?php echo $tempObject->vc_tags; ?>"> 
		<input type="hidden" name="clsbpFileDetails_txtSearch" value="<?php echo $tempObject->txtSearch; ?>"> 
		<input type="hidden" name="clsbpFileDetails_seachCat" value="<?php echo $tempObject->seachCat; ?>"> 
		<input type="hidden" name="clsbpFileDetails_bi_GenreId" value="<?php echo $tempObject->bi_GenreId; ?>"> 
		<input type="hidden" name="clsbpFileDetails_SearchGenreId" value="<?php echo $tempObject->SearchGenreId; ?>"> 
		<input type="hidden" name="clsbpFileDetails_SearchGenreName" value="<?php echo $tempObject->SearchGenreName; ?>"> 
		<input type="hidden" name="clsbpFileDetails_Search_tags" value="<?php echo $tempObject->Searchtags; ?>">
		<input type="hidden" name="clsbpFileDetails_bi_SellerId" value="<?php echo $tempObject->sellerId; ?>">
    <input type="hidden" name="clsbpFileDetails_action" value="">
    <input type="hidden" name="clsbpFileDetails_bi_file_id" value="<?php echo $tempObject->bi_file_id;  ?>">
	
      <div class="rounded" id="searhViewDetailsPage">
      <div class="t">
        <div class="tr"></div>
      </div>
      <div class="c"> <div class="cl">
        <!--add content-->
		<div id="viewDetailsLS">
            	<h1><?php echo stripslashes($clsbpFileDetails->vc_SongName); ?></h1>
                <div class="albumArt">
                	<div><img src="<?php echo IMAGEPATH; ?>albumcover.jpg" alt="Album Art" /></div>
                	
                </div>
                <div class="songDetails">
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
                    <p>by <strong><a href="bpSearch.php?clsbpFileDetails_artist=<?php echo stripslashes($clsbpFileDetails->vc_artists_nm_mod); ?>"><?php echo stripslashes($clsbpFileDetails->vc_album_nm_mod); ?></a></strong></p>
                    <p>album <strong><a href="bpSearch.php?clsbpFileDetails_album=<?php echo stripslashes($clsbpFileDetails->vc_album_nm_mod); ?>"><?php echo stripslashes($clsbpFileDetails->vc_album_nm_mod); ?></a></strong></p>
                    <p>price: $<?php echo stripslashes($clsbpFileDetails->dbl_price); ?></p>
                    <p>
                    	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="30" height="30">
                    		<param name="movie" value="preview.swf">
                    		<param name="wmode" value="transparent">
                    		<param name="quality" value="high">
                    		<param name="FlashVars" value="filename=http://bopabox.s3.amazonaws.com/bopaBox/<?php echo $clsbpFileDetails->bi_MemberId; ?>/music/<?php echo stripslashes($clsbpFileDetails->vc_FileName); ?>" />
                    		<param name="allowScriptAccess" value="sameDomain" />
                    		<embed src="preview.swf" quality="high" allowScriptAccess="sameDomain" FlashVars="filename=http://bopabox.s3.amazonaws.com/bopaBox/<?php echo $clsbpFileDetails->bi_MemberId; ?>/music/<?php echo stripslashes($clsbpFileDetails->vc_FileName); ?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="30" height="30"></embed>
                    	</object>
                    </p>
                    <div style="clear:both;"></div>
                    
<?php if(!in_array($clsbpFileDetails->bi_file_id,$_SESSION['bopaBasket']['song']) ){?>
                    <div class="btAddToCart"><a href="javascript: void(0);" onclick="return fn_cart(<?php echo $clsbpFileDetails->bi_file_id; ?>);" style="display:block;"></a></div>
<?php }else {?>
                    <div class="btAddToCart"><a href="javascript: void(0);" onclick="return fn_cart(<?php echo $clsbpFileDetails->bi_file_id; ?>);" style="display:block;"></a></div>
<?php }?>
                </div>                
                <p>format: mp3</p>
                <p>size: <?php echo number_format((($clsbpFileDetails->vc_FileSize)/(1024*1024)),2); ?>mb</p>
                <p>time: <?php echo stripslashes($clsbpFileDetails->f_track_length); ?></p>
                <p>bit rate: <?php echo round($clsbpFileDetails->f_bitrate) ?>K</p>
        </div>
            <div id="viewDetailsRS">
            	<p class="backToResults"><a href="javascript: void(0);" onclick="javascript: submitBack();">back to search results</a></p>
				<dl>
                  <dt>seller:</dt>
                        <dd><?php echo $clsbpFileDetails->memberDisplayName ?></dd>
                    <dt>rating:</dt>            
                        <dd><img src="<?php echo IMAGEPATH; ?>rate_<?php echo $rating; ?>star.png" /></dd>
                        <dd>(<?php echo $clsbpRatings->totalReviews;?>)</dd>
                    <dt style="width:72px;">member since:</dt>
                        <dd><?php  $date = explode(" ",$clsbpFileDetails->memberRegDate); echo date ("m/j/Y",strtotime($date[0]));?></dd>
                </dl>
                
                	<ul>
                 		<li><a href="<?php  echo constant("URL").str_replace(" ","-",$clsbpFileDetails->memberDisplayName); ?>" class="viewMemberStore">view member store</a></li>

<?php  if($_SESSION['USERID'] !=""){ ?>
                  	<li><a href="bpMyBopaMessageCompose.php?clsbpMessages_newToId=<?php echo $clsbpFileDetails->bi_sellerId; ?>" class="contact">contact</a></li>
<?php } else { ?>
                  	<li><a href="bpSignIn.php?height=316&width=100px&modal=true&return=<?php $currentpageurl=getCurrentPage(); echo $currentpageurl;  ?>" class="thickbox contact">contact</a></li>
<?php } ?>

<?php  
	if($_SESSION['USERID'] !="" && $_SESSION['USERID'] !=$clsbpFileDetails->bi_sellerId) {
		if($numOfFavSellors == 0) {
?>
                    <li><a href='javascript:void(0);' onclick="return fn_Add(<?php echo $clsbpFileDetails->bi_sellerId;?>);" class="assSellerToFav">add seller to favorites</a></li>
<?php
		}else{
?>
                    <li><a href='javascript:void(0);' class="assSellerToFav">one of my saved sellers</a></li>
<?php
		}
	}
?>

<?php if($_SESSION['USERID']=="") { ?>
                    <li><a href="bpSignIn.php?height=316&width=100px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo $currentpageurl; ?>" class="thickbox assSellerToFav">add seller to favorites</a></li>
<?php } ?>

                  </ul>

                
          </div>         
        </div>
        <!--finish content-->
      </div>
      <div class="b"><span class="br"></span></div>
    </div>
      
      <div class="cls"></div>
	</form>
      </div>
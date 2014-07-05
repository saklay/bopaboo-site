<script  language="javascript" type="text/javascript">

var xmlHttp;
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
		//	alert('<?php // echo $clsbpFileDetails->vc_DisplayName ?>'+" has been added to your favourite seller list.");
			 document.frmMemberStore.submit();
		}
		else if(xmlHttp.responseText==0){
			
			/*document.getElementById('sellerNew').innerHTML = '<img src="images/dis-add-a-cart-ico.png" alt="Add Seller to Favorites" width="27" height="26" border="0" align="absmiddle" /><a href="javascript:void(0);"   class="itemfooterlinks">One of My Saved Sellers</a>' ;
		*/
		//alert('<?php // echo $clsbpFileDetails->vc_DisplayName ?>'+" is already there in  your favourite seller list.")		
  
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


function fn_showTab(gourl){

//gourl=populateParameters(gourl);


xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){

  alert ("Browser does not support HTTP Request")
  return
  
} 
           xmlHttp.onreadystatechange=stateChangedTab;
          xmlHttp.open("GET",gourl,true)
          xmlHttp.send(null);

}

function stateChangedTab() 
     { 
     if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
          { 
     
          document.getElementById('memberStore').innerHTML=xmlHttp.responseText ;
          document.getElementById('loadImage').style.visibility ='hidden'
          } 
                    
   
}


function submitForm() {
     var frm=document.frmMemberStore;

     switch(frm.sortMenu.value) {
				case '1':
					
						frm.clsbpFileDetails_sortColumn.value = "dt_FileUploaded";
						frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
				case '2':
						frm.clsbpFileDetails_sortColumn.value = "dt_FileUploaded";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
				case '3':
						frm.clsbpFileDetails_sortColumn.value = "dbl_price";
						frm.clsbpFileDetails_sortDirection.value="DESC";
                                                frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
				case '4':
						frm.clsbpFileDetails_sortColumn.value = "dbl_price";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
		}
          sortAjaxColumn('bpAjaxMemberStore.php',frm.clsbpFileDetails_sortColumn.value,'clsbpFileDetails','frmMemberStore', '<?php echo $extraParameters; ?>','');
}


function populateParameters(gourl){
var frm=document.frmMemberStore;
if(document.frmMemberStore){
	switch(frm.sortMenu.value) {
				case '1':
					
						frm.clsbpFileDetails_sortColumn.value = "dt_FileUploaded";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
				case '2':
						frm.clsbpFileDetails_sortColumn.value = "dt_FileUploaded";
						frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
				case '3':
						frm.clsbpFileDetails_sortColumn.value = "dbl_price";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
				case '4':
						frm.clsbpFileDetails_sortColumn.value = "dbl_price";
						frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
		}


var clsbpFileDetails_pageIndex=frm.clsbpFileDetails_pageIndex.value;
var  clsbpFileDetails_pageIndex=  frm.clsbpFileDetails_pageIndex.value;
var  clsbpFileDetails_sortDirection=  frm.clsbpFileDetails_sortDirection.value;
var  clsbpFileDetails_action=  frm.clsbpFileDetails_action.value;
var  clsbpFileDetails_FileIds=  frm.clsbpFileDetails_FileIds.value;
var  clsbpFileDetails_FileId=  frm.clsbpFileDetails_FileId.value;
var  clsbpFileDetails_bi_GenreId=  frm.clsbpFileDetails_bi_GenreId.value;
var  clsbpFileDetails_vc_tags=  frm.clsbpFileDetails_vc_tags.value;
var  clsbpFileDetails_txtSearch=  frm.clsbpFileDetails_txtSearch.value;
var  clsbpFileDetails_seachCat=  frm.clsbpFileDetails_seachCat.value;
var  clsbpFileDetails_sortColumn=  frm.clsbpFileDetails_sortColumn.value;
var  clsbpFileDetails_SearchGenreId=  frm.clsbpFileDetails_SearchGenreId.value;
var  clsbpFileDetails_SearchGenreName =  frm.clsbpFileDetails_SearchGenreName.value;
var  clsbpFileDetails_Search_tags=  frm.clsbpFileDetails_Search_tags.value;
var  clsbpFileDetails_returnUrl=  frm.clsbpFileDetails_returnUrl.value;

url=gourl+'?clsbpFileDetails_pageIndex='+clsbpFileDetails_pageIndex;
url=url+'&clsbpFileDetails_sortColumn='+clsbpFileDetails_sortColumn;
url=url+'&clsbpFileDetails_sortDirection='+clsbpFileDetails_sortDirection;
url=url+'&clsbpFileDetails_pageIndex='+clsbpFileDetails_pageIndex; 
url=url+'&clsbpFileDetails_action='+clsbpFileDetails_action;
url=url+'&clsbpFileDetails_FileIds='+clsbpFileDetails_FileIds;
url=url+'&clsbpFileDetails_FileId='+clsbpFileDetails_FileId;
url=url+'&clsbpFileDetails_bi_GenreId='+clsbpFileDetails_bi_GenreId;
url=url+'&clsbpFileDetails_vc_tags='+clsbpFileDetails_vc_tags;
url=url+'&clsbpFileDetails_txtSearch='+clsbpFileDetails_txtSearch;
url=url+'&clsbpFileDetails_seachCat='+clsbpFileDetails_seachCat;
url=url+'&clsbpFileDetails_SearchGenreId='+clsbpFileDetails_SearchGenreId;
url=url+'&clsbpFileDetails_SearchGenreName='+clsbpFileDetails_SearchGenreName;
url=url+'&clsbpFileDetails_Search_tags='+clsbpFileDetails_Search_tags;
url=url+'&clsbpFileDetails_returnUrl='+clsbpFileDetails_returnUrl;





var  clsbpBopaCart_action=  frm.clsbpBopaCart_action.value;
url=url+'&clsbpBopaCart_action='+clsbpBopaCart_action;

var  clsbpBopaCart_FileIds=  frm.clsbpBopaCart_FileIds.value;
url=url+'&clsbpBopaCart_FileIds='+clsbpBopaCart_FileIds;

var  clsbpBopaCart_FileId=  frm.clsbpBopaCart_FileId.value;
url=url+'&clsbpBopaCart_FileId='+clsbpBopaCart_FileId;

var  clsbpBopaCart_returnUrl=  frm.clsbpBopaCart_returnUrl.value;
url=url+'&clsbpBopaCart_returnUrl='+clsbpBopaCart_returnUrl;

var  clsbpFileDetails_submitted=  frm.clsbpFileDetails_submitted.value;
url=url+'&clsbpFileDetails_submitted='+clsbpFileDetails_submitted;

var  mS=  frm.mS.value;
url=url+'&mS='+mS;

var clsbpFileDetails_goBack =  frm.clsbpFileDetails_goBack.value;
url=url+'&clsbpFileDetails_goBack='+clsbpFileDetails_goBack;

//var  textfield=  frm.textfield.value;
//url=url+'&textfield='+textfield;

var  sortMenu=  frm.sortMenu.value;
url=url+'&sortMenu='+sortMenu;

var clsbpFileDetails_jumpTo =  frm.clsbpFileDetails_jumpTo.value;
url=url+'&clsbpFileDetails_jumpTo='+clsbpFileDetails_jumpTo;
document.getElementById('loadImage').style.visibility ='visible'
}
else{
url=gourl;

}
return url;
}

</script>


  <div id="container">
  
        <div class="roundedTab" id="memberStoreBox">
          <div class="t">
            <div class="tab">
              <h3>about the seller</h3>
            </div>
            <div class="tr"></div>
          </div>
        </div>
        <div class="roundedTab" id="memberStoreBox" style="background-color:#ffffff;">
          <div class="c"> <div class="cl">
            <!--add content-->
            <div class="holder" style="width:640px;">
           		<h1><?php echo $clsbpFileDetails->vc_DisplayName ?></h1>
                <div class="ratingRow" style="width:150px;float:right;">
                <span class="rating"><img src="<?php echo IMAGEPATH ?>rate_<?php echo $rating; ?>star.png" alt="<?php echo $rating; ?> stars" title="<?php echo $rating; ?> stars" border=0 /></span><span class="rated">(<?php echo $clsbpRatings->totalReviews;?>)</span></div>
                <div class="hr"><hr /></div>
                <div style="clear:both;"></div>
                <dl class="sellerInfo" style="width:450px;">
                	<dt>member since:</dt>
                    <dd><?php $date = explode(" ",$clsbpFileDetails->dt_SignUp); echo date ("F j, Y",strtotime($date[0]));?></dd>
                    <dt>total sales:</dt>
                    <dd><?php echo $clsbpFileDetails->getAllSoldItemsCount($clsbpFileDetails->bi_sellerId); ?> songs</dd>
                    <!--
                    <dt>songs for sale:</dt>
                    <dd>1,200</dd>
                    <dt>deals: </dt>
                    <dd>1,200</dd>
                    -->
                    <dt>direct link:</dt>
                    <dd><a href="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>"><?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?></a></dd>			
              </dl>
                
          <div class="memberStoreBoxRS" style="width:150px;">
                	<ul>
<?php if ($_SESSION['USERID'] !="") { if($_COOKIE['COOKIE_USERNAME'] != $clsbpFileDetails->mS) { ?>
										<li><a href="bpMyBopaMessageCompose.php?clsbpMessages_newToId=<?php echo $clsbpFileDetails->bi_sellerId; ?>" class="contact">contact</a></li>
<?php } } else { ?>
										<li><a href="javascript:void(0);" class="contact">contact</a></li>
<?php } ?>

<?php  
	if($_SESSION['USERID'] !="" && $_SESSION['USERID'] !=$clsbpFileDetails->bi_sellerId) {
		if($numOfFavSellors == 0) {
?>
										<li><a href="javascript:void(0);" class="sellerFav" onclick="return fn_Add(<?php echo $clsbpFileDetails->bi_sellerId;?>);">add sellers to favorites</a></li>
<?php
		} else{
?>
										<li><a href="javascript:void(0);" class="sellerFav">add sellers to favorites</a></li>
            
<?php
		}
	}
?>
                      <li><script type="text/javascript" src="http://w.sharethis.com/widget/?tabs=web%2Cpost%2Cemail&amp;charset=utf-8&amp;style=default&amp;publisher=27bdba25-56fd-426b-a407-3901404f87ca"></script></li>
              </ul>
                </div>
                
                </div>
            
            </div>
            <!--finish content-->
          </div>
          <div class="b"><span class="br"></span></div>
        </div>
    
    <div id="memberStore">
    	
<?php echo "<script type='text/javascript'>fn_showTab('bpAjaxMemberStore.php?&mS=".trim($_GET['mS'])."');</script>"; ?>
    
  </div>

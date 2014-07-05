<?php
	ob_start();
	header("Cache-Control: no-store, no-cache");
	set_time_limit (60);
	$includePath		= "./";
	
	include_once($includePath."bpCommon.php");
	
	include_once($includePath."bpSessionCheck.php");
	include_once($includePath."classes/bpPayment.cls.php");
	include_once($includePath."classes/bpFileDetails.cls.php");
	include_once($includePath."classes/bpRatings.cls.php");
	include_once($includePath."classes/bpPaginate.cls.php");
	include_once($includePath."classes/bpMessages.cls.php");
	include_once($includePath."classes/bpAnnouncements.cls.php");
	include_once("classes/bpMailImport.cls.php");
	// 	error_reporting(E_ALL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><?php echo SITENAME; ?></title>
    <link rel="SHORTCUT ICON" href="<?php echo IMAGEPATH ?>logo.ico">
    <script src="Scripts/AC_RunActiveContent.js" type="text/javascript">
    	</script><script type="text/javascript" src="animation.js"></script>
    <link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
    <link href="styles/mybopa.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/thickbox.js"></script>
    <script src="scripts/jquery-1.2.3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="scripts/mootools.js"></script>
		<script type="text/javascript" src="scripts/demos.js"></script>

<style type="text/css">
@import "styles/master.css";
</style>
<!--[if IE]>
	<style type="text/css">
		@import "styles/ie.css";
    </style>    
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
  
	<script type="text/javascript">


		window.addEvent('domready', function(){
			//-vertical
			
			var qlMessagesSlide = new Fx.Slide('qlMessagesDiv').hide();
			var qlSellersSlide = new Fx.Slide('qlSellersDiv').hide();
			var qlSavedSlide = new Fx.Slide('qlSavedDiv').hide();
			var qlPopularSlide = new Fx.Slide('qlPopularDiv').hide();
			
			
			$('qlMessagesToggle').addEvent('mouseover', function(e){
				e = new Event(e);
				qlMessagesSlide.slideIn.delay(500, qlMessagesSlide);
				e.stop();
			});
			
			$('qlMessagesToggle').addEvent('mouseout', function(e){
				e = new Event(e);
				
				qlMessagesSlide.slideOut();
				e.stop();
			});
			
			$('qlSellersToggle').addEvent('mouseover', function(e){
				e = new Event(e);
				qlSellersSlide.slideIn.delay(500, qlSellersSlide);
				e.stop();
			});
			
			$('qlSellersToggle').addEvent('mouseout', function(e){
				e = new Event(e);
				qlSellersSlide.slideOut();
				qlMyDashboardSlide.slideOut();
				e.stop();
			});
			
			$('qlSavedToggle').addEvent('mouseover', function(e){
				e = new Event(e);
				qlSavedSlide.slideIn.delay(500, qlSavedSlide);
				e.stop();
			});
			
			$('qlSavedToggle').addEvent('mouseout', function(e){
				e = new Event(e);
				qlSavedSlide.slideOut();
				e.stop();
			});
			
			$('qlPopularToggle').addEvent('mouseover', function(e){
				e = new Event(e);
				qlPopularSlide.slideIn.delay(500, qlPopularSlide);
				e.stop();
			});
			
			$('qlPopularToggle').addEvent('mouseout', function(e){
				e = new Event(e);
				qlPopularSlide.slideOut();
				e.stop();
			});
			
		
		}); 
	</script>
  
  
  </head>
  <body>
    <div id="wrapper">
      <?php
        include_once($includePath."includes/bpUserCommonBody.inc.php"); 
      ?>
    </div>
  </body>
</html>
<?php
function writeMain($connect, $includePath) {
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();

    	$clsbpFileDetails->submitted = 1;
    	$clsbpFileDetails->postFiles();
    	
    	/*----------------------------------------------------------------------------	
	 Created payment object*/
	$clsbpPayment	= new clsbpPayment($connect, $includePath,"clsbpPayment");
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();
	
	/*---------------------------------------------------------------------------*/
	
	/*--------------------------------------------------------------------------------*/
	
	$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	$rating = $clsbpRatings->fn_showUserRatingsAsImage($_SESSION['USERID']);
	/*--------------------------------------------------------------------------------*/
	
	/*-------------Create Messaging object ----------------------*/
	$clsbpMessages	= new clsbpMessages($connect, $includePath,"clsbpMessages");
	$countMessages = $clsbpMessages->getMessageInboxCount();
	$clsbpMessages	= new clsbpMessages($connect, $includePath,"clsbpMessages");
	$clsbpMessages->setPostVars();
	$clsbpMessages->setGetVars();
	$clsbpMessages->postMessages();
	$arrMessages = $clsbpMessages->getMessageList();
	
	/*--------------------------------------------- ----------------------*/
	
	
	/*-------------Create Announcement object ----------------------*/
	$clsbpAnnouncements	= new clsbpAnnouncements($connect, $includePath,"clsbpMessages");
	$clsbpAnnouncements->getLatestAnnouncementDetails();
	
// 	displayObject($clsbpAnnouncements);
	/*--------------------------------------------- ----------------------*/
	
	
 	$clsbpFileDetails->getUserMybopaCount($_SESSION['USERID']);	
 	$clsbpFileDetails->getUserMybopaSellCount($_SESSION['USERID']); 	
 	$clsbpFileDetails->getAllBopaCount();
 	$clsbpFileDetails->getCurrentYearStat($_SESSION['USERID']);
 	$arrDet = $clsbpFileDetails->getTopSellingSongsList();
//  	$arrObj = get_object_vars($clsbpFileDetails);
//  	
//  	echo "<pre>";
//  	print_r($arrMemDet );
//  	echo "</pre>";
$clsbpMailImport	= new clsbpMailImport($connect, $includePath,"clsbpMailImport");

	include_once($includePath."templates/bpMyBopa.tmpl.php");
}

ob_end_flush(); 
?>

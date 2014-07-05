<?php 
	ob_start();
	header("Cache-Control: no-store, no-cache");
	set_time_limit (60);
	$includePath		= "./";
	include_once($includePath."bpCommon.php");
	include_once("bpFunctions.php");
	include_once($includePath."classes/bpHelp.cls.php");
	
	//error_reporting(E_ALL);
	$qnId = $_GET['id'];
	$catId = $_GET['catId'];
	$searchFlag = $_GET['flag'];

	
	$clsbpHelp	= new clsbpHelp($connect, $includePath,"clsbpHelp");
	$clsbpHelp->getAnswerRow($qnId);
	
?>

<div class="faqcnt">
	<h3>Q. <?php echo $clsbpHelp->strQuestion;?></h3>
	<p><?php echo nl2br($clsbpHelp->strAnswer);?></p>
	<?php 
		if($searchFlag==0) {
	?>
			<p align="right" style="padding-right:20px;"><a href="javascript: void(0);" onclick="showDiv(<?php echo $_GET['catId']; ?>, document.getElementById('link<?php echo $_GET['catId']; ?>'));" >&lt;&lt; Return to Questions</a></p>
	<?php
		}
		else {
	?>
			<p align="right" style="padding-right:20px;"><a href="javascript: void(0);" onclick="javascript: return submitForm();" >&lt;&lt; Return to Search Results</a></p>
	<?php
		}
	?>
</div>
<?php
	ob_get_contents();
?>
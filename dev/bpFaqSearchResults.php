<?php 
	ob_start();
	header("Cache-Control: no-store, no-cache");
	set_time_limit (60);
	$includePath		= "./";
	include_once($includePath."bpCommon.php");
	include_once("bpFunctions.php");
	include_once($includePath."classes/bpHelp.cls.php");
	
	//error_reporting(E_ALL);
	$keyword = $_GET['kw'];
	
	$clsbpHelp	= new clsbpHelp($connect, $includePath,"clsbpHelp");
	$qnArray = $clsbpHelp->getSearchResult($keyword);
	
	
?>
<?php 
if($keyword='') {
?>
<script>
document.frmHelp.value='';
</script>
<?php
}
?>
<div class="faqcnt">
	<?php 	
		if(count($qnArray)) {
	?>
		<h1>
		<ul>
			<?php 
				$i=1;
				foreach($qnArray as $qnRow) {
			?>
					<li><a href="javascript: void(0);" onclick="javascript: showAnswerDiv(<?php echo $qnRow['bi_FaqID']; ?>, null,1);"><?php echo $i.". ".$qnRow['t_Question']; ?></a></li>
			<?php
				$i++;
			}
			?>
		</ul>
		</h1>
	<?php
		}
		else {
	?>
		<p align="center" style="color:#F26530"><strong>Sorry!!! No results found.</strong></p>
	<?php
		}
	?>
</div>
<?php
	ob_get_contents();
?>


<script language="JavaScript" type="text/javascript">
	var list = new Array();
	<?php
		$i=0;
		foreach($catArray as $row) {
			$id = $row['bi_CatID'];
	?>
		list[<?php echo $i; ?>] = <?php echo "\"".$id."\""; ?>;
		
	<?php
		$i++;
		}
	?>
</script>


  <div id="container">
  
      <div id="buySectionlaside">
      	<div class="roundedTab" id="buySection" style="width:1000px;">
        <div class="t">
        	
<?php
			$i = 0;
			$id = $_GET['id'];
			foreach($catArray as $row) {
				if($id=='') {
					if($i==0) {
						$style  = "class=\"tab\"";
					}
					else{
						$style = "class=\"tabOff\"";
					}
				}
				else {
					if($row['bi_CatID'] == $id ) {
						$style  = "class=\"tab\"";
					}
					else {
						$style = "class=\"tabOff\"";
					}
				}			
		?>
					<div id="tablink<?php echo $row['bi_CatID']; ?>" <?php echo $style ?>><h3 class="wide" style="text-transform:lowercase;"><a href="javascript: void(0);" onclick="showDiv(<?php echo $row['bi_CatID']; ?>, this);" id="link<?php echo $row['bi_CatID']; ?>"><?php echo $row['vc_CatName']; ?></a></h3></div>
		<?php 
			$i++;
			}
		?>
					<div id="loadImage" class="loading" style="display:none;"> <img src="<?php echo IMAGEPATH ?>o2.gif" alt="loading" width="16" height="16" /> </div>
					<!-- <div id="loadImage" class="loading"></div> -->
          <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
			<div class="buySection" style="width:800px;">
							<form class="form" action="" method="POST" name="frmHelp" onsubmit="javascript: return submitForm()">
								<input type="hidden" name="clsbpHelp_action" value="" />
								<div class="bopaBoxSearch">
									<input type="text"  name="clsbpHelp_SearchKeyword" value="search help"  id="lName" class="bopaBoxSearchInput" onclick="javascript: clstext();" onblur="javascript: chktext()" />
								</div>
								<div style="clear:both;"></div>
							</form>
							
               <?php
               		$chk=0;
					
                    	foreach($catArray as $catRow) {
                    		$qnArray = $clsbpHelp->getCatActiveQuestions($catRow['bi_CatID']);
							if($id=='') {
								if($chk==0) {
									$style = "style=\"visibility:visible; display:block;\"";
								}
								else {
									$style = "style=\"visibility:hidden; display:none;\"";
								}
							}
							else {
								if($catRow['bi_CatID'] == $id ) {
									$style = "style=\"visibility:visible; display:block;\"";
								}
								else {
									$style = "style=\"visibility:hidden; display:none;\"";
								}
								
							}
                    ?>
							
							<div class="hdrBg"  id="hdr<?php echo $catRow['bi_CatID']; ?>" <?php echo $style; ?>></div>
							<div class="bodyBg"  id="main<?php echo $catRow['bi_CatID']; ?>" <?php echo $style; ?>>
								<div class="faqcnt">
								<h1>
									<ul>
                            <?php 
                            	$i=1;
                            	foreach($qnArray as $qnRow) {
                            ?>
                            <li><a href="javascript: void(0);" onclick="javascript: showAnswerDiv(<?php echo $qnRow['bi_FaqID']; ?>, <?php echo $catRow['bi_CatID']; ?>,0);"><?php echo $i.". ".$qnRow['t_Question']; ?></a></li>
                            <?php
                            	$i++;
                            	}
                            ?>
									</ul>
								</h1>
								</div>
							</div>
							<div class="ftrBg"  id="ftr<?php echo $catRow['bi_CatID']; ?>" <?php echo $style; ?>></div>
                    <?php
                    	$chk++;
                       	}
                     ?>
							<div class="hdrBg"  id="hdrAns" style="visibility:hidden; display:none;">&nbsp;</div>
							<div class="bodyBg"  id="mainAns" style="visibility:hidden; display:none;">&nbsp;<!-- AJAX-->
                    </div>
              <div class="ftrBg"  id="ftrAns" style="visibility:hidden; display:none;"></div>
							
            </div>
        
          <!--finish content-->
          </div> </div>
        <div class="b"><span class="br"></span></div>
      </div> 
      <div class="cls"></div>
      </div>
    
  </div>
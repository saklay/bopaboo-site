<?php

ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once("classes/bpMailImport.cls.php");

	/*--------------------------------------------------------------------------------*/
	
	$clsbpMailImport	= new clsbpMailImport($connect, $includePath,"clsbpMailImport");
	$contactArray = $clsbpMailImport->dcl_importer_get_contacts($_GET['user'], $_GET['pass'], $_GET['provider']);
	$count = count($contactArray);	
	/*--------------------------------------------------------------------------------*/
//print_r($contactArray);
		
		if($_GET['provider']=='A'&& $count==1){ // AOL
		$count = $count+1;
					
		}
		

if($count>1) {
?>

  <form id="form1" name="frmGrab" method="post" action="">
  <div class="top">
  	<h1>Import Email Addresses</h1>
    <a href="#" onClick="tb_remove();"><img src="images/btn-close1.jpg" alt="close" width="19" height="19" border="0" class="closenow" /></a>
    <p>Select which contacts you would like to add.</p>
   </div>
   
   
	<div class="contents">
   	  <div class="hdrselectContact">
            <span class="selectAll"><input  type="checkbox" name="selectAll" id="selectAll" onclick="javascript: fnSetAllCheckBoxes('frmGrab', 'addtoContact[]', this.checked)"/></span>
            <span>Select All</span>
    	</div>
        <div class="listSelectContactHolder">
        <table border="0" cellspacing="0" cellpadding="0">
        <?php 
		
		foreach ($contactArray as $k => $v) {
		?>
          <tr>
            <td><span class="selectAll">
              <input type="checkbox" name="addtoContact[]" id="<?php echo $k; ?>" value="<?php echo $v."[".$k."]"; ?>" />
            </span> <span class="contactName"><a href="#"><?php echo $k; ?></a></span> </td>
          </tr>
      <?php } ?>
  
  
      
     
</table>

      </div>
      <div class="ftrselectContact">
            <span class="btnimport"><a href='javascript:void(0);' onclick="return fn_GrabList();"><input type="image" src="images/btn-import.png" name="import" id="import" /></a></span>
    	</div>
    </div>
    
    
<div class="bottom">Switch Accounts:<br />
  <a href="bpGmailImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">Gmail</a> | <a href="bpYahooImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">Yahoo</a> | <a href="bpHotmailImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">Hotmail</a> | <a href="bpAOLImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">AOL</a> | <a href="#">Outlook</a> | <a href="#">Other</a></div>

  </form>

   
<?php
}
ob_get_contents();

?>
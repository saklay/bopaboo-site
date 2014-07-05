<?php

ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once("classes/bpMailImport.cls.php");

	/*--------------------------------------------------------------------------------*/
	
	$clsbpMailImport	= new clsbpMailImport($connect, $includePath,"clsbpMailImport");
	$contactArray = $clsbpMailImport->dcl_importer_get_contacts($_GET['user'], $_GET['pass'], $_GET['provider']);
	
	/*--------------------------------------------------------------------------------*/

	$count = count($contactArray[0]);
	

?>

   	
  <form id="form1" name="form1" method="post" action="">
  <div class="top">
  	<h1>Import Email Addresses</h1>
    <a href="#" onClick="tb_remove();"><img src="images/btn-close1.jpg" alt="close" width="19" height="19" border="0" class="closenow" /></a>
    <p>Select which contacts you would like to add.</p>
   </div>
   
   
	<div class="contents">
   	  <div class="hdrselectContact">
            <span class="selectAll"><input type="checkbox" name="selectAll" id="selectAll" /></span>
            <span>Select All</span>
    	</div>
        <div class="listSelectContactHolder">
        <table border="0" cellspacing="0" cellpadding="0">
        <?php 
		
		for ($i = 1; $i <= $count; $i++) {
		?>
          <tr>
            <td><span class="selectAll">
              <input type="checkbox" name="selectAll2" id="selectAll7" />
            </span> <span class="contactName"><a href="#"><?php echo $contactArray[1][$i]; ?></a></span> </td>
          </tr>
      <?php } ?>
  
  
      
     
</table>

      </div>
      <div class="ftrselectContact">
            <span class="btnimport"><input type="image" src="images/btn-import.png" name="import" id="import" /></span>
    	</div>
    </div>
    
    
<div class="bottom">Switch Accounts:<br />
  <a href="#">Gmail</a> | <a href="#">Yahoo</a> | <a href="#">Hotmail</a> | <a href="#">AOL</a> | <a href="#">Outlook</a> | <a href="#">Other</a></div>

  </form>

   
<?php
ob_get_contents();

?>
<?php
/**
* Grab Gmail : Gmail Addressbook Grabber Class
*
* @author  :  MA Razzaque Rupom <rupom_315@yahoo.com>, <rupom.bd@gmail.com>
*             Moderator, phpResource (http://groups.yahoo.com/group/phpresource/)
*             URL: http://www.rupom.info  
                   http://rupom.wordpress.com
* @version :  1.1
* @date       05/25/2006
* Purpose  :  Grabbing Your Gmail Addressbook
*/

  require_once("GrabGmail.class.php");
  
  $login = 'vasantheb';//without "@gmail.com"
  $password = 'music&me@84';
  $cookiePath = '/.';  

  $obj = new GrabGmail();
  $obj->setLoginInfo($login, $password);
  $obj->setCookiePath($cookiePath);
  $obj->setProxy("");
  $obj->prepareContactList();
  $obj->dBug("========== All Contacts of <b>$login@gmail.com</b> ==============");
  $obj->dBug('---- Contacts in Table ------');
  $resultTable = $obj->getResultTable();
  $obj->dBug($resultTable);
  $obj->dBug('---- Contacts in Array ------');
  $resultArray = $obj->getResultArray();
  $obj->dBug($resultArray);    
?>
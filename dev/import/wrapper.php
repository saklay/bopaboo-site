<?php
/**
 * Wrapper for mapping to the target importer library
 */

  $names  = array();
  $emails = array();

  function dcl_importer_get_contacts($login, $password, $provider) {
    $provider = strtoupper(trim($provider));
    $contacts = array();
    switch($provider) {
      case 'G': $contacts = importGmail		( $login, $password ); break;
      case 'Y': $contacts = importYahoo		( $login, $password ); break;
      case 'L': $contacts = importLycos		( $login, $password ); break;
      case 'A': $contacts = importAol  		( $login, $password ); break;
      case 'M': $contacts = importMsnm 		( $login, $password ); break;
      case 'S': $contacts = importMyspace	( $login, $password ); break;
      default:  $contacts = array();
    }
    return array($contacts);
  }
// $contacts = importYahoo('siva.prasad@bltsol.com', '' );
//$contacts =importMsnm('sivaprasad_80@hotmail.com','');
//  $contacts =importGmail('contactsiva.spc@gmail.com','');
 $contacts =importAol('siva.bltsol@aol.in','conair');
 print "<pre>";
 print_r($contacts);

  /**
   * Import Gmail Contacts
   */
  function importGmail($login, $password) {
    include ('scripts/importGmail.class.php');
    global $names;
    global $emails;
    $gmailer = new GMailer();
    /*
    if($gmailer->created) {
      $gmailer->setLoginInfo($login, $password, $my_timezone, 0);
      //if you are using a proxy then uncomment the following single line and modify it according to your settings.
      //$gmailer->setProxy("proxy.company.com");
      if($gmailer->connect()) {
        $gmailer->fetchBox(GM_CONTACT, 'all', '');
        $snapshot = $gmailer->getSnapshot(GM_CONTACT);
        $gmailer->disconnect();
        foreach($snapshot->contacts as $key => $value) {
          $names[] = $value['name'];
          $emails[]= $value['email'];
        }
      }
    }
    */
   $contacts = $gmailer->getAddressbook($login, $password);
   foreach($contacts as $name => $email) {
     $names[]  = $name;
     $emails[] = $email;
   }
   return array($names, $emails);
  }

  /**
   * Import Yahoo Contacts
   */
  function importYahoo($login, $password) {
    include ('scripts/importYahoo.class.php');
    global $names;
    global $emails;
    $yahooContacts  = new yahooGrabber($login, $password);
    $contacts       = $yahooContacts->grabYahoo();
    foreach($contacts as $name => $email) {
      $names[]  = $name;
      $emails[] = $email;
    }
    return array($names, $emails);
  }

  /**
   * Import Lycos Contacts
   */
  function importLycos($login, $password) {
    include ('scripts/importLycos.class.php');
    $lycosImporter  = new grabLycos($login, $password);
    $contacts       = $lycosImporter->getContactList();
    foreach($contacts as $name => $email) {
      $names[]  = $name;
      $emails[] = $email;
    }
    return array($names, $emails);
  }

  /**
   * Import AOL Contacts
   */
  function importAol($login, $password) {
    include ('scripts/importAol.class.php');
    $aolImporter  = new grabAol($login, $password);
    $contacts  = $aolImporter->getContactList();
    foreach($contacts as $name => $email) {
      $names[]  = $name;
      $emails[] = $email;
    }
    return array($names, $emails);
  }

  /**
   * Import MSN Messenger Contacts
   */
  function importMsnm($login, $password) {
    include ('scripts/importMsnm.class.php');
    $msnMessengerContacts = new msn;
    $msnContacts = $msnMessengerContacts->qGrab($login, $password);
    foreach($msnContacts as $contact) {
      $names[]  = $contact['1'];
      $emails[] = $contact['0'];
    }
    return array($names, $emails);
  }

  /**
   * Import MySpace Contacts
   */
   function importMyspace($login, $password) {
   	include ('scripts/importMyspace.class.php');
	$myspaceImporter = new myspace;
	$myspaceContacts = $myspaceImporter->getAddressbook($login, $password);
	foreach($myspaceContacts as $name => $email) {
		$names[] = $name;
		$emails[] = $email;
	}
	return array($names, $emails);
   }
  
?>

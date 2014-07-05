<?php 
/*******************************************************************
/ Title: Upload Class.
/ Purpose: This file is used for File upload functions.
/ Mainly used for file upload process.
/ 
/ Inputs:   An XML ($_POST['xmlData']), $memberId from Cookie
			
/ Outputs:  
/           

/ Authors: Sivaprasad C
/*******************************************************************/
class clsbpMailImport extends clsbpBase  { 

	var $xmlData;		
	var $clsbpMailImport_textarea;
	var $contactList;
	function clsbpMailImport($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpMailImport");			
		
		$this->xmlData			= "";
		$this->memberId			= "";	
		$this->fileName	        = "";
		$this->includePath		= $includePath;
		
		  $names  = array();
 		 $emails = array();

	}

	function setPostVars() {	

		parent::setPostVars();	
		
		if (isset($_POST['clsbpMailImport_username']))			$this->username				= trim($_POST['clsbpMailImport_username']);
		if (isset($_POST['clsbpMailImport_password']))			$this->password				= trim($_POST['clsbpMailImport_password']);
		if (isset($_POST['clsbpMailImport_provider']))			$this->provider				= trim($_POST['clsbpMailImport_provider']);
		if (isset($_POST['clsbpFileDetails_friendList']))		$this->friendsList			= trim($_POST['clsbpFileDetails_friendList']);
		if (isset($_POST['clsbpMailImport_textarea']))		    $this->contactList			= trim($_POST['clsbpMailImport_textarea']);	
					
	}

	  function dcl_importer_get_contacts($login, $password, $provider) {
    $provider = strtoupper(trim($provider));
	
    $contacts = array();
	
    switch($provider) {
      case 'G': 
	  $contacts = $this->importGmail		( $login, $password );
	  break;
      case 'Y':
	  $contacts = $this->importYahoo		( $login, $password );
	  break;
      case 'L': 
	  $contacts = $this->importLycos		( $login, $password );
	  break;
      case 'A':
	  $contacts = $this->importAol  		( $login, $password );
	  break;
      case 'M': 
	  $contacts = $this->importHotmail 		( $login, $password );
	  break;
      case 'S':
	  $contacts = $this->importMyspace	( $login, $password );
	  break;
      default:  $contacts = array();
    }
	
	return $contacts;
	//return($this->formatAddress($contacts));
  }
  
  function formatAddress($contacts){
 // print "<pre>";
  //  print_r($contacts);
	$count = count($contacts[0]);
	
	$i=0;
	for ($i = 1; $i <= $count; $i++) {
	
	$formatString .=$contacts[0][$i]."<".$contacts[1][$i].">,";

	}
  
  	return $formatString;
  
  }
  
// $contacts = importYahoo('siva.prasad@bltsol.com', '' );
 //$contacts =importMsnm('sivaprasad_80@hotmail.com','');
 // $contacts =importGmail('contactsiva.spc@gmail.com','');
 // $contacts =importAol('siva.bltsol@aol.in','conair');
/* print "<pre>";
 print_r($contacts);*/

  /**
   * Import Gmail Contacts
   */
   
  function importGmail($login, $password) {
  
    include ('importGmail.class.php');
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
   return $contacts;
  /* foreach($contacts as $name => $email) {
     $names[]  = $name;
     $emails[] = $email;
   }
   return array($names, $emails);*/
  }

  /**
   * Import Yahoo Contacts
   */
  function importYahoo($login, $password) {
 
    include ('importYahoo.class.php');
    global $names;
    global $emails;
    $yahooContacts  = new yahooGrabber($login, $password);
    $contacts       = $yahooContacts->grabYahoo();
	return $contacts;
  /*  foreach($contacts as $name => $email) {
      $names[]  = $name;
      $emails[] = $email;
    }
    return array($names, $emails);*/
  }

  /**
   * Import Lycos Contacts
   */
  function importLycos($login, $password) {
    include ('importLycos.class.php');
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
 // print $password;
    include ('importAol.class.php');
    $aolImporter  = new grabAol($login, $password);
    $contacts  = $aolImporter->getContactList();
	//print_r($contacts);
   // foreach($contacts as $name => $email) {
      //$names[]  = $name;
     // $emails[] = $email;
	// $arr[$emails]=$names;
   // }
    
	return $contacts;
	
  }

  /**
   * Import MSN Messenger Contacts
   */
function importHotmail($email,$password)
{
		include_once("bot.php");
		include_once("httpr.php");

		$cookieFile = 'cookie.txt';
		if(is_file($cookieFile))
			unlink($cookieFile);
		$bot = new bot($cookieFile);
		$r = $bot->get('http://www.hotmail.com/',30,5);
		$doc = new DOMDocument;
		@$doc->loadHTML($r->content);
		$POST = array();
		$POST['idsbho']='1';
		$POST['PwdPad']='IfYouAreReadingThisYouHaveTooMuchFreeTime';
		$POST['LoginOptions']='3';
		$POST['CS']='';
		$POST['FedState']='';
		$POST['PPSX']='';
		$POST['type'] = '11';
		$POST['login']=$email;
		$POST['passwd']=$password;
		$POST['NewUser']='1';
		$POST['PPFT']='';
		$POST['i1']='0';
		$POST['i2']='0';
		
		$regexp='/\<input[^\>]*'.'/im';
		preg_match_all($regexp,$r->content,$matches);
		foreach($matches[0] as $k => $v)
		{
			$regexp = '/value=\"([^\"]*)/i';
			preg_match_all($regexp,$v,$matches1);
			$value = $matches1[1][0];
			$regexp = '/name=\"([^\"]*)/i';
			preg_match_all($regexp,$v,$matches1);
			$name = $matches1[1][0];
			switch($name)
			{
				case 'PPFT':
				$ppft = $value;
				break;
			}
		} 
		$data = explode('srf_sRBlob=\'',$r->content);
		$data = explode("'",$data[1]);
		$ppsx = $data[0];
		$data = explode('srf_uPost=\'',$r->content);
		$data = explode("'",$data[1]);
		$action = $data[0];
		$POST['PPFT']=$ppft;
		$POST['PPSX']=$ppsx;
		$POST['PwdPad']=substr($POST['PwdPad'],0,strlen($POST['PwdPad'])-strlen($POST['passwd']));
		$r = $bot->post($action,$POST,30);
		$data = explode('location.replace("',$r->content);
		try
		{
			if(count($data)!=2)
				throw new exception('loggin');
			$url = explode('"',$data[1]);
			$r = $bot->get($url[0],30,5);
			$doc = new DOMDocument;
			@$doc->loadHTML($r->content);
			$cLink = $doc->getElementById('contactsShortcut')->getAttribute('href');
			$contactsUrl = $r->calcUrl($cLink);
			$r = $bot->get($contactsUrl);
			$doc = new DOMDocument;
			@$doc->loadHTML($r->content);
			$tables = $doc->getElementsByTagName('table');
			foreach($tables as $v)
			{
				if($v->getAttribute('class')=='ItemListContentTable')
					break;
			}
			$trs = $v->getElementsByTagName('tr');
			$returnvalue = array();
			foreach($trs as $v)
			{
				$tds = $v->getElementsByTagName('td');
				$name = $tds->item(2);
				$email = $tds->item(3);
				$email = html_entity_decode($email->textContent);
				$email = str_replace("\n",' ',$email);
				$email = trim($email);
				if(strpos($email,'@'))
				{
					$returnValue[$email] = trim($name->textContent);
				}
			}
			
				
		}
		catch(exception $e)
		{
			
			unlink($cookieFile);
			return false;
		}
		return $returnValue;
		exit;
}

  /**
   * Import MySpace Contacts
   */
   function importMyspace($login, $password) {
   	include ('importMyspace.class.php');
	$myspaceImporter = new myspace;
	$myspaceContacts = $myspaceImporter->getAddressbook($login, $password);
	foreach($myspaceContacts as $name => $email) {
		$names[] = $name;
		$emails[] = $email;
	}
	return array($names, $emails);
   }
	

	function sendMailToFriends(){
	
		    $clsbpEmailTemplate	= new clsbpEmailTemplate($this->connect,$this->includePath);
			$clsbpUserLogin	    = new clsbpUserLogin($this->connect, $this->includePath,"clsbpUserLogin");
			
    		$clsbpUserLogin->retrieveUserAllDeatils($_SESSION['USERID']);
			$clsbpUserLogin->retrieveUserDeatils($_SESSION['USERID']);
			
			
			$clsbpUserLogin->vc_FirstName;	//sender's first name		
		    $clsbpUserLogin->vc_LastName;   // senders last name
			$clsbpUserLogin->vc_EmailId;   // senders email id
			
			// Additional fields for mail templetes
		    $clsbpEmailTemplate->sendSubject        = $clsbpUserLogin->vc_FirstName.' has invited you to join bopaboo!';
	        $clsbpEmailTemplate->additionalField3 	= $clsbpUserLogin->vc_FirstName; //sender's first name
			$clsbpEmailTemplate->additionalField4 	= $clsbpUserLogin->vc_LastName; //sender's last name
			$clsbpEmailTemplate->additionalField5 	= "bpUserSignup.php";	
		   
		   
		    $friendArray = explode(",",$this->contactList);
			//print_r($this->contactList);
			//exit();

				foreach($friendArray as $value){				
				
				  $dataArray = explode("[",$value);
				  $emailTo   = str_replace("]","",$dataArray[1]);
				  $toName    = strip_tags(stripslashes(trim($dataArray[0])));
				  
				  $toNameArray = explode(" ",$toName);
				  $toFname = $toNameArray[0];
				  $toLname = $toNameArray[1];
				  
				  $clsbpEmailTemplate->additionalField1	= $toFname; // receiver's name
				  $sendStatus				            = $clsbpEmailTemplate->send('INVITEFRIENDS',$emailTo,1);
				
				}
		   
			
			
	
	}
		
	



	
	function postAccount() {	

		$this->setPostVars();
		
		$this->dcl_importer_get_contacts($_GET['user'], $_GET['pass'], $_GET['provider']);
		
				
	}
}
?>
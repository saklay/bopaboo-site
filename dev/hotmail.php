<?php

include_once("bot.php");
include_once("httpr.php");

// /*
// usage:

$array = importHotmail('vasantheb@hotmail.com','music&me@84');

















echo "<pre>";
print_r($array);
echo "</pre>";










function importHotmail($email,$password)
{
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
			echo '<h1>error</h1>';
			var_dump($e);
// 			dump($e);
// 			dump($POST);
			unlink($cookieFile);
			exit;
		}
		return $returnValue;
		exit;
}
/*
##################################
###Old and deprecated function:###
##################################

set_time_limit(60);
$email = '';//set the hotmail email adress here!
$pass = '';//the password for the hotmail account
$cookie = 'cookie.txt';//path to cookie file (keep it secure!)
unlink($cookie);
$bot = new bot($cookie);
$foo = $bot->get('http://www.hotmail.com/');
$redir = $foo->getRedir();
if($redir!=false)
{
	$foo = $bot->get($redir);
	$regexp = '/value=\"([^\"]*)/i';
	preg_match_all($regexp,$foo->content,$matches);
	$value = $matches[1][0];
	$regexp = '/action=\"([^\"]*)/i';
	preg_match_all($regexp,$foo->content,$matches);
	$action = $matches[1][0];
	$foo = $bot->post(array('mspppostint'=>$value),$action);
	if($foo)
		{
		$regexp = '/action=\"([^\"]*)/i';
		preg_match_all($regexp,$foo->content,$matches);
		$action = $matches[1][0];
			$regexp='/\<input[^\>]*'.'/i';
			preg_match_all($regexp,$foo->content,$matches);
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
					case 'PPSX':
					$ppsx = $value;
					break;
					case 'PPFT':
					$ppft = $value;
					break;
				}
			}
$pwdPad = 'IfYouAreReadingThisYouHaveTooMuchFreeTime';
$pwdPad = substr($pwdPad,0,-strlen($pass));
$loginForm = array(
'PPSX'=>$ppsx,
'login'=>$email,
'passwd'=>$pass,
'LoginOptions'=>'3',
'PwdPad'=> $pwdPad,
'PPFT'=>$ppft
);
$foo = $bot->post($loginForm,$action);	
		if($foo)
		{
			$regexp = '/\"(http[^\"]*)/i';
			preg_match($regexp,$foo->content,$matches);
			if($matches[1])
			{
				$foo = $bot->get($matches[1]);	
				$redir = $foo->getRedir();
				$foo = $bot->get($redir);
				if($foo)
				{
					$a = parse_url($redir);
					$foo = $bot->get('http://'.$a['host'].'/cgi-bin/addresses');
					if($foo)
					{
					//get addresses
							$regexp = '/[a-z0-9\-\.\_]+@[a-z0-9\-\.\_]+/i';
							preg_match_all($regexp,$foo->content,$matches);
							print_r($matches);
					}
				}
				else
				{
					//False
				}
			}
			else
			{
				//False
			}
		}
	}
}

function entity($str)
{
	return htmlspecialchars($str);
}
*/
?>
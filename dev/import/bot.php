<?php
/*
//Example of use:
$bot = new bot();
$bot->cookie = "/file/to/cookies.txt"; //setting file to store cookies in
$bot->cookie = false; //setting cookies off
$url = 'http://www.google.com/';
//send request to http://www.google.com/
if($response = $bot->get($url))
{
    //got response
    if($redirect = $response->getRedir())
    {
       echo 'You have been redirected to: '.htmlspecialchars($redirect);
    }
    else
    {
       //content of response comes here:
       echo $response->content;
    }
}
else
{
   //could not connect!
}
*/

class bot
{
	var $agent='Mozilla/5.0 (Windows; U; Windows NT 5.1; da-DK; rv:1.7.12) Gecko/20050919 Firefox/1.0.7';
	var $dataBuffer;
	var $cookie;
	
	function bot($cookie=false)
	{
		$this->cookie = $cookie;
	}
	
	function post ($data, $url, $timeout=30) {
		if(!is_array($data))
		{
			$temp = $data;
			$data = $url;
			$url = $temp;
		}
	  $url_array = parse_url($url);
	  $query = "";
	
	  foreach ($data as $key => $value) {
	    if ($query) $query .= "&";
	    $query.= $key."=".urlencode($value);
	  }
	
	  $len = strlen($query);
	
	$out = "POST ".($url_array["path"]? $url_array["path"]:'/')."?".$url_array["query"]." HTTP/1.1\r\n";
		$out .= "Host: ".$url_array['host']."\r\n";
		 $out .= "User-Agent: ".$this->agent."\r\n";
		 $out .= "Accept: application/x-shockwave-flash,text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\r\n";
		 $out .= "Accept-Language: en-us,en;q=0.5\r\n";
//		 $out .= "Accept-Encoding: gzip,deflate\r\n";
		 $out .= "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\n";
//		 $out .= "Keep-Alive: 300\r\n";

	   $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
	   $out .= "Connection: Close\r\n";
	   $out .=  "Content-Length: $len\r\n\r\n";
	   $out .= "$query\r\n";
	   
	   $ch = curl_init();
	   if($this->cookie)
	   {
	 		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
   		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
     		}
	 curl_setopt($ch, CURLOPT_URL,$url);
   curl_setopt($ch, CURLOPT_VERBOSE, 1);
	 curl_setopt($ch, CURLOPT_HEADER, 1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//   curl_setopt($ch,CURLOPT_HTTPHEADER,array($cookie));
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt ($ch, CURLOPT_POST, 1);
	 curl_setopt ($ch, CURLOPT_POSTFIELDS, $query);
	 curl_setopt($ch,CURLOPT_USERAGENT,$this->agent);
   $returned = curl_exec($ch);
	  if (!$returned) {
	    return false;
	  } else {
	    $response = new httpResponse($url,$returned);
	    return $response;
	  }
	
	}
	
	function get($url,$timeout=30,$follow=0)
	{
		$url_array = parse_url($url);
	  $query = "";
	
	  $len = strlen($query);
	  $path = $url_array['path'];
	  if($url_array['query'])
	  {
	  	$path .= '?'.$url_array['query'];
	  }
	   $out = "GET ".$path." HTTP/1.1\r\n";
	   $out .= "Host: ".$url_array['host']."\r\n";
		 $out .= "User-Agent: ".$this->agent."\r\n";
		 $out .= "Accept: application/x-shockwave-flash,text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\r\n";
		 $out .= "Accept-Language: en-us,en;q=0.5\r\n";
		 $out .= "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\n";
	   $out .= "Connection: Close\r\n";
	   $ch = curl_init();
	   if($this->cookie)
	   {
			 curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
		   curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
		 }
   curl_setopt($ch, CURLOPT_URL,$url);
   curl_setopt($ch, CURLOPT_VERBOSE, 1);
	 curl_setopt($ch, CURLOPT_HEADER, 1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	 curl_setopt($ch,CURLOPT_USERAGENT,$this->agent);
	 curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);
   $returned = curl_exec($ch);
   curl_close ($ch);
	  if ($returned == "") {
	    return false;
	  } else {
	    $response = new httpResponse($url,$returned);
	    if($follow)
	    {
	    	$follow--;
    		if($redir = $response->getRedir())
	  		$response = $this->get($redir,$timeout,$follow);
	    }
	    return $response;
	  }
	}
}
?>
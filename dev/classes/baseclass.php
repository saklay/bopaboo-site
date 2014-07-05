<?php

/**
  * Contact Grabber
  * Version 0.4
  * Released 8th January, 2008
  * Author: Magnet Technologies, vishal.kothari@magnettechnologies.com
  * Credits: Jatin Dwivedi, Jignesh Patel, Kajal Goziya, Nimesh Shah, Twinkle Panchal
  * Copyright (C) 2008

  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.

  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.

  * You should have received a copy of the GNU General Public License
  * along with this program; if not, write to the Free Software
  * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
  **/

	class baseFunction
	{		
		#read_header is essential as it processes all cookies and keeps track of the current location url
		#leave unchanged, include it with getAddressbook
		# Used in GMail
		function read_header($ch, $string)
		{
		   global $location;
		   global $cookiearr;
		   global $ch;
		   
		   $length = strlen($string);
		   if(!strncmp($string, "Location:", 9))
		   {
		     $location = trim(substr($string, 9, -1));
		   }
		   if(!strncmp($string, "Set-Cookie:", 11))
		   {
		     $cookiestr = trim(substr($string, 11, -1));
		     $cookie = explode(';', $cookiestr);
		     $cookie = explode('=', $cookie[0]);
		     $cookiename = trim(array_shift($cookie)); 
		     $cookiearr[$cookiename] = trim(implode('=', $cookie));
		   }
		   $cookie = "";
		   if(trim($string) == "" && !empty($cookiearr)) 
		   {
		     foreach ($cookiearr as $key=>$value)
		     {
		       $cookie .= "$key=$value; ";
		     }
		     curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		   }
		
		   return $length;
		}
		
		# Used in GMail
	    function splitPage($response,$header,$body)
	    {
	    	$totalLength=strlen($response);
	        $pos=strpos($response,'<html>');
	        $header = substr($response,0,$pos);
	        $body =substr($response,$pos,$totalLength-1);
	        $body=str_replace("\n","",$body);
	        $body=str_replace("\r","",$body);
	        $body = str_replace(" ","",$body);
	    }
	    
	    # Used in GMail
	    function getCookies($header)
	    { 
	    	$cookies=array();
	        $cookie=""; 
	        $returnar=explode("\r\n",$header);
	        for($ind=0;$ind<count($returnar);$ind++) 
	        {
	        	if(ereg("Set-Cookie: ",$returnar[$ind]) || ereg("Cookies ",$returnar[$ind])) 
	           	{
	            	$cookie=str_replace("Set-Cookie: ","",$returnar[$ind]);
	                $cookie=explode(";",$cookie);
	                $cookies[trim($cookie[0])]=trim($cookie[0]);
	            }
			}
	            
	        $cookie=array();
	        foreach ($cookies as $key=>$value)
	        {
	        	array_push($cookie,"$value");
			}
	        $cookie=implode(";",$cookie);
	        return $cookie; 
	    }       
	    
	    # Used in GMail
	    function getLocation($header)
	    {
	    	$returnar=explode("\r\n",$header);
	        for($ind=0;$ind<count($returnar);$ind++) 
	        {
	        	if(ereg("Location: ",$returnar[$ind])) 
	            {
					$location=str_replace("Location: ","",$returnar[$ind]);
	                $location = trim($location);
	                break;
	            }

	            $this->splitPage($response, &$header, &$body);
	            $cookies_phase1 =$this->getCookies($header);
	        }
	        return $location;
	    }
	    
	}

?>

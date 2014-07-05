<?php
class httpResponse
{
	var $url;
	var $raw;
	var $headers = array();
	var $content;
	
	function httpResponse($url,$raw)
	{
		$this->url = $url;
		$this->raw = $raw;
		//Parse response
//		echo htmlspecialchars($raw);
		$raw = explode("\r\n\r\n",$raw,2);
		$content = explode("\n",$raw[1],2);
		$this->headers = explode("\n",$raw[0]);
		$this->content = $raw[1];//substr(trim($content[1]),0,-2);
	}
	
	function getRedir()
	{
		foreach($this->headers as $k => $v)
		{
			if(substr(strtolower($v),0,9)=='location:')
			{
				$str = trim(substr($v,9));
				$a = parse_url($str);
				if($a['host']=="")
				{
					$a1 = parse_url($this->url);
					if(substr($str,0,2)=='./')
					{
						$str = '/'.substr($str,2);
					}
					if(substr($str,0,1)=='/')
					{
						$str = $a1['scheme'].'://'.$a1['host'].$str;
						$this->content = '';
						return $str;
					}
					else
					{
						if(strpos($str,'/')!==false)
						{
							$regexp = '/[^\/]+$/i';
							$foo = preg_replace($regexp,'',$str);
						}	
						else
						{
							$foo = $str;
						}
						if($foo == "")
						{
							$foo = "/";
						}
						if(substr($a1['path'],-1)!='/'&&substr($foo,0,1)!='/')
						{
							$dirs = explode('/',$a1['path']);
		//					print_r($dirs);
							$dirs[(count($dirs)-1)]="";
							
							$dirPath = implode('/',$dirs);
							$dirPath = str_replace('//','',$dirPath);
							if($dirPath=="")
							{
								$dirPath = '/';
							}
	//						echo '<h2>'.$dirPath.'</h2><br>';
//						echo '<span style="color:red;">'.$foo.'</span><br>';
							$foo = $dirPath.''.$foo;
							$redir = $a1['scheme'].'://'.$a1['host'].$foo;;
//				echo '<span style="color:blue;font-weight:bold;">2.1: '.$redir.' / '.$v.' / '.$this->url.'</span><br>';
							return $redir;
						}
						
						if(substr($a1['path'],-1)=='/'&&substr($foo,0,1)=='/')
						{
		//					echo '<span style="color:green;font-weight:bold;">BAH: '.$foo.'</span><br>';
							$foo = substr($foo,1);
						}
						$str = $a1['scheme'].'://'.$a1['host'].$a1['path'].$foo;
						$this->content = '';
//				echo '<span style="color:blue;font-weight:bold;">2: '.$str.' / '.$v.' / '.$this->url.'</span><br>';
						return $str;
					}
				}
				return $str;
			}
		}
		return false;
	}
	
	function getBase()
	{
		$doc = new DOMDocument();
		@$doc->loadHTML($this->content);
		$base = false;
		$bases = $doc->getElementsByTagName('base');
		if($bases->length>0)
		{
			$base = $bases->item(0);
			$base = $base->getAttribute('href');
			return $base;
		}
		if(!$base)
		{
			$data = parse_url($this->url);
			$path = $data['path'];
			$base = $data['scheme'].'://'.$data['host'];
			if(strlen(dirname($path))>1)
				$base .= dirname($path).'/';
			else
				$base .= '/';
			return $base;
		}
	}
	
	function calcUrl($url)
	{
		if($url[0]=='/')
		{
			$data = parse_url($url);
			$url = $data['scheme'].'://'.$data['host'].$data['path'];
			if($data['query'])
				$url .= '?'.$data['query'];
			return $url;
		}
		elseif(strtolower(substr($url,0,7))=='http://')
		{
			return $url;
		}
		$base = $this->getBase();
		return $base.$url;
	}
	
	
	function getEncoding()
	{
		foreach($this->headers as $k => $v)
		{
			if(substr(strtolower($v),0,17)=='content-encoding:')
			{
				$str = trim(substr($v,17));
				return $str;
			}
		}
		return false;
	}
}
?>
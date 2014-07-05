<?php
class clsbpEmail {

    var $to 		= array();
    var $cc 		= array();
    var $bcc 		= array();
    var $attachment = array();
    var $boundary 	= "";
    var $header 	= "";
    var $subject 	= "";
    var $body 		= "";
	var $html 		= 0;
	var $maxWords 	= 150;

	var $FromEmail 	= "";
	var $emailMode;
	var $priority;

    function clsbpEmail($FromEmail,$FromName,$subject,$htmlFormat='0')  {
		#$this->FromEmail=$FromEmail; 
        $this->boundary = md5(uniqid(time()));
        $this->header .= "From: $FromEmail\r\n";
		$this->subject = $subject;

		if($htmlFormat == 1) 
			$this->html = 1;				
		else 
			$this->html = 0;
		
		$this->emailMode	= constant("EMAIL_MODE");
		$this->priority		= "";
    }

    function to($mail) {
	
    	$this->to[] = $mail;
    }

    function cc($mail) {
	
    	$this->cc[] = $mail;
    }

    function bcc($mail) {
	
    	$this->bcc[] = $mail;
    }

    function attachment($file) {
	
		$this->attachment[] = $file;
    }

	function setBody($body, $convert2Text='0') {
	
		$this->body = $body;
		
		if($convert2Text == 1) {
			$this->body = $this->html2text($this->body) ;
		}
	}	
	
	function send() {
        # CC 
		if ($this->emailMode == "LIVE") {
        	$max = count($this->cc);
	        if($max>0) {
            	$this->header .= "Cc: ".$this->cc[0];
			
            	for($i=1;$i<$max;$i++) {
	                $this->header .= ", ".$this->cc[$i];
    	        }
        	    $this->header .= "\r\n";
        	}
			
        	# BCC 
        	$max = count($this->bcc);
			if($max>0) {
	            $this->header .= "Bcc: ".$this->bcc[0];
			
            	for($i=1;$i<$max;$i++) {
                	$this->header .= ", ".$this->bcc[$i];
            	}
            	$this->header .= "\r\n";
        	}		
		}
		
		$this->header .= 'X-Mailer: PHP/'.phpversion()."\r\n";
        $this->header .= "MIME-Version: 1.0\r\n";

		if($this->html == 1) {
			$this->header .= "Content-Type: text/html; charset=iso-8859-1\r\n";
		}

        # Attachment 
        $max = count($this->attachment);
        if($max>0)
        {
            for($i=0;$i<$max;$i++)
            {
                $file = fread(fopen($this->attachment[$i], "r"), filesize($this->attachment[$i]));
                $this->header .= "--".$this->boundary."\n";
                $this->header .= "Content-Type: application/x-zip-compressed; name=".$this->attachment[$i]."\r\n";
                $this->header .= "Content-Transfer-Encoding: base64\n";
                $this->header .= "Content-Disposition: attachment; filename=".$this->attachment[$i]."\r\n";
                $this->header .= chunk_split(base64_encode($file))."\r\n";
                $file = "";
            }
        }
        foreach($this->to as $mail) {
			if ($this->emailMode != "LIVE") {
				$mail			= constant("TEST_EMAIL"); 
				$this->subject	= "[TEST EMAIL]: ".$this->subject;
				$this->body		= "NOTE: This email was originally sent to ".implode($this->to).", Cc'ed to ".implode($this->cc)." and Bcc'ed to ".implode($this->bcc).". This has been redirected to ".constant("TEST_EMAIL")." since the email is set to TEST mode.\r\n".$this->body."\r\n";
			}

			if ($this->priority != "") { 
				if ($this->priority == "1-H") 
					$this->header .= "X-Priority: 1\r\n";
				else
					$this->header .= "X-Priority: 4\r\n";
			}
            $status = mail($mail, $this->subject, $this->body, $this->header);

/*
			echo "<br>mail-> ".$mail;
			echo "<br>subject-> ".$this->subject;
			echo "<br>body-> ".$this->body;
			echo "<br>header-> ".$this->header;
			echo "<br>status	".$status;
			exit;
*/			
        }
		unset($this->to);  # clear the array
		return $status;
		
    }
	
#function to convert html format into text format
	function html2text( $badStr ) {
		#remove PHP if it exists
		while( substr_count( $badStr, '<'.'?' ) && substr_count( $badStr, '?'.'>' ) && strpos( $badStr, '?'.'>', strpos( $badStr, '<'.'?' ) ) > strpos( $badStr, '<'.'?' ) ) {
			$badStr = substr( $badStr, 0, strpos( $badStr, '<'.'?' ) ) . substr( $badStr, strpos( $badStr, '?'.'>', strpos( $badStr, '<'.'?' ) ) + 2 ); }
		#remove comments
		while( substr_count( $badStr, '<!--' ) && substr_count( $badStr, '-->' ) && strpos( $badStr, '-->', strpos( $badStr, '<!--' ) ) > strpos( $badStr, '<!--' ) ) {
			$badStr = substr( $badStr, 0, strpos( $badStr, '<!--' ) ) . substr( $badStr, strpos( $badStr, '-->', strpos( $badStr, '<!--' ) ) + 3 ); }
		#now make sure all HTML tags are correctly written (> not in between quotes)
		for( $x = 0, $goodStr = '', $is_open_tb = false, $is_open_sq = false, $is_open_dq = false; strlen( $chr = $badStr{$x} ); $x++ ) {
			#take each letter in turn and check if that character is permitted there
			switch( $chr ) {
				case '<':
					if( !$is_open_tb && strtolower( substr( $badStr, $x + 1, 5 ) ) == 'style' ) {
						$badStr = substr( $badStr, 0, $x ) . substr( $badStr, strpos( strtolower( $badStr ), '</style>', $x ) + 7 ); $chr = '';
					} elseif( !$is_open_tb && strtolower( substr( $badStr, $x + 1, 6 ) ) == 'script' ) {
						$badStr = substr( $badStr, 0, $x ) . substr( $badStr, strpos( strtolower( $badStr ), '</script>', $x ) + 8 ); $chr = '';
					} elseif( !$is_open_tb ) { $is_open_tb = true; } else { $chr = '&lt;'; }
					break;
				case '>':
					if( !$is_open_tb || $is_open_dq || $is_open_sq ) { $chr = '&gt;'; } else { $is_open_tb = false; }
					break;
				case '"':
					if( $is_open_tb && !$is_open_dq && !$is_open_sq ) { $is_open_dq = true; }
					elseif( $is_open_tb && $is_open_dq && !$is_open_sq ) { $is_open_dq = false; }
					else { $chr = '&quot;'; }
					break;
				case "'":
					if( $is_open_tb && !$is_open_dq && !$is_open_sq ) { $is_open_sq = true; }
					elseif( $is_open_tb && !$is_open_dq && $is_open_sq ) { $is_open_sq = false; }
			} $goodStr .= $chr;
		}
		#now that the page is valid (I hope) for strip_tags, strip all unwanted tags
		$goodStr = strip_tags( $goodStr, '<title><hr><h1><h2><h3><h4><h5><h6><div><p><pre><sup><ul><ol><br><dl><dt><table><caption><tr><li><dd><th><td><a><area><img><form><input><textarea><button><select><option>' );
		#strip extra whitespace except between <pre> and <textarea> tags
		$badStr = preg_split( "/<\/?pre[^>]*>/i", $goodStr );
		for( $x = 0; is_string( $badStr[$x] ); $x++ ) {
			if( $x % 2 ) { $badStr[$x] = '<pre>'.$badStr[$x].'</pre>'; } else {
				$goodStr = preg_split( "/<\/?textarea[^>]*>/i", $badStr[$x] );
				for( $z = 0; is_string( $goodStr[$z] ); $z++ ) {
					if( $z % 2 ) { $goodStr[$z] = '<textarea>'.$goodStr[$z].'</textarea>'; } else {
						$goodStr[$z] = preg_replace( "/\s+/", ' ', $goodStr[$z] );
				} }
				$badStr[$x] = implode('',$goodStr);
		} }
		$goodStr = implode('',$badStr);
		#remove all options from select inputs
		$goodStr = preg_replace( "/<option[^>]*>[^<]*/i", '', $goodStr );
		#replace all tags with their text equivalents
		$goodStr = preg_replace( "/<(\/title|hr)[^>]*>/i", "\n          --------------------\n", $goodStr );
		$goodStr = preg_replace( "/<(h|div|p)[^>]*>/i", "\n\n", $goodStr );
		$goodStr = preg_replace( "/<sup[^>]*>/i", '^', $goodStr );
		$goodStr = preg_replace( "/<(ul|ol|br|dl|dt|table|caption|\/textarea|tr[^>]*>\s*<(td|th))[^>]*>/i", "\n", $goodStr );
		$goodStr = preg_replace( "/<li[^>]*>/i", "\n� ", $goodStr );
		$goodStr = preg_replace( "/<dd[^>]*>/i", "\n\t", $goodStr );
		$goodStr = preg_replace( "/<(th|td)[^>]*>/i", "\t", $goodStr );
		$goodStr = preg_replace( "/<a[^>]* href=(\"((?!\"|#|javascript:)[^\"#]*)(\"|#)|'((?!'|#|javascript:)[^'#]*)('|#)|((?!'|\"|>|#|javascript:)[^#\"'> ]*))[^>]*>/i", "", $goodStr );
		$goodStr = preg_replace( "/<img[^>]* alt=(\"([^\"]+)\"|'([^']+)'|([^\"'> ]+))[^>]*>/i", "[IMAGE: $2$3$4] ", $goodStr );
		$goodStr = preg_replace( "/<form[^>]* action=(\"([^\"]+)\"|'([^']+)'|([^\"'> ]+))[^>]*>/i", "\n", $goodStr );
		$goodStr = preg_replace( "/<(input|textarea|button|select)[^>]*>/i", "", $goodStr );
		#strip all remaining tags (mostly closing tags)
		$goodStr = strip_tags( $goodStr );
		#convert HTML entities
		$goodStr = strtr( $goodStr, array_flip( get_html_translation_table( HTML_ENTITIES ) ) );
		preg_replace( "/&#(\d+);/me", "chr('$1')", $goodStr );
		#wordwrap
		$this->html == 1 ? $breakChar ="<br>" : $breakChar = "\n" ;
		
		//$goodStr = wordwrap($goodStr,$this->maxWords,$breakChar,1);
		
		#make sure there are no more than 3 linebreaks in a row and trim whitespace
		return preg_replace( "/^\n*|\n*$/", '', preg_replace( "/[ \t]+(\n|$)/", "$1", preg_replace( "/\n(\s*\n){2}/", "\n\n\n", preg_replace( "/\r\n?|\f/", "\n", str_replace( chr(160), ' ', $goodStr ) ) ) ) );
	}
	
}
?>
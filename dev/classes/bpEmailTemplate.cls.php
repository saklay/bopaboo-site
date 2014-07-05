<?php 
	class clsbpEmailTemplate extends clsbpBase{ 

		var $emailContext;
		var $sendTo;
		var $sendFrom;
		var $sendCc;
		var $sendBcc;
		var $sendSubject;
		var $sendMessage;
		var $messageContent;
		
		var $sendAs;
			
		var $firstName;
		var $lastName;
		
		var $additionalField1;
		var $additionalField2;
		var $additionalField3;
		var $additionalField4;
		var $additionalField5;
		var $additionalField6;
		var $additionalField7;
		
		var $priority;
		var $action;
		var $includePath;
		function clsbpEmailTemplate() {			
			$this->sendAs			= 0;		// 0 - Plain; 1 - HTML
			$this->emailContext		= "";
			$this->sendTo			= "";
			$this->sendFrom			= constant("BPFROMMAILID");
			$this->sendCc			= "";
			$this->sendBcc			= "";
			$this->sendSubject		= "bopabooMail";
			$this->sendMessage		= "";
			$this->messageContent	= "";
			$this->priority			= "";
			
			$this->includePath		= "";
		}

		function setPostVars() {	

			parent::setPostVars();	

			if (isset($_POST['clsbpEmailTemplate_sendFrom']))			$this->sendFrom			= trim($_POST['clsbpEmailTemplate_sendFrom']);
			if (isset($_POST['clsbpEmailTemplate_sendTo']))				$this->sendTo			= trim($_POST['clsbpEmailTemplate_sendTo']);
			if (isset($_POST['clsbpEmailTemplate_sendSubject']))		$this->sendSubject		= trim($_POST['clsbpEmailTemplate_sendSubject']);
			if (isset($_POST['clsbpEmailTemplate_sendMessage']))		$this->sendMessage		= trim($_POST['clsbpEmailTemplate_sendMessage']);
			if (isset($_POST['clsbpEmailTemplate_sendAs']))				$this->sendAs			= trim($_POST['clsbpEmailTemplate_sendAs']);			
			if (isset($_POST['clsbpEmailTemplate_action']))				$this->action			= trim($_POST['clsbpEmailTemplate_action']);			
		}

		function setGetVars() {

		}
		
		function send($emailContext, $sendTo, $sendAs){
			
			$this->emailContext	= $emailContext;
			$this->sendTo		= $sendTo;
			$this->sendAs		= $sendAs;
			
			$send	= $this->sendEmail();
		}
		
		
		
		function sendEmail(){
		
			$objEmail;
			$fileName;
			$objEmail	= new clsbpEmail($this->sendFrom,constant("BPFROMNAME"),$this->sendSubject,$this->sendAs);
					
				if($this->sendAs == 0){
					$fileName	= $this->emailContext.".plain";
				}
				else if($this->sendAs == 1){
					$fileName	= $this->emailContext.".html";
				}
				$objEmail->to[] 		= $this->sendTo;
				if($this->sendCc !="")
				$objEmail->cc[]			= $this->sendCc;
				if($this->sendBcc !="")
				$objEmail->bcc[]		= $this->sendBcc;
				$objEmail->subject		= $this->sendSubject;
			
				$objEmail->body			=
				$this->parseMessage($this->includePath."./emailtemplates/".$fileName);
				
				if($this->priority != "") // added to set priority symbol for task manager
					$objEmail->priority		= $this->priority;
				if (file_exists($this->includePath."./emailtemplates/".$fileName)) 
					$sendEmail		= $objEmail->send();		
		}	
		
		function parseMessage($fileName){
			$handle		= fopen($fileName,'r');
			
			$len		= filesize($fileName);
			$contents	= fread($handle, $len);
			fclose($handle);
			if ($this->emailContext == "FEEDBACK")
				$contents	= str_replace("{firstName}",$this->additionalField8,$contents);
			else
				$contents	= str_replace("{firstName}",$this->firstName,$contents);
			$contents	= str_replace("{lastName}",$this->lastName,$contents);
			$contents	= str_replace("{additionalField1}",$this->additionalField1,$contents);
			$contents	= str_replace("{additionalField2}",$this->additionalField2,$contents);
			$contents	= str_replace("{additionalField3}",$this->additionalField3,$contents);
			$contents	= str_replace("{additionalField4}",$this->additionalField4,$contents);
			$contents	= str_replace("{messageContent}",$this->messageContent,$contents);

			return $contents;
			
		}
		
}
?>
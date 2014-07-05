<?php
/*******************************************************************
/ Title: Messaging System Class
/ Purpose: This file is used for handelling the internal messaging system.
/ 
/ Inputs:   
			
/ Outputs:  
/           

/ Authors: BL Team for Bopaboo
/*******************************************************************/
class clsbpMessages extends clsbpBase {
	
	var $nMessageId;		
	var $nMessageToId;		
	var $nMessageFromId;		
	var $strSubject;
	var $strMessage ;
	var $dtSentDate;
	var $nReceived;
	var $userId;
	
	var $action;
	
	var $newToId;  // Used when a new contact to request occures (like from contact link in the view file details page)
	var $returnUrl;
	var $strDisplayName;
	
	var $msgIds;
	var $msgId;
	var $delFlag; // It is used to identify where the delete is being taking place; if 0 inbox, if 1 outbox
	
	var $sortColumn;
	var $sortDirection;
	var $pageSize;
	var $rangeVal;
	var $includePath;
	var $pageIndex;
	var $flagFromOutbox;
	
	function clsbpMessages($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpMessages");			
		
 		$this->nMessageId = 0;
 		$this->nMessageToId = 0;
 		$this->nMessageFromId = 0;
 		$this->strSubject = "No Subject";
 		$this->strMessage = "";
 		$this->dtSentDate = "";
 		$this->nReceived = 0;
 		$this->userId = 0;
 		$this->newToId = 0;
 		$this->action = "";
 		$this->returnUrl ="";
 		$this->strDisplayName = "";
  		$this->msgIds = "";
  		$this->msgId = "";
  		$this->delFlag="";
  		$this->reSubject="";
  		
  		$this->sortColumn		= "dt_SentDate";
		$this->sortDirection    = "DESC";
		$this->pageSize				= 10;
		$this->rangeVal				= constant("BPRANGEVAL");
		$this->pageIndex =  "";
		$this->includePath =  "";
		$this->flagFromOutbox="";
	}
	
	function setPostVars() {	
		parent::setPostVars();	
		if (isset($_POST['clsbpMessages_messageId']))  $this->nMessageId		= $_POST['clsbpMessages_messageId'];
		if (isset($_POST['clsbpMessages_toId']))  $this->nMessageToId			= $_POST['clsbpMessages_toId'];
		if (isset($_POST['clsbpMessages_fromId']))  $this->nMessageFromId		= $_POST['clsbpMessages_fromId'];
		if (isset($_POST['clsbpMessages_messageSubject']) && ($_POST['clsbpMessages_messageSubject']!=''))  $this->strSubject	= $_POST['clsbpMessages_messageSubject'];
		if (isset($_POST['clsbpMessages_messageContent']))  $this->strMessage	= $_POST['clsbpMessages_messageContent'];
		if (isset($_POST['clsbpMessages_sentDate']))  $this->dtSentDate	= $_POST['clsbpMessages_sentDate'];
		if (isset($_POST['clsbpMessages_readMessage']))  $this->nReceived		= $_POST['clsbpMessages_readMessage'];
		if (isset($_POST['clsbpMessages_newToId']))  $this->newToId		= $_POST['clsbpMessages_newToId'];
		
		if (isset($_POST['clsbpMessages_delIds']))  $this->msgIds		= $_POST['clsbpMessages_delIds'];  // For multiple files
		if (isset($_POST['clsbpMessages_delId']))  $this->msgId		= $_POST['clsbpMessages_delId'];
		if (isset($_POST['clsbpMessages_delFlag']))  $this->delFlag		= $_POST['clsbpMessages_delFlag'];
		if (isset($_POST['clsbpMessages_replySubject']))  $this->reSubject		= $_POST['clsbpMessages_replySubject'];
		if (isset($_POST['clsbpMessages_chkIfFromOutbox']))  $this->flagFromOutbox		= $_POST['clsbpMessages_chkIfFromOutbox'];
		
	}

	function setGetVars() {

		parent::setGetVars();	
		if (isset($_GET['clsbpMessages_messageId']))  $this->nMessageId		= $_GET['clsbpMessages_messageId'];
		if (isset($_GET['clsbpMessages_toId']))  $this->nMessageToId			= $_GET['clsbpMessages_toId'];
		if (isset($_GET['clsbpMessages_fromId']))  $this->nMessageFromId		= $_GET['clsbpMessages_fromId'];
		if (isset($_GET['clsbpMessages_messageSubject']) && ($_GET['clsbpMessages_messageSubject']!=''))  $this->strSubject	= $_GET['clsbpMessages_messageSubject'];
		if (isset($_GET['clsbpMessages_messageContent']))  $this->dtSentDate	= $_GET['clsbpMessages_messageContent'];
		if (isset($_GET['clsbpMessages_readMessage']))  $this->nReceived		= $_GET['clsbpMessages_readMessage'];
		if (isset($_GET['clsbpMessages_newToId']))  $this->newToId			= $_GET['clsbpMessages_newToId'];
		
		if (isset($_GET['clsbpMessages_delIds']))  $this->msgIds		= $_GET['clsbpMessages_delIds'];
		if (isset($_GET['clsbpMessages_delFlag']))  $this->delFlag		= $_GET['clsbpMessages_delFlag'];
		
		if (isset($_GET['clsbpMessages_replySubject']))  $this->reSubject		= $_GET['clsbpMessages_replySubject'];
		if (isset($_GET['clsbpMessages_chkIfFromOutbox']))  $this->flagFromOutbox		= $_GET['clsbpMessages_chkIfFromOutbox'];
	}	
	
	function getMemberSentHistory() {
		$this->userId = $_SESSION['USERID'];
		$query 	= "	SELECT 
						tbl_mem_login.bi_MemberId,
						tbl_mem_login.vc_DisplayName
					FROM 
						tbl_mem_login
							INNER JOIN 
								tbl_messages 
							ON 
								tbl_mem_login.bi_MemberId = tbl_messages.`bi_ToId`
					WHERE tbl_messages.bi_FromId = ". $this->userId;
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveMessageArray($dbQry);
	}
	
	function getMemberReceivedHistory() {
		$this->userId = $_SESSION['USERID'];
		$query 	= "	SELECT 
						tbl_mem_login.bi_MemberId,
						tbl_mem_login.vc_DisplayName
					FROM 
						tbl_mem_login
							INNER JOIN 
								tbl_messages 
							ON 
								tbl_mem_login.bi_MemberId = tbl_messages.`bi_FromId`
					WHERE tbl_messages.bi_ToId = ". $this->userId;
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveMessageArray($dbQry);
	}
	
	function getNewContactDetails($newContactId) {
		$query 	= "	SELECT 
						bi_MemberId,
						vc_DisplayName
					FROM 
						tbl_mem_login
					WHERE bi_MemberId = ". $newContactId;
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveMessageArray($dbQry);
	}
	
	
	
	function retrieveMessageArray($dbQry) {
	
		$arrMessages	= array();
		while($row  = $dbQry->getArray()) {
			$arrMessages[]	= array(
												"bi_MemberId"	    => $row["bi_MemberId"],	
												"vc_DisplayName"	    => $row["vc_DisplayName"],
												);
		}
		return $arrMessages;
	}
	
	function sendMessage() {
			$this->dtSentDate = date('Y-m-d H:i:s');
			
			$query = "INSERT INTO
						tbl_messages
					 VALUES
					 	('',
					 	$this->nMessageFromId,
					 	$this->nMessageToId,
					 	'$this->strSubject',
					 	'$this->strMessage',
					 	'$this->dtSentDate',
					 	0,
					 	0,
					 	0
					 	)
					";
			$dbQry	= new dbQuery($query, $this->connect->connId);
			return 1;
	}
	
	function getMessageList() {
		$query = "SELECT * FROM 
					tbl_mem_login
				INNER JOIN 
					tbl_messages 
				ON
					tbl_mem_login.bi_MemberId = tbl_messages.`bi_FromId`	
				WHERE 
						tbl_messages.ti_inboxDel <>1
							AND
						tbl_messages.bi_ToId =". $_SESSION['USERID']. " ORDER BY dt_SentDate DESC";
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);
		return $this->retrieveMessageRowArray($this->clsbpPaginate);
	}
	
	function retrieveMessageRowArray($dbQry) {
	
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_MessageId"]]	= array(
												"bi_MessageId"	    => $row["bi_MessageId"],	
												"bi_FromId"	    => $row["bi_FromId"],
												"bi_ToId"	    => $row["bi_ToId"],
												"vc_Subject"	    => $row["vc_Subject"],
												"display_name"	    => $row["vc_DisplayName"],	
											   	 "lt_Message"	    => $row["lt_Message"],
												"dt_SentDate"		=> $row["dt_SentDate"],
												"ti_received"	=> $row["ti_received"]
												);
		}			
		return $arrFile;
	}
	
	function getMessageSentList() {
		$query = "SELECT * FROM 
					tbl_mem_login
				INNER JOIN 
					tbl_messages 
				ON
					tbl_mem_login.bi_MemberId = tbl_messages.`bi_FromId`	
				WHERE 
						tbl_messages.ti_outboxDel <>1
							AND
						tbl_messages.bi_FromId =". $_SESSION['USERID']. " ORDER BY dt_SentDate DESC";
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);
		return $this->retrieveMessageRowArray($this->clsbpPaginate);
	}
	
	function getNewMessageSentCount() {
		$query = "SELECT * FROM 
					tbl_mem_login
				INNER JOIN 
					tbl_messages 
				ON
					tbl_mem_login.bi_MemberId = tbl_messages.`bi_ToId`	
				WHERE 
						tbl_messages.bi_ToId =". $_SESSION['USERID']. " AND tbl_messages.ti_received = 0 ORDER BY dt_SentDate DESC";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		return $dbQry->numRows();
	}
	
	
	function getMessagesDetails($mesageId) {
		$query = "SELECT * FROM 
					tbl_mem_login
				INNER JOIN 
					tbl_messages 
				ON
					tbl_mem_login.bi_MemberId = tbl_messages.`bi_FromId`	
				WHERE 
						tbl_messages.bi_MessageId =". $mesageId;
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveMessageRow($dbQry);
	}
	
	
	
	function retrieveMessageRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row				= $dbQry->getArray();
		$this->strDisplayName = $row['vc_DisplayName'];
		$this->nMessageId = $row['bi_MessageId'];
 		$this->nMessageToId = $row['bi_ToId'];
 		$this->nMessageFromId = $row['bi_FromId'];
 		$this->strSubject = $row['vc_Subject'];
 		$this->strMessage = $row['lt_Message'];
 		$this->dtSentDate = $row['dt_SentDate'];
 		$this->nReceived = $row['ti_received'];
			
		return 1;
	}
	
	function getUserName($frmId) {
		$query = "SELECT * FROM 
					tbl_mem_login
				WHERE 
					bi_MemberId =". $frmId;
		$dbQry	= new dbQuery($query, $this->connect->connId);
		if(!$dbQry->numRows()) return 0;
		$row				= $dbQry->getArray();
		return $row['vc_DisplayName'];
	}
	
	function setMessageAsRead() {
		$query 	= "UPDATE
						tbl_messages 
					SET
						ti_received = 1	
					WHERE 
						tbl_messages.bi_MessageId =". $this->nMessageId;
		$dbQry	= new dbQuery($query, $this->connect->connId);	
 	}
 	
 	function deleteMessages() {
 		if($this->delFlag == 0) {
 			$condn = "ti_inboxDel = 1";
 		}
 		else if($this->delFlag == 1) {
 			$condn = "ti_outboxDel = 1";
 		}
 		
 		$arrDel = explode(",",$this->msgIds);
 		
 		foreach($arrDel as $val) {
 			$query = "UPDATE
 						tbl_messages
 					 SET
 					 	$condn
 					 	
 					 WHERE
 					 	bi_MessageId = $val
 					";
 			$dbQry	= new dbQuery($query, $this->connect->connId);
 		}
 	}
 	
 	function deleteMessage() {
 		
 		if($this->delFlag == 0) {
 			$condn = "ti_inboxDel = 1";
 		}
 		else if($this->delFlag == 1) {
 			$condn = "ti_outboxDel = 1";
 		}
 	
 		$query = "UPDATE
 						tbl_messages
 					 SET
 					 	$condn
 					 	
 					 WHERE
 					 	bi_MessageId = $this->msgId
 					";
 		$dbQry	= new dbQuery($query, $this->connect->connId);
 	}

	
	function postMessages() {
		
		if($this->action == "SENDMSG") {
			if($this->sendMessage() > 0){
				$_SESSION['BPMESSAGE'] = "Your message has been sent";
				$this->action = "";
				header("location:".stripslashes($this->includePath.$this->returnUrl));				
				exit();
			
			}
		}
		
		if($this->action == "DELETEM") {
			$this->deleteMessages();
		}
		if($this->action == "DELETES") {
			$this->deleteMessage();
		}
		
		if(($this->action == "") && ($this->nMessageId!='')) {
			$this->getMessagesDetails($this->nMessageId);
		}
		
	}
}

?>
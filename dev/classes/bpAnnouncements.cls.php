<?php
/*******************************************************************
/ Title: Announcements Class
/ Purpose: This file is used for handelling the Site Announcements. Mainly used from the Admin section.
/ 
/ Inputs:   
			
/ Outputs:  
/           

/ Authors: BL Team for Bopaboo
/*******************************************************************/
class clsbpAnnouncements extends clsbpBase {
	
	var $nAnnId;		
	var $strSubject;
	var $strAnnouncement;
	var $nMemberId ;
	var $dtInsertedDate;
	var $action;
	
	function clsbpAnnouncements($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpAnnouncements");			
		
 		$this->nAnnId = 0;		
		$this->strSubject = 'Announcement';
		$this->strAnnouncement = '';
		$this->nMemberId = 0;
		$this->dtInsertedDate = date('Y-m-d');
		$this->action = '';
	}
	
	function setPostVars() {	
		parent::setPostVars();	
		if (isset($_POST['clsbpAnnouncements_annId']))  $this->nAnnId		= $_POST['clsbpAnnouncements_AnnId'];
		if (isset($_POST['clsbpAnnouncements_annSubject']))  $this->strSubject		= $_POST['clsbpAnnouncements_annSubject'];
		if (isset($_POST['clsbpAnnouncements_annContent']))  $this->strAnnouncement		= $_POST['clsbpAnnouncements_annContent'];
		if (isset($_POST['clsbpAnnouncements_annMemberId']))  $this->nMemberId		= $_POST['clsbpAnnouncements_annMemberId'];
		if (isset($_POST['clsbpAnnouncements_annDate']))  $this->dtInsertedDate		= $_POST['clsbpAnnouncements_annDate'];
	}

	function setGetVars() {

		parent::setGetVars();	
		if (isset($_GET['clsbpAnnouncements_annId']))  $this->nAnnId		= $_GET['clsbpAnnouncements_AnnId'];
		if (isset($_GET['clsbpAnnouncements_annSubject']))  $this->strSubject		= $_GET['clsbpAnnouncements_annSubject'];
		if (isset($_GET['clsbpAnnouncements_annContent']))  $this->strAnnouncement		= $_GET['clsbpAnnouncements_annContent'];
		if (isset($_GET['clsbpAnnouncements_annMemberId']))  $this->nMemberId		= $_GET['clsbpAnnouncements_annMemberId'];
		if (isset($_GET['clsbpAnnouncements_annDate']))  $this->dtInsertedDate		= $_GET['clsbpAnnouncements_annDate'];
	}
	
	function getLatestAnnouncementDetails() {
		$query = "SELECT 
					* 
				FROM 
					`tbl_announcements` 
				ORDER BY 
					`dt_InsertedDate` DESC 
				LIMIT 
					0,1";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		return $this->retrieveAnnounementRow($dbQry);
	}
	
	
	
	function retrieveAnnounementRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row				= $dbQry->getArray();
		
		$this->nAnnId = $row['bi_AnnID'];		
		$this->strSubject = $row['vc_Subject'];
		$this->strAnnouncement = $row['lt_Announcement'];
		$this->nMemberId = $row['bi_MemberID'];
		$this->dtInsertedDate = $row['dt_InsertedDate'];
			
		return 1;
	}
	
	function postMessages() {
		if($this->action == "") {
			$this->getLatestAnnouncementDetails();
		}
		
	}
}

?>
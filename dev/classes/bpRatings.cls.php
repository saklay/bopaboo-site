<?php 
/*******************************************************************
/ Title: Rating Class.
/ Purpose:
/ 
/ Inputs:   
			
/ Outputs:  
/           

/ Authors:  Sivaprasad C
/*******************************************************************/
class clsbpRatings extends clsbpBase  { 

	var $bi_FileId;		
	var $bi_MemberId;		
	var $FileIds;		
	var $i_CCV1;
	var $totalReviews;
	function clsbpRatings($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpRatings");			
		
		$this->fileId		= "";
		$this->sellerId	        = "";		
		$this->includePath		= $includePath;
		
	
	}
 	
	function setGetVars() {

		parent::setGetVars();	

		if (isset($_GET['fileId']))		$this->fileId  = trim($_GET['fileId']);
		if (isset($_GET['sellerId']))	$this->sellerId = trim($_GET['sellerId']);
		if (isset($_GET['rateId']))	$this->rateId = trim($_GET['rateId']);
				
		
	}

	
	function saveRatings($rating,$sellerId,$fileId){
	
	global $rates;
	
		$this->bi_MemberId =$_SESSION['USERID'];
		$date =date("Y-m-d");
		$rating = $this->rateId;
		if($rating=='undefined'){
		$rating = 0;
		}
		 $query	= " INSERT INTO tbl_ratings (bi_buyerId, bi_sellerId,bi_fileId, vc_rating,dt_insertedDate) VALUES  ($this->bi_MemberId,$sellerId,$fileId,$rating,'$date')";
		$rates =  $this->rateId;
		//echo $rates;
		$dbQry	= 	new dbQuery($query, $this->connect->connId);
		
			            if($rates==0){
						 $width = 0;
						 }
						 if($rates==1){
						 $width = 17;
						 }
						 if($rates==2){
						 $width = 34;
						 }
						 if($rates==3){
						 $width = 51;
						 }
						 if($rates==4){
						 $width = 68;
						 }
						 if($rates==5){
						 $width = 85;
						 
						 }
						// print $fileId;
						echo $draw = "<ul class='star-rating'>
				<li class='current-rating' style='width:".$width."px;'>Currently 3/5 Stars.</li>
				<li><a href='#' onclick='fn_alert(1,".$FileId.",".$sellerId.")' title='1 star out of 5'".$str1.">1</a></li>
				<li><a href='#' onclick='fn_alert(2,".$FileId.",".$sellerId.")' title='2 star out of 5'".$str2.">2</a></li>
				<li><a href='#' onclick='fn_alert(3,".$FileId.",".$sellerId.")' title='3 star out of 5'".$str3.">3</a></li>
				<li><a href='#' onclick='fn_alert(4,".$FileId.",".$sellerId.")' title='4 star out of 5'".$str4.">4</a></li>
				<li><a href='#' onclick='fn_alert(5,".$FileId.",".$sellerId.")' title='5 star out of 5'".$str5.">5</a></li>
			</ul>";
					
	}
	
	/// Function to display average rating for a user
	
	function fn_showUserRatings($sellerId){
	
		$query  = "SELECT count(*) as count, sum(vc_rating) as sum FROM `tbl_ratings` WHERE bi_SellerId=$sellerId";
	    $dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->fn_showUserRatingsArray($dbQry);
	}
	
	function fn_showUserRatingsArray($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row				 = $dbQry->getArray();
		
		 $noRecords = $row["count"];
		 $sum       = $row["sum"];
		 $this->totalReviews =$noRecords;
		$avgUserRating = round($sum/$noRecords);
			
		$width      = $avgUserRating * 17;
		 
		 $drawRating ="<ul class='star-rating'>
				<li class='current-rating' style='width:".$width."px;'></li>
				<li><a href='#' >1</a></li>
				<li><a href='#' >2</a></li>
				<li><a href='#' >3</a></li>
				<li><a href='#' >4</a></li>
				<li><a href='#' >5</a></li>
			</ul>";
		
		//echo $drawRating;	
	

	}
	
	function fn_showUserRatingsAsImage($sellerId){
	
		$query  = "SELECT count(*) as count, sum(vc_rating) as sum FROM `tbl_ratings` WHERE bi_SellerId=$sellerId";
	    $dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->returnAvgRating($dbQry);
	}
	
	function returnAvgRating($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row				 = $dbQry->getArray();
		
		 $noRecords = $row["count"];
		 $sum       = $row["sum"];
		 $this->totalReviews =$noRecords;
// 		$avgUserRating = round($sum/$noRecords);
		$avgUserRating = $sum/$noRecords;
		
 		if((0.00 < $avgUserRating) &&  ($avgUserRating <= 1.00)) {
 			$avgUserRating = 1; 
 		}
 		else if((1.00 < $avgUserRating) && ($avgUserRating<=1.25)) {
 			$avgUserRating = floor($avgUserRating); 
 		}
 		else if((1.25 < $avgUserRating) && ($avgUserRating<=1.75)) {
 			$avgUserRating = 15;
 		}
 		else if((1.75<$avgUserRating) && ( $avgUserRating <= 2.00)) {
 			$avgUserRating = 2;
 		}
 		
 		
 		else if((2.00 < $avgUserRating) && ($avgUserRating<=2.25)) {
 			$avgUserRating = floor($avgUserRating); 
 		}
 		else if((2.25 < $avgUserRating) && ($avgUserRating<=2.75)) {
 			$avgUserRating = 25;
 		}
 		else if((2.75<$avgUserRating) && ( $avgUserRating <= 3.00)) {
 			$avgUserRating = 3;
 		}
 		
 		
 		else if((3.00 < $avgUserRating) && ($avgUserRating<=3.25)) {
 			$avgUserRating = floor($avgUserRating); 
 		}
 		else if((3.25 < $avgUserRating) && ($avgUserRating<=3.75)) {
 			$avgUserRating = 35;
 		}
 		else if((3.75<$avgUserRating) && ( $avgUserRating <= 4.00)) {
 			$avgUserRating = 4;
 		}
 		
 		
 		else if((4.00 < $avgUserRating) && ($avgUserRating<=4.25)) {
 			$avgUserRating = floor($avgUserRating); 
 		}
 		else if((4.25 < $avgUserRating) && ($avgUserRating<=4.75)) {
 			$avgUserRating = 45;
 		}
 		else if((4.75<$avgUserRating) && ( $avgUserRating <= 5.00)) {
 			$avgUserRating = 5;
 		}

		else {
			$avgUserRating = 0;
		}
		
		return $avgUserRating;
	}
		function fn_showUserRatings_halfstar($sellerId){
	
		$query  = "SELECT count(*) as count, sum(vc_rating) as sum FROM `tbl_ratings` WHERE bi_SellerId=$sellerId";
	    $dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->fn_showUserRatingsHalfStarArray($dbQry);
	}
	
	function fn_showUserRatingsHalfStarArray($dbQry) {

		if(!$dbQry->numRows()) return 0;

		$row				 = $dbQry->getArray();
		
		 $noRecords = $row["count"];
		 $sum       = $row["sum"];
		 $this->totalReviews =$noRecords;
		$avgUserRating = round($sum/$noRecords);
			
		$width      = $avgUserRating * 17;
		 
		 $drawRating ="<ul class='star-rating'>
				<li class='current-rating' style='width:".$width."px;'></li>
				<li><a href='#' >1</a></li>
				<li><a href='#' >2</a></li>
				<li><a href='#' >3</a></li>
				<li><a href='#' >4</a></li>
				<li><a href='#' >5</a></li>
			</ul>";
		
		echo $drawRating;	
	

	}
	

	///////////// MAIN FUNCTION //////////////
			
	function postRating() {	

	$this->returnUrl = "bpFeedback.php";
		$this->setGetVars();	
	
			$this->saveRatings($this->rateId ,$this->sellerId,$this->fileId);
			//	$this->drawRating($this->fileId,$this->sellerId,'',$this->rateId );			
		
		}
	
}
?>
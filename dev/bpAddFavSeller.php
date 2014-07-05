<?php
	session_start();
	include_once($includePath."bpCommon.php");
	include_once($includePath."classes/bpFileDetails.cls.php");
	include_once($includePath."classes/bpGenre.cls.php");
	include_once($includePath."classes/bpPaginate.cls.php");
	include_once($includePath."classes/bpUserLogin.cls.php");
	include_once($includePath."classes/bpBopaCart.cls.php");
	include_once($includePath."classes/bpRatings.cls.php");
	$userId = $_SESSION['USERID'];
	$sellerId = $_GET['sellerId'];
	$memberid = $_SESSION['USERID'];
	if($userId!=''){
		if(checkFavSeller($sellerId, $memberid) ==0) {
				$query = "INSERT INTO   
								tbl_seller_favourates 
								(
									bi_MemberId,
									bi_SellerId
								) 
							VALUES 
								(
									\"$memberid\",
									\"$sellerId\"
									
								)";
				$result = mysql_query($query);
				
				echo "1";
		}
		else {
			echo "0";
		}
	}
	else{
		echo "2";
	}
	
	function checkFavSeller($sellerId, $memberid){
		$query = "SELECT * 
					FROM 
						tbl_seller_favourates 
					WHERE 
						bi_MemberId = $memberid
							AND
						bi_SellerId = $sellerId";
		$result = mysql_query($query);
		return mysql_num_rows($result);
	}
?>
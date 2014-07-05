<?php
	session_start();
	$includePath		= "./";

	include_once($includePath."bpCommon.php");
	include_once($includePath."classes/bpFileDetails.cls.php");
	include_once($includePath."classes/bpGenre.cls.php");
	include_once($includePath."classes/bpPaginate.cls.php");
	include_once($includePath."classes/bpUserLogin.cls.php");
	include_once($includePath."classes/bpBopaCart.cls.php");
	include_once($includePath."classes/bpRatings.cls.php");
	
	/*--------------------------------------------------------------------------------*/
	
	$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	/*--------------------------------------------------------------------------------*/
	$userId = $_SESSION['USERID'];
	$favId= $_GET['id'];
	$result = mysql_query($query);
	
	$query = "DELETE FROM tbl_seller_favourates WHERE bi_FavourateId = $favId";
	
			
	$result = mysql_query($query);
	
	$query = "select * FROM tbl_seller_favourates LEFT JOIN tbl_mem_login ON tbl_mem_login.bi_MemberId=tbl_seller_favourates.bi_MemberId WHERE tbl_seller_favourates.bi_MemberId = $userId";
	
	$result = mysql_query($query);
	$i=0;
	$html="<ul id=\"savedSellers\">";
	while($row = mysql_fetch_assoc($result)) {
		$html .= "<li>
			<a href=\"javascript: void(0);\">".($i+1).".&nbsp;".$row['vc_DisplayName']."</a>
			<span>
				<a href=\"javascript:void(0);\" onclick= \"javascript: deleteFav(".$row['bi_FavourateId'].")\" class=\"last\"><img src=\"images/sellPageDeleteIcon.png\" alt=\"Delete\" width=\"20\" height=\"20\" border=\"0\" align=\"absmiddle\" /></a>
				<a href =\"bpAdvSearch.php?clsbpFileDetails_SaveId=".$row['bi_FavourateId']."\"><img src=\"images/rate_".$clsbpRatings->fn_showUserRatingsAsImage($row['bi_SellerId'])."star.png\" alt=\"Edit\" width=\"96\" height=\"20\" border=\"0\" align=\"absmiddle\" /></a>
			</span>
		</li>";
		$i++;
	}
	
		$html.="</ul>";
	if($i==0){
		$html .= "<p align=\"center\">You have no saved sellers.</p>"	;	
	}

	echo $html;
?>
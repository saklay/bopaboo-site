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
	$searchId= $_GET['id'];
	$query = "DELETE FROM tbl_savedsearch WHERE bi_SearchId = $searchId";
	$result = mysql_query($query);
	
	$query = "SELECT bi_SearchId, vc_SaveName FROM tbl_savedsearch WHERE bi_MemberId = $userId";		
	$result = mysql_query($query);
	
 	$html="<ul id=\"savedSearch\">";
 	$i=0;
 	while($row = mysql_fetch_assoc($result)) {
			if($i<=3)
	{
	$class = "class=\"column1\"";
	
	}
	if($i==4)
	{
	$class = "class=\"column1 last\"";
	
	}
	if($i==5)
	{
	$class = "class=\"column2 reset\"";
	
	}
	if($i > 5 && $i <9)
	
	{
	$class = "class=\"column2\"";
	}
		if($i==9)
	{
	$class = "class=\"column2 last\"";
	
	}
	
	
	
 		$html .= "<li ".$class.">
 			<a href=\"getSearchResult.php\">".($i+1).".&nbsp;".$row['vc_SaveName']."</a>
 			<span>
 				<a href =\"bpAdvSearch.php?clsbpFileDetails_SaveId=".$row['bi_SearchId']."\"><img src=\"images/sellPageEditIcon.png\" alt=\"Edit\" width=\"20\" height=\"20\" border=\"0\" align=\"absmiddle\" /></a>
 				<a href=\"javascript:void(0);\" onclick= \"javascript: deleteSearch(".$row['bi_SearchId'].")\"><img src=\"images/sellPageDeleteIcon.png\" alt=\"Delete\" width=\"20\" height=\"20\" border=\"0\" align=\"absmiddle\" /></a>
 			</span>
 		</li>";
 		$i++;
 	}
 	$html.="</ul>";
 	echo $html;
?>
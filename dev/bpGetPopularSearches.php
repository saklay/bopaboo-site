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
	$query = "SELECT vc_searchKeyword AS tag, bi_searchKeywordCount AS quantity
						FROM 
							tbl_search_records 
						WHERE
							bi_searchResultCount > 0
						ORDER BY 
							vc_searchKeyword 	ASC";
			
	$result = mysql_query($query);
	$html="<ul id=\"popSearch\">";
	$i=0;
	while(($row = mysql_fetch_assoc($result)) && ($i<10)) {
	
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
		//if(($i+1)%4==0){
//			$class = "class="";
//		}
//		else{
//			$class = "";
//	}
		$html .= "<li ".$class.">
			<a href=\"bpSearch.php?clsbpFileDetails_txtSearch=".$row['tag']."\">".($i+1).".&nbsp;".$row['tag']."</a>
			
		</li>";
		$i++;
	}
	if($i==0){
		$html .= "<li> No records found </li>";
	}
	$html.="</ul>";
	echo $html;
?>
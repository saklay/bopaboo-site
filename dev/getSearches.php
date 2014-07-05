<?php
	include_once($includePath."bpCommon.php");
	include_once($includePath."classes/bpFileDetails.cls.php");
	include_once($includePath."classes/bpGenre.cls.php");
	include_once($includePath."classes/bpPaginate.cls.php");
	include_once($includePath."classes/bpUserLogin.cls.php");
	include_once($includePath."classes/bpBopaCart.cls.php");
	include_once($includePath."classes/bpRatings.cls.php");
	$query = "SELECT vc_searchKeyword AS tag, bi_searchKeywordCount AS quantity
						FROM 
							tbl_search_records 
						WHERE
							bi_searchResultCount > 0
						ORDER BY 
							vc_searchKeyword 	ASC LIMIT 0,10";
			
	$result = mysql_query($query);
	$html="<ul>";
	while($row = mysql_fetch_array($result)) {
		$html .= "<li>".$row['tag']."</li>";
	}
	$html.="</ul>";
	
	echo $html;
?>
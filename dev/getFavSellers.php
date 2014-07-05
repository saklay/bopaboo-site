<?php
	session_start();
// 	mysql_connect("localhost",'root','');
// 	mysql_select_db('db_bopaboo');
	$userId = $_SESSION['USERID'];
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
	function fnCheckLength($value, $length)
{   
    if(is_array($value)) list($string, $matching) = $value;
    else { $string = $value; $matching = $value{0}; }

    $match_start = stristr($string, $matching);
    $match_compute = strlen($string) - strlen($match_start);

    if (strlen($string) > $length)
    {
        if ($match_compute < ($length - strlen($matching)))
        {
            $pre_string = substr($string, 0, $length);
            $pos_end = strrpos($pre_string, " ");
            if($pos_end === false) $string = $pre_string."...";
            else $string = substr($pre_string, 0, $pos_end)."...";
        }
        else if ($match_compute > (strlen($string) - ($length - strlen($matching))))
        {
            $pre_string = substr($string, (strlen($string) - ($length - strlen($matching))));
            $pos_start = strpos($pre_string, " ");
            $string = "...".substr($pre_string, $pos_start);
            if($pos_start === false) $string = "...".$pre_string;
            else $string = "...".substr($pre_string, $pos_start);
        }
        else
        {       
            $pre_string = substr($string, ($match_compute - round(($length / 3))), $length);
            $pos_start = strpos($pre_string, " "); $pos_end = strrpos($pre_string, " ");
            $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
            if($pos_start === false && $pos_end === false) $string = "...".$pre_string."...";
            else $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
        }

        $match_start = stristr($string, $matching);
        $match_compute = strlen($string) - strlen($match_start);
    }
   
    return $string;
}


	 $query = "select * FROM tbl_seller_favourates LEFT JOIN tbl_mem_login ON tbl_mem_login.bi_MemberId=tbl_seller_favourates.bi_SellerId WHERE tbl_seller_favourates.bi_MemberId = $userId";
			
	$result = mysql_query($query);
	
	$i=0;
	$html="<ul id=\"savedSellers\">";
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
	$string = fnCheckLength($row['vc_DisplayName'],10);
	$username = $row['vc_DisplayName'];
		$html .= "<li ".$class.">
			<a href=\"bpMemberStore.php?mS=$username\">".($i+1).".&nbsp;".$string."</a>
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
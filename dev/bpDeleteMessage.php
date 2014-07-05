<?php
	include_once($includePath."bpCommon.php");
	include_once($includePath."bpFunctions.php");
	include_once($includePath."classes/bpUserLogin.cls.php");
	include_once($includePath."classes/bpBopaCart.cls.php");
	include_once($includePath."classes/bpUserLogin.cls.php");
	include_once($includePath."classes/bpMessages.cls.php");
	include_once($includePath."classes/bpPaginate.cls.php");

	$id = $_GET['id'];
	
	$query = "UPDATE
					tbl_messages
				SET
					ti_inboxDel = 1
				WHERE
					bi_MessageId = ".$id;
	
	$result = mysql_query($query);
	
	$query = "SELECT * FROM 
					tbl_mem_login
				INNER JOIN 
					tbl_messages 
				ON
					tbl_mem_login.bi_MemberId = tbl_messages.`bi_FromId`	
				WHERE 
						tbl_messages.bi_ToId =". $_SESSION['USERID']. " AND ti_inboxDel=0 ORDER BY dt_SentDate DESC LIMIT 0,5";
			
	$result = mysql_query($query);
	$html =  "<table cellpadding=\"0\" cellspacing=\"0\" id=\"newMessages\">";
	$html .= "<thead>
                                <tr>
                                    <th class=\"left\">From</th>
                                    <th class=\"middle\">Subject</th>
                                    <th class=\"middle1\">Date</th>
                                     <th class=\"right\">Delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <td colspan=\"4\"><a href=\"bpMyBopaMessageInbox.php\" class=\"viewMessages\">&gt;&gt;&nbsp;View Messages</a></td>
                                    </tr>
                                </tfoot>
                                <tbody>";
//          $i=0;
	 if(mysql_num_rows($result)) {
		while($row = mysql_fetch_assoc($result)) {
			if($row['ti_received'] == 1) {
				$class = "class=\"read\"";
			}
			else {
				$class = "class=\"unread\"";
// 				$i++;
			}
				$date = explode(" ",$row['dt_SentDate']);	
				$sendDate = date ("m/j/y",strtotime($date[0]));
			$html .= "<tr>
					<td><a href=\"javascript: void(0);\" ".$class." onclick=\"javascript: readMessage(".$row['bi_MessageId'].");\">".substr($row['vc_DisplayName'],0,10)."</a></td>
					<td><a href=\"javascript: void(0);\" ".$class." onclick=\"javascript: readMessage(".$row['bi_MessageId'].");\">".substr($row['vc_Subject'],0,15)."</a></td>
					<td><a href=\"javascript: void(0);\" ".$class." onclick=\"javascript: readMessage(".$row['bi_MessageId'].");\">".$sendDate."</a></td>
					<td><a href=\"javascript: void(0);\" onclick=\"javascript: deleteMessage(".$row['bi_MessageId'].");\"  ".$class.">&nbsp;&nbsp;<img align=\"bottom\" src=\"images/icon-delete.png\"  alt=\"delete\" width=\"21\" height=\"21\" border=\"0\"/></a></td> 
				</tr>";
		}
	}
	else {
		$html .= "<tr>
					<td colspan=\"4\" align=\"center\" style=\"text-align:center\">There are no messages in your inbox.</td>
				</tr>";
	}

	$html .= "</tbody> </table>";
	
// 	$html .= "<script language=\"JavaSript\" type=\"text/javascript\">
// 				documet.getElementById(\"messageCount\").innerHTML=".$i."
// 				alert(documet.getElementById(\"messageCount\").innerHTML);
// 			</script>";
	
	echo $html;
?>
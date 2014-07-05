<?php
	
		include_once($includePath."bpCommon.php");
		
		$fieldname=$_GET['field_name'];
		$fieldvalue=$_GET['field_value'];
		
		//echo "fieldname!::".$fieldname;
		//echo "fieldvalue!::".$fieldvalue;
		
		$stmt=mysql_query("select * from tbl_mem_login where $fieldname='$fieldvalue'");
		$num_rows=mysql_num_rows($stmt);
		//echo "num_rows:::".$num_rows;
		if($num_rows > 0)
		{
				if($fieldname=="vc_EmailId")
				{
						echo "This Email Already Exists.";
				}else if($fieldname=="vc_DisplayName"){
						echo "This Display Name Already Exists.";
				}
		}else{
				echo "<img src='images/icon-tick.png'/>";				
		}
		
		//$res=mysql_fetch_array($stmt);
		//echo "QUERY::::".$stmt;
?>
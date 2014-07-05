<?php
//ini_set("session.gc_maxlifetime", "1200"); 
//session_cache_expire(20);
if(fnCheckSession()==false){
$_SESSION["BPMESSAGE"]	= "&nbsp;&nbsp;&nbsp;&nbsp;Please Login";	

header("location:index.php");


}

?>
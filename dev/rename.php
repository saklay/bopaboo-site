<?php

if($_POST['Status'] == 'STATUS_EXIST')
	unlink('temp/' . $_POST['dupFilename']);
else
	rename('temp/' . $_POST['dupFilename'] , 'temp/' . stripslashes($_POST['orgFilename']));
 
?>
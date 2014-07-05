<?php
if ($_FILES['Filedata']['name']) 
{
	move_uploaded_file($_FILES['Filedata']['tmp_name'], 'temp/' . $_POST['Filename']);
	chmod('temp/' . $_POST['Filename'], 0755);

}
?> 

<?php
/*******************************************************************
/ Title: XML parsing and database insertion .
/ Purpose: This file is used to open the XML file generated by the Flash Tool.
/          The XMl file is parsed using the function simplexml_load_file which returns an array.
/          In the for loop each array element is retrived. The values from the nodes are assigned to array   
/          $insertInfo[]. This array is passed to the sql function (insertQry) for insert operation.   
/ 
/ Inputs:   XML File generated by the Flash Tool
/ Outputs:  Parse the XML file and insert the node values into database
/        
/ Authors: Sivaprasad C
/*******************************************************************/

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."classes/bpFileUpload.cls.php");
$clsbpFileUpload	= new clsbpFileUpload($connect, $includePath,"clsbpFileUpload");

$clsbpFileUpload->setPostVars();
$clsbpFileUpload->createXML();
	
?>
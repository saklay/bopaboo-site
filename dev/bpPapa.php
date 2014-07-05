<?php
/*******************************************************************
/ Title: Generate PAPA XML  .
/ Purpose: This file is used to generated an XML file.
/          The XMl file is used fot PAPA validation by the Flash Tool.
/ 
/ Inputs:   USER ID (from cookie)
/ Outputs:  Generate an XML for PAPA validation. The XML is stored in a variable $xmlPAPA
/ Version : PAPA Scaning Tire-1 and Tire-2       
/ Author: Sivaprasad C
/*******************************************************************/

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpPapa.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
$bpclsPapa	= new bpclsPapa($connect,$includePath,"bpclsPapa");

$bpclsPapa->setPostVars();
$bpclsPapa->getFileInfo();

	
?>
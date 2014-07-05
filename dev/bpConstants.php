<?php

//General Constants
define("HTTP",					"http://www.bopaboo.com/dev/");
define("URL",					"http://" .   $_SERVER['HTTP_HOST'] . "/dev/");
define("BPDEFAULTPAGESIZE",			25);
define("BPRANGEVAL",				10);
define("NORMALDATEFORMAT",			"%d-%b-%Y");
define("DISPLAYDATEFORMAT",			"'%d-%b-%Y'");
define("REPORTROWHIGHLIGHTCOLOR",		"#FFFFCC");

//New Constants
define("HTTPS",					"https://www.bopaboo.com/dev/");
define("URLS",					"https://" .   $_SERVER['HTTP_HOST'] . "/dev/");
define("PCIURL",				"https://" .   $_SERVER['HTTP_HOST'] . "/dev/PCI/");
define("SITENAME",				"bopaboo - Your Place to Buy and Sell Digital Music");
define("IMAGEPATH",				"images/"); //http://bopimages.s3.amazonaws.com/
define("ALBUMART",				"./albumArt/");
define("DEFAULTALBUMART",			"images/albumcover.jpg");
define("EDKEY",					"who likes fish more than me?");

//eMail Constants
define("EMAIL_MODE",				"LIVE");			// TEST - For testing the mails
define("BPFROMMAILID",				"no-reply@bopaboo.com");
define("BPFROMNAME",				"bopaboo.com");
define("TEST_EMAIL",				"tbaki@bopaboo.com"); 
define("BPEMAILERROR",				"tbaki@bopaboo.com");
define("BPEMAILNOTIFICATION",			"tbaki@bopaboo.com");
define("BPEMAILADMIN",				"tbaki@bopaboo.com");
define("BPADMINEMAILID",			"tbaki@bopaboo.com");
define("BPBIRTHDAYEMAILID",			"tbaki@bopaboo.com");


//Global Variables
define("BPDEFAULTSONGPRICE", 			0.45); 				// default sales price

/* Payment*/
define("serviceFloor", 				1.0);
define("serviceCharge", 			0.25);
define("transactionFee", 			0.20); 				// transaction Fee is used for calculating the commission.'

/* New*/
define("MINSALE", 				0.25);
define("MINWITHDRAW", 				1.00);

//Database Connection
/* Main DB */
define("MAINDBSERVER", 				"internal-db.s35886.gridserver.com");
define("MAINDB", 				"db35886_bopaboo");
define("MAINDBUSER", 				"db35886");
define("MAINDBPASS", 				"w3UVaTyd");

/* CC DB */
define("CCDBSERVER", 				"internal-db.s35886.gridserver.com");
define("CCDB", 					"db35886_bopaPCI");
define("CCDBUSER", 				"db35886");
define("CDBPASS", 				"w3UVaTyd");

/* Album Data DB */
define("ALBUMDBSERVER", 			"internal-db.s35886.gridserver.com");
define("ALBUMDB", 				"db35886_albumData");
define("ALBUMDBUSER", 				"db35886");
define("ALBUMDBPASS", 				"w3UVaTyd");

/* Search DB */
define("SEARCHDBSERVER", 			"internal-db.s35886.gridserver.com");
define("SEARCHDB", 				"db35886_bopaboo");
define("SEARCHDBUSER", 				"db35886");
define("SEARCHDBPASS", 				"w3UVaTyd");


//Data Store Connection
/* AMAZON S3 */
define("SANURL", 				"");
define("SANKEY", 				"1ABSSS1VJH0D5XRFWT82");
define("SANPRIVATE", 				"x+S10RVL5A82g/vDSvw+tlgTHPlRFdqFNlIONdox");
define("TEMPFILEPATH", 				"./temp/");


//Captcha
define("PUBLICCAPTCHA", 			"6LdLWgIAAAAAAAcS6yPjg4amu-tYaiPS1L_j3QZ9");
define("PRIVATECAPTCHA", 			"6LdLWgIAAAAAALFJibI55Xq7ELoZeh_bnnZZlUYV");

//Amazon Album Art Key
define("Access_Key_ID", 			"1ABSSS1VJH0D5XRFWT82");
?>
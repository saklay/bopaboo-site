<?php 
/*******************************************************************
/ Title: Upload Class.
/ Purpose: This file is used for File upload functions.
/ Mainly used for file upload process.
/ 
/ Inputs:   An XML ($_POST['xmlData']), $memberId from Cookie
			
/ Outputs:  
/           

/ Authors: Sivaprasad C
/*******************************************************************/
class clsbpCSVImport extends clsbpBase  { 

	var $FileName;	
	var $returnUrl;

	function clsbpCSVImport($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpCSVImport");			
		
	
		$this->FileName	        = "";
		$this->includePath		= $includePath;
		$this->returnUrl		= "bpFriendsListOutLook.php";
		

	}

	function setPostVars() {	

		parent::setPostVars();	
		
		if ($_FILES['clsbpCSVImport_csv'])			$this->FileName				= $_FILES['clsbpCSVImport_csv'];
		if ($_POST['clsbpCSVImport_selectType'])	$this->selectType			= $_POST['clsbpCSVImport_selectType'];
					
	}

	  function GrabCSV(){
	
	
		move_uploaded_file($this->FileName['tmp_name'],"temp/".$this->FileName['name']); // upload file to server (temp folder)
		
			    /*
				loop to grab contact list from the csv file
				
				*/
				if($this->FileName['name']!=""){
				
					$path = "temp/".$this->FileName['name'];
					$handle = fopen($path, "r");
					$count =0;
					
						switch($this->selectType) {
						
							  case 'OL': 
							  
							  
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
										
										if($count!=0){
										
										$data = str_replace("(", "[", $data[59]);      
										$data = str_replace(")", "]", $data);                                                                                                                                 
										
										$_SESSION['friendListOutLook'] .=$data. ",";
										}
										$count++;
										
										}
										
										fclose($handle);
										unlink($path);
							 break;
							 
							 case 'OLE': 
							  
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
										
										if($count!=0){
										
										$name = $data[0]. " " .$data[2];
										
																		
											if($data[4]!=""){ // add to list if email is not null
											
											$email = "[".$data[4]."]";
		
											$data = $name.$email;
													 
											$_SESSION['friendListOutLook'] .=$data. ",";
											}
										
										}
										$count++;
										
										}
										
										fclose($handle);
										unlink($path);
							 break;
							 
							 case 'Y': 
							  
							  
										while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
										
										if($count!=0){
										
										$name = $data[0]. " " .$data[2];
										
																		
											if($data[4]!=""){ // add to list if email is not null
											
											$email = "[".$data[4]."]";
		
											$data = $name.$email;
													 
											$_SESSION['friendListOutLook'] .=$data. ",";
											}
										
										}
										$count++;
										
										}
										
										fclose($handle);
										unlink($path);
							 break;
						}// end switch
					 
					 
			    }  
		
		
		
	  }
  

	function postCSV() {	

		$this->setPostVars();
		
		$this->GrabCSV();
		
		header("location:".$this->includePath.stripslashes($this->returnUrl));
			exit();		
		
				
	}
}
?>
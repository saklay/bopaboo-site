<?php 
/*******************************************************************
/ Title: File Details Class.
/ Purpose: This file is used for handelling Users Files.
/ 
/ Inputs:   
			
/ Outputs:  
/           

/ Authors: Sivaprasad C
/*******************************************************************/
class clsbpFileDetails extends clsbpBase  { 

	var $vc_SongName;
	var $GenreId;		
	var $vc_GenreName;		
	var $GenreActive;		
	var $GenreIds;
	var $vc_Tags ;
	var $txtSearch;
	var $seachCat;
	var $returnURL;
	var $txtwords;
	var $searchKeyword;
	var $searchCat;
	var $searchType;
	var $searchGenre;
	var $searchMinAmount;
	var $searchMaxAmount;
	var $searchSeller;
	var $searchIfSeller;
	var $searchSaveCheck;
	var $SearchGenreId;
	var $SearchGenreName;
	var $searchSaveFav;
	var $fileIds4sale;
	var $fileIds4delete;
	var $Searchtags;
	var $goBack;
	var $countUserFiles;
	var $countUserSellFiles;
	var $countBopaBoxFiles;
	var $priceTotalSellYear;
 	var $countTotalSellYear;
	var $memberDisplayName;
	var $sellername;
	var $sellerId;
	var $minAmount;
	var $maxAmount;
	var $countFiles;
	var $pageSize;
	var $tabName;
	
	var $returnValue;
	
	var $saveId; // This is used to poplate the advanced search form from the saved searches (used from  MyBopa)
	function clsbpFileDetails($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpFileDetails");			
		$this->tabName="";
		$this->bi_file_id		= "";	
		$this->bi_MemberId		= "";		
		$this->bi_FileTypeId	= "";		
		$this->bi_GenreId		= "";
                //$this->vc_GenreName		= "";	
		$this->txtwords		= "";
		$this->SearchGenreId		= "";
		$this->SearchGenreName		= "";
		$this->sellername           = "";
		$this->vc_FileName		= "";
		$this->vc_FilePath		= "";
		$this->dt_FileUploaded	= "";
		$this->vc_FileSize		= "";
		$this->vc_artists_nm_mod	= "";
		$this->vc_album_nm_mod		= "";
		$this->vc_title_nm_mod		= "";
		$this->lt_Comment		= "";
		$this->vc_year		    = "";
		$this->f_track_length	= "";
		$this->f_bitrate	= "";
		$this->vc_tags		    = "";
		$this->dbl_price		    = "";
		$this->i_in_sell	= "";
		$this->txtSearch        ="";
		$this->seachCat        ="";
		$this->bi_FileIDs       = "";	
		$this->includePath		= $includePath;
		$this->sortColumn		= "vc_artists_nm_mod";
		$this->sortDirection    = "ASC";
		$this->pageSize			= 10;
		$this->searchSize      = 20;
		$this->rangeVal			= constant("BPRANGEVAL");
		$this->returnURL ="";
		$this->vc_genre_mod ="";
		$this->searchKeyword =  "";
		$this->searchType =  "";
		$this->searchGenre =  "";
		$this->searchMinAmount =  "";
		$this->searchMaxAmount =  "";
		$this->searchIfSeller =  "";
		$this->searchSeller =  "";
		$this->searchAction =  "";
		$this->searchSaveCheck =  "";
		$this->searchSaveFav =  "";
		$this->Searchtags =  "";
		$this->fileIds4sale = "";
		$this->fileIds4delete="";
		$this->goBack ="";
		$this->countUserFiles=0;
		$this->countUserSellFiles=0;
		$this->countBopaBoxFiles=0;
		$this->memberDisplayName="";
		$this->sellerId = "";
		$this->minAmount=0;
		$this->maxAmount=0;
		$this->countFiles=0;
		
		$this->priceTotalSellYear = 0;
 		$this->countTotalSellYear = 0;
 		
 		$this->saveId = 0;
	}

	function setPostVars() {	
		parent::setPostVars();	
		if (isset($_POST['clsbpFileDetails_bi_file_id']))	    $this->bi_file_id		= trim($_POST['clsbpFileDetails_bi_file_id']);
		if (isset($_POST['clsbpFileDetails_bi_SellerId']))	$this->sellerId	    = trim($_POST['clsbpFileDetails_bi_SellerId']);
		if (isset($_SESSION["USERID"]))		                    $this->bi_MemberId	    = trim($_SESSION["USERID"]	);
		if (isset($_POST['clsbpFileDetails_bi_FileTypeId']))	$this->bi_FileTypeId	= trim($_POST['clsbpFileDetails_bi_FileTypeId']);
		if (isset($_POST['clsbpFileDetails_bi_GenreId']))       $this->bi_GenreId	    = trim($_POST['clsbpFileDetails_bi_GenreId']);
		if (isset($_POST['clsbpFileDetails_vc_FileName']))      $this->vc_FileName		= trim($_POST['clsbpFileDetails_vc_FileName']);	
		if (isset($_POST['clsbpFileDetails_vc_FilePath']))      $this->vc_FilePath		= trim($_POST['clsbpFileDetails_vc_FilePath']);	
		if (isset($_POST['clsbpFileDetails_dt_FileUploaded']))  $this->dt_FileUploaded	= trim($_POST['clsbpFileDetails_dt_FileUploaded']);	
		if (isset($_POST['clsbpFileDetails_vc_FileSize']))       $this->vc_FileSize		= trim($_POST['clsbpFileDetails_vc_FileSize']);
		if (isset($_POST['clsbpFileDetails_vc_artists_nm_mod'])) $this->vc_artists_nm_mod	= trim($_POST['clsbpFileDetails_vc_artists_nm_mod']);		
		if (isset($_POST['clsbpFileDetails_vc_album_nm_mod']))   $this->vc_album_nm_mod		= trim($_POST['clsbpFileDetails_vc_album_nm_mod']);	
		if (isset($_POST['clsbpFileDetails_vc_title_nm_mod'])) $this->vc_title_nm_mod = trim($_POST['clsbpFileDetails_vc_title_nm_mod']);	
		if (isset($_POST['clsbpFileDetails_lt_Comment']))       $this->lt_Comment		= trim($_POST['clsbpFileDetails_lt_Comment']);	
		if (isset($_POST['clsbpFileDetails_vc_year']))           $this->vc_year		    = trim($_POST['clsbpFileDetails_vc_year']);	
		if (isset($_POST['clsbpFileDetails_f_track_length']))   $this->vc_TrackLength	= trim($_POST['clsbpFileDetails_f_track_length']);	
		if (isset($_POST['clsbpFileDetails_vc_tags']))          $this->vc_tags		    = trim($_POST['clsbpFileDetails_vc_tags']);
		if (isset($_POST['clsbpFileDetails_dbl_price']))        $this->dbl_price		    = trim($_POST['clsbpFileDetails_dbl_price']);
		if (isset($_POST['clsbpFileDetails_i_in_sell']))       $this->i_in_sell	= trim($_POST['clsbpFileDetails_i_in_sell']);
		if (isset($_POST['clsbpFileDetails_bi_FileIDs']))       $this->bi_FileIDs		= trim($_POST['clsbpFileDetails_bi_FileIDs']);
		if (isset($_POST['clsbpFileDetails_txtSearch']))        $this->txtSearch		= trim($_POST['clsbpFileDetails_txtSearch']); 
		if (isset($_POST['clsbpFileDetails_seachCat']))         $this->seachCat		    = trim($_POST['clsbpFileDetails_seachCat']);	
		if (isset($_POST['clsbpFileDetails_vc_GenreName']))     $this->vc_GenreName	    = trim($_POST['clsbpFileDetails_vc_GenreName']);
		if (isset($_POST['clsbpFileDetails_jumpTo']))           $this->jumpTo	        = trim($_POST['clsbpFileDetails_jumpTo']);
		if (isset($_POST['clsbpFileDetails_returnURL']))           $this->returnURL  	        = trim($_POST['clsbpFileDetails_returnURL']);
		if (isset($_POST['clsbpFileDetails_i_tg_id']))     $this->i_tg_id	    = trim($_POST['clsbpFileDetails_i_tg_id']);
		if (isset($_POST['optSaleStatus']))       $this->opt_i_in_sell	= trim($_POST['optSaleStatus']);
		if (isset($_POST['sellername']))       $this->sellername	= trim($_POST['sellername']);
		/*Advanced Search */
		if (isset($_POST['clsbpFileDetails_lstSeachCat']))           $this->searchCat	        	= trim($_POST['clsbpFileDetails_lstSeachCat']);
		if (isset($_POST['clsbpFileDetails_optSearchType']))           $this->searchType        = trim($_POST['clsbpFileDetails_optSearchType']);
		if (isset($_POST['clsbpFileDetails_lstGenre']))           $this->searchGenre	        	= trim($_POST['clsbpFileDetails_lstGenre']);
		if (isset($_POST['clsbpFileDetails_txtMin']))           $this->searchMinAmount	        = trim($_POST['clsbpFileDetails_txtMin']);
		if (isset($_POST['clsbpFileDetails_txtMax']))           $this->searchMaxAmount	        = trim($_POST['clsbpFileDetails_txtMax']);
		if (isset($_POST['clsbpFileDetails_optSeller']))           $this->searchIfSeller     		= trim($_POST['clsbpFileDetails_optSeller']);
		if (isset($_POST['clsbpFileDetails_lstAct']))           $this->searchAction	        	= trim($_POST['clsbpFileDetails_lstAct']);
		if (isset($_POST['clsbpFileDetails_txtSeller']))           $this->searchSeller	        	= trim($_POST['clsbpFileDetails_txtSeller']);
		if (isset($_POST['clsbpFileDetails_chkSave']))           $this->searchSaveCheck		= trim($_POST['clsbpFileDetails_chkSave']);
		if (isset($_POST['clsbpFileDetails_txtFav']))           $this->searchSaveFav	        	= trim($_POST['clsbpFileDetails_txtFav']);
		if (isset($_POST['clsbpFileDetails_check_list']))      $this->fileIds4sale	                 =       $_POST['clsbpFileDetails_check_list'];
		if(isset($_POST['clsbpFileDetails_delete_list']))      $this->fileIds4delete	                 =       $_POST['clsbpFileDetails_delete_list'];
		if(isset($_POST['clsbpFileDetails_sortColumn'])) 	  $this->sortColumn			=	$_POST['clsbpFileDetails_sortColumn'];
		if(isset($_POST['clsbpFileDetails_sortDirection'])) 	  $this->sortDirection			=	$_POST['clsbpFileDetails_sortDirection'];
		if(isset($_POST['clsbpFileDetails_filelist'])) 	  $this->filelist			=	$_POST['clsbpFileDetails_filelist'];
		if(isset($_POST['clsbpFileDetails_goBack'])) 	  $this->goBack			=	$_POST['clsbpFileDetails_goBack'];
		if (isset($_POST['clsbpFileDetails_SearchGenreId']))	$this->SearchGenreId	       =  trim($_POST['clsbpFileDetails_SearchGenreId']);
		if (isset($_POST['clsbpFileDetails_SearchGenreName']))	$this->SearchGenreName	       =  trim($_POST['clsbpFileDetails_SearchGenreName']);
		if (isset($_POST['clsbpFileDetails_Search_tags']))  $this->Searchtags	            = $_POST['clsbpFileDetails_Search_tags'];
		
		if (isset($_POST['clsbpFileDetails_SaveId']))  $this->saveId	            = $_POST['clsbpFileDetails_SaveId'];

		if (isset($_POST['textfield']))  $this->txtwords	            = $_POST['textfield'];
		if (isset($_POST['tabName']))  $this->tabName	            = $_POST['tabName'];

	}

	function setGetVars() {

		parent::setGetVars();	

		if (isset($_GET['clsbpFileDetails_bi_file_id']))	$this->bi_file_id	    = trim($_GET['clsbpFileDetails_bi_file_id']);
		if (isset($_GET['MemberId']))		                $this->bi_MemberId	    = trim($_GET['MemberId']);
		if (isset($_GET['FileTypeId']))						$this->bi_FileTypeId	= trim($_GET['FileTypeId']);
		if (isset($_GET['clsbpFileDetails_bi_GenreId']))	$this->bi_GenreId	    = trim($_GET['clsbpFileDetails_bi_GenreId']);
		if (isset($_GET['FileName']))						$this->vc_FileName	    = trim($_GET['FileName']);
		if (isset($_GET['FilePath']))						$this->vc_FilePath	    = trim($_GET['FilePath']);
		if (isset($_GET['FileUploaded']))					$this->dt_FileUploaded	= trim($_GET['FileUploaded']);
		if (isset($_GET['FileSize']))						$this->vc_FileSize	    = trim($_GET['FileSize']);
		if (isset($_GET['clsbpFileDetails_vc_artists_nm_mod'])) $this->vc_artists_nm_mod	= trim($_GET['clsbpFileDetails_vc_artists_nm_mod']);
       		if (isset($_GET['clsbpFileDetails_vc_album_nm_mod'])) $this->vc_album_nm_mod	 = trim($_GET['clsbpFileDetails_vc_album_nm_mod']);
		if (isset($_GET['clsbpFileDetails_vc_title_nm_mod'])) $this->vc_title_nm_mod = trim($_GET['clsbpFileDetails_vc_title_nm_mod']);
		if (isset($_GET['sellername']))           $this->sellername  	        = trim($_GET['sellername']);
		if (isset($_GET['clsbpFileDetails_returnURL']))           $this->returnURL  	        = trim($_GET['clsbpFileDetails_returnURL']);
		if (isset($_GET['Comment']))						$this->lt_Comment	    = trim($_GET['Comment']);
		if (isset($_GET['Year']))		   					$this->c_Year	        = trim($_GET['Year']);
		if (isset($_GET['TrackLength']))					$this->vc_TrackLength	= trim($_GET['TrackLength']);
		if (isset($_GET['clsbpFileDetails_vc_tags']))		$this->vc_tags	        = $_GET['clsbpFileDetails_vc_tags'];
		if (isset($_GET['clsbpFileDetails_dbl_price']))		$this->dbl_price	        = trim($_GET['clsbpFileDetails_dbl_price']);
		if (isset($_GET['clsbpFileDetails_i_in_sell']))		$this->i_in_sell	= trim($_GET['clsbpFileDetails_i_in_sell']);
		if (isset($_GET['FileIDs']))						$this->bi_FileIDs	    =  trim($_GET['FileIDs']);
		if (isset($_GET['clsbpFileDetails_vc_GenreName']))	$this->vc_GenreName	       =  trim($_GET['clsbpFileDetails_vc_GenreName']);
		if (isset($_GET['clsbpFileDetails_SearchGenreId']))	$this->SearchGenreId	       =  trim($_GET['clsbpFileDetails_SearchGenreId']);
		if (isset($_GET['clsbpFileDetails_SearchGenreName']))	$this->SearchGenreName	       =  trim($_GET['clsbpFileDetails_SearchGenreName']);
		if (isset($_GET['parameters']))						$this->returnURL           =  trim($_GET['parameters']);		
		if (isset($_GET['clsbpFileDetails_Search_tags']))  $this->Searchtags	            = $_GET['clsbpFileDetails_Search_tags'];
		if (isset($_GET['clsbpFileDetails_lstSeachCat']))  $this->searchCat	            = trim($_GET['clsbpFileDetails_lstSeachCat']);
		if (isset($_GET['clsbpFileDetails_optSearchType'])) $this->searchType        = trim($_GET['clsbpFileDetails_optSearchType']);
		if (isset($_GET['clsbpFileDetails_lstGenre']))      $this->searchGenre	        = trim($_GET['clsbpFileDetails_lstGenre']);
		if (isset($_GET['clsbpFileDetails_txtMin']))        $this->searchMinAmount	    = trim($_GET['clsbpFileDetails_txtMin']);
		if (isset($_GET['clsbpFileDetails_txtMax']))        $this->searchMaxAmount	    = trim($_GET['clsbpFileDetails_txtMax']);
		if (isset($_GET['clsbpFileDetails_optSeller']))     $this->searchIfSeller       = trim($_GET['clsbpFileDetails_optSeller']);
		if (isset($_GET['clsbpFileDetails_lstAct']))        $this->searchAction	        = trim($_GET['clsbpFileDetails_lstAct']);
		if (isset($_GET['clsbpFileDetails_txtSeller']))     $this->searchSeller	        = trim($_GET['clsbpFileDetails_txtSeller']);
		if (isset($_GET['clsbpFileDetails_chkSave']))       $this->searchSaveCheck		= trim($_GET['clsbpFileDetails_chkSave']);
		if (isset($_GET['[clsbpFileDetails_txtFav']))       $this->searchSaveFav	    = trim($_GET['clsbpFileDetails_txtFav']);
		//if (isset($_GET['[clsbpFileDetails_check_list']))           				$this->fileIds4sale	        = trim($_GET['clsbpFileDetails_check_list']);
		if(isset($_GET['clsbpFileDetails_delete_list']))      $this->fileIds4delete	                 =       $_GET['clsbpFileDetails_delete_list'];
		
		if(isset($_GET['filelist']))      $this->filelist	                 =       $_GET['filelist'];
		
		if(isset($_GET['feedbacklist']))      $this->feedbacklist	                 =       $_GET['feedbacklist'];
		
		if (isset($_GET['clsbpFileDetails_txtSearch']))        $this->txtSearch		= trim($_GET['clsbpFileDetails_txtSearch']); 
		
		if (isset($_GET['clsbpFileDetails_SaveId']))  $this->saveId	            = $_GET['clsbpFileDetails_SaveId'];
		if (isset($_GET['textfield']))  $this->txtwords	            = $_GET['textfield'];
		if (isset($_GET['tabName']))  $this->tabName	            = $_GET['tabName'];
	}
	
	// add/edit genre information
	function saveFileDetails($FileID) { 

		//if (!$this->validateFileInfo()) return 0;	

		if (trim($FileID) ==  "") {

			$query	= " INSERT INTO   
							tbl_member_files 
							(
								vc_Tags,
								f_price
							) 
						VALUES 
							(
								\"$this->vc_Tags\",
								\"$this->f_price\"
								
							)";


			
			$dbQry	            = new dbQuery($query, $this->connect->connId);
			$this->bi_FileID	= $dbQry->lastInsertId();
			
			//$_SESSION["BPMESSAGE"]	= "Song details added successfully";	

		} 
		else {

			   $query	= "	UPDATE 
							tbl_member_files 
						SET 
							vc_Tags   = \"$this->vc_Tags\",
							f_price   = \"$this->f_price\",
							ti_FileStatus=1
						WHERE 
							bi_FileID   = $FileID";
							

			$dbQry	        = new dbQuery($query, $this->connect->connId);
			$this->bi_FileID	= $bi_FileID;
			
			//$_SESSION["BPMESSAGE"]	= "Post details updated successfully";	
			
		}
		return $this->bi_FileID;
	}
	
	// function to validate genre while insert an new and update an exsisting genre.
	function validateFileInfo() { 
		
			$_SESSION["BPMESSAGE"]    = "";	
			
		if (trim($this->GenreName) == "") {
			$_SESSION["BPMESSAGE"] .= "Genre Name cannot be null <BR>";
		}

		 $query	= " SELECT 
						* 
					FROM 
						lkup_genre 
					WHERE 
						vc_GenreName = '$this->GenreName' "; 
		if (trim($this->GenreId) != "") {
			$query	.= " AND bi_GenreId != $this->GenreId";
		}

		$dbQry	= new dbQuery($query, $this->connect->connId);		
		if ($dbQry->numRows() > 0) {				
			$_SESSION["BPMESSAGE"] .= "The Genre already exist";
		} 

	if (strlen($_SESSION["BPMESSAGE"]) > 0) {
			return 0;
		} else {
			return 1;
		}						
	}
//Retrieve A Tag Row

function retrieveTagName() {

		

	 $query	= " SELECT 
						vc_Tags
					FROM 
						tbl_member_files WHERE  ti_lock=0
					"; 
						
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveTagNameRow($dbQry);
		return $dbQry->numRows();
	
	} 
	
       function retrieveTagNameRow($dbQry) {

		if(!$dbQry->numRows()) return 0;

	        $row				= $dbQry->getArray(); 
		
		$this->vc_Tags	= $row["vc_Tags"];
		
			
		return 1;
	}
	function retrieveTagNameArray() { 	
		
	 $query	= " SELECT vc_tags FROM
				tbl_id3_tags,tbl_bopabox WHERE 1=1 
					AND  
				
				tbl_bopabox.ti_lock=0 
					AND 
				tbl_bopabox.i_in_sell=1 
					AND 
				tbl_bopabox.i_tg_id = tbl_id3_tags.i_tg_id ";
	if(isset($_SESSION['USERID'])) {
		$query .= " AND tbl_bopabox.bi_MemberId !=".$_SESSION['USERID'];
		}

		
		$dbQry	= new dbQuery($query, $this->connect->connId);	
	    
		  return  $this->retrieveTagNameRowArray($dbQry);  
		
	}
	
	function retrieveTagNameRowArray($dbQry) {
	
		$arrTags	= array();
		while($row = $dbQry->getArray()) {
			$arrTags[]	= array("vc_tags"			=> $row["vc_tags"]);
		}
		
	return $arrTags;

	}
//
// retrive a single row 
	function retrieveFile($FileID) {

		if (trim($FileID) == "") return 0;

	 
	 $query = "SELECT * 
				FROM  
					tbl_mem_login login,
					tbl_mem_details member, 
					tbl_bopabox bpbox, 
					tbl_papa papa, 
					tbl_id3_tags id3
				WHERE 
					login.bi_MemberId = member.bi_MemberId
						AND
					member.bi_MemberId = bpbox.bi_MemberId 
						AND
					bpbox.bi_file_id = papa.bi_file_id
						AND 
					bpbox.i_tg_id = id3.i_tg_id 
						AND 
					bpbox.bi_file_id = $FileID ";
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->retrieveFileRow($dbQry);
	return	 $dbQry->numRows();
	}
	
	
	function retrieveFileRow($dbQry) {

		if(!$dbQry->numRows()) return 0;
		
		$row				= $dbQry->getArray();

		$this->vc_SongName = $row["vc_title_nm_mod"];
		$this->bi_file_id	    = $row["bi_file_id"];	
		$this->bi_MemberId	    = $row["bi_MemberId"];
		$this->bi_sellerId	    = $row["bi_MemberId"];
		$this->bi_FileTypeId	= $row["bi_FileTypeId"];
		$this->bi_GenreId	    = $row["bi_GenreId"];
		$this->vc_FileName		= $row["vc_FileName"];
		$this->vc_FilePath		= $row["vc_FilePath"];
		$this->dt_FileUploaded	= $row["dt_FileUploaded"];
		$this->vc_FileSize		= $row["vc_FileSize"];
		$this->vc_artists_nm_mod = $row["vc_artists_nm_mod"];
		$this->vc_album_nm_mod	    = $row["vc_album_nm_mod"];
		$this->vc_title_nm_mod	    = $row["vc_title_nm_mod"];
		$this->lt_Comment	    = $row["lt_comment"];
		$this->vc_year		    = $row["vc_year"];
		$this->f_track_length   = $row["f_track_length"];
		$this->vc_tags		    = $row["vc_tags"];
		$this->dbl_price		    = $row["dbl_price"];
		$this->i_in_sell    = $row["i_in_sell"];
		$this->i_tg_id    = $row["i_tg_id"];	
		$this->vc_genre_mod = $row['vc_genre_mod'];
		$this->f_bitrate = $row['f_bitrate'];
		$this->f_track_lengthf_track_length = $row['f_track_length'];
		
		$this->memberDisplayName=$row['vc_DisplayName'];		
	
		return 1;
	}
	
	
	function retrieveFileArray() { 	
		
		$arrObj = get_object_vars($this);
		$query = "SELECT tbl_bopabox.bi_file_id,tbl_bopabox.vc_FileName, tbl_bopabox.bi_MemberId, tbl_bopabox.dbl_price, tbl_bopabox.i_in_sell, tbl_bopabox.ti_lock, tbl_id3_tags.vc_title_nm_mod, tbl_id3_tags.vc_artists_nm_mod, tbl_id3_tags.vc_album_nm_mod,tbl_id3_tags.vc_tags,tbl_bopabox.bi_GenreId,tbl_id3_tags.f_bitrate,lkup_genre.vc_GenreName
					FROM tbl_bopabox
					INNER JOIN tbl_id3_tags ON tbl_id3_tags.i_tg_id = tbl_bopabox.i_tg_id
					INNER JOIN lkup_genre ON lkup_genre.bi_GenreId = tbl_bopabox.bi_GenreId
					WHERE 1 =1
					AND tbl_bopabox.ti_lock =0
					AND tbl_bopabox.i_in_sell =1
					";
		
 // $query	= " SELECT	*
								
					//FROM	

					//tbl_bopabox bpbox,tbl_id3_tags id3
					//WHERE 
					// bpbox.i_tg_id = id3.i_tg_id  AND bpbox.ti_lock=0 AND bpbox.i_in_sell=1";
	  	//die("category: ".$this->seachCat.", keyword: ".$this->txtSearch);
		if(isset($_SESSION['USERID'])) {
			$query .= " AND tbl_bopabox.bi_MemberId !=".$_SESSION['USERID'];
		}
		
		if (trim($this->seachCat) == "artists" && trim($this->txtSearch) != "" ) {
 			$query .= " AND tbl_id3_tags.vc_artists_nm_mod LIKE '%".$this->txtSearch."%'";
 		}
		if (trim($this->seachCat) == "albums" && trim($this->txtSearch) != "")  {
			$query .= " AND tbl_id3_tags.vc_album_nm_mod LIKE '%".$this->txtSearch."%' ";
		}


		if (trim($this->seachCat) == "songs" && trim($this->txtSearch) != "" ) {
			$query .= " AND tbl_id3_tags.vc_title_nm_mod LIKE '%".$this->txtSearch."%'";
		}


		if (trim($this->seachCat) == "sellers" && trim($this->txtSearch) != "" )  {
			$query.=  " AND (tbl_id3_tags.vc_artists_nm_mod LIKE '%".$this->txtSearch."%' OR tbl_id3_tags.vc_album_nm_mod LIKE '%".$this->txtSearch."%' OR tbl_id3_tags.vc_title_nm_mod LIKE '%".$this->txtSearch."%' )";
		}

		if ((trim($this->seachCat) == "all") || (trim($this->seachCat) == "" && trim($this->txtSearch)!="" && trim($this->txtSearch)!="Search All Music") ) {
			$query .= " AND (tbl_id3_tags.vc_artists_nm_mod LIKE '%".$this->txtSearch."%' OR tbl_id3_tags.vc_album_nm_mod LIKE '%".$this->txtSearch."%' OR tbl_id3_tags.vc_title_nm_mod LIKE '%".$this->txtSearch."%' OR lkup_genre.vc_GenreName = '".$this->txtSearch."' OR tbl_id3_tags.vc_tags = '".$this->txtSearch."' )";
			
		}

        if (trim($this->SearchGenreId) != "") 
			$query	.= " AND tbl_bopabox.bi_GenreId LIKE '%".$this->SearchGenreId."%' ";
			
		//if (trim($this->vc_GenreName) != "") 
			//$query	.= " AND vc_GenreName LIKE '%".$this->vc_GenreName."%'";
			
		if (trim($this->Searchtags) != "") 
		 	$query	.= " AND   	tbl_id3_tags.vc_tags LIKE '%".$this->Searchtags."%'"; 
			
		if (trim($this->vc_title_nm_mod) != "") 
			$query	.= " AND tbl_id3_tags.vc_title_nm_mod LIKE '%".$this->vc_title_nm_mod."%' ";	
				
		if (trim($this->bi_FileIDs) != "") 
			$query	.= " AND bpbox.bi_file_id IN($this->bi_file_ids)";
			
			
  $query	.= " ORDER BY $this->sortColumn $this->sortDirection";  

	if($this->jumpTo !="")
	$this->pageIndex=$this->jumpTo;
	
		$dbQry	= new dbQuery($query, $this->connect->connId);
		
 		//echo $dbQry->numRows();
 		if(($this->txtSearch!='') && ($this->txtSearch!='Search All Music') &&( $this->txtSearch!='Search artists' )&& ($this->txtSearch!='Search songs') && ($this->txtSearch!='Search sellers')){
				if($this->ifExistSearchRecord($this->txtSearch)) {
					$this->updateSearchRecord($this->txtSearch, $dbQry->numRows())	;
				}
				else{
					$this->insertSearchRecord($this->txtSearch, $dbQry->numRows())	;
				}
		}
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->searchSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveFileRowArray($this->clsbpPaginate);
	}
	
	function ifExistSearchRecord($keyWord) {
		$query = "SELECT 
					* 
				FROM 
					tbl_search_records
				WHERE
					 vc_searchKeyword = '$keyWord'
				";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		
		//echo "<br>exist count".$dbQry->numRows();
		return $dbQry->numRows();
	}
	
	function updateSearchRecord($keyWord, $resultCount) {
	
		$query = "SELECT 
					bi_searchKeywordCount 
				FROM 
					tbl_search_records
				WHERE
					 vc_searchKeyword = '$keyWord'
				";
		$dbQry	= new dbQuery($query, $this->connect->connId);
		$row				= $dbQry->getArray();
		$previousCount = $row['bi_searchKeywordCount'];
		$currentCount = $previousCount+1;
		
		$updateQuery = "	UPDATE 
							tbl_search_records
						SET
							bi_searchResultCount = $resultCount,
							bi_searchKeywordCount = $currentCount
						WHERE
					 		vc_searchKeyword = '$keyWord'"	;
		$dbQry	= new dbQuery($updateQuery, $this->connect->connId);
		
	}
	
	function insertSearchRecord($keyWord, $resultCount) {
	
		$insertQuery = "	INSERT INTO
							tbl_search_records(
								vc_searchKeyword,
								bi_searchResultCount,
								bi_searchKeywordCount
							)
						VALUES
							(
								'$keyWord',
								$resultCount,
								1
							)";
		$dbQry	= new dbQuery($insertQuery, $this->connect->connId);
		
	}
	
	function retrieveFileArrays() { 	
		
		
		 $query	= " SELECT *FROM tbl_member_files  WHERE  1=1 AND  ti_FileStatus=0  ";
					
		if($this->jumpTo !="")
			$this->pageIndex=$this->jumpTo;
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->searchSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);
		return $this->retrieveFileRowArray($this->clsbpPaginate);
	}
	
	/**
		@name: retrieveAdvFileArray
		@version: 1.0
		@date: 07-04-2008, Monday
		@param: Nil
		@return: Array, contains the search result
		
		This function retrives all the records for advanced search result page, according to the selected search parameters
	*/
	function retrieveAdvFileArray() { 
		
		if($this->saveId == 0) {
			$query	= "SELECT *
						FROM 
						    tbl_mem_login memlogin,
							tbl_mem_details member, 
							tbl_bopabox bpbox, 
							tbl_papa papa, 
							tbl_id3_tags id3
						WHERE 
						memlogin.bi_MemberId  = bpbox.bi_MemberId
						        AND
							member.bi_MemberId = bpbox.bi_MemberId
								AND 
							bpbox.bi_file_id = papa.bi_file_id
								AND 
							bpbox.i_tg_id = id3.i_tg_id 
								AND 
							bpbox.ti_lock=0 
								AND 
							bpbox.i_in_sell=1";
	
			if(isset($_SESSION['USERID'])) {
				$query .= " AND member.bi_MemberId !=".$_SESSION['USERID'];
			}
	
			
			
			
			if($this->searchCat !="" && $this->txtSearch !="") {
				
				switch($this->searchCat) {
						case "artist":
									$query .= " AND id3.vc_artists_nm_mod  LIKE '%".$this->txtSearch."%'";
									break;
						case "album": 
									$query .= " AND  id3.vc_album_nm_mod LIKE '%".$this->txtSearch."%'";
									break;
						case "song": 
									$query .= " AND  id3.vc_title_nm_mod LIKE '%".$this->txtSearch."%'";
									break;
						default 	   :
									$query .= " AND (id3.vc_artists_nm_mod LIKE '%".$this->txtSearch."%' OR id3.vc_album_nm_mod LIKE '%".$this->txtSearch."%' OR id3.vc_title_nm_mod LIKE '%".$this->txtSearch."%')";
									break;
					
				}
			}
			
			
			if($this->searchType !="") {
				
				switch($this->searchType) {
						case "1":
									$type .= " AND bpbox.bi_FileTypeId LIKE '%".$this->searchType."%'";
									break;
						case "2": 
									$query .= " AND  bpbox.bi_FileTypeId LIKE '%".$this->searchType."%'";
									break;
	// 					default 	   :
	// 								$query .= " AND bi_FileTypeId LIKE '%".$this->searchType."%' OR bi_FileTypeId LIKE '%".$this->searchType."%' OR vc_SongName LIKE '%".$this->searchType."%' ";
	// 								break;
					
				}
			}
			
			
			if($this->searchType !="") {
				if($this->searchType !=0) {
					$query .= " AND  bpbox.bi_FileTypeId = ".$this->searchType;
				}
			}
			
			if($this->searchGenre !="") {
				if($this->searchGenre !=0) {
					$query .= " AND  bpbox.bi_GenreId = ".$this->searchGenre;
				}
			}
			
			if($this->searchGenre !="") {
				if($this->searchGenre !=0) {
					$query .= " AND  bpbox.bi_GenreId = ".$this->searchGenre;
				}
			}
			
			if($this->searchMinAmount != "" && $this->searchMaxAmount =="") {
				
					$query .= " AND  bpbox.dbl_price >= ".$this->searchMinAmount;
			}
			
			else if($this->searchMinAmount == "" && $this->searchMaxAmount !="") {
				
					$query .= " AND  bpbox.dbl_price <= ".$this->searchMaxAmount;
			}
			else if($this->searchMinAmount = $this->searchMaxAmount) {
				
					$query .= " AND  bpbox.dbl_price = ".$this->searchMinAmount;
			}
			else if($this->searchMinAmount != "" && $this->searchMaxAmount !="") {
				if($this->searchMinAmount < $this->searchMaxAmount) {
					$query .= " AND  (bpbox.dbl_price >= ".$this->searchMinAmount." AND bpbox.dbl_price <=".$this->searchMaxAmount.")";
				}
			}
			
			
			if($this->searchIfSeller != "") {
				//die($this->searchAction);
				switch($this->searchAction) {
					
					case '1': 	if($this->searchSeller!="") {
								$query .= " AND (member.vc_FirstName LIKE '%".$this->searchSeller."%' OR member.vc_LastName LIKE '%".$this->searchSeller."%'  OR memlogin.vc_DisplayName LIKE '%".$this->searchSeller."%')";
							}
							break;
							
					case '0': 	if($this->searchSeller!="") {
								$query .= " AND (member.vc_FirstName NOT LIKE '%".$this->searchSeller."%' OR member.vc_LastName NOT LIKE '%".$this->searchSeller."%'  OR memlogin.vc_DisplayName LIKE '%".$this->searchSeller."%')";
							}
							break;
				}
				
				
			}
			
			
				
			if (trim($this->vc_Tags) != "") 
				$query	.= " AND id3.vc_Tags LIKE '%".$this->vc_Tags."%' ";
				
			if (trim($this->vc_SongName) != "") 
				$query	.= " AND id3.vc_SongName LIKE '%".$this->vc_SongName."%' ";	
					
	// 		if (trim($this->bi_FileIDs) != "") 
	// 			$query	.= " AND bi_FileID IN($this->bi_FileIDs)";
				
		
		$query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
	    
	    }
	    else {
		$query = $this->retriveSavedQuery();
	    }
	    
	    $dbQry	        = new dbQuery($query, $this->connect->connId);
	    
	    if(($this->txtSearch!='') && ($this->txtSearch!='Search All Music') &&( $this->txtSearch!='Search artists' )&& ($this->txtSearch!='Search songs') && ($this->txtSearch!='Search sellers')){
		if($this->ifExistSearchRecord($this->txtSearch)) {
			$this->updateSearchRecord($this->txtSearch, $dbQry->numRows())	;
		}
		else{
			$this->insertSearchRecord($this->txtSearch, $dbQry->numRows())	;
		}
	}

		
	if(isset($_SESSION['USERID'])) {
		if($this->searchSaveCheck!="" && $this->searchSaveCheck=="1"){
			$saveName = mysql_escape_string($this->searchSaveFav);
			if($saveName=="") {
				$saveName = "Saved Search";
			}
			$queryToSave = addslashes($query);
			$saveDate = date('Y-m-d');
			$memberId = $_SESSION['USERID'];
			if($this->saveId==0) {
				$saveQuery = "INSERT INTO
							tbl_savedsearch 
							VALUES (
									'', 
									$memberId, 
									'$saveName',
									'$this->txtSearch',
									'$this->searchCat',
									'$this->searchType',
									'$this->searchGenre',
									'$this->searchMinAmount',
									'$this->searchMaxAmount',
									'$this->searchIfSeller',
									'$this->searchAction',
									'$this->searchSeller',
									'$queryToSave', 
									'$saveDate')";
			}
			else {
				$saveQuery = "UPDATE  
								tbl_savedsearch 
							SET 
								vc_SaveName= '$saveName', 
								vc_keyWord = '$this->txtSearch', 
								vc_kewordType ='$this->searchType',
								vc_songType = '$this->searchType', 
								vc_songGenre = '$this->searchGenre',
								bi_minPrice='$this->searchMinAmount', 
								bi_maxPrice ='$this->searchMaxAmount', 
								vc_sellerType= '$this->searchIfSeller', 
								vc_SellerOption = '$this->searchAction',
								vc_SellerName = '$this->searchSeller',
								txt_SearchQuery = '$queryToSave',
								dt_CreatedDate='$saveDate'
							WHERE 
								bi_SearchId = '$this->saveId'
									AND 
								bi_MemberId = ".$_SESSION['USERID'];
			}
			$dbQry	        = new dbQuery($saveQuery, $this->connect->connId);
		}
	}
	
	    
	
	
	if($this->jumpTo !="")
		$this->pageIndex=$this->jumpTo;
	
	
	 
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->searchSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveFileRowArray($this->clsbpPaginate);
	}
	
	function retriveSavedQuery() {
		$retriveQuery = "SELECT txt_SearchQuery FROM tbl_savedsearch WHERE bi_SearchId= $this->saveId AND bi_MemberId = ".$_SESSION['USERID'];
		$dbQry	        = new dbQuery($retriveQuery, $this->connect->connId);
		$row			= $dbQry->getArray();
		return $row["txt_SearchQuery"];
	}
	
	/**
		@name: populateAdvSearchForm
		@version: 1.0
		@date: 12-05-2008, Monday
		@param: Nil
		@return: Array, contains the search result
		
		This function fetches data for populating the 
	*/

function populateAdvSearch() {
	
	
	$query	= " SELECT * FROM `tbl_savedsearch` WHERE `bi_SearchId` = $this->saveId AND bi_MemberId = ".$_SESSION['USERID'];
	$dbQry	        = new dbQuery($query, $this->connect->connId);
	$this->doPopulate($dbQry);
	return 1;
}

function doPopulate($dbQry) {

		if(!$dbQry->numRows()) return 0;
		
		$row				= $dbQry->getArray();
		
		$this->txtSearch = $row['vc_keyWord'];
		$this->searchCat = $row['vc_kewordType'];
		$this->searchType = $row['vc_songType'];
		$this->searchGenre = $row['vc_songGenre'];
		$this->searchMinAmount = $row['bi_minPrice'];
		$this->searchMaxAmount = $row['bi_maxPrice'];
		$this->searchIfSeller = $row['vc_sellerType'];
		$this->searchAction= $row['vc_SellerOption'];
		$this->searchSeller = $row['vc_SellerName'];
		$this->searchSaveFav =  $row['vc_SaveName'];
	
		return 1;
}
// function for retreving file details 
// used for bopabox page
function retrieveBopaBoxArray() { 	
	//echo $this->filelist;

		
		 $query	= " SELECT * 
					FROM tbl_bopabox bpbox, tbl_papa papa, tbl_id3_tags id3
					WHERE bpbox.bi_file_id = papa.bi_file_id
					AND bpbox.i_tg_id = id3.i_tg_id 
					AND bi_MemberId=$this->bi_MemberId";
						
	if($_REQUEST[tabName]=="Sale"){

	$query .=" AND i_in_sell=1";
	}



	if($_REQUEST[tabName]=="Purchase"){

	 $query ="SELECT * FROM tbl_bopabox bpbox, tbl_papa papa, tbl_id3_tags id3, tbl_file_history history 
	 WHERE bpbox.bi_file_id = papa.bi_file_id AND
	 bpbox.i_tg_id = id3.i_tg_id  AND history.bi_BuyerId=$this->bi_MemberId AND
	 bpbox.bi_MemberId=history.bi_BuyerId AND
	 bpbox.bi_file_id =history.bi_FileId";
	
	}
	
	if($_REQUEST[tabName]=="MyUploads"){

/* $query ="SELECT * FROM tbl_bopabox bpbox, tbl_papa papa, tbl_id3_tags id3, tbl_file_history history 
	 WHERE bpbox.bi_file_id = papa.bi_file_id AND
	 bpbox.i_tg_id = id3.i_tg_id  AND history.bi_FileId=bpbox.bi_file_id AND bpbox.bi_MemberId=$this->bi_MemberId AND
	 history.bi_BuyerId!=bpbox.bi_MemberId";*/
	 
 $query ="SELECT tbl_bopabox.bi_file_id, tbl_bopabox.bi_MemberId, tbl_id3_tags.vc_title_nm_mod, tbl_id3_tags.vc_artists_nm_mod, tbl_id3_tags.vc_album_nm_mod, tbl_bopabox.i_in_sell
FROM tbl_bopabox
INNER JOIN tbl_papa ON tbl_bopabox.bi_file_id = tbl_papa.bi_file_id
INNER JOIN tbl_id3_tags ON tbl_bopabox.i_tg_id = tbl_id3_tags.i_tg_id
  WHERE tbl_bopabox.bi_MemberId =$this->bi_MemberId AND NOT EXISTS (SELECT * FROM tbl_file_history history
    WHERE tbl_bopabox.bi_file_id = history.bi_FileId AND history. bi_BuyerId=$this->bi_MemberId)";
	}
if($_GET['searchWord']!=""){

$words = preg_replace('/\s\s+/', ' ', trim($_GET['searchWord']));
$keywords = explode(" ",$words);
$k=1;
foreach($keywords as $srkeyword){
if($k==1){
$srkeyquery="";
$k++;
}
else
{
$srkeyquery.=" OR ";
}
$srkeyquery.=" vc_title_nm_mod LIKE '%$srkeyword%' OR vc_artists_nm_mod LIKE '%$srkeyword%' OR vc_album_nm_mod LIKE '%$srkeyword%'";

}
$srkeyquery=" AND (".$srkeyquery.")";
$query.=$srkeyquery;
}
//print($query);
//exit;
//print_r($_GET);
if($_GET['sortColumn']!='' && $_GET['sortDirection']!='' ){
	   print $query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
		}
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveFileRowArray($this->clsbpPaginate);
}


// function for fetching database values and assign to an array - $arrFile
// called on function retrieveBopaBoxArray (above)
function retrieveFileRowArray($dbQry) {
	
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_file_id"]]	= array(
													
												"bi_file_id"	    => $row["bi_file_id"],	
												"bi_MemberId"	    => $row["bi_MemberId"],
												"bi_FileTypeId"	    => $row["bi_FileTypeId"],
												"bi_GenreId"	    => $row["bi_GenreId"],
											    "vc_FileName"	    => $row["vc_FileName"],
												"vc_FilePath"		=> $row["vc_FilePath"],
												"dt_FileUploaded"	=> $row["dt_FileUploaded"],
												"vc_FileSize"		=> $row["vc_FileSize"],
												"vc_artists_nm_mod"	=> $row["vc_artists_nm_mod"],
												"vc_album_nm_mod"	=> $row["vc_album_nm_mod"],
												"vc_title_nm_mod"	=> $row["vc_title_nm_mod"],
												"lt_comment"	    => $row["lt_comment"],
												"vc_year"		    => $row["vc_year"],
												"f_track_length"    => $row["f_track_length"],
												"dbl_price"		    => $row["dbl_price"],
												"f_bitrate"		    => $row["f_bitrate"],
												"i_in_sell"		    => $row["i_in_sell"]
												);
		}			
		return $arrFile;
	}
	

/**Get file array of the current logged user - Used in Sel-Signedin*/
function getMemberFileArray($memberId) {
	$query  = " SELECT * 
					FROM tbl_bopabox bpbox,  tbl_id3_tags id3
					WHERE bpbox.i_tg_id = id3.i_tg_id 
					AND bpbox.bi_MemberId=$memberId AND bpbox.i_in_sell=1";
	$query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
	
	$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);
	return $this->retrieveFileRowArray($this->clsbpPaginate);
	
}

function getSongDetails($artistName, $albumName) {
	$query = "SELECT COUNT(*) as count_files, MIN(bpbox.dbl_price) as min_price, MAX(bpbox.dbl_price)  as max_price
				FROM 
					tbl_bopabox bpbox, 
					tbl_id3_tags id3
				WHERE 
					bpbox.i_tg_id = id3.i_tg_id 
						AND
					id3.vc_title_nm_mod = '$artistName'
						AND 
					id3.vc_artists_nm_mod = '$albumName'
						AND
					bpbox.i_in_sell =1";
	$dbQry	= new dbQuery($query, $this->connect->connId);	
	$this->retrieveSongRow($dbQry);
	
}

function getSellPageDet($memberId) {
	$query =  " SELECT *
				FROM (

						SELECT bi_file_id, dbl_price
						FROM tbl_bopabox
						INNER JOIN tbl_id3_tags ON tbl_id3_tags.`i_tg_id` = tbl_bopabox.`i_tg_id`
						WHERE tbl_bopabox.bi_memberId =$memberId  AND tbl_bopabox.i_in_sell=1
					  ) AS t2
				LEFT JOIN (

						SELECT id3.vc_title_nm_mod, id3.vc_artists_nm_mod, bpbox.bi_file_id AS file_id, COUNT( * ) AS count_files, MIN( bpbox.dbl_price ) AS min_price, MAX( bpbox.dbl_price ) AS max_price
						FROM tbl_bopabox bpbox, tbl_id3_tags id3
						WHERE bpbox.i_tg_id = id3.i_tg_id
						GROUP BY id3.vc_title_nm_mod
						) AS t1 ON t2.bi_file_id = t1.file_id";
			$query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
			$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);
			return $this->retrieveSellPageArray($this->clsbpPaginate);
}

function retrieveSellPageArray($dbQry) {
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_file_id"]]	= array(
													
												"bi_file_id"	    => $row["file_id"],	
												"vc_artists_nm_mod"	=> $row["vc_artists_nm_mod"],
												"vc_album_nm_mod"	=> $row["vc_album_nm_mod"],
												"vc_title_nm_mod"	=> $row["vc_title_nm_mod"],
												"dbl_price"		    => $row["dbl_price"],
												"count_files"		    => $row["count_files"],
												"min_price"		    => $row["min_price"],
												"max_price"		    => $row["max_price"]
												);
		}			
		return $arrFile;
	}





function retrieveSongRow($dbQry) {
	
		if(!$dbQry->numRows()) 
			return 0;
			
		$row= $dbQry->getArray();
			
		$this->minPrice = $row['min_price'];
		$this->maxPrice = $row['max_price'];
		$this->countFiles = $row['count_files'];
		
		$arrObj = get_object_vars($this);

		return 1;
	}
//-------------------------------------//	
// Function for updating tags and price
// called at post for sale module	
function updateFileDetails($FileID){

	          $query	= "	UPDATE 
							tbl_bopabox,tbl_id3_tags
						SET 
							tbl_id3_tags.vc_tags   = \"$this->vc_tags\",
							tbl_bopabox.dbl_price   = \"$this->dbl_price\",
							tbl_bopabox.i_in_sell=1
						WHERE 
							 tbl_bopabox.i_tg_id=tbl_id3_tags.i_tg_id  AND tbl_bopabox.bi_file_id = $FileID ";
							

			$dbQry	        = new dbQuery($query, $this->connect->connId);
return 1;
}




//------------------------------------------//

//-------------------------------------//	
// Function for updating Song Sale Status
// called at Bopabox module	
function updateSongDetails($FileID){
if($this->opt_i_in_sell == 1)
{
	          $query	= "	UPDATE 
							tbl_bopabox,tbl_id3_tags
						SET 
						
							tbl_bopabox.dbl_price   = \"$this->dbl_price\",
							tbl_bopabox.i_in_sell=\"$this->opt_i_in_sell\"
						WHERE 
							 tbl_bopabox.i_tg_id=tbl_id3_tags.i_tg_id  AND tbl_bopabox.bi_file_id = $FileID ";
}
if($this->opt_i_in_sell == 0)
{
	          $query	= "	UPDATE 
							tbl_bopabox,tbl_id3_tags
						SET 
						
						
							tbl_bopabox.i_in_sell=\"$this->opt_i_in_sell\"
						WHERE 
							 tbl_bopabox.i_tg_id=tbl_id3_tags.i_tg_id  AND tbl_bopabox.bi_file_id = $FileID ";
							}							
						

			$dbQry	        = new dbQuery($query, $this->connect->connId);
return 1;
}




//------------------------------------------//

// Function for updating Song Sale Status
// called at Bopabox module	
function updateSongStatusDetails($FileID){

	          $query	= "	UPDATE 
							tbl_bopabox,tbl_id3_tags
						SET 
						
							
							tbl_bopabox.i_in_sell=\"$this->opt_i_in_sell\"
						WHERE 
							 tbl_bopabox.i_tg_id=tbl_id3_tags.i_tg_id  AND tbl_bopabox.bi_file_id = $FileID ";
							

			$dbQry	        = new dbQuery($query, $this->connect->connId);
return 1;
}




//------------------------------------------//



// Functtion for updatiing file ionformation
// Called for file details page from bopabox
function updateFileInfo($i_tg_id){

if (!$this->fn_validateFileDetails()) return 0;	

	  $query	= "	UPDATE 
							tbl_id3_tags 
						SET 
							vc_title_nm_mod=\"$this->vc_title_nm_mod\",
							vc_artists_nm_mod=\"$this->vc_artists_nm_mod\",
							vc_album_nm_mod=\"$this->vc_album_nm_mod\",
							vc_genre_mod=\"$this->bi_GenreId\",
							lt_comment=\"$this->lt_Comment\",
							vc_tags=\"$this->vc_tags\"
							
						WHERE 
							i_tg_id   = $i_tg_id";

			$dbQry	        = new dbQuery($query, $this->connect->connId);
	return 1;

}

//-----------------------------------//
// function for validation
 
 // check song name already exsist
 // called from function fn_validateFileDetails()
 
 function checkSongNameExist() {
	 $query	= " SELECT 
						* 
					FROM 
						tbl_id3_tags tags, tbl_bopabox box 
					WHERE 
						 tags.vc_title_nm_mod = '$this->vc_title_nm_mod' AND box.bi_MemberId=$this->bi_MemberId AND tags.i_tg_id!=$this->i_tg_id";	
				
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $dbQry->numRows();
}

// main validation function 
function fn_validateFileDetails() {


		$_SESSION["BPMESSAGE"] 	= "";	
		if (trim($this->vc_title_nm_mod) == "") {
			$_SESSION["BPMESSAGE"] .= "* Please enter Song Name<BR>";
		}
	
		if (trim($this->vc_artists_nm_mod) == "") {
			$_SESSION["BPMESSAGE"] .= "* Please enter Artist Name<BR>";
		}
		if (trim($this->vc_album_nm_mod) == "") {
			$_SESSION["BPMESSAGE"] .= "* Please enter Album Name<BR>";
		}
		if (trim($this->bi_GenreId) == 0) {
			$_SESSION["BPMESSAGE"] .= "* Please select Genre<BR>";
		}
		if (trim($this->vc_tags) == "") {
			$_SESSION["BPMESSAGE"] .= "* Please enter Tags&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<BR>";
		}
		
		if (strlen($_SESSION["BPMESSAGE"]) > 0) {
		
			return 0;
		
		} else {
		
			return 1;
		}	
}
//---------------- End of validation section--------------//

// Function for creating genre list
function getAllGenre() { 	
		
		$query	= "SELECT * FROM lkup_genre  order by vc_GenreName ASC";		
		
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		return $this->retrieveGenreRowArray($dbQry);
	
}

function retrieveGenreRowArray($dbQry) {
	
		$arrGenreDeatils	= array();
		
		while($row= $dbQry->getArray()) {
		
		$arrGenreDeatils[$row["bi_GenreId"]]	= array("bi_GenreId"=> $row["bi_GenreId"],"vc_GenreName"=> $row["vc_GenreName"]);
						
		}	
			
		return $arrGenreDeatils;
	}
	
function deleteFile($fileId) {
	$arrFileDetails  = $this->retrieveFile($fileId); // Retrive file details first
	
	$deleteBopaboxQuery = "DELETE FROM tbl_bopabox WHERE bi_file_id=$this->bi_file_id";  // 
	$deletePapaQuery = "DELETE FROM tbl_papa WHERE bi_file_id=$this->bi_file_id";
	$delete_id3tagQuery = "DELETE FROM tbl_id3_tags WHERE i_tg_id = $this->i_tg_id";
	
	unlink($this->vc_FilePath.$this->vc_FileName); //DELETE FILE
	
	//die($deleteBopaboxQuery."<br>".$deletePapaQuery."<br>".$delete_id3tagQuery);
	
	$dbQry	= new dbQuery($deleteBopaboxQuery, $this->connect->connId); 
	$dbQry	= new dbQuery($deletePapaQuery, $this->connect->connId);
	$dbQry	= new dbQuery($delete_id3tagQuery, $this->connect->connId);
	//$this->returnURL ="bpBopaBox.php";
	return 1;
}

function getUserMybopaCount($memberId) {
		$query = "SELECT  * FROM tbl_bopabox WHERE bi_MemberId = $memberId ";
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->countUserFiles =  $dbQry->numRows();
}

function getUserMybopaSellCount($memberId) {
		$query = "SELECT  * FROM tbl_bopabox WHERE bi_MemberId =$memberId AND i_in_sell=1 ";
		$dbQry	= new dbQuery($query, $this->connect->connId);	
		$this->countUserSellFiles =  $dbQry->numRows();
}

function getAllBopaCount() {
	$query = "SELECT  * FROM tbl_bopabox WHERE i_in_sell=1";
	$dbQry	= new dbQuery($query, $this->connect->connId);	
	$this->countBopaBoxFiles =  $dbQry->numRows();
}

function getCurrentYearStat($memberId) {
	$currentDate = date('Y');
	$query = "SELECT COUNT(*) as count_files, SUM(`vc_filePrice`) as total_price FROM tbl_file_history WHERE `bi_SellerId` = $memberId AND YEAR(`dt_insertedDate`)='$currentDate'";
	$dbQry	= new dbQuery($query, $this->connect->connId);	

	return $this->retrieveCurrentYearStat($dbQry);
}

function retrieveCurrentYearStat($dbQry) {

	if(!$dbQry->numRows()) return 0;
	
	$row				= $dbQry->getArray();	
	$this->priceTotalSellYear = $row['total_price'];
 	$this->countTotalSellYear = $row['count_files'];
	return 1;
}

/*function getAllBopaCount() {
	$query = "SELECT  * FROM tbl_bopabox WHERE i_in_sell=1";
	$dbQry	= new dbQuery($query, $this->connect->connId);	
	$this->countUserSellFiles =  $dbQry->numRows();
}

function getAllBopaCount() {
	$query = "SELECT  * FROM tbl_bopabox WHERE i_in_sell=1";
	$dbQry	= new dbQuery($query, $this->connect->connId);	
	$this->countUserSellFiles =  $dbQry->numRows();
}
*/

/* Feed back functions */
function retrieveFeedbackArray() { 	
	
		
		
				  if($this->feedbacklist=='provided' || $this->feedbacklist==''){
					 $query	=" SELECT *  FROM tbl_file_history, tbl_bopabox WHERE 
					bi_BuyerId =$this->bi_MemberId 
					AND tbl_file_history.`bi_FileId` = tbl_bopabox.`bi_file_id` ";
				   }	
				   if($this->feedbacklist=='received'){
					$query	=" SELECT * FROM  tbl_bopabox,tbl_ratings WHERE 
					tbl_ratings.bi_SellerId =$this->bi_MemberId 
					AND tbl_bopabox.bi_file_id = tbl_ratings.bi_fileId ";
				   }
				  
				  
					
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveFeedbackRowArray($this->clsbpPaginate);
}

function retrieveFeedbackReceivedArray() { 	
	
		
		
					
				 
			     $query	=" SELECT * FROM  tbl_bopabox,tbl_ratings,tbl_id3_tags,tbl_mem_login WHERE 
				 	tbl_ratings.bi_SellerId =$this->bi_MemberId 
					AND tbl_bopabox.bi_file_id = tbl_ratings.bi_fileId
					AND tbl_id3_tags.i_tg_id=tbl_bopabox.i_tg_id AND tbl_ratings.bi_BuyerId=tbl_mem_login.bi_MemberId ";
				
				 $query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
			if($this->jumpTo !="")
	        $this->pageIndex=$this->jumpTo;		  
					
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveFeedbackNeededRowArray($this->clsbpPaginate);
}
function retrieveFeedbackProvidedArray() { 	
	
		
		
				  if($this->feedbacklist=='provided' || $this->feedbacklist==''){
		       /*  print  $query	=" SELECT *  FROM tbl_file_history, tbl_bopabox WHERE 
					bi_BuyerId =$this->bi_MemberId 
					AND tbl_file_history.`bi_FileId` = tbl_bopabox.`bi_file_id` ";*/
					
/*					$query	="SELECT * FROM tbl_file_history,tbl_bopabox,tbl_id3_tags,tbl_mem_login
WHERE tbl_file_history.bi_BuyerId =$this->bi_MemberId 
AND tbl_file_history.`bi_FileId` = tbl_bopabox.`bi_file_id` 
AND tbl_id3_tags.i_tg_id=tbl_bopabox.i_tg_id AND tbl_file_history.bi_SellerId=tbl_mem_login.bi_MemberId

";*/
/*$query = "
SELECT *
FROM tbl_file_history
LEFT JOIN tbl_ratings ON tbl_file_history.bi_FileId = tbl_ratings.bi_fileId
JOIN tbl_bopabox ON tbl_file_history.bi_FileId = tbl_bopabox.bi_file_id
JOIN tbl_id3_tags ON tbl_bopabox.i_tg_id = tbl_id3_tags.i_tg_id
JOIN tbl_mem_login ON tbl_file_history.bi_SellerId = tbl_mem_login.bi_MemberId
WHERE tbl_ratings.bi_fileId IS NULL AND tbl_file_history.bi_BuyerId=$this->bi_MemberId
 ";*/
  $query ="SELECT tbl_file_history.dt_insertedDate, tbl_file_history.`bi_SellerId` , tbl_file_history.`bi_BuyerId` , tbl_file_history.`bi_FileId` , tbl_file_history.`dt_insertedDate` , tbl_bopabox.i_tg_id, tbl_id3_tags.vc_title_nm_mod, tbl_mem_login.vc_DisplayName, tbl_mem_login.bi_MemberId
FROM tbl_file_history
LEFT JOIN tbl_ratings ON tbl_file_history.bi_FileId = tbl_ratings.bi_fileId
JOIN tbl_bopabox ON tbl_file_history.bi_FileId = tbl_bopabox.bi_file_id
JOIN tbl_id3_tags ON tbl_bopabox.i_tg_id = tbl_id3_tags.i_tg_id
JOIN tbl_mem_login ON tbl_file_history.bi_SellerId = tbl_mem_login.bi_MemberId
WHERE tbl_ratings.bi_fileId IS NULL AND tbl_file_history.bi_BuyerId=$this->bi_MemberId";
					
				   }	
				 $query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
				  
			if($this->jumpTo !="")
	        $this->pageIndex=$this->jumpTo;		  
				
				
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveFeedbackRowArray($this->clsbpPaginate);
}
function retrieveFeedbackNeededArray() { 	
	
		
		
				 
		       /*  print  $query	=" SELECT *  FROM tbl_file_history, tbl_bopabox WHERE 
					bi_BuyerId =$this->bi_MemberId 
					AND tbl_file_history.`bi_FileId` = tbl_bopabox.`bi_file_id` ";*/
					
					$query	="SELECT * FROM  tbl_bopabox,tbl_ratings,tbl_id3_tags,tbl_mem_login WHERE 
				 	tbl_ratings.bi_BuyerId =$this->bi_MemberId 
					AND tbl_bopabox.bi_file_id = tbl_ratings.bi_fileId
					AND tbl_id3_tags.i_tg_id=tbl_bopabox.i_tg_id AND tbl_ratings.bi_BuyerId=tbl_mem_login.bi_MemberId

";
					
				 	
				 $query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
				  
			if($this->jumpTo !="")
	        $this->pageIndex=$this->jumpTo;		  
				
				
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveFeedbackNeededRowArray($this->clsbpPaginate);
}
function retrieveFeedbackCompleteddArray() { 	
	
		
		
				 
		       /*  print  $query	=" SELECT *  FROM tbl_file_history, tbl_bopabox WHERE 
					bi_BuyerId =$this->bi_MemberId 
					AND tbl_file_history.`bi_FileId` = tbl_bopabox.`bi_file_id` ";*/
					
					$query	="SELECT * FROM  tbl_bopabox,tbl_ratings,tbl_id3_tags,tbl_mem_login WHERE 
				 	tbl_ratings.bi_BuyerId =$this->bi_MemberId 
					AND tbl_bopabox.bi_file_id = tbl_ratings.bi_fileId
					AND tbl_id3_tags.i_tg_id=tbl_bopabox.i_tg_id AND tbl_ratings.bi_SellerId=tbl_mem_login.bi_MemberId

";
					
				 	
				 $query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
				  
			if($this->jumpTo !="")
	        $this->pageIndex=$this->jumpTo;		  
				
				
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveFeedbackNeededRowArray($this->clsbpPaginate);
}


function retrieveFeedbackRowArray($dbQry) {
	
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_FileId"]]	= array(
													
												"bi_FileId"	    => $row["bi_FileId"],	
												"bi_SellerId"	    => $row["bi_SellerId"],
												"bi_buyerId"	    => $row["bi_buyerId"],
												"dt_insertedDate"	=> $row["dt_insertedDate"],
												"vc_title_nm_mod"	    => $row["vc_title_nm_mod"],
											    "vc_DisplayName"	    => $row["vc_DisplayName"],
											     "bi_MemberId"	    => $row["bi_MemberId"]
												);
		}			
		return $arrFile;
}

function retrieveFeedbackNeededRowArray($dbQry) {
	
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_fileId"]]	= array(
													
												"bi_fileId"	    => $row["bi_fileId"],	
												"bi_SellerId"	    => $row["bi_SellerId"],
												"bi_buyerId"	    => $row["bi_buyerId"],
												"dt_insertedDate"	=> $row["dt_insertedDate"],
												"vc_title_nm_mod"	    => $row["vc_title_nm_mod"],
											    "vc_DisplayName"	    => $row["vc_DisplayName"],
											     "bi_MemberId"	    => $row["bi_MemberId"]
												);
		}			
		return $arrFile;
}

function retrieveRatingArray($sellerId,$fileId ) { 	
	
		
		 
		    if($this->feedbacklist=='provided' || $this->feedbacklist==''){
				    $query	="  SELECT *  FROM tbl_ratings WHERE bi_buyerId =$this->bi_MemberId ";
			}
			 if($this->feedbacklist=='received' ){
				    $query	=" SELECT *  FROM tbl_ratings WHERE bi_SellerId =$this->bi_MemberId ";
			}	
					
				   $query	.="  AND bi_sellerId =$sellerId AND bi_fileId=$fileId ";
				
		$dbQry	= new dbQuery($query, $this->connect->connId);	
	   $wdth = $this->retrieveRatingRowArray($dbQry);
	  return $wdth;
}

function retrieveRatingRowArray($dbQry) {
	
	
		$row        = $dbQry->getArray();
		
		$vc_rating	= $row["vc_rating"];
		$width      = 0;
		
		 $width      = $vc_rating * 17;
	
					

			
		return $width;
}

/*Feed back function end here*/

function checkFavSeller($memberid){
$userid = $_SESSION['USERID'];
	$query = "SELECT * 
				FROM 
			  		tbl_seller_favourates 
			  	WHERE 
			   		bi_MemberId = $userid
						AND
					bi_SellerId = $this->bi_MemberId";
	$dbQry	= new dbQuery($query, $this->connect->connId);
	return $dbQry->numRows();
}

function savetofavourates($memberid)
	
	{
		if($this->checkFavSeller($memberid) ==0) {
			$query = "INSERT INTO   
							tbl_seller_favourates 
							(
								bi_MemberId,
								bi_SellerId
							) 
						VALUES 
							(
								\"$memberid\",
								\"$this->sellerId\"
								
							)";
			$dbQry	= new dbQuery($query, $this->connect->connId);
			
			return 1;
		}
		else{
		$this->action = "";
			return 0;
		}
	}	
	

					
function postFiles() {	

		$this->setPostVars();
		$this->setGetVars();	
		
		if ($this->action == "SAVE") {		
			if ($this->saveFileDetails($this->bi_FileID)) {
				header("location:".stripslashes($this->includePath."/".$this->returnUrl));			
				exit();					
			}
		}
		else if ($this->action == "DELETE") {				
			$this->deleteFile($this->bi_FileIDs);
			header("location:".stripslashes($this->includePath."/".$this->returnUrl));				
			exit();
		}
		else if ($this->action == "ADDTOFAV") {				
			$this->savetofavourates($this->bi_MemberId);
			$this->action = "";
		}
		
		else if ($this->action == "UPDATEINFO") {		
		
			if($this->updateFileInfo($this->i_tg_id) > 0){
			
				header("location:".stripslashes($this->includePath.$this->returnUrl));				
				exit();
			
			}
		}
		else if ($this->action == "UPDATE") {				
			
			if($this->updateFileDetails($this->bi_file_id) > 0)
			{
			
				header("location:".stripslashes($this->returnURL));
				exit();	
			}

				
		}
			else if ($this->action == "UPDATESONG") {				
			
			if($this->updateSongDetails($this->bi_file_id) > 0)
			{
			
				header("location:".stripslashes($this->returnURL));
				exit();	
			}

				
		}
			else if ($this->action == "UPDATESONGSTATUS") {				
			
			if($this->updateSongStatusDetails($this->bi_file_id) > 0)
			{
			
				header("location:".stripslashes($this->returnURL));
				exit();	
			}

				
		}
		else if ($this->action == "UPDATEALL") {				
			
			$totalItems = count($_POST['clsbpFileDetails_txtFileId']);
			//die($totalItems);
			for($i=0; $i<$totalItems; $i++) {
				$fileId = $_POST['clsbpFileDetails_txtFileId'][$i];
				$filePrice = $_POST['clsbpFileDetails_txtPrice'][$i];
				$fileTags = $_POST['clsbpFileDetails_txaTags'][$i];
				$tagId = $_POST['clsbpFileDetails_txtTagId'][$i];
				
				$queryPrice = "UPDATE 
								tbl_bopabox 
							SET 
								dbl_price=\"$filePrice\",
								i_in_sell=1
							WHERE 
								bi_file_id   = $fileId";
				
				$dbQry	        = new dbQuery($queryPrice , $this->connect->connId);
				//echo $queryPrice;
				$queryTag = "UPDATE 
								tbl_id3_tags 
							SET 
								vc_tags=\"$fileTags\"
							WHERE 
								  i_tg_id   = $tagId";
				//die($queryTag);
				$dbQry2	        = new dbQuery($queryTag, $this->connect->connId);

			}
			header("location: bpBopaBox.php");
			exit();	
		}
		
		else if ($this->action == "DELETEFILE") {				
			//print_r(get_object_vars($this));
			if($res = $this->deleteFile($this->bi_file_id)) {
				//echo $res;
				header("location:".stripslashes($this->returnURL));
				exit();	
			}	
			exit();
		}
		else if ($this->action == "DELETEFILES") {				
			
			$deleteArray = explode(",",$this->fileIds4delete);
 			$flag =1;
 			
 			
 			foreach($deleteArray as $fileId) {
 				if(!($this->deleteFile($fileId))) {
 					$flag = 0;
 				}
 			}
			
			if($flag) {
				header("location:".stripslashes($this->returnURL));
				exit();	
			}
			
			
		}	
		
		return $this->retrieveFile($this->bi_file_id);
		
	}
}
?>
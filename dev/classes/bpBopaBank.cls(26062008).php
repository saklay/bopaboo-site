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
class clsbpBopaBank extends clsbpBase  { 

	var $vc_SongName;
	var $GenreId;		
	var $vc_GenreName;		
	var $GenreActive;		
	var $GenreIds;
	var $vc_Tags ;
	var $txtSearch;
	var $seachCat;
	var $returnURL;
	
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
	var $memberDisplayName;
	var $sellername;
	var $sellerId;
	var $minAmount;
	var $maxAmount;
	var $countFiles;
	
	var $returnValue;
	function clsbpBopaBank($connect, $includePath) {			
		
		$this->clsbpBase($connect, $includePath, "clsbpBopaBank");			
		
		$this->bi_file_id		= "";	
		$this->bi_MemberId		= "";		
		$this->bi_FileTypeId	= "";		
		$this->bi_GenreId		= "";
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
		$this->sortColumn		= "ord_date";
		$this->sortDirection    = "ASC";
		$this->pageSize			= 20;
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
		$this->memberDisplayName="";
		$this->sellerId = "";
		$this->minAmount=0;
		$this->maxAmount=0;
		$this->countFiles=0;
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
	}
	

	
	
	function retrieveAllOrderArray(){
	$optionVal0 =$_GET['optionVal0'];
	if($optionVal0==""){
	$optionVal0 = 30;
	}
/*	print $query = "SELECT * FROM tbl_mem_login,tbl_file_history WHERE tbl_mem_login.bi_MemberId=$this->bi_MemberId AND (tbl_file_history.bi_BuyerId = $this->bi_MemberId OR tbl_file_history.bi_SellerId = $this->bi_MemberId) "	;	*/		
	 
	 if(is_numeric($optionVal0)){
	
	
	
/*	 $query = "(SELECT * FROM tbl_file_history,tbl_mem_login WHERE tbl_file_history.bi_BuyerId = $this->bi_MemberId
	  AND tbl_mem_login.bi_MemberId=tbl_file_history.bi_SellerId
	  AND (tbl_file_history.dt_insertedDate  > date_sub(now(), interval $optionVal0 day)))
	   UNION
	  (SELECT * FROM tbl_file_history,tbl_mem_login WHERE tbl_mem_login.bi_MemberId=tbl_file_history.bi_BuyerId 
	  AND tbl_file_history.bi_SellerId = $this->bi_MemberId 
	  AND (tbl_file_history.dt_insertedDate  > date_sub(now(), interval $optionVal0 day))) 
 ";
 */
 	  $query = "(SELECT history.bi_HistoryId, sum( history.vc_filePrice ) AS sum, count( history.bi_FileId ) AS count,
	             history.bi_SellerId, history.bi_BuyerId,  orders.bi_ord_id, orders.vc_ord_number,
				 orders.ord_date, orders.vc_bopabank_balance
				 FROM tbl_file_history history, tbl_mem_order orders
				 WHERE history.bi_BuyerId =$this->bi_MemberId 
				 AND history.bi_ord_id = orders.bi_ord_id
				 AND (history.dt_insertedDate > date_sub( now( ) , INTERVAL 30 DAY ))
				 GROUP BY history.bi_ord_id)
				 UNION (SELECT history.bi_HistoryId, sum( history.vc_filePrice ) AS sum, count( history.bi_FileId ) AS count,
				 history.bi_SellerId, history.bi_BuyerId, orders.bi_ord_id, orders.vc_ord_number,
				 orders.ord_date, orders.vc_bopabank_balance
				 FROM tbl_file_history history, tbl_mem_order orders
				 WHERE history.bi_SellerId =$this->bi_MemberId   
				 AND history.bi_ord_id = orders.bi_ord_id
				 AND (history.dt_insertedDate > date_sub( now( ) , INTERVAL 30 DAY ))
				 GROUP BY history.bi_ord_id) 
				 UNION
				 (SELECT history.bi_HistoryId, sum( history.vc_filePrice ) AS sum, count( history.bi_FileId ) AS count,
	             history.bi_SellerId, history.bi_BuyerId,  orders.bi_ord_id, orders.vc_ord_number,
				 orders.ord_date, orders.vc_bopabank_balance
				 FROM tbl_file_history history, tbl_mem_order orders
				 WHERE history.bi_BuyerId =$this->bi_MemberId 
				 AND history.bi_ord_id = orders.bi_ord_id
				 AND (history.dt_insertedDate > date_sub( now( ) , INTERVAL 30 DAY ))
				 GROUP BY history.bi_ord_id)
				 UNION (SELECT history.bi_HistoryId, sum( history.vc_filePrice ) AS sum, count( history.bi_FileId ) AS count,
				 history.bi_SellerId, history.bi_BuyerId, orders.bi_ord_id, orders.vc_ord_number,
				 orders.ord_date, orders.vc_bopabank_balance
				 FROM tbl_file_history history, tbl_mem_order orders
				 WHERE  history.bi_SellerId =$this->bi_MemberId
				 AND history.bi_ord_id = orders.bi_ord_id
				 AND (history.dt_insertedDate > date_sub( now( ) , INTERVAL 30 DAY ))
				 GROUP BY history.bi_ord_id)
				 ";		
 
 
 
	 }
	 else{
	 $year = date("Y");
/*	  $query = "(SELECT * FROM tbl_file_history,tbl_mem_login WHERE tbl_file_history.bi_BuyerId = $this->bi_MemberId
	  AND tbl_mem_login.bi_MemberId=tbl_file_history.bi_SellerId
	    AND ( YEAR(tbl_file_history.dt_insertedDate)=$year)) 
	  UNION
	  (SELECT * FROM tbl_file_history,tbl_mem_login WHERE tbl_mem_login.bi_MemberId=tbl_file_history.bi_BuyerId 
	  AND tbl_file_history.bi_SellerId = $this->bi_MemberId  
	    AND ( YEAR(tbl_file_history.dt_insertedDate)=$year)) ";*/
	 $query = "(SELECT history.bi_HistoryId, sum( history.vc_filePrice ) AS sum, count( history.bi_FileId ) AS count,
	             history.bi_SellerId, history.bi_BuyerId,  orders.bi_ord_id, orders.vc_ord_number,
				 orders.ord_date, orders.vc_bopabank_balance
				 FROM tbl_file_history history, tbl_mem_order orders
				 WHERE history.bi_BuyerId =$this->bi_MemberId 
				 AND history.bi_ord_id = orders.bi_ord_id
				 AND YEAR(history.dt_insertedDate)='$year' 
				 GROUP BY history.bi_ord_id)
				 UNION (SELECT history.bi_HistoryId, sum( history.vc_filePrice ) AS sum, count( history.bi_FileId ) AS count,
				 history.bi_SellerId, history.bi_BuyerId, orders.bi_ord_id, orders.vc_ord_number,
				 orders.ord_date, orders.vc_bopabank_balance
				 FROM tbl_file_history history, tbl_mem_order orders
				 WHERE history.bi_SellerId =$this->bi_MemberId 
				 AND history.bi_ord_id = orders.bi_ord_id
				 AND YEAR(history.dt_insertedDate)='$year' 
				 GROUP BY history.bi_ord_id)";	
	 }
		 /* UNION
	  (SELECT * FROM tbl_file_history,tbl_mem_login WHERE tbl_mem_login.bi_MemberId=tbl_file_history.bi_BuyerId 
	  AND tbl_file_history.bi_SellerId = $this->bi_MemberId 
	  AND (tbl_file_history.dt_insertedDate  > date_sub(now(), interval $optionVal0 day)))*/
					
	$dbQry	= new dbQuery($query, $this->connect->connId);	

    $query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
	
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 1);	
		
		return $this->retrieveOrderRow($this->clsbpPaginate);
	
	}
	function retrievePaidArray(){

	/*$query = "SELECT * FROM tbl_file_history,tbl_mem_login WHERE tbl_file_history.bi_BuyerId = $this->bi_MemberId AND tbl_mem_login.bi_MemberId=tbl_file_history.bi_SellerId"	;	*/
	 $query = "SELECT history.bi_HistoryId, sum( history.vc_filePrice ) AS sum, count( history.bi_FileId ) AS count,
	             history.bi_SellerId, history.bi_BuyerId,  orders.bi_ord_id, orders.vc_ord_number,
				 orders.ord_date, orders.vc_bopabank_balance
				 FROM tbl_file_history history, tbl_mem_order orders
				 WHERE history.bi_BuyerId =$this->bi_MemberId 
				 AND history.bi_ord_id = orders.bi_ord_id "	;
	
	if($_GET['optionVal0'] !=''){
	
		$optionVal0 =$_GET['optionVal0'];
		
		if(is_numeric($optionVal0)){
	
		$query .="AND (history.dt_insertedDate > date_sub( now( ) , INTERVAL 30 DAY ))";
		}
		else{
		$year = date("Y");
		$query .=" AND YEAR(history.dt_insertedDate)='$year' ";
		}
	}		
	$query .=" GROUP BY history.bi_ord_id";				
	$dbQry	= new dbQuery($query, $this->connect->connId);	
	
    $query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
	
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveOrderRow($this->clsbpPaginate);
	
	}
	function retrieveReceivedArray(){
	
	/*$query = "SELECT * FROM tbl_file_history,tbl_mem_login WHERE tbl_mem_login.bi_MemberId=tbl_file_history.bi_BuyerId 
	AND tbl_file_history.bi_SellerId = $this->bi_MemberId "	;*/			
	
	$query = "SELECT history.bi_HistoryId, sum( history.vc_filePrice ) AS sum, count( history.bi_FileId ) AS count,
	             history.bi_SellerId, history.bi_BuyerId,  orders.bi_ord_id, orders.vc_ord_number,
				 orders.ord_date, orders.vc_bopabank_balance
				 FROM tbl_file_history history, tbl_mem_order orders
				 WHERE history.bi_SellerId =$this->bi_MemberId 
				 AND history.bi_ord_id = orders.bi_ord_id";
	if($_GET['optionVal0'] !=''){
	
	$optionVal0 =$_GET['optionVal0'];
	
		if(is_numeric($optionVal0)){
		
		$query .=" AND (history.dt_insertedDate > date_sub( now( ) , INTERVAL 30 DAY ))";
		}
		else{
		
		$year = date("Y");
		$query .=" AND YEAR(history.dt_insertedDate)='$year' ";
		}
	}
		$query .=" GROUP BY history.bi_ord_id";	
					
	$dbQry	= new dbQuery($query, $this->connect->connId);	

    $query	.= " ORDER BY $this->sortColumn $this->sortDirection"; 
	
		$this->clsbpPaginate = new clsbpPaginate($this->connect->connId, $query, $this->pageSize, $this->rangeVal, $this->pageIndex, $this->includePath, 0);	
		
		return $this->retrieveOrderRow($this->clsbpPaginate);
	
	}
	
	function retrieveOrderRow($dbQry)
	{
	
		$arrFile	= array();
		while($row  = $dbQry->getArray()) {
			$arrFile[$row["bi_HistoryId"]]	= array(
													
												"bi_HistoryId"	   		=> $row["bi_HistoryId"],
												"bi_SellerId"	    	=> $row["bi_SellerId"],
												"bi_BuyerId"	    	=> $row["bi_BuyerId"],	
												"sum"	            	=> $row["sum"],
												"count"				    => $row["count"],
												"bi_ord_id"			    => $row["bi_ord_id"],
												"vc_ord_number"		    => $row["vc_ord_number"],
												"ord_date"				=> $row["ord_date"],
												"vc_bopabank_balance"	=> $row["vc_bopabank_balance"]);
											
											
											
		}			
		return $arrFile; 
	}

	 /*--------------------------------------------------------*/
	  /**
	 *	This function returns the order datails of an order.
	 *	@Name: fn_OrderDetails
	 *	@date: 11-06-2008
	 *	@author: BL Bopaboo
	 *	@version: v1.0
	 *	@return: $arrDetails
	 */
		function fn_OrderDetails($order_id){
		
		 $query	= " SELECT orders.bi_ord_id, orders.vc_ord_number,
		           orders.vc_payment_method, orders.vc_bopabank_balance,
		           orders.f_serviceFloor, orders.f_serviceCharge,orders.f_transactionFee,
				   history.bi_HistoryId, history.bi_SellerId,
				   history.bi_BuyerId, history.bi_FileId,
				   history.vc_filePrice, history.vc_title,
				   history.vc_artists, history.vc_album,
				   payment.vc_bank_amount, payment.vc_cc_amount, payment.bi_creditcard_id
				   FROM tbl_mem_order orders, tbl_file_history history, tbl_ord_payment payment
				   WHERE orders.bi_ord_id = history.bi_ord_id
				   AND orders.bi_ord_id = payment.bi_ord_id
				   AND orders.bi_ord_id =$order_id
				   ORDER BY history.bi_SellerId";
								
		$dbQry = new dbQuery($query, $this->connect->connId);
	   return $this->fn_RetriveOrderDetailsArray($dbQry);
		
		
		}
	 	function fn_RetriveOrderDetailsArray($dbQry){
			
			$arrDetails	= array();
			while($row  = $dbQry->getArray()) {
			
			$arrDetails[$row["bi_HistoryId"]]	= array	(
											"bi_ord_id"	    => $row["bi_ord_id"],
											"vc_ord_number"	        => $row["vc_ord_number"],	
											"vc_payment_method"	    => $row["vc_payment_method"],
											"vc_bopabank_balance"	    => $row["vc_bopabank_balance"],
											"f_serviceFloor"	    => $row["f_serviceFloor"],
											"f_serviceCharge"	    => $row["f_serviceCharge"],
											"f_transactionFee"	    => $row["f_transactionFee"],
											"bi_HistoryId"	    => $row["bi_HistoryId"],
											"bi_SellerId"	    => $row["bi_SellerId"],
											"bi_BuyerId"	    => $row["bi_BuyerId"],
											"bi_FileId"	    => $row["bi_FileId"],
											"vc_filePrice"	    => $row["vc_filePrice"],
											"vc_title"	    => $row["vc_title"],
											"vc_artists"	    => $row["vc_artists"],
											"vc_album"	    => $row["vc_album"],
											"vc_bank_amount"	    => $row["vc_bank_amount"],
											"vc_cc_amount"	    => $row["vc_cc_amount"],
											"bi_creditcard_id"	    => $row["bi_creditcard_id"]
																		
											 );
			}			
			return $arrDetails;
		
		}
	 /*--------------------------------------------------------*/	

					
function postBankDetails() {	

		$this->setPostVars();
		$this->setGetVars();	

		
	
		
	}
}
?>
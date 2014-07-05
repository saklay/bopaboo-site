<?php

header("Cache-Control: no-store, no-cache");

$includePath		= "./";

include_once($includePath."bpCommon.php");


$FileID = $_REQUEST['fileId'];

 $SaleStatus = $_REQUEST['saleStatus'];
$price = $_GET['price'];



		  if($SaleStatus == 1){
						
						
							  $query	= "	UPDATE 
													tbl_bopabox,tbl_id3_tags
												SET 
												
													tbl_bopabox.dbl_price   = \"$price\",
													tbl_bopabox.i_in_sell=\"$SaleStatus\"
												WHERE 
													 tbl_bopabox.i_tg_id=tbl_id3_tags.i_tg_id  AND tbl_bopabox.bi_file_id = $FileID ";
													 
							echo $price."_".$FileID;						 
						}
			 if($SaleStatus == 0){
				
				  $query	= "	UPDATE 
										tbl_bopabox,tbl_id3_tags
									SET 
									
									
										tbl_bopabox.i_in_sell=\"$SaleStatus\"
									WHERE 
										 tbl_bopabox.i_tg_id=tbl_id3_tags.i_tg_id  AND tbl_bopabox.bi_file_id = $FileID ";
				
				echo $SaleStatus."_".$FileID;														
				}					
		
					mysql_query($query);
			
			

	

	
?>

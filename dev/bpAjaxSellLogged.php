<?php
ob_start();
header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpGenre.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpRatings.cls.php");


	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();

    	$clsbpFileDetails->submitted = 1;
    	$clsbpFileDetails->postFiles();
		/*--------------------------------------------------------------------------------*/
	
	$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	$rating = $clsbpRatings->fn_showUserRatingsAsImage($_SESSION['USERID']);
	/*--------------------------------------------------------------------------------*/
 	$clsbpFileDetails->getUserMybopaCount($_SESSION['USERID']);	
 	$clsbpFileDetails->getUserMybopaSellCount($_SESSION['USERID']); 	
 	$clsbpFileDetails->getAllBopaCount();
 	//$arrMemDet = $clsbpFileDetails->getMemberFileArray($_SESSION['USERID']);
 	$arrMemDet = $clsbpFileDetails->getSellPageDet($_SESSION['USERID']);

 	
 	$arraySize=sizeof($arrMemDet);
 	if($arraySize == 0){
			if($clsbpFileDetails->checkSongsinSale($_SESSION['USERID']))
			{
			$_SESSION["BPMESSAGE"]	= "You’re in luck! No one else is selling your song.";	
			
			}
			else{
			$_SESSION["BPMESSAGE"]	= "You need to have songs for sale to be in the game! So click the Upload button and Get your bopaboo on!";	
	        
			}
			
	}
	$extraParameters	.= "pageSize=$clsbpFileDetails->pageSize&submitted=$clsbpFileDetails->submitted";
?>
   <div id="pageheadSell">
                <h1>Sell</h1>
                <div class="adspace">
                    <!-- Begin BidVertiser code -->
    <SCRIPT LANGUAGE="JavaScript1.1" SRC="http://bdv.bidvertiser.com/BidVertiser.dbm?pid=122686&bid=321054" type="text/javascript"></SCRIPT>
    <noscript><a href="http://www.bidvertiser.com">internet marketing</a></noscript>
    <!-- End BidVertiser code -->
                </div>
            </div>
            <form id="frmDetails" name="frmDetails" method="post" action="">
		<input type="hidden"  name="clsbpFileDetails_pageSize" value="<?php echo $clsbpFileDetails->pageSize; ?>">
		<input type="hidden"  name="clsbpFileDetails_pageIndex" value="<?php echo $clsbpFileDetails->pageIndex; ?>">
		<input type="hidden"  name="clsbpFileDetails_sortColumn" value="<?php echo $clsbpFileDetails->sortColumn; ?>"> 
		<input type="hidden"  name="clsbpFileDetails_sortDirection" value="<?php echo $clsbpFileDetails->sortDirection; ?>"> 
        <input type="hidden"  id="clsbpFileDetails_bi_file_id" value=""> 
		<input type="hidden"  name="clsbpFileDetails_action" value=""> 
		<input type="hidden"  name="clsbpFileDetails_FileIds" value=""> 
		<input type="hidden" name="clsbpFileDetails_FileId" value=""> 
        <input type="hidden"  name="showjmenu" id="showjmenu" >
              <div id="pagecontents">
                <div id="sellPageLeftWrapper">
                    <div class="lbox">
                        <span class="hdr"><a href="#">My Dashboard</a></span>
                        <span class="contents">
                            <ul class="mydashboard">
                                <li><span class="numberof"><?php echo $clsbpFileDetails->countUserSellFiles; ?></span><span class="hdg">My Songs Posted for Sale</span></li>
                                <li><span class="numberof"><?php echo $clsbpFileDetails->countUserFiles; ?></span><span class="hdg">Total Songs Stored in My bopaBox</span></li>
                                <li class="total"><span class="numberof"><?php echo number_format($clsbpFileDetails->countBopaBoxFiles); ?></span><span class="hdg">Total Number of Songs for Sale</span></li>
                                <li>&nbsp;</li>
                            </ul>
                        </span>
                        <span class="ftr"></span>
                    </div>
                     <div class="lbox">
                        <span class="hdr"><a href="#">Start Selling Now!</a></span>
                        <span class="contentsStartSelling">
                            <a href='javascript:void(0);' onClick='javascript:window.open("uploadSell.php","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,screenX=150,screenY=150,top=150,left=150,height=725,width=880");'><img src="images/sellPageUploadMusic.jpg" alt="Upload Music" width="219" height="60" border="0" class="uploadMusic" /></a>
                            <a href="bpBopaBox.php"><img src="images/sellPageSellSongs.jpg" alt="Upload Music" width="219" height="60" border="0" class="sellSongs" /></a> </span>
                        <span class="ftr"></span>                 </div>
                </div>
                <div id="sellPageRightWrapper">
                    <div class="rbox">
                        <span class="hdr"><a href="#">My Store</a></span>
                        <span class="contentsMystore">
                            
                            <ul class="mydashboard">
                                <li><span class="hdg">Feedback: </span><span class="rdetails"><img src="images/rate_<?php echo $rating; ?>star.png" alt="Edit" width="96" height="20"  border="0" align="absmiddle" />
                              &nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $clsbpRatings->totalReviews;?>)</span></li>
                                <li><span class="hdg">View My Music Store:</span><span class="rdetails"> 		
                                <a href="<?php  echo constant("URL").str_replace(" ","-",$_COOKIE['COOKIE_USERNAME']); ?>"><?php  echo constant("URL"). $_COOKIE['COOKIE_USERNAME'] ;?></a></span></li>
                                <li><span class="hdg">Add To:</span><span>  <img src="images/page_white_code.png" alt="facebook"/>
                                <img src="images/wfba.gif" alt="my space"/>
                                <img src="images/myspace.gif" alt="Bebo"/>
                                <img src="images/wbba.gif" alt="Bebo"/>
                                <img src="images/blogger.gif" alt="Bebo"/>
                                <img src="images/typepad.gif" alt="Bebo"/> 
 <img src="images/wordpress.gif" alt="Bebo"/> 
 <img src="images/livejournal.gif" alt="Bebo"/>
 <img src="images/tagged.gif" alt="Bebo"/> 
 <img src="images/multiply.gif" alt="Bebo"/> 
 <img src="images/freewebs.gif" alt="Bebo"/> 
 <img src="images/blogger-post.gif" alt="Bebo"/> 
 <img src="images/google.gif" alt="Bebo"/> 
 <img src="images/netvibes.gif" alt="Bebo"/> 
 <img src="images/pageflakes.gif" alt="Bebo"/> 
 <img src="images/hi5.gif" alt="Bebo"/> 
 <img src="images/orkut-os.gif" alt="Bebo"/> 
 <img src="images/hi5-os.gif" alt="Bebo"/> 
 <img src="images/ning-os.gif" alt="Bebo"/>   
                        <!--        
                                <img src="images/icon-facebook.jpg" alt="facebook" width="100" height="37" /><img src="images/icon-myspace.jpg" alt="my space" width="147" height="34" class="lspace" /><img src="images/icon-bebo.jpg" alt="Bebo" width="99" height="37" class="lspace" />-->
                                
                                
                                </span></li>
                            </ul>
                        
                        </span>
                        <span class="ftr"></span>
                    </div>
                    <div class="rbox">
                        <span class="hdr"><a href="#">Most Popular Searches</a></span>
                        <span class="contentsPopular">
                        <?php
                        	$parameters = urlencode(getCurrentPageURL());
				$query = "SELECT vc_searchKeyword AS tag, bi_searchKeywordCount AS quantity
						FROM 
							tbl_search_records 
						WHERE
							bi_searchResultCount > 0
						ORDER BY 
							vc_searchKeyword 	ASC";
			
				$result = mysql_query($query);
			
				while ($row = mysql_fetch_array($result)) {
					$row['tag'] = trim($row['tag']);
					$row['tag'] = strtolower($row['tag']);
					$tags[$row['tag']] = $row['quantity'];
				}
				
				
				arsort($tags);

				$tags = array_slice($tags,0,25);

				ksort($tags, SORT_STRING);
				
				$max_size = 44; // max font size in %
				$min_size = 12; // min font size in %
				
				$max_qty = max(array_values($tags));
				$min_qty = min(array_values($tags));
				
				$spread = $max_qty - $min_qty;
				if (0 == $spread) { // we don't want to divide by zero
					$spread = 1;
				}
				
				$step = ($max_size - $min_size)/($spread);
				$count = 0;
				foreach ($tags as $key => $value) {
				if($count>=25) {break;}
				$size = $min_size + (($value - $min_qty) * $step);
				 if ($size   == 12)
				{
					$class = 'f007';
				} 
				elseif ($size> 12 and $size <=15) {
					$class = 'f006';
				} 
				elseif ($size > 15 and $size <=18) {
					$class = 'f004';
				} 
				elseif ($size > 18 and $size <24) {
					$class = 'f002';
				} 
				else {
					$class = 'f001';
				}
					
				echo '<a class="'.$class.'" href="bpSearch.php?clsbpFileDetails_txtSearch='.$key.'" style="font-size: '.$size.'px"';
				// perhaps adjust this title attribute for the things that are tagged
				//echo ' title="'.$value.' searches with '.$key.'"';
				echo '>'.$key.'</a> &nbsp; ';
				$count++;
				}
                        ?></span>
                        <span class="ftr"></span>                </div>
                    
                </div>
                    <div id="cls"></div>
                    <div id="sellData"></div>
                    <div id="checkOutCompetition">
<table width="784" border="0" cellspacing="0" cellpadding="0" class="datalist">
                          
                          <tr>
                            <td><table width="784" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td class="hdr"><span class="headtext">Check Out the Competition</span> <img id="loader5" src="images/o2.gif" alt="loader"  height="20" width="20"/></td>
                                </tr>
                                <tr>
                                  <td valign="top" class="bdy">
                                  
                                  
                                  <table width="100%" border="0" cellpadding="00" cellspacing="0" id="datacell">
                                      <tr>
                                        <th width="23%"><a href="javascript:void(0)" onclick="javascript:sortAjaxColumn('bpAjaxSellLogged.php','vc_title_nm_mod','clsbpFileDetails','frmDetails','<?php $extraParameters ?>','sellLogged');" <?php if($clsbpFileDetails->sortColumn =='vc_title_nm_mod' ||$clsbpFileDetails->sortColumn ==''){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}}?> >Song Title</a></th>
                                        <th width="18%"><a  href="javascript:void(0)" onclick="javascript:sortAjaxColumn('bpAjaxSellLogged.php','vc_artists_nm_mod','clsbpFileDetails','frmDetails','<?php $extraParameters ?>','sellLogged');"   <?php if($clsbpFileDetails->sortColumn =='vc_artists_nm_mod'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Artist</a></th>
                                        <th width="8%"> <a   href="javascript:void(0)" onclick="javascript:sortAjaxColumn('bpAjaxSellLogged.php','dbl_price','clsbpFileDetails','frmDetails','<?php $extraParameters ?>','sellLogged');"  <?php if($clsbpFileDetails->sortColumn =='dbl_price'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>My Price</a></th>
                                        <th width="15%"><a  href="javascript:void(0)" onclick="javascript:sortAjaxColumn('bpAjaxSellLogged.php','count_files','clsbpFileDetails','frmDetails','<?php $extraParameters ?>','sellLogged');"  <?php if($clsbpFileDetails->sortColumn =='count_files'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>># of Listings</a></th>
                                        <th width="11%"><a href="javascript:void(0)" onclick="javascript:sortAjaxColumn('bpAjaxSellLogged.php','min_price','clsbpFileDetails','frmDetails','<?php $extraParameters ?>','sellLogged');"  <?php if($clsbpFileDetails->sortColumn =='min_price'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Lowest Price</a></th>
                                        <th width="12%"><a href="javascript:void(0)" onclick="javascript:sortAjaxColumn('bpAjaxSellLogged.php','max_price','clsbpFileDetails','frmDetails','<?php $extraParameters ?>','sellLogged');" <?php if($clsbpFileDetails->sortColumn =='max_price'){ if( $clsbpFileDetails->sortDirection =="ASC") {echo "class='ascending'";} else { echo "class='descending'";}} ?>>Highest Price</a></th>
                                        <th width="7%" class="last"><a href="#">Actions</a></th>
                                      </tr>
                                      
                                      
                                      <?php 
										function fnCheckLength($value, $length)
										{   
											if(is_array($value)) list($string, $matching) = $value;
											else { $string = $value; $matching = $value{0}; }
										
											$match_start = stristr($string, $matching);
											$match_compute = strlen($string) - strlen($match_start);
										
											if (strlen($string) > $length)
											{
												if ($match_compute < ($length - strlen($matching)))
												{
													$pre_string = substr($string, 0, $length);
													$pos_end = strrpos($pre_string, " ");
													if($pos_end === false) $string = $pre_string."...";
													else $string = substr($pre_string, 0, $pos_end)."...";
												}
												else if ($match_compute > (strlen($string) - ($length - strlen($matching))))
												{
													$pre_string = substr($string, (strlen($string) - ($length - strlen($matching))));
													$pos_start = strpos($pre_string, " ");
													$string = "...".substr($pre_string, $pos_start);
													if($pos_start === false) $string = "...".$pre_string;
													else $string = "...".substr($pre_string, $pos_start);
												}
												else
												{       
													$pre_string = substr($string, ($match_compute - round(($length / 3))), $length);
													$pos_start = strpos($pre_string, " "); $pos_end = strrpos($pre_string, " ");
													$string = "...".substr($pre_string, $pos_start, $pos_end)."...";
													if($pos_start === false && $pos_end === false) $string = "...".$pre_string."...";
													else $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
												}
										
												$match_start = stristr($string, $matching);
												$match_compute = strlen($string) - strlen($match_start);
											}
										   
											return $string;
										}
	
						$recordNumber	= $clsbpFileDetails->clsbpPaginate->recordNumberOffset;
						foreach ($arrMemDet as $row) 
						{
							if ( $recordNumber &1 )
							{
							$class = "alternatebg001";
							}
							else
							{
							$class = "alternatebg002";
							}
							$string = fnCheckLength($row['vc_title_nm_mod'],25);
							//$clsbpFileDetails->getSongDetails($row['vc_title_nm_mod'], $row['vc_artists_nm_mod']);
				       ?> 
                                      <tr id="tr_<?php echo $row['bi_file_id'];?>" style="display:">
                                        <td align="left" class="<?php echo $class; ?> spacing"><a name="#file_<?php echo $row['bi_file_id'];?>"></a><?php echo stripslashes($string); ?></td>
                                        <td align="left" class="<?php echo $class; ?> spacing"><?php echo stripslashes($row['vc_artists_nm_mod']); ?></td>
                                        <td align="center" class="<?php echo $class; ?>" id="file_<?php echo $row['bi_file_id'];?>">$<?php echo stripslashes(number_format($row['dbl_price'],2)); ?></td>
                                        <td align="center" class="<?php echo $class; ?>"><?php echo stripslashes($row['count_files']); ?></td>
                                        <td align="center" class="<?php echo $class; ?>">$<?php echo stripslashes(number_format($row['min_price'],2)); ?></td>
                                        <td align="center" class="<?php echo $class; ?>">$<?php echo stripslashes(number_format($row['max_price'],2)); ?></td>
                                        <td align="center" class="<?php echo $class; ?>"><a name="#file_<?php echo $row['bi_file_id'];?>" href="bpSongFeedForSale.php?clsbpFileDetails_bi_file_id=<?php echo $row['bi_file_id'];?>&height=316&width=100px&modal=true&parameters=<?php echo "bpSellLogged.php?".urlencode($_SERVER["QUERY_STRING"]);?>"  class="thickbox"><img onclick="return test();" src="images/sellPageEditIcon.png" alt="Edit" width="20" height="20" border="0" /></a></td>
                                      </tr>
                                      <?php
						$recordNumber++;
					} 
					?>                   
                                  </table>
                                  <input type="hidden" id="test_val" value="0" />
                                  <div align="center"><?php echo displayMessage(); ?></div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="ftr">  </td>
                                </tr>
                            </table></td>
                          </tr>
                        </table>
                         <div id="pages1"><?php //echo $clsbpFileDetails->clsbpPaginate->writeHTMLPageRanges("clsbpFileDetails", "frmDetails", $extraParameters);
			echo $clsbpFileDetails->clsbpPaginate->getHTMLPageRangesForAjax("bpAjaxSellLogged.php","clsbpFileDetails", "frmDetails", $extraParameters,$tgName)
			
			?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jump to <input name="clsbpFileDetails_jumpTo" id="pagenumber" type="text" value="" class="pagenumber" />
                          <a href="javascript:goToAjaxPage('bpAjaxSellLogged.php','jump','clsbpFileDetails','frmDetails','<?php echo $extraParameters; ?>','provided');"><input type="image"  src="images/btn-go.png" id="sendbtn1" alt="Go To Page" align="top" /></a>
                      </div>
                               </div>
                    <div id="ad">
                	 <!-- Begin BidVertiser code -->
<SCRIPT LANGUAGE="JavaScript1.1" SRC="http://bdv.bidvertiser.com/BidVertiser.dbm?pid=122686&bid=312684" type="text/javascript"></SCRIPT>
<noscript><a href="http://www.bidvertiser.com">internet marketing</a></noscript>
<!-- End BidVertiser code -->
                </div>
              </div>
          </form>
    
                   
                        
<?php

ob_get_contents();



?>   
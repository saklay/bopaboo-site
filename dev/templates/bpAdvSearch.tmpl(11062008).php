  <div id="container">	   
          <form action="bpAdvSearchResult.php" method="post" name="frmsrch" onsubmit="javascript: return checkNumber();">
		<input type="hidden" name="clsbpFileDetails_SaveId" value = "<?php echo $clsbpFileDetails->saveId ?>" />
        <div id="pageheadSearch"> 
            <h1>Advanced Search</h1> 
            <div class="adspace">
            	&nbsp;
			</div>
         </div>
         	<div id="search">
         
                <div id="advanced-search-contnt01">
                  <div class="leftside-box-search">
                    	  	<div class="top-box-search"></div>
               	    <div class="mid-box-search"><strong>
                        
                    Enter Keywords</strong> <br />
                    <label for="clsbpFileDetails_txtSearch"></label>
                    <input type="text" name="clsbpFileDetails_txtSearch" id="textfield" class="mid-box-search-input01" value="<?php if($clsbpFileDetails->txtSearch !='') { echo $clsbpFileDetails->txtSearch; }?>"/><span id="errormsg" style="padding-left:15px; color:#FF0000"></span><br />
                    <label for="clsbpFileDetails_searchCat"></label>
                    <select name="clsbpFileDetails_lstSeachCat" id="select" class="mid-box-search-listdrop01">
                      <option value="0" <?php if($clsbpFileDetails->searchCat=='') { echo "selected=\"true\""; }?>>Everything</option>
                     
                      <option value="artist" <?php if($clsbpFileDetails->searchCat=='artist') {echo "selected=\"true\""; }?> >Artist</option>
                      <option value="album" <?php if($clsbpFileDetails->searchCat=='album') { echo "selected=\"true\""; }?>>Album</option>
                      <option value="song" <?php if($clsbpFileDetails->searchCat=='song') { echo "selected=\"true\""; }?>>Song</option>
                    </select><br />


                      <hr />
                   <label for="clsbpFileDetails_lstGenre"></label>
                    <select name="clsbpFileDetails_lstGenre" id="select" class="mid-box-search-listdrop01">
                      <option value="0">Select Genre</option>
                  	<?php echo $GenreListControl; ?>
                      		
                    </select><br />
                    <hr />
                    <p><br />
                        <strong>
                          
                        Item Price</strong>                     </p>
                                      <label for="clsbpFileDetails_txtMin">Min US $</label>
                      <input type="text" name="clsbpFileDetails_txtMin" id="txtMin" class="mid-box-search-input02" onKeyPress="javascript: return(currencyFormat(this,'','.',event))" value="<?php if($clsbpFileDetails->txtSearch ==0) { echo $clsbpFileDetails->searchMinAmount; }?>"/>
                      <label for="clsbpFileDetails_txtMax">Max US $</label>
                      <input type="text" name="clsbpFileDetails_txtMax" id="txtMax" class="mid-box-search-input02"  onKeyPress="javascript: return(currencyFormat(this,'','.',event))" value="<?php if($clsbpFileDetails->txtSearch ==0) { echo $clsbpFileDetails->searchMaxAmount; }?>"/><span id="errmsg" style="padding-left:20px; color:#FF0000"></span><br /><br />
                      
                      <hr /><br />
                      
                      <strong> From Sellers</strong>                       	    <br /><br />
                    <input type="radio" name="clsbpFileDetails_optSeller" id="radio" value="0" <?php if($clsbpFileDetails->searchIfSeller=='0' || $clsbpFileDetails->searchIfSeller=='' ) { echo "checked=\"true\""; }?>/>
                    <label for="clsbpFileDetails_optSeller">From Any Seller</label><br />
                    <input type="radio" name="clsbpFileDetails_optSeller" id="radio2" value="1" <?php if($clsbpFileDetails->searchIfSeller=='1') { echo "checked=\"true\""; }?>/>
                    <label for="clsbpFileDetails_optSeller">From Specific Sellers</label>
                           	  <span class="lightgrey-text">(enter Sellers' Display Name)</span><br />
                           	  <select name="clsbpFileDetails_lstAct" id="select2" class="mid-box-search-listdrop02">
                           	    <option selected="selected" value="1" <?php if($clsbpFileDetails->searchAction=='1') {echo "selected=\"true\""; }?>>Include</option>
                           	    <option value="0" <?php if($clsbpFileDetails->searchAction=='0') {echo "selected=\"true\""; }?>>Exclude</option>
                                                                                                                                                                                                                  </select>
                            <label for="clsbpFileDetails_txtSeller"></label>
                           	  <input type="text" name="clsbpFileDetails_txtSeller" id="textfield4" class="mid-box-search-input03" value="<?php if($clsbpFileDetails->searchSeller !='') { echo $clsbpFileDetails->searchSeller; }?>"/><br />
                             <span class="lightgrey-text"> Search up to 10 sellers, separate names by a comma or a space.</span><br /><br />
                             <input type="radio" name="clsbpFileDetails_optSeller" id="radio3" value="2" <?php if($clsbpFileDetails->searchIfSeller=='2') { echo "checked=\"true\""; }?>/>
                             <label for="clsbpFileDetails_optSeller">From My Favorite Sellers</label>
                             <br />
                             <br /><hr />
                             
                             <input type="checkbox" name="clsbpFileDetails_chkSave" id="checkbox" value="1" <?php if($clsbpFileDetails->searchSaveFav !='') { echo "checked=\"true\"";}?>/>
                             <label for="checkbox">Save Search to Favorites</label>
                             <label for="clsbpFileDetails_txtFav"></label> &nbsp;
                             <input type="text" name="clsbpFileDetails_txtFav" id="textfield5" class="mid-box-search-input01" value="<?php if($clsbpFileDetails->searchSaveFav !='') { echo $clsbpFileDetails->searchSaveFav; }?>"/>
               	    </div>                    
                    		<div class="bottom-box-search"></div>
                            
                            <input type="image" align="top" name="form_submitted" src="images/search-btn.png" value="Search" id="btnsearch"/>
                            <div class="clearSearch"><a href="javascript: void(0);" onclick="javascript: clearSearch();">Clear Search</a></div>
                  </div>
                    <div class="rightside"> <!-- Begin: AdBrite -->
						<script type="text/javascript">
                        var AdBrite_Title_Color = '0000FF';
                        var AdBrite_Text_Color = '000000';
                        var AdBrite_Background_Color = 'FFFFFF';
                        var AdBrite_Border_Color = 'CCCCCC';
                        var AdBrite_URL_Color = '008000';
                            </script>
						<script src="http://ads.adbrite.com/mb/text_group.php?sid=606390&zs=3136305f363030" type="text/javascript"></script>
                        <div>
                        	<a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=606390&afsid=1" style="font-weight:bold;font-family:Arial;font-size:13px;">Your Ad Here</a>
                        </div>
                  <!-- End: AdBrite --></div>
                 </div>
                 </div>
      	</form>
  </div>

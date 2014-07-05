
  <div id="container">
  
      <div class="roundedTab" id="advancedSearch">
        <div class="t">
        		<div class="tabOff"><h3 class="wide"><a href="bpBuy.php" >top 25</a></h3></div>
        		<div class="tabOff"><h3 class="wide"> <a href="bpBuy.php?tab=toptags" >top tags</a></h3></div>
        		<div class="tabOff"><h3 class="wide"><a href="bpBuy.php?tab=genre" >genre </a></h3></div>
        		<div class="tabOff"><h3 class="wide"><a href="bpBuy.php?tab=popular" >popular</a>  </h3></div>
            <div class="tab"><h3 class="wide">search</h3></div>
            <div class="tr"></div>
        </div>
        <div class="c"> <div class="cl">
          <!--add content-->
          	<div class="advSearch">
              <form action="bpSearch.php" method="post" name="frmsrch" onsubmit="javascript: return checkNumber();">
              	<input type="hidden" name="clsbpFileDetails_SaveId" value = "<?php echo $clsbpFileDetails->saveId ?>" />
              	<input type="hidden" name="clsbpFileDetails_advSearchFlag" value="OFF">
              	<input type="hidden" name="flagNew" value="1" />
              	<input type="hidden" name="flagSecond" value="1" />
               	  <p><span class="left"><strong>enter keywords</strong></span></p>
               	  <p><input type="text" name="clsbpFileDetails_txtSearch" id="textfield" class="inputStyle" value="<?php if($clsbpFileDetails->txtSearch !='') { echo $clsbpFileDetails->txtSearch; }?>"/></p>
                  <p>
                  	<select name="clsbpFileDetails_lstSeachCat" id="select" class="selectStyle">
                      <option value="0" <?php if($clsbpFileDetails->searchCat=='') { echo "selected=\"true\""; }?>>everything</option>
                      <option value="artist" <?php if($clsbpFileDetails->searchCat=='artist') {echo "selected=\"true\""; }?> >artist</option>
                      <option value="album" <?php if($clsbpFileDetails->searchCat=='album') { echo "selected=\"true\""; }?>>album</option>
                      <option value="song" <?php if($clsbpFileDetails->searchCat=='song') { echo "selected=\"true\""; }?>>song</option>
                    </select>
                  </p>
                  <hr />
                  <p>
                  	<select name="clsbpFileDetails_lstGenre" id="select" class="selectStyle">
                      <option value="0">Select Genre</option>
                  		<?php echo $GenreListControl; ?>
                    </select>
                  </p>
                  <hr />
                  <p><strong>item Price</strong></p>
                  <p>
                  	<span class="left">min US $ &nbsp;</span> <input type="text" name="clsbpFileDetails_txtMin" id="txtMin" class="inputStyle1" onKeyPress="javascript: return(currencyFormat(this,'','.',event))" value="<?php if($clsbpFileDetails->txtSearch ==0) { echo $clsbpFileDetails->searchMinAmount; }?>"  onselect="return fnSelect();"/>
                    <span class="right">max US $ &nbsp;</span> <input type="text" name="clsbpFileDetails_txtMax" id="txtMax" class="inputStyle1"  onKeyPress="javascript: return(currencyFormat(this,'','.',event))" value="<?php if($clsbpFileDetails->txtSearch ==0) { echo $clsbpFileDetails->searchMaxAmount; }?>"  onselect="return fnSelectSecond();"/>
                  </p>
                  <hr />
                  <p><strong>from sellers</strong></p>
                	<p><input type="radio" name="clsbpFileDetails_optSeller" id="radio" value="0" <?php if($clsbpFileDetails->searchIfSeller=='0' || $clsbpFileDetails->searchIfSeller=='' ) { echo "checked=\"true\""; }?>/> from any seller<br />
                  	 <input type="radio" name="clsbpFileDetails_optSeller" id="radio2" value="1" <?php if($clsbpFileDetails->searchIfSeller=='1') { echo "checked=\"true\""; }?>/> from specific sellers&nbsp;&nbsp;&nbsp;&nbsp;(enter sellers' display Name)<br /><br />
                  	 <select name="clsbpFileDetails_lstAct" id="select2" class="selectStyle">
                           	    <option selected="selected" value="1" <?php if($clsbpFileDetails->searchAction=='1') {echo "selected=\"true\""; }?>>include</option>
                           	    <option value="0" <?php if($clsbpFileDetails->searchAction=='0') {echo "selected=\"true\""; }?>>exclude</option>
                    </select>&nbsp;&nbsp;&nbsp;
                    <input type="text" name="clsbpFileDetails_txtSeller" id="textfield4" class="inputStyle" value="<?php if($clsbpFileDetails->searchSeller !='') { echo $clsbpFileDetails->searchSeller; }?>" onchange="document.getElementById('radio2').checked=true;"/>
                    <span class="note">search up to 10 sellers, separate names by a comma or a space.</span>
			    </p>
                  <hr />
                  <p>
                  	<input type="checkbox" name="clsbpFileDetails_chkSave" id="checkbox" class="saveSearch" value="1" <?php if($clsbpFileDetails->searchSaveFav !='') { echo "checked=\"true\"";}?>/>&nbsp;save search <input type="text" name="clsbpFileDetails_txtFav" id="textfield5" class="inputStyle" value="<?php if($clsbpFileDetails->searchSaveFav !='') { echo $clsbpFileDetails->searchSaveFav; }?>" onchange="document.getElementById('checkbox').checked=true;"/>
                  </p>
                <p class="last">
                
                <div>
                	<span class="btSearch"><a href="javascript:void();" onclick="document.frmsrch.submit();return false;" name="form_submitted" value="Search" id="btnsearch"></a></span>
               	  <span style="float:left;display:block;margin-left:15px;"><a href="javascript:clearSearch();">Clear Search</a></span>
               	</div>
               	</p>
              </form>
            </div>
        	<!--finish content-->
          </div><!--cl -->
          </div><!-- c -->
        <div class="b"><span class="br"></span></div>
      </div> <!-- searchBox ends -->
    
  </div>
  
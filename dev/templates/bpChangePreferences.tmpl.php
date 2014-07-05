
    <script type="text/javascript">

        function fnDownloadLocation() {

            var sPath1 = document.bpChangePref.clsbpUserLogin_txtDownloadLocation.value;
			var newPath = sPath1.substr(0,sPath1.lastIndexOf('\\'));
		 	 document.bpChangePref.clsbpUserLogin_downloadPreference.value =  newPath;

		
        }
    function fnUploadLocation() {
			
            var sPath2 = document.bpChangePref.clsbpUserLogin_txtUploadLocation.value;
		  	var newPath = sPath2.substr(0,sPath2.lastIndexOf('\\'));
		  	document.bpChangePref.clsbpUserLogin_uploadPreference.value =  newPath;
		

        }

       

      
    </script>

  <div id="container">
    <div id="signUplaside">
      <div class="roundedTab" id="signUp">
        <div class="t">
          <div class="tabOff"><h3 class="wide"><a href="<?= HTTP ?>bpChangeAccount.php">info</a></h3></div>
          <div class="tabOff"><h3 class="wide"><a href="<?= HTTPS ?>bpChangePassword.php">password</a></h3></div>
          <div class="tabOff"><h3 class="wide"><a href="<?= HTTP ?>bpChangeNotifications.php">notifications</a></h3></div>
          <div class="tab"><h3 class="wide">preferences</h3></div>
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
            <div class="resetPassword">
            	
              <form action="" method="post" name="bpChangePref" onsubmit="javascript: return valSubmit();">
              	<input type="hidden" name="clsbpUserLogin_returnUrl" value=""/>
    	 					<input type="hidden" name="clsbpUserLogin_action" value=""/>
    	 					<input type="hidden" name="clsbpUserLogin_downloadPreference" value="" />
    	 					<input type="hidden" name="clsbpUserLogin_uploadPreference" value="" />
    	 					<input type="hidden" name="flagNew" value="1" />
    	 
                <ul id="signUpForm">
                <li>
                  <label for="defaultDownload">default download location</label>
                  <span class="rside">
                  <span><input type="file" name="clsbpUserLogin_txtDownloadLocation" id="textfield" class="inputstyle05" onblur="fnDownloadLocation();" size="40" /></span>
                  </span> </li>
                <li>
                  <label for="defaultUpload">default upload location</label>
                  <span class="rside">
                  <span><input type="file" name="clsbpUserLogin_txtUploadLocation" id="textfield" class="inputstyle05"  onblur="fnUploadLocation();" size="40" /></span>
                  </span> </li>
                <li>
                  <label for="defaultSelling">default selling price</label>
                  <span class="rside">
                  <span><input name="clsbpUserLogin_txtDefaultPrice" type="text"  class="inputstyle07" id="textfield2" value="<?php echo $clsbpUserLogin->defaultPrice?>" onKeyPress="javascript: return(currencyFormat(this,'','.',event))" maxlength="6" onselect="return fnSelect();" style="width:75px;" /></span><span style="margin-left:10px;">(Per Song)</span>
                  </span>  </li>
                <li>&nbsp;</li>
                <li>
                  <label>&nbsp;</label>
                  <!-- <span class="rside btSaveChanges"><a href="homeLoggedIn.html" style="float:left;"></a></span></li> -->
                  <span class="rside"><input type="image" align="top" name="form_submitted" src="images/save-changes-btn.jpg" value="Send Email" id="sendbtn"/></span></li>
              </ul>
                    
              </form>
               
            	<p>&nbsp;</p>
            </div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->
    </div>
  </div>

<script language="javascript">
function fnEchecks(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("You have not entered a valid email address. Please try again.")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("You have not entered a valid email address. Please try again.")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		 }

 		 return true					
	}

function fnValidateNew()
{
  
    var emailID=document.frmLoginNewAdd.clsbpUserLogin_txtEmail;
	if ((emailID.value==null)||(emailID.value=="")){
		alert("You have not entered a valid email address. Please try again.")
		emailID.focus()
		return false
	}
	else if (fnEchecks(emailID.value)==false){
		emailID.value=""
		emailID.focus()
		return false
	}
	
	else if(document.frmLoginNewAdd.clsbpUserLogin_txtPassword.value == "")
	{
	alert("Enter Password");
	document.frmLoginNewAdd.clsbpUserLogin_txtPassword.focus();
	return false;
	}
	else
	{
		document.frmLoginNewAdd.clsbpUserLogin_action.value="LOGIN";
	}
return true
}
</script>

                <?php 
                    $songIds =  base64_encode(implode(",",$_SESSION['bopaBasket']['song']));
                    if($songIds!="") {
                    $link = "bpUserSignup.php?songList=$songIds";
                    }
                    else {
                    $link = "bpUserSignup.php";
                    }
                 ?>

  <div id="container">
    <div id="signUplaside">
      <div class="roundedTab" id="signUp">
        <div class="t">
          <div class="tabOff">
            <h3 class="selecttab wide"><a href="<?php echo $link;?>" >sign up</a></h3></div><div class="tab">
            <h3 class="wide">sign in</h3>
          </div>
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
            <div id="bopaboxNotLoggedIn">
                <div class="signInBox">
                	<h1>existing members</h1>
                    <form id="form1" name="frmLoginNewAdd" onsubmit="return fnValidateNew();" method="post" action="">
                    	<ul>
                        <li style="height:25px;">
                        <label for="email">email address</label>
                        <span class="rside">
                        <input type="text"  name="clsbpUserLogin_txtEmail" id="email"  class="inputStyle1" />
                        </span></li>
                      </ul>
                      <ul>
                        <li style="height:25px;">
                        <label for="password">password</label>
                        <span class="rside">
                        <input type="password"  name="clsbpUserLogin_txtPassword" id="password"  class="inputStyle1" />
                        <input type="hidden" name="clsbpUserLogin_action" value=""/>
                				<input type="hidden"  id="clsbpUserLogin_returnUrl" name="clsbpUserLogin_returnUrl" value="">
                        </span></li>
                        
                        <li style="line-height:15px;">
                         <label>&nbsp;</label>
                        <span class="rside"><span class="errorMsg1" style="margin-left:-10px;"><?php echo displayWelcome();?></span></span></li>
                      </ul>
                      <ul id="signInButtonPosition">
                      <li><br/>
                        <label>&nbsp;</label>
                        <span class="rside">
                        	<span class="registerBtn1">
                        	<!--<span class="btSignIn"><a href="javascript:fnValidates();" style="float:right;"></a></span>-->
                        	<input type="image" src="<?php echo IMAGEPATH ?>btnSignIn.jpg" id="signinbtn" class="signinbtn" border="0" /><br />
                            	<!-- <a href="#"><img src="<?php echo IMAGEPATH ?>btnSignIn.jpg" alt="Sign In" width="129" height="24" border="0" /></a><br /> -->
                                <a href="bpForgotPassword.php">forgot your password?</a>
                                
                            </span>
                         </span>
                      </li>
                      
                     </ul>
                    </form>
                </div>
                <div class="bopaboxRegisterBox">
                	
                	<h1>new member</h1>
                    <p>
                        not a member yet? in order to buy and sell on bopaboo you need to register for a free account.<br />
                        <span class="registerBtn2">
                        <a href="<?php echo $link;?>"><img src="<?php echo IMAGEPATH ?>btnRegister.jpg" alt="Register Now!" width="129" height="24" border="0" /></a>
                        </span>
                    </p>
                </div>
                <div class="cls"></div>
            </div>
            <!--finish content-->
          </div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->
    </div>
    <!-- laside ends here -->
  </div>

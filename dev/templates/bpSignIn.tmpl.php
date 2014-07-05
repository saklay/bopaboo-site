<script language="javascript">

function fnClose()
{
	
		//alert('inside fnClose');
		document.getElementById('signInPopUp').style.display="none";
		//window.location='index.php';
}


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
	



function fnValidates()
{
  		document.frmLoginNew.clsbpUserLogin_action.value="LOGIN";
		document.frmLoginNew.submit();
}
   /* var emailID=document.frmLoginNew.clsbpUserLogin_txtEmail;

	if ((emailID.value==null)||(emailID.value=="")){
		alert("You have not entered a valid email address. Please try again.")
		emailID.focus()
		return false
	}
	if (fnEchecks(emailID.value)==false){
		emailID.value=""
		emailID.focus()
		return false
	}
	
	if(document.frmLoginNew.clsbpUserLogin_txtPassword.value == "")
	{
	alert("Enter Password");
	document.frmLoginNew.clsbpUserLogin_txtPassword.focus();
	return false;
	}
	 
	ajaxFunction(document.frmLoginNew.clsbpUserLogin_txtEmail.value,document.frmLoginNew.clsbpUserLogin_txtPassword.value);

	return false;
}

function ajaxFunction(username,password)
{
	alert("test1");
var xmlHttp;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
      var s = xmlHttp.responseText;
	  if(s=="false") {
		  document.getElementById('errordisplay').innerHTML ="invalid email address or password";
	  }
	  else {
	  	document.frmLoginNew.clsbpUserLogin_action.value="LOGIN";
	 
	  	alert("test2");
		document.frmLoginNew.submit();
	  }
      }
     
    }
  xmlHttp.open("GET","loginvalidate.php"+"?user="+username+"&pass="+password,true);
  xmlHttp.send(null);
  }*/
</script>

<div class="rounded" id="signInPopUp" style="width:620px;">
        <div class="t">
          
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
<div id="bopaboxNotLoggedIn">
                <div class="signInBox">
                	<h1>existing members</h1>
                    <form id="frmLoginNew" name="frmLoginNew" target="_parent" method="post" action="" onsubmit="return fnValidates();">
                    	<ul>
                        <li>
                        <label for="email">email address</label>
                        <span class="rside">
                        <input name="clsbpUserLogin_txtEmail" type="text" id="clsbpUserLogin_txtEmail" class="inputStyle1" />
                        </span> 
                        </li>
                        <li>
                        <label for="password">password</label>
                        <span class="rside">
                        <input name="clsbpUserLogin_txtPassword" type="password" class="inputStyle1" />
                        </span>
                        </li>
                        <li>
                        	<input type="hidden" name="clsbpUserLogin_action" value=""/>
                         <label>&nbsp;</label>
                        <span class="rside"><span class="errorMsg1"><?php echo displayMessage(); ?></span></span>
                      </li>
                      <li>
                        <label>&nbsp;</label>
                        <!--<span class="rside"><span class="registerBtn1"><a href="#"><img src="../images/btnSignIn.jpg" alt="Sign In" width="129" height="24" border="0" /></a></span></span>-->
                        <span class="btSignIn"><a href="javascript:fnValidates();" style="float:right;"></a></span>
                        <!--<input type='image' src="./images/btSignIn.png" onclick="this.form.submit();">-->
                       </li>
                      </ul>
                       
                       
                    </form>
                </div>
              <div class="bopaboxRegisterBox">              	
               	<h1>new member</h1>
                    <p>
                    	not a member yet? in order to buy and sell on bopaboo you need to register for a free account.
                <?php 
                    $songIds =  base64_encode(implode(",",$_SESSION['bopaBasket']['song']));
                    if($songIds!="") {
                    $link = "bpUserSignup.php?songList=$songIds";
                    }
                    else {
                    $link = "bpUserSignup.php";
                    }
                 ?>
                        <div style="clear:both;"></div>
                        <div style="height:45px;"></div>
                        <div class="btRegister"><a href="<?php echo $link;?>" style="float:left;"></a></div>
                    </p>
                    
              </div>
              <div style="clear:both;"></div>
              <div id="closePopup"><a href="javascript:fnClose();" class="closebtn">close <img src="<?php echo IMAGEPATH ?>closePopUpSmall.png" border=0></a></div>
            </div>
            
            <!--finish content-->
          </div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->
      
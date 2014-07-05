<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pageTitle; ?></title>
<link href="styles/site.css" rel="stylesheet" type="text/css" />
<link href="../styles/signup1.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

  <script>
		var RecaptchaOptions = {
		theme: 'custom',
		lang: 'en',
		custom_theme_widget: 'recaptcha_widget'
		};
	</script>
</head>

<body>
<div id="container"><!--Container starts here-->
  <!--Header Ends here-->
  
<div id="Wrapper">
 
 <div id="breadcrumb-links">
        <ul> 
          <div align="left" style="float:left; padding-right:5px;"><a href="login.php">Home</a>          </div>
          <li>Sign Up</li>
        </ul>
 </div>
 <div id="cls"></div>


 
	<div id="LARGECOL_LEFT">
    <div id="signup-box-top-menu">
              <dl>
                <dt>Already a member? <a href="login.php">Click Here to Log In </a></dt>
              </dl>
    </div>
    
    <div id="signup-box">
    	<div id="signup-box-top"></div>
        
    	<div id="signup-box-mid"><h1>Sign Up</h1>
    	<form  method="post" name="frmRegistration" onsubmit="return fnValidate();">
    	<span id="sprytextfield1">
    	<label for="email"><strong>Email</strong></label>
     <input name="clsbptbl_mem_details_txtEmail" type="text" class="inputstyle" id="email" value="<?php $clsbpUserDetails->txtEmail; ?>"/>
     <span style="color:#FF0000"></span></span>
   	<br />
   
   <span id="sprytextfield2">
   <label for="password"><strong>Password</strong></label>
   <input name="clsbptbl_mem_details_txtPassword" type="password" class="inputstyle" id="password" />
   </span><br />




     <span id="sprytextfield3">
    <label for="ConfrmPassword"><strong>Confirm Passoword</strong></label>
    <input name="clsbptbl_mem_details_txtConfirmation" type="password" class="inputstyle" id="ConfrmPassword" />
    <span style="color:#FF0000"></span></span><br />
	  
      
      <hr />    
    
    
      <span id="sprytextfield5">
      <label for="displayName"><strong>Display Name</strong></label>
      <input name="clsbptbl_mem_details_txtDisname" value="<?php $clsbpUserDetails->txtEmail; ?>" type="text" class="inputstyle" id="txtDisname"onblur="javascript:validate(this.value, this.id)" />
      </span><br />
      
      <span id="sprytextfield9">
      <label for="firstName"><strong>First Name</strong></label>
      <input name="clsbptbl_mem_details_txtFname" type="text" class="inputstyle" id="txtFname"  value="<?php echo $clsbpUserDetails->vc_FirstName; ?>"/>
      </span> <br />   
      
      
      <span id="sprytextfield10">
      <label for="lastName"><strong>Last Name</strong></label>
      <input name="clsbptbl_mem_details_txtLname" type="text" class="inputstyle" id="txtLname" value="<?php  echo $clsbpUserDetails->vc_LastName; ?>"  />
      </span><br />
      
      
      <span id="spryselect2">
      <label for="country">Country</label>
      <select name="clsbptbl_mem_details_optCountry" class="inputstyle" id="country">
                <?php 
			      $countryInfo=getCountryInfo();	 
    			
    			  foreach($countryInfo as $key=>$value)
     			  {?>
	    			<option value="<?php echo $key; ?>" <?php if(isset($optCountry) && $key==$optCountry)  echo 'selected'; ?>><?php echo $value; ?></option> 
				    <?php 
				   }		        
	  ?>  
      </select>
      <span class="selectRequiredMsg">Please select an item.</span>            </span><br />
      
      
   

      <label for="month"><strong>Date of Birth</strong></label>

          <select name="clsbptbl_mem_details_optMonth" size="1" class="inputstyle_month1" id="month">
          	 <option selected="selected" value="0">Month</option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
         </select>
   
          <select name="clsbptbl_mem_details_optDay" size="1" class="inputstyle_month" id="month2">
            <option value="0">Date</option>
        <?php 
				for($i=1;$i<=31;$i++){ echo "<option value='".$i."'>".$i."</option>"; }	
			  ?>
            </select>
          <select name="clsbptbl_mem_details_optYear" size="1" class="inputstyle_month" id="month3">
            <option value="0">Year</option>
       <?php 
				for($i=1920;$i<=1994;$i++){ echo "<option value='".$i."'>".$i."</option>"; }		
			?>
            </select>
          <br>
    
    <label for="Gender">Gender</label>
    <input type="radio" name="clsbptbl_mem_details_optGender" id="radio-male" value="1" />
    Male 
    <input type="radio" name="clsbptbl_mem_details_optGender" id="radio-male2" value="0" /> 
    Female
<br>
    <div style="margin-bottom:5px;"><?php
	if(isset($errorList['Captcha'])) $err=$errorList['Captcha']; else $err=''; $error='';
echo recaptcha_get_html($publickey, $error,  $err);
?></div>
  <label for="doyouagree"><strong>Do you Agree</strong></label>
  <input type="clsbptbl_mem_details_checkbox"  id="sdsd" name="chkTerms"  value="1" />
  By signing up, you accept the <a href="#">terms of use</a> and confirm you're 13 or older.<br />
<div id="submitbutton"> <input type="image" align="top" name="smtUsers" src="images/register1.jpg" value="smtUsers"  width="131px" height="26px"/>
        </div>
        <input type="hidden" name="postsubmit" />
    	</form>
    	</div>
        <div id="signup-box-bottom"></div>
    </div>
  </div>
<div id="SMALLCOL_RIGHT">
   		  <div class="smallcol-right-box-top-img"></div>
          <div class="smallcol-right-box-bottom-img"></div>
           
             <div class="smallcol-right-box-top-img"></div>
          <div class="smallcol-right-box-top-img-body"> 
            <p><span class="bluecolored">Your privacy is important to us </span>bopaboo does not rent or sell your personal information to third parties without your consent. To learn more, read our              <a href="#">privacy policy</a>.</p>
            <p>&nbsp;</p>
            <p><img src="images/trustee-logo-big.jpg" width="79" height="109" /></p>
          </div>
          <div class="smallcol-right-box-bottom-img"></div>
	</div>
</div>		
</div>
<div id="FOOTER">
  <div class="footer">
    <div class="termsofservice">
	<a href="#">Terms of Use</a> | 
    <a href="#">Privacy Policy</a> | 
    <a href="#">Site Map</a></div>
  </div>
</div>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur", "change"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {validateOn:["blur", "change"]});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "none", {validateOn:["blur", "change"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur", "change"]});
//-->
</script>
</body>
</html>
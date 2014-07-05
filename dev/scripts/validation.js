
/********************************** USER SIGN UP ***********************************************/


/****************************EMAIL VALIDATION********************************************/
function checkEmail(value)
	{
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)){
			return (true);
		}else{ 
			return false; 
		}
}
function fnValidateEmail(field_name)
{
			var emailID=document.frmRegistration.clsbpUserLogin_txtEmail.value;
			var email=document.getElementById('Email_Div');
			email.style.color='#FF4040';
			email.style.size='11px';
			email.style.float='right';
			
			var myRegExp=/,|;|!|#|_|{|}|:|;|`|~/;
			var matchPos1 = emailID.search(myRegExp);	
			
			if ( emailID==null || emailID=="")
			{
				email.innerHTML=" Please enter Email ID.";
			}
			else if(matchPos1 !=-1)
			{
				email.innerHTML=" Email is not valid!.";
			}
			else if(checkEmail(emailID))
			{
				//email.innerHTML="";
				strUrl="checkDuplicate.php?field_name="+field_name+"&field_value="+emailID;
				//alert(strUrl);
				newLoadNewAJAX(strUrl, "noObj", "afterAjax","10",'Email_Div');
				//email.innerHTML="<img src='images/icon-tick.png'/>";
			}
			else
			{
				email.innerHTML="Please enter Valid Email ID.";	
			}
			
}

/**********************************************************************************************/
/**************************** DISPLAY NAME VALIDATION********************************************/

function fnValidateDisplayName(field_name)
{
		var userName=document.frmRegistration.clsbpUserLogin_txtDisname.value;
		
		//var myRegExp=/,|!|@|#|$|%|^|&|*|(|)|-|_|=|+|\|{|}|:|;|<|>|./;
		
		var myRegExp=/,|;|!|@|#|_|{|}|:|;|`|~/;
		var matchPos1 = userName.search(myRegExp);	
		
		var dispName=document.getElementById('DispName_Div');
		dispName.style.color='#FF4040';
		dispName.style.size='11px';
		dispName.style.float='right';
		
		if ( userName==null || userName=="")
		{
				//alert("ValidateDisplayName if");
				dispName.innerHTML=" Please Enter Display Name.";
		}
		else if(matchPos1 !=-1)
		{
			dispName.innerHTML=" Enter only letters and numbers.";
		}
		else 
		{
				strUrl="checkDuplicate.php?field_name="+field_name+"&field_value="+userName;
				//alert(strUrl);
				newLoadNewAJAX(strUrl, "noObj", "afterAjax","10",'DispName_Div');
		}
	  	
			
}
/**********************************************************************************************/

/**************************** USER Password VALIDATION********************************************/

function validatePassword(e)
	{
		//alert('inside validatePassword');
		var pass1=document.frmRegistration.clsbpUserLogin_txtPassword.value;
		var len1=pass1.length;
		
		var pass2=document.frmRegistration.clsbpUserLogin_txtConfirmation.value;
		var len2=pass2.length;
		
		var pass1_div=document.getElementById('Pass1_Div');
		pass1_div.style.color='#FF4040';
		pass1_div.style.size='11px';
		
		var pass2_div=document.getElementById('Pass2_Div');
		pass2_div.style.color='#FF4040';
		pass2_div.style.size='11px';
		//alert(len);
		
		
		//key=e.which;
		if (window.event)
    	{
        	key = window.event.keyCode;
    	}
    	else if (e)
    	{
        	key = e.which;
    	}
		if(key == 32)
    	{
        	return false;
    	}
    	else
    	{
    		if(pass2!="" &&(len1 < 6 || len1 > 128))
	        {
	        	pass1_div.innerHTML="Use 6 To 128 Characters";
	        	pass2_div.innerHTML="Passwords don't match";
	        }
	        
	        else if(pass2!="" && pass1==pass2)
	        {
	        	pass1_div.innerHTML="<img src='images/icon-tick.png'/>";
	        	pass2_div.innerHTML="<img src='images/icon-tick.png'/>";
	        }
	        else if(pass2!="" && pass1!=pass2)
	        {
	        	pass1_div.innerHTML="<img src='images/icon-tick.png'/>";
	        	pass2_div.innerHTML="Passwords don't match";
	        }
	        else if(len1 < 6 || len1 > 128)
	        {
	        	pass1_div.innerHTML="Use 6 To 128 Characters";
	        }
	        else
	        {
	        	pass1_div.innerHTML="<img src='images/icon-tick.png'/>";
	        }
	        
	        return true;
    	}
	}


/**********************************************************************************************/

/**************************** PassWORD CONFRMATION VALIDATION   ********************************/
function confirmPassword(e)
	{
		//alert('inside validatePassword');
		var pass1=document.frmRegistration.clsbpUserLogin_txtPassword.value;
		var len1=pass1.length;
		
		var pass2=document.frmRegistration.clsbpUserLogin_txtConfirmation.value;
		var len2=pass2.length;
		
	//	var pass1_div=document.getElementById('Pass1_Div');
	//	pass1_div.style.color='#FF4040';
	//	pass1_div.style.size='11px';
		
		var pass2_div=document.getElementById('Pass2_Div');
		pass2_div.style.color='#FF4040';
		pass2_div.style.size='11px';
		//alert(len);
		
		
		if (window.event)
    	{
        	key = window.event.keyCode;
    	}
    	else if (e)
    	{
        	key = e.which;
    	}
		if(key == 32)
    	{
        	return false;
    	}
    	else
    	{
	        if( len2 != len1 )
	        {
	        	pass2_div.innerHTML="Passwords don't match";
	        }
	        if(len2 == len1)
	        {
	        	if(pass1==pass2)
	        	{
	        		pass2_div.innerHTML="<img src='images/icon-tick.png'/>";
	        	}
	        }
	        return true;
    	}
}
/**********************************************************************************************/

/******************** To check valid display names ********************************************/

function allowCharNum(e,txtname)
{	//alert("hello");
		var dispName=document.getElementById('DispName_Div');
		dispName.style.color='#FF4040';
		dispName.style.size='11px';
		dispName.style.float='right';
		
		var email=document.getElementById('Email_Div');
			email.style.color='#FF4040';
			email.style.size='11px';
			email.style.float='right';
			
			if (window.event)
		    	{
		        	key = window.event.keyCode;
		        	
		    	}
		    	else if (e)
		    	{
		        	key = e.which;
		    	}
		    	if((txtname=='clsbpUserLogin_txtEmail') && (key!=0 && key!=32 && key!=95 && key!=8 && key!=46 &&( key>122 || key<96 ) &&( key<64 || key>90 ) && (key < 48 || key > 57)))
    			{    
    				//alert(key);
    				email.innerHTML="Invalid Email ID";
    				return false;
    			}	
    			else if((txtname=='clsbpUserLogin_txtDisname') && (key!=0 && key!=32 && key!=95 && key!=8 &&( key>122 || key<96 ) &&( key<65 || key>90 ) && (key < 48 || key > 57)))
    			{	dispName.innerHTML="Enter only letters and numbers";
        			return false;
    			}
    		   
    		   else
    			{
    				//alert(key);
    				return true;
    			}
    			
}

/***32 to 47,58 to 64 , 91 to 96 ,123 to 126		***/
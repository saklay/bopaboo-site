
// Copyright ©2008 by VIJ
//-------------------------------------------------------------------------
// Project : 
// Developer : Hitesh Rawal
// Reviewer : Vaibhav Shete
// Date of creation : dd.mm.yyyy
//-------------------------------------------------------------------------
// Contains the javascript code used for handle all the functionality of player.
//
//-------------------------------------------------------------------------


//g_strSiteURL="/bopaboo/dev/";
g_strSiteURL="/dev/";
var MAX_PROFILE=24;
function isNullOrUndefined(strA,strValue){
	if(typeof strValue != 'undefined'){
		if (typeof strA == 'undefined'){
			return strValue;
		}else{
			if(strA == null){
				return strValue;
			}else{
				return strA;
			}
		}
	}else{
		if(typeof strA == 'undefined'){
			return true;
		}else{
			if(strA == null){
				return true;
			}else{
				return false;
			}
		}
	}
}
function requestURL(strUrl, oProcessReqChangeGet, oReqGet, myObj, myFun,strMode,strUrlParam){
	var strMethod;
	if(strMode != '2'){
		strMethod = "GET";
	}else{
		strMethod = "POST";
	}
	function processReqBinder(){
		if(oProcessReqChangeGet){
			oProcessReqChangeGet(oReqGet, myObj, myFun); 
		}else{
			//msgBox('no callback defined');
		}
	};
	if(window.XMLHttpRequest){
		if(oReqGet != null){
			if(strMode == '3'){
				var strEmail = ge("email").value;
				var strPasswordHashValue = hex_sha1(ge("password").value);
				var strParams = "email=" +strEmail+"&password_hash="+strPasswordHashValue;
				oReqGet.onreadystatechange = processReqBinder;
				oReqGet.open("POST", strUrl, true);
				oReqGet.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				oReqGet.setRequestHeader("Content-length", strParams.length);
				oReqGet.send(strParams);
			}else if(strMode == '2'){
				oReqGet.onreadystatechange = processReqBinder;
				oReqGet.open("POST", strUrl, true);
				oReqGet.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				if(isNullOrUndefined(strUrlParam)){
					var strTmpParam = 'aa = bb';
					oReqGet.setRequestHeader("Content-length", strTmpParam.length);
					oReqGet.send(strTmpParam);
				}else{
					oReqGet.setRequestHeader("Content-length", strUrlParam.length);
					oReqGet.send(strUrlParam);
				}
			}else{
				oReqGet.onreadystatechange = processReqBinder;
				oReqGet.open(strMethod, strUrl, true);
				oReqGet.send(null);
			}
		}else{
			messageAlert("Your browser does not support XMLHTTP.","1");
		}
	}else if(window.ActiveXObject){
		if(strMode == '3'){
			var strEmail = ge("email").value;
			var strPasswordHashValue = hex_sha1(ge("password").value);
			var strParams = "email=" +strEmail+"&password_hash="+strPasswordHashValue;
			oReqGet.onreadystatechange = processReqBinder;
			oReqGet.open("POST",strUrl,true);
			oReqGet.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			oReqGet.send(strParams);
		}else if(strMode == '2'){
			oReqGet.onreadystatechange = processReqBinder;
			oReqGet.open("POST", strUrl, true);
			oReqGet.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			oReqGet.send(strUrlParam);
		}else{
			oReqGet.onreadystatechange = processReqBinder;
			oReqGet.open(strMethod, strUrl, true);
			oReqGet.send();
		}
	}else{
		msgBox("Error\n Please Try Again\n","1");
	}
}

function createRequest(){
	var oReq = null;
	if (window.XMLHttpRequest){
		oReq = new XMLHttpRequest();
	}else if(window.ActiveXObject){
		oReq = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return oReq;
}

function newLoadNewAJAX(strUrl,myObj,myFun,mode,myParam,urlParam){
	//alert(strUrl);
	strUrl = g_strSiteURL+strUrl;
	//alert(strUrl);
	//alert('newLoadNewAJAX::strUrl:'+strUrl);
	var oReqGet = createRequest();
	if(oReqGet == null){
		if(mode != "1"){
			messageAlert("???????????????.","1");
		}
		return;
	}
	var oProcessReqChangeGet = function processResult(oReqGet, myObj, myFun) {
		if(oReqGet.readyState == 4){ // 4 means it has finished, but you can get results even before the transmition have ended.
			if(oReqGet.status == 200){ // 200 means Success
			
				g_strReturnDataAJAX = oReqGet.responseText;
				if(myObj != "noObj"){
					eval(myObj).setDoc(g_strReturnDataAJAX);
				}
				if(myFun != "noFun"){
					if(isNullOrUndefined(myParam)){
						if(mode == "10"){
							var myParam2=g_strReturnDataAJAX;
							eval(myFun)(myParam2);
						}else{ 
							eval(myFun)();
						}
					}else{
						if(mode == "10"){
							myParam2=g_strReturnDataAJAX;
							eval(myFun)(myParam2,myParam);
						}else{ 
							eval(myFun)(myParam);
						}
						
					}
				}
				return;
			}
			if(mode != "10"){
				messageAlert("???????????????.","1");// HTTP Error
			}
		}
	};
	requestURL(strUrl,oProcessReqChangeGet,oReqGet,myObj,myFun,mode,urlParam);
}

/**********************************************************************************************/
/**********************************************************************************************/
/**********************************************************************************************/
/**********************************************************************************************/
/**********************************************************************************************/


function afterAjax(param1,param2)
{
	//alert ("Param1  "+param1);
	//alert ("Param2  "+param2);
	
	document.getElementById(param2).innerHTML=param1;
}
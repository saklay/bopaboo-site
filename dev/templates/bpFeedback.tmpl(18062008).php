<script  type="text/javascript" language="javascript">
var stars;
var fileId;
var resp;
var img,img1;
var check;
var controls;
var stat;
var pageIndex1;


function fn_showTab(tabName,gourl){

<!--for changing the tab class-->
if(tabName=='received'){
	if(document.getElementById('rec')){
	document.getElementById('rec').className = 'currentsel';
	document.getElementById('pro').className = '';
	}
}
if(tabName=='provided'){
	if(document.getElementById('pro')){
	document.getElementById('rec').className = '';
	document.getElementById('pro').className = 'currentsel';
	}
}
<!--end of changing the tab class-->

<!--Displaying loader image-->
document.getElementById('loader1').style.visibility ='visible';

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){

  alert ("Browser does not support HTTP Request")
  return
} 

function stateChangedTab() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 
 document.getElementById('tabdata').innerHTML=xmlHttp.responseText ;

 <!--Stop  loader image-->
document.getElementById('loader1').style.visibility ='hidden';	
 } 
}
	
	var url=gourl+"&tabName="+tabName;


	xmlHttp.onreadystatechange=stateChangedTab;
	
	//document.write(url);
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)

}


	


<!-- Begin

function fn_alert(rateId,fileId,sellerId,count){
	
	
	var control,i;
	controls = 'document.frmrating.starUser'+fileId;
	controls = eval(controls);
	control = 'document.frmrating.starUser'+fileId;
	
	check = fileId;
	//control = eval(control);
	control.value=rateId;
	
	stars=rateId;
	
	


	for (var i = 0; i < 10; i++) {
	img ='img_'+i;
	img1 ='img1_'+i;
		if(document.getElementById(img)){
			if(document.getElementById(img).style.display == '' || document.getElementById(img1).style.display == ''){
			document.getElementById(img).style.display = '';
			document.getElementById(img1).style.display = 'none';
			}
		}
	}
	img1 ='img1_'+count;
	img ='img_'+count;
	document.getElementById(img).style.display = 'none';
	document.getElementById(img1).style.display = '';

}


function fn_addrate(fileId,sellerId,count){

if(stars==undefined){
alert('Please click the star to rate!');
//controls.value='';
return false;
}
if(check!=fileId){
alert('Please click the star to rate!');
controls.value='';

for (var i = 0; i < 10; i++) {
img ='img_'+i;
img1 ='img1_'+i;
if(document.getElementById(img)){
		if(document.getElementById(img).style.display == '' || document.getElementById(img1).style.display == ''){
	document.getElementById(img).style.display = '';
	document.getElementById(img1).style.display = 'none';
	}
}
}


return false;
}
img ='img_'+count;
img1 ='img1_'+count;
tr ='tr_'+count;
document.getElementById(img).style.display = 'none';
document.getElementById(img1).style.display = 'none';
document.getElementById(tr).style.display = 'none';
	resp = 'Response'+fileId;
	
	//resp = eval(resp);
	
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){

  alert ("Browser does not support HTTP Request")
  return
} 
	var url="feed.php?fileId="+fileId+"&sellerId="+sellerId+"&rateId="+stars;
// document.getElementById(fileId).style.width = 20;
	url=url+"&sid="+Math.random()
	xmlHttp.onreadystatechange=stateChanged;
	//document.getElementById(fileId).style.width = 20;
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)

}

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
  
 document.getElementById(resp).innerHTML=xmlHttp.responseText ;
 	
 } 
}

function GetXmlHttpObject()
{
var xmlHttp=null;
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
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}
</script>



<div id="container">

      <div id="submenu">
           <a href="bpAccountActivity.php">bopaBank</a>	|	<a href="bpFeedback.php?feedbacklist=provided"  class="current">Feedback</a>	|	<a href="bpMyBopaMessageInbox.php">Messages</a>      </div>
        <div id="pageheadSell">
          <h1>Feedback</h1>
      </div>
      <div id="feedback">
      
          <table width="921" border="0" cellspacing="0" cellpadding="0" class="datalist">
                <tr>
                  <td><ul id="feedback-menu"><div id="loader1" style="visibility:hidden;" > <img src="images/o2.gif" alt="loader" /></div>
                    <li class="provided"><a href='javascript:void(0);' onclick="return fn_showTab('provided','bpajaxFeed.php?optionVal=1');" id="pro" class='currentsel'>You Provided</a></li>
                    <li class="received"><a href='javascript:void(0);' onclick="return fn_showTab('received','bpajaxFeed.php?');" id="rec" class=""  >You Received</a></li>
                  </ul></td>
                </tr>
<?php
if($clsbpFileDetails->feedbacklist=='provided'){
echo "<script type='text/javascript'>fn_showTab('provided','bpajaxFeed.php?optionVal=1');</script>";

}

?>
              <tr ><td  id="tabdata" ></td></tr>
                 
          </table>
          
         
              
        
        

        
        <div>
        </div>
        </div>
    </div>
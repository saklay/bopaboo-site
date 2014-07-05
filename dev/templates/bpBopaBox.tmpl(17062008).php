<script  type="text/javascript" language="javascript">
function fn_showTab(tabName,gourl,e){
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){

  alert ("Browser does not support HTTP Request")
  return
} 

function checkKeycode(e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
		else if (e) keycode = e.which;
return keycode;

}

function stateChangedTab() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 
 document.getElementById('bopasearchbox').innerHTML=xmlHttp.responseText ;
if(document.getElementById('textfield').value==''){
 document.getElementById('textfield').value='Search your bopaBox';
}
 else document.getElementById('textfield').focus();
 } 
}
if(tabName==''){
document.frmFileList.tabName.value='Search your bopaBox';
tabName=document.frmFileList.tabName.value;

}
	x=1000;
	if(e){       
		x=checkKeycode(e);
	}
	if(x!=1000){
		if(x!=32){
		var url=gourl+"&tabName="+tabName;
		if(document.getElementById('textfield')){
			txtword=document.form2.textfield.value;
			if(txtword!='Search your bopaBox'){
				url+="&searchWord="+txtword }
		
		}
		xmlHttp.onreadystatechange=stateChangedTab;
	
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		}
	}
	else{
		var url=gourl+"&tabName="+tabName;
		if(document.getElementById('textfield')){
			txtword=document.form2.textfield.value;
			if(txtword!='Search your bopaBox'){
				url+="&searchWord="+txtword }
		
		}
		xmlHttp.onreadystatechange=stateChangedTab;
	
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
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

/////////////////////////////////////////////////////////
//function fnSetAllCheckBoxes(FormName, FieldName, CheckValue)
//{
//	if(!document.forms[FormName])
//		return;
//	var objCheckBoxes = document.forms[FormName].elements[FieldName];
//	if(!objCheckBoxes)
//		return;
//	var countCheckBoxes = objCheckBoxes.length;
//	if(!countCheckBoxes)
//		objCheckBoxes.checked = CheckValue;
//	else
//		// set the check value for all check boxes
//		for(var i = 0; i < countCheckBoxes; i++)
//			objCheckBoxes[i].checked = CheckValue;
//}
function fnSetAllCheckBoxes(FormName, FieldName, CheckValue)
{
var frmcart = document.frmFileList;
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
		
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
			if(CheckValue == true)
			{
			fileIds		= getCheckedItem(frmcart,"check_list[]");
			
	
		document.getElementById('spanid').style.display ='';
document.getElementById('spanidnew').style.display='none'; 
			}
			else
			
			{

			document.getElementById('spanid').style.display ='none';
document.getElementById('spanidnew').style.display=''; 
			}
			
}


function fnChecking()
{
var chks = document.getElementsByName('check_list[]');

var hasChecked = false;
  for (var i = 0; i < chks.length; i++)

        {

                if (chks[i].checked)

                {

                        hasChecked = true;

                        break;

                }

        }
	if(	hasChecked == true)
	
	{

document.getElementById('spanid').style.display ='';
document.getElementById('spanidnew').style.display='none'; 

  
 
	}
	
	else
	
	{

document.getElementById('spanid').style.display ='none';
document.getElementById('spanidnew').style.display=''; 
	}
}
function fnPopUp(URL) {
day = new Date();
id = day.getTime();

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=0,statusbar=1,menubar=1,resizable=0,width=500,height=430,left = 262,top = 169');");
}
// End -->

function fn_viewDetails(fileId)
{
var frm = document.frmFileList;
frm.action="bpViewDetails.php?clsbpFileDetails_bi_file_id="+fileId+"&clsbpFileDetails_returnURL=<?php echo "bpBopaBox.php?";  ?><?php echo $_SERVER["QUERY_STRING"];?>";

frm.submit();

}



function fn_postSell() {
	var frmcart = document.frmFileList;
 	fileIds		= getCheckedItem(frmcart,"check_list[]");
// // 	
// // 	alert(frmcart.elements[check_list].value);
	
	if(fileIds==undefined || fileIds=='') {
		alert('Please select a song from list');
		
		return false
	}
	else {
		
 		frmcart.clsbpFileDetails_check_list.value = fileIds;
		
 		frmcart.action="bpMultiplePostSale.php";
 		frmcart.submit();
	}
}

function fn_postDelete() {
	
	var frmcart = document.frmFileList;
	fileIds		= getCheckedItem(frmcart,"check_list[]");
	
	var objName = document.getElementById('delink');
	if(fileIds==undefined || fileIds=='') {
		fileIds=0;
	}
	objName.href="bpMultipleFileDelete.php?"+"parameters=<?php echo "bpBopaBox.php?".urlencode($_SERVER["QUERY_STRING"]);?>"+"&clsbpFileDetails_delete_list="+fileIds+"&height=200&width=550&modal=true";
}

// function change(number)
// {
// alert(number);
// 	document.getElementById(number).style.className = 'artists';
	//this.style.className = 'artists';
//	return true;
 
 //}
function clstext(tab){
document.bgimage.src = 'images/btnSearchZoom.png';
document.getElementById('textfield').value='';
return fn_showTab(tab,'bpajaxBopaBox.php?optionVal=1');
document.getElementById('textfield').value="Search your bopaBox";

}

</script>
    <?php
if($_REQUEST['tabName']==''){
echo "<script type='text/javascript'>fn_showTab('All','bpajaxBopaBox.php?optionVal=1');</script>";
}
else{

echo "<script type='text/javascript'>fn_showTab('".$_REQUEST['tabName']."','bpajaxBopaBox.php?optionVal=1');</script>";
}

?>

<div id="container">	
        
        <div id="pageheadBopabox">
        	<h1>bopaBox</h1>

            	<div id="uploadmusic">
            	<a href='javascript:void(0);' onClick='javascript:window.open("upload.php","","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,screenX=150,screenY=150,top=150,left=150,height=725,width=880");'><img src="images/icon-uploadmusic.png" alt="Upload Music" width="165" height="52" border="0" /></a>
			</div>
    	</div>
                
 <div id="bopasearchbox">
		
            
      	  
      </div>
      
      </div>
      <div id="cls"></div>
<div id="ad">   <!-- Begin: AdBrite -->
          <script type="text/javascript">
				var AdBrite_Title_Color = '0000FF';
				var AdBrite_Text_Color = '000000';
				var AdBrite_Background_Color = 'FFFFFF';
				var AdBrite_Border_Color = 'CCCCCC';
				var AdBrite_URL_Color = '008000';
            </script>
          <span style="white-space:nowrap;">
          <script src="http://ads.adbrite.com/mb/text_group.php?sid=597989&amp;zs=3732385f3930" type="text/javascript"></script>
          <!--  -->
          <a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=597989&amp;afsid=1"> <img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#CCCCCC;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" /> </a> </span>
          <!-- End: AdBrite --></div>
<script  type="text/javascript" language="javascript">
function fn_showTab(tabName,gourl){

//alert(tabName);
//alert(gourl);
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){

  alert ("Browser does not support HTTP Request")
  return
} 

function stateChangedTab() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 
 document.getElementById('container').innerHTML=xmlHttp.responseText ;
/*alert(document.getElementById);*/
//window.location = "#file_"+document.getElementById("hid_file_id").value;
//alert(document.getElementById("hid_file_id").value);
 	
 } 
}
	
	var url=gourl+"&tabName="+tabName;

//alert( gourl);
	xmlHttp.onreadystatechange=stateChangedTab;
	
	//document.write(url);
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)

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
/*function setFileId(file_id)
{
	document.getElementById("hid_file_id").value = file_id;
}*/	
</script>
    <?php

echo "<script type='text/javascript'>fn_showTab('sellLogged','bpAjaxSellLogged.php?optionVal=1&sortDirection=DESC&sortColumn=vc_title_nm_mod');</script>";



?>

<div id="container">	
</div>
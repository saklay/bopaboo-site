<script  type="text/javascript" language="javascript">
function changeClass(Elem, myClass) {
	var elem;
	if(document.getElementById) {
		var elem = document.getElementById(Elem);
	} else if (document.all){
		var elem = document.all[Elem];
	}
     document.getElementById("All").className="tabOff";
     document.getElementById("MyUploads").className="tabOff";
     document.getElementById("Sale").className="tabOff";
     document.getElementById("Purchase").className="tabOff";
     // document.getElementById("tabId").value=Elem;
     elem.className = myClass;

}


function fn_showTab(tabName,gourl,e){
document.getElementById('loadImage').style.visibility ='visible';
changeImage();
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
                    document.getElementById('loadImage').style.visibility ='hidden';
               } 
 }

if(tabName==''){
          document.frmFileList.tabName.value='search your bopaBox';
          tabName=document.frmFileList.tabName.value;
          
          }
               x=1000;
               if(e){       
                         x=checkKeycode(e);
               }
               if(x!=1000){
                         if(x!=32){
                              tabName=document.getElementById("tabId").value;
                              var url=gourl+"&tabName="+tabName;
                                if(document.getElementById('textfield')){
                                        txtword=document.form2.textfield.value;
                                        if(txtword!='search your bopaBox'){
                                                  url+="&searchWord="+txtword 
                                        }                         
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
                                             if(txtword!='search your bopaBox'){
                                                       url+="&searchWord="+txtword 
                                             }
                                        
                              }
                              xmlHttp.onreadystatechange=stateChangedTab;
                              xmlHttp.open("GET",url,true)               
                              xmlHttp.send(null)
                              changeClass(tabName,"tab")
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


function clstext(){
document.bgimage.src = 'images/btnSearchZoom.png';
document.getElementById('textfield').value="";
document.getElementById('textfield').focus();
}
function changeImage(){
     txtword=document.form2.textfield.value;
			if(txtword!='' && txtword!='search your bopaBox' ){
				   document.bgimage.src = 'images/btnSearchNo.png';}
                         else
                                   document.bgimage.src = 'images/btnSearchZoom.png';
}

</script>

  <div id="container">
  
      <div class="roundedTab" id="bopaBigBox">
        <div class="t">
          <div id="All" <?php if($_REQUEST[tabName]=='All') { echo "class='tab'";  } else  { echo "class='tabOff'";} ?>><h3 class="wide"><a href="#" onclick="return fn_showTab('All','bpajaxBopaBox.php?optionVal=1');">all</a></h3></div>
          <div id="MyUploads" class="tabOff"><h3 class="wide"><a href="#" onclick="return fn_showTab('MyUploads','bpajaxBopaBox.php?optionVal=1');">uploads</a></h3></div>
          <div id="Purchase" class="tabOff"><h3 class="wide"><a href="#" onclick="return fn_showTab('Purchase','bpajaxBopaBox.php?optionVal=1');">purchases</a></h3></div>
          <div id="Sale" class="tabOff"><h3 class="wide"><a href="#" onclick="return fn_showTab('Sale','bpajaxBopaBox.php?optionVal=1');">for sale</a></h3></div>
          <div id="loadImage" class="loading" style="visibility:hidden;"> <img src="<?php echo IMAGEPATH ?>o2.gif" alt="loading" width="16" height="16" /> </div>
          <div class="tr"></div>
        </div>
      </div>
    	
    	<div id="bopaboxRight">
    		<div id="search_zoom" onclick="clstext()" class="bopaboxSearchZoom"><img  name="bgimage" id="bgimage" src="images/btnSearchZoom.png" alt="search" /></div>
    		<div style="display:block;margin-left:775px;" class="bopaBoxSearch">
					<form id="form2" name="form2" method="post" action="" onsubmit="return false;">
        		<div id="bopaboxSearchBox"><input onkeyup="return fn_showTab('','bpajaxBopaBox.php?optionVal=2',event);" name="textfield" type="text" id="textfield" class="bopaboxSearchInputBox" onfocus="if (this.value=='search your bopaBox') {this.value = '';}" onblur="if(this.value=='') {this.value = 'search your bopaBox';}" value="search your bopaBox"/></div>
						<div style="visibility:hidden" id="tabId"></div>
      		</form>
    		</div>
    		
    	</div>

<?php
	if($_REQUEST['tabName']==''){
		echo "<script type='text/javascript'>fn_showTab('All','bpajaxBopaBox.php?optionVal=1');</script>";
	} else{
		echo "<script type='text/javascript'>fn_showTab('".$_REQUEST['tabName']."','bpajaxBopaBox.php?optionVal=1');</script>";
	}
?>
      
 			<div id="bopasearchbox">
		
            
      	  
  </div>
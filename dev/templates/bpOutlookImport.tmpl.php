<script  language="javascript">



function fnValidates()
{
  

	 
	var frm = document.form1;
	frm.action="bpUploadcsv.php";

	frm.submit();
}

function show(id){
	if(id==1){
	document.getElementById("inst").style.display = 'none';
	document.getElementById("hidelink").style.display = 'none';
	document.getElementById("showlink").style.display = '';
	}
	if(id==2){
	
	document.getElementById("inst").style.display = '';
	document.getElementById("showlink").style.display = 'none';
	document.getElementById("hidelink").style.display = '';
	}
}
function showInter(id){
	if(id==1){
	document.getElementById("inter").style.display = '';
	document.getElementById("interHide").style.display = '';
	document.getElementById("interShow").style.display = 'none';
	}
	if(id==2){
	document.getElementById("inter").style.display = 'none';
	document.getElementById("interHide").style.display = 'none';
	document.getElementById("interShow").style.display = '';
	}
	
}
  
</script>
<div class="popup486w">
    	<span class="box01"></span>
        <span class="box02">
        	<div id="importEmailAddressYahoo">
  <form id="form1" name="form1" method="post" action="" onsubmit="return fnValidates();" enctype="multipart/form-data">
  <div class="top">
  	<h1>Import Email Addresses</h1>
    <a href="#" onClick="tb_remove();"><img src="images/btn-close1.jpg" alt="close" width="19" height="19" border="0" class="closenow" /></a>
   </div>
   
   
	<div class="contents">
         	<label><span class="hdr">File type</span>
         	<select name="clsbpCSVImport_selectType" id="selectType" class="selectType">
              <option value="OL" selected="selected">Outlook (csv)</option>
              <option value="OLE">Outlook Express (csv)</option>
              <option value="Y">Yahoo!(csv)</option>
              <option value="CSL">Comma-Separated List (csv,.txt)</option>
              <option value="TDL">Tab-Delimited List (.tab,.txt)</option>
            </select>
         	</label>
            <label><span class="hdr">Select file</span><input   type="file" name="clsbpCSVImport_csv" id="upload" class="selectFile" /></label>
         	<label><span class="hdr">&nbsp;</span><input type="image" name="upload" id="upload" value="Submit" src="images/btn-upload.png" class="upload" /></label>
           
       <span class="contentftr">
       <span class="additionallink" id="hidelink"><a href="javascript: void(0);" onclick="javascript: show(1);">Hide detailed instructions</a></span>
       <span class="additionallink" id="showlink" style="display:none;"><a href="javascript: void(0);" onclick="javascript: show(2);">Show detailed instructions</a></span>
       <span class="expandedInstructions" id="inst" style="display:">
       	<span class="hdr">First export information from Microsoft Outlook.</span>
        <ol>
        	<li>Open Microsoft Outlook 97, 98,2000, 2003, XP. or 2003.</li>
        	<li>Open the &quot;File&quot; menu and select &quot;Import and Export.&quot; </li>
        	<li>Select &quot;Export to a File&quot; and click &quot;Next&quot;</li>
        	<li>Select &quot;Comma Separated Values (Windows)&quot; and click &quot;Next.&quot;</li>
        	<li>Select your &quot;Contacts&quot; folder and click &quot;Next.&quot; (Outlook 97 users: Perform step 4 first.)</li>
        	<li>Specify a location where you would like to save the file and enter a name for the .CSV file. Then click &quot;Next.&quot;</li>
        	<li>Make sure to check the box next to &quot;Export Contacts from the Contacts Folder.&quot; and then click &quot;Finish&quot; to export the date to the .CSV file.</li>
       	</ol>
       </span>
        <span class="additionallink" id="interShow"><a href="javascript: void(0);" onclick="javascript: showInter(1);">Show notice for international users</a></span>
        <span class="additionallink" id="interHide" style="display:none;"><a href="javascript: void(0);" onclick="javascript: showInter(2);">Hide notice for international users</a></span>
        </span> 
           <span class="expandedInstructions" id="inter" style="display:none;">
       	<span>We can only import files in English or a Western European language. If you haev contact information encoded in non-Western characters (eg. Chinese, Japanese etc) then you must make sure your file is encoded in the UTF-8 format before uploading. </span>
        
       </span>
              </div>
    
    
<div class="bottom">Switch Accounts:<br />
    <a href="bpGmailImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">Gmail</a> | <a  href="bpYahooImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">Yahoo</a> | <a href="bpHotmailImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">Hotmail</a> | <a href="bpAOLImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">AOL</a> | <a href="bpOutlookImport.php?height=770&width=419px&modal=true&returnUrl=" class="thickbox">Outlook</a> | <a href="bpOutlookImport.php?height=770&width=419px&modal=true&returnUrl=" class="thickbox">Other</a></div>

  </form>
</div>
        </span>
        <span class="box03"></span>
    </div>
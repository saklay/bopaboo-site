<script type="text/javascript" language="javascript">
function fnGo()
{
window.location="<?=HTTPS?>bpCreditCardAdd.php";
return false;
}
function fn_showTab(tabName,gourl){


xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){

  alert ("Browser does not support HTTP Request")
  return
} 

function stateChangedTab() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 
 document.getElementById('bopabank').innerHTML=xmlHttp.responseText ;
 	
 } 
}
	
	var url=gourl+"&tabName="+tabName;


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
</script>
<div id="bopabank" >
	<table width="900" border="0" cellspacing="0" cellpadding="0" class="datalist"><tr><td valign="top" class="bdy">
<form action="" method="post" name="formname">

<table width="100%" border="0" cellpadding="00" cellspacing="0" id="datacell">
                      <tr>
                      <th width="19%" align="center">Card Type</a></th>
                      <th width="17%" align="center">Last 4 Digits on Card</a></th>
                      <th width="18%" align="center">Expiration Date</th>
                      <th width="29%" align="center">Billing Address</th>
                      <th width="17%" align="center">Action</th>
                    </tr>
                   
                    <tr>
                      <td align="center">&nbsp;</td>
                      <td align="left">&nbsp;</td>
                      <td align="left">&nbsp;</td>
                      <td align="left">&nbsp;</td>
                      <td align="left">&nbsp;</td>
                    </tr>
                     <?php 
				
				$recordNumber	= $clsbpCreditCard->clsbpPaginate->recordNumberOffset;
				
				foreach ($arrfileDetails as $row) { ?> 
                    <tr>
                      <td align="center"><?php
					
					  
					  if($row['vc_card_type'] == "Visa" && $row['i_isPrimary'] ==1 ) {echo "<img src='".HTTP."images/tn-visa-primary.jpg' alt='visa-primary' width='60' height='38' />"; } else if($row['vc_card_type'] == "Visa") {echo "<img src='".HTTP."images/icon-visacard.png' alt='visa' />";}?></td>
                      <td align="left" valign="top" class="hspace1">****-****-****-<?php echo substr("$row[bi_card_num]", -4);    ?></td>
                      <td align="center" valign="top"><?php $year = substr($row['dt_expiry'],0,4);
$month = substr($row['dt_expiry'],5,2);

echo $month."/".$year;  ?></td>
                      <td align="left" valign="top" class="hspace"><?php echo $row['vc_addr']; ?></td>
                      <td align="center" valign="top"><a href="javascript:parent.document.location='<?=HTTPS?>bpCreditEdit.php?clsbpCreditCard_bi_card_id=<?php echo $row['bi_card_id']; ?>' " class="edit-remove">Edit</a> | <a href="<?=HTTPS?>bpCreditCardDelete.php?clsbpCreditCard_bi_card_id=<?php echo $row['bi_card_id']; ?>&height=316&width=100px&modal=true" class="edit-remove thickbox">Remove</a></td>
                    </tr>
                    <?php
				$recordNumber++;
				 } ?>
                  </table>
                  	  
</form>
</td></tr></table>
</div>

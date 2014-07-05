<SCRIPT language="JavaScript">

function fnshow (obje)
{

if (obje.value=='Search All Music')


 {obje.value = '';}

if (obje.value=='Search all') {obje.value = '';}

if (obje.value=='Search artists') {obje.value = '';}
if (obje.value=='Search albums') {obje.value = '';}
if (obje.value=='Search songs') {obje.value = '';}
if (obje.value=='Search sellers') {obje.value = '';}
document.getElementById('clsbpFileDetails_seachError').value = "";
}
function fnhide(obje)
{
	if(document.getElementById('clsbpFileDetails_seachCat').value != ""){
		if (obje.value=='') {obje.value = 'Search '+document.getElementById('clsbpFileDetails_seachCat').value;}
	}
	else
	{
		if (obje.value=='') {obje.value = 'Search All Music'}
	
	}	
}

function fnDisp(obj)
{

document.getElementById('clsbpFileDetails_txtSearch').value = 'Search ' + obj.innerHTML;
document.getElementById('clsbpFileDetails_seachCat').value = obj.innerHTML;


}

function fnsubmitInformation()
{
var error="";
 var searcharray = new Array();	
 searcharray[0] ="Search All Music"; 
   searcharray[1] ="Search all"; 
   searcharray[2] ="Search artists"; 
   
   searcharray[3] ="Search albums"; 

   searcharray[4] ="Search sellers"; 
   for(i=0;i<searcharray.length;i++)
  
   {
 
   if(document.getElementById('clsbpFileDetails_txtSearch').value ==  searcharray[i] && document.getElementById('clsbpFileDetails_seachError').value=="")
   {
   error = "search term should have two or more characters";
   var url ="bpBuy.php";
   window.location=url+"?msg="+error;	
   return false;
   }
   }
if(document.frmSearch.clsbpFileDetails_txtSearch.value.length <2 && document.frmSearch.clsbpFileDetails_txtSearch.value!="")
{
		error = "search term should have two or more characters";	
document.getElementById("errormsg").innerHTML=error;
return false;
}
return true;
}

</SCRIPT>
<?php 
$message = $_REQUEST['msg'];
$temp = isset($_GET['tab']) ? trim($_GET['tab']) : '';
?>

  <div id="container">
  
      <div class="roundedTab" style="width:720px;">
        <div class="t">
        		<div id="buyTab1" class="<?php if ($temp == ""){echo "tab";}else{echo "tabOff";} ?>"><h3 class="wide"><a href="javascript:display(1);">top 25</a></h3></div>
        		<div id="buyTab2" class="<?php if ($temp == "toptags"){echo "tab";}else{echo "tabOff";} ?>"><h3 class="wide"><a href="javascript:display(2);" >top tags</a></h3></div>
        		<div id="buyTab3" class="<?php if ($temp == "genre"){echo "tab";}else{echo "tabOff";} ?>"><h3 class="wide"><a href="javascript:display(3);" >genre</a></h3></div>
        		<div id="buyTab4" class="<?php if ($temp == "popular"){echo "tab";}else{echo "tabOff";} ?>"><h3 class="wide"><a href="javascript:display(4);" >popular</a></h3></div>
            <div class="tabOff"><h3 class="wide"><a href="bpAdvSearch.php" >search</a></h3></div>
          <div class="tr"></div>
        </div>
      </div>
      <div class="roundedTab" style="width:720px;background-color:#ffffff;">
        <div class="c"> <div class="cl">
          <!--add content-->
          <div id="errormsg" style="padding-left:10px; color:#FF0000"><?php echo $message; ?> </div>
          <div id="buyContent1" style="display: <?php if ($temp == ""){echo "block";}else{echo "none";} ?>;">
          	<div id="topTwentyfive">
          	<ul class="albumPics">
            	<li><a href="#"><img src="<?php echo IMAGEPATH ?>top50-tn-jpg001.jpg" alt="Celine Dion" width="105" height="97" border="0" /></a></li>
                <li><a href="#"><img src="<?php echo IMAGEPATH ?>top50-tn-jpg002.jpg" alt="Ricky" width="105" height="97" border="0" /></a></li>
                <li><a href="#"><img src="<?php echo IMAGEPATH ?>top50-tn-jpg003.jpg" alt="Boyband" width="105" height="97" border="0" /></a></li>
                <li><a href="#"><img src="<?php echo IMAGEPATH ?>top50-tn-jpg004.jpg" alt="Tupac" width="105" height="97" border="0" /></a></li>
            </ul>
            <form id="frmTopList" name="frmTopList" method="post" action="bpSearch.php">
    					<input type="hidden" name="clsbpFileDetails_flagTopSearch" value="">
    					<input type="hidden" name="clsbpFileDetails_vc_title_nm_mod" value="">
    					<input type="hidden" name="clsbpFileDetails_vc_artists_nm_mod" value="">
            <ol class="tags">               
            	    <?php
            	    	$i=0;
            	    	foreach ($top25Files as $row) {
            	    ?>
                      <li><a href="javascript:searchItem('<?php echo $row['vc_title_nm_mod']; ?>','<?php echo $row['vc_artists_nm_mod']; ?>')"><?php echo $row['vc_artists_nm_mod']; ?> - <?php echo $row['vc_title_nm_mod']; ?></a></li>
                      <?php
                      		$i++;
                      		if($i==25) { 
                      			break;
                      		}
                      	}
                      ?>
               
               
            </ol>
          	</form>
          </div>
          </div>
          
          <div id="buyContent2" style="display: <?php if ($temp == "toptags"){echo "block";}else{echo "none";} ?>;">
          	<div id="tags" style="padding:15px;width:700px;">
<?php             	
foreach ($arrTagname as  $row) {


$temp_tags = explode(",", $row["vc_tags"]); 



foreach ($temp_tags as $tag) {
$tag = trim($tag);
$tag = strtolower($tag);
if (isset($tags[$tag])) {


$tags[$tag]++;
} else {
$tags[$tag] = 1;
}
}
}

arsort($tags);

$tags = array_slice($tags,0,75);

ksort($tags, SORT_STRING);

// change these font sizes if you will
$max_size = "44px"; // max font size in %
$min_size = "12px"; // min font size in %

// get the largest and smallest array values
$max_qty = max(array_values($tags));
$min_qty = min(array_values($tags));

// find the range of values
$spread = $max_qty - $min_qty;
if (0 == $spread) { // we don't want to divide by zero
$spread = 1;
}

// determine the font-size increment
// this is the increase per tag quantity (times used)
$step = ($max_size - $min_size)/($spread);

// loop through our tag array

foreach ($tags as $key => $value) {
//$count = array_count_values($tags);

// calculate CSS font-size
// find the $value in excess of $min_qty
// multiply by the font-size increment ($size)
// and add the $min_size set above

$size = $min_size + (($value - $min_qty) * $step);
 $size = ceil($size);

if ($size   == 12)
{
$class = 'f007';
} elseif ($size> 12 and $size <=15) {
$class = 'f006';
} elseif ($size > 15 and $size <=18) {
$class = 'f004';
} 
elseif ($size > 18 and $size <24) {
$class = 'f002';
} 

else {
$class = 'f001';
}
// uncomment if you want sizes in whole %:
// $size = ceil($size);

if($key!='')
	echo '<a href="bpSearch.php?clsbpFileDetails_Search_tags='.$key.'" class="'.$class.'" title="'.$value.' files tagged with '.$key.'">'.$key.'</a>  ';



}
?>
						</div>
          </div>
          
          <div id="buyContent3" style="display: <?php if ($temp == "genre"){echo "block";}else{echo "none";} ?>;">
          	<div id="genre">
                                        	  <ul class="genreListings">

<?php 
	$i = 0;
	foreach ($arrfileDetails as $row) {
		$i++;
	}
	$i = ($i / 2) + 1;
	$liCount = 0;
?>
<?php foreach ($arrfileDetails as $row) {
		$liCount++;
		if ($liCount == $i) {
			echo "</ul><ul class=\"genreListings\">";
		}
?>
<li><?php 


$genrename = urlencode($row[vc_GenreName]);
echo "<a href=\"bpSearch.php?clsbpFileDetails_SearchGenreId=$row[bi_GenreId]&clsbpFileDetails_SearchGenreName=$genrename\">$row[vc_GenreName]</a>";?> </li>
<?php }  ?>                                  
                                      	    </ul>
          	</div>
        	</div>
   	  
          <div id="buyContent4" style="display: <?php if ($temp == "popular"){echo "block";}else{echo "none";} ?>;">
          	<div id="tags" style="padding:15px;width:700px;">
                        <?php
                        	$parameters = urlencode(getCurrentPageURL());
				$query = "SELECT vc_searchKeyword AS tag, bi_searchKeywordCount AS quantity
						FROM 
							tbl_search_records 
						WHERE
							bi_searchResultCount > 0
						ORDER BY 
							vc_searchKeyword 	ASC";
			
				$result = mysql_query($query);
			
				while ($row = mysql_fetch_array($result)) {
					$row['tag'] = trim($row['tag']);
					$row['tag'] = strtolower($row['tag']);
					$tags[$row['tag']] = $row['quantity'];
				}
				
				
				arsort($tags);

				$tags = array_slice($tags,0,25);

				ksort($tags, SORT_STRING);
				
				$max_size = 44; // max font size in %
				$min_size = 12; // min font size in %
				
				$max_qty = max(array_values($tags));
				$min_qty = min(array_values($tags));
				
				$spread = $max_qty - $min_qty;
				if (0 == $spread) { // we don't want to divide by zero
					$spread = 1;
				}
				
				$step = ($max_size - $min_size)/($spread);
				$count = 0;
				foreach ($tags as $key => $value) {
				if($count>=25) {break;}
				$size = $min_size + (($value - $min_qty) * $step);
				 if ($size   == 12)
				{
					$class = 'f007';
				} 
				elseif ($size> 12 and $size <=15) {
					$class = 'f006';
				} 
				elseif ($size > 15 and $size <=18) {
					$class = 'f004';
				} 
				elseif ($size > 18 and $size <24) {
					$class = 'f002';
				} 
				else {
					$class = 'f001';
				}
					
				echo '<a class="'.$class.'" href="bpSearch.php?clsbpFileDetails_txtSearch='.$key.'" style="font-size: '.$size.'px"';
				// perhaps adjust this title attribute for the things that are tagged
				//echo ' title="'.$value.' searches with '.$key.'"';
				echo '>'.$key.'</a> &nbsp; ';
				$count++;
				}
                        ?>
						</div>
          </div>    
   	      
</div>
          <!--cl -->
          </div><!-- c -->
        <div class="b"><span class="br"></span></div>
      </div> <!-- searchBox ends -->
      
      <div class="cls"></div>
            
    
  </div>

<?php 
if (session_is_registered("ARLOGINTIME"))
{
$timediff =  calcDateDiff(date("H-i-s"),$ARLOGINTIME);

//echo "minutes=$timediff";
if($timediff > 1) header("Location:bpTimeOut.php");
//$_SESSION["ARLOGINTIME"] = date("Y-m-d H:i:s");
}
function calcDateDiff($date1,$date2) {
//echo "date1=$date1<br>";
//echo "date2=$date2<br>";
    list ($hour,$minute,$second,) = split ('[/.-]', $date1);
    list ($hour1,$minute1,$second1,) = split ('[/.-]', $date2);
/*
    echo"<br>hour=$hour";
    echo"<br>minute=$minute";
    echo"<br>second=$second";
    echo"<br>hour1=$hour1";
    echo"<br>minute1=$minute1";
    echo"<br>second1=$second1";
*/
          if($hour<$hour1)
          {
             $h=24-$hour1;
             $h1=$hour%24;
             $h2=$h+$h1;

          }
          else
          {
             $h2=$hour-$hour1;
          }
          if($minute<$minute1)
          {
             $m=60-$minute1;
             $m1=$minute%60;
             $m2=$m+$m1;
          }
          else
          {
             $m2=$minute-$minute1;
          }
          if($second<$second1)
          {
             $s=60-$second1;
             $s1=$second%60;
             $s2=$s+$s1;
          }
          else
          {
             $s2=$second-$second1;
          }

$mm=$h2*60+$m2+$s2/60;
return $mm;
}

?>
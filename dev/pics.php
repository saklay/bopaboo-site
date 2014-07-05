<?php

$xml=''; 		
$xml ="<"."?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
$xml .="<images>";

for ($i = 1; $i <= 14; $i++) {
    $xml .= '<image><url>pics/image'.$i.'.jpg</url><link>bpSearch.php?term=xxx'.$i.'</link><albumName>Hot Fuss '.$i.'</albumName><artistName>The Killers</artistName></image>'."\r\n";
}
$xml .="</images>";

echo $xml
?>

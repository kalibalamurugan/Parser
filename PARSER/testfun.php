<?php


$stuff = array('orange','banana', 'apples','orange','apples','orange');
$frequence = array_count_values($stuff);


print_r($frequence);
$stuff= array_unique($stuff);
$i=0;
foreach ($frequence as $value) 
{

echo"<br/> $stuff[$i]-$value";$i++;
}

?>
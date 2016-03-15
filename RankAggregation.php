<?php

function Rank_Aggregation($schRank,$A11yRank,$pageURL,$nooflink)
{
	$AggregatedRank[$nooflink];  
	$f = fopen("logfile.txt", "a");
	for ($i = 1; $i<=$nooflink; $i++)
	{	
		$AggregatedRank[$i]=($schRank[$i]+$A11yRank[$i])/2;
		fputs($f,"...................................".PHP_EOL);
		fputs($f, "URL: " .$pageURL[$i] ."  Search Engine Rank Point: ". $schRank[$i] ."  Accessibility based Rank Point: ".  $A11yRank[$i] ." Aggregated Point: ". $AggregatedRank[$i]. PHP_EOL);		
    }		
	return $AggregatedRank;
}

?>
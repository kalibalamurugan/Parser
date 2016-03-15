
<?php
	
	include "ProfileChecker.php";
	

	//Developed by K.Balamurugan M.Tech
	ini_set("max_execution_time", 600);
	
	/* Defining a PHP Function */
	function Accessiblity_evaluation($url)
	{ 
    
	    $f = fopen("logfile.txt", "a");
		@ini_set('display_errors',0);
		//$ch = curl_init("https://achecker.grantsolutions.gov/checkacc.php?uri=". $url."&id=9d1a8ef5a3d348182940bbbd45c46562fa76c452&output=rest&guide=WCAG2-AA&offset=10");

		//Allocate a new cURL handle


		// We'll be returning this transfer, and the data is binary
		// so we don't want to NULL terminate
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);

		// Grab the jpg and save the contents in the $data variable
		//$response  = curl_exec($ch);
		//echo($response);
		// if (empty($response )){
		//    print "Nothing returned from url.<p>";
		//}
		// else{
		//$str_url  = "https://achecker.grantsolutions.gov/checkacc.php?uri=". $url."&id=9d1a8ef5a3d348182940bbbd45c46562fa76c452&output=rest&guide=WCAG2-AA&offset=10";
		//$response = getUrl($str_url);
		//echo	" $response  <br/> <br/>";
	     $response = file_get_contents("https://achecker.grantsolutions.gov/checkacc.php?uri=". $url."&id=9d1a8ef5a3d348182940bbbd45c46562fa76c452&output=rest&guide=WCAG2-A,WCAG2-AA,WCAG2-AAA&offset=10") ;
		//$response = file_get_contents("http://localhost/xampp/checkacc.php?uri=". $url." &output=rest&guide=WCAG2-A,WCAG2-AA,WCAG2-AAA & offset=10") ;
		// problem in page produced in xml format
		
		
		//$response = file_get_contents("http://localhost/xampp/AChecker/checkacc.php?uri=".$url."&id=211f02791ccac552f98e4cba84a769128eee4ce1&output=rest&guide=WCAG2-A,WCAG2-AA,WCAG2-AAA&offset=10");
		$xml = simplexml_load_string($response);
		// important line
		fputs($f, "URL: " . $url . PHP_EOL); 
		fputs($f, "No of  known Problems: " . $xml->summary->NumOfErrors . PHP_EOL); 
		fputs($f, "NumOfLikelyProblems: " . $xml->summary->NumOfLikelyProblems . PHP_EOL); 
		fputs($f, "NumOfPotentialProblems: " . $xml->summary->NumOfPotentialProblems . PHP_EOL);
		$i=0;
		foreach ($xml->results->result AS $item)
		{
			//fputs($f, "Type: " .$item->resultType . PHP_EOL);
			//fputs($f, "Error msg: <font size=2 color=	#ADFF2F>" .$item->errorMsg ."</font><br/>" . PHP_EOL);
			//	if (strcmp($item->resultType ,"Potential Problem")==0)
			//{
				$sequenceid=explode("_", $item->sequenceID);
				$checkid[$i]=$sequenceid[2];
				//fputs($f, "Checkid " . $sequenceid[2]. PHP_EOL);
				//echo "<font size=3 color=red>Checkid: ". $checkid[$i] ."</font> <br/> " ;
				//echo "<font size=2 color=green>line,col,checkid: ". $item->sequenceID."</font> <br/><br/>";//sequenceID 	A child of result. The unique sequence ID identifying each error/problem. This ID is used to pinpoint each error/problem in make/reverse decision request.
				$i++;
			//}

		}
     fclose($f);

		return(check($checkid));
	}

	function getUrl($url)
	{  

 
		$ch = curl_init($url); 
		$timeout = 0; // set to zero for no timeout 
		curl_setopt($ch, CURLOPT_HEADER, false); 
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
		//curl_setopt ($ch, CURLOPT_URL, $url); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
		//curl_setopt($ch, CURLOPT_PROXY, "10.10.80.12"); //your proxy url
		//curl_setopt($ch, CURLOPT_PROXYPORT, "3128"); // your proxy port number 
		//curl_setopt($ch, CURLOPT_PROXYUSERPWD, "username:pass"); //username:pass 
		$file_contents = curl_exec($ch);
		 
		curl_close($ch); 
		return $file_contents;
	}

?>
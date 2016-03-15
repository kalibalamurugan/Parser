
<?php
	//Developed by K.Balamurugan M.Tech
	include "rest webservice.php";
	/****
	* Accessibility PHP application for using the Bing Search API
	*/

	//url and api key for bing search
	$acctKey = 'o5y4ZptDReWF3ie0y88BTC0rqNaxhDxVue/sGKzeM3k';
	$rootUri = 'https://api.datamarket.azure.com/Bing/Search';
 // Encode the query and the single quotes that must surround it.
		
	// Read the contents of the .html file into a string.
	$contents = file_get_contents('searchbar_header.html');
	if (isset($_POST['query']))
	{
	   
        $query = urlencode("'{$_POST['query']}'");  
		// Get the selected service operation (Web or Image).
		$serviceOp = $_POST['service_op'];
		$profileOp = $_POST['profile'];

		// Construct the full URI for the query.
		$requestUri = "$rootUri/$serviceOp?\$format=json&Query=$query";

		// Here is where you'll process the query.
		// Encode the credentials and create the stream context.
		$auth = base64_encode("$acctKey:$acctKey");
		$data = array(
			'http' => array(
			'request_fulluri' => true,
			 'proxy' => '10.10.80.11:3128',
			// ignore_errors can help debug – remove for production. This option added in PHP 5.2.10
			'ignore_errors' => true,
			'header'  => "Authorization: Basic $auth")
		);
		$context = stream_context_create($data);

		// Get the response from Bing.
		$response = file_get_contents($requestUri, 0, $context);

		// The rest of the code samples in this tutorial are inside this conditional block.
		// Decode the response.
		$jsonObj = json_decode($response);
		$resultStr = '';
  		// Parse each result according to its metadata type.
		//no of result taken for evaluation
		$nooflink=1;
		foreach($jsonObj->d->results as $value)
		{
		    
			switch ($value->__metadata->type)
			{
				case 'WebResult':
	
				if ($nooflink<=5)
				{
	              
					//Creating Search Result Set
					//$resultStr .= 
					// "</br> <b>URL:$value->Url</b><br/><a href=\"{$value->Url}\">{$value->Title}</a><p>{$value->Description}</p> <br/>" ;
					//Saving data for score calculation
					$page[$nooflink]= "</br> <b><a href=\"{$value->Url}\">{$value->Title}</a><p>{$value->Description}</p> <p style=color:green>$value->Url</p></b><br/>" ;
					$pageURL[$nooflink]=$value->Url;
					$pas[$nooflink]=Accessiblity_evaluation($value->Url);
					$pagerankscore[$nooflink]=$nooflink;
					$nooflink=$nooflink+1;
				}
				else
					break;
		
				break;
				case 'ImageResult':
					$resultStr .= 
					"<h4>{$value->Title} ({$value->Width}x{$value->Height}) " .
					"{$value->FileSize} bytes)</h4>" .
					"<a href=\"{$value->MediaUrl}\">" .
					"<img src=\"{$value->Thumbnail->MediaUrl}\"></a><br />";
					break;
			}
		}
		//Bubble sort: of page result based on pas score
		$nooflink=$nooflink-1;
		//  important line print_r($pas);
		for ($i = 1; $i < $nooflink; $i++) {
			for ($j = $nooflink; $j >= $i; $j--) {
				if($pas[$j-1] > $pas[$j]) {
					$tmp = $pas[$j - 1];
					$pas[$j - 1] = $pas[$j];
					$pas[$j] = $tmp;
					$tmp=$page[$j - 1];
					$page[$j - 1] = $page[$j];
					$page[$j] = $tmp;
					$tmp=$pageURL[$j - 1];
					$pageURL[$j - 1] =$pageURL[$j];
					$pageURL[$j] = $tmp;
				    $tmp=$pagerankscore[$j - 1];
					$pagerankscore[$j - 1] =$pagerankscore[$j];
					$pagerankscore[$j] = $tmp;
					
				}
			}
		}
		for ($i = 1; $i<=$nooflink; $i++)
		{
		//  important line echo"<br/> $i.$pageURL[$i]";
		$resultStr .=$page[$i];
					
					
		}
		//   print_r($pas);

		// Substitute the results placeholder. Ready to go.
		
		$contents = str_replace('{RESULTS}', $resultStr, $contents);
    }
    else
    {

$resultStr.="<p>No standard web pages were found.</p>
            <p>Suggestions:</p>
            <ul>
            <li>* Make sure all words are spelled correctly.</li>
            <li>* Try different keywords.</li>
            <li>* Try more general keywords.</li>
            <li>* Try fewer keywords.</li>
            </ul>";
		$contents = str_replace('{RESULTS}', $resultStr, $contents);
		
    }		
	echo $contents;

?> 

</body>


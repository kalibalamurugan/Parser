<?php

	
	function check($checkids)
	{
		$f = fopen("logfile.txt", "a");
		$frequence = array_count_values($checkids);
		$checkids = array_unique($checkids);
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
		//profile loader
		$profileop=load_profile();
		if( $profileop==1) 
		$filename =  $root."/xampp/PARSER/Visual_Profile.xml";
	    elseif( $profileop==2) 
        $filename =  $root."/xampp/PARSER/Hearing_Profile.xml";
        elseif( $profileop==3) 
        $filename =  $root."/xampp/PARSER/Cognitive_Profile.xml";
        elseif( $profileop==12) 
        $filename =  $root."/xampp/PARSER/VH.xml";	
        elseif( $profileop==13) 
        $filename =  $root."/xampp/PARSER/VC.xml";	
        elseif( $profileop==23) 
       	$filename =  $root."/xampp/PARSER/HC.xml";	
        elseif( $profileop==123) 
        $filename =  $root."/xampp/PARSER/VHC.xml";	
        else
        $filename =  $root."/xampp/PARSER/KBA11Y_profile.xml";	

		$xml=simplexml_load_file($filename);
		$i=0;
		$inscore= array();
		$bol= array();
		//echo $xml;
      fputs($f, 'Profile Selected is '. $filename . PHP_EOL);
		foreach ($xml->rule AS $item) //list of  check id from user profiles
		{
			$k=0;
			$checkid=$item->id;
			//fputs($f, 'checkID'.$checkid. PHP_EOL); //all user check id printed into log file
			$pri=$item->pri;
			//echo "<br/>checked id of profile:$checkid and pri:$pri";
			foreach ($checkids as $value) //list of check id in url
			{
			    $k++;
				if ($checkid==$value)//matching userid and urlcheckid
				{
				  fputs($f, 'checkID Matched for '.$frequence[$value].' times '. PHP_EOL);
				  $bol[$i]=1;
				  $inscore[$i]=$bol[$i]*$pri*$frequence[$value];
				   fputs($f, 'inscore[i]'.$i.' ' .$inscore[$i] . PHP_EOL); 
				  //$nor=normalize($inscore[$i], 0, 9);
				  // echo"<br/> $value-$frequence[$value]- $inscore[$i]- $nor";
				}
				
			}
			if($bol[$i]!=1)
			{
				 $bol[$i]=0;
				 $inscore[$i]=0;  
		      fputs($f, '$inscore[$i]'.$i.' ' .$inscore[$i]. PHP_EOL); 
			}
			$i++;

		}
		$tot=0;
		for($j=0;$j<$i;$j++)
		{
			 //echo "<br/>value of tot: $tot , $inscore[$j]";
			 $tot=$tot+$inscore[$j];
		}
		$i=$i-1;
		fputs($f, 'Tot and i: '.$tot.' '. $i . PHP_EOL);
		$pas=($tot/$i);
		fputs($f, 'Pas Score '.$pas. PHP_EOL);
		fclose($f);
		//  important line echo "Accessibility score:$pas <br/>";
		return $pas;
	}

	function normalize($value, $min, $max) {
		$normalized = ($value - $min) / ($max - $min);
		return $normalized;
	}

	function load_profile()
	{
    $f = fopen("logfile.txt", "a");
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("Parser",$conn);
	$result = mysql_query("SELECT * FROM userauthentication  WHERE status=1");
	$count  = mysql_num_rows($result);
	$row = mysql_fetch_row($result);
	fputs($f, "User name ". $row[0]. PHP_EOL); 
	$result1 = mysql_query("SELECT * FROM registeration  WHERE Uname='" .  $row[0] . "'");
	$count1  = mysql_num_rows($result1);
    $row1 = mysql_fetch_row($result1);

   if($count>0 && $count>0) 
    	$val=$row1[3]; 
   else
    	$val=6;   


    	return($val);    

    }
	
	
	
?>

<?php
	function check($checkids)
	{
		$frequence = array_count_values($checkids);
		$checkids = array_unique($checkids);
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
		//profile loader
		$profileop=load_profile();
		if( $profileop==1) 
		$filename =  $root."/xampp/BingAC/Visual_Profile.xml";
	    elseif( $profileop==2) 
        $filename =  $root."/xampp/BingAC/Hearing_Profile.xml";
        elseif( $profileop==3) 
        $filename =  $root."/xampp/BingAC/Cognitive_Profile.xml";
        elseif( $profileop==12) 
        $filename =  $root."/xampp/BingAC/VH.xml";	
        elseif( $profileop==13) 
        $filename =  $root."/xampp/BingAC/VC.xml";	
        elseif( $profileop==23) 
       	$filename =  $root."/xampp/BingAC/HC.xml";	
        elseif( $profileop==123) 
        $filename =  $root."/xampp/BingAC/VHC.xml";	
        else
        $filename =  $root."/xampp/BingAC/KBA11Y_profile.xml";	

		$xml=simplexml_load_file($filename);
		$i=0;
		$inscore= array();
		$bol= array();
		//echo $xml;

		foreach ($xml->rule AS $item)
		{
			$k=0;
			$checkid=$item->id;
			$pri=$item->pri;
			//echo "<br/>checked id of profile:$checkid and pri:$pri";
			foreach ($checkids as $value) {
			    $k++;
				if ($checkid==$value)
				{
				  $bol[$i]=1;
				  $inscore[$i]=$bol[$i]*$pri*$frequence[$value];
				  //$nor=normalize($inscore[$i], 0, 9);
				  // echo"<br/> $value-$frequence[$value]- $inscore[$i]- $nor";
				}
				
			}
			if($bol[$i]!=1)
			{
				 $bol[$i]=0;
				 $inscore[$i]=0;  
			}
			$i++;

		}
		$tot=0;
		for($j=0;$j<$i;$j++)
		{
			 //echo "<br/>value of tot: $tot , $inscore[$j]";
			 $tot=$tot+$inscore[$j];
		}
		$pas=($tot/$i);
		//  important line echo "Accessibility score:$pas <br/>";
		return $pas;
	}

	function normalize($value, $min, $max) {
		$normalized = ($value - $min) / ($max - $min);
		return $normalized;
	}

	function load_profile()
	{

	$conn = mysql_connect("localhost","root","");
	mysql_select_db("Parser",$conn);
	$result = mysql_query("SELECT * FROM userauthentication  WHERE status=1");
	$count  = mysql_num_rows($result);
	$row = mysql_fetch_row($result);
	$result1 = mysql_query("SELECT * FROM registeration  WHERE Uname='" .  $row[0] . "'");
	$count1  = mysql_num_rows($result1);
    $row1 = mysql_fetch_row($result1);

   if($count>0 && $count>0) 
    	$val=$row1[3]; 
   else
    	$val=3;   


    	return($val);    

    }
	
?>

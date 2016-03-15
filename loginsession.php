<?php $conn = mysql_connect("localhost","root","");
mysql_select_db("Parser",$conn);
$result = mysql_query("SELECT * FROM userauthentication  WHERE status=1");
$count  = mysql_num_rows($result);

$row = mysql_fetch_row($result);
   if($count>0) {

    	echo $row[0];         
//echo "true";
} else {
echo  "false";
} ?>
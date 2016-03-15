<?php


$conn = mysql_connect("localhost","root","");
mysql_select_db("Parser",$conn);

$retval = mysql_query("UPDATE userauthentication SET status=0 WHERE  status=1", $conn);
if($retval) {

    	echo "true";         
//echo "true";
} else {
echo  "false";

}
?>
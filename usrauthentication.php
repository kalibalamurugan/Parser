<?php

if(count($_POST)>0) {
$conn = mysql_connect("localhost","root","");
mysql_select_db("Parser",$conn);
$result = mysql_query("SELECT * FROM userauthentication  WHERE Uname='" . $_POST["name"] . "' and pswd = '". $_POST["pwd"]."'");
$sql = "UPDATE userauthentication SET status=1 WHERE Uname='" . $_POST["name"] . "'";
$count  = mysql_num_rows($result);
$result1 = mysql_query("SELECT * FROM registeration  WHERE Uname='" . $_POST["name"] . "'");
$retval = mysql_query( $sql, $conn );
$row = mysql_fetch_row($result1);
   if($count>0 && $retval) {

    	echo $row[3];         
//echo "true";
} else {
echo  "false";
}
}
?>
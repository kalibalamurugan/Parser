<?php

if(count($_POST)>0) {


$conn = mysql_connect("localhost","root","");
mysql_select_db("Parser");
if( $conn )
{
 
   
if(! get_magic_quotes_gpc() )
{
	$username=addslashes($_POST["name"]);
	$pswd=addslashes($_POST["pwd"]);
	$email=addslashes($_POST["email"]);
	$keyword=addslashes($_POST["keyword"]);
	$a11yop=addslashes($_POST["a11yop"]);
  
}
else
{
	$username=$_POST["name"];
	$pswd=$_POST["pwd"]; 
	$email=$_POST["email"];
	$keyword=$_POST["keyword"];
	$a11yop=$_POST["a11yop"];
}





//inserting data order
$sql = "INSERT INTO registeration
	   (uname, email,keyword,a11yop)
	  VALUES
	   ('$username' ,'$email' ,'$keyword',$a11yop)";

//declare in the order variable
$result = mysql_query($sql);	//order executes

//$sql = "INSERT INTO registeration ".
    //   "(uname, email,keyword,a11yop) ".
      // "VALUES('$username' ,'$email' ,'$keyword',$a11yop)";
//$sql1 = "INSERT INTO userauthentication (uname, pswd,status)".

//"VALUES ('$username' ,'$pswd',0)";

//$retval = mysql_query( $sql, $conn );
//$retva11 = mysql_query( $sql1, $conn );
if( $result ) 
echo "Entered data successfully";
else
echo "Sorry for inconvience,try again";

}
else
	echo ('Could not connect: ' . mysql_error());  

}
?>



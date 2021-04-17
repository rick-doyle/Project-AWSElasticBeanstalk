<?php
function OpenCon()
{
  $dbhost = "xxxxxxxxxxx.xxxxxxxx.amazonaws.com";
  $dbuser = "xxxxxxxxxxxxxxxxxx";
  $dbpass = "xxxxxxxxxxxxxxxxxxxxx";
  $db = "crud_operation";

  $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
  return $conn;
 }
 
function CloseCon($conn)
{
  $conn -> close();
}
?>

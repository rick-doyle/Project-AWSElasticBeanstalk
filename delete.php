<?php
include 'config.php';
$conn = OpenCon();

$ID=$_GET['id'];
$sql="DELETE FROM tbl_connect WHERE tbl_id='$ID'";
$conn->query($sql);
header('Location:index.php');
?>

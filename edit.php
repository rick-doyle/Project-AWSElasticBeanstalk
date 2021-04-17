<?php
include 'header.php';

include 'config.php';
$conn = OpenCon();

$ID=$_GET['id'];

$sql="SELECT * FROM tbl_connect WHERE tbl_id='$ID'";
$result = $conn->query($sql);

$info=$result->fetch_assoc();

if(isset($_POST['Save']))
{
	
	if(isset($_FILES["images"]["name"]))
	{
		
		$filename="";
		$fext=pathinfo($_FILES["images"]["name"]);
		$ext=strtolower($fext['extension']);

		if($ext=="jpg" || $ext=="jpeg" || $ext=="png" || $ext=="gif" || $ext=="bmp")
		{
			$filename= date("YmhHis").".jpg";
		}
		
	$sql1="UPDATE tbl_connect SET tbl_name='".$_POST['name']."',tbl_email='".$_POST['email']."',tbl_address='".$_POST['address']."',sex='".$_POST['sex']."',date='".$_POST['date']."',image= '".$filename."' WHERE tbl_id='$ID'";

	$conn->query($sql1);
	$s3config = array(
            'region'  => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                'secret' => '/xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
            ]
        );
	$bucket = 'upfile-demo'; 


	require 'aws-module/aws-autoloader.php';
	$tmpfile = $_FILES["images"]["tmp_name"];
	$s3 = new Aws\S3\S3Client($s3config);
	#$key = str_replace(".","-".rand(1,9999).".",$tmpfile['name']);
	$key = $filename ; 
	$result = $s3->putObject([
		'Bucket' => $bucket,
		'Key'    => $key,
		'SourceFile' => $tmpfile['tmp_name'],
		'ACL'   => 'public-read'
	]);

	#move_uploaded_file($_FILES["images"]["tmp_name"],"upload/".$filename);
	
	header("Location:index.php");
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Record</title>
<link href="css/date.css" rel="stylesheet" type="text/css" media="screen"/>
<script type="text/javascript" src="js/date.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<form method="post" action="" name="myform" enctype="multipart/form-data">
		<div class="container">
  		<h2>Update Details</h2>
		<table class="table table-bordered table-striped text-center">
		<tbody>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" id="name" value="<?php echo $info['tbl_name']; ?>" /></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" id="email" value="<?php echo $info['tbl_email']; ?>"/></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" name="address" id="address" value="<?php echo $info['tbl_address']; ?>"/></td>
			</tr>
            <tr>
   				<td>Gender</td>
    			<td>
						  <select name="sex">
							  <option value="1" <?php if($info['sex'] == 1) echo 'selected="selected"';?>>Male</option>           
							  <option value="0" <?php if($info['sex'] == 0) echo 'selected="selected"';?>>Female</option>
						  </select>
				</td>
  			</tr>
            <tr>
				<td>Date</td>
				<td>
                <input type="text" name="date"  id="date" value="<?php echo $info['date']; ?>"/>
  				<input type="button" class="calendar" value="" onclick="displayDatePicker('date');"/></td>
			</tr>
            <tr>
                <td>Image</td>
               
                <td><input type="file" name="images" id="images" value="https://upfile-demo.s3.us-east-2.amazonaws.com/<?php echo $info['image']; ?>" /></td>
            </tr>
            
			<tr>			
				<td>&nbsp;</td>
				<td><input type="submit" name="Save" id="Save" value="Submit"/></td>
			</tr>
			<tr>
				<td></td>
			</tr>
					
		</tbody>
		</table>
	</form>
</body>
</html>

<?php
include 'header.php';

include 'config.php';
$conn = OpenCon();

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


	$sql="INSERT INTO tbl_connect(tbl_name,tbl_email,tbl_address,sex,date,image) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['address']."','".$_POST['sex']."','".$_POST['date']."','".$filename."')";	
	$result=$conn->query($sql);


	$s3config = array(
            'region'  => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
                'secret' => '/xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
            ]
        );
	$bucket = 'upfile-demo'; 


	require 'aws-module/aws-autoloader.php';
	$tmpfile = $_FILES["images"];
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
	echo "1 row added successfully";
	header("Location:index.php");
	}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add records</title>
<link href="css/date.css" rel="stylesheet" type="text/css" media="screen"/>
<script type="text/javascript" src="library/validate.js"></script> 
<script type="text/javascript" src="js/date.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<form enctype="multipart/form-data" method="post" action="" name="form_vali" id="form_vali" onsubmit="return myform_validation();">
		<div class="container">
  		<h2>Add Details</h2>
		 <table class="table table-bordered table-striped text-center">
		<tbody>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" id="name" /></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" id="email" /></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" name="address" id="address" /></td>
			</tr>
             <tr>
   				<td>Gender</td>
    			<!--<td><select name="sex" id="sex">
	   				<option>Select Sex</option>	
					<option value="male">Male</option>
					<option value="female">Female</option>
					</select>
				</td>-->
                <td><select name="sex" id="sex">
						<option>Please Select</option>	
						<option value="1">Male</option>
						<option value="0">Female</option>
					</select>
				</td>
  			</tr>
            <tr>
				<td>Date</td>
				<td>
                <input type="text" name="date"  id="date"/>
  				<input type="button" class="calendar" value="" onclick="displayDatePicker('date');"/></td>
			</tr>
            <tr>
                <td>Image</td>
                <td><input type="file" name="images" id="images"/></td>
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

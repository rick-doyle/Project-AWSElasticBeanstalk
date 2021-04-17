<?php
include 'header.php';
include 'config.php';
$conn = OpenCon();

$sql="SELECT * FROM tbl_connect";
$result = $conn->query($sql);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dashboard</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
		<div class="container">
  		<h2>Details</h2>
		 <table class="table table-bordered table-striped text-center">
		<thead>	
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Address</th>
                		<th>Gender</th>
                		<th>Date</th>
                		<th>Image</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if ($result->num_rows > 0) {
			while($info=$result->fetch_assoc())
			{
			
			?>
			
			<tr>
				<td><?php echo $info['tbl_name']; ?></td>
				<td><?php echo $info['tbl_email']; ?></td>
				<td><?php echo $info['tbl_address']; ?></td>
                <td>
					<?php if($info['sex'] == 0)
					{
						echo "Female";
					}
					else
					{
						echo "Male";
					}
					?>
					
				</td>
                <td><?php echo $info['date']; ?></td>
                <td><image id="image" src="https://upfile-demo.s3.us-east-2.amazonaws.com/<?php echo $info['image']; ?>" alt="image" width="50" height="75"></td>
				<td><a href="edit.php?id=<?php echo $info['tbl_id']; ?>"><img src="images/edit-icon.png" /></a></td>
				<td><a href="delete.php?id=<?php echo $info['tbl_id']; ?>"><img src="images/icon_delete.GIF" /></a></td>
    		</tr>
			<?php
			  }
			} else {
  				echo "0 results";
			}
			?>
		</tbody>
		</table>

</div>
</body>
</html>

<?php 	

	session_start();
	if(!isset($_SESSION['username'])){
		header("location:login.php");
	}

	elseif($_SESSION['usertype']=='student'){
		header("location:login.php");
	}

	$host="localhost";
	$user="root"; 
	$password="";
	$db="pspecial";

	$data=mysqli_connect($host,$user,$password,$db);

	if(isset($_POST['add_staff'])){
		$s_name=$_POST['name'];
		$s_designation=$_POST['designation'];
		$s_image=$_FILES['image']['name'];

		$dst="./staff_image/".$s_image;
		$dst_db="staff_image/".$s_image;

		move_uploaded_file($_FILES['image']['tmp_name'], $dst);


		/*Username Duplication catcher*/
		/*$check="SELECT * FROM user WHERE username='$username'";
		$check_user_variable=mysqli_query($data,$check);
		$row_count=mysqli_num_rows($check_user_variable);

		if($row_count==1){
			echo "<script type=text/javascript>
				alert('Username already exists, try another one');
			</script>";
		}

		else{*/
		$sql="INSERT INTO staff(name,designation,image) VALUES ('$s_name','$s_designation','$dst_db')"; 

		$result=mysqli_query($data,$sql);
		if($result){
			header('location:add_staff.php');
		}
		/*

		else{
			echo "<script type=text/javascript>
				alert('Failed to add student');
			</script>";
		}*/
	//}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
	<style>
		body{
	
	background:url('./images/st_pages/bg.jpg') repeat scroll center top #e6e7e4;
	
	 }
	</style>
	<?php 
		include 'admin_css.php';
	?>

	<style type="text/css">
		label{
			display: inline-block;
			text-align: right;
			width: 100px;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.div_deg{
			 background-color: skyblue;
			 width: 400px;
			 padding-top: 70px;
			 padding-bottom: 70px;
		} </style>

</head>
<body>
	<!-- <h1>admin home</h1>
	<a href="logout.php">Logout</a> -->

	<?php 	
		include 'admin_sidebar.php';
	?>

	<div class="content">
		<center>
		<h1 class="text-3xl font-bold my-6">Add Staff</h1>

		<div class="div_deg bg-slate-300 rounded-lg shadow-2xl">
			<form action="#" method="POST" enctype="multipart/form-data">
				<div>
					<label>Staff Name</label>
					<input type="text" name="name">
				</div>

				<br>
				<div>
					<label>Designation</label>
					<input type="text" name="designation">
				</div>
				<br>
				<div>
					<label>Image: </label>
					<input type="file" name="image">
				</div>
				<br>
				<div>
					<input type="submit" class="btn btn-accent" name="add_staff" value="Add Staff">
				</div>
			</form>
		</div>
		</center>

	</div>

	

</body>
</html>
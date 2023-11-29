<?php
	
	session_start();

	if(!isset($_SESSION['username'])){
		header("location:login.php");
	}

	elseif($_SESSION['usertype']=='admin'){
		header("location:login.php");
	}

	$host="localhost";
	$user="root"; 
	$password="";
	$db="pspecial";

	$data=mysqli_connect($host,$user,$password,$db);

	$name=$_SESSION['username'];

	//$id=$_GET['student_id'];

	$sql="SELECT * from user WHERE username='$name'";
	$result=mysqli_query($data,$sql);
	$info=mysqli_fetch_assoc($result);

	if(isset($_POST['update_profile'])){
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$password=$_POST['password'];

		$query="UPDATE user SET email='$email', phone='$phone', password='$password' WHERE username='$name'";
		$result2=mysqli_query($data,$query);
		if($result2){
			header("location:studenthome.php");
		}
	}


?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		include 'student_css.php';
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
		}
	</style>
</head>
<body>
	<!-- <h1>admin home</h1>
	<a href="logout.php">Logout</a> -->

	<?php
		include 'student_sidebar.php';
	?>

	<div class="content">
		<center>
		<h1 class="text-3xl font-bold my-8">Update Student Information</h1>

		<div class="div_deg bg-slate-300 rounded-lg shadow-2xl">
			<form action="#" method="POST">
				<div>
					<label>Email</label>
					<input type="email" name="email" value="<?php echo "{$info['email']}";?>">
				</div>

				<div>
					<label>Phone</label>
					<input type="number" name="phone"value="<?php echo "{$info['phone']}";?>">
				</div>

				<div>
					<label>Password</label>
					<input type="text" name="password" value="<?php echo "{$info['password']}";?>">
				</div>

				<div>
					<input type="submit" class="btn btn-accent btn-wide mt-4" name="update_profile" value="update">
				</div>
			</form>
		</div>
		</center>

	</div>

	

</body>
</html>
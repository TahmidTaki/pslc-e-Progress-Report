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

	if(isset($_POST['add_student'])){
		$username=$_POST['name'];
		$user_phone=$_POST['phone'];
		$user_email=$_POST['email'];
		$usertype="student";
		$user_password=$_POST['password'];

		/*Username Duplication catcher*/
		$check="SELECT * FROM user WHERE username='$username'";
		$check_user_variable=mysqli_query($data,$check);
		$row_count=mysqli_num_rows($check_user_variable);

		if($row_count==1){
			echo "<script type=text/javascript>
				alert('Username already exists, try another one');
			</script>";
		}

		else{
		$sql="INSERT INTO user(username,phone,email,usertype,password) VALUES ('$username','$user_phone','$user_email','$usertype','$user_password')"; 

		$result=mysqli_query($data,$sql);
		if($result){
			echo "<script type=text/javascript>
				alert('Successfully Added New Student');
			</script>";
		}

		else{
			echo "<script type=text/javascript>
				alert('Failed to add student');
			</script>";
		}
	}
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
			background: rgba(253,238,202,0.5);
-webkit-backdrop-filter: blur(25px);
backdrop-filter: blur(25px);
border: 1px solid rgba(253,238,202,0.25);
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
		include 'admin_sidebar.php';
	?>

	<div class="content">
		<center>
		<h1 class="font-bold text-2xl my-8">Add Student</h1>

		<div class="div_deg bg-slate-300 rounded-lg shadow-2xl">
			<form action="#" method="POST">
				<div>
					<label>Username</label>
					<input type="text" name="name">
				</div>

					<div>
					<label>Email</label>
					<input type="email" name="email">
				</div>

				<div>
					<label>Phone</label>
					<input type="number" name="phone">
				</div>

				<div>
					<label>Password</label>
					<input type="text" name="password">
				</div>

				<div class="mt-8">
					<input type="submit" class="btn btn-accent" name="add_student" value="Add Student">
				</div>
			</form>
		</div>
		</center>

	</div>

	

</body>
</html>
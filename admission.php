<?php 	

	session_start();
	if(!isset($_SESSION['username'])){
		header("location:login.php");
	}

	elseif($_SESSION['usertype']=='student'){
		header("location:login.php");
	}

	#connect db
	$host="localhost";
	$user="root";
	$password="";
	$db="pspecial";

	$data=mysqli_connect($host,$user,$password,$db);

	$sql="SELECT * from admission";
	$result=mysqli_query($data,$sql);


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
</head>
<body>
	<!-- <h1>admin home</h1>
	<a href="logout.php">Logout</a> -->


	<?php 	
		include 'admin_sidebar.php';
	?>


	<div class="content m-content">
		<center>
		<h1 class="font-bold text-2xl mt-8">Applied for Admission</h1>
		<br>
		<table class="bg-slate-300 rounded-lg shadow-2xl">
			
			<tr>
				<th style="padding:20px; font-size:15px;">Name</th>
				<th style="padding:20px; font-size:15px;">Email</th>
				<th style="padding:20px; font-size:15px;">Phone</th>
				<th style="padding:20px; font-size:15px;">Message</th>
			</tr>

			<?php 
				while($info=$result->fetch_assoc()){
			?>

			<tr class="bg-cyan-50">
				<th style="padding:20px;">
					<?php 
					echo "{$info['name']}";
					?>
				</th>
				<th style="padding:20px;">
					<?php 
						echo "{$info['email']}";
					?>
				</th>
				<th style="padding:20px;">
					<?php 
					echo "{$info['email']}";
					?>
				</th>
				<th style="padding:20px;">
					<?php 
					echo "{$info['message']}";
					?>
				</th>
			</tr>

			<?php 
				}
			?>

		</table>
		</center>
	</div>

	

</body>
</html>
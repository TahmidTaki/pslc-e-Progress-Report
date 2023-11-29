<?php 	

	session_start();
	if(!isset($_SESSION['username'])){
		header("location:login.php");
	}

	elseif($_SESSION['usertype']=='student'){
		header("location:login.php");
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
</head>
<body>
	<!-- <h1>admin home</h1>
	<a href="logout.php">Logout</a> -->

	<?php 	
		include 'admin_sidebar.php';
	?>

	<div class="content pl-6">
		<h1 class="mt-6 text-3xl font-bold">Admin Dashboard</h1>
		<p>Please choose your preferred actions from the left sidebar </p>
	</div>

	

</body>
</html>
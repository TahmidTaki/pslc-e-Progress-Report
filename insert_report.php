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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Insert Report</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.46.0/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
    <style media="screen">
      .div1{
        border: 2px solid black;
        padding: 30px;
        width: 500px;
        margin-left: 400px;
        margin-top: 100px;
      }
      #chapter_name{
        width: 350px;
        padding: 7px;
        font-size: 20px;
      }
      #pdf{
        font-size: 20px;
      }
      #insert{
        width: 130px;
        padding: 7px;
        font-weight: bold;
        font-size: 20px;
      }
    </style>
  </head>
  <body class="bg-stone-200 h-screen">
    <div class="pt-48">

    </div>
    <div class="div1 my-auto bg-slate-300 rounded-lg shadow-2xl">
      
      <?php
        //include 'db.php';
      $host="localhost";
	$user="root"; 
	$password="";
	$db="pspecial";

	$data=mysqli_connect($host,$user,$password,$db);
	$id=$_GET['student_id'];

	$sql="select * from user where id='$id'";


	$result=mysqli_query($data,$sql);
	$info=$result->fetch_assoc();
	
	/*if(isset($_POST['update'])){
		$name=$_POST['name'];

		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$password=$_POST['password'];

		$query="UPDATE user SET username='$name', email='$email', phone='$phone', password='$password' WHERE id='$id'";
		$result2=mysqli_query($data,$query);
		if($result2){
			header("location:view_student.php");
		}
	}*/

	//$conn=mysqli_connect($host,$user,$pass,$db);

        if (isset($_POST['insert'])) {
          $user_name=$_POST['name'];
          $pdf_name=$_FILES['pdf']['name'];
          $pdf_type=$_FILES['pdf']['type'];
          $pdf_size=$_FILES['pdf']['size'];
          $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
          $pdf_store="pdf/".$pdf_name;

          move_uploaded_file($pdf_tem_loc,$pdf_store);

          $query="INSERT INTO pdf_report(username,pdf) values('$user_name','$pdf_name')";
          $result2=mysqli_query($data,$query);
          if($result2){
			header("location:view_student.php");
		}
        }
     
       ?>

       <form class="" action="insert_report.php" method="post" enctype="multipart/form-data">
        <!-- <input id="chapter_name" type="text" name="chapter_name" value="" placeholder="Enter Chapter Name" required><br><br> -->
        <label class="font-bold">Username</label>
		<input class="border-2 px-2" type="text" name="name" value="<?php echo "{$info['username']}";?>">
    <h1 class="font-bold my-3">Upload e-Progress Report</h1>
        <input id="pdf" type="file" name="pdf" value="" required><br><br>
        <input class="btn btn-accent" id="insert" type="submit" name="insert" value="Insert">

      </form>

    </div>

  </body>
</html>

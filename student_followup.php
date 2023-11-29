<?php 
session_start();
	
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>e-Progress Report</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.46.0/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
    <style media="screen">
      .div1{
        width: 1100px;
        border: 2px solid black;
        padding: 0px;
        margin-left: 100px;
        /* height: 600px; */
      }
      p{
        background-color: orange;
        
        /* margin-top: -2px; */
        margin-left: -2px;
        margin-right: -2px;
        /* margin-bottom: -8px; */
        text-align: center;
        color: white;
        font-size: 30px;
        padding: 8px;
        font-weight: bold;
      }
      .div2{
        border: 2px solid black;
        width: 200px;
        margin-top: -30px;
        margin-left: -1px;
        max-height: 550px;
        overflow: auto;
        float: left;
      }
       #username{
        font-size: 20px;
        font-weight: bold;
        width: 180px;
        margin-top: 4px;
        padding: 8px;
        background-color: #056FE6;
        color: white;
        border: 1px solid #056FE6;
      }
      .pdf_deg{
        border: 1px solid #056FE6;
      }
      #username:hover{
        opacity: 0.8;
        cursor: pointer;
      } 
      .div3{
        float: left;
        width: 800px;
        
      }
      embed{
        width: 890px;
        height: 540px;
        margin-top: 10px;
        margin-bottom: 10px;

      }
    </style>
  </head>
  <body>
    <div class="div1">
      <p>e-Progress Reports</p>
      <div class="div2">
        <?php
        $host="localhost";
        $user="root"; 
        $password="";
        $db="pspecial";

		$data=mysqli_connect($host,$user,$password,$db);
		//$id=$_GET['student_id'];
		$username=$_GET['student_username'];

		//$sql="select * from user where name='$username'";

    $sql="SELECT * from pdf_report where username='$username' AND approval=2";
    //$sql="SELECT * from pdf_report";
    $query=mysqli_query($data,$sql);
    while ($info=mysqli_fetch_array($query)) {
      ?>
      <form class="" action="#" method="post">
        <input type="text" name="id" value="<?php echo $info['id']; ?>" hidden>
        <input type="submit" name="list" value="<?php echo $info['id']; ?>">

      </form>

      <?php
    }

         ?>

      </div>

      <div class="div3">
        <?php
        //error_reporting(0);

          $host="localhost";
          $user="root"; 
          $password="";
          $db="pspecial";
		      $data=mysqli_connect($host,$user,$password,$db);

          // $id=$_POST['idpdf'];
          

          // $sql1="SELECT * FROM pdf_book where id='$id'";
          $sql1="SELECT * from pdf_report where username='$username' AND approval=2";
          $query1=mysqli_query($data,$sql1);
          while ($info2=mysqli_fetch_array($query1)) {
          	?>
                <embed class="pdf_deg" type="application/pdf" src="pdf/<?php echo $info2['pdf']; ?>">
                
                <span class="pb-8">==================================================================================</span>
                <?php
            
          }
          

         ?>

      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    
  </body>
</html>

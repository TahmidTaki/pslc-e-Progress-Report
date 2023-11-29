<?php

	error_reporting(0);
	session_start();
	session_destroy();	

	if($_SESSION['message']){
		$message=$_SESSION['message'];

		echo" <script type='text/javascript'>
		alert('$message');
		</script> ";
	}

	$host="localhost";
	$user="root"; 
	$password="";
	$db="pspecial";

	$data=mysqli_connect($host,$user,$password,$db);
	$sql="SELECT * from staff";
	$result=mysqli_query($data,$sql);


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Penawar</title>
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/daisyui@2.46.0/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
	 body{
	
background:url('./images/st_pages/bg.jpg') repeat scroll center top #e6e7e4;

 }
 .content{
	background: #fdeef1;
background: -webkit-linear-gradient(0deg, #fdeef1 0%, rgba(248, 255, 232, 0.72) 100%);
background: linear-gradient(0deg, #fdeef1 0%, rgba(248, 255, 232, 0.72) 100%);
padding:20px 15px;

border-radius:15px

 }
  </style>
</head>
<body class="mainbody">
	<nav class="float-right">
		
		<ul>
			<li><a href="login.php" class="btn btn-wide">Login</a></li>
		</ul>
	</nav>

	<div class="mx-auto w-[1000px]">
	<div class="section1">
		<label class="img_text"></label>
		<img class="main_img" src="images/mainp.jpg">

	</div>
	<div class="bg-pink-600 mb-6 text-white font-bold">
	<div class="flex justify-between mx-auto md:justify-center md:space-x-8 py-1">
		<ul class="items-stretch flex">
			<li class="flex border-r-2 border-white">
				<a rel="noopener noreferrer" href="../index.php" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">Home </a>
			</li>
            <!-- <div className="divider divider-horizontal text-white"></div> -->
			<li class="flex  border-r-2 border-white">
				<a rel="noopener noreferrer" href="./Static_pages/about_us.php" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">About Us </a>
			</li>
			<li class="flex border-r-2 border-white">
				<a rel="noopener noreferrer" href="./Static_pages/school_based_program.php" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">School Based <br>Program </a>
			</li>
		</ul>
		
		<ul class="items-stretch space-x-3 flex">
			<li class="flex border-r-2 border-white">
				<a rel="noopener noreferrer" href="./Static_pages/therapy_center.php" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">Therapy Centre </a>
			</li>
			<li class="flex border-r-2 border-white">
				<a rel="noopener noreferrer" href="./Static_pages/education_and_autism.php" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">Education & <br>Autism </a>
			</li>
			<li class="flex border-r-2 border-white">
				<a rel="noopener noreferrer" href="./Static_pages/services.php" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">Services </a>
			</li>
			<li class="flex border-r-2 border-white">
				<a rel="noopener noreferrer" href="./Static_pages/speech_therapy.php" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">Speech Therapy </a>
			</li>
			<li class="flex">
				<a rel="noopener noreferrer" href="./Static_pages/about_autism.php" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">About Autism </a>
			</li>
		</ul>
		
	</div>
	</div>

	

	<!-- carousel -->
	<div class="carousel w-full">
		<div id="slide1" class="carousel-item relative w-full">
			<img src="./images/wpda4c83f1_05_06.jpg" class="w-full" />
			<div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
			<a href="#slide2" class="btn btn-circle">❮</a> 
			<a href="#slide2" class="btn btn-circle">❯</a>
			</div>
		</div> 
		<div id="slide2" class="carousel-item relative w-full">
			<img src="./images/wp46dcb4f3_05_06.jpg" class="w-full" />
			<div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
			<a href="#slide1" class="btn btn-circle">❮</a> 
			<a href="#slide1" class="btn btn-circle">❯</a>
		</div>
  </div> 
  
</div>

<!-- menu 1 -->


	<!-- <center>
		<h1 class="text-4xl">Our Team</h1>
	</center>

	<div class="">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
			<?php 
				while($info=$result->fetch_assoc()){
			?>
			<div class="">
				<img class="our_team rounded-md" src="<?php 
						echo "{$info['image']}";
					?>">
				<h3><?php 
						echo "{$info['name']}";
					?>
				</h3>
				<h4><?php 
						echo "{$info['designation']}";
					?>
				</h4>
			</div>
			<?php 
				}
			?>

			
		</div>

	</div> -->


	<!-- <center>
		<h1>Our Services</h1>
	</center>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img class="our_team" src="images/ser1.jpg">
				<h3>Speech Therapy</h3>
			</div>

			<div class="col-md-4">
				<img class="our_team" src="images/ser2.jpg">
				<h3>Occupational Therapy</h3>
			</div>

			<div class="col-md-4">
				<img class="our_team" src="images/ser3.jpg">
				<h3>Medical Doctor Consultation</h3>
			</div>

		</div>

	</div> -->
	<div class='w-full mx-auto mt-4 content'>
	<div class="mx-auto">
				<h1 class="text-center text-3xl font-semibold">Welcome to Penawar Special Learning center</h1>
				<p class="py-4">Penawar Special Learning Center which is a part of Penawar Medical group, aims to provide a friendly and enjoyable environment for children with a focus on best practice in therapy. Therapists provide full support to children with additional needs and their families through ten branches all over Malaysia. In order to do so, a Web-Based application would be significantly improving the efficiency of the institution in terms of communication between parents and therapists, finalizing therapy session reports by the head therapist, generating printed copy of therapy sessions, view progress of learning disability students, easier payment system for parents via online and so on.</p>
			</div>
		<img src="./images/wp5470471d_05_06.jpg" alt="" class="mx-auto">
	</div>


	<!-- occu therapy starts -->
	<div class="mt-8 bg-orange-50 rounded-xl pt-4">
		<h2 class="text-center text-3xl font-bold">About our Occupational Therapy</h2>

		<!-- sensory integration -->
		<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  	<div class="grid gap-10 lg:grid-cols-2">
    <div class="flex flex-col justify-center md:pr-8 xl:pr-0 lg:max-w-lg">
      <div class="flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-teal-accent-400">
        <svg class="text-teal-900 w-7 h-7" viewBox="0 0 24 24">
          <polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" points=" 8,5 8,1 16,1 16,5" stroke-linejoin="round"></polyline>
          <polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" points="9,15 1,15 1,5 23,5 23,15 15,15" stroke-linejoin="round"></polyline>
          <polyline fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" points="22,18 22,23 2,23 2,18" stroke-linejoin="round"></polyline>
          <rect x="9" y="13" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" width="6" height="4" stroke-linejoin="round"></rect>
        </svg>
      </div>
      <div class="max-w-xl mb-6">
        <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl sm:leading-none">
          Sensory
          <span class="inline-block text-purple-700">Integration</span>
        </h2>
        <p class="text-base text-gray-700 md:text-lg">
		Sensory integration is an innate neurobiological process and refers to the integration and interpretation of sensory stimulation from the environment by the brain. In contrast, sensory integrative dysfunction is a disorder in which sensory input is not integrated or organized appropriately in the brain and may produce varying degrees of problems in development, information processing, and behavior. <br>

In general, our main focal points are:
<ol class="ml-4 font-bold">
	<li>* Improving vestibular system</li>
	<li>* Improving gross motor development</li>
	<li>* Improving body posture and balance</li>
</ol>
        </p>
      </div>

	  
      
    </div>
    <div class="flex items-center justify-center -mx-4 lg:pl-8">
      <div class="flex flex-col items-end px-3">
        <img
          class="object-cover mb-6 rounded shadow-lg h-28 sm:h-48 xl:h-56 w-28 sm:w-48 xl:w-56"
          src="./images/st_pages/occu/sensory (1).png?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260"
          alt=""
        />
        <img class="object-cover w-20 h-20 rounded shadow-lg sm:h-32 xl:h-40 sm:w-32 xl:w-40" src="./images/st_pages/occu/sensory (2).png?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" alt="" />
      </div>
      <div class="px-3">
        <img class="object-cover w-40 h-40 rounded shadow-lg sm:h-64 xl:h-80 sm:w-64 xl:w-80" src="./images/st_pages/occu/sensory (3).png?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" alt="" />
      </div>
    </div>
  </div>
</div>
		<!-- sensory integration ends -->

		<!-- Motor therapy -->
		

		<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
    
    <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
      <span class="relative inline-block">
        <svg viewBox="0 0 52 24" fill="currentColor" class="absolute top-0 left-0 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
          <defs>
            <pattern id="7b568941-9ed0-4f49-85a0-5e21ca6c7ad6" x="0" y="0" width=".135" height=".30">
              <circle cx="1" cy="1" r=".7"></circle>
            </pattern>
          </defs>
          <rect fill="url(#7b568941-9ed0-4f49-85a0-5e21ca6c7ad6)" width="52" height="24"></rect>
        </svg>
        <span class="relative">Motor Planning</span>
		
      </span>
     
    </h2>
	<p class="text-center">Motor planning is part of a group of skills that help us move our body the way we want to. There are different kinds of motor skills that we use over and over again throughout our lifetime to get things done.

Gross motor skills help us move our large muscles so we can perform actions like walking, jumping, and balancing. Fine motor skills help us move smaller muscles that control our hands, wrists, and feet.

Motor planning is a process that helps us learn motor actions. You try something, and you get instant feedback on how it went. You adjust what you’re doing and try again. And you keep adjusting until you find the most efficient way of doing it. From then on, your brain quickly plans for that action every time.</p>
    
  </div>
  <div class="grid gap-5 row-gap-5 mb-8 lg:grid-cols-3 sm:grid-cols-2">
    <a href="#" aria-label="View Item" class="inline-block overflow-hidden duration-300 transform bg-white rounded shadow-sm hover:-translate-y-2">
      <div class="flex flex-col h-full">
        <img src="./images/st_pages/occu/motor1.png" class="object-cover w-full h-48" alt="" />
        <div class="flex-grow border border-t-0 rounded-b">
          <div class="p-5">
            <h6 class="mb-2 font-semibold leading-5">Improving body coordination</h6>
            
          </div>
        </div>
      </div>
    </a>
    <a href="#" aria-label="View Item" class="inline-block overflow-hidden duration-300 transform bg-white rounded shadow-sm hover:-translate-y-2">
      <div class="flex flex-col h-full">
        <img src="./images/st_pages/occu/motor2.png" class="object-cover w-full h-48" alt="" />
        <div class="flex-grow border border-t-0 rounded-b">
          <div class="p-5">
            <h6 class="mb-2 font-semibold leading-5">Improving gross motor development</h6>
            
          </div>
        </div>
      </div>
    </a>
    <a href="#" aria-label="View Item" class="inline-block overflow-hidden duration-300 transform bg-white rounded shadow-sm hover:-translate-y-2">
      <div class="flex flex-col h-full">
        <img src="./images/st_pages/occu/motor3.png" class="object-cover w-full h-48" alt="" />
        <div class="flex-grow border border-t-0 rounded-b">
          <div class="p-5">
            <h6 class="mb-2 font-semibold leading-5">Improving motor planning</h6>
            
          </div>
        </div>
      </div>
    </a>
    
    
    
    
  </div>
  
</div>
		<!-- Motor therapy ends -->


		<!-- play therapy -->

		<section class="p-4 lg:p-8 bg-orange-50 text-gray-800">
	<div class="container mx-auto space-y-12">
		<div class="flex flex-col overflow-hidden rounded-md shadow-sm lg:flex-row">
			<img src="./images/st_pages/occu/play1.png" alt="" class="h-80 bg-gray-500 aspect-video">
			<div class="flex flex-col justify-center flex-1 p-6 bg-gray-50">
				<span class="text-xs uppercase text-gray-600">Join, it's free</span>
				<h3 class="text-3xl font-bold">Play Therapy</h3>
				<p class="my-6 text-gray-600">Play therapy was originally conceived as a tool for providing psychotherapy to young people coping with trauma, anxiety, and mental illness. In that context, play becomes a way for children to act out their feelings and find coping mechanisms.

Play is a wonderful tool for helping children (and sometimes even adults) to move beyond autism's self-absorption into real, shared interaction. Properly used, play can also allow youngsters to explore their feelings, their environment, and their relationships with parents, siblings, and peers.</p>
				
			</div>
		</div>
		<div class="flex flex-col overflow-hidden rounded-md shadow-sm lg:flex-row-reverse">
			<img src="./images/st_pages/occu/social1.png" alt="" class="h-80 bg-gray-500 aspect-video">
			<div class="flex flex-col justify-center flex-1 p-6 bg-gray-50">
				
				<h3 class="text-3xl font-bold">Social Skills</h3>
				<p class="my-6 text-gray-600">Social skills will help your child with autism spectrum disorder (ASD) know how to act in different social situations – from talking to her grandparents when they visit to playing with friends at school.

Social skills can help your child make friends, learn from others and develop hobbies and interests. They can also help with family relationships and give your child a sense of belonging.

And good social skills can improve your child’s mental health and overall quality of life.</p>
				
			</div>
		</div>
		<div class="flex flex-col overflow-hidden rounded-md shadow-sm lg:flex-row">
			<img src="./images/st_pages/occu/adl.png" alt="" class="h-80 bg-gray-500 aspect-video">
			<div class="flex flex-col justify-center flex-1 p-6 bg-gray-50">
				
				<h3 class="text-3xl font-bold">ACTIVITY DAILY LIVING (ADLs)</h3>
				<p class="my-6 text-gray-600">By definition, ADLs are the essential tasks that each person needs to perform, on a regular basis, to sustain basic survival and well-being. The term helps healthcare professionals quickly communicate the level of assistance an individual might need or how their health is impacting their day-to-day life.

Activities of daily living (ADL) are also called self-help or self-care activities. These activities can include everyday tasks such as dressing, self-feeding, bathing, laundry, and / or meal preparation. Sometimes adaptive equipment is needed to assist with these tasks, which can include items such as a reacher, long-handled sponge, buttonholer, rocker knife, and / or built-up spoon.</p>
				
			</div>
		</div>
	</div>
</section>

		<!-- play therapy ends -->

	</div>
	<!-- occu therapy ends -->
<div class="bg-orange-50 py-8">

		<h1 class="adm_form text-center text-3xl font-bold">Admission Form</h1>
	

	<div align="center" class="admission_form ">
		
		<form action="admission_form_check.php" method="POST">
			
			<div class="adm_int">
				<label class="label_text">Name</label>
				<input class="input_deg" type="text" name="name">
			</div>

			<div class="adm_int">
				<label class="label_text">Email</label>
				<input class="input_deg" type="text" name="email">
			</div>

			<div class="adm_int">
				<label class="label_text">Phone</label>
				<input class="input_deg" type="text" name="phone">
			</div>

			<div class="adm_int">
				<label class="label_text">Message</label>
				
				<textarea class="input_txt" name="message"></textarea>
			</div>

			<div>
				<input class="btn btn-accent mt-2" id="submit" type="submit" value="APPLY" name="apply">
			</div>

			

		</form>
		</div>
</div>
	

		<footer>
			<h3 class="footer_text">PENAWAR SPECIAL LEARNING CENTRE 2018</h3>
		</footer>

	
	</div>


</body>
</html>
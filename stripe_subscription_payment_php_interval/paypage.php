<?php 
 
// Include configuration file  
require_once 'config.php'; 
 
// Include the database connection file 
include_once 'dbConnect.php'; 

session_start();
// echo $_SESSION['st_user'];
// echo $_SESSION['st_email'];
// echo $_SESSION['loggedInUserID'];
 
// Fetch plans from the database 
$sqlQ = "SELECT * FROM plans"; 
$stmt = $db->prepare($sqlQ); 
$stmt->execute(); 
$result = $stmt->get_result(); 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe</title>
    <link rel="stylesheet" type="text/css" href="paypage.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.46.0/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://js.stripe.com/v3/"></script>
<script src="js/checkout.js" STRIPE_PUBLISHABLE_KEY="<?php echo STRIPE_PUBLISHABLE_KEY; ?>" defer></script>
 <style>
    .content{
        background: rgba(254,231,205,0.5);
-webkit-backdrop-filter: blur(10px);
backdrop-filter: blur(10px);
border: 1px solid rgba(254,231,205,0.25);
height:screen;
    }
 </style>
</head>
<body class="bg-orange-50 ">
    <div class="w-[990px] mx-auto px-12 my-12 py-12 content">
            <div class="container">
        <div class="panel">

        <!-- plans -->
        <section class="py-20  text-gray-800">
	<div class="container px-4 mx-auto">
		<div class="max-w-2xl mx-auto mb-16 text-center">
			<span class="font-bold tracking-wider uppercase text-amber-600">Pricing</span>
			<h2 class="text-4xl font-bold lg:text-5xl">Choose your best plan</h2>
		</div>
		<div class="flex flex-wrap items-stretch -mx-4">
			<div class="flex w-full mb-8 sm:px-4 md:w-1/2 lg:w-1/3 lg:mb-0">
				<div class="flex flex-col p-6 space-y-6 rounded shadow sm:p-8 bg-gray-50">
					<div class="space-y-2">
						<h4 class="text-2xl font-bold">Beginner</h4>
						<span class="text-6xl font-bold">RM 20
							<span class="text-sm tracking-wide">/1month</span>
						</span>
					</div>
					<p class="mt-3 leading-relaxed text-gray-600">Monthly Subscription</p>
					<ul class="flex-1 mb-6 text-gray-600">
						<li class="flex mb-2 space-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-amber-600">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>e-Progress Reports</span>
						</li>
						<li class="flex mb-2 space-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-amber-600">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>Edit Profiles</span>
						</li>
						<li class="flex mb-2 space-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-amber-600">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>Good for new learners</span>
						</li>
					</ul>
					
				</div>
			</div>
			<div class="flex w-full mb-8 sm:px-4 md:w-1/2 lg:w-1/3 lg:mb-0">
				<div class="flex flex-col p-6 space-y-6 rounded shadow sm:p-8 bg-amber-600 text-gray-50">
					<div class="space-y-2">
						<h4 class="text-2xl font-bold">Pro</h4>
						<span class="text-6xl font-bold">RM 100
							<span class="text-sm tracking-wide">/6months</span>
						</span>
					</div>
					<p class="leading-relaxed">Half-Yearly Subscription</p>
					<ul class="flex-1 space-y-2">
                    <li class="flex mb-2 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>e-Progress Reports</span>
						</li>
						<li class="flex mb-2 space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>Edit Profiles</span>
						</li>
						<li class="flex mb-2 space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>Daily activity tracking</span>
						</li>
						<li class="flex items-center space-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>Auto renewal of payment after 6 months</span>
						</li>
					</ul>
					
				</div>
			</div>
			<div class="w-full mb-8 sm:px-4 md:w-1/2 lg:w-1/3 lg:mb-0">
				<div class="p-6 space-y-6 rounded shadow sm:p-8 bg-gray-50">
					<div class="space-y-2">
						<h4 class="text-2xl font-bold">Pro+</h4>
						<span class="text-6xl font-bold">RM 200
							<span class="text-sm tracking-wide">/12Months</span>
						</span>
					</div>
					<p class="leading-relaxed text-gray-600">Yearly Subscription</p>
					<ul class="flex-1 mb-6 text-gray-600">
						<li class="flex mb-2 space-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-amber-600">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>e-Progress Reports</span>
						</li>
						<li class="flex mb-2 space-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-amber-600">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>Edit Profiles</span>
						</li>
						<li class="flex mb-2 space-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-amber-600">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>Daily activity tracking</span>
						</li>
						<li class="flex mb-2 space-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-amber-600">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>Auto renewal of payment after 12 months</span>
						</li>
						<li class="flex mb-2 space-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 text-amber-600">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
							</svg>
							<span>Good for students having longer treatment phase</span>
						</li>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
</section>
        <!-- plans ends -->
            <div class="panel-heading">
                <h3 class="panel-title text-center text-3xl font-bold mb-12">Subscribe with your visa/master card</h3>
                
                <!-- Plan Info -->
                <div>
                    <b class="mb-4">Select Plan:</b>
                    <select id="subscr_plan" class="form-control">
                        <?php 
                        if($result->num_rows > 0){ 
                            while($row = $result->fetch_assoc()){ 
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name'].' [RM '.$row['price'].'/'.$row['interval_count']." ".$row['interval'].']'; ?></option>
                        <?php 
                            } 
                        } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="panel-body">
                <!-- Display status message -->
                <div id="paymentResponse" class="hidden"></div>
                
                <!-- Display a subscription form -->
                <form id="subscrFrm">
                    <div class="form-group">
                        <label>NAME</label>
                        <input type="text" id="name" class="form-control px-2" value="<?php echo $_SESSION['st_user'] ?>" readonly required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <label>EMAIL</label>
                        <input type="email" id="email" class="form-control px-2" value="<?php echo $_SESSION['st_email'] ?>" readonly required="">
                    </div>
                    
                    <div class="form-group c-element">
                        <label>CARD INFO</label>
                        <div id="card-element">
                            <!-- Stripe.js will create card input elements here -->
                        </div>
                    </div>
                    
                    <!-- Form submit button -->
                    <button id="submitBtn" class="btn btn-success">
                        <div class="spinner hidden" id="spinner"></div>
                        <span id="buttonText">Proceed</span>
                    </button>
                    <p class="text-red-800">After clicking proceed, please wait a few seconds for the system to process your payment</p>
                </form>
                
                <!-- Display processing notification -->
                <div id="frmProcess" class="hidden">
                    <span class="ring"></span> Processing...
                </div>
            </div>
        </div> 
        </div> 
    </div>


</body>
</html>
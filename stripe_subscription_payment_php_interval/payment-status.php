<?php 
// Include the configuration file  
require_once 'config.php'; 
 
// Include the database connection file  
require_once 'dbConnect.php'; 
 
$payment_id = $statusMsg = ''; 
$status = 'error'; 
 
// Check whether the subscription ID is not empty 
if(!empty($_GET['sid'])){ 
    $subscr_id  = base64_decode($_GET['sid']); 
     
    // Fetch subscription info from the database 
    // $sqlQ = "SELECT S.*, P.name as plan_name, P.price as plan_amount, U.first_name, U.last_name, U.email FROM user_subscriptions as S LEFT JOIN users as U On U.id = S.user_id LEFT JOIN plans as P On P.id = S.plan_id WHERE S.id = ?"; 
     $sqlQ = "SELECT S.*, P.name as plan_name, P.price as plan_amount, U.username, U.email FROM user_subscriptions as S LEFT JOIN user as U On U.id = S.user_id LEFT JOIN plans as P On P.id = S.plan_id WHERE S.id = ?"; 
    $stmt = $db->prepare($sqlQ);  
    $stmt->bind_param("i", $db_id); 
    $db_id = $subscr_id; 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
     
    if($result->num_rows > 0){ 
        // Subscription and transaction details 
        $subscrData = $result->fetch_assoc(); 
        $stripe_subscription_id = $subscrData['stripe_subscription_id']; 
        $paid_amount = $subscrData['paid_amount']; 
        $paid_amount_currency = $subscrData['paid_amount_currency']; 
        $plan_interval = $subscrData['plan_interval']; 
        $plan_period_start = $subscrData['plan_period_start']; 
        $plan_period_end = $subscrData['plan_period_end']; 
        $subscr_status = $subscrData['status']; 
         
        $plan_name = $subscrData['plan_name']; 
        $plan_amount = $subscrData['plan_amount']; 
 
        $customer_name = $subscrData['username']; 
        $customer_email = $subscrData['payer_email']; 
         
        $status = 'success'; 
        $statusMsg = 'Your Subscription Payment has been Successful!'; 
        ?>
        <h1><a href="../studenthome.php">Back to home page</a></h1>
        <?php 
    }else{ 
        $statusMsg = "Transaction has been failed!"; 
    } 
}else{ 
    header("Location: index.php"); 
    exit; 
} 
?>

<?php if(!empty($subscr_id)){ ?>
    <h1 class="<?php echo $status; ?>"><?php echo $statusMsg; ?></h1>
    
    <h4>Payment Information</h4>
    <p><b>Reference Number:</b> <?php echo $subscr_id; ?></p>
    <p><b>Subscription ID:</b> <?php echo $stripe_subscription_id; ?></p>
    <p><b>Paid Amount:</b> <?php echo $paid_amount.' '.$paid_amount_currency; ?>
</p>
    <p><b>Status:</b> <?php echo $subscr_status; ?></p>
    
    <h4>Subscription Information</h4>
    <p><b>Plan Name:</b> <?php echo $plan_name; ?></p>
    <p><b>Amount:</b> <?php echo $plan_amount.' '.STRIPE_CURRENCY; ?></p>
    <p><b>Plan Interval:</b> <?php echo $plan_interval; ?></p>
    <p><b>Period Start:</b> <?php echo $plan_period_start; ?></p>
    <p><b>Period End:</b> <?php echo $plan_period_end; ?></p>
    
    <h4>Customer Information</h4>
    <p><b>Name:</b> <?php echo $customer_name; ?></p>
    <p><b>Email:</b> <?php echo $customer_email; ?></p>
<?php }else{ ?>
    <h1 class="error">Your Transaction been failed!</h1>
    <p class="error"><?php echo $statusMsg; ?></p>
<?php } ?>
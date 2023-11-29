<?php 
// Include the configuration file 
require_once 'config.php'; 
 
// Include the database connection file 
include_once 'dbConnect.php'; 
 
// Include the Stripe PHP library 
require_once 'stripe-php/init.php'; 
 
// Set API key 
\Stripe\Stripe::setApiKey(STRIPE_API_KEY); 
 
// Retrieve JSON from POST body 
$jsonStr = file_get_contents('php://input'); 
$jsonObj = json_decode($jsonStr); 
 
// Get user ID from current SESSION 
session_start();
$userID = isset($_SESSION['loggedInUserID'])?$_SESSION['loggedInUserID']:1; 
 
if($jsonObj->request_type == 'create_customer_subscription'){ 
    $subscr_plan_id = !empty($jsonObj->subscr_plan_id)?$jsonObj->subscr_plan_id:''; 
    $name = !empty($jsonObj->name)?$jsonObj->name:''; 
    $email = !empty($jsonObj->email)?$jsonObj->email:''; 
     
    // Fetch plan details from the database 
    $sqlQ = "SELECT * FROM plans WHERE id=?"; 
    $stmt = $db->prepare($sqlQ); 
    $stmt->bind_param("i", $db_id); 
    $db_id = $subscr_plan_id; 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
    $planData = $result->fetch_assoc(); 
 
    $planName = $planData['name']; 
    $planPrice = $planData['price']; 
    $planInterval = $planData['interval']; 
     
    // Convert price to cents 
    $planPriceCents = round($planPrice*100); 
     
    // Add customer to stripe 
    try {   
        $customer = \Stripe\Customer::create([ 
            'name' => $name,  
            'email' => $email 
        ]);  
    }catch(Exception $e) {   
        $api_error = $e->getMessage();   
    } 
     
    if(empty($api_error) && $customer){ 
        try { 
            // Create price with subscription info and interval 
            $price = \Stripe\Price::create([ 
                'unit_amount' => $planPriceCents, 
                'currency' => STRIPE_CURRENCY, 
                'recurring' => ['interval' => $planInterval], 
                'product_data' => ['name' => $planName], 
            ]); 
        } catch (Exception $e) {  
            $api_error = $e->getMessage(); 
        } 
         
        if(empty($api_error) && $price){ 
            // Create a new subscription 
            try { 
                $subscription = \Stripe\Subscription::create([ 
                    'customer' => $customer->id, 
                    'items' => [[ 
                        'price' => $price->id, 
                    ]], 
                    'payment_behavior' => 'default_incomplete', 
                    'expand' => ['latest_invoice.payment_intent'], 
                ]); 
            }catch(Exception $e) { 
                $api_error = $e->getMessage(); 
            } 
             
            if(empty($api_error) && $subscription){ 
                $output = [ 
                    'subscriptionId' => $subscription->id, 
                    'clientSecret' => $subscription->latest_invoice->payment_intent->client_secret, 
                    'customerId' => $customer->id 
                ]; 
             
                echo json_encode($output); 
            }else{ 
                echo json_encode(['error' => $api_error]); 
            } 
        }else{ 
            echo json_encode(['error' => $api_error]); 
        } 
    }else{ 
        echo json_encode(['error' => $api_error]); 
    } 
}elseif($jsonObj->request_type == 'payment_insert'){ 
    $payment_intent = !empty($jsonObj->payment_intent)?$jsonObj->payment_intent:''; 
    $subscription_id = !empty($jsonObj->subscription_id)?$jsonObj->subscription_id:''; 
    $customer_id = !empty($jsonObj->customer_id)?$jsonObj->customer_id:''; 
    $subscr_plan_id = !empty($jsonObj->subscr_plan_id)?$jsonObj->subscr_plan_id:''; 
     
    // Fetch plan details from the database 
    $sqlQ = "SELECT * FROM plans WHERE id=?"; 
    $stmt = $db->prepare($sqlQ); 
    $stmt->bind_param("i", $db_id); 
    $db_id = $subscr_plan_id; 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
    $planData = $result->fetch_assoc(); 
 
    $planName = $planData['name']; 
    $planPrice = $planData['price']; 
    $planInterval = $planData['interval']; 
     
    // Retrieve customer info 
    try {   
        $customer = \Stripe\Customer::retrieve($customer_id);  
    }catch(Exception $e) {   
        $api_error = $e->getMessage();   
    } 
     
    // Check whether the charge was successful 
    if(!empty($payment_intent) && $payment_intent->status == 'succeeded'){ 
         
        // Retrieve subscription info 
        try {   
            $subscriptionData = \Stripe\Subscription::retrieve($subscription_id);  
        }catch(Exception $e) {   
            $api_error = $e->getMessage();   
        } 
 
        $payment_intent_id = $payment_intent->id; 
        $paidAmount = $payment_intent->amount; 
        $paidAmount = ($paidAmount/100); 
        $paidCurrency = $payment_intent->currency; 
        $payment_status = $payment_intent->status; 
         
        $created = date("Y-m-d H:i:s", $payment_intent->created); 
        $current_period_start = $current_period_end = ''; 
        if(!empty($subscriptionData)){ 
            $created = date("Y-m-d H:i:s", $subscriptionData->created); 
            $current_period_start = date("Y-m-d H:i:s", $subscriptionData->current_period_start); 
            $current_period_end = date("Y-m-d H:i:s", $subscriptionData->current_period_end); 
        } 
         
        $name = $email = ''; 
        if(!empty($customer)){ 
            $name = !empty($customer->name)?$customer->name:''; 
            $email = !empty($customer->email)?$customer->email:''; 
        } 
         
        // Check if any transaction data exists already with the same TXN ID 
        $sqlQ = "SELECT id FROM user_subscriptions WHERE stripe_payment_intent_id = ?"; 
        $stmt = $db->prepare($sqlQ);  
        $stmt->bind_param("s", $db_txn_id); 
        $db_txn_id = $payment_intent_id; 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        $prevRow = $result->fetch_assoc(); 
         
        $payment_id = 0; 
        if(!empty($prevRow)){ 
            $payment_id = $prevRow['id']; 
        }else{ 
            // Insert transaction data into the database 
            $sqlQ = "INSERT INTO user_subscriptions (user_id,plan_id,stripe_subscription_id,stripe_customer_id,stripe_payment_intent_id,paid_amount,paid_amount_currency,plan_interval,payer_email,created,plan_period_start,plan_period_end,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"; 
            $stmt = $db->prepare($sqlQ); 
            $stmt->bind_param("iisssdsssssss", $db_user_id, $db_plan_id, $db_stripe_subscription_id, $db_stripe_customer_id, $db_stripe_payment_intent_id, $db_paid_amount, $db_paid_amount_currency, $db_plan_interval, $db_payer_email, $db_created, $db_plan_period_start, $db_plan_period_end, $db_status); 
            $db_user_id = $userID; 
            $db_plan_id = $subscr_plan_id; 
            $db_stripe_subscription_id = $subscription_id; 
            $db_stripe_customer_id = $customer_id; 
            $db_stripe_payment_intent_id = $payment_intent_id; 
            $db_paid_amount = $paidAmount; 
            $db_paid_amount_currency = $paidCurrency; 
            $db_plan_interval = $planInterval; 
            $db_payer_email = $email; 
            $db_created = $created; 
            $db_plan_period_start = $current_period_start; 
            $db_plan_period_end = $current_period_end; 
            $db_status = $payment_status; 
            $insert = $stmt->execute(); 
             
            if($insert){ 
                $payment_id = $stmt->insert_id; 
                 
                // Update subscription ID in user table 
                $sqlQ = "UPDATE user SET subscription_id=? WHERE id=?"; 
                $stmt = $db->prepare($sqlQ); 
                $stmt->bind_param("ii", $db_subscription_id, $db_user_id); 
                $db_subscription_id = $payment_id; 
                $db_user_id = $userID; 
                $update = $stmt->execute(); 
            } 
        } 
         
        $output = [ 
            'payment_id' => base64_encode($payment_id) 
        ]; 
        echo json_encode($output); 
    }else{ 
        echo json_encode(['error' => 'Transaction has been failed!']); 
    } 
}
<?php
  require_once('vendor/autoload.php');
  require_once('config/db.php');
  require_once('lib/pdo_db.php');

  require_once 'init.php' ;
  include 'head.php';
  include 'navigation.php';

  \Stripe\Stripe::setApiKey('sk_test_Yg6Nwj3uSkHf1oYOuc1PPop000ZhnRozgZ');

  //Sanitize POST Array
  $_POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);


  $grand_total = $_POST['grand_total'];
  $email = $_POST['email'];
  $token = $_POST['stripeToken'];

  //Create Customer In Stripe
  $customer = \Stripe\Customer::create(array(
    "email" => $email,
    "source" => $token
  ));

  //Charge Customer
  $charge = \Stripe\Charge::create(array(
    "amount" => round($grand_total).'00',
    "currency" => "PHP",
    "description" => "Crosspoint Paper, Inc.",
    "customer" => $customer->id
  ));

   $session_email = $_POST['email'];
   $select_customer = "SELECT * from customers where email='$session_email'";
   $run_customer = mysqli_query($db,$select_customer);
   $row_customer = mysqli_fetch_array($run_customer);
   $customer_id = $row_customer['id'];


  //Redirect to success
  echo "<script>window.open('order.php?id=$customer_id&true=1','_self')</script>";
 ?>

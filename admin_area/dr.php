<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
?>
<?php

  if(isset($_GET['id'])){
    $txn_id = $_GET['id'];
    $tTranQ = $db->query("SELECT * FROM temp_transactions WHERE transaction_id = '{$txn_id}'");
    $tTranResult = mysqli_fetch_assoc($tTranQ);
    $temp_cart_id = $tTranResult['cart_id'];
    $temp_customer_id = $tTranResult['customer_id'];
    $temp_description = $tTranResult['description'];
    $temp_state = $tTranResult['state'];
    $temp_dr_done = $tTranResult['dr_done'];
    $temp_txn_date = $tTranResult['txn_date'];
  }

  if($temp_cart_id != ''){
    $cartQ = $db->query("SELECT * FROM temp_cart WHERE cart_id = '{$temp_cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $temp_items = $result['items'];
    $items = json_decode($result['items'],true);
    $sub_total = 0;
    $item_count = 0;
  }

  foreach ($items as $item) {
    $product_id = $item['id'];
    $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
    $product = mysqli_fetch_assoc($productQ);

    $sub_total += ($product['price'] * $item['quantity']);
  }
  $tax = TAXRATE * $sub_total;
  $grand_total = $tax + $sub_total;

  $tempTranQ = $db->query("UPDATE transactions SET cart_id='$temp_cart_id',customer_id='$temp_customer_id',sub_total='$sub_total',tax='$tax',grand_total='$grand_total',description='$temp_description',state='$temp_state',dr_done='$temp_dr_done',txn_date='$temp_txn_date' WHERE id = '{$txn_id}'");
  $tempCartQ = $db->query("UPDATE cart SET items='$temp_items' WHERE id = '{$temp_cart_id}'");

  $state = 'Draft';
  $db->query("INSERT INTO delivery_receipt(transaction_id,customer_id,txn_date,state) values('$txn_id','$temp_customer_id',NOW(),'$state')");
  $db->query("UPDATE transactions SET dr_done = 'yes' WHERE id = '$txn_id'");
  $_SESSION['success_flash'] = "The Delivery Receipt Has Been Created!";
  echo "<script>window.open('index.php?view_delivery_receipt','_self')</script>";

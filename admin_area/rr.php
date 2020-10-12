<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
?>
<?php

  if(isset($_GET['id'])){
    $txn_id = $_GET['id'];
    $tTranQ = $db->query("SELECT * FROM purchase_orders WHERE id = '{$txn_id}'");
    $tTranResult = mysqli_fetch_assoc($tTranQ);
    $temp_cart_id = $tTranResult['cart_id'];
    $temp_customer_id = $tTranResult['supplier_id'];
    $temp_description = $tTranResult['description'];
    $temp_state = $tTranResult['state'];
    $temp_dr_done = $tTranResult['dr_done'];
    $temp_txn_date = $tTranResult['txn_date'];
  }

  $state = 'Draft';
  $db->query("INSERT INTO receiving_report(po_id,supplier_id,txn_date,state) values('$txn_id','$temp_customer_id',NOW(),'$state')");
  $_SESSION['success_flash'] = "The Receive Order Has Been Created!";
  echo "<script>window.open('index.php?view_receiving_report','_self')</script>";
?>

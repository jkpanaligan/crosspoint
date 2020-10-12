<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
?>
<?php

  if(isset($_GET['id'])){
    $txn_id = $_GET['id'];
    $tTranQ = $db->query("SELECT * FROM receiving_report WHERE id = '{$txn_id}'");
    $tTranResult = mysqli_fetch_assoc($tTranQ);
    $po_id = $tTranResult['po_id'];
    $temp_customer_id = $tTranResult['supplier_id'];
    $temp_state = $tTranResult['state'];
    $temp_txn_date = $tTranResult['txn_date'];

    $poQ = $db->query("SELECT * FROM purchase_orders WHERE id = '{$po_id}'");
    $poResult = mysqli_fetch_assoc($poQ);
    $amount = $poResult['grand_total'];
  }

  $state = 'Draft';
  $db->query("INSERT INTO accounts_payable (rr_id,supplier_id,amount,txn_date,state) values('$txn_id','$temp_customer_id',$amount,NOW(),'$state')");
  $_SESSION['success_flash'] = "The Accounts Payable Has Been Created!";
  echo "<script>window.open('index.php?view_accounts_payables','_self')</script>";
?>

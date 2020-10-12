<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
  $customer_id = sanitize($_GET['customer_id']);
  $txn_id = sanitize($_GET['edit_order']);

  $db->query("UPDATE temp_transactions SET customer_id = '{$customer_id}' WHERE transaction_id = '{$txn_id}'");

  echo "<script>window.open('index.php?edit_order=$txn_id','_self')</script>";

 ?>

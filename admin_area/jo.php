<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';

  $txn_id = $_GET['id'];
  $remark = $_GET['remark'];
  $state = 'Draft';
  $db->query("INSERT INTO job_orders (do_id,cart_id,txn_date,state) values('$txn_id','$cart_id',NOW(),'$state')");

  $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')? '.'.$_SERVER['HTTP_HOST']:false;
  setcookie(CART_COOKIE,'',1,"/",$domain,false);
  $_SESSION['success_flash'] = "The Job Order Has Been Created!";
  echo "<script>window.open('index.php?view_job_order','_self')</script>";

?>

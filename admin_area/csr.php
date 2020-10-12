<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
?>
<?php

  if(isset($_GET['csr'])){
    $jo_id = $_GET['csr'];
    $tTranQ = $db->query("SELECT * FROM job_orders WHERE id = '{$jo_id}'");
    $tTranResult = mysqli_fetch_assoc($tTranQ);
    $cart_id1 = $tTranResult['cart_id'];

    if(isset($_GET['email'])){
      $email = $_GET['email'];

      $get_admin = "SELECT * from users where email='$email'";
      $run_admin = mysqli_query($db,$get_admin);
      $row_admin = mysqli_fetch_array($run_admin);
      $id = $row_admin['id'];
    }
  }

  $state = 'Draft';
  $db->query("INSERT INTO cuttingsheeting_report (date1,jo_id,in_items,out_items,state,made_by) values(NOW(),'$jo_id',$cart_id1,'$cart_id','$state','$id')");

  $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')? '.'.$_SERVER['HTTP_HOST']:false;
  setcookie(CART_COOKIE,'',1,"/",$domain,false);
  $_SESSION['success_flash'] = "The Cutting/Sheeting Report Has Been Created!";
  echo "<script>window.open('index.php?view_CrSr','_self')</script>";
?>

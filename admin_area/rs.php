<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';

    $si_id = $_GET['id'];
    $customer_id = $_GET['customer_id'];
    $state = 'Draft';
    $db->query("INSERT INTO return_slip (si_id,customer_id,txn_date,state) values('$si_id','$customer_id',NOW(),'$state')");
    $_SESSION['success_flash'] = "The Return Slip Has Been Created!";
    echo "<script>window.open('index.php?view_return_slip','_self')</script>";

?>

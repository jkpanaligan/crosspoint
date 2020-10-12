<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
?>
<?php

    $state = 'Draft';
    $supplier_id = sanitize($_GET['supplier_id']);
    $payment = sanitize($_GET['pay']);

    if(empty($cheque_id))
    {
      $id = 0;
      $item = array();
      $item[] = array(
        'id'        => $id,
      );
      $items_json = json_encode($item);
      $db->query("INSERT INTO cheque_details (cheque_items) values ('$items_json') ");
      $cheque_id = $db->insert_id;
    }


    $db->query("INSERT INTO check_vouchers (supplier_id,ap_id,cheque_detail_id,cash_payment,state,txn_date) VALUES ('$supplier_id','$invoice_id','$cheque_id','$payment','$state',NOW())");

    $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')? '.'.$_SERVER['HTTP_HOST']:false;
    setcookie(INVOICE_COOKIE,'',1,"/",$domain,false);
    setcookie(CHEQUE_COOKIE,'',1,"/",$domain,false);

    echo "<script>alert('Check Voucher has been created.')</script>";
    echo "<script>window.open('index.php?view_check_voucher','_self')</script>";
?>

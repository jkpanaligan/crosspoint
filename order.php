<?php
require_once 'init.php';
?>
<?php

  if(isset($_GET['id'])){

      $customer_id = $_GET['id'];

  }

  if($cart_id != ''){
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'],true);
    $grand_total = 0;
    $item_count = 0;
    $state = 'Draft';
  }
  foreach ($items as $item) {
    $product_id = $item['id'];
    $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
    $product = mysqli_fetch_assoc($productQ);

    $grand_total += ($product['price'] * $item['quantity']);
  }
  $tax = TAXRATE * $grand_total;
  $sub_total = $grand_total - $tax;
  $dr_done = 'no';
  $status = 'Processing';

  $ip_add = getRealIpUser();

  $db->query("INSERT INTO transactions
    (cart_id,customer_id,sub_total,tax,grand_total,txn_date,state,dr_done,status) VALUES
    ('$cart_id','$customer_id','$sub_total','$tax','$grand_total',NOW(),'$state','$dr_done','$status')");
  $tran_id = $db->insert_id;

  $txnQuery = $db->query("SELECT * FROM transactions WHERE id = '{$tran_id}'");
  $txn = mysqli_fetch_assoc($txnQuery);

  // $cart_id = $txn['cart_id'];
  // $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
  // $cart = mysqli_fetch_assoc($cartQ);
  // $items = json_decode($cart['items'],true);
  //
  // foreach ($items as $item) {
  //   $total = 0;
  //   $product_id = $item['id'];
  //   $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
  //   $product = mysqli_fetch_assoc($productQ);
  //
  //   $quantity = $product['current_quantity'];
  //   $total = $quantity - $item['quantity'];
  //
  //   $db->query("UPDATE products SET current_quantity = '$total' where id = '$product_id'");
  // }


  if(isset($_GET['true']) == 1){

    $db->query("INSERT INTO stripe_payments
        (customer_id,si_id,amount,txn_date) VALUES
        ('$customer_id','$tran_id','$grand_total',NOW())");

  }



  $delete_cart = "DELETE from p_cart where ip_add='$ip_add'";
  $run_delete = mysqli_query($db,$delete_cart);

  $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')? '.'.$_SERVER['HTTP_HOST']:false;
  setcookie(CART_COOKIE,'',1,"/",$domain,false);

  echo "<script>alert('Your order will be deliver in 2-3 days, Thanks')</script>";
  echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";

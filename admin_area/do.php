<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
?>
<?php

if(isset($_GET['id'])){

    $customer_id = $_GET['id'];

}

  if($cart_id != ''){
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'],true);
    $sub_total = 0;
    $item_count = 0;
    $state = 'Draft';
  }
  foreach ($items as $item) {
    $product_id = $item['id'];
    $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
    $product = mysqli_fetch_assoc($productQ);

    $sub_total += ($product['price'] * $item['quantity']);
  }
  $tax = TAXRATE * $sub_total;
  $grand_total = $tax + $sub_total;
  $dr_done = 'no';

  $ip_add = getRealIpUser();

  $db->query("INSERT INTO transactions
    (cart_id,customer_id,sub_total,tax,grand_total,txn_date,state,dr_done) VALUES
    ('$cart_id','$customer_id','$sub_total','$tax','$grand_total',NOW(),'$state','$dr_done')");

  $delete_cart = "DELETE from p_cart where ip_add='$ip_add'";
  $run_delete = mysqli_query($db,$delete_cart);

  $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')? '.'.$_SERVER['HTTP_HOST']:false;
  setcookie(CART_COOKIE,'',1,"/",$domain,false);

  echo "<script>alert('Delivery Order has been submitted.')</script>";
  echo "<script>window.open('index.php?view_orders','_self')</script>";

<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
  $mode = sanitize($_POST['mode']);
  $edit_id = sanitize($_POST['edit_id']);
  $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
  $result = mysqli_fetch_assoc($cartQ);
  $items = json_decode($result['items'],true);
  $updated_items = array();
  $domain = (($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false);
  $ip_add = getRealIpUser();

  if($mode == 'removeone'){
    foreach($items as $item){
      if($item['id'] == $edit_id){
        $item['quantity'] = $item['quantity'] - 1;

        $edit_id = $item['id'];
        $total = 0;
        $productQ = $db->query("SELECT * FROM products WHERE id = '{$edit_id}'");
        $product = mysqli_fetch_assoc($productQ);

        $quantity1 = $product['current_quantity'];
        $total = $quantity1 + 1;

        $db->query("UPDATE products SET current_quantity = '$total' where id = '$edit_id'");
      }
      if($item['quantity'] > 0){
        $updated_items[] = $item;
      }
    }
  }

  if($mode == 'addone'){
    foreach($items as $item){
      if($item['id'] == $edit_id){
        $item['quantity'] = $item['quantity'] + 1;

        $edit_id = $item['id'];
        $total = 0;
        $productQ = $db->query("SELECT * FROM products WHERE id = '{$edit_id}'");
        $product = mysqli_fetch_assoc($productQ);

        $quantity1 = $product['current_quantity'];
        $total = $quantity1 - 1;

        $db->query("UPDATE products SET current_quantity = '$total' where id = '$edit_id'");
      }
      $updated_items[] = $item;
    }
  }

  if($mode == 'delete'){
    foreach($items as $item){
      if($item['id'] == $edit_id){


        $edit_id = $item['id'];
        $total = 0;
        $productQ = $db->query("SELECT * FROM products WHERE id = '{$edit_id}'");
        $product = mysqli_fetch_assoc($productQ);

        $quantity1 = $product['current_quantity'];
        $total = $quantity1 + $item['quantity'];

        $db->query("UPDATE products SET current_quantity = '$total' where id = '$edit_id'");

        $item['quantity'] = 0;
      }
      if($item['quantity'] > 0){
        $updated_items[] = $item;
      }
    }
  }

  if(!empty($updated_items)){
    $json_updated = json_encode($updated_items);
    $db->query("UPDATE cart SET items = '{$json_updated}' WHERE id = '{$cart_id}'");
    $_SESSION['success_flash'] = 'Your shopping cart has been updated!';
  }

  if(empty($updated_items)){
    $db->query("DELETE FROM cart WHERE id ='{$cart_id}'");
    $db->query("DELETE FROM p_cart WHERE ip_add ='{$ip_add}'");
    setcookie(CART_COOKIE,'',1,"/",$domain,false);
  }
?>

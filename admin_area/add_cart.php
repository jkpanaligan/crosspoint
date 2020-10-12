<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
  $id = sanitize($_POST['id']);
  $mode = sanitize($_POST['mode']);
  $txn_id = sanitize($_POST['txn_id']);

?>

<?php if($mode == 'new'): ?>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
    $product_id = sanitize($_POST['product_id']);
    $quantity = sanitize($_POST['quantity']);
    $item = array();
    $item[] = array(
      'id'        => $product_id,
      'quantity'  => $quantity,
    );

    $ip_add = getRealIpUser();
    $p_id = sanitize($_POST['product_id']);
    $quantity = sanitize($_POST['quantity']);
    $check_product = "SELECT * from p_cart where ip_add='$ip_add' AND p_id='$p_id'";
    $run_check = mysqli_query($db,$check_product);

    $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
    $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
    $product = mysqli_fetch_assoc($query);
    $_SESSION['success_flash'] = $product['title']. ' was added.';

    //check to see if the cart cookie exists
    if($cart_id != ''){
      $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
      $cart = mysqli_fetch_assoc($cartQ);
      $previous_items = json_decode($cart['items'],true);
      $item_match = 0;
      $new_items = array();
      foreach($previous_items as $pitem){
        if($item[0]['id'] == $pitem['id']){
          $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
            $item_match = 1;
        }
        $new_items[] = $pitem;
      }
      if($item_match != 1){
        $new_items = array_merge($item,$previous_items);
      }
      $items_json = json_encode($new_items);
      $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
      $db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE id = '{$cart_id}'");
      setcookie(CART_COOKIE,'',1,"/",$domain,false);
      setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);

    }else if(mysqli_num_rows($run_check)>0){

      echo "<script>alert('This product has already added in cart')</script>";
      echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

    }else{
      //add the cart to the database and set cookie
      $query = "INSERT into p_cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$quantity')";
      $run_query = mysqli_query($db,$query);

      $items_json = json_encode($item);
      $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
      $db->query("INSERT INTO cart (items,expire_date) VALUES ('{$items_json}','{$cart_expire}')");
      $cart_id = $db->insert_id;
      setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
  }
?>
<?php elseif($mode == 'new_jo'): ?>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
    $product_id = sanitize($_POST['product_id']);
    $quantity = sanitize($_POST['quantity']);
    $item = array();
    $item[] = array(
      'id'        => $product_id,
      'quantity'  => $quantity,
    );

    $ip_add = getRealIpUser();
    $p_id = sanitize($_POST['product_id']);
    $quantity = sanitize($_POST['quantity']);
    $check_product = "SELECT * from p_cart where ip_add='$ip_add' AND p_id='$p_id'";
    $run_check = mysqli_query($db,$check_product);

    $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
    $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
    $product = mysqli_fetch_assoc($query);
    $_SESSION['success_flash'] = $product['title']. ' was added.';

    //check to see if the cart cookie exists
    if($cart_id != ''){
      $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
      $cart = mysqli_fetch_assoc($cartQ);
      $previous_items = json_decode($cart['items'],true);
      $item_match = 0;
      $new_items = array();
      foreach($previous_items as $pitem){
        if($item[0]['id'] == $pitem['id']){
          $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
            $item_match = 1;
        }
        $new_items[] = $pitem;
      }
      if($item_match != 1){
        $new_items = array_merge($item,$previous_items);
      }
      $items_json = json_encode($new_items);
      $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
      $db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE id = '{$cart_id}'");
      setcookie(CART_COOKIE,'',1,"/",$domain,false);
      setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);

    }else if(mysqli_num_rows($run_check)>0){

      echo "<script>alert('This product has already added in cart')</script>";
      echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

    }else{
      //add the cart to the database and set cookie
      $query = "INSERT into p_cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$quantity')";
      $run_query = mysqli_query($db,$query);

      $items_json = json_encode($item);
      $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
      $db->query("INSERT INTO cart (items,expire_date) VALUES ('{$items_json}','{$cart_expire}')");
      $cart_id = $db->insert_id;
      setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
  }
?>
<?php elseif($mode == 'new_po'): ?>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
    $product_id = sanitize($_POST['product_id']);
    $quantity = sanitize($_POST['quantity']);
    $item = array();
    $item[] = array(
      'id'        => $product_id,
      'quantity'  => $quantity,
    );

    $ip_add = getRealIpUser();
    $p_id = sanitize($_POST['product_id']);
    $quantity = sanitize($_POST['quantity']);
    $check_product = "SELECT * from p_cart where ip_add='$ip_add' AND p_id='$p_id'";
    $run_check = mysqli_query($db,$check_product);

    $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
    $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
    $product = mysqli_fetch_assoc($query);
    $_SESSION['success_flash'] = $product['title']. ' was added.';

    //check to see if the cart cookie exists
    if($cart_id != ''){
      $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
      $cart = mysqli_fetch_assoc($cartQ);
      $previous_items = json_decode($cart['items'],true);
      $item_match = 0;
      $new_items = array();
      foreach($previous_items as $pitem){
        if($item[0]['id'] == $pitem['id']){
          $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
            $item_match = 1;
        }
        $new_items[] = $pitem;
      }
      if($item_match != 1){
        $new_items = array_merge($item,$previous_items);
      }
      $items_json = json_encode($new_items);
      $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
      $db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE id = '{$cart_id}'");
      setcookie(CART_COOKIE,'',1,"/",$domain,false);
      setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);

    }else if(mysqli_num_rows($run_check)>0){

      echo "<script>alert('This product has already added in cart')</script>";
      echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

    }else{
      //add the cart to the database and set cookie
      $query = "INSERT into p_cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$quantity')";
      $run_query = mysqli_query($db,$query);

      $items_json = json_encode($item);
      $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
      $db->query("INSERT INTO cart (items,expire_date) VALUES ('{$items_json}','{$cart_expire}')");
      $cart_id = $db->insert_id;
      setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
  }
?>
<?php elseif($mode == 'edit'): ?>
  <?php

      require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
      $txn_id = sanitize($_POST['txn_id']);
      $txnQ = $db->query("SELECT * FROM temp_transactions WHERE transaction_id = '{$txn_id}'");
      $txn = mysqli_fetch_assoc($txnQ);
      $cart_id1 = $txn['cart_id'];
      $product_id = sanitize($_POST['product_id']);
      $quantity = sanitize($_POST['quantity']);
      $item = array();
      $item[] = array(
        'id'        => $product_id,
        'quantity'  => $quantity,
      );

      $ip_add = getRealIpUser();
      $p_id = sanitize($_POST['product_id']);
      $quantity = sanitize($_POST['quantity']);
      $check_product = "SELECT * from p_cart where ip_add='$ip_add' AND p_id='$p_id'";
      $run_check = mysqli_query($db,$check_product);

      $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
      $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
      $product = mysqli_fetch_assoc($query);
      $_SESSION['success_flash'] = $product['title']. ' was added.';

      //check to see if the cart cookie exists

        $cartQ = $db->query("SELECT * FROM temp_cart WHERE cart_id = '{$cart_id1}'");
        $cart = mysqli_fetch_assoc($cartQ);

        if($cart != ''){
        $previous_items = json_decode($cart['items'],true);
        $item_match = 0;
        $new_items = array();
        foreach($previous_items as $pitem){
          if($item[0]['id'] == $pitem['id']){
            $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
              $item_match = 1;
          }
          $new_items[] = $pitem;
        }
        if($item_match != 1){
          $new_items = array_merge($item,$previous_items);
        }
        $items_json = json_encode($new_items);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $db->query("UPDATE temp_cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE cart_id = '{$cart_id1}'");

      }else if(mysqli_num_rows($run_check)>0){

        echo "<script>alert('This product has already added in cart')</script>";
        echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

      }else{
        //add the cart to the database and set cookie
        $query = "INSERT into p_cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$quantity')";
        $run_query = mysqli_query($db,$query);

        $items_json = json_encode($item);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $db->query("INSERT INTO temp_cart (cart_id,items,expire_date) VALUES ('{$cart_id1}','{$items_json}','{$cart_expire}')");
    }

  ?>
<?php elseif($mode == 'edit_jo'): ?>
    <?php

        require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
        $txn_id = sanitize($_POST['txn_id']);
        $txnQ = $db->query("SELECT * FROM temp_jo WHERE jo_id = '{$txn_id}'");
        $txn = mysqli_fetch_assoc($txnQ);
        $cart_id1 = $txn['cart_id'];
        $product_id = sanitize($_POST['product_id']);
        $quantity = sanitize($_POST['quantity']);
        $item = array();
        $item[] = array(
          'id'        => $product_id,
          'quantity'  => $quantity,
        );

        $ip_add = getRealIpUser();
        $p_id = sanitize($_POST['product_id']);
        $quantity = sanitize($_POST['quantity']);
        $check_product = "SELECT * from p_cart where ip_add='$ip_add' AND p_id='$p_id'";
        $run_check = mysqli_query($db,$check_product);

        $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
        $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
        $product = mysqli_fetch_assoc($query);
        $_SESSION['success_flash'] = $product['title']. ' was added.';

        //check to see if the cart cookie exists

          $cartQ = $db->query("SELECT * FROM temp_cart WHERE cart_id = '{$cart_id1}'");
          $cart = mysqli_fetch_assoc($cartQ);

          if($cart != ''){
          $previous_items = json_decode($cart['items'],true);
          $item_match = 0;
          $new_items = array();
          foreach($previous_items as $pitem){
            if($item[0]['id'] == $pitem['id']){
              $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
                $item_match = 1;
            }
            $new_items[] = $pitem;
          }
          if($item_match != 1){
            $new_items = array_merge($item,$previous_items);
          }
          $items_json = json_encode($new_items);
          $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
          $db->query("UPDATE temp_cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE cart_id = '{$cart_id1}'");

        }else if(mysqli_num_rows($run_check)>0){

          echo "<script>alert('This product has already added in cart')</script>";
          echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

        }else{
          //add the cart to the database and set cookie
          $query = "INSERT into p_cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$quantity')";
          $run_query = mysqli_query($db,$query);

          $items_json = json_encode($item);
          $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
          $db->query("INSERT INTO temp_cart (cart_id,items,expire_date) VALUES ('{$cart_id1}','{$items_json}','{$cart_expire}')");
      }

    ?>
<?php elseif($mode == 'edit_po'): ?>
  <?php

      require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
      $txn_id = sanitize($_POST['txn_id']);
      $txnQ = $db->query("SELECT * FROM temp_transactions WHERE transaction_id = '{$txn_id}'");
      $txn = mysqli_fetch_assoc($txnQ);
      $cart_id1 = $txn['cart_id'];
      $product_id = sanitize($_POST['product_id']);
      $quantity = sanitize($_POST['quantity']);
      $item = array();
      $item[] = array(
        'id'        => $product_id,
        'quantity'  => $quantity,
      );

      $ip_add = getRealIpUser();
      $p_id = sanitize($_POST['product_id']);
      $quantity = sanitize($_POST['quantity']);
      $check_product = "SELECT * from p_cart where ip_add='$ip_add' AND p_id='$p_id'";
      $run_check = mysqli_query($db,$check_product);

      $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
      $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
      $product = mysqli_fetch_assoc($query);
      $_SESSION['success_flash'] = $product['title']. ' was added.';

      //check to see if the cart cookie exists

        $cartQ = $db->query("SELECT * FROM temp_cart WHERE cart_id = '{$cart_id1}'");
        $cart = mysqli_fetch_assoc($cartQ);

        if($cart != ''){
        $previous_items = json_decode($cart['items'],true);
        $item_match = 0;
        $new_items = array();
        foreach($previous_items as $pitem){
          if($item[0]['id'] == $pitem['id']){
            $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
              $item_match = 1;
          }
          $new_items[] = $pitem;
        }
        if($item_match != 1){
          $new_items = array_merge($item,$previous_items);
        }
        $items_json = json_encode($new_items);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $db->query("UPDATE temp_cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE cart_id = '{$cart_id1}'");

      }else if(mysqli_num_rows($run_check)>0){

        echo "<script>alert('This product has already added in cart')</script>";
        echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

      }else{
        //add the cart to the database and set cookie
        $query = "INSERT into p_cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$quantity')";
        $run_query = mysqli_query($db,$query);

        $items_json = json_encode($item);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $db->query("INSERT INTO temp_cart (cart_id,items,expire_date) VALUES ('{$cart_id1}','{$items_json}','{$cart_expire}')");
    }

  ?>
<?php elseif($mode == 'edit_dr'): ?>
  <?php

      require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
      $dr_id = sanitize($_POST['txn_id']);

      $drQ = $db->query("SELECT * FROM temp_dr WHERE dr_id = '{$dr_id}'");
      $dr = mysqli_fetch_assoc($drQ);
      $txn_id = $dr['transaction_id'];

      $txnQ = $db->query("SELECT * FROM temp_transactions WHERE transaction_id = '{$txn_id}'");
      $txn = mysqli_fetch_assoc($txnQ);
      $cart_id1 = $txn['cart_id'];
      $product_id = sanitize($_POST['product_id']);
      $quantity = sanitize($_POST['quantity']);
      $item = array();
      $item[] = array(
        'id'        => $product_id,
        'quantity'  => $quantity,
      );

      $ip_add = getRealIpUser();
      $p_id = sanitize($_POST['product_id']);
      $quantity = sanitize($_POST['quantity']);
      $check_product = "SELECT * from p_cart where ip_add='$ip_add' AND p_id='$p_id'";
      $run_check = mysqli_query($db,$check_product);

      $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
      $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
      $product = mysqli_fetch_assoc($query);
      $_SESSION['success_flash'] = $product['title']. ' was added.';

      //check to see if the cart cookie exists

        $cartQ = $db->query("SELECT * FROM temp_cart WHERE cart_id = '{$cart_id1}'");
        $cart = mysqli_fetch_assoc($cartQ);

        if($cart != ''){
        $previous_items = json_decode($cart['items'],true);
        $item_match = 0;
        $new_items = array();
        foreach($previous_items as $pitem){
          if($item[0]['id'] == $pitem['id']){
            $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
              $item_match = 1;
          }
          $new_items[] = $pitem;
        }
        if($item_match != 1){
          $new_items = array_merge($item,$previous_items);
        }
        $items_json = json_encode($new_items);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $db->query("UPDATE temp_cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE cart_id = '{$cart_id1}'");

      }else if(mysqli_num_rows($run_check)>0){

        echo "<script>alert('This product has already added in cart')</script>";
        echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

      }else{
        //add the cart to the database and set cookie
        $query = "INSERT into p_cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$quantity')";
        $run_query = mysqli_query($db,$query);

        $items_json = json_encode($item);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $db->query("INSERT INTO temp_cart (cart_id,items,expire_date) VALUES ('{$cart_id1}','{$items_json}','{$cart_expire}')");
    }

  ?>
<?php elseif($mode == 'edit_rr'): ?>
  <?php

      require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
      $dr_id = sanitize($_POST['txn_id']);

      $drQ = $db->query("SELECT * FROM temp_dr WHERE dr_id = '{$dr_id}'");
      $dr = mysqli_fetch_assoc($drQ);
      $txn_id = $dr['transaction_id'];

      $txnQ = $db->query("SELECT * FROM temp_transactions WHERE transaction_id = '{$txn_id}'");
      $txn = mysqli_fetch_assoc($txnQ);
      $cart_id1 = $txn['cart_id'];
      $product_id = sanitize($_POST['product_id']);
      $quantity = sanitize($_POST['quantity']);
      $item = array();
      $item[] = array(
        'id'        => $product_id,
        'quantity'  => $quantity,
      );

      $ip_add = getRealIpUser();
      $p_id = sanitize($_POST['product_id']);
      $quantity = sanitize($_POST['quantity']);
      $check_product = "SELECT * from p_cart where ip_add='$ip_add' AND p_id='$p_id'";
      $run_check = mysqli_query($db,$check_product);

      $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
      $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
      $product = mysqli_fetch_assoc($query);
      $_SESSION['success_flash'] = $product['title']. ' was added.';

      //check to see if the cart cookie exists

        $cartQ = $db->query("SELECT * FROM temp_cart WHERE cart_id = '{$cart_id1}'");
        $cart = mysqli_fetch_assoc($cartQ);

        if($cart != ''){
        $previous_items = json_decode($cart['items'],true);
        $item_match = 0;
        $new_items = array();
        foreach($previous_items as $pitem){
          if($item[0]['id'] == $pitem['id']){
            $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
              $item_match = 1;
          }
          $new_items[] = $pitem;
        }
        if($item_match != 1){
          $new_items = array_merge($item,$previous_items);
        }
        $items_json = json_encode($new_items);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $db->query("UPDATE temp_cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE cart_id = '{$cart_id1}'");

      }else if(mysqli_num_rows($run_check)>0){

        echo "<script>alert('This product has already added in cart')</script>";
        echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

      }else{
        //add the cart to the database and set cookie
        $query = "INSERT into p_cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$quantity')";
        $run_query = mysqli_query($db,$query);

        $items_json = json_encode($item);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $db->query("INSERT INTO temp_cart (cart_id,items,expire_date) VALUES ('{$cart_id1}','{$items_json}','{$cart_expire}')");
    }

  ?>
<?php endif; ?>

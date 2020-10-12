<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';

    $id = $_GET['id'];
    $customer_id = $_GET['customer_id'];
    $edit = $_GET['mode'];
    $cr_id = $_GET['cr_id'];

    if($_GET['mode'] == 'new'){

      $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
      $item = array();
      $item[] = array(
        'id'        => $id,
      );

      if($cheque_id != ''){
        $cartQ = $db->query("SELECT * FROM cheque_details WHERE id = '{$cheque_id}'");
        $cart = mysqli_fetch_assoc($cartQ);
        $previous_items = json_decode($cart['cheque_items'],true);
        $item_match = 0;
        $new_items = array();
        foreach($previous_items as $pitem){
          if($item[0]['id'] == $pitem['id']){
              echo "<script>alert('This cheque has already added')</script>";
              $item_match = 1;
          }
          $new_items[] = $pitem;
        }
        if($item_match != 1){
          $new_items = array_merge($item,$previous_items);
        }
        $items_json = json_encode($new_items);
        $db->query("UPDATE cheque_details SET cheque_items = '{$items_json}' WHERE id = '{$cheque_id}'");
        setcookie(CHEQUE_COOKIE,'',1,"/",$domain,false);
        setcookie(CHEQUE_COOKIE,$cheque_id,CART_COOKIE_EXPIRE,'/',$domain,false);
        echo "<script>window.open('index.php?new_cr=$customer_id','_self')</script>";

      }else{
        $items_json = json_encode($item);
        $tempTranQ = $db->query("INSERT INTO cheque_details (cheque_items) VALUES ('{$items_json}')");
        $cheque_id = $db->insert_id;
        setcookie(CHEQUE_COOKIE,$cheque_id,CART_COOKIE_EXPIRE,'/',$domain,false);

        echo "<script>window.open('index.php?new_cr=$customer_id','_self')</script>";
      }
    }

    if($_GET['mode'] == 'new_cv'){

      $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
      $item = array();
      $item[] = array(
        'id'        => $id,
      );

      if($cheque_id != ''){
        $cartQ = $db->query("SELECT * FROM cheque_details WHERE id = '{$cheque_id}'");
        $cart = mysqli_fetch_assoc($cartQ);
        $previous_items = json_decode($cart['cheque_items'],true);
        $item_match = 0;
        $new_items = array();
        foreach($previous_items as $pitem){
          if($item[0]['id'] == $pitem['id']){
              echo "<script>alert('This cheque has already added')</script>";
              $item_match = 1;
          }
          $new_items[] = $pitem;
        }
        if($item_match != 1){
          $new_items = array_merge($item,$previous_items);
        }
        $items_json = json_encode($new_items);
        $db->query("UPDATE cheque_details SET cheque_items = '{$items_json}' WHERE id = '{$cheque_id}'");
        setcookie(CHEQUE_COOKIE,'',1,"/",$domain,false);
        setcookie(CHEQUE_COOKIE,$cheque_id,CART_COOKIE_EXPIRE,'/',$domain,false);
        echo "<script>window.open('index.php?new_cv=$customer_id','_self')</script>";

      }else{
        $items_json = json_encode($item);
        $tempTranQ = $db->query("INSERT INTO cheque_details (cheque_items) VALUES ('{$items_json}')");
        $cheque_id = $db->insert_id;
        setcookie(CHEQUE_COOKIE,$cheque_id,CART_COOKIE_EXPIRE,'/',$domain,false);

        echo "<script>window.open('index.php?new_cv=$customer_id','_self')</script>";
      }
    }

    if($_GET['mode'] == 'edit'){
      $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
      $item = array();
      $item[] = array(
        'id'        => $id,
      );

      $tempCr = $db->query("SELECT * FROM temp_cr WHERE cr_id = '{$cr_id}'");
      $temp_Si = mysqli_fetch_assoc($tempCr);
      $cheque_detail_id = $temp_Si['cheque_detail_id'];

      if($cheque_detail_id != 0){

        $cartQ = $db->query("SELECT * FROM temp_cheque_detail WHERE cheque_detail_id = '{$cheque_detail_id}'");
        $cart = mysqli_fetch_assoc($cartQ);
        $previous_items = json_decode($cart['cheque_items'],true);
        $item_match = 0;
        $new_items = array();
        foreach($previous_items as $pitem){
          if($item[0]['id'] == $pitem['id']){
              echo "<script>alert('This cheque has already added')</script>";
              $item_match = 1;
          }
          $new_items[] = $pitem;
        }
        if($item_match != 1){
          $new_items = array_merge($item,$previous_items);
        }
        $items_json = json_encode($new_items);
        $db->query("UPDATE temp_cheque_detail SET cheque_items = '{$items_json}' WHERE cheque_detail_id = '{$cheque_detail_id}'");
        echo "<script>window.open('index.php?edit_cr=$cr_id','_self')</script>";

      }else{
        $items_json = json_encode($item);
        $tempTranQ = $db->query("INSERT INTO temp_cheque_detail (cheque_items) VALUES ('{$items_json}')");
        $cheque_detail_id = $db->insert_id;

        echo "<script>window.open('index.php?edit_cr=$cr_id','_self')</script>";
      }
    }

    if($_GET['mode'] == 'edit_cv'){
      $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
      $item = array();
      $item[] = array(
        'id'        => $id,
      );

      $tempCr = $db->query("SELECT * FROM temp_cr WHERE cr_id = '{$cr_id}'");
      $temp_Si = mysqli_fetch_assoc($tempCr);
      $cheque_detail_id = $temp_Si['cheque_detail_id'];

      if($cheque_detail_id != 0){

        $cartQ = $db->query("SELECT * FROM temp_cheque_detail WHERE cheque_detail_id = '{$cheque_detail_id}'");
        $cart = mysqli_fetch_assoc($cartQ);
        $previous_items = json_decode($cart['cheque_items'],true);
        $item_match = 0;
        $new_items = array();
        foreach($previous_items as $pitem){
          if($item[0]['id'] == $pitem['id']){
              echo "<script>alert('This cheque has already added')</script>";
              $item_match = 1;
          }
          $new_items[] = $pitem;
        }
        if($item_match != 1){
          $new_items = array_merge($item,$previous_items);
        }
        $items_json = json_encode($new_items);
        $db->query("UPDATE temp_cheque_detail SET cheque_items = '{$items_json}' WHERE cheque_detail_id = '{$cheque_detail_id}'");
        echo "<script>window.open('index.php?edit_cv=$cr_id','_self')</script>";

      }else{
        $items_json = json_encode($item);
        $tempTranQ = $db->query("INSERT INTO temp_cheque_detail (cheque_items) VALUES ('{$items_json}')");
        $cheque_detail_id = $db->insert_id;

        echo "<script>window.open('index.php?edit_cv=$cr_id','_self')</script>";
      }
    }


?>

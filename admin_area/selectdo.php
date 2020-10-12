    <?php

      require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
      $id = sanitize($_POST['id']);
      $mode = sanitize($_POST['mode']);
      $dr_id = sanitize($_POST['dr_id']);

    ?>
    <?php if($mode == 'new'): ?>
      <?php
        echo "<script>window.open('index.php?new_dr2=$id','_self')</script>";
      ?>
    <?php elseif($mode == 'new_csr'): ?>
      <?php
        echo "<script>window.open('index.php?new_csr=$id','_self')</script>";
      ?>
    <?php elseif($mode == 'new_jo'): ?>
      <?php
      $apQ = $db->query("SELECT * FROM transactions WHERE id = '{$id}'");
      $ap = mysqli_fetch_assoc($apQ);
      $tcart_id = $ap['cart_id'];
      $bQ = $db->query("SELECT * FROM cart WHERE id = '{$tcart_id}'");
      $b = mysqli_fetch_assoc($bQ);
      $items = $b['items'];
      $cQ = $db->query("INSERT INTO cart (items) values ('$items')");
      $cart_id = $db->insert_id;
      setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);

        echo "<script>window.open('index.php?new_jo=$id','_self')</script>";
      ?>
    <?php elseif($mode == 'new_rr'): ?>
      <?php
        echo "<script>window.open('index.php?new_rr=$id','_self')</script>";
      ?>
    <?php elseif($mode == 'new_cv'): ?>
      <?php

      $apQ = $db->query("SELECT * FROM accounts_payable WHERE id = '{$id}'");
      $ap = mysqli_fetch_assoc($apQ);
      $invoice_id = $ap['id'];
      setcookie(INVOICE_COOKIE,$invoice_id,CART_COOKIE_EXPIRE,'/',$domain,false);

        echo "<script>window.open('index.php?new_cv=$dr_id','_self')</script>";
      ?>
    <?php elseif($mode == 'new_ap'): ?>
      <?php
        echo "<script>window.open('index.php?new_ap=$id','_self')</script>";
      ?>
    <?php elseif($mode == 'edit_ap'): ?>
      <?php

        $db->query("UPDATE temp_dr SET transaction_id = '{$id}' WHERE dr_id = '{$dr_id}'");

        echo "<script>window.open('index.php?edit_ap=$dr_id','_self')</script>";
      ?>
    <?php elseif($mode == 'edit_csr'): ?>
      <?php

        $db->query("UPDATE temp_csr SET jo_id = '{$id}' WHERE csr_id = '{$dr_id}'");

        $tTranQ = $db->query("SELECT * FROM job_orders WHERE id = '{$id}'");
        $tTranResult = mysqli_fetch_assoc($tTranQ);
        $cart_id1 = $tTranResult['cart_id'];

        $db->query("UPDATE temp_csr SET in_items = '{$cart_id1}' WHERE csr_id = '{$dr_id}'");

        echo "<script>window.open('index.php?edit_csr=$dr_id','_self')</script>";
      ?>
    <?php elseif($mode == 'edit_rs'): ?>
      <?php

        $db->query("UPDATE temp_rs SET si_id = '{$id}' WHERE rs_id = '{$dr_id}'");

        echo "<script>window.open('index.php?edit_rs=$dr_id','_self')</script>";
      ?>
    <?php elseif($mode == 'new_rs'): ?>
      <?php
        echo "<script>window.open('index.php?new_rs=$id','_self')</script>";
      ?>
    <?php elseif($mode == 'new_si'): ?>
        <?php
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
        $item = array();
        $item[] = array(
          'id'        => $id,
        );


          if($cart_id != ''){
            $cartQ = $db->query("SELECT * FROM dr_details WHERE id = '{$cart_id}'");
            $cart = mysqli_fetch_assoc($cartQ);
            $previous_items = json_decode($cart['dr_items'],true);
            $item_match = 0;
            $new_items = array();
            foreach($previous_items as $pitem){
              if($item[0]['id'] == $pitem['id']){
                  echo "<script>alert('This dr has already added')</script>";
                  $item_match = 1;
              }
              $new_items[] = $pitem;
            }
            if($item_match != 1){
              $new_items = array_merge($item,$previous_items);
            }
            $items_json = json_encode($new_items);
            $db->query("UPDATE dr_details SET dr_items = '{$items_json}' WHERE id = '{$cart_id}'");
            setcookie(CART_COOKIE,'',1,"/",$domain,false);
            setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
            echo "<script>window.open('index.php?new_si=$dr_id','_self')</script>";

          }else{
            $items_json = json_encode($item);
            $tempTranQ = $db->query("INSERT INTO dr_details (dr_items) VALUES ('{$items_json}')");
            $cart_id = $db->insert_id;
            setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);

            echo "<script>window.open('index.php?new_si=$dr_id','_self')</script>";
          }
        ?>
      <?php elseif($mode == 'new_cr'): ?>
          <?php
          $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
          $item = array();
          $item[] = array(
            'id'        => $id,
          );


            if($invoice_id != ''){
              $cartQ = $db->query("SELECT * FROM si_details WHERE id = '{$invoice_id}'");
              $cart = mysqli_fetch_assoc($cartQ);
              $previous_items = json_decode($cart['si_items'],true);
              $item_match = 0;
              $new_items = array();
              foreach($previous_items as $pitem){
                if($item[0]['id'] == $pitem['id']){
                    echo "<script>alert('This s.i. has already added')</script>";
                    $item_match = 1;
                }
                $new_items[] = $pitem;
              }
              if($item_match != 1){
                $new_items = array_merge($item,$previous_items);
              }
              $items_json = json_encode($new_items);
              $db->query("UPDATE si_details SET si_items = '{$items_json}' WHERE id = '{$invoice_id}'");
              setcookie(INVOICE_COOKIE,'',1,"/",$domain,false);
              setcookie(INVOICE_COOKIE,$invoice_id,CART_COOKIE_EXPIRE,'/',$domain,false);
              echo "<script>window.open('index.php?new_cr=$dr_id','_self')</script>";

            }else{
              $items_json = json_encode($item);
              $tempTranQ = $db->query("INSERT INTO si_details (si_items) VALUES ('{$items_json}')");
              $invoice_id = $db->insert_id;
              setcookie(INVOICE_COOKIE,$invoice_id,CART_COOKIE_EXPIRE,'/',$domain,false);

              echo "<script>window.open('index.php?new_cr=$dr_id','_self')</script>";
            }
          ?>
        <?php elseif($mode == 'new_tt'): ?>
            <?php
            $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
            $item = array();
            $item[] = array(
              'id'        => $id,
              'depart'        => '',
              'arrive'        => '',
            );


              if($trip_si_id != ''){
                $cartQ = $db->query("SELECT * FROM trip_si_details WHERE id = '{$trip_si_id}'");
                $cart = mysqli_fetch_assoc($cartQ);
                $previous_items = json_decode($cart['trip_si_items'],true);
                $item_match = 0;
                $new_items = array();
                foreach($previous_items as $pitem){
                  if($item[0]['id'] == $pitem['id']){
                      echo "<script>alert('This s.i. has already added')</script>";
                      $item_match = 1;
                  }
                  $new_items[] = $pitem;
                }
                if($item_match != 1){
                  $new_items = array_merge($item,$previous_items);
                }
                $items_json = json_encode($new_items);
                $db->query("UPDATE trip_si_details SET trip_si_items = '{$items_json}' WHERE id = '{$trip_si_id}'");
                setcookie(TRIPSI_COOKIE,'',1,"/",$domain,false);
                setcookie(TRIPSI_COOKIE,$trip_si_id,CART_COOKIE_EXPIRE,'/',$domain,false);
                echo "<script>window.open('index.php?new_tt','_self')</script>";

              }else{
                $items_json = json_encode($item);
                $tempTranQ = $db->query("INSERT INTO trip_si_details (trip_si_items) VALUES ('{$items_json}')");
                $trip_si_id = $db->insert_id;
                setcookie(TRIPSI_COOKIE,$trip_si_id,CART_COOKIE_EXPIRE,'/',$domain,false);

                echo "<script>window.open('index.php?new_tt','_self')</script>";
              }
            ?>
      <?php elseif($mode == 'edit_si'): ?>
          <?php
          $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
          $item = array();
          $item[] = array(
            'id'        => $id,
          );

          $tempSi = $db->query("SELECT * FROM temp_si WHERE si_id = '{$dr_id}'");
          $temp_Si = mysqli_fetch_assoc($tempSi);
          $dr_detail_id = $temp_Si['dr_detail_id'];
          $cartQ = $db->query("SELECT * FROM temp_dr_detail WHERE dr_detail_id = '{$dr_detail_id}'");

            if($dr_detail_id != ''){

              $cart = mysqli_fetch_assoc($cartQ);
              $previous_items = json_decode($cart['dr_items'],true);
              $item_match = 0;
              $new_items = array();
              foreach($previous_items as $pitem){
                if($item[0]['id'] == $pitem['id']){
                    echo "<script>alert('This dr has already added')</script>";
                    $item_match = 1;
                }
                $new_items[] = $pitem;
              }
              if($item_match != 1){
                $new_items = array_merge($item,$previous_items);
              }
              $items_json = json_encode($new_items);
              $db->query("UPDATE temp_dr_detail SET dr_items = '{$items_json}' WHERE dr_detail_id = '{$dr_detail_id}'");
              echo "<script>window.open('index.php?edit_si=$dr_id','_self')</script>";

            }else{
              $items_json = json_encode($item);
              $tempTranQ = $db->query("INSERT INTO temp_dr_detail (dr_items) VALUES ('{$items_json}')");
              $cart_id = $db->insert_id;
              setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);

              echo "<script>window.open('index.php?edit_si=$dr_id','_self')</script>";
            }
          ?>
        <?php elseif($mode == 'edit_cr'): ?>
            <?php
            $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
            $item = array();
            $item[] = array(
              'id'        => $id,
            );

            $tempSi = $db->query("SELECT * FROM temp_cr WHERE cr_id = '{$dr_id}'");
            $temp_Si = mysqli_fetch_assoc($tempSi);
            $dr_detail_id = $temp_Si['si_detail_id'];
            $cartQ = $db->query("SELECT * FROM temp_si_detail WHERE si_detail_id = '{$dr_detail_id}'");

              if($dr_detail_id != ''){

                $cart = mysqli_fetch_assoc($cartQ);
                $previous_items = json_decode($cart['si_items'],true);

                $item_match = 0;
                $new_items = array();
                foreach($previous_items as $pitem){
                  if($item[0]['id'] == $pitem['id']){
                      echo "<script>alert('This si has already added')</script>";
                      $item_match = 1;
                  }
                  $new_items[] = $pitem;
                }
                if($item_match != 1){
                  $new_items = array_merge($item,$previous_items);
                }
                $items_json = json_encode($new_items);
                $db->query("UPDATE temp_si_detail SET si_items = '{$items_json}' WHERE si_detail_id = '{$dr_detail_id}'");
                echo "<script>window.open('index.php?edit_cr=$dr_id','_self')</script>";

              }else{
                $items_json = json_encode($item);
                $tempTranQ = $db->query("INSERT INTO temp_si_detail (si_items) VALUES ('{$items_json}')");
                $invoice_id = $db->insert_id;
                setcookie(INVOICE_COOKIE,$invoice_id,CART_COOKIE_EXPIRE,'/',$domain,false);

                echo "<script>window.open('index.php?edit_cr=$dr_id','_self')</script>";
              }
            ?>

          <?php elseif($mode == 'edit_cv'): ?>
              <?php

              $tempSi = $db->query("UPDATE temp_cr SET si_detail_id = '$id' WHERE cr_id = '{$dr_id}'");
              echo "<script>window.open('index.php?edit_cv=$dr_id','_self')</script>";

              ?>
          <?php elseif($mode == 'edit_tt'): ?>
              <?php
              $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
              $item = array();
              $item[] = array(
                'id'        => $id,
              );

              $tempSi = $db->query("SELECT * FROM trip_tickets WHERE id = '{$dr_id}'");
              $temp_Si = mysqli_fetch_assoc($tempSi);
              $dr_detail_id = $temp_Si['trip_si_detail_id'];
              $cartQ = $db->query("SELECT * FROM temp_trip_si_details WHERE trip_si_detail_id = '{$dr_detail_id}'");

                if($dr_detail_id != ''){

                  $cart = mysqli_fetch_assoc($cartQ);
                  $previous_items = json_decode($cart['trip_si_items'],true);

                  $item_match = 0;
                  $new_items = array();
                  foreach($previous_items as $pitem){
                    if($item[0]['id'] == $pitem['id']){
                        echo "<script>alert('This si has already added')</script>";
                        $item_match = 1;
                    }
                    $new_items[] = $pitem;
                  }
                  if($item_match != 1){
                    $new_items = array_merge($item,$previous_items);
                  }
                  $items_json = json_encode($new_items);
                  $db->query("UPDATE temp_trip_si_details SET trip_si_items = '{$items_json}' WHERE trip_si_detail_id = '{$dr_detail_id}'");
                  echo "<script>window.open('index.php?edit_tt=$dr_id','_self')</script>";

                }else{
                  $items_json = json_encode($item);
                  $tempTranQ = $db->query("INSERT INTO temp_trip_si_details (trip_si_items) VALUES ('{$items_json}')");
                  $invoice_id = $db->insert_id;
                  setcookie(INVOICE_COOKIE,$invoice_id,CART_COOKIE_EXPIRE,'/',$domain,false);

                  echo "<script>window.open('index.php?edit_tt=$dr_id','_self')</script>";
                }
              ?>
            <?php elseif($mode == 'edit_rr'): ?>
              <?php
              $db->query("UPDATE temp_dr SET transaction_id = '{$id}' WHERE dr_id = '{$dr_id}'");

              $tempDr = $db->query("SELECT * FROM temp_dr WHERE dr_id = '{$dr_id}'");
              $temp_Dr = mysqli_fetch_assoc($tempDr);
              $txn_id = $temp_Dr['transaction_id'];

              $txnQuery = $db->query("SELECT * FROM purchase_orders WHERE id = '{$txn_id}'");
              $txn = mysqli_fetch_assoc($txnQuery);

              $temp_transaction_id = $txn['id'];
              $temp_cart_id = $txn['cart_id'];
              $temp_customer_id = $txn['supplier_id'];
              $temp_sub_total = $txn['sub_total'];
              $temp_tax = $txn['tax'];
              $temp_grand_total = $txn['grand_total'];
              $temp_state = $txn['state'];
              $temp_txn_date = $txn['txn_date'];

              $tempTranQ = $db->query("INSERT INTO temp_transactions (transaction_id,cart_id,customer_id,sub_total,tax,grand_total,state,txn_date)
                                      VALUES ('$temp_transaction_id','$temp_cart_id','$temp_customer_id','$temp_sub_total','$temp_tax','$temp_grand_total','$temp_state','$temp_txn_date')");
              $tempTrQ = $db->query("SELECT * FROM temp_transactions WHERE transaction_id = '{$txn_id}'");
              $temp_transaction = mysqli_fetch_assoc($tempTrQ);

              $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$temp_cart_id}'");
              $cart = mysqli_fetch_assoc($cartQ);
              $temp_cart_id = $cart['id'];
              $temp_items = $cart['items'];
              $temp_expire_date = $cart['expire_date'];
              $temp_paid = $cart['paid'];
              $temp_shipped = $cart['shipped'];

              $tempCartQ = $db->query("INSERT INTO temp_cart (cart_id,items,expire_date,paid,shipped)
                                      VALUES ('$temp_cart_id','$temp_items','$temp_expire_date','$temp_paid','$temp_shipped')");

              echo "<script>window.open('index.php?edit_rr=$dr_id','_self')</script>";
              ?>
            <?php elseif($mode == 'edit_jo'): ?>
              <?php
              $db->query("UPDATE temp_jo SET do_id = '{$id}' WHERE jo_id = '{$dr_id}'");

              $tempDr = $db->query("SELECT * FROM temp_jo WHERE jo_id = '{$dr_id}'");
              $temp_Dr = mysqli_fetch_assoc($tempDr);
              $txn_id = $temp_Dr['do_id'];

              $txnQuery = $db->query("SELECT * FROM transactions WHERE id = '{$txn_id}'");
              $txn = mysqli_fetch_assoc($txnQuery);

              $temp_transaction_id = $txn['id'];
              $temp_cart_id = $txn['cart_id'];

              $db->query("UPDATE temp_jo SET cart_id = '{$temp_cart_id}' WHERE jo_id = '{$dr_id}'");

              $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$temp_cart_id}'");
              $cart = mysqli_fetch_assoc($cartQ);
              $temp_cart_id = $cart['id'];
              $temp_items = $cart['items'];
              $temp_expire_date = $cart['expire_date'];
              $temp_paid = $cart['paid'];
              $temp_shipped = $cart['shipped'];

              $tempCartQ = $db->query("INSERT INTO temp_cart (cart_id,items,expire_date,paid,shipped)
                                      VALUES ('$temp_cart_id','$temp_items','$temp_expire_date','$temp_paid','$temp_shipped')");

              echo "<script>window.open('index.php?edit_jo=$dr_id','_self')</script>";
              ?>
    <?php else: ?>
      <?php
      $db->query("UPDATE temp_dr SET transaction_id = '{$id}' WHERE dr_id = '{$dr_id}'");

      $tempDr = $db->query("SELECT * FROM temp_dr WHERE dr_id = '{$dr_id}'");
      $temp_Dr = mysqli_fetch_assoc($tempDr);
      $txn_id = $temp_Dr['transaction_id'];

      $txnQuery = $db->query("SELECT * FROM transactions WHERE id = '{$txn_id}'");
      $txn = mysqli_fetch_assoc($txnQuery);

      $temp_transaction_id = $txn['id'];
      $temp_cart_id = $txn['cart_id'];
      $temp_customer_id = $txn['customer_id'];
      $temp_sub_total = $txn['sub_total'];
      $temp_tax = $txn['tax'];
      $temp_grand_total = $txn['grand_total'];
      $temp_description = $txn['description'];
      $temp_state = $txn['state'];
      $temp_dr_done = $txn['dr_done'];
      $temp_txn_date = $txn['txn_date'];

      $tempTranQ = $db->query("INSERT INTO temp_transactions (transaction_id,cart_id,customer_id,sub_total,tax,grand_total,description,state,dr_done,txn_date)
                              VALUES ('$temp_transaction_id','$temp_cart_id','$temp_customer_id','$temp_sub_total','$temp_tax','$temp_grand_total','$temp_description','$temp_state','$temp_dr_done','$temp_txn_date')");
      $tempTrQ = $db->query("SELECT * FROM temp_transactions WHERE transaction_id = '{$txn_id}'");
      $temp_transaction = mysqli_fetch_assoc($tempTrQ);

      $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$temp_cart_id}'");
      $cart = mysqli_fetch_assoc($cartQ);
      $temp_cart_id = $cart['id'];
      $temp_items = $cart['items'];
      $temp_expire_date = $cart['expire_date'];
      $temp_paid = $cart['paid'];
      $temp_shipped = $cart['shipped'];

      $tempCartQ = $db->query("INSERT INTO temp_cart (cart_id,items,expire_date,paid,shipped)
                              VALUES ('$temp_cart_id','$temp_items','$temp_expire_date','$temp_paid','$temp_shipped')");

      echo "<script>window.open('index.php?edit_dr=$dr_id','_self')</script>";
      ?>
    <?php endif; ?>

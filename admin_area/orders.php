<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';

  include 'head.php';
  include 'navigation.php';

  ?>

  <div id="content"><!-- #content Begin -->
      <div class="container"><!-- container Begin -->
          <div class="col-md-12"><!-- col-md-12 Begin -->

          </div><!-- col-md-12 Finish -->

          <div class="col-md-2"><!-- col-md-3 Begin -->

           </div><!-- col-md-3 Finish -->

           <div class="col-md-10"><!-- col-md-9 Begin -->

      <?php

          $delTempTrans = $db->query("DELETE FROM temp_transactions");
          $delTempCart = $db->query("DELETE FROM temp_cart");

          $txn_id = sanitize((int)$_GET['txn_id']);
          $txnQuery = $db->query("SELECT * FROM transactions WHERE id = '{$txn_id}'");
          $txn = mysqli_fetch_assoc($txnQuery);
          $c_id = $txn['customer_id'];
          $state = $txn['state'];
          $dr_done = $txn['dr_done'];
          $get_customer = "SELECT * from customers where id='$c_id'";
          $run_customer = mysqli_query($db,$get_customer);
          $row_customer = mysqli_fetch_array($run_customer);
          $cart_id = $txn['cart_id'];
          $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
          $cart = mysqli_fetch_assoc($cartQ);
          $items = json_decode($cart['items'],true);
          $idArray = array();
          $products = array();
          foreach($items as $item){
            $idArray[] = $item['id'];
          }
          $ids = implode(',',$idArray);
          $productQ = $db->query(
            "SELECT i.id as 'id', i.title as 'title', i.price as 'price', i.unit as 'unit', c.id as 'cid', c.category as 'child', p.category as 'parent'
            FROM products i
            LEFT JOIN categories c ON i.category = c.id
            LEFT JOIN categories p ON c.parent = p.id
            WHERE i.id IN ({$ids})
            ");
              while($p = mysqli_fetch_assoc($productQ)){
                  foreach($items as $item){
                    if($item['id'] == $p['id']){
                      $x = $item;
                      continue;
                    }
                  }
                $products[] = array_merge($x,$p);
              }
        ?>
        <br>
        <div class="row"><!-- row 1 begin -->
            <div class="col-lg-12"><!-- col-lg-12 begin -->
                <ol class="breadcrumb"><!-- breadcrumb begin -->
                    <li class="active"><!-- active begin -->

                        <i class="fa fa-dashboard"></i> Dashboard / Delivery Order
                        <?php if($state != 'Approved'): ?>
                          <a href="index.php?edit_order=<?php echo $txn_id; ?>&click=1"><span class="btn btn-default"><i class="fa fa-edit"></i></span></a>
                        <?php else: ?>
                        <?php endif; ?>

                        <a href="index.php?view_orders"><span class="btn btn-default"><i class="fa fa-list"></i></span></a>

                        <?php if($state == 'Approved' && $dr_done == 'no'): ?>
                          <a href="index.php?new_dr2=<?php echo $txn_id; ?>"><span class="btn btn-default"><i class="fa fa-plus"></i> New DR</span></a>
                        <?php else: ?>
                        <?php endif; ?>

                        <a href="index.php?view_orders"><span class="btn btn-default"><i class="fa fa-plus"></i> New JO</span></a>

                    </li><!-- active finish -->
                </ol><!-- breadcrumb finish -->
            </div><!-- col-lg-12 finish -->
        </div><!-- row 1 finish -->

        <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-condensed table-bordered">
                <tbody>
                  <tr>
                    <td  align="right">Transaction Number:</td>
                    <td><?=$txn_id;?></td>
                    <td  align="right">Date:</td>
                    <td><?=pretty_date($txn['txn_date']);?></td></tr>
                  <tr>
                    <td  align="right">Customer Name:</td>
                    <td><?=$row_customer['company_name'];?></td>
                  </tr>
                  <tr>
                    <td  align="right">Address:</td>
                    <td><?=$row_customer['street'];?>
                    <?=$row_customer['barangay'];?>
                    <?=$row_customer['city'];?></td>
                  </tr>
                </tbody>
              </table>
              <table class="table table-condensed table-bordered">
                <thead>
                  <th>Quantity</th>
                  <th>Unit</th>
                  <th>Item Description</th>
                  <th>Unit Price</th>
                  <th>Amount</th>
                </thead>
                <tbody>
                  <?php foreach($products as $product): ?>
                    <tr>
                      <td><?=$product['quantity'];?></td>
                      <td><?=$product['unit'];?></td>
                      <td><?=$product['title'];?></td>
                      <td><?=$product['price'];?></td>
                      <td><?=$product['quantity']*$product['price'];?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="pull-right col-md-4">
              <table class="table table-condensed table-bordered">
                <tbody>
                  <tr>
                    <td  align="right">Sub Total:</td>
                    <td><?=$txn['sub_total']?></td>
                  <tr>
                    <td  align="right">Tax:</td>
                    <td><?=$txn['tax']?></td>
                  </tr>
                  <tr>
                    <td  align="right">Grand Total:</td>
                    <td><?=$txn['grand_total']?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="pull-right">
            <?php if($state != 'Approved'): ?>
              <input type="submit" name="submit" value="Approve Now" class="btn btn-primary">
            <?php else: ?>
            <?php endif; ?>
            <a href="index.php?view_orders" class="btn btn-large btn-default">Back</a>
          </div>
       </form>
    </div><!-- col-md-9 Finish -->
  </div><!-- container Finish -->
</div><!-- #content Finish -->
<?php

    if(isset($_POST['submit'])){

      $txn_id = sanitize((int)$_GET['txn_id']);
      $db->query("UPDATE transactions SET state = 'Approved' WHERE id = '$txn_id'");
      $_SESSION['success_flash'] = "The Delivery Order Has Been Submitted!";
      echo "<script>window.open('index.php?view_orders','_self')</script>";

    }

?>
<?php include 'footer.php'; ?>

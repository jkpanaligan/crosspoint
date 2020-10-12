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

                 $txn_id = sanitize((int)$_GET['txn_id']);

                 $siQuery = $db->query("SELECT * FROM sales_invoice WHERE id = '{$txn_id}'");
                  $si = mysqli_fetch_assoc($siQuery);
                  $id = $si['id'];
                  $dr_detail_id = $si['dr_detail_id'];
                  $state = $si['state'];

                  $run_dr_detail = $db->query("SELECT * FROM dr_details WHERE id ='$dr_detail_id'");
                  $row_dr_detail = mysqli_fetch_assoc($run_dr_detail);
                  $dr_items = json_decode($row_dr_detail['dr_items'],true);
                  $drIdArray = array();
                  $drs = array();
                  foreach($dr_items as $dr_item){
                    $drIdArray[] = $dr_item['id'];
                  }
                  $drIds = implode(',',$drIdArray);
                  $drQ = $db->query(
                    "SELECT d.id as 'id', d.transaction_id as 'transaction_id'
                    FROM delivery_receipt d WHERE d.id IN ({$drIds})");

                      while($d = mysqli_fetch_assoc($drQ)){
                          foreach($dr_items as $dr_item){
                            if($dr_item['id'] == $d['id']){
                              $x = $dr_item;
                              continue;
                            }
                          }
                        $drs[] = array_merge($x,$d);
                      }

                  $drQuery = $db->query("SELECT * FROM delivery_receipt WHERE id = '{$drIdArray[0]}'");
                  $dr = mysqli_fetch_assoc($drQuery);
                  $tran_id = $dr['transaction_id'];

                   $txnQuery = $db->query("SELECT * FROM transactions WHERE id = '{$tran_id}'");
                   $txn = mysqli_fetch_assoc($txnQuery);
                   $order_id = $txn['id'];
                   $c_id = $txn['customer_id'];
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

                       if(!empty($drIdArray[1])){
                         $drQuery1 = $db->query("SELECT * FROM delivery_receipt WHERE id = '{$drIdArray[1]}'");
                         $dr1 = mysqli_fetch_assoc($drQuery1);
                         $tran_id1 = $dr1['transaction_id'];

                          $txnQuery1 = $db->query("SELECT * FROM transactions WHERE id = '{$tran_id1}'");
                          $txn1 = mysqli_fetch_assoc($txnQuery1);
                          $order_id1 = $txn1['id'];
                          $c_id1 = $txn1['customer_id'];
                          $get_customer1 = "SELECT * from customers where id='$c_id1'";
                          $run_customer1 = mysqli_query($db,$get_customer1);
                          $row_customer1 = mysqli_fetch_array($run_customer1);
                          $cart_id1 = $txn1['cart_id'];
                          $cartQ1 = $db->query("SELECT * FROM cart WHERE id = '{$cart_id1}'");
                          $cart1 = mysqli_fetch_assoc($cartQ1);
                          $items1 = json_decode($cart1['items'],true);
                          $idArray1 = array();
                          $products1 = array();
                          foreach($items1 as $item1){
                            $idArray1[] = $item1['id'];
                          }
                          $ids1 = implode(',',$idArray1);
                          $productQ1 = $db->query(
                            "SELECT i.id as 'id', i.title as 'title', i.price as 'price', i.unit as 'unit', c.id as 'cid', c.category as 'child', p.category as 'parent'
                            FROM products i
                            LEFT JOIN categories c ON i.category = c.id
                            LEFT JOIN categories p ON c.parent = p.id
                            WHERE i.id IN ({$ids1})
                            ");
                              while($p1 = mysqli_fetch_assoc($productQ1)){
                                  foreach($items1 as $item1){
                                    if($item1['id'] == $p1['id']){
                                      $x1 = $item1;
                                      continue;
                                    }
                                  }
                                $products1[] = array_merge($x1,$p1);
                              }
                       }

                       if(!empty($drIdArray[2])){
                         $drQuery2 = $db->query("SELECT * FROM delivery_receipt WHERE id = '{$drIdArray[2]}'");
                         $dr2 = mysqli_fetch_assoc($drQuery2);
                         $tran_id2 = $dr2['transaction_id'];

                          $txnQuery2 = $db->query("SELECT * FROM transactions WHERE id = '{$tran_id2}'");
                          $txn2 = mysqli_fetch_assoc($txnQuery2);
                          $order_id2 = $txn2['id'];
                          $c_id2 = $txn2['customer_id'];
                          $get_customer2 = "SELECT * from customers where id='$c_id2'";
                          $run_customer2 = mysqli_query($db,$get_customer2);
                          $row_customer2 = mysqli_fetch_array($run_customer2);
                          $cart_id2 = $txn2['cart_id'];
                          $cartQ2 = $db->query("SELECT * FROM cart WHERE id = '{$cart_id2}'");
                          $cart2 = mysqli_fetch_assoc($cartQ2);
                          $items2 = json_decode($cart2['items'],true);
                          $idArray2 = array();
                          $products2 = array();
                          foreach($items2 as $item2){
                            $idArray2[] = $item2['id'];
                          }
                          $ids2 = implode(',',$idArray2);
                          $productQ2 = $db->query(
                            "SELECT i.id as 'id', i.title as 'title', i.price as 'price', i.unit as 'unit', c.id as 'cid', c.category as 'child', p.category as 'parent'
                            FROM products i
                            LEFT JOIN categories c ON i.category = c.id
                            LEFT JOIN categories p ON c.parent = p.id
                            WHERE i.id IN ({$ids2})
                            ");
                              while($p2 = mysqli_fetch_assoc($productQ2)){
                                  foreach($items2 as $item2){
                                    if($item2['id'] == $p2['id']){
                                      $x2 = $item2;
                                      continue;
                                    }
                                  }
                                $products2[] = array_merge($x2,$p2);
                              }
                       }

               ?>

             <br>

             <div class="row"><!-- row 1 begin -->
                 <div class="col-lg-12"><!-- col-lg-12 begin -->
                     <ol class="breadcrumb"><!-- breadcrumb begin -->
                         <li class="active"><!-- active begin -->

                             <i class="fa fa-dashboard"></i> Dashboard / Sales Invoice

                             <?php if($state != 'Approved'): ?>
                               <a href="index.php?edit_si=<?php echo $txn_id; ?>&click=1"><span class="btn btn-default"><i class="fa fa-edit"></i></span></a>
                             <?php else: ?>
                             <?php endif; ?>

                             <a href="index.php?view_sales_invoice"><span class="btn btn-default"><i class="fa fa-list"></i></span></a>

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
                         <td><?=$si['txn_date'];?></td></tr>
                       <tr>
                         <td  align="right">Customer Name:</td>
                         <td><?=$row_customer['company_name'];?></td>
                         <td  align="right">Delivery Receipt Number/s:</td>
                         <td><?=$drIds;?></td>
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
                       <th>D.R. No.</th>
                       <th>Quantity</th>
                       <th>Unit</th>
                       <th>Item Description</th>
                       <th>Unit Price</th>
                       <th>Amount</th>
                     </thead>
                     <tbody>
                       <tr>
                         <td><?=$drIdArray[0];?></td>
                       </tr>
                       <?php foreach($products as $product): ?>
                         <tr>
                           <td></td>
                           <td><?=$product['quantity'];?></td>
                           <td><?=$product['unit'];?></td>
                           <td><?=$product['title'];?></td>
                           <td><?=$product['price'];?></td>
                           <td><?=$product['quantity']*$product['price'];?></td>
                         </tr>
                       <?php endforeach; ?>

                       <?php if(!empty($drIdArray[1])): ?>
                       <tr>
                         <td><?=$drIdArray[1];?></td>
                       </tr>
                       <?php foreach($products1 as $product1): ?>

                         <tr>
                           <td></td>
                           <td><?=$product1['quantity'];?></td>
                           <td><?=$product1['unit'];?></td>
                           <td><?=$product1['title'];?></td>
                           <td><?=$product1['price'];?></td>
                           <td><?=$product1['quantity']*$product1['price'];?></td>
                         </tr>
                       <?php endforeach; ?>
                     <?php else: ?>
                     <?php endif; ?>

                     <?php if(!empty($drIdArray[2])): ?>
                     <tr>
                       <td><?=$drIdArray[2];?></td>
                     </tr>
                     <?php foreach($products2 as $product2): ?>

                       <tr>
                         <td></td>
                         <td><?=$product2['quantity'];?></td>
                         <td><?=$product2['unit'];?></td>
                         <td><?=$product2['title'];?></td>
                         <td><?=$product2['price'];?></td>
                         <td><?=$product2['quantity']*$product2['price'];?></td>
                       </tr>
                     <?php endforeach; ?>
                   <?php else: ?>
                   <?php endif; ?>
                     </tbody>
                   </table>
                 </div>
                 <div class="pull-right col-md-4">
                   <table class="table table-condensed table-bordered">
                     <?php if(empty($drIdArray[1]) && empty($drIdArray[2])): ?>
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
                   <?php else: ?>
                   <?php endif; ?>
                     <?php if(!empty($drIdArray[1]) && empty($drIdArray[2])): ?>
                     <tbody>
                       <tr>
                         <td  align="right">Sub Total:</td>
                         <td><?=$txn['sub_total']+$txn1['sub_total']?></td>
                       <tr>
                         <td  align="right">Tax:</td>
                         <td><?=$txn['tax']+$txn1['tax']?></td>
                       </tr>
                       <tr>
                         <td  align="right">Grand Total:</td>
                         <td><?=$txn['grand_total']+$txn1['grand_total']?></td>
                       </tr>
                     </tbody>
                   <?php else: ?>
                   <?php endif; ?>
                   <?php if(!empty($drIdArray[2])): ?>
                   <tbody>
                     <tr>
                       <td  align="right">Sub Total:</td>
                       <td><?=$txn['sub_total']+$txn1['sub_total']+$txn2['sub_total']?></td>
                     <tr>
                       <td  align="right">Tax:</td>
                       <td><?=$txn['tax']+$txn1['tax']+$txn2['tax']?></td>
                     </tr>
                     <tr>
                       <td  align="right">Grand Total:</td>
                       <td><?=$txn['grand_total']+$txn1['grand_total']+$txn2['grand_total']?></td>
                     </tr>
                   </tbody>
                 <?php else: ?>
                 <?php endif; ?>
                   </table>
                 </div>
               </div>
               <div class="pull-right">
                 <?php if($state != 'Approved'): ?>
                    <input type="submit" name="submit" value="Approve Now" class="btn btn-primary">
                 <?php else: ?>
                 <?php endif; ?>
                         <a href="index.php?view_sales_invoice" class="btn btn-large btn-default">Back</a>
              </div>
              </div>
            </form>

           </div><!-- col-md-9 Finish -->
        </div><!-- container Finish -->
  </div><!-- #content Finish -->
  <?php

      if(isset($_POST['submit'])){

        $si_id = sanitize((int)$_GET['txn_id']);
        $db->query("UPDATE sales_invoice SET state = 'Approved' WHERE id = '$si_id'");
        $_SESSION['success_flash'] = "The Sales Invoice Has Been Submitted!";
        echo "<script>window.open('index.php?view_sales_invoice','_self')</script>";

      }

  ?>
  <?php include 'footer.php'; ?>

<?php

    $active='Cart';
    require_once 'init.php' ;
    include 'head.php';
    include 'navigation.php';

    if($cart_id != ''){
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'],true);
    $i = 1;
    $grand_total = 0;
    $item_count = 0;

    }

?>
<div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <?php if($cart_id == ''): ?>
             <div class="col-md-12"><!-- col-md-12 Begin -->

                 <ul class="breadcrumb"><!-- breadcrumb Begin -->
                     <li>
                         <a href="index.php">Home</a>
                     </li>
                     <li>
                         Cart
                     </li>
                 </ul><!-- breadcrumb Finish -->
                 <div class="bg-danger">
                   <p class="text-center text-danger">
                     Your shopping cart is empty!
                   </p>
                 </div>

             </div><!-- col-md-12 Finish -->

             <div id="cart" class="col-md-9"><!-- col-md-9 Begin -->

                 <div class="box"><!-- box Begin -->

                   <form action="cart.php" method="post" enctype="multipart/form-data"><!-- form Begin -->

                         <h1>Shopping Cart</h1>

                         <div class="table-responsive"><!-- table-responsive Begin -->

                   <table class="table tablt-bordered table-condensed table-striped">
                    <thead><th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Amount</th><th>Delete</th></thead>


                  </table>

                </div><!-- table-responsive Finish -->

                       <div class="box-footer"><!-- box-footer Begin -->

                           <div class="pull-left"><!-- pull-left Begin -->

                               <a href="index.php" class="btn btn-default"><!-- btn btn-default Begin -->

                                   <i class="fa fa-chevron-left"></i> Continue Shopping

                               </a><!-- btn btn-default Finish -->

                           </div><!-- pull-left Finish -->

                           <div class="pull-right"><!-- pull-right Begin -->

                             <?php if(!empty($grand_total) && $grand_total >= 10000): ?>
                               <a href="checkout.php" class="btn btn-primary">

                                   Proceed Checkout <i class="fa fa-chevron-right"></i>

                               </a>
                             <?php else: ?>
                               <a href="cart.php" class="btn btn-primary">

                                   Proceed Checkout <i class="fa fa-chevron-right"></i>

                               </a>

                              <?php endif; ?>

                           </div><!-- pull-right Finish -->

                       </div><!-- box-footer Finish -->

                   </form><!-- form Finish -->

                 </div><!-- box Finish -->

                 <div id="row same-heigh-row"><!-- #row same-heigh-row Begin -->
                     <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Begin -->
                         <div class="box same-height headline"><!-- box same-height headline Begin -->
                             <h3 class="text-center">Products You Maybe Like</h3>
                         </div><!-- box same-height headline Finish -->
                     </div><!-- col-md-3 col-sm-6 Finish -->

                     <?php

                     $get_products = "SELECT * from products where featured = 1 order by rand() LIMIT 0,3";

                     $run_products = mysqli_query($db,$get_products);

                     while($row_products=mysqli_fetch_array($run_products)){

                         $pro_id = $row_products['id'];

                         $pro_title = $row_products['title'];

                         $pro_price = $row_products['price'];

                         $pro_img1 = $row_products['image'];

                         echo "

                      <div class='col-md-3 col-sm-6 center-responsive'><!-- col-md-3 col-sm-6 center-responsive Begin -->
                         <div class='product same-height'><!-- product same-height Begin -->
                             <a href='details.php?pro_id=$pro_id'>
                                 <img class='img-responsive' src='$pro_img1' alt='Product 6'>
                              </a>

                              <div class='text'><!-- text Begin -->
                                  <h3><a href='details.php?pro_id=$pro_id'> $pro_title </a></h3>

                                  <p class='price'>P $pro_price</p>

                              </div><!-- text Finish -->

                          </div><!-- product same-height Finish -->
                     </div><!-- col-md-3 col-sm-6 center-responsive Finish -->

                         ";

                     }

                     ?>

                 </div><!-- #row same-heigh-row Finish -->

             </div><!-- col-md-9 Finish -->

             <div class="col-md-3"><!-- col-md-3 Begin -->

                 <div id="order-summary" class="box"><!-- box Begin -->

                     <div class="box-header"><!-- box-header Begin -->

                         <h3>Order Summary</h3>

                     </div><!-- box-header Finish -->

                     <div class="table-responsive"><!-- table-responsive Begin -->

                         <table class="table"><!-- table Begin -->

                             <tbody><!-- tbody Begin -->

                                 <tr><!-- tr Begin -->

                                     <td> Order All Sub-Total </td>
                                     <th> P0 </th>

                                 </tr><!-- tr Finish -->

                                 <tr><!-- tr Begin -->

                                     <td> Tax </td>
                                     <th> P0 </th>

                                 </tr><!-- tr Finish -->

                                 <tr class="total"><!-- tr Begin -->

                                     <td> Total </td>
                                     <th> P0 </th>

                                 </tr><!-- tr Finish -->

                             </tbody><!-- tbody Finish -->

                         </table><!-- table Finish -->

                     </div><!-- table-responsive Finish -->

                 </div><!-- box Finish -->

             </div><!-- col-md-3 Finish -->

          <?php else: ?>
           <div class="col-md-12"><!-- col-md-12 Begin -->

               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Cart
                   </li>
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->

           <?php

           if(isset($_SESSION['email'])){

             $session_email = $_SESSION['email'];

             $select_customer = "SELECT * from customers where email='$session_email'";

             $run_customer = mysqli_query($db,$select_customer);

             $row_customer = mysqli_fetch_array($run_customer);

             $customer_id = $row_customer['id'];

           }

            ?>

           <div id="cart" class="col-md-9"><!-- col-md-9 Begin -->

               <div class="box"><!-- box Begin -->

                 <form action="cart.php" method="post" enctype="multipart/form-data"><!-- form Begin -->

                       <h1>Shopping Cart</h1>

                       <?php

                       $select_cart = "select * from cart where id='$cart_id'";
                       $run_cart = mysqli_query($db,$select_cart);
                       $count = mysqli_num_rows($run_cart);

                       ?>

                      <!-- <p class="text-muted">You currently have <?php echo $count1; ?> item(s) in your cart</p>-->

                       <div class="table-responsive"><!-- table-responsive Begin -->

                 <table class="table tablt-bordered table-condensed table-striped">
                  <thead><th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Amount</th><th>Delete</th></thead>
                  <tbody>

                    <?php
                      foreach ($items as $item) {
                        $product_id = $item['id'];
                        $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
                        $product = mysqli_fetch_assoc($productQ);
                      ?>
                      <tr>
                        <td><?=$i;?></td>
                        <td><?=$product['title'];?></td>
                        <td><?=money($product['price']);?></td>
                        <td>
                          <button class="btn btn-xs btn-default" onclick="update_cart1('removeone','<?=$product['id'];?>');">-</button>
                          <?=$item['quantity'];?>
                          <?php if($product['current_quantity'] == 0): ?>
                            <span class="text-danger">Max</span>
                          <?php else: ?>
                            <button class="btn btn-xs btn-default" onclick="update_cart1('addone','<?=$product['id'];?>');">+</button>
                          <?php endif; ?>
                        </td>
                        <td><?=money($item['quantity'] * $product['price']);?></td>
                        <td><button class="btn btn-xs btn-default" onclick="update_cart1('delete','<?=$product['id'];?>');"><span class="glyphicon glyphicon-remove"></span></button></td>
                      </tr>
                    <?php
                      $i++;
                      $item_count += $item["quantity"];
                      $grand_total += ($product['price'] * $item['quantity']);
                    }
                    $tax = TAXRATE * $grand_total;
                    $sub_total = $grand_total - $tax;
                    ?>
                  </tbody>


                </table>

              </div><!-- table-responsive Finish -->

                     <div class="box-footer"><!-- box-footer Begin -->

                         <div class="pull-left"><!-- pull-left Begin -->

                             <a href="index.php" class="btn btn-default"><!-- btn btn-default Begin -->

                                 <i class="fa fa-chevron-left"></i> Continue Shopping

                             </a><!-- btn btn-default Finish -->

                         </div><!-- pull-left Finish -->

                         <div class="pull-right"><!-- pull-right Begin -->

                           <?php if(!empty($grand_total) && $grand_total >= 10000): ?>
                             <a href="checkout.php" class="btn btn-primary">

                                 Proceed Checkout <i class="fa fa-chevron-right"></i>

                             </a>
                           <?php else: ?>
                             <a href="cart.php" class="btn btn-primary">

                                 Proceed Checkout <i class="fa fa-chevron-right"></i>

                             </a>

                            <?php endif; ?>


                         </div><!-- pull-right Finish -->

                     </div><!-- box-footer Finish -->

                 </form><!-- form Finish -->

               </div><!-- box Finish -->

               <div id="row same-heigh-row"><!-- #row same-heigh-row Begin -->
                   <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Begin -->
                       <div class="box same-height headline"><!-- box same-height headline Begin -->
                           <h3 class="text-center">Products You Maybe Like</h3>
                       </div><!-- box same-height headline Finish -->
                   </div><!-- col-md-3 col-sm-6 Finish -->

                   <?php

                   $get_products = "SELECT * from products where featured = 1 order by rand() LIMIT 0,3";

                   $run_products = mysqli_query($db,$get_products);

                   while($row_products=mysqli_fetch_array($run_products)){

                       $pro_id = $row_products['id'];

                       $pro_title = $row_products['title'];

                       $pro_price = $row_products['price'];

                       $pro_img1 = $row_products['image'];

                       echo "

                    <div class='col-md-3 col-sm-6 center-responsive'><!-- col-md-3 col-sm-6 center-responsive Begin -->
                       <div class='product same-height'><!-- product same-height Begin -->
                           <a href='details.php?pro_id=$pro_id'>
                               <img class='img-responsive' src='$pro_img1' alt='Product 6'>
                            </a>

                            <div class='text'><!-- text Begin -->
                                <h3><a href='details.php?pro_id=$pro_id'> $pro_title </a></h3>

                                <p class='price'>P $pro_price</p>

                            </div><!-- text Finish -->

                        </div><!-- product same-height Finish -->
                   </div><!-- col-md-3 col-sm-6 center-responsive Finish -->

                       ";

                   }

                   ?>

               </div><!-- #row same-heigh-row Finish -->

           </div><!-- col-md-9 Finish -->

           <div class="col-md-3"><!-- col-md-3 Begin -->

               <div id="order-summary" class="box"><!-- box Begin -->

                   <div class="box-header"><!-- box-header Begin -->
                     <?php if($grand_total > 10000): ?>
                     <?php else: ?>
                     <div class="bg-danger">
                       <p class="text-center text-danger">
                         Total amount of your order should be greater than P10,000
                       </p>
                     </div>
                     <?php endif; ?>

                       <h3>Order Summary</h3>

                   </div><!-- box-header Finish -->

                   <div class="table-responsive"><!-- table-responsive Begin -->

                       <table class="table"><!-- table Begin -->

                           <tbody><!-- tbody Begin -->

                               <tr><!-- tr Begin -->

                                   <td> Order All Sub-Total </td>
                                   <th> <?php echo money($sub_total); ?> </th>

                               </tr><!-- tr Finish -->

                               <tr><!-- tr Begin -->

                                   <td> Tax </td>
                                   <th> <?php echo money($tax); ?> </th>

                               </tr><!-- tr Finish -->

                               <tr class="total"><!-- tr Begin -->

                                   <td> Total </td>
                                   <th> <?php echo money($grand_total); ?> </th>

                               </tr><!-- tr Finish -->

                           </tbody><!-- tbody Finish -->

                       </table><!-- table Finish -->

                   </div><!-- table-responsive Finish -->

               </div><!-- box Finish -->

           </div><!-- col-md-3 Finish -->
           <?php endif; ?>
       </div><!-- container Finish -->
   </div><!-- #content Finish -->

   <?php

    include("footer.php");

    ?>

</body>
</html>

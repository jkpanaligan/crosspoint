<?php

    $active='Account';
    require_once 'init.php' ;
    include 'head.php';
    include 'navigation.php';

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

?>

   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->

               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Pay with Card
                   </li>
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->


           <div class="col-md-1">

           </div>

    <div class="col-md-6"><!-- col-md-9 Begin -->

     <link rel="stylesheet" href="/css/style.css">
       <h2 class="my-4 text-center">Pay with Card</h2>
       <form action="./charge.php" method="post" id="payment-form">
       <div class="form-row">
         <input value="<?php echo $_SESSION['email'] ?>" type="hidden" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address">
         <input type="hidden" name="grand_total" value="<?php echo $grand_total ?>">
         <input maxlength="30" onkeypress="lettersOnly1(event)" type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="First Name">

              <script>

              function lettersOnly1(evt1){
                  var ch = String.fromCharCode(evt1.which);
                    if(!(/[a-z]|[ ]|[A-Z]/.test(ch))){
                      evt1.preventDefault();
                    }
              }

            </script>

        <input maxlength="30" onkeypress="lettersOnly1(event)" type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Last Name">
         <div id="card-element" class="form-control">
           <!-- A Stripe Element will be inserted here. -->
         </div>

         <!-- Used to display form errors. -->
         <div id="card-errors" role="alert"></div>
       </div>
       <button>Submit Payment</button>
     </form>
   <script src="https://js.stripe.com/v3/"></script>
   <script src="./js/charge.js"></script>
    </div><!-- col-md-9 Finish -->


    <div class="col-md-4"><!-- col-md-3 Begin -->

      <?php

      include("leftbar.php");

      ?>

   </div><!-- col-md-3 Finish -->
  </div><!-- container Finish -->
</div><!-- #content Finish -->

  <?php

  include("footer.php");

  ?>

</body>
</html>

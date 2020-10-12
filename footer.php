<div id="footer"><!-- #footer Begin -->
    <div class="container"><!-- container Begin -->
        <div class="row"><!-- row Begin -->
            <div class="col-sm-6 col-md-3"><!-- col-sm-6 col-md-3 Begin -->

               <h4>Pages</h4>

                <ul><!-- ul Begin -->
                    <li><a href="cart.php">Shopping Cart</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="customer/my_account.php">My Account</a></li>
                </ul><!-- ul Finish -->

                <hr>

                <h4>User Section</h4>

                <ul><!-- ul Begin -->

                           <?php

                           if(!isset($_SESSION['customer_email'])){

                               echo"<a href='checkout.php'>Login</a>";

                           }else{

                              echo"<a href='customer/my_account.php?my_orders'>My Account</a>";

                           }

                           ?>

                    <li><a href="customer_register.php">Register</a></li>
                </ul><!-- ul Finish -->

                <hr class="hidden-md hidden-lg hidden-sm">

            </div><!-- col-sm-6 col-md-3 Finish -->

            <div class="com-sm-6 col-md-3"><!-- col-sm-6 col-md-3 Begin -->

                <h4>Products Categories</h4>

                <ul><!-- ul Begin -->

                    <?php

                        $get_p_cats = "SELECT * from categories where parent != 0";

                        $run_p_cats = mysqli_query($db,$get_p_cats);

                        while($row_p_cats=mysqli_fetch_array($run_p_cats)){

                            $p_cat_id = $row_p_cats['id'];

                            $p_cat_title = $row_p_cats['category'];

                            echo "

                                <li>

                                    <a href='shop.php?p_cat=$p_cat_id'>

                                        $p_cat_title

                                    </a>

                                </li>

                            ";

                        }

                    ?>

                </ul><!-- ul Finish -->

                <hr class="hidden-md hidden-lg">

            </div><!-- col-sm-6 col-md-3 Finish -->

            <div class="col-sm-6 col-md-3"><!-- col-sm-6 col-md-3 Begin -->

                <h4>About Us</h4>

                <p><!-- p Start -->

                    <strong>Crosspoint Paper inc.</strong>
                    <br/>Barangay Maguyam
                    <br/>Silang Cavite
                    <br/>514-2686, 881-1356, 9981467
                    <br/>sales@crosspointpaper.com
                </p><!-- p Finish -->

                <a href="contact.php">Check Our Contact Page</a>

                <hr class="hidden-md hidden-lg">

            </div><!-- col-sm-6 col-md-3 Finish -->
        </div><!-- row Finish -->
    </div><!-- container Finish -->
</div><!-- #footer Finish -->


<div id="copyright"><!-- #copyright Begin -->
    <div class="container"><!-- container Begin -->
        <div class="col-md-6"><!-- col-md-6 Begin -->

            <p class="pull-left">&copy; Copyright 2019-2020 Crosspoint Paper Inc.</p>

        </div><!-- col-md-6 Finish -->
    </div><!-- container Finish -->
</div><!-- #copyright Finish -->



<script>

function update_cart1(mode,edit_id){
    var data = {"mode" : mode, "edit_id" : edit_id};
    jQuery.ajax({
      url : '/crosspointpaper/update_cart.php',
      method : "post",
      data : data,
      success : function(){location.reload();},
      error : function(){alert("Something went wrong.");},
    });
  }

function add_to_cart(){
    jQuery('#modal_errors').html("");
    var quantity = jQuery('#quantity').val();
    var available = jQuery('#available').val();
    var error = '';
    var data = jQuery('#add_product_form').serialize();
    if(quantity == '' || quantity == 0){
      error += '<p class="text-danger text-center">You must enter a quantity.</p>';
      jQuery('#modal_errors').html(error);
      return;
    }else if(available < quantity && available > quantity){
     error += '<p class="text-danger text-center">There are only '+available+' available.</p>';
     jQuery('#modal_errors').html(error);
    }else{
      jQuery.ajax({
        url : '/crosspointpaper/add_cart.php',
        method : 'post',
        data : data,
        success : function(){
          location.reload();
        },
        error : function(){alert("Something went wrong");}
      });
    }
  }
</script>

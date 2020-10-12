<?php

    $active='Cart';
    require_once 'init.php' ;
    include 'head.php';
    include 'navigation.php';

?>

<div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->

               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Home</a>
                   </li>
                   <li>
                       Shop
                   </li>

                   <li>
                       <a href="shop.php?p_cat=<?php echo $category1; ?>"><?php echo $p_cat_title; ?></a>
                   </li>
                   <li> <?php echo $pro_title; ?> </li>
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->

           <div class="col-md-3"><!-- col-md-3 Begin -->

   <?php

    include("leftbar.php");

    ?>

           </div><!-- col-md-3 Finish -->

           <div class="col-md-9"><!-- col-md-9 Begin -->
               <div id="productMain" class="row"><!-- row Begin -->
                   <div class="col-sm-6"><!-- col-sm-6 Begin -->
                       <div id="mainImage"><!-- #mainImage Begin -->
                           <div id="myCarousel" class="carousel slide" data-ride="carousel"><!-- carousel slide Begin -->
                               <ol class="carousel-indicators"><!-- carousel-indicators Begin -->
                                   <li data-target="#myCarousel" data-slide-to="0" class="active" ></li>
                               </ol><!-- carousel-indicators Finish -->
                               <div class="carousel-inner">
                                   <div class="item active">
                                       <center><img class="img-responsive" src="<?php echo $image; ?>" alt="Product 1-a"></center>
                                   </div>
                               </div>
                           </div><!-- carousel slide Finish -->
                       </div><!-- mainImage Finish -->
                   </div><!-- col-sm-6 Finish -->

                   <div class="col-sm-6"><!-- col-sm-6 Begin -->

                       <div class="box"><!-- box Begin -->
                         <span id="modal_errors" class="bg-danger"></span>
                           <h1 class="text-center"> <?php echo $pro_title; ?> </h1>

                           <form class="form-horizontal" method="post" id="add_product_form"><!-- form-horizontal Begin -->
                                <input type="hidden" name="product_id" value="<?=$product_id;?>">
                               <div class="form-group"><!-- form-group Begin -->
                                   <label for="" class="col-md-5 control-label">Products Quantity</label>

                                   <div class="col-md-7"><!-- col-md-7 Begin -->

                                           <input type="number" class="form-control" id="quantity" name="quantity" min="0">

                                    </div><!-- col-md-7 Finish -->

                               </div><!-- form-group Finish -->

                               <p class="price">P <?php echo $pro_price; ?></p>

                               <p class="text-center buttons"><button class="btn btn-primary i fa fa-shopping-cart" onclick="add_to_cart();return false;"> Add to cart</button></p>

                           </form><!-- form-horizontal Finish -->

                       </div><!-- box Finish -->

                   </div><!-- col-sm-6 Finish -->
                   
               </div><!-- row Finish -->

               <div class="box" id="details"><!-- box Begin -->

                      <center>
                       <h4>Product Details</h4>
                       <br>
                       <h4>Unit: <?php echo $unit; ?></h4>

                       <h4>Per Set: <?php echo $per_set ?></h4>
                     </center>

               </div><!-- box Finish -->

               <div id="row same-heigh-row"><!-- #row same-heigh-row Begin -->
                   <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Begin -->
                       <div class="box same-height headline"><!-- box same-height headline Begin -->
                           <h3 class="text-center">Products You Maybe Like</h3>
                       </div><!-- box same-height headline Finish -->
                   </div><!-- col-md-3 col-sm-6 Finish -->

                   <?php

                    $get_products = "SELECT * from products order by rand() LIMIT 0,3";

                    $run_products = mysqli_query($db,$get_products);

                   while($row_products=mysqli_fetch_array($run_products)){

                       $pro_id = $row_products['id'];

                       $pro_title = $row_products['title'];

                       $pro_img1 = $row_products['image'];

                       $pro_price = $row_products['price'];

                       echo "

                        <div class='col-md-3 col-sm-6 center-responsive'>

                            <div class='product same-height'>

                                <a href='details.php?pro_id=$pro_id'>

                                    <img class='img-responsive' src='$pro_img1'>

                                </a>

                                <div class='text'>

                                    <h3> <a href='details.php?pro_id=$pro_id'> $pro_title </a> </h3>

                                    <p class='price'> $ $pro_price </p>

                                </div>

                            </div>

                        </div>

                       ";

                   }

                   ?>

               </div><!-- #row same-heigh-row Finish -->

           </div><!-- col-md-9 Finish -->

       </div><!-- container Finish -->
   </div><!-- #content Finish -->

   <?php

    include("footer.php");

    ?>

</body>
</html>

<?php

    $active='Shop';
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
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->

           <div class="col-md-3"><!-- col-md-3 Begin -->

   <?php

    include("leftbar.php");

    ?>

           </div><!-- col-md-3 Finish -->

           <div class="col-md-9"><!-- col-md-9 Begin -->

             <?php

                if(!isset($_GET['p_cat'])){

                    if(!isset($_GET['cat'])){

                      echo "

                       <div class='box'><!-- box Begin -->
                           <h1>Shop</h1>
                           <p>
                          </p>
                       </div><!-- box Finish -->

                       ";

                    }

                   }

               ?>

               <div class="row"><!-- row Begin -->

                   <?php

                        if(!isset($_GET['p_cat'])){

                         if(!isset($_GET['cat'])){

                            $per_page=6;

                            if(isset($_GET['page'])){

                                $page = $_GET['page'];

                            }else{

                                $page=1;

                            }

                            $start_from = ($page-1) * $per_page;

                            $get_products = "select * from products where featured = 1 order by 1 DESC LIMIT $start_from,$per_page";

                            $run_products = mysqli_query($db,$get_products);

                            while($row_products=mysqli_fetch_array($run_products)){

                                $pro_id = $row_products['id'];

                                $pro_title = $row_products['title'];

                                $pro_price = $row_products['price'];

                                $pro_img1 = $row_products['image'];

                                echo "

                                    <div class='col-md-4 col-sm-6 center-responsive'>

                                        <div class='product'>

                                            <a href='details.php?pro_id=$pro_id'>

                                                <img class='img-responsive' src='$pro_img1'>

                                            </a>

                                            <div class='text'>

                                                <h3>

                                                    <a href='details.php?pro_id=$pro_id'> $pro_title </a>

                                                </h3>

                                                <p class='price'>

                                                    P $pro_price

                                                </p>

                                                <p class='buttons'>

                                                    <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                                                        View Details

                                                    </a>

                                                    <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                                                        <i class='fa fa-shopping-cart'></i> Add To Cart

                                                    </a>

                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                ";

                        }

                   ?>

               </div><!-- row Finish -->

               <center>
                   <ul class="pagination"><!-- pagination Begin -->
					 <?php

                    $query = "select * from products";

                    $result = mysqli_query($db,$query);

                    $total_records = mysqli_num_rows($result);

                    $total_pages = ceil($total_records / $per_page);

                        echo "

                            <li>

                                <a href='shop.php?page=1'> ".'First Page'." </a>

                            </li>

                        ";

                        for($i=1; $i<=$total_pages; $i++){

                              echo "

                            <li>

                                <a href='shop.php?page=".$i."'> ".$i." </a>

                            </li>

                        ";

                        };

                        echo "

                            <li>

                                <a href='shop.php?page=$total_pages'> ".'Last Page'." </a>

                            </li>

                        ";

					    	}

						}

					 ?>

                   </ul><!-- pagination Finish -->
               </center>

                <?php

               getpcatpro();

               ?>

           </div><!-- col-md-9 Finish -->

       </div><!-- container Finish -->
   </div><!-- #content Finish -->

   <?php

    include("footer.php");

    ?>


</body>
</html>

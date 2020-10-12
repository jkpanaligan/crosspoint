<?php

  $active='Home';

  require_once 'init.php' ;
  include 'head.php';
  include 'navigation.php';

  $sql = "SELECT * FROM products WHERE featured = 1";
  $featured = $db->query($sql);
?>
<div class="container" id="slider"><!-- container Begin -->

       <div class="col-md-12"><!-- col-md-12 Begin -->

           <div class="carousel slide" id="myCarousel" data-ride="carousel"><!-- carousel slide Begin -->

               <ol class="carousel-indicators"><!-- carousel-indicators Begin -->

                   <li class="active" data-target="#myCarousel" data-slide-to="0"></li>
                   <li data-target="#myCarousel" data-slide-to="1"></li>
                   <li data-target="#myCarousel" data-slide-to="2"></li>
                   <li data-target="#myCarousel" data-slide-to="3"></li>

               </ol><!-- carousel-indicators Finish -->

               <div class="carousel-inner"><!-- carousel-inner Begin -->

                  <?php

                   $get_slides = "select * from slider LIMIT 0,1";

                   $run_slides = mysqli_query($db,$get_slides);

                   while($row_slides=mysqli_fetch_array($run_slides)){

                       $slide_name = $row_slides['slide_name'];
                       $slide_image = $row_slides['slide_image'];
                       $slide_url = $row_slides['slide_url'];

                       echo "

                       <div class='item active'>

                           <a href='$slide_url'>

                                <img src='admin_area/slides_images/$slide_image'>

                           </a>

                       </div>

                       ";

                   }

                   $get_slides = "select * from slider LIMIT 1,3";

                   $run_slides = mysqli_query($db,$get_slides);

                   while($row_slides=mysqli_fetch_array($run_slides)){

                       $slide_name = $row_slides['slide_name'];
                       $slide_image = $row_slides['slide_image'];
                       $slide_url = $row_slides['slide_url'];

                       echo "

                       <div class='item'>

                           <a href='$slide_url'>

                                <img src='admin_area/slides_images/$slide_image'>

                           </a>

                       </div>

                       ";

                   }

                   ?>

               </div><!-- carousel-inner Finish -->

               <a href="#myCarousel" class="left carousel-control" data-slide="prev"><!-- left carousel-control Begin -->

                   <span class="glyphicon glyphicon-chevron-left"></span>
                   <span class="sr-only">Previous</span>

               </a><!-- left carousel-control Finish -->

               <a href="#myCarousel" class="right carousel-control" data-slide="next"><!-- left carousel-control Begin -->

                   <span class="glyphicon glyphicon-chevron-right"></span>
                   <span class="sr-only">Next</span>

               </a><!-- left carousel-control Finish -->

           </div><!-- carousel slide Finish -->

       </div><!-- col-md-12 Finish -->

   </div><!-- container Finish -->

   <div id="hot"><!-- #hot Begin -->

       <div class="box"><!-- box Begin -->

           <div class="container"><!-- container Begin -->

               <div class="col-md-12"><!-- col-md-12 Begin -->

                   <h2>
                       Our Products
                   </h2>

               </div><!-- col-md-12 Finish -->

           </div><!-- container Finish -->

       </div><!-- box Finish -->

   </div><!-- #hot Finish -->


  <div id="content" class="container"><!-- container Begin -->

       <div class="row"><!-- row Begin -->

          <?php

           getPro();

           ?>

       </div><!-- row Finish -->

   </div><!-- container Finish -->

   <?php

    include("footer.php");

    ?>

<?php

    $active='Account';
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
                       Register
                   </li>
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->


           <div class="col-md-1">

           </div>
    <div class="col-md-6"><!-- col-md-9 Begin -->

     <?php

         if(!isset($_SESSION['email'])){

             include("customer/customer_login.php");

         }else{

             include("payment_options.php");

         }

     ?>

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

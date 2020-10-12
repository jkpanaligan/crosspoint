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

           <div class="col-md-3"><!-- col-md-3 Begin -->

   <?php

    include("leftbar.php");

    ?>

  </div><!-- col-md-3 Finish -->

         <div class="col-md-9"><!-- col-md-9 Begin -->

             <div class="box"><!-- box Begin -->

                 <div class="box-header"><!-- box-header Begin -->

                     <center><!-- center Begin -->

                         <h2> Register a new account </h2>

                     </center><!-- center Finish -->

                     <form action="customer_register.php" method="post" enctype="multipart/form-data"><!-- form Begin -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>Company Name</label>

                             <input type="text" class="form-control" name="company" required>

                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>City</label>

                             <input type="text" class="form-control" name="city" required>

                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>Barangay</label>

                             <input type="text" class="form-control" name="barangay" required>

                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>Street</label>

                             <input type="text" class="form-control" name="street" required>

                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>Contact Number</label>

                             <input type="text" class="form-control" name="contact" required>

                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>TIN</label>

                             <input type="text" class="form-control" name="tin" required>

                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>Email</label>

                             <input type="text" class="form-control" name="email" required>

                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>Password</label>

                             <input type="password" class="form-control" name="pass" required>

                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>Your Profile Picture</label>

                             <input type="file" class="form-control form-height-custom" name="image" required>

                         </div><!-- form-group Finish -->

                         <div class="text-center"><!-- text-center Begin -->

                             <button type="submit" name="register" class="btn btn-primary">

                             <i class="fa fa-user-md"></i> Register

                             </button>

                         </div><!-- text-center Finish -->

                     </form><!-- form Finish -->

                 </div><!-- box-header Finish -->

             </div><!-- box Finish -->

         </div><!-- col-md-9 Finish -->

     </div><!-- container Finish -->
 </div><!-- #content Finish -->

 <?php

  include("footer.php");

  ?>

</body>
</html>


<?php

if(isset($_POST['register'])){

  $company = $_POST['company'];

  $city = $_POST['city'];

  $barangay = $_POST['barangay'];

  $street = $_POST['street'];

  $contact = $_POST['contact'];

  $tin = $_POST['tin'];

  $email = $_POST['email'];

  $pass = $_POST['pass'];

  $c_image = $_FILES['image']['name'];

  $c_image_tmp = $_FILES['image']['tmp_name'];

  $c_ip = getRealIpUser();

  move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

  $insert_customer = "INSERT into customers (company_name,city,barangay,street,contact,tin,email,pass,image,customer_ip)
                      values ('$company','$city','$barangay','$street','$contact','$tin','$email','$pass','$c_image','$c_ip')";

  $run_customer = mysqli_query($db,$insert_customer);

  $sel_cart = "SELECT * from p_cart where ip_add='$c_ip'";

  $run_cart = mysqli_query($db,$sel_cart);

  $check_cart = mysqli_num_rows($run_cart);

  if($check_cart>0){

      /// If register have items in cart ///

      $_SESSION['email']=$email;

      echo "<script>alert('You have been Registered Sucessfully')</script>";

      echo "<script>window.open('checkout.php','_self')</script>";

  }else{

      /// If register without items in cart ///

      $_SESSION['email']=$email;

      echo "<script>alert('You have been Registered Sucessfully')</script>";

      echo "<script>window.open('index.php','_self')</script>";

  }

}

?>

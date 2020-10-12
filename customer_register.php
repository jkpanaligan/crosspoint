<?php

    $active='Account';
    require_once 'init.php' ;
    include 'head.php';
    include 'navigation.php';

?>

<style>
  .error{
    color:Red;
  }
</style>

<?php
$company = $city =  $barangay = $street = $contact = $tin = $email = $pass = $pass2 = "";
$companyErr = $cityErr =  $barangayErr = $streetErr = $contactErr = $tinErr = $emailErr = $passErr = $pass2Err = $verificationErr = "";

if(isset($_POST['register'])){

  $secretKey = "6LeKyLwUAAAAAIGpeEbD5u3143SIZ4lLT4mqtwU7";
  $responseKey = $_POST['g-recaptcha-response'];
  $userIP = $_SERVER['REMOTE_ADDR'];

  $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
  $response = file_get_contents($url);
  $response = json_decode($response);
  if($response->success){
    echo "";
  }else{
    $verificationErr = " Verification failed!";
  }

    if(empty($_POST['company'])){
      $companyErr = " Company Name is required!";
    }else{
      $company = $_POST['company'];
    }

    if(empty($_POST['city'])){
      $cityErr = " City/Municipality is required!";
    }else{
      $city = $_POST['city'];
    }

    if(empty($_POST['barangay'])){
      $barangayErr = " Barangay is required!";
    }else{
      $barangay = $_POST['barangay'];
    }

    if(empty($_POST['street'])){
      $streetErr = " Street is required!";
    }else{
      $street = $_POST['street'];
    }

    if(empty($_POST['contact'])){
      $contactErr = " Contact is required!";
    }else{
      $contact = $_POST['contact'];
    }

    if(empty($_POST['tin'])){
      $tinErr = " TIN is required!";
    }else{
      $tin = $_POST['tin'];
    }

    if(empty($_POST['email'])){
      $emailErr = " Email is required!";
    }else{
      $email = $_POST['email'];
    }

    if(empty($_POST['pass'])){
      $passErr = " Password is required!";
    }else{
      $pass = $_POST['pass'];
    }

    if(empty($_POST['pass2'])){
      $pass2Err = " Confirm Password is required!";
    }else{
      $pass2 = $_POST['pass2'];
    }

    if($pass != $pass2){
      $pass2Err = "Invalid Confirm Password!";
    }

    if($email && $contact && $tin){
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "Invalid email format.";
      }

      $sel_c = "SELECT * FROM customers where email = '$email'";
      $run = mysqli_query($db, $sel_c);
      $check = mysqli_num_rows($run);

      if($check!=0){
          $emailErr = "Email is already taken.";
      }

      $check_contact = strlen($contact);
      if($check_contact < 11){
        $contactErr = "Invalid Contact Number format.";
      }

      $check_tin = strlen($tin);
      if($check_tin < 12){
        $tinErr = "Invalid TIN format.";
      }

    }

  if(empty($companyErr) && empty($cityErr) &&  empty($barangayErr) && empty($streetErr) && empty($contactErr) && empty($tinErr) && empty($emailErr) && empty($passErr) && empty($pass2Err)  && empty($verificationErr)){
    $company = $_POST['company'];

    $city = $_POST['city'];

    $barangay = $_POST['barangay'];

    $street = $_POST['street'];

    $contact = $_POST['contact'];

    $tin = $_POST['tin'];

    $email = $_POST['email'];

    $pass = $_POST['pass'];

    $pass2 = $_POST['pass2'];

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


}

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

             <div class="box"><!-- box Begin -->

                 <div class="box-header"><!-- box-header Begin -->

                     <center><!-- center Begin -->

                         <h2> Register a new account </h2>

                     </center><!-- center Finish -->

                     <form action="customer_register.php" method="post" enctype="multipart/form-data"><!-- form Begin -->

                         <div class="form-group"><!-- form-group Begin -->

                             <input value="<?php echo $company; ?>" maxlength="30" type="text" class="form-control" name="company" placeholder="Company Name*">
                             <span class="error"><?php echo $companyErr; ?></span>
                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <!--<select name="city" class="form-control">
                              <option name="city" value="">Select City/Municipality</option>
                              <option name="city" <?php if($city == "Caloocan"){ echo "selected";} ?> value="Caloocan">Caloocan</option>
                              <option name="city" <?php if($city == "Malabon"){ echo "selected";} ?> value="Malabon">Malabon</option>
                              <option name="city" <?php if($city == "Navotas"){ echo "selected";} ?> value="Navotas">Navotas</option>
                              <option name="city" <?php if($city == "Valenzuela"){ echo "selected";} ?> value="Valenzuela">Valenzuela</option>
                              <option name="city" <?php if($city == "Quezon City"){ echo "selected";} ?> value="Quezon City">Quezon City</option>
                              <option name="city" <?php if($city == "Marikina"){ echo "selected";} ?> value="Marikina">Marikina</option>
                              <option name="city" <?php if($city == "Pasig"){ echo "selected";} ?> value="Pasig">Pasig</option>
                              <option name="city" <?php if($city == "Taguig"){ echo "selected";} ?> value="Taguig">Taguig</option>
                              <option name="city" <?php if($city == "Makati"){ echo "selected";} ?> value="Makati">Makati</option>
                              <option name="city" <?php if($city == "Manila"){ echo "selected";} ?> value="Manila">Manila</option>
                              <option name="city" <?php if($city == "Mandaluyong"){ echo "selected";} ?> value="Mandaluyong">Mandaluyong</option>
                              <option name="city" <?php if($city == "San Juan"){ echo "selected";} ?> value="San Juan">San Juan</option>
                              <option name="city" <?php if($city == "Pasay"){ echo "selected";} ?> value="Pasay">Pasay</option>
                              <option name="city" <?php if($city == "Paranaque"){ echo "selected";} ?> value="Paranaque">Paranaque</option>
                              <option name="city" <?php if($city == "Las Pinas"){ echo "selected";} ?> value="Las Pinas">Las Pinas</option>
                              <option name="city" <?php if($city == "Muntilupa"){ echo "selected";} ?> value="Muntilupa">Muntilupa</option>
                              <option name="city" <?php if($city == "Pateros"){ echo "selected";} ?> value="Pateros">Pateros</option>
                            </select> -->

                            <input value="<?php echo $city; ?>" maxlength="30" type="text" class="form-control" name="city" placeholder="City/Municipality*">
                            <span class="error"><?php echo $cityErr; ?></span>
                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <input value="<?php echo $barangay; ?>" maxlength="30" type="text" class="form-control" name="barangay" placeholder="Barangay*">
                             <span class="error"><?php echo $barangayErr; ?></span>
                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <input value="<?php echo $street; ?>" maxlength="30" type="text" class="form-control" name="street" placeholder="Street*">
                             <span class="error"><?php echo $streetErr; ?></span>
                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <input value="<?php echo $contact; ?>" maxlength="11" onkeypress="isInputNumber(event)" type="tel" class="form-control" name="contact" placeholder="Contact Number*">
                             <span class="error"><?php echo $contactErr; ?></span>
                         </div><!-- form-group Finish -->

                         <script>
                          function isInputNumber(evt){
                            var ch = String.fromCharCode(evt.which);
                            if(!(/[0-9]/.test(ch))){
                              evt.preventDefault();
                            }
                          }
                        </script>

                         <div class="form-group"><!-- form-group Begin -->

                             <input value="<?php echo $tin; ?>" maxlength="12" onkeypress="isInputNumber(event)" type="tel" class="form-control" name="tin" placeholder="TIN*">
                             <span class="error"><?php echo $tinErr; ?></span>
                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <input value="<?php echo $email; ?>" type="text" class="form-control" name="email" placeholder="Email*">
                             <span class="error"><?php echo $emailErr; ?></span>
                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <input value="<?php echo $pass; ?>" type="password" class="form-control" name="pass" placeholder="Password*">
                             <span class="error"><?php echo $passErr; ?></span>
                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <input value="<?php echo $pass2; ?>" type="password" class="form-control" name="pass2" placeholder="Confirm Password*">
                             <span class="error"><?php echo $pass2Err; ?></span>
                         </div><!-- form-group Finish -->

                         <div class="form-group"><!-- form-group Begin -->

                             <label>Your Profile Picture (Optional)</label>

                             <input value="<?php echo $image; ?>" type="file" class="form-control form-height-custom" name="image">
                         </div><!-- form-group Finish -->

                         <div class="form-group">
                           <div class="g-recaptcha" data-sitekey="6LeKyLwUAAAAAH4umakpcejJGwhn4zizoBxMwD6L" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                            <span class="error"><?php echo $verificationErr; ?></span>
                         </div>

                         <div class="text-center"><!-- text-center Begin -->

                             <button type="submit" name="register" class="btn btn-primary">

                             <i class="fa fa-user-md"></i> Register

                             </button>

                         </div><!-- text-center Finish -->

                     </form><!-- form Finish -->

                     <script src="https://www.google.com/recaptcha/api.js"></script>

                 </div><!-- box-header Finish -->

             </div><!-- box Finish -->

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

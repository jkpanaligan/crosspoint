<div class="box"><!-- box Begin -->

  <div class="box-header"><!-- box-header Begin -->

      <center><!-- center Begin -->

          <h1> Login </h1>

          <p class="lead"> Already have our account..? </p>

      </center><!-- center Finish -->

  </div><!-- box-header Finish -->

  <form method="post" action="checkout.php"><!-- form Begin -->

      <div class="form-group"><!-- form-group Begin -->

          <label> Email </label>

          <input name="email" type="text" class="form-control" required>

      </div><!-- form-group Finish -->

       <div class="form-group"><!-- form-group Begin -->

          <label> Password </label>

          <input name="pass" type="password" class="form-control" required>

      </div><!-- form-group Finish -->

      <div class="text-center"><!-- text-center Begin -->

          <button name="login" value="Login" class="btn btn-primary">

              <i class="fa fa-sign-in"></i> Login

          </button>

      </div><!-- text-center Finish -->

  </form><!-- form Finish -->

  <center><!-- center Begin -->

     <a href="customer_register.php">

         <h3> Dont have account..? Register here </h3>

     </a>

  </center><!-- center Finish -->

</div><!-- box Finish -->


<?php

if(isset($_POST['login'])){

    $customer_email = $_POST['email'];

    $customer_pass = $_POST['pass'];

    $select_customer = "select * from customers where email='$customer_email' AND pass='$customer_pass'";

    $run_customer = mysqli_query($db,$select_customer);

    $get_ip = getRealIpUser();

    $check_customer = mysqli_num_rows($run_customer);

    $select_cart = "select * from p_cart where ip_add='$get_ip'";

    $run_cart = mysqli_query($db,$select_cart);

    $check_cart = mysqli_num_rows($run_cart);

    if($check_customer==0){

        echo "<script>alert('Your email or password is wrong')</script>";

        exit();

    }

    if($check_customer==1 AND $check_cart==0){

        $_SESSION['email']=$customer_email;

       echo "<script>alert('You are Logged in')</script>";

       echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";

    }else{

        $_SESSION['email']=$customer_email;

       echo "<script>alert('You are Logged in')</script>";

       echo "<script>window.open('checkout.php','_self')</script>";

    }

}

?>

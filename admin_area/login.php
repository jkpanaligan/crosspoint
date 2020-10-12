<?php
  require_once '../init.php' ;

  include 'head.php';
?>

<div class="container"><!-- container begin -->
       <form action="" class="form-login" method="post"><!-- form-login begin -->
           <h2 class="form-login-heading"> User Login </h2>

           <input type="text" class="form-control" placeholder="Email Address" name="email" required>

           <input type="password" class="form-control" placeholder="Your Password" name="pass" required>

           <button type="submit" class="btn btn-lg btn-primary btn-block" name="admin_login"><!-- btn btn-lg btn-primary btn-block begin -->

               Login

           </button><!-- btn btn-lg btn-primary btn-block finish -->

       </form><!-- form-login finish -->
   </div><!-- container finish -->

</body>
</html>


<?php

    if(isset($_POST['admin_login'])){

        $email = mysqli_real_escape_string($db,$_POST['email']);

        $pass = mysqli_real_escape_string($db,$_POST['pass']);

        $get_admin = "SELECT * from users where email='$email' AND pass='$pass'";

        $run_admin = mysqli_query($db,$get_admin);

        $count = mysqli_num_rows($run_admin);

        if($count==1){

            $_SESSION['email']=$email;

            echo "<script>alert('Logged in. Welcome Back')</script>";

            echo "<script>window.open('index.php?dashboard','_self')</script>";

        }else{

            echo "<script>alert('Email or Password is Wrong !')</script>";

        }

    }

?>

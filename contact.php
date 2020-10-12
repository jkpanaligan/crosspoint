<?php

    $active='Contact';
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

$sender_name = $sender_email = $sender_subject = $sender_message = "";
$sender_nameErr = $sender_emailErr = $sender_subjectErr = $sender_messageErr = $verificationErr = "";

if(isset($_POST['submit'])){

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

  if(empty($_POST['name'])){
    $sender_nameErr = " Name is required!";
  }else{
    $sender_name = $_POST['name'];
  }

  if(empty($_POST['email'])){
    $sender_emailErr = " Email is required!";
  }else{
    $sender_email = $_POST['email'];
  }

  if(empty($_POST['subject'])){
    $sender_subjectErr = " Subject is required!";
  }else{
    $sender_subject = $_POST['subject'];
  }

  if(empty($_POST['message'])){
    $sender_messageErr = " Message is required!";
  }else{
    $sender_message = $_POST['message'];
  }

  if($sender_email){
    if(!filter_var($sender_email, FILTER_VALIDATE_EMAIL)){
      $sender_emailErr = "Invalid email format.";
    }

  }

  if(empty($sender_nameErr) && empty($sender_emailErr) && empty($sender_subjectErr) && empty($sender_messageErr) && empty($verificationErr))
  {
    /// Admin receives message with this ///

    $sender_name = $_POST['name'];

    $sender_email = $_POST['email'];

    $sender_subject = $_POST['subject'];

    $sender_message = $_POST['message'];

    $receiver_email = "johnkennethpanaligan12@gmail.com";

    mail($receiver_email,$sender_name,$sender_subject,$sender_message,$sender_email);

    /// Auto reply to sender with this ///

    $email = $_POST['email'];

    $subject = "Welcome to my website";

    $msg = "Thanks for sending us message. ASAP we will reply your message";

    $from = "johnkennethpanaligan12@gmail.com";

    mail($email,$subject,$msg,$from);

    echo "<h3 align='center'> Your message has sent sucessfully </h3>";
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
                       Contact Us
                   </li>
               </ul><!-- breadcrumb Finish -->

           </div><!-- col-md-12 Finish -->

           <div class="col-md-1">

           </div>

           <div class="col-md-6"><!-- col-md-9 Begin -->

               <div class="box"><!-- box Begin -->

                   <div class="box-header"><!-- box-header Begin -->

                       <center><!-- center Begin -->

                           <h2> Feel free to Contact Us</h2>

                           <p class="text-muted"><!-- text-muted Begin -->

                               If you have any questions, feel free to contact us. Our Customer Service work <strong>24/7</strong>

                           </p><!-- text-muted Finish -->

                       </center><!-- center Finish -->

                       <form action="contact.php" method="post"><!-- form Begin -->

                           <div class="form-group"><!-- form-group Begin -->

                               <input maxlength="30" onkeypress="lettersOnly1(event)" value="<?php echo $sender_name; ?>" placeholder="Name" type="text" class="form-control" name="name">
                               <span class="error"><?php echo $sender_nameErr; ?></span>
                           </div><!-- form-group Finish -->

                           <script>

                            function lettersOnly1(evt1){
                              var ch = String.fromCharCode(evt1.which);
                              if(!(/[a-z]|[ ]|[A-Z]/.test(ch))){
                                evt1.preventDefault();
                              }
                            }

                          </script>

                           <div class="form-group"><!-- form-group Begin -->

                               <input value="<?php echo $sender_email; ?>" placeholder="Email" type="text" class="form-control" name="email">
                               <span class="error"><?php echo $sender_emailErr; ?></span>
                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <input value="<?php echo $sender_subject; ?>" placeholder="Subject" type="text" class="form-control" name="subject">
                               <span class="error"><?php echo $sender_subjectErr; ?></span>
                           </div><!-- form-group Finish -->

                           <div class="form-group"><!-- form-group Begin -->

                               <input value="<?php echo $sender_message; ?>" placeholder="Message" name="message" class="form-control">
                               <span class="error"><?php echo $sender_messageErr; ?></span>
                           </div><!-- form-group Finish -->

                           <div class="form-group">
                             <div class="g-recaptcha" data-sitekey="6LeKyLwUAAAAAH4umakpcejJGwhn4zizoBxMwD6L" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                              <span class="error"><?php echo $verificationErr; ?></span>
                           </div>
                           <br>

                           <div class="text-center"><!-- text-center Begin -->

                               <button type="submit" name="submit" class="btn btn-primary">

                               <i class="fa fa-user-md"></i> Send Message

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

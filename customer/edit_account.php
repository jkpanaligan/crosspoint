<?php

$customer_session = $_SESSION['email'];

$get_customer = "SELECT * from customers where email='$customer_session'";

$run_customer = mysqli_query($db,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$id = $row_customer['id'];

$company_name = $row_customer['company_name'];

$city = $row_customer['city'];

$barangay = $row_customer['barangay'];

$street = $row_customer['street'];

$contact = $row_customer['contact'];

$tin = $row_customer['tin'];

$email = $row_customer['email'];

$image = $row_customer['image'];

?>

<h1 align="center"> Edit Your Account </h1>

<form action="" method="post" enctype="multipart/form-data"><!-- form Begin -->

    <div class="form-group"><!-- form-group Begin -->

        <label> Company Name: </label>

        <input type="text" name="company_name" class="form-control" value="<?php echo $company_name; ?>" required>

    </div><!-- form-group Finish -->

    <div class="form-group"><!-- form-group Begin -->

        <label> City: </label>

        <input type="text" name="city" class="form-control" value="<?php echo $city; ?>" required>

    </div><!-- form-group Finish -->

    <div class="form-group"><!-- form-group Begin -->

        <label> Barangay: </label>

        <input type="text" name="barangay" class="form-control" value="<?php echo $barangay; ?>" required>

    </div><!-- form-group Finish -->

    <div class="form-group"><!-- form-group Begin -->

        <label> Street: </label>

        <input type="text" name="street" class="form-control" value="<?php echo $street; ?>" required>

    </div><!-- form-group Finish -->

    <div class="form-group"><!-- form-group Begin -->

        <label> Contact Number: </label>

        <input type="text" name="contact" class="form-control" value="<?php echo $contact; ?>" required>

    </div><!-- form-group Finish -->

    <div class="form-group"><!-- form-group Begin -->

        <label> TIN: </label>

        <input type="text" name="tin" class="form-control" value="<?php echo $tin; ?>" required>

    </div><!-- form-group Finish -->

    <div class="form-group"><!-- form-group Begin -->

        <label> Email: </label>

        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" required>

    </div><!-- form-group Finish -->

    <div class="form-group"><!-- form-group Begin -->

        <label> Image: </label>

        <input type="file" name="image" class="form-control form-height-custom" required>

        <img class="img-responsive" src="customer_images/<?php echo $image; ?>" alt="Costumer Image" required>

    </div><!-- form-group Finish -->

    <div class="text-center"><!-- text-center Begin -->

        <button name="update" class="btn btn-primary"><!-- btn btn-primary Begin -->

            <i class="fa fa-user-md"></i> Update Now

        </button><!-- btn btn-primary inish -->

    </div><!-- text-center Finish -->

</form><!-- form Finish -->

<?php

if(isset($_POST['update'])){

    $update_id = $id;

    $company_name = $_POST['company_name'];

    $city = $_POST['city'];

    $barangay = $_POST['barangay'];

    $street = $_POST['street'];

    $contact = $_POST['contact'];

    $tin = $_POST['tin'];

    $email = $_POST['email'];

    $image = $_FILES['image']['name'];

    $image_tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file ($image_tmp,"customer_images/$image");

    $update_customer = "UPDATE customers set company_name='$company_name',city='$city',barangay='$barangay',street='$street',contact='$contact',tin='$tin',email='$email',image='$image' where id='$update_id' ";

    $run_customer = mysqli_query($db,$update_customer);

    if($run_customer){

        echo "<script>alert('Your account has been edited, to complete the process, please Relogin')</script>";

        echo "<script>window.open('logout.php','_self')</script>";

    }

}

?>

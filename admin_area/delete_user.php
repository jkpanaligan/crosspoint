<?php

    if(!isset($_SESSION['email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

?>

<?php

    if(isset($_GET['delete_user'])){

        $delete_user_id = $_GET['delete_user'];

        $delete_user = "DELETE from users where id='$delete_user_id'";

        $run_delete = mysqli_query($db,$delete_user);

        if($run_delete){

            echo "<script>alert('One of User has been Deleted')</script>";

            echo "<script>window.open('index.php?view_users','_self')</script>";

        }

    }

?>

<?php } ?>

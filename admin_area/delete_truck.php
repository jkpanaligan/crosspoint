<?php

    if(!isset($_SESSION['email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

?>

<?php

    if(isset($_GET['delete_truck'])){

        $delete_truck_id = $_GET['delete_truck'];

        $delete_truck = "DELETE from trucks where id='$delete_truck_id'";

        $run_delete = mysqli_query($db,$delete_truck);

        if($run_delete){

            echo "<script>alert('One of truck has been Deleted')</script>";

            echo "<script>window.open('index.php?view_trucks','_self')</script>";

        }

    }

?>

<?php } ?>

<?php

    if(isset($_GET['delete_customer'])){

        $delete_id = $_GET['delete_customer'];

        $delete_c = "DELETE from customers where id='$delete_id'";

        $run_delete = mysqli_query($db,$delete_c);

        if($run_delete){

            echo "<script>alert('One of your costumer has been Deleted')</script>";

            echo "<script>window.open('index.php?view_customers','_self')</script>";

        }

    }

?>

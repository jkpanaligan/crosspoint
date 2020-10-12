<?php

    if(!isset($_SESSION['email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

?>

<?php

    if(isset($_GET['delete_supplier'])){

        $delete_supplier_id = $_GET['delete_supplier'];

        $delete_supplier = "DELETE from suppliers where id='$delete_supplier_id'";

        $run_delete = mysqli_query($db,$delete_supplier);

        if($run_delete){

            echo "<script>alert('One of supplier has been Deleted')</script>";

            echo "<script>window.open('index.php?view_suppliers','_self')</script>";

        }

    }

?>

<?php } ?>

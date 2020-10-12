<?php

    if(!isset($_SESSION['email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

?>

<?php

    if(isset($_GET['delete_employee'])){

        $delete_employee_id = $_GET['delete_employee'];

        $delete_employee = "DELETE from employees where id='$delete_employee_id'";

        $run_delete = mysqli_query($db,$delete_employee);

        if($run_delete){

            echo "<script>alert('One of employee has been Deleted')</script>";

            echo "<script>window.open('index.php?view_employee','_self')</script>";

        }

    }

?>

<?php } ?>

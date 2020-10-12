<?php

    if(!isset($_SESSION['email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

?>

<div class="row"><!-- row Begin -->

    <div class="col-lg-12"><!-- col-lg-12 Begin -->

        <ol class="breadcrumb"><!-- breadcrumb Begin -->

            <li class="active"><!-- active Begin -->

                <i class="fa fa-dashboard"></i> Dashboard / Insert User

            </li><!-- active Finish -->

        </ol><!-- breadcrumb Finish -->

    </div><!-- col-lg-12 Finish -->

</div><!-- row Finish -->

<div class="row"><!-- row Begin -->

    <div class="col-lg-12"><!-- col-lg-12 Begin -->

        <div class="panel panel-default"><!-- panel panel-default Begin -->

           <div class="panel-heading"><!-- panel-heading Begin -->

               <h3 class="panel-title"><!-- panel-title Begin -->

                   <i class="fa fa-plus"></i> Insert User
                   <a href="index.php?view_users" class="btn btn-primary"><i class="fa fa-list"></i></a>

               </h3><!-- panel-title Finish -->

           </div> <!-- panel-heading Finish -->

           <div class="panel-body"><!-- panel-body Begin -->

               <form method="post" class="form-horizontal" enctype="multipart/form-data"><!-- form-horizontal Begin -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Employee Name </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select name="employee_id" class="form-control"><!-- form-control Begin -->

                              <option> Select Person </option>

                        <?php

                            $get_emps = "SELECT * from employees";
                            $run_emps = mysqli_query($db,$get_emps);

                            while ($row_emps=mysqli_fetch_array($run_emps)){

                                $id = $row_emps['id'];
                                $firstname = $row_emps['firstname'];
                                $surname = $row_emps['surname'];

                                echo "

                                <option value='$id'> $firstname $surname </option>

                                ";

                            }

                            ?>
                        </select><!-- form-control Finish -->

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> E-mail </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="email" type="text" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Password </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="pass" type="password" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Roles </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select name="roles" id="" class="form-control" required><!-- select Begin -->
                                         <option>Admin</option>
                                         <option>Staff</option>
                                         <option>Accountant</option>
                        </select><!-- select Finish -->

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Status </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select name="status" id="" class="form-control" required><!-- select Begin -->
                                         <option>Active</option>
                                         <option>Archieved</option>
                        </select><!-- select Finish -->

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"></label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="submit" value="Insert User" type="submit" class="btn btn-primary form-control">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

               </form><!-- form-horizontal Finish -->

           </div><!-- panel-body Finish -->

        </div><!-- canel panel-default Finish -->

    </div><!-- col-lg-12 Finish -->

</div><!-- row Finish -->


<?php

if(isset($_POST['submit'])){

    $employee_id = $_POST['employee_id'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $roles = $_POST['roles'];
    $status = $_POST['status'];

    $insert_user = "INSERT into users (employee_id,email,pass,roles,status) values ('$employee_id','$email','$pass','$roles','$status')";

    $run_user = mysqli_query($db,$insert_user);

    if($run_user){

        echo "<script>alert('New User has been inserted sucessfully')</script>";
        echo "<script>window.open('index.php?view_users','_self')</script>";

    }

}

?>


<?php } ?>

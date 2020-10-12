<?php

    if(!isset($_SESSION['email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

?>

<div class="row"><!-- row Begin -->

    <div class="col-lg-12"><!-- col-lg-12 Begin -->

        <ol class="breadcrumb"><!-- breadcrumb Begin -->

            <li class="active"><!-- active Begin -->

                <i class="fa fa-dashboard"></i> Dashboard / Insert Employee

            </li><!-- active Finish -->

        </ol><!-- breadcrumb Finish -->

    </div><!-- col-lg-12 Finish -->

</div><!-- row Finish -->

<div class="row"><!-- row Begin -->

    <div class="col-lg-12"><!-- col-lg-12 Begin -->

        <div class="panel panel-default"><!-- panel panel-default Begin -->

           <div class="panel-heading"><!-- panel-heading Begin -->

               <h3 class="panel-title"><!-- panel-title Begin -->

                   <i class="fa fa-plus"></i> Insert Employee
                   <a href="index.php?view_employee" class="btn btn-primary"><i class="fa fa-list"></i></a>

               </h3><!-- panel-title Finish -->

           </div> <!-- panel-heading Finish -->

           <div class="panel-body"><!-- panel-body Begin -->

               <form method="post" class="form-horizontal" enctype="multipart/form-data"><!-- form-horizontal Begin -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Firstname </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="firstname" type="text" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Surname </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="surname" type="text" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Middlename </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="middlename" type="text" class="form-control">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Alias </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="alias" type="text" class="form-control">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> City </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="city" type="text" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Barangay </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="barangay" type="text" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Street Address </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="street" type="text" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Birthdate </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="birthdate" type="date" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Contact Number </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="contact" type="text" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Position </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select name="position" id="" class="form-control" required><!-- select Begin -->
                                         <option>Manager</option>
                                         <option>Staff</option>
                                         <option>Accountant</option>
                                         <option>Truck Driver</option>
                                         <option>Truck Helpter</option>
                        </select><!-- select Finish -->

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Department </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select name="department" id="" class="form-control" required><!-- select Begin -->
                                         <option>Sales</option>
                                         <option>Accounting</option>
                                         <option>Production</option>
                                         <option>Delivery</option>
                        </select><!-- select Finish -->

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Gender </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select name="gender" id="" class="form-control" required><!-- select Begin -->
                                         <option>Male</option>
                                         <option>Female</option>
                        </select><!-- select Finish -->

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Civil Status </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select name="civil_status" id="" class="form-control" required><!-- select Begin -->
                                         <option>Single</option>
                                         <option>Married</option>
                        </select><!-- select Finish -->

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Religion </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="religion" type="text" class="form-control">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Citizenship </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="citizenship" type="text" class="form-control">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> State </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select name="state" id="" class="form-control" required><!-- select Begin -->
                                         <option>Active</option>
                                         <option>Archieved</option>
                        </select><!-- select Finish -->

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"></label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="submit" value="Create Employee" type="submit" class="btn btn-primary form-control">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

               </form><!-- form-horizontal Finish -->

           </div><!-- panel-body Finish -->

        </div><!-- canel panel-default Finish -->

    </div><!-- col-lg-12 Finish -->

</div><!-- row Finish -->


<?php

if(isset($_POST['submit'])){

    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $middlename = $_POST['middlename'];
    $alias = $_POST['alias'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $street = $_POST['street'];
    $birthdate = $_POST['birthdate'];
    $contact = $_POST['contact'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $gender = $_POST['gender'];
    $civil_status = $_POST['civil_status'];
    $religion = $_POST['religion'];
    $citizenship = $_POST['citizenship'];
    $state = $_POST['state'];

    $insert_employee = "INSERT into employees (firstname,surname,middlename,alias,city,barangay,street_address,birth_date,contact,position,department,gender,civil_status,religion,citizenship,state)
                        values ('$firstname','$surname','$middlename','$alias','$city','$barangay','$street','$birthdate','$contact','$position','$department','$gender','$civil_status','$religion','$citizenship','$state')";

    $run_employee = mysqli_query($db,$insert_employee);

    if($run_employee){

        echo "<script>alert('New Employee has been inserted sucessfully')</script>";
        echo "<script>window.open('index.php?view_employee','_self')</script>";

    }

}

?>


<?php } ?>

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->

                <i class="fa fa-dashboard"></i> Dashboard / Select Customer

            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->

                   <i class="fa fa-tags"></i>  Select Customer

               </h3><!-- panel-title finish -->
            </div><!-- panel-heading finish -->

            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <span id="modal_errors" class="bg-danger"></span>
                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->

                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th> Image </th>
                                <th> ID </th>
                                <th> Customer Name </th>
                                <th> City </th>
                                <th> Barangay </th>
                                <th> Street Address </th>
                                <th> Contact Number </th>
                                <th> TIN </th>
                                <th> E-Mail </th>
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->

                        <tbody><!-- tbody begin -->

                            <?php

                                $i=0;

                                $get_c = "SELECT * from customers";

                                $run_c = mysqli_query($db,$get_c);

                                while($row_c=mysqli_fetch_array($run_c)){

                                    $c_id = $row_c['id'];

                                    $company_name = $row_c['company_name'];

                                    $city = $row_c['city'];

                                    $barangay = $row_c['barangay'];

                                    $street = $row_c['street'];

                                    $contact = $row_c['contact'];

                                    $tin = $row_c['tin'];

                                    $email = $row_c['email'];

                                    $image = $row_c['image'];

                                    $i++;

                            ?>

                            <tr><!-- tr begin -->

                                  <td><a href="new_do.php?id=<?php echo $c_id; ?>"><img src="../customer/customer_images/<?php echo $image; ?>" width="60" height="60"></a></td>
                                  <td><a href="new_do.php?id=<?php echo $c_id; ?>"> <?php echo $c_id; ?></a></td>
                                  <td><a href="new_do.php?id=<?php echo $c_id; ?>"> <?php echo $company_name; ?></a></td>
                                  <td><a href="new_do.php?id=<?php echo $c_id; ?>"> <?php echo $city; ?></a> </td>
                                  <td><a href="new_do.php?id=<?php echo $c_id; ?>"> <?php echo $barangay; ?></a> </td>
                                  <td><a href="new_do.php?id=<?php echo $c_id; ?>"> <?php echo $street; ?></a> </td>
                                  <td><a href="new_do.php?id=<?php echo $c_id; ?>"> <?php echo $contact ?></a> </td>
                                  <td><a href="new_do.php?id=<?php echo $c_id; ?>"> <?php echo $tin ?></a> </td>
                                  <td><a href="new_do.php?id=<?php echo $c_id; ?>"> <?php echo $email; ?></a> </td>

                            </tr><!-- tr finish -->

                            <?php } ?>

                        </tbody><!-- tbody finish -->
                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div><!-- table-responsive finish -->
            </div><!-- panel-body finish -->
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

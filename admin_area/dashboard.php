

<div class="row"><!-- row no: 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <h1 class="page-header"> Dashboard </h1>

        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->

                <i class="fa fa-dashboard"></i> Dashboard

            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->

    </div><!-- col-lg-12 finish -->
</div><!-- row no: 1 finish -->

<div class="row"><!-- row no: 2 begin -->

    <div class="col-lg-3 col-md-6"><!-- col-lg-3 col-md-6 begin -->
        <div class="panel panel-primary"><!-- panel panel-primary begin -->

            <div class="panel-heading"><!-- panel-heading begin -->
                <div class="row"><!-- panel-heading row begin -->
                    <div class="col-xs-3"><!-- col-xs-3 begin -->

                        <i class="fa fa-tasks fa-5x"></i>

                    </div><!-- col-xs-3 finish -->

                    <div class="col-xs-9 text-right"><!-- col-xs-9 text-right begin -->
                        <div class="huge"> <?php echo $count_products; ?> </div>

                        <div> Products </div>

                    </div><!-- col-xs-9 text-right finish -->

                </div><!-- panel-heading row finish -->
            </div><!-- panel-heading finish -->

            <a href="products.php"><!-- a href begin -->
                <div class="panel-footer"><!-- panel-footer begin -->

                    <span class="pull-left"><!-- pull-left begin -->
                        View Details
                    </span><!-- pull-left finish -->

                    <span class="pull-right"><!-- pull-right begin -->
                        <i class="fa fa-arrow-circle-right"></i>
                    </span><!-- pull-right finish -->

                    <div class="clearfix"></div>

                </div><!-- panel-footer finish -->
            </a><!-- a href finish -->

        </div><!-- panel panel-primary finish -->
    </div><!-- col-lg-3 col-md-6 finish -->

    <div class="col-lg-3 col-md-6"><!-- col-lg-3 col-md-6 begin -->
        <div class="panel panel-green"><!-- panel panel-green begin -->

            <div class="panel-heading"><!-- panel-heading begin -->
                <div class="row"><!-- panel-heading row begin -->
                    <div class="col-xs-3"><!-- col-xs-3 begin -->

                        <i class="fa fa-users fa-5x"></i>

                    </div><!-- col-xs-3 finish -->

                    <div class="col-xs-9 text-right"><!-- col-xs-9 text-right begin -->
                        <div class="huge"> <?php echo $count_customers; ?> </div>

                        <div> Customers </div>

                    </div><!-- col-xs-9 text-right finish -->

                </div><!-- panel-heading row finish -->
            </div><!-- panel-heading finish -->

            <a href="index.php?view_customers"><!-- a href begin -->
                <div class="panel-footer"><!-- panel-footer begin -->

                    <span class="pull-left"><!-- pull-left begin -->
                        View Details
                    </span><!-- pull-left finish -->

                    <span class="pull-right"><!-- pull-right begin -->
                        <i class="fa fa-arrow-circle-right"></i>
                    </span><!-- pull-right finish -->

                    <div class="clearfix"></div>

                </div><!-- panel-footer finish -->
            </a><!-- a href finish -->

        </div><!-- panel panel-green finish -->
    </div><!-- col-lg-3 col-md-6 finish -->

    <div class="col-lg-3 col-md-6"><!-- col-lg-3 col-md-6 begin -->
        <div class="panel panel-orange"><!-- panel panel-yellow begin -->

            <div class="panel-heading"><!-- panel-heading begin -->
                <div class="row"><!-- panel-heading row begin -->
                    <div class="col-xs-3"><!-- col-xs-3 begin -->

                        <i class="fa fa-tags fa-5x"></i>

                    </div><!-- col-xs-3 finish -->

                    <div class="col-xs-9 text-right"><!-- col-xs-9 text-right begin -->
                        <div class="huge"> <?php echo $count_p_categories; ?> </div>

                        <div> Product Categories </div>

                    </div><!-- col-xs-9 text-right finish -->

                </div><!-- panel-heading row finish -->
            </div><!-- panel-heading finish -->

            <a href="categories.php"><!-- a href begin -->
                <div class="panel-footer"><!-- panel-footer begin -->

                    <span class="pull-left"><!-- pull-left begin -->
                        View Details
                    </span><!-- pull-left finish -->

                    <span class="pull-right"><!-- pull-right begin -->
                        <i class="fa fa-arrow-circle-right"></i>
                    </span><!-- pull-right finish -->

                    <div class="clearfix"></div>

                </div><!-- panel-footer finish -->
            </a><!-- a href finish -->

        </div><!-- panel panel-yellow finish -->
    </div><!-- col-lg-3 col-md-6 finish -->

    <div class="col-lg-3 col-md-6"><!-- col-lg-3 col-md-6 begin -->
        <div class="panel panel-red"><!-- panel panel-red begin -->

            <div class="panel-heading"><!-- panel-heading begin -->
                <div class="row"><!-- panel-heading row begin -->
                    <div class="col-xs-3"><!-- col-xs-3 begin -->

                        <i class="fa fa-shopping-cart fa-5x"></i>

                    </div><!-- col-xs-3 finish -->

                    <div class="col-xs-9 text-right"><!-- col-xs-9 text-right begin -->
                        <div class="huge"> <?php echo $count_transactions; ?> </div>

                        <div> Orders </div>

                    </div><!-- col-xs-9 text-right finish -->

                </div><!-- panel-heading row finish -->
            </div><!-- panel-heading finish -->

            <a href="index.php?view_orders"><!-- a href begin -->
                <div class="panel-footer"><!-- panel-footer begin -->

                    <span class="pull-left"><!-- pull-left begin -->
                        View Details
                    </span><!-- pull-left finish -->

                    <span class="pull-right"><!-- pull-right begin -->
                        <i class="fa fa-arrow-circle-right"></i>
                    </span><!-- pull-right finish -->

                    <div class="clearfix"></div>

                </div><!-- panel-footer finish -->
            </a><!-- a href finish -->

        </div><!-- panel panel-red finish -->
    </div><!-- col-lg-3 col-md-6 finish -->

</div><!-- row no: 2 finish -->

<div class="row"><!-- row no: 3 begin -->
    <div class="col-lg-8"><!-- col-lg-8 begin -->
        <div class="panel panel-primary"><!-- panel panel-primary begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->

                    <i class="fa fa-money fa-fw"></i> New Orders

                </h3><!-- panel-title finish -->
            </div><!-- panel-heading finish -->

            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-hover table-striped table-bordered"><!-- table table-hover table-striped table-bordered begin -->

                        <thead><!-- thead begin -->

                            <tr><!-- th begin -->

                                <th> No.: </th>
                                <th> Order Date:</th>
                                <th> Transaction No.: </th>
                                <th> Company Name: </th>
                                <th> Sub Total: </th>
                                <th> Tax: </th>
                                <th> Grand Total: </th>

                            </tr><!-- th finish -->

                        </thead><!-- thead finish -->

                        <tbody><!-- tbody begin -->

                          <?php

                              $i=0;

                              $get_orders = "SELECT * from transactions";

                              $run_orders = mysqli_query($db,$get_orders);

                              while($row_order=mysqli_fetch_array($run_orders)){

                                  $txn_date = $row_order['txn_date'];
                                  $id = $row_order['id'];

                                  $c_id = $row_order['customer_id'];
                                  $get_customer = "SELECT * from customers where id='$c_id'";
                                  $run_customer = mysqli_query($db,$get_customer);
                                  $row_customer = mysqli_fetch_array($run_customer);
                                  $company_name = $row_customer['company_name'];

                                  $sub_total = $row_order['sub_total'];
                                  $tax = $row_order['tax'];
                                  $grand_total = $row_order['grand_total'];
                                  $i++;

                          ?>

                          <tr><!-- tr begin -->
                              <td> <?php echo $i; ?> </td>
                              <td> <?php echo $txn_date; ?> </td>
                              <td> <?php echo $id; ?></td>
                              <td> <?php echo $company_name; ?> </td>
                              <td> <?php echo $sub_total; ?> </td>
                              <td> <?php echo $tax; ?></td>
                              <td> <?php echo $grand_total; ?> </td>
                          </tr><!-- tr finish -->

                          <?php } ?>

                        </tbody><!-- tbody finish -->

                    </table><!-- table table-hover table-striped table-bordered finish -->
                </div><!-- table-responsive finish -->

                <div class="text-right"><!-- text-right begin -->

                    <a href="index.php?view_orders"><!-- a href begin -->

                        View All Orders <i class="fa fa-arrow-circle-right"></i>

                    </a><!-- a href finish -->

                </div><!-- text-right finish -->

            </div><!-- panel-body finish -->

        </div><!-- panel panel-primary finish -->
    </div><!-- col-lg-8 finish -->

    <div class="col-md-4"><!-- col-md-4 begin -->
        <div class="panel"><!-- panel begin -->
            <div class="panel-body"><!-- panel-body begin -->

                <div class="mb-md"><!-- mb-md begin -->
                    <div class="widget-content-expanded"><!-- widget-content-expanded begin -->
                        <i class="fa fa-user"></i> <span> Email: </span> <?php echo $email; ?> <br/>
                        <i class="fa fa-flag"></i> <span> Roles: </span> <?php echo $roles; ?> <br/>
                        <i class="fa fa-envelope"></i> <span> Status: </span> <?php echo $status; ?> <br/>
                    </div><!-- widget-content-expanded finish -->

                    <hr class="dotted short">

                </div><!-- mb-md finish -->

            </div><!-- panel-body finish -->
        </div><!-- panel finish -->
    </div><!-- col-md-4 finish -->

</div><!-- row no: 3 finish -->

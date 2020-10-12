
<?php
    $admin_session = $_SESSION['email'];

    $get_admin = "SELECT * from users where email='$admin_session'";

    $run_admin = mysqli_query($db,$get_admin);

    $row_admin = mysqli_fetch_array($run_admin);

    $id = $row_admin['id'];

    $email = $row_admin['email'];

    $roles = $row_admin['roles'];

    $status = $row_admin['status'];

    $get_products = "SELECT * from products";

    $run_products = mysqli_query($db,$get_products);

    $count_products = mysqli_num_rows($run_products);

    $get_customers = "SELECT * from customers";

    $run_customers = mysqli_query($db,$get_customers);

    $count_customers = mysqli_num_rows($run_customers);

    $get_p_categories = "SELECT * from categories";

    $run_p_categories = mysqli_query($db,$get_p_categories);

    $count_p_categories = mysqli_num_rows($run_p_categories);

    $get_transactions = "SELECT * from transactions";

    $run_transactions = mysqli_query($db,$get_transactions);

    $count_transactions = mysqli_num_rows($run_transactions);
?>

<nav class="navbar navbar-inverse navbar-fixed-top"><!-- navbar navbar-inverse navbar-fixed-top begin -->
    <div class="navbar-header"><!-- navbar-header begin -->

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><!-- navbar-toggle begin -->

            <span class="sr-only">Toggle Navigation</span>

            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

        </button><!-- navbar-toggle finish -->

        <a href="index.php?dashboard" class="navbar-brand">Admin Area</a>

    </div><!-- navbar-header finish -->

    <ul class="nav navbar-right top-nav"><!-- nav navbar-right top-nav begin -->

        <li class="dropdown"><!-- dropdown begin -->

            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><!-- dropdown-toggle begin -->

                <i class="fa fa-user"></i> <?php echo $email;  ?> <b class="caret"></b>

            </a><!-- dropdown-toggle finish -->

            <ul class="dropdown-menu"><!-- dropdown-menu begin -->
                <li><!-- li begin -->
                    <a href="index.php?user_profile=<?php echo $id; ?>"><!-- a href begin -->

                        <i class="fa fa-fw fa-user"></i> Profile

                    </a><!-- a href finish -->
                </li><!-- li finish -->

                <li><!-- li begin -->
                    <a href="products.php"><!-- a href begin -->

                        <i class="fa fa-fw fa-envelope"></i> Products

                        <span class="badge"><?php echo $count_products; ?></span>

                    </a><!-- a href finish -->
                </li><!-- li finish -->

                <li><!-- li begin -->
                    <a href="index.php?view_customers"><!-- a href begin -->

                        <i class="fa fa-fw fa-users"></i> Customeres

                        <span class="badge"><?php echo $count_customers; ?></span>

                    </a><!-- a href finish -->
                </li><!-- li finish -->

                <li><!-- li begin -->
                    <a href="categories.php"><!-- a href begin -->

                        <i class="fa fa-fw fa-gear"></i> Product Categories

                        <span class="badge"><?php echo $count_p_categories; ?></span>

                    </a><!-- a href finish -->
                </li><!-- li finish -->

                <li class="divider"></li>

                <li><!-- li begin -->
                    <a href="logout.php"><!-- a href begin -->

                        <i class="fa fa-fw fa-power-off"></i> Log Out

                    </a><!-- a href finish -->
                </li><!-- li finish -->

            </ul><!-- dropdown-menu finish -->

        </li><!-- dropdown finish -->

    </ul><!-- nav navbar-right top-nav finish -->

    <div class="collapse navbar-collapse navbar-ex1-collapse"><!-- collapse navbar-collapse navbar-ex1-collapse begin -->
        <ul class="nav navbar-nav side-nav"><!-- nav navbar-nav side-nav begin -->
            <li><!-- li begin -->
                <a href="index.php?dashboard"><!-- a href begin -->

                        <i class="fa fa-fw fa-dashboard"></i> Dashboard

                </a><!-- a href finish -->

            </li><!-- li finish -->

            <li><!-- li begin -->
                <a href="#" data-toggle="collapse" data-target="#receivables"><!-- a href begin -->

                        <i class="fa fa-fw fa-book"></i> Receivable
                        <i class="fa fa-fw fa-caret-down"></i>

                </a><!-- a href finish -->

                <ul id="receivables" class="collapse"><!-- collapse begin -->
                    <li><!-- li begin -->
                        <a href="index.php?view_orders"> View Delivery Order </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_delivery_receipt"> View Delivery Receipt </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_sales_invoice"> View Sales Invoice </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_collection_receipt"> View Collection Receipt </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_trip_ticket"> View Trip Tickets </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_return_slip"> View Return Slip </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_sales_invoice"> View Credit Memo </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_customers"> View Customers</a><!-- a href finish -->
                    </li><!-- li finish -->
                </ul><!-- collapse finish -->

            </li><!-- li finish -->

            <li><!-- li begin -->
                <a href="#" data-toggle="collapse" data-target="#payables"><!-- a href begin -->

                        <i class="fa fa-fw fa-book"></i> Payable
                        <i class="fa fa-fw fa-caret-down"></i>

                </a><!-- a href finish -->

                <ul id="payables" class="collapse"><!-- collapse begin -->
                    <li><!-- li begin -->
                        <a href="index.php?view_purchase_orders"> View Purchase Order </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_receiving_report"> View Receive Order </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_accounts_payables"> View Accounts Payable </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_check_voucher"> View Check Voucher </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_suppliers"> View Supplier </a>
                    </li><!-- li finish -->
                </ul><!-- collapse finish -->

            </li><!-- li finish -->

            <li><!-- li begin -->
                <a href="#" data-toggle="collapse" data-target="#inventory"><!-- a href begin -->

                        <i class="fa fa-fw fa-book"></i> Inventory
                        <i class="fa fa-fw fa-caret-down"></i>

                </a><!-- a href finish -->

                <ul id="inventory" class="collapse"><!-- collapse begin -->
                    <li><!-- li begin -->
                        <a href="categories.php"> View Category </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="products.php"> View Product </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="archieved.php"> View Archieved Product </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_CrSr"> View Cutting/Sheeting Report </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href=""> View Paper Bag </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_job_order"> View Job Order </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_trucks"> View Truck </a>
                    </li><!-- li finish -->
                </ul><!-- collapse finish -->

            </li><!-- li finish -->

            <li><!-- li begin -->
                <a href="#" data-toggle="collapse" data-target="#settings"><!-- a href begin -->

                        <i class="fa fa-fw fa-gear"></i> Settings
                        <i class="fa fa-fw fa-caret-down"></i>

                </a><!-- a href finish -->

                <ul id="settings" class="collapse"><!-- collapse begin -->
                  <li><!-- li begin -->
                      <a href="index.php?view_employee"> View Employees </a>
                  </li><!-- li finish -->
                  <li><!-- li begin -->
                      <a href="index.php?view_users"> View Users </a>
                  </li><!-- li finish -->
                  <li><!-- li begin -->
                      <a href="index.php?view_slides"> View Slides </a>
                  </li><!-- li finish -->
                </ul><!-- collapse finish -->

            </li><!-- li finish -->

            <li><!-- li begin -->
                <a href="logout.php"><!-- a href begin -->
                    <i class="fa fa-fw fa-power-off"></i> Log Out
                </a><!-- a href finish -->
            </li><!-- li finish -->

        </ul><!-- nav navbar-nav side-nav finish -->
    </div><!-- collapse navbar-collapse navbar-ex1-collapse finish -->
</nav><!-- navbar navbar-inverse navbar-fixed-top finish -->

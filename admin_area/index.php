<?php
  require_once '../init.php' ;

  include 'head.php';

  if(!isset($_SESSION['email'])){

        echo "<script>window.open('login.php','_self')</script>";

    }else{

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

<div id="wrapper"><!-- #wrapper begin -->

        <div id="page-wrapper"><!-- #page-wrapper begin -->

          <?php include("navigation.php"); ?>

            <div class="container-fluid"><!-- container-fluid begin -->

                <?php

                if(isset($_GET['dashboard'])){

                  include("dashboard.php");

                }    if(isset($_GET['insert_slide'])){

                        include("insert_slide.php");

                }   if(isset($_GET['view_slides'])){

                        include("view_slides.php");

                }   if(isset($_GET['delete_slide'])){

                        include("delete_slide.php");

                }   if(isset($_GET['delete_employee'])){

                        include("delete_employee.php");

                }     if(isset($_GET['edit_slide'])){

                        include("edit_slide.php");

                }   if(isset($_GET['edit_employee'])){

                        include("edit_employee.php");

                }     if(isset($_GET['view_customers'])){

                        include("view_customers.php");

                }     if(isset($_GET['view_suppliers'])){

                        include("view_suppliers.php");

                }     if(isset($_GET['new_supplier'])){

                        include("new_supplier.php");

                }     if(isset($_GET['edit_supplier'])){

                        include("edit_supplier.php");

                }     if(isset($_GET['delete_supplier'])){

                        include("delete_supplier.php");

                }     if(isset($_GET['delete_customer'])){

                        include("delete_customer.php");

                }   if(isset($_GET['view_orders'])){

                        include("view_orders.php");

                }     if(isset($_GET['view_sales_invoice'])){

                        include("view_sales_invoice.php");

                }     if(isset($_GET['view_collection_receipt'])){

                        include("view_collection_receipt.php");

                }     if(isset($_GET['view_trip_ticket'])){

                        include("view_trip_ticket.php");

                }     if(isset($_GET['view_receiving_report'])){

                        include("view_receiving_report.php");

                }     if(isset($_GET['view_accounts_payables'])){

                        include("view_accounts_payables.php");

                }     if(isset($_GET['view_CrSr'])){

                        include("view_CrSr.php");

                }     if(isset($_GET['selectcustomer'])){

                        include("selectcustomer.php");

                }     if(isset($_GET['selectcustomer2'])){

                        include("selectcustomer2.php");

                }     if(isset($_GET['select_item'])){

                        include("select_item.php");

                }   if(isset($_GET['selectdo'])){

                        include("selectdo.php");

                }     if(isset($_GET['edit_order'])){

                        include("edit_order.php");

                }     if(isset($_GET['edit_dr'])){

                        include("edit_dr.php");

                }     if(isset($_GET['edit_si'])){

                        include("edit_si.php");

                }     if(isset($_GET['edit_cr'])){

                        include("edit_cr.php");

                }     if(isset($_GET['edit_tt'])){

                        include("edit_tt.php");

                }     if(isset($_GET['edit_rs'])){

                        include("edit_rs.php");

                }      if(isset($_GET['edit_po'])){

                        include("edit_po.php");

                }      if(isset($_GET['edit_rr'])){

                        include("edit_rr.php");

                }       if(isset($_GET['edit_ap'])){

                        include("edit_ap.php");

                }     if(isset($_GET['edit_cv'])){

                        include("edit_cv.php");

                }     if(isset($_GET['edit_truck'])){

                        include("edit_truck.php");

                }      if(isset($_GET['edit_jo'])){

                        include("edit_jo.php");

                }      if(isset($_GET['edit_csr'])){

                        include("edit_csr.php");

                }     if(isset($_GET['delete_truck'])){

                        include("delete_truck.php");

                }     if(isset($_GET['insert_truck'])){

                        include("insert_truck.php");

                }     if(isset($_GET['new_dr2'])){

                        include("new_dr2.php");

                }     if(isset($_GET['new_si'])){

                        include("new_si.php");

                }     if(isset($_GET['new_cr'])){

                        include("new_cr.php");

                }      if(isset($_GET['new_tt'])){

                        include("new_tt.php");

                }    if(isset($_GET['new_rs'])){

                        include("new_rs.php");

                }     if(isset($_GET['new_rr'])){

                        include("new_rr.php");

                }     if(isset($_GET['new_ap'])){

                        include("new_ap.php");

                }       if(isset($_GET['new_cv'])){

                        include("new_cv.php");

                }     if(isset($_GET['new_jo'])){

                        include("new_jo.php");

                }     if(isset($_GET['new_csr'])){

                        include("new_csr.php");

                }     if(isset($_GET['view_purchase_orders'])){

                        include("view_purchase_orders.php");

                }     if(isset($_GET['view_delivery_receipt'])){

                        include("view_delivery_receipt.php");

                }     if(isset($_GET['view_return_slip'])){

                        include("view_return_slip.php");

                }     if(isset($_GET['view_check_voucher'])){

                        include("view_check_voucher.php");

                }     if(isset($_GET['view_trucks'])){

                        include("view_trucks.php");

                }     if(isset($_GET['delete_order'])){

                        include("delete_order.php");

                }   if(isset($_GET['view_payments'])){

                        include("view_payments.php");

                }   if(isset($_GET['delete_payment'])){

                        include("delete_payment.php");

                }   if(isset($_GET['view_users'])){

                        include("view_users.php");

                }     if(isset($_GET['view_employee'])){

                        include("view_employee.php");

                }   if(isset($_GET['view_job_order'])){

                        include("view_job_order.php");

                }     if(isset($_GET['delete_user'])){

                        include("delete_user.php");

                }   if(isset($_GET['insert_user'])){

                        include("insert_user.php");

                }   if(isset($_GET['insert_employee'])){

                        include("insert_employee.php");

                }     if(isset($_GET['user_profile'])){

                        include("user_profile.php");

                }

                ?>

            </div><!-- container-fluid finish -->
        </div><!-- #page-wrapper finish -->
    </div><!-- wrapper finish -->

</body>
</html>

<?php } ?>

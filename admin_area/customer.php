<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';

  include 'head.php';
  include 'navigation.php';

    if(isset($_GET['customer_id'])){

        $customer_id = $_GET['customer_id'];

        $get_customer = "SELECT * from customers where id='$customer_id'";

        $run_customer = mysqli_query($db,$get_customer);

        $row_customer = mysqli_fetch_array($run_customer);

        $image = $row_customer['image'];

        $company_name = $row_customer['company_name'];

        $city = $row_customer['city'];

        $barangay = $row_customer['barangay'];

        $street = $row_customer['street'];

        $contact = $row_customer['contact'];
    }

  ?>


<div id="content"><!-- #content Begin -->
    <div class="container"><!-- container Begin -->
        <div class="col-md-12"><!-- col-md-12 Begin -->

        </div><!-- col-md-12 Finish -->

        <div class="col-md-2"><!-- col-md-3 Begin -->

         </div><!-- col-md-3 Finish -->

         <div class="col-md-10"><!-- col-md-9 Begin -->
           <br>
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
                              <span id="modal_errors" class="bg-danger"></span>
                            <div id="productMain" class="row"><!-- row Begin -->
                              <div class="col-sm-4 fotorama">
                                <?php $photos = explode(',',$row_customer['image']);
                                foreach($photos as $photo): ?>
                                  <img src="../customer/customer_images/<?= $photo ?>" alt="<?= $row_customer['company_name']; ?>" class="details img-responsive">
                              <?php endforeach; ?>
                              </div>

                              <div class="col-sm-8"><!-- col-sm-6 Begin -->

                                  <div class="box"><!-- box Begin -->
                                    <span id="modal_errors" class="bg-danger"></span>
                                    <h4 class="modal-title text-center"><?= $row_customer['company_name']; ?></h4>

                                      <form action="new_do.php" class="form-horizontal" method="post" id="add_product_form"><!-- form-horizontal Begin -->
                                        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>">
                                        <div class="form-group">
                                          <h4>Information</h4>
                                          <hr>
                                          <p>Street Address: <?= $row_customer['street']; ?></p>
                                          <p>Barangay: <?= $row_customer['barangay']; ?></p>
                                          <p>City: <?= $row_customer['city']; ?></p>
                                          <p>Contact Number: <?= $row_customer['contact']; ?></p>
                                        </div>

                                          <div class="form-group"><!-- form-group Begin -->

                                              <div class="col-md-2 pull-right"><!-- col-md-7 Begin -->

                                                      <p class="text-center buttons"><a class="btn btn-default" href="index.php?selectcustomer">Back</a></p>

                                               </div><!-- col-md-7 Finish -->

                                               <div class="col-md-1 pull-right"><!-- col-md-7 Begin -->

                                                        <p class="text-center buttons"><button class="btn btn-primary" onclick="selectcustomer();return false;"> OK</button></p>

                                                </div><!-- col-md-7 Finish -->

                                          </div><!-- form-group Finish -->



                                      </form><!-- form-horizontal Finish -->

                                  </div><!-- box Finish -->

                              </div><!-- col-sm-6 Finish -->
                            </div><!-- row Finish -->
                    </div><!-- panel-body finish -->

                </div><!-- panel panel-default finish -->
            </div><!-- col-lg-12 finish -->
        </div><!-- row 2 finish -->
    </div>
  </div>
</div>

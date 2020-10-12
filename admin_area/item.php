<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';

  include 'head.php';
  include 'navigation.php';

    if(isset($_GET['item_id'])){

        $txn_id = $_GET['edit_order'];

        $item_id = $_GET['item_id'];

        $get_product = "SELECT * from products where id='$item_id'";

        $run_product = mysqli_query($db,$get_product);

        $row_product = mysqli_fetch_array($run_product);

        $image = $row_product['image'];

        $title = $row_product['title'];

        $price = $row_product['price'];

        $unit = $row_product['unit'];

        $per_set = $row_product['per_set'];
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

                <i class="fa fa-dashboard"></i> Dashboard / Select product

            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->

                   <i class="fa fa-tags"></i>  Select Product

               </h3><!-- panel-title finish -->
            </div><!-- panel-heading finish -->

              <div class="panel-body"><!-- panel-body begin -->
                      <span id="modal_errors" class="bg-danger"></span>
                    <div id="productMain" class="row"><!-- row Begin -->
                      <div class="col-sm-4"><!-- col-sm-6 Begin -->
                          <div id="mainImage"><!-- #mainImage Begin -->
                              <div id="myCarousel" class="carousel slide" data-ride="carousel"><!-- carousel slide Begin -->
                                  <div class="carousel-inner">
                                      <div class="item active">
                                          <center><img class="img-responsive" src="<?php echo $image; ?>" alt="Product 1-a"></center>
                                      </div>
                                  </div>
                              </div><!-- carousel slide Finish -->
                          </div><!-- mainImage Finish -->
                      </div><!-- col-sm-6 Finish -->

                      <div class="col-sm-8"><!-- col-sm-6 Begin -->

                          <div class="box"><!-- box Begin -->
                            <span id="modal_errors" class="bg-danger"></span>

                              <form action="add_cart2.php" class="form-horizontal" method="post" id="add_product_form"><!-- form-horizontal Begin -->
                                <input type="hidden" id="product_id" name="product_id" value="<?php echo $item_id; ?>">
                                <input type="text" id="txn_id" name="txn_id" value="<?php echo $txn_id; ?>">
                                <div class="form-group"><!-- form-group Begin -->
                                    <label for="" class="col-md-4 control-label">Item Code:</label>


                                    <div class="col-md-5"><!-- col-md-7 Begin -->

                                            <label id="product_id" name="product_id" value="<?php echo $item_id; ?>" for="" class="col-md-5 control-label"><?php echo $item_id; ?></label>

                                     </div><!-- col-md-7 Finish -->

                                </div><!-- form-group Finish -->

                                  <div class="form-group"><!-- form-group Begin -->
                                      <label for="" class="col-md-4 control-label">Item Description:</label>

                                      <div class="col-md-5"><!-- col-md-7 Begin -->

                                              <label for="" class="col-md-5 control-label"><?php echo $title; ?></label>

                                       </div><!-- col-md-7 Finish -->

                                  </div><!-- form-group Finish -->

                                  <div class="form-group"><!-- form-group Begin -->
                                      <label for="" class="col-md-4 control-label">Price:</label>

                                      <div class="col-md-5"><!-- col-md-7 Begin -->

                                              <label for="" class="col-md-5 control-label"><?php echo $price; ?></label>

                                       </div><!-- col-md-7 Finish -->

                                  </div><!-- form-group Finish -->

                                  <div class="form-group"><!-- form-group Begin -->
                                      <label for="" class="col-md-4 control-label">Unit:</label>

                                      <div class="col-md-5"><!-- col-md-7 Begin -->

                                              <label for="" class="col-md-5 control-label"><?php echo $unit; ?></label>

                                       </div><!-- col-md-7 Finish -->

                                  </div><!-- form-group Finish -->

                                  <div class="form-group"><!-- form-group Begin -->
                                      <label for="" class="col-md-4 control-label">Per Set:</label>

                                      <div class="col-md-5"><!-- col-md-7 Begin -->

                                              <label for="" class="col-md-5 control-label"><?php echo $per_set; ?></label>

                                       </div><!-- col-md-7 Finish -->

                                  </div><!-- form-group Finish -->

                                  <div class="form-group"><!-- form-group Begin -->
                                      <label for="" class="col-md-5 control-label">Products Quantity</label>

                                      <div class="col-md-7"><!-- col-md-7 Begin -->

                                              <input type="number" class="form-control" id="quantity" name="quantity" min="0">

                                       </div><!-- col-md-7 Finish -->

                                  </div><!-- form-group Finish -->

                                  <div class="form-group"><!-- form-group Begin -->
                                      <label for="" class="col-md-4 control-label"></label>

                                      <div class="col-md-6"><!-- col-md-7 Begin -->

                                       </div><!-- col-md-7 Finish -->

                                  </div><!-- form-group Finish -->

                                  <div class="form-group"><!-- form-group Begin -->

                                           <div class="col-md-2 pull-right"><!-- col-md-7 Begin -->

                                                  <p class="text-center buttons"><button class="btn btn-primary" onclick="add_to_cart2();return false;"> OK</button></p>

                                            </div><!-- col-md-7 Finish -->

                                            <div class="col-md-2 pull-right"><!-- col-md-7 Begin -->

                                              <?php if($_GET['dr'] == '1'): ?>
                                                <p class="text-center buttons"><a class="btn btn-primary" href="index.php?select_item=<?php echo $txn_id; ?>&dr=1"><<< Back</a></p>
                                              <?php else: ?>
                                                <p class="text-center buttons"><a class="btn btn-primary" href="index.php?select_item=<?php echo $txn_id; ?>&dr=0"><<< Back</a></p>
                                              <?php endif; ?>


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
<script>
function add_to_cart2(){
    jQuery('#modal_errors').html("");
    var quantity = jQuery('#quantity').val();
    var error = '';
    var data = jQuery('#add_product_form').serialize();
    if(quantity == '' || quantity == 0){
      error += '<p class="text-danger text-center">You must enter a quantity.</p>';
      jQuery('#modal_errors').html(error);
      return;
    }else{
      jQuery.ajax({
        url : '/crosspointpaper/admin_area/add_cart2.php',
        method : 'post',
        data : data,
        success : function(){
          window.open('index.php?edit_order=<?php echo $txn_id;?>','_self');
        },
        error : function(){alert("Something went wrong");}
      });
    }
  }
  </script>

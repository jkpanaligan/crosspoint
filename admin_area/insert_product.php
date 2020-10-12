<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';

  include 'head.php';
  include 'navigation.php';

  $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
  $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
  $category = ((isset($_POST['child'])) && !empty($_POST['child'])?sanitize($_POST['child']):'');
  ?>

  <div id="content"><!-- #content Begin -->
      <div class="container"><!-- container Begin -->
          <div class="col-md-12"><!-- col-md-12 Begin -->

          </div><!-- col-md-12 Finish -->

          <div class="col-md-1"><!-- col-md-3 Begin -->

           </div><!-- col-md-3 Finish -->

           <div class="col-md-11"><!-- col-md-9 Begin -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Insert Products </title>
</head>
<body>
<br>
<div class="row"><!-- row Begin -->

    <div class="col-lg-12"><!-- col-lg-12 Begin -->

        <ol class="breadcrumb"><!-- breadcrumb Begin -->

            <li class="active"><!-- active Begin -->

                <i class="fa fa-dashboard"></i> Dashboard / Insert Products

            </li><!-- active Finish -->

        </ol><!-- breadcrumb Finish -->

    </div><!-- col-lg-12 Finish -->

</div><!-- row Finish -->

<div class="row"><!-- row Begin -->

    <div class="col-lg-12"><!-- col-lg-12 Begin -->

        <div class="panel panel-default"><!-- panel panel-default Begin -->

           <div class="panel-heading"><!-- panel-heading Begin -->

               <h3 class="panel-title"><!-- panel-title Begin -->

                   <i class="fa fa-money fa-fw"></i> Insert Product

               </h3><!-- panel-title Finish -->

           </div> <!-- panel-heading Finish -->

           <div class="panel-body"><!-- panel-body Begin -->

               <form method="post" class="form-horizontal" enctype="multipart/form-data"><!-- form-horizontal Begin -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Title </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="title" type="text" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label for="parent" class="col-md-3 control-label"> Parent Category </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select class="form-control" id="parent" name="parent">
                          <option value=""<?=(($parent == '')?' selected':'');?>></option>
                          <?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
                            <option value="<?=$p['id'];?>"<?=(($parent == $p['id'])?' selected':'');?>><?=$p['category'];?></option>
                          <?php endwhile; ?>
                        </select>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Child Category </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                        <select id="child" name="child" class="form-control">
                        </select>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Price</label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="price" type="text" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Unit </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="unit" type="text" class="form-control">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->
                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Per Set </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="per_set" type="text" class="form-control">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Current Quantity </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="current_quantity" type="text" class="form-control form-height-custom">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Product Image </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="product_img" type="file" class="form-control" required>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Product Desc </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <textarea name="description" cols="19" rows="6" class="form-control"></textarea>

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"></label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="submit" value="Insert Product" type="submit" class="btn btn-primary form-control">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

               </form><!-- form-horizontal Finish -->

           </div><!-- panel-body Finish -->

        </div><!-- canel panel-default Finish -->

    </div><!-- col-lg-12 Finish -->

</div><!-- row Finish -->

    <script src="js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea'});</script>
</body>
</html>


<?php

if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $category = $_POST['child'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $per_set = $_POST['per_set'];
    $current_quantity = $_POST['current_quantity'];
    $description = $_POST['description'];

    $product_img = $_FILES['product_img']['name'];

    $temp_name = $_FILES['product_img']['tmp_name'];

    move_uploaded_file($temp_name,"product_images/$product_img");

    $insert_product = "insert into products (title,category,price,unit,per_set,current_quantity,image,description)
                                  values ('$title','$category','$price','$unit','$per_set','$current_quantity','$product_img','$description')";

    $run_product = mysqli_query($db,$insert_product);

    if($run_product){

        echo "<script>alert('Product has been inserted sucessfully')</script>";
        echo "<script>window.open('products.php','_self')</script>";

    }

}


?>
</div><!-- col-md-9 Finish -->
</div><!-- container Finish -->
</div><!-- #content Finish -->
<?php include 'footer.php'; ?>
<script>
  jQuery('document').ready(function(){
    get_child_options('<?=$category;?>');
  });
</script>

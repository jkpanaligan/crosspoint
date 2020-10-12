<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';

  include 'head.php';
  include 'navigation.php';

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

                               <i class="fa fa-dashboard"></i> Dashboard / Products

                           </li><!-- active finish -->
                       </ol><!-- breadcrumb finish -->
                   </div><!-- col-lg-12 finish -->
               </div><!-- row 1 finish -->

    <?php

//Delete Product
  if(isset($_GET['delete'])){
    $id = sanitize($_GET['delete']);
    $db->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
    echo "<script>window.open('products.php','_self')</script>";
  }

  $dbpath = '';
  if(isset($_GET['add']) || isset($_GET['edit'])){
  $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
  $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
  $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
  $category = ((isset($_POST['child'])) && !empty($_POST['child'])?sanitize($_POST['child']):'');
  $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
  $unit = ((isset($_POST['unit']) && $_POST['unit'] != '')?sanitize($_POST['unit']):'');
  $per_set = ((isset($_POST['per_set']) && $_POST['per_set'] != '')?sanitize($_POST['per_set']):'');
  $quantity = ((isset($_POST['quantity']) && $_POST['quantity'] != '')?sanitize($_POST['quantity']):'');
  $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
  $purchase = ((isset($_POST['purchase']) && $_POST['purchase'] != '')?sanitize($_POST['purchase']):'');
  $saved_image = '';

    if(isset($_GET['edit'])){
      $edit_id = (int)$_GET['edit'];
      $productResults = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
      $product = mysqli_fetch_assoc($productResults);
      if(isset($_GET['delete_image'])){
        $imgi = (int)$_GET['imgi'] - 1;
        $images = explode(',',$product['image']);
        $image_url = $_SERVER['DOCUMENT_ROOT'].$images[$imgi];
        unlink($image_url);
        unset($images[$imgi]);
        $imageString = implode(',',$images);
        $db->query("UPDATE products SET image = '{$imageString}' WHERE id = '$edit_id'");
        echo "<script>window.open('products.php?edit='.$edit_id','_self')</script>";
      }
      $category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$product['category']);
      $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):$product['title']);
      $parentQ = $db->query("SELECT * FROM categories WHERE id = '$category'");
      $parentResult = mysqli_fetch_assoc($parentQ);
      $parent = ((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):$parentResult['parent']);
      $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):$product['price']);
      $unit = ((isset($_POST['unit']) && $_POST['unit'] != '')?sanitize($_POST['unit']):$product['unit']);
      $per_set = ((isset($_POST['per_set']) && $_POST['per_set'] != '')?sanitize($_POST['per_set']):$product['per_set']);
      $quantity = ((isset($_POST['current_quantity']) && $_POST['current_quantity'] != '')?sanitize($_POST['current_quantity']):$product['current_quantity']);
      $description = ((isset($_POST['description']))?sanitize($_POST['description']):$product['description']);
      $purchase = ((isset($_POST['purchase']))?sanitize($_POST['purchase']):$product['purchase']);
      $saved_image = (($product['image'] != '')?$product['image']:'');
      $dbpath = $saved_image;
    }

  if ($_POST) {
    $errors = array();
    $required = array('title', 'price', 'parent', 'child', 'unit', 'per_set');
    $allowed = array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF');
    $uploadPath = array();
    $tmpLoc = array();
    foreach($required as $field){
      if($_POST[$field] == ''){
        $errors[] = 'All Fields With and Astrisk are required.';
        break;
      }
    }
    $photoCount = count($_FILES['photo']['name']);
     if ($photoCount > 0) {
       for($i = 0; $i < $photoCount; $i++){echo $i;
        $name = $_FILES['photo']['name'][$i];
        $nameArray = explode('.',$name);
        $fileName = $nameArray[0];
        $fileExt = $nameArray[1];
        $mime = explode('/',$_FILES['photo']['type'][$i]);
        $mimeType = $mime[0];
        $mimeExt = $mime[1];
        $tmpLoc[] = $_FILES['photo']['tmp_name'][$i];
        $fileSize = $_FILES['photo']['size'][$i];
        $uploadName = md5(microtime()).'.'.$fileExt;
        $uploadPath[] = BASEURL.'admin_area/product_images/'.$uploadName;
        if($i != 0){
          $dbpath .= ',';
        }
        $dbpath .= '/crosspointpaper/admin_area/product_images/'.$uploadName;
        if($mimeType != 'image'){
          $errors[] = 'The file must be an image.';
        }
        if(!in_array($fileExt, $allowed)){
          $errors[] = 'The file extension must be a png, jpg, jpeg, or jif.';
        }
        if($fileSize > 15000000){
          $errors[] = 'The files size must be under 15MB.';
        }
        if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
          $errors[] = 'File extension does not match the file.';
        }
      }
    }
    if(!empty($errors)){
      echo display_errors($errors);
    }else{
      if($photoCount > 0){
      // upload file and insert into database
        for($i = 0; $i < $photoCount; $i++){
          move_uploaded_file($tmpLoc[$i], $uploadPath[$i]);
        }
      }
      $insertSql = "INSERT INTO products (`title`, `category`, `price`, `unit`, `per_set`, `current_quantity`, `image`, `description`,`purchase`)
      VALUES ('$title', '$category', '$price', '$unit', '$per_set', '$quantity', '$dbpath', '$description', '$purchase')";
      if(isset($_GET['edit'])){
        $insertSql = "UPDATE products SET title = '$title', category = '$category', price = '$price',
        unit = '$unit', per_set = '$per_set', current_quantity = '$quantity', image = '$dbpath', description = '$description', purchase = '$purchase'
        WHERE id = '$edit_id'";
      }
      $db->query($insertSql);
      echo "<script>window.open('products.php','_self')</script>";
    }
  }
  ?>
  <br>
    <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ':'Add A New ');?>Product</h2><hr>
    <form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="POST" enctype="multipart/form-data">
      <div class="form-group col-md-3">
        <label for="title">Title*:</label>
        <input type="text" name="title" class="form-control" id="title" value="<?=$title;?>">
      </div>

        <div class="form-group col-md-3">
          <label for="parent">Parent Category*:</label>
          <select class="form-control" id="parent" name="parent">
            <option value=""<?=(($parent == '')?' selected':'');?>></option>
            <?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
              <option value="<?=$p['id'];?>"<?=(($parent == $p['id'])?' selected':'');?>><?=$p['category'];?></option>
            <?php endwhile; ?>
          </select>
          </div>

          <div class="form-group col-md-3">
            <label for="child">Child Category*:</label>
            <select id="child" name="child" class="form-control">
            </select>
          </div>

          <div class="form-group col-md-3">
            <label for="price">Price*:</label>
            <input type="text" id="price" name="price" class="form-control" value="<?=$price;?>">
          </div>

          <div class="form-group col-md-3">
            <label for="unit">Unit*:</label>
            <input type="text" id="unit" name="unit" class="form-control" value="<?=$unit;?>">
          </div>

          <div class="form-group col-md-3">
            <label for="per_set">Per set*:</label>
            <input type="text" id="per_set" name="per_set" class="form-control" value="<?=$per_set;?>">
          </div>

          <div class="form-group col-md-3">
            <label for="quantity">Current Quantity*:</label>
            <input type="text" id="quantity" name="quantity" class="form-control" value="<?=$quantity;?>" readonly>
          </div>

          <div class="form-group col-md-6">
            <?php if($saved_image != ''): ?>
              <?php
                $imgi =1;
                $images = explode(',',$saved_image); ?>
                <?php foreach($images as $image) : ?>
              <div class="saved-image col-md-6">
                <label for="photo">Product Photo:</label>
                <img src="<?=$image;?>" alt="saved image"/><br>
                <a href="products.php?delete_image=1&edit=<?=$edit_id;?>&imgi=<?=$imgi;?>" class="text-danger">Delete Image</a>
              </div>
            <?php
                $imgi++;
                endforeach; ?>
            <?php else: ?>
              <label for="photo">Product Photo:</label>
              <input type="file" id="photo" class="form-control" name="photo[]">
            <?php endif; ?>
          </div>

          <div class="form-group col-md-3">
            <label for="description">Description:</label>
            <textarea id="description" class="form-control" name="description" rows="6"><?=$description;?></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="description">Type of product:</label>
            <select class="form-control" name="purchase">
              <option value="<?=$purchase;?>"><?=$purchase;?></option>
              <option value="Sales Product">Sales Product</option>
              <option value="Purchase Product">Purchase Product</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label></label>

          </div>
          <div class="form-group pull-right">
            <a href="products.php" class="btn btn-default">Cancel</a>
            <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Product" class="btn btn-success">
          </div><div class="clearfix"></div>
    </form>

<?php }else{
  $sql = "SELECT * FROM products WHERE deleted = 0 ";
  $presults = $db->query($sql);
  if(isset($_GET['featured'])){
    $id = (int)$_GET['id'];
    $featured = (int)$_GET['featured'];
    $featuredSql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
    $db->query($featuredSql);
    echo "<script>window.open('products.php','_self')</script>";
  }
?>
<h2 class="text-center">Products</h2>
<a href="products.php?add=1" id="add-btn" class="btn btn-success pull-right">Add Product</a><div class="clearfix"></div>
<hr>
<table class="table table-bordered table-striped table-condensed">
  <thead>
    <th></th><th>Product</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th>
  </thead>
  <tbody>
    <?php while($product = mysqli_fetch_assoc($presults)):
      $childID = $product['category'];
      $catSql = "SELECT * FROM categories WHERE id = $childID";
      $result = $db->query($catSql);
      $child = mysqli_fetch_assoc($result);
      $parentID = $child['parent'];
      $pSql = "SELECT * FROM categories WHERE id = $parentID";
      $presult = $db->query($pSql);
      $parent = mysqli_fetch_assoc($presult);
      $category = $parent['category'].'-'.$child['category'];
      ?>
      <tr>
        <td>
          <a href="products.php?edit=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="fa fa-pencil"></span></a>
          <a href="products.php?delete=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="fa fa-trash-o"></span></a>
        </td>
        <td><?=$product['title'];?></td>
        <td><?=money($product['price']);?></td>
        <td><?=$category;?></td>
        <td><a href="products.php?featured=<?=(($product['featured'] == 0)?'1':'0');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default">
          <span class="glyphicon glyphicon-<?=(($product['featured'] == 1)?'minus':'plus');?>"></span>
          &nbsp <?=(($product['featured'] == 1)?'Featured Product':'');?>
          </a></td>
        <td>0</td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
    </div><!-- col-md-9 Finish -->
  </div><!-- container Finish -->
</div><!-- #content Finish -->
<?php }include 'footer.php'; ?>
<script>
  jQuery('document').ready(function(){
    get_child_options('<?=$category;?>');
  });
</script>

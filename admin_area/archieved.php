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

            <?php
             //Add Product
              if(isset($_GET['add'])){
                $id = sanitize($_GET['add']);
                $db->query("UPDATE products SET deleted = 0 WHERE id = '$id'");
                echo "<script>window.open('archieved.php','_self')</script>";
              }
            ?>
            <?php
              $sql = "SELECT * FROM products WHERE deleted = 1 ";
              $presults = $db->query($sql);
            ?>
            <h2 class="text-center">Archived Products</h2>
            <hr>
            <table class="table table-bordered table-striped table-condensed">
              <thead>
                <th></th><th>Product</th><th>Price</th><th>Category</th><th>Sold</th>
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
                      <a href="archieved.php?add=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-plus"><strong></strong></span></a>
                    </td>
                    <td><?=$product['title'];?></td>
                    <td><?=money($product['price']);?></td>
                    <td><?=$category;?></td>
                    <td>0</td>
                  </tr>
                    <?php endwhile; ?>
              </tbody>
            </table>

           </div><!-- col-md-9 Finish -->
      </div><!-- container Finish -->
  </div><!-- #content Finish -->

           <?php include 'footer.php'; ?>

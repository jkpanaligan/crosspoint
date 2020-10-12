<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
  ?>
<?php

  $cart_id = sanitize($_POST['id']);
  $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
  setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);

?>
<div class="modal fade details-1" id="details-modal" tabindex="-1" aria-labelledby="details-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" onclick="closeModal()" aria-label="Close"><span aria=hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Products</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <form action="add_cart.php" method="post" id="add_product_form">
            <span id="modal_errors" class="bg-danger"></span>
            <table class="table table-bordered table-striped table-condensed">

              <thead>
                <th class="col-md-6 text-center">Item Description</th>
                <th class="col-md-1 text-center">Quantity</th>
                <th class="col-md-1 text-center">Add</th>
              </thead>
              <tbody>

                  <tr>
                    <td class="col-md-6 text-center"><select name="product_id" class="form-control"><!-- form-control Begin -->

                          <option> Select Product </option>
                    <?php
                        $get_prod = "SELECT * from products WHERE deleted = 0";
                        $run_prod = mysqli_query($db,$get_prod);

                        while ($row_prod=mysqli_fetch_array($run_prod)){

                            $id = $row_prod['id'];
                            $title = $row_prod['title'];

                            echo "

                            <option value='$id'> $title </option>

                            ";
                        }

                        ?>
                    </select><!-- form-control Finish --></td>
                    <td class="col-md-2 text-center"><input type="number" class="text-center form-control" id="quantity" name="quantity" min="0"></td>
                    <td class="col-md-1 text-center"><button class="text-center form-control" class="btn btn-xs btn-default" onclick="add_to_cart();return false;"><span class="glyphicon glyphicon-plus"></span></button></td>
                  </tr>
              </tbody>
            </table>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" onclick="closeModal()">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
function closeModal(){
    jQuery('#details-modal').modal('hide');
    setTimeout(function(){
      jQuery('#details-modal').remove();
      jQuery('.modal-backdrop').remove();
    },500);
  }
</script>

<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
  $id = $_POST['id'];
  $cart_id = $_POST['cart_id'];
  $id = (int)$id;
  $sql = "SELECT * FROM products WHERE id = '$id'";
  $result = $db->query($sql);
  $product = mysqli_fetch_assoc($result);
?>
<!--Details Modal-->
<?php ob_start(); ?>
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" onclick="closeModal()" aria-label="Close"><span aria=hidden="true">&times;</span></button>
        <h4 class="modal-title text-center"><?= $product['title']; ?></h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <span id="modal_errors" class="bg-danger"></span>
            <div class="col-sm-6 fotorama">
              <?php $photos = explode(',',$product['image']);
              foreach($photos as $photo): ?>
                <img src="<?= $photo ?>" alt="<?= $product['title']; ?>" class="details img-responsive">
            <?php endforeach; ?>
            </div>
            <div class="col-sm-6">
              <h4>Details</h4>
              <hr>
              <p>Price: <?= $product['price']; ?></p>
              <p>Unit: <?= $product['unit']; ?></p>
              <p>Per Set: <?= $product['per_set']; ?></p>
              <form action="add_cart2.php" method="post" id="add_product_form">
                <input type="text" name="cart_id" value="<?php echo $cart_id; ?>">
                <input type="hidden" name="product_id" value="<?=$id;?>">
                <div class="form-group">
                  <div class="col-xs-6">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="0">
                  </div>
                </div><br><br><br>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" onclick="closeModal()">Close</button>
        <button class="btn btn-warning" onclick="add_to_cart2();return false;"><span></span>Add</button>
      </div>
    </div>
  </div>
</div>
<script>
  jQuery('#size').change(function(){
    var available = jQuery('#size option:selected').data("available");
    jQuery('#available').val(available);
  });

  $(function () {
    $('.fotorama').fotorama({'loop':true,'autoplay':true});
  });

  function closeModal(){
    jQuery('#details-modal').modal('hide');
    jQuery('#itemModal').modal('hide');
    setTimeout(function(){
      jQuery('#details-modal').remove();
      jQuery('.modal-backdrop').remove();
    },500);
  }
</script>
<?php echo ob_get_clean(); ?>

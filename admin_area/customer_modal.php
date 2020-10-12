<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
  $id = $_POST['id'];
  $id = (int)$id;
  $sql = "SELECT * FROM customers WHERE id = '$id'";
  $result = $db->query($sql);
  $customer = mysqli_fetch_assoc($result);
?>
<!--Details Modal-->
<?php ob_start(); ?>
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" onclick="closeModal()" aria-label="Close"><span aria=hidden="true">&times;</span></button>
        <h4 class="modal-title text-center"><?= $customer['company_name']; ?></h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <span id="modal_errors" class="bg-danger"></span>
            <div class="col-sm-6 fotorama">
              <?php $photos = explode(',',$customer['image']);
              foreach($photos as $photo): ?>
                <img src="../customer/customer_images/<?= $photo ?>" alt="<?= $customer['company_name']; ?>" class="details img-responsive">
            <?php endforeach; ?>
            </div>
            <div class="col-sm-6">
              <h4>Information</h4>
              <hr>
              <p>Street Address: <?= $customer['street']; ?></p>
              <p>Barangay: <?= $customer['barangay']; ?></p>
              <p>City: <?= $customer['city']; ?></p>
              <p>Contact Number: <?= $customer['contact']; ?></p>
              <form action="" method="post" id="add_product_form">
                <input type="text" name="customer_id" value="<?=$id;?>">
                <div class="form-group">
                  <div class="col-xs-6">

                  </div>
                </div>
                <br><br><br>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" onclick="closeModal()">Close</button>
        <button class="btn btn-primary" onclick="selectcustomer2('<?=$id;?>')"> OK</button>
      </div>
    </div>
  </div>
</div>
<script>


  function selectcustomer2(id){
      var data = {"id" : id};
      jQuery.ajax({
        url : '/crosspointpaper/admin_area/new_do.php',
        method : "post",
        data : data,
        success : function(){location.reload();},
        error : function(){alert("Something went wrong.");},
      });
    }

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

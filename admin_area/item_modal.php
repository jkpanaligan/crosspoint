<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
  $id = $_POST['id'];
  $mode = sanitize($_POST['mode']);
  $txn_id = sanitize($_POST['txn_id']);
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
              <form action="add_cart.php" method="post" id="add_product_form">
                <input type="hidden" name="product_id" value="<?=$id;?>">
                <input type="hidden" name="mode" value="<?=$mode;?>">
                <input type="hidden" name="txn_id" value="<?=$txn_id;?>">
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
        <?php if($mode == 'new'): ?>
          <?php
          echo "<button class='btn btn-warning' onclick='add_to_cart();return false;'><span></span>Add</button>";
          ?>
        <?php elseif($mode == 'new_po'): ?>
          <?php
          echo "<button class='btn btn-warning' onclick='add_to_cart();return false;'><span></span>Add</button>";
          ?>
        <?php elseif($mode == 'new_jo'): ?>
          <?php
          echo "<button class='btn btn-warning' onclick='add_to_cart();return false;'><span></span>Add</button>";
          ?>
        <?php elseif($mode == 'edit'): ?>
          <?php
            echo "<button class='btn btn-warning' onclick='add_to_cart2();return false;'><span></span>Add</button>";
          ?>
        <?php elseif($mode == 'edit_jo'): ?>
          <?php
            echo "<button class='btn btn-warning' onclick='add_to_cart22();return false;'><span></span>Add</button>";
          ?>
        <?php elseif($mode == 'edit_po'): ?>
          <?php
            echo "<button class='btn btn-warning' onclick='add_to_cartt2();return false;'><span></span>Add</button>";
          ?>
        <?php elseif($mode == 'edit_dr'): ?>
          <?php
            echo "<button class='btn btn-warning' onclick='add_to_cart3();return false;'><span></span>Add</button>";
          ?>
        <?php elseif($mode == 'edit_rr'): ?>
          <?php
            echo "<button class='btn btn-warning' onclick='add_to_cartt3();return false;'><span></span>Add</button>";
          ?>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>
<script>
function add_to_cart(){
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
        url : '/crosspointpaper/admin_area/add_cart.php',
        method : 'post',
        data : data,
        success : function(){
          location.reload();
        },
        error : function(){alert("Something went wrong");}
      });
    }
  }
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
        url : '/crosspointpaper/admin_area/add_cart.php',
        method : 'post',
        data : data,
        success : function(){
          window.open('index.php?edit_order=<?php echo $txn_id;?>','_self');
        },
        error : function(){alert("Something went wrong");}
      });
    }
  }
  function add_to_cart22(){
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
          url : '/crosspointpaper/admin_area/add_cart.php',
          method : 'post',
          data : data,
          success : function(){
            window.open('index.php?edit_jo=<?php echo $txn_id;?>','_self');
          },
          error : function(){alert("Something went wrong");}
        });
      }
    }
  function add_to_cartt2(){
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
          url : '/crosspointpaper/admin_area/add_cart.php',
          method : 'post',
          data : data,
          success : function(){
            window.open('index.php?edit_po=<?php echo $txn_id;?>','_self');
          },
          error : function(){alert("Something went wrong");}
        });
      }
    }
  function add_to_cart3(){
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
          url : '/crosspointpaper/admin_area/add_cart.php',
          method : 'post',
          data : data,
          success : function(){
            window.open('index.php?edit_dr=<?php echo $txn_id;?>','_self');
          },
          error : function(){alert("Something went wrong");}
        });
      }
    }
    function add_to_cartt3(){
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
            url : '/crosspointpaper/admin_area/add_cart.php',
            method : 'post',
            data : data,
            success : function(){
              window.open('index.php?edit_rr=<?php echo $txn_id;?>','_self');
            },
            error : function(){alert("Something went wrong");}
          });
        }
      }
  </script>
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

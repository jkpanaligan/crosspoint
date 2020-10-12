<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
  ?>
  <?php

    $txn_id = sanitize($_POST['id']);


  ?>
  <div class="modal fade details-1" id="details-modal1" tabindex="-1" aria-labelledby="details-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" onclick="closeModal()" aria-label="Close"><span aria=hidden="true">&times;</span></button>
          <h4 class="modal-title text-center">Customers</h4>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <form action="change_customer.php" method="post" id="add_product_form1">
              <span id="modal_errors" class="bg-danger"></span>
              <table class="table table-bordered table-striped table-condensed">

                <thead>
                  <th class="col-md-6 text-center">Customer Name</th>
                  <th class="col-md-4 text-center">Address</th>
                  <th class="col-md-6 text-center">Contact</th>
                  <th class="col-md-6 text-center">Done</th>
                </thead>
                <tbody>

                    <tr>
                      <input type="hidden" name="txn_id" value="<?php echo $txn_id; ?>">
                      <td class="col-md-6 text-center"><select name="customer_id" class="form-control"><!-- form-control Begin -->

                            <option> Select Customer </option>
                      <?php
                          $get_cus = "SELECT * from customers";
                          $run_cus = mysqli_query($db,$get_cus);

                          while ($row_cus=mysqli_fetch_array($run_cus)){

                              $id = $row_cus['id'];
                              $name = $row_cus['company_name'];

                              echo "

                              <option value='$id'> $id $name </option>

                              ";
                          }

                          ?>
                      </select><!-- form-control Finish --></td>
                      <td class="col-md-2 text-center"></td>
                      <td class="col-md-2 text-center"></td>
                      <td class="col-md-1 text-center"><button class="text-center form-control" class="btn btn-xs btn-default" onclick="change_customer1();return false;"><span>Ok</span></button></td>
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
      jQuery('#details-modal1').modal('hide');
      setTimeout(function(){
        jQuery('#details-modal1').remove();
        jQuery('.modal-backdrop').remove();
      },500);
    }
  </script>

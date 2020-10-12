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

                 $txn_id = sanitize((int)$_GET['txn_id']);

                 $crQuery = $db->query("SELECT * FROM check_vouchers WHERE id = '{$txn_id}'");
                  $cr = mysqli_fetch_assoc($crQuery);
                  $id = $cr['id'];
                  $supplier_id = $cr['supplier_id'];
                  $ap_id = $cr['ap_id'];
                  $cheque_detail_id = $cr['cheque_detail_id'];
                  $state = $cr['state'];

                  $run_supplier = $db->query("SELECT * FROM suppliers WHERE id ='$supplier_id'");
                  $row_supplier = mysqli_fetch_assoc($run_supplier);

                  $cheque_detailQ = $db->query("SELECT * FROM cheque_details WHERE id = '{$cheque_detail_id}'");
                  $cheque_detail = mysqli_fetch_assoc($cheque_detailQ);
                  $items = json_decode($cheque_detail['cheque_items'],true);
                  $idArray = array();
                  $products = array();
                  if(!empty($items)){
                    foreach($items as $item){
                      $idArray[] = $item['id'];
                    }
                    $ids = implode(',',$idArray);
                    $productQ = $db->query(
                      "SELECT i.id as 'id', i.cheque_no as 'cheque_no', i.bank as 'bank', i.amount as 'amount', i.cheque_date as 'cheque_date'
                      FROM cheque i WHERE i.id IN ({$ids})
                      ");
                        while($p = mysqli_fetch_assoc($productQ)){
                            foreach($items as $item){
                              if($item['id'] == $p['id']){
                                $x = $item;
                                continue;
                              }
                            }
                          $products[] = array_merge($x,$p);
                        }

                  }

               ?>

             <br>

             <div class="row"><!-- row 1 begin -->
                 <div class="col-lg-12"><!-- col-lg-12 begin -->
                     <ol class="breadcrumb"><!-- breadcrumb begin -->
                         <li class="active"><!-- active begin -->

                             <i class="fa fa-dashboard"></i> Dashboard / Check Voucher

                             <?php if($state != 'Approved'): ?>
                               <a href="index.php?edit_cv=<?php echo $txn_id; ?>&click=1"><span class="btn btn-default"><i class="fa fa-edit"></i></span></a>
                             <?php else: ?>
                             <?php endif; ?>

                             <a href="index.php?view_check_voucher"><span class="btn btn-default"><i class="fa fa-list"></i></span></a>

                         </li><!-- active finish -->
                     </ol><!-- breadcrumb finish -->
                 </div><!-- col-lg-12 finish -->
             </div><!-- row 1 finish -->
             <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
               <div class="row">
                 <div class="col-md-12">
                   <table class="table table-condensed table-bordered">
                     <tbody>
                       <tr>
                         <td  align="right">Transaction Number:</td>
                         <td><?=$txn_id;?></td>
                         <td  align="right">Date:</td>
                         <td><?=$cr['txn_date'];?></td></tr>
                       <tr>
                         <td  align="right">Supplier Name:</td>
                         <td><?=$row_supplier['company_name'];?></td>
                         <td  align="right">Accounts Payable Number:</td>
                         <td><?= $ap_id; ?>
                         </td>
                       </tr>
                       <tr>
                         <td  align="right">Address:</td>
                         <td><?=$row_supplier['street'];?>
                         <?=$row_supplier['barangay'];?>
                         <?=$row_supplier['city'];?></td>
                       </tr>
                       <tr>
                         <td align="right">Cash Payment:</td>
                         <td><?=$cr['cash_payment'];?></td>
                       </tr>
                     </tbody>
                   </table>
                   <table class="table table-condensed table-bordered">
                     <thead>
                       <th>Cheque No.</th>
                       <th>Bank</th>
                       <th>Amount</th>
                       <th>Date</th>
                     </thead>
                     <tbody>
                       <?php if(!empty($items)): ?>
                         <?php foreach($products as $product): ?>
                           <tr>
                             <td><?=$product['cheque_no'];?></td>
                             <td><?=$product['bank'];?></td>
                             <td><?=$product['amount'];?></td>
                             <td><?=$product['cheque_date'];?></td>
                           </tr>
                         <?php endforeach; ?>
                       <?php else: ?>
                       <?php endif; ?>
                     </tbody>
                   </table>
                 </div>
               </div>
               <div class="pull-right">
                 <?php if($state != 'Approved'): ?>
                    <input type="submit" name="submit" value="Approve Now" class="btn btn-primary">
                 <?php else: ?>
                 <?php endif; ?>
                         <a href="index.php?view_check_voucher" class="btn btn-large btn-default">Back</a>
              </div>
              </div>
            </form>

           </div><!-- col-md-9 Finish -->
        </div><!-- container Finish -->
  </div><!-- #content Finish -->
  <?php

      if(isset($_POST['submit'])){

        $si_id = sanitize((int)$_GET['txn_id']);
        $db->query("UPDATE check_vouchers SET state = 'Approved' WHERE id = '$si_id'");
        $_SESSION['success_flash'] = "The Check Voucher Has Been Submitted!";
        echo "<script>window.open('index.php?view_check_voucher','_self')</script>";

      }

  ?>
  <?php include 'footer.php'; ?>

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

                 $crQuery = $db->query("SELECT * FROM collection_receipt WHERE id = '{$txn_id}'");
                  $cr = mysqli_fetch_assoc($crQuery);
                  $id = $cr['id'];
                  $customer_id = $cr['customer_id'];
                  $si_detail_id = $cr['si_detail_id'];
                  $cheque_detail_id = $cr['cheque_detail_id'];
                  $state = $cr['state'];

                  $run_customer = $db->query("SELECT * FROM customers WHERE id ='$customer_id'");
                  $row_customer = mysqli_fetch_assoc($run_customer);

                  $run_dr_detail = $db->query("SELECT * FROM si_details WHERE id ='$si_detail_id'");
                  $row_dr_detail = mysqli_fetch_assoc($run_dr_detail);
                  $dr_items = json_decode($row_dr_detail['si_items'],true);
                  $drIdArray = array();
                  $drs = array();
                  if(!empty($dr_items)){
                    foreach($dr_items as $dr_item){
                      $drIdArray[] = $dr_item['id'];
                    }
                    $drIds = implode(',',$drIdArray);
                  }

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

                             <i class="fa fa-dashboard"></i> Dashboard / Collection Receipt

                             <?php if($state != 'Approved'): ?>
                               <a href="index.php?edit_cr=<?php echo $txn_id; ?>&click=1"><span class="btn btn-default"><i class="fa fa-edit"></i></span></a>
                             <?php else: ?>
                             <?php endif; ?>

                             <a href="index.php?view_collection_receipt"><span class="btn btn-default"><i class="fa fa-list"></i></span></a>

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
                         <td  align="right">Customer Name:</td>
                         <td><?=$row_customer['company_name'];?></td>
                         <td  align="right">Sales Invoice Number/s:</td>
                         <td>
                           <?php if(!empty($dr_items)): ?>
                             <?=$drIds;?>
                          <?php else: ?>
                          <?php endif ?>
                         </td>
                       </tr>
                       <tr>
                         <td  align="right">Address:</td>
                         <td><?=$row_customer['street'];?>
                         <?=$row_customer['barangay'];?>
                         <?=$row_customer['city'];?></td>
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
                         <a href="index.php?view_collection_receipt" class="btn btn-large btn-default">Back</a>
              </div>
              </div>
            </form>

           </div><!-- col-md-9 Finish -->
        </div><!-- container Finish -->
  </div><!-- #content Finish -->
  <?php

      if(isset($_POST['submit'])){

        $si_id = sanitize((int)$_GET['txn_id']);
        $db->query("UPDATE collection_receipt SET state = 'Approved' WHERE id = '$si_id'");
        $_SESSION['success_flash'] = "The Collection Receipt Has Been Submitted!";
        echo "<script>window.open('index.php?view_collection_receipt','_self')</script>";

      }

  ?>
  <?php include 'footer.php'; ?>

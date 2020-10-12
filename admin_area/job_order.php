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
                 $drQuery = $db->query("SELECT * FROM job_orders WHERE id = '{$txn_id}'");
                  $dr = mysqli_fetch_assoc($drQuery);
                  $id = $dr['id'];
                  $state = $dr['state'];
                  $tran_id = $dr['do_id'];
                  $cart_id = $dr['cart_id'];


                   $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
                   $cart = mysqli_fetch_assoc($cartQ);
                   $items = json_decode($cart['items'],true);
                   $idArray = array();
                   $products = array();
                   foreach($items as $item){
                     $idArray[] = $item['id'];
                   }
                   $ids = implode(',',$idArray);
                   $productQ = $db->query(
                     "SELECT i.id as 'id', i.title as 'title', i.price as 'price', i.unit as 'unit', c.id as 'cid', c.category as 'child', p.category as 'parent'
                     FROM products i
                     LEFT JOIN categories c ON i.category = c.id
                     LEFT JOIN categories p ON c.parent = p.id
                     WHERE i.id IN ({$ids})
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
               ?>

             <br>

             <div class="row"><!-- row 1 begin -->
                 <div class="col-lg-12"><!-- col-lg-12 begin -->
                     <ol class="breadcrumb"><!-- breadcrumb begin -->
                         <li class="active"><!-- active begin -->

                             <i class="fa fa-dashboard"></i> Dashboard / Job Order

                             <?php if($state != 'Approved'): ?>
                               <a href="index.php?edit_jo=<?php echo $txn_id; ?>&click=1"><span class="btn btn-default"><i class="fa fa-edit"></i></span></a>
                             <?php else: ?>
                             <?php endif; ?>

                             <a href="index.php?view_job_order"><span class="btn btn-default"><i class="fa fa-list"></i></span></a>

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
                         <td  align="right">Delivery Order Number:</td>
                         <td>
                           <?php if(!empty($tran_id)): ?>
                           <?=$tran_id;?>
                         <?php else: ?>
                           <?php echo '-'; ?>
                         <?php endif ?>
                         </td>
                       <tr>
                         <td  align="right">Date:</td>
                         <td><?=$dr['txn_date'];?></td>
                       </tr>
                     </tbody>
                   </table>
                   <table class="table table-condensed table-bordered">
                     <thead>
                       <th>Item Description</th>
                         <th>Unit</th>
                           <th>Quantity</th>
                     </thead>
                     <tbody>
                       <?php foreach($products as $product): ?>
                         <tr>
                            <td><?=$product['title'];?></td>
                            <td><?=$product['unit'];?></td>
                             <td><?=$product['quantity'];?></td>
                         </tr>
                       <?php endforeach; ?>
                     </tbody>
                   </table>
                 </div>
               </div>
               <div class="pull-right">
                 <?php if($state != 'Approved'): ?>
                    <input type="submit" name="submit" value="Approve Now" class="btn btn-primary">
                 <?php else: ?>
                 <?php endif; ?>
                         <a href="index.php?view_job_order" class="btn btn-large btn-default">Back</a>
              </div>
              </div>
            </form>

           </div><!-- col-md-9 Finish -->
        </div><!-- container Finish -->
  </div><!-- #content Finish -->
  <?php

      if(isset($_POST['submit'])){

        $dr_id = sanitize((int)$_GET['txn_id']);
        $db->query("UPDATE job_orders SET state = 'Approved' WHERE id = '$dr_id'");
        $_SESSION['success_flash'] = "The Job Orders Has Been Submitted!";
        echo "<script>window.open('index.php?view_job_order','_self')</script>";

      }

  ?>
  <?php include 'footer.php'; ?>

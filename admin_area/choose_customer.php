<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
  $id = sanitize($_POST['id']);
  $mode = sanitize($_POST['mode']);
  $txn_id = sanitize($_POST['txn_id']);

?>
  <?php if($mode == 'new'): ?>
    <?php
    echo "<script>window.open('new_do.php?id=$id','_self')</script>";
    ?>
  <?php elseif($mode == 'new_po'): ?>
      <?php
      echo "<script>window.open('new_po.php?id=$id','_self')</script>";
      ?>
  <?php elseif($mode == 'new_si'): ?>
    <?php
    echo "<script>window.open('index.php?new_si=$id','_self')</script>";
    ?>
  <?php elseif($mode == 'new_cr'): ?>
    <?php
    echo "<script>window.open('index.php?new_cr=$id','_self')</script>";
    ?>
  <?php elseif($mode == 'new_tt'): ?>
    <?php
    echo "<script>window.open('index.php?new_tt=$id','_self')</script>";
    ?>
  <?php elseif($mode == 'new_cv'): ?>
    <?php
    echo "<script>window.open('index.php?new_cv=$id','_self')</script>";
    ?>
  <?php elseif($mode == 'edit'): ?>
    <?php
    $db->query("UPDATE temp_transactions SET customer_id = '{$id}' WHERE transaction_id = '{$txn_id}'");
    echo "<script>window.open('index.php?edit_order=$txn_id','_self')</script>";
    ?>
  <?php elseif($mode == 'edit_po'): ?>
    <?php
    $db->query("UPDATE temp_transactions SET customer_id = '{$id}' WHERE transaction_id = '{$txn_id}'");
    echo "<script>window.open('index.php?edit_po=$txn_id','_self')</script>";
    ?>
  <?php endif; ?>

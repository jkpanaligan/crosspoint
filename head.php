
<?php

if(isset($_GET['pro_id'])){

    $product_id = $_GET['pro_id'];

    $get_product = "SELECT * from products where id='$product_id'";

    $run_product = mysqli_query($db,$get_product);

    $row_product = mysqli_fetch_array($run_product);

    $category1 = $row_product['category'];

    $pro_title = $row_product['title'];

    $pro_price = $row_product['price'];

    $pro_desc = $row_product['description'];

    $unit = $row_product['unit'];

    $per_set = $row_product['per_set'];

    $current_quantity = $row_product['current_quantity'];

    $image = $row_product['image'];

    $get_p_cat = "SELECT * from categories where id = '$category1'";

    $run_p_cat = mysqli_query($db,$get_p_cat);

    $row_p_cat = mysqli_fetch_array($run_p_cat);

    $p_cat_title = $row_p_cat['category'];
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Crosspoint Paper, Inc.</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
</head>
<body>

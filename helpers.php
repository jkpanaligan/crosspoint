<?php
function display_errors($errors){
  $display = '<ul class="bg-danger">';
  foreach($errors as $error){
    $display .= '<li class="text-danger">'.$error.'</li>';
  }
  $display .= '</ul>';
  return $display;
}

function sanitize($dirty){
  return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function money($number){
  return 'P'.number_format($number,2);
}

function login($user_id){
  $_SESSION['SBUser'] = $user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id'");
  $_SESSION['success_flash'] = 'You are now logged in!';
  header('Location: adminIndex.php');
}

function is_logged_in(){
  if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
    return true;
  }
  return false;
}

function login_error_redirect($url = 'adminLogin.php'){
  $_SESSION['error_flash'] = 'You must be logged in to access that page';
  header('Location: '.$url);
}

function permission_error_redirect($url = 'adminLogin.php'){
  $_SESSION['error_flash'] = 'You do not have permission to access that page';
  header('Location: '.$url);
}

function has_permission($permission = 'admin'){
  global $user_data;
  $permissions = explode(',', $user_data['permissions']);
  if(in_array($permission,$permissions,true)){
    return true;
  }
  return false;
}

function pretty_date($date){
  return date("M d, Y", strtotime($date));
}

function get_category($child_id){
  global $db;
  $id = sanitize($child_id);
  $sql = "SELECT p.id AS 'pid', p.category AS 'parent', c.id AS 'cid', c.category AS 'child'
          FROM categories c
          INNER JOIN categories p
          ON c.parent = p.id
          WHERE c.id = '$id'";
  $query = $db->query($sql);
  $category = mysqli_fetch_assoc($query);
  return $category;
}

function sizesToArray($string){
  $sizesArray = explode(',',$string);
  $returnArray = array();
  foreach($sizesArray as $size){
    $s = explode(':',$size);
    $returnArray[] = array('size' => $s[0], 'quantity' => $s[1]);
    // ,'threshold' => $s[2]
  }
  return $returnArray;
}

function sizesToString($sizes){
  $sizeString = '';
  foreach($sizes as $size){
    $sizeString .= $size['size'].':'.$size['quantity'].',';
    // .':'.$size['threshold']
  }
  $trimmed = rtrim($sizeString, ',');
  return $trimmed;
}

/// begin getPCats functions ///

function getPCats(){

    global $db;

    $get_p_cats = "SELECT * from categories where parent != 0";

    $run_p_cats = mysqli_query($db,$get_p_cats);

    while($row_p_cats=mysqli_fetch_array($run_p_cats)){

        $id = $row_p_cats['id'];

        $category = $row_p_cats['category'];

        echo "

            <li>

                <a href='shop.php?p_cat=$id'> $category </a>

            </li>

        ";

    }

}

/// finish getPCats functions ///

/// begin getCats functions ///

function getCats(){

    global $db;

    $get_cats = "SELECT * from categories where parent = 0";

    $run_cats = mysqli_query($db,$get_cats);

    while($row_cats=mysqli_fetch_array($run_cats)){

        $id = $row_cats['id'];

        $title = $row_cats['category'];

        echo "

            <li>

                <a href='shop.php?cat=$id'> $title </a>

            </li>

        ";

    }

}

/// finish getCats functions ///

/// begin getPro functions ///

function getPro(){

    global $db;

    $get_products = "SELECT * FROM products WHERE featured = 1 order by 1 ASC LIMIT 0,4";

    $run_products = mysqli_query($db,$get_products);

    while($row_products=mysqli_fetch_array($run_products)){

        $id = $row_products['id'];

        $title = $row_products['title'];

        $price = $row_products['price'];

        $image = $row_products['image'];

        echo "

        <div class='col-md-4 col-sm-6 single'>

            <div class='product'>

                <a href='details.php?pro_id=$id'>

                    <img class='img-responsive' src='$image'>

                </a>

                <div class='text'>

                    <h3>

                        <a href='details.php?pro_id=$id'>

                            $title

                        </a>

                    </h3>

                    <p class='price'>

                        P $price

                    </p>

                    <p class='button'>

                        <a class='btn btn-default' href='details.php?pro_id=$id'>

                            View Details

                        </a>

                        <a class='btn btn-primary' href='details.php?pro_id=$id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>

                    </p>

                </div>

            </div>

        </div>

        ";

    }

}

/// finish getPro functions ///
/// begin getpcatpro functions ///

function getpcatpro(){

    global $db;

    if(isset($_GET['p_cat'])){

        $p_cat_id = $_GET['p_cat'];

        $get_p_cat ="SELECT * from categories where id='$p_cat_id'";

        $run_p_cat = mysqli_query($db,$get_p_cat);

        $row_p_cat = mysqli_fetch_array($run_p_cat);

        $p_cat_title = $row_p_cat['category'];

        $get_products ="SELECT * from products where featured = 1 AND category='$p_cat_id'";

        $run_products = mysqli_query($db,$get_products);

        $count = mysqli_num_rows($run_products);

        if($count==0){

            echo "

                <div class='box'>

                    <h1> No Product Found In This Product Categories </h1>

                </div>

            ";

        }else{

            echo "

                <div class='box'>

                    <h1> $p_cat_title </h1>

                </div>

            ";

        }

        while($row_products=mysqli_fetch_array($run_products)){

            $pro_id = $row_products['id'];

            $pro_title = $row_products['title'];

            $pro_price = $row_products['price'];

            $pro_img1 = $row_products['image'];

            echo "

                <div class='col-md-4 col-sm-6 center-responsive'>

            <div class='product'>

                <a href='details.php?pro_id=$pro_id'>

                    <img class='img-responsive' src='$pro_img1'>

                </a>

                <div class='text'>

                    <h3>

                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>

                    </h3>

                    <p class='price'>

                        P $pro_price

                    </p>

                    <p class='button'>

                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            View Details

                        </a>

                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Add to Cart

                        </a>

                    </p>

                </div>

            </div>

        </div>

            ";

        }

    }

}

/// finish getpcatpro functions ///
/// begin getRealIpUser functions ///
function getRealIpUser(){

    switch(true){

            case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
            case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
            case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

            default : return $_SERVER['REMOTE_ADDR'];

    }

}

/// finish getRealIpUser functions ///
/// begin add_cart functions ///


function add_cart(){

    global $db;

    if(isset($_GET['add_cart'])){

        require_once $_SERVER['DOCUMENT_ROOT'].'/crosspointpaper/init.php';
        $product_id = sanitize($_POST['product_id']);
        $quantity = sanitize($_POST['quantity']);
        $item = array();
        $item[] = array(
          'id'        => $product_id,
          'quantity'  => $quantity,
        );

        $ip_add = getRealIpUser();
        $p_id = $_GET['add_cart'];
        $product_qty = $_POST['quantity'];
        $check_product = "SELECT * from p_cart where ip_add='$ip_add' AND p_id='$p_id'";
        $run_check = mysqli_query($db,$check_product);

        $domain = ($_SERVER['HTTP_HOST'] != 'localhost:8080')?'.'.$_SERVER['HTTP_HOST']:false;
        $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
        $product = mysqli_fetch_assoc($query);
        $_SESSION['success_flash'] = $product['title']. ' was added to your cart.';

        if(mysqli_num_rows($run_check)>0){

          echo "<script>alert('This product has already added in cart')</script>";
          echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

        }else if($cart_id != ''){
          $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
          $cart = mysqli_fetch_assoc($cartQ);
          $previous_items = json_decode($cart['items'],true);
          $item_match = 0;
          $new_items = array();
          foreach($previous_items as $pitem){
            if($item[0]['id'] == $pitem['id']){
              $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
                $item_match = 1;
            }
            $new_items[] = $pitem;
          }
          if($item_match != 1){
            $new_items = array_merge($item,$previous_items);
          }
          $items_json = json_encode($new_items);
          $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
          $db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE id = '{$cart_id}'");
          setcookie(CART_COOKIE,'',1,"/",$domain,false);
          setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);

        }else{
          $items_json = json_encode($item);
          $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
          $db->query("INSERT INTO cart (items,expire_date) VALUES ('{$items_json}','{$cart_expire}')");
          $cart_id = $db->insert_id;
          setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);

            $query = "INSERT into p_cart (p_id,ip_add,qty) values ('$p_id','$ip_add','$product_qty')";
            $run_query = mysqli_query($db,$query);
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";

        }

    }

}
/// finish add_cart functions ///

function items(){

    global $db;

    $ip_add = getRealIpUser();

    $get_items = "select * from p_cart where ip_add='$ip_add'";

    $run_items = mysqli_query($db,$get_items);

    $count_items = mysqli_num_rows($run_items);

    echo $count_items;

}

/// begin total_price functions ///

function total_price(){

    global $db;

    $ip_add = getRealIpUser();

    $total = 0;

    $select_cart = "select * from p_cart where ip_add='$ip_add'";

    $run_cart = mysqli_query($db,$select_cart);

    while($record=mysqli_fetch_array($run_cart)){

        $pro_id = $record['p_id'];

        $pro_qty = $record['qty'];

        $get_price = "select * from products where id='$pro_id'";

        $run_price = mysqli_query($db,$get_price);

        while($row_price=mysqli_fetch_array($run_price)){

            $sub_total = $row_price['price']*$pro_qty;

            $total += $sub_total;

        }

    }

    echo "$" . $total;

}

/// finish total_price functions ///

<?php
// include connect file
//include './includes/connect.php';

//get the product 
function getproducts()
{
  global $con;

  //check condition isset or not
  if (!isset($_GET['category'])) {
    if (!isset($_GET['brand'])) {
      $select_query = "Select * from `products` order by rand() LIMIT 0,6";
      $result_query = mysqli_query($con, $select_query);
      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='./admin_panel/product_img/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-text'>Price: $product_price USD</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-success'>View product</a>
            </div>
            </div>
            </div>";
      }
    }
  }
}

//getting all products
function get_all_products()
{ {
    global $con;

    //check condition isset or not
    if (!isset($_GET['category'])) {
      if (!isset($_GET['brand'])) {
        $select_query = "Select * from `products` order by rand()";
        $result_query = mysqli_query($con, $select_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_description = $row['product_description'];
          $product_image1 = $row['product_image1'];
          $product_price = $row['product_price'];
          $category_id = $row['category_id'];
          $brand_id = $row['brand_id'];
          echo "<div class='col-md-4 mb-2'>
              <div class='card'>
              <img src='./admin_panel/product_img/$product_image1' class='card-img-top' alt='$product_title'>
              <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_description</p>
              <p class='card-text'>Price: $product_price USD</p>
              <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
              <a href='product_details.php?product_id=$product_id' class='btn btn-success'>View product</a>
              </div>
              </div>
              </div>";
        }
      }
    }
  }
}


//getting unique categories
function get_unique_categories()
{
  global $con;

  //check condition isset or not
  if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $select_query = "Select * from `products` where category_id='$category_id'";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-danger'> Out of stock :( </h2>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      echo "<div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='./admin_panel/product_img/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-text'>Price: $product_price USD</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-success'>View product</a>
            </div>
            </div>
            </div>";
    }
  }
}

//get unique brands
function get_unique_brands()
{
  global $con;

  //check condition isset or not
  if (isset($_GET['brand'])) {
    $brand_id = $_GET['brand'];
    $select_query = "Select * from `products` where brand_id='$brand_id'";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-danger'> This brand is not available now :( </h2>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      echo "<div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='./admin_panel/product_img/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-text'>Price: $product_price USD</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-success'>View product</a>
            </div>
            </div>
            </div>";
    }
  }
}



// display brand in side navbar
function getbrands()
{
  global $con;
  $select_brands = "Select * from `brands`";
  $result_brands = mysqli_query($con, $select_brands);
  while ($row_data = mysqli_fetch_assoc($result_brands)) {
    $brand_title = $row_data['brand_title'];
    $brand_id = $row_data['brand_id'];
    echo "<li class='nav-item'>
    <a href='index.php?brand=$brand_id' class='nav-link text-dark'>$brand_title</a>
  </li>";
  }
}

//display category in side navbar
function getcategories()
{
  global $con;
  $select_categories = "Select * from `categories`";
  $result_categories = mysqli_query($con, $select_categories);
  while ($row_data = mysqli_fetch_assoc($result_categories)) {
    $category_title = $row_data['category_title'];
    $category_id = $row_data['category_id'];
    echo "<li class='nav-item'>
            <a href='index.php?category=$category_id' class='nav-link text-dark'>$category_title</a>
          </li>";
  }
}

//search product
function search_product()
{
  global $con;
  if (isset($_GET['search_data_product'])) {
    $search_data_value = $_GET['search_data'];
    $search_query = "Select * from `products` where product_keyword like '%$search_data_value%'";
    $result_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='text-danger'> No result</h2>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      echo "<div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='./admin_panel/product_img/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <p class='card-text'>Price: $product_price USD</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-success'>View product</a>
            </div>
            </div>
            </div>";
    }
  }
}


//get product details
function get_product_details()
{
  global $con;
  if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $select_query = "Select * from `products` where product_id='$product_id'";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image1 = $row['product_image1'];
      $product_image2 = $row['product_image2'];
      $product_image3 = $row['product_image3'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      echo "<div class='row'>
            <div class='col-md-6'>
            <img src='./admin_panel/product_img/$product_image1' class='card-img-top' alt='$product_title'>
            </div>
            <div class='col-md-6'>
            <h2 class='text-center'>$product_title</h2><br/>
            <p class=''>Description: $product_description</p>
            <p class=''>Price: $product_price USD</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
            <a href='index.php' class='btn btn-success'>Go back</a>
            </div>
            </div>";
    }
  }
}
//related image
function related_image()
{
  global $con;
  if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $select_query = "Select * from `products` where product_id='$product_id'";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_description = $row['product_description'];
      $product_image1 = $row['product_image1'];
      $product_image2 = $row['product_image2'];
      $product_image3 = $row['product_image3'];
      $product_price = $row['product_price'];
      $category_id = $row['category_id'];
      $brand_id = $row['brand_id'];
      echo "<div class='row'>
            <div class='col-md-4'>
            <img src='./admin_panel/product_img/$product_image1' class='card-img-top' alt='$product_title'>
            </div>
            <div class='col-md-4'>
            <img src='./admin_panel/product_img/$product_image2' class='card-img-top' alt='$product_title'>
            </div>
            <div class='col-md-4'>
            <img src='./admin_panel/product_img/$product_image3' class='card-img-top' alt='$product_title'>
            </div>
            </div>";
    }
  }
}
//get ip address
function getIPAddress()
{
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address  
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
//print ip address code
//$ip = getIPAddress();
//echo 'User Real IP Address - ' . $ip;

//cart function
function cart()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $get_ip = getIPAddress();
    $get_product_id = $_GET['add_to_cart'];
    $select_query = "Select * from `cart_details` where ip_address='$get_ip' AND product_id='$get_product_id'";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows > 0) {
      echo "<script>alert('This product is already added in your cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    } else {
      $insert_query = "Insert into `cart_details` (product_id, ip_address, quantity) values ('$get_product_id', '$get_ip', '0')";
      $result_query = mysqli_query($con, $insert_query);
      echo "<script>alert('Add to cart successfully!')</script>";
      echo "<script>window.open('index.php', '_self')</script>";
    }
  }
}

// function to get cart item number
function cart_item()
{
  global $con;
  $get_ip = getIPAddress();
  $select_query = "Select * from `cart_details` where ip_address='$get_ip'";
  $result_query = mysqli_query($con, $select_query);
  $count_cart_items = mysqli_num_rows($result_query);
  echo $count_cart_items;
}

//total price function
function total_cart_price()
{
  global $con;
  $get_ip = getIPAddress();
  $cart_query = "Select * from `cart_details` where ip_address='$get_ip'";
  $result = mysqli_query($con, $cart_query);
  $total_price = 0;
  while ($row = mysqli_fetch_array($result)) {
    $product_id = $row['product_id'];
    $select_products = "Select * from `products` where product_id='$product_id'";
    $result_products = mysqli_query($con, $select_products);
    while ($row_product_price = mysqli_fetch_array($result_products)) {
      $product_price = array($row_product_price['product_price']);
      $product_values = array_sum($product_price);
      $total_price += $product_values;
    }
  }
  echo $total_price;
}


//get user order details
function get_user_order_details()
{
  global $con;
  $username = $_SESSION['username'];
  $get_details = "Select * from `user_table` where username='$username'";
  $result_query = mysqli_query($con, $get_details);
  while ($row_query = mysqli_fetch_array($result_query)) {
    $user_id = $row_query['user_id'];
    if (!isset($_GET['edit_account'])) {
      if (!isset($_GET['myorders'])) {
        if (!isset($_GET['delete_account'])) {
          $get_orders = "Select * from `user_orders` where user_id='$user_id' and order_status='pending'";
          $result_orders_query = mysqli_query($con, $get_orders);
          $row_count = mysqli_num_rows($result_orders_query);
          if ($row_count > 0) {
            echo "<h3 class='text-center text-success mt-5 my-4'>You have <span class = 'text-danger'>$row_count</span> pending order(s)</h3>
            <p class='text-center'><a href='profile.php?myorders' class='text-primary'>More details</a></p>";
          } else {
            echo "<h3 class='text-center text-success mt-5 my-4'>You don't have any pending orders</h3>
            <p class='text-center'><a href='../index.php' class='text-primary'>Back to homepage</a></p>";
          }
        }
      }
    }
  }
}

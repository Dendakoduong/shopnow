<!--connect php-->
<?php
include("includes/connect.php");
include("functions/common_function.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <!--Bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--Font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--Custom css-->
  <link rel="stylesheet" href="/css/style.css">
  <style>
    .cart_img {
      width: 100px;
      height: 100px;
      object-fit: contain;
    }
  </style>

</head>

<body>
  <!--navbar-->
  <div class="container-fluid p-0">
    <!--first child-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <img src="https://iili.io/p4Qtzg.png" alt="Logo icon" class="logo">
      <!--logo-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link active" href="index.php">ShopNow <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="display_all.php">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php">About us</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Account
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Login</a>
              <a class="dropdown-item" href="./users/user_registration.php">Register</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Total price: <?php total_cart_price(); ?> USD</a>
          </li>
        </ul>
        <!--search-->
        <form class="form-inline my-2 my-lg-0" action="search_product.php" method="GET">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
          <input type="submit" value="Search" class="btn btn-success" name="search_data_product">
        </form>
      </div>
    </nav>
    <!--end navbar-->

    <!--call cart function-->
    <?php
    cart();
    ?>

    <!--sencond child-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <?php
        if (!isset($_SESSION['username'])) {
          echo "<li class='nav-item'>
              <a class='nav-link' href='#'>Welcome. Sign in to buy</a>
            </li>";
        } else {
          echo "<li class='nav-item'>
              <a class='nav-link' href='#'>Welcome, " . $_SESSION['username'] . "</a>
            </li>";
        }
        if (!isset($_SESSION['username'])) {
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users/user_login.php'>Sign in</a>
        </li>";
        } else {
          echo "<li class='nav-item'>
          <a class='nav-link' href='./users/logout.php'>Sign out</a>
        </li>";
        }
        ?>
      </ul>
    </nav>

    <!--third child-->
    <div class="bg-light">
      <h2 class="text-center">My Cart</h2>

    </div><br />

    <!--fourth child-->
    <div class="container">
      <div class="row">
        <form action="" method="POST">
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Remove</th>
                <th colspan="2">Options</th>
              </tr>
            </thead>
            <tbody>
              <!--php code to fetch data-->
              <?php
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
                  $price_table = $row_product_price['product_price'];
                  $product_title = $row_product_price['product_title'];
                  $product_image1 = $row_product_price['product_image1'];
                  $product_values = array_sum($product_price);
                  $total_price += $product_values;
              ?>

                  <tr>
                    <td><?php echo $product_title ?></td>
                    <td><img src="./admin_panel/product_img/<?php echo $product_image1 ?>" alt="" class=" cart_img"></td>
                    <td><input type="text" name="qty" id="" class="form-input w-50"></td>
                    <!--action update quantity-->
                    <?php
                    $get_ip = getIPAddress();
                    if (isset($_POST['update_cart'])) {
                      $quantities = $_POST['qty'];
                      $update_cart = "update `cart_details` set quantity=$quantities where ip_address='$get_ip'";
                      $result_products_quantity = mysqli_query($con, $update_cart);
                      $total_price = $total_price * $quantities;
                    }
                    ?>

                    <td><?php echo $price_table ?> USD</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>" id=""></td>
                    <td>
                      <!--update/remote btn-->
                      <input type="submit" value="Update" name="update_cart">
                      <input type="submit" value="Remove" name="remove_cart">
                    </td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
          <!--subtotal-->
          <div class="d-flex mb-5"></div>
          <h3 class="px-3">Total: <strong class="text-success"><?php echo $total_price ?> USD </strong></h3>
          <!--button-->
          <br />
          <a class="btn btn-info px-3 py-2" href="index.php" role="button">Continue shopping</a>
          <a class="btn btn-success px-3 py-2" href="checkout.php" role="button">Checkout</a>
      </div>
    </div>
    </form>
    <!--remove item from cart function-->
    <?php
    function remove_cart_item()
    {
      global $con;
      if (isset($_POST['remove_cart'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
          echo $remove_id;
          $delete_query = "delete from `cart_details` where product_id=$remove_id";
          $run_delete = mysqli_query($con, $delete_query);
          if ($run_delete) {
            echo "<script>window.open('cart.php', '_self')</script>";
          }
        }
      }
    }
    echo @$remove_cart = remove_cart_item();
    ?>


    <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

    <!--footer-->
    <?php
    include("./includes/footer.php");
    ?>
  </div>


  <!--Bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
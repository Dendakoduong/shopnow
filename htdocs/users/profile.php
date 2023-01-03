<!--connect php-->
<?php
include("../includes/connect.php");
include("../functions/common_function.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_SESSION['username'] ?>'s account</title>
  <!--Bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--Font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--Custom css-->
  <link rel="stylesheet" href="/css/style.css">
  <style>
    body {
      overflow-x: hidden;
    }

    .profile_img {
      width: 90%;
      /* height: 100%; */
      margin: auto;
      display: block;
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
            <a class="nav-link active" href="../index.php">ShopNow <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../display_all.php">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../feedback.php">Feedback</a>
          </li>

          <!--<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Account
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="./users/user_login.php">Sign in</a>
              <a class="dropdown-item" href="./users/user_registration.php">My account</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>-->

          <li class="nav-item">
            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../checkout.php">Total price: <?php total_cart_price(); ?> USD</a>
          </li>
        </ul>
        <!--search-->
        <form class="form-inline my-2 my-lg-0" action="../search_product.php" method="GET">
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
          <a class='nav-link' href='logout.php'>Sign out</a>
        </li>";
        }
        ?>
      </ul>
    </nav>



    <!--fourth child-->
    <div class="row">
      <div class="col-md-2 p-0">
        <ul class="navbar-nav bg-success text-center" style="height:100vh ;">
          <li class="nav-item bg-success">
            <a class="nav-link text-light" href="#">
              <h4>Your profile</h4>
            </a>
          </li>
          <?php
          $username = $_SESSION['username'];
          $user_image = "Select * from `user_table` where username='$username'";
          $user_image = mysqli_query($con, $user_image);
          $row_image = mysqli_fetch_array($user_image);
          $user_image = $row_image['user_image'];
          echo "<li class='nav-item'><img src='./user_images/$user_image' class='profile_img my-4'  alt=''>
          </li>";
          ?>
          <li class="nav-item">
            <a class="nav-link text-light" href="profile.php">Pending orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="profile.php?edit_account">Edit account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="profile.php?myorders">My orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="profile.php?delete_account">Delete account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="logout.php">Log out</a>
          </li>
        </ul>
      </div>
      <div class="col-md-10">
        <?php
        get_user_order_details();
        if (isset($_GET['edit_account'])) {
          include("edit_account.php");
        }
        if (isset($_GET['myorders'])) {
          include("user_orders.php");
        }
        if (isset($_GET['delete_account'])) {
          include("delete_account.php");
        }
        ?>
      </div>
    </div>










    <!--end side nav -->
  </div>
  </div>

  <!--footer-->
  <?php
  include("../includes/footer.php");
  ?>
  </div>


  <!--Bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
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
  <title>ShopNow</title>
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
              <?php
              if (isset($_SESSION['username'])) {
                echo "<a class='dropdown-item' href='./users/profile.php'>My account</a>";
                echo "<a class='dropdown-item' href='./users/logout.php'>Sign out</a>";
              } else {
                echo "<a class='dropdown-item' href='./users/user_login.php'>Sign in</a>";
                echo "<a class='dropdown-item' href='./users/user_registration.php'>Sign up</a>";
              }
              ?>

              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="feedback.php">Feedback</a>
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
          <a class='nav-link' href='#'>Welcome to our website. Shop now for Christmas Day</a>
        </li>";
        } else {
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome, " . $_SESSION['username'] . ". Let's go shopping!</a>
        </li>";
        }
        ?>
      </ul>
    </nav>
    <!--Carousel-->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./images/Screenshot 2022-11-14 124447.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-info">Happy holiday</h5>
            <p class="text-info">Get new technology items for the Christmas! Shop now</p>
          </div>
        </div>
      </div>
    </div><br />
    <!--third child-->
    <div class="bg-light">
      <h3 class="text-center">Main store</h3>
      <p class="text-center">Products of the day. Browse now</p>
    </div><br />

    <!-- fourth child -->
    <div class="row px-5">
      <div class="col-md-10">
        <!-- product list -->
        <div class="row">
          <!--fetch product from database-->
          <?php
          getproducts(); //call function
          get_unique_categories();
          get_unique_brands();
          ?>


          <!--row end-->
        </div>
        <!--col end-->
      </div>

      <!--start side nav-->
      <div class="col-md-2" style="background-color: #e3f2fd;">
        <!-- brand show in side navbar-->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item">
            <a href="#" class="nav-link text-dark">
              <h4>Brand</h4>
            </a>
          </li>

          <?php
          getbrands(); //call function
          ?>
        </ul>

        <!--category-->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item">
            <a href="#" class="nav-link text-dark">
              <h4>Category</h4>
            </a>
          </li>
          <?php
          getcategories(); //call function
          ?>
        </ul>


        <!--end side nav -->
      </div>
    </div>

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
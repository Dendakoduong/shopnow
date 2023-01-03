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
  <title>Admin Panel</title>
  <!--Bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!--font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--Custom css-->
  <link rel="stylesheet" href="/css/style.css">
  <style>
    .admin_img {
      width: 100px;
      object-fit: contain;
    }

    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 60px;
      line-height: 60px;
    }

    body {
      overflow-x: hidden;
    }

    .product_img {
      width: 100px;
      object-fit: contain;
    }
  </style>
</head>

<body>
  <!--navbar-->
  <div class="container-fluid p-0">
    <!--first child-->
    <nav class="navbar navbar-expand-lg navbar-light bg-success" style="background-color: #F7CAC9">
      <div class="container-fluid">
        <img src="https://iili.io/p4Qtzg.png" alt="Logo" class="logo">
        <nav class="navbar navbar-expand-lg">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="./admin.php" class="nav-link">Admin Dashboard</a>
            </li>
          </ul>
        </nav>
      </div>
    </nav>
    <!--second child-->
    <div class="bg-light">
      <h3 class="text-center bg-success p-2">Manage details</h3>
    </div>
    <!--third child-->
    <div class="row">
      <div class="col-md-12 bg-success d-flex">
        <!--p-1-->
        <div class="px-4">
          <a href="#"><img src="../images/admin_Profilepic.png" class="admin_img"></a>
          <p class="text-light text-center">@<?php echo $_SESSION['admin_username'] ?></p>
        </div>
        <div class="button text-center">
          <button><a href="insert_products.php" class="nav-link text-dark bg-success my-1">Insert products</a></button>
          <button><a href="admin.php?view_products" class="nav-link text-dark bg-success my-1"> View products</a></button>
          <button><a href="admin.php?insert_category" class="nav-link text-dark bg-success my-1">Insert categories</a></button>
          <button><a href="admin.php?view_categories" class="nav-link text-dark bg-success my-1">View categories</a></button>
          <button><a href="admin.php?insert_brand" class="nav-link text-dark bg-success my-1">Insert brands</a></button>
          <button><a href="admin.php?view_brands" class="nav-link text-dark bg-success my-1">View brands</a></button>
          <button><a href="admin.php?list_orders" class="nav-link text-dark bg-success my-1">Order</a></button>
          <button><a href="admin.php?list_payments" class="nav-link text-dark bg-success my-1">Payment</a></button>
          <button><a href="admin.php?list_users" class="nav-link text-dark bg-success my-1">Users</a></button>
          <button><a href="admin_logout.php" class="nav-link text-dark bg-success my-1">Log out</a></button>
        </div>
      </div>
    </div>
    <!--4th child-->
    <div class="container my-3">
      <?php
      if (isset($_GET['insert_category'])) {
        include("insert_categories.php");
      }
      if (isset($_GET['insert_brand'])) {
        include("insert_brands.php");
      }
      if (isset($_GET['view_products'])) {
        include("view_products.php");
      }
      if (isset($_GET['edit_products'])) {
        include("edit_products.php");
      }
      if (isset($_GET['delete_product'])) {
        include("delete_product.php");
      }
      if (isset($_GET['view_categories'])) {
        include("view_categories.php");
      }
      if (isset($_GET['view_brands'])) {
        include("view_brands.php");
      }
      if (isset($_GET['edit_category'])) {
        include("edit_category.php");
      }
      if (isset($_GET['edit_brands'])) {
        include("edit_brands.php");
      }
      if (isset($_GET['delete_category'])) {
        include("delete_category.php");
      }
      if (isset($_GET['delete_brands'])) {
        include("delete_brands.php");
      }
      if (isset($_GET['list_orders'])) {
        include("list_orders.php");
      }
      if (isset($_GET['list_payments'])) {
        include("list_payments.php");
      }
      if (isset($_GET['list_users'])) {
        include("list_users.php");
      }
      ?>

    </div>

  </div>


  <!--footer-->

  </div>

  </div>



  <!--bootstrap js-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
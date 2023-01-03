<?php
$con = mysqli_connect('localhost', 'root', '', 'asm2_web');
if (!$con) {
  echo "disconnected to database";
}
include('common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in</title>
  <!--Bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--Font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--Custom css-->
  <style>
    body {
      overflow: hidden;
    }

    .bg-image-vertical {
      position: relative;
      overflow: hidden;
      background-repeat: no-repeat;
      background-position: right center;
      background-size: auto 100%;
    }

    @media (min-width: 1025px) {
      .h-custom-2 {
        height: 100%;
      }
    }

    .link {
      color: #e0b2a4;
      background-color: transparent;
      text-decoration: none;
    }
  </style>

  <!--css-->
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">

          <div class="px-5 ms-xl-4">
            <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #e0b2a4;"></i>
            <span class="h1 fw-bold mb-0" style="color: #e0b2a4;">ShopNow</span>
          </div>

          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

            <form style="width: 23rem;" action="" method="POST" enctype="multipart/form-data">

              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign in</h3>


              <div class="form-outline mb-4">
                <!--username filed-->
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control" placeholder="Enter your username" required="required" name="username" />
              </div>

              <!--password-->
              <div class="form-outline mb-4">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" id="user_password" class="form-control" placeholder="Enter your password" required="required" name="user_password" />
              </div>

              <div class="pt-1 mb-4">
                <input type="submit" value="Login" class="btn btn-light text-light btn-lg btn-block" name="user_login" style="background-color: #e0b2a4">
              </div>

              <p>Don't have an account? <a href="../../asm2_web/users/user_registration.php" class="link">Register here</a></p>
              <h2 class="small text-center">© ShopNow 2022. The image is for decorating purposes only. </h2>


            </form>

          </div>

        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="../images/rose.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
  </section>


</body>

</html>


<?php
if (isset($_POST['user_login'])) {
  $username = $_POST['username'];
  $user_password = $_POST['user_password'];
  $select_query = "Select * from `user_table` where username='$username'";
  $result = mysqli_query($con, $select_query);
  $row_count = mysqli_num_rows($result);
  $row_count = mysqli_num_rows($result);
  $row_data = mysqli_fetch_assoc($result);
  $user_ip = getIPAddress();

  //cart item
  $select_query_cart = "Select * from `cart_details` where ip_address='$user_ip'";
  $select_cart = mysqli_query($con, $select_query_cart);
  $row_count_cart = mysqli_num_rows($select_cart);
  if ($row_count > 0) {
    $_SESSION['username'] = $username;
    if (password_verify($user_password, $row_data['user_password'])) {
      //echo "<script> alert('Login successful!')</script>";
      if ($row_count == 1 and $row_count_cart == 0) {
        $_SESSION['username'] = $username;
        echo "<script> alert('Login successful!')</script>";
        echo "<script> window.open('../index.php','_self')</script>";
      } else {
        $_SESSION['username'] = $username;
        echo "<script> alert('Login successful! Redirecting to Payment...')</script>";
        echo "<script> window.open('payment.php','_self')</script>";
      }
    } else {
      echo "<script> alert('Wrong username/password')</script>";
    }
  } else {
    echo "<script> alert('Wrong username/password')</script>";
  }
}
?>
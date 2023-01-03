<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <!--Bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--Font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--Custom css-->
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <div class="container-fluid my-3">
    <h2 class="text-center"> Sign up</h2>
    <div class="row d-flex align-items-center justify-content-center">
      <div class="col-lg-12 col-xl-6">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-outline mb-4">
            <!--username filed-->
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" class="form-control" placeholder="Enter your username" required="required" name="username" />
          </div>
          <!--email-->
          <div class="form-outline mb-4">
            <label for="user_email" class="form-label">Email</label>
            <input type="email" id="user_email" class="form-control" placeholder="Enter your email" required="required" name="user_email" />
          </div>
          <!--upload image-->
          <div class="form-outline mb-4">
            <label for="user_image" class="form-label">User image</label>
            <input type="file" id="user_image" class="form-control" required="required" name="user_image" />
          </div>
          <!--password-->
          <div class="form-outline mb-4">
            <label for="user_password" class="form-label" aria-describedby="passwordHelpBlock">Password</label>
            <input type="password" id="user_password" class="form-control" placeholder="Enter your password" required="required" name="user_password" />
          </div>
          <!--pass help-->
          <div id="passwordHelpBlock" class="form-text"><small>Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </small>
          </div> <br />
          <!--confirm password-->
          <div class="form-outline mb-4">
            <label for="user_confirm_password" class="form-label">Confirm password</label>
            <input type="password" id="user_confirm_password" class="form-control" placeholder="Confirm your password" required="required" name="user_confirm_password" />
          </div>
          <!--address-->
          <div class="form-outline mb-4">
            <label for="user_address" class="form-label">Address</label>
            <input type="text" id="user_address" class="form-control" placeholder="Enter your address" required="required" name="user_address" />
          </div>
          <!--phone-->
          <div class="form-outline mb-4">
            <label for="user_mobile" class="form-label">Phone</label>
            <input type="text" id="user_mobile" class="form-control" placeholder="Enter your phone" required="required" name="user_mobile" />
          </div>
          <!--submit button-->
          <div class="mt-4 pt-2 text-center">
            <input type="submit" value="Register" class="bg-primary text-light py-2 px-3 border-0" name="user_register" class=""> <br /><br />
            <!--text under button login-->
            <p>Already have an account?<a href="user_login.php"> Sign in</a> </p>
          </div>

        </form>
      </div>
    </div>
  </div>

  <?php
  include("../includes/footer.php");
  ?>
  </div>

</body>

</html>
<!--php code-->
<?php
if (isset($_POST['user_register'])) {
  $username = $_POST['username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
  $user_confirm_password = $_POST['user_confirm_password'];
  $user_address = $_POST['user_address'];
  $user_mobile = $_POST['user_mobile'];
  $user_image = $_FILES['user_image']['name'];
  $user_image_tmp = $_FILES['user_image']['tmp_name'];
  $user_ip = getIPAddress();

  //select query
  $select_query = "Select * from `user_table` where username='$username' or user_email='$user_email'";
  $result = mysqli_query($con, $select_query);
  $rows_count = mysqli_num_rows($result);
  if ($rows_count > 0) {
    echo "<script> alert('Username or Email already existed. Please try another username or email!')</script>";
  } else if ($user_password != $user_confirm_password) {
    echo "<script> alert('Password does not match!')</script>";
  } else {
    // insert_query
    move_uploaded_file($user_image_tmp, "./user_images/$user_image");
    $insert_query = "insert into `user_table` (username, user_email, user_password, user_image,user_ip, user_address, user_mobile) values ('$username', '$user_email', '$hash_password', '$user_image',
'$user_ip', '$user_address', '$user_mobile')";
    $sql_execute = mysqli_query($con, $insert_query);
    if ($sql_execute) {
      echo "<script> alert('Registration successful!')</script>";
      echo "<script> window.open('user_login.php', '_self')</script>";
    } else {
      echo "<script> alert('Registration failed!')</script>";
    }
  }

  //select cart item
  $select_cart_items = "Select * from `cart_details` where ip_address='$user_ip'";
  $result_cart = mysqli_query($con, $select_cart_items);
  $rows_count = mysqli_num_rows($result_cart);
  if ($rows_count > 0) {
    $_SESSION['username'] = $username;
    echo "<script> alert('You have items in your cart')</script>";
    echo "<script>window.open('../checkout.php','_self'></script>";
  } else {
    $_SESSION['username'] = $username;
    echo "<script>window.open('../index.php,'_self')</script>";
  }
}
?>
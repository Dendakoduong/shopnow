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
  <title>Sign up (Admin)</title>
  <!--Bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!--font awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--Custom css-->
  <style>
    body {
      overflow-x: hidden;
    }
  </style>
</head>

<body>
  <div class="container-fluid m-3">
    <h2 class="text-center mb-5">Admin registration</h2>
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-xl-5">
        <img src="../images/cod-istock.jpg" alt="" class='img-fluid'>
      </div>
      <div class="col-lg-6 col-xl-4">
        <form action="" method="POST">
          <div class="outline mb-4">
            <label for="admin_username" class="form-label">Username</label>
            <input type="text" id="admin_username" name="admin_username" placeholder="Enter username" required="required" class="form-control">
          </div>
          <div class="form-outline mb-4">
            <form action="" method="POST">
              <div class="outline mb-4">
                <label for="admin_email" class="form-label">Email</label>
                <input type="text" id="admin_email" name="admin_email" placeholder="Enter email" required="required" class="form-control">
              </div>
              <div class="form-outline mb-4">
                <form action="" method="POST">
                  <div class="outline mb-4">
                    <label for="admin_password" class="form-label">Password</label>
                    <input type="password" id="password" name="admin_password" placeholder="Enter password" required="required" class="form-control">
                  </div>
                  <div class="form-outline mb-4">
                    <form action="" method="POST">
                      <div class="outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Re-Enter password" required="required" class="form-control">
                      </div>
                      <div class="text-center">
                        <input type="submit" class="bg-primary text-light py-2 px-3 border-0" name="submit" value="Submit">
                        <p class="small fw-bold mt-2 pt-1">Already have account? <a href="admin_login.php">Log in</a></p>
                      </div>
                    </form>
                  </div>
              </div>
          </div>

</body>

</html>

<!--php code-->
<?php
if (isset($_POST['submit'])) {
  $admin_username = $_POST['admin_username'];
  $admin_email = $_POST['admin_email'];
  $admin_password = $_POST['admin_password'];
  $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);
  $confirm_password = $_POST['confirm_password'];


  //select query
  $select_query = "Select * from `admin_table` where admin_username='$admin_username' or admin_email='$admin_email'";
  $result = mysqli_query($con, $select_query);
  $rows_count = mysqli_num_rows($result);
  if ($rows_count > 0) {
    echo "<script> alert('Username or Email already existed. Please try another username or email!')</script>";
  } else if ($admin_password != $confirm_password) {
    echo "<script> alert('Password does not match!')</script>";
  } else {
    // insert_query
    $insert_query = "insert into `admin_table` (admin_username, admin_email, admin_password) values ('$admin_username', '$admin_email', '$hash_password')";
    $sql_execute = mysqli_query($con, $insert_query);
    if ($sql_execute) {
      echo "<script> alert('Registration successful!')</script>";
      echo "<script> window.open('admin_login.php', '_self')</script>";
    } else {
      echo "<script> alert('Registration failed!')</script>";
    }
  }
}
?>
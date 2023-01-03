<?php
$con = mysqli_connect('localhost', 'root', '', 'asm2_web');
if (!$con) {
  echo "disconnected to database";
}
include('../functions/common_function.php');
@session_start();
?>


<?php
if (isset($_POST['admin_login'])) {
  $admin_username = $_POST['admin_username'];
  $admin_password = $_POST['admin_password'];
  $select_query = "Select * from `admin_table` where admin_username='$admin_username'";
  $result = mysqli_query($con, $select_query);
  $row_count = mysqli_num_rows($result);
  $row_data = mysqli_fetch_assoc($result);

  if ($row_count > 0) {
    $_SESSION['admin_username'] = $admin_username;
    if (password_verify($admin_password, $row_data['admin_password'])) {
      //echo "<script> alert('Login successful!')</script>";
      if ($row_count == 1) {
        $_SESSION['admin_username'] = $admin_username;
        echo "<script> alert('Login successful!')</script>";
        echo "<script> window.open('admin.php','_self')</script>";
      }
    } else {
      echo "<script> alert('Wrong username/password')</script>";
    }
  } else {
    echo "<script> alert('Wrong username/password')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in (Admin)</title>
  <!--Bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--Font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--Custom css-->
  <style>
    body {
      overflow-x: hidden;
    }
  </style>

  <!--css-->
  <link rel="stylesheet" href="/css/style.css">
</head>


<body>
  <section class="vh-100" style="background-color: #F7CAC9;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://images.unsplash.com/photo-1547496832-84e64458210a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Sign in</span>

                    </div>
                    <div class="form-outline mb-4">
                      <!--username filed-->
                      <label for="admin_username" class="form-label">Username</label>
                      <input type="text" id="admin_username" class="form-control" placeholder="Enter your username" required="required" name="admin_username" />
                    </div>

                    <!--password-->
                    <div class="form-outline mb-4">
                      <label for="admin_password" class="form-label">Password</label>
                      <input type="password" id="admin_password" class="form-control" placeholder="Enter your password" required="required" name="admin_password" />
                    </div>


                    <!--submit button-->
                    <div class="mt-4 pt-2 text-center">
                      <input type="submit" value="Login" class=" py-2 px-3 border-0" name="admin_login" class="" style="background-color: #F7CAC9" ;> <br /><br />
                    </div>

                    <!--sign up text-->
                    <div class=" mt-4 pt-2 text-center">
                      <p>Don't have an account?<a href="admin_registration.php"> Sign up</a> </p>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
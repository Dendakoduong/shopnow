<?php
$con = mysqli_connect('localhost', 'root', '', 'asm2_web');
if (!$con) {
  echo "disconnected to database";
}
include('common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment</title>
  <!--Bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
  body {
    overflow-x: hidden;
  }

  .payment_img {
    width: 90%;
    margin: auto;

  }
</style>

<body>
  <!--php code-->
  <?php
  $user_ip = getIPAddress();
  $get_user = "select * from `user_table` where user_ip='$user_ip'";
  $result = mysqli_query($con, $get_user);
  $run_query = mysqli_fetch_array($result);
  $user_id = $run_query['user_id'];

  ?>
  <div class="container">
    <h2 class="text-center text-primary">Choose payment method</h2>
    <div class="row d-flex justify-content-center allign-items-center my-5">
      <div class="col-md-6">
        <a href="https://www.paypal.com" target="_blank"><img src="../images/onlinepay.jpg" alt="" class="payment_img"></a>
        <h2 class="text-center text-info my-5">Online payment</h2>
      </div>
      <div class="col-md-6">
        <a href="order.php?user_id=<?php echo $user_id ?>" target="_blank"><img src="../images/codimg.jpg" alt="" class="payment_img"></a>
        <h2 class="text-center text-success my-5">Others</h2>
      </div>
    </div>
  </div>
</body>

</html>
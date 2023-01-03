<?php
include('../includes/connect.php');
session_start();
if (isset($_GET['order_id'])) {
  $order_id = $_GET['order_id'];
  //echo $order_id;
  $select_data = "Select * from `user_orders` where order_id= $order_id";
  $result = mysqli_query($con, $select_data);
  $row_fetch = mysqli_fetch_assoc($result);
  $invoice_number = $row_fetch['invoice_number'];
  $amount_due = $row_fetch['amount_due'];
  $total_products = $row_fetch['total_products'];
}

if (isset($_POST['confirm_payment'])) {
  $invoice_number = $_POST['invoice_number'];
  $amount = $_POST['amount'];
  $payment_mode = $_POST['payment_mode'];
  $insert_query = "INSERT INTO `user_payments`(`order_id`, `invoice_number`, `amount`, `payment_mode`) VALUES ('$order_id','$invoice_number','$amount','$payment_mode')";
  $result = mysqli_query($con, $insert_query);
  if ($result) {
    echo "<script>alert('Payment Success!')</script>";
    //echo "<h3 class='text-center' text-light>Payment Success!</h3>";
    echo "<script>window.open('profile.php?myorders','_self')</script>";
  }
  $update_orders = "UPDATE `user_orders` SET `order_status`='Complete' WHERE order_id='$order_id'";
  $result_orders = mysqli_query($con, $update_orders);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm</title>
  <!--Bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-secondary">
  <h1 class="text-center text-light">Payment</h1>
  <div class="container my-5">
    <form action="" method="POST">
      <div class="form-outline my-4 text-center w-50 m-auto">
        <label for="" class="text-light">Invoice number</label>
        <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>">
      </div>
      <div class="form-outline my-4 text-center w-50 m-auto">
        <label for="" class="text-light">Amount</label>
        <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $total_products ?>">
      </div> <br />
      <div class="form-outline my-4 text-center w-50 m-auto">
        <select name="payment_mode" class="form-select w-50 m-auto">
          <option>Select payment</option>
          <option>Card</option>
          <option>Banking</option>
          <option>Paypal</option>
          <option>Cash on Delivery (COD)</option>
          <option>Pay offline</option>
        </select>
      </div>
      <div class="form-outline my-4 text-center w-50 m-auto"> <br />
        <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
      </div>
    </form>
  </div>
</body>

</html>
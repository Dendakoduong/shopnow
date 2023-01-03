<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $username = $_SESSION['username'];
  $get_user = "SELECT * FROM `user_table` WHERE username='$username'";
  $result = mysqli_query($con, $get_user);
  $row_fetch = mysqli_fetch_assoc($result);
  $user_id = $row_fetch['user_id'];
  ?>
  <br />
  <h3 class="text-success text-center">All my orders</h3>
  <table class="table table-bordered mt-5">
    <thead class="bg-success text-white">
      <tr>

        <th>Order number</th>
        <th>Amount</th>
        <th>Total products</th>
        <th>Invoice number</th>
        <th>Date</th>
        <th>Status</th>
        <th>Received</th>
      </tr>
    </thead>
    <tbody class="bg-white">
      <?php
      $get_order_details = "SELECT * FROM `user_orders` WHERE user_id='$user_id'";
      $result_order = mysqli_query($con, $get_order_details);
      while ($row_orders = mysqli_fetch_assoc($result_order)) {
        $order_id = $row_orders['order_id'];
        $amount_due = $row_orders['amount_due'];
        $amount_due = $row_orders['amount_due'];
        $total_products = $row_orders['total_products'];
        $invoice_number = $row_orders['invoice_number'];
        $order_status = $row_orders['order_status'];
        if ($order_status == 'pending') {
          $order_status = "Incomplete";
        } else {
          $order_status = "Complete";
        }
        $order_date = $row_orders['order_date'];
        //$number = 1;<th>No</th><td>$number</td>
        echo " <tr>
        
        <td>$order_id</td>
        <td>$amount_due USD</td>
        <td>$total_products</td>
        <td>$invoice_number</td>
        <td>$order_date</td>
        <td>$order_status</td>";
      ?>

      <?php
        if ($order_status == 'Complete') {
          echo "<td>Paid</td>";
        } else {
          echo " <td><a href='confirm_payment.php?order_id=$order_id' class='text-primary'>Confirm</a></td></tr>";
        }
      }
      //$number++;
      ?>
    </tbody>
  </table>
</body>

</html>
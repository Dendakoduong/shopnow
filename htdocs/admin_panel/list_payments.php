<h3 class="text-center text-success">All payments</h3>
<table class="table table-bordered mt-5">
  <thead class="bg-success">

    <?php
    $get_payments = "Select * from `user_payments`";
    $result = mysqli_query($con, $get_payments);
    $row_count = mysqli_num_rows($result);


    if ($row_count == 0) {
      echo "<h2 class='text-danger text-center mt-5'>No payments yet</h2>";
    } else {
      echo "<tr>
      <th>No</th>
      <th>Invoice number</th>
      <th>Amount</th>
      <th>Payment method</th>
      <th>Order Date</th>
      <th>Delete</th>
      </tr>
      </thead>
      <tbody class='bg-secondary text-light'>";
      $number = 0;
      while ($row_data = mysqli_fetch_assoc($result)) {
        $order_id = $row_data['order_id'];
        $payment_id = $row_data['payment_id'];
        $amount = $row_data['amount'];
        $invoice_number = $row_data['invoice_number'];
        $payment_method = $row_data['payment_mode'];
        $date = $row_data['date'];
        $number++;
        echo " <tr>
        <td>$number</td>
        <td>$invoice_number</td>
        <td>$amount</td>
        <td>$payment_method</td>
        <td>$date</td>
        <td><a href='' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
      </tr>";
      }
    }

    ?>


    </tbody>
</table>
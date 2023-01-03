<h2 class="text-center text-success">All products</h2>
<table class="table table-bordered mt-5">
  <thead class="">
    <tr>
      <th>Product ID</th>
      <th>Name</th>
      <th>Image</th>
      <th>Price</th>
      <th>Sold</th>
      <th>Status</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody class="bg-secondary text-light">
    <?php
    $get_products = "SELECT * FROM `products`";
    $result = mysqli_query($con, $get_products);
    $number = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      $product_id = $row['product_id'];
      $product_title = $row['product_title'];
      $product_image1 = $row['product_image1'];
      $product_price = $row['product_price'];
      $status = $row['status'];
      $number++;
    ?>
      <tr class='text-center'>
        <td><?php echo $number ?></td>
        <td><?php echo $product_title ?></td>
        <td><img src='./product_img/<?php echo $product_image1 ?>' class='product_img' /></td>
        <td><?php echo $product_price ?>$</td>
        <td><?php
            $get_count = "SELECT * FROM `orders_pending` WHERE product_id='$product_id'";
            $result_count = mysqli_query($con, $get_count);
            $row_count = mysqli_num_rows($result_count);
            echo $row_count;
            ?></td>
        <td><?php echo $status ?></td>
        <td><a href='admin.php?edit_products=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='admin.php?delete_product=<?php echo $product_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
      </tr>
    <?php
    }
    ?>

  </tbody>
</table>
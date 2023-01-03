<style>
  .product_img {
    width: 100px;
    object-fit: contain;
  }
</style>
<h3 class="text-center text-success">All users</h3>
<table class="table table-bordered mt-5">
  <thead class="bg-success">

    <?php
    $get_users = "Select * from `user_table`";
    $result = mysqli_query($con, $get_users);
    $row_count = mysqli_num_rows($result);


    if ($row_count == 0) {
      echo "<h2 class='text-danger text-center mt-5'>No users yet</h2>";
    } else {
      echo "<tr>
      <th>No</th>
      <th>Username</th>
      <th>Email</th>
      <th>Image</th>
      <th>Address</th>
      <th>Phone</th>
      <th>Delete</th>
      </tr>
      </thead>
      <tbody class='bg-secondary text-light'>";
      $number = 0;
      while ($row_data = mysqli_fetch_assoc($result)) {
        $user_id = $row_data['user_id'];
        $username = $row_data['username'];
        $user_email = $row_data['user_email'];
        $user_image = $row_data['user_image'];
        $user_address = $row_data['user_address'];
        $user_mobile = $row_data['user_mobile'];
        $number++;
        echo " <tr>
        <td>$number</td>
        <td>$username</td>
        <td>$user_email</td>
        <td><img src='../users/user_images/$user_image' alt='$username' class='product_img'/></td>
        <td>$user_address</td>
        <td>$user_mobile</td>
        <td><a href='' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
      </tr>";
      }
    }

    ?>


    </tbody>
</table>
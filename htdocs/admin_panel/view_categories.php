<h2 class="text-center text-success">All categories</h2>
<table class="table table-bordered mt-5">
  <thead class="bg-success">
    <tr class="text-center">
      <th>No</th>
      <th>Category title</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

  </thead>
  <tbody class="bg-secondary text-light">
    <?php
    $select_cat = "SELECT * FROM `categories`";
    $result = mysqli_query($con, $select_cat);
    $number = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      $cat_id = $row['category_id'];
      $cat_title = $row['category_title'];
      $number++;
    ?>
      <tr class="text-center">
        <td><?php echo $number; ?></td>
        <td><?php echo $cat_title ?></td>
        <td><a href='admin.php?edit_category=<?php echo $cat_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='admin.php?delete_category=<?php echo $cat_id ?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
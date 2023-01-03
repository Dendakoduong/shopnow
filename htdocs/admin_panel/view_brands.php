<h2 class="text-center text-success">All brands</h2>
<table class="table table-bordered mt-5">
  <thead class="bg-success">
    <tr class="text-center">
      <th>No</th>
      <th>Brand title</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

  </thead>
  <tbody class="bg-secondary text-light">
    <?php
    $select = "SELECT * FROM `brands`";
    $result = mysqli_query($con, $select);
    $number = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      $brand_id = $row['brand_id'];
      $brand_title = $row['brand_title'];
      $number++;
    ?>
      <tr class="text-center">
        <td><?php echo $number; ?></td>
        <td><?php echo $brand_title ?></td>
        <td><a href='admin.php?edit_brands=<?php echo $brand_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='admin.php?delete_brands=<?php echo $brand_id ?>' type="button" class="text-light" data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./admin.php?view_brands" class="text-light text-decoration-none">No</a></button>
        <button type="button" class="btn btn-primary"><a href='admin.php?delete_brands=<?php echo $brand_id ?>' class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div>
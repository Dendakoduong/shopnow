<?php
include("../includes/connect.php");
if (isset($_POST['insert_cat'])) {
  $category_title = $_POST['cat_title'];
  // select query from db
  $select_query = "SELECT * FROM `categories` WHERE category_title = '$category_title'";
  $result_select = mysqli_query($con, $select_query);
  $number = mysqli_num_rows($result_select);
  if ($number > 0) {
    echo "<script>alert('The category is exist in database!')</script>";
  } else  $insert_query = "insert into `categories` (category_title) values ('$category_title')";
  $result = mysqli_query($con, $insert_query);
  if ($result) {
    echo "<script>alert('New category has been inserted!')</script>";
  }
}
?>

<h2 class="text-center">Insert category</h2>
<form action="" method="post" class="mb-2">

  <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-success" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" name="cat_title" placeholder="Categories" aria-label="Categories" aria-describedby="basic-addon1">
  </div>
  <div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="bg-success border-0 p-2 my-3" name="insert_cat" value="Insert Categories">

  </div>
</form>
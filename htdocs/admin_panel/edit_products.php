<?php
if (isset($_GET['edit_products'])) {
  $edit_id = $_GET['edit_products'];
  $get_data = "SELECT * FROM `products` WHERE product_id='$edit_id'";
  $result = mysqli_query($con, $get_data);
  $row = mysqli_fetch_assoc($result);
  $product_title = $row['product_title'];
  $product_description = $row['product_description'];
  $product_keywords = $row['product_keyword'];
  $category_id = $row['category_id'];
  $brand_id = $row['brand_id'];
  $product_image1 = $row['product_image1'];
  $product_image2 = $row['product_image2'];
  $product_image3 = $row['product_image3'];
  $product_price = $row['product_price'];

  //fetch category
  $select_category = "SELECT * FROM `categories` WHERE category_id='$category_id'";
  $result_category = mysqli_query($con, $select_category);
  $row_category = mysqli_fetch_assoc($result_category);
  $category_title = $row_category['category_title'];

  //fetch brand
  $select_brand = "SELECT * FROM `brands` WHERE brand_id='$brand_id'";
  $result_brand = mysqli_query($con, $select_brand);
  $row_brand = mysqli_fetch_assoc($result_brand);
  $brand_title = $row_brand['brand_title'];
}
?>

<div class="container mt-5">
  <h2 class="text-center">Edit product</h2>
  <form action="" method="POST" enctype="multipart/form-data">

    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_title" class="form-label">Title</label>
      <input type="text" name="" id="product_title" name="product_title" value="<?php echo $product_title ?>" class="form-control" required="required">
    </div>
    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_description" class="form-label">Description</label>
      <input type="text" name="" id="product_description" name="product_description" class="form-control" required="required" value="<?php echo $product_description ?>">
    </div>
    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_keywords" class="form-label">Keywords</label>
      <input type="text" name="" id="product_keywords" name="product_keywords" class="form-control" required="required" value="<?php echo $product_keywords ?>">
    </div>

    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_category" class="form-label">Category</label>
      <select name="product_category" class="form-select">
        <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
        <?php
        $select_category_all = "Select * from `categories`";
        $result_category_all = mysqli_query($con, $select_category_all);
        while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
          $category_title = $row_category_all['category_title'];
          $category_id = $row_category_all['category_id'];
          echo " <option value='$category_id'>$category_title</option>";
        };
        ?>

      </select>
    </div>

    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_brands" class="form-label">Brand</label>
      <select name="product_brands" class="form-select">
        <option value="<?php echo $brand_title ?>"><?php echo $brand_title ?></option>
        <?php
        $select_brand_all = "Select * from `brands`";
        $result_brand_all = mysqli_query($con, $select_brand_all);
        while ($row_brand_all = mysqli_fetch_assoc($result_brand_all)) {
          $brand_title = $row_brand_all['brand_title'];
          $brand_id = $row_brand_all['brand_id'];
          echo " <option value='$brand_id'>$brand_title</option>";
        };
        ?>
      </select>
    </div>

    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_image1" class="form-label">Image 1</label>
      <div class="d-flex">
        <input type="file" name="" id="product_image1" name="product_image1" class="form-control w-90 m-auto" required="required">
        <img src="./product_img/<?php echo $product_image1 ?>" alt="" class="product_img">
      </div>
    </div>
    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_image2" class="form-label">Image 2</label>
      <div class="d-flex">
        <input type="file" name="" id="product_image2" name="product_image2" class="form-control w-90 m-auto" required="required">
        <img src="./product_img/<?php echo $product_image2 ?>" alt="" class="product_img">
      </div>
    </div>
    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_image3" class="form-label">Image 3</label>
      <div class="d-flex">
        <input type="file" name="" id="product_image3" name="product_image3" class="form-control w-90 m-auto" required="required">
        <img src="./product_img/<?php echo $product_image3 ?>" alt="" class="product_img">
      </div>
    </div>
    <div class="form-outline w-50 m-auto mb-4">
      <label for="product_price" class="form-label">Price (USD)</label>
      <input type="text" name="" id="product_price" name="product_price" class="form-control" required="required" value="<?php echo $product_price ?>">
    </div>
    <div class="w-50 m-auto text-center">
      <input type="submit" name="edit_product" value="Update" class="btn btn-success px-3 mb-3">
    </div>

  </form>
</div>

<!--editing product-->
<?php
if (isset($_POST['edit_product'])) {
  $product_title = $_POST['product_title'];
  $product_description = $_POST['product_description'];
  $product_keywords = $_POST['product_keywords'];
  $product_category = $_POST['product_category'];
  $product_brands = $_POST['product_brands'];
  $product_price = $_POST['product_price'];

  $product_image1 = $_FILES['product_image1']['name'];
  $product_image2 = $_FILES['product_image2']['name'];
  $product_image3 = $_FILES['product_image3']['name'];

  $temp_image1 = $_FILES['product_image1']['tmp_name'];
  $temp_image2 = $_FILES['product_image2']['tmp_name'];
  $temp_image3 = $_FILES['product_image3']['tmp_name'];

  //check field is empty or not
  if ($product_title = '' or $product_description = '' or $product_keywords = '' or $product_category = '' or $product_brands = '' or $product_image1 = '' or $product_image2 = '' or $product_image3 = '' or $product_price = '') {
    echo "<script>alert('Please fill all the fields')</script>";
  } else {
    move_uploaded_file($temp_image1, "./product_img/$product_image1");
    move_uploaded_file($temp_image2, "./product_img/$product_image2");
    move_uploaded_file($temp_image3, "./product_img/$product_image3");
    // query to update products
    $update_product = "update `products` set product_title='$product_title', product_description='$product_description',product_keyword='$product_keywords', category_id='$product_category', brand_id='$product_brands',product_image1='$product_image1',product_image2='$product_image2',product_image3='$product_image3', product_price ='$product_price', date=NOW() where product_id=$edit_id";
    $result_update = mysqli_query($con, $update_product);
    if ($result_update) {
      echo "<script>alert('Product updated successfully')</script>";
      echo "<script>window.open('./insert_products.php','_self')</script>";
    } else {
      echo "<script>alert('Product not updated')</script>";
    }
  }
}
?>
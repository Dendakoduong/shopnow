<?php
include("../includes/connect.php");
if (isset($_POST['insert_product'])) {
  $product_title = $_POST['product_title'];
  $product_description = $_POST['product_description'];
  $product_keywords = $_POST['product_keyword'];
  $product_category = $_POST['product_category'];
  $product_brands = $_POST['product_brand'];
  $product_price = $_POST['product_price'];
  $product_staus = 'true';
  // accessing images
  $product_image1 = $_FILES['product_image1']['name'];
  $product_image2 = $_FILES['product_image2']['name'];
  $product_image3 = $_FILES['product_image3']['name'];
  // accesing image tmp name
  $temp_image1 = $_FILES['product_image1']['tmp_name'];
  $temp_image2 = $_FILES['product_image2']['tmp_name'];
  $temp_image3 = $_FILES['product_image3']['tmp_name'];
  // checking empty condition
  if ($product_title == '' or $product_description == '' or $product_keywords == '' or $product_category == '' or $product_brands == '' or $product_price == '' or $product_image1 == '' or $product_image2 == '' or $product_image3 == '') {
    echo "<script> alert('Please fill all the fields!')</script>";
    exit();
  } else {
    move_uploaded_file($temp_image1, "./product_img/$product_image1");
    move_uploaded_file($temp_image2, "./product_img/$product_image2");
    move_uploaded_file($temp_image3, "./product_img/$product_image3");
    // insert query
    $insert_products = "insert into `products` (product_title,product_description,product_keyword,category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status) values ('$product_title','$product_description','$product_keywords','$product_category','$product_brands','$product_image1','$product_image2','$product_image3','$product_price', NOW(),'$product_staus')";
    $result_query = mysqli_query($con, $insert_products);
    if ($result_query) {
      echo "<script> alert('Product has been inserted successfully')</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert product</title>
  <!--Bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--Font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--Custom css-->
  <link rel="stylesheet" href="../css/style.css">

</head>

<body class="bg-light">
  <div class="container mt-3">
    <h1 class="text-center">Add product</h1>
    <!--form-->
    <form action="" method="POST" enctype="multipart/form-data">
      <!--title-->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_title" class="form-label">Title</label>
        <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" required="required">
      </div><br />
      <!--description-->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_description" class="form-label">Description</label>
        <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter product description" required="required">
      </div><br />
      <!--keyword-->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_keyword" class="form-label">Keyword</label>
        <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="Enter product keyword" required="required">
      </div><br />
      <!--brands list-->
      <div class="form-outline mb-4 w-50 m-auto">
        <select name="product_brand" class="form-control">
          <option value="">Select brand</option>
          <?php
          $select_query = "Select * from `brands`";
          $result_query = mysqli_query($con, $select_query);
          while ($row = mysqli_fetch_array($result_query)) {
            $brand_title = $row['brand_title'];
            $brand_id = $row['brand_id'];
            echo "<option value='$brand_id'>$brand_title</option>";
          }
          ?>
        </select>
      </div> <br />
      <!--select category-->
      <div class="form-outline mb-4 w-50 m-auto">
        <select name="product_category" class="form-control">
          <option value="">Select category</option>
          <?php
          $select_query = "Select * from `categories`";
          $result_query = mysqli_query($con, $select_query);
          while ($row = mysqli_fetch_array($result_query)) {
            $category_title = $row['category_title'];
            $category_id = $row['category_id'];
            echo "<option value='$category_id'>$category_title</option>";
          }
          ?>
        </select>
      </div> <br />
      <!-- Image 1 -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image1" class="form-label">Product image 1</label>
        <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
      </div><br />
      <!-- Image 2 -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image2" class="form-label">Product image 2</label>
        <input type="file" name="product_image2" id="product_image1" class="form-control" required="required">
      </div><br />
      <!-- Image 3 -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image3" class="form-label">Product image 3</label>
        <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
      </div><br />
      <!--price-->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_price" class="form-label">Price</label>
        <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" required="required">
      </div> <br />
      <!--submit button-->
      <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" name="insert_product" value="Submit" class="btn btn-success">
      </div>

    </form>
  </div>

</body>

</html>
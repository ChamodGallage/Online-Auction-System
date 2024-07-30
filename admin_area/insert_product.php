<?php
include('../includes/connect.php');

if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // Accessing images
    $temp_image1 = $_FILES['product_image1']['name'];
    $temp_image2 = $_FILES['product_image2']['name'];
    $temp_image3 = $_FILES['product_image3']['name'];

    // Accessing image tmp names
    $product_image1 = $_FILES['product_image1']['tmp_name'];
    $product_image2 = $_FILES['product_image2']['tmp_name'];
    $product_image3 = $_FILES['product_image3']['tmp_name'];

    // Checking empty condition
    if ($product_title == "" || $product_description == "" || $product_keywords == "" ||
        $product_category == "" || $product_price == "" ||
        $product_image1 == "" || $product_image2 == "" || $product_image3 == "") {
        echo "<script>alert('Please fill all the available fields');</script>";
        exit();
    } else {
        move_uploaded_file($product_image1, "./product_images/$temp_image1");
        move_uploaded_file($product_image2, "./product_images/$temp_image2");
        move_uploaded_file($product_image3, "./product_images/$temp_image3");

        // Insert query
        $insert_products = "INSERT INTO `products` (product_title, product_description, product_keywords, category_id, product_image1, product_image2, product_image3, product_price, date, status) VALUES ('$product_title', '$product_description', '$product_keywords', '$product_category', '$temp_image1', '$temp_image2', '$temp_image3', '$product_price', NOW(), '$product_status')";
        $result_query = mysqli_query($con, $insert_products);
        if ($result_query) {
            echo "<script>alert('Successfully inserted the products')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert products</title>
     <!--bootstrap css link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css file-->
    <link rel="stylesheet" href="../homestyle.css">
    <link rel="stylesheet" href="./adminstyle.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>
            <!--keywords-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>
            <!--categories-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select Category</option>
                    <?php 
                    $select_query = "SELECT * FROM categories"; 
                    $result_query = mysqli_query($con, $select_query);
                    while($row = mysqli_fetch_assoc($result_query)){
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>"; // Added category_id as value
                    }
                    ?>
                </select>
            </div>
            <!--image 1-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>
            <!--image 2-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">
            </div>
            <!--image 3-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">
            </div>
            <!--price-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            <!--submit button-->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
            </div>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    // echo $edit_id;
    $get_data = "SELECT * FROM `products` WHERE product_id = $edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    echo $product_title;
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $product_price = $row['product_price'];
}

// Fetching category name
$select_category = "SELECT * FROM `categories` WHERE category_id = $category_id";
$result_category = mysqli_query($con, $select_category);
$row_category = mysqli_fetch_assoc($result_category);
$category_title = $row_category['category_title'];

?>

<div class="container mt-5">
    <h1 class="text-center">Edit Auction Products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" id="product_title" name="product_title" value="<?php echo $product_title ?>" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label">Product Description</label>
            <input type="text" id="product_desc" name="product_desc" value="<?php echo $product_description ?>" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" id="product_keywords" name="product_keywords" value="<?php echo $product_keywords ?>" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Product category</label>
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
                <?php
                $select_category_all = "SELECT * FROM `categories`";
                $result_select_category_all = mysqli_query($con, $select_category_all);
                while ($row_select_category_all = mysqli_fetch_assoc($result_select_category_all)) {
                    $category_title = $row_select_category_all['category_title'];
                    $category_id = $row_select_category_all['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product price</label>
            <input type="text" id="product_price" name="product_price" value="<?php echo $product_price ?>" class="form-control" required="required">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" id="edit_product" name="edit_product" class="btn btn-success px-3 mb-3" value="Update product">
        </div>
    </form>
</div>

<!--editing products-->
<?php
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_desc = $_POST['product_desc'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
   
    // Checking for empty fields
    if ($product_title == "" || $product_desc == "" || $product_keywords == "" ||
        $product_category == "" || $product_price == "") {
        
        echo "<script>alert('Please fill all the fields and continue the process')</script>";
    } else {
        // Query to update products
        $update_product = "UPDATE `products` SET 
            product_title='$product_title',
            product_description='$product_desc',
            product_keywords='$product_keywords',
            category_id='$product_category',
            product_price='$product_price',
            date=NOW()
            WHERE product_id=$edit_id";

        $result_update = mysqli_query($con, $update_product);

        if ($result_update) {
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        }
    }
}
?>

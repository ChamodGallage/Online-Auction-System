<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 class="text-center text-success">All Products</h3>
    <table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
    <?php
$get_products = "SELECT * FROM products";
$result = mysqli_query($con, $get_products);
$number=0;
while ($row = mysqli_fetch_assoc($result)) {
    $product_id = $row['product_id'];
    $product_title = $row['product_title'];
    $product_price = $row['product_price'];
    $number++;
    ?>
    <tr class='text-center'>
    <td><?php echo $number; ?></td>
    <td><?php echo $product_title; ?></td>
    <td><?php echo $product_price; ?>/-</td>
        <td><input type="submit" value="Edit" class="bg-success px-3 py-2 border-0 mx-3" name="Edit" onclick="window.location.href='index.php?edit_products=<?php echo $product_id ?> '">
</td>
        <td><input type="submit" value="Delete" class="bg-danger px-3 py-2 border-0 mx-3" name="Delete" onclick="window.location.href='index.php?delete_product=<?php echo $product_id ?> '"></td>
        
    </tr>
    <?php
}
?>

    </tbody>
</table>


</body>
</html>
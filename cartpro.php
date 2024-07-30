<!--connect file-->
<?php
include('./includes/connect.php');
include('functions/common_function.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Auction Bids details</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS file -->
    <link rel="stylesheet" href="homestyle.css"> 
</head>
<body>
     <!-- Navbar -->
     <div class="container-fluid p-0">
        <!-- First child -->
        <nav class="navbar navbar-expand-lg" style="background-color: #0c343d;">
            <div class="container-fluid">
                <a href="#"><img src="img/logopro.PNG" class="logo" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="myfirstphp.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Auctions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fas fa-cart-plus"></i><sup>1</sup></a>
                        </li>
                    </ul>
                   
                </div>
            </div>
        </nav>

<!--calling cart function-->
          <?php
           cart();
          ?>
        <!-- Second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
            <?php
                        if (!isset($_SESSION['username'])) {
                            echo '<a class="nav-link" href="./users_area/user_login.php">Welcome Guest</a>';
                        } else {
                            echo '<a class="nav-link" href="profile.php">Welcome ' . $_SESSION['username'] . '</a>';
                        }
                
                if(!isset ($_SESSION['username'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                </li>";
                }else{
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                </li>";
                }

                ?>
            </ul>
        </nav>


<!-- Third child -->
        <section id="product1" class="section-p1">
    <h2>Watched Item List</h2>
    <p>Bid Win Smile</p>

<!--fourth child_table-->
<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                    <th colspan="2">Operation</th>
                </tr>
            </thead>
            <tbody>
                <!--php code to dispaly dynamic data-->
                <?php
                 global $con;
                 $get_ip_address = getIPAddress();
                 $total_price= 0;
                 $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
                 $result = mysqli_query($con, $cart_query);
                 
                 while($row = mysqli_fetch_array($result)){
                     $product_id = $row['product_id'];
                     $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                     $result_products = mysqli_query($con, $select_products);
                     
                     while($row_product_price = mysqli_fetch_array($result_products)){
                         $product_price = array($row_product_price['product_price']); //[200]
                         $price_table=$row_product_price['product_price'];
                         $product_title=$row_product_price['product_title'];
                         $product_image1=$row_product_price['product_image1'];
                         $product_values = array_sum($product_price); //[200]
                         $total_price += $product_values; 
                   
                ?>

                <tr>
                <td><?php echo $product_title ?></td>
                    <td><img src="./img/product/<?php echo $product_image1 ?>" alt="" class="cart_img"></td>
                    <td><input type="text" name="qty" class="form-input w-50"></td>
                    <?php
                    $get_ip_address = getIPAddress();
                    if (isset($_POST['update_cart'])) {
                        $quantities = $_POST['qty'];
                        $update_cart = "UPDATE `cart_details` SET quantity = $quantities WHERE ip_address = '$get_ip_address'";
                        $result_products_quantity = mysqli_query($con, $update_cart);
                        $total_price = $total_price * $quantities;
                        
                    }
                    ?>



                    <td>Rs. <?php echo $price_table?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo$product_id ?>"></td>
                    <td>
                        <!--<button class="bg-success px-3 py-2 border-0 mx-3">Update</button>-->
                        <input type="submit" value="Update Cart" class="bg-success px-3 py-2 border-0 mx-3" name="update_cart">
                       
                        <input type="submit" value="Remove  Cart" class="bg-danger px-3 py-2 border-0 mx-3" name="remove_cart">
                    </td>

                </tr>
                <?php  }
                 }?>
            </tbody>
        </table>
        <!--subtotal-->
        <div class="d-flex mb-5">
            <h4 class="px-3">Subtotal: <strong style="color: #0c343d;">Rs: <?php echo $total_price?>/-</strong>
</h4>
<a href="myfirstphp.php" class="bg-info px-3 py-2 border-0 mx-3 text-dark text-decoration-none">Continue Shopping</a>


                <button class="bg-secondary px-3 py-2  border-0 text-light"><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>

        </div>
    </div>
</div>
</form>
<!--function to remove items-->
<?php 
function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart'])){
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delete_query="Delete from `cart_details` where product_id=$remove_id";
            $run_delete=mysqli_query($con,$delete_query);
            if($run_delete){
                echo "<script>window.open('cart.php','_self)</script>";
            }
        }
    }
}
echo $remove_item= remove_cart_item();

?>

        <!-- Last child -->
<!--include footer-->
      <?php include("./includes/footer.php") ?>
       
        </div>
    
      

        <!-- Bootstrap JS link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 <!--Js-->
        <script>
          function redirectToDisplayAll() {
              window.location.href = "display_all.php";
          }
          function redirectToProductDetails(product_id) {
    window.location.href = "product_details.php?product_id=" + product_id;
      } 
      function redirectToCart(product_id) {
    window.location.href = "myfirstphp.php?add_to-cart=" + product_id;
}

</script>

    </body>
</html>
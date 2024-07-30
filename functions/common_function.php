<?php
// including connect file
//include('./includes/connect.php');

// getting products
function getproducts(){
    global $con;
    $select_query = "SELECT * FROM `products` ORDER BY rand() LIMIT 0,8";
    $result_query = mysqli_query($con, $select_query);

    echo "<div class='pro-container'>";

    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        $category_id = $row['category_id'];

        echo "<div class='pro'>
            <div class='image-container'>
                <img src='./admin_area/product_images/$product_image1' alt=''>
            </div>
            <div class='des'>
                <h5>$product_title</h5>
                <div class='star'>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                </div>
                <h4><i class='fas fa-clock clock'>&nbsp;</i><span>9h 12m</span> &nbsp;LKR $product_price</h4>
            </div>
            <a href='#'><i class='fas fa-cart-plus cart'></i></a>
            <button class='product-Button' onclick='redirectToProductDetails($product_id)'>Buy Now &nbsp;<i class='fas fa-bolt'></i> &nbsp;LKR $product_price</button>

            <button class='product-bid' onclick='redirectToCart($product_id)'>Bid</button>
        </div>";
    }

    echo "</div>";
}

// getting auctions
function get_all_products(){
    global $con;
    $select_query = "SELECT * FROM `products` ORDER BY rand()";
    $result_query = mysqli_query($con, $select_query);

    echo "<div class='pro-container'>";

    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $product_price = $row['product_price'];
        $category_id = $row['category_id'];

        echo "<div class='pro'>
            <div class='image-container'>
                <img src='./admin_area/product_images/$product_image1' alt=''>
            </div>
            <div class='des'>
                <h5>$product_title</h5>
                <div class='star'>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                </div>
                <h4><i class='fas fa-clock clock'>&nbsp;</i><span>9h 12m</span> &nbsp;LKR $product_price</h4>
            </div>
            <a href='#'><i class='fas fa-cart-plus cart'></i></a>
            <button class='product-Button' onclick='redirectToProductDetails($product_id)'>Buy Now &nbsp;<i class='fas fa-bolt'></i> &nbsp;LKR $product_price</button>

            <button class='product-bid' onclick='redirectToCart($product_id)'>Bid</button>
        </div>";
    }

    echo "</div>";
}

// displaying categories
function getcategories(){
    // Add your code here
}

// searching auctions
function search_product(){
    global $con;
    if(isset($_GET['search_data_product'])){
        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
                if ($num_of_rows == 0) {
                    echo "<h2 class='text-center text-danger'>No results match. No products found in this category!</h2>";
                }


        echo "<div class='pro-container'>";

        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];

            echo "<div class='pro'>
                <div class='image-container'>
                    <img src='./admin_area/product_images/$product_image1' alt=''>
                </div>
                <div class='des'>
                    <h5>$product_title</h5>
                    <div class='star'>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                    </div>
                    <h4><i class='fas fa-clock clock'>&nbsp;</i><span>9h 12m</span> &nbsp;LKR $product_price</h4>
                </div>
                <a href='#'><i class='fas fa-cart-plus cart'></i></a>
                <button class='product-Button'>Buy Now &nbsp;<i class='fas fa-bolt'></i> &nbsp;LKR $product_price</button>
                <button class='product-bid' onclick='redirectToCart($product_id)'>Bid</button>

            </div>";
        }

        echo "</div>";
    }
}
//get ip address function
// from java-point
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
/*
$ip = getIPAddress();  
echo 'User Real IP Address - '.$ip; */

// cart function
function cart()
{
    if (isset($_GET['add_to-cart'])) {
        global $con;
        $get_ip_address = getIPAddress();
        $get_product_id = $_GET['add_to-cart'];

        // Check if the item is already present in the cart
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address' AND product_id=$get_product_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
  
        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already present inside the cart')</script>";
            echo "<script>window.open('myfirstphp.php','_self')</script>";
        } else {
            // Add the item to the cart
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($get_product_id,'$get_ip_address', 0)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script>alert('Item is added to cart')</script>";
            echo "<script>window.open('myfirstphp.php','_self')</script>";
        }
    }
}

// total price function
function total_cart_price(){
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
            $product_values = array_sum($product_price); //[200]
            $total_price += $product_values; 
        }
    }
    
    echo $total_price;
}

// get user order details
function get_user_order_details() {
    global $con;
    $username = $_SESSION['username'];
    $get_details = "SELECT * FROM `user_table` WHERE username='$username'";
    $result_query = mysqli_query($con, $get_details);

    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['user_id'];

        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_orders = "SELECT * FROM user_orders WHERE user_id=$user_id AND order_status='pending'";
                    $result_orders_query = mysqli_query($con, $get_orders);
                    $row_count = mysqli_num_rows($result_orders_query);

                    if ($row_count > 0) {
                        echo "<h3 class='text-center my-5'>You have <span class='text-danger'>$row_count</span> pending orders</h3>";
                        echo "<p class='text-center'><a href='profile.php?my_orders' class='order-details-button'>Order Details</a></p>";
                    }else{
                        echo "<h3 class='text-center my-5'>You have 0 pending orders</h3>";
                        echo "<p class='text-center'><a href='../myfirstphp.php' class='order-details-button'>Exlplore Auctions</a></p>";
                    }
                }
            }
        }
    }
}



  

?>


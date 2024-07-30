<!--connect file-->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-registration</title>
     <!-- Bootstrap CSS link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="container-fluid my-3 bg-light">
    <h2 class="text-center">Hello!</h2>
    <h3 class="text-center">Create an account</h3>
    <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">
                    <!--usename field-->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">User name</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                    </div>
                    <!--email field-->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="text" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email">
                    </div>
                    <!--password field-->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                    </div>
                     <!--confirm password field-->
                     <div class="form-outline mb-4">
                        <label for="conf_user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Confirm Password" autocomplete="off" required="required" name="conf_user_password">
                    </div>
                    <!--address field-->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address">
                    </div>
                    <!--contact field-->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your moblie number" autocomplete="off" required="required" name="user_contact">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-success py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already member? <a href="user_login.php" class="text-danger">Login here</a></p>
                    </div>
                </form>
            </div>
    </div>
  </div>  
</body>
</html>
<!-- PHP code -->
<?php
//include('../functions/common_function.php');


if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_ip= getIPAddress();

    //select query
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    if ($rows_count > 0) {
        echo "<script>alert('Username already exists');</script>";
    }elseif ($user_password!=$conf_user_password){
        echo "<script>alert('Passwords do not match');</script>";

    } else {
         // Insert query
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_ip, user_address, user_mobile) VALUES ('$user_username', '$user_email', '$user_password', '$user_ip', '$user_address', '$user_contact')";
        // Execute the query
        $sql_execute = mysqli_query($con, $insert_query);
    }


    if ($sql_execute) {
        echo "<script>alert('User registration successful');</script>";
    } else {
        echo "<script>alert('User registration failed');</script>";
    }
//selecting cart iems
$select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
$result_cart = mysqli_query($con, $select_cart_items);
$rows_count = mysqli_num_rows($result_cart);

if ($rows_count > 0) {
    $_SESSION['username'] = $user_username;
    echo "<script>alert('You have items in your cart');</script>";
    echo "<script>window.open('checkout.php','_self');</script>";
} else {
    echo "<script>window.open('../myfirstphp.php','_self');</script>";
}


}
?>


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
    <title>Payment-page</title>
     <!-- Bootstrap CSS link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    img{
        width:30%;
        margin: auto;
        display: block;
    }
</style>
<body>
<!--php code to access user id-->
<?php
    $user_ip=getIPAddress();
    $get_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
    $result = mysqli_query($con, $get_user);
    $run_query = mysqli_fetch_array($result);

    $user_id = $run_query['user_id'];



?>

    <div class="container">
        <h2 class="text-center text-success my-5"><strong>Payment options</strong></h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col md-6">
            <a href="https://www.paypal.com" target="_blank"><img src="../img/payment..jpg" alt=""></a> 
            </div> 
            <div class="col md-6">
            <a href="order.php?user_id=<?php echo $user_id ?>"><img src="../img/offline-payments.png" alt=""></a> 
            </div>  
        </div>
    </div>
</body>
</html>
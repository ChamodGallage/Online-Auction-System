<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS file -->
    <link rel="stylesheet" href="../homestyle.css"> 
    <link rel="stylesheet" href="profilestyle.css"> 
</head>
<body>
<!-- Navbar -->
<div class="container-fluid p-0">
    <!-- First child -->
    <nav class="navbar navbar-expand-lg" style="background-color: #0c343d;">
        <div class="container-fluid">
            <a href="#"><img src="../img/logopro.PNG" class="logo" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../myfirstphp.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../display_all.php">Auctions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cart.php"><i class="fas fa-cart-plus"></i><sup>1</sup></a>
                    </li>
                </ul>
                <form class="d-flex" action="../search_product.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                    <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                </form>
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
            <li class="nav-item">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo '<a class="nav-link" href="./users_area/user_login.php">Welcome Guest</a>';
                } else {
                    echo '<a class="nav-link" href="profile.php">Welcome ' . $_SESSION['username'] . '</a>';
                }
                ?>
            </li>
            <li class="nav-item">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<a class='nav-link' href='./users_area/user_login.php'>Login</a>";
                } else {
                    echo "<a class='nav-link' href='../users_area/logout.php'>Logout</a>";
                }
                ?>
            </li>
        </ul>
    </nav>

    <!-- First child -->
    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Top products. Incredible prices</p>

        <!-- Second child -->
        <div class="row">
            <div class="col-md-2 p-0"></div>
            <div class="col-md-10 p-0">
                <ul class="navbar-nav custom-nav">
                    <li class="nav-item bg-success">
                        <a class="nav-link text-light" href="profile.php"><h4>Your profile</h4></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php">Pending orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?my_orders">My orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10">
                <?php
                get_user_order_details();
                if (isset($_GET['edit_account'])) {
                    include('edit_account.php');
                }
                if (isset($_GET['my_orders'])) {
                    include('user_orders.php');
                }
                if (isset($_GET['delete_account'])) {
                    include('delete_account.php');
                }
                ?>
            </div>
        </div>
    </section>
</div>

<!--include footer-->
<div class="bg-success p-3 text-center fixed-bottom">
    <p class="m-0">Copyright 2023 © Diyasen. All Rights Reserved.</p>
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




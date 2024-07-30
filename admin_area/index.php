<?php
include('../includes/connect.php');
include('../functions/common_function.php');

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--css file-->
    <link rel="stylesheet" href="../homestyle.css">
    <link rel="stylesheet" href="./adminstyle.css">
</head>
<body>
        <!--navbar-->
        <div class="container-fluid p-0">
            <!--first-child-->
            <nav class="navbar navbar-expand-lg navbar-light bg-custom">
            <div class="container-fluid">
                <img src="../img/logopro.PNG" alt="" class="logo">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="" class="nav-link">Welcome Guest</a>
                    </li>
                </ul>
            </nav>
        </div>
            </nav>

            <!--Second child-->
            <div class="bg-light">
                <h2 class="text-center p-2">Admin Panel</h2></br>
                <h3 class="text-center p-2">Manage Details</h3>
             </div>

            <!--third child-->
            <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                 <div class="p-3">
                     <a href="#" class="">
                        <img src="../img/admin_profile.jpg" alt="" class="admin_image">
                    </a>
                        <p class="text-light text-center">Hello, Admin Name</p>
                </div>
                <!--button*10>a.nav-link.text-light.bg-info.my-1-->
                <div class="button text-center">
                    <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1">View Active Bids</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">List sellers</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">List Users</a></button>
                    <button><a href="./insert_categories.php" class="nav-link text-light bg-info my-1">Insert categories</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">View categories</a></button>
                    <button><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1">View products</a></button>
                    <button><a href="" class="nav-link text-light bg-info my-1">Logout</a></button>
                </div>
            </div>
            </div>

            <!--forth child-->
            <div class="container my-5">
        <?php
        if(isset($_GET['insert_category'])){
            include('insert_categories.php');
        }
        if(isset($_GET['view_products'])){
            include('view_products.php');
        }
        if(isset($_GET['edit_products'])){
            include('edit_products.php');
        }
        if(isset($_GET['delete_product'])){
            include('delete_product.php');
        }
        
        ?>
    </div>
             <!-- last child -->  
<!--include footer-->
<div class="bg-success p-3 text-center fixed-bottom">
    <p class="m-0">Copyright 2023 © Diyasen. All Rights Reserved.</p>
</div>


        </div>

 <!--bootstrap js link-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>   
</body>
</html>
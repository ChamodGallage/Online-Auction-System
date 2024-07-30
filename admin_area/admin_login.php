<!--connect file-->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-login</title>
     <!-- Bootstrap CSS link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <div class="container-fluid my-3 bg-light">
    <h2 class="text-center">Hello!</h2>
    <h3 class="text-center">Admin</h3>
    <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post">
                    <!--username field-->
                        <div class="form-outline mb-4">
                            <label for="admin_username" class="form-label">Admin username</label>
                            <input type="text" id="admin_username" class="form-control" placeholder="Enter your admin username" autocomplete="off" required="required" name="admin_username">
                        </div>
                        <!--password field-->
                        <div class="form-outline mb-4">
                            <label for="admin_password" class="form-label">Password</label>
                            <input type="password" id="admin_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="admin_password">
                        </div>
                        <div class="mt-4 pt-2">
                            <input type="submit" value="Login" class="bg-success py-2 px-3 border-0" name="admin_login">
                            <p class="small fw-bold mt-2 pt-1 mb-0">New admin? <a href="admin_registration.php" class="text-danger">Register here</a></p>
                        </div>
                </form>
            </div>
    </div>
  </div>  
</body>
</html>

<!--php-->
<?php
// ...

if (isset($_POST['admin_login'])) {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if ($row_count > 0) {
        if ($admin_password == $row_data['admin_password']) {
            $_SESSION['admin_name'] = $admin_username;
            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>


<?php

include('../includes/connect.php');

if(isset($_POST['insert_cat'])){
    $category_title = $_POST['cat_title'];

    // Select data from database
    $select_query = "SELECT * FROM categories WHERE category_title = '$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);
    if($number > 0){
        echo "<script>alert('This Category is already present in the database');</script>";   
    }else{
        $insert_query = "INSERT INTO categories (category_title) VALUES ('$category_title')";
    $result = mysqli_query($con, $insert_query);

    if($result){
        echo "<script>alert('Category has been inserted');</script>";
    }
    }

    
}
 

?>
 
 
 
 
 <!--bootstrap css link-->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="bg-info p-3 text-center">
  <div style="background-color: #ffe599;">
    <h2 style="color: #0c343d;">Insert Categories</h2>
  </div>
</div>

<div class="container my-5">
  <form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-3">
      <span class="input-group-text bg-info" id="basic-addon1">
        <i class="fa-solid fa-receipt"></i>
      </span>
      <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-3">
      <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="Insert Categories" aria-label="Username" aria-describedby="basic-addon1" class="bg-info">
    </div>
  </form>
</div>
 
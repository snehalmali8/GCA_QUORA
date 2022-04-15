<?php 
    if(isset($_POST['submit'])){
        $category_title = $_POST['category_title'];
        if(!empty($category_title)){
            $query_category = "INSERT INTO categories(category_name) VALUES('$category_title')";
            $result = mysqli_query($conn, $query_category);
            if(!$result){
                echo "Bhurrr";
            }
        }
        echo "<script>window.location.href='view_All_categories.php'</script>";

    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="category" class="form-label">Category Name:</label>
        <input type="text" class="form-control category" id="category" placeholder="Enter here" name="category_title">
    </div>


    <div class="form-group py-2">
        <input type="submit" class="btn btn-primary" id="submit" value="Add Category" name="submit">
    </div>

</form>
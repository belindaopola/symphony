<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Add Product</h1>

        <?php 
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
                <label for="inputTitle" class="col-sm-1 col-form-label">Title:</label>
                <div class="col-sm-3"> 
                    <input type="text" id="title" name="title" placeholder="Enter Product Name" class="form-control" required>
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputDescription" class="col-sm-1 col-form-label">Description:</label>
                <div class="col-sm-3">
                    <textarea id="description" name="description" placeholder="Enter Product Description" class="form-control" required></textarea>
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputPrice" class="col-sm-1 col-form-label">Price:</label>
                <div class="col-sm-3">
                    <input type="number" id="price" name="price" placeholder="Enter Product Price" class="form-control" required>
                </div>
            </div>
            <div class="row mb-4">
                <label for="image" class="col-sm-1 col-form-label">Select Image:</label>
                <div class="col-sm-3">
                    <input type="file" id="image" name="image" class="form-control">
                </div>
            </div>

            <div class="row mb-4">
                <label for="section" class="col-sm-1 col-form-label">Section:</label>
                <div class="col-sm-3">
                    <select name="section" class="form-control" required>
                        <?php 
                            $sql = "SELECT * FROM tbl_section WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count > 0) {
                                while($row = mysqli_fetch_assoc($res)) {
                                    $id = htmlspecialchars($row['id']);
                                    $title = htmlspecialchars($row['title']);
                                    echo "<option value='$id'>$title</option>";
                                }
                            } else {
                                echo "<option value='0'>No Section Found</option>";
                            }
                        ?>
                    </select>    
                </div>
            </div>

            <div class="row mb-4">
                <label for="featured" class="col-sm-1 col-form-label">Featured:</label>
                <div class="col-sm-3">
                    <input class="form-check-input" type="radio" name="featured" id="featuredYes" value="Yes">
                    <label class="form-check-label" for="featuredYes">Yes</label>
                    <input class="form-check-input" type="radio" name="featured" id="featuredNo" value="No" checked>
                    <label class="form-check-label" for="featuredNo">No</label>
                </div>
            </div>
            <div class="row mb-4">
                <label for="active" class="col-sm-1 col-form-label">Active:</label>
                <div class="col-sm-3">
                    <input class="form-check-input" type="radio" name="active" id="activeYes" value="Yes">
                    <label class="form-check-label" for="activeYes">Yes</label>
                    <input class="form-check-input" type="radio" name="active" id="activeNo" value="No" checked>
                    <label class="form-check-label" for="activeNo">No</label>
                </div>
            </div>         
            <input type="submit" name="submit" value="Add Product" class="btn btn-primary col-sm-1">
        </form>

        <?php 
            if(isset($_POST['submit'])) {
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $price = mysqli_real_escape_string($conn, $_POST['price']);
                $section = mysqli_real_escape_string($conn, $_POST['section']);
                $featured = isset($_POST['featured']) ? mysqli_real_escape_string($conn, $_POST['featured']) : 'No';
                $active = isset($_POST['active']) ? mysqli_real_escape_string($conn, $_POST['active']) : 'No';

                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                    $image_name = $_FILES['image']['name'];
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_name = "Product-Name-".rand(0000,9999).".".$ext;

                    $src = $_FILES['image']['tmp_name'];
                    $dst = "images/product/".$image_name;

                    $upload = move_uploaded_file($src, $dst);

                    if($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:'.SITEURL.'add-product.php');
                        die();
                    }
                } 
                else {
                $image_name = "";
                }

        $sql2 = "INSERT INTO tbl_product SET 
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            section_id = $section,
            featured = '$featured',
            active = '$active'
        ";

        $res2 = mysqli_query($conn, $sql2);

        if($res2 == true) 
        {
            $_SESSION['add'] = "<div class='success'>Product Added Successfully.</div>";
            header('location:'.SITEURL.'manage-product.php');
        } 
        else 
        {
            $_SESSION['add'] = "<div class='error'>Failed to Add Product.</div>";
            header('location:'.SITEURL.'manage-product.php');
        }                
}
?>

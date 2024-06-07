<?php include('partials/menu.php'); ?>

<?php 
            if(isset($_POST['submit'])) {
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $section = mysqli_real_escape_string($conn, $_POST['section']);
                $featured = isset($_POST['featured']) ? mysqli_real_escape_string($conn, $_POST['featured']) : 'No';
                $active = isset($_POST['active']) ? mysqli_real_escape_string($conn, $_POST['active']) : 'No';

               

        $sql2 = "INSERT INTO tbl_product SET 
            title = '$title',
            description = '$description',
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


<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Add Product</h1>

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

        
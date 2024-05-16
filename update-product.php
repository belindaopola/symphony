<?php include('partials/menu.php'); ?>

<?php 
    // Check whether id is set or not 
    if(isset($_GET['id']))
    {
        // Get all the details
        $id = $_GET['id'];

        // SQL Query to Get the Selected product
        $sql2 = "SELECT * FROM tbl_product WHERE id=$id";
        // execute the Query
        $res2 = mysqli_query($conn, $sql2);

        // Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        // Get the Individual Values of Selected product
        $title = $row2['title'];
        $current_section = $row2['section_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        // Redirect to Manage product
        header('location:'.SITEURL.'manage-product.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Update Product/Service</h1>

        <form action="" method="POST" enctype="multipart/form-data">  
            
            <div class="row mb-4">
                <label for="inputDescription" class="col-sm-1 col-form-label">Description:</label>
                <div class="col-sm-3"> 
                <input type="text" id="title" name="title" value="<?php echo $title; ?>" class="form-control">
                </div>
            </div>

            <div class="row mb-4">
                <label for="inputSection" class="col-sm-1 col-form-label">Description:</label>
                <div class="col-sm-3"> 
                    <select name="section" >
                        <?php 
                            //Query to Get ACtive Categories
                            $sql = "SELECT * FROM tbl_section WHERE active='Yes'";
                            //Execute the Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);

                            //Check whether section available or not
                            if($count>0)
                            {
                                //section Available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $section_title = $row['title'];
                                    $section_id = $row['id'];
                                    
                                    //echo "<option value='$section_id'>$section_title</option>";
                                    ?>
                                    <option <?php if($current_section==$section_id){echo "selected";} ?> value="<?php echo $section_id; ?>"><?php echo $section_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //section Not Available
                                echo "<option value='0'>section Not Available.</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <label for="inputFeatured" class="col-sm-1 col-form-label">Featured:</label>
                    <div class="col-sm-3">
                    <input <?php if($featured=="Yes") {echo "checked";} ?> class="form-check-input" type="radio" name="featured" id="featuredyes" value="Yes">
                    <label class="form-check-label" for="featuredRadio">Yes</label>
                    <input <?php if($featured=="No") {echo "checked";} ?> class="form-check-input" type="radio" name="featured" id="featuredno" value="No">
                    <label class="form-check-label" for="featuredRadio">No</label>
                    </div>
                </div>
                <div class="row mb-4">
                <label for="inputActive" class="col-sm-1 col-form-label">Active:</label>
                    <div class="col-sm-3">
                    <input <?php if($active=="Yes") {echo "checked";} ?>  class="form-check-input" type="radio" name="active" id="activeyes" value="Yes">
                    <label class="form-check-label" for="activeRadio">Yes</label>
                    <input <?php if($active=="No") {echo "checked";} ?> class="form-check-input" type="radio" name="active" id="activeno" value="No">
                    <label class="form-check-label" for="activeRadio">No</label>
                    </div>
                </div> 
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="submit" name="submit" value="Update product" class="btn btn-primary col-sm-1.2">      
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $section = $_POST['section'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];
                                   
               //2. Update the product in Database
                $sql3 = "UPDATE tbl_product SET 
                    title = '$title',
                    price = $price,
                    section_id = '$section',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and product Updated
                    $_SESSION['update'] = "<div class='success'>product Updated Successfully.</div>";
                    header('location:'.SITEURL.'manage-product.php');
                }
                else
                {
                    //Failed to Update product
                    $_SESSION['update'] = "<div class='error'>Failed to Update product.</div>";
                    header('location:'.SITEURL.'manage-product.php');
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
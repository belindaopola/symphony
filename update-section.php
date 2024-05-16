<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Update section</h1>

        <?php 
            // Check whether the id is set or not
            if(isset($_GET['id']))
            {
                // Get the ID and all other details
                //echo "Getting the Data";
                $id = $_GET['id'];
                // Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_section WHERE id=$id";

                // Execute the Query
                $res = mysqli_query($conn, $sql);

                // Count the Rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    // Redirect to manage section with session message
                    $_SESSION['no-section-found'] = "<div class='error'>section not Found.</div>";
                    header('location:'.SITEURL.'manage-section.php');
                }

            }
            else
            {
                // Redirect to Manage section
                header('location:'.SITEURL.'manage-section.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="row mb-4">
                <label for="inputTitle" class="col-sm-1 col-form-label">Title:</label>
                <div class="col-sm-3"> 
                <input type="text" id="title" name="title" value="<?php echo $title; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputImage" class="col-sm-1 col-form-label">Current Image:</label>
                <div class="col-sm-3"> 
                    <?php 
                        if($current_image != "")
                        {
                            //Display the Image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/section/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                        else
                        {
                            //Display Message
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                    ?>                
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputImage" class="col-sm-1 col-form-label">New Image:</label>
                <div class="col-sm-3"> 
                <input type="file" id="image" name="image" class="form-control">
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

            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update section" class="btn btn-primary col-sm-1.2">

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1. Get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Updating New Image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the Image Details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name != "")
                    {
                        //Image Available

                        //A. UPload the New Image

                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialproduct1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "product_section_".rand(000, 999).'.'.$ext; // e.g. product_section_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "images/section/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to Add section Page
                            header('location:'.SITEURL.'manage-section.php');
                            //STop the Process
                            die();
                        }

                        //B. Remove the Current Image if available
                        if($current_image!="")
                        {
                            $remove_path = "images/section/".$current_image;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'manage-section.php');
                                die();//Stop the Process
                            }
                        }
                        

                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //3. Update the Database
                $sql2 = "UPDATE tbl_section SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //4. REdirect to Manage section with MEssage
                //CHeck whether executed or not
                if($res2==true)
                {
                    //section Updated
                    $_SESSION['update'] = "<div class='success'>section Updated Successfully.</div>";
                    header('location:'.SITEURL.'manage-section.php');
                }
                else
                {
                    //failed to update section
                    $_SESSION['update'] = "<div class='error'>Failed to Update section.</div>";
                    header('location:'.SITEURL.'manage-section.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
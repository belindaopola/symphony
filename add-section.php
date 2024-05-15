<?php include('partials/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
</body>
</html>

<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Add Section</h1>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <!-- Add section Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

        <div class="row mb-4">
            <label for="title" class="col-sm-1 col-form-label">Title:</label>
            <div class="col-sm-3">
            <input type="text" id="title" placeholder="Section Title" class="form-control">
            </div>
        </div>
        <div class="row mb-4">
            <label for="image" class="col-sm-1 col-form-label">Select Image:</label>
            <div class="col-sm-3">
            <input type="file" id="image"  class="form-control">
            </div>
        </div>
        <div class="row mb-4">
        <label for="inputFeatured" class="col-sm-1 col-form-label">Featured:</label>
            <div class="col-sm-3">
            <input class="form-check-input" type="radio" name="featured" id="featuredyes" value="Yes">
            <label class="form-check-label" for="featuredRadio">Yes</label>
            <input class="form-check-input" type="radio" name="featured" id="featuredno" value="No">
            <label class="form-check-label" for="featuredRadio">No</label>
            </div>
        </div>
        <div class="row mb-4">
        <label for="inputActive" class="col-sm-1 col-form-label">Active:</label>
            <div class="col-sm-3">
            <input class="form-check-input" type="radio" name="active" id="activeyes" value="Yes">
            <label class="form-check-label" for="activeRadio">Yes</label>
            <input class="form-check-input" type="radio" name="active" id="activeno" value="No">
            <label class="form-check-label" for="activeRadio">No</label>
            </div>
        </div>        
            <input type="submit" name="submit" value="Add section" class="btn btn-primary col-sm-1">
        </form>
        <!-- Add section Form Ends -->

        <?php 
        
            // Check whether the Submit Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                // echo "Clicked";

                // 1. Get the Value from section Form
                $title = $_POST['title'];

                // For Radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    // Get the VAlue from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    // Set the Default VAlue
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                // Check whether the image is selected or not and set the value for image name accoridingly
                //print_r($_FILES['image']);

                //die();//Break the Code Here

                if(isset($_FILES['image']['name']))
                {
                    // Upload the Image
                    // To upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];
                    
                    // Upload the Image only if image is selected
                    if($image_name != "")
                    {

                        // Auto Rename our Image
                        // Get the Extension of our image (jpg, png, gif, etc) e.g. "specialproduct1.jpg"
                        $ext = end(explode('.', $image_name));

                        // Rename the Image
                        $image_name = "product_section_".rand(000, 999).'.'.$ext; // e.g. product_section_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "images/section/".$image_name;

                        // Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the image is uploaded or not
                        // And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            // Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            // Redirect to Add section Page
                            header('location:'.SITEURL.'add-section.php');
                            // Stop the Process
                            die();
                        }

                    }
                }
                else
                {
                    // Don't Upload Image and set the image_name value as blank
                    $image_name="";
                }

                // 2. Create SQL Query to Insert section into Database
                $sql = "INSERT INTO tbl_section SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                // 3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                // 4. Check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Query Executed and section Added
                    $_SESSION['add'] = "<div class='success'>section Added Successfully.</div>";
                    //Redirect to Manage section Page
                    header('location:'.SITEURL.'manage-section.php');
                }
                else
                {
                    // Failed to Add section
                    $_SESSION['add'] = "<div class='error'>Failed to Add section.</div>";
                    // Redirect to Manage section Page
                    header('location:'.SITEURL.'add-section.php');
                }
            }        
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
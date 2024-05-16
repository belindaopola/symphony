<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Add product</h1>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
            <label for="inputTitle" class="col-sm-1 col-form-label">Title:</label>
                <div class="col-sm-3"> 
                <input type="text" id="title" name="title" placeholder="Enter Product Name" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputDescription" class="col-sm-1 col-form-label">Description:</label>
                <div class="col-sm-3">
                <textarea type="text" id="description" name="description" placeholder="Enter Product Description" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputPrice" class="col-sm-1 col-form-label">Price:</label>
                <div class="col-sm-3">
                <input type="number" id="price" name="price" placeholder="Enter Product Price" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="image" class="col-sm-1 col-form-label">Select Image:</label>
                <div class="col-sm-3">
                <input type="file" id="image" name="image" placeholder="Select Image" class="form-control" >
                </div>
            </div>

            <!-- N.B: Dropdown is still not being populated from the db -->
            <div class="row mb-4">
            <label for="customerName" class="col-sm-1 col-form-label">Section:</label>
            <div class="col-sm-3">
                <select name="section" class="form-control">
                <?php 
                    //Create PHP Code to display sections from Database
                    //1. CReate SQL to get all active sections from database

                    // $sql = "SELECT * FROM tbl_section WHERE active='Yes'";
                    
                    //Executing qUery
                    // $res = mysqli_query($conn, $sql);

                    //Count Rows to check whether we have sections or not
                    // $count = mysqli_num_rows($res);

                    //IF count is greater than zero, we have sections else we donot have sections
                    // if($count>0)
                    // {
                        //WE have sections
                        // while($row=mysqli_fetch_assoc($res))
                        // {
                            //get the details of sections
                            // $id = $row['id'];
                            // $title = $row['title'];

                            ?>
                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                            <?php
                        // }
                    // }
                    // else
                    // {
                        // We do not have Section
                        ?>
                        <option value="0">No Section Found</option>
                        <?php
                    // }
                
                    //2. Display on Drpopdown
                ?>

                    </select>    
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
            <input type="submit" name="submit" value="Add product" class="btn btn-primary col-sm-1">
        </form>

        <?php 

            // Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //hAdd the product in Database
                //echo "Clicked";
                
                //h1. Get the DAta from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $section = $_POST['section'];

                //hCheck whether radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; // Setting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; // Setting Default Value
                }

                // 2. Upload the Image if selected
                // Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    // Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    // Check Whether the Image is Selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        // Image is Selected
                        // 1. Rename the Image
                        // Get the extension of selected image (jpg, png, gif, etc.) "vijay-thapa.jpg" vijay-thapa jpg
                        $ext = end(explode('.', $image_name));

                        // Create New Name for Image
                        $image_name = "Product-Name-".rand(0000,9999).".".$ext; //New Image Name May Be "product-Name-657.jpg"

                        // 2. Upload the Image
                        // Get the Src Path and DEstinaton path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        // Destination Path for the image to be uploaded
                        $dst = "images/product/".$image_name;

                        // Finally Uppload the product image
                        $upload = move_uploaded_file($src, $dst);

                        // Check whether image uploaded of not
                        if($upload==false)
                        {
                            // Failed to Upload the image
                            // Redirect to Add product Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'add-product.php');
                            // Stop the process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; // Setting Default Value as blank
                }

                // 3. Insert Into Database

                // Create a SQL Query to Save or Add product
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_product SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    section_id = $section,
                    featured = '$featured',
                    active = '$active'
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether data inserted or not
                // 4. Redirect with MEssage to Manage product page
                if($res2 == true)
                {
                    // Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>product Added Successfully.</div>";
                    header('location:'.SITEURL.'manage-product.php');
                }
                else
                {
                    // Failed to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add product.</div>";
                    header('location:'.SITEURL.'manage-product.php');
                }                
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
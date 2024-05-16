<?php include('partials/menu.php'); ?>

    <?php 
        // Check whether id is set or not 
        if(isset($_GET['id']))
        {
            // Get all the details
            $id = $_GET['id'];
    
            // SQL Query to Get the Selected customer
            $sql2 = "SELECT * FROM tbl_customer WHERE id=$id";
            // execute the Query
            $res2 = mysqli_query($conn, $sql2);
    
            // Get the value based on query executed
            $row2 = mysqli_fetch_assoc($res2);
    
            // Get the Individual Values of Selected customer
            $name = $row2['customer_name'];
            $contact = $row2['customer_contact'];
            $email = $row2['customer_email'];
            $address = $row2['customer_address'];
            $featured = $row2['featured'];
            $active = $row2['active'];
        }
        else
        {
            // Redirect to Manage Customer
            header('location:'.SITEURL.'manage-customer.php');
        }
    ?>
    
    
    <div class="main-content">
        <div class="wrapper">
            <h1 class="row mb-4">Update Customer</h1>

            <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
                    <label for="inputCustomerName" class="col-sm-1 col-form-label">Customer Name:</label>
                    <div class="col-sm-3"> 
                    <input type="text" id="customer_name" name="customer_name" value="<?php echo $name; ?>" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                <label for="InputContact" class="col-sm-1 col-form-label">Contact:</label>
                    <div class="col-sm-3">
                    <input type="text" id="customer_contact" name="customer_contact" value="<?php echo $contact; ?>" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                <label for="InputEmail" class="col-sm-1 col-form-label">Email:</label>
                    <div class="col-sm-3">
                    <input type="email" id="customer_email" name="customer_email" value="<?php echo $email; ?>" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                <label for="InputAddress" class="col-sm-1 col-form-label">Address:</label>
                    <div class="col-sm-3">
                    <textarea type="text" id="customer_address" name="customer_address" value="<?php echo $address; ?>" class="form-control"></textarea>
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
                <input type="submit" name="submit" value="Update Customer" class="btn btn-primary col-sm-1.2">
    
            </form>
    
            <?php 
            
                if(isset($_POST['submit']))
                {
                    //echo "Button Clicked";
    
                    // 1. Get all the details from the form
                    $id = $_POST['id'];
                    $name = $_POST['customer_name'];
                    $contact = $_POST['customer_contact'];
                    $email = $_POST['customer_email'];
                    $address = $_POST['customer_address'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];
                                       
                   // 2. Update the customer in Database
                    $sql3 = "UPDATE tbl_customer SET 
                        customer_name = '$name',
                        customer_contact = $contact,
                        customer_email = '$email',
                        customer_address = '$address',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                    ";
    
                    // Execute the SQL Query
                    $res3 = mysqli_query($conn, $sql3);
    
                    // Check whether the query is executed or not 
                    if($res3==true)
                    {
                        // Query Exectued and customer Updated
                        $_SESSION['update'] = "<div class='success'>Customer Details Updated Successfully.</div>";
                        header('location:'.SITEURL.'manage-customer.php');
                    }
                    else
                    {
                        // Failed to Update customer
                        $_SESSION['update'] = "<div class='error'>Failed to Update customer details.</div>";
                        header('location:'.SITEURL.'manage-customer.php');
                    }
                }
            ?>
        </div>
    </div>
    
    <?php include('partials/footer.php'); ?>
    

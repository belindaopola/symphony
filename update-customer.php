<?php include('partials/menu.php'); ?>

<?php 
    // Check whether id is set or not 
    if(isset($_GET['id'])) {
        // Get all the details
        $id = $_GET['id'];
        
        // Prepare SQL Query to Get the Selected customer
        $sql2 = "SELECT * FROM tbl_customer WHERE id=?";
        // Prepare the statement
        $stmt2 = mysqli_prepare($conn, $sql2);
        // Bind parameters
        mysqli_stmt_bind_param($stmt2, 'i', $id);
        // Execute the statement
        mysqli_stmt_execute($stmt2);
        // Get the result
        $res2 = mysqli_stmt_get_result($stmt2);
        // Fetch the data
        $row2 = mysqli_fetch_assoc($res2);

        // Get the Individual Values of Selected customer
        $name = $row2['customer_name'];
        $contact = $row2['customer_contact'];
        $email = $row2['customer_email'];
        $address = $row2['customer_address'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    } else {
        // Redirect to Manage Customer
        header('location:'.SITEURL.'manage-customer.php');
        exit;
    }
?>



        <?php 
            if(isset($_POST['submit'])) {
                // Get all the details from the form
                $id = $_POST['id'];
                $name = $_POST['customer_name'];
                $contact = $_POST['customer_contact'];
                $email = $_POST['customer_email'];
                $address = $_POST['customer_address'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                // Prepare SQL Query to update the customer in Database
                $sql3 = "UPDATE tbl_customer SET 
                    customer_name = ?,
                    customer_contact = ?,
                    customer_email = ?,
                    customer_address = ?,
                    featured = ?,
                    active = ?
                    WHERE id = ?";
                
                // Prepare the statement
                $stmt3 = mysqli_prepare($conn, $sql3);
                // Bind parameters
                mysqli_stmt_bind_param($stmt3, 'ssssssi', $name, $contact, $email, $address, $featured, $active, $id);
                // Execute the statement
                $res3 = mysqli_stmt_execute($stmt3);

                // Check whether the query is executed or not 
                if($res3) {
                    // Query Executed and customer Updated
                    $_SESSION['update'] = "<div class='success'>Customer Details Updated Successfully.</div>";
                    header('location:'.SITEURL.'manage-customer.php');
                    exit;
                } else {
                    // Failed to Update customer
                    $_SESSION['update'] = "<div class='error'>Failed to Update customer details.</div>";
                    header('location:'.SITEURL.'manage-customer.php');
                    exit;
                }
            }
        ?>

<div class="main-content">
    <div class="wrapper">
        <h2 class="row mb-4">Update Customer</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
                <label for="inputCustomerName" class="col-sm-1 col-form-label">Customer Name:</label>
                <div class="col-sm-3"> 
                    <input type="text" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($name); ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="InputContact" class="col-sm-1 col-form-label">Contact:</label>
                <div class="col-sm-3">
                    <input type="text" id="customer_contact" name="customer_contact" value="<?php echo htmlspecialchars($contact); ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="InputEmail" class="col-sm-1 col-form-label">Email:</label>
                <div class="col-sm-3">
                    <input type="email" id="customer_email" name="customer_email" value="<?php echo htmlspecialchars($email); ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="InputAddress" class="col-sm-1 col-form-label">Address:</label>
                <div class="col-sm-3">
                    <textarea id="customer_address" name="customer_address" class="form-control"><?php echo htmlspecialchars($address); ?></textarea>
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputFeatured" class="col-sm-1 col-form-label">Featured:</label>
                <div class="col-sm-3">
                    <input <?php if($featured == "Yes") { echo "checked"; } ?> class="form-check-input" type="radio" name="featured" id="featuredyes" value="Yes">
                    <label class="form-check-label" for="featuredyes">Yes</label>
                    <input <?php if($featured == "No") { echo "checked"; } ?> class="form-check-input" type="radio" name="featured" id="featuredno" value="No">
                    <label class="form-check-label" for="featuredno">No</label>
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputActive" class="col-sm-1 col-form-label">Active:</label>
                <div class="col-sm-3">
                    <input <?php if($active == "Yes") { echo "checked"; } ?> class="form-check-input" type="radio" name="active" id="activeyes" value="Yes">
                    <label class="form-check-label" for="activeyes">Yes</label>
                    <input <?php if($active == "No") { echo "checked"; } ?> class="form-check-input" type="radio" name="active" id="activeno" value="No">
                    <label class="form-check-label" for="activeno">No</label>
                </div>
            </div>     
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">         
            <input type="submit" name="submit" value="Update Customer" class="btn btn-primary col-sm-1.2">
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

    

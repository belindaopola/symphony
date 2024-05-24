<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Add Customer</h1>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
                <label for="inputCustomerName" class="col-sm-1 col-form-label">Customer Name:</label>
                <div class="col-sm-3"> 
                <input type="text" id="name" name="name" placeholder="Enter Customer Name" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputContact" class="col-sm-1 col-form-label">Contact:</label>
                <div class="col-sm-3">
                <input type="text" id="contact" name="contact" placeholder="Enter Customer Contact" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputEmail" class="col-sm-1 col-form-label">Email:</label>
                <div class="col-sm-3">
                <input type="email" id="email" name="email" placeholder="Enter Customer Email" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputAddress" class="col-sm-1 col-form-label">Address:</label>
                <div class="col-sm-3">
                <textarea type="text" id="address" name="address" placeholder="Enter Customer Address" class="form-control"></textarea>
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
                <input type="submit" name="submit" value="Add Customer" class="btn btn-primary col-sm-1.2">
        </form>

        
        <?php 

            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the customer to the Database
                
                //Get the Data from Form
                $customer_name = $_POST['name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //Check whether radio buttons for featured and active are checked or not
                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No"; // Setting the default value
                $active = isset($_POST['active']) ? $_POST['active'] : "No"; // Setting the default value

                // Insert Into Database
                $sql2 = "INSERT INTO tbl_customer (customer_name, customer_contact, customer_email, customer_address, featured, active) VALUES ('$customer_name', '$customer_contact', '$customer_email', '$customer_address', '$featured', '$active')";
                
                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether data inserted or not
                if($res2)
                {
                    //Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Customer Added Successfully.</div>";
                    header('location:'.SITEURL.'manage-customer.php');
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Customer.</div>";
                    header('location:'.SITEURL.'add-customer.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>


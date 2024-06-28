<?php include('partials/menu.php'); ?>

    <?php 
        // Check whether id is set or not 
        if(isset($_GET['id']))
        {
            // Get all the details
            $id = $_GET['id'];
    
            // SQL Query to Get the Selected customer
            $sql2 = "SELECT * FROM tbl_user WHERE id=$id";
            // execute the Query
            $res2 = mysqli_query($conn, $sql2);
    
            // Get the value based on query executed
            $row2 = mysqli_fetch_assoc($res2);
    
            // Get the Individual Values of Selected customer
            $name = $row2['user_name'];
            $email = $row2['email'];
            $role = $row2['role'];
            $department = $row2['department'];
        }
        else
        {
            // Redirect to Manage Customer
            header('location:'.SITEURL.'manage-user.php');
        }
    ?>
    
    <div class="main-content">
        <div class="wrapper">
            <h1 class="row mb-4">Update User</h1>

            <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
                    <label for="inputName" class="col-sm-1 col-form-label">Name:</label>
                    <div class="col-sm-3"> 
                    <input type="text" id="name" name="user_name" value="<?php echo $name; ?>" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                <label for="InputEmail" class="col-sm-1 col-form-label">Email:</label>
                    <div class="col-sm-3">
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                <label for="InputRole" class="col-sm-1 col-form-label">Role:</label>
                    <div class="col-sm-3">
                    <input type="text" id="role" name="role" value="<?php echo $role; ?>" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="inputDepartment" class="col-sm-1 col-form-label">Department:</label>
                    <div class="col-sm-3">
                    <select name="department">
                        <option value="IT">IT</option>
                        <option value="TS">TS</option>
                    </select>               
                    </div>
                </div>
                
                <input type="hidden" name="id" value="<?php echo $id; ?>">         
                <input type="submit" name="submit" value="Update User" class="btn btn-primary col-sm-1.2">
    
            </form>
    
            <?php 
            
                if(isset($_POST['submit']))
                {
                    //echo "Button Clicked";
    
                    // 1. Get all the details from the form
                    $id = $_POST['id'];
                    $name = $_POST['user_name'];
                    $email = $_POST['email'];
                    $role = $_POST['role'];
                    $department = $_POST['department'];
                                       
                   // 2. Update the customer in Database
                    $sql3 = "UPDATE tbl_user SET 
                        user_name = '$name',
                        email = '$email',
                        role = '$role',
                        department = '$department'
                        WHERE id=$id
                    ";
    
                    // Execute the SQL Query
                    $res3 = mysqli_query($conn, $sql3);
    
                    // Check whether the query is executed or not 
                    if($res3==true)
                    {
                        // Query Exectued and customer Updated
                        $_SESSION['update'] = "<div class='success'>User Details Updated Successfully.</div>";
                        header('location:'.SITEURL.'manage-user.php');
                    }
                    else
                    {
                        // Failed to Update customer
                        $_SESSION['update'] = "<div class='error'>Failed to Update user details.</div>";
                        header('location:'.SITEURL.'manage-user.php');
                    }
                }
            ?>
        </div>
    </div>
    
    <?php include('partials/footer.php'); ?>
    

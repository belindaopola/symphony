<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h2 class="row mb-4">Change Password</h2>
    
            <?php 
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
            ?>
    
            <form action="" method="POST">
                <div class="row mb-4">
                    <label for="InputCurrentPassword" class="col-sm-2 col-form-label">Current Password:</label>
                    <div class="col-sm-3">
                    <input type="password" name="current_password" placeholder="Current Password" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="InputNewPassword" class="col-sm-2 col-form-label">New Password:</label>
                    <div class="col-sm-3">
                    <input type="password" name="new_password" placeholder="New Password" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="InputConfirmPassword" class="col-sm-2 col-form-label">Confirm Password:</label>
                    <div class="col-sm-3">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Change Password" class="btn btn-primary col-sm-1.2">   
            </form>
    
        </div>
    </div>
    
    <?php 
        // Check whether the Submit Button is Clicked on Not
        if(isset($_POST['submit']))
        {
            // echo "clicked";

            // 1. Get the Data from Form
            $id=$_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);


            // 2. Check whether the user with current ID and Current Password Exists or Not
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            // Execute the Query
            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                // Check whether data is available or not
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    // User Exists and Password Can be CHanged
                    //echo "User FOund";

                    // Check whether the new password and confirm match or not
                    if($new_password==$confirm_password)
                    {
                        // Update the Password
                        $sql2 = "UPDATE tbl_admin SET 
                            password='$new_password' 
                            WHERE id=$id
                        ";

                        // Execute the Query
                        $res2 = mysqli_query($conn, $sql2);

                        // Check whether the query exeuted or not
                        if($res2==true)
                        {
                            // Display Succes Message
                            // Redirect to Manage Admin Page with Success Message
                            $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                            // Redirect the User
                            header('location:'.SITEURL.'manage-admin.php');
                        }
                        else
                        {
                            // Display Error Message
                            // Redirect to Manage Admin Page with Error Message
                            $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                            // Redirect the User
                            header('location:'.SITEURL.'manage-admin.php');
                        }
                    }
                    else
                    {
                        // Redirect to Manage Admin Page with Error Message
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Patch. </div>";
                        // Redirect the User
                        header('location:'.SITEURL.'manage-admin.php');

                    }
                }
                else
                {
                    // User Does not Exist Set Message and REdirect
                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                    //Redirect the User
                    header('location:'.SITEURL.'manage-admin.php');
                }
            }

            // 3. Check Whether the New Password and Confirm Password Match or not

            // 4. Change PAssword if all above is true
        }
    ?>
    
    <?php include('partials/footer.php'); ?>
    

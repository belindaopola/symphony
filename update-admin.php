<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1 class="row mb-4">Update Admin</h1>
        
            <?php 
                //1. Get the ID of Selected Admin
                $id=$_GET['id'];
    
                //2. Create SQL Query to Get the Details
                $sql="SELECT * FROM tbl_admin WHERE id=$id";
    
                //Execute the Query
                $res=mysqli_query($conn, $sql);
    
                //Check whether the query is executed or not
                if($res==true)
                {
                    // Check whether the data is available or not
                    $count = mysqli_num_rows($res);
                    //Check whether we have admin data or not
                    if($count==1)
                    {
                        // Get the Details
                        //echo "Admin Available";
                        $row=mysqli_fetch_assoc($res);
    
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                    else
                    {
                        //Redirect to Manage Admin PAge
                        header('location:'.SITEURL.'manage-admin.php');
                    }
                }
            
            ?>
    
    
            <form action="" method="POST">
            <div class="row mb-4">
            <label for="inputFullName" class="col-sm-1 col-form-label">Full Name:</label>
                <div class="col-sm-3">
                <input type="text" id="full-name" name="full_name" value="<?php echo $full_name; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputUsername" class="col-sm-1 col-form-label">Username:</label>
                <div class="col-sm-3">
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" class="form-control">
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Admin" class="btn btn-primary col-sm-1.2">  
            </form>
        </div>
    </div>
    
    <?php 
    
        //Check whether the Submit Button is Clicked or not
        if(isset($_POST['submit']))
        {
            //echo "Button CLicked";
            //Get all the values from form to update
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
    
            //Create a SQL Query to Update Admin
            $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username' 
            WHERE id='$id'
            ";
    
            //Execute the Query
            $res = mysqli_query($conn, $sql);
    
            //Check whether the query executed successfully or not
            if($res==true)
            {
                //Query Executed and Admin Updated
                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'manage-admin.php');
            }
            else
            {
                //Failed to Update Admin
                $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'manage-admin.php');
            }
        }
    ?>
    
    <?php include('partials/footer.php'); ?>


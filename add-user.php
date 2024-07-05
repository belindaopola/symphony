<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h4 class="row mb-4">Add User</h4>

        <?php 
            if(isset($_SESSION['add'])) // Checking whether the Session is Set of Not
            {
                echo $_SESSION['add']; // Display the Session Message if Set
                unset($_SESSION['add']); // Remove Session Message
            }
        ?>

        <form action="" method="POST">
        <div class="row mb-4">
            <label for="inputName" class="col-sm-1 col-form-label">Name:</label>
                <div class="col-sm-3">
                <input type="text" id="name" name="user_name" placeholder="Enter Name" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputEmail" class="col-sm-1 col-form-label">Email:</label>
                <div class="col-sm-3">
                <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="inputRole" class="col-sm-1 col-form-label">Role:</label>
                <div class="col-sm-3">
                <input type="text" id="role" name="role" placeholder="Enter Role" class="form-control" >
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
            <input type="submit" name="submit" value="Add User" class="btn btn-primary col-sm-1">
        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    // Process the Value from Form and Save it in Database

    // Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        // 1. Get the Data from form
        $name = $_POST['user_name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $department = $_POST['department'];


        // 2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_user SET 
            user_name='$name',
            email='$email',
            role='$role',
            department='$department'
        ";
 
        // 3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            // Data Inserted
            //echo "Data Inserted";
            // Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>User Added Successfully.</div>";
            // Redirect Page to Manage User
            header("location:".SITEURL.'manage-user.php');
        }
        else
        {
            // Failed to Insert DAta
            //echo "Faile to Insert Data";
            // Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add User.</div>";
            // Redirect Page to Add Admin
            header("location:".SITEURL.'add-user.php');
        }

    }
    
?>


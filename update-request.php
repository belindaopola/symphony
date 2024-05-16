<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="row mb-4">Update request</h1>

        <?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
                //GEt the request Details
                $id=$_GET['id'];

                //Get all other details based on this id
                //SQL Query to get the request details
                $sql = "SELECT * FROM tbl_request WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);

                    $product = $row['product'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address= $row['customer_address'];
                }
                else
                {
                    //DEtail not Available/
                    //Redirect to Manage request
                    header('location:'.SITEURL.'manage-request.php');
                }
            }
            else
            {
                //REdirect to Manage request PAge
                header('location:'.SITEURL.'manage-request.php');
            }
        
        ?>

        <form action="" method="POST">

            <div class="row mb-4">
                <label for="inputProductName" class="col-sm-1 col-form-label">Product Name:</label>
                <div class="col-sm-3"> 
                <input type="text" id="product" name="product" value="<?php echo $product; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputPrice" class="col-sm-1 col-form-label">Price:</label>
                <div class="col-sm-3"> 
                <input type="number" id="price" name="price" value="<?php echo $price; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputQty" class="col-sm-1 col-form-label">Qty:</label>
                <div class="col-sm-3"> 
                <input type="number" id="qty" name="qty" value="<?php echo $qty; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputStatus" class="col-sm-1 col-form-label">Status:</label>
                <div class="col-sm-3"> 
                    <select name="status">
                        <option <?php if($status=="requested"){echo "selected";} ?> value="requested">requested</option>
                        <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                    <label for="inputCustomerName" class="col-sm-1 col-form-label">Customer Name:</label>
                    <div class="col-sm-3"> 
                    <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" class="form-control">
                    </div>
            </div>
            <div class="row mb-4">
                <label for="InputContact" class="col-sm-1 col-form-label">Customer Contact:</label>
                <div class="col-sm-3">
                <input type="text" id="customer_contact" name="customer_contact" value="<?php echo $customer_contact; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputEmail" class="col-sm-1 col-form-label">Customer Email:</label>
                <div class="col-sm-3">
                <input type="email" id="customer_email" name="customer_email" value="<?php echo $customer_email; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="InputAddress" class="col-sm-1 col-form-label">Customer Address:</label>
                <div class="col-sm-3">
                <textarea type="text" id="customer_address" name="customer_address" value="<?php echo $customer_address; ?>" class="form-control"></textarea>
                </div>
            </div>
        
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <input type="submit" name="submit" value="Update request" class="btn btn-primary col-sm-1.2">      
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                //Update the Values
                $sql2 = "UPDATE tbl_request SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage request with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>request Updated Successfully.</div>";
                    header('location:'.SITEURL.'manage-request.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update request.</div>";
                    header('location:'.SITEURL.'manage-request.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

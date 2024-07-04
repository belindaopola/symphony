<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2 class="row mb-4">Update IT Request</h2>

        <?php 
        
            // Check whether id is set or not
            if(isset($_GET['id']))
            {
                // Get the request details
                $id = $_GET['id'];

                // SQL query to get the request details with joins for customer and salesperson names
                $sql = "SELECT ir.*, c.customer_name, u.user_name AS sales_person 
                        FROM tbl_it_request ir
                        JOIN tbl_customer c ON ir.customer_name = c.id
                        JOIN tbl_user u ON ir.sales_person = u.id
                        WHERE ir.id = $id";
                // Execute query
                $res = mysqli_query($conn, $sql);
                // Count rows
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    // Details available
                    $row = mysqli_fetch_assoc($res);

                    $customer_name = $row['customer_name'];
                    $title=$row['title']; 
                    $description = $row['description'];
                    $currency = $row['currency'];
                    $price = $row['price'];
                    $vat = $row['vat'];
                    $quotation = $row['quotation'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_po = $row['customer_po'];
                    $costing_sheet = $row['costing_sheet'];
                    $sales_person = $row['sales_person'];
                }
                else
                {
                    // Detail not available
                    // Redirect to manage request
                    header('location:' . SITEURL . 'manage-it-request.php');
                }
            }
            else
            {
                // Redirect to manage request page
                header('location:' . SITEURL . 'manage-it-request.php');
            }
        
        ?>

        <form action="" method="POST">
            <div class="row mb-4">
                <label for="inputCustomerName" class="col-sm-2 col-form-label">Customer Name:</label>
                <div class="col-sm-3"> 
                    <select id="customer-name" name="customer_name" class="form-control">
                        <option value="">Select Customer</option>
                        <?php 
                            $sql2 = "SELECT id, customer_name FROM tbl_customer";
                            $res2 = mysqli_query($conn, $sql2);
                            while ($row = mysqli_fetch_assoc($res2)) {
                                $selected = $row['id'] == $customer_name ? "selected" : "";
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['customer_name'] . "</option>";
                            }
                        ?>
                        <option value="new">Add New Customer</option>
                    </select>
                </div>
            </div>  
            <div class="row mb-4">
                <label for="inputDescription" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-3"> 
                <input type="text" id="description" name="description" value="<?php echo $description; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputquotation" class="col-sm-2 col-form-label">Quotation:</label>
                <div class="col-sm-3"> 
                <input type="file" id="quotation" name="quotation" value="<?php echo $quotation; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputPo" class="col-sm-2 col-form-label">Customer PO:</label>
                <div class="col-sm-3"> 
                <input type="file" id="customer_po" name="customer_po" value="<?php echo $customer_po; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputCostingsheet" class="col-sm-2 col-form-label">Costing Sheet:</label>
                <div class="col-sm-3"> 
                <input type="file" id="costing_sheet" name="costing_sheet" value="<?php echo $costing_sheet; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="currency" class="col-sm-2 col-form-label">Currency:</label>
                <div class="col-sm-3">
                    <select id="currency" name="currency" class="form-control">
                        <option value="USD" <?php if($currency == "USD"){echo "selected";} ?>>USD</option>
                        <option value="EUR" <?php if($currency == "EUR"){echo "selected";} ?>>EUR</option>
                        <option value="KES" <?php if($currency == "KES"){echo "selected";} ?>>KES</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputPrice" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-3"> 
                <input type="number" id="price" name="price" value="<?php echo $price; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputVAT" class="col-sm-2 col-form-label">VAT:</label>
                <div class="col-sm-3"> 
                <input type="number" id="vat" name="vat" value="<?php echo $vat; ?>" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="sales_person" class="col-sm-2 col-form-label">Sales Person:</label>
                <div class="col-sm-3">
                    <select id="sales_person" name="sales_person" class="form-control">
                        <option value="">Select Sales Person</option>
                        <?php 
                            $sql4 = "SELECT id, user_name FROM tbl_user";
                            $res4 = mysqli_query($conn, $sql4);
                            while ($row = mysqli_fetch_assoc($res4)) {
                                $selected = $row['id'] == $sales_person ? "selected" : "";
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['user_name'] . "</option>";
                            }
                        ?>
                        <option value="new">Add New Sales Person</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label for="inputStatus" class="col-sm-2 col-form-label">Status:</label>
                <div class="col-sm-3"> 
                    <select name="status" class="form-control">
                        <option <?php if($status == "requested"){echo "selected";} ?> value="requested">requested</option>
                        <option <?php if($status == "On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($status == "Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($status == "Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <input type="submit" name="submit" value="Update request" class="btn btn-primary col-sm-1.2">      
        </form>

        <?php 
            // Check whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                // Get All the Values from Form
                $id = $_POST['id'];
                $description = $_POST['description'];
                $quotation = $_POST['quotation'];
                $customer_po = $_POST['customer_po'];
                $costing_sheet = $_POST['costing_sheet'];
                $currency = $_POST['currency'];
                $price = $_POST['price'];
                $vat = $_POST['vat'];
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $sales_person = $_POST['sales_person'];

                // Update the Values
                $sql2 = "UPDATE tbl_it_request SET 
                    description = '$description',
                    quotation = '$quotation',
                    customer_po = '$customer_po',
                    costing_sheet = '$costing_sheet',
                    currency = '$currency',
                    price = $price,
                    vat = $vat,
                    status = '$status',
                    customer_name = $customer_name,
                    sales_person = $sales_person
                    WHERE id = $id
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // Check whether update or not and redirect to manage request with message
                if($res2 == true)
                {
                    // Updated
                    $_SESSION['update'] = "<div class='success'>Request Updated Successfully.</div>";
                    header('location:' . SITEURL . 'manage-request.php');
                }
                else
                {
                    // Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Request.</div>";
                    header('location:' . SITEURL . 'manage-it-request.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

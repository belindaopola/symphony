<?php 
include('partials/menu.php'); 

// Check whether id is set or not
if(isset($_GET['id'])) {
    // Get the request details
    $id = $_GET['id'];

    // SQL query to get the request details with joins for customer and salesperson names
    $sql = "SELECT r.*, c.customer_name, p.title, u.user_name AS sales_person 
            FROM tbl_request r
            JOIN tbl_customer c ON r.customer_name = c.id
            JOIN tbl_product p ON r.title = p.id
            JOIN tbl_user u ON r.sales_person = u.id
            WHERE r.id = $id";
    // Execute query
    $res = mysqli_query($conn, $sql);
    // Count rows
    $count = mysqli_num_rows($res);
    
    if($count == 1) {
        // Detail Available
        $row = mysqli_fetch_assoc($res);

        $customer_name = $row['customer_name'];
        $title = $row['title']; 
        $description = $row['description'];
        $quotation = $row['quotation'];            
        $customer_po = $row['customer_po'];
        $costing_sheet = $row['costing_sheet'];   
        $currency = $row['currency'];
        $price = $row['price'];
        $vat = $row['vat'];
        $sales_person = $row['sales_person']; 
        $status = $row['status'];                                
    } else {
        // Redirect to Manage request
        header('location:'.SITEURL.'manage-request.php');
        exit();
    }
} else {
    // Redirect to Manage request
    header('location:'.SITEURL.'manage-request.php');
    exit();
}

// Check whether Update Button is Clicked or Not
// Handle form submission
if (isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $vat = mysqli_real_escape_string($conn, $_POST['vat']);
    $sales_person = mysqli_real_escape_string($conn, $_POST['sales_person']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Function to handle file uploads and overwrite existing files
    function handleFileUpload($file, $prefix, $id) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $file_name = $file['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_name = $prefix . "_TS" . date("Y") . "_" . sprintf('%03d', $id) . '.' . $file_ext;
            $upload_path = 'uploads/files_ts/' . strtolower($prefix) . '/' . $new_name;
            move_uploaded_file($file['tmp_name'], $upload_path);
            return $new_name;
        } else {
            return "";
        }
    }

    // Handle file uploads and overwrite existing files
    $quotation = handleFileUpload($_FILES['quotation'], 'Quotation', $id);
    $customer_po = handleFileUpload($_FILES['po'], 'Customer_PO', $id);
    $costing_sheet = handleFileUpload($_FILES['costing_sheet'], 'Costing', $id);

    // Debugging the uploaded files
    var_dump($quotation, $customer_po, $costing_sheet);

    // Calculate total
    $total = $amount + $vat;

    // Update the database with the file names
    $sql = "UPDATE tbl_request SET 
            customer_name='$customer_name', 
            title='$title', 
            description='$description', 
            currency='$currency', 
            price='$amount', 
            vat='$vat', 
            total='$total', 
            sales_person='$sales_person', 
            status='$status'";

    if (!empty($quotation)) {
        $sql .= ", quotation='$quotation'";
    }
    if (!empty($customer_po)) {
        $sql .= ", customer_po='$customer_po'";
    }
    if (!empty($costing_sheet)) {
        $sql .= ", costing_sheet='$costing_sheet'";
    }

    $sql .= " WHERE id=$id";

    // Execute query
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['add'] = "<div class='success'>Request Updated Successfully.</div>";
        header("location:" . SITEURL . 'manage-request.php');
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to Update Request.</div>";
        header("location:" . SITEURL . 'update-request.php?id=' . $id);
    }
    exit(); // Ensure no further code is executed
}
?>

<section class="main-content">
    <div class="wrapper">
        <h1 class="text-center row mb-4">Update CSR</h1>

        <?php 
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add']; // Display session message if set
                unset($_SESSION['add']); // Remove session message
            }
        ?>

        <form action="" method="POST" class="request" enctype="multipart/form-data">

            <div class="row mb-4">
                <label for="customer_name" class="col-sm-3 col-form-label">Customer Name:</label>
                <div class="col-sm-5">
                    <select id="customer_name" name="customer_name" class="form-control">
                        <option value="">Select Customer</option>
                        <?php 
                            $sql2 = "SELECT id, customer_name FROM tbl_customer";
                            $res2 = mysqli_query($conn, $sql2);
                            while ($row = mysqli_fetch_assoc($res2)) {
                                $selected = ($row['customer_name'] == $customer_name) ? "selected" : "";
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['customer_name'] . "</option>";
                            }
                        ?>
                        <option value="new">Add New Customer</option>
                    </select>
                </div>
            </div>

            <script>
                document.getElementById('customer_name').addEventListener('change', function() {
                    if (this.value === 'new') {
                        window.location.href = 'add-customer.php';
                    }
                });
            </script>

            <div class="row mb-4">
                <label for="title" class="col-sm-3 col-form-label">Product:</label>
                <div class="col-sm-5">
                    <select id="title" name="title" class="form-control">
                        <option value="">Select Product/Service</option>
                        <?php 
                            $sql3 = "SELECT id, title FROM tbl_product";
                            $res3 = mysqli_query($conn, $sql3);
                            while ($row = mysqli_fetch_assoc($res3)) {
                                $selected = ($row['title'] == $title) ? "selected" : "";
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['title'] . "</option>";
                            }
                        ?>
                        <option value="new">Add New Product/Service</option>
                    </select>
                </div>
            </div>

            <script>
                document.getElementById('title').addEventListener('change', function() {
                    if (this.value === 'new') {
                        window.location.href = 'add-product.php';
                    }
                });
            </script>

            <div class="row mb-4">
                <label for="description" class="col-sm-3 col-form-label">Description:</label>
                <div class="col-sm-5">
                    <textarea id="description" name="description" class="form-control"><?php echo $description; ?></textarea>
                </div>
            </div>

            <div class="row mb-4">
                <label for="quotation" class="col-sm-3 col-form-label">Add Quotation:</label>
                <div class="col-sm-5">
                    <input type="file" id="quotation" name="quotation" class="form-control">
                </div>
            </div>

            <div class="row mb-4">
                <label for="customer_po" class="col-sm-3 col-form-label">Add Customer's PO:</label>
                <div class="col-sm-5">
                    <input type="file" id="customer_po" name="customer_po" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="costing_sheet" class="col-sm-3 col-form-label">Add Costing Sheet:</label>
                <div class="col-sm-5">
                    <input type="file" id="costing_sheet" name="costing_sheet" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="currency" class="col-sm-3 col-form-label">Currency:</label>
                <div class="col-sm-5">
                    <select id="currency" name="currency" class="form-control">
                        <option value="USD" <?php if ($currency == 'USD') echo 'selected'; ?>>USD</option>
                        <option value="EUR" <?php if ($currency == 'EUR') echo 'selected'; ?>>EUR</option>
                        <option value="KES" <?php if ($currency == 'KES') echo 'selected'; ?>>KES</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label for="amount" class="col-sm-3 col-form-label">Amount:</label>
                <div class="col-sm-5">
                    <input type="number" step="0.01" id="amount" name="amount" class="form-control" value="<?php echo $price; ?>" placeholder="Enter amount" required>
                </div>
            </div>
            <div class="row mb-4">
                <label for="vat" class="col-sm-3 col-form-label">VAT:</label>
                <div class="col-sm-5">
                    <input type="number" step="0.01" id="vat" name="vat" class="form-control" value="<?php echo $vat; ?>" placeholder="Enter VAT" required>
                </div>
            </div>
            <div class="row mb-4">
                <label for="sales_person" class="col-sm-3 col-form-label">Sales Person:</label>
                <div class="col-sm-5">
                    <select id="sales_person" name="sales_person" class="form-control">
                        <option value="">Select Sales Person</option>
                        <?php 
                            $sql4 = "SELECT id, user_name FROM tbl_user";
                            $res4 = mysqli_query($conn, $sql4);
                            while ($row = mysqli_fetch_assoc($res4)) {
                                $selected = ($row['user_name'] == $sales_person) ? "selected" : "";
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['user_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label for="status" class="col-sm-3 col-form-label">Status:</label>
                <div class="col-sm-5">
                <select name="status" class="form-control">
                        <option <?php if($status=="requested"){echo "selected";} ?> value="requested">requested</option>
                        <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="submit" name="submit" class="btn btn-primary">Update Request</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include('partials/footer.php'); ?>

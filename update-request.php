<?php 
include('partials/menu.php'); 

// Check whether id is set or not
if(isset($_GET['id'])) {
    // Get the request details
    $id = $_GET['id'];
}
// SQL Query to get the request details with joins
$sql = "
SELECT 
    tbl_request.id,
    tbl_request.request_date,
    tbl_customer.customer_name,
    tbl_product.title,
    tbl_request.quotation,
    tbl_request.customer_po,
    tbl_request.costing_sheet,
    tbl_request.currency,
    tbl_request.price,
    tbl_request.vat,
    tbl_request.total,
    tbl_request.status,
    tbl_user.user_name
FROM 
    tbl_request
JOIN 
    tbl_customer ON tbl_request.customer_name = tbl_customer.id
JOIN 
    tbl_product ON tbl_request.title = tbl_product.id
JOIN 
    tbl_user ON tbl_request.sales_person = tbl_user.id
WHERE 
    tbl_request.id  =$id";

// Execute Query
$res = mysqli_query($conn, $sql);
// Count Rows
$count = mysqli_num_rows($res);

if($count == 1) {
    // Detail Available
    $row = mysqli_fetch_assoc($res);

    $customer_name = $row['customer_name'];
    $title=$row['title']; 
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

    // Initialize file names
    $quotation = $customer_po = $costing_sheet = "";

    // Function to handle file upload
    function handleFileUpload($file, $prefix, $conn) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $file_name = $file['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $last_id_query = "SELECT MAX(id) AS last_id FROM tbl_it_request";
            $result = mysqli_query($conn, $last_id_query);
            $row = mysqli_fetch_assoc($result);
            $last_id = $row['last_id'] ?? 0;
            $new_name = $prefix . "_TS" . date("Y") . "_" . sprintf('%03d', $last_id + 1) . '.' . $file_ext;
            $upload_path = 'uploads/files_ts/' . strtolower($prefix) . '/' . $new_name;
            move_uploaded_file($file['tmp_name'], $upload_path);
            return $new_name;
        } else {
            return "";
        }
    }

    // Handle file uploads
    $quotation = handleFileUpload($_FILES['quotation'], 'Quotation', $conn);
    $customer_po = handleFileUpload($_FILES['customer_po'], 'Customer_PO', $conn);
    $costing_sheet = handleFileUpload($_FILES['costing_sheet'], 'Costing', $conn);

    // Calculate total
    $total = $amount + $vat;

    // Update the database with the file names
    $sql = "INSERT INTO tbl_it_request SET 
            customer_name='$customer_name', 
            title='$title', 
            description='$description', 
            currency='$currency', 
            price='$amount', 
            vat='$vat', 
            total='$total', 
            sales_person='$sales_person', 
            status='$status', 
            quotation='$quotation', 
            customer_po='$customer_po', 
            costing_sheet='$costing_sheet'";

    // Execute query
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['add'] = "<div class='success'>Request Added Successfully.</div>";
        header("location:" . SITEURL . 'manage-it-request.php');
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Request.</div>";
        header("location:" . SITEURL . 'add-it-request.php');
    }
    exit(); // Ensure no further code is executed
}
?>

<section class="main-content">
    <div class="wrapper">
        <h1 class="text-center row mb-4">Create New IT CSR</h1>

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
                                echo "<option value='" . $row['id'] . "'>" . $row['customer_name'] . "</option>";
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
                                echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
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
                    <textarea id="description" name="description" class="form-control"></textarea>
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
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="KES">KES</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label for="amount" class="col-sm-3 col-form-label">Amount:</label>
                <div class="col-sm-5">
                    <input type="number" step="0.01" id="amount" name="amount" class="form-control" placeholder="Enter amount" required>
                </div>
            </div>
            <div class="row mb-4">
                <label for="vat" class="col-sm-3 col-form-label">VAT:</label>
                <div class="col-sm-5">
                    <input type="number" step="0.01" id="vat" name="vat" class="form-control" placeholder="Enter VAT" required>
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
                                echo "<option value='" . $row['id'] . "'>" . $row['user_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label for="status" class="col-sm-3 col-form-label">Status:</label>
                <div class="col-sm-5">
                    <select id="status" name="status" class="form-control">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="submit" name="submit" class="btn btn-primary">Add Request</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include('partials/footer.php'); ?>
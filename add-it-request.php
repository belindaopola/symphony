<?php 
include('partials/menu.php');

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

    // Handle file uploads; get the last inserted ID to generate unique names for the files and upload files
    if ($_FILES['quotation']['error'] === UPLOAD_ERR_OK) {
        $quotation = $_FILES['quotation']['name'];
        $quotation_ext = pathinfo($quotation, PATHINFO_EXTENSION);
        $q_last_id_query = "SELECT MAX(id) AS q_last_id FROM tbl_it_request";
        $q_result = mysqli_query($conn, $q_last_id_query);
        $q_row = mysqli_fetch_assoc($q_result);
        $q_last_id = $q_row['q_last_id'] ?? 0;
        $quotation_new_name = "Quotation_IT" . date("Y") . "_" . sprintf('%03d', $q_last_id + 1) . '.' . $quotation_ext;
        $quotation_path = 'uploads/files_it/quotation/' . $quotation_new_name;
        move_uploaded_file($_FILES['quotation']['tmp_name'], $quotation_path);
        $quotation = $quotation_new_name;
    } else {
        $quotation = "";
    }

    if ($_FILES['customer_po']['error'] === UPLOAD_ERR_OK) {
        $customer_po = $_FILES['customer_po']['name'];
        $customer_po_ext = pathinfo($customer_po, PATHINFO_EXTENSION);
        $p_last_id_query = "SELECT MAX(id) AS p_last_id FROM tbl_it_request";
        $p_result = mysqli_query($conn, $p_last_id_query);
        $p_row = mysqli_fetch_assoc($p_result);
        $p_last_id = $p_row['p_last_id'] ?? 0;
        $customer_po_new_name = "PO_IT" . date("Y") . "_" . sprintf('%03d', $p_last_id + 1) . '.' . $customer_po_ext;
        $customer_po_path = 'uploads/files_it/po/' . $customer_po_new_name;
        move_uploaded_file($_FILES['customer_po']['tmp_name'], $customer_po_path);
        $customer_po = $customer_po_new_name;
    } else {
        $customer_po = "";
    }

    if ($_FILES['costing_sheet']['error'] === UPLOAD_ERR_OK) {
        $costing_sheet = $_FILES['costing_sheet']['name'];
        $costing_sheet_ext = pathinfo($costing_sheet, PATHINFO_EXTENSION);
        $c_last_id_query = "SELECT MAX(id) AS c_last_id FROM tbl_it_request";
        $c_result = mysqli_query($conn, $c_last_id_query);
        $c_row = mysqli_fetch_assoc($c_result);
        $c_last_id = $c_row['c_last_id'] ?? 0;
        $costing_sheet_new_name = "Costing_IT" . date("Y") . "_" . sprintf('%03d', $c_last_id + 1) . '.' . $costing_sheet_ext;
        $costing_sheet_path = 'uploads/files_it/costing/' . $costing_sheet_new_name;
        move_uploaded_file($_FILES['costing_sheet']['tmp_name'], $costing_sheet_path);
        $costing_sheet = $costing_sheet_new_name;
    } else {
        $costing_sheet = "";
    }

    // Calculate total
    $total = $amount + $vat;

    // Update the database with the file names
    $sql = "INSERT INTO tbl_it_request SET 
            customer_name='$customer_name', 
            description='$title', 
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
                                                header("location:" . SITEURL . 'manage-request.php');
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Request.</div>";
        header("location:" . SITEURL . 'add-request.php');
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
                <label for="customer-name" class="col-sm-3 col-form-label">Customer Name:</label>
                <div class="col-sm-5">
                    <select id="customer-name" name="customer_name" class="form-control">
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
                document.getElementById('customer-name').addEventListener('change', function() {
                    if (this.value === 'new') {
                        window.location.href = 'add-customer.php';
                    }
                });
            </script>

            <div class="row mb-4">
                <label for="title" class="col-sm-3 col-form-label">Product Description:</label>
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
                <label for="quotation" class="col-sm-3 col-form-label">Add Quotation:</label>
                <div class="col-sm-5">
                    <input type="file" id="quotation" name="quotation" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="customer-po" class="col-sm-3 col-form-label">Add Customer's PO:</label>
                <div class="col-sm-5">
                    <input type="file" id="customer-po" name="customer_po" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
                <label for="costing-sheet" class="col-sm-3 col-form-label">Add Costing Sheet:</label>
                <div class="col-sm-5">
                    <input type="file" id="costing-sheet" name="costing_sheet" class="form-control">
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
                    <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount" required>
                </div>
            </div>
            <div class="row mb-4">
                <label for="vat" class="col-sm-3 col-form-label">VAT:</label>
                <div class="col-sm-5">
                    <input type="number" id="vat" name="vat" class="form-control" placeholder="Enter VAT" required>
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
                        <option value="new">Add New Sales Person</option>
                    </select>
                </div>
            </div>

            <script>
                document.getElementById('sales_person').addEventListener('change', function() {
                    if (this.value === 'new') {
                        window.location.href = 'add-salesperson.php';
                    }
                });
            </script>

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
                <div class="col-sm-3"></div>
                <div class="col-sm-5">
                    <button type="submit" name="submit" class="btn btn-primary">Add Request</button>
                </div>
            </div>
        </form>
    </div>
</section>



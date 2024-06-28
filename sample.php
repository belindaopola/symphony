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
    $customer_po = handleFileUpload($_FILES['customer_po'], 'Customer_PO', $id);
    $costing_sheet = handleFileUpload($_FILES['costing_sheet'], 'Costing', $id);

    // Calculate total
    $total = $amount + $vat;

    // Update the database with the file names
    $sql = "UPDATE tbl_it_request SET 
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

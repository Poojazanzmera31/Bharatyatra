<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "bharatyatra_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form is submitted with inquiry ID and status
if (isset($_POST['inquiry_id']) && isset($_POST['status'])) {
    $inquiryId = $_POST['inquiry_id'];
    $status = $_POST['status'];
    // Update the status in the database
    $stmt = $conn->prepare("UPDATE contact_form_submissions SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $inquiryId);

    if ($stmt->execute()) {
        // Redirect back to the main page after successful update
        header("Location: admin-panel.php?status=updated");
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>
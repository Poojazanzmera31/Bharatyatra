<?php
// update_package_status.php
$conn = new mysqli("localhost", "root", "", "bharatyatra_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_id = $_POST['package_id']; // Get package ID
    $new_status = $_POST['status']; // Get new status from the dropdown

    // Update the status in the database
    $sql = "UPDATE tour_packages SET status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_status, $package_id);

    if ($stmt->execute()) {
        // Display a success message and reload the page after clicking OK
        echo "<script>
                alert('Status updated successfully!');
                window.location.href = 'admin-panel.php'; // Reload the page after alert
              </script>";
    } else {
        echo "<script>alert('Error updating status: " . $conn->error . "');</script>";
    }

    $stmt->close();
    $conn->close();

    // Exit to ensure no further processing after the redirect
    exit();
}

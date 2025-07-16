<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// update_status.php
$conn = new mysqli("localhost", "root", "", "bharatyatra_db");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id']; // Get booking ID
    $new_status = $_POST['status']; // Get new status from the dropdown

    // Update the status in the database
    $sql = "UPDATE bookings SET status=? WHERE booking_id=?"; // Correct column name
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error); // Error handling for statement preparation
    }

    $stmt->bind_param("si", $new_status, $booking_id); // Bind parameters

    if ($stmt->execute()) {
        // Display a success message and reload the page after clicking OK
        echo "<script>
                alert('Status updated successfully!');
                window.location.href = 'admin-panel.php'; // Redirect back to the bookings section
              </script>";
    } else {
        echo "<script>alert('Error updating status: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();

    // Exit to ensure no further processing after the redirect
    exit();
}
?>

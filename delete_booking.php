<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "bharatyatra_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the booking ID from the POST request
    $booking_id = $_POST['booking_id'];

    // SQL query to delete the booking
    $sql = "DELETE FROM bookings WHERE booking_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $booking_id); // Bind booking ID
        if ($stmt->execute()) {
            echo "<script>alert('Booking deleted successfully'); window.location.href='admin-panel.php';</script>";
        } else {
            echo "<script>alert('Failed to delete booking'); window.location.href='admin-panel.php';</script>";
        }
        $stmt->close();
    }

    $conn->close();
} else {
    echo "<script>alert('Invalid request'); window.location.href='admin-panel.php';</script>";
}
?>

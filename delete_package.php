<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli("localhost", "root", "", "bharatyatra_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the tour name from the tour_packages table based on the ID
    $getTourNameSql = "SELECT title FROM tour_packages WHERE id = ?";
    $stmt = $conn->prepare($getTourNameSql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($tourName);
    $stmt->fetch();
    $stmt->close();

    // Check if the package is linked to any bookings using the tour name
    if ($tourName) {
        $checkBookingSql = "SELECT COUNT(*) FROM bookings WHERE tour_package = ?";
        $stmt = $conn->prepare($checkBookingSql);
        $stmt->bind_param("s", $tourName); // Use string for the tour package name
        $stmt->execute();
        $stmt->bind_result($bookingCount);
        $stmt->fetch();
        $stmt->close();

        if ($bookingCount > 0) {
            echo "<script>alert('This package cannot be deleted as it is associated with a booking.'); window.location.href='admin-panel.php';</script>";
        } else {
            // Prepare a statement to delete the package
            $sql = "DELETE FROM tour_packages WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                // Bind parameters and execute the statement
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    echo "<script>alert('Package deleted successfully!'); window.location.href='admin-panel.php';</script>";
                } else {
                    echo "<script>alert('Error deleting package: " . $conn->error . "'); window.location.href='admin-panel.php';</script>";
                }
                // Close the statement
                $stmt->close();
            } else {
                echo "<script>alert('Error preparing statement: " . $conn->error . "'); window.location.href='admin-panel.php';</script>";
            }
        }
    } else {
        echo "<script>alert('No valid tour package found for this ID.'); window.location.href='admin-panel.php';</script>";
    }
} else {
    echo "<script>alert('No package ID provided.'); window.location.href='admin-panel.php';</script>";
}

// Close the database connection
$conn->close();
?>
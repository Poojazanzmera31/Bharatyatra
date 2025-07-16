<?php
// Check if user_id and status are set in the POST request
if (isset($_POST['user_id']) && isset($_POST['status'])) {
    $conn = new mysqli("localhost", "root", "", "bharatyatra_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = intval($_POST['user_id']);
    $status = $_POST['status'];

    // Update the user's status
    $sql = "UPDATE users SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $user_id);

    if ($stmt->execute()) {
        // Redirect back to the user management page or display a success message
        header("Location: admin-panel.php"); // Change to the appropriate page
    } else {
        echo "Error updating user status!";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request!";
}
?>
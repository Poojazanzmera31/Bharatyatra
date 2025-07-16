<?php
session_start();
include 'db.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];
$target_path = "uploads/";

// Ensure the "uploads" directory exists and has correct permissions
if (!is_dir($target_path)) {
    mkdir($target_path, 0777, true);
}

// Check if file is selected
if (!isset($_FILES['profilePic']) || $_FILES['profilePic']['error'] !== UPLOAD_ERR_OK) {
    echo "<script>alert('File upload error. Please select a valid image.'); window.location.href='profile.php';</script>";
    exit;
}

$file_name = basename($_FILES['profilePic']['name']);
$file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

// Validate file type
if (!in_array($file_type, $allowed_types)) {
    echo "<script>alert('Invalid file type! Only JPG, JPEG, PNG, and GIF files are allowed.'); window.location.href='profile.php';</script>";
    exit;
}

// Generate unique file name
$new_file_name = "profile_" . $user_id . "_" . time() . "." . $file_type;
$target_file = $target_path . $new_file_name;

// Move uploaded file
if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $target_file)) {
    // Update database with new image path
    $updateQuery = "UPDATE users SET profile_image = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("si", $target_file, $user_id);

    if ($updateStmt->execute()) {
        echo "<script>alert('Profile picture updated successfully!'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile image in the database.'); window.location.href='profile.php';</script>";
    }

    $updateStmt->close();
} else {
    echo "<script>alert('Error uploading file.'); window.location.href='profile.php';</script>";
}
?>

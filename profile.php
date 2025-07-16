<?php
session_start();
include 'db.php'; // Database connection file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT name, email, phone, first_name, last_name, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $phone, $firstName, $lastName, $profileImage);
$stmt->fetch();
$stmt->close();

// Set default profile image if not set
$defaultImage = 'images/default.png';
if (empty($profileImage)) {
    $profileImage = $defaultImage;
}

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $newName = trim($_POST['fullName']);
    $newEmail = trim($_POST['email']);
    $newPhone = trim($_POST['phone']);
    $newFirstName = trim($_POST['firstName']);
    $newLastName = trim($_POST['lastName']);

    if (!empty($newName) && filter_var($newEmail, FILTER_VALIDATE_EMAIL) && !empty($newPhone)) {
        $updateQuery = "UPDATE users SET name = ?, email = ?, phone = ?, first_name = ?, last_name = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("sssssi", $newName, $newEmail, $newPhone, $newFirstName, $newLastName, $user_id);

        if ($updateStmt->execute()) {
            echo "<script>alert('Profile updated successfully'); window.location.href='profile.php';</script>";
        } else {
            echo "<script>alert('Error updating profile');</script>";
        }
        $updateStmt->close();
    } else {
        echo "<script>alert('Invalid input data!');</script>";
    }
}

// Handle password update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    $newPassword = $_POST['new_password'];

    if (strlen($newPassword) >= 6) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updatePasswordQuery = "UPDATE users SET password = ? WHERE id = ?";
        $updatePasswordStmt = $conn->prepare($updatePasswordQuery);
        $updatePasswordStmt->bind_param("si", $hashedPassword, $user_id);

        if ($updatePasswordStmt->execute()) {
            echo "<script>alert('Password updated successfully'); window.location.href='profile.php';</script>";
        } else {
            echo "<script>alert('Error updating password');</script>";
        }
        $updatePasswordStmt->close();
    } else {
        echo "<script>alert('Password must be at least 6 characters long');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: lightgrey;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .profile-container {
        display: flex;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 600px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    .profile-img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ddd;
    display: block;
    margin: 0 auto;
}

    .profile-left {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }
    .profile-left img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 3px solid #4caf50;
        margin-bottom: 10px;
        object-fit: cover;
    }
    .profile-right {
        flex: 2;
        padding: 20px;
    }
    .profile-right h2 {
        border-bottom: 2px solid #4caf50;
        padding-bottom: 10px;
    }
    form {
        display: flex;
        flex-direction: column;
    }
    label {
        margin-top: 10px;
        display: flex;
        align-items: center;
    }
    label i {
        margin-right: 10px;
        color: #4caf50;
    }
    input {
        background: #f1f1f1;
        border: 1px solid #ccc;
        padding: 8px;
        color: #333;
        border-radius: 5px;
        width: 100%;
    }
    button {
        margin-top: 15px;
        background: #4caf50;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 5px;
    }
    button:hover {
        background: #45a049;
    }
    .close-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 18px;
        cursor: pointer;
        color: green;
    }
</style>
<body>
    <div class="profile-container">
        <i class="fas fa-times close-icon" onclick="redirectToHome()"></i>
        <div class="profile-left">
            <img id="profile-img" src="<?php echo $profileImage; ?>" alt="Profile Picture">
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="profilePic" id="file-input" accept="image/*" required>
                <button type="submit" name="upload">Upload</button>
            </form>
            <button class="remove-btn" onclick="removeImage()">Remove</button>
            
            <h3>Update Password</h3>
            <form method="POST">
                <label><i class="fas fa-lock"></i> New Password:</label>
                <input type="password" name="new_password" required>
                <button type="submit" name="update_password">Update Password</button>
            </form>
        </div>
        <div class="profile-right">
            <h2>Edit Profile</h2>
            <form method="POST">
                <label><i class="fas fa-user"></i> Username:</label>
                <input type="text" name="fullName" value="<?php echo htmlspecialchars($name); ?>" required>
                
                <label><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                
                <label><i class="fas fa-phone"></i> Phone:</label>
                <input type="tel" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                
                <label><i class="fas fa-user"></i> First Name:</label>
                <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
                
                <label><i class="fas fa-user"></i> Last Name:</label>
                <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>

                <button type="submit" name="update_profile">Save Changes</button>
            </form>
        </div>
    </div>
    <script>
    function removeImage() {
        let confirmation = confirm("Are you sure you want to remove your profile picture?");
        if (confirmation) {
            document.getElementById("profile-img").src = "<?php echo $defaultImage; ?>";
        }
    }

    function redirectToHome() {
        window.location.href = 'home.php';
    }
</script>

</body>
</html>
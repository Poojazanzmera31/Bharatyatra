<?php
// Check if the form has been submitted
if (isset($_POST['btn3'])) {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "bharatyatra_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $id = $conn->real_escape_string($_POST['id']);
    $title = $conn->real_escape_string($_POST['titl']);
    $description = $conn->real_escape_string($_POST['desc']);
    $cost = $conn->real_escape_string($_POST['cost']);
    $duration = $conn->real_escape_string($_POST['dur']);
    $location = $conn->real_escape_string($_POST['loc']);
    $status = $conn->real_escape_string($_POST['status']); // New field for status

    // Handle file upload
    $image = '';
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file types
    $target_dir = "uploads/";

    if (!empty($_FILES['fileToUpload']['name'])) {
        // Extract file extension
        $file_name = basename($_FILES['fileToUpload']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Check if the file type is allowed
        if (in_array($file_ext, $allowed_types)) {
            // Generate a unique name for the file
            $new_file_name = uniqid() . '.' . $file_ext;
            $target_file = $target_dir . $new_file_name;

            // Attempt to move the uploaded file
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                $image = $new_file_name; // Save the new file name to the database
            } else {
                echo "<script>alert('Sorry, file upload failed. Please try again!');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');</script>";
        }
    } else {
        // If no new file is uploaded, keep the existing image
        $result = $conn->query("SELECT image FROM tour_packages WHERE id = '$id'");
        if ($result) {
            $row = $result->fetch_assoc();
            $image = $row['image'];
        }
    }

    // Update query
    $sql = "UPDATE tour_packages 
            SET title='$title', image='$image', description='$description', cost='$cost', duration='$duration', location='$location', status='$status'
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Display success message and then redirect
        echo "<script>
                alert('Record updated successfully!');
                window.location.href = 'admin-panel.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }

    $conn->close();
}

// Fetch existing data for editing
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $conn = new mysqli("localhost", "root", "", "bharatyatra_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $id = $conn->real_escape_string($id);
    $sql = "SELECT * FROM tour_packages WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result) {
        $data = $result->fetch_assoc();
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tour Package</title>
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <style>
    .form-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        width: 400px;
        margin: 20px auto;
    }

    .form-container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 24px;
    }

    .form-container label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #555;
    }

    .form-container input[type="text"],
    .form-container input[type="file"],
    .form-container select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .form-container input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        border: none;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .form-container input[type="submit"]:hover {
        background-color: #218838;
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 768px) {
        .form-container {
            width: 90%;
            padding: 15px;
        }

        .form-container h2 {
            font-size: 22px;
        }

        .form-container input[type="submit"] {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .form-container {
            width: 95%;
            margin: 10px;
        }

        .form-container h2 {
            font-size: 20px;
        }
    }
    </style>

</head>
<body>
    <div class="form-container">
        <h2>Update Tour Package</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">

            <label for="titl">Title</label>
            <input type="text" id="titl" name="titl" value="<?php echo htmlspecialchars($data['title']); ?>" required>

            <label for="fileToUpload">Image</label>
            <input type="file" id="fileToUpload" name="fileToUpload">

            <label for="desc">Description</label>
            <input type="text" id="desc" name="desc" value="<?php echo htmlspecialchars($data['description']); ?>" required>

            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost" value="<?php echo htmlspecialchars($data['cost']); ?>" required>

            <label for="dur">Duration</label>
            <input type="text" id="dur" name="dur" value="<?php echo htmlspecialchars($data['duration']); ?>" required>

            <label for="loc">Location</label>
            <input type="text" id="loc" name="loc" value="<?php echo htmlspecialchars($data['location']); ?>" required>

            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="active" <?php if ($data['status'] == 'active') echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if ($data['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
            </select>

            <input type="submit" name="btn3" value="Update">
        </form>
    </div>
</body>
</html>

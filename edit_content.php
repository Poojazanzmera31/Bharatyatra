<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Check if the form has been submitted
if (isset($_POST['btn'])) {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "bharatyatra_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $id = $conn->real_escape_string($_POST['id']);
    $tour_package_id = $conn->real_escape_string($_POST['tour_package_id']);
    $tour_name = $conn->real_escape_string($_POST['tour_name']);
    $location = $conn->real_escape_string($_POST['location']);
    $description = $conn->real_escape_string($_POST['description']);
    // Handle file upload
    $image = '';
    if (!empty($_FILES['fileToUpload']['name'])) {
        $target_path = "uploads/";
        $target_path = $target_path . basename($_FILES['fileToUpload']['name']);

        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {
            $image = basename($_FILES['fileToUpload']['name']);
        } else {
            echo "<script>alert('Sorry, file not uploaded, please try again!');</script>";
        }
    } else {
        // If no new file is uploaded, keep the existing image
        $result = $conn->query("SELECT image_path FROM content_package WHERE id = '$id'");
        if ($result) {
            $row = $result->fetch_assoc();
            $image = $row['image_path'];
        }
    }

    // Update query
    $sql = "UPDATE content_package 
            SET tour_package_id='$tour_package_id', tour_name='$tour_name', image_path='$image', location='$location', description='$description'
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully!'); window.location.href='admin-panel.php';</script>";
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
    $sql = "SELECT * FROM content_package WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result) {
        $data = $result->fetch_assoc();
    }
    $conn->close();
}

// Fetch tour packages for the dropdown
$conn = new mysqli("localhost", "root", "", "bharatyatra_db");
$tour_packages = [];
$sql = "SELECT id, title FROM tour_packages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tour_packages[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Content Package</title>
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
        .form-container select,
        .form-container textarea {
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
        @media (max-width: 768px) {
    .form-container {
        width: 100%; /* Make the form take full width on tablets and smaller */
        padding: 15px; /* Adjust padding for smaller screens */
    }

    .form-container h2 {
        font-size: 22px; /* Slightly reduce heading size */
    }

    .form-container input[type="submit"] {
        font-size: 14px; /* Adjust font size for the button on smaller screens */
    }
}

@media (max-width: 480px) {
    .form-container {
        width: 100%; /* Full-width on mobile devices */
        margin: 10px; /* Reduce margin for mobile */
    }

    .form-container h2 {
        font-size: 20px; /* Further reduce heading size on small screens */
    }
}
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Update Content Package</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">

            <label for="tour_package_id">Tour Package</label>
            <select id="tour_package_id" name="tour_package_id" required>
                <option value="">Select Tour Package</option>
                <?php foreach ($tour_packages as $package): ?>
                    <option value="<?php echo $package['id']; ?>" <?php if ($package['id'] == $data['tour_package_id']) echo 'selected'; ?>>
                        <?php echo $package['title']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="tour_name">Tour Name</label>
            <input type="text" id="tour_name" name="tour_name" value="<?php echo htmlspecialchars($data['tour_name']); ?>" required>

            <label for="fileToUpload">Image</label>
            <input type="file" id="fileToUpload" name="fileToUpload">

            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($data['location']); ?>" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($data['description']); ?></textarea>

            <input type="submit" name="btn" value="Update">
        </form>
    </div>
</body>
</html>


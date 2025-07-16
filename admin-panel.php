<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin-panel.css">
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <style>
        /* dashboard */
/* General Section Styling */
#dashboardsection {
    padding: 20px;
    font-family: Arial, sans-serif;
    text-align: center;
}

/* Row styling */
.row {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

/* Column styling for dashboard tiles */
.col-md-3 {
    flex: 1;
    max-width: 22%;
    margin: 10px;
}

/* General dashboard tile styling */
.dashboard-tile {
    padding: 20px;
    border-radius: 10px;
    color: white;
    text-align: center;
    transition: transform 0.2s;
}

/* Hover effect for tiles */
.dashboard-tile:hover {
    transform: scale(1.05);
}

/* Specific colors for tiles */
.dashboard-tile.red {
    background-color: #f44336;
}

.dashboard-tile.purple {
    background-color: #9c27b0;
}

.dashboard-tile.blue {
    background-color: #2196f3;
}

.dashboard-tile.green {
    background-color: #4caf50;
}

/* Styling for tile headers and numbers */
.dashboard-tile h3 {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
}

.dashboard-tile h2 {
    font-size: 35px;
    color: white;
    margin: 10px 0;
}

select {
    width: auto; /* Adjust the width as needed */
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    color: #333;
    font-size: 14px;
    outline: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

select:focus {
    background-color: #e2e2e2;
    border-color: #007bff; /* Highlight border color when focused */
}

select option {
    padding: 10px;
    background-color: white;
    color: #333;
}

select:hover {
    background-color: #f0f0f0;
}

/* Status colors */
.status-new { color: green; font-weight: bold; }
.status-read { color: red; font-weight: bold; }
.status-pending { color: orange; font-weight: bold; }
.status-approved { color: green; font-weight: bold; }
.status-rejected { color: red; font-weight: bold; }
.status-active { color: green; font-weight: bold; }
.status-blocked { color: red; font-weight: bold; }

.btn {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    margin: 5px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn i {
    margin-right: 8px;
}

/* Warning button for Update */
.btn-warning {
    background-color: #ffc107;
    color: #000;
}

.btn-warning:hover {
    background-color: #e0a800;
}

/* Danger button for Delete */
.btn-danger {
    background-color: #dc3545;
    color: #fff;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Icon size and spacing */
.btn i {
    font-size: 18px;
}
/* Base button style */
.btn {
    display: inline-flex;
    align-items: center;
    padding: 8px 12px;
    margin: 5px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

/* Icon size and spacing */
.btn i {
    font-size: 18px;
    margin-right: 8px; /* Spacing between the icon and the text */
}

/* Danger button for Delete */
.btn-danger {
    background-color: #dc3545;
    color: #fff;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Warning button for other actions (like update) */
.btn-warning {
    background-color: #ffc107;
    color: #000;
}

.btn-warning:hover {
    background-color: #e0a800;
}

/* Optional: table styling for better alignment */
.table td {
    vertical-align: middle;
    text-align: center;
}

.packages-container table {
    width: 100%;
    table-layout: fixed; /* Ensures table cells are a fixed width */
}

.packages-container td {
    word-wrap: break-word; /* Forces words to break within the cell */
    vertical-align: top; /* Aligns the content to the top of the cell */
}

.truncate-text {
    max-width: 200px; /* Adjust this as needed */
    white-space: nowrap; /* Keep the text in one line */
    overflow: hidden; /* Hide any overflow text */
    text-overflow: ellipsis; /* Add ellipsis (...) for overflowing text */
}

/* Optional: Limit width for the entire table */
.packages-container {
    overflow-x: auto; /* Enable horizontal scrolling if the table overflows */
}

/* Media queries for element visibility */
@media (max-width: 1200px) {
    .col-md-3 {
        max-width: 30%;
    }
    /* Example: Hide an element for screens smaller than 1200px */
    .hide-on-large {
        display: none;
    }
}

@media (max-width: 992px) {
    .col-md-3 {
        max-width: 45%;
    }
    .hide-on-medium {
        display: none;
    }
}

@media (max-width: 768px) {
    .col-md-3 {
        max-width: 90%;
    }

    .row {
        flex-direction: column;
        align-items: center;
    }

    .dashboard-tile h3 {
        font-size: 16px;
    }

    .dashboard-tile h2 {
        font-size: 30px;
    }

    /* Hide elements on smaller screens */
    .hide-on-small {
        display: none;
    }
}

@media (max-width: 576px) {
    .dashboard-tile h3 {
        font-size: 14px;
    }

    .dashboard-tile h2 {
        font-size: 25px;
    }

    select {
        width: 100%;
    }

    /* Example: Hide element for very small screens */
    .hide-on-xsmall {
        display: none;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <h2>Bharatyatra</h2>
            </div>
<!-- side navbar -->
            <nav>
                <ul>
                <li><a href="#" onclick="showSection('dashboardsection')">Dashboard</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropbtn" onclick="toggleDropdown()">Package</a>
                        <div class="dropdown-content">
                            <a href="#" onclick="showCreateForm()">Create</a>
                            <a href="#" onclick="showDisplaySection()">Display</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropbtn" onclick="toggleDropdown1()">Description</a>
                        <div class="dropdown-content1">
                            <a href="#" onclick="showformcontent()">Create</a>
                            <a href="#" onclick="showDisplaycontent()">Display</a>
                        </div>
                    </li>
                    <li><a href="#" onclick="showDisplayUsers()">Users</a></li>
                    <li><a href="#" onclick="showBookings()">Bookings</a></li>
                    <li><a href="#" onclick="showInquries()">Enquiries</a></li>
                    <li><a href="#" onclick="showReviews()">Rate & Reviews</a></li>
                    <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header>
                <h1>Bharatyatra - The Heaven of Earth</h1>
            </header><br><br>
            
<!--  display dashboard information-->
            <section id="dashboardsection">
                <?php
                include 'db.php';

                // Fetch total users
                $user_query = "SELECT COUNT(*) as total_users FROM users";
                $user_result = $conn->query($user_query);
                $total_users = $user_result->fetch_assoc()['total_users'];

                // Fetch total tour packages
                $package_query = "SELECT COUNT(*) as total_packages FROM tour_packages";
                $package_result = $conn->query($package_query);
                $total_packages = $package_result->fetch_assoc()['total_packages'];

                // Fetch total active packages
                $active_packages_query = "SELECT COUNT(*) as active_packages FROM tour_packages WHERE status = 'active'";
                $active_packages_result = $conn->query($active_packages_query);
                $active_packages = $active_packages_result->fetch_assoc()['active_packages'];

                // Fetch total inactive packages
                $inactive_packages_query = "SELECT COUNT(*) as inactive_packages FROM tour_packages WHERE status = 'inactive'";
                $inactive_packages_result = $conn->query($inactive_packages_query);
                $inactive_packages = $inactive_packages_result->fetch_assoc()['inactive_packages'];

                // Fetch total enquiries (contact form submissions)
                $enquiries_query = "SELECT COUNT(*) as total_enquiries FROM contact_form_submissions";
                $enquiries_result = $conn->query($enquiries_query);
                $total_enquiries = $enquiries_result->fetch_assoc()['total_enquiries'];

                // Fetch new enquiries
                $new_enquiries_query = "SELECT COUNT(*) as new_enquiries FROM contact_form_submissions WHERE status = 'new'";
                $new_enquiries_result = $conn->query($new_enquiries_query);
                $new_enquiries = $new_enquiries_result->fetch_assoc()['new_enquiries'];

                // Fetch read enquiries
                $read_enquiries_query = "SELECT COUNT(*) as read_enquiries FROM contact_form_submissions WHERE status = 'read'";
                $read_enquiries_result = $conn->query($read_enquiries_query);
                $read_enquiries = $read_enquiries_result->fetch_assoc()['read_enquiries'];

                // Fetch total bookings
                $bookings_query = "SELECT COUNT(*) as total_bookings FROM bookings";
                $bookings_result = $conn->query($bookings_query);
                $total_bookings = $bookings_result->fetch_assoc()['total_bookings'];

                // Fetch new bookings
                $new_bookings_query = "SELECT COUNT(*) as new_bookings FROM bookings WHERE status = 'new'";
                $new_bookings_result = $conn->query($new_bookings_query);
                $new_bookings = $new_bookings_result->fetch_assoc()['new_bookings'];

                // Fetch cancelled bookings
                $cancelled_bookings_query = "SELECT COUNT(*) as cancelled_bookings FROM bookings WHERE status = 'cancelled'";
                $cancelled_bookings_result = $conn->query($cancelled_bookings_query);
                $cancelled_bookings = $cancelled_bookings_result->fetch_assoc()['cancelled_bookings'];

                // Fetch confirmed bookings
                $confirmed_bookings_query = "SELECT COUNT(*) as confirmed_bookings FROM bookings WHERE status = 'confirmed'";
                $confirmed_bookings_result = $conn->query($confirmed_bookings_query);
                $confirmed_bookings = $confirmed_bookings_result->fetch_assoc()['confirmed_bookings'];
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-tile red">
                            <h3><i class="fas fa-user"></i> User</h3>
                            <h2><?php echo $total_users; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-tile purple">
                            <h3><i class="fas fa-box"></i> Total Packages</h3>
                            <h2><?php echo $total_packages; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-tile green">
                            <h3><i class="fas fa-box-open"></i> Active Packages</h3>
                            <h2><?php echo $active_packages; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-tile red">
                            <h3><i class="fas fa-box-open"></i> Inactive Packages</h3>
                            <h2><?php echo $inactive_packages; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-tile blue">
                            <h3><i class="fas fa-envelope"></i> Enquiries</h3>
                            <h2><?php echo $total_enquiries; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-tile green">
                            <h3><i class="fas fa-envelope-open-text"></i> New Enquiries</h3>
                            <h2><?php echo $new_enquiries; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-tile blue">
                            <h3><i class="fas fa-envelope-open"></i> Read Enquiries</h3>
                            <h2><?php echo $read_enquiries; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-tile blue">
                            <h3><i class="fas fa-book"></i> Bookings</h3>
                            <h2><?php echo $total_bookings; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-tile purple">
                            <h3><i class="fas fa-plus"></i> New Bookings</h3>
                            <h2><?php echo $new_bookings; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-tile red">
                            <h3><i class="fas fa-times"></i> Cancelled Bookings</h3>
                            <h2><?php echo $cancelled_bookings; ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-tile green">
                            <h3><i class="fas fa-check"></i> Confirmed Bookings</h3>
                            <h2><?php echo $confirmed_bookings; ?></h2>
                        </div>
                    </div>
                </div>
                <?php
                    include 'db.php';

                    // Fetch users count per month
                    $user_monthly_query = "
                        SELECT YEAR(submission_date) as year, 
                            MONTH(submission_date) as month, 
                            DATE_FORMAT(submission_date, '%M %Y') as month_year,
                            COUNT(*) as monthly_users 
                        FROM users 
                        GROUP BY YEAR(submission_date), MONTH(submission_date)
                        ORDER BY YEAR(submission_date) DESC, MONTH(submission_date) DESC 
                        LIMIT 6"; // Fetch data for the last 6 months
                    $user_monthly_result = $conn->query($user_monthly_query);
                    $monthly_users = [];
                    $months = [];

                    while ($row = $user_monthly_result->fetch_assoc()) {
                        $months[] = $row['month_year']; // Month in 'Month Year' format
                        $monthly_users[] = $row['monthly_users'];
                    }

                    // Fetch bookings count per month
                    $bookings_monthly_query = "
                        SELECT YEAR(submission_date) as year, 
                            MONTH(submission_date) as month, 
                            COUNT(*) as monthly_bookings 
                        FROM bookings 
                        GROUP BY YEAR(submission_date), MONTH(submission_date)
                        ORDER BY YEAR(submission_date) DESC, MONTH(submission_date) DESC 
                        LIMIT 6"; // Fetch data for the last 6 months
                    $bookings_monthly_result = $conn->query($bookings_monthly_query);
                    $monthly_bookings = [];

                    while ($row = $bookings_monthly_result->fetch_assoc()) {
                        $monthly_bookings[] = $row['monthly_bookings'];
                    }
                ?>
                <canvas id="monthlyUsersBookingsChart" width="400" height="200"></canvas>
                <script>
                    var ctx = document.getElementById('monthlyUsersBookingsChart').getContext('2d');
                    var monthlyUsersBookingsChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode(array_reverse($months)); ?>,  // Labels for the months
                            datasets: [
                                {
                                    label: 'Users',
                                    data: <?php echo json_encode(array_reverse($monthly_users)); ?>,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',  // Blue for Users
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Bookings',
                                    data: <?php echo json_encode(array_reverse($monthly_bookings)); ?>,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',  // Red for Bookings
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Count'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Months'
                                    }
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Monthly Comparison of Users and Bookings'
                                }
                            }
                        }
                    });
                </script>
            </section>

<!-- display or insert tour_package form and details -->
            <section class="display" id="displaySection" style="display: none;">
                <h2>Tour Packages</h2>
                <div class="packages-container">
                    <?php
                    if (isset($_POST['btn1'])) {
                        // Validate that inputs do not contain only spaces
                        $b = trim($_POST['titl']);
                        $d = trim($_POST['desc']);
                        $e = trim($_POST['cost']);
                        $f = trim($_POST['dur']);
                        $g = trim($_POST['loc']);
                        $h = trim($_POST['status']);

                        if ($b === '' || $d === '' || $e === '' || $f === '' || $g === '' || $h === '') {
                            echo "<script>alert('Error: Fields cannot contain only spaces.');</script>";
                        } else {
                            $conn = mysqli_connect("localhost", "root", "", "bharatyatra_db");

                            // Check if the title already exists
                            $checkTitleQuery = "SELECT * FROM tour_packages WHERE title = '$b'";
                            $checkResult = mysqli_query($conn, $checkTitleQuery);

                            if (mysqli_num_rows($checkResult) > 0) {
                                echo "<script>alert('Error: Package with title \"$b\" already exists.');</script>";
                            } else {
                                // Image upload handling
                                $target_path = "uploads/";
                                $file_name = basename($_FILES['fileToUpload']['name']);
                                $target_path = $target_path . $file_name;

                                // Check the file type (only allow certain types)
                                $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                                $file_type = $_FILES['fileToUpload']['type'];

                                // Check the file size (limit to 2MB)
                                $max_file_size = 2 * 1024 * 1024; // 2MB
                                if ($_FILES['fileToUpload']['size'] > $max_file_size) {
                                    echo "<script>alert('Error: File size exceeds the 2MB limit.');</script>";
                                } elseif (!in_array($file_type, $allowed_types)) {
                                    echo "<script>alert('Error: Only JPG, PNG, and GIF files are allowed.');</script>";
                                } else {
                                    // Move the uploaded file
                                    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path)) {
                                        echo "<script>alert('File uploaded successfully!');</script>";
                                    } else {
                                        echo "<script>alert('File uploaded successfully!');</script>";
                                    }

                                    $q = "INSERT INTO tour_packages (title, image, description, cost, duration, location, status) VALUES ('$b', '$file_name', '$d', '$e', '$f', '$g', '$h')";
                                    $query = mysqli_query($conn, $q);

                                    if ($query) {
                                        echo "<script>alert('Data inserted successfully!');</script>";
                                    } else {
                                        echo "<script>alert('Error inserting data: " . mysqli_error($conn) . "');</script>";
                                    }
                                }
                            }
                        }
                    }

                    // Fetch data
                    $sql = "SELECT id, title, image, description, cost, duration, location, status, submission_date FROM tour_packages";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table class='table'>";
                        echo "<tr><th>ID</th><th>Title</th><th>Image</th><th>Description</th><th>Cost</th><th>Duration</th><th>Location</th><th>Status</th><th>Submission Date</th><th>Edit</th><th>Delete</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            $statusColor = $row["status"] === 'active' ? 'green' : 'red';
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["title"] . "</td>";
                            echo "<td><img src='uploads/" . $row["image"] . "' alt='Image' width='100'></td>";
                            echo "<td class='truncate-text'>" . $row["description"] . "</td>";
                            echo "<td>" . $row["cost"] . "</td>";
                            echo "<td>" . $row["duration"] . "</td>";
                            echo "<td>" . $row["location"] . "</td>";

                            // Create a form with a dropdown for status and color it
                            echo "<td>";
                            echo "<form method='POST' action='update_package_status.php'>";
                            echo "<input type='hidden' name='package_id' value='" . $row["id"] . "'>"; // Hidden field to pass the package ID
                            echo "<select name='status' onchange='this.form.submit()' style='color: $statusColor; font-weight: bold;'>";
                            echo "<option value='active'" . ($row["status"] === 'active' ? "selected" : "") . ">Active</option>";
                            echo "<option value='inactive'" . ($row["status"] === 'inactive' ? "selected" : "") . ">Inactive</option>";
                            echo "</select>";
                            echo "</form>";
                            echo "</td>";
                            echo "<td>" . $row["submission_date"] . "</td>";
                            echo "<td><a href='edit_package.php?id=" . $row["id"] . "' class='btn btn-warning' onclick=\"showupdate()\"><i class='fas fa-edit'></i> Update</a></td>";
                            echo "<td><a href='delete_content.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this package?');\" class='btn btn-danger'><i class='fas fa-trash-alt'></i> Delete</a></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No Package found.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            </section>

<!-- display or insert content_package form and detail -->
            <section>
                <div class="display" id="displaycontent" style="display: none;">
                    <h2>Content Packages</h2>
                    <div class="packages-container">
                        <?php
                            // Enable error reporting for debugging
                            ini_set('display_errors', 1);
                            ini_set('display_startup_errors', 1);
                            error_reporting(E_ALL);

                            // Include your database connection file
                            include 'db.php';

                            // Initialize an error message variable
                            $error_message = '';

                            // Fetch tour packages from the database
                            $tour_packages = [];
                            $sql = "SELECT id, title FROM tour_packages";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $tour_packages[] = $row;
                                }
                            } else {
                                $error_message = "No tour packages found. Please add a tour package first.";
                            }

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Collecting the form data with validation
                                $image_path = trim($conn->real_escape_string($_POST['image_path']));
                                $tour_name = trim($conn->real_escape_string($_POST['tour_name']));
                                $location = trim($conn->real_escape_string($_POST['location']));
                                $description = trim($conn->real_escape_string($_POST['description']));
                                $tour_package_id = (int)$_POST['tour_package_id']; // Typecast to integer

                                // Server-side validation for spaces or empty values
                                if (empty($image_path) || empty($tour_name) || empty($location) || empty($description)) {
                                    $error_message = "All fields are required and must not contain only spaces.";
                                } elseif (preg_match('/^\s*$/', $image_path) || preg_match('/^\s*$/', $tour_name) || preg_match('/^\s*$/', $location) || preg_match('/^\s*$/', $description)) {
                                    $error_message = "Fields cannot consist of only spaces.";
                                } else {
                                    // Insert data into the content_package table using prepared statements
                                    $stmt = $conn->prepare("INSERT INTO content_package (image_path, tour_name, location, description, tour_package_id) 
                                                            VALUES (?, ?, ?, ?, ?)");
                                    $stmt->bind_param("ssssi", $image_path, $tour_name, $location, $description, $tour_package_id);

                                    if ($stmt->execute()) {
                                        echo "<script>alert('New record created successfully');</script>";
                                    } else {
                                        echo "<script>alert('Error: " . $stmt->error . "');</script>";
                                    }

                                    $stmt->close();
                                }
                            }

                            // Fetch data to display
                            $sql = "SELECT id, image_path, tour_name, location, description, tour_package_id, created_at FROM content_package";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table class='table'>";
                                echo "<tr><th>ID</th><th>Image</th><th>Name</th><th>Location</th><th>Description</th><th>Tour Package ID</th><th>Created Date</th><th>Edit</th><th>Delete</th></tr>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td><img src='uploads/" . $row["image_path"] . "' alt='Image' width='100'></td>";
                                    echo "<td>" . $row["tour_name"] . "</td>";
                                    echo "<td>" . $row["location"] . "</td>";

                                    // Description column with inline styling for truncation
                                    echo "<td style='max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>" . $row["description"] . "</td>";

                                    echo "<td>" . $row["tour_package_id"] . "</td>";
                                    echo "<td>" . $row["created_at"] . "</td>";
                                    echo "<td><a href='edit_content.php?id=" . $row["id"] . "' class='btn btn-warning'><i class='fas fa-edit'></i> Update</a></td>";
                                    echo "<td><a href='delete_content.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this package?');\" class='btn btn-danger'><i class='fas fa-trash-alt'></i> Delete</a></td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<p>No Package found.</p>";
                            }

                            // Close the database connection
                            $conn->close();
                        ?>
                    </div>
                </div>
            </section>

<!-- display users signup-login details -->
            <section class="display" id="displayusers" style="display: none;">
                <h2>Users Signup-Login</h2>
                <div class="packages-container">
                    <?php
                    // Connect to the database
                    $conn = new mysqli("localhost", "root", "", "bharatyatra_db");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch users data including status
                    $sql = "SELECT id, name, email, password, status, submission_date FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>Id</th><th>Name</th><th>Email</th><th>Password</th><th>Status</th><th>Submission Date</th></tr>";

                        while ($row = $result->fetch_assoc()) {
                            $statusOptions = [
                                'active' => 'Active',
                                'blocked' => 'Blocked'
                            ];

                            // Determine the class based on the status
                            $statusClass = $row["status"] === 'active' ? 'status-active' : 'status-blocked';

                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";

                            // Form to change the status
                            echo "<td>";
                            echo "<form method='POST' action='update_user_status.php'>";
                            echo "<input type='hidden' name='user_id' value='" . $row["id"] . "'>"; // Hidden field to pass the user ID
                            echo "<select name='status' onchange='this.form.submit()' class='$statusClass'>"; // Apply class for color
                            foreach ($statusOptions as $value => $label) {
                                $selected = $row["status"] === $value ? "selected" : "";
                                echo "<option value='$value' $selected>$label</option>";
                            }
                            echo "</select>";
                            echo "</form>";
                            echo "</td>";

                            echo "<td>" . $row["submission_date"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No Signup found.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            </section>

<!-- display booking details -->
            <section class="display" id="displaybookings" style="display: none;">
                <h2>Bookings</h2>
                <div class="packages-container">
                    <!-- Filtering Form -->
                    <form method="GET" action="" onsubmit="showBookings()">
                        <label for="statusFilter">Filter by Status:</label>
                        <select name="statusFilter" id="statusFilter" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="new" <?= isset($_GET['statusFilter']) && $_GET['statusFilter'] === 'new' ? 'selected' : '' ?>>New</option>
                            <option value="confirmed" <?= isset($_GET['statusFilter']) && $_GET['statusFilter'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                            <option value="cancelled" <?= isset($_GET['statusFilter']) && $_GET['statusFilter'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </form>

                    <?php
                    // Database connection
                    $conn = new mysqli("localhost", "root", "", "bharatyatra_db");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Get the current date
                    $current_date = date('Y-m-d');

                    // Prepare the base SQL query
                    $sql = "SELECT booking_id, name, email, country_code, phone, tour_package, travel_date, return_date, number_of_persons, status, submission_date FROM bookings";

                    // Check if a filter is applied
                    if (isset($_GET['statusFilter']) && $_GET['statusFilter'] !== '') {
                        $statusFilter = $_GET['statusFilter'];
                        $sql .= " WHERE status = '$statusFilter'";
                    }

                    $result = $conn->query($sql);

                    // Check if there are bookings and update status if travel date has passed
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $travel_date = $row['travel_date'];
                            $status = $row['status'];

                            // If travel date has passed and status is not 'cancelled' or 'confirmed', update to 'confirmed'
                            if ($status !== 'cancelled' && $current_date >= $travel_date && $status !== 'confirmed') {
                                $update_sql = "UPDATE bookings SET status = 'confirmed' WHERE booking_id = ?";
                                if ($stmt = $conn->prepare($update_sql)) {
                                    $stmt->bind_param("i", $row['booking_id']);
                                    $stmt->execute();
                                    $stmt->close();
                                }
                            }
                        }
                    }

                    // Re-fetch updated bookings to display the latest information
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>Booking ID</th><th>Name</th><th>Email</th><th>Country Code</th><th>Phone</th><th>Tour Package</th><th>Travel Date</th><th>Return Date</th><th>Number of Persons</th><th>Status</th><th>Submission Date</th><th>Actions</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            $statusOptions = [
                                'new' => 'New',
                                'confirmed' => 'Confirmed',
                                'cancelled' => 'Cancelled'
                            ];

                            // Determine the color based on the status
                            $statusColor = '';
                            if ($row["status"] === 'new') {
                                $statusColor = 'color: orange; font-weight: bold;';
                            } elseif ($row["status"] === 'confirmed') {
                                $statusColor = 'color: green; font-weight: bold;';
                            } elseif ($row["status"] === 'cancelled') {
                                $statusColor = 'color: red; font-weight: bold;';
                            }

                            echo "<tr>";
                            echo "<td>" . $row["booking_id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["country_code"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["tour_package"] . "</td>";
                            echo "<td>" . $row["travel_date"] . "</td>";
                            echo "<td>" . $row["return_date"] . "</td>";
                            echo "<td>" . $row["number_of_persons"] . "</td>";

                            // Create a form with a dropdown for status
                            echo "<td>";
                            echo "<form method='POST' action='update_booking_status.php'>";
                            echo "<input type='hidden' name='booking_id' value='" . $row["booking_id"] . "'>"; // Hidden field to pass the booking ID
                            echo "<select name='status' onchange='this.form.submit()' style='$statusColor'>"; // Inline color styling for the dropdown
                            foreach ($statusOptions as $value => $label) {
                                $selected = $row["status"] === $value ? "selected" : "";
                                echo "<option value='$value' $selected>$label</option>";
                            }
                            echo "</select>";
                            echo "</form>";
                            echo "</td>";

                            echo "<td>" . $row["submission_date"] . "</td>";

                            // Add a delete button
                            echo "<td>";
                            echo "<form method='POST' action='delete_booking.php' id='deleteForm" . $row["booking_id"] . "'>";
                            echo "<input type='hidden' name='booking_id' value='" . $row["booking_id"] . "'>"; // Hidden field for booking ID
                            echo "<a href='#' class='btn btn-danger' onclick='if(confirm(\"Are you sure you want to delete this booking?\")) { document.getElementById(\"deleteForm" . $row["booking_id"] . "\").submit(); return false; }'>";
                            echo "<i class='fas fa-trash-alt'></i>  Delete"; // Trash icon
                            echo "</a>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No bookings found.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            </section>

<!-- display contact_form_submissions? -->
        <section class="display" id="displayinquiry" style="display: none;">
            <h2>Inquiry-Response</h2>
            <div class="Inquiries & Response">
                <!-- Filtering Form -->
                <form method="GET" action="">
                    <label for="statusFilter">Filter by Status:</label>
                    <select name="statusFilter" id="statusFilter" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="new" <?= isset($_GET['statusFilter']) && $_GET['statusFilter'] === 'new' ? 'selected' : '' ?>>New</option>
                        <option value="read" <?= isset($_GET['statusFilter']) && $_GET['statusFilter'] === 'read' ? 'selected' : '' ?>>Read</option>
                    </select>
                </form>

                <?php
                $conn = new mysqli("localhost", "root", "", "bharatyatra_db");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Base SQL query
                $sql = "SELECT id, name, mobile, email, destination, comment, status, submission_date FROM contact_form_submissions";

                // Check if a filter is applied
                if (isset($_GET['statusFilter']) && $_GET['statusFilter'] !== '') {
                    $statusFilter = $_GET['statusFilter'];
                    $sql .= " WHERE status = '$statusFilter'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Id</th><th>Name</th><th>Mobile</th><th>Email</th><th>Destination</th><th>Comment</th><th>Status</th><th>Submission Date</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        $statusOptions = [
                            'new' => 'New',
                            'read' => 'Read'
                        ];

                        // Determine the class based on the status
                        $statusClass = $row["status"] === 'new' ? 'status-new' : 'status-read';

                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["mobile"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["destination"] . "</td>";
                        echo "<td>" . $row["comment"] . "</td>";

                        // Form to change the status
                        echo "<td>";
                        echo "<form method='POST' action='update_inquiry_status.php'>";
                        echo "<input type='hidden' name='inquiry_id' value='" . $row["id"] . "'>"; // Hidden field to pass the inquiry ID
                        echo "<select name='status' onchange='this.form.submit()' class='$statusClass'>"; // Apply class for color
                        foreach ($statusOptions as $value => $label) {
                            $selected = $row["status"] === $value ? "selected" : "";
                            echo "<option value='$value' $selected>$label</option>";
                        }
                        echo "</select>";
                        echo "</form>";
                        echo "</td>";

                        echo "<td>" . $row["submission_date"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No Inquiries found.</p>";
                }

                $conn->close();
                ?>
            </div>
        </section>

<!-- display rate and Reviews -->
            <section class="display" id="displayreviews" style="display: none;">
                <h2>Rate And Reviews</h2>
                <div class="feedback">
                    <!-- Filtering Form -->
                    <form method="GET" action="">
                        <label for="statusFilter">Filter by Status:</label>
                        <select name="statusFilter" id="statusFilter" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="pending" <?= isset($_GET['statusFilter']) && $_GET['statusFilter'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="approved" <?= isset($_GET['statusFilter']) && $_GET['statusFilter'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                            <option value="rejected" <?= isset($_GET['statusFilter']) && $_GET['statusFilter'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                    </form>

                    <?php
                    $conn = new mysqli("localhost", "root", "", "bharatyatra_db");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Base SQL query
                    $sql = "SELECT id, name, email, rating, comments, status, submission_date FROM feedback";

                    // Check if a filter is applied
                    if (isset($_GET['statusFilter']) && $_GET['statusFilter'] !== '') {
                        $statusFilter = $_GET['statusFilter'];
                        $sql .= " WHERE status = '$statusFilter'";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>Id</th><th>Name</th><th>Email</th><th>Rating</th><th>Comments</th><th>Status</th><th>Submission Date</th></tr>";

                        while ($row = $result->fetch_assoc()) {
                            $statusOptions = [
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected'
                            ];

                            // Determine the class based on the status
                            $statusClass = $row["status"] === 'pending' ? 'status-pending' :
                                        ($row["status"] === 'approved' ? 'status-approved' : 'status-rejected');

                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["rating"] . "</td>";
                            echo "<td>" . $row["comments"] . "</td>";

                            // Form to change the status
                            echo "<td>";
                            echo "<form method='POST' action='update_feedback_status.php'>";
                            echo "<input type='hidden' name='feedback_id' value='" . $row["id"] . "'>"; // Hidden field to pass the review ID
                            echo "<select name='status' onchange='this.form.submit()' class='$statusClass'>"; // Apply class for color
                            foreach ($statusOptions as $value => $label) {
                                $selected = $row["status"] === $value ? "selected" : "";
                                echo "<option value='$value' $selected>$label</option>";
                            }
                            echo "</select>";
                            echo "</form>";
                            echo "</td>";

                            echo "<td>" . $row["submission_date"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No Reviews found.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            </section>

<!-- tour package form -->
            <section class="form-container" id="formContainer">
                <h2>Create Tour Package</h2>
                    <form method="POST" action="" enctype="multipart/form-data">
                    <label for="titl">Title</label>
                    <input type="text" id="titl" name="titl" required>

                    <label for="fileToUpload">Image</label>
                    <input type="file" id="fileToUpload" name="fileToUpload" required>

                    <label for="desc">Description</label>
                    <input type="text" id="desc" name="desc" required>

                    <label for="cost">Cost</label>
                    <input type="text" id="cost" name="cost" required>

                    <label for="dur">Duration</label>
                    <input type="text" id="dur" name="dur" required>

                    <label for="loc">Location</label>
                    <input type="text" id="loc" name="loc" required>

                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select><br><br>

                    <input type="submit" name="btn1" value="Create Package">
                </form>
            </section>

<!-- content_package form -->
            <section class="form-container" id="formcontent">
                <h2 style="text-align:center;">Add Content Package</h2>

                <!-- Display error message if any -->
                <?php if (!empty($error_message)): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <label for="image_path">Image Path</label>
                    <input type="text" id="image_path" name="image_path" required>

                    <label for="tour_name">Tour Name</label>
                    <input type="text" id="tour_name" name="tour_name" required>

                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" required>

                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="5" cols="40" required></textarea><br>

                    <label for="tour_package_id">Tour Package</label>
                    <select id="tour_package_id" name="tour_package_id" required>
                        <option value="">Select Tour Package</option>
                        <?php foreach ($tour_packages as $package): ?>
                            <option value="<?php echo $package['id']; ?>"><?php echo $package['title']; ?></option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <input type="submit" name="btn2" value="Create Content Package">
                </form>
            </section>

            <script>
                function validateForm() {
                    var imagePath = document.getElementById("image_path").value.trim();
                    var tourName = document.getElementById("tour_name").value.trim();
                    var location = document.getElementById("location").value.trim();
                    var description = document.getElementById("description").value.trim();

                    if (imagePath === "" || tourName === "" || location === "" || description === "") {
                        alert("All fields are required and must not consist of only spaces.");
                        return false;
                    }

                    return true;
                }
            </script>

        </main>
    </div>
</body>
</html>
<script>
    function toggleDropdown() {
        const dropdownContent = document.querySelector('.dropdown-content');
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    }
    function toggleDropdown1() {
        const dropdownContent = document.querySelector('.dropdown-content1');
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    }
    function hideAllSections() {
        document.getElementById('dashboardsection').style.display = 'none';
        document.getElementById('formContainer').style.display = 'none';
        document.getElementById('formcontent').style.display = 'none';
        document.getElementById('displaySection').style.display = 'none';
        document.getElementById('displaycontent').style.display = 'none';
        document.getElementById('displayusers').style.display = 'none';
        document.getElementById('displaybookings').style.display = 'none';
        document.getElementById('displayinquiry').style.display = 'none';
        document.getElementById('displayreviews').style.display = 'none';
    }

    function showdashboard() {
        hideAllSections();
        document.getElementById('dashboardsection').style.display = 'block';
    }

    function showCreateForm() {
        hideAllSections();
        document.getElementById('formContainer').style.display = 'block';
    }

    function showformcontent() {
        hideAllSections();
        document.getElementById('formcontent').style.display = 'block';
    }

    function showDisplaySection() {
        hideAllSections();
        document.getElementById('displaySection').style.display = 'block';
    }

    function showDisplaycontent() {
        hideAllSections();
        document.getElementById('displaycontent').style.display = 'block';
    }

    function showDisplayUsers() {
        hideAllSections();
        document.getElementById('displayusers').style.display = 'block';
    }

    function showBookings() {
        hideAllSections();
        document.getElementById('displaybookings').style.display = 'block';
    }

    function showInquries() {
        hideAllSections();
        document.getElementById('displayinquiry').style.display = 'block';
    }
    function showReviews() {
        hideAllSections();
        document.getElementById('displayreviews').style.display = 'block';
    }
    function showSection(sectionId) {
        // Hide all sections
        var sections = document.querySelectorAll('main section');
        sections.forEach(function(section) {
            section.style.display = 'none';
        });

        // Show the selected section
        var selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
            selectedSection.style.display = 'block';
        }
    }
function confirmLogout() {
    if (confirm("Are you sure you want to log out?")) {
        window.location.href = 'admin_logout.php'; // Redirect to logout page if confirmed
    }
}
</script>
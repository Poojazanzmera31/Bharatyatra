<?php
// content.php

// Start the session if not already started (optional, based on your project needs)
if (session_status() == PHP_SESSION_NONE) {
    // session_start();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'bharatyatra_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$details = null;
$error_message = null;

// Check if 'id' is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $tourPackageId = (int)$_GET['id']; // Cast to integer for safety

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM content_package WHERE tour_package_id = ?");
    if ($stmt) {
        $stmt->bind_param('i', $tourPackageId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $details = $result->fetch_assoc();
        } else {
            $error_message = "No details found for this tour package.";
        }

        $stmt->close();
    } else {
        $error_message = "Failed to prepare the SQL statement.";
    }
} else {
    $error_message = "Invalid package selection.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Package Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="final_project2/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="content.css">
    <link rel="stylesheet" href="header.css"> 
    <link rel="stylesheet" href="footer.css"> 
    <style>
        /* Container for the package details */
        .package-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 1200px;
            margin: 50px auto;
            gap: 20px;
            padding: 20px;
        }

        /* Image styling */
        .image img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 10px;
        }

        /* Styling for the details section */
        .details {
            text-align: left;
            max-width: 800px;
            padding: 20px;
        }

        .details h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .details .location {
            font-size: 18px;
            color: #777;
            margin-bottom: 20px;
        }

        /* Description formatting */
        .description {
            text-align: justify;
            font-size: 16px;
            line-height: 1.1;
            color: #333;
            margin-bottom: 10px;
        }

        /* Hidden content (for description) */
        .description-full {
            display: none; /* Initially hidden */
        }

        /* Styled Read More link */
        .read-more-link {
            color: #007bff; /* Blue color similar to a hyperlink */
            font-weight: bold;
            cursor: pointer;
            text-decoration: none; /* Remove underline */
            padding: 5px 10px;
            background-color: #f0f0f0; /* Light gray background */
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .read-more-link:hover {
            background-color: #007bff; /* Blue background on hover */
            color: #ffffff; /* White text on hover */
        }

        /* Button styling */
        .details .cn {
            width: 160px;
            height: 40px;
            background: green;
            border: none;
            margin-bottom: 20px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: .4s ease;
        }

        .details .cn a {
            text-decoration: none;
            color: white;
            transition: 0.3s ease;
            font-weight: bold;
        }

        .cn:hover {
            background-color: black;
        }

        @media (max-width: 768px) {
            .package-details {
                flex-direction: column;
                padding: 10px;
            }

            .details h1 {
                font-size: 28px;
            }

            .details .location, .description {
                font-size: 14px;
            }

            .details .cn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .package-details {
                margin: 20px auto;
                gap: 10px;
            }

            .details h1 {
                font-size: 24px;
            }

            .details .cn {
                height: 40px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <?php include_once("header.php"); ?>

    <main>
        <section class="package-details">
            <?php if (isset($error_message)): ?>
                <p><?php echo $error_message; ?></p>
            <?php elseif ($details): ?>
                <div class="image">
                    <img src="uploads/<?php echo htmlspecialchars($details['image_path']); ?>" alt="<?php echo htmlspecialchars($details['tour_name']); ?>">
                </div>
                <div class="details">
                    <h1><?php echo htmlspecialchars($details['tour_name']); ?></h1>
                    <p class="location"><?php echo htmlspecialchars($details['location']); ?></p>
                    <h2>Details</h2>

                    <?php
                    // Split description into lines
                    $description = nl2br(htmlspecialchars($details['description']));
                    $lines = explode('<br />', $description); // Split by <br /> which is from nl2br

                    // Limit the display to 10 lines
                    if (count($lines) > 10) {
                        // Show first 10 lines and hide the rest
                        $short_description = implode('<br />', array_slice($lines, 0, 10));
                        $full_description = implode('<br />', array_slice($lines, 10));
                    ?>
                        <p class="description"><?php echo $short_description; ?></p>
                        <p class="description-full"><?php echo $full_description; ?></p>
                        <span class="read-more-link">Read More</span>
                    <?php
                    } else {
                        // Show full description if it's 10 lines or less
                        echo "<p class='description'>$description</p>";
                    }
                    ?><br><br>
                    <button class="cn"><a href="bookings.php?tour_name=<?php echo urlencode($details['tour_name']); ?>">Book Now</a></button>
                </div>
            <?php else: ?>
                <p>No content available for this tour package.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php include_once("footer.php"); ?>

    <!-- Optional JavaScript for Bootstrap (Ensure paths are correct) -->
    <script src="bootstrap-4.0.0-dist/js/jquery.min.js"></script>
    <script src="bootstrap-4.0.0-dist/js/popper.min.js"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

    <!-- JavaScript to toggle 'Read More' content -->
    <script>
        document.querySelector('.read-more-link').addEventListener('click', function() {
            const fullDescription = document.querySelector('.description-full');
            fullDescription.style.display = fullDescription.style.display === 'none' ? 'block' : 'none';

            // Toggle between "Read More" and "Read Less"
            this.textContent = fullDescription.style.display === 'block' ? 'Read Less' : 'Read More';
        });
    </script>
</body>
</html>
<?php
// Start the session only if no session is already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bharatyatra_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data only if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the required fields are set
    if (isset($_POST['name'], $_POST['email'], $_POST['rating'], $_POST['comments'])) {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $rating = $_POST['rating'];
        $comments = $_POST['comments'];

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, comments) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $email, $rating, $comments);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect with a success message
            header("Location: home.php?success=1");
            exit();
        } else {
            // Redirect with an error message
            header("Location: home.php?error=1");
            exit();
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Redirect with a missing fields message
        header("Location: home.php?error=missing_fields");
        exit();
    }
}

// Handle search functionality for tour packages
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $stmt = $conn->prepare("SELECT id, title, image, description, cost, duration, location FROM tour_packages WHERE status = 'active' AND title LIKE ?");
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Fetch all active tour packages if no search query is provided
    $result = $conn->query("SELECT id, title, image, description, cost, duration, location FROM tour_packages WHERE status = 'active'");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore India</title>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Your other CSS files -->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="feedback.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    main {
        padding: 0;
    }

    .feedback-section h2 {
        text-align: center;
    }   

    .feedback-section, .reviews-section {
        margin-bottom: 30px;
    }

    .feedback-form label {
        margin-left: 50px;
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .feedback-form input[type="text"],
    .feedback-form input[type="email"],
    .feedback-form select,
    .feedback-form textarea {
        margin-left: 50px;
        width: 90%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .feedback-section .btn {
        width: 160px;
        height: 40px;
        background: green;
        border: none;
        margin-bottom: 10px;
        margin-left: 50px;
        font-size: 15px;
        border-radius: 10px;
        cursor: pointer;
        transition: .4s ease;
        text-decoration: none;
        color: white;
        font-weight: bold;
        display: inline-block;
        text-align: center;
    }

    .btn:hover {
        background-color: black;
    }

    .success-message { 
        color: green;
        font-weight: bold;
        text-align: center;
    }

    .error-message {
        color: red;
        font-weight: bold;
        text-align: center;
    }

    /* Search Bar Styling */
.search-bar {
    text-align: center;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.search-bar input[type="text"] {
    padding: 12px 18px;
    width: 500px;
    font-size: 16px;
    border: 2px solid #ddd;
    border-radius: 25px 0 0 25px;
    outline: none;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
}

.search-bar input[type="text"]:focus {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-color: #32a852; /* Green border on focus */
}

.search-bar button {
    padding: 12px 18px;
    background-color: #32a852; /* Green background */
    color: white;
    border: none;
    font-size: 16px;
    border-radius: 0 25px 25px 0;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
}

.search-bar button i {
    margin-right: 8px;
}

.search-bar button:hover {
    background-color: black; /* Darker green on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.close-icon {
    margin-left: -150px;
    display: flex;
    align-items: center;
    font-size: 20px; /* Adjust the size as needed */
    color: #32a852; /* Match the color to your design */
    transition: color 0.3s ease;
}

.close-icon:hover {
    color: red; /* Change color on hover for feedback */
}

/* Media Queries for Responsiveness */
@media (max-width: 480px) {
    .search-bar input[type="text"] {
        width: 70%;
    }
}

@media (min-width: 481px) and (max-width: 768px) {
    .search-bar input[type="text"] {
        width: 80%;
    }
}

    /* Media Queries for Responsiveness */
    @media (max-width: 480px) {
        .feedback-form label {
            margin-left: 20px;
        }

        .feedback-form input[type="text"],
        .feedback-form input[type="email"],
        .feedback-form select,
        .feedback-form textarea,
        .feedback-section .btn {
            margin-left: 20px;
            width: 90%;
        }

        .feedback-section .btn {
            width: 100%;
        }

        .search-bar input[type="text"] {
            width: 70%;
        }
    }

    @media (min-width: 481px) and (max-width: 768px) {
        .feedback-form label {
            margin-left: 30px;
        }
    }
</style>

<body>
    <?php include_once("header.php");?>

    <section>
        <div class="main">
            <div class="content">
                <h1>WELCOME TO <br><span>EXPLORE INDIA</span><br></h1>
                <p class="par">
                    <b>Welcome to Bharatyatra.<br>Your Ultimate Tour and Travel Guide to India.<br>Discover the diverse beauty and rich<br>cultural heritage of India with Bharatyatra.<br>As a dedicated travel agency, we specialize in providing<br>curated tours and travel experiences across India.<br></b>
                </p>
                <button class="cn"><a href="aboutus.php">VIEW DETAILS</a></button>
            </div> 
        </div>
    </section><br><br><br>

    <section class="places" id="place-cards">
        <div class="places-text">
            <h1 id="package">FEATURED TOURS PACKAGES</h1>
            <h2>Favourite Places</h2>
        </div>

        <div class="search-bar">
            <form action="" method="GET" style="display: flex; align-items: center;">
                <input type="text" name="search" placeholder="Search Tour Packages by Title" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit">
                    <i class="fas fa-search">Search</i>
                </button>
                <!-- Add the close icon inside the input box area -->
                <span class="close-icon" onclick="clearSearch()">
                    <i class="fas fa-times"></i>
                </span>
            </form>
        </div>

        <script>
            // Function to clear the search input
            function clearSearch() {
                document.querySelector('input[name="search"]').value = '';
                document.querySelector('form').submit();
            }
        </script>

        <section class="cards">
        <?php
        // Check if any active packages are found
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <div class="card">
            <div class="zoom-img">
                <div class="img-card">
                    <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                </div>
            </div>
            <div class="text">
                <span class="rating">⭐⭐⭐⭐⭐</span>
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <h3><?php echo htmlspecialchars($row['description']); ?></h3>
                <p class="cost">₹<?php echo htmlspecialchars($row['cost']); ?></p>
                <div class="card-box">
                    <p class="time">🕑<?php echo htmlspecialchars($row['duration']); ?></p>
                    <p class="location"><?php echo htmlspecialchars($row['location']); ?></p>
                </div>
                <button class="cn"><a href="content.php?id=<?php echo $row['id']; ?>">View More</a></button>
            </div>
        </div>
        <?php
            endwhile;
        else:
        ?>
            <p>No packages found matching your search.</p>
        <?php
        endif;

        // Close the connection
        $conn->close();
        ?>
    </section><br><br>

    <?php if (isset($_SESSION['user_id'])): ?>
    <section class="feedback-section" id="feedback">
        <h2>We value your feedback!</h2>

        <form action="" method="POST" class="feedback-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="rating">Rating:</label>
            <select id="rating" name="rating" required>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>

            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" rows="4" required></textarea>

            <button type="submit" class="btn">Submit Feedback</button>
        </form>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <p class="success-message">Thank you for your feedback!</p>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <p class="error-message">Oops! Something went wrong. Please try again.</p>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 'missing_fields'): ?>
            <p class="error-message">Please fill in all required fields.</p>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php include_once("footer.php");?>
</body>
</html>
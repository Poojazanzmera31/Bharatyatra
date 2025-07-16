<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="feedback.css"> <!-- Optional: Add your CSS file -->
</head>
<body>
    <main>
        <section class="feedback-section" id="feedback">
            <h2>We value your feedback!</h2>

            <?php if (isset($_GET['success'])): ?>
                <p class="success-message">Thank you for your feedback!</p>
            <?php elseif (isset($_GET['error'])): ?>
                <p class="error-message">There was an error submitting your feedback. Please try again.</p>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'missing_fields'): ?>
                <p class="error-message">Please fill in all required fields.</p>
            <?php endif; ?>

            <form action="submit_feedback.php" method="POST" class="feedback-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="rating">Rating:</label>
                <select id="rating" name="rating" required>
                    <option value="5">Excellent (5)</option>
                    <option value="4">Very Good (4)</option>
                    <option value="3">Good (3)</option>
                    <option value="2">Fair (2)</option>
                    <option value="1">Poor (1)</option>
                </select>

                <label for="comments">Comments:</label>
                <textarea id="comments" name="comments" rows="5" required></textarea>

                <button type="submit" class="btn">Submit Feedback</button>
            </form>
        </section>
    </main>
</body>
</html>


<?php
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

// Process form data only if form is submitted
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
            header("Location: feedback_form.php?success=1");
        } else {
            // Redirect with an error message
            header("Location: feedback_form.php?error=1");
        }

        // Close statement
        $stmt->close();
    } else {
        // Redirect with a missing fields message
        header("Location: feedback_form.php?error=missing_fields");
    }
}

// Close connection
$conn->close();
exit();
?>

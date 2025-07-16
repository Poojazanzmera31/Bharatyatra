<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include('db.php');

// Start session to handle redirects
session_start();

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = sanitizeInput($_POST['password']);

    if ($email && $password) {
        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, name, password, status FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Fetch the user data
                $stmt->bind_result($userId, $name, $hashedPassword, $status);
                $stmt->fetch();

                // Check if the user is blocked
                if ($status === 'blocked') {
                    echo "<script>
                            alert('Your account has been blocked. Please contact support.');
                            window.location.href = 'login.php';
                          </script>";
                    exit(); // Stop further processing
                }

                // Verify password (hash comparison)
                if (password_verify($password, $hashedPassword)) {
                    // Start session and set user data
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;

                    // Redirect to the user's dashboard or home page
                    header("Location: home.php");
                    exit();
                } else {
                    // Password is incorrect
                    echo "<script>
                            alert('Incorrect password. Please try again.');
                            window.location.href = 'login.php';
                          </script>";
                }
            } else {
                // User does not exist
                echo "<script>
                        alert('You are not registered. Please sign up.');
                        window.location.href = 'signup.php';
                      </script>";
            }

            // Close statement
            $stmt->close();
        } else {
            // Handle SQL error
            echo "<script>alert('Database error. Please try again later.');</script>";
        }
    } else {
        echo "<script>alert('Please enter a valid email and password.');</script>";
    }
}

// Close connection
$conn->close();
?>

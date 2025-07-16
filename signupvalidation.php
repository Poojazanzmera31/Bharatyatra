<?php
// Database connection
$host = "localhost";
$dbname = "bharatyatra_db";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs as previously described
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    // Validate email to ensure it has an "@" and ends with ".com"
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/@.+\.com$/", $email)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $errors[] = "Password must be at least 8 characters long, contain at least one uppercase letter, one digit, and one special character.";
    }

    if (empty($errors)) {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Email already exists
            echo "<script>
                    alert('Email is already registered. Please use a different email.');
                    window.location.href = 'signup.php'; // Redirect back to sign-up form
                  </script>";
        } else {
            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert user data into the database
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Registration successful! You can now log in.');
                        window.location.href = 'login.php'; // Redirect to login form
                      </script>";
            } else {
                echo "<script>
                        alert('An error occurred during registration.');
                        window.location.href = 'signup.php'; // Redirect back to sign-up form
                      </script>";
            }
        }

        $stmt->close();
    } else {
        $errorMessage = $errors[0];
        echo "<script>
                alert('$errorMessage');
                window.location.href = 'signup.php'; // Redirect back to sign-up form
              </script>";
    }
}

$conn->close();
?>

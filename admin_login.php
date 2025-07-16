<?php
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user input
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate credentials
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin-panel.php");
        exit(); // Always call exit after a header redirect
    } else {
        $_SESSION['login_error'] = "Invalid credentials!";
        header("Location: admin_login.php"); // Redirect back to the login page
        exit(); // Always call exit after a header redirect
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        .login-box h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .login-box p {
            margin-bottom: 30px;
            font-size: 14px;
            color: #777;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: calc(100% - 40px);
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-box input[type="submit"] {
            background-color: green;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            text-decoration: none;
            color: white;
            transition: 0.3s ease;
            font-weight: bold;
        }

        .login-box input[type="submit"]:hover {
            background-color: black;
        }

        .login-box a {
            color: skyblue;
            text-decoration: none;
            font-size: 15px;
        }

        .login-box a:hover {
            text-decoration: underline;
        }

        .link {
            margin-top: 30px;
        }

        .input-group {
            display: flex;
            align-items: center;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .input-group input {
            padding-left: 35px; /* Space for the icon */
        }

        /* Media queries for responsiveness */
        @media only screen and (min-width: 1024px) {'8'
            .login-box {
                width: 400px;
            }
        }

        @media only screen and (max-width: 1024px) and (min-width: 768px) {
            .login-box {
                width: 350px;
            }
        }

        @media only screen and (max-width: 767px) {
            body {
                flex-direction: column;
                padding: 20px;
            }

            .login-box {
                width: 100%;
                padding: 20px;
                box-shadow: none;
            }

            .login-box h2 {
                font-size: 20px;
            }

            .login-box input[type="text"],
            .login-box input[type="password"] {
                font-size: 14px;
                padding: 8px 12px;
            }

            .login-box input[type="submit"] {
                padding: 10px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <p>Sign in to start your session</p>
    <form method="post" action="">
        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        
        <input type="submit" value="Sign In">
        <div class="link">
            <a href="home.php">Go to Website</a>
        </div>
    </form>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    // Display error message from PHP session variable
    <?php if (isset($_SESSION['login_error'])): ?>
        alert("<?php echo $_SESSION['login_error']; ?>");
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>
</script>
</body>
</html>
<?php
// Start session to check if user is logged in
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="header.css">
    <style>
        .dropdown-content {
            right: 0; /* Position the dropdown menu on the right */
            left: auto; /* Remove default left alignment */
            padding: 15px; /* Add some padding */
            background-color: #fff; /* Background color for the dropdown */
            border: 1px solid #ddd; /* Border around the dropdown */
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1); /* Shadow for better visibility */
            width: 100px; /* Set a fixed width for consistency */
        }
        .dropdown-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
            text-align: center;
        }
        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
<section class="nav-bar">
    <div class="logo">BharatYatra</div>
    <ul class="menu">
        <li><a href="home.php">Home</a></li>
        <li><a href="#package">Package</a></li>
        <li><a href="aboutus.php">About us</a></li>
        <li><a href="#feedback" id="feedback-link" 
               data-logged-in="<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>">Feedback</a></li>
        <li><a href="contactus.php">Contact us</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- If the user is logged in, show their profile options -->
            <li class="dropdown">
            <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong>
                <div class="dropdown-content">
                    <div class="profile-info">
                        <a href="your_bookings.php">Your Bookings</a>
                        <a href="profile.php">Your Profile</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </li>
        <?php else: ?>
            <!-- If the user is not logged in, show the registration links -->
            <li class="dropdown">
                <a href="#" class="dropbtn">Registration</a>
                <div class="dropdown-content">
                    <a href="signup.php" target="_blank">SignUp</a>
                    <a href="login.php">LogIn</a>
                </div>
            </li>
        <?php endif; ?>
    </ul>
</section>

<script>
    document.getElementById('feedback-link').addEventListener('click', function(event) {
        var isLoggedIn = this.getAttribute('data-logged-in') === 'true';

        if (!isLoggedIn) {
            event.preventDefault(); // Prevent default action
            alert('Please login first to give feedback.');
        }
    });
</script>

</body>
</html>
<?php
session_start();
session_unset();
session_destroy();

echo "<script>
        alert('You have been logged out.');
        window.location.href = 'home.php'; // Redirect to login page
      </script>";

// Redirect to the login page
header("Location: login.php");
exit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contactus.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <?php include_once("header.php"); ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = ""; // Add your database password here
        $dbname = "bharatyatra_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize and validate input
        $name = htmlspecialchars(trim($_POST['name']));
        $mobile = htmlspecialchars(trim($_POST['mobile']));
        $email = htmlspecialchars(trim($_POST['email']));
        $destination = htmlspecialchars(trim($_POST['destination']));
        $comment = htmlspecialchars(trim($_POST['comment']));

        // Initialize an array to store errors
        $errors = [];

        // Validate fields
        if (empty($name)) {
            $errors[] = "Name is required.";
        }
        if (empty($mobile)) {
            $errors[] = "Mobile number is required.";
        } elseif (!preg_match("/^[0-9]{10}$/", $mobile)) {
            $errors[] = "Invalid mobile number format. It should be 10 digits.";
        }
        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
        if (empty($destination)) {
            $errors[] = "Destination is required.";
        }
        if (empty($comment)) {
            $errors[] = "Message is required.";
        }

        if (empty($errors)) {
            // Prepare SQL statement
            $stmt = $conn->prepare("INSERT INTO contact_form_submissions (name, mobile, email, destination, comment) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $mobile, $email, $destination, $comment);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>showAlert('Thank you for contacting us, $name. We will get back to you soon!');</script>";
            } else {
                echo "<script>showAlert('Sorry, something went wrong. Please try again later.');</script>";
            }

            // Close connections
            $stmt->close();
        } else {
            foreach ($errors as $error) {
                echo "<script>showAlert('$error');</script>";
            }
        }

        $conn->close();
    }
    ?>

    <section>
        <div class="main">
            <h1>CONNECT WITH US</h1>
            <div class="contact-content">
                <div class="contact-box">
                    <h2>📞 Call Us</h2>
                    <p>For further details please call</p>
                    <p class="contact-number">+91 9512128080</p>
                </div>
                <div class="contact-box">
                    <h2>✉️ Mail Us</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="text" name="name" placeholder="Enter Name*" required>
                        <input type="text" name="mobile" placeholder="Enter Mobile Number*" required>
                        <input type="email" name="email" placeholder="Enter Email*" required>
                        <input list="destinations" name="destination" placeholder="Select or enter your destination" required>
                        <datalist id="destinations">
                            <option value="Andhra Pradesh">
                            <option value="Bihar Jharkhand">
                            <option value="Chhatisgadh">
                            <option value="Delhi-Uttarpradesh">
                            <option value="Delhi">
                            <option value="Goa">
                            <option value="Gujarat">
                            <option value="Jammu-Kashmir">
                            <option value="Karnataka">
                            <option value="Kerala">
                            <option value="Maharashtra">
                            <option value="Orrissa-Sikkim">
                            <option value="Punjab">
                            <option value="Rajasthan">
                            <option value="Tamil-Nadu">
                            <option value="West-Benagl">
                        </datalist>
                        <textarea name="comment" placeholder="Enter Your Message*" required></textarea>
                        <button type="submit">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include_once("footer.php"); ?>
</body>
</html>
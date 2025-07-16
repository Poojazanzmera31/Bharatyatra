<?php
session_start();

// Include the database connection file
include 'db.PHP';  // Assuming this file contains the $conn initialization

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('Please, login into the website.');
            window.location.href = 'login.php';
        </script>";
    exit();
}

// Fetch the stored username and email from the session
$name = $_SESSION['name'] ?? '';
$email = $_SESSION['email'] ?? '';

$errors = [];
$phone = $countryCode = $travelDate = $returnDate = $numberOfPersons = $tourPackage = "";

// Check if a specific tour package is passed in the URL
if (isset($_GET['tour_name'])) {
    $tourPackage = htmlspecialchars(urldecode($_GET['tour_name']));
} else {
    // Set a default value if no tour is selected
    $tourPackage = "No package selected";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $countryCode = htmlspecialchars($_POST['countryCode']);
    $phone = htmlspecialchars($_POST['phone']);
    $travelDate = htmlspecialchars($_POST['travelDate']);
    $returnDate = htmlspecialchars($_POST['returnDate']);
    $numberOfPersons = htmlspecialchars($_POST['numberOfPersons']);
    $tourPackage = htmlspecialchars($_POST['tourPackage']); // Tour package fetched from the database

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/@.+\.com$/", $email)) {
        $errors[] = "Invalid email format.";
    }

    // Validate phone number
    if ($countryCode == "+91" && !preg_match("/^\d{10}$/", $phone)) {
        $errors[] = "Phone number must be exactly 10 digits when using the Indian country code.";
    }

    // If no errors, store data in session and insert into database
    if (empty($errors)) {
        $_SESSION['bookingData'] = [
            'name' => $name,
            'email' => $email,
            'countryCode' => $countryCode,
            'phone' => $phone,
            'travelDate' => $travelDate,
            'returnDate' => $returnDate,
            'numberOfPersons' => $numberOfPersons,
            'tourPackage' => $tourPackage,
        ];

        // SQL query to insert data
        $sql = "INSERT INTO bookings (name, email, country_code, phone, tour_package, travel_date, return_date, number_of_persons) 
                VALUES ('$name', '$email', '$countryCode', '$phone', '$tourPackage', '$travelDate', '$returnDate', '$numberOfPersons')";

        // Execute query and check for success
        if ($conn->query($sql) === TRUE) {
            header("Location: confirmation.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <style>
        /* Your existing CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    margin-top: 50px;
    margin-bottom: 50px;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input, .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-group .phone {
    display: flex;
}

.form-group .phone input {
    flex: 1;
    margin-right: -1px;
}

.form-group .phone select {
    width: 150px;
}

.number-control {
    display: flex;
    align-items: center;
}

.number-control button {
    width: 30px;
    height: 30px;
    font-size: 18px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #eaeaea;
    cursor: pointer;
}

.number-control input {
    text-align: center;
    width: 50px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 0 5px;
}

.form-group button {
    padding: 10px 20px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.form-group button:hover {
    background-color: #218838;
}

h1 {
    text-align: center;
    color: #333;
}

.errors {
    color: red;
    margin-bottom: 20px;
}

.errors p {
    margin: 0;
}

.container .submit-btn {
    width: 160px;
    height: 40px;
    background: green;
    border: none;
    margin-bottom: 10px;
    margin-left: 20px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.4s ease;
}

.container .submit-btn {
    text-decoration: none;
    color: white;
    transition: 0.3s ease;
    font-weight: bold;
}

.submit-btn:hover {
    background-color: black;
}

/* Media Queries for Responsive Design */

/* Large screens (desktops) */
@media only screen and (min-width: 1024px) {
    .container {
        max-width: 800px; /* Increase width on large screens */
    }

    .form-group input, .form-group select {
        padding: 12px; /* Increase padding for better readability */
    }
}

/* Medium screens (tablets) */
@media only screen and (max-width: 1024px) and (min-width: 768px) {
    .container {
        max-width: 700px; /* Adjust width for tablets */
    }

    h1 {
        font-size: 24px;
    }

    .form-group input, .form-group select {
        padding: 10px; /* Keep padding reasonable */
    }

    .submit-btn {
        width: 140px; /* Adjust button width for tablets */
        font-size: 16px;
    }
}

/* Small screens (mobile devices) */
@media only screen and (max-width: 767px) {
    body {
        padding: 10px; /* Add padding around the container */
    }

    .container {
        max-width: 100%; /* Full width for mobile */
        margin-top: 20px;
        margin-bottom: 20px;
        padding: 15px;
        box-shadow: none; /* Remove shadow for simplicity */
    }

    h1 {
        font-size: 20px; /* Reduce heading size */
    }

    .form-group input, .form-group select {
        padding: 8px;
    }

    .submit-btn {
        width: 100%; /* Full width button for mobile */
        font-size: 16px;
        margin-left: 0;
    }
}

    </style>
</head>
<body>
    <?php include_once("header.php");?>
    <div class="container">
        <h1>Booking Form</h1>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form id="bookingForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <div class="phone">
                    <select id="countryCode" name="countryCode">
                        <option value="+91" <?php if($countryCode == "+91") echo "selected"; ?>>+91</option>
                        <!-- Add other country codes as needed -->
                    </select>
                    <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="tourPackage">Tour Package</label>
                <input type="text" id="tourPackage" name="tourPackage" value="<?php echo $tourPackage; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="travelDate">Travel Date</label>
                <input type="date" id="travelDate" name="travelDate" value="<?php echo $travelDate; ?>" required>
                <span id="travelDateError" style="color:red;display:none;">Travel date cannot be today or in the past.</span>
            </div>
            <div class="form-group">
                <label for="returnDate">Return Date</label>
                <input type="date" id="returnDate" name="returnDate" value="<?php echo $returnDate; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="numberOfPersons">Number of Persons</label>
                <input type="number" id="numberOfPersons" name="numberOfPersons" value="<?php echo $numberOfPersons; ?>" min="1" max="10" required>
                <p id="errorPersonsMessage" style="display:none; color:red;">Please enter a number between 1 and 10.</p>
            </div>
            <button type="submit" class="submit-btn">Book</button>
        </form>
    </div>
    <?php include_once("footer.php");?>

    <script>
        document.getElementById('travelDate').addEventListener('change', function() {
            var today = new Date();
            today.setHours(0, 0, 0, 0);  // Reset time to midnight
            var travelDate = new Date(this.value);

            if (travelDate <= today) {
                document.getElementById('travelDateError').style.display = 'block';
                this.value = '';  // Reset the value to avoid invalid input
            } else {
                document.getElementById('travelDateError').style.display = 'none';
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const travelDateInput = document.getElementById('travelDate');
            const returnDateInput = document.getElementById('returnDate');
            const numberOfPersonsInput = document.getElementById('numberOfPersons');
            const errorPersonsMessage = document.getElementById('errorPersonsMessage');

            // Automatically calculate and set the return date (12 days after travel date)
            travelDateInput.addEventListener('change', function() {
                const travelDate = new Date(travelDateInput.value);
                if (!isNaN(travelDate)) {
                    const returnDate = new Date(travelDate);
                    returnDate.setDate(travelDate.getDate() + 12); // Add 12 days
                    returnDateInput.value = returnDate.toISOString().split('T')[0]; // Set return date
                }
            });
            
            // Validate number of persons (must be between 1 and 10)
            numberOfPersonsInput.addEventListener('input', function() {
                const numberOfPersons = parseInt(numberOfPersonsInput.value, 10);
                if (numberOfPersons < 1 || numberOfPersons > 10 || isNaN(numberOfPersons)) {
                    errorPersonsMessage.style.display = 'block';
                } else {
                    errorPersonsMessage.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
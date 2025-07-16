<?php
session_start();

if (!isset($_SESSION['bookingData'])) {
    // Redirect back to booking page if there's no session data
    header("Location: booking.php");
    exit();
}

$bookingData = $_SESSION['bookingData'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
   <style>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
        text-align: center;
    }

    .receipt {
        max-width: 600px;
        margin: 0 auto;
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .receipt h2 {
        margin-top: 0;
    }

    .receipt p {
        font-size: 16px;
        line-height: 1.5;
    }

    .receipt button {
        padding: 10px 20px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .receipt button:hover {
        background-color: #218838;
    }

    /* Media Queries for Responsive Design */

    /* Large screens (desktops) */
    @media only screen and (min-width: 1024px) {
        .receipt {
            max-width: 800px;
            padding: 30px;
        }
        .receipt p {
            font-size: 18px;
        }
    }

    /* Medium screens (tablets) */
    @media only screen and (max-width: 1024px) and (min-width: 768px) {
        .receipt {
            max-width: 700px;
        }
        .receipt p {
            font-size: 17px;
        }
    }

    /* Small screens (mobile devices) */
    @media only screen and (max-width: 767px) {
        .receipt {
            max-width: 100%;
            padding: 15px;
        }
        .receipt p {
            font-size: 14px;
        }
    }
</style>

   </style>
</head>
<body>

    <div class="receipt">
        <h2>Booking Confirmation</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($bookingData['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($bookingData['email']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($bookingData['countryCode']) . ' ' . htmlspecialchars($bookingData['phone']); ?></p>
        <p><strong>Tour Package:</strong> <?php echo htmlspecialchars($bookingData['tourPackage']); ?></p>
        <p><strong>Duration:</strong> <?php echo htmlspecialchars($bookingData['travelDate']) . ' to ' . htmlspecialchars($bookingData['returnDate']); ?></p>
        <p><strong>Number of Persons:</strong> <?php echo htmlspecialchars($bookingData['numberOfPersons']); ?></p>
        <p><strong>Happy Journey & Good Luck For Your Tour</strong></p>
        <p><strong>Regards From Bharatyatra.com</strong></p>

        <button onclick="printAndRedirect()">Print Receipt</button>
    </div>

    <script>
        // Show an alert message when the page loads
        alert('You have successfully booked your tour!');

        // Function to handle printing and redirect after printing
        function printAndRedirect() {
            window.print(); // Opens the print dialog
        }

        // After the print dialog is closed, redirect to home.php
        window.onafterprint = function() {
            window.location.href = "home.php"; // Redirect to home.php
        };
    </script>

</body>
</html>
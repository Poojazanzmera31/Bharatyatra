<?php
session_start();
include 'db.php';  // Database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['name'])) {
    echo "<script>
            alert('You must log in first.');
            window.location.href = 'login.php'; // Redirect to login page
          </script>";
    exit;
}

$email = $_SESSION['email'];

// Handle booking cancellation
if (isset($_GET['cancel_booking_id'])) {
    $cancel_booking_id = $_GET['cancel_booking_id'];

    // Query to check the travel date and submission date
    $query = "SELECT travel_date, submission_date FROM bookings WHERE booking_id = ? AND email = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("is", $cancel_booking_id, $email);
        $stmt->execute();
        $stmt->bind_result($travel_date, $submission_date);
        $stmt->fetch();
        $stmt->close();

        // Check if booking can be canceled
        $current_date = new DateTime();
        $submission_date = new DateTime($submission_date);
        $travel_date = new DateTime($travel_date);

        // Calculate the difference in days between the current date and submission date
        $diff_from_submission = $current_date->diff($submission_date);

        // Check if cancellation is allowed within 2 days of the submission date
        if ($diff_from_submission->days <= 2 && $current_date <= $travel_date) {
            // Update the booking status to 'cancelled'
            $update_query = "UPDATE bookings SET status = 'cancelled' WHERE booking_id = ? AND email = ?";
            if ($update_stmt = $conn->prepare($update_query)) {
                $update_stmt->bind_param("is", $cancel_booking_id, $email);
                if ($update_stmt->execute()) {
                    $message = "Booking successfully cancelled.";
                } else {
                    $message = "Failed to cancel booking: " . $conn->error;
                }
                $update_stmt->close();
            } else {
                $message = "Failed to prepare update statement: " . $conn->error;
            }
        } else {
            $message = "You can only cancel bookings within 2 days of the submission date and before the travel date.";
        }
    } else {
        die('Query failed: ' . $conn->error);
    }
}

// Fetch bookings for the logged-in user
$query = "SELECT booking_id, tour_package, travel_date, return_date, number_of_persons, status, submission_date 
          FROM bookings 
          WHERE email = ?";

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $bookings = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    die('Query failed: ' . $conn->error);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookings</title>
   <style>
    body {
    font-family: 'Roboto', sans-serif;
    background-color: #f0f4f8;
    margin: 0;
    padding: 20px;
    color: #333;
}

h1 {
    text-align: center;
    color: #2c3e50;
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Bookings Table Styling */
.bookings-table {
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.bookings-table thead {
    background-color: #3498db;
    color: white;
}

.bookings-table th,
.bookings-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.bookings-table th {
    font-size: 1.1rem;
    text-transform: uppercase;
}

.bookings-table td {
    font-size: 1rem;
    color: #2c3e50;
}

.bookings-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.bookings-table tr:hover {
    background-color: #d5e5f1;
    transition: background-color 0.3s ease;
}

/* Cancel Button */
.cancel-button {
    color: #e74c3c;
    cursor: pointer;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.cancel-button:hover {
    color: #c0392b;
}

/* Close Button */
.close-button {
    display: block;
    width: 150px;
    margin: 20px auto;
    padding: 12px;
    background-color: #3498db;
    color: white;
    text-align: center;
    font-size: 1.1rem;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}

.close-button:hover {
    background-color: #2980b9;
}

/* Message Box */
.message {
    text-align: center;
    margin: 20px 0;
    padding: 10px;
    border-radius: 5px;
    color: white;
    font-size: 1.1rem;
}

.message.success {
    background-color: #2ecc71;
}

.message.error {
    background-color: #e74c3c;
}

/* Responsive Design */

/* Mobile Devices */
@media (max-width: 768px) {
    h1 {
        font-size: 2rem;
    }

    .bookings-table th, 
    .bookings-table td {
        padding: 10px;
    }

    .bookings-table th {
        font-size: 1rem;
    }

    .bookings-table td {
        font-size: 0.9rem;
    }

    .close-button {
        width: 100px;
        font-size: 1rem;
    }

    .message {
        font-size: 1rem;
    }
}

/* Tablets */
@media (min-width: 769px) and (max-width: 1024px) {
    h1 {
        font-size: 2.2rem;
    }

    .bookings-table {
        width: 95%;
    }

    .bookings-table th, 
    .bookings-table td {
        padding: 12px;
    }

    .close-button {
        width: 120px;
    }
}

/* Desktops */
@media (min-width: 1025px) {
    h1 {
        font-size: 2.5rem;
    }

    .bookings-table {
        width: 90%;
    }

    .close-button {
        width: 150px;
    }
}

   </style>
</head>
<body>
    
    <div class="container">
        <h1>Your Bookings<br><strong><?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></strong></h1>        
        <?php if (isset($message)): ?>
            <p class="message <?php echo ($diff_from_submission->days <= 2) ? 'success' : 'error'; ?>"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <?php if (empty($bookings)): ?>
            <p>No bookings found.</p>
        <?php else: ?>
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>Tour Package</th>
                        <th>Travel Date</th>
                        <th>Return Date</th>
                        <th>Number of Persons</th>
                        <th>Status</th>
                        <th>Submission Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['tour_package']); ?></td>
                            <td><?php echo htmlspecialchars($booking['travel_date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['return_date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['number_of_persons']); ?></td>
                            <td><?php echo htmlspecialchars($booking['status']); ?></td>
                            <td><?php echo htmlspecialchars($booking['submission_date']); ?></td>
                            <td>
                                <?php if ($booking['status'] !== 'cancelled'): ?>
                                    <a href="your_bookings.php?cancel_booking_id=<?php echo htmlspecialchars($booking['booking_id']); ?>" class="cancel-button">Cancel Booking</a>
                                <?php else: ?>
                                    Cancelled
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <a href="javascript:void(0);" class="close-button" onclick="redirectToHome()">Close</a>
    <script>
        function redirectToHome() {
            window.location.href = 'home.php'; // Redirect to home page
        }
    </script>
</body>
</html>

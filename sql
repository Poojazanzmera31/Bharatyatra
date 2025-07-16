CREATE TABLE tour_packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT,
    cost VARCHAR(50) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    location VARCHAR(255) NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',  -- Status column added
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    status ENUM('active', 'blocked') DEFAULT 'active',
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
);

CREATE TABLE contact_form_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    destination VARCHAR(255),
    comment TEXT,
    status ENUM('new', 'read') DEFAULT 'new',  -- Status column added
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    country_code VARCHAR(10) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    tour_package VARCHAR(255) NOT NULL,
    travel_date DATE NOT NULL,
    return_date DATE NOT NULL,
    number_of_persons INT NOT NULL,
    status ENUM('new', 'cancelled', 'confirmed') DEFAULT 'new',
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE content_package (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(255) NOT NULL,
    tour_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    tour_package_id INT,  -- New column to reference tour_packages table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_package_id) REFERENCES tour_packages(id)  -- Adding foreign key constraint
);

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    rating INT NOT NULL,
    comments TEXT NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

<section class="reviews-section">
        <h2>Customer Reviews</h2>
        <div class="reviews">
            <?php
            // Fetch and display feedback from the database
            $feedbackQuery = "SELECT name, rating, comments FROM feedback ORDER BY id DESC LIMIT 5";
            $feedbackResult = $conn->query($feedbackQuery);

            if ($feedbackResult->num_rows > 0) {
                while ($review = $feedbackResult->fetch_assoc()) {
                    echo '<div class="review">';
                    echo '<h4>' . htmlspecialchars($review['name']) . ' (Rating: ' . htmlspecialchars($review['rating']) . ')</h4>';
                    echo '<p>' . htmlspecialchars($review['comments']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No reviews found.</p>';
            }
            ?>
        </div>
    </section>
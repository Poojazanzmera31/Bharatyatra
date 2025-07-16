<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Images</title>
</head>
<body>
    <?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $conn = mysqli_connect("localhost", "root", "", "bharatyatra_db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM tour_packages";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($data = mysqli_fetch_assoc($result)) {
            $imagePath = "uploads/" . htmlspecialchars($data['image']);
            echo '<img class="image" src="' . $imagePath . '" alt="Image">';
        }
    } else {
        echo "No images found.";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
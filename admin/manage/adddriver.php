<?php
require '../includes/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $license = $_POST['license'];
    $phone = $_POST['phone'];
    $vehicle = $_POST['vehicle'];

    // Validate inputs
    if (!empty($name) && !empty($license) && !empty($phone) && !empty($vehicle)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO drivers (name, license, phone, vehicle) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $license, $phone, $vehicle);

        if ($stmt->execute()) {
            echo "New driver added successfully";
            // Redirect or show success message
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}
?>

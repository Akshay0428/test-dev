<?php
require_once __DIR__ . '/config/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $slot = $conn->real_escape_string($_POST['slot']);
    $start = $conn->real_escape_string($_POST['start_time']);
    $end = $conn->real_escape_string($_POST['end_time']);
    $user_id = $_SESSION['user_id'];
    $status = 'booked';  // status for the booking

    // Insert the booking into the bookings table
    $sql = "INSERT INTO bookings (user_id, slot_id, start_time, end_time, status) 
            VALUES ('$user_id', '$slot', '$start', '$end', '$status')";

    if ($conn->query($sql)) {
        // Update the parking slot to mark it as unavailable
        $sql_update = "UPDATE parking_slots SET available = 0 WHERE id = '$slot'";
        
        if ($conn->query($sql_update)) {
            // Redirect to the user's bookings page after successful booking
            header("Location: my_bookings.php");
            exit();
        } else {
            echo "Error while updating slot availability: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

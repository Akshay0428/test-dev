<?php 
include 'includes/header.php'; 
require_once __DIR__ . '/config/db.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch available parking slots from the database
$sql = "SELECT * FROM parking_slots WHERE available = 1";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Book a Parking Slot</h2>

    <!-- Booking Form Card -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="booking.php">

                <!-- Parking Slot Dropdown -->
                <div class="mb-3">
                    <label for="slot" class="form-label">Choose Parking Slot</label>
                    <select name="slot" id="slot" class="form-select" required>
                        <?php 
                        if ($result->num_rows > 0) {
                            // Display each available parking slot in the dropdown
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>
                                        {$row['location']} - Date: {$row['slot_date']} - Cost: ₹{$row['cost']}
                                      </option>";
                            }
                        } else {
                            echo "<option value=''>No slots available</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Start Time Input -->
                <div class="mb-3">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="form-control" required>
                </div>

                <!-- End Time Input -->
                <div class="mb-3">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="datetime-local" name="end_time" id="end_time" class="form-control" required>
                </div>

                <!-- Book Now Button -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Book Now</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

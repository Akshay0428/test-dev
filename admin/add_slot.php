<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
require_once __DIR__ . '/../config/db.php'; 

$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['location'];
    $slot_date = $_POST['slot_date'];
    $cost = $_POST['cost'];

    $stmt = $conn->prepare("INSERT INTO parking_slots (location, slot_date, cost) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $location, $slot_date, $cost);
    $stmt->execute();
    $success = "✅ Slot added successfully!";
}
?>

<?php include 'includes/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white fw-bold text-center">
                    ➕ Add New Parking Slot
                </div>
                <div class="card-body">
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success text-center"><?= $success ?></div>
                    <?php endif; ?>
                    <form method="POST" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="e.g., Block A - Basement" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slot Date</label>
                            <input type="date" name="slot_date" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Cost (in ₹)</label>
                            <input type="number" name="cost" step="0.01" class="form-control" placeholder="e.g., 50.00" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Add Slot</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted text-center">
                    Manage your parking availability efficiently
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

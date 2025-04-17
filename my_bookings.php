<?php
require_once __DIR__ . '/config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// JOIN bookings with parking_slots to get full slot info
$sql = "SELECT b.*, p.location, p.cost 
        FROM bookings b
        JOIN parking_slots p ON b.slot_id = p.id
        WHERE b.user_id = '$user_id'
        ORDER BY b.start_time DESC";

$result = $conn->query($sql);
?>

<?php include 'includes/header.php'; ?>

<div class="container py-5">
    <h2 class="text-center mb-4">📋 My Bookings</h2>

    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white fw-bold">
            Booking History
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Location</th>
                            <th>Cost</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['location']) ?></td>
                                    <td>₹<?= htmlspecialchars($row['cost']) ?></td>
                                    <td><?= date('d M Y, h:i A', strtotime($row['start_time'])) ?></td>
                                    <td><?= date('d M Y, h:i A', strtotime($row['end_time'])) ?></td>
                                    <td>
                                        <?php if (strtolower($row['status']) === 'booked'): ?>
                                            <span class="badge bg-success">Booked</span>
                                        <?php elseif (strtolower($row['status']) === 'cancelled'): ?>
                                            <span class="badge bg-danger">Cancelled</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= htmlspecialchars($row['status']) ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center py-3">No bookings found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

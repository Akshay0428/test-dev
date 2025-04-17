<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
require_once __DIR__ . '/../config/db.php'; 

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM parking_slots WHERE id = $id");
}

$slots = $conn->query("SELECT * FROM parking_slots ORDER BY slot_date DESC");
?>

<?php include 'includes/header.php'; ?>

<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white fw-bold">
            🚗 Manage Parking Slots
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Cost (₹)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $slots->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['location']) ?></td>
                                <td><?= htmlspecialchars($row['slot_date']) ?></td>
                                <td>₹<?= number_format($row['cost'], 2) ?></td>
                                <td>
                                    <?php if ($row['available'] == 0): ?>
                                        <span class="badge bg-danger">Booked</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Available</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Are you sure you want to delete this slot?')">
                                       Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if ($slots->num_rows === 0): ?>
                            <tr>
                                <td colspan="6" class="text-muted">No parking slots found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-end text-muted">
            Last updated: <?= date("d M Y, h:i A") ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

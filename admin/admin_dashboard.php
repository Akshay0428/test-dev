<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<?php include 'includes/header.php'; ?>

<div class="container-fluid py-5">
    <!-- Admin Dashboard Heading -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4 text-primary fw-bold">Admin Dashboard</h1>
            <p class="lead text-muted">Manage parking slots and user bookings efficiently.</p>
        </div>
    </div>


    <!-- Dashboard Main Content -->
    <div class="row">
        <div class="col-12 text-center">
            <h3>Welcome to the Admin Dashboard</h3>
            <p class="text-muted">Use the navigation above to manage parking slots, bookings, and more.</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<base href="/ParkMate_Car_Parking_App/">
<title>ParkMate - Smart Car Parking</title>

<!-- Bootstrap 5.3 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom Stylesheet -->
<link rel="stylesheet" href="/assets/css/style.css">
<!-- Font Awesome for Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold fs-4" href="index.php">🚗 ParkMate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="fas fa-user"></i> My Account</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-cogs"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="my_bookings.php"><i class="fas fa-calendar-check"></i> My Bookings</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php"><i class="fas fa-user-plus"></i> Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="hero bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Smart Parking Solutions</h1>
        <p class="lead">Easily find and book parking slots for your vehicle with just a few clicks.</p>
        <a href="dashboard.php" class="btn btn-light btn-lg mt-3">Find Parking</a>
    </div>
</header>

<!-- Main Content Section -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Our Parking Services</h2>
            <p class="text-center">ParkMate offers a seamless and efficient way to book your parking slots. Just choose a slot, make a booking, and park with ease. Let's get started!</p>
        </div>
    </div>

   

</div>



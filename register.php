<?php include 'includes/header.php'; require_once __DIR__ . '/config/db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = $conn->real_escape_string($_POST['phone']);

    $conn->query("INSERT INTO users (name, email, password, phone) VALUES ('$name', '$email', '$password', '$phone')");
    echo "<div class='alert alert-success text-center'>🎉 Registration successful. <a href='login.php' class='alert-link'>Login here</a>.</div>";
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center fw-bold">
                    ✍️ Register for ParkMate
                </div>
                <div class="card-body">
                    <form method="POST" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Choose a secure password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Create Account</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center text-muted">
                    Already registered? <a href="login.php">Login here</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

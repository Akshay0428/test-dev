<?php 
include 'includes/header.php'; 
require_once __DIR__ . '/config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));

    $update_sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone' WHERE id = '$user_id'";
    if ($conn->query($update_sql)) {
        $success = "Profile updated successfully!";
    } else {
        $error = "Error updating profile: " . $conn->error;
    }
}

// Re-fetch updated user data
$user = $conn->query("SELECT * FROM users WHERE id = '$user_id'")->fetch_assoc();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">👤 My Profile</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success text-center"><?= $success ?></div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white fw-bold">Profile Details</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Name:</strong> <?= htmlspecialchars($user['name']); ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></li>
                    <li class="list-group-item"><strong>Phone:</strong> <?= htmlspecialchars($user['phone']); ?></li>
                </ul>
                <div class="card-footer text-end">
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#editProfileForm">
                        ✏️ Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Collapsible Edit Profile Form -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="collapse" id="editProfileForm">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white fw-bold">
                        Update Your Profile
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" 
                                       value="<?= htmlspecialchars($user['name']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" id="email" class="form-control" 
                                       value="<?= htmlspecialchars($user['email']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control" 
                                       value="<?= htmlspecialchars($user['phone']) ?>" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

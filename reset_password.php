<?php
session_start();
include 'includes/db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_GET['email'];
    $verification_code = $_POST['verification_code'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    // Validate the verification code
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND verification_code = ?");
    $stmt->bind_param("ss", $email, $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Code is valid, update the password
        $stmt = $conn->prepare("UPDATE users SET password = ?, verification_code = NULL WHERE email = ?");
        $stmt->bind_param("ss", $new_password, $email);
        $stmt->execute();
        $success = "Your password has been successfully updated.";
    } else {
        $error = "Invalid verification code.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Reset Password</h2>
    <form method="POST" class="p-4 bg-white shadow rounded">
        <div class="mb-3">
            <label for="verification_code">Enter your verification code</label>
            <input type="text" name="verification_code" id="verification_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="new_password">New Password</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Update Password</button>
        <p class="mt-3 text-danger"><?= $error ?></p>
        <p class="mt-3 text-success"><?= $success ?></p>
    </form>
</div>

</body>
</html>

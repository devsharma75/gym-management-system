<?php
session_start();
include 'includes/db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['reset_email'], FILTER_SANITIZE_EMAIL);

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Generate a random verification code
            $verification_code = bin2hex(random_bytes(16));  // Generates a 32 characters long string

            // Save the code in the database (for later verification)
            $stmt = $conn->prepare("UPDATE users SET verification_code = ? WHERE email = ?");
            $stmt->bind_param("ss", $verification_code, $email);
            $stmt->execute();

            // Send the verification code to the user's email
            $to = $email;
            $subject = "Password Reset Request";
            $message = "Hello, \n\nTo reset your password, please use the following verification code: \n\n" . $verification_code;
            $headers = "From: no-reply@gym.com";

            if (mail($to, $subject, $message, $headers)) {
                $success = "A reset code has been sent to your email. Please check your inbox.";
                header("Location: reset_password.php?email=$email");
                exit();
            } else {
                $error = "Failed to send email. Please try again later.";
            }
        } else {
            $error = "Email not registered.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Forgot Password</h2>
    <form method="post" class="p-4 bg-white shadow rounded">
        <div class="mb-3">
            <label for="reset_email">Enter your registered email address</label>
            <input type="email" name="reset_email" id="reset_email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
        <p class="mt-3 text-danger"><?= $error ?></p>
        <p class="mt-3 text-success"><?= $success ?></p>
    </form>
</div>

</body>
</html>

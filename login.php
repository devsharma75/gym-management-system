<?php
session_start();
include 'includes/db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    header("Location: admin/dashboard.php");
                } elseif ($user['role'] === 'trainer') {
                    header("Location: trainer/dashboard.php");
                } else {
                    header("Location: member/dashboard.php");
                }
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gym Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 6rem;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            background: #fff;
            padding: 2rem;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
        }

        .card-header {
            background-color: #ff8c00;
            color: #fff;
            text-align: center;
            border-radius: 12px;
            font-size: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 1rem;
            border: 1px solid #ddd;
            background-color: #f7f7f7;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #ff8c00;
            box-shadow: 0 0 5px rgba(255, 140, 0, 0.8);
        }

        .btn {
            border-radius: 8px;
            padding: 1rem;
            font-size: 1.2rem;
            background-color: #ff8c00;
            border: none;
            color: white;
            width: 100%;
        }

        .btn:hover {
            background-color: #e07b00;
            transform: scale(1.05);
        }

        .alert {
            opacity: 0;
            animation: fadeInAlert 1s ease-in-out forwards;
        }

        @keyframes fadeInAlert {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .text-link {
            color: #ff8c00;
            text-decoration: none;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #222;
            color: #bbb;
            padding: 2rem 0;
        }

        footer a {
            color: #bbb;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }
        /* Global Styles */
body {
    background-color: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding-top: 6rem;
    overflow-x: hidden;
}

.card {
    border-radius: 12px;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
    background: #fff;
    padding: 2rem;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
}

.card-header {
    background-color: #ff7f00;
    color: white;
    text-align: center;
    border-radius: 12px;
    font-size: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.form-control {
    border-radius: 8px;
    margin-bottom: 20px;
    padding: 1rem;
    border: 1px solid #ddd;
    background-color: #f7f7f7;
    transition: all 0.3s ease;
}

.form-control:focus {
    background-color: white;
    border-color: #ff7f00;
    box-shadow: 0 0 5px rgba(255, 127, 0, 0.8);
}

.btn {
    border-radius: 8px;
    padding: 1rem;
    font-size: 1.2rem;
    background-color: #ff7f00;
    border: none;
    color: white;
    width: 100%;
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.btn:hover {
    background-color: #e57c00;
    transform: scale(1.05);
}

/* Alert Animation */
.alert {
    opacity: 0;
    animation: fadeInAlert 1s ease-in-out forwards;
}

@keyframes fadeInAlert {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

/* Link Styling */
.text-link {
    color: #ff7f00;
    text-decoration: none;
    transition: color 0.3s ease;
}

.text-link:hover {
    text-decoration: underline;
    color: #e57c00;
}

/* Navbar Styling */
.navbar {
    background-color: #343a40;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    font-weight: bold;
    color: #fff;
}

.navbar-nav .nav-link {
    color: white !important;
    transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #ff7f00 !important;
}

/* Footer Styles */
footer {
    background-color: #222;
    color: #bbb;
    padding: 2rem 0;
    box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
}

footer a {
    color: #bbb;
    text-decoration: none;
    transition: color 0.3s ease;
}

footer a:hover {
    color: #fff;
}

/* Animations */
@keyframes slideIn {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(0);
    }
}

.card {
    animation: slideIn 0.5s ease-in-out;
}

/* Footer Quick Links Styling */
footer ul {
    list-style-type: none;
    padding: 0;
}

footer ul li {
    margin: 8px 0;
    font-size: 1rem;
}

footer ul li a {
    font-size: 1rem;
    color: #bbb;
    transition: color 0.3s ease;
}

footer ul li a:hover {
    color: #ff7f00;
}

/* Responsive Design */
@media (max-width: 767px) {
    .navbar-brand {
        font-size: 1.25rem;
    }

    .navbar-nav .nav-link {
        font-size: 1rem;
    }

    .card {
        padding: 1.5rem;
    }
}

    </style>
</head>
<body>

<!-- 🌐 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">🏋️ Gym Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-light" href="index.php">🏠 Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="signup.php">📝 Signup</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="btn btn-warning ms-3 px-4 py-2">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- 💳 Login Card -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Login to Your Account</h4>
                </div>
                <div class="card-body">
                    <?= $error ? "<div class='alert alert-danger text-center'>$error</div>" : '' ?>
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
                        </div>
                        <div class="d-grid">
                            <button class="btn">Login</button>
                        </div>
                    </form>
                    <p class="mt-3 text-center">Don't have an account? <a href="signup.php" class="text-link">Sign up</a></p>
                    <p class="mt-3 text-center">Forgot your password? <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="text-link">Reset Password</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Your Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="forgot_password.php">
                    <div class="mb-3">
                        <label for="resetEmail" class="form-label">Enter your registered email address</label>
                        <input type="email" name="reset_email" id="resetEmail" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Send Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- 🌟 Footer -->
<footer class="text-center text-lg-start mt-5">
    <div class="container text-center text-md-start">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5 class="text-uppercase text-light mb-3">🏋️ Gym Management</h5>
                <p style="font-size: 0.95rem;">Manage your gym members, trainers, and schedules with ease and efficiency.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h6 class="text-uppercase text-light mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-decoration-none text-muted">🏠 Home</a></li>
                    <li><a href="login.php" class="text-decoration-none text-muted">🔐 Login</a></li>
                    <li><a href="signup.php" class="text-decoration-none text-muted">📝 Signup</a></li>
                    <li><a href="terms.php" class="text-decoration-none text-muted">📜 Terms</a></li>
                    <li><a href="privacy.php" class="text-decoration-none text-muted">📜 Privacy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

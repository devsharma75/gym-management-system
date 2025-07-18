<?php
include 'includes/db.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $membership_type = $_POST['membership_type'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    // Validate mobile number to not start with 1, 2, 3, 4, or 5
    if (preg_match('/^[12345]/', $mobile)) {
        $msg = "<div class='alert alert-danger text-center'>❌ Mobile number cannot start with 1, 2, 3, 4, or 5.</div>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (full_name, age, gender, membership_type, email, password, mobile, address, role)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssssss", $full_name, $age, $gender, $membership_type, $email, $password, $mobile, $address, $role);

        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success text-center'>✅ Signup successful. You can now <a href='login.php'>login</a>.</div>";
        } else {
            $msg = "<div class='alert alert-danger text-center'>❌ Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Gym System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .card {
            border: none;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .card-header {
            background-color: #ffffff;
            padding: 1.5rem;
            font-size: 1.5rem;
            color: #007bff;
        }
        .card-body {
            padding: 2rem;
        }
        .form-label {
            font-weight: 600;
            font-size: 1rem;
        }
        .form-control, .form-select, .btn {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            border-color: #007bff;
        }
        .footer {
            background-color: #f1f1f1;
            padding: 1rem 0;
            font-size: 0.875rem;
            color: #333;
        }
        .alert {
            margin-top: 1rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .text-center a {
            color: #007bff;
        }
        .text-center a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        body {
    background-color: #f8f9fa;
    font-family: 'Arial', sans-serif;
}

.navbar {
    background-color: #343a40; /* Dark background matching your homepage */
}

.navbar-brand {
    font-weight: bold;
    color: #ffffff;
}

.navbar .btn {
    color: #ffffff;
    border: 1px solid #ffffff;
}

.navbar .btn:hover {
    background-color: #007bff; /* Light blue hover effect */
    border: 1px solid #007bff;
}

.card {
    border: none;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #343a40; /* Matching card header background */
    color: #ffffff;
}

.card-body {
    background-color: #ffffff;
}

.form-label {
    font-weight: 500;
    color: #333333; /* Slightly darker for better visibility */
}

input, select, textarea {
    border: 1px solid #ced4da;
}

input:focus, select:focus, textarea:focus {
    border-color: #007bff; /* Matching focus color */
}

button {
    background-color: #007bff; /* Matching primary button color */
    color: white;
    border: none;
}

button:hover {
    background-color: #0056b3; /* Darker shade of blue for hover */
}

.alert {
    margin-top: 10px;
}

footer {
    background-color: #343a40;
    color: white;
    padding: 10px;
}

footer small {
    font-size: 0.9rem;
}

.text-center a {
    color: #007bff; /* Matching link color */
}

.text-center a:hover {
    color: #0056b3; /* Darker shade of blue for hover effect */
}

    </style>
</head>
<body>

<!-- 🌐 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">🏋️ Gym Management</a>
        <div class="d-flex">
            <a href="login.php" class="btn btn-outline-light btn-sm">Login</a>
        </div>
    </div>
</nav>

<!-- 💳 Signup Card -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header text-center">
                    Create Your Account
                </div>
                <div class="card-body">
                    <?= $msg ?>
                    <form method="post" novalidate onsubmit="return validateFullName() && validateMobile()">
                        <div class="form-group">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="member">Member</option>
                                    <option value="trainer">Trainer</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="membership_type" class="form-label">Membership Type</label>
                            <select name="membership_type" class="form-select" required>
                                <option value="Basic">Basic</option>
                                <option value="Premium">Premium</option>
                                <option value="Personal Training">Personal Training</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="text" id="mobile" name="mobile" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="d-grid mt-4">
                            <button class="btn btn-primary">Signup</button>
                        </div>
                        <div class="text-center mt-3">
                            Already have an account? <a href="login.php">Login here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 🧾 Footer -->
<footer class="footer text-center">
    <small>&copy; <?= date("Y") ?> Gym Management System. All rights reserved.</small>
</footer>

</body>
</html>

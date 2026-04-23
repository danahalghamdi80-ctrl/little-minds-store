<?php
// Author: Atheer
// Create Admin WITHOUT login (for testing)

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database/db.php';

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        $message = "Please fill in all fields.";
        $messageType = "error";
    } else {
        // Check if username exists
        $check_sql = "SELECT id FROM admin WHERE username = ?";
        $check_stmt = mysqli_prepare($conn, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "s", $username);
        mysqli_stmt_execute($check_stmt);
        $check_result = mysqli_stmt_get_result($check_stmt);

        if (mysqli_num_rows($check_result) > 0) {
            $message = "Username already exists.";
            $messageType = "error";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new admin
            $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Admin created successfully.";
                $messageType = "success";
            } else {
                $message = "Error creating admin: " . mysqli_error($conn);
                $messageType = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Admin</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #4a90e2;
            color: white;
            border: none;
            cursor: pointer;
        }

        .success { color: green; }
        .error { color: red; }
    </style>
</head>

<body>

<div class="box">
    <h2>Create Admin</h2>

    <?php if (!empty($message)) : ?>
        <p class="<?php echo $messageType; ?>">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">
<<<<<<< HEAD

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>

=======
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
>>>>>>> 1158a06f54736aac19ff9aa71c618764d9d7410c
        <button type="submit">Create</button>
    </form>
</div>

</body>
</html>
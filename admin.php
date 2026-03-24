<?php
// Author: Atheer
// Task: Protected admin page

session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 25px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            font-size: 15px;
        }

        .btn-admin {
            background-color: #4a90e2;
        }

        .btn-admin:hover {
            background-color: #357abd;
        }

        .btn-logout {
            background-color: #e74c3c;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome, <?php echo $_SESSION["admin_username"]; ?></h1>
    <p>You are logged in successfully.</p>

    
    <a href="create_admin.php" class="btn btn-admin">Add New Admin</a>

   
    <a href="logout.php" class="btn btn-logout">Logout</a>
</div>

</body>
</html>